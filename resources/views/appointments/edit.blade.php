<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment - FURCARE</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #FFF8F0;
    padding: 20px;
    padding-top: 92px;
    min-height: 100vh;
}
        .container {
            max-width: 1000px;
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
        .alert {
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #fca5a5;
            background: #fee2e2;
            color: #991b1b;
        }
        .alert strong {
            display: block;
            margin-bottom: 8px;
        }
        .alert ul {
            margin: 8px 0 0 20px;
        }
        .appointment-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .form-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08), 0 4px 16px rgba(0,0,0,0.04);
            border: 1px solid #e5e7eb;
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
        .card-body.secondary {
            background: #fffbeb;
        }
        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-row:last-child {
            margin-bottom: 0;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group.full-width {
            grid-column: 1 / -1;
        }
        label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .required {
            color: #ef4444;
        }
        .form-control {
            padding: 11px 14px;
            border: 1.5px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }
        textarea.form-control {
            resize: vertical;
            min-height: 90px;
        }
        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
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
        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }
        .btn-secondary:hover {
            background: #e5e7eb;
        }
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<x-staff-navbar />
<div class="container">
    <a href="{{ route('appointments.show', $appointment) }}" class="back-button">
        <i class="bi bi-arrow-left"></i> Back to Appointment
    </a>
    <div class="header">
        <h1>Edit Appointment</h1>
    </div>

    @if ($errors->any())
        <div class="alert">
            <strong>Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.update', $appointment) }}" method="POST" class="appointment-form">
        @csrf
        @method('PUT')
        
        <!-- Pet Information -->
        <div class="form-card">
            <div class="card-header">
                <h2>Pet Information</h2>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="patient_id">Pet <span class="required">*</span></label>
                        <select name="patient_id" id="patient_id" class="form-control" required>
                            <option value="{{ $appointment->patient->id }}">
                                {{ $appointment->patient->full_name }} ({{ $appointment->patient->patient_id }})
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Details -->
        <div class="form-card">
            <div class="card-header">
                <h2>Appointment Details</h2>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="appointment_date">Appointment Date <span class="required">*</span></label>
                        <input type="date" name="appointment_date" id="appointment_date" class="form-control" 
                               value="{{ old('appointment_date', $appointment->appointment_date->format('Y-m-d')) }}" required>
                    </div>
                    <div class="form-group">
    <label for="appointment_time">Appointment Time <span class="required">*</span></label>
    @php
        $currentTime = old('appointment_time', \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i:s'));
    @endphp
    <select name="appointment_time" id="appointment_time" class="form-control" required>
        <option value="">Select Time</option>
        <option value="09:00:00" {{ $currentTime == '09:00:00' || $currentTime == '09:00' ? 'selected' : '' }}>9:00 AM</option>
        <option value="10:00:00" {{ $currentTime == '10:00:00' || $currentTime == '10:00' ? 'selected' : '' }}>10:00 AM</option>
        <option value="11:00:00" {{ $currentTime == '11:00:00' || $currentTime == '11:00' ? 'selected' : '' }}>11:00 AM</option>
        <option value="13:00:00" {{ $currentTime == '13:00:00' || $currentTime == '13:00' ? 'selected' : '' }}>1:00 PM</option>
        <option value="14:00:00" {{ $currentTime == '14:00:00' || $currentTime == '14:00' ? 'selected' : '' }}>2:00 PM</option>
        <option value="15:00:00" {{ $currentTime == '15:00:00' || $currentTime == '15:00' ? 'selected' : '' }}>3:00 PM</option>
        <option value="16:00:00" {{ $currentTime == '16:00:00' || $currentTime == '16:00' ? 'selected' : '' }}>4:00 PM</option>
        <option value="17:00:00" {{ $currentTime == '17:00:00' || $currentTime == '17:00' ? 'selected' : '' }}>5:00 PM</option>
    </select>
</div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="service_type">Service Type <span class="required">*</span></label>
                        <select name="service_type" id="service_type" class="form-control" required>
    <option value="">Select Service</option>
    @foreach($services as $category => $items)
        <optgroup label="{{ $category }}">
            @foreach($items as $svc)
                <option value="{{ $svc->name }}" {{ old('service_type') == $svc->name ? 'selected' : '' }}>
                    {{ $svc->name }}
                </option>
            @endforeach
        </optgroup>
    @endforeach
</select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="scheduled" {{ old('status', $appointment->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="confirmed" {{ old('status', $appointment->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ old('status', $appointment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $appointment->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="no-show" {{ old('status', $appointment->status) == 'no-show' ? 'selected' : '' }}>No-Show</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="chief_complaint">Chief Complaint</label>
                        <textarea name="chief_complaint" id="chief_complaint" class="form-control">{{ old('chief_complaint', $appointment->chief_complaint) }}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="health_worker">Health Worker</label>
                        <input type="text" name="health_worker" id="health_worker" class="form-control" 
                               value="{{ old('health_worker', $appointment->health_worker) }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" class="form-control">{{ old('notes', $appointment->notes) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Contact -->
        <div class="form-card">
            <div class="card-header">
                <h2>Pickup / Secondary Contact (Optional)</h2>
            </div>
            <div class="card-body secondary">
                <div class="form-row">
                    <div class="form-group">
                        <label for="secondary_contact_name">Contact Person Name</label>
                        <input type="text" name="secondary_contact_name" id="secondary_contact_name" class="form-control"
                               placeholder="e.g. Maria Santos"
                               value="{{ old('secondary_contact_name', $appointment->secondary_contact_name) }}">
                    </div>
                    <div class="form-group">
                        <label for="secondary_contact_number">Contact Number</label>
                        <input type="tel" name="secondary_contact_number" id="secondary_contact_number" class="form-control"
                               placeholder="09XX-XXX-XXXX"
                               value="{{ old('secondary_contact_number', $appointment->secondary_contact_number) }}">
                    </div>
                </div>
            </div>
        </div>




        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                Update Appointment
            </button>
            <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
</body>
</html>

