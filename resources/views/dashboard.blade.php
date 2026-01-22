<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - VaxLog</title>
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
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #059669 0%, #047857 100%);
            color: white;
            padding: 24px 0;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 0 24px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: #f59e0b;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 600;
        }

        .sidebar-subtitle {
            font-size: 12px;
            opacity: 0.9;
            padding-left: 52px;
        }

        .sidebar-menu {
            margin-top: 24px;
        }

        .menu-section {
            margin-bottom: 24px;
        }

        .menu-label {
            padding: 0 24px;
            font-size: 11px;
            text-transform: uppercase;
            opacity: 0.7;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .menu-item {
            margin: 0 16px 8px 16px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .menu-text {
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Sidebar Activities */
        .sidebar-activities {
            padding: 16px;
            margin-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .activities-header {
            font-size: 13px;
            font-weight: 600;
            color: white;
            margin-bottom: 12px;
            padding: 0 8px;
        }

        .sidebar-activity-item {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 8px;
            display: flex;
            gap: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-activity-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .sidebar-activity-content {
            flex: 1;
            min-width: 0;
        }

        .sidebar-activity-title {
            font-size: 11px;
            color: white;
            font-weight: 500;
            margin-bottom: 2px;
            line-height: 1.3;
        }

        .sidebar-activity-time {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 4px;
        }

        .sidebar-activity-badge {
            display: inline-block;
            font-size: 9px;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 500;
        }

        .sidebar-activity-badge.completed {
            background: rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
        }

        .sidebar-activity-badge.scheduled {
            background: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
        }

        .sidebar-activity-badge.pending {
            background: rgba(251, 191, 36, 0.2);
            color: #fcd34d;
        }

        /* Top Navigation */
        .top-nav {
            background: white;
            padding: 16px 32px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-nav-left h1 {
            font-size: 24px;
            color: #1f2937;
        }

        .top-nav-left p {
            font-size: 14px;
            color: #6b7280;
            margin-top: 4px;
        }

        .top-nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #059669 0%, #f59e0b 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-details {
            text-align: right;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        .user-role {
            font-size: 12px;
            color: #6b7280;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s ease;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        /* Dashboard Content */
        .dashboard-content {
            padding: 32px;
            flex: 1;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .action-card {
            background: #FFFFFF;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid #E5E7EB;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: currentColor;
        }

        .action-card:nth-child(1) { color: #3B82F6; }
        .action-card:nth-child(2) { color: #10B981; }
        .action-card:nth-child(3) { color: #8B5CF6; }
        .action-card:nth-child(4) { color: #F59E0B; }

        .action-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .action-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .action-icon.blue {
            background: #EFF6FF;
            color: #3B82F6;
        }

        .action-icon.green {
            background: #ECFDF5;
            color: #10B981;
        }

        .action-icon.purple {
            background: #F5F3FF;
            color: #8B5CF6;
        }

        .action-icon.orange {
            background: #FEF3C7;
            color: #F59E0B;
        }

        .action-details h3 {
            font-size: 15px;
            color: #111827;
            font-weight: 600;
            margin-bottom: 4px;
            letter-spacing: -0.01em;
        }

        .action-details p {
            font-size: 13px;
            color: #6B7280;
            font-weight: 400;
        }

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: #FFFFFF;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            transition: all 0.2s ease;
            border: 1px solid #E5E7EB;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .stat-card:nth-child(1)::before,
        .stat-card:nth-child(2)::before {
            background: #10B981;
        }

        .stat-card:nth-child(3)::before,
        .stat-card:nth-child(4)::before {
            background: #F59E0B;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .stat-title {
            font-size: 13px;
            color: #6B7280;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }

        .stat-change {
            font-size: 13px;
            color: #10B981;
            font-weight: 500;
        }

        .stat-change.negative {
            color: #ef4444;
        }

        /* Recent Activity Section */
        .section-header {
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 20px;
            color: #1f2937;
            font-weight: 600;
        }

        .collapsible-content.collapsed {
            max-height: 0;
        }

        .activity-card {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .activity-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            background: #f3f4f6;
        }

        .activity-details {
            flex: 1;
        }

        .activity-title {
            font-size: 14px;
            color: #1f2937;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .activity-time {
            font-size: 12px;
            color: #6b7280;
        }

        .activity-status {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-completed { background: #dcfce7; color: #166534; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-scheduled { background: #dbeafe; color: #1e40af; }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .sidebar.collapsed {
                width: 70px;
            }

            .main-content {
                margin-left: 70px;
            }

            .sidebar-header .logo-text,
            .sidebar-subtitle,
            .menu-text,
            .menu-label {
                display: none;
            }

            .menu-item {
                justify-content: center;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <div class="logo-icon">V</div>
                <div class="logo-text">VaxLog</div>
            </div>
            <div class="sidebar-subtitle">Health Center System</div>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-section">
                <div class="menu-label">Main</div>
                <a href="{{ route('dashboard') }}" class="menu-item active">
                    <span class="menu-icon">📊</span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-label">Patient Management</div>
                <a href="{{ route('medical.records') }}" class="menu-item">
                    <span class="menu-icon">📋</span>
                    <span class="menu-text">Medical Records</span>
                </a>
                <a href="{{ route('patients.list') }}" class="menu-item">
                    <span class="menu-icon">👥</span>
                    <span class="menu-text">Patient List</span>
                </a>
                <a href="{{ route('patients.new') }}" class="menu-item">
                    <span class="menu-icon">➕</span>
                    <span class="menu-text">New Patient</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-label">Appointments</div>
                <a href="{{ route('appointments.schedule') }}" class="menu-item">
                    <span class="menu-icon">📅</span>
                    <span class="menu-text">Schedule</span>
                </a>
                <a href="{{ route('appointments.queue') }}" class="menu-item">
                    <span class="menu-icon">🕐</span>
                    <span class="menu-text">Today's Queue</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-label">Services</div>
                <a href="{{ route('immunizations.index') }}" class="menu-item">
                    <span class="menu-icon">💉</span>
                    <span class="menu-text">Immunization</span>
                </a>
                <a href="{{ route('prenatal.care') }}" class="menu-item">
                    <span class="menu-icon">🤰</span>
                    <span class="menu-text">Prenatal Care</span>
                </a>
                <a href="{{ route('general.checkup') }}" class="menu-item">
                    <span class="menu-icon">🏥</span>
                    <span class="menu-text">General Checkup</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-label">Tools</div>
                <a href="{{ route('ai.support') }}" class="menu-item">
                    <span class="menu-icon">🤖</span>
                    <span class="menu-text">AI Assistant</span>
                </a>
                <a href="{{ route('reports') }}" class="menu-item">
                    <span class="menu-icon">📊</span>
                    <span class="menu-text">Reports</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navigation -->
        <header class="top-nav">
            <div class="top-nav-left">
                <h1>Good {{ date('A') === 'AM' ? 'Morning' : 'Afternoon' }}, {{ Auth::user()->name }}!</h1>
                <p>{{ date('l, F j, Y') }}</p>
            </div>
            <div class="top-nav-right">
                <div class="user-info">
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-role">Health Center Staff</div>
                    </div>
                    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="dashboard-content">
            <!-- Quick Actions -->
            <div class="quick-actions">
                <a href="{{ route('patients.new') }}" class="action-card">
                    <div class="action-icon blue">📋</div>
                    <div class="action-details">
                        <h3>New Patient Record</h3>
                        <p>Create medical record</p>
                    </div>
                </a>

                <a href="{{ route('appointments.book') }}" class="action-card">
                    <div class="action-icon green">📅</div>
                    <div class="action-details">
                        <h3>Book Appointment</h3>
                        <p>Schedule new visit</p>
                    </div>
                </a>

                <a href="{{ route('patients.search') }}" class="action-card">
                    <div class="action-icon purple">👥</div>
                    <div class="action-details">
                        <h3>Patient Search</h3>
                        <p>Find patient records</p>
                    </div>
                </a>

                <a href="{{ route('ai.support') }}" class="action-card">
                    <div class="action-icon orange">🤖</div>
                    <div class="action-details">
                        <h3>AI Decision Support</h3>
                        <p>Get health insights</p>
                    </div>
                </a>
            </div>

            <!-- Statistics -->
            <div class="stats-grid">
                    <a href="{{ route('patients.today') }}" class="stat-card">
                        <div class="stat-header">
                            <span class="stat-title">Today's Patients</span>
                            <div class="stat-icon" style="background: #ECFDF5; color: #10B981;">👥</div>
                        </div>
                        <div class="stat-value">24</div>
                        <div class="stat-change">↑ 12% from yesterday</div>
                    </a>

                    <a href="{{ route('appointments.today') }}" class="stat-card">
                        <div class="stat-header">
                            <span class="stat-title">Appointments Today</span>
                            <div class="stat-icon" style="background: #ECFDF5; color: #10B981;">📅</div>
                        </div>
                        <div class="stat-value">18</div>
                        <div class="stat-change">5 pending</div>
                    </a>

                    <a href="{{ route('patients.all') }}" class="stat-card">
                        <div class="stat-header">
                            <span class="stat-title">Total Patients</span>
                            <div class="stat-icon" style="background: #FEF3C7; color: #F59E0B;">📊</div>
                        </div>
                        <div class="stat-value">1,247</div>
                        <div class="stat-change">↑ 8% this month</div>
                    </a>

                    <a href="{{ route('immunizations.index') }}" class="stat-card">
                        <div class="stat-header">
                            <span class="stat-title">Immunizations</span>
                            <div class="stat-icon" style="background: #FEF3C7; color: #F59E0B;">💉</div>
                        </div>
                        <div class="stat-value">156</div>
                        <div class="stat-change">This month</div>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
