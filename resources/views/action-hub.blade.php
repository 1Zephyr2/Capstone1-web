<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action Hub - PAWSER</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>

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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--bg) 0%, var(--bg-alt) 100%);
            padding: 0;
            padding-top: 72px;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            color: var(--text);
            display: flex;
            flex-direction: column;
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
            padding: 40px 20px;
            flex: 1;
            width: 100%;
            animation: staffFadeInUp 0.6s ease-out;
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
            color: #111827;
            border: 1px solid #111827;
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
            background: #f0fdfa;
            border-color: #14b8a6;
            color: #14b8a6;
            transform: translateY(-1px);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
            animation: staffFadeInUp 0.6s ease-out 0.1s both;
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

        @keyframes staffFadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes staffFadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
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
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.2s ease;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            max-height: 75vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            padding: 24px;
            border-radius: 16px 16px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
        }

        .modal-header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        .modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            font-weight: 600;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .modal-body {
            padding: 16px;
        }

        .patient-detail-row {
            padding: 12px 14px;
            margin-bottom: 10px;
            background: #f0fdf9;
            border-radius: 8px;
            border-left: 4px solid #14b8a6;
            transition: all 0.2s ease;
        }

        .patient-detail-row:hover {
            background: #e0fdf8;
            border-left-color: #0d9488;
        }

        .patient-detail-row label {
            display: block;
            font-size: 11px;
            color: #0d9488;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            font-weight: 700;
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
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
        }

        .modal-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(20, 184, 166, 0.35);
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
            z-index: 1001;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            height: 72px;
            animation: staffFadeIn 0.5s ease-out;
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

        .navbar-profile-section {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            background: transparent;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .navbar-profile-section:hover {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .navbar-avatar-img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        .navbar-avatar-placeholder {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            color: white;
            flex-shrink: 0;
        }

        .navbar-user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .navbar-user-name {
            font-weight: 700;
            font-size: 13px;
            color: white;
        }

        .navbar-logout-btn {
            padding: 8px 11px;
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #fca5a5;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-logout-btn:hover {
            background: rgba(239, 68, 68, 0.3);
            border-color: rgba(239, 68, 68, 0.6);
            transform: translateY(-2px);
            color: #fecaca;
        }
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
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('dashboard') }}" class="navbar-brand">
                <img src="{{ asset('newlogo.png') }}" alt="PAWSER" class="navbar-logo" onerror="this.style.display='none'">
                <div class="navbar-brand-text">
                    <p class="navbar-title">PAWSER</p>
                    <p class="navbar-subtitle">Staff Dashboard</p>
                </div>
            </a>
            <div class="navbar-menu">
                <a href="{{ route('dashboard') }}" class="navbar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('pets.index') }}" class="navbar-item {{ request()->routeIs('pets.*') ? 'active' : '' }}">
                    <i class="bi bi-heart-fill"></i>
                    <span>Pets</span>
                </a>
                <a href="{{ route('appointments.index') }}" class="navbar-item {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check"></i>
                    <span>Appointments</span>
                </a>
                @if(Auth::user()->hasStaffAccess())
                <a href="{{ route('appointment-requests.index') }}" class="navbar-item {{ request()->routeIs('appointment-requests.*') ? 'active' : '' }}">
                    <i class="bi bi-inbox-fill"></i>
                    <span>Requests</span>
                </a>
                @endif
                <a href="{{ route('visits.today') }}" class="navbar-item {{ request()->routeIs('visits.*') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i>
                    <span>Visits</span>
                </a>
                @if(Auth::user()->hasStaffAccess())
                <a href="{{ route('analytics.index') }}" class="navbar-item {{ request()->routeIs('analytics.*') ? 'active' : '' }}">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span>Insights</span>
                </a>
                <a href="{{ route('automation.support') }}" class="navbar-item {{ request()->routeIs('automation.*') ? 'active' : '' }}">
                    <i class="bi bi-cpu"></i>
                    <span>Actions</span>
                </a>
                @endif
            </div>
            <div class="navbar-end">
                <a href="{{ route('profile.show') }}" class="navbar-profile-section">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="navbar-avatar-img">
                    @else
                        <div class="navbar-avatar-placeholder">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="navbar-user-info">
                        <div class="navbar-user-name">{{ Auth::user()->name }}</div>
                        <div class="navbar-user-role">{{ Auth::user()->role_name ?? ucfirst(Auth::user()->role) }}</div>
                    </div>
                </a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="navbar-logout-btn" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
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
                <h2>Incomplete Pet Records<span class="badge warning">{{ $incompleteRecords->count() }}</span></h2>
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

