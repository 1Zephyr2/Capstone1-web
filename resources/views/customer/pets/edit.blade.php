<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet - PAWSER</title>
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

        .page-subtitle {
            font-size: 14px;
            color: #64748b;
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
        input[type="date"],
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
        input[type="date"]:focus,
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

        /* Photo Upload */
        .photo-upload-section {
            margin-bottom: 24px;
            padding: 20px;
            background: #f9fafb;
            border-radius: 10px;
            border: 2px dashed #e5e7eb;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
        }

        .photo-upload-section:hover {
            border-color: #14b8a6;
            background: #f0fdf4;
        }

        .photo-upload-section.dragover {
            border-color: #14b8a6;
            background: #f0fdf4;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        .photo-upload-icon {
            font-size: 36px;
            color: #14b8a6;
            margin-bottom: 8px;
        }

        .photo-upload-text {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .photo-upload-hint {
            color: #9ca3af;
            font-size: 12px;
            margin-top: 4px;
        }

        .photo-preview {
            margin-top: 16px;
            text-align: center;
        }

        .photo-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .photo-preview-label {
            display: block;
            font-size: 12px;
            color: #64748b;
            margin-top: 8px;
        }

        #pet_photo {
            display: none;
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

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
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
            border-top: 1px solid #e5e7eb;
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

            .form-row {
                grid-template-columns: 1fr;
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
                <a href="{{ route('customer.pets.index') }}" class="nav-item active">
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
                    <a href="{{ route('profile.show') }}" style="text-decoration: none; color: white;" title="View Profile">
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
        <a href="{{ route('customer.pets.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to My Pets
        </a>

        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-pencil-square"></i>
                Edit {{ $patient->pet_name }}
            </h1>
            <p class="page-subtitle">Update your pet's information and photo</p>
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

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <form action="{{ route('customer.pets.update', $patient) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Photo Upload -->
                <div class="form-group">
                    <label>Pet Photo</label>
                    @if($patient->pet_photo_path)
                        <div class="photo-preview">
                            <img src="{{ asset('storage/' . $patient->pet_photo_path) }}" alt="Pet photo">
                            <p class="photo-preview-label">Current photo - Click to change</p>
                        </div>
                    @endif
                    <div class="photo-upload-section" id="photoUpload" @if($patient->pet_photo_path) style="display: none;" @endif>
                        <div class="photo-upload-icon">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>
                        <p class="photo-upload-text">Drag and drop your pet's photo here, or click to select</p>
                        <p class="photo-upload-hint">PNG, JPG, GIF up to 4MB</p>
                    </div>
                    <input type="file" name="pet_photo" id="pet_photo" accept="image/*">
                    <div class="photo-preview" id="photoPreview" style="display: none;">
                        <img id="previewImage" src="" alt="Pet photo preview">
                    </div>
                </div>

                <!-- Pet Name -->
                <div class="form-group">
                    <label>
                        <span><i class="bi bi-paw-fill" style="color: #14b8a6;"></i></span>
                        Pet Name <span class="required">*</span>
                    </label>
                    <input type="text" name="pet_name" required value="{{ old('pet_name', $patient->pet_name) }}" placeholder="e.g., Buddy, Whiskers">
                </div>

                <!-- Species and Breed Row -->
                <div class="form-row">
                    <div class="form-group">
                        <label>
                            Species <span class="required">*</span>
                        </label>
                        <select name="species_id" id="species_id" required>
                            <option value="">-- Select Species --</option>
                            @foreach($species as $s)
                                <option value="{{ $s->id }}" {{ old('species_id', $patient->species_id) == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Breed</label>
                        <input type="text" name="breed" value="{{ old('breed', $patient->breed) }}" placeholder="e.g., Golden Retriever">
                    </div>
                </div>

                <!-- Color and Sex Row -->
                <div class="form-row">
                    <div class="form-group">
                        <label>Color</label>
                        <input type="text" name="color" value="{{ old('color', $patient->color) }}" placeholder="e.g., Brown, Black & White">
                    </div>

                    <div class="form-group">
                        <label>
                            Sex <span class="required">*</span>
                        </label>
                        <select name="sex" required>
                            <option value="">-- Select Sex --</option>
                            <option value="Male" {{ old('sex', $patient->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('sex', $patient->sex) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Neutered Male" {{ old('sex', $patient->sex) == 'Neutered Male' ? 'selected' : '' }}>Neutered Male</option>
                            <option value="Spayed Female" {{ old('sex', $patient->sex) == 'Spayed Female' ? 'selected' : '' }}>Spayed Female</option>
                        </select>
                    </div>
                </div>

                <!-- Birthdate -->
                <div class="form-group">
                    <label>
                        <span><i class="bi bi-calendar" style="color: #14b8a6;"></i></span>
                        Date of Birth <span class="required">*</span>
                    </label>
                    <input type="date" name="birthdate" required value="{{ old('birthdate', $patient->birthdate ? $patient->birthdate->format('Y-m-d') : '') }}" max="{{ date('Y-m-d') }}">
                </div>

                <!-- Emergency Contact -->
                <div class="form-group">
                    <label>Emergency Contact Name</label>
                    <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}" placeholder="Name of emergency contact">
                </div>

                <div class="form-group">
                    <label>Emergency Contact Number</label>
                    <input type="text" name="emergency_contact_number" value="{{ old('emergency_contact_number', $patient->emergency_contact_number) }}" placeholder="Emergency contact phone number">
                </div>

                <!-- Buttons -->
                <div class="buttons">
                    <a href="{{ route('customer.pets.index') }}" class="btn btn-cancel">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Photo upload functionality
        const photoUpload = document.getElementById('photoUpload');
        const photoInput = document.getElementById('pet_photo');
        const photoPreview = document.getElementById('photoPreview');
        const previewImage = document.getElementById('previewImage');
        const existingPreview = document.querySelector('.photo-preview:not(#photoPreview)');

        // Click to upload
        photoUpload.addEventListener('click', () => photoInput.click());

        // File input change
        photoInput.addEventListener('change', handleFileSelect);

        // Drag and drop
        photoUpload.addEventListener('dragover', (e) => {
            e.preventDefault();
            photoUpload.classList.add('dragover');
        });

        photoUpload.addEventListener('dragleave', () => {
            photoUpload.classList.remove('dragover');
        });

        photoUpload.addEventListener('drop', (e) => {
            e.preventDefault();
            photoUpload.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                photoInput.files = files;
                handleFileSelect();
            }
        });

        function handleFileSelect() {
            const file = photoInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                    photoPreview.style.display = 'block';
                    photoUpload.style.display = 'none';
                    if (existingPreview) {
                        existingPreview.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }
        }

        // Allow user to change photo by clicking preview
        if (existingPreview) {
            existingPreview.addEventListener('click', () => photoInput.click());
            existingPreview.style.cursor = 'pointer';
        }
    </script>
</body>
</html>
