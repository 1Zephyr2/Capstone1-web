<!-- Staff Navigation Bar -->
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
            <div class="navbar-user">
                <?php if(Auth::user()->profile_picture): ?>
                    <div class="navbar-avatar">
                        <img src="<?php echo e(asset('storage/' . Auth::user()->profile_picture)); ?>" alt="<?php echo e(Auth::user()->name); ?>">
                    </div>
                <?php else: ?>
                    <div class="navbar-avatar">
                        <i class="bi bi-person-fill" style="font-size: 18px;"></i>
                    </div>
                <?php endif; ?>
                <div class="navbar-user-text">
                    <div class="navbar-user-name"><?php echo e(Auth::user()->name); ?></div>
                    <div class="navbar-user-role"><?php echo e(Auth::user()->role_name ?? ucfirst(Auth::user()->role)); ?></div>
                </div>
            </div>
            <a href="<?php echo e(route('profile.show')); ?>" class="navbar-profile-btn" title="My Profile">
                <i class="bi bi-person-circle"></i>
            </a>
            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="navbar-logout-btn" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</nav>
<?php /**PATH C:\Users\Lei\Capstone1-web\resources\views/components/staff-navbar.blade.php ENDPATH**/ ?>