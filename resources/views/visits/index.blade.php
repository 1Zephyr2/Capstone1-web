<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Visits - VaxLog</title>
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
            max-width: 1400px;
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
            background: #f59e0b;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
            color: white;
        }
        .header-logo-text {
            font-size: 18px;
            font-weight: 600;
            color: #047857;
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
            font-size: 28px;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
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
                    <div class="header-logo-text">VaxLog</div>
                </a>
                <a href="{{ route('dashboard') }}" class="btn-back">← Back</a>
                <h1>📋 Today's Visits</h1>
            </div>
            <p style="color: #6b7280; font-size: 14px;">{{ now()->format('l, F j, Y') }}</p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-value">{{ $visits->count() }}</div>
                <div class="stat-label">Total Visits Today</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $visits->where('service_type', 'General Checkup')->count() }}</div>
                <div class="stat-label">General Checkups</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $visits->where('service_type', 'Immunization')->count() }}</div>
                <div class="stat-label">Immunizations</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $visits->where('service_type', 'Prenatal')->count() }}</div>
                <div class="stat-label">Prenatal Care</div>
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
                                🕐 {{ \Carbon\Carbon::parse($visit->visit_time)->format('h:i A') }}
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
                    <span class="health-worker-label">👨‍⚕️ Health Worker:</span>
                    <span class="health-worker-name" id="modalHealthWorkerName"></span>
                </div>
            </div>
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
                `🕐 ${visitTime.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true })}`;

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
    </script>
</body>
</html>
