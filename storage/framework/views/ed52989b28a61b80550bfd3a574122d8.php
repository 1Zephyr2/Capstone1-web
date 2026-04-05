<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pet->pet_name ?? 'Pet Details'); ?> - PAWSER</title>
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

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
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

        /* Hide top-nav white bar */
        .top-nav {
            display: none !important;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
            padding: 40px 24px;
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
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #0d9488;
            border-color: #14b8a6;
            background: #f0fdf4;
        }

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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
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

        .card-content {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
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

        @media (max-width: 768px) {
            .navbar-center {
                display: none;
            }

            .main-content {
                padding: 20px 16px;
            }

            .pet-header {
                flex-direction: column;
                text-align: center;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="<?php echo e(route('customer.dashboard')); ?>" class="navbar-brand">
                <img src="<?php echo e(asset('newlogo.png')); ?>" alt="PAWSER" class="navbar-logo" onerror="this.style.display='none'">
                <span class="navbar-title">PAWSER</span>
            </a>
            <div class="navbar-center">
                <a href="<?php echo e(route('customer.dashboard')); ?>" class="nav-item">
                    <i class="bi bi-house"></i>
                    Dashboard
                </a>
                <a href="<?php echo e(route('customer.pets.index')); ?>" class="nav-item active">
                    <i class="bi bi-paw"></i>
                    My Pets
                </a>
                <a href="<?php echo e(route('customer.appointments.index')); ?>" class="nav-item">
                    <i class="bi bi-calendar-check"></i>
                    Appointments
                </a>
            </div>
            <div class="navbar-end">
                <div class="user-menu">
                    <a href="<?php echo e(route('profile.show')); ?>" class="user-avatar" style="text-decoration: none;" title="View Profile">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                    </a>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin: 0;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="logout-btn">
                            <i class="bi bi-box-arrow-left"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <a href="<?php echo e(route('customer.pets.index')); ?>" class="back-link">
            <i class="bi bi-arrow-left"></i>
            Back to Pets
        </a>

        <!-- Pet Header -->
        <div class="pet-header">
            <div class="pet-header-info">
                <div class="pet-icon-large" style="font-size: 60px;">
                    <i class="bi bi-paw"></i>
                </div>
                <div class="pet-header-content">
                    <h1><?php echo e($pet->pet_name); ?></h1>
                    <p><?php echo e($pet->species ?? 'Unknown Species'); ?> • <?php echo e($pet->breed ?? 'Unknown Breed'); ?></p>
                </div>
            </div>
            <div class="pet-header-actions">
                <a href="<?php echo e(route('customer.pets.edit', $pet)); ?>" class="btn-edit-pet">
                    <i class="bi bi-pencil-square"></i>
                    Edit Pet
                </a>
            </div>
        </div>

        <!-- Quick Info Cards -->
        <div class="cards-grid">
            <div class="card">
                <div class="card-title">
                    <i class="bi bi-calendar3"></i>
                    Birth & Sex
                </div>
                <div class="info-item">
                    <span class="info-label">Date of Birth</span>
                    <span class="info-value"><?php echo e($pet->birthdate ? $pet->birthdate->format('M d, Y') : 'Unknown'); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Sex</span>
                    <span class="info-value"><?php echo e(ucfirst($pet->sex ?? 'Unknown')); ?></span>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <i class="bi bi-palette"></i>
                    Appearance
                </div>
                <div class="info-item">
                    <span class="info-label">Color</span>
                    <span class="info-value"><?php echo e($pet->color ?? 'Unknown'); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Breed</span>
                    <span class="info-value"><?php echo e($pet->breed ?? 'Unknown'); ?></span>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <i class="bi bi-info-circle"></i>
                    Owner Info
                </div>
                <div class="info-item">
                    <span class="info-label">Owner</span>
                    <span class="info-value"><?php echo e($pet->owner_name ?? 'Unknown'); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Contact</span>
                    <span class="info-value"><?php echo e($pet->owner_contact ?? 'Unknown'); ?></span>
                </div>
            </div>
        </div>

        <!-- Visits -->
        <div class="section">
            <div class="section-title">
                <i class="bi bi-clipboard-check"></i>
                Visits
            </div>

            <?php if($pet->visits->isEmpty()): ?>
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>No visits recorded yet.</p>
                </div>
            <?php else: ?>
                <div class="records-list">
                    <?php $__currentLoopData = $pet->visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="record-item">
                            <div class="record-title"><?php echo e($visit->reason ?? 'Visit'); ?></div>
                            <div class="record-info">
                                <i class="bi bi-calendar-event"></i>
                                <?php echo e($visit->visit_date->format('M d, Y')); ?>

                                <?php if($visit->notes): ?>
                                    • <?php echo e(substr($visit->notes, 0, 50)); ?><?php echo e(strlen($visit->notes) > 50 ? '...' : ''); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Appointments -->
        <div class="section">
            <div class="section-title">
                <i class="bi bi-calendar-check"></i>
                Upcoming Appointments
            </div>

            <?php if($pet->appointments->isEmpty()): ?>
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>No upcoming appointments.</p>
                </div>
            <?php else: ?>
                <div class="records-list">
                    <?php $__currentLoopData = $pet->appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="record-item">
                            <div class="record-title"><?php echo e($appointment->reason ?? 'Appointment'); ?></div>
                            <div class="record-info">
                                <i class="bi bi-calendar-event"></i>
                                <?php echo e($appointment->appointment_date->format('M d, Y \a\t g:i A')); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Referrals -->
        <?php if(!$pet->referrals->isEmpty()): ?>
            <div class="section">
                <div class="section-title">
                    <i class="bi bi-arrow-up-right-square"></i>
                    Referrals
                </div>

                <div class="records-list">
                    <?php $__currentLoopData = $pet->referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="record-item">
                            <div class="record-title"><?php echo e($referral->reason ?? 'Referral'); ?></div>
                            <div class="record-info">
                                <i class="bi bi-calendar-event"></i>
                                <?php echo e($referral->referral_date->format('M d, Y')); ?>

                                <?php if($referral->referred_to): ?>
                                    • Referred to: <?php echo e($referral->referred_to); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php /**PATH C:\Users\keeia\OneDrive\Documents\Capstone1-web-mayerror\capstone\resources\views/customer/pets/show.blade.php ENDPATH**/ ?>