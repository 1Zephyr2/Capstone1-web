<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action Hub - PAWser</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap');

        :root {
            --bg: #f8fafc;
            --bg-alt: #f0f9ff;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #6b7280;
            --line: #e5e7eb;
            --primary: #14b8a6;
            --primary-strong: #0d9488;
            --accent: #06b6d4;
            --accent-strong: #0891b2;
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
            padding: 40px;
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
            width: 440px;
            height: 440px;
            top: -160px;
            right: -140px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, rgba(37, 99, 235, 0) 70%);
        }

        body::after {
            width: 360px;
            height: 360px;
            bottom: -160px;
            left: -120px;
            background: radial-gradient(circle, rgba(22, 163, 74, 0.16) 0%, rgba(22, 163, 74, 0) 70%);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: var(--card);
            padding: 24px 28px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 28px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border: 1px solid var(--line);
            transition: all 0.3s ease;
            animation: pageEnter 0.5s ease;
        }
        
        .header:hover {
            box-shadow: var(--shadow-lg);
        }

        .header h1 {
            font-size: 30px;
            font-weight: 800;
            color: var(--text);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            line-height: 1.1;
            row-gap: 8px;
            letter-spacing: -0.02em;
            max-width: 100%;
        }

        .refresh-indicator {
            font-size: 12px;
            color: #10B981;
            font-weight: normal;
            padding: 4px 12px;
            background: #ECFDF5;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            margin-top: 6px;
        }

        .refresh-dot {
            width: 8px;
            height: 8px;
            background: #10B981;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        .back-btn {
            background: white;
            color: var(--text);
            border: 1px solid var(--line);
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .page-actions {
            margin-bottom: 24px;
        }

        .back-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-1px);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--card);
            padding: 24px;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
            border-top: 3px solid var(--primary);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card h3 {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .stat-card .number {
            font-size: 30px;
            font-weight: 800;
            color: var(--primary);
        }

        .alerts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 24px;
        }

        .alert-card {
            background: var(--card);
            padding: 24px;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
            border-left: 4px solid var(--primary);
            transition: all 0.2s ease;
        }

        .alert-card:hover {
            box-shadow: var(--shadow-lg);
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

        .alert-card h2 {
            font-size: 18px;
            color: #047857;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
        }

        .alert-item {
            padding: 12px;
            border-left: 4px solid #FCD34D;
            background: #FFFBEB;
            margin-bottom: 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .alert-item:hover {
            transform: translateX(4px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .alert-item.danger {
            border-left-color: #EF4444;
            background: #FEF2F2;
        }

        .alert-item.info {
            border-left-color: #3B82F6;
            background: #EFF6FF;
        }

        .alert-item.success {
            border-left-color: #10B981;
            background: #ECFDF5;
        }

        .alert-item.success {
            border-left-color: #10B981;
            background: #ECFDF5;
        }

        .alert-item strong {
            display: block;
            margin-bottom: 4px;
            color: #111827;
        }

        .alert-item small {
            color: #6B7280;
            font-size: 13px;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #9CA3AF;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            margin-left: 8px;
        }

        .badge.warning {
            background: #FEF3C7;
            color: #92400E;
        }

        .badge.danger {
            background: #FEE2E2;
            color: #991B1B;
        }

        .badge.success {
            background: #ECFDF5;
            color: #047857;
            font-weight: 600;
        }

        .empty-state.success {
            color: #047857;
            font-weight: 500;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            animation: fadeIn 0.2s ease;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 480px;
            max-height: 75vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
        }

        .modal-header {
            background: linear-gradient(135deg, #047857 0%, #059669 100%);
            color: white;
            padding: 14px 18px;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
        }

        .modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 22px;
            cursor: pointer;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 16px;
        }

        .patient-detail-row {
            padding: 10px 12px;
            margin-bottom: 8px;
            background: #f9fafb;
            border-radius: 6px;
            border-left: 3px solid #047857;
        }

        .patient-detail-row label {
            display: block;
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 3px;
            font-weight: 600;
        }

        .patient-detail-row .value {
            font-size: 14px;
            color: #111827;
            font-weight: 500;
        }

        .modal-actions {
            display: flex;
            gap: 8px;
            padding: 12px 16px;
            border-top: 1px solid #e5e7eb;
            background: #f9fafb;
            border-radius: 0 0 12px 12px;
        }

        .modal-btn {
            flex: 1;
            padding: 9px 16px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        .modal-btn-primary {
            background: #047857;
            color: white;
        }

        .modal-btn-primary:hover {
            background: #059669;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(4, 120, 87, 0.3);
        }

        .modal-btn-secondary {
            background: white;
            color: #374151;
            border: 2px solid #e5e7eb;
        }

        .modal-btn-secondary:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .alert-item {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-actions">
            <a href="{{ route('dashboard') }}" class="back-btn">← Back to Dashboard</a>
        </div>
        <div class="header">
            <h1>
                Action Hub
                <span class="refresh-indicator">
                    <span class="refresh-dot"></span>
                    <span id="refresh-text">Live Updates</span>
                </span>
            </h1>
        </div>

        <!-- Quick Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Pets</h3>
                <div class="number">{{ $stats['total_patients'] }}</div>
            </div>
            <div class="stat-card" style="border-top-color:#f59e0b;">
                <h3>Today's Appointments</h3>
                <div class="number" style="color:#d97706;">{{ $stats['today_appointments'] }}</div>
            </div>
            <div class="stat-card" style="border-top-color:#8b5cf6;">
                <h3>Upcoming (7 Days)</h3>
                <div class="number" style="color:#7c3aed;">{{ $stats['upcoming_week'] }}</div>
            </div>
            <div class="stat-card" style="border-top-color:#ef4444;">
                <h3>No-Shows (7 Days)</h3>
                <div class="number" style="color:#dc2626;">{{ $stats['no_shows'] }}</div>
            </div>
            <div class="stat-card">
                <h3>Visits This Week</h3>
                <div class="number">{{ $stats['visits_this_week'] }}</div>
            </div>
        </div>

        <!-- Alerts and Automations -->
        <div class="alerts-grid">
            <!-- Incomplete Records -->
            <div class="alert-card">
                <h2><i class="bi bi-exclamation-triangle-fill"></i> Incomplete Pet Records<span class="badge warning">{{ $incompleteRecords->count() }}</span></h2>
                @forelse($incompleteRecords as $patient)
                    <div class="alert-item" onclick="showPatientModal({{ json_encode($patient) }}, 'incomplete')">
                        <strong>{{ $patient->pet_name ?? $patient->full_name }} ({{ $patient->patient_id }})</strong>
                        <small>
                            Missing:
                            @if(!$patient->owner_name) <span style="color:#ef4444;">Owner Name</span> @endif
                            @if(!$patient->owner_contact) <span style="color:#ef4444;">Owner Contact</span> @endif
                        </small>
                    </div>
                @empty
                    <div class="empty-state">All pet records are complete.</div>
                @endforelse
            </div>

            <!-- Today's Appointments -->
            <div class="alert-card" style="border-left-color:#f59e0b;">
                <h2 style="color:#d97706;"><i class="bi bi-calendar-check-fill"></i> Today's Appointments<span class="badge warning">{{ $todayAppointments->count() }}</span></h2>
                @forelse($todayAppointments as $appt)
                    <div class="alert-item {{ $appt->status === 'completed' ? 'success' : ($appt->status === 'cancelled' ? '' : '') }}"
                         style="border-left-color: {{ $appt->status === 'completed' ? '#10b981' : ($appt->status === 'cancelled' ? '#6b7280' : '#f59e0b') }}; background: {{ $appt->status === 'completed' ? '#ecfdf5' : ($appt->status === 'cancelled' ? '#f9fafb' : '#fffbeb') }};">
                        <strong>{{ $appt->patient->owner_name ?? 'Unknown Owner' }} &mdash; {{ $appt->patient->pet_name }}</strong>
                        <small>
                            <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($appt->appointment_time)->format('g:i A') }}
                            &nbsp;&bull;&nbsp; {{ $appt->service_type }}
                            &nbsp;&bull;&nbsp; <span style="text-transform:capitalize;">{{ $appt->status }}</span>
                            @if($appt->chief_complaint)
                                <br><i class="bi bi-chat-dots"></i> {{ $appt->chief_complaint }}
                            @endif
                        </small>
                    </div>
                @empty
                    <div class="empty-state"><i class="bi bi-calendar2-x" style="font-size:28px;display:block;margin-bottom:8px;"></i>No appointments scheduled for today.</div>
                @endforelse
            </div>

            <!-- Upcoming Appointments (next 7 days) -->
            <div class="alert-card" style="border-left-color:#8b5cf6;">
                <h2 style="color:#7c3aed;"><i class="bi bi-calendar-week-fill"></i> Upcoming This Week<span class="badge" style="background:#ede9fe;color:#5b21b6;">{{ $upcomingAppointments->count() }}</span></h2>
                @forelse($upcomingAppointments as $appt)
                    <div class="alert-item info">
                        <strong>{{ $appt->patient->owner_name ?? 'Unknown Owner' }} &mdash; {{ $appt->patient->pet_name }}</strong>
                        <small>
                            <i class="bi bi-calendar"></i> {{ $appt->appointment_date->format('M d, Y') }}
                            &nbsp;&bull;&nbsp; <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($appt->appointment_time)->format('g:i A') }}
                            <br><i class="bi bi-scissors"></i> {{ $appt->service_type }}
                        </small>
                    </div>
                @empty
                    <div class="empty-state"><i class="bi bi-calendar2-check" style="font-size:28px;display:block;margin-bottom:8px;"></i>No upcoming appointments this week.</div>
                @endforelse
            </div>

            <!-- Missed / No-Show Appointments -->
            <div class="alert-card" style="border-left-color:#ef4444;">
                <h2 style="color:#dc2626;"><i class="bi bi-person-x-fill"></i> No-Shows &amp; Missed (7 Days)<span class="badge danger">{{ $missedAppointments->count() }}</span></h2>
                @forelse($missedAppointments as $appt)
                    <div class="alert-item danger">
                        <strong>{{ $appt->patient->owner_name ?? 'Unknown Owner' }} &mdash; {{ $appt->patient->pet_name }}</strong>
                        <small>
                            <i class="bi bi-calendar"></i> {{ $appt->appointment_date->format('M d, Y') }}
                            &nbsp;&bull;&nbsp; {{ $appt->service_type }}
                            @if($appt->secondary_contact_name)
                                <br><i class="bi bi-telephone"></i> Secondary: {{ $appt->secondary_contact_name }} {{ $appt->secondary_contact_number }}
                            @elseif($appt->patient->owner_contact)
                                <br><i class="bi bi-telephone"></i> {{ $appt->patient->owner_contact }}
                            @endif
                        </small>
                    </div>
                @empty
                    <div class="empty-state success"><i class="bi bi-check-circle-fill" style="font-size:28px;display:block;margin-bottom:8px;"></i>No missed appointments in the last 7 days.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Patient Modal -->
    <div id="patientModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Pet Details</h2>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Content will be dynamically inserted -->
            </div>
            <div class="modal-actions">
                <a id="viewProfileBtn" class="modal-btn modal-btn-primary" href="#">View Full Profile</a>
                <button class="modal-btn modal-btn-secondary" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
        // Modal Functions
        function showPatientModal(patient, type, vaccine = null, dueDate = null, extraDetails = null, serviceType = null, visitDate = null, healthWorker = null) {
            const modal = document.getElementById('patientModal');
            const modalBody = document.getElementById('modalBody');
            const modalTitle = document.getElementById('modalTitle');
            const viewBtn = document.getElementById('viewProfileBtn');
            const petDisplayName = patient.pet_name
                ? `${patient.pet_name}${patient.species ? ' (' + patient.species + ')' : ''}`
                : (patient.full_name || 'Unknown');
            
            // Set title based on type
            let title = '<i class="bi bi-person-circle"></i> Pet Information';
            if (type === 'incomplete') title = '<i class="bi bi-exclamation-triangle-fill"></i> Incomplete Pet Record';
            if (type === 'visit') title = '<i class="bi bi-hospital"></i> Recent Visit';
            
            modalTitle.innerHTML = title;
            
            // Build modal content
            let content = `
                <div class="patient-detail-row">
                    <label>Pet Name</label>
                    <div class="value">${petDisplayName}</div>
                </div>
                <div class="patient-detail-row">
                    <label>Patient ID</label>
                    <div class="value">${patient.patient_id}</div>
                </div>
                <div class="patient-detail-row">
                    <label>Age</label>
                    <div class="value">${patient.age || 'N/A'} years old</div>
                </div>
                <div class="patient-detail-row">
                    <label>Sex</label>
                    <div class="value">${patient.sex || 'N/A'}</div>
                </div>
                <div class="patient-detail-row">
                    <label>Owner Contact</label>
                    <div class="value">${patient.owner_contact || 'Not provided'}</div>
                </div>
                <div class="patient-detail-row">
                    <label>Owner Address</label>
                    <div class="value">${patient.address || 'N/A'}</div>
                </div>
            `;
            
            // Add type-specific information
            if (type === 'visit' && serviceType) {
                content += `
                    <div class="patient-detail-row" style="border-left-color: #10b981; background: #ecfdf5;">
                        <label>Service Type</label>
                        <div class="value">${serviceType}</div>
                    </div>
                    <div class="patient-detail-row" style="border-left-color: #10b981; background: #ecfdf5;">
                        <label>Visit Date</label>
                        <div class="value">${visitDate}</div>
                    </div>
                `;
                if (healthWorker && healthWorker !== 'N/A') {
                    content += `
                        <div class="patient-detail-row" style="border-left-color: #10b981; background: #ecfdf5;">
                            <label><i class="bi bi-person-badge"></i> Veterinarian</label>
                            <div class="value">${healthWorker}</div>
                        </div>
                    `;
                }
            }
            
            if (type === 'incomplete') {
                let missing = [];
                if (!patient.microchip_number) missing.push('Microchip Number');
                if (!patient.owner_contact) missing.push('Owner Contact Number');
                
                content += `
                    <div class="patient-detail-row" style="border-left-color: #f59e0b; background: #fef3c7;">
                        <label>Missing Information</label>
                        <div class="value">${missing.join(', ')}</div>
                    </div>
                `;
            }
            
            modalBody.innerHTML = content;
            viewBtn.href = '/pets/' + patient.id;
            
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            const modal = document.getElementById('patientModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal on outside click
        document.getElementById('patientModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
        
        // Auto-refresh every 30 seconds for real-time updates
        let refreshInterval;
        let countdown = 30;
        
        function startAutoRefresh() {
            refreshInterval = setInterval(() => {
                location.reload();
            }, 30000); // 30 seconds
            
            // Countdown timer
            setInterval(() => {
                countdown--;
                if (countdown <= 0) countdown = 30;
                document.getElementById('refresh-text').textContent = `Updates in ${countdown}s`;
            }, 1000);
        }
        
        // Start auto-refresh
        startAutoRefresh();
        console.log('Auto-refresh enabled: Page updates every 30 seconds');
    </script>
</body>
</html>
