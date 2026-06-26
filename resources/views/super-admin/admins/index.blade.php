<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admins - FURCARE Super Admin</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #FFF8F0; min-height: 100vh; }
        .navbar {
            background: #0f172a; color: white; height: 72px;
            display: flex; align-items: center; padding: 0 24px;
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            justify-content: space-between;
        }
        .navbar-brand { display: flex; align-items: center; gap: 12px; text-decoration: none; color: white; }
        .navbar-brand-title { font-size: 18px; font-weight: 800; color: #f59e0b; }
        .navbar-brand-sub { font-size: 11px; opacity: 0.7; }
        .navbar-menu { display: flex; gap: 4px; }
        .nav-item { padding: 8px 14px; color: white; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 500; opacity: 0.8; display: flex; align-items: center; gap: 8px; transition: all 0.2s; }
        .nav-item:hover { opacity: 1; background: rgba(255,255,255,0.1); }
        .nav-item.active { background: rgba(245,158,11,0.2); color: #f59e0b; opacity: 1; font-weight: 700; }
        .navbar-end { display: flex; align-items: center; gap: 12px; }
        .user-badge { background: rgba(245,158,11,0.2); border: 1px solid rgba(245,158,11,0.4); color: #f59e0b; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
        .logout-btn { padding: 8px 11px; background: rgba(239,68,68,0.2); border: 1px solid rgba(239,68,68,0.4); color: #fca5a5; border-radius: 6px; cursor: pointer; font-size: 16px; transition: all 0.2s; }
        .logout-btn:hover { background: rgba(239,68,68,0.3); }
        .main { padding: 104px 32px 32px; }
        .page-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 28px; }
        .page-title { font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
        .page-sub { color: #64748b; font-size: 14px; }
        .btn { padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.2s; }
        .btn-primary { background: #f59e0b; color: white; }
        .btn-primary:hover { background: #d97706; transform: translateY(-2px); }
        .btn-edit { background: #eff6ff; color: #1e40af; }
        .btn-edit:hover { background: #dbeafe; }
        .btn-danger { background: #fee2e2; color: #991b1b; }
        .btn-danger:hover { background: #fecaca; }
        .card { background: white; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.06); overflow: hidden; }
        .card-header { padding: 18px 24px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; }
        .card-title { font-size: 16px; font-weight: 700; color: #0f172a; }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; padding: 10px 16px; border-bottom: 1.5px solid #e2e8f0; text-align: left; letter-spacing: 0.05em; }
        td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fafc; }
        .role-badge { display: inline-flex; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .role-admin { background: #dbeafe; color: #1e40af; }
        .role-staff { background: #d1fae5; color: #065f46; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .actions { display: flex; gap: 8px; }
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
            <a href="{{ route('super-admin.dashboard') }}" class="nav-item {{ request()->routeIs('super-admin.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('super-admin.admins.index') }}" class="nav-item {{ request()->routeIs('super-admin.admins.*') ? 'active' : '' }}"><i class="bi bi-people"></i> Manage Admins</a>
            <a href="{{ route('super-admin.audit-logs') }}" class="nav-item"><i class="bi bi-journal-text"></i> Audit Logs</a>
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

    <div class="main">
        @if(session('success'))
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error"><i class="bi bi-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        <div class="page-header">
            <div>
                <h1 class="page-title">Manage Admin & Staff Accounts</h1>
                <p class="page-sub">Create, edit, or remove administrator and staff accounts.</p>
            </div>
            <a href="{{ route('super-admin.admins.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus"></i> Add New Account
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">All Admin & Staff ({{ $users->total() }})</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td style="font-weight:700;">{{ $user->name }}</td>
                        <td style="color:#64748b;">{{ $user->username }}</td>
                        <td style="color:#64748b;">{{ $user->email }}</td>
                        <td style="color:#64748b;">{{ $user->phone ?? '-' }}</td>
                        <td>
                            <span class="role-badge {{ $user->role === 'admin' ? 'role-admin' : 'role-staff' }}">
                                {{ $user->role_name }}
                            </span>
                        </td>
                        <td style="color:#64748b;">{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('super-admin.admins.edit', $user) }}" class="btn btn-edit" style="padding:6px 12px; font-size:12px;">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('super-admin.admins.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this account?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:6px 12px; font-size:12px;">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($users->hasPages())
            <div style="padding:16px 24px; border-top:1px solid #e2e8f0;">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>
</body>
</html>