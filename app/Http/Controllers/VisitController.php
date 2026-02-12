<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Patient;
use App\Models\VitalSign;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
    /**
     * Display visit history (all visits)
     */
    public function index()
    {
        $query = Visit::with(['patient', 'vitalSigns']);

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
            'service_type' => 'required|in:General Checkup,Immunization,Prenatal,Family Planning,Referral,Health Education,Other',
            'chief_complaint' => 'nullable|string',
            'notes' => 'nullable|string',
            'health_worker' => 'nullable|string|max:255',
            'visit_date' => 'nullable|date',
            'visit_time_input' => 'nullable|date_format:H:i',
            // Vital signs
            'blood_pressure' => 'nullable|string|max:20',
            'temperature' => 'nullable|numeric|min:30|max:45',
            'pulse_rate' => 'nullable|numeric|min:30|max:200',
            'weight' => 'nullable|numeric|min:0|max:500',
            'height' => 'nullable|numeric|min:0|max:300',
            // Immunization fields
            'vaccine_name' => 'required_if:service_type,Immunization|nullable|string|max:255',
            'dose_number' => 'required_if:service_type,Immunization|nullable|string|max:50',
            'batch_number' => 'nullable|string|max:100',
            'next_dose_date' => 'nullable|date',
            // Prenatal fields
            'gestational_age' => 'required_if:service_type,Prenatal|nullable|integer|min:1|max:42',
            'fundal_height' => 'nullable|numeric|min:0',
            'fetal_heart_rate' => 'nullable|integer|min:0|max:200',
            'presentation' => 'nullable|in:Cephalic,Breech,Transverse',
            'prenatal_notes' => 'nullable|string',
            // Family Planning fields
            'fp_method' => 'required_if:service_type,Family Planning|nullable|string|max:255',
            'fp_quantity' => 'nullable|string|max:100',
            'fp_followup_date' => 'nullable|date',
            // Referral fields
            'referred_to' => 'required_if:service_type,Referral|nullable|string|max:255',
            'referral_reason' => 'required_if:service_type,Referral|nullable|string|max:255',
            'referral_urgency' => 'nullable|in:Routine,Urgent,Emergency',
        ]);

        DB::beginTransaction();
        try {
            // Prepare visit data
            $visitData = $request->only([
                'patient_id',
                'service_type',
                'chief_complaint',
                'health_worker',
            ]);
            
            // Build comprehensive notes from all sources
            $allNotes = [];
            if ($request->filled('notes')) {
                $allNotes[] = $request->notes;
            }
            
            // Add service-specific data to notes
            if ($request->service_type === 'Immunization') {
                $immunizationNotes = [
                    "Vaccine: {$request->vaccine_name}",
                    "Dose: {$request->dose_number}"
                ];
                if ($request->filled('batch_number')) {
                    $immunizationNotes[] = "Batch: {$request->batch_number}";
                }
                if ($request->filled('next_dose_date')) {
                    $immunizationNotes[] = "Next Dose: {$request->next_dose_date}";
                }
                $allNotes[] = "IMMUNIZATION:\n" . implode("\n", $immunizationNotes);
            }
            
            if ($request->service_type === 'Prenatal') {
                $prenatalNotes = [
                    "Gestational Age: {$request->gestational_age} weeks"
                ];
                if ($request->filled('fundal_height')) {
                    $prenatalNotes[] = "Fundal Height: {$request->fundal_height} cm";
                }
                if ($request->filled('fetal_heart_rate')) {
                    $prenatalNotes[] = "FHR: {$request->fetal_heart_rate} bpm";
                }
                if ($request->filled('presentation')) {
                    $prenatalNotes[] = "Presentation: {$request->presentation}";
                }
                if ($request->filled('prenatal_notes')) {
                    $prenatalNotes[] = "Notes: {$request->prenatal_notes}";
                }
                $allNotes[] = "PRENATAL:\n" . implode("\n", $prenatalNotes);
            }
            
            if ($request->service_type === 'Family Planning') {
                $fpNotes = [
                    "Method: {$request->fp_method}"
                ];
                if ($request->filled('fp_quantity')) {
                    $fpNotes[] = "Quantity: {$request->fp_quantity}";
                }
                if ($request->filled('fp_followup_date')) {
                    $fpNotes[] = "Follow-up: {$request->fp_followup_date}";
                }
                $allNotes[] = "FAMILY PLANNING:\n" . implode("\n", $fpNotes);
            }
            
            if ($request->service_type === 'Referral') {
                $referralNotes = [
                    "Referred To: {$request->referred_to}",
                    "Reason: {$request->referral_reason}"
                ];
                if ($request->filled('referral_urgency')) {
                    $referralNotes[] = "Urgency: {$request->referral_urgency}";
                }
                $allNotes[] = "REFERRAL:\n" . implode("\n", $referralNotes);
            }
            
            $visitData['notes'] = implode("\n\n", $allNotes);
            
            // Handle custom visit time if provided
            if ($request->filled('visit_date') && $request->filled('visit_time_input')) {
                $visitData['visit_time'] = $request->visit_date . ' ' . $request->visit_time_input;
            }
            
            // Create visit
            $visit = Visit::create($visitData);

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
            
            // Create immunization record if service is immunization
            if ($request->service_type === 'Immunization') {
                \App\Models\Immunization::create([
                    'patient_id' => $request->patient_id,
                    'vaccine_name' => $request->vaccine_name,
                    'dose_number' => $request->dose_number,
                    'date_given' => $visitData['visit_time'] ?? now(),
                    'next_dose_date' => $request->next_dose_date,
                    'administered_by' => $request->health_worker,
                    'notes' => $request->filled('batch_number') ? "Batch: {$request->batch_number}" : null,
                ]);
            }
            
            // Create prenatal record if service is prenatal
            if ($request->service_type === 'Prenatal') {
                \App\Models\PrenatalRecord::create([
                    'patient_id' => $request->patient_id,
                    'visit_date' => $visitData['visit_time'] ?? now(),
                    'gestational_age' => $request->gestational_age,
                    'blood_pressure' => $request->blood_pressure,
                    'weight' => $request->weight,
                    'fundal_height' => $request->fundal_height,
                    'fetal_heart_rate' => $request->fetal_heart_rate,
                    'presentation' => $request->presentation,
                    'remarks' => $request->prenatal_notes,
                ]);
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
        
        $visits = Visit::with(['patient', 'vitalSigns'])
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

