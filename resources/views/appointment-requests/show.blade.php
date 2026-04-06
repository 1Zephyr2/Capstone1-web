<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Request Details - PAWSER</title>
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
            min-height: 100vh;
            padding: 20px;
            color: #0f172a;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: white;
            border: 1px solid #e5e7eb;
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

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-header {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            padding: 24px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h1 {
            font-size: 24px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-pending {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .badge-approved {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .card-body {
            padding: 28px;
        }

        .section {
            margin-bottom: 28px;
        }

        .section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: #14b8a6;
        }

        .info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 16px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 15px;
            color: #0f172a;
            font-weight: 500;
        }

        .info-row.full {
            grid-template-columns: 1fr;
        }

        .notes-box {
            background: #f3f4f6;
            padding: 16px;
            border-radius: 8px;
            border-left: 4px solid #14b8a6;
        }

        .notes-box p {
            margin: 0;
            line-height: 1.6;
            color: #374151;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .action-buttons > * {
            flex: 1;
            min-width: 0;
        }

        button,
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #6b7280;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #d1d5db;
            color: #4b5563;
        }

        .btn-approve {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-approve:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
        }

        .btn-reject {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-reject:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            max-width: 500px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            padding: 24px;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 20px;
            color: #0f172a;
        }

        .modal-body {
            padding: 24px;
        }

        .form-group {
            margin-bottom: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-weight: 600;
            color: #1f2937;
            font-size: 13px;
        }

        textarea {
            padding: 12px 14px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            resize: vertical;
            min-height: 100px;
        }

        textarea:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding-top: 20px;
        }

        .close-button {
            position: absolute;
            top: 16px;
            right: 16px;
            background: none;
            border: none;
            font-size: 28px;
            color: #6b7280;
            cursor: pointer;
        }

        .rejection-info {
            background: #fee2e2;
            padding: 16px;
            border-radius: 8px;
            border-left: 4px solid #ef4444;
            margin-bottom: 16px;
        }

        .rejection-info strong {
            color: #991b1b;
        }

        .rejection-info p {
            margin: 0;
            color: #7f1d1d;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('appointment-requests.index') }}" class="back-button">
            <i class="bi bi-arrow-left"></i> Back to Requests
        </a>

        <div class="card">
            <div class="card-header">
                <h1>
                    Appointment Request
                </h1>
                @if ($appointmentRequest->status === 'pending')
                    <span class="badge badge-pending">{{ ucfirst($appointmentRequest->status) }}</span>
                @elseif ($appointmentRequest->status === 'approved')
                    <span class="badge badge-approved">{{ ucfirst($appointmentRequest->status) }}</span>
                @elseif ($appointmentRequest->status === 'rejected')
                    <span class="badge badge-rejected">{{ ucfirst($appointmentRequest->status) }}</span>
                @endif
            </div>

            <div class="card-body">
                <!-- Customer Information -->
                <div class="section">
                    <div class="section-title">
                        <i class="bi bi-person-fill"></i> Customer Information
                    </div>
                    <div class="info-row">
                        <div class="info-item">
                            <div class="info-label">Name</div>
                            <div class="info-value">{{ $appointmentRequest->user?->name ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $appointmentRequest->user?->email ?? 'N/A' }}</div>
                        </div>
                    </div>
                    @if ($appointmentRequest->user?->phone)
                        <div class="info-row">
                            <div class="info-item">
                                <div class="info-label">Phone</div>
                                <div class="info-value">{{ $appointmentRequest->user?->phone ?? 'N/A' }}</div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Pet Information -->
                <div class="section">
                    <div class="section-title">
                        <i class="bi bi-paw-fill"></i> Pet Information
                    </div>
                    <div class="info-row">
                        <div class="info-item">
                            <div class="info-label">Pet Name</div>
                            <div class="info-value">{{ $appointmentRequest->patient?->pet_name ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Species</div>
                            <div class="info-value">{{ $appointmentRequest->patient?->species ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-item">
                            <div class="info-label">Breed</div>
                            <div class="info-value">{{ $appointmentRequest->patient?->breed ?? 'Not specified' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Age</div>
                            <div class="info-value">{{ $appointmentRequest->patient?->age ?? 'Not specified' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Appointment Details -->
                <div class="section">
                    <div class="section-title">
                        <i class="bi bi-calendar3"></i> Appointment Details
                    </div>
                    <div class="info-row">
                        <div class="info-item">
                            <div class="info-label">Requested Date</div>
                            <div class="info-value">{{ $appointmentRequest->requested_date?->format('l, F j, Y') ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Requested Time</div>
                            <div class="info-value">{{ $appointmentRequest->requested_time ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-item">
                            <div class="info-label">Service Type</div>
                            <div class="info-value">{{ $appointmentRequest->service_type ?? 'General' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Submitted</div>
                            <div class="info-value">{{ $appointmentRequest->created_at?->format('M d, Y h:i A') ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Customer Notes -->
                @if ($appointmentRequest->preferred_notes)
                    <div class="section">
                        <div class="section-title">
                            <i class="bi bi-chat-left-text-fill"></i> Customer Notes
                        </div>
                        <div class="notes-box">
                            <p>{{ $appointmentRequest->preferred_notes ?? 'No notes' }}</p>
                        </div>
                    </div>
                @endif

                <!-- Rejection Reason (if rejected) -->
                @if ($appointmentRequest->status === 'rejected' && $appointmentRequest->rejection_reason)
                    <div class="section">
                        <div class="section-title">
                            <i class="bi bi-exclamation-circle"></i> Rejection Reason
                        </div>
                        <div class="rejection-info">
                            <p>{{ $appointmentRequest->rejection_reason ?? 'No reason provided' }}</p>
                        </div>
                    </div>
                @endif

                <!-- Approval Information (if approved) -->
                @if ($appointmentRequest->status === 'approved' && $appointmentRequest->approvedBy)
                    <div class="section">
                        <div class="section-title">
                            <i class="bi bi-check-circle-fill"></i> Approval Information
                        </div>
                        <div class="info-row">
                            <div class="info-item">
                                <div class="info-label">Approved By</div>
                                <div class="info-value">{{ $appointmentRequest->approvedBy?->name ?? 'N/A' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Approved On</div>
                                <div class="info-value">{{ $appointmentRequest->approved_at?->format('M d, Y h:i A') ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                @if ($appointmentRequest->status === 'pending')
                    <div class="action-buttons">
                        <a href="{{ route('appointment-requests.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="button" onclick="openRejectModal()" class="btn btn-reject">
                            Reject Request
                        </button>
                        <form action="{{ route('appointment-requests.approve', $appointmentRequest->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-approve">
                                Approve & Create Appointment
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Rejection Modal -->
    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <button type="button" onclick="closeRejectModal()" class="close-button">×</button>
            <div class="modal-header">
                <h2>Reject Appointment Request</h2>
            </div>
            <form action="{{ route('appointment-requests.reject', $appointmentRequest->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rejection_reason">Reason for Rejection <span style="color: #dc2626;">*</span></label>
                        <textarea id="rejection_reason" name="rejection_reason" placeholder="Please provide a reason for rejecting this request..." required></textarea>
                    </div>
                </div>
                <div class="modal-actions" style="padding: 0 24px 24px;">
                    <button type="button" onclick="closeRejectModal()" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-reject">Reject Request</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal() {
            document.getElementById('rejectModal').classList.add('active');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('rejectModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
    </script>
</body>
</html>

