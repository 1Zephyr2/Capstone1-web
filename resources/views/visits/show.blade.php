<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Details - PAWser</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            padding: 24px;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: white;
            color: #14b8a6;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: #f0fdfa;
            border-color: #14b8a6;
            box-shadow: 0 2px 8px rgba(20, 184, 166, 0.2);
        }

        .header {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            border-radius: 12px;
            padding: 24px;
            color: white;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            opacity: 0.9;
            margin-bottom: 4px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #1f2937;
        }

        .info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 16px;
        }

        .info-row.full {
            grid-template-columns: 1fr;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 12px;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 15px;
            color: #1f2937;
            font-weight: 500;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            background: #d1fae5;
            color: #065f46;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            width: fit-content;
        }

        .service-badge {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
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
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            color: #111827;
        }

        @media (max-width: 768px) {
            .info-row {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 16px;
            }

            .header h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="javascript:history.back()" class="back-button">
            <i class="bi bi-arrow-left"></i>
            Back
        </a>

        <div class="header">
            <h1>{{ $visit->patient->pet_name ?? $visit->patient->full_name }}</h1>
            <p><i class="bi bi-calendar-event"></i> {{ $visit->visit_date->format('l, M d, Y') }}</p>
            <p><i class="bi bi-clock"></i> {{ $visit->visit_time ? \Carbon\Carbon::parse($visit->visit_time)->format('g:i A') : 'N/A' }}</p>
        </div>

        <div class="card">
            <div class="card-title">
                <i class="bi bi-info-circle"></i>
                Visit Information
            </div>

            <div class="info-row">
                <div class="info-item">
                    <span class="info-label">Service Type</span>
                    <span class="badge service-badge">{{ $visit->service_type }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Health Worker</span>
                    <span class="info-value">{{ $visit->health_worker ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="info-row full">
                <div class="info-item">
                    <span class="info-label">Chief Complaint</span>
                    <span class="info-value">{{ $visit->chief_complaint ?? 'No complaint recorded' }}</span>
                </div>
            </div>

            @if($visit->notes)
            <div class="info-row full">
                <div class="info-item">
                    <span class="info-label">Notes</span>
                    <span class="info-value">{{ $visit->notes }}</span>
                </div>
            </div>
            @endif
        </div>

        <div class="card">
            <div class="card-title">
                <i class="bi bi-paw"></i>
                Patient Information
            </div>

            <div class="info-row">
                <div class="info-item">
                    <span class="info-label">Pet Name</span>
                    <span class="info-value">{{ $visit->patient->pet_name ?? $visit->patient->full_name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Species</span>
                    <span class="info-value">{{ $visit->patient->species ?? 'Unknown' }}</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <span class="info-label">Breed</span>
                    <span class="info-value">{{ $visit->patient->breed ?? 'Unknown' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date of Birth</span>
                    <span class="info-value">{{ $visit->patient->date_of_birth ? $visit->patient->date_of_birth->format('M d, Y') : 'N/A' }}</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <span class="info-label">Owner Name</span>
                    <span class="info-value">{{ $visit->patient->owner_name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Owner Contact</span>
                    <span class="info-value">{{ $visit->patient->owner_contact ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-title">
                <i class="bi bi-clock-history"></i>
                Visit Timeline
            </div>

            <div class="info-row">
                <div class="info-item">
                    <span class="info-label">Created At</span>
                    <span class="info-value">{{ $visit->created_at->format('M d, Y \a\t g:i A') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Last Updated</span>
                    <span class="info-value">{{ $visit->updated_at->format('M d, Y \a\t g:i A') }}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
