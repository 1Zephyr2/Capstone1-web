<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automation Support - CareSync</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            padding: 40px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 24px 32px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 28px;
            color: #111827;
        }

        .back-btn {
            background: #10B981;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .back-btn:hover {
            background: #059669;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .stat-card h3 {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 8px;
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
        }

        .alerts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 24px;
        }

        .alert-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .alert-card h2 {
            font-size: 18px;
            color: #111827;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-item {
            padding: 12px;
            border-left: 4px solid #FCD34D;
            background: #FFFBEB;
            margin-bottom: 12px;
            border-radius: 4px;
        }

        .alert-item.danger {
            border-left-color: #EF4444;
            background: #FEF2F2;
        }

        .alert-item.info {
            border-left-color: #3B82F6;
            background: #EFF6FF;
        }

        .alert-item.success {
            border-left-color: #10B981;
            background: #ECFDF5;
        }

        .alert-item strong {
            display: block;
            margin-bottom: 4px;
            color: #111827;
        }

        .alert-item small {
            color: #6B7280;
            font-size: 13px;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #9CA3AF;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            margin-left: 8px;
        }

        .badge.warning {
            background: #FEF3C7;
            color: #92400E;
        }

        .badge.danger {
            background: #FEE2E2;
            color: #991B1B;
        }

        .badge.success {
            background: #D1FAE5;
            color: #065F46;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🤖 Automation Support</h1>
            <a href="{{ route('dashboard') }}" class="back-btn">← Back to Dashboard</a>
        </div>

        <!-- Quick Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Patients</h3>
                <div class="number">{{ $stats['total_patients'] }}</div>
            </div>
            <div class="stat-card">
                <h3>Visits This Week</h3>
                <div class="number">{{ $stats['visits_this_week'] }}</div>
            </div>
            <div class="stat-card">
                <h3>Pending Immunizations</h3>
                <div class="number">{{ $stats['pending_immunizations'] }}</div>
            </div>
            <div class="stat-card">
                <h3>Active Prenatal Cases</h3>
                <div class="number">{{ $stats['active_prenatal'] }}</div>
            </div>
        </div>

        <!-- Alerts and Automations -->
        <div class="alerts-grid">
            <!-- Incomplete Records -->
            <div class="alert-card">
                <h2>⚠️ Incomplete Patient Records<span class="badge warning">{{ $incompleteRecords->count() }}</span></h2>
                @forelse($incompleteRecords as $patient)
                    <div class="alert-item">
                        <strong>{{ $patient->full_name }} ({{ $patient->patient_id }})</strong>
                        <small>
                            Missing: 
                            @if(!$patient->philhealth_number) PhilHealth Number @endif
                            @if(!$patient->contact_number) Contact Number @endif
                        </small>
                    </div>
                @empty
                    <div class="empty-state">✓ All patient records are complete!</div>
                @endforelse
            </div>

            <!-- Overdue Immunizations -->
            <div class="alert-card">
                <h2>💉 Overdue Immunizations<span class="badge danger">{{ $overdueImmunizations->count() }}</span></h2>
                @forelse($overdueImmunizations as $immunization)
                    <div class="alert-item danger">
                        <strong>{{ $immunization->patient->full_name }}</strong>
                        <small>{{ $immunization->vaccine_name }} - Due: {{ Carbon\Carbon::parse($immunization->next_dose_date)->format('M d, Y') }}</small>
                    </div>
                @empty
                    <div class="empty-state">✓ No overdue immunizations!</div>
                @endforelse
            </div>

            <!-- Inactive Patients -->
            <div class="alert-card">
                <h2>📅 Inactive Patients (30+ days)<span class="badge warning">{{ $inactivePatients->count() }}</span></h2>
                @forelse($inactivePatients as $patient)
                    <div class="alert-item info">
                        <strong>{{ $patient->full_name }} ({{ $patient->patient_id }})</strong>
                        <small>Last visit: 
                            @if($patient->visits->count() > 0)
                                {{ $patient->visits->sortByDesc('visit_date')->first()->visit_date->format('M d, Y') }}
                            @else
                                Never visited
                            @endif
                        </small>
                    </div>
                @empty
                    <div class="empty-state">✓ All patients are active!</div>
                @endforelse
            </div>

            <!-- High Risk Prenatal -->
            <div class="alert-card">
                <h2>🤰 High-Risk Prenatal Cases<span class="badge danger">{{ $highRiskPrenatal->count() }}</span></h2>
                @forelse($highRiskPrenatal as $record)
                    <div class="alert-item danger">
                        <strong>{{ $record->patient->full_name }}</strong>
                        <small>BP: {{ $record->blood_pressure }} - Requires immediate attention</small>
                    </div>
                @empty
                    <div class="empty-state">✓ No high-risk prenatal cases!</div>
                @endforelse
            </div>

            <!-- Recent Visits -->
            <div class="alert-card">
                <h2>🏥 Recent Visits<span class="badge success">{{ $recentVisits->count() }}</span></h2>
                @forelse($recentVisits as $visit)
                    <div class="alert-item success">
                        <strong>{{ $visit->patient->full_name }}</strong>
                        <small>{{ $visit->service_type }} - {{ $visit->visit_date->format('M d, Y g:i A') }}</small>
                    </div>
                @empty
                    <div class="empty-state">No recent visits</div>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>
