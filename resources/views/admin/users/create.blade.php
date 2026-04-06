<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create User - PAWSER Admin</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --app-font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body,
        input,
        select,
        textarea,
        button,
        table,
        th,
        td,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        label,
        small,
        strong,
        em,
        li,
        span,
        div {
            font-family: var(--app-font-family) !important;
        }

        body {
            font-family: var(--app-font-family);
            background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #1e40af 0%, #1e3a8a 100%);
            color: white;
            padding: 24px 0 0 0;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 8px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 0;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            transition: opacity 0.2s;
        }
        
        .logo-container:hover {
            opacity: 0.8;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.3);
        }

        .logo-text {
            font-size: 22px;
            font-weight: 600;
        }

        .sidebar-subtitle {
            font-size: 12px;
            opacity: 0.9;
            padding-left: 0;
            text-align: left;
            margin-top: 8px;
        }

        .sidebar-menu {
            margin-top: 12px;
        }

        .menu-section {
            margin-bottom: 16px;
        }

        .menu-label {
            padding: 0 24px;
            font-size: 11px;
            text-transform: uppercase;
            opacity: 0.7;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .menu-item {
            margin: 0 16px 6px 16px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .menu-text {
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        /* User Section */
        .user-section {
            padding: 14px 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: auto;
        }

        .user-info-sidebar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .user-avatar-sidebar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            overflow: hidden;
        }

        .user-avatar-sidebar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-details-sidebar {
            flex: 1;
        }

        .user-name-sidebar {
            font-weight: 500;
            font-size: 14px;
        }

        .user-role-sidebar {
            font-size: 12px;
            opacity: 0.8;
        }

        .logout-btn-sidebar {
            width: 100%;
            padding: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logout-btn-sidebar:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 0;
            padding: 104px 24px 40px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .form-container {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            border-radius: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 920px;
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            color: #111827;
            padding: 24px 28px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .form-header h1 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }

        .form-header p {
            color: #64748b;
            opacity: 1;
            font-size: 14px;
        }

        .form-body {
            padding: 28px;
        }

        .form-group {
            margin-bottom: 16px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .form-label .required {
            color: #dc2626;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.2s;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.15);
        }

        .form-select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            background: white;
            cursor: pointer;
        }

        .form-select:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.15);
        }

        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            justify-content: flex-end;
        }

        .btn {
            padding: 12px 22px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: #14b8a6;
            color: white;
        }

        .btn-primary:hover {
            background: #0d9488;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
        }

        .btn-secondary:hover {
            background: #d1d5db;
            transform: translateY(-2px);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .alert.error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .help-text {
            font-size: 12px;
            color: #64748b;
            margin-top: 4px;
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 96px 16px 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-header,
            .form-body {
                padding: 20px;
            }

            .form-header h1 {
                font-size: 24px;
            }

            .form-actions {
                justify-content: stretch;
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <x-admin-navbar />

    <!-- Main Content -->
    <div class="main-content">
    <div class="form-container">
        <div class="form-header">
            <h1><i class="bi bi-person-plus"></i> Create New User</h1>
            <p>Add a new administrator or veterinary provider</p>
        </div>

        <div class="form-body">
            @if ($errors->any())
                <div class="alert error">
                    <strong>Please fix the following errors:</strong>
                    <ul style="margin-top: 8px; margin-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            Full Name <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-input" 
                            value="{{ old('name') }}" 
                            required
                            placeholder="Enter full name"
                        >
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Username <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="username" 
                            class="form-input" 
                            value="{{ old('username') }}" 
                            required
                            placeholder="Enter username"
                        >
                        <div class="help-text">Used for logging in to the system</div>
                        @error('username')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            Email <span class="required">*</span>
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-input" 
                            value="{{ old('email') }}" 
                            required
                            placeholder="Enter email address"
                        >
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Phone Number
                        </label>
                        <input 
                            type="tel" 
                            name="phone" 
                            id="phone"
                            class="form-input" 
                            value="{{ old('phone') }}" 
                            placeholder="09XX-XXX-XXXX"
                            pattern="(09\d{9}|09\d{2}-\d{3}-\d{4})"
                            maxlength="13"
                            inputmode="numeric"
                        >
                        <div class="help-text">Format: 09XX-XXX-XXXX (11 digits)</div>
                        @error('phone')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Role <span class="required">*</span>
                    </label>
                    <select name="role" class="form-select" required>
                        <option value="">Select role</option>
                        <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>
                            Staff Member
                        </option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                            Administrator
                        </option>
                    </select>
                    <div class="help-text">
                        <strong>Staff Member:</strong> Can manage pets and veterinary records<br>
                        <strong>Administrator:</strong> Can manage users and system settings
                    </div>
                    @error('role')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            Password <span class="required">*</span>
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-input" 
                            required
                            placeholder="Enter password"
                        >
                        <div class="help-text">Must be at least 8 characters</div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Confirm Password <span class="required">*</span>
                        </label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            class="form-input" 
                            required
                            placeholder="Confirm password"
                        >
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Create User
                    </button>
                </div>
            </form>

            <script>
                // Phone number formatting
                const phoneInput = document.getElementById('phone');
                if (phoneInput) {
                    phoneInput.addEventListener('input', function(e) {
                        let digits = this.value.replace(/\D/g, '');
                        if (digits.length > 11) digits = digits.slice(0, 11);
                        
                        let formatted = '';
                        if (digits.length > 0) {
                            if (digits.length <= 2) formatted = digits;
                            else if (digits.length <= 4) formatted = digits.slice(0, 2) + digits.slice(2);
                            else if (digits.length <= 7) formatted = digits.slice(0, 2) + digits.slice(2, 4) + '-' + digits.slice(4);
                            else formatted = digits.slice(0, 2) + digits.slice(2, 4) + '-' + digits.slice(4, 7) + '-' + digits.slice(7, 11);
                        }
                        this.value = formatted;
                        this.style.borderColor = (digits.length === 11 && digits.startsWith('09')) ? '#10b981' : '#ef4444';
                    });
                }
            </script>
        </div>
    </div>
    </div>
</body>
</html>

