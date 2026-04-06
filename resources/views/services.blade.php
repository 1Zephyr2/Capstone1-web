<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features - PAWSER Pet Care Management</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --page-bg-start: #969696;
            --page-bg-end: #b0b0b0;
            --surface-dark: rgba(31, 41, 55, 0.82);
            --surface-darker: rgba(15, 23, 42, 0.74);
            --surface-border: rgba(126, 232, 223, 0.22);
            --text-main: #e2e8f0;
            --text-muted: #cbd5e1;
            --accent-start: #0f766e;
            --accent-end: #06b6d4;
            --accent-soft: #7ee8df;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--page-bg-start) 0%, var(--page-bg-end) 100%);
            color: #1e293b;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        /* Navigation */
        nav {
            background: #1e293b;
            border-bottom: 1px solid rgba(20, 184, 166, 0.2);
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
            color: white;
            transition: opacity 0.3s ease;
        }

        .nav-brand:hover {
            opacity: 0.8;
        }

        .nav-logo {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            object-fit: contain;
        }

        .nav-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .nav-menu {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: #cbd5e1;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 8px 14px;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }

        .nav-menu a:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateY(-2px);
        }

        .nav-menu a.active {
            background: rgba(20, 184, 166, 0.15);
            color: #14b8a6;
            border-bottom: 2px solid #14b8a6;
        }

        .nav-cta {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-login {
            padding: 8px 20px;
            border: 1px solid #14b8a6;
            color: #14b8a6;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: rgba(20, 184, 166, 0.1);
        }

        .btn-primary {
            padding: 8px 20px;
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(20, 184, 166, 0.2);
        }

        /* Hero */
        .hero-section {
            background: var(--surface-dark);
            padding: 120px 24px;
            text-align: center;
            border: 1px solid var(--surface-border);
            backdrop-filter: blur(10px);
            border-radius: 22px;
            max-width: 1260px;
            margin: 36px auto 0;
            box-shadow: 0 16px 38px rgba(0, 0, 0, 0.25);
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-content h1 {
            font-size: 56px;
            font-weight: 800;
            margin-bottom: 30px;
            color: var(--text-main);
        }

        .hero-content h1 span {
            background: linear-gradient(135deg, var(--accent-soft) 0%, #22d3ee 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-content p {
            font-size: 18px;
            color: var(--text-muted);
            line-height: 1.8;
        }

        /* Container */
        .container {
            max-width: 1260px;
            margin: 0 auto;
            padding: 90px 16px 120px;
        }

        .section-title {
            font-size: 42px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 60px;
            color: var(--text-main);
        }

        .section-title span {
            background: linear-gradient(135deg, var(--accent-soft) 0%, #22d3ee 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-muted);
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto 60px;
            line-height: 1.8;
        }

        .features-shell {
            background: var(--surface-dark);
            border: 1px solid var(--surface-border);
            border-radius: 18px;
            padding: 48px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.22);
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 30px;
            margin-bottom: 0;
        }

        .service-card {
            background: var(--surface-dark);
            border: 1px solid var(--surface-border);
            border-radius: 12px;
            padding: 40px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.2);
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-start) 0%, var(--accent-end) 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            border-color: var(--accent-soft);
            box-shadow: 0 20px 40px rgba(126, 232, 223, 0.18);
            transform: translateY(-6px);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(13, 148, 136, 0.24) 0%, rgba(20, 184, 166, 0.14) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: var(--accent-soft);
            margin-bottom: 30px;
        }

        .service-card h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-main);
        }

        .service-card p {
            font-size: 15px;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 0;
        }

        nav {
            animation: fadeIn 0.5s ease-out;
        }

        .hero-section {
            animation: fadeInUp 0.6s ease-out;
        }

        .features-shell {
            animation: fadeInUp 0.6s ease-out;
            animation-delay: 0.1s;
        }

        .service-card {
            animation: fadeInUp 0.5s ease-out;
        }

        .service-card:nth-child(1) { animation-delay: 0.14s; }
        .service-card:nth-child(2) { animation-delay: 0.2s; }
        .service-card:nth-child(3) { animation-delay: 0.26s; }
        .service-card:nth-child(4) { animation-delay: 0.32s; }

        @media (prefers-reduced-motion: reduce) {
            body {
                transition: none;
            }

            nav,
            .hero-section,
            .features-shell,
            .service-card {
                animation: none;
            }
        }

        @media (max-width: 1180px) {
            .services-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .features-shell {
                padding: 40px;
            }
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 32px;
            }

            .section-title {
                font-size: 32px;
            }

            .nav-menu {
                display: none;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .features-shell {
                padding: 28px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-brand">
                <div class="nav-logo">
                    @if (file_exists(public_path('newlogo.png')))
                        <img src="{{ asset('newlogo.png') }}" alt="PAWSER Logo">
                    @else
                        <i class="bi bi-paw-fill"></i>
                    @endif
                </div>
                PAWSER
            </a>
            <div class="nav-menu">
                <a href="{{ route('home') }}">Home</a>
                <a href="/about">About</a>
                <a href="/features" class="active">Features</a>
            </div>
            <div class="nav-cta">
                @auth
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn-primary" style="border: none; cursor: pointer;">
                            Logout
                        </button>
                    </form>
                    <a href="/dashboard" class="btn-login">Dashboard</a>
                @else
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero-section">
        <div class="hero-content">
            <h1>Powerful <span>Features</span> of PAWSER</h1>
            <p>A comprehensive pet care management system with intelligent scheduling, service tracking, team coordination, and complete client communication tools.</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <!-- Features Overview -->
        <section class="features-shell">
            <h2 class="section-title">System <span>Features</span></h2>
            <p class="section-subtitle">These are the core features of PAWSER.</p>

            <div class="services-grid">
                <!-- Service 1 -->
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-calendar-event"></i></div>
                    <h3>Easy Appointments</h3>
                    <p>Quick booking and instant confirmations for smooth daily scheduling.</p>
                </div>

                <!-- Service 2 -->
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-scissors"></i></div>
                    <h3>Service Tracking</h3>
                    <p>Complete service history to help staff review each pet's past care.</p>
                </div>

                <!-- Service 3 -->
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-people"></i></div>
                    <h3>Team Management</h3>
                    <p>Organize staff and schedules effortlessly with role-based workflows.</p>
                </div>

                <!-- Service 4 -->
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-chat-dots"></i></div>
                    <h3>Client Communication</h3>
                    <p>Stay connected with your customers through clear updates and notifications.</p>
                </div>
            </div>
        </section>

    </div>

</body>
</html>
