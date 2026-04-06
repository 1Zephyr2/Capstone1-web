<?php

namespace App\Http\Controllers;

use App\Models\AppointmentRequest;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class AppointmentRequestController extends Controller
{
    /**
     * Stable key to identify duplicate records of the same pet.
     */
    private function petSignature(Patient $pet): string
    {
        $petName = strtolower(trim((string) ($pet->pet_name ?? '')));
        $species = strtolower(trim((string) ($pet->species ?? '')));
        $breed = strtolower(trim((string) ($pet->breed ?? '')));
        $birthdate = $pet->birthdate ? $pet->birthdate->format('Y-m-d') : '';
        $sex = strtolower(trim((string) ($pet->sex ?? '')));

        return implode('|', [$petName, $species, $breed, $birthdate, $sex]);
    }

    /**
     * Build query for pets accessible to the customer.
     */
    private function customerPetsQuery(User $user): Builder
    {
        $phoneDigits = preg_replace('/\D/', '', (string) ($user->phone ?? ''));

        return Patient::query()->where(function ($query) use ($user, $phoneDigits) {
            $query->where('owner_name', $user->name)
                ->orWhere('owner_contact', $user->email);

            if (!empty($phoneDigits)) {
                $query->orWhere('owner_contact', $phoneDigits)
                    ->orWhere('owner_contact', substr($phoneDigits, 0, 4) . '-' . substr($phoneDigits, 4, 3) . '-' . substr($phoneDigits, 7, 4));
            }

            // Customer-created records should also be directly visible.
            $query->orWhere('user_id', $user->id);
        });
    }

    /**
     * Pick the best representative row among duplicate pet records.
     */
    private function pickPreferredPet(Collection $pets): ?Patient
    {
        if ($pets->isEmpty()) {
            return null;
        }

        return $pets
            ->sortByDesc(function (Patient $pet) {
                $hasPhoto = !empty($pet->pet_photo_path) ? 100000 : 0;
                $hasContact = !empty($pet->owner_contact) ? 10000 : 0;
                return $hasPhoto + $hasContact + (int) $pet->id;
            })
            ->first();
    }

    /**
     * Collapse duplicate pet records for customer selection.
     */
    private function deduplicatePets(Collection $pets): Collection
    {
        return $pets
            ->groupBy(function (Patient $pet) {
                return $this->petSignature($pet);
            })
            ->map(function (Collection $group) {
                return $this->pickPreferredPet($group);
            })
            ->filter()
            ->values();
    }

    /**
     * Check whether the authenticated customer owns the given pet record.
     */
    private function customerOwnsPet(User $user, Patient $pet): bool
    {
        $phoneDigits = preg_replace('/\D/', '', (string) ($user->phone ?? ''));
        $petContactDigits = preg_replace('/\D/', '', (string) ($pet->owner_contact ?? ''));

        return $pet->user_id === $user->id
            || $pet->owner_name === $user->name
            || $pet->owner_contact === $user->email
            || (!empty($phoneDigits) && $petContactDigits === $phoneDigits);
    }

    /**
     * Show the form for creating a new appointment request (customer)
     */
    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        $pets = $this->deduplicatePets($this->customerPetsQuery($user)->get());

        return view('appointment-requests.create', compact('pets'));
    }

    /**
     * Store a newly created appointment request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'requested_date' => 'required|date|after_or_equal:today',
            'requested_time' => 'required',
            'service_type' => 'nullable|string|max:255',
            'preferred_notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        /** @var User $user */
        $user = Auth::user();
        $patient = Patient::find($request->patient_id);

        // Verify ownership
        if (!$patient || !$this->customerOwnsPet($user, $patient)) {
            return back()->with('error', 'Unauthorized access to this pet.');
        }

        $appointmentRequest = AppointmentRequest::create([
            'user_id' => $user->id,
            'patient_id' => $request->patient_id,
            'requested_date' => $request->requested_date,
            'requested_time' => $request->requested_time,
            'service_type' => $request->service_type,
            'preferred_notes' => $request->preferred_notes,
            'status' => 'pending',
        ]);

        // Notify all staff members of new appointment request
        $staffMembers = User::where('role', 'staff')->orWhere('role', 'admin')->get();
        foreach ($staffMembers as $staffUser) {
            Notification::create([
                'user_id' => $staffUser->id,
                'type' => 'new_request',
                'title' => 'New Appointment Request',
                'message' => "{$user->name} requested an appointment for {$patient->pet_name} on {$appointmentRequest->requested_date->format('M d, Y')}",
                'appointment_request_id' => $appointmentRequest->id,
                'data' => [
                    'customer_name' => $user->name,
                    'pet_name' => $patient->pet_name,
                    'date' => $appointmentRequest->requested_date->format('M d, Y'),
                    'time' => \Carbon\Carbon::parse($appointmentRequest->requested_time)->format('g:i A'),
                    'service_type' => $appointmentRequest->service_type ?? 'General',
                ],
            ]);
        }

        return redirect()->route('customer.dashboard')
            ->with('success', 'Appointment request submitted successfully! Staff will review and confirm your request.');
    }

    /**
     * Show pending appointment requests (staff view)
     */
    public function index(Request $request)
    {
        // Only staff/admin can view all requests
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasStaffAccess()) {
            abort(403, 'Unauthorized access. Admin or staff privileges required.');
        }

        $status = $request->query('status', 'pending');
        
        $query = AppointmentRequest::with(['user', 'patient', 'approvedBy']);
        
        // Filter by status unless 'all' is selected
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $requests = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Get counts for each status for the stats
        $stats = [
            'pending' => AppointmentRequest::where('status', 'pending')->count(),
            'approved' => AppointmentRequest::where('status', 'approved')->count(),
            'rejected' => AppointmentRequest::where('status', 'rejected')->count(),
            'cancelled' => AppointmentRequest::where('status', 'cancelled')->count(),
            'total' => AppointmentRequest::count(),
        ];

        return view('appointment-requests.index', compact('requests', 'status', 'stats'));
    }

    /**
     * Show details of a specific request
     */
    public function show(AppointmentRequest $appointmentRequest)
    {
        // Only staff/admin can view all requests
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasStaffAccess()) {
            abort(403, 'Unauthorized access. Admin or staff privileges required.');
        }

        $appointmentRequest->load(['user', 'patient', 'approvedBy']);
        return view('appointment-requests.show', compact('appointmentRequest'));
    }

    /**
     * Approve an appointment request and create appointment
     */
    public function approve(Request $request, AppointmentRequest $appointmentRequest)
    {
        // Only staff/admin can approve requests
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasStaffAccess()) {
            abort(403, 'Unauthorized access. Admin or staff privileges required.');
        }

        if ($appointmentRequest->status !== 'pending') {
            return back()->with('error', 'This request has already been processed.');
        }

        // Create the appointment from the request
        Appointment::create([
            'patient_id' => $appointmentRequest->patient_id,
            'appointment_date' => $appointmentRequest->requested_date,
            'appointment_time' => $appointmentRequest->requested_time,
            'service_type' => $appointmentRequest->service_type ?? 'General',
            'chief_complaint' => $appointmentRequest->preferred_notes,
            'health_worker' => Auth::user()->name,
            'status' => 'confirmed',
        ]);

        // Update request status
        $appointmentRequest->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        // Create notification for pet owner
        Notification::create([
            'user_id' => $appointmentRequest->user_id,
            'type' => 'request_approved',
            'title' => 'Appointment Request Approved! ✓',
            'message' => "Your appointment request for {$appointmentRequest->patient->pet_name} on {$appointmentRequest->requested_date->format('M d, Y')} at " . \Carbon\Carbon::parse($appointmentRequest->requested_time)->format('g:i A') . " has been approved.",
            'appointment_request_id' => $appointmentRequest->id,
            'data' => [
                'pet_name' => $appointmentRequest->patient->pet_name,
                'date' => $appointmentRequest->requested_date->format('M d, Y'),
                'time' => \Carbon\Carbon::parse($appointmentRequest->requested_time)->format('g:i A'),
                'service_type' => $appointmentRequest->service_type ?? 'General',
            ],
        ]);

        return back()->with('success', 'Appointment request approved and appointment created!');
    }

    /**
     * Reject an appointment request
     */
    public function reject(Request $request, AppointmentRequest $appointmentRequest)
    {
        // Only staff/admin can reject requests
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasStaffAccess()) {
            abort(403, 'Unauthorized access. Admin or staff privileges required.');
        }

        $validator = Validator::make($request->all(), [
            'rejection_reason' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if ($appointmentRequest->status !== 'pending') {
            return back()->with('error', 'This request has already been processed.');
        }

        $appointmentRequest->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        // Create notification for pet owner
        Notification::create([
            'user_id' => $appointmentRequest->user_id,
            'type' => 'request_rejected',
            'title' => 'Appointment Request Declined',
            'message' => "Your appointment request for {$appointmentRequest->patient->pet_name} on {$appointmentRequest->requested_date->format('M d, Y')} has been declined. Reason: {$request->rejection_reason}",
            'appointment_request_id' => $appointmentRequest->id,
            'data' => [
                'pet_name' => $appointmentRequest->patient->pet_name,
                'date' => $appointmentRequest->requested_date->format('M d, Y'),
                'reason' => $request->rejection_reason,
            ],
        ]);

        return back()->with('success', 'Appointment request rejected.');
    }

    /**
     * Cancel a pending request (customer)
     */
    public function cancel(AppointmentRequest $appointmentRequest)
    {
        $user = Auth::user();

        // Verify ownership
        if ($appointmentRequest->user_id !== $user->id) {
            abort(403);
        }

        if ($appointmentRequest->status !== 'pending') {
            return back()->with('error', 'Only pending requests can be cancelled.');
        }

        $appointmentRequest->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment request cancelled.');
    }
}
