<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($patient->pet_name ?? $patient->full_name); ?> - Pet Profile</title>
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap-icons/bootstrap-icons.min.css')); ?>">
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
<body>
    <!-- Main Content -->
    <div class="main-content">
        <?php if(session('success')): ?>
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i>
            <div><?php echo e(session('success')); ?></div>
        </div>
        <?php endif; ?>

        <!-- Back Button -->
        <div style="margin-bottom: 16px;">
            <a href="<?php echo e(route('patients.index')); ?>" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Back to Patients
            </a>
        </div>

        <!-- Pet Header -->
        <div class="pet-header">
            <div class="pet-header-info">
                <?php if($patient->pet_photo_path): ?>
                    <img src="<?php echo e(asset('storage/' . $patient->pet_photo_path)); ?>" alt="<?php echo e($patient->pet_name ?? $patient->full_name); ?>" class="pet-photo">
                <?php else: ?>
                    <div class="pet-icon-large">
                        <i class="bi bi-paw"></i>
                    </div>
                <?php endif; ?>
                <div class="pet-header-content">
                    <h1><?php echo e($patient->pet_name ?? $patient->full_name); ?></h1>
                    <p><?php echo e($patient->species ?? 'Unknown Species'); ?> • <?php echo e($patient->breed ?? 'Unknown Breed'); ?></p>
                </div>
            </div>
            <div class="pet-header-actions">
                <a href="<?php echo e(route('pets.edit', $patient)); ?>" class="btn-edit-pet">
                    <i class="bi bi-pencil-square"></i>
                    Edit Pet
                </a>
                <a href="<?php echo e(route('visits.create', ['patient_id' => $patient->id])); ?>" class="btn-action">
                    <i class="bi bi-plus-circle"></i>
                    Record Visit
                </a>
            </div>
        </div>

        <!-- Photo Gallery -->
        <?php
            $petPhotos = [];
            if ($patient->pet_photo_path) {
                $petPhotos[] = [
                    'path' => $patient->pet_photo_path,
                    'alt' => ($patient->pet_name ?? $patient->full_name) . ' - Main Photo'
                ];
            }
        ?>

        <?php if(!empty($petPhotos)): ?>
        <div class="photo-gallery-section">
            <div class="gallery-title">
                <i class="bi bi-images"></i>
                Pet Photos
            </div>
            <div class="gallery-grid">
                <?php $__currentLoopData = $petPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="gallery-item" onclick="openPhotoModal('<?php echo e(asset('storage/' . $photo['path'])); ?>')">
                    <img src="<?php echo e(asset('storage/' . $photo['path'])); ?>" alt="<?php echo e($photo['alt']); ?>">
                    <div class="gallery-item-icon">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

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
                    <span class="info-value"><?php echo e($patient->owner_name ?? 'Unknown'); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Contact</span>
                    <span class="info-value"><?php echo e($patient->owner_contact ?? 'Not provided'); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Address</span>
                    <span class="info-value"><?php echo e(Str::limit($patient->address ?? 'Unknown', 40)); ?></span>
                </div>
                <?php if($patient->email): ?>
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value"><?php echo e(Str::limit($patient->email, 35)); ?></span>
                </div>
                <?php endif; ?>
            </div>

            <div class="card">
                <div class="card-title">
                    <i class="bi bi-calendar3"></i>
                    Birth & Sex
                </div>
                <div class="info-item">
                    <span class="info-label">Date of Birth</span>
                    <span class="info-value"><?php echo e($patient->birthdate ? $patient->birthdate->format('M d, Y') : 'Unknown'); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Sex</span>
                    <span class="info-value"><?php echo e(ucfirst($patient->sex ?? 'Unknown')); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Age</span>
                    <span class="info-value"><?php echo e($patient->age ?? 'Unknown'); ?> years</span>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <i class="bi bi-palette"></i>
                    Appearance
                </div>
                <div class="info-item">
                    <span class="info-label">Color</span>
                    <span class="info-value"><?php echo e($patient->color ?? 'Unknown'); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Breed</span>
                    <span class="info-value"><?php echo e($patient->breed ?? 'Unknown'); ?></span>
                </div>
            </div>
        </div>

        <!-- Visit History -->
        <div class="section">
            <div class="section-title">
                <i class="bi bi-clipboard-check"></i>
                Visit History
            </div>

            <?php if($patient->visits->where('service_type', '!=', 'Vaccination')->isEmpty()): ?>
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>No visits recorded yet.</p>
                </div>
            <?php else: ?>
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
                            <?php $__currentLoopData = $patient->visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($visit->service_type !== 'Vaccination'): ?>
                            <tr onclick="window.location.href='<?php echo e(route('visits.show', $visit)); ?>'">
                                <td><?php echo e($visit->visit_date->format('M d, Y')); ?></td>
                                <td><span class="badge badge-success"><?php echo e($visit->service_type); ?></span></td>
                                <td><?php echo e($visit->health_worker ?? '-'); ?></td>
                                <td><?php echo e(Str::limit($visit->notes ?? '-', 50)); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
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
</body>
</html>
<?php /**PATH C:\Users\Lei\Capstone1-web\resources\views/pets/show.blade.php ENDPATH**/ ?>