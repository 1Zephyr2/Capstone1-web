<!-- Staff Navigation Bar -->
<style>
    /* Navbar Styles */
    .navbar {
        background: #1e293b;
        color: white;
        padding: 0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 100;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .navbar-brand:hover {
        opacity: 0.8;
        transform: translateY(-2px);
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
        font-weight: 800;
        font-size: 16px;
        letter-spacing: -0.02em;
    }

    .navbar-subtitle {
        font-weight: 600;
        font-size: 11px;
        opacity: 0.7;
    }

    .navbar-menu {
        display: flex;
        gap: 4px;
        align-items: center;
        flex: 1;
    }

    .navbar-item {
        padding: 8px 12px;
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        border-radius: 6px;
        transition: all 0.2s ease;
        font-size: 13px;
        font-weight: 500;
        opacity: 0.8;
    }

    .navbar-item:hover {
        opacity: 1;
        background: rgba(255, 255, 255, 0.1);
    }

    .navbar-item.active {
        background: rgba(20, 184, 166, 0.2);
        color: #5eead4;
        opacity: 1;
        font-weight: 600;
    }

    .navbar-end {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-left: auto;
    }

    .navbar-profile-section {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        background: transparent;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        color: white;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .navbar-profile-section:hover {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
    }

    .navbar-avatar-img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
    }

    .navbar-avatar-placeholder {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        color: white;
        flex-shrink: 0;
    }

    .navbar-user-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .navbar-user-name {
        font-weight: 700;
        font-size: 13px;
        color: white;
    }

    .navbar-user-role {
        font-weight: 500;
        font-size: 11px;
        opacity: 0.75;
        color: rgba(255, 255, 255, 0.9);
    }

    .navbar-logout-btn {
        padding: 8px 11px;
        background: rgba(239, 68, 68, 0.2);
        border: 1px solid rgba(239, 68, 68, 0.4);
        color: #fca5a5;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .navbar-logout-btn:hover {
        background: rgba(239, 68, 68, 0.3);
        border-color: rgba(239, 68, 68, 0.6);
        transform: translateY(-2px);
        color: #fecaca;
    }

    @media (max-width: 768px) {
        .navbar-menu {
            gap: 4px;
        }

        .navbar-item {
            padding: 6px 10px;
            font-size: 12px;
            gap: 4px;
        }

        .navbar-item span {
            display: none;
        }

        .navbar-container {
            padding: 0 12px;
            gap: 12px;
        }

        .navbar-item i {
            font-size: 18px;
        }

        .navbar-user-info {
            display: none;
        }

        .navbar-profile-section {
            padding: 8px;
            background: transparent;
            border: none;
        }

        .navbar-profile-section:hover {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
    }
</style>

<nav class="navbar">
    <div class="navbar-container">
        <a href="<?php echo e(route('dashboard')); ?>" class="navbar-brand">
            <img src="<?php echo e(asset('newlogo.png')); ?>" alt="PAWser" class="navbar-logo" onerror="this.style.display='none'">
            <div class="navbar-brand-text">
                <p class="navbar-title">PAWser</p>
                <p class="navbar-subtitle">Staff Dashboard</p>
            </div>
        </a>
        <div class="navbar-menu">
            <a href="<?php echo e(route('dashboard')); ?>" class="navbar-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo e(route('pets.index')); ?>" class="navbar-item <?php echo e(request()->routeIs('pets.*') ? 'active' : ''); ?>">
                <i class="bi bi-heart-fill"></i>
                <span>Pets</span>
            </a>
            <a href="<?php echo e(route('appointments.index')); ?>" class="navbar-item <?php echo e(request()->routeIs('appointments.*') ? 'active' : ''); ?>">
                <i class="bi bi-calendar-check"></i>
                <span>Appointments</span>
            </a>
            <?php if(Auth::user()->hasStaffAccess()): ?>
            <a href="<?php echo e(route('appointment-requests.index')); ?>" class="navbar-item <?php echo e(request()->routeIs('appointment-requests.*') ? 'active' : ''); ?>">
                <i class="bi bi-inbox-fill"></i>
                <span>Requests</span>
            </a>
            <?php endif; ?>
            <a href="<?php echo e(route('visits.today')); ?>" class="navbar-item <?php echo e(request()->routeIs('visits.*') ? 'active' : ''); ?>">
                <i class="bi bi-clock-history"></i>
                <span>Visits</span>
            </a>
            <?php if(Auth::user()->hasStaffAccess()): ?>
            <a href="<?php echo e(route('analytics.index')); ?>" class="navbar-item <?php echo e(request()->routeIs('analytics.*') ? 'active' : ''); ?>">
                <i class="bi bi-graph-up-arrow"></i>
                <span>Insights</span>
            </a>
            <a href="<?php echo e(route('automation.support')); ?>" class="navbar-item <?php echo e(request()->routeIs('automation.*') ? 'active' : ''); ?>">
                <i class="bi bi-cpu"></i>
                <span>Actions</span>
            </a>
            <?php endif; ?>
        </div>
        <div class="navbar-end">
            <a href="<?php echo e(route('profile.show')); ?>" class="navbar-profile-section">
                <?php if(Auth::user()->profile_picture): ?>
                    <img src="<?php echo e(asset('storage/' . Auth::user()->profile_picture)); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="navbar-avatar-img">
                <?php else: ?>
                    <div class="navbar-avatar-placeholder">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                    </div>
                <?php endif; ?>
                <div class="navbar-user-info">
                    <div class="navbar-user-name"><?php echo e(Auth::user()->name); ?></div>
                    <div class="navbar-user-role"><?php echo e(Auth::user()->role_name ?? ucfirst(Auth::user()->role)); ?></div>
                </div>
            </a>
            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="navbar-logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</nav>
<?php /**PATH C:\Users\Lei\Capstone1-web\resources\views/components/staff-navbar.blade.php ENDPATH**/ ?>