<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Details - FURCARE</title>
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
            padding: 24px;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: white;
            color: #14b8a6;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: #f0fdfa;
            border-color: #14b8a6;
            box-shadow: 0 2px 8px rgba(20, 184, 166, 0.2);
        }

        .header {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            border-radius: 12px;
            padding: 24px;
            color: white;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            opacity: 0.9;
            margin-bottom: 4px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #1f2937;
        }

        .info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 16px;
        }

        .info-row.full {
            grid-template-columns: 1fr;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 12px;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 15px;
            color: #1f2937;
            font-weight: 500;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            background: #d1fae5;
            color: #065f46;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            width: fit-content;
        }

        .service-badge {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
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
            color: #111827;
        }

        .visit-photos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 12px;
        }

        .visit-photo-item {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            background: #f9fafb;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .visit-photo-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
        }

        .visit-photo-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .visit-photo-button {
            all: unset;
            display: block;
            width: 100%;
            cursor: pointer;
        }

        .visit-photo-caption {
            padding: 8px 10px;
            font-size: 12px;
            color: #6b7280;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .photo-viewer {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(10px) saturate(120%);
            -webkit-backdrop-filter: blur(10px) saturate(120%);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.22s ease;
        }

        .photo-viewer.active {
            display: flex;
            opacity: 1;
        }

        .photo-viewer-content {
            position: relative;
            width: min(92vw, 1100px);
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transform: scale(0.96) translateY(10px);
            transition: transform 0.22s ease;
        }

        .photo-viewer.active .photo-viewer-content {
            transform: scale(1) translateY(0);
        }

        .photo-viewer-image {
            width: 100%;
            max-height: 78vh;
            object-fit: contain;
            border-radius: 12px;
            background: rgba(17, 24, 39, 0.85);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
        }

        .photo-viewer-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #e5e7eb;
            font-size: 13px;
            gap: 12px;
        }

        .viewer-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 50%;
            background: rgba(17, 24, 39, 0.55);
            backdrop-filter: blur(6px);
            color: #fff;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .viewer-btn:hover {
            background: rgba(17, 24, 39, 0.9);
        }

        .viewer-btn.prev {
            left: -56px;
        }

        .viewer-btn.next {
            right: -56px;
        }

        .viewer-close {
            position: absolute;
            top: -52px;
            right: 0;
            border: none;
            background: rgba(17, 24, 39, 0.55);
            backdrop-filter: blur(6px);
            color: #fff;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .info-row {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 16px;
            }

            .header h1 {
                font-size: 22px;
            }

            .viewer-btn.prev {
                left: 8px;
            }

            .viewer-btn.next {
                right: 8px;
            }

            .viewer-close {
                top: 8px;
                right: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="javascript:history.back()" class="back-button">
            <i class="bi bi-arrow-left"></i>
            Back
        </a>

        <div class="header">
            <h1>{{ $visit->patient->pet_name ?? $visit->patient->full_name }}</h1>
            <p><i class="bi bi-calendar-event"></i> {{ $visit->visit_date->format('l, M d, Y') }}</p>
            <p><i class="bi bi-clock"></i> {{ $visit->visit_time ? \Carbon\Carbon::parse($visit->visit_time)->format('g:i A') : 'N/A' }}</p>
        </div>

        <div class="card">
            <div class="card-title">
                <i class="bi bi-info-circle"></i>
                Visit Information
            </div>

            <div class="info-row">
                <div class="info-item">
                    <span class="info-label">Service Type</span>
                    <span class="badge service-badge">{{ $visit->service_type }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Health Worker</span>
                    <span class="info-value">{{ $visit->health_worker ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="info-row full">
                <div class="info-item">
                    <span class="info-label">Chief Complaint</span>
                    <span class="info-value">{{ $visit->chief_complaint ?? 'No complaint recorded' }}</span>
                </div>
            </div>

            @if($visit->notes)
            <div class="info-row full">
                <div class="info-item">
                    <span class="info-label">Notes</span>
                    <span class="info-value">{{ $visit->notes }}</span>
                </div>
            </div>
            @endif
        </div>

        <div class="card">
            <div class="card-title">
                <i class="bi bi-paw"></i>
                Patient Information
            </div>

            <div class="info-row">
                <div class="info-item">
                    <span class="info-label">Pet Name</span>
                    <span class="info-value">{{ $visit->patient->pet_name ?? $visit->patient->full_name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Species</span>
                    <span class="info-value">{{ $visit->patient->species ?? 'Unknown' }}</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <span class="info-label">Breed</span>
                    <span class="info-value">{{ $visit->patient->breed ?? 'Unknown' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date of Birth</span>
                    <span class="info-value">{{ $visit->patient->date_of_birth ? $visit->patient->date_of_birth->format('M d, Y') : 'N/A' }}</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <span class="info-label">Owner Name</span>
                    <span class="info-value">{{ $visit->patient->owner_name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Owner Contact</span>
                    <span class="info-value">{{ $visit->patient->owner_contact ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-title">
                <i class="bi bi-clock-history"></i>
                Visit Timeline
            </div>

            <div class="info-row">
                <div class="info-item">
                    <span class="info-label">Created At</span>
                    <span class="info-value">{{ $visit->created_at->format('M d, Y \a\t g:i A') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Last Updated</span>
                    <span class="info-value">{{ $visit->updated_at->format('M d, Y \a\t g:i A') }}</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-title">
                <i class="bi bi-images"></i>
                Uploaded Visit Photos
            </div>

            @if($visit->photos && $visit->photos->count() > 0)
            <div class="visit-photos-grid">
                @foreach($visit->photos as $index => $photo)
                <div class="visit-photo-item">
                    <button type="button" class="visit-photo-button" onclick="openPhotoViewer({{ $index }})" aria-label="Open visit photo {{ $index + 1 }}">
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Visit photo {{ $index + 1 }}">
                        <div class="visit-photo-caption">{{ $photo->original_name ?: 'Visit photo' }}</div>
                    </button>
                </div>
                @endforeach
            </div>
            @else
            <div class="info-value" style="color: #6b7280;">No photos were uploaded for this visit.</div>
            @endif
        </div>
    </div>

    <div id="photoViewer" class="photo-viewer" aria-hidden="true">
        <div class="photo-viewer-content">
            <button type="button" class="viewer-close" onclick="closePhotoViewer()" aria-label="Close photo viewer">
                <i class="bi bi-x"></i>
            </button>
            <button type="button" class="viewer-btn prev" onclick="showPreviousPhoto()" aria-label="Previous photo">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button type="button" class="viewer-btn next" onclick="showNextPhoto()" aria-label="Next photo">
                <i class="bi bi-chevron-right"></i>
            </button>
            <img id="photoViewerImage" class="photo-viewer-image" src="" alt="Visit photo preview">
            <div class="photo-viewer-meta">
                <span id="photoViewerName"></span>
                <span id="photoViewerIndex"></span>
            </div>
        </div>
    </div>

    <script>
        const visitPhotos = [
            @foreach($visit->photos as $photo)
            {
                url: "{{ asset('storage/' . $photo->photo_path) }}",
                name: "{{ addslashes($photo->original_name ?: 'Visit photo') }}"
            },
            @endforeach
        ];

        let currentPhotoIndex = 0;

        function openPhotoViewer(index) {
            if (!visitPhotos.length) return;

            currentPhotoIndex = index;
            updatePhotoViewer();
            document.getElementById('photoViewer').classList.add('active');
            document.getElementById('photoViewer').setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closePhotoViewer() {
            const viewer = document.getElementById('photoViewer');
            viewer.classList.remove('active');
            viewer.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        function updatePhotoViewer() {
            const photo = visitPhotos[currentPhotoIndex];
            if (!photo) return;

            document.getElementById('photoViewerImage').src = photo.url;
            document.getElementById('photoViewerName').textContent = photo.name;
            document.getElementById('photoViewerIndex').textContent = `${currentPhotoIndex + 1} / ${visitPhotos.length}`;
        }

        function showNextPhoto() {
            if (!visitPhotos.length) return;
            currentPhotoIndex = (currentPhotoIndex + 1) % visitPhotos.length;
            updatePhotoViewer();
        }

        function showPreviousPhoto() {
            if (!visitPhotos.length) return;
            currentPhotoIndex = (currentPhotoIndex - 1 + visitPhotos.length) % visitPhotos.length;
            updatePhotoViewer();
        }

        document.getElementById('photoViewer').addEventListener('click', function (event) {
            if (event.target === this) {
                closePhotoViewer();
            }
        });

        document.addEventListener('keydown', function (event) {
            const viewerOpen = document.getElementById('photoViewer').classList.contains('active');
            if (!viewerOpen) return;

            if (event.key === 'Escape') {
                closePhotoViewer();
            } else if (event.key === 'ArrowRight') {
                showNextPhoto();
            } else if (event.key === 'ArrowLeft') {
                showPreviousPhoto();
            }
        });
    </script>
</body>
</html>

