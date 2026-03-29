<!-- Staff Navigation Bar -->
<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('dashboard') }}" class="navbar-brand">
            <img src="{{ asset('newlogo.png') }}" alt="PAWser" class="navbar-logo" onerror="this.style.display='none'">
            <div class="navbar-brand-text">
                <p class="navbar-title">PAWser</p>
                <p class="navbar-subtitle">Staff Dashboard</p>
            </div>
        </a>
        <div class="navbar-menu">
            <a href="{{ route('dashboard') }}" class="navbar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pets.index') }}" class="navbar-item {{ request()->routeIs('pets.*') ? 'active' : '' }}">
                <i class="bi bi-heart-fill"></i>
                <span>Pets</span>
            </a>
            <a href="{{ route('appointments.index') }}" class="navbar-item {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check"></i>
                <span>Appointments</span>
            </a>
            @if(Auth::user()->hasStaffAccess())
            <a href="{{ route('appointment-requests.index') }}" class="navbar-item {{ request()->routeIs('appointment-requests.*') ? 'active' : '' }}">
                <i class="bi bi-inbox-fill"></i>
                <span>Requests</span>
            </a>
            @endif
            <a href="{{ route('visits.today') }}" class="navbar-item {{ request()->routeIs('visits.*') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>
                <span>Visits</span>
            </a>
            @if(Auth::user()->hasStaffAccess())
            <a href="{{ route('analytics.index') }}" class="navbar-item {{ request()->routeIs('analytics.*') ? 'active' : '' }}">
                <i class="bi bi-graph-up-arrow"></i>
                <span>Insights</span>
            </a>
            <a href="{{ route('automation.support') }}" class="navbar-item {{ request()->routeIs('automation.*') ? 'active' : '' }}">
                <i class="bi bi-cpu"></i>
                <span>Actions</span>
            </a>
            @endif
        </div>
        <div class="navbar-end">
            <div class="navbar-user">
                @if(Auth::user()->profile_picture)
                    <div class="navbar-avatar">
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}">
                    </div>
                @else
                    <div class="navbar-avatar">
                        <i class="bi bi-person-fill" style="font-size: 18px;"></i>
                    </div>
                @endif
                <div class="navbar-user-text">
                    <div class="navbar-user-name">{{ Auth::user()->name }}</div>
                    <div class="navbar-user-role">{{ Auth::user()->role_name ?? ucfirst(Auth::user()->role) }}</div>
                </div>
            </div>
            <a href="{{ route('profile.show') }}" class="navbar-profile-btn" title="My Profile">
                <i class="bi bi-person-circle"></i>
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="navbar-logout-btn" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</nav>
