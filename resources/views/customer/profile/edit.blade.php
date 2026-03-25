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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
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
                    <i class="bi bi-paw"></i>
                    My Pets
                </a>
                <a href="{{ route('customer.appointments.index') }}" class="nav-item">
                    <i class="bi bi-calendar2-check"></i>
                    Appointments
                </a>
            </div>

            <div class="navbar-end">
                <div class="user-avatar">
                    {{ substr(auth()->user()->name, 0, 1) }}
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
