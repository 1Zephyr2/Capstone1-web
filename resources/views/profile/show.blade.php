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

        .profile-head {
            display: flex;
            gap: 24px;
            margin-bottom: 32px;
            padding-bottom: 32px;
            border-bottom: 1px solid #e2e8f0;
        }

        .profile-picture-wrapper {
            position: relative;
            cursor: pointer;
        }

        .profile-picture-wrapper:hover .profile-picture-overlay {
            opacity: 1;
        }

        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            object-fit: cover;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .profile-picture-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .profile-picture-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .profile-picture-overlay i {
            color: white;
            font-size: 28px;
        }

        .profile-info {
            flex: 1;
        }

        .profile-name {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .profile-role {
            font-size: 14px;
            color: #8b5cf6;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .profile-status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #059669;
            font-weight: 500;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .detail-item {
            flex: 1;
        }

        .detail-label {
            font-size: 12px;
            text-transform: uppercase;
            color: #999;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .detail-value {
            font-size: 15px;
            color: #1f2937;
            font-weight: 500;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
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

            .profile-head {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .detail-grid {
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
                <a href="{{ route('dashboard') }}" class="navbar-item active">
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
        <a href="{{ route('dashboard') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>

        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-person-circle"></i>
                My Profile
            </h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="card">
            <div class="profile-head">
                <div class="profile-picture-wrapper" onclick="document.getElementById('profilePictureModal').style.display='flex'">
                    @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="profile-picture">
                    @else
                        <div class="profile-picture-placeholder">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                    <div class="profile-picture-overlay">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                </div>
                <div class="profile-info">
                    <div class="profile-name">{{ $user->name }}</div>
                    <div class="profile-role">{{ $user->role === 'admin' ? 'Administrator' : 'Veterinary Staff' }}</div>
                    <div class="profile-status">
                        <i class="bi bi-check-circle-fill"></i>
                        Account Active
                    </div>
                </div>
            </div>

            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Email Address</div>
                    <div class="detail-value">{{ $user->email }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Phone Number</div>
                    <div class="detail-value">{{ $user->phone }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Member Since</div>
                    <div class="detail-value">{{ $user->created_at->format('M d, Y') }}</div>
                </div>
            </div>

            <div class="buttons">
                <a href="{{ route('dashboard') }}" class="btn btn-cancel">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>

    <!-- Profile Picture Upload Modal -->
    <div id="profilePictureModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: 16px; padding: 32px; max-width: 500px; width: 90%; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h2 style="margin: 0; font-size: 20px; color: #111827; font-weight: 700;">Update Profile Picture</h2>
                <button onclick="document.getElementById('profilePictureModal').style.display='none'" style="background: none; border: none; font-size: 28px; cursor: pointer; color: #6b7280;">&times;</button>
            </div>

            <form id="profilePictureForm" enctype="multipart/form-data" style="margin: 0;">
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #374151; font-size: 14px;">Choose Image <span style="color: #ef4444;">*</span></label>
                    <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*" style="display: none;">
                    <div onclick="document.getElementById('profilePictureInput').click()" style="border: 2px dashed #d1d5db; border-radius: 10px; padding: 32px; text-align: center; cursor: pointer; transition: all 0.3s; background: #f9fafb;">
                        <i class="bi bi-cloud-arrow-up" style="font-size: 32px; color: #14b8a6; display: block; margin-bottom: 12px;"></i>
                        <p style="margin: 0 0 4px 0; color: #374151; font-weight: 600; font-size: 14px;">Click to upload or drag and drop</p>
                        <p style="margin: 0; color: #6b7280; font-size: 12px;">PNG, JPG, GIF up to 2MB</p>
                    </div>
                    <div id="previewContainer" style="margin-top: 16px; display: none;">
                        <img id="previewImage" style="max-width: 100%; border-radius: 10px; max-height: 300px;">
                        <p id="previewFileName" style="margin-top: 8px; color: #6b7280; font-size: 12px;"></p>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; justify-content: flex-end;">
                    <button type="button" onclick="document.getElementById('profilePictureModal').style.display='none'" style="padding: 11px 22px; border: 1px solid #d1d5db; border-radius: 10px; background: white; color: #374151; cursor: pointer; font-weight: 600; transition: all 0.3s;">Cancel</button>
                    <button type="button" onclick="uploadProfilePicture()" style="padding: 11px 22px; border: none; border-radius: 10px; background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); color: white; cursor: pointer; font-weight: 600; transition: all 0.3s; box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);" id="uploadBtn">Upload</button>
                </div>
            </form>

            @if($user->profile_picture)
            <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #e5e7eb; text-align: center;">
                <form action="{{ route('profile.delete-picture') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 14px; font-weight: 600; text-decoration: underline;">Remove current picture</button>
                </form>
            </div>
            @endif
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('profilePictureInput');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const previewFileName = document.getElementById('previewFileName');
        const uploadBtn = document.getElementById('uploadBtn');

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewFileName.textContent = file.name;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Drag and drop
        const dropZone = document.querySelector('[style*="border: 2px dashed"]');
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#14b8a6';
            dropZone.style.backgroundColor = '#f0fdf4';
        });
        dropZone.addEventListener('dragleave', () => {
            dropZone.style.borderColor = '#d1d5db';
            dropZone.style.backgroundColor = '#f9fafb';
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#d1d5db';
            dropZone.style.backgroundColor = '#f9fafb';
            fileInput.files = e.dataTransfer.files;
            fileInput.dispatchEvent(new Event('change', { bubbles: true }));
        });

        function uploadProfilePicture() {
            const file = fileInput.files[0];
            if (!file) {
                alert('Please select an image file');
                return;
            }

            uploadBtn.disabled = true;
            uploadBtn.textContent = 'Uploading...';

            const formData = new FormData();
            formData.append('profile_picture', file);
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route("profile.update") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || data.message) {
                    // Reload page to show updated picture
                    setTimeout(() => location.reload(), 500);
                } else {
                    alert('Error uploading image');
                    uploadBtn.disabled = false;
                    uploadBtn.textContent = 'Upload';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error uploading image');
                uploadBtn.disabled = false;
                uploadBtn.textContent = 'Upload';
            });
        }

        // Close modal on outside click
        document.getElementById('profilePictureModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    </script>
</body>
</html>
