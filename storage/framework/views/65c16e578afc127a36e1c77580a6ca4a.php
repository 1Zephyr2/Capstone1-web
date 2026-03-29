<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Pet - PAWser</title>
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap-icons/bootstrap-icons.min.css')); ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background: #1e293b;
            color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            height: 72px;
        }

        .navbar i.bi {
            font-family: bootstrap-icons;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 0 24px;
            gap: 24px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .navbar-brand:hover {
            opacity: 0.8;
        }

        .navbar-logo {
            height: 40px;
            width: 40px;
            object-fit: contain;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 6px;
            flex: 1;
            justify-content: center;
        }

        .navbar-item {
            padding: 8px 14px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .navbar-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .navbar-item.active {
            background: rgba(20, 184, 166, 0.15);
            color: #14b8a6;
            border-bottom: 2px solid #14b8a6;
        }

        .navbar-end {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
        }

        .navbar-title {
            font-size: 16px;
            font-weight: 700;
        }

        .Container {
            max-width: 800px;
            margin: 0 auto;
            width: 100%;
            background: white;
            padding: 40px 24px;
        }

        h1 {
            color: #14b8a6;
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: white;
            color: #0f172a;
            text-decoration: none;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #0f172a;
            border-color: #14b8a6;
            background: #f0fdf4;
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
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
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
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0d9488 0%, #0a7e70 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }
        .btn-primary:disabled, .btn-primary[disabled] {
            background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
            cursor: not-allowed;
            opacity: 0.5;
            transform: none;
            box-shadow: none;
        }
        .btn-primary:disabled:hover, .btn-primary[disabled]:hover {
            background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
            transform: none;
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
            color: #14b8a6;
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
            background: #f0fdf4;
            border-color: #14b8a6;
            color: #0d9488;
        }
        .age-display {
            display: inline-block;
            margin-left: 8px;
            padding: 4px 8px;
            background: #f0fdf4;
            color: #14b8a6;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }
        .field-valid {
            border-color: #10b981 !important;
            background-color: #f0fdf4 !important;
        }
        .field-invalid {
            border-color: #ef4444 !important;
            background-color: #fef2f2 !important;
        }
        .form-progress {
            margin-bottom: 20px;
            padding: 16px;
            background: #f0fdf4;
            border-radius: 8px;
            border: 1px solid #a7f3d0;
        }
        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 8px;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #14b8a6, #0d9488);
            transition: width 0.3s ease;
            border-radius: 3px;
        }
        .progress-text {
            font-size: 12px;
            color: #14b8a6;
            font-weight: 600;
        }
        .field-error-inline {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }
        .field-success {
            color: #10b981;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }
        input:disabled, select:disabled {
            background: #f9fafb;
            cursor: not-allowed;
            opacity: 0.6;
        }
        .form-loading {
            opacity: 0.6;
            pointer-events: none;
        }
        .loading-spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 2px solid #f3f4f6;
            border-top-color: #14b8a6;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-right: 6px;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="Container">
        <a href="<?php echo e(route('pets.index')); ?>" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to Pets
        </a>

        <h1>Register New Pet</h1>
        <p class="subtitle">Fill in essential pet information. Pet ID will be auto-generated.</p>

        <!-- Patient Search Autocomplete -->
        <div class="autocomplete-container">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">
                <i class="bi bi-search"></i> Search Existing Pet (Auto-fill)
            </label>
            <input type="text" id="patientSearch" placeholder="Type pet name to check if already exists..." 
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

        <?php if($errors->any()): ?>
        <div class="alert alert-error">
            <strong>Please fix the following errors:</strong>
            <ul style="margin-top: 8px; margin-left: 20px;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('pets.store')); ?>" method="POST" id="petForm">
            <?php echo csrf_field(); ?>

            <!-- Form Progress Indicator -->
            <div class="form-progress">
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill" style="width: 0%;"></div>
                </div>
                <div class="progress-text"><span id="progressPercent">0</span>% Complete</div>
            </div>

            <!-- Pet Information -->
            <div class="form-section">
                <div class="section-title">Pet Information</div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Pet Name <span class="required">*</span></label>
                        <input type="text" name="pet_name" value="<?php echo e(old('pet_name')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Species <span class="required">*</span></label>
                        <select name="species_id" id="speciesSelect" required onchange="loadSpeciesCharacteristics()">
                            <option value="">Select Species</option>
                            <?php $__currentLoopData = $species; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sp->id); ?>" <?php echo e(old('species_id') == $sp->id ? 'selected' : ''); ?>><?php echo e($sp->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div id="speciesCharacteristics" style="margin-top: 12px; padding: 12px; background: #f0fdf4; border-left: 4px solid #14b8a6; border-radius: 6px; display: none;">
                            <strong style="color: #14b8a6; display: block; margin-bottom: 8px;">Species Characteristics:</strong>
                            <div id="characteristicsContent" style="color: #1e40af; font-size: 13px; line-height: 1.6;"></div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Breed <span class="required">*</span></label>
                        <input type="text" name="breed" value="<?php echo e(old('breed')); ?>" required placeholder="e.g., Golden Retriever, Persian">
                    </div>
                    <div class="form-group">
                        <label>Color</label>
                        <input type="text" name="color" value="<?php echo e(old('color')); ?>" placeholder="e.g., Brown, White">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Birthdate <span class="required">*</span></label>
                        <input type="date" id="birthdate" name="birthdate" value="<?php echo e(old('birthdate')); ?>" required max="<?php echo e(date('Y-m-d')); ?>">
                        <span class="hint">Age will be auto-calculated<span id="ageDisplay" class="age-display" style="display: none;"></span></span>
                    </div>
                    <div class="form-group">
                        <label>Sex <span class="required">*</span></label>
                        <select name="sex" required>
                            <option value="">Select</option>
                            <option value="Male" <?php echo e(old('sex') == 'Male' ? 'selected' : ''); ?>>Male</option>
                            <option value="Female" <?php echo e(old('sex') == 'Female' ? 'selected' : ''); ?>>Female</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Owner Information -->
            <div class="form-section">
                <div class="section-title">Owner Information</div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Owner Name <span class="required">*</span></label>
                        <input type="text" name="owner_name" value="<?php echo e(old('owner_name')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Owner Contact <span class="required">*</span></label>
                        <input type="tel" name="owner_contact" value="<?php echo e(old('owner_contact')); ?>" required placeholder="09XX-XXX-XXXX">
                    </div>
                </div>

                <div class="form-row full">
                    <div class="form-group">
                        <label>Address <span class="required">*</span></label>
                        <textarea name="address" required><?php echo e(old('address')); ?></textarea>
                        <span class="hint">House No., Street, Barangay, City</span>
                    </div>
                </div>
            </div>

            <!-- Optional Information -->
            <div class="form-section">
                <div class="section-title">Additional Information</div>
                <div class="optional-section">
                    <div class="form-row full">
                        <div class="form-group">
                            <label style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                                <input type="checkbox" name="is_required" value="1" <?php echo e(old('is_required') ? 'checked' : ''); ?> style="width: auto; cursor: pointer;">
                                <span style="color: #374151; font-weight: 500;">Mark as Requiring Special Care</span>
                            </label>
                            <span class="hint">Check this if the pet requires special care or attention</span>
                        </div>
                    </div>
                    <div class="form-row full">
                        <div class="form-group">
                            <label style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" name="privacy_consent" value="1" <?php echo e(old('privacy_consent') ? 'checked' : ''); ?> style="width: auto; cursor: pointer;">
                                <span style="color: #374151; font-weight: 500;">I consent to data privacy and processing</span>
                            </label>
                            <span class="hint">Please review our <a href="#" style="color: #14b8a6; text-decoration: underline;">privacy policy</a> before consent</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <button type="button" class="btn-secondary" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn-primary">Register Pet</button>
            </div>
        </form>
    </div>

    <script>
        // Form Progress Tracking
        const petForm = document.getElementById('petForm');
        const requiredFields = ['pet_name', 'species_id', 'breed', 'birthdate', 'sex', 'owner_name', 'owner_contact', 'address'];
        const submitBtn = document.querySelector('.btn-primary');
        
        function areAllRequiredFieldsFilled() {
            return requiredFields.every(fieldName => {
                const field = document.querySelector(`[name="${fieldName}"]`);
                return field && field.value.trim() !== '';
            });
        }

        function updateSubmitButton() {
            if (areAllRequiredFieldsFilled()) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            } else {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
                submitBtn.style.cursor = 'not-allowed';
            }
        }
        
        function updateFormProgress() {
            let completed = 0;
            requiredFields.forEach(fieldName => {
                const field = document.querySelector(`[name="${fieldName}"]`);
                if (field && field.value.trim()) {
                    completed++;
                }
            });
            
            const percent = Math.round((completed / requiredFields.length) * 100);
            document.getElementById('progressFill').style.width = percent + '%';
            document.getElementById('progressPercent').textContent = percent;
            
            // Update submit button state
            updateSubmitButton();
        }

        // Real-time validation
        function validateField(field) {
            let isValid = true;
            let errorMsg = '';

            if (field.name === 'pet_name') {
                isValid = field.value.trim().length > 0;
                errorMsg = 'Pet name is required';
            } else if (field.name === 'species_id') {
                isValid = field.value !== '';
                errorMsg = 'Please select a species';
            } else if (field.name === 'breed') {
                isValid = field.value.trim().length > 0;
                errorMsg = 'Breed is required';
            } else if (field.name === 'birthdate') {
                isValid = field.value !== '';
                errorMsg = 'Birthdate is required';
            } else if (field.name === 'sex') {
                isValid = field.value !== '';
                errorMsg = 'Please select sex';
            } else if (field.name === 'owner_name') {
                isValid = field.value.trim().length > 0;
                errorMsg = 'Owner name is required';
            } else if (field.name === 'owner_contact') {
                isValid = /^\d{10,}$/.test(field.value.replace(/\D/g, '')) || field.value === '';
                errorMsg = 'Please enter a valid contact number';
            } else if (field.name === 'address') {
                isValid = field.value.trim().length > 0;
                errorMsg = 'Address is required';
            }

            // Remove existing error
            const existingError = field.parentElement.querySelector('.field-error-inline');
            if (existingError) existingError.remove();

            if (!isValid && field.value !== '') {
                field.classList.add('field-invalid');
                field.classList.remove('field-valid');
                const errorEl = document.createElement('span');
                errorEl.className = 'field-error-inline';
                errorEl.textContent = errorMsg;
                field.parentElement.appendChild(errorEl);
            } else if (isValid && field.value !== '') {
                field.classList.add('field-valid');
                field.classList.remove('field-invalid');
            } else {
                field.classList.remove('field-valid', 'field-invalid');
            }

            return isValid || field.value === '';
        }

        // Add validation to all form fields
        document.querySelectorAll('input[required], select[required]').forEach(field => {
            field.addEventListener('blur', function() {
                validateField(this);
                updateFormProgress();
            });
            field.addEventListener('input', function() {
                updateFormProgress();
            });
            field.addEventListener('change', function() {
                updateFormProgress();
            });
        });

        // Species characteristics loader
        async function loadSpeciesCharacteristics() {
            const speciesId = document.getElementById('speciesSelect').value;
            const characteristicsDiv = document.getElementById('speciesCharacteristics');
            const characteristicsContent = document.getElementById('characteristicsContent');
            
            if (!speciesId) {
                characteristicsDiv.style.display = 'none';
                return;
            }
            
            try {
                const response = await fetch(`/api/species/${speciesId}`);
                const data = await response.json();
                
                if (data && data.characteristics) {
                    let characteristics = data.characteristics;
                    if (typeof characteristics === 'string') {
                        characteristics = JSON.parse(characteristics);
                    }
                    
                    let html = '';
                    for (const [key, value] of Object.entries(characteristics)) {
                        html += `<div style="margin-bottom: 6px;"><strong>${key}:</strong> ${value}</div>`;
                    }
                    
                    characteristicsContent.innerHTML = html;
                    characteristicsDiv.style.display = 'block';
                } else {
                    characteristicsDiv.style.display = 'none';
                }
            } catch (error) {
                console.error('Error loading species characteristics:', error);
                characteristicsDiv.style.display = 'none';
            }
            updateFormProgress();
        }

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
            updateFormProgress();
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
                fetch(`/api/pets/search?q=${encodeURIComponent(query)}`)
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
                    <strong>${patient.pet_name} (${patient.species})</strong>
                    <small>ID: ${patient.patient_id} | Owner: ${patient.owner_name} | Birthdate: ${patient.birthdate}</small>
                </div>
            `).join('');
            resultsContainer.classList.add('active');
        }
        
        function fillPatientData(patient) {
            // Fill form fields
            document.querySelector('[name="pet_name"]').value = patient.pet_name || '';
            document.querySelector('[name="species_id"]').value = patient.species_id || '';
            document.querySelector('[name="breed"]').value = patient.breed || '';
            document.querySelector('[name="color"]').value = patient.color || '';
            document.getElementById('birthdate').value = patient.birthdate || '';
            document.querySelector('[name="sex"]').value = patient.sex || '';
            document.querySelector('[name="owner_name"]').value = patient.owner_name || '';
            document.querySelector('[name="owner_contact"]').value = patient.owner_contact || '';
            document.querySelector('[name="address"]').value = patient.address || '';
            
            // Trigger age calculation and load characteristics
            birthdateInput.dispatchEvent(new Event('change'));
            loadSpeciesCharacteristics();
            
            // Hide results
            resultsContainer.classList.remove('active');
            searchInput.value = '';
            
            // Show duplicate warning
            duplicateWarning.style.display = 'flex';
            duplicateMessage.innerHTML = `This pet already exists: <strong>${patient.pet_name}</strong>. Data has been auto-filled. You can edit or cancel if this is a duplicate.`;
            
            updateFormProgress();
        }
        
        // Check for duplicate pet names on typing
        const petNameInput = document.querySelector('[name="pet_name"]');
        const ownerNameInput = document.querySelector('[name="owner_name"]');
        let duplicateTimeout;
        
        function checkDuplicate() {
            clearTimeout(duplicateTimeout);
            const petName = petNameInput.value.trim();
            const ownerName = ownerNameInput.value.trim();
            
            if (petName.length < 2) {
                return;
            }
            
            duplicateTimeout = setTimeout(() => {
                fetch(`/api/pets/search?q=${encodeURIComponent(petName)}`)
                    .then(res => res.json())
                    .then(patients => {
                        const exactMatch = patients.find(p => 
                            p.pet_name.toLowerCase() === petName.toLowerCase()
                        );
                        
                        if (exactMatch && duplicateWarning.style.display === 'none') {
                            duplicateWarning.style.display = 'flex';
                            duplicateMessage.innerHTML = `A pet with this name may already exist: <strong>${exactMatch.pet_name}</strong> (${exactMatch.patient_id}). Please verify before submitting.`;
                        }
                    });
            }, 500);
        }
        
        petNameInput.addEventListener('input', checkDuplicate);
        
        // Form submission with validation
        petForm.addEventListener('submit', function(e) {
            // Double-check all required fields are filled
            if (!areAllRequiredFieldsFilled()) {
                e.preventDefault();
                alert('Please fill in all required fields (marked with *)');
                
                // Scroll to first empty required field
                requiredFields.forEach(fieldName => {
                    const field = document.querySelector(`[name="${fieldName}"]`);
                    if (field && !field.value.trim()) {
                        field.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        field.focus();
                        return;
                    }
                });
                return false;
            }

            let allValid = true;
            
            document.querySelectorAll('input[required], select[required]').forEach(field => {
                const isValid = validateField(field);
                if (!isValid) {
                    allValid = false;
                    if (!field.offsetParent) field.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });

            if (!allValid) {
                e.preventDefault();
                alert('Please fix validation errors before submitting.');
                return false;
            }
        });
        
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
                window.location.href = '/pets';
            }
        }
        
        // Initialize on page load
        window.addEventListener('DOMContentLoaded', function() {
            // Initially disable submit button
            updateSubmitButton();
            
            // Add listeners to update button state on all required fields
            requiredFields.forEach(fieldName => {
                const field = document.querySelector(`[name="${fieldName}"]`);
                if (field) {
                    field.addEventListener('input', updateFormProgress);
                    field.addEventListener('change', updateFormProgress);
                    field.addEventListener('blur', updateFormProgress);
                }
            });
            
            // Load characteristics if species is already selected
            if (document.getElementById('speciesSelect').value) {
                loadSpeciesCharacteristics();
            }
            // Initial progress update
            updateFormProgress();
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\Lei\Capstone1-web\resources\views/pets/create.blade.php ENDPATH**/ ?>