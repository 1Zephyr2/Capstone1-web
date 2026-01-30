@php
    use App\Models\Immunization;
    $immunizations = Immunization::with('patient')->orderBy('date_given', 'desc')->get();
    $thisMonth = $immunizations->filter(function($imm) {
        return \Carbon\Carbon::parse($imm->date_given)->isCurrentMonth();
    });
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immunizations - VaxLog</title>
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

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            border-left: 4px solid #f59e0b;
        }

        .stat-card h3 {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .stat-card .value {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
        }

        .content-card {
            background: white;
            padding: 32px;
            border-radius: 14px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            border: 1px solid #E5E7EB;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 20px;
        }

        .immunization-list {
            display: grid;
            gap: 16px;
        }

        .immunization-card {
            background: #fef3c7;
            border-radius: 10px;
            padding: 20px;
            border-left: 4px solid #f59e0b;
            transition: transform 0.2s;
        }

        .immunization-card:hover {
            transform: translateX(4px);
        }

        .imm-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 12px;
        }

        .patient-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .patient-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 18px;
        }

        .patient-details h4 {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
        }

        .patient-details p {
            font-size: 13px;
            color: #6b7280;
        }

        .dose-badge {
            background: #10b981;
            color: white;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .vaccine-info {
            background: white;
            padding: 16px;
            border-radius: 8px;
            margin-top: 12px;
        }

        .vaccine-name {
            font-size: 15px;
            font-weight: 600;
            color: #92400e;
            margin-bottom: 8px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #78716c;
            margin-top: 4px;
        }

        .info-row strong {
            color: #57534e;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6B7280;
        }

        .empty-state .icon {
            font-size: 64px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>💉 Immunization Records</h1>
            <a href="{{ route('dashboard') }}" class="back-btn">← Back to Dashboard</a>
        </div>

        <div class="stats-row">
            <div class="stat-card">
                <h3>Total Immunizations</h3>
                <div class="value">{{ $immunizations->count() }}</div>
            </div>
            <div class="stat-card" style="border-left-color: #10b981;">
                <h3>This Month</h3>
                <div class="value">{{ $thisMonth->count() }}</div>
            </div>
            <div class="stat-card" style="border-left-color: #3b82f6;">
                <h3>Patients Immunized</h3>
                <div class="value">{{ $immunizations->pluck('patient_id')->unique()->count() }}</div>
            </div>
        </div>

        <div class="content-card">
            <h2 class="section-title">All Immunization Records</h2>
            
            @if($immunizations->count() > 0)
                <div class="immunization-list">
                    @foreach($immunizations as $imm)
                    <div class="immunization-card">
                        <div class="imm-header">
                            <div class="patient-info">
                                <div class="patient-avatar">
                                    {{ strtoupper(substr($imm->patient->first_name, 0, 1) . substr($imm->patient->last_name, 0, 1)) }}
                                </div>
                                <div class="patient-details">
                                    <h4>{{ $imm->patient->first_name }} {{ $imm->patient->last_name }}</h4>
                                    <p>{{ $imm->patient->age }} years old • {{ $imm->patient->bhc_id }}</p>
                                </div>
                            </div>
                            <span class="dose-badge">Dose {{ $imm->dose_number }}</span>
                        </div>
                        
                        <div class="vaccine-info">
                            <div class="vaccine-name">{{ $imm->vaccine_name }}</div>
                            <div class="info-row">
                                <span><strong>Date Given:</strong> {{ \Carbon\Carbon::parse($imm->date_given)->format('F j, Y') }}</span>
                            </div>
                            <div class="info-row">
                                <span><strong>Administered by:</strong> {{ $imm->administered_by }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="icon">💉</div>
                    <h2>No Immunization Records</h2>
                    <p>There are no immunization records in the system yet.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
