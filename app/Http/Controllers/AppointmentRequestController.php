<?php

namespace App\Http\Controllers;

use App\Models\AppointmentRequest;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentRequestController extends Controller
{
    /**
     * Show the form for creating a new appointment request (customer)
     */
    public function create()
    {
        $user = Auth::user();
        $pets = Patient::where('owner_name', $user->name)
            ->orWhere('owner_contact', $user->email)
            ->get();

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

        $user = Auth::user();
        $patient = Patient::find($request->patient_id);

        // Verify ownership
        if ($patient->owner_name !== $user->name && $patient->owner_contact !== $user->email) {
            return back()->with('error', 'Unauthorized access to this pet.');
        }

        AppointmentRequest::create([
            'user_id' => $user->id,
            'patient_id' => $request->patient_id,
            'requested_date' => $request->requested_date,
            'requested_time' => $request->requested_time,
            'service_type' => $request->service_type,
            'preferred_notes' => $request->preferred_notes,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Appointment request submitted successfully! Staff will review and confirm your request.');
    }

    /**
     * Show pending appointment requests (staff view)
     */
    public function index()
    {
        // Only staff/admin can view all requests
        if (!Auth::user()->hasStaffAccess()) {
            abort(403, 'Unauthorized access. Admin or staff privileges required.');
        }

        $requests = AppointmentRequest::with(['user', 'patient', 'approvedBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('appointment-requests.index', compact('requests'));
    }

    /**
     * Show details of a specific request
     */
    public function show(AppointmentRequest $request)
    {
        // Only staff/admin can view all requests
        if (!Auth::user()->hasStaffAccess()) {
            abort(403, 'Unauthorized access. Admin or staff privileges required.');
        }

        $request->load(['user', 'patient', 'approvedBy']);
        return view('appointment-requests.show', compact('request'));
    }

    /**
     * Approve an appointment request and create appointment
     */
    public function approve(Request $request, AppointmentRequest $appointmentRequest)
    {
        // Only staff/admin can approve requests
        if (!Auth::user()->hasStaffAccess()) {
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

        return back()->with('success', 'Appointment request approved and appointment created!');
    }

    /**
     * Reject an appointment request
     */
    public function reject(Request $request, AppointmentRequest $appointmentRequest)
    {
        // Only staff/admin can reject requests
        if (!Auth::user()->hasStaffAccess()) {
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
