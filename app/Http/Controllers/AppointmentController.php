<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments
     */
    public function index()
    {
        $appointments = Appointment::with('patient')
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->paginate(20);

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new appointment
     */
    public function create()
    {
        $patients = Patient::orderBy('full_name')->get();
        return view('appointments.create', compact('patients'));
    }

    /**
     * Store a newly created appointment in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'visit_date' => 'required|date',
            'visit_time_input' => 'required',
            'service_type' => 'required|string',
            'chief_complaint' => 'nullable|string',
            'health_worker' => 'nullable|string',
            'notes' => 'nullable|string',
            'vaccine_name' => 'nullable|string',
            'dose_number' => 'nullable|string',
            'gestational_age' => 'nullable|integer',
            'presentation' => 'nullable|string',
            'fp_method' => 'nullable|string',
            'referred_to' => 'nullable|string',
            'referral_urgency' => 'nullable|string',
        ]);

        try {
            $appointment = Appointment::create([
                'patient_id' => $validated['patient_id'],
                'appointment_date' => $validated['visit_date'],
                'appointment_time' => $validated['visit_time_input'],
                'service_type' => $validated['service_type'],
                'chief_complaint' => $validated['chief_complaint'] ?? null,
                'health_worker' => $validated['health_worker'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'status' => 'scheduled',
                'vaccine_name' => $validated['vaccine_name'] ?? null,
                'dose_number' => $validated['dose_number'] ?? null,
                'gestational_age' => $validated['gestational_age'] ?? null,
                'presentation' => $validated['presentation'] ?? null,
                'fp_method' => $validated['fp_method'] ?? null,
                'referred_to' => $validated['referred_to'] ?? null,
                'referral_urgency' => $validated['referral_urgency'] ?? null,
            ]);

            return redirect()->route('dashboard')
                ->with('success', 'Appointment booked successfully! The appointment has been scheduled for ' . 
                    $appointment->appointment_date->format('F d, Y') . ' at ' . 
                    $appointment->formatted_time);

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to book appointment: ' . $e->getMessage());
        }
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
        $patients = Patient::orderBy('full_name')->get();
        return view('appointments.edit', compact('appointment', 'patients'));
    }

    /**
     * Update the specified appointment in storage
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'service_type' => 'nullable|string',
            'status' => 'nullable|in:scheduled,completed,cancelled,no-show',
            'chief_complaint' => 'nullable|string',
            'health_worker' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validated);

        // Return JSON for AJAX requests
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Appointment updated successfully!',
                'appointment' => $appointment
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Appointment updated successfully!');
    }

    /**
     * Remove the specified appointment from storage
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Appointment cancelled successfully!');
    }

    /**
     * Get appointments for calendar view
     */
    public function calendar()
    {
        $appointments = Appointment::with('patient')
            ->where('status', '!=', 'cancelled')
            ->get()
            ->groupBy(function($appointment) {
                return $appointment->appointment_date->format('Y-m-d');
            })
            ->map(function($dayAppointments) {
                return $dayAppointments->map(function($appointment) {
                    return [
                        'id' => $appointment->id,
                        'time' => $appointment->formatted_time,
                        'patient' => $appointment->patient->full_name,
                        'type' => $appointment->service_type,
                        'status' => $appointment->status,
                    ];
                })->sortBy('time')->values();
            });

        return response()->json($appointments);
    }

    /**
     * Get today's appointments
     */
    public function today()
    {
        $today = now()->format('Y-m-d');
        
        $appointments = Appointment::with('patient')
            ->whereDate('appointment_date', $today)
            ->where('status', 'scheduled')
            ->orderBy('appointment_time')
            ->get();

        return view('appointments.today', compact('appointments'));
    }
}
