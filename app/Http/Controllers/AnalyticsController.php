<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // ── Core pet counts ──────────────────────────────────────────────
        $totalPatients = Patient::count();

        // ── Visit metrics ────────────────────────────────────────────────
        $currentMonthVisits = Visit::whereMonth('visit_date', Carbon::now()->month)
            ->whereYear('visit_date', Carbon::now()->year)
            ->count();

        $lastMonthVisits = Visit::whereMonth('visit_date', Carbon::now()->subMonth()->month)
            ->whereYear('visit_date', Carbon::now()->subMonth()->year)
            ->count();

        $visitGrowthRate = $lastMonthVisits > 0
            ? round((($currentMonthVisits - $lastMonthVisits) / $lastMonthVisits) * 100, 1)
            : 0;

        $avgMonthlyVisits = round(
            Visit::where('visit_date', '>=', Carbon::now()->subMonths(3))->count() / 3
        );

        $predictedNextMonth = round($avgMonthlyVisits * (1 + ($visitGrowthRate / 100)));

        // ── Appointment metrics ────────────────────────────────────────────
        $appointmentsThisMonth = Appointment::whereMonth('appointment_date', Carbon::now()->month)
            ->whereYear('appointment_date', Carbon::now()->year)
            ->count();

        $appointmentsLastMonth = Appointment::whereMonth('appointment_date', Carbon::now()->subMonth()->month)
            ->whereYear('appointment_date', Carbon::now()->subMonth()->year)
            ->count();

        $appointmentGrowthRate = $appointmentsLastMonth > 0
            ? round((($appointmentsThisMonth - $appointmentsLastMonth) / $appointmentsLastMonth) * 100, 1)
            : 0;

        $upcomingAppointments = Appointment::where('appointment_date', '>=', Carbon::today())
            ->where('appointment_date', '<=', Carbon::today()->addDays(7))
            ->where('status', 'scheduled')
            ->count();

        $completedAppointments = Appointment::where('status', 'completed')->count();
        $cancelledAppointments = Appointment::where('status', 'cancelled')->count();
        $noShowAppointments    = Appointment::where('status', 'no-show')->count();
        $totalAppointments     = Appointment::count();

        $appointmentCompletionRate = $totalAppointments > 0
            ? round(($completedAppointments / $totalAppointments) * 100, 1)
            : 0;

        $metrics = [
            'total_patients'            => $totalPatients,
            'current_month_visits'      => $currentMonthVisits,
            'visit_growth_rate'         => $visitGrowthRate,
            'predicted_next_month'      => $predictedNextMonth,
            'avg_monthly_visits'        => $avgMonthlyVisits,
            'appointments_this_month'   => $appointmentsThisMonth,
            'appointment_growth_rate'   => $appointmentGrowthRate,
            'upcoming_appointments'     => $upcomingAppointments,
            'appointment_completion'    => $appointmentCompletionRate,
            'total_appointments'        => $totalAppointments,
            'completed_appointments'    => $completedAppointments,
            'cancelled_appointments'    => $cancelledAppointments,
            'no_show_appointments'      => $noShowAppointments,
        ];

        // ── Pet registration trend (6 months) ────────────────────────────
        $patientGrowth = Patient::select(
                DB::raw("strftime('%Y-%m', created_at) as month"),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->map(fn($i) => tap($i, fn($i) => $i->month = Carbon::parse($i->month)->format('M Y')));

        // ── Visit trends (30 days) ─────────────────────────────────────────
        $visitTrends = Visit::select(
                DB::raw("DATE(visit_date) as date"),
                DB::raw('COUNT(*) as count')
            )
            ->where('visit_date', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(fn($i) => tap($i, fn($i) => $i->date = Carbon::parse($i->date)->format('M d')));

        // ── Appointment trend (6 months) ─────────────────────────────────
        $appointmentTrend = Appointment::select(
                DB::raw("strftime('%Y-%m', appointment_date) as month"),
                DB::raw('COUNT(*) as count')
            )
            ->where('appointment_date', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->map(fn($i) => tap($i, fn($i) => $i->month = Carbon::parse($i->month)->format('M Y')));

        // ── Appointment service type distribution ─────────────────────────
        $appointmentServiceDistribution = Appointment::select(
                'service_type', DB::raw('COUNT(*) as count')
            )
            ->whereNotNull('service_type')
            ->groupBy('service_type')
            ->orderBy('count', 'desc')
            ->get();

        // ── Appointment status breakdown ──────────────────────────────────
        $appointmentStatusBreakdown = Appointment::select(
                'status', DB::raw('COUNT(*) as count')
            )
            ->groupBy('status')
            ->get();

        // ── Species distribution ──────────────────────────────────────────
        $speciesDistribution = Patient::select(
                DB::raw("COALESCE(NULLIF(species,''), 'Unknown') as species"),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('species')
            ->orderBy('count', 'desc')
            ->get();

        // ── Pet age groups (vet-appropriate) ─────────────────────────────
        $ageDemographics = Patient::select(
                DB::raw("CASE
                    WHEN (strftime('%Y', 'now') - strftime('%Y', birthdate)) < 1  THEN 'Under 1 yr'
                    WHEN (strftime('%Y', 'now') - strftime('%Y', birthdate)) BETWEEN 1 AND 2  THEN '1-2 yrs'
                    WHEN (strftime('%Y', 'now') - strftime('%Y', birthdate)) BETWEEN 3 AND 5  THEN '3-5 yrs'
                    WHEN (strftime('%Y', 'now') - strftime('%Y', birthdate)) BETWEEN 6 AND 9  THEN '6-9 yrs'
                    WHEN (strftime('%Y', 'now') - strftime('%Y', birthdate)) BETWEEN 10 AND 12 THEN '10-12 yrs'
                    ELSE '13+ yrs'
                END as age_group"),
                DB::raw('COUNT(*) as count')
            )
            ->whereNotNull('birthdate')
            ->groupBy('age_group')
            ->get()
            ->sortBy(function ($item) {
                $order = ['Under 1 yr' => 1, '1-2 yrs' => 2, '3-5 yrs' => 3,
                          '6-9 yrs' => 4, '10-12 yrs' => 5, '13+ yrs' => 6];
                return $order[$item->age_group] ?? 99;
            })
            ->values();

        // ── Sex distribution ─────────────────────────────────────────────
        $genderDistribution = Patient::select('sex', DB::raw('COUNT(*) as count'))
            ->whereNotNull('sex')
            ->groupBy('sex')
            ->get();

        // ── Top complaints ────────────────────────────────────────────────
        $topComplaints = Visit::select('chief_complaint', DB::raw('COUNT(*) as count'))
            ->whereNotNull('chief_complaint')
            ->where('chief_complaint', '!=', '')
            ->groupBy('chief_complaint')
            ->orderBy('count', 'desc')
            ->limit(8)
            ->get();

        // ── Pet activity / retention ──────────────────────────────────────
        $patientsWithRecentVisits = Visit::where('visit_date', '>=', Carbon::now()->subDays(30))
            ->distinct('patient_id')
            ->count('patient_id');

        $inactivePatients = Patient::whereHas('visits', function ($q) {
                $q->where('visit_date', '<', Carbon::now()->subDays(90));
            })
            ->whereDoesntHave('visits', function ($q) {
                $q->where('visit_date', '>=', Carbon::now()->subDays(90));
            })
            ->count();

        $neverVisitedPatients = Patient::whereDoesntHave('visits')->count();
        $totalActivePatients  = $totalPatients - $neverVisitedPatients;
        $retentionRate = $totalActivePatients > 0
            ? round((($totalActivePatients - $inactivePatients) / $totalActivePatients) * 100, 1)
            : 0;

        $atRiskPatients = Patient::whereHas('visits', function ($q) {
                $q->whereBetween('visit_date', [Carbon::now()->subDays(90), Carbon::now()->subDays(60)]);
            })
            ->whereDoesntHave('visits', function ($q) {
                $q->where('visit_date', '>=', Carbon::now()->subDays(60));
            })
            ->count();

        $patientActivityMetrics = [
            'patients_with_recent_visits' => $patientsWithRecentVisits,
            'inactive_patients'           => $inactivePatients,
            'never_visited'               => $neverVisitedPatients,
            'at_risk_patients'            => $atRiskPatients,
            'retention_rate'              => $retentionRate,
            'total_active'               => $totalActivePatients,
        ];

        // ── Keep legacy alias for view ────────────────────────────────────
        $serviceDistribution = $appointmentServiceDistribution;

        return view('analytics', compact(
            'metrics',
            'patientGrowth',
            'visitTrends',
            'appointmentTrend',
            'serviceDistribution',
            'appointmentServiceDistribution',
            'appointmentStatusBreakdown',
            'speciesDistribution',
            'ageDemographics',
            'genderDistribution',
            'topComplaints',
            'patientActivityMetrics'
        ));
    }
}
