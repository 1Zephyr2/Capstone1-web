<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - FURCARE Admin</title>
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
            padding: 104px 24px 40px;
        }

        .page-wrap {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        /* Form Container */
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

        .divider {
            border-top: 1px solid #e2e8f0;
            margin: 20px 0;
        }

        .section-title {
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
        }
        
        @media (max-width: 768px) {
            body {
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

    <div class="page-wrap">
    <div class="form-container">
        <div class="form-header">
            <h1>Edit User</h1>
            <p>Update user information and settings</p>
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

            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="section-title">Basic Information</div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            Full Name <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-input" 
                            value="{{ old('name', $user->name) }}" 
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
                            value="{{ old('username', $user->username) }}" 
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
                            value="{{ old('email', $user->email) }}" 
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
                            value="{{ old('phone', $user->phone) }}" 
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
                        <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>
                            Staff Member
                        </option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
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

                <div class="divider"></div>

                <div class="section-title">Change Password (Optional)</div>
                <div class="help-text" style="margin-bottom: 16px;">Leave blank to keep current password</div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            New Password
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-input" 
                            placeholder="Enter new password"
                        >
                        <div class="help-text">Must be at least 8 characters</div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Confirm New Password
                        </label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            class="form-input" 
                            placeholder="Confirm new password"
                        >
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Update User
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

