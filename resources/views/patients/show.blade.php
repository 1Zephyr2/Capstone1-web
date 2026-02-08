<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $patient->full_name }} - Patient Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 12px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }
        .btn-back {
            padding: 10px 20px;
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
        }
        
        .btn-back:hover {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100());
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(107, 114, 128, 0.4);
        }
        .btn-primary {
            background: #047857;
            color: white;
        }
        .btn-secondary {
            background: #6b7280;
            color: white;
        }
        .patient-header {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 28px;
            border-radius: 16px;
            margin-bottom: 24px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .patient-header:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .patient-header h1 {
            color: #047857;
            margin-bottom: 8px;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .patient-id {
            color: #6b7280;
            font-family: monospace;
            font-size: 14px;
            margin-bottom: 16px;
        }
        .patient-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
        }
        .info-item {
            padding: 12px;
            background: #f9fafb;
            border-radius: 6px;
        }
        .info-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
        }
        .section {
            background: white;
            padding: 24px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        .section h2 {
            color: #374151;
            font-size: 18px;
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
            border-bottom: 2px solid #e5e7eb;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #f3f4f6;
        }
        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 16px;
        }
        .alert-success {
            background: #d1fae5;
            color: #065f46;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-actions">
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">← Back to Patients</a>
            <div>
                <a href="{{ route('visits.create', ['patient_id' => $patient->id]) }}" class="btn btn-primary">+ Record Visit</a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="patient-header">
            <h1>{{ $patient->full_name }}</h1>
            <div class="patient-id">Patient ID: {{ $patient->patient_id }}</div>
            
            <div class="patient-grid">
                <div class="info-item">
                    <div class="info-label">Age</div>
                    <div class="info-value">{{ $patient->age }} years</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Sex</div>
                    <div class="info-value">{{ $patient->sex }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Birthdate</div>
                    <div class="info-value">{{ $patient->birthdate->format('F d, Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Contact Number</div>
                    <div class="info-value">{{ $patient->contact_number ?: 'Not provided' }}</div>
                </div>
                <div class="info-item" style="grid-column: 1 / -1;">
                    <div class="info-label">Address</div>
                    <div class="info-value">{{ $patient->address }}</div>
                </div>
            </div>
        </div>

        <!-- Visit History -->
        <div class="section">
            <div class="section-header">
                <h2>Visit History</h2>
            </div>
            
            @if($patient->visits->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Service Type</th>
                        <th>Vital Signs</th>
                        <th>Health Worker</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patient->visits as $visit)
                    <tr>
                        <td>{{ $visit->visit_date->format('M d, Y') }}</td>
                        <td><span class="badge badge-success">{{ $visit->service_type }}</span></td>
                        <td>
                            @if($visit->vitalSigns)
                                <small>
                                    BP: {{ $visit->vitalSigns->blood_pressure ?: '-' }} | 
                                    Temp: {{ $visit->vitalSigns->temperature ?: '-' }}°C | 
                                    Weight: {{ $visit->vitalSigns->weight ?: '-' }}kg
                                </small>
                            @else
                                <small style="color: #9ca3af;">No vital signs recorded</small>
                            @endif
                        </td>
                        <td>{{ $visit->health_worker ?: '-' }}</td>
                        <td>{{ Str::limit($visit->notes, 50) ?: '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <p>No visits recorded yet</p>
            </div>
            @endif
        </div>

        <!-- Immunizations -->
        @if($patient->immunizations->count() > 0)
        <div class="section">
            <div class="section-header">
                <h2>Immunization Records</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Vaccine</th>
                        <th>Dose</th>
                        <th>Date Given</th>
                        <th>Next Due</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patient->immunizations as $imm)
                    <tr>
                        <td>{{ $imm->vaccine_name }}</td>
                        <td>{{ $imm->dose_number ? '#' . $imm->dose_number : '-' }}</td>
                        <td>{{ $imm->date_given->format('M d, Y') }}</td>
                        <td>{{ $imm->next_dose_due ? $imm->next_dose_due->format('M d, Y') : 'Completed' }}</td>
                        <td>
                            @if($imm->is_overdue)
                                <span class="badge badge-warning">Overdue</span>
                            @else
                                <span class="badge badge-success">On Schedule</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Prenatal Records (for female patients) -->
        @if($patient->prenatalRecords->count() > 0)
        <div class="section">
            <div class="section-header">
                <h2>Prenatal Care Records</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Visit Date</th>
                        <th>Gestational Age</th>
                        <th>Weight</th>
                        <th>BP</th>
                        <th>Fundal Height</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patient->prenatalRecords as $prenatal)
                    <tr>
                        <td>{{ $prenatal->visit_date->format('M d, Y') }}</td>
                        <td>{{ $prenatal->gestational_age_weeks }} weeks</td>
                        <td>{{ $prenatal->weight }}kg</td>
                        <td>{{ $prenatal->blood_pressure }}</td>
                        <td>{{ $prenatal->fundal_height }}cm</td>
                        <td>
                            @if($prenatal->is_high_risk)
                                <span class="badge badge-warning">High Risk</span>
                            @else
                                <span class="badge badge-success">Normal</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Referrals -->
        @if($patient->referrals->count() > 0)
        <div class="section">
            <div class="section-header">
                <h2>Referrals</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Referred To</th>
                        <th>Reason</th>
                        <th>Urgency</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patient->referrals as $referral)
                    <tr>
                        <td>{{ $referral->referral_date->format('M d, Y') }}</td>
                        <td>{{ $referral->referred_to }}</td>
                        <td>{{ Str::limit($referral->reason, 40) }}</td>
                        <td>{{ $referral->urgency }}</td>
                        <td>
                            @if($referral->completed)
                                <span class="badge badge-success">Completed</span>
                            @else
                                <span class="badge badge-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <script>
        function goBack() {
            const referrer = document.referrer;
            const currentDomain = window.location.origin;
            
            // Check if we have a referrer from the same domain and it's not the current page
            if (referrer && referrer.startsWith(currentDomain) && referrer !== window.location.href) {
                window.history.back();
            } else {
                window.location.href = '/patients';
            }
        }
    </script>
</body>
</html>
