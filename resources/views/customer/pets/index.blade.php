<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pets - PAWSER</title>
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

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #111827;
            border: 1px solid #111827;
            background: white;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            margin-bottom: 24px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #14b8a6;
            border-color: #14b8a6;
            background: #f0fdfa;
        }

        /* Cards Grid */
        .pets-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .pet-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .pet-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .pet-card-header {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            padding: 20px;
            color: white;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .pet-icon {
            font-size: 40px;
        }

        .pet-card-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .pet-card-body {
            padding: 20px;
        }

        .pet-info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }

        .pet-info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #9ca3af;
            font-weight: 500;
        }

        .info-value {
            color: #1f2937;
            font-weight: 600;
        }

        .pet-card-footer {
            padding: 16px 20px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 8px;
        }

        .btn {
            flex: 1;
            padding: 8px 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .btn-primary {
            background: #14b8a6;
            color: white;
        }

        .btn-primary:hover {
            background: #0d9488;
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
            grid-column: 1 / -1;
        }

        .empty-state i {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 16px;
        }

        .empty-state p {
            font-size: 16px;
            margin: 8px 0;
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

        @media (max-width: 768px) {
            .navbar-center {
                display: none;
            }

            .main-content {
                padding: 20px 16px;
            }

            .pets-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 24px;
            }
        }

        .pets-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 24px;
        }

        .pet-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .pet-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .pet-card-header {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            padding: 20px;
            color: white;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .pet-icon {
            font-size: 36px;
        }

        .pet-card-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .pet-card-body {
            padding: 20px;
        }

        .pet-info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }

        .pet-info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #9ca3af;
            font-weight: 500;
        }

        .info-value {
            color: #1f2937;
            font-weight: 600;
        }

        .pet-card-footer {
            padding: 16px 20px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 8px;
        }

        .btn {
            flex: 1;
            padding: 8px 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .btn-primary {
            background: #14b8a6;
            color: white;
        }

        .btn-primary:hover {
            background: #0d9488;
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
            grid-column: 1 / -1;
        }

        .empty-state i {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 16px;
        }

        .empty-state p {
            font-size: 16px;
            margin: 8px 0;
        }

        .add-pet-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 2px dashed #14b8a6;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            text-decoration: none;
            cursor: pointer;
            min-height: 280px;
        }

        .add-pet-card:hover {
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
            transform: translateY(-2px);
            border-color: #0d9488;
            background: rgba(20, 184, 166, 0.02);
        }

        .add-pet-content {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .add-pet-icon {
            font-size: 48px;
            color: #14b8a6;
            transition: all 0.3s ease;
        }

        .add-pet-card:hover .add-pet-icon {
            color: #0d9488;
            transform: scale(1.1);
        }

        .add-pet-text {
            font-size: 16px;
            font-weight: 600;
            color: #14b8a6;
        }

        .add-pet-card:hover .add-pet-text {
            color: #0d9488;
        }

        .add-pet-subtext {
            font-size: 13px;
            color: #9ca3af;
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

        .pets-grid {
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        .add-pet-card {
            animation: fadeInUp 0.5s ease-out;
        }

        .add-pet-card:nth-child(1) { animation-delay: 0.1s; }
        .add-pet-card:nth-child(2) { animation-delay: 0.2s; }
        .add-pet-card:nth-child(3) { animation-delay: 0.3s; }

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
                <img src="{{ asset('newlogo.png') }}" alt="PAWSER" class="navbar-logo" onerror="this.style.display='none'">
                <span class="navbar-title">PAWSER</span>
            </a>
            <div class="navbar-center">
                <a href="{{ route('customer.dashboard') }}" class="nav-item">
                    <i class="bi bi-speedometer2"></i>
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
            <h1 class="page-title">
                <i class="bi bi-paw"></i>
                My Pets
            </h1>
        </div>

        @if($pets->isEmpty())
            <div class="pets-grid">
                <a href="{{ route('customer.pets.create') }}" class="add-pet-card">
                    <div class="add-pet-content">
                        <div class="add-pet-icon">
                            <i class="bi bi-plus-circle"></i>
                        </div>
                        <div class="add-pet-text">Add Your First Pet</div>
                        <div class="add-pet-subtext">Click to create a new pet profile</div>
                    </div>
                </a>
                <div class="empty-state" style="grid-column: 1 / -1; padding-top: 20px; padding-bottom: 20px;">
                    <p style="font-size: 14px;">You can also contact your veterinary clinic to have your pet information added to the system.</p>
                </div>
            </div>
        @else
            <div class="pets-grid">
                <a href="{{ route('customer.pets.create') }}" class="add-pet-card">
                    <div class="add-pet-content">
                        <div class="add-pet-icon">
                            <i class="bi bi-plus-circle"></i>
                        </div>
                        <div class="add-pet-text">Add New Pet</div>
                        <div class="add-pet-subtext">Add another pet to your profile</div>
                    </div>
                </a>
                @foreach($pets as $pet)
                    <div class="pet-card">
                        <div class="pet-card-header">
                            <div class="pet-icon">
                                <i class="bi bi-paw"></i>
                            </div>
                            <h2 class="pet-card-title">{{ $pet->pet_name }}</h2>
                        </div>
                        <div class="pet-card-body">
                            <div class="pet-info-row">
                                <span class="info-label">Species</span>
                                <span class="info-value">{{ $pet->species ?? 'Unknown' }}</span>
                            </div>
                            <div class="pet-info-row">
                                <span class="info-label">Breed</span>
                                <span class="info-value">{{ $pet->breed ?? 'Unknown' }}</span>
                            </div>
                            <div class="pet-info-row">
                                <span class="info-label">Color</span>
                                <span class="info-value">{{ $pet->color ?? 'Unknown' }}</span>
                            </div>
                            <div class="pet-info-row">
                                <span class="info-label">Sex</span>
                                <span class="info-value">{{ $pet->sex ?? 'Unknown' }}</span>
                            </div>
                            <div class="pet-info-row">
                                <span class="info-label">Date of Birth</span>
                                <span class="info-value">{{ $pet->birthdate ? $pet->birthdate->format('M d, Y') : 'Unknown' }}</span>
                            </div>
                        </div>
                        <div class="pet-card-footer">
                            <a href="{{ route('customer.pets.show', $pet) }}" class="btn btn-primary">
                                <i class="bi bi-arrow-right"></i>
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
