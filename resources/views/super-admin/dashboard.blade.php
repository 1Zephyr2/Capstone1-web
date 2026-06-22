<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard - FURCARE</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; min-height: 100vh; }
        .navbar {
            background: #0f172a;
            color: white;
            height: 72px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            justify-content: space-between;
        }
        .navbar-brand { display: flex; align-items: center; gap: 12px; text-decoration: none; color: white; }
        .navbar-brand-title { font-size: 18px; font-weight: 800; color: #f59e0b; }
        .navbar-brand-sub { font-size: 11px; opacity: 0.7; }
        .navbar-menu { display: flex; gap: 4px; }
        .nav-item {
            padding: 8px 14px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            opacity: 0.8;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .nav-item:hover { opacity: 1; background: rgba(255,255,255,0.1); }
        .nav-item.active { background: rgba(245,158,11,0.2); color: #f59e0b; opacity: 1; font-weight: 700; }
        .navbar-end { display: flex; align-items: center; gap: 12px; }
        .user-badge {
            background: rgba(245,158,11,0.2);
            border: 1px solid rgba(245,158,11,0.4);
            color: #f59e0b;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }
        .logout-btn {
            padding: 8px 11px;
            background: rgba(239,68,68,0.2);
            border: 1px solid rgba(239,68,68,0.4);
            color: #fca5a5;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.2s;
        }
        .logout-btn:hover { background: rgba(239,68,68,0.3); }
        .main { padding: 104px 32px 32px; }
        .page-title { font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
        .page-sub { color: #64748b; font-size: 14px; margin-bottom: 28px; }
        .super-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 28px; }
        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            transition: all 0.3s;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
        .stat-label { font-size: 13px; color: #64748b; font-weight: 500; margin-bottom: 8px; }
        .stat-value { font-size: 36px; font-weight: 800; color: #0f172a; }
        .stat-icon { font-size: 28px; margin-bottom: 12px; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }
        .card { background: white; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.06); overflow: hidden; }
        .card-header { padding: 18px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
        .card-title { font-size: 16px; font-weight: 700; color: #0f172a; }
        .card-body { padding: 24px; }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; padding: 8px 12px; border-bottom: 1.5px solid #e2e8f0; text-align: left; }
        td { padding: 12px; font-size: 14px; border-bottom: 1px solid #f1f5f9; }
        tr:last-child td { border-bottom: none; }
        .role-badge { display: inline-flex; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .role-admin { background: #dbeafe; color: #1e40af; }
        .role-staff { background: #d1fae5; color: #065f46; }
        .quick-action {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            color: inherit;
            margin-bottom: 10px;
            transition: all 0.2s;
        }
        .quick-action:hover { border-color: #f59e0b; background: #fffbeb; transform: translateX(4px); }
        .qa-icon { width: 40px; height: 40px; border-radius: 10px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .qa-title { font-weight: 700; font-size: 14px; color: #0f172a; }
        .qa-desc { font-size: 12px; color: #64748b; }
        .alert-super {
            background: linear-gradient(135deg, #fef3c7, #fffbeb);
            border: 1px solid #f59e0b;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #92400e;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('super-admin.dashboard') }}" class="navbar-brand">
            <img src="{{ asset('newlogo.png') }}" alt="FURCARE" style="height:36px;" onerror="this.style.display='none'">
            <div>
                <div class="navbar-brand-title">FURCARE</div>
                <div class="navbar-brand-sub">Super Admin Panel</div>
            </div>
        </a>
        <div class="navbar-menu">
            <a href="{{ route('super-admin.dashboard') }}" class="nav-item {{ request()->routeIs('super-admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('super-admin.admins.index') }}" class="nav-item {{ request()->routeIs('super-admin.admins.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Manage Admins
            </a>
            <a href="{{ route('super-admin.audit-logs') }}" class="nav-item {{ request()->routeIs('super-admin.audit-logs') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i> Audit Logs
            </a>
            <a href="{{ route('super-admin.system') }}" class="nav-item {{ request()->routeIs('super-admin.system') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> System
            </a>
            <a href="{{ route('dashboard') }}" class="nav-item">
                <i class="bi bi-arrow-left-right"></i> Provider View
            </a>
        </div>
        <div class="navbar-end">
            <span class="user-badge"><i class="bi bi-shield-fill-check"></i> Super Admin</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn"><i class="bi bi-box-arrow-right"></i></button>
            </form>
        </div>
    </nav>

    <div class="main">
        <div class="super-badge"><i class="bi bi-shield-fill-check"></i> Super Administrator Access</div>
        <h1 class="page-title">Super Admin Dashboard</h1>
        <p class="page-sub">Full system control and management</p>

        <div class="alert-super">
            <i class="bi bi-exclamation-triangle-fill" style="font-size:20px; color:#f59e0b;"></i>
            <div><strong>Super Admin Mode:</strong> You have full access to all system functions including creating/deleting admin accounts and viewing audit logs.</div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="color:#1e40af;">👤</div>
                <div class="stat-label">Total Admins</div>
                <div class="stat-value">{{ $stats['total_admins'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color:#059669;">👥</div>
                <div class="stat-label">Total Staff</div>
                <div class="stat-value">{{ $stats['total_staff'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color:#7c3aed;">🐾</div>
                <div class="stat-label">Pet Owners</div>
                <div class="stat-value">{{ $stats['total_customers'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color:#0891b2;">🐶</div>
                <div class="stat-label">Total Pets</div>
                <div class="stat-value">{{ $stats['total_pets'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color:#d97706;">📅</div>
                <div class="stat-label">Total Appointments</div>
                <div class="stat-value">{{ $stats['total_appointments'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color:#dc2626;">✅</div>
                <div class="stat-label">Total Visits</div>
                <div class="stat-value">{{ $stats['total_visits'] }}</div>
            </div>
        </div>

        <div class="content-grid">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Recent Admin & Staff Accounts</h2>
                    <a href="{{ route('super-admin.admins.index') }}" style="font-size:13px; color:#f59e0b; text-decoration:none; font-weight:600;">View All →</a>
                </div>
                <div class="card-body" style="padding:0;">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentAdmins as $admin)
                            <tr>
                                <td style="font-weight:600;">{{ $admin->name }}</td>
                                <td style="color:#64748b;">{{ $admin->username }}</td>
                                <td style="color:#64748b;">{{ $admin->email }}</td>
                                <td>
                                    <span class="role-badge {{ $admin->role === 'admin' ? 'role-admin' : 'role-staff' }}">
                                        {{ $admin->role_name }}
                                    </span>
                                </td>
                                <td style="color:#64748b;">{{ $admin->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Quick Actions</h2>
                </div>
                <div class="card-body">
                    <a href="{{ route('super-admin.admins.create') }}" class="quick-action">
                        <div class="qa-icon"><i class="bi bi-person-plus"></i></div>
                        <div>
                            <div class="qa-title">Add Admin/Staff</div>
                            <div class="qa-desc">Create new admin or staff account</div>
                        </div>
                    </a>
                    <a href="{{ route('super-admin.admins.index') }}" class="quick-action">
                        <div class="qa-icon"><i class="bi bi-people"></i></div>
                        <div>
                            <div class="qa-title">Manage Accounts</div>
                            <div class="qa-desc">Edit or remove admin/staff accounts</div>
                        </div>
                    </a>
                    <a href="{{ route('super-admin.audit-logs') }}" class="quick-action">
                        <div class="qa-icon"><i class="bi bi-journal-text"></i></div>
                        <div>
                            <div class="qa-title">View Audit Logs</div>
                            <div class="qa-desc">Track all system activity</div>
                        </div>
                    </a>
                    <a href="{{ route('super-admin.system') }}" class="quick-action">
                        <div class="qa-icon"><i class="bi bi-gear"></i></div>
                        <div>
                            <div class="qa-title">System Info</div>
                            <div class="qa-desc">View system configuration</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>