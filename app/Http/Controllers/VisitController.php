<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\VisitPhoto;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VisitController extends Controller
{
    /**
     * Display visit history (all visits)
     */
    public function index()
    {
        $query = Visit::with(['patient']);

        // Search by patient name or ID
        if (request('search')) {
            $search = request('search');
            $query->whereHas('patient', function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('patient_id', 'like', "%{$search}%");
            });
        }

        // Filter by service type
        if (request('service_type') && request('service_type') !== 'all') {
            $query->where('service_type', request('service_type'));
        }

        // Filter by date range
        if (request('from_date')) {
            $query->whereDate('visit_date', '>=', request('from_date'));
        }
        if (request('to_date')) {
            $query->whereDate('visit_date', '<=', request('to_date'));
        }

        $visits = $query->orderBy('visit_date', 'desc')
            ->orderBy('visit_time', 'desc')
            ->paginate(20);

        return view('visits.index', [
            'visits' => $visits,
            'search' => request('search'),
            'service_type' => request('service_type'),
            'from_date' => request('from_date'),
            'to_date' => request('to_date'),
        ]);
    }

    /**
     * Show form for creating a new visit
     */
    public function create(Request $request)
    {
        $patientId = $request->get('patient_id');
        $patient = $patientId ? Patient::findOrFail($patientId) : null;

        return view('visits.create', compact('patient'));
    }

    /**
     * Store a new visit with vital signs
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'service_type' => 'required|in:Bath & Dry,Full Grooming,Haircut & Styling,Nail Trimming,Ear Cleaning,Teeth Brushing,De-shedding Treatment,Flea & Tick Treatment,Paw Treatment,Boarding Checkup,Follow-up,Other',
            'health_worker' => 'nullable|string|max:255',
            'coat_condition' => 'nullable|string',
            'behavior' => 'nullable|string',
            'grooming_notes' => 'nullable|string',
            'flea_tick_product' => 'nullable|string',
            'flea_tick_area' => 'nullable|string',
            'nail_condition_before' => 'nullable|string',
            'nail_condition_after' => 'nullable|string',
            'dental_notes' => 'nullable|string',
            'shedding_amount' => 'nullable|string',
            'hair_removed' => 'nullable|string',
            'boarding_observations' => 'nullable|string',
            'visit_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        DB::beginTransaction();
        try {
            // Prepare visit data
            $visitData = $request->only([
                'patient_id',
                'service_type',
                'health_worker',
                'coat_condition',
                'behavior',
                'grooming_notes',
                'flea_tick_product',
                'flea_tick_area',
                'nail_condition_before',
                'nail_condition_after',
                'dental_notes',
                'shedding_amount',
                'hair_removed',
                'boarding_observations',
            ]);
            
            // Create visit
            $visit = Visit::create($visitData);

            // Handle photo uploads
            if ($request->hasFile('visit_photos')) {
                foreach ($request->file('visit_photos') as $photo) {
                    $path = $photo->store('visits', 'public');
                    VisitPhoto::create([
                        'visit_id' => $visit->id,
                        'photo_path' => $path,
                        'original_name' => $photo->getClientOriginalName(),
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('dashboard')
                ->with('success', 'Visit recorded successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to record visit: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Get visit details via AJAX for modal display
     */
    public function getDetails(Visit $visit)
    {
        $visit->load('patient', 'photos');
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $visit->id,
                'service_type' => $visit->service_type,
                'visit_date' => $visit->visit_date->format('M d, Y'),
                'visit_time' => $visit->visit_time ?? 'N/A',
                'pet_name' => $visit->patient->pet_name,
                'owner_name' => $visit->patient->owner_name,
                'health_worker' => $visit->health_worker,
                'coat_condition' => $visit->coat_condition,
                'behavior' => $visit->behavior,
                'grooming_notes' => $visit->grooming_notes,
                'flea_tick_product' => $visit->flea_tick_product,
                'flea_tick_area' => $visit->flea_tick_area,
                'nail_condition_before' => $visit->nail_condition_before,
                'nail_condition_after' => $visit->nail_condition_after,
                'dental_notes' => $visit->dental_notes,
                'shedding_amount' => $visit->shedding_amount,
                'hair_removed' => $visit->hair_removed,
                'boarding_observations' => $visit->boarding_observations,
                'photos' => $visit->photos->map(function($photo) {
                    return [
                        'url' => Storage::url($photo->photo_path),
                        'name' => $photo->original_name,
                    ];
                }),
            ]
        ]);
    }

    /**
     * Display the specified visit
     */
    public function show(Visit $visit)
    {
        $visit->load(['patient']);
        return view('visits.show', compact('visit'));
    }

    /**
     * Show the form for editing the visit
     */
    public function edit(Visit $visit)
    {
        return view('visits.edit', compact('visit'));
    }

    /**
     * Update the specified visit
     */
    public function update(Request $request, Visit $visit)
    {
        $request->validate([
            'service_type' => 'required|in:Bath & Dry,Full Grooming,Haircut & Styling,Nail Trimming,Ear Cleaning,Teeth Brushing,De-shedding Treatment,Flea & Tick Treatment,Paw Treatment,Boarding Checkup,Follow-up,Other',
            'chief_complaint' => 'nullable|string',
            'notes' => 'nullable|string',
            'health_worker' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $visit->update($request->only([
                'service_type',
                'chief_complaint',
                'notes',
                'health_worker',
            ]));

            DB::commit();

            return redirect()
                ->route('visits.show', $visit)
                ->with('success', 'Visit updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update visit'])->withInput();
        }
    }

    /**
     * Remove the specified visit
     */
    public function destroy(Visit $visit)
    {
        $patientId = $visit->patient_id;
        $visit->delete();

        return redirect()
            ->route('pets.show', $patientId)
            ->with('success', 'Visit deleted successfully.');
    }

    /**
     * Display calendar view
     */
    public function calendar()
    {
        return view('visits.calendar');
    }

    /**
     * Get visits for a specific date (AJAX endpoint)
     */
    public function getVisitsByDate(Request $request)
    {
        $date = $request->get('date');
        
        $visits = Visit::with(['patient'])
            ->whereDate('visit_date', $date)
            ->orderBy('visit_time', 'asc')
            ->get();

        return response()->json([
            'visits' => $visits->map(function($visit) {
                return [
                    'id' => $visit->id,
                    'patient_name' => $visit->patient->name,
                    'service_type' => $visit->service_type,
                    'visit_time' => \Carbon\Carbon::parse($visit->visit_time)->format('h:i A'),
                    'chief_complaint' => $visit->chief_complaint,
                    'status' => $visit->visit_date == now()->toDateString() && 
                               \Carbon\Carbon::parse($visit->visit_time)->isPast() ? 'CONFIRMED' : 'PENDING'
                ];
            })
        ]);
    }
}

