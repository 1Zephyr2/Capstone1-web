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
            color: #111827;
            transition: all 0.3s ease;
            border: 1px solid #111827;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            color: #14b8a6;

            background: #f0fdfa;
            background: rgba(20, 184, 166, 0.15);
            color: #14b8a6;
            border-bottom: 2px solid #14b8a6;
        }

        .navbar-end {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
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

        /* Hide top-nav white bar */
        .top-nav {
            display: none !important;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
            padding: 40px 24px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: white;
            color: #111827;
            text-decoration: none;
            border: 1px solid #111827;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #14b8a6;
            border-color: #14b8a6;
            background: #f0fdfa;
        }

        /* Appointment Header */
        .appointment-header {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            border-radius: 12px;
            padding: 24px;
            color: white;
            margin-bottom: 24px;
        }

        .appointment-header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .appointment-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 4px;
            opacity: 0.9;
        }

        .status-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }

        .info-label {
            color: #9ca3af;
            font-weight: 500;
        }

        .info-value {
            color: #1f2937;
            font-weight: 600;
        }

        /* Section */
        .section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .content-block {
            color: #6b7280;
            line-height: 1.6;
        }

        .appointment-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .info-box {
            padding: 16px;
            background: #f9fafb;
            border-radius: 8px;
            border-left: 4px solid #14b8a6;
        }

        .info-box-label {
            color: #9ca3af;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .info-box-value {
            color: #1f2937;
            font-size: 16px;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            margin-top: 16px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            background: #14b8a6;
            color: white;
        }

        .btn-primary:hover {
            background: #0d9488;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        @media (max-width: 768px) {
            .navbar-center {
                display: none;
            }

            .main-content {
                padding: 20px 16px;
            }

            .appointment-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .cards-grid {
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

        .appointment-header {
            animation: fadeInUp 0.6s ease-out;
        }

        .card {
            animation: fadeInUp 0.5s ease-out;
        }

        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }

        /* Button hover effects */
        .btn, .action-btn {
            transition: all 0.3s ease;
        }

        .btn:hover, .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .btn:active, .action-btn:active {
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('customer.dashboard') }}" class="navbar-brand">
                <img src="{{ asset('newlogo.png') }}" alt="PAWSER" class="navbar-logo" onerror="this.style.display='none'">
                <span class="navbar-title">PAWSER</span>
            </a>
            <div class="navbar-center">
                <a href="{{ route('customer.dashboard') }}" class="nav-item">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
                <a href="{{ route('customer.pets.index') }}" class="nav-item">
                    <i class="bi bi-heart-pulse"></i>
                    My Pets
                </a>
                <a href="{{ route('customer.appointments.index') }}" class="nav-item active">
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

                <div class="user-menu">
                    <a href="{{ route('profile.show') }}" class="user-avatar" style="text-decoration: none;" title="View Profile">{{ substr(auth()->user()->name, 0, 1) }}</a>
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
        <a href="{{ route('customer.appointments.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i>
            Back to Appointments
        </a>

        <!-- Appointment Header -->
        <div class="appointment-header">
            <h1>{{ $appointment->service_type ?? 'Appointment' }}</h1>
            <div class="appointment-meta">
                <div class="meta-item">
                    <i class="bi bi-calendar-event"></i>
                    {{ $appointment->appointment_date->format('l, M d, Y') }} at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                </div>
                <div class="meta-item">
                    <i class="bi bi-paw"></i>
                    {{ $pet->name }} ({{ $pet->species ?? 'Unknown' }})
                </div>
                @if($appointment->appointment_date->isToday())
                    <span class="status-badge">
                        <i class="bi bi-exclamation-circle"></i>
                        Today
                    </span>
                @elseif($appointment->appointment_date->isFuture())
                    <span class="status-badge">
                        <i class="bi bi-check-circle"></i>
                        Upcoming
                    </span>
                @else
                    <span class="status-badge">
                        <i class="bi bi-check-all"></i>
                        Completed
                    </span>
                @endif
            </div>
        </div>

        <!-- Quick Info -->
        <div class="cards-grid">
            <div class="card">
                <div class="card-title">
                    <i class="bi bi-calendar-event"></i>
                    Date & Time
                </div>
                <div class="info-item">
                    <span class="info-label">Appointment Date</span>
                    <span class="info-value">{{ $appointment->appointment_date->format('M d, Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Time</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <i class="bi bi-paw"></i>
                    Pet Information
                </div>
                <div class="info-item">
                    <span class="info-label">Pet Name</span>
                    <span class="info-value">{{ $pet->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Species</span>
                    <span class="info-value">{{ $pet->species ?? 'Unknown' }}</span>
                </div>
            </div>

            @if($appointment->veterinarian)
                <div class="card">
                    <div class="card-title">
                        <i class="bi bi-person-badge"></i>
                        Veterinarian
                    </div>
                    <div class="info-item">
                        <span class="info-label">Name</span>
                        <span class="info-value">{{ $appointment->veterinarian }}</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Appointment Details -->
        <div class="section">
            <div class="section-title">
                <i class="bi bi-info-circle"></i>
                Appointment Details
            </div>

            <div class="appointment-info-grid">
                <div class="info-box">
                    <div class="info-box-label">Reason for Visit</div>
                    <div class="info-box-value">{{ $appointment->service_type ?? 'General Checkup' }}</div>
                </div>

                @if($appointment->status)
                    <div class="info-box">
                        <div class="info-box-label">Status</div>
                        <div class="info-box-value">{{ ucfirst($appointment->status) }}</div>
                    </div>
                @endif

                @if($appointment->clinic_location)
                    <div class="info-box">
                        <div class="info-box-label">Clinic Location</div>
                        <div class="info-box-value">{{ $appointment->clinic_location }}</div>
                    </div>
                @endif
            </div>

            @if($appointment->notes)
                <div style="margin-top: 16px;">
                    <p style="color: #9ca3af; font-size: 12px; margin-bottom: 8px;">NOTES</p>
                    <div style="padding: 12px; background: #f9fafb; border-radius: 8px; border-left: 4px solid #14b8a6; color: #6b7280; line-height: 1.6;">
                        {{ $appointment->notes }}
                    </div>
                </div>
            @endif
        </div>

        <!-- Pet Owner Information -->
        <div class="section">
            <div class="section-title">
                <i class="bi bi-person"></i>
                Your Contact Information
            </div>

            <div class="appointment-info-grid">
                <div class="info-box">
                    <div class="info-box-label">Owner Name</div>
                    <div class="info-box-value">{{ $pet->owner_name }}</div>
                </div>
                <div class="info-box">
                    <div class="info-box-label">Contact</div>
                    <div class="info-box-value">{{ $pet->owner_contact }}</div>
                </div>
                @if($pet->address)
                    <div class="info-box">
                        <div class="info-box-label">Address</div>
                        <div class="info-box-value">{{ $pet->address }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Important Notes -->
        <div class="section" style="border-left: 4px solid #f59e0b;">
            <div class="section-title">
                <i class="bi bi-exclamation-triangle"></i>
                Important Reminders
            </div>
            <div class="content-block">
                <ul style="margin-left: 20px; color: #6b7280;">
                    <li style="margin-bottom: 8px;">Please arrive 10-15 minutes early to complete any necessary paperwork.</li>
                    <li style="margin-bottom: 8px;">Bring your pet's medical records if this is your first visit.</li>
                    <li style="margin-bottom: 8px;">If you need to reschedule, please contact the clinic as soon as possible.</li>
                    <li>Keep your pet calm and secure during transport to the appointment.</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
