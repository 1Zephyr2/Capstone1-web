@extends('layouts.app')

@section('title', 'Edit Appointment')

@section('content')
<div class="container">
    <div class="header">
        <div class="header-top">
            <a href="{{ route('appointments.show', $appointment) }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Back to Appointment
            </a>
            <h1><i class="bi bi-pencil-square"></i> Edit Appointment</h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
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
        
        <div class="form-card">
            <div class="card-header">
                <h2><i class="bi bi-person"></i> Patient Information</h2>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="patient_id">Patient <span class="required">*</span></label>
                        <select name="patient_id" id="patient_id" class="form-control" required>
                            <option value="{{ $appointment->patient->id }}">
                                {{ $appointment->patient->full_name }} ({{ $appointment->patient->patient_id }})
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="card-header">
                <h2><i class="bi bi-calendar-check"></i> Appointment Details</h2>
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
                        <input type="time" name="appointment_time" id="appointment_time" class="form-control" 
                               value="{{ old('appointment_time', \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i')) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="service_type">Service Type <span class="required">*</span></label>
                        <select name="service_type" id="service_type" class="form-control" required>
                            <option value="">Select Service</option>
                            <option value="Immunization" {{ old('service_type', $appointment->service_type) == 'Immunization' ? 'selected' : '' }}>Immunization</option>
                            <option value="Prenatal Care" {{ old('service_type', $appointment->service_type) == 'Prenatal Care' ? 'selected' : '' }}>Prenatal Care</option>
                            <option value="General Checkup" {{ old('service_type', $appointment->service_type) == 'General Checkup' ? 'selected' : '' }}>General Checkup</option>
                            <option value="Family Planning" {{ old('service_type', $appointment->service_type) == 'Family Planning' ? 'selected' : '' }}>Family Planning</option>
                            <option value="Referral" {{ old('service_type', $appointment->service_type) == 'Referral' ? 'selected' : '' }}>Referral</option>
                            <option value="Other" {{ old('service_type', $appointment->service_type) == 'Other' ? 'selected' : '' }}>Other</option>
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
                        <textarea name="chief_complaint" id="chief_complaint" class="form-control" rows="3">{{ old('chief_complaint', $appointment->chief_complaint) }}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="health_worker">Health Worker</label>
                        <input type="text" name="health_worker" id="health_worker" class="form-control" 
                               value="{{ old('health_worker', $appointment->health_worker) }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes', $appointment->notes) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service-Specific Fields -->
        <div id="immunization-fields" class="form-card" style="display: none;">
            <div class="card-header">
                <h2><i class="bi bi-shield-check"></i> Immunization Details</h2>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="vaccine_name">Vaccine Name</label>
                        <input type="text" name="vaccine_name" id="vaccine_name" class="form-control" 
                               value="{{ old('vaccine_name', $appointment->vaccine_name) }}">
                    </div>
                    <div class="form-group">
                        <label for="dose_number">Dose Number</label>
                        <input type="number" name="dose_number" id="dose_number" class="form-control" min="1" 
                               value="{{ old('dose_number', $appointment->dose_number) }}">
                    </div>
                </div>
            </div>
        </div>

        <div id="prenatal-fields" class="form-card" style="display: none;">
            <div class="card-header">
                <h2><i class="bi bi-heart-pulse"></i> Prenatal Care Details</h2>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="gestational_age">Gestational Age (weeks)</label>
                        <input type="number" name="gestational_age" id="gestational_age" class="form-control" min="0" 
                               value="{{ old('gestational_age', $appointment->gestational_age) }}">
                    </div>
                    <div class="form-group">
                        <label for="presentation">Presentation</label>
                        <input type="text" name="presentation" id="presentation" class="form-control" 
                               value="{{ old('presentation', $appointment->presentation) }}">
                    </div>
                </div>
            </div>
        </div>

        <div id="familyplanning-fields" class="form-card" style="display: none;">
            <div class="card-header">
                <h2><i class="bi bi-people"></i> Family Planning Details</h2>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="fp_method">FP Method</label>
                        <input type="text" name="fp_method" id="fp_method" class="form-control" 
                               value="{{ old('fp_method', $appointment->fp_method) }}">
                    </div>
                </div>
            </div>
        </div>

        <div id="referral-fields" class="form-card" style="display: none;">
            <div class="card-header">
                <h2><i class="bi bi-hospital"></i> Referral Details</h2>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="referred_to">Referred To</label>
                        <input type="text" name="referred_to" id="referred_to" class="form-control" 
                               value="{{ old('referred_to', $appointment->referred_to) }}">
                    </div>
                    <div class="form-group">
                        <label for="referral_urgency">Urgency</label>
                        <select name="referral_urgency" id="referral_urgency" class="form-control">
                            <option value="">Select Urgency</option>
                            <option value="routine" {{ old('referral_urgency', $appointment->referral_urgency) == 'routine' ? 'selected' : '' }}>Routine</option>
                            <option value="urgent" {{ old('referral_urgency', $appointment->referral_urgency) == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            <option value="emergency" {{ old('referral_urgency', $appointment->referral_urgency) == 'emergency' ? 'selected' : '' }}>Emergency</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Update Appointment
            </button>
            <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancel
            </a>
        </div>
    </form>
</div>

<style>
    .container {
        max-width: 1000px;
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
        margin: 12px 0 0 0;
    }
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #007bff;
        text-decoration: none;
        font-size: 14px;
    }
    .btn-back:hover {
        text-decoration: underline;
    }
    .alert {
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    .alert ul {
        margin: 8px 0 0 20px;
    }
    .form-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
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
        padding: 24px;
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
        color: #495057;
        margin-bottom: 8px;
        font-size: 14px;
    }
    .required {
        color: #dc3545;
    }
    .form-control {
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s;
    }
    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }
    textarea.form-control {
        resize: vertical;
        font-family: inherit;
    }
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }
    .btn {
        padding: 12px 24px;
        border-radius: 8px;
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
        background: #007bff;
        color: white;
    }
    .btn-primary:hover {
        background: #0056b3;
    }
    .btn-secondary {
        background: #6c757d;
        color: white;
    }
    .btn-secondary:hover {
        background: #545b62;
    }
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const serviceTypeSelect = document.getElementById('service_type');
        const immunizationFields = document.getElementById('immunization-fields');
        const prenatalFields = document.getElementById('prenatal-fields');
        const familyPlanningFields = document.getElementById('familyplanning-fields');
        const referralFields = document.getElementById('referral-fields');

        function toggleServiceFields() {
            const serviceType = serviceTypeSelect.value;
            
            // Hide all service-specific fields
            immunizationFields.style.display = 'none';
            prenatalFields.style.display = 'none';
            familyPlanningFields.style.display = 'none';
            referralFields.style.display = 'none';

            // Show relevant fields
            if (serviceType === 'Immunization') {
                immunizationFields.style.display = 'block';
            } else if (serviceType === 'Prenatal Care') {
                prenatalFields.style.display = 'block';
            } else if (serviceType === 'Family Planning') {
                familyPlanningFields.style.display = 'block';
            } else if (serviceType === 'Referral') {
                referralFields.style.display = 'block';
            }
        }

        serviceTypeSelect.addEventListener('change', toggleServiceFields);
        
        // Initialize on page load
        toggleServiceFields();
    });
</script>
@endsection
