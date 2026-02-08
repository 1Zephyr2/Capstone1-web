<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Visit - Health Center</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 36px;
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 8px;
        }
        .btn-back {
            padding: 10px 20px;
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
        }
        
        .btn-back:hover {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100());
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(107, 114, 128, 0.4);
        }
        h1 {
            color: #047857;
            margin: 0;
            flex: 1;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -0.02em;
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
        .service-section {
            display: none;
            background: #f0f9ff;
            padding: 20px;
            border-radius: 8px;
            border: 2px solid #3b82f6;
            margin-top: 24px;
        }
        .service-section.active {
            display: block;
        }
        .service-section h3 {
            color: #1e40af;
            margin-bottom: 16px;
            font-size: 16px;
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
                    <select name="service_type" id="serviceType" required>
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

            <!-- Service-Specific Sections -->
            
            <!-- Immunization Section -->
            <div id="immunizationSection" class="service-section">
                <h3><i class="bi bi-shield-fill-check"></i> Immunization Details</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label>Vaccine Name <span class="required">*</span></label>
                        <select name="vaccine_name" id="vaccineName">
                            <option value="">Select vaccine</option>
                            <option value="BCG">BCG (Bacillus Calmette-Guérin)</option>
                            <option value="Hepatitis B">Hepatitis B</option>
                            <option value="Pentavalent">Pentavalent (DPT-HepB-Hib)</option>
                            <option value="OPV">OPV (Oral Polio Vaccine)</option>
                            <option value="IPV">IPV (Inactivated Polio Vaccine)</option>
                            <option value="PCV">PCV (Pneumococcal Conjugate Vaccine)</option>
                            <option value="MMR">MMR (Measles, Mumps, Rubella)</option>
                            <option value="MR">MR (Measles, Rubella)</option>
                            <option value="Tetanus Toxoid">Tetanus Toxoid</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dose Number <span class="required">*</span></label>
                        <select name="dose_number" id="doseNumber">
                            <option value="">Select dose</option>
                            <option value="1st Dose">1st Dose</option>
                            <option value="2nd Dose">2nd Dose</option>
                            <option value="3rd Dose">3rd Dose</option>
                            <option value="4th Dose">4th Dose</option>
                            <option value="Booster">Booster</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Batch/Lot Number</label>
                        <input type="text" name="batch_number" placeholder="e.g., LOT123456">
                    </div>
                    <div class="form-group">
                        <label>Next Dose Due Date</label>
                        <input type="date" name="next_dose_date" min="{{ date('Y-m-d') }}">
                        <span class="hint">Leave blank if completed series</span>
                    </div>
                </div>
            </div>

            <!-- Prenatal Section -->
            <div id="prenatalSection" class="service-section">
                <h3><i class="bi bi-heart-pulse-fill"></i> Prenatal Care Details</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label>Gestational Age (weeks) <span class="required">*</span></label>
                        <input type="number" name="gestational_age" min="1" max="42" placeholder="e.g., 28">
                    </div>
                    <div class="form-group">
                        <label>Fundal Height (cm)</label>
                        <input type="number" name="fundal_height" step="0.1" min="0" placeholder="e.g., 26.5">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Fetal Heart Rate (bpm)</label>
                        <input type="number" name="fetal_heart_rate" min="0" max="200" placeholder="120-160">
                        <span class="hint">Normal: 120-160 bpm</span>
                    </div>
                    <div class="form-group">
                        <label>Presentation</label>
                        <select name="presentation">
                            <option value="">Select</option>
                            <option value="Cephalic">Cephalic (Head down)</option>
                            <option value="Breech">Breech (Bottom down)</option>
                            <option value="Transverse">Transverse (Sideways)</option>
                        </select>
                    </div>
                </div>
                <div class="form-row full">
                    <div class="form-group">
                        <label>Prenatal Complications/Concerns</label>
                        <textarea name="prenatal_notes" placeholder="Any concerns, edema, bleeding, etc."></textarea>
                    </div>
                </div>
            </div>

            <!-- Family Planning Section -->
            <div id="familyPlanningSection" class="service-section">
                <h3>👨‍👩‍👧 Family Planning Details</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label>Method Provided <span class="required">*</span></label>
                        <select name="fp_method">
                            <option value="">Select method</option>
                            <option value="Pills">Pills (Oral Contraceptives)</option>
                            <option value="Condoms">Condoms</option>
                            <option value="Injectable">Injectable (Depo)</option>
                            <option value="IUD">IUD (Intrauterine Device)</option>
                            <option value="Implant">Implant</option>
                            <option value="BTL">BTL (Bilateral Tubal Ligation)</option>
                            <option value="Vasectomy">Vasectomy</option>
                            <option value="Natural">Natural Family Planning</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity/Cycles Given</label>
                        <input type="text" name="fp_quantity" placeholder="e.g., 3 months supply">
                    </div>
                </div>
                <div class="form-row full">
                    <div class="form-group">
                        <label>Follow-up Date</label>
                        <input type="date" name="fp_followup_date" min="{{ date('Y-m-d') }}">
                    </div>
                </div>
            </div>

            <!-- Referral Section -->
            <div id="referralSection" class="service-section">
                <h3><i class="bi bi-hospital"></i> Referral Details</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label>Referred To <span class="required">*</span></label>
                        <input type="text" name="referred_to" placeholder="Hospital/Clinic name">
                    </div>
                    <div class="form-group">
                        <label>Reason for Referral <span class="required">*</span></label>
                        <input type="text" name="referral_reason" placeholder="e.g., High blood pressure">
                    </div>
                </div>
                <div class="form-row full">
                    <div class="form-group">
                        <label>Urgency Level</label>
                        <select name="referral_urgency">
                            <option value="Routine">Routine</option>
                            <option value="Urgent">Urgent</option>
                            <option value="Emergency">Emergency</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Vital Signs -->
            <div class="section-title">
                <span>Vital Signs</span>
                @if($patient && $patient->lastVitalSigns)
                <button type="button" class="btn btn-copy" onclick="copyLastVitalSigns()">
                    <i class="bi bi-clipboard2"></i> Copy from Last Visit
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
        // Service type handler - show/hide specific sections
        const serviceTypeSelect = document.getElementById('serviceType');
        const immunizationSection = document.getElementById('immunizationSection');
        const prenatalSection = document.getElementById('prenatalSection');
        const familyPlanningSection = document.getElementById('familyPlanningSection');
        const referralSection = document.getElementById('referralSection');
        
        serviceTypeSelect.addEventListener('change', function() {
            const selectedService = this.value;
            
            // Hide all sections first
            immunizationSection.classList.remove('active');
            prenatalSection.classList.remove('active');
            familyPlanningSection.classList.remove('active');
            referralSection.classList.remove('active');
            
            // Clear required attributes
            document.querySelectorAll('.service-section input, .service-section select').forEach(field => {
                field.removeAttribute('required');
            });
            
            // Show relevant section and set required fields
            if (selectedService === 'Immunization') {
                immunizationSection.classList.add('active');
                document.getElementById('vaccineName').setAttribute('required', 'required');
                document.getElementById('doseNumber').setAttribute('required', 'required');
            } else if (selectedService === 'Prenatal') {
                prenatalSection.classList.add('active');
                document.querySelector('[name="gestational_age"]').setAttribute('required', 'required');
            } else if (selectedService === 'Family Planning') {
                familyPlanningSection.classList.add('active');
                document.querySelector('[name="fp_method"]').setAttribute('required', 'required');
            } else if (selectedService === 'Referral') {
                referralSection.classList.add('active');
                document.querySelector('[name="referred_to"]').setAttribute('required', 'required');
                document.querySelector('[name="referral_reason"]').setAttribute('required', 'required');
            }
        });

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
