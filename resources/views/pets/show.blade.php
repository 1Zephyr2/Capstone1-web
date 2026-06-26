<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $patient->pet_name ?? $patient->full_name }} - Pet Profile</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #FFF8F0;
    padding: 24px;
    padding-top: 96px;
    min-height: 100vh;
}

        .main-content {

        .pet-header {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            border-radius: 12px;
            padding: 24px;
            color: white;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            justify-content: space-between;
        }

        .pet-header-info {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1;
        }

        .pet-icon-large {
            font-size: 60px;
            min-width: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pet-photo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.3);
            flex-shrink: 0;
        }

        .pet-header-content h1 {
            font-size: 32px;
            margin: 0 0 8px 0;
        }

        .pet-header-content p {
            margin: 0;
            opacity: 0.9;
        }

        .pet-header-actions {
            display: flex;
            gap: 8px;
        }

        .btn-edit-pet {
            padding: 10px 16px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-edit-pet:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .btn-back {
            padding: 10px 16px;
            background: white;
            color: #14b8a6;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-back:hover {
            background: #f0fdfa;
            border-color: #14b8a6;
            box-shadow: 0 2px 8px rgba(20, 184, 166, 0.2);
        }

        .btn-action {
            padding: 10px 16px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-action:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }

        .info-label {
            color: #9ca3af;
            font-weight: 500;
        }

        .info-value {
            color: #1f2937;
            font-weight: 600;
        }

        /* Sections */
        .section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }

        .section:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .records-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .record-item {
            padding: 12px;
            background: #f9fafb;
            border-left: 4px solid #14b8a6;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .record-item:hover {
            background: #f3f4f6;
        }

        .record-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .record-info {
            font-size: 13px;
            color: #9ca3af;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #9ca3af;
        }

        .empty-state i {
            font-size: 40px;
            color: #d1d5db;
            margin-bottom: 12px;
        }

        /* Photo Gallery */
        .photo-gallery-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
        }

        .gallery-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 12px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            aspect-ratio: 1;
            cursor: pointer;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
            border-color: #14b8a6;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 32px;
            color: #d1d5db;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-item-icon {
            opacity: 1;
        }

        /* Photo Modal */
        .photo-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .photo-modal.active {
            display: flex;
        }

        .photo-modal-content {
            position: relative;
            max-width: 90%;
            max-height: 90vh;
            border-radius: 12px;
            overflow: hidden;
        }

        .photo-modal-image {
            max-width: 100%;
            max-height: 90vh;
            width: auto;
            height: auto;
            display: block;
        }

        .photo-modal-close {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .photo-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f9fafb;
            padding: 12px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
            color: #111827;
        }

        tbody tr {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            background: #f0fdf4;
            box-shadow: inset 0 0 8px rgba(20, 184, 166, 0.1);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border: 1px solid;
        }

        .alert-success {
            background: #d1fae5;
            color: #166534;
            border-color: #86efac;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px 16px;
            }

            .pet-header {
                flex-direction: column;
                text-align: center;
            }

            .pet-header-info {
                flex-direction: column;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>\n<x-staff-navbar />
    <!-- Main Content -->
    <div class="main-content">
        @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i>
            <div>{{ session('success') }}</div>
        </div>
        @endif

        <!-- Back Button -->
        <div style="margin-bottom: 16px;">
            <a href="{{ route('patients.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Back to Patients
            </a>
        </div>

        <!-- Pet Header -->
        <div class="pet-header">
            <div class="pet-header-info">
                @if($patient->pet_photo_path)
                    <img src="{{ asset('storage/' . $patient->pet_photo_path) }}" alt="{{ $patient->pet_name ?? $patient->full_name }}" class="pet-photo">
                @else
                    <div class="pet-icon-large">
                        <i class="bi bi-paw"></i>
                    </div>
                @endif
                <div class="pet-header-content">
                    <h1>{{ $patient->pet_name ?? $patient->full_name }}</h1>
                    <p>{{ $patient->species ?? 'Unknown Species' }} • {{ $patient->breed ?? 'Unknown Breed' }}</p>
                </div>
            </div>
            <div class="pet-header-actions">
                <a href="{{ route('pets.edit', $patient) }}" class="btn-edit-pet">
                    <i class="bi bi-pencil-square"></i>
                    Edit Pet
                </a>
                <a href="{{ route('visits.create', ['patient_id' => $patient->id]) }}" class="btn-action">
                    <i class="bi bi-plus-circle"></i>
                    Record Visit
                </a>
            </div>
        </div>

        <!-- Photo Gallery -->
        @php
            $petPhotos = [];
            if ($patient->pet_photo_path) {
                $petPhotos[] = [
                    'path' => $patient->pet_photo_path,
                    'alt' => ($patient->pet_name ?? $patient->full_name) . ' - Main Photo'
                ];
            }
        @endphp

        @if(!empty($petPhotos))
        <div class="photo-gallery-section">
            <div class="gallery-title">
                <i class="bi bi-images"></i>
                Pet Photos
            </div>
            <div class="gallery-grid">
                @foreach($petPhotos as $photo)
                <div class="gallery-item" onclick="openPhotoModal('{{ asset('storage/' . $photo['path']) }}')">
                    <img src="{{ asset('storage/' . $photo['path']) }}" alt="{{ $photo['alt'] }}">
                    <div class="gallery-item-icon">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Photo Modal -->
        <div class="photo-modal" id="photoModal" onclick="if(event.target.id === 'photoModal') closePhotoModal()">
            <div class="photo-modal-content">
                <button class="photo-modal-close" onclick="closePhotoModal()">&times;</button>
                <img id="modalPhotoImage" class="photo-modal-image" src="" alt="Pet Photo">
            </div>
        </div>

        <!-- Quick Info Cards -->
        <div class="cards-grid">
            <div class="card">
                <div class="card-title">
                    <i class="bi bi-person"></i>
                    Owner Information
                </div>
                <div class="info-item">
                    <span class="info-label">Name</span>
                    <span class="info-value">{{ $patient->owner_name ?? 'Unknown' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Contact</span>
                    <span class="info-value">{{ $patient->owner_contact ?? 'Not provided' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Address</span>
                    <span class="info-value">{{ Str::limit($patient->address ?? 'Unknown', 40) }}</span>
                </div>
                @if($patient->email)
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ Str::limit($patient->email, 35) }}</span>
                </div>
                @endif
            </div>

            <div class="card">
                <div class="card-title">
                    <i class="bi bi-calendar3"></i>
                    Birth & Sex
                </div>
                <div class="info-item">
                    <span class="info-label">Date of Birth</span>
                    <span class="info-value">{{ $patient->birthdate ? $patient->birthdate->format('M d, Y') : 'Unknown' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Sex</span>
                    <span class="info-value">{{ ucfirst($patient->sex ?? 'Unknown') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Age</span>
                    <span class="info-value">{{ $patient->age ?? 'Unknown' }} years</span>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <i class="bi bi-palette"></i>
                    Appearance
                </div>
                <div class="info-item">
                    <span class="info-label">Color</span>
                    <span class="info-value">{{ $patient->color ?? 'Unknown' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Breed</span>
                    <span class="info-value">{{ $patient->breed ?? 'Unknown' }}</span>
                </div>
            </div>
        </div>

        <!-- Visit History -->
        <div class="section">
            <div class="section-title">
                <i class="bi bi-clipboard-check"></i>
                Visit History
            </div>

            @if($patient->visits->where('service_type', '!=', 'Vaccination')->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>No visits recorded yet.</p>
                </div>
            @else
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Service Type</th>
                                <th>Health Worker</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patient->visits as $visit)
                            @if($visit->service_type !== 'Vaccination')
                            <tr onclick="window.location.href='{{ route('visits.show', $visit) }}'">
                                <td>{{ $visit->visit_date->format('M d, Y') }}</td>
                                <td><span class="badge badge-success">{{ $visit->service_type }}</span></td>
                                <td>{{ $visit->health_worker ?? '-' }}</td>
                                <td>{{ Str::limit($visit->notes ?? '-', 50) }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    <script>
        function openPhotoModal(imagePath) {
            const modal = document.getElementById('photoModal');
            const image = document.getElementById('modalPhotoImage');
            image.src = imagePath;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePhotoModal() {
            const modal = document.getElementById('photoModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closePhotoModal();
            }
        });
    </script>
    {{-- ============================================================ --}}
{{-- PET HEALTH BACKGROUND SECTION - Add to pets/show.blade.php  --}}
{{-- Place this AFTER the Visit History section                   --}}
{{-- ============================================================ --}}

{{-- Load health records: add this to the PetController@show method --}}
{{-- $healthRecords = $patient->healthRecords()->latest()->get();    --}}

<!-- Health Background Section -->
<div class="section" style="margin-top: 24px;">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
        <div class="section-title" style="margin-bottom:0;">
            <i class="bi bi-heart-pulse-fill" style="color:#ef4444;"></i>
            Health Background
        </div>
        <button onclick="document.getElementById('addHealthRecordForm').style.display = document.getElementById('addHealthRecordForm').style.display === 'none' ? 'block' : 'none'"
            style="padding:8px 16px; background:linear-gradient(135deg,#0F8A7A,#0B6B5F); color:white; border:none; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:6px;">
            <i class="bi bi-plus-circle"></i> Add Record
        </button>
    </div>

    {{-- Add Record Form (hidden by default) --}}
    <div id="addHealthRecordForm" style="display:none; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:20px; margin-bottom:20px;">
        <h4 style="font-size:14px; font-weight:700; color:#1C2B33; margin-bottom:16px;"><i class="bi bi-plus-circle" style="color:#0F8A7A;"></i> New Health Record</h4>
        <form action="{{ route('pets.health-records.store', $patient) }}" method="POST">
            @csrf
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px;">
                <div>
                    <label style="font-size:12px; font-weight:600; color:#374151; display:block; margin-bottom:5px;">Condition / Disease <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="condition" required placeholder="e.g. Skin Allergy, Mange, Ear Infection"
                        style="width:100%; padding:10px 12px; border:1.5px solid #d1d5db; border-radius:8px; font-size:13px;">
                </div>
                <div>
                    <label style="font-size:12px; font-weight:600; color:#374151; display:block; margin-bottom:5px;">Date Diagnosed</label>
                    <input type="date" name="diagnosed_date" max="{{ date('Y-m-d') }}"
                        style="width:100%; padding:10px 12px; border:1.5px solid #d1d5db; border-radius:8px; font-size:13px;">
                </div>
                <div>
                    <label style="font-size:12px; font-weight:600; color:#374151; display:block; margin-bottom:5px;">Medication / Treatment</label>
                    <input type="text" name="medication" placeholder="e.g. Apoquel 5.4mg, Medicated Shampoo"
                        style="width:100%; padding:10px 12px; border:1.5px solid #d1d5db; border-radius:8px; font-size:13px;">
                </div>
                <div>
                    <label style="font-size:12px; font-weight:600; color:#374151; display:block; margin-bottom:5px;">Dosage / Frequency</label>
                    <input type="text" name="dosage" placeholder="e.g. 1 tablet daily, Apply twice a week"
                        style="width:100%; padding:10px 12px; border:1.5px solid #d1d5db; border-radius:8px; font-size:13px;">
                </div>
            </div>
            <div style="margin-bottom:14px;">
                <label style="font-size:12px; font-weight:600; color:#374151; display:block; margin-bottom:5px;">Status <span style="color:#dc2626;">*</span></label>
                <select name="status" required style="width:200px; padding:10px 12px; border:1.5px solid #d1d5db; border-radius:8px; font-size:13px;">
                    <option value="active">Active</option>
                    <option value="monitoring">Monitoring</option>
                    <option value="resolved">Resolved</option>
                </select>
            </div>
            <div style="margin-bottom:16px;">
                <label style="font-size:12px; font-weight:600; color:#374151; display:block; margin-bottom:5px;">Notes / Special Instructions</label>
                <textarea name="notes" rows="2" placeholder="e.g. Avoid sulfate-based shampoos, sensitive to cold water"
                    style="width:100%; padding:10px 12px; border:1.5px solid #d1d5db; border-radius:8px; font-size:13px; resize:vertical;"></textarea>
            </div>
            <div style="display:flex; gap:10px;">
                <button type="submit" style="padding:9px 20px; background:linear-gradient(135deg,#0F8A7A,#0B6B5F); color:white; border:none; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer;">
                    <i class="bi bi-check-circle"></i> Save Record
                </button>
                <button type="button" onclick="document.getElementById('addHealthRecordForm').style.display='none'"
                    style="padding:9px 20px; background:#e5e7eb; color:#374151; border:none; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer;">
                    Cancel
                </button>
            </div>
        </form>
    </div>

    {{-- Health Records List --}}
    @if(isset($healthRecords) && $healthRecords->count() > 0)
        <div style="display:flex; flex-direction:column; gap:12px;">
            @foreach($healthRecords as $record)
            <div style="background:white; border:1px solid #e2e8f0; border-radius:10px; padding:16px; border-left:4px solid {{ $record->status === 'active' ? '#ef4444' : ($record->status === 'monitoring' ? '#f59e0b' : '#10b981') }};">
                <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:12px; margin-bottom:10px;">
                    <div style="flex:1;">
                        <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                            <span style="font-size:15px; font-weight:700; color:#1C2B33;">{{ $record->condition }}</span>
                            {!! $record->status_badge !!}
                        </div>
                        @if($record->diagnosed_date)
                            <div style="font-size:12px; color:#7A8B85; margin-top:4px;">
                                <i class="bi bi-calendar3"></i> Diagnosed: {{ $record->diagnosed_date->format('M d, Y') }}
                            </div>
                        @endif
                    </div>
                    <div style="display:flex; gap:6px; flex-shrink:0;">
                        <button onclick="toggleEditForm('editHealth{{ $record->id }}')"
                            style="padding:6px 10px; background:#eff6ff; color:#1e40af; border:1px solid #bfdbfe; border-radius:6px; font-size:12px; cursor:pointer;">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form action="{{ route('pets.health-records.destroy', [$patient, $record]) }}" method="POST" style="display:inline;"
                            onsubmit="return confirm('Delete this health record?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="padding:6px 10px; background:#fee2e2; color:#991b1b; border:1px solid #fca5a5; border-radius:6px; font-size:12px; cursor:pointer;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>

                @if($record->medication)
                <div style="display:flex; gap:8px; align-items:flex-start; margin-bottom:6px;">
                    <i class="bi bi-capsule" style="color:#0F8A7A; margin-top:2px; flex-shrink:0;"></i>
                    <div>
                        <span style="font-size:13px; font-weight:600; color:#374151;">{{ $record->medication }}</span>
                        @if($record->dosage)
                            <span style="font-size:12px; color:#7A8B85;"> — {{ $record->dosage }}</span>
                        @endif
                    </div>
                </div>
                @endif

                @if($record->notes)
                <div style="background:#f8fafc; border-radius:6px; padding:8px 12px; font-size:12px; color:#374151; border-left:3px solid #EDE3D6;">
                    <i class="bi bi-info-circle" style="color:#7A8B85;"></i> {{ $record->notes }}
                </div>
                @endif

                @if($record->recordedBy)
                <div style="font-size:11px; color:#9ca3af; margin-top:8px;">
                    Recorded by {{ $record->recordedBy->name }} on {{ $record->created_at->format('M d, Y') }}
                </div>
                @endif

                {{-- Inline Edit Form --}}
                <div id="editHealth{{ $record->id }}" style="display:none; margin-top:14px; padding:16px; background:#f8fafc; border-radius:8px; border:1px solid #e2e8f0;">
                    <form action="{{ route('pets.health-records.update', [$patient, $record]) }}" method="POST">
                        @csrf @method('PUT')
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px;">
                            <div>
                                <label style="font-size:11px; font-weight:700; color:#374151; display:block; margin-bottom:4px;">Condition</label>
                                <input type="text" name="condition" value="{{ $record->condition }}" required
                                    style="width:100%; padding:8px 10px; border:1.5px solid #d1d5db; border-radius:6px; font-size:13px;">
                            </div>
                            <div>
                                <label style="font-size:11px; font-weight:700; color:#374151; display:block; margin-bottom:4px;">Date Diagnosed</label>
                                <input type="date" name="diagnosed_date" value="{{ $record->diagnosed_date?->format('Y-m-d') }}" max="{{ date('Y-m-d') }}"
                                    style="width:100%; padding:8px 10px; border:1.5px solid #d1d5db; border-radius:6px; font-size:13px;">
                            </div>
                            <div>
                                <label style="font-size:11px; font-weight:700; color:#374151; display:block; margin-bottom:4px;">Medication</label>
                                <input type="text" name="medication" value="{{ $record->medication }}"
                                    style="width:100%; padding:8px 10px; border:1.5px solid #d1d5db; border-radius:6px; font-size:13px;">
                            </div>
                            <div>
                                <label style="font-size:11px; font-weight:700; color:#374151; display:block; margin-bottom:4px;">Dosage</label>
                                <input type="text" name="dosage" value="{{ $record->dosage }}"
                                    style="width:100%; padding:8px 10px; border:1.5px solid #d1d5db; border-radius:6px; font-size:13px;">
                            </div>
                        </div>
                        <div style="margin-bottom:12px;">
                            <label style="font-size:11px; font-weight:700; color:#374151; display:block; margin-bottom:4px;">Status</label>
                            <select name="status" required style="padding:8px 10px; border:1.5px solid #d1d5db; border-radius:6px; font-size:13px;">
                                <option value="active" {{ $record->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="monitoring" {{ $record->status === 'monitoring' ? 'selected' : '' }}>Monitoring</option>
                                <option value="resolved" {{ $record->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                            </select>
                        </div>
                        <div style="margin-bottom:12px;">
                            <label style="font-size:11px; font-weight:700; color:#374151; display:block; margin-bottom:4px;">Notes</label>
                            <textarea name="notes" rows="2" style="width:100%; padding:8px 10px; border:1.5px solid #d1d5db; border-radius:6px; font-size:13px; resize:vertical;">{{ $record->notes }}</textarea>
                        </div>
                        <div style="display:flex; gap:8px;">
                            <button type="submit" style="padding:7px 16px; background:#0F8A7A; color:white; border:none; border-radius:6px; font-size:12px; font-weight:600; cursor:pointer;">
                                <i class="bi bi-check-circle"></i> Save
                            </button>
                            <button type="button" onclick="toggleEditForm('editHealth{{ $record->id }}')"
                                style="padding:7px 16px; background:#e5e7eb; color:#374151; border:none; border-radius:6px; font-size:12px; cursor:pointer;">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="bi bi-heart-pulse"></i>
            <p>No health records on file. Use the Add Record button above to add the first one.</p>
        </div>
    @endif
</div>

{{-- Toggle edit form script - add near bottom of page before </body> --}}
<script>
function toggleEditForm(id) {
    const el = document.getElementById(id);
    el.style.display = el.style.display === 'none' ? 'block' : 'none';
}
</script>
</body>
</html>
