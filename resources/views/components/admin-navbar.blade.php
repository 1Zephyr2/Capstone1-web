<!-- Admin Navigation Bar -->
<style>
    :root {
        --app-font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    html,
    body {
        font-family: var(--app-font-family) !important;
    }

    body,
    input,
    select,
    textarea,
    button,
    table,
    th,
    td {
        font-family: var(--app-font-family) !important;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    a,
    label,
    small,
    strong,
    em,
    li,
    span {
        font-family: var(--app-font-family) !important;
    }

    .admin-navbar {
        background: #1e293b;
        color: white;
        padding: 0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 100;
        font-family: var(--app-font-family);
        display: flex;
        align-items: center;
        height: 72px;
        animation: adminFadeIn 0.5s ease-out;
    }

    @keyframes adminFadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .admin-navbar-container {
        display: grid;
        grid-template-columns: auto 1fr auto;
        align-items: center;
        width: 100%;
        padding: 0 24px;
        gap: 24px;
    }

    .admin-navbar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .admin-navbar-brand:hover {
        opacity: 0.8;
        transform: translateY(-2px);
    }

    .admin-navbar-logo {
        height: 40px;
        width: 40px;
        object-fit: contain;
    }

    .admin-navbar-brand-text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .admin-navbar-title {
        font-weight: 800;
        font-size: 16px;
        letter-spacing: -0.02em;
    }

    .admin-navbar-subtitle {
        font-weight: 600;
        font-size: 11px;
        opacity: 0.7;
    }

    .admin-navbar-menu {
        display: flex;
        gap: 4px;
        align-items: center;
        flex: 1;
        justify-content: center;
    }

    .admin-navbar-item {
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

    .admin-navbar-item:hover {
        opacity: 1;
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .admin-navbar-item.active {
        background: rgba(20, 184, 166, 0.2);
        color: #14b8a6;
        opacity: 1;
        font-weight: 600;
        border-bottom: 2px solid #14b8a6;
    }

    .admin-navbar-end {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-left: auto;
    }

    .admin-navbar-profile {
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

    .admin-navbar-profile:hover {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
    }

    .admin-navbar-avatar-img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
    }

    .admin-navbar-avatar-placeholder {
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

    .admin-navbar-user-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .admin-navbar-user-name {
        font-weight: 700;
        font-size: 13px;
        color: white;
    }

    .admin-navbar-user-role {
        font-weight: 500;
        font-size: 11px;
        opacity: 0.75;
        color: rgba(255, 255, 255, 0.9);
    }

    .admin-navbar-logout-btn {
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

    .admin-navbar-logout-btn:hover {
        background: rgba(239, 68, 68, 0.3);
        border-color: rgba(239, 68, 68, 0.6);
        transform: translateY(-2px);
        color: #fecaca;
    }

    @media (max-width: 768px) {
        .admin-navbar-menu {
            gap: 4px;
        }

        .admin-navbar-item {
            padding: 6px 10px;
            font-size: 12px;
            gap: 4px;
        }

        .admin-navbar-item span {
            display: none;
        }

        .admin-navbar-container {
            padding: 0 12px;
            gap: 12px;
        }

        .admin-navbar-item i {
            font-size: 18px;
        }

        .admin-navbar-user-info {
            display: none;
        }

        .admin-navbar-profile {
            padding: 8px;
            background: transparent;
            border: none;
        }

        .admin-navbar-profile:hover {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
    }
</style>

<nav class="admin-navbar">
    <div class="admin-navbar-container">
        <a href="{{ route('admin.dashboard') }}" class="admin-navbar-brand">
            <img src="{{ asset('newlogo.png') }}" alt="FURCARE" class="admin-navbar-logo" onerror="this.style.display='none'">
            <div class="admin-navbar-brand-text">
                <p class="admin-navbar-title">FURCARE</p>
                <p class="admin-navbar-subtitle">Admin Panel</p>
            </div>
        </a>

        <div class="admin-navbar-menu">
            <a href="{{ route('admin.dashboard') }}" class="admin-navbar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="admin-navbar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Users</span>
            </a>
            <a href="{{ route('admin.settings') }}" class="admin-navbar-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </div>

        <div class="admin-navbar-end">
            <a href="{{ route('profile.show') }}" class="admin-navbar-profile">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="admin-navbar-avatar-img">
                @else
                    <div class="admin-navbar-avatar-placeholder">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div class="admin-navbar-user-info">
                    <div class="admin-navbar-user-name">{{ Auth::user()->name }}</div>
                    <div class="admin-navbar-user-role">Administrator</div>
                </div>
            </a>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="admin-navbar-logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</nav>

