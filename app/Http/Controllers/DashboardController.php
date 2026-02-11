<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Immunization;
use App\Models\PrenatalRecord;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Redirect admins to admin dashboard
        $user = Auth::user();
        if ($user && $user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        // Get total patients count
        $totalPatients = Patient::count();
        
        // Get visits from this week
        $weeklyVisits = Visit::whereBetween('visit_date', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();
        
        // Get overdue immunizations count
        $overdueImmunizations = Immunization::where('next_dose_date', '<', now())
            ->where('status', '!=', 'completed')
            ->count();
        
        // Get active prenatal records count
        $activePrenatal = PrenatalRecord::whereHas('patient', function ($query) {
            $query->whereNotNull('id');
        })->count();
        
        // Get incomplete patient records
        $incompleteRecords = Patient::where(function ($query) {
            $query->whereNull('philhealth_number')
                  ->orWhereNull('contact_number');
        })->count();
        
        // Get high-risk prenatal cases
        $highRiskPrenatal = PrenatalRecord::where(function ($query) {
            $query->where('blood_pressure', 'like', '%140%')
                  ->orWhere('blood_pressure', 'like', '%150%')
                  ->orWhere('blood_pressure', 'like', '%160%');
        })->count();
        
        // Total alerts count
        $totalAlerts = $incompleteRecords + $overdueImmunizations + $highRiskPrenatal;
        
        // Get top alerts with details (limit to 3-5)
        $topAlerts = [];
        
        if ($incompleteRecords > 0) {
            $topAlerts[] = [
                'type' => 'warning',
                'icon' => 'bi-exclamation-triangle-fill',
                'title' => 'Incomplete Records',
                'count' => $incompleteRecords,
                'message' => "$incompleteRecords patient(s) with missing information"
            ];
        }
        
        if ($overdueImmunizations > 0) {
            $topAlerts[] = [
                'type' => 'danger',
                'icon' => 'bi-shield-fill-exclamation',
                'title' => 'Overdue Immunizations',
                'count' => $overdueImmunizations,
                'message' => "$overdueImmunizations immunization(s) overdue"
            ];
        }
        
        if ($highRiskPrenatal > 0) {
            $topAlerts[] = [
                'type' => 'danger',
                'icon' => '🚨',
                'title' => 'High-Risk Prenatal',
                'count' => $highRiskPrenatal,
                'message' => "$highRiskPrenatal prenatal case(s) with high blood pressure"
            ];
        }
        
        // Limit to top 3 alerts for dashboard
        $topAlerts = array_slice($topAlerts, 0, 3);
        
        // Get appointments for calendar (scheduled appointments only)
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
                        'notes' => $appointment->chief_complaint,
                    ];
                })->sortBy('time')->values();
            });
        
        return view('dashboard', compact(
            'totalPatients',
            'weeklyVisits',
            'overdueImmunizations',
            'activePrenatal',
            'totalAlerts',
            'topAlerts',
            'appointments'
        ));
    }
}
