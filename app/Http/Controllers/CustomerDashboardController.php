<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CustomerDashboardController extends Controller
{
    /**
     * Show the customer dashboard
     */
    public function dashboard(): View
    {
        $user = Auth::user();
        
        // Get customer's pets by email match
        $pets = Patient::where('owner_name', $user->name)
            ->orWhere('owner_contact', $user->email)
            ->get();
        
        // Get upcoming appointments
        $appointments = Appointment::whereIn('patient_id', $pets->pluck('id'))
            ->where('appointment_date', '>=', now())
            ->orderBy('appointment_date')
            ->limit(5)
            ->get();
        
        return view('customer.dashboard', [
            'pets' => $pets,
            'appointments' => $appointments,
        ]);
    }

    /**
     * Show customer's pets list
     */
    public function pets(): View
    {
        $user = Auth::user();
        
        $pets = Patient::where('owner_name', $user->name)
            ->orWhere('owner_contact', $user->email)
            ->get();
        
        return view('customer.pets.index', [
            'pets' => $pets,
        ]);
    }

    /**
     * Show a specific pet and its records
     */
    public function showPet(Patient $patient): View
    {
        // Verify customer owns this pet
        $user = Auth::user();
        if ($patient->owner_contact !== $user->email && $patient->owner_name !== $user->name) {
            abort(403);
        }

        $patient->load([
            'visits' => fn($q) => $q->orderBy('visit_date', 'desc'),
            'appointments' => fn($q) => $q->where('appointment_date', '>=', now())->orderBy('appointment_date'),
        ]);
        
        return view('customer.pets.show', [
            'pet' => $patient,
        ]);
    }

    /**
     * Show customer's appointments
     */
    public function appointments(): View
    {
        $user = Auth::user();
        
        $pets = Patient::where('owner_name', $user->name)
            ->orWhere('owner_contact', $user->email)
            ->get();
        
        $appointments = Appointment::whereIn('patient_id', $pets->pluck('id'))
            ->orderBy('appointment_date', 'desc')
            ->paginate(15);
        
        return view('customer.appointments.index', [
            'appointments' => $appointments,
        ]);
    }

    /**
     * Show a specific appointment details
     */
    public function showAppointment(Appointment $appointment): View
    {
        // Verify customer has access
        $user = Auth::user();
        $pet = $appointment->patient;
        
        if ($pet->owner_contact !== $user->email && $pet->owner_name !== $user->name) {
            abort(403);
        }
        
        return view('customer.appointments.show', [
            'appointment' => $appointment,
            'pet' => $pet,
        ]);
    }
}
