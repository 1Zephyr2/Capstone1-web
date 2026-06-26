<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PetHealthRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetHealthRecordController extends Controller
{
    // Store a new health record (staff only)
    public function store(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'condition'      => 'required|string|max:255',
            'diagnosed_date' => 'nullable|date',
            'medication'     => 'nullable|string|max:255',
            'dosage'         => 'nullable|string|max:255',
            'status'         => 'required|in:active,resolved,monitoring',
            'notes'          => 'nullable|string',
        ]);

        $validated['patient_id'] = $patient->id;
        $validated['recorded_by'] = Auth::id();

        PetHealthRecord::create($validated);

        return redirect()->route('pets.show', $patient)
            ->with('success', 'Health record added successfully.');
    }

    // Update an existing health record (staff only)
    public function update(Request $request, Patient $patient, PetHealthRecord $healthRecord)
    {
        $validated = $request->validate([
            'condition'      => 'required|string|max:255',
            'diagnosed_date' => 'nullable|date',
            'medication'     => 'nullable|string|max:255',
            'dosage'         => 'nullable|string|max:255',
            'status'         => 'required|in:active,resolved,monitoring',
            'notes'          => 'nullable|string',
        ]);

        $healthRecord->update($validated);

        return redirect()->route('pets.show', $patient)
            ->with('success', 'Health record updated successfully.');
    }

    // Delete a health record (staff only)
    public function destroy(Patient $patient, PetHealthRecord $healthRecord)
    {
        $healthRecord->delete();

        return redirect()->route('pets.show', $patient)
            ->with('success', 'Health record deleted.');
    }
}