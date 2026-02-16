<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - VetCare</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
            padding: 40px;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 28px 36px;
            border-radius: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 36px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .header:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .header h1 {
            font-size: 32px;
            font-weight: 800;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.02em;
        }

        .back-btn {
            padding: 12px 24px;
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
        }

        .back-btn:hover {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(107, 114, 128, 0.4);
        }

        .profile-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            border-radius: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .profile-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .profile-header {
            background: linear-gradient(135deg, 
                {{ Auth::user()->role === 'admin' ? '#1e40af 0%, #1e3a8a' : '#059669 0%, #047857' }} 100%);
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
            background: {{ Auth::user()->role === 'admin' ? '#1e40af' : '#059669' }};
            color: white;
        }

        .btn-primary:hover {
            background: {{ Auth::user()->role === 'admin' ? '#1e3a8a' : '#047857' }};
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
            <h1><i class="bi bi-person-circle"></i> My Profile</h1>
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
                            <i class="bi bi-person-fill" style="font-size: 48px;"></i>
                        </div>
                    @endif
                </div>
                <div class="profile-name">{{ $user->name }}</div>
                <div class="profile-role">Veterinary Staff</div>
            </div>

            <div class="profile-body">
                <div class="info-section">
                    <h2><i class="bi bi-envelope"></i> Account Information</h2>
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
                    <h2><i class="bi bi-lock"></i> Security</h2>
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
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary"><i class="bi bi-pencil"></i> Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
