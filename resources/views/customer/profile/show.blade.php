<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - PAWSER</title>
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

        /* Main Content */
        .main-content {
            flex: 1;
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
            padding: 40px 24px;
        }

        .page-header {
            margin-bottom: 32px;
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
            margin-bottom: 16px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #14b8a6;
            border-color: #14b8a6;
            background: #f0fdfa;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        /* Profile Card */
        .profile-card {
            background: white;
            border-radius: 14px;
            padding: 32px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
        }

        .profile-header {
            display: flex;
            align-items: flex-start;
            gap: 24px;
            margin-bottom: 32px;
            padding-bottom: 32px;
            border-bottom: 1px solid #e2e8f0;
        }

        .profile-picture-wrapper {
            position: relative;
            flex-shrink: 0;
        }

        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            background: linear-gradient(135deg, #14b8a6, #0d9488);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: 600;
            overflow: hidden;
            border: 2px solid #e2e8f0;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-picture-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
            border-radius: 12px;
        }

        .profile-picture-wrapper:hover .profile-picture-overlay {
            opacity: 1;
        }

        .profile-picture-overlay i {
            color: white;
            font-size: 32px;
        }

        .profile-info h2 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .profile-info p {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .profile-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .detail-item {
            padding: 20px;
            background: #f9fafb;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .detail-label {
            font-size: 12px;
            text-transform: uppercase;
            color: #9ca3af;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 16px;
            color: #0f172a;
            font-weight: 600;
            word-break: break-all;
        }

        .buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        a.btn,
        button.btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(20, 184, 166, 0.4);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #6b7280;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .alert-success i {
            color: #16a34a;
            margin-top: 2px;
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

            .profile-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
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

        .profile-header {
            animation: fadeInUp 0.6s ease-out;
        }

        .card {
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        /* Button hover effects */
        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .btn:active {
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('customer.dashboard') }}" class="navbar-brand">
                <img src="{{ asset('newlogo.png') }}" alt="PAWSER" class="navbar-logo">
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
        <a href="{{ route('customer.dashboard') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>

        <div class="page-header">
            <h1 class="page-title">
                My Profile
            </h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="profile-card">
            <!-- Profile Header with Picture -->
            <div class="profile-header">
                <div class="profile-picture-wrapper">
                    <div class="profile-picture">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
                        @else
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        @endif
                    </div>
                </div>
                <div class="profile-info">
                    <h2>{{ $user->name }}</h2>
                    <p><strong>{{ ucfirst($user->role) }}</strong></p>
                    <p style="color: #14b8a6; margin-top: 8px;">✓ Account Active</p>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="profile-details">
                <div class="detail-item">
                    <div class="detail-label">Email Address</div>
                    <div class="detail-value">{{ $user->email }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Phone Number</div>
                    <div class="detail-value">{{ $user->phone ?? 'Not provided' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Member Since</div>
                    <div class="detail-value">{{ $user->created_at->format('M d, Y') }}</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="buttons">
                <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>
</body>
</html>
