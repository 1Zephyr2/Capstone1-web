<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Immunization;
use App\Models\PrenatalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Patient Growth Trends (last 6 months)
        $patientGrowth = Patient::selectRaw("strftime('%Y-%m', created_at) as month, COUNT(*) as count")
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Service Type Distribution
        $serviceDistribution = Visit::selectRaw('service_type, COUNT(*) as count')
            ->groupBy('service_type')
            ->get();

        // Age Demographics
        $ageDemographics = Patient::selectRaw("
            CASE 
                WHEN CAST((julianday('now') - julianday(birthdate)) / 365.25 AS INTEGER) BETWEEN 0 AND 5 THEN '0-5 years'
                WHEN CAST((julianday('now') - julianday(birthdate)) / 365.25 AS INTEGER) BETWEEN 6 AND 12 THEN '6-12 years'
                WHEN CAST((julianday('now') - julianday(birthdate)) / 365.25 AS INTEGER) BETWEEN 13 AND 18 THEN '13-18 years'
                WHEN CAST((julianday('now') - julianday(birthdate)) / 365.25 AS INTEGER) BETWEEN 19 AND 35 THEN '19-35 years'
                WHEN CAST((julianday('now') - julianday(birthdate)) / 365.25 AS INTEGER) BETWEEN 36 AND 60 THEN '36-60 years'
                ELSE '60+ years'
            END as age_group,
            COUNT(*) as count
        ")
            ->groupBy('age_group')
            ->get();

        // Gender Distribution
        $genderDistribution = Patient::selectRaw('sex, COUNT(*) as count')
            ->groupBy('sex')
            ->get();

        // Visit Trends (last 30 days)
        $visitTrends = Visit::selectRaw("date(created_at) as date, COUNT(*) as count")
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Immunization Coverage by Vaccine
        $immunizationCoverage = Immunization::selectRaw('vaccine_name, COUNT(*) as count')
            ->groupBy('vaccine_name')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        // Monthly Comparison (current vs previous month)
        $currentMonthVisits = Visit::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        $previousMonthVisits = Visit::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $visitGrowthRate = $previousMonthVisits > 0 
            ? round((($currentMonthVisits - $previousMonthVisits) / $previousMonthVisits) * 100, 1)
            : 100;

        // High-Risk Prenatal Trend
        $highRiskPrenatalTrend = PrenatalRecord::selectRaw("strftime('%Y-%m', created_at) as month, COUNT(*) as count")
            ->where(function($query) {
                $query->where('blood_pressure', 'like', '%140%')
                      ->orWhere('blood_pressure', 'like', '%150%')
                      ->orWhere('blood_pressure', 'like', '%160%');
            })
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Predictive Insights
        $avgMonthlyVisits = Visit::where('created_at', '>=', now()->subMonths(3))
            ->count() / 3;
        $predictedNextMonthVisits = round($avgMonthlyVisits * (1 + ($visitGrowthRate / 100)));

        // Immunization Completion Rate
        $totalImmunizations = Immunization::count();
        $completedImmunizations = Immunization::whereNull('next_dose_date')
            ->orWhere('next_dose_date', '<', now()->subMonths(6))
            ->count();
        $completionRate = $totalImmunizations > 0 
            ? round(($completedImmunizations / $totalImmunizations) * 100, 1)
            : 0;

        // Top Chief Complaints
        $topComplaints = Visit::selectRaw('chief_complaint, COUNT(*) as count')
            ->whereNotNull('chief_complaint')
            ->where('chief_complaint', '!=', '')
            ->groupBy('chief_complaint')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        // Key Metrics Summary
        $metrics = [
            'total_patients' => Patient::count(),
            'total_visits' => Visit::count(),
            'current_month_visits' => $currentMonthVisits,
            'previous_month_visits' => $previousMonthVisits,
            'visit_growth_rate' => $visitGrowthRate,
            'total_immunizations' => $totalImmunizations,
            'completion_rate' => $completionRate,
            'high_risk_prenatal' => PrenatalRecord::where(function($query) {
                $query->where('blood_pressure', 'like', '%140%')
                      ->orWhere('blood_pressure', 'like', '%150%')
                      ->orWhere('blood_pressure', 'like', '%160%');
            })->count(),
            'predicted_next_month' => $predictedNextMonthVisits,
            'avg_monthly_visits' => round($avgMonthlyVisits),
        ];

        return view('analytics', compact(
            'patientGrowth',
            'serviceDistribution',
            'ageDemographics',
            'genderDistribution',
            'visitTrends',
            'immunizationCoverage',
            'metrics',
            'highRiskPrenatalTrend',
            'topComplaints'
        ));
    }
}
