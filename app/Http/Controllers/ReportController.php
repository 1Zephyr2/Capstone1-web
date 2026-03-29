<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Appointment;
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
            'total_pets' => Patient::count(),
            'new_pets' => Patient::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count(),
            'total_visits' => Visit::whereYear('visit_date', $date->year)
                ->whereMonth('visit_date', $date->month)
                ->count(),
            'total_appointments' => Appointment::whereYear('appointment_date', $date->year)
                ->whereMonth('appointment_date', $date->month)
                ->count(),
        ];

        // Service breakdown
        $serviceBreakdown = Visit::whereYear('visit_date', $date->year)
            ->whereMonth('visit_date', $date->month)
            ->select('service_type', DB::raw('count(*) as count'))
            ->groupBy('service_type')
            ->get();

        return view('reports.index', compact('stats', 'serviceBreakdown', 'month'));
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
        ];

        // Return as JSON or view for PDF generation
        if ($request->get('format') == 'json') {
            return response()->json($report);
        }

        return view('reports.monthly', compact('report'));
    }

    /**
     * Helper: Get monthly statistics
     */
    private function getMonthlyStats($date)
    {
        return [
            'new_pets' => Patient::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count(),
            'total_visits' => Visit::whereYear('visit_date', $date->year)
                ->whereMonth('visit_date', $date->month)
                ->count(),
            'total_appointments' => Appointment::whereYear('appointment_date', $date->year)
                ->whereMonth('appointment_date', $date->month)
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
}
