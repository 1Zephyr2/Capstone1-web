<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Audit Logs - FURCARE Super Admin</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; min-height: 100vh; }
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
        .main { padding: 104px 32px 32px; }
        .page-title { font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
        .page-sub { color: #64748b; font-size: 14px; margin-bottom: 28px; }
        .card { background: white; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; }
        .card-header { padding: 18px 24px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; }
        .card-title { font-size: 16px; font-weight: 700; color: #0f172a; }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; padding: 10px 16px; border-bottom: 1.5px solid #e2e8f0; text-align: left; }
        td { padding: 12px 16px; font-size: 13px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fafc; }
        .action-badge { display: inline-flex; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; background: #dbeafe; color: #1e40af; }
        .empty { padding: 48px; text-align: center; color: #94a3b8; }
        .empty i { font-size: 40px; display: block; margin-bottom: 12px; }
    </style>
</head>
<body>
    @if(Auth::user()->isSuperAdmin())
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
        <a href="{{ route('super-admin.audit-logs') }}" class="nav-item active"><i class="bi bi-journal-text"></i> Audit Logs</a>
        <a href="{{ route('super-admin.system') }}" class="nav-item"><i class="bi bi-gear"></i> System</a>
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
@else
<x-admin-navbar />
@endif

    <div class="main">
        <h1 class="page-title">Audit Logs</h1>
        <p class="page-sub">Track all system activity and user actions.</p>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">System Activity Log</h2>
            </div>
            @if($logs->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td style="color:#64748b; white-space:nowrap;">
                            {{ $log->created_at->format('M d, Y H:i') }}
                        </td>
                        <td style="font-weight:600;">{{ $log->user?->name ?? 'System' }}</td>
                        <td><span class="action-badge">{{ $log->action ?? '-' }}</span></td>
                        <td style="color:#374151;">{{ $log->description ?? '-' }}</td>
                        <td style="color:#64748b;">{{ $log->ip_address ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="padding:16px 24px; border-top:1px solid #e2e8f0;">
                {{ $logs->links() }}
            </div>
            @else
            <div class="empty">
                <i class="bi bi-journal-x"></i>
                No audit logs found.
            </div>
            @endif
        </div>
    </div>
</body>
</html>