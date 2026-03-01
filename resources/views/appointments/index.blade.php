<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments - PAWser</title>
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
        .header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }
        .header-actions {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }
        .btn-primary {
            background: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background: #545b62;
        }
        .filters-form {
            margin-top: 20px;
        }
        .filters-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 12px;
        }
        .form-control {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }
        .btn-search {
            background: #28a745;
            color: white;
            padding: 10px 24px;
        }
        .btn-search:hover {
            background: #218838;
        }
        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .appointments-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #f8f9fa;
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }
        td {
            padding: 16px;
            border-bottom: 1px solid #dee2e6;
        }
        .badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-scheduled { background: #cce5ff; color: #004085; }
        .badge-confirmed { background: #d4edda; color: #155724; }
        .badge-completed { background: #d6d8db; color: #383d41; }
        .badge-cancelled { background: #f8d7da; color: #721c24; }
        .badge-no-show { background: #fff3cd; color: #856404; }
        .row-today td {
            background: #e6f0ff;
        }
        .row-upcoming td {
            background: #ecfdf3;
        }
        .row-today td:first-child,
        .row-upcoming td:first-child {
            border-left: 4px solid #2563eb;
        }
        .row-upcoming td:first-child {
            border-left-color: #16a34a;
        }
        .appt-owner-name {
            font-weight: 700;
            font-size: 14px;
            color: #111827;
            line-height: 1.3;
        }
        .appt-pet-name {
            font-size: 12px;
            color: #6b7280;
            margin-top: 3px;
        }
        .appt-species {
            color: #9ca3af;
        }
        .legend {
            display: flex;
            gap: 16px;
            align-items: center;
            font-size: 13px;
            color: #4b5563;
            margin-top: 16px;
        }
        .legend-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .legend-swatch {
            width: 16px;
            height: 12px;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
        }
        .legend-today { background: #e6f0ff; border-color: #2563eb; }
        .legend-upcoming { background: #ecfdf3; border-color: #16a34a; }
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        .btn-action {
            padding: 6px 10px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            background: none;
        }
        .btn-view { color: #007bff; }
        .btn-view:hover { background: #e7f1ff; }
        .btn-edit { color: #28a745; }
        .btn-edit:hover { background: #d4edda; }
        .btn-delete { color: #dc3545; }
        .btn-delete:hover { background: #f8d7da; }
        .pagination-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        /* Quick-edit modal */
        .qe-backdrop {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .qe-backdrop.open { display: flex; }
        .qe-panel {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 640px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 24px 60px rgba(0,0,0,0.22);
            animation: qeSlideIn 0.22s ease;
        }
        @keyframes qeSlideIn {
            from { opacity:0; transform: translateY(24px); }
            to   { opacity:1; transform: translateY(0); }
        }
        .qe-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px 16px;
            border-bottom: 1px solid #e5e7eb;
            position: sticky; top: 0; background: white; z-index: 1;
            border-radius: 16px 16px 0 0;
        }
        .qe-header h3 { font-size: 18px; font-weight: 700; color: #111827; margin:0; }
        .qe-header .qe-pet { font-size: 13px; color: #6b7280; margin-top: 2px; }
        .qe-close {
            width: 32px; height: 32px; border-radius: 50%;
            border: none; background: #f3f4f6;
            font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center;
            transition: background 0.15s;
        }
        .qe-close:hover { background: #e5e7eb; }
        .qe-body { padding: 20px 24px; }
        .qe-section {
            font-size: 11px; font-weight: 700; letter-spacing: 0.08em;
            text-transform: uppercase; color: #9ca3af;
            margin: 18px 0 10px;
        }
        .qe-section:first-child { margin-top: 0; }
        .qe-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .qe-grid.full { grid-template-columns: 1fr; }
        .qe-field { display: flex; flex-direction: column; gap: 5px; }
        .qe-field label { font-size: 13px; font-weight: 600; color: #374151; }
        .qe-field input, .qe-field select, .qe-field textarea {
            padding: 9px 11px;
            border: 1.5px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.15s;
            background: white;
        }
        .qe-field input:focus, .qe-field select:focus, .qe-field textarea:focus {
            outline: none; border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }
        .qe-field textarea { resize: vertical; min-height: 72px; }
        .qe-secondary-box {
            background: #fffbeb;
            border: 1.5px dashed #fcd34d;
            border-radius: 10px;
            padding: 14px 16px;
            margin-top: 4px;
        }
        .qe-secondary-label {
            font-size: 12px; font-weight: 700; color: #92400e;
            display: flex; align-items: center; gap: 6px; margin-bottom: 12px;
        }
        .qe-footer {
            display: flex; gap: 10px; justify-content: flex-end;
            padding: 16px 24px 20px;
            border-top: 1px solid #e5e7eb;
        }
        .qe-btn {
            padding: 9px 22px; border-radius: 8px; border: none;
            font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.15s;
        }
        .qe-btn-save { background: #2563eb; color: white; }
        .qe-btn-save:hover { background: #1d4ed8; }
        .qe-btn-save:disabled { background: #93c5fd; cursor: not-allowed; }
        .qe-btn-cancel { background: #f3f4f6; color: #374151; }
        .qe-btn-cancel:hover { background: #e5e7eb; }
        .qe-alert { padding: 10px 14px; border-radius: 8px; font-size: 13px; margin-bottom: 12px; display: none; }
        .qe-alert.success { background: #dcfce7; color: #166534; }
        .qe-alert.error   { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
<div class="container">
    <a href="{{ route('dashboard') }}" class="back-button">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>
    <div class="header">
        <div class="header-top">
            <h1 style="display: flex; align-items: center; gap: 12px;"><i class="bi bi-calendar-check"></i> Scheduling</h1>
        </div>
        
        <div class="header-actions">
            <a href="{{ route('appointments.create') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);">
                <i class="bi bi-plus-circle"></i> New Appointment
            </a>
        </div>

        <!-- Filters -->
        <form method="GET" action="{{ route('appointments.index') }}" class="filters-form">
            <div class="filters-row">
                <input type="text" name="search" placeholder="Search pet..." value="{{ request('search') }}" class="form-control">
                
                <select name="status" class="form-control">
                    <option value="all">All Status</option>
                    <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="no-show" {{ request('status') == 'no-show' ? 'selected' : '' }}>No-Show</option>
                </select>

                <select name="service_type" class="form-control">
                    <option value="all">All Services</option>
                    <option value="Bath & Dry" {{ request('service_type') == 'Bath & Dry' ? 'selected' : '' }}>Bath &amp; Dry</option>
                    <option value="Full Grooming" {{ request('service_type') == 'Full Grooming' ? 'selected' : '' }}>Full Grooming</option>
                    <option value="Haircut & Styling" {{ request('service_type') == 'Haircut & Styling' ? 'selected' : '' }}>Haircut &amp; Styling</option>
                    <option value="Nail Trimming" {{ request('service_type') == 'Nail Trimming' ? 'selected' : '' }}>Nail Trimming</option>
                    <option value="Ear Cleaning" {{ request('service_type') == 'Ear Cleaning' ? 'selected' : '' }}>Ear Cleaning</option>
                    <option value="Teeth Brushing" {{ request('service_type') == 'Teeth Brushing' ? 'selected' : '' }}>Teeth Brushing</option>
                    <option value="De-shedding Treatment" {{ request('service_type') == 'De-shedding Treatment' ? 'selected' : '' }}>De-shedding Treatment</option>
                    <option value="Flea & Tick Treatment" {{ request('service_type') == 'Flea & Tick Treatment' ? 'selected' : '' }}>Flea &amp; Tick Treatment</option>
                    <option value="Paw Treatment" {{ request('service_type') == 'Paw Treatment' ? 'selected' : '' }}>Paw Treatment</option>
                    <option value="Breeding Consultation" {{ request('service_type') == 'Breeding Consultation' ? 'selected' : '' }}>Breeding Consultation</option>
                    <option value="Boarding Checkup" {{ request('service_type') == 'Boarding Checkup' ? 'selected' : '' }}>Boarding Checkup</option>
                    <option value="Follow-up" {{ request('service_type') == 'Follow-up' ? 'selected' : '' }}>Follow-up</option>
                </select>

                <button type="submit" class="btn btn-search">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>
        <div class="legend">
            <span class="legend-item"><span class="legend-swatch legend-today"></span> Scheduled today</span>
            <span class="legend-item"><span class="legend-swatch legend-upcoming"></span> Upcoming (next 7 days)</span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="appointments-table">
        <table>
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Owner / Pet</th>
                    <th>Service Type</th>
                    <th>Status</th>
                    <th>Chief Complaint</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $today = \Carbon\Carbon::today();
                @endphp
                @forelse($appointments as $appointment)
                    @php
                        $isToday = $appointment->appointment_date->isSameDay($today);
                        $isUpcoming = !$isToday && $appointment->appointment_date->isAfter($today)
                            && $appointment->appointment_date->diffInDays($today) <= 7;
                    @endphp
                    <tr class="{{ $isToday ? 'row-today' : ($isUpcoming ? 'row-upcoming' : '') }}">
                        <td>
                            {{ $appointment->appointment_date->format('M d, Y') }}<br>
                            <small>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</small>
                        </td>
                        <td>
                            <div class="appt-owner-name">{{ $appointment->patient->owner_name ?? 'Unknown Owner' }}</div>
                            <div class="appt-pet-name"><i class="bi bi-heart-fill" style="font-size:10px;"></i> {{ $appointment->patient->pet_name }} <span class="appt-species">({{ $appointment->patient->species }})</span></div>
                        </td>
                        <td>{{ $appointment->service_type }}</td>
                        <td>
                            <span class="badge badge-{{ $appointment->status }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td>{{ $appointment->chief_complaint ?? 'N/A' }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('appointments.show', $appointment) }}" class="btn-action btn-view">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <button type="button" class="btn-action btn-edit"
                                    onclick="openQuickEdit(
                                        {{ $appointment->id }},
                                        '{{ addslashes(($appointment->patient->owner_name ?? 'Unknown') . ' — ' . $appointment->patient->pet_name) }}',
                                        '{{ $appointment->appointment_date->format('Y-m-d') }}',
                                        '{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}',
                                        '{{ addslashes($appointment->service_type) }}',
                                        '{{ $appointment->status }}',
                                        '{{ addslashes($appointment->chief_complaint ?? '') }}',
                                        '{{ addslashes($appointment->health_worker ?? '') }}',
                                        '{{ addslashes($appointment->notes ?? '') }}',
                                        '{{ addslashes($appointment->secondary_contact_name ?? '') }}',
                                        '{{ addslashes($appointment->secondary_contact_number ?? '') }}'
                                    )">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px;">
                            <i class="bi bi-calendar-x" style="font-size: 48px; color: #ccc;"></i>
                            <p style="color: #999; margin-top: 16px;">No appointments found</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $appointments->links() }}
    </div>
</div>

<!-- Quick-Edit Modal -->
<div class="qe-backdrop" id="qeBackdrop" onclick="closeQuickEdit(event)">
    <div class="qe-panel">
        <div class="qe-header">
            <div>
                <h3><i class="bi bi-pencil-square" style="color:#2563eb;"></i> Edit Appointment</h3>
                <div class="qe-pet" id="qePetName"></div>
            </div>
            <button class="qe-close" onclick="closeQuickEditBtn()">&times;</button>
        </div>
        <div class="qe-body">
            <div class="qe-alert" id="qeAlert"></div>

            <div class="qe-section">Schedule</div>
            <div class="qe-grid">
                <div class="qe-field">
                    <label>Date <span style="color:#ef4444">*</span></label>
                    <input type="date" id="qeDate">
                </div>
                <div class="qe-field">
                    <label>Time <span style="color:#ef4444">*</span></label>
                    <input type="time" id="qeTime">
                </div>
            </div>

            <div class="qe-section" style="margin-top:16px;">Details</div>
            <div class="qe-grid">
                <div class="qe-field">
                    <label>Service Type <span style="color:#ef4444">*</span></label>
                    <select id="qeService">
                        <optgroup label="Grooming Services">
                            <option value="Bath & Dry">Bath &amp; Dry</option>
                            <option value="Full Grooming">Full Grooming</option>
                            <option value="Haircut & Styling">Haircut &amp; Styling</option>
                            <option value="Nail Trimming">Nail Trimming</option>
                            <option value="Ear Cleaning">Ear Cleaning</option>
                            <option value="Teeth Brushing">Teeth Brushing</option>
                            <option value="De-shedding Treatment">De-shedding Treatment</option>
                            <option value="Flea & Tick Treatment">Flea &amp; Tick Treatment</option>
                            <option value="Paw Treatment">Paw Treatment</option>
                        </optgroup>
                        <optgroup label="Other Services">
                            <option value="Breeding Consultation">Breeding Consultation</option>
                            <option value="Boarding Checkup">Boarding Checkup</option>
                            <option value="Follow-up">Follow-up</option>
                            <option value="Other">Other</option>
                        </optgroup>
                    </select>
                </div>
                <div class="qe-field">
                    <label>Status <span style="color:#ef4444">*</span></label>
                    <select id="qeStatus">
                        <option value="scheduled">Scheduled</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="no-show">No-Show</option>
                    </select>
                </div>
            </div>
            <div class="qe-grid" style="margin-top:14px;">
                <div class="qe-field">
                    <label>Groomer / Health Worker</label>
                    <input type="text" id="qeWorker" placeholder="Staff name">
                </div>
                <div class="qe-field">
                    <label>Chief Complaint / Purpose</label>
                    <input type="text" id="qeComplaint" placeholder="e.g. matted fur, nail trim">
                </div>
            </div>
            <div class="qe-grid full" style="margin-top:14px;">
                <div class="qe-field">
                    <label>Notes</label>
                    <textarea id="qeNotes" placeholder="Any additional notes..."></textarea>
                </div>
            </div>

            <div class="qe-section" style="margin-top:20px;">Pickup / Secondary Contact</div>
            <div class="qe-secondary-box">
                <div class="qe-secondary-label">
                    <i class="bi bi-person-lines-fill"></i>
                    In case someone else picks up the pet
                </div>
                <div class="qe-grid">
                    <div class="qe-field">
                        <label>Contact Person Name</label>
                        <input type="text" id="qeSecName" placeholder="e.g. Maria Santos">
                    </div>
                    <div class="qe-field">
                        <label>Contact Number</label>
                        <input type="tel" id="qeSecNumber" placeholder="09XX-XXX-XXXX">
                    </div>
                </div>
            </div>
        </div>
        <div class="qe-footer">
            <button class="qe-btn qe-btn-cancel" onclick="closeQuickEditBtn()">Cancel</button>
            <button class="qe-btn qe-btn-save" id="qeSaveBtn" onclick="saveQuickEdit()">
                <i class="bi bi-check-lg"></i> Save Changes
            </button>
        </div>
    </div>
</div>

<script>
    let qeActiveId = null;

    function openQuickEdit(id, petName, date, time, service, status, complaint, worker, notes, secName, secNumber) {
        qeActiveId = id;
        document.getElementById('qePetName').textContent = petName;
        document.getElementById('qeDate').value = date;
        document.getElementById('qeTime').value = time;
        document.getElementById('qeService').value = service;
        document.getElementById('qeStatus').value = status;
        document.getElementById('qeComplaint').value = complaint;
        document.getElementById('qeWorker').value = worker;
        document.getElementById('qeNotes').value = notes;
        document.getElementById('qeSecName').value = secName;
        document.getElementById('qeSecNumber').value = secNumber;
        document.getElementById('qeAlert').style.display = 'none';
        document.getElementById('qeSaveBtn').disabled = false;
        document.getElementById('qeBackdrop').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeQuickEdit(e) {
        if (e.target === document.getElementById('qeBackdrop')) closeQuickEditBtn();
    }

    function closeQuickEditBtn() {
        document.getElementById('qeBackdrop').classList.remove('open');
        document.body.style.overflow = '';
    }

    function saveQuickEdit() {
        const saveBtn = document.getElementById('qeSaveBtn');
        const alert  = document.getElementById('qeAlert');
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Saving...';
        alert.style.display = 'none';

        fetch(`/appointments/${qeActiveId}/quick-update`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                appointment_date:         document.getElementById('qeDate').value,
                appointment_time:         document.getElementById('qeTime').value,
                service_type:             document.getElementById('qeService').value,
                status:                   document.getElementById('qeStatus').value,
                chief_complaint:          document.getElementById('qeComplaint').value,
                health_worker:            document.getElementById('qeWorker').value,
                notes:                    document.getElementById('qeNotes').value,
                secondary_contact_name:   document.getElementById('qeSecName').value,
                secondary_contact_number: document.getElementById('qeSecNumber').value,
            })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                alert.className = 'qe-alert success';
                alert.textContent = '✓ Appointment updated successfully.';
                alert.style.display = 'block';
                saveBtn.innerHTML = '<i class="bi bi-check-lg"></i> Saved!';
                setTimeout(() => { closeQuickEditBtn(); window.location.reload(); }, 1200);
            } else {
                const msgs = data.errors ? Object.values(data.errors).flat().join(' | ') : (data.message || 'Error saving.');
                alert.className = 'qe-alert error';
                alert.textContent = msgs;
                alert.style.display = 'block';
                saveBtn.disabled = false;
                saveBtn.innerHTML = '<i class="bi bi-check-lg"></i> Save Changes';
            }
        })
        .catch(() => {
            alert.className = 'qe-alert error';
            alert.textContent = 'Network error. Please try again.';
            alert.style.display = 'block';
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<i class="bi bi-check-lg"></i> Save Changes';
        });
    }

    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeQuickEditBtn(); });
</script>
</body>
</html>
