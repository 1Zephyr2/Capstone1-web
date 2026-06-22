<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments - FURCARE</title>
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Top Navigation Bar */
        .navbar {
    background: #1C2B33;
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
    background: rgba(15, 138, 122, 0.18);
    color: #1DCBA8;
    border-bottom: 2px solid #1DCBA8;
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

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Appointments Container */
        .appointments-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .appointments-list {
            divide-y divide-gray-200;
        }

        .appointment-item {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .appointment-item:last-child {
            border-bottom: none;
        }

        .appointment-item:hover {
            background: #f9fafb;
        }

        .appointment-content {
            flex: 1;
        }

        .appointment-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .appointment-pet {
            font-weight: 600;
            color: #1f2937;
            font-size: 16px;
        }

        .appointment-reason {
            background: rgba(20, 184, 166, 0.1);
            color: #14b8a6;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .appointment-date {
            color: #6b7280;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .appointment-link {
            padding: 8px 16px;
            background: #14b8a6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .appointment-link:hover {
            background: #0d9488;
            transform: translateY(-1px);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-upcoming {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .status-today {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
        }

        .empty-state i {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 16px;
        }

        .pagination-container {
            padding: 16px 20px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .pagination-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            color: #14b8a6;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .pagination-link:hover {
            background: #f3f4f6;
            border-color: #14b8a6;
        }

        .pagination-link.active {
            background: #14b8a6;
            color: white;
            border-color: #14b8a6;
        }

        .pagination-link.disabled {
            color: #d1d5db;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .navbar-center {
                display: none;
            }

            .main-content {
                padding: 20px 16px;
            }

            .appointment-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .appointment-link {
                width: 100%;
                justify-content: center;
            }

            .page-title {
                font-size: 24px;
            }
        }

        /* Appointments Container */
        .appointments-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .appointments-list {
            divide-y divide-gray-200;
        }

        .appointment-item {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .appointment-item:last-child {
            border-bottom: none;
        }

        .appointment-item:hover {
            background: #f9fafb;
        }

        .appointment-content {
            flex: 1;
        }

        .appointment-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .appointment-pet {
            font-weight: 600;
            color: #1f2937;
            font-size: 16px;
        }

        .appointment-reason {
            background: rgba(20, 184, 166, 0.1);
            color: #14b8a6;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .appointment-date {
            color: #6b7280;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .appointment-link {
            padding: 8px 16px;
            background: #14b8a6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .appointment-link:hover {
            background: #0d9488;
            transform: translateY(-1px);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-upcoming {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .status-today {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
        }

        .empty-state i {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 16px;
        }

        .pagination-container {
            padding: 16px 20px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .pagination-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            color: #14b8a6;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .pagination-link:hover {
            background: #f3f4f6;
            border-color: #14b8a6;
        }

        .pagination-link.active {
            background: #14b8a6;
            color: white;
            border-color: #14b8a6;
        }

        .pagination-link.disabled {
            color: #d1d5db;
            cursor: not-allowed;
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

        .page-header {
            animation: fadeInUp 0.6s ease-out;
        }

        .appointments-list {
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        .appointment-item {
            animation: fadeInUp 0.5s ease-out;
        }

        .appointment-item:nth-child(1) { animation-delay: 0.1s; }
        .appointment-item:nth-child(2) { animation-delay: 0.2s; }
        .appointment-item:nth-child(3) { animation-delay: 0.3s; }

        /* Button hover effects */
        .btn, .view-btn {
            transition: all 0.3s ease;
        }

        .btn:hover, .view-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .btn:active, .view-btn:active {
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('customer.dashboard') }}" class="navbar-brand">
                <img src="{{ asset('newlogo.png') }}" alt="FURCARE" class="navbar-logo" onerror="this.style.display='none'">
                <span class="navbar-title">FURCARE</span>
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
                    <a href="{{ route('profile.show') }}" class="user-avatar" style="text-decoration: none;" title="View Profile">
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
    <div class="page-header">
        <h1 class="page-title">My Appointments</h1>
    </div>

    {{-- Appointment Requests Section (pending/rejected/cancelled) --}}
    @if($appointmentRequests->isNotEmpty())
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 14px; display:flex; align-items:center; gap:8px;">
            <i class="bi bi-hourglass-split" style="color:#f59e0b;"></i> Appointment Requests
        </h2>
        <div class="appointments-container">
            <div class="appointments-list">
                @foreach($appointmentRequests as $req)
                <div class="appointment-item" style="
                    @if($req->status === 'rejected') background: #fff5f5; border-left: 4px solid #ef4444;
                    @elseif($req->status === 'pending') border-left: 4px solid #f59e0b;
                    @else border-left: 4px solid #d1d5db;
                    @endif
                ">
                    <div class="appointment-content">
                        <div class="appointment-header">
                            <span class="appointment-pet">
                                <i class="bi bi-paw"></i> {{ $req->patient->pet_name ?? 'Unknown Pet' }}
                            </span>
                            @if($req->service_type)
                                <span class="appointment-reason">{{ $req->service_type }}</span>
                            @endif
                            {{-- Status Badge --}}
                            @if($req->status === 'pending')
                                <span class="status-badge" style="background:rgba(245,158,11,0.1); color:#d97706;">
                                    <i class="bi bi-hourglass-split"></i> Pending Review
                                </span>
                            @elseif($req->status === 'rejected')
                                <span class="status-badge" style="background:rgba(239,68,68,0.1); color:#ef4444;">
                                    <i class="bi bi-x-circle"></i> Rejected
                                </span>
                            @elseif($req->status === 'cancelled')
                                <span class="status-badge" style="background:rgba(107,114,128,0.1); color:#6b7280;">
                                    <i class="bi bi-slash-circle"></i> Cancelled
                                </span>
                            @endif
                        </div>

                        <div class="appointment-date">
                            <i class="bi bi-calendar-event"></i>
                            Requested: {{ $req->requested_date->format('l, M d, Y') }}
                            at {{ \Carbon\Carbon::parse($req->requested_time)->format('g:i A') }}
                        </div>

                        {{-- Rejection Reason --}}
                        @if($req->status === 'rejected' && $req->rejection_reason)
                            <div style="margin-top: 10px; padding: 12px 14px; background: #fee2e2; border-left: 4px solid #ef4444; border-radius: 6px;">
                                <p style="font-size: 12px; font-weight: 700; color: #991b1b; margin-bottom: 4px;">
                                    <i class="bi bi-x-circle-fill"></i> Reason for Rejection:
                                </p>
                                <p style="font-size: 13px; color: #7f1d1d; margin: 0; line-height: 1.5;">
                                    {{ $req->rejection_reason }}
                                </p>
                            </div>
                        @endif

                        {{-- Pending info --}}
                        @if($req->status === 'pending')
                            <div style="margin-top: 10px; padding: 10px 14px; background: #fffbeb; border-left: 4px solid #f59e0b; border-radius: 6px;">
                                <p style="font-size: 12px; color: #92400e; margin: 0;">
                                    <i class="bi bi-clock"></i> Your request is being reviewed by our staff. You'll be notified once it's processed.
                                </p>
                            </div>
                        @endif

                        <div style="margin-top: 6px; font-size: 12px; color: #9ca3af;">
                            Submitted {{ $req->created_at->diffForHumans() }}
                        </div>
                    </div>

                    {{-- Cancel button for pending requests --}}
                    @if($req->status === 'pending')
                        <form action="{{ route('appointment-requests.cancel', $req) }}" method="POST" onsubmit="return confirm('Cancel this request?')">
                            @csrf @method('PATCH')
                            <button type="submit" style="padding: 8px 14px; background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 600; white-space: nowrap;">
                                <i class="bi bi-x"></i> Cancel
                            </button>
                        </form>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Confirmed Appointments Section --}}
    <h2 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 14px; display:flex; align-items:center; gap:8px;">
        <i class="bi bi-calendar-check" style="color:#14b8a6;"></i> Confirmed Appointments
    </h2>
    <div class="appointments-container">
        @if($appointments->isEmpty())
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p style="font-size: 18px; font-weight: 600;">No Appointments</p>
                <p>You don't have any confirmed appointments scheduled.</p>
            </div>
        @else
            <div class="appointments-list">
                @foreach($appointments as $appointment)
                    <div class="appointment-item">
                        <div class="appointment-content">
                            <div class="appointment-header">
                                <span class="appointment-pet">
                                    <i class="bi bi-paw"></i> {{ $appointment->patient->pet_name ?? 'Unknown Pet' }}
                                </span>
                                <span class="appointment-reason">{{ $appointment->service_type ?? 'Checkup' }}</span>
                                @if($appointment->appointment_date->isToday())
                                    <span class="status-badge status-today">
                                        <i class="bi bi-exclamation-circle"></i> Today
                                    </span>
                                @else
                                    <span class="status-badge status-upcoming">
                                        <i class="bi bi-check-circle"></i> Upcoming
                                    </span>
                                @endif
                            </div>
                            <div class="appointment-date">
                                <i class="bi bi-calendar-event"></i>
                                {{ $appointment->appointment_date->format('l, M d, Y') }} at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                            </div>
                        </div>
                        <a href="{{ route('customer.appointments.show', $appointment) }}" class="appointment-link">
                            <i class="bi bi-arrow-right"></i> View Details
                        </a>
                    </div>
                @endforeach
            </div>

            @if($appointments->hasPages())
                <div class="pagination-container">
                    {{ $appointments->links('pagination::simple-tailwind') }}
                </div>
            @endif
        @endif
    </div>
</div>
</body>
</html>
