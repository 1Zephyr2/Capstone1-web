<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - PAWser</title>
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
            padding: 40px;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 28px 36px;
            border-radius: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 36px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .header:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .header h1 {
            font-size: 32px;
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.02em;
        }

        .header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .back-btn {
            background: white;
            color: #111827;
            border: 1px solid #111827;
            padding: 12px 28px;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .back-btn:hover {
            background: #f0fdfa;
            border-color: #14b8a6;
            color: #14b8a6;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.4);
        }

        .form-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            margin-bottom: 24px;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .required {
            color: #dc2626;
        }

        .form-control {
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .helper-text {
            font-size: 12px;
            color: #6b7280;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 14px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .alert-warning {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
        }

        .alert-info {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e3a8a;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 12px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 22px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
            border: none;
            padding: 12px 22px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }



        .patient-summary {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-top: 12px;
        }

        .summary-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px;
            font-size: 13px;
        }

        .summary-label {
            color: #6b7280;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 4px;
        }

        .summary-value {
            font-weight: 700;
            color: #111827;
        }

        .hidden {
            display: none;
        }

        .search-wrapper {
            position: relative;
            margin-bottom: 8px;
        }

        .search-input {
            width: 100%;
            padding: 13px 14px 13px 44px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.2s;
            background: white;
        }

        .search-input:focus {
            border-color: #10b981;
            outline: none;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12);
        }

        .search-input.has-value {
            border-color: #10b981;
            background: #f0fdf4;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 17px;
            pointer-events: none;
            transition: color 0.2s;
        }

        .search-input:focus ~ .search-icon,
        .search-wrapper:focus-within .search-icon { color: #10b981; }

        .search-clear {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            background: #e5e7eb;
            border: none;
            border-radius: 50%;
            width: 22px; height: 22px;
            font-size: 14px;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            line-height: 1;
        }
        .search-clear:hover { background: #d1d5db; color: #111827; }
        .search-clear.visible { display: flex; }

        .autocomplete-results {
            position: absolute;
            top: calc(100% + 4px);
            left: 0; right: 0;
            background: white;
            border: 1.5px solid #e5e7eb;
            border-radius: 14px;
            max-height: 360px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
            box-shadow: 0 12px 32px rgba(0,0,0,0.13);
        }
        .autocomplete-results.active { display: block; }

        .ac-hint {
            padding: 10px 16px 6px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: #9ca3af;
        }
        .ac-owner-group {
            border-top: 1px solid #f3f4f6;
        }
        .ac-owner-group:first-of-type { border-top: none; }
        .ac-owner-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 16px 5px;
            background: #f9fafb;
        }
        .ac-owner-avatar {
            width: 28px; height: 28px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            border-radius: 50%;
            color: white;
            font-size: 12px;
            font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .ac-owner-name {
            font-size: 13px; font-weight: 700; color: #374151;
        }
        .ac-owner-contact {
            font-size: 12px; color: #9ca3af; margin-left: auto;
        }
        .ac-pet-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 9px 16px 9px 52px;
            cursor: pointer;
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.15s;
        }
        .ac-pet-item:last-child { border-bottom: none; }
        .ac-pet-item:hover,
        .ac-pet-item.kb-focus { background: #f0fdf4; }
        .ac-pet-item.selected { background: #ecfdf5; }
        .ac-pet-icon {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
            color: #059669;
            flex-shrink: 0;
        }
        .ac-pet-info { flex: 1; min-width: 0; }
        .ac-pet-name { font-size: 14px; font-weight: 700; color: #111827; }
        .ac-pet-meta { font-size: 12px; color: #6b7280; margin-top: 1px; }
        .ac-pet-badge {
            font-size: 11px; font-weight: 600;
            padding: 2px 8px; border-radius: 10px;
            background: #ede9fe; color: #5b21b6;
        }

        .no-results {
            padding: 24px 16px;
            text-align: center;
            color: #9ca3af;
            font-size: 13px;
        }
        .no-results i { font-size: 28px; display: block; margin-bottom: 8px; }

        /* Selected pet card */
        .selected-pet-card {
            display: none;
            background: #f0fdf4;
            border: 1.5px solid #6ee7b7;
            border-radius: 12px;
            padding: 14px 16px;
            margin-top: 8px;
            align-items: center;
            gap: 14px;
        }
        .selected-pet-card.visible { display: flex; }
        .selected-pet-photo {
            width: 44px; height: 44px;
            border-radius: 10px;
            background: linear-gradient(135deg, #a7f3d0, #6ee7b7);
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            color: #065f46;
            flex-shrink: 0;
        }
        .selected-pet-details { flex: 1; min-width: 0; }
        .selected-pet-name {
            font-size: 16px; font-weight: 800; color: #065f46; line-height: 1.2;
        }
        .selected-pet-sub {
            font-size: 13px; color: #059669; margin-top: 2px;
        }
        .selected-pet-owner {
            margin-top: 6px;
            display: flex; gap: 16px; flex-wrap: wrap;
        }
        .selected-pet-owner span {
            font-size: 12px; color: #374151;
            display: flex; align-items: center; gap: 4px;
        }
        .selected-pet-owner i { color: #6b7280; }
        .selected-change-btn {
            background: white;
            border: 1.5px solid #6ee7b7;
            color: #059669;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.15s;
        }
        .selected-change-btn:hover { background: #dcfce7; }

        .checkbox-group {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .checkbox-group label {
            font-weight: 500;
            display: inline-flex;
            gap: 8px;
            align-items: center;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        @media (max-width: 900px) {
            body {
                padding: 20px;
            }

            .form-grid,
            .patient-summary,
            .service-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }

            .header-actions {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="bi bi-calendar-plus"></i> Book Appointment</h1>
            <div class="header-actions">
                <a href="{{ route('appointments.index') }}" class="back-btn">← Back to Appointments</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul style="margin-left: 18px; margin-top: 6px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST" id="appointmentForm">
            @csrf

            <div class="form-card">
                <div class="card-header">
                    <h2><i class="bi bi-person"></i> Pet Information</h2>
                </div>

                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="patient_search">Pet / Owner <span class="required">*</span></label>
                        <div class="search-wrapper">
                            <i class="bi bi-search search-icon"></i>
                            <input type="text"
                                   id="patient_search"
                                   class="search-input"
                                   placeholder="Search by owner name, pet name, species, or breed..."
                                   autocomplete="off">
                            <button type="button" class="search-clear" id="searchClear" tabindex="-1">&times;</button>
                            <div id="autocomplete_results" class="autocomplete-results"></div>
                        </div>

                        {{-- hidden select keeps the real patient_id for form submission --}}
                        <select name="patient_id" id="patient_id" required style="display:none;">
                            <option value="">Select pet</option>
                            @foreach($patients as $patientItem)
                                <option value="{{ $patientItem->id }}"
                                    data-patient-id="{{ $patientItem->patient_id }}"
                                    data-contact="{{ $patientItem->owner_contact ?? '' }}"
                                    data-age="{{ $patientItem->age }}"
                                    data-sex="{{ $patientItem->sex }}"
                                    data-pet-name="{{ $patientItem->pet_name }}"
                                    data-species="{{ $patientItem->species }}"
                                    data-breed="{{ $patientItem->breed ?? '' }}"
                                    data-owner-name="{{ $patientItem->owner_name ?? '' }}"
                                    {{ (old('patient_id') ?? optional($patient)->id) == $patientItem->id ? 'selected' : '' }}>
                                    {{ $patientItem->full_name }} ({{ $patientItem->patient_id }})
                                </option>
                            @endforeach
                        </select>

                        {{-- Selected pet confirmation card --}}
                        <div class="selected-pet-card" id="selectedPetCard">
                            <div class="selected-pet-photo" id="selectedPetIcon"><i class="bi bi-heart-fill"></i></div>
                            <div class="selected-pet-details">
                                <div class="selected-pet-name" id="selectedPetName"></div>
                                <div class="selected-pet-sub" id="selectedPetSub"></div>
                                <div class="selected-pet-owner">
                                    <span><i class="bi bi-person-fill"></i> <span id="selectedOwnerName"></span></span>
                                    <span><i class="bi bi-telephone-fill"></i> <span id="selectedOwnerContact"></span></span>
                                </div>
                            </div>
                            <button type="button" class="selected-change-btn" id="changePetBtn">Change</button>
                        </div>

                        <div class="helper-text" id="searchHint">Type at least 2 characters &mdash; search by owner or pet name.</div>
                    </div>
                </div>

                <div id="patientSummary" class="patient-summary hidden">
                    <div class="summary-card">
                        <div class="summary-label">Pet Name</div>
                        <div class="summary-value" id="summaryPatientId">--</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-label">Age</div>
                        <div class="summary-value" id="summaryAge">--</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-label">Sex</div>
                        <div class="summary-value" id="summarySex">--</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-label">Owner Contact</div>
                        <div class="summary-value" id="summaryContact">--</div>
                    </div>
                </div>
            </div>

            <div id="conflictWarning" class="alert alert-warning hidden">
                <i class="bi bi-exclamation-diamond-fill"></i>
                <div>
                    <strong>Potential conflict detected.</strong>
                    <div id="conflictDetails" style="margin-top: 4px;"></div>
                </div>
            </div>

            <div class="form-card">
                <div class="card-header">
                    <h2><i class="bi bi-calendar-check"></i> Appointment Details</h2>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="appointment_date">Appointment Date <span class="required">*</span></label>
                        <input type="date" name="appointment_date" id="appointment_date" class="form-control"
                               value="{{ old('appointment_date', now()->format('Y-m-d')) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_time">Appointment Time <span class="required">*</span></label>
                        <input type="time" name="appointment_time" id="appointment_time" class="form-control"
                               value="{{ old('appointment_time') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="service_type">Service Type <span class="required">*</span></label>
                        <select name="service_type" id="service_type" class="form-control" required>
                            <option value="">Select Service</option>
                            <optgroup label="Grooming Services">
                                <option value="Bath & Dry" {{ old('service_type') == 'Bath & Dry' ? 'selected' : '' }}>Bath &amp; Dry</option>
                                <option value="Full Grooming" {{ old('service_type') == 'Full Grooming' ? 'selected' : '' }}>Full Grooming</option>
                                <option value="Haircut & Styling" {{ old('service_type') == 'Haircut & Styling' ? 'selected' : '' }}>Haircut &amp; Styling</option>
                                <option value="Nail Trimming" {{ old('service_type') == 'Nail Trimming' ? 'selected' : '' }}>Nail Trimming</option>
                                <option value="Ear Cleaning" {{ old('service_type') == 'Ear Cleaning' ? 'selected' : '' }}>Ear Cleaning</option>
                                <option value="Teeth Brushing" {{ old('service_type') == 'Teeth Brushing' ? 'selected' : '' }}>Teeth Brushing</option>
                                <option value="De-shedding Treatment" {{ old('service_type') == 'De-shedding Treatment' ? 'selected' : '' }}>De-shedding Treatment</option>
                                <option value="Flea & Tick Treatment" {{ old('service_type') == 'Flea & Tick Treatment' ? 'selected' : '' }}>Flea &amp; Tick Treatment</option>
                                <option value="Paw Treatment" {{ old('service_type') == 'Paw Treatment' ? 'selected' : '' }}>Paw Treatment</option>
                            </optgroup>
                            <optgroup label="Other Services">
                                <option value="Boarding Checkup" {{ old('service_type') == 'Boarding Checkup' ? 'selected' : '' }}>Boarding Checkup</option>
                                <option value="Follow-up" {{ old('service_type') == 'Follow-up' ? 'selected' : '' }}>Follow-up</option>
                                <option value="Other" {{ old('service_type') == 'Other' ? 'selected' : '' }}>Other</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="scheduled" {{ old('status', 'scheduled') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="no-show" {{ old('status') == 'no-show' ? 'selected' : '' }}>No-Show</option>
                        </select>
                    </div>
                    <div class="form-group full-width">
                        <label for="chief_complaint">Chief Complaint</label>
                        <textarea name="chief_complaint" id="chief_complaint" class="form-control" rows="3">{{ old('chief_complaint') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="health_worker">Veterinary Staff</label>
                        <input type="text" name="health_worker" id="health_worker" class="form-control"
                               value="{{ old('health_worker', auth()->user()->name ?? '') }}">
                    </div>
                    <div class="form-group full-width">
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="card-header">
                    <h2><i class="bi bi-bell"></i> Reminder Automation</h2>
                </div>

                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Reminder Channels</label>
                        <div class="checkbox-group">
                            <label><input type="checkbox" id="reminder_sms" checked> SMS reminder</label>
                            <label><input type="checkbox" id="reminder_email" checked> Email reminder</label>
                        </div>
                        <div class="helper-text">Defaults are pre-selected for faster booking.</div>
                    </div>
                    <div class="form-group">
                        <label for="reminder_timing">Reminder Timing</label>
                        <select id="reminder_timing" class="form-control">
                            <option value="24h" selected>24 hours before</option>
                            <option value="12h">12 hours before</option>
                            <option value="2h">2 hours before</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Include in Notes</label>
                        <label><input type="checkbox" id="reminder_note" checked> Add reminder plan to notes</label>
                    </div>
                </div>

                <div id="reminderSummary" class="alert alert-info" style="margin-top: 12px;">
                    <i class="bi bi-lightning-charge-fill"></i>
                    <div>
                        <strong>Automation summary:</strong>
                        <span id="reminderSummaryText">SMS + Email reminders scheduled 24 hours before.</span>
                    </div>
                </div>
            </div>



            <div class="actions">
                <a href="{{ route('appointments.index') }}" class="btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    Create Appointment
                </button>
            </div>
        </form>
    </div>

    <script>
        const patientSelect   = document.getElementById('patient_id');
        const patientSearch    = document.getElementById('patient_search');
        const autocompleteResults = document.getElementById('autocomplete_results');
        const searchClear      = document.getElementById('searchClear');
        const selectedPetCard  = document.getElementById('selectedPetCard');
        const changePetBtn     = document.getElementById('changePetBtn');
        const searchHint       = document.getElementById('searchHint');
        const patientSummary   = document.getElementById('patientSummary');
        const summaryPatientId = document.getElementById('summaryPatientId');
        const summaryAge       = document.getElementById('summaryAge');
        const summarySex       = document.getElementById('summarySex');
        const summaryContact   = document.getElementById('summaryContact');
        const appointmentDate  = document.getElementById('appointment_date');
        const conflictWarning  = document.getElementById('conflictWarning');
        const conflictDetails  = document.getElementById('conflictDetails');
        const reminderSms      = document.getElementById('reminder_sms');
        const reminderEmail    = document.getElementById('reminder_email');
        const reminderTiming   = document.getElementById('reminder_timing');
        const reminderSummaryText = document.getElementById('reminderSummaryText');
        const reminderNote     = document.getElementById('reminder_note');
        const notesField       = document.getElementById('notes');
        const appointmentForm  = document.getElementById('appointmentForm');
        const serviceType         = document.getElementById('service_type');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // ── Species icon helper (Bootstrap Icons) ───────────────────────
        function speciesIconClass(species) {
            const map = {
                dog:         'bi-heart-fill',
                cat:         'bi-heart-fill',
                rabbit:      'bi-heart-fill',
                bird:        'bi-feather',
                hamster:     'bi-heart-fill',
                'guinea pig':'bi-heart-fill',
                fish:        'bi-droplet-fill',
                reptile:     'bi-heart-fill',
            };
            return map[(species||'').toLowerCase()] || 'bi-heart-fill';
        }
        function speciesIconHtml(species) {
            return `<i class="bi ${speciesIconClass(species)}"></i>`;
        }

        // ── Show selected pet card ───────────────────────────────────────
        function showSelectedPet(p) {
            document.getElementById('selectedPetIcon').innerHTML  = speciesIconHtml(p.species);
            document.getElementById('selectedPetName').textContent  = p.pet_name || p.name || 'Unknown';
            document.getElementById('selectedPetSub').textContent   =
                [p.species, p.breed, p.age ? p.age + ' yrs' : '', p.sex].filter(Boolean).join(' · ');
            document.getElementById('selectedOwnerName').textContent    = p.owner_name || '—';
            document.getElementById('selectedOwnerContact').textContent = p.owner_contact || p.contact || '—';
            selectedPetCard.classList.add('visible');
            patientSearch.style.display = 'none';
            searchClear.classList.remove('visible');
            searchHint.style.display = 'none';
            autocompleteResults.classList.remove('active');
            // update old summary strip too
            summaryPatientId.textContent = p.pet_name || p.name || '--';
            summaryAge.textContent       = p.age ? p.age + ' yrs' : '--';
            summarySex.textContent       = p.sex || '--';
            summaryContact.textContent   = p.owner_contact || p.contact || 'N/A';
            patientSummary.classList.remove('hidden');
        }

        function clearSelection() {
            patientSelect.value = '';
            selectedPetCard.classList.remove('visible');
            patientSearch.style.display = '';
            patientSearch.value = '';
            searchClear.classList.remove('visible');
            searchHint.style.display = '';
            patientSearch.classList.remove('has-value');
            patientSummary.classList.add('hidden');
            conflictWarning.classList.add('hidden');
            patientSearch.focus();
        }

        changePetBtn.addEventListener('click', clearSelection);

        // ── Live API search ──────────────────────────────────────────────
        let searchTimeout = null;

        patientSearch.addEventListener('input', function() {
            const q = this.value.trim();
            searchClear.classList.toggle('visible', q.length > 0);
            this.classList.toggle('has-value', q.length > 0);

            if (q.length < 2) {
                autocompleteResults.classList.remove('active');
                return;
            }
            clearTimeout(searchTimeout);
            autocompleteResults.innerHTML = '<div class="ac-hint">Searching...</div>';
            autocompleteResults.classList.add('active');

            searchTimeout = setTimeout(() => {
                fetch(`/api/pets/search?term=${encodeURIComponent(q)}`, {
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                })
                .then(r => r.json())
                .then(patients => renderResults(patients, q))
                .catch(() => {
                    autocompleteResults.innerHTML = '<div class="no-results"><i class="bi bi-wifi-off"></i>Search unavailable</div>';
                });
            }, 280);
        });

        searchClear.addEventListener('click', clearSelection);

        // ── Render grouped results ───────────────────────────────────────
        function renderResults(patients, q) {
            if (!patients.length) {
                autocompleteResults.innerHTML = `<div class="no-results"><i class="bi bi-search"></i>No results for "${q}"<br><small style="font-size:11px;">Try owner name, pet name, species or breed</small></div>`;
                autocompleteResults.classList.add('active');
                return;
            }

            // Group by owner_name
            const groups = {};
            patients.forEach(p => {
                const owner = p.owner_name || 'Unknown Owner';
                if (!groups[owner]) groups[owner] = { contact: p.owner_contact || p.contact || '', pets: [] };
                groups[owner].pets.push(p);
            });

            let html = `<div class="ac-hint">${patients.length} result${patients.length>1?'s':''} found</div>`;
            Object.entries(groups).forEach(([owner, data]) => {
                html += `
                <div class="ac-owner-group">
                    <div class="ac-owner-header">
                        <div class="ac-owner-avatar">${owner.charAt(0).toUpperCase()}</div>
                        <span class="ac-owner-name">${owner}</span>
                        ${data.contact ? `<span class="ac-owner-contact"><i class="bi bi-telephone" style="margin-right:3px;"></i>${data.contact}</span>` : ''}
                    </div>
                    ${data.pets.map(p => `
                        <div class="ac-pet-item" data-pid="${p.id}">
                            <div class="ac-pet-icon">${speciesIconHtml(p.species)}</div>
                            <div class="ac-pet-info">
                                <div class="ac-pet-name">${p.pet_name || p.name}</div>
                                <div class="ac-pet-meta">${[p.species, p.breed, p.age ? p.age+' yrs' : '', p.sex].filter(Boolean).join(' · ')}</div>
                            </div>
                            <span class="ac-pet-badge">${p.species || '—'}</span>
                        </div>
                    `).join('')}
                </div>`;
            });

            autocompleteResults.innerHTML = html;
            autocompleteResults.classList.add('active');

            // Click handlers
            autocompleteResults.querySelectorAll('.ac-pet-item').forEach(el => {
                el.addEventListener('click', function() {
                    const pid = this.dataset.pid;
                    patientSelect.value = pid;
                    const p = patients.find(p => String(p.id) === String(pid));
                    if (p) showSelectedPet(p);
                    checkConflicts();
                });
            });
        }

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-wrapper')) autocompleteResults.classList.remove('active');
        });

        // Keyboard nav
        patientSearch.addEventListener('keydown', function(e) {
            const items = autocompleteResults.querySelectorAll('.ac-pet-item');
            let active = autocompleteResults.querySelector('.ac-pet-item.kb-focus');
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                const next = active ? (active.nextElementSibling?.classList.contains('ac-pet-item') ? active.nextElementSibling : items[0]) : items[0];
                if (active) active.classList.remove('kb-focus');
                if (next) { next.classList.add('kb-focus'); next.scrollIntoView({block:'nearest'}); }
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                const prev = active ? (active.previousElementSibling?.classList.contains('ac-pet-item') ? active.previousElementSibling : items[items.length-1]) : items[items.length-1];
                if (active) active.classList.remove('kb-focus');
                if (prev) { prev.classList.add('kb-focus'); prev.scrollIntoView({block:'nearest'}); }
            } else if (e.key === 'Enter') {
                if (active) { e.preventDefault(); active.click(); }
            } else if (e.key === 'Escape') {
                autocompleteResults.classList.remove('active');
            }
        });

        // Initialize if a patient was pre-selected (e.g. old() on validation fail)
        if (patientSelect.value) {
            const opt = patientSelect.options[patientSelect.selectedIndex];
            if (opt && opt.value) {
                showSelectedPet({
                    pet_name: opt.dataset.petName,
                    species:  opt.dataset.species,
                    breed:    opt.dataset.breed,
                    age:      opt.dataset.age,
                    sex:      opt.dataset.sex,
                    owner_name:    opt.dataset.ownerName || '',
                    owner_contact: opt.dataset.contact || '',
                });
            }
        }

        const updateReminderSummary = () => {
            const channels = [];
            if (reminderSms.checked) channels.push('SMS');
            if (reminderEmail.checked) channels.push('Email');

            const timingLabel = reminderTiming.options[reminderTiming.selectedIndex].text;
            const channelText = channels.length ? channels.join(' + ') : 'No reminders';
            reminderSummaryText.textContent = `${channelText} reminders scheduled ${timingLabel.toLowerCase()}.`;
        };

        const checkConflicts = async () => {
            const patientId = patientSelect.value;
            const dateValue = appointmentDate.value;

            if (!patientId || !dateValue) {
                conflictWarning.classList.add('hidden');
                return;
            }

            try {
                const response = await fetch(`{{ route('appointments.conflicts') }}?patient_id=${patientId}&date=${dateValue}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    }
                });

                if (!response.ok) {
                    conflictWarning.classList.add('hidden');
                    return;
                }

                const data = await response.json();
                if (data.count > 0) {
                    const list = data.appointments.map(app => `${app.time} (${app.status})`).join(', ');
                    conflictDetails.textContent = `This pet already has ${data.count} appointment(s) on this date: ${list}.`;
                    conflictWarning.classList.remove('hidden');
                } else {
                    conflictWarning.classList.add('hidden');
                }
            } catch (error) {
                conflictWarning.classList.add('hidden');
            }
        };

        appointmentForm.addEventListener('submit', () => {
            if (!reminderNote.checked) {
                return;
            }

            const channels = [];
            if (reminderSms.checked) channels.push('SMS');
            if (reminderEmail.checked) channels.push('Email');

            const timingLabel = reminderTiming.options[reminderTiming.selectedIndex].text;
            const reminderLine = `Reminder plan: ${channels.length ? channels.join(' + ') : 'None'} (${timingLabel}).`;

            if (notesField.value.trim().length === 0) {
                notesField.value = reminderLine;
                return;
            }

            if (!notesField.value.includes('Reminder plan:')) {
                notesField.value = `${notesField.value.trim()}\n${reminderLine}`;
            }
        });

        patientSelect.addEventListener('change', () => {
            checkConflicts();
        });

        appointmentDate.addEventListener('change', checkConflicts);
        reminderSms.addEventListener('change', updateReminderSummary);
        reminderEmail.addEventListener('change', updateReminderSummary);
        reminderTiming.addEventListener('change', updateReminderSummary);

        updateReminderSummary();
        checkConflicts();
    </script>
</body>
</html>
