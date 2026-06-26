<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>System Info - FURCARE Super Admin</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #FFF8F0; min-height: 100vh; }
        .navbar { background: #0f172a; color: white; height: 72px; display: flex; align-items: center; padding: 0 24px; position: fixed; top: 0; left: 0; right: 0; z-index: 100; justify-content: space-between; }
        .navbar-brand { display: flex; align-items: center; gap: 12px; text-decoration: none; color: white; }
        .navbar-brand-title { font-size: 18px; font-weight: 800; color: #f59e0b; }
        .navbar-brand-sub { font-size: 11px; opacity: 0.7; }
        .navbar-menu { display: flex; gap: 4px; }
        .nav-item { padding: 8px 14px; color: white; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 500; opacity: 0.8; display: flex; align-items: center; gap: 8px; transition: all 0.2s; }
        .nav-item:hover { opacity: 1; background: rgba(255,255,255,0.1); }
        .nav-item.active { background: rgba(245,158,11,0.2); color: #f59e0b; opacity: 1; font-weight: 700; }
        .navbar-end { display: flex; align-items: center; gap: 12px; }
        .user-badge { background: rgba(245,158,11,0.2); border: 1px solid rgba(245,158,11,0.4); color: #f59e0b; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
        .logout-btn { padding: 8px 11px; background: rgba(239,68,68,0.2); border: 1px solid rgba(239,68,68,0.4); color: #fca5a5; border-radius: 6px; cursor: pointer; font-size: 16px; }
        .main { padding: 104px 32px 32px; max-width: 800px; }
        .page-title { font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
        .page-sub { color: #64748b; font-size: 14px; margin-bottom: 28px; }
        .card { background: white; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 20px; }
        .card-header { padding: 18px 24px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; }
        .card-title { font-size: 16px; font-weight: 700; color: #0f172a; }
        .info-grid { display: grid; grid-template-columns: 200px 1fr; gap: 0; }
        .info-row { display: contents; }
        .info-label { padding: 14px 24px; font-size: 13px; font-weight: 600; color: #64748b; border-bottom: 1px solid #f1f5f9; background: #f8fafc; }
        .info-value { padding: 14px 24px; font-size: 14px; color: #0f172a; border-bottom: 1px solid #f1f5f9; }
        .info-label:last-of-type, .info-value:last-of-type { border-bottom: none; }
        .badge-env { display: inline-flex; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 700; background: #d1fae5; color: #065f46; }
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
            <a href="{{ route('super-admin.dashboard') }}" class="nav-item"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('super-admin.admins.index') }}" class="nav-item"><i class="bi bi-people"></i> Manage Admins</a>
            <a href="{{ route('super-admin.audit-logs') }}" class="nav-item"><i class="bi bi-journal-text"></i> Audit Logs</a>
            <a href="{{ route('super-admin.system') }}" class="nav-item active"><i class="bi bi-gear"></i> System</a>
            <a href="{{ route('dashboard') }}" class="nav-item"><i class="bi bi-arrow-left-right"></i> Provider View</a>
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
        <h1 class="page-title">System Information</h1>
        <p class="page-sub">Full system configuration and environment details.</p>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><i class="bi bi-info-circle" style="color:#f59e0b;"></i> Application</h2>
            </div>
            <div class="info-grid">
                <div class="info-label">Application Name</div>
                <div class="info-value">{{ $info['app_name'] }}</div>
                <div class="info-label">Environment</div>
                <div class="info-value"><span class="badge-env">{{ $info['environment'] }}</span></div>
                <div class="info-label">Database</div>
                <div class="info-value">{{ strtoupper($info['database']) }}</div>
                <div class="info-label">Timezone</div>
                <div class="info-value">{{ $info['timezone'] }}</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><i class="bi bi-cpu" style="color:#f59e0b;"></i> Server</h2>
            </div>
            <div class="info-grid">
                <div class="info-label">PHP Version</div>
                <div class="info-value">{{ $info['php_version'] }}</div>
                <div class="info-label">Laravel Version</div>
                <div class="info-value">{{ $info['laravel_ver'] }}</div>
            </div>
        </div>
    </div>
</body>
</html>