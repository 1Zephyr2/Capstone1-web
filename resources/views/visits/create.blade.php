<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Visit - PAWser</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        :root {
            --primary: #14b8a6;
            --primary-strong: #0d9488;
            --text: #1f2937;
            --line: #e5e7eb;
        }
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
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 16px;
        }
        .btn-back {
            padding: 10px 16px;
            background: white;
            color: #111827;
            border: 1px solid #111827;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }
        .btn-back:hover {
            background: #f0fdfa;
            border-color: #14b8a6;
            color: #14b8a6;
            transform: translateY(-1px);
        }
        h1 {
            color: var(--primary-strong);
            margin: 0;
            flex: 1;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .section-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin: 28px 0 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--line);
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: -0.01em;
        }
        .service-field {
            display: none;
        }
        .service-field.show {
            display: block;
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
            padding: 12px 14px;
            border: 1.5px solid var(--line);
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            color: #374151;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1), inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        input::placeholder, textarea::placeholder {
            color: #9ca3af;
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
        .btn {
            padding: 12px 28px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-strong) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-strong) 0%, #0f766e 100%);
            box-shadow: 0 8px 20px rgba(20, 184, 166, 0.4);
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: white;
            color: var(--text);
            border: 1px solid var(--line);
        }
        .btn-secondary:hover {
            background: var(--line);
            border-color: #9ca3af;
        }
        .actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid var(--line);
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header-top">
            <a href="{{ route('pets.show', $patient) }}" class="btn-back"><i class="bi bi-arrow-left"></i> Back</a>
            <h1>Record Visit</h1>
        </div>

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

        <form action="{{ route('visits.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient ? $patient->id : old('patient_id') }}">

            <!-- Visit Information -->
            <div class="section-title"><i class="bi bi-clipboard-check" style="color: var(--primary);"></i>Visit Information</div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Service Type <span class="required">*</span></label>
                    <select name="service_type" id="serviceType" required>
                        <option value="">Select service</option>
                        <option value="Bath & Dry">Bath &amp; Dry</option>
                        <option value="Full Grooming">Full Grooming</option>
                        <option value="Haircut & Styling">Haircut &amp; Styling</option>
                        <option value="Nail Trimming">Nail Trimming</option>
                        <option value="Ear Cleaning">Ear Cleaning</option>
                        <option value="Teeth Brushing">Teeth Brushing</option>
                        <option value="De-shedding Treatment">De-shedding Treatment</option>
                        <option value="Flea & Tick Treatment">Flea &amp; Tick Treatment</option>
                        <option value="Paw Treatment">Paw Treatment</option>
                        <option value="Boarding Checkup">Boarding Checkup</option>
                        <option value="Follow-up">Follow-up</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Staff Member</label>
                    <input type="text" name="health_worker" placeholder="Groomer/Staff name" value="{{ old('health_worker', session('last_health_worker', '')) }}">
                    <span class="hint">Auto-remembered from last visit</span>
                </div>
            </div>

            <!-- Grooming Details -->
            <div class="section-title"><i class="bi bi-scissors" style="color: var(--primary);"></i>Grooming Details</div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Coat Condition</label>
                    <select name="coat_condition">
                        <option value="">Select condition</option>
                        <option value="Clean">Clean</option>
                        <option value="Matted">Matted</option>
                        <option value="Dirty">Dirty</option>
                        <option value="Shedding">Shedding</option>
                        <option value="Flea-Infested">Flea-Infested</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pet Behavior</label>
                    <select name="behavior">
                        <option value="">Select behavior</option>
                        <option value="Calm">Calm</option>
                        <option value="Anxious">Anxious</option>
                        <option value="Aggressive">Aggressive</option>
                        <option value="Hyperactive">Hyperactive</option>
                    </select>
                </div>
            </div>

            <!-- Service-Specific Fields -->
            <div class="service-field" id="fleaTickField">
                <div class="form-row">
                    <div class="form-group">
                        <label>Treatment Product Used</label>
                        <input type="text" name="flea_tick_product" placeholder="e.g., Frontline Plus, Advantage II">
                    </div>
                    <div class="form-group">
                        <label>Area Treated</label>
                        <select name="flea_tick_area">
                            <option value="">Select area</option>
                            <option value="Full Body">Full Body</option>
                            <option value="Head">Head</option>
                            <option value="Body">Body</option>
                            <option value="Spot">Spot Treatment</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="service-field" id="nailTrimmingField">
                <div class="form-row">
                    <div class="form-group">
                        <label>Nail Condition Before</label>
                        <select name="nail_condition_before">
                            <option value="">Select condition</option>
                            <option value="Short">Short</option>
                            <option value="Medium">Medium</option>
                            <option value="Long">Long</option>
                            <option value="Overgrown">Overgrown</option>
                            <option value="Cracked">Cracked</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nail Condition After</label>
                        <select name="nail_condition_after">
                            <option value="">Select condition</option>
                            <option value="Trimmed">Trimmed</option>
                            <option value="Buffed">Buffed</option>
                            <option value="Polished">Polished</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="service-field" id="teethBrushingField">
                <div class="form-row">
                    <div class="form-group">
                        <label>Dental Observations</label>
                        <textarea name="dental_notes" placeholder="Any tartar buildup, gum issues, or other observations..."></textarea>
                    </div>
                </div>
            </div>

            <div class="service-field" id="deshedField">
                <div class="form-row">
                    <div class="form-group">
                        <label>Shedding Amount</label>
                        <select name="shedding_amount">
                            <option value="">Select amount</option>
                            <option value="Light">Light Shedding</option>
                            <option value="Moderate">Moderate Shedding</option>
                            <option value="Heavy">Heavy Shedding</option>
                            <option value="Extreme">Extreme Shedding</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hair Removed (approx.)</label>
                        <input type="text" name="hair_removed" placeholder="e.g., 2 cups, 1 bag">
                    </div>
                </div>
            </div>

            <div class="service-field" id="boardingField">
                <div class="form-row full">
                    <div class="form-group">
                        <label>Health Observations</label>
                        <textarea name="boarding_observations" placeholder="Pet's health status, energy level, appetite, any concerns..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Image Upload -->
            <div class="form-row">
                <div class="form-group">
                    <label>Upload Photos</label>
                    <input type="file" name="visit_photos[]" multiple accept="image/*">
                    <span class="hint">Upload photos of the grooming results (optional, max 5 images)</span>
                </div>
            </div>

            <!-- Notes -->
            <div class="section-title"><i class="bi bi-chat-left-text" style="color: var(--primary);"></i>Visit Notes</div>
            
            <div class="form-row full">
                <div class="form-group">
                    <label>Grooming Notes</label>
                    <textarea name="grooming_notes" placeholder="Special instructions, coat issues, client requests, any observations...">{{ old('grooming_notes') }}</textarea>
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
        // Service type conditional fields
        const serviceTypeSelect = document.getElementById('serviceType');
        
        const serviceFields = {
            'Flea & Tick Treatment': 'fleaTickField',
            'Nail Trimming': 'nailTrimmingField',
            'Teeth Brushing': 'teethBrushingField',
            'De-shedding Treatment': 'deshedField',
            'Boarding Checkup': 'boardingField'
        };

        function updateServiceFields() {
            const selectedService = serviceTypeSelect.value;
            
            // Hide all service fields
            Object.values(serviceFields).forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) field.classList.remove('show');
            });
            
            // Show relevant field
            if (serviceFields[selectedService]) {
                const field = document.getElementById(serviceFields[selectedService]);
                if (field) field.classList.add('show');
            }
        }

        serviceTypeSelect.addEventListener('change', updateServiceFields);

        // Remember health worker/groomer name in session
        document.querySelector('form').addEventListener('submit', function(e) {
            const healthWorker = document.querySelector('[name="health_worker"]').value;
            if (healthWorker) {
                sessionStorage.setItem('last_health_worker', healthWorker);
            }
        });
    </script>
</body>
</html>
