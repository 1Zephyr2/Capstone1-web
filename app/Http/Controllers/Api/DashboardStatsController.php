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
                    'visit_date' => optional($visit->visit_date)->toDateString() ?? today()->toDateString(),
                    'visit_time' => (string) $visit->visit_time,
                    'service_type' => $visit->service_type,
                    'chief_complaint' => $visit->chief_complaint,
                    'health_worker' => $visit->health_worker,
                    'source' => 'visit',
                ];
            });

        // Include completed appointments so the Visits page reflects completed workflow items
        // even when a detailed Visit record has not been created yet.
        $completedAppointments = Appointment::whereDate('appointment_date', today())
            ->where('status', 'completed')
            ->with('patient')
            ->orderBy('appointment_time', 'desc')
            ->get()
            ->map(function($appointment) {
                return [
                    'id' => 'apt-' . $appointment->id,
                    'patient_id' => $appointment->patient_id,
                    'pet_name' => $appointment->patient->pet_name ?? $appointment->patient->full_name,
                    'owner_name' => $appointment->patient->owner_name ?? 'Unknown Owner',
                    'visit_date' => optional($appointment->appointment_date)->toDateString() ?? today()->toDateString(),
                    'visit_time' => (string) $appointment->appointment_time,
                    'service_type' => $appointment->service_type,
                    'chief_complaint' => $appointment->chief_complaint,
                    'health_worker' => $appointment->health_worker,
                    'source' => 'appointment',
                ];
            });

        // Prevent duplicate rows when both a visit record and a completed appointment exist.
        $visitKeys = $visits->map(function ($item) {
            return implode('|', [
                $item['patient_id'],
                $item['visit_date'],
                strtolower(trim((string) $item['service_type'])),
                substr((string) $item['visit_time'], 0, 5),
            ]);
        })->values();

        $completedAppointments = $completedAppointments->filter(function ($item) use ($visitKeys) {
            $appointmentKey = implode('|', [
                $item['patient_id'],
                $item['visit_date'],
                strtolower(trim((string) $item['service_type'])),
                substr((string) $item['visit_time'], 0, 5),
            ]);

            return !$visitKeys->contains($appointmentKey);
        })->values();

        $combined = $visits
            ->concat($completedAppointments)
            ->sortByDesc(function ($item) {
                $dateTime = trim(($item['visit_date'] ?? today()->toDateString()) . ' ' . ($item['visit_time'] ?? '00:00:00'));

                return Carbon::parse($dateTime)->timestamp;
            })
            ->values();

        return response()->json([
            'visits' => $combined,
            'count' => $combined->count(),
        ]);
    }
}

