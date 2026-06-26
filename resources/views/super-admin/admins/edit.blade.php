<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Account - FURCARE Super Admin</title>
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
        .main { padding: 104px 32px 32px; max-width: 700px; }
        .back-btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; background: white; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #374151; font-size: 13px; font-weight: 600; margin-bottom: 20px; transition: all 0.2s; }
        .back-btn:hover { border-color: #f59e0b; color: #f59e0b; }
        .page-title { font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
        .page-sub { color: #64748b; font-size: 14px; margin-bottom: 28px; }
        .card { background: white; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; }
        .card-header { padding: 18px 24px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; }
        .card-title { font-size: 16px; font-weight: 700; color: #0f172a; }
        .card-body { padding: 28px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        label { font-size: 13px; font-weight: 600; color: #374151; }
        .required { color: #dc2626; }
        .form-control { padding: 10px 14px; border: 1.5px solid #d1d5db; border-radius: 8px; font-size: 14px; transition: all 0.2s; font-family: inherit; }
        .form-control:focus { outline: none; border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245,158,11,0.1); }
        .helper { font-size: 12px; color: #6b7280; }
        .form-actions { display: flex; gap: 12px; margin-top: 24px; padding-top: 20px; border-top: 1px solid #e2e8f0; justify-content: flex-end; }
        .btn { padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.2s; }
        .btn-primary { background: #f59e0b; color: white; }
        .btn-primary:hover { background: #d97706; }
        .btn-secondary { background: #e5e7eb; color: #374151; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
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
            <a href="{{ route('super-admin.admins.index') }}" class="nav-item active"><i class="bi bi-people"></i> Manage Admins</a>
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
        <a href="{{ route('super-admin.admins.index') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i> Back to Accounts
        </a>
        <h1 class="page-title">Edit Account</h1>
        <p class="page-sub">Update details for {{ $user->name }}.</p>

        @if($errors->any())
            <div class="alert-error"><i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Account Details</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('super-admin.admins.update', $user) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Full Name <span class="required">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Username <span class="required">*</span></label>
                            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address <span class="required">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="09XX-XXX-XXXX">
                        </div>
                        <div class="form-group">
                            <label>Role <span class="required">*</span></label>
                            <select name="role" class="form-control" required>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                                <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff Member</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>New Password <span class="helper">(leave blank to keep current)</span></label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="{{ route('super-admin.admins.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>