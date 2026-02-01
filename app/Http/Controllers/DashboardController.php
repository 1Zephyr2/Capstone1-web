<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Immunization;
use App\Models\PrenatalRecord;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
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
                'icon' => '⚠️',
                'title' => 'Incomplete Records',
                'count' => $incompleteRecords,
                'message' => "$incompleteRecords patient(s) with missing information"
            ];
        }
        
        if ($overdueImmunizations > 0) {
            $topAlerts[] = [
                'type' => 'danger',
                'icon' => '💉',
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
        
        return view('dashboard', compact(
            'totalPatients',
            'weeklyVisits',
            'overdueImmunizations',
            'activePrenatal',
            'totalAlerts',
            'topAlerts'
        ));
    }
}
