<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - PAWSER</title>
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
            padding: 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            height: 72px;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 0 24px;
            gap: 24px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
            transition: opacity 0.2s;
            flex-shrink: 0;
        }

        .navbar-brand:hover {
            opacity: 0.8;
        }

        .navbar-logo {
            height: 40px;
            width: 40px;
            object-fit: contain;
        }

        .navbar-brand-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .navbar-title {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }

        .navbar-subtitle {
            font-size: 11px;
            opacity: 0.8;
            margin: 0;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 6px;
            flex: 1;
            justify-content: center;
        }

        .navbar-item {
            padding: 8px 14px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .navbar-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .navbar-item.active {
            background: rgba(20, 184, 166, 0.15);
            color: #14b8a6;
        }

        .navbar-end {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            overflow: hidden;
        }

        .navbar-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .navbar-user-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .navbar-user-name {
            font-size: 13px;
            font-weight: 600;
            color: white;
        }

        .navbar-user-role {
            font-size: 11px;
            opacity: 0.7;
        }

        .navbar-profile-btn {
            padding: 6px 12px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .navbar-profile-btn:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .navbar-logout-btn {
            padding: 6px 12px;
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .navbar-logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
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
            color: #14b8a6;
            text-decoration: none;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #0d9488;
            border-color: #14b8a6;
            background: #f0fdf4;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        /* Card */
        .card {
            background: white;
            border-radius: 14px;
            padding: 32px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-weight: 600;
            color: #1f2937;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .required {
            color: #dc2626;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        select,
        textarea {
            padding: 12px 14px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s;
            background-color: white;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="tel"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin: 24px 0 16px 0;
            padding-bottom: 12px;
            border-bottom: 2px solid #e5e7eb;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .alert-error i {
            color: #dc2626;
        }

        .error-list {
            list-style: none;
            padding: 0;
        }

        .error-list li {
            padding: 4px 0;
        }

        .buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        button,
        .btn {
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

        .btn-cancel {
            background: #e5e7eb;
            color: #6b7280;
            border: 1px solid #d1d5db;
        }

        .btn-cancel:hover {
            background: #d1d5db;
            color: #4b5563;
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

        .helper-text {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 4px;
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

            .buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('dashboard') }}" class="navbar-brand">
                <img src="{{ asset('newlogo.png') }}" alt="PAWser" class="navbar-logo">
                <div class="navbar-brand-text">
                    <div class="navbar-title">PAWser</div>
                    <div class="navbar-subtitle">Staff Dashboard</div>
                </div>
            </a>

            <div class="navbar-menu">
                <a href="{{ route('dashboard') }}" class="navbar-item">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
                <a href="{{ route('pets.index') }}" class="navbar-item">
                    <i class="bi bi-heart-fill"></i>
                    Pets
                </a>
                <a href="{{ route('appointments.index') }}" class="navbar-item">
                    <i class="bi bi-calendar-check"></i>
                    Appointments
                </a>
                <a href="{{ route('visits.today') }}" class="navbar-item">
                    <i class="bi bi-clock-history"></i>
                    Visits
                </a>
                @if(Auth::user()->hasStaffAccess())
                <a href="{{ route('analytics.index') }}" class="navbar-item">
                    <i class="bi bi-graph-up-arrow"></i>
                    Insights
                </a>
                <a href="{{ route('automation.support') }}" class="navbar-item">
                    <i class="bi bi-cpu"></i>
                    Actions
                </a>
                @endif
            </div>

            <div class="navbar-end">
                <div class="navbar-user">
                    @if(Auth::user()->profile_picture)
                        <div class="navbar-avatar">
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}">
                        </div>
                    @else
                        <div class="navbar-avatar">
                            <i class="bi bi-person-fill" style="font-size: 18px;"></i>
                        </div>
                    @endif
                    <div class="navbar-user-text">
                        <div class="navbar-user-name">{{ Auth::user()->name }}</div>
                        <div class="navbar-user-role">{{ Auth::user()->role_name ?? (Auth::user()->role === 'admin' ? 'Administrator' : 'Veterinary Staff') }}</div>
                    </div>
                </div>
                <a href="{{ route('profile.show') }}" class="navbar-profile-btn" title="My Profile">
                    <i class="bi bi-person-circle"></i>
                </a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="navbar-logout-btn" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <a href="{{ route('profile.show') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to Profile
        </a>

        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-pencil-square"></i>
                Edit Profile
            </h1>
        </div>

        <div class="card">
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

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Personal Information Section -->
                <div class="section-title">Personal Information</div>

                <div class="form-group">
                    <label>
                        <span><i class="bi bi-person-fill" style="color: #14b8a6;"></i></span>
                        Full Name <span class="required">*</span>
                    </label>
                    <input type="text" name="name" required value="{{ old('name', $user->name) }}" placeholder="Enter your full name">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>
                            <span><i class="bi bi-envelope-fill" style="color: #14b8a6;"></i></span>
                            Email Address <span class="required">*</span>
                        </label>
                        <input type="email" name="email" required value="{{ old('email', $user->email) }}" placeholder="you@example.com">
                    </div>

                    <div class="form-group">
                        <label>
                            <span><i class="bi bi-telephone-fill" style="color: #14b8a6;"></i></span>
                            Phone Number <span class="required">*</span>
                        </label>
                        <input type="tel" name="phone" required value="{{ old('phone', $user->phone) }}" placeholder="11-digit number" maxlength="11">
                        <p class="helper-text">Format: 09123456789</p>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="section-title">Change Password (Optional)</div>

                <div class="form-group">
                    <label>
                        <span><i class="bi bi-lock-fill" style="color: #14b8a6;"></i></span>
                        Current Password
                    </label>
                    <input type="password" name="current_password" placeholder="Enter your current password">
                    <p class="helper-text">Required only if you want to change your password</p>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>
                            <span><i class="bi bi-key-fill" style="color: #14b8a6;"></i></span>
                            New Password
                        </label>
                        <input type="password" name="new_password" placeholder="Enter new password (min. 8 characters)">
                    </div>

                    <div class="form-group">
                        <label>
                            <span><i class="bi bi-key-fill" style="color: #14b8a6;"></i></span>
                            Confirm New Password
                        </label>
                        <input type="password" name="new_password_confirmation" placeholder="Confirm new password">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="buttons">
                    <a href="{{ route('profile.show') }}" class="btn btn-cancel">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
