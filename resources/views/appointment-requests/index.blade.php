<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Requests - PAWser</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap');

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
            font-family: 'Manrope', sans-serif;
            background: linear-gradient(135deg, var(--bg) 0%, var(--bg-alt) 100%);
            padding: 40px 20px;
            min-height: 100vh;
            color: var(--text);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
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
            border: 1px solid var(--line);
            border-radius: 8px;
            text-decoration: none;
            color: var(--text);
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .back-button:hover {
            border-color: var(--primary);
            color: var(--primary);
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
    <div class="container">
        <a href="{{ route('dashboard') }}" class="back-button">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>

        <div class="header">
            <h1><i class="bi bi-calendar-check"></i> Appointment Requests</h1>
            <p>Review and manage customer appointment requests</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="stats">
            <div class="stat-card">
                <div class="stat-value">{{ $requests->where('status', 'pending')->count() }}</div>
                <div class="stat-label">Pending Requests</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" style="color: #059669;">{{ $requests->where('status', 'approved')->count() }}</div>
                <div class="stat-label" style="color: #047857;">Approved</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" style="color: #e11d48;">{{ $requests->where('status', 'rejected')->count() }}</div>
                <div class="stat-label" style="color: #831843;">Rejected</div>
            </div>
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
                                    <div style="font-weight: 600;">{{ $request->user->name }}</div>
                                    <div style="font-size: 12px; color: #6b7280;">{{ $request->user->email }}</div>
                                </td>
                                <td>{{ $request->patient->pet_name }} ({{ $request->patient->species }})</td>
                                <td>{{ $request->requested_date->format('M d, Y') }}</td>
                                <td>{{ $request->requested_time }}</td>
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
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        @if ($request->status === 'pending')
                                            <form action="{{ route('appointment-requests.approve', $request) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-approve" onclick="return confirm('Approve this request?')">
                                                    <i class="bi bi-check"></i> Approve
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
                    <p>All appointment requests have been processed.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
