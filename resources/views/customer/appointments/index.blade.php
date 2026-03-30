<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments - PAWSER</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Top Navigation Bar */
        .navbar {
            background: #1e293b;
            color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar i.bi {
            font-family: bootstrap-icons;
        }

        .navbar-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
            transition: opacity 0.2s;
        }

        .navbar-brand:hover {
            opacity: 0.8;
        }

        .navbar-logo {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .navbar-title {
            font-size: 20px;
            font-weight: 700;
            color: white;
            letter-spacing: -0.3px;
        }

        .navbar-center {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            justify-content: center;
        }

        .nav-item {
            padding: 8px 16px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-item.active {
            background: rgba(20, 184, 166, 0.15);
            color: #14b8a6;
            border-bottom: 2px solid #14b8a6;
        }

        .navbar-end {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .logout-btn {
            padding: 8px 14px;
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Hide top-nav white bar */
        .top-nav {
            display: none !important;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
            padding: 40px 24px;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Appointments Container */
        .appointments-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .appointments-list {
            divide-y divide-gray-200;
        }

        .appointment-item {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .appointment-item:last-child {
            border-bottom: none;
        }

        .appointment-item:hover {
            background: #f9fafb;
        }

        .appointment-content {
            flex: 1;
        }

        .appointment-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .appointment-pet {
            font-weight: 600;
            color: #1f2937;
            font-size: 16px;
        }

        .appointment-reason {
            background: rgba(20, 184, 166, 0.1);
            color: #14b8a6;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .appointment-date {
            color: #6b7280;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .appointment-link {
            padding: 8px 16px;
            background: #14b8a6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .appointment-link:hover {
            background: #0d9488;
            transform: translateY(-1px);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-upcoming {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .status-today {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
        }

        .empty-state i {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 16px;
        }

        .pagination-container {
            padding: 16px 20px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .pagination-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            color: #14b8a6;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .pagination-link:hover {
            background: #f3f4f6;
            border-color: #14b8a6;
        }

        .pagination-link.active {
            background: #14b8a6;
            color: white;
            border-color: #14b8a6;
        }

        .pagination-link.disabled {
            color: #d1d5db;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .navbar-center {
                display: none;
            }

            .main-content {
                padding: 20px 16px;
            }

            .appointment-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .appointment-link {
                width: 100%;
                justify-content: center;
            }

            .page-title {
                font-size: 24px;
            }
        }

        /* Appointments Container */
        .appointments-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .appointments-list {
            divide-y divide-gray-200;
        }

        .appointment-item {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .appointment-item:last-child {
            border-bottom: none;
        }

        .appointment-item:hover {
            background: #f9fafb;
        }

        .appointment-content {
            flex: 1;
        }

        .appointment-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .appointment-pet {
            font-weight: 600;
            color: #1f2937;
            font-size: 16px;
        }

        .appointment-reason {
            background: rgba(20, 184, 166, 0.1);
            color: #14b8a6;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .appointment-date {
            color: #6b7280;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .appointment-link {
            padding: 8px 16px;
            background: #14b8a6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .appointment-link:hover {
            background: #0d9488;
            transform: translateY(-1px);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-upcoming {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .status-today {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
        }

        .empty-state i {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 16px;
        }

        .pagination-container {
            padding: 16px 20px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .pagination-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            color: #14b8a6;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .pagination-link:hover {
            background: #f3f4f6;
            border-color: #14b8a6;
        }

        .pagination-link.active {
            background: #14b8a6;
            color: white;
            border-color: #14b8a6;
        }

        .pagination-link.disabled {
            color: #d1d5db;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('customer.dashboard') }}" class="navbar-brand">
                <img src="{{ asset('newlogo.png') }}" alt="PAWSER" class="navbar-logo" onerror="this.style.display='none'">
                <span class="navbar-title">PAWSER</span>
            </a>
            <div class="navbar-center">
                <a href="{{ route('customer.dashboard') }}" class="nav-item">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
                <a href="{{ route('customer.pets.index') }}" class="nav-item">
                    <i class="bi bi-heart-pulse"></i>
                    My Pets
                </a>
                <a href="{{ route('customer.appointments.index') }}" class="nav-item active">
                    <i class="bi bi-calendar2-check"></i>
                    Appointments
                </a>
            </div>
            <div class="navbar-end">
                <div class="user-menu">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="bi bi-box-arrow-left"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-calendar-check"></i>
                My Appointments
            </h1>
        </div>

        <div class="appointments-container">
            @if($appointments->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p style="font-size: 18px; font-weight: 600;">No Appointments</p>
                    <p>You don't have any appointments scheduled.</p>
                </div>
            @else
                <div class="appointments-list">
                    @foreach($appointments as $appointment)
                        <div class="appointment-item">
                            <div class="appointment-content">
                                <div class="appointment-header">
                                    <span class="appointment-pet">
                                        <i class="bi bi-paw"></i> {{ $appointment->patient->pet_name ?? 'Unknown Pet' }}
                                    </span>
                                    <span class="appointment-reason">{{ $appointment->service_type ?? 'Checkup' }}</span>
                                    @if($appointment->appointment_date->isToday())
                                        <span class="status-badge status-today">
                                            <i class="bi bi-exclamation-circle"></i> Today
                                        </span>
                                    @else
                                        <span class="status-badge status-upcoming">
                                            <i class="bi bi-check-circle"></i> Upcoming
                                        </span>
                                    @endif
                                </div>
                                <div class="appointment-date">
                                    <i class="bi bi-calendar-event"></i>
                                    {{ $appointment->appointment_date->format('l, M d, Y') }} at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                </div>
                            </div>
                            <a href="{{ route('customer.appointments.show', $appointment) }}" class="appointment-link">
                                <i class="bi bi-arrow-right"></i>
                                View Details
                            </a>
                        </div>
                    @endforeach
                </div>

                @if($appointments->hasPages())
                    <div class="pagination-container">
                        {{ $appointments->links('pagination::simple-tailwind') }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</body>
</html>
