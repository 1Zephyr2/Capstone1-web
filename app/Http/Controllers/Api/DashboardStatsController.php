<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Visit;
use Carbon\Carbon;

class DashboardStatsController extends Controller
{
    /**
     * Get updated dashboard stats for today
     */
    public function todayStats()
    {
        // Today's visits (distinct patients who had visits today)
        $todayVisits = Visit::whereDate('visit_date', today())
            ->distinct('patient_id')
            ->count('patient_id');

        // Today's scheduled appointments
        $todayAppointments = Appointment::whereDate('appointment_date', today())
            ->where('status', '!=', 'completed')
            ->count();

        // Today's completed appointments
        $todayCompleted = Appointment::whereDate('appointment_date', today())
            ->where('status', 'completed')
            ->count();

        // Today's cancelled appointments
        $todayCancelled = Appointment::whereDate('appointment_date', today())
            ->where('status', 'cancelled')
            ->count();

        return response()->json([
            'today_visits' => $todayVisits,
            'today_appointments' => $todayAppointments,
            'today_completed' => $todayCompleted,
            'today_cancelled' => $todayCancelled,
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    /**
     * Get today's visits with all details
     */
    public function getTodaysVisits()
    {
        $visits = Visit::whereDate('visit_date', today())
            ->with('patient')
            ->orderBy('visit_time', 'desc')
            ->get()
            ->map(function($visit) {
                return [
                    'id' => $visit->id,
                    'patient_id' => $visit->patient_id,
                    'pet_name' => $visit->patient->pet_name ?? $visit->patient->full_name,
                    'owner_name' => $visit->patient->owner_name ?? 'Unknown Owner',
                    'visit_date' => $visit->visit_date,
                    'visit_time' => $visit->visit_time,
                    'service_type' => $visit->service_type,
                    'chief_complaint' => $visit->chief_complaint,
                    'health_worker' => $visit->health_worker,
                ];
            });

        return response()->json([
            'visits' => $visits,
            'count' => $visits->count(),
        ]);
    }
}

