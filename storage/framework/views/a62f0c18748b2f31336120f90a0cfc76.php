<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - PAWSER</title>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar i.bi {
            font-family: bootstrap-icons;
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
            flex-shrink: 0;
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
            transform: translateY(-2px);
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

        /* Notification Bell Styles */
        .notification-bell-wrapper {
            position: relative;
        }

        .notification-bell {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .notification-bell:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .notification-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            border: 2px solid #1e293b;
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            min-width: 350px;
            max-height: 450px;
            overflow-y: auto;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            margin-top: 8px;
        }

        .notification-dropdown.active {
            display: block;
        }

        .notification-header {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #111827;
            font-weight: 600;
            font-size: 14px;
        }

        .notification-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f3f4f6;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            gap: 12px;
            color: #666;
        }

        .notification-item:hover {
            background: #f9fafb;
        }

        .notification-item.unread {
            background: #f0fdf4;
        }

        .notification-item-icon {
            flex-shrink: 0;
            font-size: 18px;
        }

        .notification-item-content {
            flex: 1;
        }

        .notification-item-title {
            color: #111827;
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 2px;
        }

        .notification-item-message {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .notification-item-time {
            font-size: 11px;
            color: #9ca3af;
        }

        .notification-empty {
            padding: 40px 20px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        .notification-footer {
            padding: 12px 16px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }

        .notification-footer a {
            color: #14b8a6;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .notification-footer a:hover {
            text-decoration: underline;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar {
            animation: fadeIn 0.5s ease-out;
        }

        .back-link {
            animation: fadeInUp 0.5s ease-out;
        }

        .page-header {
            animation: fadeInUp 0.6s ease-out;
        }

        .card {
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        /* Hide top-nav white bar */
        .top-nav {
            display: none !important;
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
            <a href="<?php echo e(route('dashboard')); ?>" class="navbar-brand">
                <img src="<?php echo e(asset('newlogo.png')); ?>" alt="PAWSER" class="navbar-logo" onerror="this.style.display='none'">
                <span class="navbar-title">PAWSER</span>
            </a>

            <div class="navbar-center">
                <a href="<?php echo e(route('dashboard')); ?>" class="nav-item active">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
                <a href="<?php echo e(route('pets.index')); ?>" class="nav-item">
                    <i class="bi bi-heart-fill"></i>
                    Pets
                </a>
                <a href="<?php echo e(route('appointments.index')); ?>" class="nav-item">
                    <i class="bi bi-calendar-check"></i>
                    Appointments
                </a>
                <a href="<?php echo e(route('visits.today')); ?>" class="nav-item">
                    <i class="bi bi-clock-history"></i>
                    Visits
                </a>
                <?php if(Auth::user()->hasStaffAccess()): ?>
                <a href="<?php echo e(route('analytics.index')); ?>" class="nav-item">
                    <i class="bi bi-graph-up-arrow"></i>
                    Insights
                </a>
                <a href="<?php echo e(route('automation.support')); ?>" class="nav-item">
                    <i class="bi bi-cpu"></i>
                    Actions
                </a>
                <?php endif; ?>
            </div>

            <div class="navbar-end">
                <!-- Notification Bell -->
                <div class="notification-bell-wrapper">
                    <button class="notification-bell" onclick="toggleNotifications()" title="Notifications">
                        <i class="bi bi-bell"></i>
                        <?php
                            $unreadCount = auth()->user()->unreadNotifications()->count();
                        ?>
                        <?php if($unreadCount > 0): ?>
                            <span class="notification-badge"><?php echo e(min($unreadCount, 9)); ?></span>
                        <?php endif; ?>
                    </button>

                    <!-- Notification Dropdown -->
                    <div class="notification-dropdown" id="notificationDropdown">
                        <div class="notification-header">
                            <span>Notifications</span>
                            <?php if($unreadCount > 0): ?>
                                <button onclick="markAllAsRead()" style="background: rgba(255,255,255,0.2); border: none; color: white; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-size: 11px;">Mark all as read</button>
                            <?php endif; ?>
                        </div>

                        <?php
                            $notifications = auth()->user()->notifications()->orderBy('created_at', 'desc')->limit(8)->get();
                        ?>

                        <?php if($notifications->count() > 0): ?>
                            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="notification-item <?php echo e($notification->isUnread() ? 'unread' : ''); ?>" onclick="notificationClick(<?php echo e($notification->id); ?>)">
                                    <div class="notification-item-icon">
                                        <?php if($notification->type == 'request_approved'): ?>
                                            <i class="bi bi-check-circle-fill" style="color: #10b981;"></i>
                                        <?php elseif($notification->type == 'request_rejected'): ?>
                                            <i class="bi bi-x-circle-fill" style="color: #ef4444;"></i>
                                        <?php else: ?>
                                            <i class="bi bi-info-circle-fill"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="notification-item-content">
                                        <div class="notification-item-title"><?php echo e($notification->title); ?></div>
                                        <div class="notification-item-message"><?php echo e(Str::limit($notification->message, 80)); ?></div>
                                        <div class="notification-item-time"><?php echo e($notification->created_at->diffForHumans()); ?></div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="notification-empty">
                                <p><i class="bi bi-inbox" style="font-size: 24px; display: block; margin-bottom: 8px;"></i>No notifications yet</p>
                            </div>
                        <?php endif; ?>

                        <?php if($notifications->count() > 0): ?>
                            <div class="notification-footer">
                                <a href="<?php echo e(route('notifications')); ?>">View All Notifications →</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <script>
                        function toggleNotifications() {
                            const dropdown = document.getElementById('notificationDropdown');
                            dropdown.classList.toggle('active');
                        }

                        function markAllAsRead() {
                            fetch('<?php echo e(route("notifications.mark-all-read")); ?>', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                }
                            }).then(() => {
                                location.reload();
                            });
                        }

                        function notificationClick(id) {
                            fetch(`<?php echo e(url('notifications')); ?>/${id}/read`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                }
                            }).then(res => res.json()).then(data => {
                                if(data.redirect) {
                                    window.location.href = data.redirect;
                                }
                            });
                        }

                        document.addEventListener('click', function(event) {
                            const wrapper = document.querySelector('.notification-bell-wrapper');
                            const dropdown = document.getElementById('notificationDropdown');

                            if (wrapper && dropdown && !wrapper.contains(event.target)) {
                                dropdown.classList.remove('active');
                            }
                        });

                        document.addEventListener('keydown', function(event) {
                            if (event.key === 'Escape') {
                                const dropdown = document.getElementById('notificationDropdown');
                                if (dropdown) {
                                    dropdown.classList.remove('active');
                                }
                            }
                        });
                    </script>
                </div>

                <div class="user-avatar">
                    <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                </div>
                <form method="POST" action="<?php echo e(route('logout')); ?>" style="display: inline;">
                    <?php echo csrf_field(); ?>
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
        <a href="<?php echo e(route('dashboard')); ?>" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>

        <div class="page-header">
            <h1 class="page-title">
                My Profile
            </h1>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                <div><?php echo e(session('success')); ?></div>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="profile-head">
                <div class="profile-picture-wrapper" onclick="document.getElementById('profilePictureModal').style.display='flex'">
                    <?php if($user->profile_picture): ?>
                        <img src="<?php echo e(asset('storage/' . $user->profile_picture)); ?>" alt="<?php echo e($user->name); ?>" class="profile-picture">
                    <?php else: ?>
                        <div class="profile-picture-placeholder">
                            <?php echo e(substr($user->name, 0, 1)); ?>

                        </div>
                    <?php endif; ?>
                    <div class="profile-picture-overlay">
                    </div>
                </div>
                <div class="profile-info">
                    <div class="profile-name"><?php echo e($user->name); ?></div>
                    <div class="profile-role"><?php echo e($user->role === 'admin' ? 'Administrator' : 'Veterinary Staff'); ?></div>
                    <div class="profile-status">
                        <i class="bi bi-check-circle-fill"></i>
                        Account Active
                    </div>
                </div>
            </div>

            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Email Address</div>
                    <div class="detail-value"><?php echo e($user->email); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Phone Number</div>
                    <div class="detail-value"><?php echo e($user->phone); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Member Since</div>
                    <div class="detail-value"><?php echo e($user->created_at->format('M d, Y')); ?></div>
                </div>
            </div>

            <div class="buttons">
                <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-cancel">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-primary">
                    Edit Profile
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

            <?php if($user->profile_picture): ?>
            <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #e5e7eb; text-align: center;">
                <form action="<?php echo e(route('profile.delete-picture')); ?>" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 14px; font-weight: 600; text-decoration: underline;">Remove current picture</button>
                </form>
            </div>
            <?php endif; ?>
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
            formData.append('_token', '<?php echo e(csrf_token()); ?>');

            fetch('<?php echo e(route("profile.update")); ?>', {
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
<?php /**PATH C:\Users\keeia\OneDrive\Documents\Capstone1-web-mayerror\capstone\resources\views/profile/show.blade.php ENDPATH**/ ?>