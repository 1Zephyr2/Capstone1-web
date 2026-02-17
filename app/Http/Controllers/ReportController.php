<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Immunization;
use App\Models\BreedingRecord;
use App\Models\Referral;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display monthly reports dashboard
     */
    public function index(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $date = Carbon::parse($month . '-01');

        $stats = [
            'total_patients' => Patient::count(),
            'new_patients' => Patient::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count(),
            'total_visits' => Visit::whereYear('visit_date', $date->year)
                ->whereMonth('visit_date', $date->month)
                ->count(),
            'immunizations' => Immunization::whereYear('date_given', $date->year)
                ->whereMonth('date_given', $date->month)
                ->count(),
            'breeding_checkups' => BreedingRecord::whereYear('checkup_date', $date->year)
                ->whereMonth('checkup_date', $date->month)
                ->count(),
            'referrals' => Referral::whereYear('referral_date', $date->year)
                ->whereMonth('referral_date', $date->month)
                ->count(),
        ];

        // Service breakdown
        $serviceBreakdown = Visit::whereYear('visit_date', $date->year)
            ->whereMonth('visit_date', $date->month)
            ->select('service_type', DB::raw('count(*) as count'))
            ->groupBy('service_type')
            ->get();

        // Top vaccines given
        $vaccineBreakdown = Immunization::whereYear('date_given', $date->year)
            ->whereMonth('date_given', $date->month)
            ->select('vaccine_name', DB::raw('count(*) as count'))
            ->groupBy('vaccine_name')
            ->orderBy('count', 'desc')
            ->get();

        return view('reports.index', compact('stats', 'serviceBreakdown', 'vaccineBreakdown', 'month'));
    }

    /**
     * Generate monthly report (exportable)
     */
    public function generate(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $date = Carbon::parse($month . '-01');

        $report = [
            'period' => $date->format('F Y'),
            'generated_at' => now()->format('F d, Y h:i A'),
            'stats' => $this->getMonthlyStats($date),
            'services' => $this->getServiceBreakdown($date),
            'vaccines' => $this->getVaccineBreakdown($date),
        ];

        // Return as JSON or view for PDF generation
        if ($request->get('format') == 'json') {
            return response()->json($report);
        }

        return view('reports.monthly', compact('report'));
    }

    /**
     * Get overdue immunizations report
     */
    public function overdueImmunizations()
    {
        $overdueImmunizations = Immunization::with('patient')
            ->overdue()
            ->orderBy('next_dose_due', 'asc')
            ->get()
            ->groupBy('patient_id');

        return view('reports.overdue-immunizations', compact('overdueImmunizations'));
    }

    /**
     * Get high-risk breeding cases
     */
    public function highRiskBreeding()
    {
        $highRiskCases = BreedingRecord::with('patient')
            ->where(function($q) {
                $q->whereNotNull('risk_factors')
                  ->orWhere('referred', true);
            })
            ->orderBy('checkup_date', 'desc')
            ->get();

        return view('reports.high-risk-breeding', compact('highRiskCases'));
    }

    /**
     * Helper: Get monthly statistics
     */
    private function getMonthlyStats($date)
    {
        return [
            'new_patients' => Patient::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count(),
            'total_visits' => Visit::whereYear('visit_date', $date->year)
                ->whereMonth('visit_date', $date->month)
                ->count(),
            'immunizations' => Immunization::whereYear('date_given', $date->year)
                ->whereMonth('date_given', $date->month)
                ->count(),
            'breeding_checkups' => BreedingRecord::whereYear('checkup_date', $date->year)
                ->whereMonth('checkup_date', $date->month)
                ->count(),
            'referrals' => Referral::whereYear('referral_date', $date->year)
                ->whereMonth('referral_date', $date->month)
                ->count(),
        ];
    }

    /**
     * Helper: Get service breakdown
     */
    private function getServiceBreakdown($date)
    {
        return Visit::whereYear('visit_date', $date->year)
            ->whereMonth('visit_date', $date->month)
            ->select('service_type', DB::raw('count(*) as count'))
            ->groupBy('service_type')
            ->get()
            ->pluck('count', 'service_type')
            ->toArray();
    }

    /**
     * Helper: Get vaccine breakdown
     */
    private function getVaccineBreakdown($date)
    {
        return Immunization::whereYear('date_given', $date->year)
            ->whereMonth('date_given', $date->month)
            ->select('vaccine_name', DB::raw('count(*) as count'))
            ->groupBy('vaccine_name')
            ->get()
            ->pluck('count', 'vaccine_name')
            ->toArray();
    }
}
