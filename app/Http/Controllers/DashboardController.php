<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Appointment;
use App\Models\AppointmentRequest;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        
        // Month comparison
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
        
        // Get incomplete patient records (missing owner name or contact)
        $incompleteRecords = Patient::where(function ($query) {
            $query->whereNull('owner_contact')
                  ->orWhere('owner_contact', '')
                  ->orWhereNull('owner_name')
                  ->orWhere('owner_name', '');
        })->count();

        // Get pending appointment requests
        $pendingAppointmentRequests = AppointmentRequest::where('status', 'pending')->count();

        // Today's appointments
        $todayAppointments = Appointment::whereDate('appointment_date', now()->toDateString())
            ->where('status', 'scheduled')
            ->count();

        // No-shows in the last 7 days
        $noShowAppointments = Appointment::where('status', 'no-show')
            ->whereDate('appointment_date', '>=', now()->subDays(7)->toDateString())
            ->count();

        // Total alerts count
        $totalAlerts = $incompleteRecords + $todayAppointments + $noShowAppointments + $pendingAppointmentRequests;

        // Top alerts for dashboard (limit 4)
        $topAlerts = [];

        if ($pendingAppointmentRequests > 0) {
            $topAlerts[] = [
                'type'    => 'info',
                'icon'    => 'bi-inbox-fill',
                'title'   => 'Pending Requests',
                'count'   => $pendingAppointmentRequests,
                'message' => "$pendingAppointmentRequests appointment request(s) awaiting approval",
                'route'   => 'appointment-requests.index',
            ];
        }

        if ($todayAppointments > 0) {
            $topAlerts[] = [
                'type'    => 'warning',
                'icon'    => 'bi-calendar-check-fill',
                'title'   => "Today's Appointments",
                'count'   => $todayAppointments,
                'message' => "$todayAppointments appointment(s) scheduled for today",
            ];
        }

        if ($noShowAppointments > 0) {
            $topAlerts[] = [
                'type'    => 'danger',
                'icon'    => 'bi-person-x-fill',
                'title'   => 'No-Shows (7 Days)',
                'count'   => $noShowAppointments,
                'message' => "$noShowAppointments appointment(s) marked as no-show",
            ];
        }

        if ($incompleteRecords > 0) {
            $topAlerts[] = [
                'type'    => 'warning',
                'icon'    => 'bi-exclamation-triangle-fill',
                'title'   => 'Incomplete Pet Records',
                'count'   => $incompleteRecords,
                'message' => "$incompleteRecords pet record(s) missing owner info",
            ];
        }

        // Limit to top 4 alerts for dashboard
        $topAlerts = array_slice($topAlerts, 0, 4);
        
        // ── Automation panel data ─────────────────────────────────────────
        $automationIncomplete = Patient::where(function ($q) {
                $q->whereNull('owner_contact')->orWhere('owner_contact', '')
                  ->orWhereNull('owner_name')->orWhere('owner_name', '');
            })->limit(15)->get();

        $automationToday = Appointment::with('patient')
            ->whereDate('appointment_date', Carbon::today())
            ->orderBy('appointment_time', 'asc')
            ->get();

        $automationUpcoming = Appointment::with('patient')
            ->whereDate('appointment_date', '>', Carbon::today())
            ->whereDate('appointment_date', '<=', Carbon::today()->addDays(7))
            ->where('status', 'scheduled')
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->limit(10)->get();

        $automationMissed = Appointment::with('patient')
            ->where('status', 'no-show')
            ->whereDate('appointment_date', '>=', Carbon::today()->subDays(7))
            ->orderBy('appointment_date', 'desc')
            ->limit(10)->get();

        $automationStats = [
            'total_patients'     => $totalPatients,
            'today_appointments' => $automationToday->count(),
            'upcoming_week'      => $automationUpcoming->count(),
            'no_shows'           => Appointment::where('status', 'no-show')
                                        ->whereDate('appointment_date', '>=', Carbon::today()->subDays(7))->count(),
            'visits_this_week'   => $weeklyVisits,
        ];

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
        
        $species = Species::all();
        
        return view('dashboard', compact(
            'todayPatients',
            'totalPatients',
            'patientChangePercent',
            'monthChangePercent',
            'weeklyVisits',
            'totalAlerts',
            'topAlerts',
            'appointments',
            'automationIncomplete',
            'automationToday',
            'automationUpcoming',
            'automationMissed',
            'automationStats',
            'species'
        ));
    }
}
