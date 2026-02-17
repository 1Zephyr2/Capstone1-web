<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Immunization;
use App\Models\BreedingRecord;
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
        
        // Get today's patients (distinct patients who had visits today)
        $todayPatients = Visit::whereDate('visit_date', today())
            ->distinct('patient_id')
            ->count('patient_id');
        
        // Get total patients count
        $totalPatients = Patient::count();
        
        // Get total immunizations count
        $totalImmunizations = Immunization::count();
        
        // Get yesterday's patient count for comparison
        $yesterdayPatients = Visit::whereDate('visit_date', today()->subDay())
            ->distinct('patient_id')
            ->count('patient_id');
        
        // Calculate percentage change
        $patientChangePercent = $yesterdayPatients > 0 
            ? round((($todayPatients - $yesterdayPatients) / $yesterdayPatients) * 100)
            : 0;
        
        // Get current month's patient count for comparison
        $monthStartDate = today()->startOfMonth();
        $monthPatients = Patient::whereDate('created_at', '>=', $monthStartDate)->count();
        $prevMonthEndDate = $monthStartDate->subDay();
        $prevMonthPatients = Patient::whereDate('created_at', '<', $monthStartDate)->count();
        
        // Calculate month percentage change
        $monthChangePercent = $prevMonthPatients > 0
            ? round((($monthPatients - count(Patient::whereDateBetween('created_at', [$prevMonthEndDate->subMonth()->startOfMonth(), $prevMonthEndDate])) ?? 1) / (count(Patient::whereDateBetween('created_at', [$prevMonthEndDate->subMonth()->startOfMonth(), $prevMonthEndDate])) ?? 1)) * 100)
            : ($monthPatients > 0 ? 100 : 0);
        
        // Simpler approach for month comparison
        $thisMonthNew = Patient::whereDate('created_at', '>=', today()->startOfMonth())->count();
        $lastMonthNew = Patient::whereDate('created_at', '>=', today()->subMonth()->startOfMonth())
            ->whereDate('created_at', '<', today()->startOfMonth())->count();
        $monthChangePercent = $lastMonthNew > 0 
            ? round((($thisMonthNew - $lastMonthNew) / $lastMonthNew) * 100)
            : ($thisMonthNew > 0 ? 100 : 0);
        
        // Get visits from this week
        $weeklyVisits = Visit::whereBetween('visit_date', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();
        
        // Get overdue immunizations count
        $overdueImmunizations = Immunization::where('next_dose_date', '<', now())
            ->where('status', '!=', 'completed')
            ->count();
        
        // Get active breeding records count
        $activeBreeding = BreedingRecord::whereHas('patient', function ($query) {
            $query->whereNotNull('id');
        })->count();
        
        // Get incomplete patient records
        $incompleteRecords = Patient::where(function ($query) {
            $query->whereNull('microchip_number')
                  ->orWhereNull('owner_contact');
        })->count();
        
        // Get high-risk breeding cases
        $highRiskBreeding = BreedingRecord::where(function ($query) {
            $query->whereNotNull('risk_factors')
                  ->orWhere('referred', true);
        })->count();
        
        // Total alerts count
        $totalAlerts = $incompleteRecords + $overdueImmunizations + $highRiskBreeding;
        
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
        
        if ($highRiskBreeding > 0) {
            $topAlerts[] = [
                'type' => 'danger',
                'icon' => 'bi-exclamation-triangle-fill',
                'title' => 'High-Risk Breeding',
                'count' => $highRiskBreeding,
                'message' => "$highRiskBreeding breeding case(s) require attention"
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
            'todayPatients',
            'totalPatients',
            'totalImmunizations',
            'patientChangePercent',
            'monthChangePercent',
            'weeklyVisits',
            'overdueImmunizations',
            'activeBreeding',
            'totalAlerts',
            'topAlerts',
            'appointments'
        ));
    }
}
