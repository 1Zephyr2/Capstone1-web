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
            background: linear-gradient(135deg, #f5f5f5 0%, #f0f9ff 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        .back-button:hover {
            background: #f8f9fa;
            border-color: #007bff;
            color: #007bff;
        }
        .header {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 24px;
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

        .header-logo-text {
            font-size: 18px;
            font-weight: 600;
            color: #047857;
        }
        h1 {
            color: #333;
            margin: 0;
            flex: 1;
            font-size: 28px;
            font-weight: 700;
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
    <!-- CALENDAR MODAL - SYNCHRONIZED WITH DASHBOARD -->
    <div id="visitsCalendarModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 10000; align-items: center; justify-content: center;" onclick="closeCalendarModal(event)">
        <div style="background: white; border-radius: 12px; max-width: 750px; width: 90%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);" onclick="event.stopPropagation()">
            <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 20px; border-radius: 12px 12px 0 0; display: flex; justify-content: space-between; align-items: center;">
                <h2 style="margin: 0; color: white; font-size: 20px;"><i class="bi bi-calendar-week"></i> Appointments Calendar</h2>
                <button onclick="closeCalendarModal()" style="background: rgba(255,255,255,0.2); border: none; color: white; font-size: 24px; cursor: pointer; width: 36px; height: 36px; border-radius: 50%; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">Ã—</button>
            </div>
            <div style="padding: 20px;">
                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <button onclick="visitsChangeMonth(-1)" style="padding: 8px 16px; background: #10b981; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">â† Previous</button>
                        <h3 id="visitsCurrentMonth" style="margin: 0;">February 2026</h3>
                        <button onclick="visitsChangeMonth(1)" style="padding: 8px 16px; background: #10b981; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">Next â†’</button>
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
        <a href="{{ route('dashboard') }}" class="back-button"><i class="bi bi-arrow-left"></i> Back</a>
        <div class="header">
            <div class="header-top">
                <a href="{{ route('dashboard') }}" class="header-logo">
                    <img src="/images/systemlogo.png" alt="CareSync" style="height: 35px; object-fit: contain;">
                </a>
                <h1 style="display: flex; align-items: center; gap: 12px;"><i class="bi bi-clock-history"></i> Visit History</h1>
            </div>
            
            <!-- Search & Filters -->
            <div style="margin-top: 20px; display: grid; grid-template-columns: 2fr 1fr 1fr 1fr auto; gap: 12px; align-items: end;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px;">Search Patient</label>
                    <input type="text" id="patientSearch" placeholder="Name or Patient ID..." style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;" value="{{ request('search') }}">
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px;">Service Type</label>
                    <select id="serviceType" style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                        <option value="all">All Services</option>
                        <option value="General Checkup" {{ request('service_type') == 'General Checkup' ? 'selected' : '' }}>General Checkup</option>
                        <option value="Immunization" {{ request('service_type') == 'Immunization' ? 'selected' : '' }}>Immunization</option>
                        <option value="Prenatal Care" {{ request('service_type') == 'Prenatal Care' ? 'selected' : '' }}>Prenatal Care</option>
                        <option value="Family Planning" {{ request('service_type') == 'Family Planning' ? 'selected' : '' }}>Family Planning</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px;">From Date</label>
                    <input type="date" id="fromDate" style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;" value="{{ request('from_date') }}">
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px;">To Date</label>
                    <input type="date" id="toDate" style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;" value="{{ request('to_date') }}">
                </div>
                <button onclick="applyFilters()" style="padding: 10px 24px; background: #007bff; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600;">Search</button>
            </div>
        </div>


        <!-- Visit History Table -->
        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-top: 24px;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                    <tr>
                        <th style="padding: 16px 18px; text-align: left; font-size: 13px; font-weight: 700; color: #495057; text-transform: uppercase; letter-spacing: 0.5px;">Date & Time</th>
                        <th style="padding: 16px 18px; text-align: left; font-size: 13px; font-weight: 700; color: #495057; text-transform: uppercase; letter-spacing: 0.5px;">Patient</th>
                        <th style="padding: 16px 18px; text-align: left; font-size: 13px; font-weight: 700; color: #495057; text-transform: uppercase; letter-spacing: 0.5px;">Service Type</th>
                        <th style="padding: 16px 18px; text-align: left; font-size: 13px; font-weight: 700; color: #495057; text-transform: uppercase; letter-spacing: 0.5px;">Chief Complaint</th>
                        <th style="padding: 16px 18px; text-align: left; font-size: 13px; font-weight: 700; color: #495057; text-transform: uppercase; letter-spacing: 0.5px;">Health Worker</th>
                        <th style="padding: 16px 18px; text-align: left; font-size: 13px; font-weight: 700; color: #495057; text-transform: uppercase; letter-spacing: 0.5px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visits as $visit)
                    <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s ease;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                        <td style="padding: 16px 18px; font-size: 14px;">
                            {{ $visit->visit_date->format('M d, Y') }}<br>
                            <small style="color: #6b7280;">{{ \Carbon\Carbon::parse($visit->visit_time)->format('h:i A') }}</small>
                        </td>
                        <td style="padding: 16px 18px; font-size: 14px;">
                            <strong>{{ $visit->patient->full_name }}</strong><br>
                            <small style="color: #6b7280;">{{ $visit->patient->patient_id }}</small>
                        </td>
                        <td style="padding: 16px 18px; font-size: 14px;">
                            <span style="display: inline-block; padding: 4px 12px; background: #dbeafe; color: #1e40af; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                {{ $visit->service_type }}
                            </span>
                        </td>
                        <td style="padding: 16px 18px; font-size: 14px; color: #6b7280;">
                            {{ $visit->chief_complaint ?? '-' }}
                        </td>
                        <td style="padding: 16px 18px; font-size: 14px;">
                            {{ $visit->health_worker ?? '-' }}
                        </td>
                        <td style="padding: 16px 18px;">
                            <button onclick="openVisitModal({{ $visit->id }})" style="padding: 6px 12px; background: #007bff; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#0056b3'" onmouseout="this.style.background='#007bff'">
                                <i class="bi bi-eye"></i> View
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 60px 20px; color: #9ca3af;">
                            <div style="font-size: 48px; margin-bottom: 16px;"><i class="bi bi-inbox" style="color: #d1d5db;"></i></div>
                            <p style="font-size: 16px; margin: 0;">No visit records found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="margin-top: 24px;">
            {{ $visits->links() }}
        </div>
            @if($visits->count() > 0)
                @foreach($visits as $visit)
                <div style="display: none;">
                    <div data-visit-id="{{ $visit->id }}" data-visit-json="{{ json_encode($visit) }}"></div>
                </div>
                @endforeach
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
                <button class="modal-close" onclick="closeVisitModal()">Ã—</button>
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
                    <h2 style="margin:0;color:#047857;font-size:20px;"><i class="bi bi-arrow-repeat"></i> Reschedule Appointment</h2>
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
        const visits = @json($visits->items());

        function applyFilters() {
            const search = document.getElementById('patientSearch').value;
            const serviceType = document.getElementById('serviceType').value;
            const fromDate = document.getElementById('fromDate').value;
            const toDate = document.getElementById('toDate').value;

            const params = new URLSearchParams();
            if (search) params.append('search', search);
            if (serviceType && serviceType !== 'all') params.append('service_type', serviceType);
            if (fromDate) params.append('from_date', fromDate);
            if (toDate) params.append('to_date', toDate);

            window.location.href = '{{ route('visits.index') }}' + (params.toString() ? '?' + params.toString() : '');
        }

        // Allow Enter key in search field
        document.getElementById('patientSearch')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') applyFilters();
        });

        function openVisitModal(visitId) {
            const visit = visits.find(v => v.id === visitId);
            if (!visit) return;

            // Set patient name and info
            document.getElementById('modalPatientName').textContent = visit.patient.full_name;
            document.getElementById('modalPatientInfo').textContent = 
                `ID: ${visit.patient.patient_id} â€¢ Age: ${visit.patient.age} years â€¢ Sex: ${visit.patient.sex}`;

            // Set service badge and time
            const serviceBadge = document.getElementById('modalServiceBadge');
            serviceBadge.textContent = visit.service_type;
            serviceBadge.className = `service-badge service-${visit.service_type.toLowerCase().replace(/ /g, '-')}`;
            
            const visitTime = new Date(visit.visit_time);
            document.getElementById('modalVisitTime').textContent = 
                visitTime.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });

            // Set vital signs
            const vitalSignsDiv = document.getElementById('modalVitalSigns');
            if (visit.vital_signs && visit.vital_signs.length > 0) {
                const vs = visit.vital_signs[0];
                let vitalHTML = '';
                if (vs.blood_pressure) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Blood Pressure</div><div class="vital-value">${vs.blood_pressure}</div></div>`;
                }
                if (vs.temperature) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Temperature</div><div class="vital-value">${vs.temperature}Â°C</div></div>`;
                }
                if (vs.pulse_rate) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Pulse Rate</div><div class="vital-value">${vs.pulse_rate} bpm</div></div>`;
                }
                if (vs.weight) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Weight</div><div class="vital-value">${vs.weight} kg</div></div>`;
                }
                if (vs.height) {
                    vitalHTML += `<div class="vital-item"><div class="vital-label">Height</div><div class="vital-value">${vs.height} cm</div></div>`;
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

        // Close modal on background click
        window.onclick = function(event) {
            const modal = document.getElementById('visitModal');
            if (event.target === modal) {
                closeVisitModal();
            }
        }
    </script>
</body>
</html>
