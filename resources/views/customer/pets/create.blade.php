<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pet - FURCARE</title>
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Top Navigation Bar */
        .navbar {
            background: #1e293b;
            color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar i.bi {
            font-family: bootstrap-icons;
        }

        .navbar-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
            transition: opacity 0.2s;
        }

        .navbar-brand:hover {
            opacity: 0.8;
        }

        .navbar-logo {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .navbar-title {
            font-size: 20px;
            font-weight: 700;
            color: white;
            letter-spacing: -0.3px;
        }

        .navbar-center {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            justify-content: center;
        }

        .nav-item {
            padding: 8px 16px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-item.active {
            background: rgba(20, 184, 166, 0.15);
            color: #14b8a6;
            border-bottom: 2px solid #14b8a6;
        }

        .navbar-end {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .user-avatar:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .logout-btn {
            padding: 8px 14px;
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Notification Bell Styles */
        .notification-bell-wrapper {
            position: relative;
        }

        .notification-bell {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .notification-bell:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .notification-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            border: 2px solid #1e293b;
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            min-width: 350px;
            max-height: 450px;
            overflow-y: auto;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            margin-top: 8px;
        }

        .notification-dropdown.active {
            display: block;
        }

        .notification-header {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #111827;
            font-weight: 600;
            font-size: 14px;
        }

        .notification-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f3f4f6;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            gap: 12px;
            color: #666;
        }

        .notification-item:hover {
            background: #f9fafb;
        }

        .notification-item.unread {
            background: #f0fdf4;
        }

        .notification-item-icon {
            flex-shrink: 0;
            font-size: 18px;
        }

        .notification-item-content {
            flex: 1;
        }

        .notification-item-title {
            color: #111827;
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 2px;
        }

        .notification-item-message {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .notification-item-time {
            font-size: 11px;
            color: #9ca3af;
        }

        .notification-empty {
            padding: 40px 20px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        .notification-footer {
            padding: 12px 16px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }

        .notification-footer a {
            color: #14b8a6;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .notification-footer a:hover {
            text-decoration: underline;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            width: 100%;
            padding: 40px 24px;
            background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 28px 36px;
            border-radius: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 36px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .header:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .header h1 {
            font-size: 32px;
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.02em;
        }

        .back-link {
            background: white;
            color: #111827;
            border: 1px solid #111827;
            padding: 12px 28px;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
            display: inline-block;
            margin-bottom: 20px;
        }

        .back-link:hover {
            background: #f0fdfa;
            border-color: #14b8a6;
            color: #14b8a6;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.4);
        }

        .form-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            margin-bottom: 24px;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .required {
            color: #dc2626;
        }

        .form-control {
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.15);
        }

        .helper-text {
            font-size: 12px;
            color: #6b7280;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .optional-section {
            background: #f9fafb;
            padding: 16px;
            border-radius: 8px;
            margin-top: 12px;
        }

        .checkbox-label {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            cursor: pointer;
            margin-bottom: 0;
        }

        .checkbox-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .checkbox-label span {
            color: #374151;
            font-weight: 500;
            line-height: 1.4;
        }

        input[type="checkbox"] {
            cursor: pointer;
        }

        /* Photo Upload */
        .photo-upload-section {
            margin-bottom: 24px;
            padding: 20px;
            background: #f9fafb;
            border-radius: 10px;
            border: 2px dashed #e5e7eb;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
        }

        .photo-upload-section:hover {
            border-color: #14b8a6;
            background: #f0fdf4;
        }

        .photo-upload-section.dragover {
            border-color: #14b8a6;
            background: #f0fdf4;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        .photo-upload-icon {
            font-size: 36px;
            color: #14b8a6;
            margin-bottom: 8px;
        }

        .photo-upload-text {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .photo-upload-hint {
            color: #9ca3af;
            font-size: 12px;
            margin-top: 4px;
        }

        .photo-preview {
            margin-top: 16px;
            text-align: center;
        }

        .photo-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .photo-preview-label {
            display: block;
            font-size: 12px;
            color: #64748b;
            margin-top: 8px;
        }

        #pet_photo {
            display: none;
        }

        .form-progress {
            margin-bottom: 20px;
            padding: 16px;
            background: #f0fdf4;
            border-radius: 8px;
            border: 1px solid #a7f3d0;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #14b8a6, #0d9488);
            transition: width 0.3s ease;
            border-radius: 3px;
        }

        .progress-text {
            font-size: 12px;
            color: #14b8a6;
            font-weight: 600;
        }

        .field-error-inline {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        .field-valid {
            border-color: #10b981 !important;
            background-color: #f0fdf4 !important;
        }

        .field-invalid {
            border-color: #ef4444 !important;
            background-color: #fef2f2 !important;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 14px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .error-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .error-list li {
            padding: 4px 0;
        }

        .actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 12px;
        }

        .btn-primary {
            background: #14b8a6;
            color: white;
            border: none;
            padding: 12px 22px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #0d9488;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
            border: none;
            padding: 12px 22px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #d1d5db;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .navbar-center {
                display: none;
            }

            .main-content {
                padding: 20px 16px;
            }

            .page-title {
                font-size: 22px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar {
            animation: fadeIn 0.5s ease-out;
        }

        .form-container {
            animation: fadeInUp 0.6s ease-out;
        }

        .form-group {
            animation: fadeInUp 0.5s ease-out;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }

        /* Button hover effects */
        .btn, .submit-btn, button {
            transition: all 0.3s ease;
        }

        .btn:hover, .submit-btn:hover, button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .btn:active, .submit-btn:active, button:active {
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('customer.dashboard') }}" class="navbar-brand">
                <img src="{{ asset('newlogo.png') }}" alt="FURCARE" class="navbar-logo">
                <span class="navbar-title">FURCARE</span>
            </a>

            <div class="navbar-center">
                <a href="{{ route('customer.dashboard') }}" class="nav-item">
                    Dashboard
                </a>
                <a href="{{ route('customer.pets.index') }}" class="nav-item active">
                    <i class="bi bi-heart-pulse"></i>
                    My Pets
                </a>
                <a href="{{ route('customer.appointments.index') }}" class="nav-item">
                    <i class="bi bi-calendar2-check"></i>
                    Appointments
                </a>
            </div>

            <div class="navbar-end">
                <!-- Notification Bell -->
                <div class="notification-bell-wrapper">
                    <button class="notification-bell" onclick="toggleNotifications()" title="Notifications">
                        <i class="bi bi-bell"></i>
                        @php
                            $unreadCount = auth()->user()->unreadNotifications()->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="notification-badge">{{ min($unreadCount, 9) }}</span>
                        @endif
                    </button>

                    <!-- Notification Dropdown -->
                    <div class="notification-dropdown" id="notificationDropdown">
                        <div class="notification-header">
                            <span>Notifications</span>
                            @if($unreadCount > 0)
                                <button onclick="markAllAsRead()" style="background: rgba(255,255,255,0.2); border: none; color: white; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-size: 11px;">Mark all as read</button>
                            @endif
                        </div>

                        @php
                            $notifications = auth()->user()->notifications()->orderBy('created_at', 'desc')->limit(8)->get();
                        @endphp

                        @if($notifications->count() > 0)
                            @foreach($notifications as $notification)
                                <div class="notification-item {{ $notification->isUnread() ? 'unread' : '' }}" onclick="notificationClick({{ $notification->id }})">
                                    <div class="notification-item-icon">
                                        @if($notification->type == 'request_approved')
                                            <i class="bi bi-check-circle-fill" style="color: #10b981;"></i>
                                        @elseif($notification->type == 'request_rejected')
                                            <i class="bi bi-x-circle-fill" style="color: #ef4444;"></i>
                                        @else
                                            <i class="bi bi-info-circle-fill"></i>
                                        @endif
                                    </div>
                                    <div class="notification-item-content">
                                        <div class="notification-item-title">{{ $notification->title }}</div>
                                        <div class="notification-item-message">{{ Str::limit($notification->message, 80) }}</div>
                                        <div class="notification-item-time">{{ $notification->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="notification-empty">
                                <p><i class="bi bi-inbox" style="font-size: 24px; display: block; margin-bottom: 8px;"></i>No notifications yet</p>
                            </div>
                        @endif

                        @if($notifications->count() > 0)
                            <div class="notification-footer">
                                <a href="{{ route('customer.notifications') }}">View All Notifications →</a>
                            </div>
                        @endif
                    </div>
                    <script>
                        function toggleNotifications() {
                            const dropdown = document.getElementById('notificationDropdown');
                            dropdown.classList.toggle('active');
                        }

                        function markAllAsRead() {
                            fetch('{{ route("customer.notifications.mark-all-read") }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                }
                            }).then(() => {
                                location.reload();
                            });
                        }

                        function notificationClick(id) {
                            fetch(`{{ url('customer/notifications') }}/${id}/read`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                }
                            }).then(res => res.json()).then(data => {
                                if(data.redirect) {
                                    window.location.href = data.redirect;
                                }
                            });
                        }
                    </script>

                </div>

                <div class="user-avatar">
                    <a href="{{ route('profile.show') }}" style="text-decoration: none; color: white;" title="View Profile">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </a>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <a href="{{ route('customer.pets.index') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Back to My Pets
            </a>

            <div class="header">
                <h1><i class="bi bi-paw-fill" style="color: #14b8a6; margin-right: 12px;"></i>Add New Pet</h1>
            </div>

            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle"></i>
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul class="error-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('customer.pets.store') }}" method="POST" enctype="multipart/form-data" id="petForm">
                @csrf

                <!-- Form Progress Indicator -->
                <div class="form-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill" style="width: 0%;"></div>
                    </div>
                    <div class="progress-text"><span id="progressPercent">0</span>% Complete</div>
                </div>

                <!-- Pet Information Card -->
                <div class="form-card">
                    <div class="card-header">
                        <h2><i class="bi bi-info-circle" style="color: #14b8a6; margin-right: 8px;"></i>Pet Information</h2>
                    </div>

                    <!-- Photo Upload -->
                    <div class="form-group full-width">
                        <label>Pet Photo</label>
                        <div class="photo-upload-section" id="photoUpload">
                            <div class="photo-upload-icon">
                                <i class="bi bi-cloud-arrow-up"></i>
                            </div>
                            <p class="photo-upload-text">Drag and drop your pet's photo here, or click to select</p>
                            <p class="photo-upload-hint">PNG, JPG, GIF up to 4MB</p>
                        </div>
                        <input type="file" name="pet_photo" id="pet_photo" accept="image/*">
                        <div class="photo-preview" id="photoPreview" style="display: none;">
                            <img id="previewImage" src="" alt="Pet photo preview">
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Pet Name <span class="required">*</span></label>
                            <input type="text" name="pet_name" class="form-control" required value="{{ old('pet_name') }}" placeholder="e.g., Buddy, Whiskers">
                        </div>

                        <div class="form-group">
                            <label>Species <span class="required">*</span></label>
                            <select name="species_id" id="species_id" class="form-control" required>
                                <option value="">-- Select Species --</option>
                                @foreach($species as $s)
                                    <option value="{{ $s->id }}" {{ old('species_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Breed <span class="required">*</span></label>
                            <input type="text" name="breed" class="form-control" required value="{{ old('breed') }}" placeholder="e.g., Golden Retriever, Persian">
                        </div>

                        <div class="form-group">
                            <label>Color</label>
                            <input type="text" name="color" class="form-control" value="{{ old('color') }}" placeholder="e.g., Brown, White">
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Date of Birth <span class="required">*</span></label>
                            <input type="date" name="birthdate" class="form-control" required value="{{ old('birthdate') }}" max="{{ date('Y-m-d') }}">
                            <span class="helper-text">Age will be auto-calculated</span>
                        </div>

                        <div class="form-group">
                            <label>Sex <span class="required">*</span></label>
                            <select name="sex" class="form-control" required>
                                <option value="">-- Select --</option>
                                <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Additional Information Card -->
                <div class="form-card">
                    <div class="card-header">
                        <h2><i class="bi bi-file-text" style="color: #14b8a6; margin-right: 8px;"></i>Additional Information</h2>
                    </div>

                    <div class="optional-section">
                        <div class="form-group full-width" style="margin-bottom: 20px;">
                            <label class="checkbox-label">
                                <input type="checkbox" name="has_special_needs" value="1" {{ old('has_special_needs') ? 'checked' : '' }}>
                                <div>
                                    <span>Pet has special care needs</span>
                                    <div class="helper-text" style="margin-top: 4px;">Check this if your pet requires special care or attention</div>
                                </div>
                            </label>
                        </div>
                        <div class="form-group full-width">
                            <label class="checkbox-label">
                                <input type="checkbox" name="privacy_consent" value="1" {{ old('privacy_consent') ? 'checked' : '' }}>
                                <div>
                                    <span>I consent to data privacy and processing</span>
                                    <div class="helper-text" style="margin-top: 4px;">Please review our privacy policy before consent</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="actions">
                    <button type="button" class="btn-secondary" onclick="goBack()">Cancel</button>
                    <button type="submit" class="btn-primary">Add Pet</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function goBack() {
            const referrer = document.referrer;
            const currentDomain = window.location.origin;

            if (referrer && referrer.startsWith(currentDomain) && referrer !== window.location.href) {
                window.history.back();
            } else {
                window.location.href = "{{ route('customer.pets.index') }}";
            }
        }

        // Form Progress Tracking
        const petForm = document.getElementById('petForm');
        const requiredFields = ['pet_name', 'species_id', 'breed', 'birthdate', 'sex'];
        const submitBtn = document.querySelector('.btn-primary');

        function areAllRequiredFieldsFilled() {
            return requiredFields.every(fieldName => {
                const field = document.querySelector(`[name="${fieldName}"]`);
                return field && field.value.trim() !== '';
            });
        }

        function updateSubmitButton() {
            if (areAllRequiredFieldsFilled()) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            } else {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
                submitBtn.style.cursor = 'not-allowed';
            }
        }

        function updateFormProgress() {
            let completed = 0;
            requiredFields.forEach(fieldName => {
                const field = document.querySelector(`[name="${fieldName}"]`);
                if (field && field.value.trim()) {
                    completed++;
                }
            });

            const percent = Math.round((completed / requiredFields.length) * 100);
            document.getElementById('progressFill').style.width = percent + '%';
            document.getElementById('progressPercent').textContent = percent;

            // Update submit button state
            updateSubmitButton();
        }

        // Real-time validation
        function validateField(field) {
            let isValid = true;
            let errorMsg = '';

            if (field.name === 'pet_name') {
                isValid = field.value.trim().length > 0;
                errorMsg = 'Pet name is required';
            } else if (field.name === 'species_id') {
                isValid = field.value !== '';
                errorMsg = 'Please select a species';
            } else if (field.name === 'breed') {
                isValid = field.value.trim().length > 0;
                errorMsg = 'Breed is required';
            } else if (field.name === 'birthdate') {
                isValid = field.value !== '';
                errorMsg = 'Date of birth is required';
            } else if (field.name === 'sex') {
                isValid = field.value !== '';
                errorMsg = 'Please select sex';
            }

            // Remove existing error
            const existingError = field.parentElement.querySelector('.field-error-inline');
            if (existingError) existingError.remove();

            if (!isValid && field.value !== '') {
                field.classList.add('field-invalid');
                field.classList.remove('field-valid');
                const errorEl = document.createElement('span');
                errorEl.className = 'field-error-inline';
                errorEl.textContent = errorMsg;
                field.parentElement.appendChild(errorEl);
            } else if (isValid && field.value !== '') {
                field.classList.add('field-valid');
                field.classList.remove('field-invalid');
            } else {
                field.classList.remove('field-valid', 'field-invalid');
            }

            return isValid || field.value === '';
        }

        // Add validation to all form fields
        document.querySelectorAll('input[required], select[required]').forEach(field => {
            field.addEventListener('blur', function() {
                validateField(this);
                updateFormProgress();
            });
            field.addEventListener('input', updateFormProgress);
            field.addEventListener('change', function() {
                validateField(this);
                updateFormProgress();
            });
        });

        // Photo upload functionality
        const photoUpload = document.getElementById('photoUpload');
        const photoInput = document.getElementById('pet_photo');
        const photoPreview = document.getElementById('photoPreview');
        const previewImage = document.getElementById('previewImage');

        // Click to upload
        photoUpload.addEventListener('click', () => photoInput.click());

        // File input change
        photoInput.addEventListener('change', handleFileSelect);

        // Drag and drop
        photoUpload.addEventListener('dragover', (e) => {
            e.preventDefault();
            photoUpload.classList.add('dragover');
        });

        photoUpload.addEventListener('dragleave', () => {
            photoUpload.classList.remove('dragover');
        });

        photoUpload.addEventListener('drop', (e) => {
            e.preventDefault();
            photoUpload.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                photoInput.files = files;
                handleFileSelect();
            }
        });

        function handleFileSelect() {
            const file = photoInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                    photoPreview.style.display = 'block';
                    photoUpload.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        }

        // Allow user to change photo by clicking preview
        photoPreview.addEventListener('click', () => photoInput.click());
        photoPreview.style.cursor = 'pointer';

        // Initialize form state
        updateFormProgress();
    </script>
</body>
</html>
