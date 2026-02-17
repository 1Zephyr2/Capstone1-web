<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Visits - VetCare</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap');

        :root {
            --bg: #f5f7fb;
            --bg-alt: #eef2ff;
            --card: #ffffff;
            --text: #111827;
            --muted: #6b7280;
            --line: #e5e7eb;
            --primary: #2563eb;
            --primary-strong: #1d4ed8;
            --accent: #16a34a;
            --accent-strong: #15803d;
            --shadow-sm: 0 4px 14px rgba(15, 23, 42, 0.08);
            --shadow-lg: 0 20px 40px rgba(15, 23, 42, 0.12);
            --radius: 14px;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Manrope', sans-serif;
            background: linear-gradient(135deg, var(--bg) 0%, var(--bg-alt) 100%);
            padding: 20px;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            color: var(--text);
        }

        body::before,
        body::after {
            content: '';
            position: fixed;
            z-index: -1;
            border-radius: 50%;
        }

        body::before {
            width: 420px;
            height: 420px;
            top: -140px;
            right: -120px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, rgba(37, 99, 235, 0) 70%);
        }

        body::after {
            width: 360px;
            height: 360px;
            bottom: -160px;
            left: -100px;
            background: radial-gradient(circle, rgba(22, 163, 74, 0.16) 0%, rgba(22, 163, 74, 0) 70%);
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        .header {
            background: var(--card);
            padding: 24px;
            border-radius: var(--radius);
            margin-bottom: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
            transition: all 0.3s ease;
            animation: pageEnter 0.5s ease;
        }
        
        .header:hover {
            box-shadow: var(--shadow-lg);
        }
        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 12px;
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-actions {
            margin-left: auto;
            display: flex;
            gap: 10px;
        }
        .header-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: inherit;
            transition: opacity 0.2s;
        }
        .header-logo:hover {
            opacity: 0.8;
        }
        .header-logo-text {
            font-size: 18px;
            font-weight: 600;
            color: #047857;
        }
        .btn-back {
            padding: 10px 16px;
            background: white;
            color: var(--text);
            border: 1px solid var(--line);
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }
        
        .btn-back:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-1px);
        }
        h1 {
            color: var(--text);
            margin: 0;
            flex: 1;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        .stat-card,
        .stat-item {
            background: var(--card);
            padding: 22px;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover,
        .stat-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        .stat-value {
            font-size: 30px;
            font-weight: 800;
            color: var(--primary);
        }
        .stat-label {
            color: var(--muted);
            font-size: 13px;
            margin-top: 6px;
        }
        .visits-container {
            display: grid;
            gap: 20px;
        }
        .visit-card {
            background: var(--card);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
            border-left: 4px solid var(--primary);
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .visit-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
            border-left-color: var(--accent);
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
        .service-vaccination { background: #fef3c7; color: #92400e; }
        .service-breeding { background: #fce7f3; color: #9f1239; }
        .service-surgery { background: #fee2e2; color: #991b1b; }
        .service-wellness { background: #d1fae5; color: #065f46; }
        .service-dental { background: #e0e7ff; color: #3730a3; }
        .service-emergency { background: #fee2e2; color: #991b1b; }
        .service-other { background: #f3f4f6; color: #374151; }
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
            color: var(--muted);
            background: var(--card);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
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
            color: #1f2937;
        }

        @keyframes pageEnter {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- CALENDAR MODAL - SYNCHRONIZED WITH DASHBOARD -->
    <div id="visitsCalendarModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 10000; align-items: center; justify-content: center;" onclick="closeCalendarModal(event)">
        <div style="background: white; border-radius: 12px; max-width: 750px; width: 90%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);" onclick="event.stopPropagation()">
            <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 20px; border-radius: 12px 12px 0 0; display: flex; justify-content: space-between; align-items: center;">
                <h2 style="margin: 0; color: white; font-size: 20px;"><i class="bi bi-calendar-week"></i> Appointments Calendar</h2>
                <button onclick="closeCalendarModal()" style="background: rgba(255,255,255,0.2); border: none; color: white; font-size: 24px; cursor: pointer; width: 36px; height: 36px; border-radius: 50%; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">×</button>
            </div>
            <div style="padding: 20px;">
                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <button onclick="visitsChangeMonth(-1)" style="padding: 8px 16px; background: #10b981; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">← Previous</button>
                        <h3 id="visitsCurrentMonth" style="margin: 0;">February 2026</h3>
                        <button onclick="visitsChangeMonth(1)" style="padding: 8px 16px; background: #10b981; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">Next →</button>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; margin-bottom: 8px;">
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Sun</div>
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Mon</div>
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Tue</div>
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Wed</div>
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Thu</div>
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Fri</div>
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Sat</div>
                    </div>
                    <div id="visitsCalendarDays" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px;"></div>
                </div>
                <div id="visitsSelectedDateInfo" style="display: none; padding: 20px; background: #f9fafb; border-radius: 8px; border: 2px solid #10b981;">
                    <h3 id="visitsSelectedDateTitle" style="margin: 0 0 16px 0; color: #111827;"></h3>
                    <div id="visitsAppointmentsList"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn-back" style="margin-bottom: 16px;">← Back to Dashboard</a>
        <div class="header">
            <div class="header-top">
                <div class="header-left">
                    <a href="{{ route('dashboard') }}" class="header-logo">
                        <img src="/images/systemlogo.png" alt="VetCare" style="height: 35px; object-fit: contain;">
                    </a>
                    <h1><i class="bi bi-clipboard2-check"></i> Today's Visits</h1>
                </div>
                <div class="header-actions">
                    <button onclick="openAppointmentsCalendar()" class="btn-calendar" style="padding: 8px 16px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.3); transition: all 0.2s; display: flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 6px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(16, 185, 129, 0.3)'">
                        <i class="bi bi-calendar3"></i> View Calendar
                    </button>
                </div>
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
                <div class="stat-label">Wellness Exams</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="vaccinationsToday">0</div>
                <div class="stat-label">Vaccinations</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="breedingConsultToday">0</div>
                <div class="stat-label">Breeding Consultations</div>
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
                    <span class="health-worker-label"><i class="bi bi-person-badge"></i> Veterinarian:</span>
                    <span class="health-worker-name" id="modalHealthWorkerName"></span>
                </div>
            </div>
        </div>
    </div>

    <script>
        const visitsData = @json($visits);
        const visits = visitsData.data || visitsData;

        function openVisitModal(visitId) {
            console.log('Opening modal for visit ID:', visitId);
            console.log('Available visits:', visits);
            const visit = visits.find(v => v.id === visitId);
            if (!visit) {
                console.error('Visit not found with ID:', visitId);
                return;
            }
            console.log('Found visit:', visit);

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
            const vitalSigns = visit.vital_signs || visit.vitalSigns;
            if (vitalSigns) {
                let vitalHTML = '';
                if (vitalSigns.blood_pressure) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Heart Rate</div><div class="vital-value">${vitalSigns.blood_pressure} bpm</div></div>`;
                }
                if (vitalSigns.temperature) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Temperature</div><div class="vital-value">${vitalSigns.temperature}°C</div></div>`;
                }
                if (vitalSigns.pulse_rate) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Pulse Rate</div><div class="vital-value">${vitalSigns.pulse_rate} bpm</div></div>`;
                }
                if (vitalSigns.weight) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Weight</div><div class="vital-value">${vitalSigns.weight} kg</div></div>`;
                }
                if (vitalSigns.height) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Height</div><div class="vital-value">${vitalSigns.height} cm</div></div>`;
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
                    <h2 style="margin: 0; font-size: 24px; font-weight: 700;">Appointments Calendar</h2>
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
    
    <!-- CALENDAR SYNCHRONIZATION SCRIPT - UNIFIED WITH DASHBOARD -->
    <script>
    (function() {
        // Get appointments from backend (same structure as dashboard)
        const VISITS_APPOINTMENTS = @json($appointments ?? []);
        let visitsCurrentDate = new Date();
        
        console.log('VISITS PAGE: Appointments loaded:', VISITS_APPOINTMENTS);
        
        // Open calendar modal
        window.openAppointmentsCalendar = function() {
            document.getElementById('visitsCalendarModal').style.display = 'flex';
            renderVisitsCalendar();
        };
        
        // Close calendar modal
        window.closeCalendarModal = function(event) {
            if (!event || event.target.id === 'visitsCalendarModal') {
                document.getElementById('visitsCalendarModal').style.display = 'none';
                document.getElementById('visitsSelectedDateInfo').style.display = 'none';
            }
        };
        
        // Change month
        window.visitsChangeMonth = function(delta) {
            visitsCurrentDate.setMonth(visitsCurrentDate.getMonth() + delta);
            renderVisitsCalendar();
        };
        
        // Select a date
        window.visitsSelectDate = function(dateStr) {
            const appointments = VISITS_APPOINTMENTS[dateStr] || [];
            const dateObj = new Date(dateStr + 'T00:00:00');
            const formatted = dateObj.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' });
            
            document.getElementById('visitsSelectedDateInfo').style.display = 'block';
            document.getElementById('visitsSelectedDateTitle').textContent = formatted;
            
            const list = document.getElementById('visitsAppointmentsList');
            
            if (appointments.length === 0) {
                list.innerHTML = '<div style="text-align: center; padding: 32px; color: #9ca3af;"><i class="bi bi-calendar-x" style="font-size: 48px; margin-bottom: 12px;"></i><div style="font-size: 16px; font-weight: 600;">No appointments scheduled</div></div>';
            } else {
                list.innerHTML = '<div style="padding: 12px; background: #10b981; color: white; border-radius: 6px; margin-bottom: 16px; font-weight: 600;"><i class="bi bi-check-circle"></i> ' + appointments.length + ' appointment(s) scheduled</div>';
                
                appointments.forEach(function(apt) {
                    // Check localStorage for attendance status
                    const statusKey = 'apt-status-' + apt.id;
                    const status = localStorage.getItem(statusKey);
                    
                    const div = document.createElement('div');
                    div.style.cssText = 'padding: 16px; background: white; border-radius: 8px; margin-bottom: 12px; border-left: 4px solid ' + (status === 'attended' ? '#10b981' : status === 'rescheduled' ? '#f59e0b' : '#3b82f6') + '; box-shadow: 0 1px 3px rgba(0,0,0,0.1);';
                    
                    let statusBadge = '';
                    if (status === 'attended') {
                        statusBadge = '<div style="background: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Attended</div>';
                    } else if (status === 'rescheduled') {
                        statusBadge = '<div style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Rescheduled</div>';
                    }
                    
                    div.innerHTML = '' +
                        '<div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">' +
                        '<div style="font-size: 16px; font-weight: 700; color: #111827;"><i class="bi bi-person-circle" style="color: #10b981; margin-right: 6px;"></i>' + apt.patient + '</div>' +
                        '<div style="display: flex; gap: 8px;">' +
                        statusBadge +
                        '<div style="background: #dbeafe; color: #1d4ed8; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase;">' + apt.type + '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div style="font-size: 14px; color: #6b7280; margin-bottom: 4px;"><i class="bi bi-clock" style="margin-right: 6px;"></i><strong>' + apt.time + '</strong></div>' +
                        (apt.status ? '<div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;"><i class="bi bi-info-circle" style="margin-right: 6px;"></i>Status: <span style="text-transform: capitalize; font-weight: 600;">' + apt.status + '</span></div>' : '') +
                        (apt.notes ? '<div style="margin-top: 12px; padding: 12px; background: #fef3c7; border-radius: 6px; font-size: 13px; color: #78350f;"><i class="bi bi-chat-left-text" style="margin-right: 6px;"></i>' + apt.notes + '</div>' : '');
                    list.appendChild(div);
                });
            }
        };
        
        // Render calendar
        function renderVisitsCalendar() {
            const year = visitsCurrentDate.getFullYear();
            const month = visitsCurrentDate.getMonth();
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            document.getElementById('visitsCurrentMonth').textContent = months[month] + ' ' + year;
            
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const daysInPrevMonth = new Date(year, month, 0).getDate();
            const today = new Date();
            
            const container = document.getElementById('visitsCalendarDays');
            container.innerHTML = '';
            
            // Previous month days
            for (let i = firstDay - 1; i >= 0; i--) {
                const day = daysInPrevMonth - i;
                const div = document.createElement('div');
                div.style.cssText = 'padding: 12px 8px; text-align: center; border-radius: 6px; color: #d1d5db; cursor: default;';
                div.textContent = day;
                container.appendChild(div);
            }
            
            // Current month days
            for (let day = 1; day <= daysInMonth; day++) {
                const dateStr = year + '-' + String(month + 1).padStart(2, '0') + '-' + String(day).padStart(2, '0');
                const hasApts = VISITS_APPOINTMENTS[dateStr] && VISITS_APPOINTMENTS[dateStr].length > 0;
                const isToday = today.getFullYear() === year && today.getMonth() === month && today.getDate() === day;
                
                const div = document.createElement('div');
                div.style.cssText = 'padding: 12px 8px; text-align: center; border-radius: 6px; cursor: pointer; transition: all 0.2s; position: relative;' +
                    (isToday ? 'background: #10b981; color: white; font-weight: 700;' : 'background: #f3f4f6; color: #111827;') +
                    (hasApts && !isToday ? 'border: 2px solid #10b981; font-weight: 600;' : '');
                
                div.textContent = day;
                
                if (hasApts) {
                    const dot = document.createElement('div');
                    dot.style.cssText = 'position: absolute; bottom: 4px; left: 50%; transform: translateX(-50%); width: 6px; height: 6px; background: ' + (isToday ? 'white' : '#10b981') + '; border-radius: 50%;';
                    div.appendChild(dot);
                }
                
                div.onclick = (function(ds) {
                    return function() {
                        window.visitsSelectDate(ds);
                    };
                })(dateStr);
                
                div.onmouseover = function() {
                    if (!isToday) this.style.background = '#e5e7eb';
                };
                div.onmouseout = function() {
                    if (!isToday) this.style.background = hasApts ? '#f3f4f6' : '#f3f4f6';
                };
                
                container.appendChild(div);
            }
            
            // Next month days
            const totalCells = firstDay + daysInMonth;
            const remainingCells = Math.ceil(totalCells / 7) * 7 - totalCells;
            for (let day = 1; day <= remainingCells; day++) {
                const div = document.createElement('div');
                div.style.cssText = 'padding: 12px 8px; text-align: center; border-radius: 6px; color: #d1d5db; cursor: default;';
                div.textContent = day;
                container.appendChild(div);
            }
            
            document.getElementById('visitsSelectedDateInfo').style.display = 'none';
        }
        
        // Listen for localStorage changes (sync with dashboard)
        window.addEventListener('storage', function(e) {
            if (e.key && e.key.startsWith('apt-status-')) {
                console.log('VISITS PAGE: Detected attendance change from dashboard, refreshing...');
                // Re-render if calendar is open
                if (document.getElementById('visitsCalendarModal').style.display === 'flex') {
                    const selectedDate = document.getElementById('visitsSelectedDateTitle').textContent;
                    if (selectedDate) {
                        renderVisitsCalendar();
                    }
                }
            }
        });
        
        // Notify dashboard of changes
        window.addEventListener('beforeunload', function() {
            localStorage.setItem('visits-page-updated', Date.now().toString());
        });
    })();
    </script>
</body>
</html>
