<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments
     */
    public function index(Request $request)
    {
        $query = Appointment::with('patient');

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by service type
        if ($request->has('service_type') && $request->service_type !== 'all') {
            $query->where('service_type', $request->service_type);
        }

        // Filter by date range
        if ($request->has('date_from')) {
            $query->where('appointment_date', '>=', $request->date_from);
        }
        if ($request->has('date_to')) {
            $query->where('appointment_date', '<=', $request->date_to);
        }

        // Search by patient name
        if ($request->has('search') && !empty($request->search)) {
            $query->whereHas('patient', function($q) use ($request) {
                $q->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $request->search . '%');
            });
        }

        $appointments = $query->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->paginate(20);

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new appointment
     */
    public function create(Request $request)
    {
        $patientId = $request->get('patient_id');
        $patient = $patientId ? Patient::find($patientId) : null;

        return view('appointments.book', compact('patient'));
    }

    /**
     * Store a newly created appointment
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'service_type' => 'required|string',
            'chief_complaint' => 'nullable|string',
            'health_worker' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'nullable|in:scheduled,confirmed,completed,cancelled,no-show',
            'vaccine_name' => 'nullable|string|max:255',
            'dose_number' => 'nullable|integer|min:1',
            'gestational_age' => 'nullable|integer|min:0',
            'presentation' => 'nullable|string',
            'fp_method' => 'nullable|string',
            'referred_to' => 'nullable|string',
            'referral_urgency' => 'nullable|in:routine,urgent,emergency',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['status'] = $data['status'] ?? 'scheduled';

        $appointment = Appointment::create($data);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified appointment
     */
    public function show(Appointment $appointment)
    {
        $appointment->load('patient');
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified appointment
     */
    public function edit(Appointment $appointment)
    {
        $appointment->load('patient');
        return view('appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified appointment
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'service_type' => 'required|string',
            'chief_complaint' => 'nullable|string',
            'health_worker' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'nullable|in:scheduled,confirmed,completed,cancelled,no-show',
            'vaccine_name' => 'nullable|string|max:255',
            'dose_number' => 'nullable|integer|min:1',
            'gestational_age' => 'nullable|integer|min:0',
            'presentation' => 'nullable|string',
            'fp_method' => 'nullable|string',
            'referred_to' => 'nullable|string',
            'referral_urgency' => 'nullable|in:routine,urgent,emergency',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $appointment->update($request->all());

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified appointment
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }

    /**
     * Get calendar data for appointments
     */
    public function calendar(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');

        $query = Appointment::with('patient');

        if ($start) {
            $query->where('appointment_date', '>=', $start);
        }
        if ($end) {
            $query->where('appointment_date', '<=', $end);
        }

        $appointments = $query->get()->map(function($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->patient->full_name . ' - ' . $appointment->service_type,
                'start' => $appointment->appointment_date->format('Y-m-d') . 'T' . $appointment->appointment_time->format('H:i:s'),
                'backgroundColor' => $this->getStatusColor($appointment->status),
                'borderColor' => $this->getStatusColor($appointment->status),
                'extendedProps' => [
                    'patient' => $appointment->patient->full_name,
                    'service_type' => $appointment->service_type,
                    'status' => $appointment->status,
                    'chief_complaint' => $appointment->chief_complaint,
                ],
            ];
        });

        return response()->json($appointments);
    }

    /**
     * Get today's appointments
     */
    public function today()
    {
        $appointments = Appointment::with('patient')
            ->whereDate('appointment_date', now()->format('Y-m-d'))
            ->orderBy('appointment_time')
            ->get();

        return view('appointments.today', compact('appointments'));
    }

    /**
     * Get status color for calendar
     */
    private function getStatusColor($status)
    {
        return match($status) {
            'scheduled' => '#007bff',
            'confirmed' => '#28a745',
            'completed' => '#6c757d',
            'cancelled' => '#dc3545',
            'no-show' => '#ffc107',
            default => '#6c757d',
        };
    }
}
