<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients - Health Center</title>
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
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            background: white;
            padding: 24px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }
        .header-actions {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }
        .btn-new-patient {
            padding: 12px 24px;
            background: #047857;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-new-patient:hover {
            background: #065f46;
        }
        .btn-import {
            padding: 12px 24px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-import:hover {
            background: #2563eb;
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
        .search-bar {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }
        .search-wrapper {
            flex: 1;
            position: relative;
        }
        input[type="search"] {
            width: 100%;
            padding: 12px 40px 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 15px;
        }
        input[type="search"]:focus {
            outline: none;
            border-color: #047857;
        }
        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-primary {
            background: #047857;
            color: white;
        }
        .btn-primary:hover {
            background: #059669;
        }
        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }
        .btn-success {
            background: #10b981;
            color: white;
        }
        .btn-info {
            background: #3b82f6;
            color: white;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 16px;
        }
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .patients-table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background: #f9fafb;
        }
        th {
            padding: 14px 16px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        td {
            padding: 16px;
            border-top: 1px solid #e5e7eb;
        }
        tr:hover {
            background: #f9fafb;
        }
        .patient-id {
            font-family: monospace;
            color: #6b7280;
            font-size: 13px;
        }
        .patient-name {
            font-weight: 600;
            color: #111827;
        }
        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-male {
            background: #dbeafe;
            color: #1e40af;
        }
        .badge-female {
            background: #fce7f3;
            color: #9f1239;
        }
        .actions {
            display: flex;
            gap: 8px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }
        .empty-state svg {
            width: 64px;
            height: 64px;
            margin-bottom: 16px;
            opacity: 0.3;
        }
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 8px;
        }
        .autocomplete-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            margin-top: 4px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            max-height: 300px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
        }
        .autocomplete-results.show {
            display: block;
        }
        .autocomplete-item {
            padding: 12px 16px;
            cursor: pointer;
            border-bottom: 1px solid #f3f4f6;
        }
        .autocomplete-item:hover {
            background: #f9fafb;
        }
        .autocomplete-item:last-child {
            border-bottom: none;
        }
        .autocomplete-item .name {
            font-weight: 600;
            color: #111827;
        }
        .autocomplete-item .details {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }
        
        /* Visit Modal Styles */
        .visit-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            overflow-y: auto;
        }
        .visit-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .visit-modal-content {
            background: white;
            border-radius: 8px;
            max-width: 800px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .visit-modal-header {
            background: #047857;
            color: white;
            padding: 20px 24px;
            border-radius: 8px 8px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .visit-modal-header h2 {
            margin: 0;
            font-size: 20px;
        }
        .modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
            padding: 0;
            width: 32px;
            height: 32px;
            line-height: 1;
        }
        .visit-modal-body {
            padding: 24px;
        }
        .modal-patient-info {
            background: #f0fdf4;
            padding: 16px;
            border-radius: 6px;
            margin-bottom: 24px;
            border-left: 4px solid #047857;
        }
        .modal-patient-info h3 {
            color: #047857;
            margin: 0 0 8px 0;
            font-size: 16px;
        }
        .modal-patient-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 8px;
            font-size: 13px;
            color: #374151;
        }
        .modal-section-title {
            font-size: 15px;
            font-weight: 600;
            color: #374151;
            margin: 20px 0 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
        }
        .modal-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }
        .modal-form-row.full {
            grid-template-columns: 1fr;
        }
        .modal-form-group {
            display: flex;
            flex-direction: column;
        }
        .modal-form-group label {
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }
        .modal-form-group input,
        .modal-form-group select,
        .modal-form-group textarea {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }
        .modal-form-group textarea {
            min-height: 80px;
            resize: vertical;
        }
        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        .btn-modal-cancel {
            padding: 10px 20px;
            background: #6b7280;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-modal-cancel:hover {
            background: #4b5563;
        }
        .btn-modal-submit {
            padding: 10px 20px;
            background: #047857;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-modal-submit:hover {
            background: #065f46;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-top">
                <button onclick="goBack()" class="btn-back">← Back</button>
                <h1>Patient List</h1>
            </div>
            
            <div class="header-actions">
                <a href="{{ route('patients.create') }}" class="btn-new-patient">
                    ➕ Register New Patient
                </a>
                <a href="{{ route('patients.import.form') }}" class="btn-import">
                    📥 Import from CSV
                </a>
            </div>
            
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="search-bar">
                <div class="search-wrapper">
                    <input 
                        type="search" 
                        id="patientSearch" 
                        placeholder="Search by name, patient ID, or contact number..."
                        autocomplete="off"
                    >
                    <span class="search-icon">🔍</span>
                    <div id="autocompleteResults" class="autocomplete-results"></div>
                </div>
                <div style="display: flex; gap: 8px;">
                    <a href="{{ route('patients.import.form') }}" class="btn" style="background: #3b82f6; color: white;">📥 Import</a>
                    <a href="{{ route('patients.create') }}" class="btn btn-primary">+ New Patient</a>
                </div>
            </div>
        </div>

        <div class="patients-table">
            @if($patients->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Contact</th>
                        <th>Last Visit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                    <tr>
                        <td class="patient-id">{{ $patient->patient_id }}</td>
                        <td class="patient-name">{{ $patient->full_name }}</td>
                        <td>{{ $patient->age }} yrs</td>
                        <td>
                            <span class="badge badge-{{ strtolower($patient->sex) }}">
                                {{ $patient->sex }}
                            </span>
                        </td>
                        <td>{{ $patient->contact_number ?: '-' }}</td>
                        <td>
                            @if($patient->visits->first())
                                {{ $patient->visits->first()->visit_date->format('M d, Y') }}
                            @else
                                <span style="color: #9ca3af;">No visits</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('patients.show', $patient) }}" class="btn btn-info btn-sm">View</a>
                                <button onclick="openVisitModal({{ $patient->id }}, '{{ $patient->full_name }}', '{{ $patient->patient_id }}', {{ $patient->age }}, '{{ $patient->sex }}')" class="btn btn-success btn-sm">+ Visit</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="pagination">
                {{ $patients->links() }}
            </div>
            @else
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3>No patients found</h3>
                <p>Start by registering a new patient</p>
            </div>
            @endif
        </div>
    </div>

    <script>
        // Type-ahead search functionality
        const searchInput = document.getElementById('patientSearch');
        const autocompleteResults = document.getElementById('autocompleteResults');
        let searchTimeout;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const term = this.value.trim();

            if (term.length < 2) {
                autocompleteResults.classList.remove('show');
                return;
            }

            searchTimeout = setTimeout(() => {
                fetch(`/api/patients/search?term=${encodeURIComponent(term)}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(patients => {
                    if (patients.length === 0) {
                        autocompleteResults.innerHTML = '<div class="autocomplete-item">No patients found</div>';
                    } else {
                        autocompleteResults.innerHTML = patients.map(patient => `
                            <div class="autocomplete-item" onclick="window.location.href='/patients/${patient.id}'">
                                <div class="name">${patient.name}</div>
                                <div class="details">${patient.patient_id} • ${patient.age} yrs • ${patient.sex} ${patient.contact ? '• ' + patient.contact : ''}</div>
                            </div>
                        `).join('');
                    }
                    autocompleteResults.classList.add('show');
                })
                .catch(error => console.error('Search error:', error));
            }, 300);
        });

        // Close autocomplete when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !autocompleteResults.contains(e.target)) {
                autocompleteResults.classList.remove('show');
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

        // Visit Modal Functions
        function openVisitModal(patientId, patientName, patientIdCode, age, sex) {
            document.getElementById('visitModal').classList.add('active');
            document.getElementById('modalPatientName').textContent = patientName;
            document.getElementById('modalPatientId').textContent = patientIdCode;
            document.getElementById('modalPatientAge').textContent = age;
            document.getElementById('modalPatientSex').textContent = sex;
            document.getElementById('visitPatientId').value = patientId;
        }

        function closeVisitModal() {
            document.getElementById('visitModal').classList.remove('active');
            document.getElementById('visitForm').reset();
        }

        // Auto-calculate BMI
        function calculateBMI() {
            const weight = parseFloat(document.getElementById('modalWeight').value);
            const height = parseFloat(document.getElementById('modalHeight').value) / 100; // convert cm to m
            
            if (weight > 0 && height > 0) {
                const bmi = (weight / (height * height)).toFixed(1);
                document.getElementById('modalBMI').textContent = bmi;
            } else {
                document.getElementById('modalBMI').textContent = '-';
            }
        }

        // Close modal when clicking outside
        document.getElementById('visitModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeVisitModal();
            }
        });
    </script>

    <!-- Visit Modal -->
    <div id="visitModal" class="visit-modal">
        <div class="visit-modal-content">
            <div class="visit-modal-header">
                <h2>📋 Record Patient Visit</h2>
                <button class="modal-close" onclick="closeVisitModal()">×</button>
            </div>
            <div class="visit-modal-body">
                <div class="modal-patient-info">
                    <h3 id="modalPatientName"></h3>
                    <div class="modal-patient-details">
                        <div><strong>ID:</strong> <span id="modalPatientId"></span></div>
                        <div><strong>Age:</strong> <span id="modalPatientAge"></span> years</div>
                        <div><strong>Sex:</strong> <span id="modalPatientSex"></span></div>
                    </div>
                </div>

                <form id="visitForm" action="{{ route('visits.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="patient_id" id="visitPatientId">

                    <div class="modal-section-title">Visit Information</div>
                    
                    <div class="modal-form-row">
                        <div class="modal-form-group">
                            <label>Service Type <span style="color: #ef4444;">*</span></label>
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
                        <div class="modal-form-group">
                            <label>Health Worker</label>
                            <input type="text" name="health_worker" placeholder="Name of health worker">
                        </div>
                    </div>

                    <div class="modal-form-row full">
                        <div class="modal-form-group">
                            <label>Chief Complaint</label>
                            <textarea name="chief_complaint" placeholder="Patient's main concern or symptoms..."></textarea>
                        </div>
                    </div>

                    <div class="modal-section-title">Vital Signs</div>

                    <div class="modal-form-row">
                        <div class="modal-form-group">
                            <label>Blood Pressure</label>
                            <input type="text" name="blood_pressure" placeholder="120/80" pattern="\d{2,3}/\d{2,3}">
                        </div>
                        <div class="modal-form-group">
                            <label>Temperature (°C)</label>
                            <input type="number" name="temperature" step="0.1" min="30" max="45" placeholder="36.5">
                        </div>
                    </div>

                    <div class="modal-form-row">
                        <div class="modal-form-group">
                            <label>Pulse Rate (bpm)</label>
                            <input type="number" name="pulse_rate" step="1" min="30" max="200" placeholder="75">
                        </div>
                        <div class="modal-form-group">
                            <label>Weight (kg)</label>
                            <input type="number" name="weight" id="modalWeight" step="0.1" min="0" max="500" placeholder="65.5" oninput="calculateBMI()">
                        </div>
                    </div>

                    <div class="modal-form-row">
                        <div class="modal-form-group">
                            <label>Height (cm)</label>
                            <input type="number" name="height" id="modalHeight" step="0.1" min="0" max="300" placeholder="165" oninput="calculateBMI()">
                        </div>
                        <div class="modal-form-group">
                            <label>BMI</label>
                            <input type="text" readonly style="background: #f9fafb;" value="-" id="modalBMI">
                        </div>
                    </div>

                    <div class="modal-form-row full">
                        <div class="modal-form-group">
                            <label>Notes / Recommendations</label>
                            <textarea name="notes" placeholder="Additional notes, treatment, or recommendations..."></textarea>
                        </div>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-modal-cancel" onclick="closeVisitModal()">Cancel</button>
                        <button type="submit" class="btn-modal-submit">Save Visit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
