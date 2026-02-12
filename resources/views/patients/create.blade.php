<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Patient - Health Center</title>
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
            max-width: 800px;
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
            margin-bottom: 10px;
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
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(107, 114, 128, 0.4);
        }
        .header-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: inherit;
            transition: opacity 0.2s;
            margin-right: auto;
        }
        .header-logo:hover {
            opacity: 0.8;
        }

        .header-logo-text {
            font-size: 18px;
            font-weight: 600;
            color: #047857;
        }
        h1 {
            color: #047857;
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            flex: 1;
            letter-spacing: -0.02em;
        }
        .subtitle {
            color: #6b7280;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .form-section {
            margin-bottom: 24px;
        }
        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
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
            transition: border-color 0.2s;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #047857;
            box-shadow: 0 0 0 3px rgba(4,120,87,0.1);
        }
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        .hint {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }
        .actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        button {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
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
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .optional-section {
            background: #f9fafb;
            padding: 16px;
            border-radius: 6px;
            margin-top: 16px;
        }
        .autocomplete-container {
            position: relative;
            margin-bottom: 24px;
        }
        .autocomplete-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            max-height: 300px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
        }
        .autocomplete-results.active {
            display: block;
        }
        .autocomplete-item {
            padding: 12px 16px;
            cursor: pointer;
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.2s;
        }
        .autocomplete-item:hover {
            background: #f9fafb;
        }
        .autocomplete-item strong {
            color: #047857;
            display: block;
            margin-bottom: 4px;
        }
        .autocomplete-item small {
            color: #6b7280;
            font-size: 12px;
        }
        .automation-alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .automation-alert.warning {
            background: #fef3c7;
            border-color: #f59e0b;
            color: #92400e;
        }
        .automation-alert.info {
            background: #dbeafe;
            border-color: #3b82f6;
            color: #1e40af;
        }
        .age-display {
            display: inline-block;
            margin-left: 8px;
            padding: 4px 8px;
            background: #ecfdf5;
            color: #047857;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-top">
            <a href="{{ route('dashboard') }}" class="header-logo">
                <img src="/images/systemlogo.png" alt="CareSync" style="height: 35px; object-fit: contain;">
            </a>
            <button onclick="goBack()" class="btn-back">← Back</button>
            <h1>Register New Patient</h1>
        </div>
        <p class="subtitle">Fill in essential patient information. Patient ID will be auto-generated.</p>

        <!-- Patient Search Autocomplete -->
        <div class="autocomplete-container">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">
                <i class="bi bi-search"></i> Search Existing Patient (Auto-fill)
            </label>
            <input type="text" id="patientSearch" placeholder="Type patient name to check if already exists..." 
                   style="width: 100%; padding: 12px; border: 2px solid #d1d5db; border-radius: 6px; font-size: 14px;">
            <div id="autocompleteResults" class="autocomplete-results"></div>
            <p style="font-size: 12px; color: #6b7280; margin-top: 6px;">
                <i class="bi bi-lightbulb"></i> Start typing to search. Click on a result to auto-fill their information (you can still edit after).
            </p>
        </div>

        <!-- Duplicate Warning -->
        <div id="duplicateWarning" class="automation-alert warning" style="display: none;">
            <i class="bi bi-exclamation-triangle-fill" style="font-size: 20px;"></i>
            <div>
                <strong>Possible Duplicate Detected!</strong>
                <div id="duplicateMessage"></div>
            </div>
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

        <form action="{{ route('patients.store') }}" method="POST">
            @csrf

            <!-- Basic Information -->
            <div class="form-section">
                <div class="section-title">Basic Information</div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name <span class="required">*</span></label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name <span class="required">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name') }}">
                        <span class="hint">Optional</span>
                    </div>
                    <div class="form-group">
                        <label>Birthdate <span class="required">*</span></label>
                        <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required max="{{ date('Y-m-d') }}">
                        <span class="hint">Age will be auto-calculated<span id="ageDisplay" class="age-display" style="display: none;"></span></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Sex <span class="required">*</span></label>
                        <select name="sex" required>
                            <option value="">Select</option>
                            <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="tel" name="contact_number" value="{{ old('contact_number') }}" placeholder="09XX-XXX-XXXX">
                    </div>
                </div>

                <div class="form-row full">
                    <div class="form-group">
                        <label>Address <span class="required">*</span></label>
                        <textarea name="address" required>{{ old('address') }}</textarea>
                        <span class="hint">House No., Street, Barangay, City</span>
                    </div>
                </div>
            </div>

            <!-- Optional Information -->
            <div class="form-section">
                <div class="section-title">Additional Information (Optional)</div>
                <div class="optional-section">
                    <div class="form-row">
                        <div class="form-group">
                            <label>PhilHealth Number</label>
                            <input type="text" name="philhealth_number" value="{{ old('philhealth_number') }}">
                        </div>
                        <div class="form-group">
                            <label>Emergency Contact Name</label>
                            <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Emergency Contact Number</label>
                            <input type="tel" name="emergency_contact_number" value="{{ old('emergency_contact_number') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <button type="button" class="btn-secondary" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn-primary">Register Patient</button>
            </div>
        </form>
    </div>

    <script>
        // Auto-calculate age from birthdate
        const birthdateInput = document.getElementById('birthdate');
        const ageDisplay = document.getElementById('ageDisplay');
        
        birthdateInput.addEventListener('change', function() {
            const birthdate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthdate.getFullYear();
            const monthDiff = today.getMonth() - birthdate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }
            
            if (age >= 0) {
                ageDisplay.textContent = `Age: ${age} years old`;
                ageDisplay.style.display = 'inline-block';
            }
        });

        // Patient search autocomplete
        const searchInput = document.getElementById('patientSearch');
        const resultsContainer = document.getElementById('autocompleteResults');
        const duplicateWarning = document.getElementById('duplicateWarning');
        const duplicateMessage = document.getElementById('duplicateMessage');
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();
            
            if (query.length < 2) {
                resultsContainer.classList.remove('active');
                return;
            }
            
            searchTimeout = setTimeout(() => {
                fetch(`/api/patients/search?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(patients => {
                        if (patients.length > 0) {
                            displayResults(patients);
                        } else {
                            resultsContainer.classList.remove('active');
                        }
                    })
                    .catch(err => console.error('Search error:', err));
            }, 300);
        });
        
        function displayResults(patients) {
            resultsContainer.innerHTML = patients.map(patient => `
                <div class="autocomplete-item" onclick='fillPatientData(${JSON.stringify(patient)})'>
                    <strong>${patient.full_name}</strong>
                    <small>ID: ${patient.patient_id} | Birthdate: ${patient.birthdate} | ${patient.address}</small>
                </div>
            `).join('');
            resultsContainer.classList.add('active');
        }
        
        function fillPatientData(patient) {
            // Fill form fields
            document.querySelector('[name="first_name"]').value = patient.first_name || '';
            document.querySelector('[name="last_name"]').value = patient.last_name || '';
            document.querySelector('[name="middle_name"]').value = patient.middle_name || '';
            document.getElementById('birthdate').value = patient.birthdate || '';
            document.querySelector('[name="sex"]').value = patient.sex || '';
            document.querySelector('[name="contact_number"]').value = patient.contact_number || '';
            document.querySelector('[name="address"]').value = patient.address || '';
            document.querySelector('[name="philhealth_number"]').value = patient.philhealth_number || '';
            document.querySelector('[name="emergency_contact_name"]').value = patient.emergency_contact_name || '';
            document.querySelector('[name="emergency_contact_number"]').value = patient.emergency_contact_number || '';
            
            // Trigger age calculation
            birthdateInput.dispatchEvent(new Event('change'));
            
            // Hide results
            resultsContainer.classList.remove('active');
            searchInput.value = '';
            
            // Show duplicate warning
            duplicateWarning.style.display = 'flex';
            duplicateMessage.innerHTML = `This patient already exists: <strong>${patient.full_name}</strong> (${patient.patient_id}). Data has been auto-filled. You can edit or cancel if this is a duplicate.`;
        }
        
        // Check for duplicate names on typing
        const firstNameInput = document.querySelector('[name="first_name"]');
        const lastNameInput = document.querySelector('[name="last_name"]');
        let duplicateTimeout;
        
        function checkDuplicate() {
            clearTimeout(duplicateTimeout);
            const firstName = firstNameInput.value.trim();
            const lastName = lastNameInput.value.trim();
            
            if (firstName.length < 2 || lastName.length < 2) {
                return;
            }
            
            duplicateTimeout = setTimeout(() => {
                fetch(`/api/patients/search?q=${encodeURIComponent(firstName + ' ' + lastName)}`)
                    .then(res => res.json())
                    .then(patients => {
                        const exactMatch = patients.find(p => 
                            p.first_name.toLowerCase() === firstName.toLowerCase() && 
                            p.last_name.toLowerCase() === lastName.toLowerCase()
                        );
                        
                        if (exactMatch && duplicateWarning.style.display === 'none') {
                            duplicateWarning.style.display = 'flex';
                            duplicateMessage.innerHTML = `A patient with this name may already exist: <strong>${exactMatch.full_name}</strong> (${exactMatch.patient_id}). Please verify before submitting.`;
                        }
                    });
            }, 500);
        }
        
        firstNameInput.addEventListener('input', checkDuplicate);
        lastNameInput.addEventListener('input', checkDuplicate);
        
        // Hide autocomplete when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.autocomplete-container')) {
                resultsContainer.classList.remove('active');
            }
        });

        function goBack() {
            const referrer = document.referrer;
            const currentDomain = window.location.origin;
            
            // Check if we have a referrer from the same domain and it's not the current page
            if (referrer && referrer.startsWith(currentDomain) && referrer !== window.location.href) {
                window.history.back();
            } else {
                window.location.href = '/patients';
            }
        }
    </script>
</body>
</html>
