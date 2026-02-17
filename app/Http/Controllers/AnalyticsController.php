<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Immunization;
use App\Models\BreedingRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Calculate metrics
        $totalPatients = Patient::count();
        
        // Current month visits
        $currentMonthVisits = Visit::whereMonth('visit_date', Carbon::now()->month)
            ->whereYear('visit_date', Carbon::now()->year)
            ->count();
        
        // Last month visits
        $lastMonthVisits = Visit::whereMonth('visit_date', Carbon::now()->subMonth()->month)
            ->whereYear('visit_date', Carbon::now()->subMonth()->year)
            ->count();
        
        // Calculate visit growth rate
        $visitGrowthRate = $lastMonthVisits > 0 
            ? round((($currentMonthVisits - $lastMonthVisits) / $lastMonthVisits) * 100, 1)
            : 0;
        
        // Calculate average monthly visits (last 3 months)
        $avgMonthlyVisits = Visit::where('visit_date', '>=', Carbon::now()->subMonths(3))
            ->count() / 3;
        $avgMonthlyVisits = round($avgMonthlyVisits);
        
        // Predicted next month visits
        $predictedNextMonth = round($avgMonthlyVisits * (1 + ($visitGrowthRate / 100)));
        
        // Immunization completion rate
        $totalImmunizations = Immunization::count();
        $completedImmunizations = Immunization::where('dose_number', '>=', 3)->count();
        $completionRate = $totalImmunizations > 0 
            ? round(($completedImmunizations / $totalImmunizations) * 100, 1)
            : 0;
        
        // High risk breeding cases (animals with breeding complications or concerns)
        $highRiskBreeding = BreedingRecord::whereNotNull('risk_factors')
            ->orWhere('referred', true)
            ->distinct('patient_id')
            ->count();
        
        $metrics = [
            'total_patients' => $totalPatients,
            'current_month_visits' => $currentMonthVisits,
            'visit_growth_rate' => $visitGrowthRate,
            'completion_rate' => $completionRate,
            'total_immunizations' => $totalImmunizations,
            'predicted_next_month' => $predictedNextMonth,
            'avg_monthly_visits' => $avgMonthlyVisits,
            'high_risk_breeding' => $highRiskBreeding,
        ];
        
        // Patient growth (last 6 months)
        $patientGrowth = Patient::select(
                DB::raw("strftime('%Y-%m', created_at) as month"),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function($item) {
                $item->month = Carbon::parse($item->month)->format('M Y');
                return $item;
            });
        
        // Visit trends (last 30 days)
        $visitTrends = Visit::select(
                DB::raw("DATE(visit_date) as date"),
                DB::raw('COUNT(*) as count')
            )
            ->where('visit_date', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function($item) {
                $item->date = Carbon::parse($item->date)->format('M d');
                return $item;
            });
        
        // Service distribution
        $serviceDistribution = Visit::select('service_type', DB::raw('COUNT(*) as count'))
            ->groupBy('service_type')
            ->orderBy('count', 'desc')
            ->get();
        
        // Age demographics
        $ageDemographics = Patient::select(
                DB::raw("CASE 
                    WHEN (strftime('%Y', 'now') - strftime('%Y', birthdate)) < 5 THEN '0-4'
                    WHEN (strftime('%Y', 'now') - strftime('%Y', birthdate)) BETWEEN 5 AND 12 THEN '5-12'
                    WHEN (strftime('%Y', 'now') - strftime('%Y', birthdate)) BETWEEN 13 AND 17 THEN '13-17'
                    WHEN (strftime('%Y', 'now') - strftime('%Y', birthdate)) BETWEEN 18 AND 35 THEN '18-35'
                    WHEN (strftime('%Y', 'now') - strftime('%Y', birthdate)) BETWEEN 36 AND 59 THEN '36-59'
                    ELSE '60+' 
                END as age_group"),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('age_group')
            ->get()
            ->sortBy(function($item) {
                $order = ['0-4' => 1, '5-12' => 2, '13-17' => 3, '18-35' => 4, '36-59' => 5, '60+' => 6];
                return $order[$item->age_group] ?? 99;
            })
            ->values();
        
        // Gender distribution
        $genderDistribution = Patient::select('sex', DB::raw('COUNT(*) as count'))
            ->groupBy('sex')
            ->get();
        
        // Immunization coverage
        $immunizationCoverage = Immunization::select('vaccine_name', DB::raw('COUNT(*) as count'))
            ->groupBy('vaccine_name')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();
        
        // High risk breeding trend (last 6 months)
        $highRiskBreedingTrend = BreedingRecord::select(
                DB::raw("strftime('%Y-%m', checkup_date) as month"),
                DB::raw('COUNT(*) as count')
            )
            ->where('checkup_date', '>=', Carbon::now()->subMonths(6))
            ->where(function($query) {
                $query->whereNotNull('risk_factors')
                      ->orWhere('referred', true);
            })
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function($item) {
                $item->month = Carbon::parse($item->month)->format('M Y');
                return $item;
            });
        
        // Top complaints
        $topComplaints = Visit::select('chief_complaint', DB::raw('COUNT(*) as count'))
            ->whereNotNull('chief_complaint')
            ->groupBy('chief_complaint')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();
        
        // Patient Visit Activity Analytics
        // Patients with recent visits (last 30 days)
        $patientsWithRecentVisits = Visit::where('visit_date', '>=', Carbon::now()->subDays(30))
            ->distinct('patient_id')
            ->count('patient_id');
        
        // Inactive patients (no visit in last 90 days) - only count those who had at least one visit before
        $inactivePatients = Patient::whereHas('visits', function($query) {
                $query->where('visit_date', '<', Carbon::now()->subDays(90));
            })
            ->whereDoesntHave('visits', function($query) {
                $query->where('visit_date', '>=', Carbon::now()->subDays(90));
            })
            ->count();
        
        // Never visited patients
        $neverVisitedPatients = Patient::whereDoesntHave('visits')->count();
        
        // Predicted patient retention rate
        $totalActivePatients = $totalPatients - $neverVisitedPatients;
        $retentionRate = $totalActivePatients > 0 
            ? round((($totalActivePatients - $inactivePatients) / $totalActivePatients) * 100, 1)
            : 0;
        
        // Predict patients at risk of becoming inactive (visited 60-90 days ago but not recently)
        $atRiskPatients = Patient::whereHas('visits', function($query) {
                $query->whereBetween('visit_date', [Carbon::now()->subDays(90), Carbon::now()->subDays(60)]);
            })
            ->whereDoesntHave('visits', function($query) {
                $query->where('visit_date', '>=', Carbon::now()->subDays(60));
            })
            ->count();
        
        // Patient activity metrics
        $patientActivityMetrics = [
            'patients_with_recent_visits' => $patientsWithRecentVisits,
            'inactive_patients' => $inactivePatients,
            'never_visited' => $neverVisitedPatients,
            'at_risk_patients' => $atRiskPatients,
            'retention_rate' => $retentionRate,
            'total_active' => $totalActivePatients,
        ];
        
        return view('analytics', compact(
            'metrics',
            'patientGrowth',
            'visitTrends',
            'serviceDistribution',
            'ageDemographics',
            'genderDistribution',
            'immunizationCoverage',
            'highRiskBreedingTrend',
            'topComplaints',
            'patientActivityMetrics'
        ));
    }
}
