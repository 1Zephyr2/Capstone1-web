@extends('layouts.app')

@section('title', 'Appointment Details')

@section('content')
<div class="container">
    <div class="header">
        <div class="header-top">
            <a href="{{ route('appointments.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Back to Appointments
            </a>
            <h1><i class="bi bi-calendar-check"></i> Appointment Details</h1>
        </div>
        
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
                <h2><i class="bi bi-info-circle"></i> Appointment Information</h2>
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
                    <label>Health Worker:</label>
                    <span>{{ $appointment->health_worker ?? 'Not assigned' }}</span>
                </div>
            </div>
        </div>

        <!-- Patient Information -->
        <div class="card">
            <div class="card-header">
                <h2><i class="bi bi-person"></i> Patient Information</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <label>Patient ID:</label>
                    <span>{{ $appointment->patient->patient_id }}</span>
                </div>
                <div class="info-row">
                    <label>Name:</label>
                    <span>
                        <a href="{{ route('patients.show', $appointment->patient) }}" class="link">
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
                    <label>Contact:</label>
                    <span>{{ $appointment->patient->contact_number ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Chief Complaint & Notes -->
        <div class="card full-width">
            <div class="card-header">
                <h2><i class="bi bi-chat-left-text"></i> Chief Complaint & Notes</h2>
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

        <!-- Service-Specific Details -->
        @if($appointment->service_type == 'Immunization' && $appointment->vaccine_name)
        <div class="card full-width">
            <div class="card-header">
                <h2><i class="bi bi-shield-check"></i> Immunization Details</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <label>Vaccine Name:</label>
                    <span>{{ $appointment->vaccine_name }}</span>
                </div>
                @if($appointment->dose_number)
                <div class="info-row">
                    <label>Dose Number:</label>
                    <span>{{ $appointment->dose_number }}</span>
                </div>
                @endif
            </div>
        </div>
        @endif

        @if($appointment->service_type == 'Prenatal Care' && $appointment->gestational_age)
        <div class="card full-width">
            <div class="card-header">
                <h2><i class="bi bi-heart-pulse"></i> Prenatal Care Details</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <label>Gestational Age:</label>
                    <span>{{ $appointment->gestational_age }} weeks</span>
                </div>
                @if($appointment->presentation)
                <div class="info-row">
                    <label>Presentation:</label>
                    <span>{{ $appointment->presentation }}</span>
                </div>
                @endif
            </div>
        </div>
        @endif

        @if($appointment->service_type == 'Family Planning' && $appointment->fp_method)
        <div class="card full-width">
            <div class="card-header">
                <h2><i class="bi bi-people"></i> Family Planning Details</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <label>FP Method:</label>
                    <span>{{ $appointment->fp_method }}</span>
                </div>
            </div>
        </div>
        @endif

        @if($appointment->referred_to)
        <div class="card full-width">
            <div class="card-header">
                <h2><i class="bi bi-hospital"></i> Referral Information</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <label>Referred To:</label>
                    <span>{{ $appointment->referred_to }}</span>
                </div>
                @if($appointment->referral_urgency)
                <div class="info-row">
                    <label>Urgency:</label>
                    <span class="badge badge-{{ $appointment->referral_urgency }}">
                        {{ ucfirst($appointment->referral_urgency) }}
                    </span>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    .header {
        background: white;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 24px;
    }
    .header h1 {
        color: #333;
        font-size: 28px;
        margin: 12px 0;
    }
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #007bff;
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 8px;
    }
    .btn-back:hover {
        text-decoration: underline;
    }
    .header-actions {
        display: flex;
        gap: 12px;
        margin-top: 16px;
    }
    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
    }
    .btn-primary {
        background: #007bff;
        color: white;
    }
    .btn-primary:hover {
        background: #0056b3;
    }
    .btn-danger {
        background: #dc3545;
        color: white;
    }
    .btn-danger:hover {
        background: #c82333;
    }
    .content-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    .card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .card.full-width {
        grid-column: 1 / -1;
    }
    .card-header {
        background: #f8f9fa;
        padding: 16px 20px;
        border-bottom: 1px solid #dee2e6;
    }
    .card-header h2 {
        font-size: 18px;
        color: #495057;
        margin: 0;
    }
    .card-body {
        padding: 20px;
    }
    .info-row {
        display: grid;
        grid-template-columns: 160px 1fr;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .info-row:last-child {
        border-bottom: none;
    }
    .info-row label {
        font-weight: 600;
        color: #495057;
    }
    .info-row span {
        color: #333;
    }
    .badge {
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-info { background: #d1ecf1; color: #0c5460; }
    .badge-scheduled { background: #cce5ff; color: #004085; }
    .badge-confirmed { background: #d4edda; color: #155724; }
    .badge-completed { background: #d6d8db; color: #383d41; }
    .badge-cancelled { background: #f8d7da; color: #721c24; }
    .badge-no-show { background: #fff3cd; color: #856404; }
    .badge-routine { background: #d4edda; color: #155724; }
    .badge-urgent { background: #fff3cd; color: #856404; }
    .badge-emergency { background: #f8d7da; color: #721c24; }
    .link {
        color: #007bff;
        text-decoration: none;
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
@endsection
