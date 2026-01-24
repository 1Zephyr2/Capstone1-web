<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Visit - Health Center</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 8px;
        }
        .btn-back {
            padding: 8px 16px;
            background: #6b7280;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-back:hover {
            background: #4b5563;
        }
        h1 {
            color: #047857;
            margin: 0;
            flex: 1;
        }
        .patient-info {
            background: #f0fdf4;
            padding: 16px;
            border-radius: 6px;
            margin-bottom: 24px;
            border-left: 4px solid #047857;
        }
        .patient-info h3 {
            color: #047857;
            margin-bottom: 8px;
        }
        .patient-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
            font-size: 14px;
            color: #374151;
        }
        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #374151;
            margin: 24px 0 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }
        .form-row.full {
            grid-template-columns: 1fr;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }
        label .required {
            color: #dc2626;
        }
        input, select, textarea {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #047857;
            box-shadow: 0 0 0 3px rgba(4,120,87,0.1);
        }
        textarea {
            min-height: 80px;
            resize: vertical;
        }
        .hint {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }
        .vital-signs-card {
            background: #fef3c7;
            padding: 20px;
            border-radius: 8px;
            border: 2px solid #fbbf24;
        }
        .vital-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: #047857;
            color: white;
        }
        .btn-primary:hover {
            background: #059669;
        }
        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }
        .btn-secondary:hover {
            background: #d1d5db;
        }
        .btn-copy {
            background: #3b82f6;
            color: white;
            font-size: 13px;
            padding: 8px 16px;
        }
        .btn-copy:hover {
            background: #2563eb;
        }
        .actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .status-indicator {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-left: 8px;
        }
        .status-normal {
            background: #10b981;
        }
        .status-elevated {
            background: #f59e0b;
        }
        .status-high {
            background: #ef4444;
        }
        .status-low {
            background: #3b82f6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-top">
            <button onclick="goBack()" class="btn-back">← Back</button>
            <h1>Record Patient Visit</h1>
        </div>
        
        @if($patient)
        <div class="patient-info">
            <h3>{{ $patient->full_name }}</h3>
            <div class="patient-details">
                <div><strong>ID:</strong> {{ $patient->patient_id }}</div>
                <div><strong>Age:</strong> {{ $patient->age }} years</div>
                <div><strong>Sex:</strong> {{ $patient->sex }}</div>
                <div><strong>Contact:</strong> {{ $patient->contact_number ?: 'N/A' }}</div>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-error">
            <strong>Please fix the following errors:</strong>
            <ul style="margin-top: 8px; margin-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('visits.store') }}" method="POST">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient ? $patient->id : old('patient_id') }}">

            <!-- Visit Information -->
            <div class="section-title">Visit Information</div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Service Type <span class="required">*</span></label>
                    <select name="service_type" required>
                        <option value="">Select service</option>
                        <option value="General Checkup">General Checkup</option>
                        <option value="Immunization">Immunization</option>
                        <option value="Prenatal">Prenatal Care</option>
                        <option value="Family Planning">Family Planning</option>
                        <option value="Referral">Referral</option>
                        <option value="Health Education">Health Education</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Health Worker</label>
                    <input type="text" name="health_worker" value="{{ old('health_worker', session('last_health_worker', '')) }}">
                    <span class="hint">Auto-remembered from last entry</span>
                </div>
            </div>

            <div class="form-row full">
                <div class="form-group">
                    <label>Chief Complaint</label>
                    <textarea name="chief_complaint">{{ old('chief_complaint') }}</textarea>
                </div>
            </div>

            <!-- Vital Signs -->
            <div class="section-title">
                <span>Vital Signs</span>
                @if($patient && $patient->lastVitalSigns)
                <button type="button" class="btn btn-copy" onclick="copyLastVitalSigns()">
                    📋 Copy from Last Visit
                </button>
                @endif
            </div>

            <div class="vital-signs-card">
                <div class="vital-grid">
                    <div class="form-group">
                        <label>Blood Pressure</label>
                        <input type="text" name="blood_pressure" id="bp" placeholder="120/80" pattern="\d{2,3}/\d{2,3}">
                        <span class="hint">e.g., 120/80</span>
                    </div>
                    <div class="form-group">
                        <label>Temperature (°C)</label>
                        <input type="number" name="temperature" id="temp" step="0.1" min="30" max="45" placeholder="36.5">
                        <span class="hint">Normal: 36.1-37.2</span>
                    </div>
                    <div class="form-group">
                        <label>Pulse Rate (bpm)</label>
                        <input type="number" name="pulse_rate" id="pulse" step="1" min="30" max="200" placeholder="75">
                        <span class="hint">Normal: 60-100</span>
                    </div>
                    <div class="form-group">
                        <label>Weight (kg)</label>
                        <input type="number" name="weight" id="weight" step="0.1" min="0" max="500" placeholder="65.5">
                    </div>
                    <div class="form-group">
                        <label>Height (cm)</label>
                        <input type="number" name="height" id="height" step="0.1" min="0" max="300" placeholder="165">
                    </div>
                    <div class="form-group" id="bmiDisplay" style="display: flex; align-items: end;">
                        <div style="padding: 10px; background: white; border-radius: 6px; width: 100%;">
                            <label style="margin: 0;">BMI: <span id="bmiValue">-</span></label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="form-row full" style="margin-top: 24px;">
                <div class="form-group">
                    <label>Notes / Recommendations</label>
                    <textarea name="notes">{{ old('notes') }}</textarea>
                </div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Visit</button>
            </div>
        </form>
    </div>

    <script>
        function goBack() {
            const referrer = document.referrer;
            const currentDomain = window.location.origin;
            
            // Check if we have a referrer from the same domain and it's not the current page
            if (referrer && referrer.startsWith(currentDomain) && referrer !== window.location.href) {
                window.history.back();
            } else {
                window.location.href = '/dashboard';
            }
        }

        // Copy from last visit functionality
        function copyLastVitalSigns() {
            @if($patient)
            fetch(`/api/patients/{{ $patient->id }}/vital-signs/last`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    document.getElementById('bp').value = result.data.blood_pressure || '';
                    document.getElementById('temp').value = result.data.temperature || '';
                    document.getElementById('pulse').value = result.data.pulse_rate || '';
                    document.getElementById('weight').value = result.data.weight || '';
                    document.getElementById('height').value = result.data.height || '';
                    calculateBMI();
                    alert('✓ Last vital signs copied successfully!');
                } else {
                    alert('No previous vital signs found.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to copy vital signs');
            });
            @endif
        }

        // Auto-calculate BMI
        function calculateBMI() {
            const weight = parseFloat(document.getElementById('weight').value);
            const height = parseFloat(document.getElementById('height').value);
            
            if (weight && height) {
                const heightInMeters = height / 100;
                const bmi = (weight / (heightInMeters * heightInMeters)).toFixed(1);
                document.getElementById('bmiValue').textContent = bmi;
            } else {
                document.getElementById('bmiValue').textContent = '-';
            }
        }

        document.getElementById('weight').addEventListener('input', calculateBMI);
        document.getElementById('height').addEventListener('input', calculateBMI);

        // Remember health worker in session storage
        document.querySelector('form').addEventListener('submit', function(e) {
            const healthWorker = document.querySelector('[name="health_worker"]').value;
            if (healthWorker) {
                sessionStorage.setItem('last_health_worker', healthWorker);
            }
        });

        // Auto-fill today's date (already handled server-side, but for display)
        window.addEventListener('load', function() {
            const today = new Date().toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            console.log('Visit date:', today);
        });
    </script>
</body>
</html>
