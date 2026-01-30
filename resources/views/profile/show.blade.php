<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - VaxLog</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 24px 32px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 28px;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .back-btn {
            padding: 10px 20px;
            background: #6b7280;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
        }

        .back-btn:hover {
            background: #4b5563;
        }

        .profile-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .profile-header {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            padding: 48px 32px;
            text-align: center;
            position: relative;
        }

        .profile-picture-wrapper {
            display: inline-block;
            position: relative;
            margin-bottom: 16px;
        }

        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            object-fit: cover;
            background: white;
        }

        .profile-picture-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: 600;
            color: white;
        }

        .profile-name {
            color: white;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .profile-role {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
        }

        .profile-body {
            padding: 32px;
        }

        .info-section {
            margin-bottom: 32px;
        }

        .info-section:last-child {
            margin-bottom: 0;
        }

        .info-section h2 {
            font-size: 18px;
            color: #1f2937;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .info-label {
            font-size: 13px;
            color: #6b7280;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 16px;
            color: #1f2937;
            font-weight: 500;
        }

        .actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #059669;
            color: white;
        }

        .btn-primary:hover {
            background: #047857;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👤 My Profile</h1>
            <a href="{{ route('dashboard') }}" class="back-btn">← Back to Dashboard</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-picture-wrapper">
                    @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="profile-picture">
                    @else
                        <div class="profile-picture-placeholder">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="profile-name">{{ $user->name }}</div>
                <div class="profile-role">Health Center Staff</div>
            </div>

            <div class="profile-body">
                <div class="info-section">
                    <h2>📧 Account Information</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Full Name</div>
                            <div class="info-value">{{ $user->name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email Address</div>
                            <div class="info-value">{{ $user->email }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Phone Number</div>
                            <div class="info-value">{{ $user->phone }}</div>
                        </div>
                    </div>
                </div>

                <div class="info-section">
                    <h2>🔐 Security</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Password</div>
                            <div class="info-value">••••••••</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Member Since</div>
                            <div class="info-value">{{ $user->created_at->format('F j, Y') }}</div>
                        </div>
                    </div>
                </div>

                <div class="actions">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">✏️ Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
