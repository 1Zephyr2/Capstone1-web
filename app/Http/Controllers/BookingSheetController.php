<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingSheetController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->get('date', today()->format('Y-m-d'));
        $selectedDate = Carbon::parse($date);

        $timeSlots = [
            '09:00:00' => '9:00 AM',
            '10:00:00' => '10:00 AM',
            '11:00:00' => '11:00 AM',
            '13:00:00' => '1:00 PM',
            '14:00:00' => '2:00 PM',
            '15:00:00' => '3:00 PM',
            '16:00:00' => '4:00 PM',
            '17:00:00' => '5:00 PM',
        ];

        $appointments = Appointment::with('patient')
            ->whereDate('appointment_date', $selectedDate)
            ->whereNotIn('status', ['cancelled'])
            ->orderBy('appointment_time')
            ->get()
            ->keyBy(function($a) {
                return Carbon::parse($a->appointment_time)->format('H:i:s');
            });

        $services = Service::where('is_active', true)->orderBy('sort_order')->get();

        return view('appointments.booking-sheet', compact(
            'appointments', 'timeSlots', 'selectedDate', 'services'
        ));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'service_type'   => 'nullable|string|max:255',
            'notes'          => 'nullable|string',
            'status'         => 'nullable|in:scheduled,confirmed,completed,cancelled,no-show',
        ]);

        $appointment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Updated successfully.',
        ]);
    }
}