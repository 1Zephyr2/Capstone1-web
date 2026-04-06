<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - PAWSER Admin</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --app-font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body,
        input,
        select,
        textarea,
        button,
        table,
        th,
        td,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        label,
        small,
        strong,
        em,
        li,
        span,
        div {
            font-family: var(--app-font-family) !important;
        }

        body {
            font-family: var(--app-font-family);
            background: #f8fafc;
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
            margin-left: 0;
            padding: 104px 32px 32px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #1e293b;
        }

        .btn-primary {
            padding: 12px 24px;
            background: #1e40af;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: #1e3a8a;
        }

        .tab-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .tab-link {
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border: 1px solid #cbd5e1;
            color: #334155;
            background: #f8fafc;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .tab-link:hover {
            background: #eef2ff;
            border-color: #94a3b8;
            color: #1e293b;
            transform: translateY(-1px);
        }

        .tab-link.active {
            background: rgba(20, 184, 166, 0.18);
            border-color: #14b8a6;
            color: #0f766e;
        }

        .tab-count {
            padding: 2px 8px;
            border-radius: 999px;
            background: rgba(148, 163, 184, 0.2);
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }

        .tab-link.active .tab-count {
            background: rgba(20, 184, 166, 0.2);
            color: #0f766e;
        }

        /* Alerts */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert.success {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
        }

        .alert.error {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        /* Table */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            padding: 16px 24px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 16px 24px;
            border-bottom: 1px solid #f1f5f9;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background: #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge.admin {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge.provider {
            background: #dcfce7;
            color: #059669;
        }

        .badge.staff {
            background: #dcfce7;
            color: #059669;
        }

        .badge.customer {
            background: #fef3c7;
            color: #b45309;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
        }

        .btn-edit {
            background: #dbeafe;
            color: #1e40af;
        }

        .btn-edit:hover {
            background: #bfdbfe;
        }

        .btn-delete {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        .pagination {
            padding: 24px;
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .pagination a:hover {
            background: #f8fafc;
        }

        .pagination .active {
            background: #1e40af;
            color: white;
            border-color: #1e40af;
        }
    </style>
</head>
<body>
    <x-admin-navbar />

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">User Management</h1>
            <a href="{{ route('admin.users.create') }}" class="btn-primary">
                <i class="bi bi-person-plus"></i>
                Add New User
            </a>
        </div>

        <div class="tab-bar">
            <a href="{{ route('admin.users.index', ['tab' => 'staff']) }}" class="tab-link {{ $activeTab === 'staff' ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                Staff Accounts
                <span class="tab-count">{{ $staffCount }}</span>
            </a>
            <a href="{{ route('admin.users.index', ['tab' => 'pet_owners']) }}" class="tab-link {{ $activeTab === 'pet_owners' ? 'active' : '' }}">
                <i class="bi bi-heart"></i>
                Pet Owner Accounts
                <span class="tab-count">{{ $petOwnerCount }}</span>
            </a>
        </div>

        @if(session('success'))
            <div class="alert success">
                <i class="bi bi-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert error">
                <i class="bi bi-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="card">
            <div class="table-container">
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
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $user->role === 'admin' ? 'admin' : ($user->role === 'customer' ? 'customer' : 'staff') }}">
                                        {{ $user->role_name }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('M j, Y') }}</td>
                                <td>
                                    <div class="actions">
                                        @if($user->role !== 'customer')
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn-sm btn-edit">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        @endif
                                        @if($user->id !== Auth::id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-sm btn-delete">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 40px; color: #64748b;">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="pagination">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>

