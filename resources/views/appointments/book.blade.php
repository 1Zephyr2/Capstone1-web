<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - CareSync</title>
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
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: white;
            border: none;
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
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
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

        .automation-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ecfdf5;
            color: #047857;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
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
                <span class="automation-pill"><i class="bi bi-stars"></i> Automation Assist</span>
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
                    <h2><i class="bi bi-person"></i> Patient Information</h2>
                </div>

                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="patient_id">Patient <span class="required">*</span></label>
                        <select name="patient_id" id="patient_id" class="form-control" required>
                            <option value="">Select patient</option>
                            @foreach($patients as $patientItem)
                                <option value="{{ $patientItem->id }}"
                                    data-patient-id="{{ $patientItem->patient_id }}"
                                    data-contact="{{ $patientItem->contact_number ?? '' }}"
                                    data-age="{{ $patientItem->age }}"
                                    data-sex="{{ $patientItem->sex }}"
                                    {{ (old('patient_id') ?? optional($patient)->id) == $patientItem->id ? 'selected' : '' }}>
                                    {{ $patientItem->full_name }} ({{ $patientItem->patient_id }})
                                </option>
                            @endforeach
                        </select>
                        <div class="helper-text">Auto-fills patient summary and checks for conflicts.</div>
                    </div>
                </div>

                <div id="patientSummary" class="patient-summary hidden">
                    <div class="summary-card">
                        <div class="summary-label">Patient ID</div>
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
                        <div class="summary-label">Contact</div>
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
                            <option value="Immunization" {{ old('service_type') == 'Immunization' ? 'selected' : '' }}>Immunization</option>
                            <option value="Prenatal Care" {{ old('service_type') == 'Prenatal Care' ? 'selected' : '' }}>Prenatal Care</option>
                            <option value="General Checkup" {{ old('service_type') == 'General Checkup' ? 'selected' : '' }}>General Checkup</option>
                            <option value="Family Planning" {{ old('service_type') == 'Family Planning' ? 'selected' : '' }}>Family Planning</option>
                            <option value="Referral" {{ old('service_type') == 'Referral' ? 'selected' : '' }}>Referral</option>
                            <option value="Other" {{ old('service_type') == 'Other' ? 'selected' : '' }}>Other</option>
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
                        <label for="health_worker">Health Worker</label>
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

            <div id="immunization-fields" class="form-card hidden">
                <div class="card-header">
                    <h2><i class="bi bi-shield-check"></i> Immunization Details</h2>
                </div>
                <div class="service-grid">
                    <div class="form-group">
                        <label for="vaccine_name">Vaccine Name</label>
                        <input type="text" name="vaccine_name" id="vaccine_name" class="form-control" value="{{ old('vaccine_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="dose_number">Dose Number</label>
                        <input type="number" name="dose_number" id="dose_number" class="form-control" min="1" value="{{ old('dose_number') }}">
                    </div>
                </div>
            </div>

            <div id="prenatal-fields" class="form-card hidden">
                <div class="card-header">
                    <h2><i class="bi bi-heart-pulse"></i> Prenatal Care Details</h2>
                </div>
                <div class="service-grid">
                    <div class="form-group">
                        <label for="gestational_age">Gestational Age (weeks)</label>
                        <input type="number" name="gestational_age" id="gestational_age" class="form-control" min="0" value="{{ old('gestational_age') }}">
                    </div>
                    <div class="form-group">
                        <label for="presentation">Presentation</label>
                        <input type="text" name="presentation" id="presentation" class="form-control" value="{{ old('presentation') }}">
                    </div>
                </div>
            </div>

            <div id="familyplanning-fields" class="form-card hidden">
                <div class="card-header">
                    <h2><i class="bi bi-people"></i> Family Planning Details</h2>
                </div>
                <div class="form-group full-width">
                    <label for="fp_method">FP Method</label>
                    <input type="text" name="fp_method" id="fp_method" class="form-control" value="{{ old('fp_method') }}">
                </div>
            </div>

            <div id="referral-fields" class="form-card hidden">
                <div class="card-header">
                    <h2><i class="bi bi-hospital"></i> Referral Details</h2>
                </div>
                <div class="service-grid">
                    <div class="form-group">
                        <label for="referred_to">Referred To</label>
                        <input type="text" name="referred_to" id="referred_to" class="form-control" value="{{ old('referred_to') }}">
                    </div>
                    <div class="form-group">
                        <label for="referral_urgency">Urgency</label>
                        <select name="referral_urgency" id="referral_urgency" class="form-control">
                            <option value="">Select Urgency</option>
                            <option value="routine" {{ old('referral_urgency') == 'routine' ? 'selected' : '' }}>Routine</option>
                            <option value="urgent" {{ old('referral_urgency') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            <option value="emergency" {{ old('referral_urgency') == 'emergency' ? 'selected' : '' }}>Emergency</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('appointments.index') }}" class="btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn-primary">
                    <i class="bi bi-check-circle"></i> Create Appointment
                </button>
            </div>
        </form>
    </div>

    <script>
        const patientSelect = document.getElementById('patient_id');
        const patientSummary = document.getElementById('patientSummary');
        const summaryPatientId = document.getElementById('summaryPatientId');
        const summaryAge = document.getElementById('summaryAge');
        const summarySex = document.getElementById('summarySex');
        const summaryContact = document.getElementById('summaryContact');
        const appointmentDate = document.getElementById('appointment_date');
        const conflictWarning = document.getElementById('conflictWarning');
        const conflictDetails = document.getElementById('conflictDetails');
        const reminderSms = document.getElementById('reminder_sms');
        const reminderEmail = document.getElementById('reminder_email');
        const reminderTiming = document.getElementById('reminder_timing');
        const reminderSummaryText = document.getElementById('reminderSummaryText');
        const reminderNote = document.getElementById('reminder_note');
        const notesField = document.getElementById('notes');
        const appointmentForm = document.getElementById('appointmentForm');

        const immunizationFields = document.getElementById('immunization-fields');
        const prenatalFields = document.getElementById('prenatal-fields');
        const familyPlanningFields = document.getElementById('familyplanning-fields');
        const referralFields = document.getElementById('referral-fields');
        const serviceType = document.getElementById('service_type');

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const updatePatientSummary = () => {
            const selectedOption = patientSelect.options[patientSelect.selectedIndex];
            if (!selectedOption || !selectedOption.value) {
                patientSummary.classList.add('hidden');
                return;
            }

            summaryPatientId.textContent = selectedOption.dataset.patientId || '--';
            summaryAge.textContent = selectedOption.dataset.age ? `${selectedOption.dataset.age} yrs` : '--';
            summarySex.textContent = selectedOption.dataset.sex || '--';
            summaryContact.textContent = selectedOption.dataset.contact || 'N/A';
            patientSummary.classList.remove('hidden');
        };

        const updateReminderSummary = () => {
            const channels = [];
            if (reminderSms.checked) channels.push('SMS');
            if (reminderEmail.checked) channels.push('Email');

            const timingLabel = reminderTiming.options[reminderTiming.selectedIndex].text;
            const channelText = channels.length ? channels.join(' + ') : 'No reminders';
            reminderSummaryText.textContent = `${channelText} reminders scheduled ${timingLabel.toLowerCase()}.`;
        };

        const updateServiceFields = () => {
            const selected = serviceType.value;
            immunizationFields.classList.toggle('hidden', selected !== 'Immunization');
            prenatalFields.classList.toggle('hidden', selected !== 'Prenatal Care');
            familyPlanningFields.classList.toggle('hidden', selected !== 'Family Planning');
            referralFields.classList.toggle('hidden', selected !== 'Referral');
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
                    conflictDetails.textContent = `This patient already has ${data.count} appointment(s) on this date: ${list}.`;
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
            updatePatientSummary();
            checkConflicts();
        });

        appointmentDate.addEventListener('change', checkConflicts);
        reminderSms.addEventListener('change', updateReminderSummary);
        reminderEmail.addEventListener('change', updateReminderSummary);
        reminderTiming.addEventListener('change', updateReminderSummary);
        serviceType.addEventListener('change', updateServiceFields);

        updatePatientSummary();
        updateReminderSummary();
        updateServiceFields();
        checkConflicts();
    </script>
</body>
</html>
