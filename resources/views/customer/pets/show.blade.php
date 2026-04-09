<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pet->pet_name ?? 'Pet Details' }} - FURCARE</title>
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

        .pet-header {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            border-radius: 12px;
            padding: 24px;
            color: white;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            justify-content: space-between;
        }

        .pet-header-info {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1;
        }

        .pet-icon-large {
            font-size: 60px;
            min-width: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pet-photo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.3);
            flex-shrink: 0;
        }

        .pet-header-content h1 {
            font-size: 32px;
            margin: 0 0 8px 0;
        }

        .pet-header-content p {
            margin: 0;
            opacity: 0.9;
        }

        .pet-header-actions {
            display: flex;
            gap: 8px;
        }

        .btn-edit-pet {
            padding: 10px 16px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-edit-pet:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
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

        .card-content {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
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

        /* Sections */
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

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .section-toggle-btn {
            border: 1px solid #d1d5db;
            background: #f9fafb;
            color: #374151;
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .section-toggle-btn:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }

        .records-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .record-item {
            padding: 12px;
            background: #f9fafb;
            border-left: 4px solid #14b8a6;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .record-item.visit-clickable {
            cursor: pointer;
        }

        .record-item.visit-clickable:hover {
            background: #f0fdfa;
            border-left-color: #0d9488;
        }

        .record-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .record-info {
            font-size: 13px;
            color: #9ca3af;
        }

        .visit-row-meta {
            margin-top: 8px;
            font-size: 12px;
            color: #0f766e;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .record-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .visit-record-item {
            overflow: hidden;
            max-height: 220px;
            opacity: 1;
            transform: translateY(0);
            transition: max-height 0.35s ease, opacity 0.25s ease, transform 0.25s ease, margin 0.25s ease;
        }

        .visit-record-item.visit-hidden {
            max-height: 0;
            opacity: 0;
            transform: translateY(-6px);
            margin: 0;
            pointer-events: none;
        }

        .visit-detail-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.62);
            z-index: 10000;
            align-items: center;
            justify-content: center;
            padding: 16px;
            backdrop-filter: blur(6px);
        }

        .visit-detail-modal.active {
            display: flex;
        }

        .visit-detail-content {
            width: min(92vw, 760px);
            max-height: 88vh;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
        }

        .visit-detail-header {
            padding: 16px 18px;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .visit-detail-title {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
        }

        .visit-detail-subtitle {
            margin: 4px 0 0;
            font-size: 13px;
            opacity: 0.95;
        }

        .visit-detail-close {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.24);
            color: white;
            font-size: 20px;
            cursor: pointer;
            line-height: 1;
        }

        .visit-detail-body {
            padding: 16px 18px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .visit-detail-block {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #f8fafc;
            padding: 12px;
        }

        .visit-detail-block h4 {
            margin: 0 0 8px;
            font-size: 14px;
            color: #0f172a;
            font-weight: 700;
        }

        .visit-detail-text {
            font-size: 13px;
            color: #475569;
            line-height: 1.45;
        }

        .visit-photos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 10px;
        }

        .visit-photo-thumb {
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            background: #f8fafc;
            aspect-ratio: 1;
        }

        .visit-photo-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #9ca3af;
        }

        .empty-state i {
            font-size: 40px;
            color: #d1d5db;
            margin-bottom: 12px;
        }

        /* Photo Gallery */
        .photo-gallery-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
        }

        .gallery-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 12px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            aspect-ratio: 1;
            cursor: pointer;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
            border-color: #14b8a6;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 32px;
            color: #d1d5db;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-item-icon {
            opacity: 1;
        }

        /* Photo Modal */
        .photo-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .photo-modal.active {
            display: flex;
        }

        .photo-modal-content {
            position: relative;
            max-width: 90%;
            max-height: 90vh;
            border-radius: 12px;
            overflow: hidden;
        }

        .photo-modal-image {
            max-width: 100%;
            max-height: 90vh;
            width: auto;
            height: auto;
            display: block;
        }

        .photo-modal-close {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .photo-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .navbar-center {
                display: none;
            }

            .main-content {
                padding: 20px 16px;
            }

            .pet-header {
                flex-direction: column;
                text-align: center;
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

        .pet-header {
            animation: fadeInUp 0.6s ease-out;
        }

        .card {
            animation: fadeInUp 0.5s ease-out;
        }

        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }

        /* Button hover effects */
        .btn, .login-btn {
            transition: all 0.3s ease;
        }

        .btn:hover, .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .btn:active, .login-btn:active {
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
        <a href="{{ route('customer.pets.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i>
            Back to Pets
        </a>

        <!-- Pet Header -->
        <div class="pet-header">
            <div class="pet-header-info">
                @if($pet->pet_photo_path)
                    <img src="{{ asset('storage/' . $pet->pet_photo_path) }}" alt="{{ $pet->pet_name }}" class="pet-photo">
                @else
                    <div class="pet-icon-large">
                        <i class="bi bi-paw"></i>
                    </div>
                @endif
                <div class="pet-header-content">
                    <h1>{{ $pet->pet_name }}</h1>
                    <p>{{ $pet->species ?? 'Unknown Species' }} • {{ $pet->breed ?? 'Unknown Breed' }}</p>
                </div>
            </div>
            <div class="pet-header-actions">
                <a href="{{ route('customer.pets.edit', $pet) }}" class="btn-edit-pet">
                    <i class="bi bi-pencil-square"></i>
                    Edit Pet
                </a>
            </div>
        </div>

        <!-- Photo Gallery -->
        @php
            $petPhotos = [];
            if ($pet->pet_photo_path) {
                $petPhotos[] = [
                    'path' => $pet->pet_photo_path,
                    'alt' => $pet->pet_name . ' - Main Photo'
                ];
            }
        @endphp

        @if(!empty($petPhotos))
        <div class="photo-gallery-section">
            <div class="gallery-title">
                <i class="bi bi-images"></i>
                Pet Photos
            </div>
            <div class="gallery-grid">
                @foreach($petPhotos as $photo)
                <div class="gallery-item" onclick="openPhotoModal('{{ asset('storage/' . $photo['path']) }}')">
                    <img src="{{ asset('storage/' . $photo['path']) }}" alt="{{ $photo['alt'] }}">
                    <div class="gallery-item-icon">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Photo Modal -->
        <div class="photo-modal" id="photoModal" onclick="if(event.target.id === 'photoModal') closePhotoModal()">
            <div class="photo-modal-content">
                <button class="photo-modal-close" onclick="closePhotoModal()">&times;</button>
                <img id="modalPhotoImage" class="photo-modal-image" src="" alt="Pet Photo">
            </div>
        </div>
        <div class="cards-grid">
            <div class="card">
                <div class="card-title">
                    <i class="bi bi-calendar3"></i>
                    Birth & Sex
                </div>
                <div class="info-item">
                    <span class="info-label">Date of Birth</span>
                    <span class="info-value">{{ $pet->birthdate ? $pet->birthdate->format('M d, Y') : 'Unknown' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Sex</span>
                    <span class="info-value">{{ ucfirst($pet->sex ?? 'Unknown') }}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <i class="bi bi-palette"></i>
                    Appearance
                </div>
                <div class="info-item">
                    <span class="info-label">Color</span>
                    <span class="info-value">{{ $pet->color ?? 'Unknown' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Breed</span>
                    <span class="info-value">{{ $pet->breed ?? 'Unknown' }}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <i class="bi bi-info-circle"></i>
                    Owner Info
                </div>
                <div class="info-item">
                    <span class="info-label">Owner</span>
                    <span class="info-value">{{ $pet->owner_name ?? 'Unknown' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Contact</span>
                    <span class="info-value">{{ $pet->owner_contact ?? 'Unknown' }}</span>
                </div>
            </div>
        </div>

        <!-- Visits -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="bi bi-clipboard-check"></i>
                    Visits
                </div>
                <button type="button" id="visitsToggleBtn" class="section-toggle-btn" onclick="toggleVisitsSection()" aria-expanded="true" aria-controls="visitsSectionBody">
                    <i id="visitsToggleIcon" class="bi bi-chevron-up"></i>
                    <span id="visitsToggleLabel">Collapse</span>
                </button>
            </div>

            <div id="visitsSectionBody">
                @if($pet->visits->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>No visits recorded yet.</p>
                    </div>
                @else
                    <div class="records-list">
                        @foreach($pet->visits as $visit)
                            <a href="{{ route('visits.show', $visit) }}" class="record-link visit-record-item">
                                <div class="record-item visit-clickable">
                                    <div class="record-title">{{ $visit->service_type ?? 'Visit' }}</div>
                                    <div class="record-info">
                                        <i class="bi bi-calendar-event"></i>
                                        {{ $visit->visit_date->format('M d, Y') }}
                                        @if($visit->notes)
                                            • {{ substr($visit->notes, 0, 50) }}{{ strlen($visit->notes) > 50 ? '...' : '' }}
                                        @endif
                                    </div>
                                    <div class="visit-row-meta"><i class="bi bi-eye"></i> View full visit details</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Appointments -->
        <div class="section">
            <div class="section-title">
                <i class="bi bi-calendar-check"></i>
                Upcoming Appointments
            </div>

            @if($pet->appointments->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>No upcoming appointments.</p>
                </div>
            @else
                <div class="records-list">
                    @foreach($pet->appointments as $appointment)
                        <div class="record-item">
                            <div class="record-title">{{ $appointment->service_type ?? 'Appointment' }}</div>
                            <div class="record-info">
                                <i class="bi bi-calendar-event"></i>
                                {{ $appointment->appointment_date->format('M d, Y \a\t g:i A') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    <script>
        function openPhotoModal(imagePath) {
            const modal = document.getElementById('photoModal');
            const image = document.getElementById('modalPhotoImage');
            image.src = imagePath;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePhotoModal() {
            const modal = document.getElementById('photoModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function toggleVisitsSection() {
            const visitsBody = document.getElementById('visitsSectionBody');
            const toggleBtn = document.getElementById('visitsToggleBtn');
            const toggleIcon = document.getElementById('visitsToggleIcon');
            const toggleLabel = document.getElementById('visitsToggleLabel');
            const visitItems = visitsBody ? visitsBody.querySelectorAll('.visit-record-item') : [];

            if (!visitsBody || !toggleBtn || !toggleIcon || !toggleLabel) {
                return;
            }

            const isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';

            if (isExpanded) {
                visitItems.forEach((item, index) => {
                    if (index >= 2) {
                        item.classList.add('visit-hidden');
                    }
                });
                toggleBtn.setAttribute('aria-expanded', 'false');
                toggleIcon.className = 'bi bi-chevron-down';
                toggleLabel.textContent = 'Expand';
            } else {
                visitItems.forEach((item) => {
                    item.classList.remove('visit-hidden');
                });
                toggleBtn.setAttribute('aria-expanded', 'true');
                toggleIcon.className = 'bi bi-chevron-up';
                toggleLabel.textContent = 'Collapse';
            }
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closePhotoModal();
            }
        });
    </script>
</body>
</html>
