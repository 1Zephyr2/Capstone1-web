<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Reports - Health Center</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }
        .btn-back {
            padding: 8px 16px;
            background: #6b7280;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-back:hover {
            background: #4b5563;
        }
        h1 {
            color: #047857;
            margin: 0;
            flex: 1;
        }
        .filters {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            gap: 16px;
            align-items: end;
        }
        .form-group {
            flex: 1;
        }
        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 6px;
            color: #374151;
        }
        input, select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }
        .btn {
            padding: 11px 24px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-primary {
            background: #047857;
            color: white;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .stat-label {
            font-size: 13px;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #047857;
        }
        .section {
            background: white;
            padding: 24px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        h2 {
            color: #374151;
            font-size: 18px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e5e7eb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #f9fafb;
            padding: 12px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }
        td {
            padding: 12px;
            border-top: 1px solid #e5e7eb;
        }
        .progress-bar {
            height: 24px;
            background: #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: #047857;
            display: flex;
            align-items: center;
            padding: 0 12px;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-top">
            <button onclick="goBack()" class="btn-back">← Back</button>
            <h1>Monthly Health Center Reports</h1>
        </div>

        <div class="filters">
            <div class="form-group">
                <label>Select Month</label>
                <input type="month" id="monthSelector" value="{{ $month }}" onchange="loadReport()">
            </div>
            <button class="btn btn-primary" onclick="window.print()">🖨️ Print Report</button>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">New Patients</div>
                <div class="stat-value">{{ $stats['new_patients'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Total Visits</div>
                <div class="stat-value">{{ $stats['total_visits'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Immunizations</div>
                <div class="stat-value">{{ $stats['immunizations'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Prenatal Visits</div>
                <div class="stat-value">{{ $stats['prenatal_visits'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Referrals</div>
                <div class="stat-value">{{ $stats['referrals'] }}</div>
            </div>
            <div class="stat-card">
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
            <p style="text-align: center; padding: 40px; color: #9ca3af;">No services recorded this month</p>
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
            <p style="text-align: center; padding: 40px; color: #9ca3af;">No immunizations recorded this month</p>
            @endif
        </div>

        <div style="margin-top: 40px; padding: 20px; background: white; border-radius: 8px; text-align: center; color: #6b7280; font-size: 13px;">
            <p>Report generated on {{ now()->format('F d, Y h:i A') }}</p>
            <p>Barangay Health Center Management System</p>
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
