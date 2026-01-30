<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - VaxLog</title>
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
            padding: 32px;
        }

        .section {
            margin-bottom: 32px;
            padding-bottom: 32px;
            border-bottom: 2px solid #e5e7eb;
        }

        .section:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .section h2 {
            font-size: 18px;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .profile-picture-section {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .profile-picture-preview {
            position: relative;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e5e7eb;
        }

        .profile-picture-placeholder {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #059669 0%, #f59e0b 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: 600;
            color: white;
            border: 3px solid #e5e7eb;
        }

        .profile-picture-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #059669;
        }

        .form-group .help-text {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
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

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 13px;
        }

        .actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 32px;
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

        .error-message {
            color: #dc2626;
            font-size: 13px;
            margin-top: 4px;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .file-input-label {
            padding: 8px 16px;
            background: #059669;
            color: white;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-block;
        }

        .file-input-label:hover {
            background: #047857;
        }

        .file-name {
            font-size: 13px;
            color: #6b7280;
            margin-top: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✏️ Edit Profile</h1>
            <a href="{{ route('profile.show') }}" class="back-btn">← Back to Profile</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="profile-card">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Profile Picture Section -->
                <div class="section">
                    <h2>📷 Profile Picture</h2>
                    <div class="profile-picture-section">
                        <div class="profile-picture-preview">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="profile-picture" id="profilePreview">
                            @else
                                <div class="profile-picture-placeholder" id="profilePreview">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="profile-picture-actions">
                            <div class="file-input-wrapper">
                                <input type="file" name="profile_picture" id="profilePicture" accept="image/*" onchange="previewImage(event)">
                                <label for="profilePicture" class="file-input-label">📁 Choose Picture</label>
                            </div>
                            <div class="file-name" id="fileName">No file chosen</div>
                            @if($user->profile_picture)
                                <button type="button" class="btn btn-danger btn-small" onclick="deleteProfilePicture()">🗑️ Remove Picture</button>
                            @endif
                            @error('profile_picture')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Account Information Section -->
                <div class="section">
                    <h2>👤 Account Information</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" pattern="[0-9]*" inputmode="numeric" placeholder="e.g., 09123456789" required>
                            <div class="help-text">Numbers only</div>
                            @error('phone')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="section">
                    <h2>🔐 Change Password</h2>
                    <p style="color: #6b7280; font-size: 14px; margin-bottom: 20px;">Leave blank if you don't want to change your password</p>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" id="current_password" name="current_password">
                            @error('current_password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password">
                            <div class="help-text">Minimum 8 characters</div>
                            @error('new_password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="actions">
                    <a href="{{ route('profile.show') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">💾 Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Phone number validation - only allow numbers
        document.getElementById('phone').addEventListener('input', function(e) {
            // Remove any non-numeric characters
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        document.getElementById('phone').addEventListener('keypress', function(e) {
            // Only allow numeric keys
            if (e.key && !/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab' && e.key !== 'ArrowLeft' && e.key !== 'ArrowRight') {
                e.preventDefault();
            }
        });

        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('profilePreview');
            const fileName = document.getElementById('fileName');
            
            if (file) {
                fileName.textContent = file.name;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Replace the placeholder or existing image with the new preview
                    preview.innerHTML = '';
                    preview.style.background = 'none';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'profile-picture';
                    preview.appendChild(img);
                }
                reader.readAsDataURL(file);
            } else {
                fileName.textContent = 'No file chosen';
            }
        }

        function deleteProfilePicture() {
            if (confirm('Are you sure you want to remove your profile picture?')) {
                // Create a form and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("profile.delete-picture") }}';
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
