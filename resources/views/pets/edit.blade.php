<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet – {{ $patient->pet_name }}</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f0f4ff 100%);
            padding: 24px;
            min-height: 100vh;
            color: #111827;
        }
        .container { max-width: 860px; margin: 0 auto; }

        /* Header */
        .page-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
        }
        .btn-back {
            padding: 9px 18px;
            background: linear-gradient(135deg, #6b7280, #4b5563);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(107,114,128,0.3);
            transition: all 0.2s;
        }
        .btn-back:hover { background: linear-gradient(135deg, #4b5563, #374151); transform: translateY(-1px); }
        .page-title { font-size: 26px; font-weight: 800; color: #1e1b4b; }
        .page-sub   { font-size: 13px; color: #6b7280; margin-top: 2px; }

        /* Card */
        .card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.06);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f3f4f6;
            background: #fafafa;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-header-icon {
            width: 34px; height: 34px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
            color: white;
        }
        .card-body { padding: 24px; }

        /* Photo upload */
        .photo-section {
            display: flex;
            align-items: center;
            gap: 24px;
            padding: 20px 24px;
            border-bottom: 1px solid #f3f4f6;
        }
        .photo-preview {
            width: 100px; height: 100px;
            border-radius: 14px;
            object-fit: cover;
            border: 3px solid #e0e7ff;
            flex-shrink: 0;
            background: #f3f4f6;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }
        .photo-preview img { width: 100%; height: 100%; object-fit: cover; }
        .photo-placeholder { font-size: 40px; }
        .photo-upload-info h3 { font-size: 15px; font-weight: 700; color: #111827; margin-bottom: 4px; }
        .photo-upload-info p  { font-size: 13px; color: #6b7280; margin-bottom: 12px; }
        .btn-upload-photo {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px;
            background: #4f46e5;
            color: white;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: background 0.2s;
        }
        .btn-upload-photo:hover { background: #4338ca; }
        #pet_photo { display: none; }

        /* Form grid */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-grid.full { grid-template-columns: 1fr; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group label {
            font-size: 12px;
            font-weight: 700;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-group label .req { color: #ef4444; }
        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px 13px;
            border: 1.5px solid #e5e7eb;
            border-radius: 9px;
            font-size: 14px;
            color: #111827;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }
        .form-group .error-msg {
            font-size: 12px;
            color: #ef4444;
        }

        /* Section title inside card */
        .section-label {
            font-size: 11px;
            font-weight: 800;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 20px 0 14px;
        }
        .section-label:first-child { margin-top: 0; }

        /* Alert */
        .alert-error {
            background: #fef2f2; border: 1px solid #fca5a5;
            color: #991b1b; border-radius: 10px;
            padding: 14px 18px; margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-error ul { margin: 8px 0 0 18px; }

        /* Footer buttons */
        .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            padding: 20px 24px;
            border-top: 1px solid #f3f4f6;
            background: #fafafa;
        }
        .btn-save {
            padding: 11px 28px;
            background: linear-gradient(135deg, #4f46e5, #4338ca);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex; align-items: center; gap: 7px;
            box-shadow: 0 2px 10px rgba(79,70,229,0.35);
            transition: all 0.2s;
        }
        .btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 16px rgba(79,70,229,0.45); }
        .btn-cancel {
            padding: 11px 22px;
            background: #f3f4f6;
            color: #374151;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-cancel:hover { background: #e5e7eb; }
    </style>
</head>
<body>
<div class="container">

    <div class="page-header">
        <a href="{{ route('pets.show', $patient) }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <div>
            <div class="page-title">Edit Pet Profile</div>
            <div class="page-sub">Last updated {{ $patient->updated_at->format('M d, Y') }}</div>
        </div>
    </div>

    @if($errors->any())
    <div class="alert-error">
        <strong>Please fix the following errors:</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pets.update', $patient) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ── Pet Photo ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon" style="background: linear-gradient(135deg,#f472b6,#ec4899);">
                    <i class="bi bi-camera-fill"></i>
                </div>
                <strong style="font-size:15px;">Pet Photo</strong>
            </div>
            <div class="photo-section">
                <div class="photo-preview" id="photoPreviewBox">
                    @if($patient->pet_photo_path)
                        <img id="photoPreviewImg" src="{{ asset('storage/' . $patient->pet_photo_path) }}" alt="Pet photo">
                    @else
                        <span class="photo-placeholder" id="photoPlaceholder">🐾</span>
                        <img id="photoPreviewImg" src="" alt="" style="display:none;">
                    @endif
                </div>
                <div class="photo-upload-info">
                    <h3>Upload a photo of {{ $patient->pet_name }}</h3>
                    <p>JPG, PNG or GIF &middot; Max 4 MB</p>
                    <label for="pet_photo" class="btn-upload-photo">
                        <i class="bi bi-upload"></i>
                        {{ $patient->pet_photo_path ? 'Change Photo' : 'Upload Photo' }}
                    </label>
                    <input type="file" name="pet_photo" id="pet_photo" accept="image/*">
                </div>
            </div>
        </div>

        {{-- ── Pet Information ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon" style="background: linear-gradient(135deg,#34d399,#059669);">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
                <strong style="font-size:15px;">Pet Information</strong>
            </div>
            <div class="card-body">
                <div class="section-label">Basic Details</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Pet Name <span class="req">*</span></label>
                        <input type="text" name="pet_name" value="{{ old('pet_name', $patient->pet_name) }}" required>
                        @error('pet_name')<span class="error-msg">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Species <span class="req">*</span></label>
                        <select name="species_id" id="speciesSelect" required onchange="loadSpeciesCharacteristics()">
                            <option value="">Select Species</option>
                            @foreach($species as $sp)
                                <option value="{{ $sp->id }}" {{ old('species_id', $patient->species_id) == $sp->id ? 'selected' : '' }}>{{ $sp->name }}</option>
                            @endforeach
                        </select>
                        @error('species_id')<span class="error-msg">{{ $message }}</span>@enderror
                        <div id="speciesCharacteristics" style="margin-top: 12px; padding: 12px; background: #eff6ff; border-left: 4px solid #2563eb; border-radius: 6px; display: none;">
                            <strong style="color: #2563eb; display: block; margin-bottom: 8px;">Species Characteristics:</strong>
                            <div id="characteristicsContent" style="color: #1e40af; font-size: 13px; line-height: 1.6;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Breed</label>
                        <input type="text" name="breed" value="{{ old('breed', $patient->breed) }}" placeholder="e.g. Labrador Retriever">
                    </div>
                    <div class="form-group">
                        <label>Color / Markings</label>
                        <input type="text" name="color" value="{{ old('color', $patient->color) }}" placeholder="e.g. Golden, white paws">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth <span class="req">*</span></label>
                        <input type="date" name="birthdate" value="{{ old('birthdate', $patient->birthdate?->format('Y-m-d')) }}" max="{{ date('Y-m-d') }}" required>
                        @error('birthdate')<span class="error-msg">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Sex <span class="req">*</span></label>
                        <select name="sex" required>
                            @foreach(['Male','Female','Neutered Male','Spayed Female'] as $s)
                                <option value="{{ $s }}" {{ old('sex', $patient->sex) === $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('sex')<span class="error-msg">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Owner Information ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon" style="background: linear-gradient(135deg,#60a5fa,#2563eb);">
                    <i class="bi bi-person-fill"></i>
                </div>
                <strong style="font-size:15px;">Owner Information</strong>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Owner Name <span class="req">*</span></label>
                        <input type="text" name="owner_name" value="{{ old('owner_name', $patient->owner_name) }}" required>
                        @error('owner_name')<span class="error-msg">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" name="owner_contact" value="{{ old('owner_contact', $patient->owner_contact) }}" placeholder="e.g. 09171234567">
                    </div>
                    <div class="form-group form-grid full">
                        <label>Address <span class="req">*</span></label>
                        <input type="text" name="address" value="{{ old('address', $patient->address) }}" required>
                        @error('address')<span class="error-msg">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="section-label" style="margin-top:20px;">Emergency Contact</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Emergency Contact Name</label>
                        <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}">
                    </div>
                    <div class="form-group">
                        <label>Emergency Contact Number</label>
                        <input type="text" name="emergency_contact_number" value="{{ old('emergency_contact_number', $patient->emergency_contact_number) }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- Additional Information --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon" style="background: linear-gradient(135deg,#a78bfa,#8b5cf6);">
                    <i class="bi bi-info-circle-fill"></i>
                </div>
                <strong style="font-size:15px;">Additional Information</strong>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group" style="align-items: flex-start;">
                        <label style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; margin-top: 4px;">
                            <input type="checkbox" name="is_required" value="1" {{ old('is_required', $patient->is_required) ? 'checked' : '' }} style="width: auto; cursor: pointer;">
                            <span style="font-weight: 500;">Requires Special Care</span>
                        </label>
                        <span class="hint">Check if this pet requires special care or attention</span>
                    </div>
                    <div class="form-group" style="align-items: flex-start;">
                        <label style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; margin-top: 4px;">
                            <input type="checkbox" name="privacy_consent" value="1" {{ old('privacy_consent', $patient->privacy_consent) ? 'checked' : '' }} style="width: auto; cursor: pointer;">
                            <span style="font-weight: 500;">Privacy Consent Given</span>
                        </label>
                        <span class="hint">Data privacy and processing consent</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="card">
            <div class="form-footer">
                <a href="{{ route('pets.show', $patient) }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">
                    <i class="bi bi-check2-circle"></i> Save Changes
                </button>
            </div>
        </div>

    </form>
</div>

<script>
    // Form Progress Tracking
    const petForm = document.querySelector('form');
    const requiredFields = ['pet_name', 'species_id', 'breed', 'birthdate', 'sex', 'owner_name', 'owner_contact', 'address'];
    
    function updateFormProgress() {
        let completed = 0;
        requiredFields.forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field && field.value.trim()) {
                completed++;
            }
        });
        
        const percent = Math.round((completed / requiredFields.length) * 100);
        // Update the UI if progress element exists, otherwise skip
        const progress = document.getElementById('progressFill');
        const progressPercent = document.getElementById('progressPercent');
        if (progress && progressPercent) {
            progress.style.width = percent + '%';
            progressPercent.textContent = percent;
        }
    }

    // Species characteristics loader
    async function loadSpeciesCharacteristics() {
        const speciesId = document.getElementById('speciesSelect').value;
        const characteristicsDiv = document.getElementById('speciesCharacteristics');
        const characteristicsContent = document.getElementById('characteristicsContent');
        
        if (!speciesId) {
            characteristicsDiv.style.display = 'none';
            return;
        }
        
        try {
            const response = await fetch(`/api/species/${speciesId}`);
            const data = await response.json();
            
            if (data && data.characteristics) {
                let characteristics = data.characteristics;
                if (typeof characteristics === 'string') {
                    characteristics = JSON.parse(characteristics);
                }
                
                let html = '';
                for (const [key, value] of Object.entries(characteristics)) {
                    html += `<div style="margin-bottom: 6px;"><strong>${key}:</strong> ${value}</div>`;
                }
                
                characteristicsContent.innerHTML = html;
                characteristicsDiv.style.display = 'block';
            } else {
                characteristicsDiv.style.display = 'none';
            }
        } catch (error) {
            console.error('Error loading species characteristics:', error);
            characteristicsDiv.style.display = 'none';
        }
        updateFormProgress();
    }

    document.getElementById('pet_photo').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.getElementById('photoPreviewImg');
            const placeholder = document.getElementById('photoPlaceholder');
            img.src = e.target.result;
            img.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    // Form submission validation
    document.querySelector('form').addEventListener('submit', function(e) {
        let hasErrors = false;
        const requiredFields = ['pet_name', 'species_id', 'breed', 'birthdate', 'sex', 'owner_name', 'address'];
        
        requiredFields.forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field && !field.value.trim()) {
                hasErrors = true;
                field.style.borderColor = '#ef4444';
                field.style.backgroundColor = '#fef2f2';
            }
        });

        if (hasErrors) {
            e.preventDefault();
            alert('Please fill in all required fields (marked with *)');
            return false;
        }
    });

    // Add form change tracking
    document.querySelectorAll('input, select, textarea').forEach(field => {
        field.addEventListener('change', function() {
            updateFormProgress();
        });
        field.addEventListener('input', function() {
            updateFormProgress();
        });
    });

    // Load characteristics on page load if species is selected
    window.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('speciesSelect').value) {
            loadSpeciesCharacteristics();
        }
        updateFormProgress();
    });
</script>
</body>
</html>
