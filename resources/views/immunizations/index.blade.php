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
    <title>Vaccinations - PAWser</title>
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
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        .back-btn {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(20, 184, 166, 0.3);
        }

        .back-btn:hover {
            background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(20, 184, 166, 0.4);
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 24px;
            border-radius: 14px;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            border-right: 1px solid rgba(0, 0, 0, 0.06);
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border-left: 5px solid #14b8a6;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
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
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .content-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .section-title {
            font-size: 20px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 24px;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .immunization-list {
            display: grid;
            gap: 12px;
        }

        .immunization-card {
            background: linear-gradient(135deg, #dcfce7 0%, #d1fae5 100%);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #a7f3d0;
            border-left: 5px solid #10B981;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 3px rgba(16, 185, 129, 0.1);
        }

        .immunization-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15), 0 8px 24px rgba(16, 185, 129, 0.1);
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
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 20px;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .patient-details h4 {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
            letter-spacing: -0.01em;
        }

        .patient-details p {
            font-size: 13px;
            color: #6b7280;
        }

        .dose-badge {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
            letter-spacing: -0.01em;
        }

        .vaccine-info {
            background: rgba(255, 255, 255, 0.85);
            padding: 14px 16px;
            border-radius: 10px;
            margin-top: 12px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
        }

        .vaccine-name {
            font-size: 15px;
            font-weight: 700;
            color: #15803d;
            margin-bottom: 8px;
            letter-spacing: -0.01em;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #4a5568;
            margin-top: 6px;
        }

        .info-row strong {
            color: #2d3748;
            font-weight: 600;
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
