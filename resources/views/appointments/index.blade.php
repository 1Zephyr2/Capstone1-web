<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments - PAWSER</title>
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
            padding: 0;
            padding-top: 72px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* Top Navigation Bar */
        .navbar {
            background: #1e293b;
            color: white;
            padding: 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            height: 72px;
        }

        .navbar i.bi {
            font-family: bootstrap-icons;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 0 24px;
            gap: 24px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .navbar-brand:hover {
            opacity: 0.8;
            transform: translateY(-2px);
        }

        .navbar-logo {
            height: 40px;
            width: 40px;
            object-fit: contain;
        }

        .navbar-brand-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .navbar-title {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }

        .navbar-subtitle {
            font-size: 11px;
            opacity: 0.8;
            margin: 0;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 6px;
            flex: 1;
            justify-content: center;
        }

        .navbar-item {
            padding: 8px 14px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .navbar-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateY(-2px);
        }

        .navbar-item.active {
            background: rgba(20, 184, 166, 0.15);
            color: #14b8a6;
            border-bottom: 2px solid #14b8a6;
        }

        .navbar-end {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .navbar-avatar:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.08);
        }

        .navbar-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .navbar-user-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .navbar-user-name {
            font-size: 13px;
            font-weight: 600;
            color: white;
        }

        .navbar-user-role {
            font-size: 11px;
            opacity: 0.7;
        }

        .navbar-profile-btn {
            padding: 6px 12px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .navbar-profile-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        .navbar-logout-btn {
            padding: 6px 12px;
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .navbar-logout-btn:hover {
            background: rgba(239, 68, 68, 0.25);
            border-color: rgba(239, 68, 68, 0.5);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .navbar-menu {
                gap: 4px;
            }

            .navbar-item {
                padding: 6px 10px;
                font-size: 12px;
                gap: 4px;
            }

            .navbar-item span {
                display: none;
            }

            .navbar-user-text {
                display: none;
            }

            .navbar-container {
                padding: 0 12px;
                gap: 12px;
            }

            .navbar-item i {
                font-size: 18px;
            }
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
            flex: 1;
            width: 100%;
        }
        .header {
            background: white;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08), 0 4px 16px rgba(0,0,0,0.04);
            margin-bottom: 28px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .header:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        .header h1 {
            color: #0f172a;
            font-size: 32px;
            margin-bottom: 24px;
            font-weight: 800;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 12px;
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
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
            box-shadow: 0 8px 20px rgba(20, 184, 166, 0.4);
            transform: translateY(-2px);
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
            padding: 10px 14px;
            border: 1.5px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: all 0.2s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }
        .btn-search {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            padding: 10px 24px;
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
        }
        .btn-search:hover {
            background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
            box-shadow: 0 8px 20px rgba(6, 182, 212, 0.4);
            transform: translateY(-2px);
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
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08), 0 4px 16px rgba(0,0,0,0.04);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .appointments-table:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        tbody tr {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: 1px solid #e5e7eb;
        }
        tbody tr:hover {
            background-color: #f9fafb;
        }
        tbody tr:last-child {
            border-bottom: none;
        }
        th {
            background: linear-gradient(135deg, #f0f9ff 0%, #f8fafc 100%);
            padding: 18px 16px;
            text-align: left;
            font-weight: 700;
            color: #0f172a;
            border-bottom: 2px solid #e5e7eb;
            letter-spacing: -0.01em;
            font-size: 13px;
            text-transform: uppercase;
        }
        td {
            padding: 18px 16px;
            border-bottom: 1px solid #e5e7eb;
            color: #374151;
            font-size: 14px;
        }
        .badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-scheduled { background: #ccfbf1; color: #0d7377; border: 1px solid #99f6e4; }
        .badge-confirmed { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .badge-completed { background: #e6e6e6; color: #292524; border: 1px solid #d4d4d4; }
        .badge-cancelled { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .badge-no-show { background: #fef3c7; color: #92400e; border: 1px solid #fcd34d; }
        .row-today td {
            background: #f0fdf4;
        }
        .row-upcoming td {
            background: #f0f9ff;
        }
        .row-today td:first-child,
        .row-upcoming td:first-child {
            border-left: 4px solid #14b8a6;
        }
        .row-upcoming td:first-child {
            border-left-color: #06b6d4;
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
        .legend-today { background: #f0fdf4; border-color: #14b8a6; }
        .legend-upcoming { background: #f0f9ff; border-color: #06b6d4; }
        .action-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        .btn-action {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            width: 36px;
            height: 36px;
        }
        .btn-view { 
            color: #06b6d4;
            border-color: #cffafe;
        }
        .btn-view:hover { 
            background: #ecfdfd;
            border-color: #06b6d4;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.15);
        }
        .btn-edit { 
            color: #14b8a6;
            border-color: #ccfbf1;
        }
        .btn-edit:hover { 
            background: #ecfdfd;
            border-color: #14b8a6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.15);
        }
        .btn-delete { 
            color: #ef4444;
            border-color: #fee2e2;
        }
        .btn-delete:hover { 
            background: #fef2f2;
            border-color: #ef4444;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
        }
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
            box-shadow: 0 24px 60px rgba(0,0,0,0.15);
            animation: qeSlideIn 0.22s ease;
            border: 1px solid #e5e7eb;
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
            padding: 10px 14px;
            border: 1.5px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            color: #374151;
        }
        .qe-field input:focus, .qe-field select:focus, .qe-field textarea:focus {
            outline: none; 
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1), inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        .qe-field input::placeholder, .qe-field textarea::placeholder {
            color: #9ca3af;
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
            padding: 10px 24px; 
            border-radius: 10px; 
            border: none;
            font-size: 14px; 
            font-weight: 700; 
            cursor: pointer; 
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .qe-btn-save { 
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); 
            color: white; 
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3); 
        }
        .qe-btn-save:hover { 
            background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%); 
            box-shadow: 0 8px 20px rgba(20, 184, 166, 0.4); 
            transform: translateY(-2px); 
        }
        .qe-btn-save:disabled { 
            background: #a7f3d0; 
            cursor: not-allowed; 
            transform: none;
        }
        .qe-btn-cancel { 
            background: #f3f4f6; 
            color: #374151;
            border: 1px solid #d1d5db;
        }
        .qe-btn-cancel:hover { 
            background: #e5e7eb;
            border-color: #9ca3af;
        }
        .qe-alert { padding: 10px 14px; border-radius: 8px; font-size: 13px; margin-bottom: 12px; display: none; }
        .qe-alert.success { background: #dcfce7; color: #166534; }
        .qe-alert.error   { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
<x-staff-navbar />
<div class="container">
    <div class="header">
        <div class="header-top">
            <h1>Scheduling</h1>
        </div>
        
        <div class="header-actions">
            <a href="{{ route('appointments.create') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); box-shadow: 0 2px 8px rgba(20, 184, 166, 0.3);">
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
                        $isToday = $appointment->appointment_date->isSameDay($today) && $appointment->status !== 'completed';
                        $isUpcoming = !$isToday && $appointment->appointment_date->isAfter($today)
                            && $appointment->appointment_date->diffInDays($today) <= 7
                            && $appointment->status !== 'completed';
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
            <button class="qe-btn qe-btn-save" id="qeSaveBtn" onclick="saveQuickEdit()"></div>

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
                
                // Notify dashboard to update stats
                localStorage.setItem('dashboard-update-needed', 'true');
                
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
</script>
</body>
</html>

