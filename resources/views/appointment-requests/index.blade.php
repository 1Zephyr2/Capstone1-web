<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Requests - FURCARE</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>

        :root {
            --bg: #f8fafc;
            --bg-alt: #f0f9ff;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #6b7280;
            --line: #e5e7eb;
            --primary: #14b8a6;
            --primary-strong: #0d9488;
            --accent: #06b6d4;
            --accent-strong: #0891b2;
            --shadow-sm: 0 4px 14px rgba(15, 23, 42, 0.08);
            --shadow-lg: 0 20px 40px rgba(15, 23, 42, 0.12);
            --radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--bg) 0%, var(--bg-alt) 100%);
            padding: 0;
            padding-top: 72px;
            min-height: 100vh;
            color: var(--text);
            display: flex;
            flex-direction: column;
        }

        /* Top Navigation Bar */
        .navbar {
            background: #1e293b;
            color: white;
            padding: 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            height: 72px;
        }

        .navbar i.bi {
            font-family: bootstrap-icons;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 0 24px;
            gap: 24px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .navbar-brand:hover {
            opacity: 0.8;
            transform: translateY(-2px);
        }

        .navbar-logo {
            height: 40px;
            width: 40px;
            object-fit: contain;
        }

        .navbar-brand-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .navbar-title {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }

        .navbar-subtitle {
            font-size: 11px;
            opacity: 0.8;
            margin: 0;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 6px;
            flex: 1;
            justify-content: center;
        }

        .navbar-item {
            padding: 8px 14px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .navbar-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateY(-2px);
        }

        .navbar-item.active {
            background: rgba(20, 184, 166, 0.15);
            color: #14b8a6;
            border-bottom: 2px solid #14b8a6;
        }

        .navbar-end {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .navbar-avatar:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.08);
        }

        .navbar-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .navbar-user-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .navbar-user-name {
            font-size: 13px;
            font-weight: 600;
            color: white;
        }

        .navbar-user-role {
            font-size: 11px;
            opacity: 0.7;
        }

        .navbar-profile-btn {
            padding: 6px 12px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .navbar-profile-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        .navbar-logout-btn {
            padding: 6px 12px;
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .navbar-logout-btn:hover {
            background: rgba(239, 68, 68, 0.25);
            border-color: rgba(239, 68, 68, 0.5);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .navbar-menu {
                gap: 4px;
            }

            .navbar-item {
                padding: 6px 10px;
                font-size: 12px;
                gap: 4px;
            }

            .navbar-item span {
                display: none;
            }

            .navbar-user-text {
                display: none;
            }

            .navbar-container {
                padding: 0 12px;
                gap: 12px;
            }

            .navbar-item i {
                font-size: 18px;
            }
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
            flex: 1;
            width: 100%;
        }

        .header {
            background: var(--card);
            padding: 32px;
            border-radius: var(--radius);
            margin-bottom: 32px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
        }

        .header h1 {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header p {
            color: var(--muted);
            font-size: 14px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #a7f3d0;
            text-align: center;
        }

        .stat-card.active {
            background: linear-gradient(135deg, #ccfbf1 0%, #99f6e0 100%);
            border: 2px solid #14b8a6;
        }

        .stat-card {
            cursor: pointer;
            transition: all 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.15);
        }

        .filter-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 8px 16px;
            border: 2px solid var(--line);
            background: white;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            color: var(--text);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .filter-tab:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .filter-tab.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
        }

        .stat-label {
            font-size: 13px;
            color: #047857;
            font-weight: 600;
            margin-top: 4px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: white;
            border: 1px solid #111827;
            border-radius: 8px;
            text-decoration: none;
            color: #111827;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .back-button:hover {
            background: #f0fdfa;
            border-color: #14b8a6;
            color: #14b8a6;
        }

        .table-container {
            background: var(--card);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #f0f9ff 0%, #f8fafc 100%);
        }

        th {
            padding: 18px 16px;
            text-align: left;
            font-weight: 700;
            color: var(--text);
            border-bottom: 2px solid var(--line);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid var(--line);
            color: #374151;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }

        .badge-approved {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            width: 100%;
        }

        .action-buttons > * {
            flex: 1 1 0;
            min-width: 0;
        }

        .action-buttons a {
            display: flex;
        }

        .action-buttons form {
            display: flex !important;
            flex: 1 1 0;
        }

        .action-buttons form .btn {
            flex: 1;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            text-decoration: none;
        }

        .btn-view {
            background: var(--accent);
            color: white;
        }

        .btn-view:hover {
            background: var(--accent-strong);
        }

        .btn-approve {
            background: #10b981;
            color: white;
        }

        .btn-approve:hover {
            background: #059669;
        }

        .btn-reject {
            background: #ef4444;
            color: white;
        }

        .btn-reject:hover {
            background: #dc2626;
        }

        .empty-state {
            text-align: center;
            padding: 60px 40px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 48px;
            color: var(--line);
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 18px;
            color: var(--text);
            margin-bottom: 8px;
        }

        .pagination {
            display: flex;
            gap: 8px;
            justify-content: center;
            padding: 20px;
            margin-top: 20px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid var(--line);
            border-radius: 6px;
            text-decoration: none;
            color: var(--text);
        }

        .pagination a:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .pagination .active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
    </style>
</head>
<body>
    <x-staff-navbar />
    <div class="container">
        <div class="header">
            <h1>Appointment Requests</h1>
            <p>Review and manage customer appointment requests</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="stats">
            <a href="{{ route('appointment-requests.index', ['status' => 'pending']) }}" class="stat-card {{ $status === 'pending' ? 'active' : '' }}">
                <div class="stat-value">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending Requests</div>
            </a>
            <a href="{{ route('appointment-requests.index', ['status' => 'approved']) }}" class="stat-card {{ $status === 'approved' ? 'active' : '' }}" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); {{ $status === 'approved' ? 'border: 2px solid #10b981;' : '' }}">
                <div class="stat-value" style="color: #059669;">{{ $stats['approved'] }}</div>
                <div class="stat-label" style="color: #047857;">Approved</div>
            </a>
            <a href="{{ route('appointment-requests.index', ['status' => 'rejected']) }}" class="stat-card {{ $status === 'rejected' ? 'active' : '' }}" style="background: linear-gradient(135deg, #fee2e2 0%, #fca5a5 100%); {{ $status === 'rejected' ? 'border: 2px solid #ef4444;' : '' }}">
                <div class="stat-value" style="color: #dc2626;">{{ $stats['rejected'] }}</div>
                <div class="stat-label" style="color: #991b1b;">Rejected</div>
            </a>
            <a href="{{ route('appointment-requests.index', ['status' => 'cancelled']) }}" class="stat-card {{ $status === 'cancelled' ? 'active' : '' }}" style="background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%); {{ $status === 'cancelled' ? 'border: 2px solid #6b7280;' : '' }}">
                <div class="stat-value" style="color: #4b5563;">{{ $stats['cancelled'] }}</div>
                <div class="stat-label" style="color: #374151;">Cancelled</div>
            </a>
            <a href="{{ route('appointment-requests.index', ['status' => 'all']) }}" class="stat-card {{ $status === 'all' ? 'active' : '' }}" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); {{ $status === 'all' ? 'border: 2px solid #3b82f6;' : '' }}">
                <div class="stat-value" style="color: #1d4ed8;">{{ $stats['total'] }}</div>
                <div class="stat-label" style="color: #1e40af;">All Records</div>
            </a>
        </div>

        <div class="table-container">
            @if ($requests->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Pet</th>
                            <th>Requested Date</th>
                            <th>Time</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            <tr>
                                <td>
                                    <div style="font-weight: 600;">{{ $request->user?->name ?? 'N/A' }}</div>
                                    <div style="font-size: 12px; color: #6b7280;">{{ $request->user?->email ?? 'N/A' }}</div>
                                </td>
                                <td>{{ $request->patient?->pet_name ?? 'N/A' }} ({{ $request->patient?->species ?? 'N/A' }})</td>
                                <td>{{ $request->requested_date?->format('M d, Y') ?? 'N/A' }}</td>
                                <td>{{ $request->requested_time ?? 'N/A' }}</td>
                                <td>{{ $request->service_type ?? 'General' }}</td>
                                <td>
                                    @if ($request->status === 'pending')
                                        <span class="badge badge-pending">Pending</span>
                                    @elseif ($request->status === 'approved')
                                        <span class="badge badge-approved">Approved</span>
                                    @elseif ($request->status === 'rejected')
                                        <span class="badge badge-rejected">Rejected</span>
                                    @else
                                        <span class="badge">{{ ucfirst($request->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('appointment-requests.show', $request) }}" class="btn btn-view">
                                            View
                                        </a>
                                        @if ($request->status === 'pending')
                                            <form action="{{ route('appointment-requests.approve', $request) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-approve" onclick="return confirm('Approve this request?')">
                                                    Approve
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $requests->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h3>No Requests</h3>
                    <p>
                        @if ($status === 'pending')
                            All appointment requests have been processed.
                        @elseif ($status === 'all')
                            No appointment requests found.
                        @else
                            No {{ strtolower($status) }} requests to display.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>

