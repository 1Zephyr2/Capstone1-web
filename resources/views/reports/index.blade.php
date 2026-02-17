<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Reports - Health Center</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f5f5 0%, #f0f9ff 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        .back-button:hover {
            background: #f8f9fa;
            border-color: #007bff;
            color: #007bff;
        }
        .header {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 24px;
        }
        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
            animation: slideDown 0.5s ease-out;
        }
        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes scaleIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        h1 {
            color: #333;
            margin: 0;
            flex: 1;
            font-size: 28px;
            font-weight: 700;
        }
        .filters {
            background: transparent;
            padding: 0;
            border-radius: 0;
            margin-bottom: 0;
            display: flex;
            gap: 16px;
            align-items: end;
            animation: fadeInUp 0.6s ease-out;
        }
        .form-group {
            flex: 1;
        }
        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #4a5568;
        }
        input, select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .btn {
            padding: 12px 28px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary {
            background: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }
        .stat-card {
            background: white;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            animation: scaleIn 0.5s ease-out backwards;
        }
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
        .stat-card:nth-child(5) { animation-delay: 0.5s; }
        .stat-card:nth-child(6) { animation-delay: 0.6s; }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }
        .stat-icon {
            font-size: 32px;
            margin-bottom: 12px;
            display: block;
        }
        .stat-label {
            font-size: 13px;
            color: #718096;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
            font-weight: 600;
        }
        .stat-value {
            font-size: 36px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .section {
            background: white;
            padding: 32px;
            border-radius: 16px;
            margin-bottom: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.7s ease-out;
        }
        h2 {
            color: #2d3748;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 3px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            padding: 16px;
            text-align: left;
            font-size: 13px;
            font-weight: 700;
            color: #4a5568;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        td {
            padding: 16px;
            border-top: 1px solid #e2e8f0;
            transition: background 0.2s ease;
        }
        tr:hover td {
            background: #f7fafc;
        }
        .progress-bar {
            height: 32px;
            background: #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.06);
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            padding: 0 16px;
            color: white;
            font-size: 13px;
            font-weight: 700;
            transition: width 1s ease-out;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #a0aec0;
        }
        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
        .empty-state-text {
            font-size: 16px;
            font-weight: 500;
        }
        .footer {
            margin-top: 40px;
            padding: 24px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            text-align: center;
            color: #718096;
            font-size: 13px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .footer p {
            margin: 4px 0;
        }
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .back-button, .filters {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('dashboard') }}" class="back-button">← Back</a>
        <div class="header">
            <div class="header-top">
                <h1>Monthly Health Center Reports</h1>
            </div>
            <div class="filters">
                <div class="form-group">
                    <label>Select Month</label>
                    <input type="month" id="monthSelector" value="{{ $month }}" onchange="loadReport()">
                </div>
                <button class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer"></i> Print Report</button>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-icon"><i class="bi bi-people-fill"></i></span>
                <div class="stat-label">New Patients</div>
                <div class="stat-value">{{ $stats['new_patients'] }}</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon"><i class="bi bi-hospital"></i></span>
                <div class="stat-label">Total Visits</div>
                <div class="stat-value">{{ $stats['total_visits'] }}</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon"><i class="bi bi-shield-fill-check"></i></span>
                <div class="stat-label">Vaccinations</div>
                <div class="stat-value">{{ $stats['immunizations'] }}</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon"><i class="bi bi-heart-pulse-fill"></i></span>
                <div class="stat-label">Breeding Checkups</div>
                <div class="stat-value">{{ $stats['breeding_checkups'] }}</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon"><i class="bi bi-clipboard2-check"></i></span>
                <div class="stat-label">Referrals</div>
                <div class="stat-value">{{ $stats['referrals'] }}</div>
            </div>
            <div class="stat-card">
                <span class="stat-icon"><i class="bi bi-bar-chart-fill"></i></span>
                <div class="stat-label">Total Registered</div>
                <div class="stat-value">{{ $stats['total_patients'] }}</div>
            </div>
        </div>

        <div class="section">
            <h2>Service Breakdown</h2>
            @if($serviceBreakdown->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Service Type</th>
                        <th>Count</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($serviceBreakdown as $service)
                    <tr>
                        <td>{{ $service->service_type }}</td>
                        <td><strong>{{ $service->count }}</strong></td>
                        <td>
                            @php
                                $percentage = $stats['total_visits'] > 0 ? round(($service->count / $stats['total_visits']) * 100) : 0;
                            @endphp
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $percentage }}%">
                                    {{ $percentage }}%
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <div class="empty-state-icon"><i class="bi bi-inbox"></i></div>
                <div class="empty-state-text">No services recorded this month</div>
            </div>
            @endif
        </div>

        <div class="section">
            <h2>Vaccines Administered</h2>
            @if($vaccineBreakdown->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Vaccine Name</th>
                        <th>Doses Given</th>
                        <th>Distribution</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vaccineBreakdown as $vaccine)
                    <tr>
                        <td>{{ $vaccine->vaccine_name }}</td>
                        <td><strong>{{ $vaccine->count }}</strong></td>
                        <td>
                            @php
                                $percentage = $stats['immunizations'] > 0 ? round(($vaccine->count / $stats['immunizations']) * 100) : 0;
                            @endphp
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $percentage }}%">
                                    {{ $percentage }}%
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <div class="empty-state-icon"><i class="bi bi-shield-fill-check"></i></div>
                <div class="empty-state-text">No immunizations recorded this month</div>
            </div>
            @endif
        </div>

        <div class="footer">
            <p><strong>Report generated on {{ now()->format('F d, Y h:i A') }}</strong></p>
            <p>© 2026 CareSync - Health Center Management System</p>
        </div>
    </div>

    <script>
        function goBack() {
            const referrer = document.referrer;
            const currentDomain = window.location.origin;
            
            // Check if we have a referrer from the same domain and it's not the current page
            if (referrer && referrer.startsWith(currentDomain) && referrer !== window.location.href) {
                window.history.back();
            } else {
                window.location.href = '/dashboard';
            }
        }

        function loadReport() {
            const month = document.getElementById('monthSelector').value;
            window.location.href = `{{ route('reports.index') }}?month=${month}`;
        }
    </script>
</body>
</html>
