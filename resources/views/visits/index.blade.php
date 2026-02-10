<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Visits - CareSync</title>
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
            max-width: 1400px;
            margin: 0 auto;
        }
        .header {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 28px;
            border-radius: 16px;
            margin-bottom: 24px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .header:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }
        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 12px;
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
        .header-logo-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #047857 0%, #059669 100%);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
            color: white;
            box-shadow: 0 2px 6px rgba(4, 120, 87, 0.3);
        }
        .header-logo-text {
            font-size: 18px;
            font-weight: 600;
            color: #047857;
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
        h1 {
            color: #047857;
            margin: 0;
            flex: 1;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 24px;
            border-radius: 14px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }
        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #047857;
        }
        .stat-label {
            color: #6b7280;
            font-size: 14px;
            margin-top: 4px;
        }
        .visits-container {
            display: grid;
            gap: 20px;
        }
        .visit-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e5e7eb;
            border-left: 4px solid #047857;
            transition: all 0.2s;
            cursor: pointer;
        }
        .visit-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateY(-2px);
            border-left-color: #059669;
        }
        .visit-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .visit-summary-left {
            flex: 1;
        }
        .visit-summary-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .click-hint {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 4px;
        }
        
        /* Modal Styles */
        .visit-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .visit-modal.active {
            display: flex;
        }
        .visit-modal-content {
            background: white;
            border-radius: 12px;
            max-width: 800px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        .visit-modal-header {
            padding: 24px;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
            border-radius: 12px 12px 0 0;
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 28px;
            color: #6b7280;
            cursor: pointer;
            padding: 0;
            line-height: 1;
            transition: color 0.2s;
        }
        .modal-close:hover {
            color: #111827;
        }
        .visit-modal-body {
            padding: 24px;
        }
        .modal-patient-header {
            margin-bottom: 20px;
        }
        .visit-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }
        .visit-patient {
            flex: 1;
        }
        .patient-name {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }
        .patient-info {
            display: flex;
            gap: 16px;
            color: #6b7280;
            font-size: 14px;
        }
        .visit-time {
            color: #6b7280;
            font-size: 14px;
        }
        .service-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            margin-top: 8px;
        }
        .service-general { background: #dbeafe; color: #1e40af; }
        .service-immunization { background: #fef3c7; color: #92400e; }
        .service-prenatal { background: #fce7f3; color: #9f1239; }
        .service-other { background: #e5e7eb; color: #374151; }
        .vital-signs {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
        }
        .vital-item {
            display: flex;
            flex-direction: column;
        }
        .vital-label {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 2px;
        }
        .vital-value {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
        }
        .complaint {
            margin-top: 12px;
            padding: 12px;
            background: #f9fafb;
            border-radius: 6px;
        }
        .complaint-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
            margin-bottom: 4px;
        }
        .complaint-text {
            color: #374151;
            font-size: 14px;
        }
        .health-worker {
            margin-top: 12px;
            padding: 10px 12px;
            background: #ecfdf5;
            border-radius: 6px;
            border-left: 3px solid #10b981;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .health-worker-label {
            font-size: 13px;
            color: #047857;
            font-weight: 600;
        }
        .health-worker-name {
            font-size: 13px;
            color: #065f46;
        }
        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #6b7280;
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .empty-state svg {
            width: 64px;
            height: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #374151;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-top">
                <a href="{{ route('dashboard') }}" class="header-logo">
                    <div class="header-logo-icon">V</div>
                    <img src="/images/systemlogo.png" alt="CareSync" style="height: 35px; object-fit: contain;">
                </a>
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('dashboard') }}" class="btn-back">← Back</a>
                    <button onclick="openAppointmentsCalendar()" class="btn-calendar" style="padding: 8px 16px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.3); transition: all 0.2s; display: flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 6px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(16, 185, 129, 0.3)'">
                        <i class="bi bi-calendar3"></i> View Calendar
                    </button>
                </div>
                <h1><i class="bi bi-clipboard2-check"></i> Today's Visits</h1>
            </div>
            <p style="color: #6b7280; font-size: 14px;">{{ now()->format('l, F j, Y') }}</p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-value" id="totalVisitsToday">0</div>
                <div class="stat-label">Total Visits Today</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="totalAbsentToday">0</div>
                <div class="stat-label">Rescheduled Today</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="generalCheckupsToday">0</div>
                <div class="stat-label">General Checkups</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="immunizationsToday">0</div>
                <div class="stat-label">Immunizations</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="prenatalCareToday">0</div>
                <div class="stat-label">Prenatal Care</div>
            </div>
        </div>

        <!-- Appointment Attendance Section -->
        <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #e5e7eb; padding-bottom: 12px;">
                <h2 style="color: #047857; font-size: 20px; margin: 0;"><i class="bi bi-calendar2-check"></i> Today's Appointments Attendance</h2>
                <div style="display: flex; gap: 12px; align-items: center;">
                    <button onclick="resetAllAttendance()" style="padding: 8px 16px; background: #6b7280; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 500; transition: all 0.2s;" onmouseover="this.style.background='#4b5563'" onmouseout="this.style.background='#6b7280'">
                        🔄 Reset All
                    </button>
                    <div id="currentDateDisplay" style="font-size: 14px; color: #6b7280;"></div>
                </div>
            </div>
            
            <div id="appointmentAttendanceList">
                <div style="text-align: center; padding: 40px; color: #9ca3af;">
                    <div style="font-size: 48px; margin-bottom: 16px;">⏳</div>
                    <div style="font-size: 16px; font-weight: 600; color: #6b7280;">Loading appointments...</div>
                </div>
            </div>
        </div>

        <div class="visits-container">
            @if($visits->count() > 0)
                @foreach($visits as $visit)
                <div class="visit-card" onclick="openVisitModal({{ $visit->id }})">
                    <div class="visit-summary">
                        <div class="visit-summary-left">
                            <div class="patient-name">{{ $visit->patient->full_name }}</div>
                            <div class="patient-info">
                                <span><strong>ID:</strong> {{ $visit->patient->patient_id }}</span>
                                <span><strong>Age:</strong> {{ $visit->patient->age }} years</span>
                                <span><strong>Sex:</strong> {{ $visit->patient->sex }}</span>
                            </div>
                            <div class="click-hint">Click to view full details</div>
                        </div>
                        <div class="visit-summary-right">
                            <span class="service-badge service-{{ strtolower(str_replace(' ', '-', $visit->service_type)) }}">
                                {{ $visit->service_type }}
                            </span>
                            <div class="visit-time">
                                <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($visit->visit_time)->format('h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3>No visits recorded today</h3>
                <p>Visit records will appear here as patients are seen</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Visit Details Modal -->
    <div id="visitModal" class="visit-modal">
        <div class="visit-modal-content">
            <div class="visit-modal-header">
                <div>
                    <h2 id="modalPatientName" style="margin: 0; color: #047857; font-size: 24px;"></h2>
                    <p id="modalPatientInfo" style="color: #6b7280; margin-top: 4px; font-size: 14px;"></p>
                </div>
                <button class="modal-close" onclick="closeVisitModal()">×</button>
            </div>
            <div class="visit-modal-body">
                <div class="modal-patient-header">
                    <div style="display: flex; gap: 12px; margin-bottom: 12px;">
                        <span id="modalServiceBadge" class="service-badge"></span>
                        <span id="modalVisitTime" style="color: #6b7280; font-size: 14px;"></span>
                    </div>
                </div>

                <div id="modalVitalSigns" class="vital-signs" style="margin-bottom: 20px;"></div>

                <div id="modalChiefComplaint" class="complaint" style="display: none;">
                    <div class="complaint-label">Chief Complaint:</div>
                    <div class="complaint-text" id="modalChiefComplaintText"></div>
                </div>

                <div id="modalNotes" class="complaint" style="display: none; margin-top: 16px;">
                    <div class="complaint-label">Notes/Recommendations:</div>
                    <div class="complaint-text" id="modalNotesText"></div>
                </div>

                <div id="modalHealthWorker" class="health-worker" style="display: none; margin-top: 16px;">
                    <span class="health-worker-label"><i class="bi bi-person-badge"></i> Health Worker:</span>
                    <span class="health-worker-name" id="modalHealthWorkerName"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Reschedule Modal -->
    <div id="rescheduleModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:2000;align-items:center;justify-content:center;">
        <div style="background:white;border-radius:12px;max-width:500px;width:90%;max-height:90vh;overflow-y:auto;box-shadow:0 20px 25px -5px rgba(0,0,0,0.3);">
            <div style="padding:24px;border-bottom:1px solid #e5e7eb;">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <h2 style="margin:0;color:#047857;font-size:20px;">🔄 Reschedule Appointment</h2>
                    <button onclick="closeRescheduleModal()" style="background:none;border:none;font-size:28px;color:#6b7280;cursor:pointer;padding:0;line-height:1;" onmouseover="this.style.color='#111827'" onmouseout="this.style.color='#6b7280'">&times;</button>
                </div>
                <p id="reschedulePatientName" style="margin:8px 0 0 0;color:#6b7280;font-size:14px;"></p>
            </div>
            <form id="rescheduleForm" method="POST" style="padding:24px;">
                @csrf
                @method('PUT')
                <input type="hidden" id="rescheduleAppointmentId" name="appointment_id">
                
                <div style="margin-bottom:20px;">
                    <label style="display:block;font-weight:500;color:#374151;margin-bottom:8px;font-size:14px;">Current Appointment</label>
                    <div style="padding:12px;background:#f9fafb;border-radius:6px;color:#6b7280;font-size:14px;">
                        <div id="currentAppointmentInfo"></div>
                    </div>
                </div>

                <div style="margin-bottom:20px;">
                    <label for="newAppointmentDate" style="display:block;font-weight:500;color:#374151;margin-bottom:8px;font-size:14px;">New Date <span style="color:#ef4444;">*</span></label>
                    <input type="date" id="newAppointmentDate" name="appointment_date" required style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:6px;font-size:14px;" min="{{ date('Y-m-d') }}">
                </div>

                <div style="margin-bottom:24px;">
                    <label for="newAppointmentTime" style="display:block;font-weight:500;color:#374151;margin-bottom:8px;font-size:14px;">New Time <span style="color:#ef4444;">*</span></label>
                    <input type="time" id="newAppointmentTime" name="appointment_time" required style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:6px;font-size:14px;">
                </div>

                <div style="display:flex;gap:12px;justify-content:flex-end;">
                    <button type="button" onclick="closeRescheduleModal()" style="padding:10px 20px;background:#e5e7eb;color:#374151;border:none;border-radius:6px;cursor:pointer;font-size:14px;font-weight:500;" onmouseover="this.style.background='#d1d5db'" onmouseout="this.style.background='#e5e7eb'">Cancel</button>
                    <button type="submit" style="padding:10px 20px;background:#047857;color:white;border:none;border-radius:6px;cursor:pointer;font-size:14px;font-weight:500;" onmouseover="this.style.background='#065f46'" onmouseout="this.style.background='#047857'">Confirm Reschedule</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const visits = @json($visits);

        function openVisitModal(visitId) {
            const visit = visits.find(v => v.id === visitId);
            if (!visit) return;

            // Set patient name and info
            document.getElementById('modalPatientName').textContent = visit.patient.full_name;
            document.getElementById('modalPatientInfo').textContent = 
                `ID: ${visit.patient.patient_id} • Age: ${visit.patient.age} years • Sex: ${visit.patient.sex}`;

            // Set service badge and time
            const serviceBadge = document.getElementById('modalServiceBadge');
            serviceBadge.textContent = visit.service_type;
            serviceBadge.className = `service-badge service-${visit.service_type.toLowerCase().replace(/ /g, '-')}`;
            
            const visitTime = new Date(visit.visit_time);
            document.getElementById('modalVisitTime').textContent = 
                visitTime.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });

            // Set vital signs
            const vitalSignsDiv = document.getElementById('modalVitalSigns');
            if (visit.vital_signs) {
                let vitalHTML = '';
                if (visit.vital_signs.blood_pressure) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Blood Pressure</div><div class="vital-value">${visit.vital_signs.blood_pressure}</div></div>`;
                }
                if (visit.vital_signs.temperature) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Temperature</div><div class="vital-value">${visit.vital_signs.temperature}°C</div></div>`;
                }
                if (visit.vital_signs.pulse_rate) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Pulse Rate</div><div class="vital-value">${visit.vital_signs.pulse_rate} bpm</div></div>`;
                }
                if (visit.vital_signs.weight) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Weight</div><div class="vital-value">${visit.vital_signs.weight} kg</div></div>`;
                }
                if (visit.vital_signs.height) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Height</div><div class="vital-value">${visit.vital_signs.height} cm</div></div>`;
                }
                vitalSignsDiv.innerHTML = vitalHTML;
                vitalSignsDiv.style.display = vitalHTML ? 'grid' : 'none';
            } else {
                vitalSignsDiv.style.display = 'none';
            }

            // Set chief complaint
            if (visit.chief_complaint) {
                document.getElementById('modalChiefComplaintText').textContent = visit.chief_complaint;
                document.getElementById('modalChiefComplaint').style.display = 'block';
            } else {
                document.getElementById('modalChiefComplaint').style.display = 'none';
            }

            // Set notes
            if (visit.notes) {
                document.getElementById('modalNotesText').textContent = visit.notes;
                document.getElementById('modalNotes').style.display = 'block';
            } else {
                document.getElementById('modalNotes').style.display = 'none';
            }

            // Set health worker
            if (visit.health_worker) {
                document.getElementById('modalHealthWorkerName').textContent = visit.health_worker;
                document.getElementById('modalHealthWorker').style.display = 'flex';
            } else {
                document.getElementById('modalHealthWorker').style.display = 'none';
            }

            // Show modal
            document.getElementById('visitModal').classList.add('active');
        }

        function closeVisitModal() {
            document.getElementById('visitModal').classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('visitModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVisitModal();
            }
        });

        // Appointment Attendance System - Real data from backend
        const todayAppointments = @json($todayAppointments ?? []);

        function loadTodayAppointments() {
            const appointments = todayAppointments;
            
            const container = document.getElementById('appointmentAttendanceList');
            
            if (appointments.length === 0) {
                container.innerHTML = '<div style="text-align:center;padding:40px;color:#9ca3af;"><div style="font-size:48px;margin-bottom:16px;"><i class="bi bi-calendar-x" style="font-size:48px;"></i></div><div style="font-size:16px;font-weight:600;color:#6b7280;">No appointments scheduled for today</div></div>';
            } else {
                container.innerHTML = '<div style="display:grid;gap:12px;">' + appointments.map(apt => 
                    '<div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:16px;display:flex;justify-content:space-between;align-items:center;" id="apt-' + apt.id + '">' +
                        '<div style="flex:1;">' +
                            '<div style="font-weight:600;color:#111827;font-size:15px;margin-bottom:4px;">' + apt.patient + '</div>' +
                            '<div style="display:flex;gap:12px;font-size:13px;color:#6b7280;"><span>' + apt.time + '</span><span>• ' + apt.type + '</span></div>' +
                        '</div>' +
                        '<div style="display:flex;gap:8px;align-items:center;">' +
                            '<div id="status-' + apt.id + '" style="min-width:100px;text-align:center;"></div>' +
                            '<div id="buttons-' + apt.id + '" style="display:flex;gap:8px;">' +
                                '<button onclick="markAppointmentAttendance(' + apt.id + ',\'attended\')" style="padding:8px 16px;background:#10b981;color:white;border:none;border-radius:6px;cursor:pointer;font-size:13px;font-weight:500;transition:all 0.2s;" onmouseover="this.style.background=\'#059669\'" onmouseout="this.style.background=\'#10b981\'">✓ Attended</button>' +
                                '<button onclick="openRescheduleModal(' + apt.id + ',\'' + apt.patient + '\',\'' + apt.date + '\',\'' + apt.time + '\')" style="padding:8px 16px;background:#f59e0b;color:white;border:none;border-radius:6px;cursor:pointer;font-size:13px;font-weight:500;transition:all 0.2s;" onmouseover="this.style.background=\'#d97706\'" onmouseout="this.style.background=\'#f59e0b\'">🔄 Re-schedule</button>' +
                            '</div>' +
                        '</div>' +
                    '</div>'
                ).join('') + '</div>';
                
                appointments.forEach(apt => {
                    const savedStatus = localStorage.getItem('apt-status-' + apt.id);
                    if (savedStatus) updateAppointmentStatus(apt.id, savedStatus);
                });
            }
        }

        function markAppointmentAttendance(aptId, status) {
            localStorage.setItem('apt-status-' + aptId, status);
            updateAppointmentStatus(aptId, status);
            updateVisitStats(); // Update stats when attendance is marked
        }

        function updateAppointmentStatus(aptId, status) {
            const statusDiv = document.getElementById('status-' + aptId);
            const buttonsDiv = document.getElementById('buttons-' + aptId);
            if (status === 'attended') {
                statusDiv.innerHTML = '<span style="display:inline-block;padding:6px 12px;background:#d1fae5;color:#065f46;border-radius:6px;font-size:13px;font-weight:600;">✓ Attended</span>';
                buttonsDiv.style.display = 'none';
            } else if (status === 'rescheduled') {
                statusDiv.innerHTML = '<span style="display:inline-block;padding:6px 12px;background:#fef3c7;color:#92400e;border-radius:6px;font-size:13px;font-weight:600;">🔄 Rescheduled</span>';
                buttonsDiv.style.display = 'none';
            }
        }

        function updateVisitStats() {
            console.log('=== Updating Visit Stats ===');
            const appointments = todayAppointments;
            console.log('Today\'s Appointments:', appointments.length);
            
            let totalAttended = 0;
            let totalRescheduled = 0;
            let generalCheckups = 0;
            let immunizations = 0;
            let prenatalCare = 0;
            
            appointments.forEach(apt => {
                const storageKey = 'apt-status-' + apt.id;
                const status = localStorage.getItem(storageKey);
                console.log('Checking appointment', apt.id, ':', storageKey, '=', status);
                
                if (status === 'attended') {
                    totalAttended++;
                    
                    // Count by type
                    if (apt.type.includes('General Checkup') || apt.type.includes('Checkup')) {
                        generalCheckups++;
                    } else if (apt.type.includes('Immunization') || apt.type.includes('Vaccination')) {
                        immunizations++;
                    } else if (apt.type.includes('Prenatal')) {
                        prenatalCare++;
                    }
                } else if (status === 'rescheduled') {
                    totalRescheduled++;
                }
            });
            
            console.log('Stats - Attended:', totalAttended, 'Rescheduled:', totalRescheduled, 'General:', generalCheckups, 'Immunizations:', immunizations, 'Prenatal:', prenatalCare);
            
            document.getElementById('totalVisitsToday').textContent = totalAttended;
            document.getElementById('totalAbsentToday').textContent = totalRescheduled;
            document.getElementById('generalCheckupsToday').textContent = generalCheckups;
            document.getElementById('immunizationsToday').textContent = immunizations;
            document.getElementById('prenatalCareToday').textContent = prenatalCare;
        }

        function resetAllAttendance() {
            if (confirm('Reset all attendance records? This will clear all attendance data and refresh both pages.')) {
                // Clear all localStorage items starting with 'apt-status-'
                Object.keys(localStorage).forEach(key => {
                    if (key.startsWith('apt-status-')) {
                        localStorage.removeItem(key);
                    }
                });
                // Reload the entire page to show cleared state
                window.location.reload();
            }
        }

        function openRescheduleModal(aptId, patientName, currentDate, currentTime) {
            document.getElementById('rescheduleAppointmentId').value = aptId;
            document.getElementById('reschedulePatientName').textContent = 'Patient: ' + patientName;
            document.getElementById('currentAppointmentInfo').innerHTML = 
                '<strong>' + currentDate + '</strong><br>' + currentTime;
            
            // Show modal
            const modal = document.getElementById('rescheduleModal');
            modal.style.display = 'flex';
        }

        function closeRescheduleModal() {
            document.getElementById('rescheduleModal').style.display = 'none';
            document.getElementById('rescheduleForm').reset();
        }

        // Handle reschedule form submission
        document.addEventListener('DOMContentLoaded', function() {
            const rescheduleForm = document.getElementById('rescheduleForm');
            if (rescheduleForm) {
                rescheduleForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const aptId = document.getElementById('rescheduleAppointmentId').value;
                    const newDate = document.getElementById('newAppointmentDate').value;
                    const newTime = document.getElementById('newAppointmentTime').value;
                    
                    // Format the time for display
                    const timeObj = new Date('2000-01-01 ' + newTime);
                    const formattedTime = timeObj.toLocaleTimeString('en-US', { 
                        hour: 'numeric', 
                        minute: '2-digit', 
                        hour12: true 
                    });
                    
                    // Format the date for display
                    const dateObj = new Date(newDate);
                    const formattedDate = dateObj.toLocaleDateString('en-US', { 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    });
                    
                    // Send reschedule request to backend
                    fetch(`/appointments/${aptId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            appointment_date: newDate,
                            appointment_time: newTime,
                            status: 'scheduled'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success || data.message) {
                            // Mark as rescheduled in local storage
                            localStorage.setItem('apt-status-' + aptId, 'rescheduled');
                            updateAppointmentStatus(aptId, 'rescheduled');
                            updateVisitStats();
                            
                            alert(`Appointment rescheduled successfully!\n\nNew Date: ${formattedDate}\nNew Time: ${formattedTime}`);
                            closeRescheduleModal();
                        } else {
                            alert('Failed to reschedule appointment. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while rescheduling. Please try again.');
                    });
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Update current date display
            const today = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('currentDateDisplay').textContent = today.toLocaleDateString('en-US', options);
            
            loadTodayAppointments();
            updateVisitStats(); // Count and update the stats!
        });

        // Appointments Calendar Modal Functions
        let appointmentsCalendarData = {};
        let currentCalendarMonth = new Date();

        function openAppointmentsCalendar() {
            document.getElementById('appointmentsCalendarModal').style.display = 'flex';
            document.getElementById('selectedDateAppointments').style.display = 'none';
            loadAppointmentsCalendar();
        }

        function closeAppointmentsCalendar() {
            document.getElementById('appointmentsCalendarModal').style.display = 'none';
        }

        function loadAppointmentsCalendar() {
            fetch('{{ route("appointments.calendar.data") }}')
                .then(response => response.json())
                .then(data => {
                    appointmentsCalendarData = data;
                    renderAppointmentsCalendar();
                })
                .catch(error => {
                    console.error('Error loading appointments:', error);
                });
        }

        function renderAppointmentsCalendar() {
            const year = currentCalendarMonth.getFullYear();
            const month = currentCalendarMonth.getMonth();
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const startingDayOfWeek = firstDay.getDay();
            const monthDays = lastDay.getDate();

            // Update header
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'];
            document.getElementById('calendarMonthYear').textContent = `${monthNames[month]} ${year}`;

            // Generate calendar grid
            let html = '<div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 8px; margin-top: 20px;">';
            
            // Day headers
            const dayHeaders = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            dayHeaders.forEach(day => {
                html += `<div style="text-align: center; font-weight: 600; color: #6b7280; padding: 8px; font-size: 12px;">${day}</div>`;
            });

            // Empty cells before first day
            for (let i = 0; i < startingDayOfWeek; i++) {
                html += '<div style="padding: 12px;"></div>';
            }

            // Days of month
            for (let day = 1; day <= monthDays; day++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const hasAppointments = appointmentsCalendarData[dateStr] && appointmentsCalendarData[dateStr].length > 0;
                const appointmentCount = hasAppointments ? appointmentsCalendarData[dateStr].length : 0;
                const isToday = dateStr === new Date().toISOString().split('T')[0];
                
                const style = `
                    padding: 12px;
                    text-align: center;
                    border-radius: 8px;
                    cursor: pointer;
                    background: ${hasAppointments ? 'linear-gradient(135deg, #10b981 0%, #059669 100%)' : (isToday ? '#f3f4f6' : 'white')};
                    color: ${hasAppointments ? 'white' : '#374151'};
                    font-weight: ${hasAppointments ? '700' : (isToday ? '600' : '400')};
                    border: ${isToday && !hasAppointments ? '2px solid #10b981' : 'none'};
                    transition: all 0.2s;
                    position: relative;
                `;
                
                html += `<div style="${style}" onclick="showDateAppointments('${dateStr}')" 
                    onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <div>${day}</div>
                    ${hasAppointments ? `<div style="font-size: 10px; margin-top: 2px;">${appointmentCount} apt${appointmentCount > 1 ? 's' : ''}</div>` : ''}
                </div>`;
            }

            html += '</div>';
            document.getElementById('calendarGrid').innerHTML = html;
        }

        function showDateAppointments(dateStr) {
            const appointments = appointmentsCalendarData[dateStr] || [];
            const displaySection = document.getElementById('selectedDateAppointments');
            const contentDiv = document.getElementById('selectedDateAppointmentsContent');

            const date = new Date(dateStr + 'T00:00:00');
            const formattedDate = date.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            
            let html = `
                <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 16px; border-radius: 8px; margin-bottom: 16px;">
                    <h3 style="margin: 0; font-size: 18px;">${formattedDate}</h3>
                    <p style="margin: 4px 0 0 0; font-size: 14px; opacity: 0.9;">${appointments.length} appointment${appointments.length > 1 ? 's' : ''}</p>
                </div>
            `;
            
            if (appointments.length === 0) {
                html += `
                    <div style="text-align: center; padding: 40px 20px; color: #6b7280; background: #f9fafb; border-radius: 8px;">
                        <i class="bi bi-calendar-x" style="font-size: 48px; color: #d1d5db; margin-bottom: 16px;"></i>
                        <p style="font-size: 16px; margin: 0;">No appointments scheduled for this date</p>
                    </div>
                `;
            } else {
                html += '<div style="max-height: 400px; overflow-y: auto;">';
            
            appointments.forEach(apt => {
                const statusColors = {
                    'scheduled': '#10b981',
                    'completed': '#3b82f6',
                    'cancelled': '#ef4444',
                    'no-show': '#f59e0b'
                };
                const statusColor = statusColors[apt.status] || '#6b7280';
                
                html += `
                    <div style="background: #f9fafb; padding: 16px; border-radius: 8px; margin-bottom: 12px; border-left: 4px solid ${statusColor};">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                            <div style="font-weight: 600; font-size: 16px; color: #111827;">${apt.patient}</div>
                            <div style="background: ${statusColor}; color: white; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; text-transform: uppercase;">
                                ${apt.status}
                            </div>
                        </div>
                        <div style="display: flex; gap: 16px; font-size: 14px; color: #6b7280;">
                            <div><i class="bi bi-clock"></i> ${apt.time}</div>
                            <div><i class="bi bi-heart-pulse"></i> ${apt.type}</div>
                        </div>
                    </div>
                `;
            });
            
                html += '</div>';
            }
            
            contentDiv.innerHTML = html;
            displaySection.style.display = 'block';
            
            // Scroll to appointments section smoothly
            setTimeout(() => {
                displaySection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
        }

        function changeCalendarMonth(direction) {
            currentCalendarMonth.setMonth(currentCalendarMonth.getMonth() + direction);
            renderAppointmentsCalendar();
            // Hide appointments section when changing months
            document.getElementById('selectedDateAppointments').style.display = 'none';
        }

        function closeDateAppointments() {
            document.getElementById('dateAppointmentsModal').style.display = 'none';
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const calModal = document.getElementById('appointmentsCalendarModal');
            const dateModal = document.getElementById('dateAppointmentsModal');
            if (event.target === calModal) {
                closeAppointmentsCalendar();
            }
            if (event.target === dateModal) {
                closeDateAppointments();
            }
        }
    </script>

    <!-- Appointments Calendar Modal -->
    <div id="appointmentsCalendarModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 10000; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: white; border-radius: 16px; max-width: 800px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
            <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 24px; border-radius: 16px 16px 0 0; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h2 style="margin: 0; font-size: 24px; font-weight: 700;">📅 Appointments Calendar</h2>
                    <p style="margin: 4px 0 0 0; font-size: 14px; opacity: 0.9;">View appointments by date</p>
                </div>
                <button onclick="closeAppointmentsCalendar()" style="background: rgba(255,255,255,0.2); border: none; color: white; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; font-size: 20px; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">×</button>
            </div>
            <div style="padding: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <button onclick="changeCalendarMonth(-1)" style="background: #f3f4f6; border: none; color: #374151; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">
                        ← Previous
                    </button>
                    <h3 id="calendarMonthYear" style="margin: 0; font-size: 18px; font-weight: 700; color: #111827;"></h3>
                    <button onclick="changeCalendarMonth(1)" style="background: #f3f4f6; border: none; color: #374151; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">
                        Next →
                    </button>
                </div>
                <div id="calendarGrid"></div>
                <div style="margin-top: 20px; padding: 16px; background: #f9fafb; border-radius: 8px; display: flex; gap: 16px; align-items: center; font-size: 13px; color: #6b7280;">
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <div style="width: 16px; height: 16px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 4px;"></div>
                        <span>Has Appointments</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <div style="width: 16px; height: 16px; background: white; border: 2px solid #10b981; border-radius: 4px;"></div>
                        <span>Today</span>
                    </div>
                </div>
                
                <!-- Appointments Display Section -->
                <div id="selectedDateAppointments" style="margin-top: 24px; display: none;">
                    <div style="border-top: 2px solid #e5e7eb; padding-top: 20px;">
                        <div id="selectedDateAppointmentsContent"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Appointments Details Modal -->
    <div id="dateAppointmentsModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 10001; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: white; border-radius: 16px; max-width: 600px; width: 100%; max-height: 90vh; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
            <div style="padding: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <button onclick="closeDateAppointments(); openAppointmentsCalendar();" style="background: #f3f4f6; border: none; color: #374151; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px; transition: all 0.2s;" onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">
                        ← Back to Calendar
                    </button>
                    <button onclick="closeDateAppointments()" style="background: transparent; border: none; color: #6b7280; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; font-size: 24px; transition: all 0.2s;" onmouseover="this.style.background='#f3f4f6'; this.style.color='#111827'" onmouseout="this.style.background='transparent'; this.style.color='#6b7280'">×</button>
                </div>
                <div id="dateAppointmentsContent"></div>
            </div>
        </div>
    </div>
</body>
</html>
