<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - PAWSER</title>
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
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .user-avatar:hover {
            background: rgba(255, 255, 255, 0.4);
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
        }

        .page-subtitle {
            font-size: 14px;
            color: #64748b;
        }

        .menu-label {
            padding: 16px 24px 8px 24px;
            font-size: 11px;
            text-transform: uppercase;
            opacity: 0.65;
            font-weight: 700;
            letter-spacing: 0.8px;
            margin: 0;
            color: #a0aec0;
            margin-top: 8px;
        }

        .menu-label:first-child {
            margin-top: 0;
            padding-top: 12px;
        }

        .sidebar-menu {
            margin-top: 0;
            flex: 1;
            padding: 16px 0;
        }

        .quick-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 0 12px;
        }

        .quick-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.25s ease;
            background: rgba(20, 184, 166, 0.05);
            border-radius: 10px;
            border: 1px solid rgba(20, 184, 166, 0.12);
            font-size: 14px;
            font-weight: 500;
        }

        .quick-nav-item:hover {
            background: rgba(20, 184, 166, 0.15);
            border-color: rgba(20, 184, 166, 0.35);
            color: white;
            transform: translateX(3px);
        }

        .quick-nav-item.active {
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.25) 0%, rgba(6, 182, 212, 0.15) 100%);
            border-color: rgba(20, 184, 166, 0.45);
            color: #22d3ee;
            box-shadow: 0 0 16px rgba(20, 184, 166, 0.15);
        }

        .quick-nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            opacity: 0.8;
        }

        .quick-nav-item.active .quick-nav-icon {
            opacity: 1;
        }

        /* Main Content */
        .main-content {
        }

        /* Cards */
        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #14b8a6, #06b6d4);
        }

        .card:hover {
            box-shadow: 0 8px 24px rgba(20, 184, 166, 0.12);
            transform: translateY(-3px);
            border-color: #cbd5e1;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            opacity: 0.85;
        }

        .card-title i {
            font-size: 20px;
            color: #14b8a6;
        }

        .card-content {
            color: #64748b;
            line-height: 1.6;
            font-size: 14px;
        }

        .stat-number {
            font-size: 40px;
            font-weight: 800;
            background: linear-gradient(135deg, #14b8a6, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 20px 0 12px 0;
            letter-spacing: -1px;
        }

        /* Pets Section */
        .pets-section {
            background: white;
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.3px;
        }

        .section-title i {
            font-size: 24px;
            color: #14b8a6;
        }

        .pets-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .pet-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .pet-item:hover {
            background: linear-gradient(135deg, #f0f4f8 0%, #e8ecf1 100%);
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.08);
            transform: translateX(2px);
        }

        .pet-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.15), rgba(6, 182, 212, 0.1));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #14b8a6;
            flex-shrink: 0;
        }

        .pet-details h3 {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            margin: 0 0 4px 0;
        }

        .pet-details p {
            font-size: 12px;
            color: #64748b;
            margin: 0;
        }

        .pet-info {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
        }

        .pet-link {
            padding: 8px 16px;
            background: linear-gradient(135deg, #14b8a6, #06b6d4);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            font-weight: 500;
            flex-shrink: 0;
        }

        .pet-link:hover {
            background: linear-gradient(135deg, #0d9488, #0891b2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 54px;
            color: #cbd5e1;
            margin-bottom: 16px;
        }

        /* Appointments */
        .appointments-section {
            margin-top: 32px;
            background: white;
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }

        .appointment-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            border-left: 3px solid #14b8a6;
            margin-bottom: 16px;
            transition: all 0.3s ease;
        }

        .appointment-item:hover {
            background: linear-gradient(135deg, #f0f4f8 0%, #e8ecf1 100%);
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.08);
            transform: translateX(2px);
        }

        .appointment-info h4 {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            margin: 0 0 4px 0;
        }

        .appointment-info p {
            font-size: 12px;
            color: #64748b;
            margin: 0;
            color: #9ca3af;
            margin: 4px 0 0 0;
        }

        @media (max-width: 768px) {
            .navbar-container {
                padding: 0 16px;
                height: 64px;
            }

            .navbar-title {
                font-size: 18px;
            }

            .navbar-center {
                display: none;
            }

            .main-content {
                padding: 24px 16px;
            }

            .page-title {
                font-size: 24px;
            }

            .cards-container {
                grid-template-columns: 1fr;
            }

            .navbar-end {
                gap: 8px;
            }

            .logout-btn {
                padding: 6px 12px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('customer.dashboard') }}" class="navbar-brand">
                <img src="{{ asset('newlogo.png') }}" alt="PAWSER" class="navbar-logo">
                <span class="navbar-title">PAWSER</span>
            </a>

            <div class="navbar-center">
                <a href="{{ route('customer.dashboard') }}" class="nav-item active">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
                <a href="{{ route('customer.pets.index') }}" class="nav-item">
                    <i class="bi bi-heart-pulse"></i>
                    My Pets
                </a>
                <a href="{{ route('customer.appointments.index') }}" class="nav-item">
                    <i class="bi bi-calendar2-check"></i>
                    Appointments
                </a>
            </div>

            <div class="navbar-end">
                <div class="user-menu">
                    <a href="{{ route('profile.show') }}" class="user-avatar" style="text-decoration: none;" title="View Profile">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </a>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="page-subtitle">{{ auth()->user()->email }}</p>
        </div>

        <!-- Quick Stats -->
        <div class="cards-container">
            <div class="card">
                <div class="card-title">
                    <i class="bi bi-paw"></i>
                    Total Pets
                </div>
                <div class="stat-number">{{ $pets->count() }}</div>
                <div class="card-content">
                    You have {{ $pets->count() }} pet{{ $pets->count() != 1 ? 's' : '' }} registered.
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <i class="bi bi-calendar-check"></i>
                    Upcoming Appointments
                </div>
                <div class="stat-number">{{ $appointments->count() }}</div>
                <div class="card-content">
                    {{ $appointments->count() }} appointment{{ $appointments->count() != 1 ? 's' : '' }} scheduled.
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div style="display: flex; gap: 12px; margin-bottom: 32px; flex-wrap: wrap;">
            <a href="{{ route('appointment-requests.create') }}" style="padding: 14px 24px; background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3); transition: all 0.3s; text-decoration: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(20, 184, 166, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(20, 184, 166, 0.3)'">
                <i class="bi bi-calendar-plus"></i>
                Request an Appointment
            </a>
            <a href="{{ route('customer.pets.index') }}" style="padding: 14px 24px; background: white; color: #14b8a6; border: 2px solid #14b8a6; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s;" onmouseover="this.style.background='#f0fdf4'" onmouseout="this.style.background='white'">
                <i class="bi bi-paw-fill"></i>
                View All Pets
            </a>
            <a href="{{ route('customer.appointments.index') }}" style="padding: 14px 24px; background: white; color: #06b6d4; border: 2px solid #06b6d4; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s;" onmouseover="this.style.background='#ecf9ff'" onmouseout="this.style.background='white'">
                <i class="bi bi-calendar3"></i>
                View All Appointments
            </a>
        </div>

        <!-- Pets List -->
        <div class="pets-section">
            <div class="section-title">
                <i class="bi bi-paw"></i>
                Your Pets
            </div>

            @if($pets->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>No pets registered yet.</p>
                    <p style="font-size: 12px; margin-top: 8px;">Contact your veterinary clinic to add your pet.</p>
                </div>
            @else
                <div class="pets-list">
                    @foreach($pets as $pet)
                        <div class="pet-item">
                            <div class="pet-info">
                                <div class="pet-icon">
                                    <i class="bi bi-paw-fill"></i>
                                </div>
                                <div class="pet-details">
                                    <h3>{{ $pet->pet_name }}</h3>
                                    <p>{{ $pet->species ?? 'Unknown species' }} • {{ $pet->breed ?? 'Unknown breed' }}</p>
                                </div>
                            </div>
                            <a href="{{ route('customer.pets.show', $pet) }}" class="pet-link">
                                <i class="bi bi-arrow-right"></i>
                                View Details
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Upcoming Appointments -->
        @if(!$appointments->isEmpty())
            <div class="appointments-section">
                <div class="section-title">
                    <i class="bi bi-calendar-check"></i>
                    Upcoming Appointments
                </div>
                @foreach($appointments->take(5) as $appointment)
                    <div class="appointment-item">
                        <div class="appointment-info">
                            <h4>{{ $appointment->patient->pet_name ?? 'Unknown Pet' }} - {{ $appointment->reason ?? 'General Checkup' }}</h4>
                            <p>
                                <i class="bi bi-calendar-event"></i>
                                {{ $appointment->appointment_date->format('M d, Y \a\t g:i A') }}
                            </p>
                        </div>
                        <a href="{{ route('customer.appointments.show', $appointment) }}" class="pet-link">
                            <i class="bi bi-arrow-right"></i>
                            View
                        </a>
                    </div>
                @endforeach
                @if($appointments->count() > 5)
                    <div style="text-align: center; margin-top: 16px;">
                        <a href="{{ route('customer.appointments.index') }}" class="pet-link">View All Appointments</a>
                    </div>
                @endif
            </div>
        @endif
    </div>
</body>
</html>
