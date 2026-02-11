@extends('layouts.app')

@section('title', 'Appointments')

@section('content')
<div class="container">
    <div class="header">
        <div class="header-top">
            <h1><i class="bi bi-calendar-check"></i> Appointments</h1>
        </div>
        
        <div class="header-actions">
            <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> New Appointment
            </a>
            <a href="{{ route('appointments.today') }}" class="btn btn-secondary">
                <i class="bi bi-calendar-day"></i> Today's Appointments
            </a>
        </div>

        <!-- Filters -->
        <form method="GET" action="{{ route('appointments.index') }}" class="filters-form">
            <div class="filters-row">
                <input type="text" name="search" placeholder="Search patient..." value="{{ request('search') }}" class="form-control">
                
                <select name="status" class="form-control">
                    <option value="all">All Status</option>
                    <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="no-show" {{ request('status') == 'no-show' ? 'selected' : '' }}>No-Show</option>
                </select>

                <select name="service_type" class="form-control">
                    <option value="all">All Services</option>
                    <option value="Immunization" {{ request('service_type') == 'Immunization' ? 'selected' : '' }}>Immunization</option>
                    <option value="Prenatal Care" {{ request('service_type') == 'Prenatal Care' ? 'selected' : '' }}>Prenatal Care</option>
                    <option value="General Checkup" {{ request('service_type') == 'General Checkup' ? 'selected' : '' }}>General Checkup</option>
                    <option value="Family Planning" {{ request('service_type') == 'Family Planning' ? 'selected' : '' }}>Family Planning</option>
                </select>

                <button type="submit" class="btn btn-search">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="appointments-table">
        <table>
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Patient</th>
                    <th>Service Type</th>
                    <th>Status</th>
                    <th>Chief Complaint</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr>
                        <td>
                            {{ $appointment->appointment_date->format('M d, Y') }}<br>
                            <small>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</small>
                        </td>
                        <td>{{ $appointment->patient->full_name }}</td>
                        <td>{{ $appointment->service_type }}</td>
                        <td>
                            <span class="badge badge-{{ $appointment->status }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td>{{ $appointment->chief_complaint ?? 'N/A' }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('appointments.show', $appointment) }}" class="btn-action btn-view">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('appointments.edit', $appointment) }}" class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px;">
                            <i class="bi bi-calendar-x" style="font-size: 48px; color: #ccc;"></i>
                            <p style="color: #999; margin-top: 16px;">No appointments found</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $appointments->links() }}
    </div>
</div>

<style>
    .container {
        max-width: 1400px;
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
        margin-bottom: 20px;
    }
    .header-actions {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
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
    .btn-secondary {
        background: #6c757d;
        color: white;
    }
    .btn-secondary:hover {
        background: #545b62;
    }
    .filters-form {
        margin-top: 20px;
    }
    .filters-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto;
        gap: 12px;
    }
    .form-control {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }
    .btn-search {
        background: #28a745;
        color: white;
        padding: 10px 24px;
    }
    .btn-search:hover {
        background: #218838;
    }
    .alert {
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    .appointments-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th {
        background: #f8f9fa;
        padding: 16px;
        text-align: left;
        font-weight: 600;
        color: #495057;
        border-bottom: 2px solid #dee2e6;
    }
    td {
        padding: 16px;
        border-bottom: 1px solid #dee2e6;
    }
    .badge {
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-scheduled { background: #cce5ff; color: #004085; }
    .badge-confirmed { background: #d4edda; color: #155724; }
    .badge-completed { background: #d6d8db; color: #383d41; }
    .badge-cancelled { background: #f8d7da; color: #721c24; }
    .badge-no-show { background: #fff3cd; color: #856404; }
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    .btn-action {
        padding: 6px 10px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        background: none;
    }
    .btn-view { color: #007bff; }
    .btn-view:hover { background: #e7f1ff; }
    .btn-edit { color: #28a745; }
    .btn-edit:hover { background: #d4edda; }
    .btn-delete { color: #dc3545; }
    .btn-delete:hover { background: #f8d7da; }
    .pagination-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
</style>
@endsection
