<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of patients with search
     */
    public function index(Request $request)
    {
        $query = Patient::with(['visits' => function($q) {
            $q->latest()->limit(1);
        }]);

        // Type-ahead search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->search($request->search);
        }

        $patients = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('patients.index', compact('patients'));
    }

    /**
     * Type-ahead search API for AJAX
     */
    public function search(Request $request)
    {
        $term = $request->get('q', $request->get('term', ''));
        $birthday = $request->get('birthday', '');
        
        $query = Patient::query();
        
        // Search by term (name, ID, contact)
        if (strlen($term) >= 2) {
            $query->search($term);
        } elseif ($birthday) {
            // If no term but birthday is provided, search by birthday
            $query->whereDate('birthdate', $birthday);
        } else {
            return response()->json([]);
        }

        $patients = $query->limit(10)
            ->get()
            ->map(function($patient) {
                return [
                    'id' => $patient->id,
                    'patient_id' => $patient->patient_id,
                    'full_name' => $patient->full_name,
                    'name' => $patient->full_name,
                    'age' => $patient->age,
                    'sex' => $patient->sex,
                    'contact' => $patient->contact_number,
                    'address' => $patient->address,
                    'birthdate' => $patient->birthdate ? $patient->birthdate->format('Y-m-d') : null,
                    'first_name' => $patient->first_name,
                    'last_name' => $patient->last_name,
                    'middle_name' => $patient->middle_name,
                    'philhealth_number' => $patient->philhealth_number,
                    'emergency_contact_name' => $patient->emergency_contact_name,
                    'emergency_contact_number' => $patient->emergency_contact_number,
                ];
            });

        return response()->json($patients);
    }

    /**
     * Show the form for creating a new patient
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created patient
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birthdate' => 'required|date|before:today',
            'sex' => 'required|in:Male,Female',
            'contact_number' => 'nullable|string|max:20',
            'address' => 'required|string',
            'philhealth_number' => 'nullable|string|max:50',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            // Check if request is AJAX
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $patient = Patient::create($request->all());

        // Check if request is AJAX
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Patient registered successfully! Patient ID: ' . $patient->patient_id,
                'patient' => $patient
            ]);
        }

        return redirect()
            ->route('patients.show', $patient)
            ->with('success', 'Patient registered successfully! Patient ID: ' . $patient->patient_id);
    }

    /**
     * Display the specified patient
     */
    public function show(Patient $patient)
    {
        $patient->load(['visits.vitalSigns', 'immunizations', 'prenatalRecords', 'referrals']);
        
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the patient
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified patient
     */
    public function update(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birthdate' => 'required|date|before:today',
            'sex' => 'required|in:Male,Female',
            'contact_number' => 'nullable|string|max:20',
            'address' => 'required|string',
            'philhealth_number' => 'nullable|string|max:50',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $patient->update($request->all());

        return redirect()
            ->route('patients.show', $patient)
            ->with('success', 'Patient information updated successfully!');
    }

    /**
     * Remove the specified patient
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient record archived successfully.');
    }

    /**
     * Show import form
     */
    public function showImportForm()
    {
        return view('patients.import');
    }

    /**
     * Download CSV template
     */
    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="patient_import_template.csv"',
        ];

        $columns = ['first_name', 'last_name', 'middle_name', 'birthdate', 'sex', 'contact_number', 'address', 'philhealth_number'];
        
        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            // Add sample data
            fputcsv($file, ['Maria', 'Santos', 'Cruz', '1990-05-15', 'Female', '09171234567', '123 Main St, Brgy San Roque, Quezon City', '12-345678901-2']);
            fputcsv($file, ['Juan', 'Dela Cruz', '', '1985-08-20', 'Male', '09181234567', '456 Second Ave, Brgy San Roque, Quezon City', '']);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Import patients from Excel/CSV
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx,xls|max:2048',
        ]);

        try {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            
            // Handle CSV files
            if ($extension == 'csv' || $extension == 'txt') {
                $result = $this->importCsv($file);
                
                // Check if request is AJAX
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => $result['message'],
                        'imported' => $result['imported'],
                        'errors' => $result['errors']
                    ]);
                }
                
                return redirect()
                    ->route('patients.index')
                    ->with('success', $result['message'])
                    ->with('import_errors', $result['errors']);
            } else {
                $errorMsg = 'Please use CSV format. Excel support coming soon!';
                
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => $errorMsg
                    ], 400);
                }
                
                return back()->with('error', $errorMsg);
            }
        } catch (\Exception $e) {
            $errorMsg = 'Import failed: ' . $e->getMessage();
            
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMsg
                ], 500);
            }
            
            return back()->with('error', $errorMsg);
        }
    }

    /**
     * Import CSV file
     */
    private function importCsv($file)
    {
        $handle = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($handle); // Read header row
        
        $imported = 0;
        $errors = [];
        $row = 1;

        while (($data = fgetcsv($handle)) !== false) {
            $row++;
            
            try {
                // Map CSV columns to array
                $patientData = array_combine($header, $data);
                
                // Validate required fields
                if (empty($patientData['first_name']) || empty($patientData['last_name']) || 
                    empty($patientData['birthdate']) || empty($patientData['sex']) || 
                    empty($patientData['address'])) {
                    $errors[] = "Row $row: Missing required fields";
                    continue;
                }

                // Validate sex
                if (!in_array($patientData['sex'], ['Male', 'Female'])) {
                    $errors[] = "Row $row: Sex must be 'Male' or 'Female'";
                    continue;
                }

                // Validate birthdate
                try {
                    $birthdate = \Carbon\Carbon::parse($patientData['birthdate']);
                    if ($birthdate->isFuture()) {
                        $errors[] = "Row $row: Birthdate cannot be in the future";
                        continue;
                    }
                } catch (\Exception $e) {
                    $errors[] = "Row $row: Invalid birthdate format (use YYYY-MM-DD)";
                    continue;
                }

                // Create patient
                Patient::create([
                    'first_name' => $patientData['first_name'],
                    'last_name' => $patientData['last_name'],
                    'middle_name' => $patientData['middle_name'] ?? null,
                    'birthdate' => $birthdate,
                    'sex' => $patientData['sex'],
                    'contact_number' => $patientData['contact_number'] ?? null,
                    'address' => $patientData['address'],
                    'philhealth_number' => $patientData['philhealth_number'] ?? null,
                ]);

                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Row $row: " . $e->getMessage();
            }
        }

        fclose($handle);

        $message = "Successfully imported $imported patients.";
        if (count($errors) > 0) {
            $message .= " " . count($errors) . " rows failed.";
        }

        return [
            'message' => $message,
            'imported' => $imported,
            'errors' => $errors
        ];
    }

    /**
     * Get last vital signs for a patient (for copy feature)
     */
    public function getLastVitalSigns(Patient $patient)
    {
        $lastVitalSigns = $patient->lastVitalSigns;

        if (!$lastVitalSigns) {
            return response()->json([
                'success' => false,
                'message' => 'No previous vital signs found'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'blood_pressure' => $lastVitalSigns->blood_pressure,
                'temperature' => $lastVitalSigns->temperature,
                'pulse_rate' => $lastVitalSigns->pulse_rate,
                'weight' => $lastVitalSigns->weight,
                'height' => $lastVitalSigns->height,
            ]
        ]);
    }
}

