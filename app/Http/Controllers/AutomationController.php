<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AutomationController extends Controller
{
    public function index()
    {
        // ── Incomplete pet records ────────────────────────────────────────
        // Flag pets missing owner contact or owner name (microchip removed)
        $incompleteRecords = Patient::where(function ($q) {
                $q->whereNull('owner_contact')
                  ->orWhere('owner_contact', '')
                  ->orWhereNull('owner_name')
                  ->orWhere('owner_name', '');
            })
            ->limit(15)
            ->get();

        // ── Today's appointments ──────────────────────────────────────────
        $todayAppointments = Appointment::with('patient')
            ->whereDate('appointment_date', Carbon::today())
            ->orderBy('appointment_time', 'asc')
            ->get();

        // ── Upcoming appointments (next 7 days, excluding today) ──────────
        $upcomingAppointments = Appointment::with('patient')
            ->whereDate('appointment_date', '>', Carbon::today())
            ->whereDate('appointment_date', '<=', Carbon::today()->addDays(7))
            ->where('status', 'scheduled')
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->limit(10)
            ->get();

        // ── Missed / no-show appointments (last 7 days) ───────────────────
        $missedAppointments = Appointment::with('patient')
            ->where('status', 'no-show')
            ->whereDate('appointment_date', '>=', Carbon::today()->subDays(7))
            ->orderBy('appointment_date', 'desc')
            ->limit(10)
            ->get();

        // ── Recent visits ─────────────────────────────────────────────────
        $recentVisits = Visit::with('patient')
            ->orderBy('visit_date', 'desc')
            ->limit(5)
            ->get();

        // ── Quick stats ───────────────────────────────────────────────────
        $stats = [
            'total_patients'        => Patient::count(),
            'visits_this_week'      => Visit::where('visit_date', '>=', Carbon::now()->startOfWeek())->count(),
            'today_appointments'    => $todayAppointments->count(),
            'upcoming_week'         => $upcomingAppointments->count(),
            'no_shows'              => Appointment::where('status', 'no-show')
                                          ->whereDate('appointment_date', '>=', Carbon::today()->subDays(7))
                                          ->count(),
        ];

        return view('automation-support', compact(
            'incompleteRecords',
            'todayAppointments',
            'upcomingAppointments',
            'missedAppointments',
            'recentVisits',
            'stats'
        ));
    }
}
