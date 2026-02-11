<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.ico?v={{ time() }}">
    <title>Admin Dashboard - CareSync</title>
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
            min-height: 100vh;
            scroll-behavior: smooth;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #1e40af 0%, #1e3a8a 100%);
            color: white;
            padding: 24px 0 0 0;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 8px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 0;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            transition: opacity 0.2s;
        }
        
        .logo-container:hover {
            opacity: 0.8;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.3);
        }

        .logo-text {
            font-size: 22px;
            font-weight: 600;
        }

        .sidebar-subtitle {
            font-size: 12px;
            opacity: 0.9;
            padding-left: 0;
            text-align: left;
            margin-top: 8px;
        }

        .sidebar-menu {
            margin-top: 12px;
        }

        .menu-section {
            margin-bottom: 16px;
        }

        .menu-label {
            padding: 0 24px;
            font-size: 11px;
            text-transform: uppercase;
            opacity: 0.7;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .menu-item {
            margin: 0 16px 6px 16px;
            padding: 10px 16px;
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

        /* User Section */
        .user-section {
            padding: 14px 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: auto;
        }

        .user-info-sidebar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .user-avatar-sidebar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            overflow: hidden;
        }

        .user-avatar-sidebar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-details-sidebar {
            flex: 1;
        }

        .user-name-sidebar {
            font-weight: 500;
            font-size: 14px;
        }

        .user-role-sidebar {
            font-size: 12px;
            opacity: 0.8;
        }

        .logout-btn-sidebar {
            width: 100%;
            padding: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logout-btn-sidebar:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 32px;
            background: linear-gradient(to bottom, #f8fafc 0%, #f1f5f9 100%);
        }

        .page-header {
            margin-bottom: 32px;
            animation: slideUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #1e293b 0%, #1e40af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            animation: slideUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 0;
            background: #1e40af;
            transition: height 0.3s ease;
        }

        .stat-card:hover::before {
            height: 4px;
        }

        .stat-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08), 0 8px 32px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .stat-title {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            transition: transform 0.3s ease;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1);
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            color: #1e40af;
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            color: #059669;
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%);
            color: #7c3aed;
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            color: #F59E0B;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.02em;
            transition: transform 0.3s ease;
        }

        .stat-card:hover .stat-value {
            transform: scale(1.05);
        }

        .stat-change {
            font-size: 12px;
            color: #64748b;
            margin-top: 8px;
        }

        /* Content Sections */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
            animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
        }

        .card-action {
            font-size: 14px;
            color: #1e40af;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
        }

        .card-action:hover {
            color: #1e3a8a;
            background: rgba(30, 64, 175, 0.1);
            transform: translateX(4px);
        }

        .card-body {
            padding: 24px;
        }

        .activity-item {
            display: flex;
            gap: 16px;
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            border-radius: 8px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .activity-item:hover {
            background: #f8fafc;
            transform: translateX(4px);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-date {
            font-size: 12px;
            color: #64748b;
            min-width: 80px;
            font-weight: 500;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
            font-size: 15px;
            transition: color 0.2s ease;
        }

        .activity-item:hover .activity-title {
            color: #1e40af;
        }

        .activity-count {
            font-size: 24px;
            font-weight: 600;
            color: #1e40af;
        }

        .quick-actions {
            display: grid;
            gap: 12px;
        }

        .action-btn {
            padding: 18px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            background: white;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .action-btn:hover {
            background: #f8fafc;
            border-color: #1e40af;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08), 0 8px 32px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }

        .action-btn .action-btn-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            color: #1e40af;
            font-size: 20px;
            transition: transform 0.3s ease;
        }

        .action-btn:hover .action-btn-icon {
            transform: scale(1.1);
        }

        .action-btn i {
            font-size: 20px;
            color: #1e40af;
        }

        .action-btn-text {
            flex: 1;
        }

        .action-btn-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
            font-size: 15px;
            letter-spacing: -0.01em;
            transition: color 0.3s ease;
        }

        .action-btn:hover .action-btn-title {
            color: #1e40af;
        }

        .action-btn-desc {
            font-size: 13px;
            color: #64748b;
            line-height: 1.4;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert.info {
            background: #dbeafe;
            border: 1px solid #93c5fd;
            color: #1e40af;
        }

        .alert i {
            font-size: 20px;
        }

        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="logo-container">
                <div class="logo-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div class="logo-text">CareSync</div>
            </a>
            <div class="sidebar-subtitle">ADMIN PANEL</div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-section">
                <div class="menu-label">MAIN</div>
                <a href="{{ route('admin.dashboard') }}" class="menu-item active">
                    <span class="menu-icon"><i class="bi bi-speedometer2"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="menu-item">
                    <span class="menu-icon"><i class="bi bi-people"></i></span>
                    <span class="menu-text">User Management</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-label">SYSTEM</div>
                <a href="{{ route('admin.settings') }}" class="menu-item">
                    <span class="menu-icon"><i class="bi bi-gear"></i></span>
                    <span class="menu-text">Settings</span>
                </a>
                <a href="{{ route('reports.index') }}" class="menu-item">
                    <span class="menu-icon"><i class="bi bi-file-earmark-bar-graph"></i></span>
                    <span class="menu-text">Reports</span>
                </a>
            </div>
        </div>

        <div class="user-section">
            <div class="user-info-sidebar">
                @if(Auth::user()->profile_picture)
                    <div class="user-avatar-sidebar">
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}">
                    </div>
                @else
                    <div class="user-avatar-sidebar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div class="user-details-sidebar">
                    <div class="user-name-sidebar">{{ Auth::user()->name }}</div>
                    <div class="user-role-sidebar">Administrator</div>
                </div>
            </div>
            <a href="{{ route('profile.show') }}" class="logout-btn-sidebar" style="text-decoration: none; margin-bottom: 8px;">
                <i class="bi bi-person-circle"></i> My Profile
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn-sidebar">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Admin Dashboard</h1>
            <p class="page-subtitle">System overview and management</p>
        </div>

        <!-- Data Privacy Notice -->
        <div class="alert info">
            <i class="bi bi-shield-check"></i>
            <div>
                <strong>Data Privacy Compliant:</strong> This dashboard shows only anonymized statistics. Patient identifiable information is restricted to authorized healthcare providers.
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Total Patients</div>
                    <div class="stat-icon blue">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['total_patients']) }}</div>
                <div class="stat-change">Registered in system</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Visits This Month</div>
                    <div class="stat-icon green">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['total_visits_this_month']) }}</div>
                <div class="stat-change">{{ now()->format('F Y') }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Appointments Today</div>
                    <div class="stat-icon purple">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['total_appointments_today']) }}</div>
                <div class="stat-change">{{ now()->format('F j, Y') }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">System Users</div>
                    <div class="stat-icon orange">
                        <i class="bi bi-person-badge"></i>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['total_users']) }}</div>
                <div class="stat-change">{{ $stats['admin_count'] }} Admins, {{ $stats['staff_count'] }} Staff</div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Recent Activity (Last 7 Days)</h2>
                </div>
                <div class="card-body">
                    @if($recentVisits->count() > 0)
                        @foreach($recentVisits as $visit)
                            <div class="activity-item">
                                <div class="activity-date">
                                    {{ \Carbon\Carbon::parse($visit->date)->format('M j') }}
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Patient Visits</div>
                                    <div class="activity-count">{{ $visit->count }}</div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p style="color: #64748b; text-align: center; padding: 20px;">No recent activity</p>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Quick Actions</h2>
                </div>
                <div class="card-body">
                    <div class="quick-actions">
                        <a href="{{ route('admin.users.create') }}" class="action-btn">
                            <div class="action-btn-icon">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div class="action-btn-text">
                                <div class="action-btn-title">Add User</div>
                                <div class="action-btn-desc">Create new admin or provider account</div>
                            </div>
                        </a>

                        <a href="{{ route('admin.users.index') }}" class="action-btn">
                            <div class="action-btn-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="action-btn-text">
                                <div class="action-btn-title">Manage Users</div>
                                <div class="action-btn-desc">View and edit user accounts</div>
                            </div>
                        </a>

                        <a href="{{ route('reports.index') }}" class="action-btn">
                            <div class="action-btn-icon">
                                <i class="bi bi-file-earmark-bar-graph"></i>
                            </div>
                            <div class="action-btn-text">
                                <div class="action-btn-title">View Reports</div>
                                <div class="action-btn-desc">Access anonymized system reports</div>
                            </div>
                        </a>

                        <a href="{{ route('admin.settings') }}" class="action-btn">
                            <div class="action-btn-icon">
                                <i class="bi bi-gear"></i>
                            </div>
                            <div class="action-btn-text">
                                <div class="action-btn-title">System Settings</div>
                                <div class="action-btn-desc">Configure clinic information</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
