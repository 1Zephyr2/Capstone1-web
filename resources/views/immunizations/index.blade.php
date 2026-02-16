@php
    use App\Models\Immunization;
    $immunizations = Immunization::with('patient')->orderBy('date_given', 'desc')->get();
    $thisMonth = $immunizations->filter(function($imm) {
        return \Carbon\Carbon::parse($imm->date_given)->isCurrentMonth();
    });
@endphp

<!DOCTYPE html>
<html lang="en ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccinations - VetCare</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
            padding: 24px;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 18px 24px;
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .header:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .header h1 {
            font-size: 26px;
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.02em;
        }

        .back-btn {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .back-btn:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.4);
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border-left: 4px solid #f59e0b;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            border-right: 1px solid rgba(0, 0, 0, 0.06);
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .stat-card h3 {
            font-size: 13px;
            font-weight: 600;
            color: #6B7280;
            margin-bottom: 8px;
            letter-spacing: -0.01em;
        }

        .stat-card .value {
            font-size: 30px;
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.02em;
        }

        .content-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .content-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .section-title {
            font-size: 19px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
            letter-spacing: -0.01em;
        }

        .immunization-list {
            display: grid;
            gap: 12px;
        }

        .immunization-card {
            background: #dcfce7;
            border-radius: 10px;
            padding: 16px;
            border-left: 4px solid #10B981;
            transition: transform 0.2s;
        }

        .immunization-card:hover {
            transform: translateX(4px);
        }

        .imm-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 10px;
        }

        .patient-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .patient-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .patient-details h4 {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
        }

        .patient-details p {
            font-size: 12px;
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
            padding: 12px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .vaccine-name {
            font-size: 14px;
            font-weight: 600;
            color: #92400e;
            margin-bottom: 6px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #78716c;
            margin-top: 4px;
        }

        .info-row strong {
            color: #57534e;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6B7280;
        }

        .empty-state .icon {
            font-size: 48px;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Vaccination Records</h1>
            <a href="{{ route('dashboard') }}" class="back-btn">← Back to Dashboard</a>
        </div>

        <div class="stats-row">
            <div class="stat-card">
                <h3>Total Vaccinations</h3>
                <div class="value">{{ $immunizations->count() }}</div>
            </div>
            <div class="stat-card" style="border-left-color: #10b981;">
                <h3>This Month</h3>
                <div class="value">{{ $thisMonth->count() }}</div>
            </div>
            <div class="stat-card" style="border-left-color: #3b82f6;">
                <h3>Pets Vaccinated</h3>
                <div class="value">{{ $immunizations->pluck('patient_id')->unique()->count() }}</div>
            </div>
        </div>

        <div class="content-card">
            <h2 class="section-title">All Vaccination Records</h2>
            
            @if($immunizations->count() > 0)
                <div class="immunization-list">
                    @foreach($immunizations as $imm)
                    <div class="immunization-card">
                        <div class="imm-header">
                            <div class="patient-info">
                                <div class="patient-avatar">
                                    <i class="bi bi-heart-fill" style="font-size: 18px;"></i>
                                </div>
                                <div class="patient-details">
                                    <h4>{{ $imm->patient->pet_name ?? $imm->patient->full_name }}</h4>
                                    <p>{{ $imm->patient->age }} years old • {{ $imm->patient->patient_id }}</p>
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
                    <div class="icon"><i class="bi bi-shield-fill-check" style="font-size: 48px;"></i></div>
                    <h2>No Immunization Records</h2>
                    <p>There are no immunization records in the system yet.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
