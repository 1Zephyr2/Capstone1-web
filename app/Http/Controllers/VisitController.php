<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Patient;
use App\Models\VitalSign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
    /**
     * Display today's visits
     */
    public function index()
    {
        $visits = Visit::with(['patient', 'vitalSigns'])
            ->today()
            ->orderBy('visit_time', 'desc')
            ->get();

        return view('visits.index', compact('visits'));
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
            'service_type' => 'required|in:General Checkup,Immunization,Prenatal,Family Planning,Referral,Health Education,Other',
            'chief_complaint' => 'nullable|string',
            'notes' => 'nullable|string',
            'health_worker' => 'nullable|string|max:255',
            // Vital signs
            'blood_pressure' => 'nullable|string|max:20',
            'temperature' => 'nullable|numeric|min:30|max:45',
            'pulse_rate' => 'nullable|numeric|min:30|max:200',
            'weight' => 'nullable|numeric|min:0|max:500',
            'height' => 'nullable|numeric|min:0|max:300',
        ]);

        DB::beginTransaction();
        try {
            // Create visit (dates auto-filled by model)
            $visit = Visit::create($request->only([
                'patient_id',
                'service_type',
                'chief_complaint',
                'notes',
                'health_worker',
            ]));

            // Create vital signs if any provided
            if ($request->filled(['blood_pressure', 'temperature', 'pulse_rate', 'weight', 'height'])) {
                VitalSign::create([
                    'visit_id' => $visit->id,
                    'blood_pressure' => $request->blood_pressure,
                    'temperature' => $request->temperature,
                    'pulse_rate' => $request->pulse_rate,
                    'weight' => $request->weight,
                    'height' => $request->height,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('patients.show', $visit->patient_id)
                ->with('success', 'Visit recorded successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to record visit: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified visit
     */
    public function show(Visit $visit)
    {
        $visit->load(['patient', 'vitalSigns']);
        return view('visits.show', compact('visit'));
    }

    /**
     * Show the form for editing the visit
     */
    public function edit(Visit $visit)
    {
        $visit->load('vitalSigns');
        return view('visits.edit', compact('visit'));
    }

    /**
     * Update the specified visit
     */
    public function update(Request $request, Visit $visit)
    {
        $request->validate([
            'service_type' => 'required|in:General Checkup,Immunization,Prenatal,Family Planning,Referral,Health Education,Other',
            'chief_complaint' => 'nullable|string',
            'notes' => 'nullable|string',
            'health_worker' => 'nullable|string|max:255',
            // Vital signs
            'blood_pressure' => 'nullable|string|max:20',
            'temperature' => 'nullable|numeric|min:30|max:45',
            'pulse_rate' => 'nullable|numeric|min:30|max:200',
            'weight' => 'nullable|numeric|min:0|max:500',
            'height' => 'nullable|numeric|min:0|max:300',
        ]);

        DB::beginTransaction();
        try {
            $visit->update($request->only([
                'service_type',
                'chief_complaint',
                'notes',
                'health_worker',
            ]));

            // Update or create vital signs
            if ($visit->vitalSigns) {
                $visit->vitalSigns->update($request->only([
                    'blood_pressure',
                    'temperature',
                    'pulse_rate',
                    'weight',
                    'height',
                ]));
            } else {
                VitalSign::create([
                    'visit_id' => $visit->id,
                    'blood_pressure' => $request->blood_pressure,
                    'temperature' => $request->temperature,
                    'pulse_rate' => $request->pulse_rate,
                    'weight' => $request->weight,
                    'height' => $request->height,
                ]);
            }

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
            ->route('patients.show', $patientId)
            ->with('success', 'Visit deleted successfully.');
    }
}

