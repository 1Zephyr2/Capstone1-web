<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - VetCare Admin</title>
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
            min-height: 100vh;
            justify-content: center;
            align-items: flex-start;
            padding: 32px;
        }

        /* Form Container */
        .form-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            width: 100%;
            max-width: 800px;
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
            color: white;
            padding: 20px 24px;
            text-align: center;
        }

        .form-header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-header p {
            opacity: 0.9;
            font-size: 13px;
        }

        .form-body {
            padding: 24px;
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
            font-weight: 500;
            color: #1e293b;
            font-size: 13px;
        }

        .form-label .required {
            color: #dc2626;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #1e40af;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            cursor: pointer;
        }

        .form-select:focus {
            outline: none;
            border-color: #1e40af;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn {
            flex: 1;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: #1e40af;
            color: white;
        }

        .btn-primary:hover {
            background: #1e3a8a;
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #64748b;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .alert.error {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        .help-text {
            font-size: 11px;
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
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1><i class="bi bi-pencil-square"></i> Edit User</h1>
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
                            type="text" 
                            name="phone" 
                            class="form-input" 
                            value="{{ old('phone', $user->phone) }}" 
                            placeholder="Enter phone number"
                        >
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
        </div>
    </div>
</body>
</html>
