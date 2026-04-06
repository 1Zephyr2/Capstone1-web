<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details - PAWSER</title>
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
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
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
        .header {
            background: white;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08), 0 4px 16px rgba(0,0,0,0.04);
            margin-bottom: 28px;
            border: 1px solid #e5e7eb;
        }
        .header h1 {
            color: #0f172a;
            font-size: 32px;
            margin: 0;
            font-weight: 800;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }
        .btn {
            padding: 11px 22px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }
        .btn-primary:hover {
            box-shadow: 0 8px 20px rgba(20, 184, 166, 0.4);
            transform: translateY(-2px);
        }
        .btn-danger {
            background: #ef4444;
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }
        .btn-danger:hover {
            background: #dc2626;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
            transform: translateY(-2px);
        }
        .content-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08), 0 4px 16px rgba(0,0,0,0.04);
            border: 1px solid #e5e7eb;
        }
        .card.full-width {
            grid-column: 1 / -1;
        }
        .card-header {
            background: #f8fafc;
            padding: 18px 24px;
            border-bottom: 1.5px solid #e5e7eb;
        }
        .card-header h2 {
            font-size: 16px;
            color: #0f172a;
            margin: 0;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-header i {
            color: #14b8a6;
        }
        .card-body {
            padding: 24px;
        }
        .info-row {
            display: grid;
            grid-template-columns: 140px 1fr;
            padding: 14px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-row label {
            font-weight: 600;
            color: #6b7280;
            font-size: 14px;
        }
        .info-row span {
            color: #1f2937;
            font-size: 14px;
        }
        .badge {
            padding: 5px 14px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        .badge-info { background: #ccfbf1; color: #0d7377; border: 1px solid #99f6e4; }
        .badge-scheduled { background: #ccfbf1; color: #0d7377; border: 1px solid #99f6e4; }
        .badge-confirmed { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .badge-completed { background: #e6e6e6; color: #292524; border: 1px solid #d4d4d4; }
        .badge-cancelled { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .badge-no-show { background: #fef3c7; color: #92400e; border: 1px solid #fcd34d; }
        .badge-routine { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .badge-urgent { background: #fef3c7; color: #92400e; border: 1px solid #fcd34d; }
        .badge-emergency { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .link {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 600;
        }
        .link:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            .info-row {
                grid-template-columns: 1fr;
                gap: 4px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <a href="{{ route('appointments.index') }}" class="back-button">
        <i class="bi bi-arrow-left"></i> Back to Appointments
    </a>
    <div class="header">
        <h1>Appointment Details</h1>
        <div class="header-actions">
            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Edit Appointment
            </a>
            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this appointment?')">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="content-grid">
        <!-- Appointment Information -->
        <div class="card">
            <div class="card-header">
                <h2>Appointment Information</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <label>Date:</label>
                    <span>{{ $appointment->appointment_date->format('F d, Y') }}</span>
                </div>
                <div class="info-row">
                    <label>Time:</label>
                    <span>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
                </div>
                <div class="info-row">
                    <label>Service Type:</label>
                    <span class="badge badge-info">{{ $appointment->service_type }}</span>
                </div>
                <div class="info-row">
                    <label>Status:</label>
                    <span class="badge badge-{{ $appointment->status }}">{{ ucfirst($appointment->status) }}</span>
                </div>
                <div class="info-row">
                    <label>Veterinary Staff:</label>
                    <span>{{ $appointment->health_worker ?? 'Not assigned' }}</span>
                </div>
            </div>
        </div>

        <!-- Pet Information -->
        <div class="card">
            <div class="card-header">
                <h2>Pet Information</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <label>Pet ID:</label>
                    <span>{{ $appointment->patient->patient_id }}</span>
                </div>
                <div class="info-row">
                    <label>Name:</label>
                    <span>
                        <a href="{{ route('pets.show', $appointment->patient) }}" class="link">
                            {{ $appointment->patient->full_name }}
                        </a>
                    </span>
                </div>
                <div class="info-row">
                    <label>Age:</label>
                    <span>{{ $appointment->patient->age }} years old</span>
                </div>
                <div class="info-row">
                    <label>Sex:</label>
                    <span>{{ $appointment->patient->sex }}</span>
                </div>
                <div class="info-row">
                    <label>Owner Contact:</label>
                    <span>{{ $appointment->patient->owner_contact ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Chief Complaint & Notes -->
        <div class="card full-width">
            <div class="card-header">
                <h2>Chief Complaint & Notes</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <label>Chief Complaint:</label>
                    <span>{{ $appointment->chief_complaint ?? 'Not specified' }}</span>
                </div>
                @if($appointment->notes)
                <div class="info-row">
                    <label>Notes:</label>
                    <span>{{ $appointment->notes }}</span>
                </div>
                @endif
            </div>
        </div>


    </div>
</div>
</body>
</html>

