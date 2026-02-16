<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automation Support - VetCare</title>
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
            max-width: 1400px;
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
            color: #047857;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.02em;
        }

        .refresh-indicator {
            font-size: 14px;
            color: #10B981;
            font-weight: normal;
            padding: 4px 12px;
            background: #ECFDF5;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
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
            background: linear-gradient(135deg, #047857 0%, #059669 100%);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(4, 120, 87, 0.3);
        }

        .back-btn:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(4, 120, 87, 0.4);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border-top: 4px solid #047857;
            border-left: 1px solid rgba(0, 0, 0, 0.06);
            border-right: 1px solid rgba(0, 0, 0, 0.06);
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(4, 120, 87, 0.15);
            transform: translateY(-2px);
        }

        .stat-card h3 {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: 700;
            color: #047857;
        }

        .alerts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 24px;
        }

        .alert-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            border-left: 4px solid #047857;
            transition: all 0.2s ease;
        }

        .alert-card:hover {
            box-shadow: 0 4px 12px rgba(4, 120, 87, 0.1);
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
        <div class="header">
            <h1>
                Automation Support
                <span class="refresh-indicator">
                    <span class="refresh-dot"></span>
                    <span id="refresh-text">Live Updates</span>
                </span>
            </h1>
            <a href="{{ route('dashboard') }}" class="back-btn">← Back to Dashboard</a>
        </div>

        <!-- Quick Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Pets</h3>
                <div class="number">{{ $stats['total_patients'] }}</div>
            </div>
            <div class="stat-card">
                <h3>Visits This Week</h3>
                <div class="number">{{ $stats['visits_this_week'] }}</div>
            </div>
            <div class="stat-card">
                <h3>Pending Immunizations</h3>
                <div class="number">{{ $stats['pending_immunizations'] }}</div>
            </div>
            <div class="stat-card">
                <h3>Active Prenatal Cases</h3>
                <div class="number">{{ $stats['active_prenatal'] }}</div>
            </div>
        </div>

        <!-- Alerts and Automations -->
        <div class="alerts-grid">
            <!-- Incomplete Records -->
            <div class="alert-card">
                <h2><i class="bi bi-exclamation-triangle-fill"></i> Incomplete Patient Records<span class="badge warning">{{ $incompleteRecords->count() }}</span></h2>
                @forelse($incompleteRecords as $patient)
                    <div class="alert-item" onclick="showPatientModal({{ json_encode($patient) }}, 'incomplete')">
                        <strong>{{ $patient->full_name }} ({{ $patient->patient_id }})</strong>
                        <small>
                            Missing: 
                            @if(!$patient->philhealth_number) PhilHealth Number @endif
                            @if(!$patient->contact_number) Contact Number @endif
                        </small>
                    </div>
                @empty
                    <div class="empty-state">✓ All patient records are complete!</div>
                @endforelse
            </div>

            <!-- Due for Follow Up -->
            <div class="alert-card">
                <h2><i class="bi bi-shield-fill-check"></i> Due for Follow Up<span class="badge danger">{{ $overdueImmunizations->count() }}</span></h2>
                @forelse($overdueImmunizations as $immunization)
                    <div class="alert-item danger" onclick="showPatientModal({{ json_encode($immunization->patient) }}, 'immunization', '{{ $immunization->vaccine_name }}', '{{ Carbon\Carbon::parse($immunization->next_dose_date)->format('M d, Y') }}')">
                        <strong>{{ $immunization->patient->full_name }}</strong>
                        <small>{{ $immunization->vaccine_name }} - Due: {{ Carbon\Carbon::parse($immunization->next_dose_date)->format('M d, Y') }}</small>
                    </div>
                @empty
                    <div class="empty-state">✓ No overdue immunizations!</div>
                @endforelse
            </div>

            <!-- High Risk Prenatal -->
            <div class="alert-card">
                <h2><i class="bi bi-heart-pulse-fill"></i> High-Risk Prenatal Cases<span class="badge danger">{{ $highRiskPrenatal->count() }}</span></h2>
                @forelse($highRiskPrenatal as $record)
                    <div class="alert-item danger" onclick="showPatientModal({{ json_encode($record->patient) }}, 'prenatal', null, null, '{{ $record->blood_pressure }}')">
                        <strong>{{ $record->patient->full_name }}</strong>
                        <small>BP: {{ $record->blood_pressure }} - Requires immediate attention</small>
                    </div>
                @empty
                    <div class="empty-state">✓ No high-risk prenatal cases!</div>
                @endforelse
            </div>

            <!-- Recent Visits -->
            <div class="alert-card">
                <h2><i class="bi bi-hospital"></i> Recent Visits<span class="badge success">{{ $recentVisits->count() }}</span></h2>
                @forelse($recentVisits as $visit)
                    <div class="alert-item success" onclick="showPatientModal({{ json_encode($visit->patient) }}, 'visit', null, null, null, '{{ $visit->service_type }}', '{{ $visit->visit_date->format('M d, Y g:i A') }}', '{{ $visit->health_worker ?? 'N/A' }}')">
                        <strong>{{ $visit->patient->full_name }}</strong>
                        <small>{{ $visit->service_type }} - {{ $visit->visit_date->format('M d, Y g:i A') }}
                        @if($visit->health_worker)
                            <br><i class="bi bi-person-badge"></i> Doctor: {{ $visit->health_worker }}
                        @endif
                        </small>
                    </div>
                @empty
                    <div class="empty-state">No recent visits</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Patient Modal -->
    <div id="patientModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Patient Details</h2>
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
        function showPatientModal(patient, type, vaccine = null, dueDate = null, bp = null, serviceType = null, visitDate = null, healthWorker = null) {
            const modal = document.getElementById('patientModal');
            const modalBody = document.getElementById('modalBody');
            const modalTitle = document.getElementById('modalTitle');
            const viewBtn = document.getElementById('viewProfileBtn');
            
            // Set title based on type
            let title = '<i class="bi bi-person-circle"></i> Patient Information';
            if (type === 'incomplete') title = '<i class="bi bi-exclamation-triangle-fill"></i> Incomplete Patient Record';
            if (type === 'immunization') title = '<i class="bi bi-shield-fill-check"></i> Overdue Immunization';
            if (type === 'prenatal') title = '<i class="bi bi-heart-pulse-fill"></i> High-Risk Prenatal Case';
            if (type === 'visit') title = '<i class="bi bi-hospital"></i> Recent Visit';
            
            modalTitle.innerHTML = title;
            
            // Build modal content
            let content = `
                <div class="patient-detail-row">
                    <label>Full Name</label>
                    <div class="value">${patient.full_name}</div>
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
                    <label>Contact Number</label>
                    <div class="value">${patient.contact_number || 'Not provided'}</div>
                </div>
                <div class="patient-detail-row">
                    <label>Address</label>
                    <div class="value">${patient.address || 'N/A'}</div>
                </div>
            `;
            
            // Add type-specific information
            if (type === 'immunization' && vaccine) {
                content += `
                    <div class="patient-detail-row" style="border-left-color: #ef4444; background: #fef2f2;">
                        <label>Vaccine Due</label>
                        <div class="value">${vaccine}</div>
                    </div>
                    <div class="patient-detail-row" style="border-left-color: #ef4444; background: #fef2f2;">
                        <label>Due Date</label>
                        <div class="value">${dueDate}</div>
                    </div>
                `;
            }
            
            if (type === 'prenatal' && bp) {
                content += `
                    <div class="patient-detail-row" style="border-left-color: #ef4444; background: #fef2f2;">
                        <label>Blood Pressure</label>
                        <div class="value">${bp} <span style="color: #ef4444; font-weight: 600;"><i class="bi bi-exclamation-triangle-fill"></i> HIGH</span></div>
                    </div>
                `;
            }
            
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
                            <label><i class="bi bi-person-badge"></i> Doctor/Health Worker</label>
                            <div class="value">${healthWorker}</div>
                        </div>
                    `;
                }
            }
            
            if (type === 'incomplete') {
                let missing = [];
                if (!patient.philhealth_number) missing.push('PhilHealth Number');
                if (!patient.contact_number) missing.push('Contact Number');
                
                content += `
                    <div class="patient-detail-row" style="border-left-color: #f59e0b; background: #fef3c7;">
                        <label>Missing Information</label>
                        <div class="value">${missing.join(', ')}</div>
                    </div>
                `;
            }
            
            modalBody.innerHTML = content;
            viewBtn.href = '/patients/' + patient.id;
            
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
        console.log('✓ Auto-refresh enabled: Page updates every 30 seconds');
    </script>
</body>
</html>
