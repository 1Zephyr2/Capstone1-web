<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Settings - VetCare Admin</title>
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
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            padding: 32px;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 16px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .info-label {
            font-weight: 500;
            color: #64748b;
        }

        .info-value {
            color: #1e293b;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert.info {
            background: #dbeafe;
            border: 1px solid #93c5fd;
            color: #1e40af;
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
                <div class="logo-text">VetCare</div>
            </a>
            <div class="sidebar-subtitle">ADMIN PANEL</div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-section">
                <div class="menu-label">MAIN</div>
                <a href="{{ route('admin.dashboard') }}" class="menu-item">
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
                <a href="{{ route('admin.settings') }}" class="menu-item active">
                    <span class="menu-icon"><i class="bi bi-gear"></i></span>
                    <span class="menu-text">Settings</span>
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
                        <i class="bi bi-person-fill" style="font-size: 24px;"></i>
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
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">System Settings</h1>
            <p class="page-subtitle">System configuration and information</p>
        </div>

        <div class="alert info">
            <i class="bi bi-info-circle"></i>
            <div>
                <strong>Note:</strong> Advanced settings and configurations are managed through the system configuration files. Contact your system administrator for custom configurations.
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">System Information</h2>
            <div class="info-grid">
                <div class="info-label">Application Name:</div>
                <div class="info-value">VetCare - Veterinary Management System</div>

                <div class="info-label">Version:</div>
                <div class="info-value">1.0.0</div>

                <div class="info-label">Environment:</div>
                <div class="info-value">{{ config('app.env') }}</div>

                <div class="info-label">Database:</div>
                <div class="info-value">{{ config('database.default') }}</div>

                <div class="info-label">Timezone:</div>
                <div class="info-value">{{ config('app.timezone') }}</div>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">Data Privacy Compliance</h2>
            <p style="color: #64748b; margin-bottom: 16px;">
                This system is designed to comply with the Data Privacy Act of 2012 (Republic Act No. 10173) of the Philippines.
            </p>
            <div class="info-grid">
                <div class="info-label">Access Logging:</div>
                <div class="info-value">✓ Enabled (All pet record access is logged)</div>

                <div class="info-label">Role-Based Access:</div>
                <div class="info-value">✓ Enabled (Admin & Veterinary Provider roles)</div>

                <div class="info-label">Data Encryption:</div>
                <div class="info-value">✓ Enabled (Passwords hashed with bcrypt)</div>

                <div class="info-label">Audit Trail:</div>
                <div class="info-value">✓ Available (User activity tracking)</div>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">Quick Links</h2>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <a href="{{ route('admin.users.index') }}" style="color: #1e40af; text-decoration: none;">
                    <i class="bi bi-people"></i> Manage Users
                </a>
                <a href="{{ route('dashboard') }}" style="color: #1e40af; text-decoration: none;">
                    <i class="bi bi-arrow-left-right"></i> Switch to Provider View
                </a>
            </div>
        </div>
    </div>
</body>
</html>
