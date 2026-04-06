<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About PAWSER - Pet Care Management System</title>
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
            color: rgba(255, 255, 255, 0.7);
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
        .intro-box {
            background: var(--surface-dark);
            border: 1px solid var(--surface-border);
            border-radius: 20px;
            max-width: 1000px;
            margin: 44px auto 0;
            box-shadow: 0 14px 34px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .hero-section {
            background: transparent;
            padding: 70px 24px 32px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-content h1 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
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

        /* Main Content */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 50px 24px 80px;
        }

        .container.container-flush {
            padding-left: 0;
            padding-right: 0;
        }

        .section {
            margin-bottom: 80px;
            background: var(--surface-dark);
            border: 1px solid var(--surface-border);
            border-radius: 18px;
            padding: 36px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.22);
        }

        .section.section-plain {
            margin-bottom: 0;
            background: transparent;
            border: none;
            border-radius: 0;
            box-shadow: none;
            padding-top: 8px;
            padding-bottom: 44px;
        }

        .section h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 30px;
            color: var(--text-main);
        }

        .section h2 span {
            background: linear-gradient(135deg, var(--accent-soft) 0%, #22d3ee 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section p {
            font-size: 16px;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .value-card {
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(126, 232, 223, 0.2);
            border-radius: 12px;
            padding: 32px;
            transition: all 0.3s ease;
        }

        .value-card:hover {
            border-color: var(--accent-soft);
            box-shadow: 0 12px 24px rgba(126, 232, 223, 0.18);
            transform: translateY(-4px);
        }

        .value-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(13, 148, 136, 0.22) 0%, rgba(20, 184, 166, 0.12) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: var(--accent-soft);
            margin-bottom: 20px;
        }

        .value-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--text-main);
        }

        .value-card p {
            font-size: 14px;
            color: var(--text-muted);
        }

        nav {
            animation: fadeIn 0.5s ease-out;
        }

        .intro-box {
            animation: fadeInUp 0.6s ease-out;
        }

        .container.container-flush .section {
            animation: fadeInUp 0.6s ease-out;
            animation-delay: 0.1s;
        }

        .value-card {
            animation: fadeInUp 0.5s ease-out;
        }

        .value-card:nth-child(1) { animation-delay: 0.14s; }
        .value-card:nth-child(2) { animation-delay: 0.2s; }
        .value-card:nth-child(3) { animation-delay: 0.26s; }
        .value-card:nth-child(4) { animation-delay: 0.32s; }
        .value-card:nth-child(5) { animation-delay: 0.38s; }
        .value-card:nth-child(6) { animation-delay: 0.44s; }

        @media (prefers-reduced-motion: reduce) {
            body {
                transition: none;
            }

            nav,
            .intro-box,
            .container.container-flush .section,
            .value-card {
                animation: none;
            }
        }




        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 32px;
            }

            .section h2 {
                font-size: 28px;
            }

            .nav-menu {
                display: none;
            }

            .container.container-flush {
                padding-left: 16px;
                padding-right: 16px;
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
                <a href="/about" class="active">About</a>
                <a href="/features">Features</a>
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

    <div class="intro-box">
        <!-- Hero -->
        <section class="hero-section">
            <div class="hero-content">
                <h1>About <span>PAWSER</span></h1>
                <p>Revolutionizing pet care management through innovative technology and compassionate service</p>
            </div>
        </section>

        <!-- Our Story -->
        <div class="container">
            <section class="section section-plain">
                <h2>About <span>PAWSER</span></h2>
                <p>PAWSER is an end-to-end pet care management system built to centralize clinic and grooming workflows. It combines appointment scheduling, pet records, visit tracking, notification handling, and operational dashboards in one secure platform.</p>
                <p>The system is designed for both staff and pet owners. Staff can manage daily operations, requests, and service history efficiently, while pet owners can book, track, and review their pets' records through a clear self-service portal.</p>
            </section>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container container-flush">
        <section class="section">
            <h2>System <span>Capabilities</span></h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-heart-fill"></i></div>
                    <h3>Centralized Pet Records</h3>
                    <p>Maintain complete and organized pet profiles, including service history, owner information, and relevant care details.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-shield-check"></i></div>
                    <h3>Role-Based Access</h3>
                    <p>Separate experiences for staff and pet owners to ensure secure access, clear permissions, and efficient task flows.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-lightbulb"></i></div>
                    <h3>Easy Scheduling</h3>
                    <p>Handle appointment requests, confirmations, and visit timelines with less manual follow-up and fewer booking conflicts.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-people-fill"></i></div>
                    <h3>Owner Self-Service</h3>
                    <p>Give pet owners direct visibility into appointments, pet information, and profile management through a simple interface.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-rocket-fill"></i></div>
                    <h3>Operational Insights</h3>
                    <p>Use dashboards and analytics views to monitor activity trends and improve daily clinic or salon performance.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-globe"></i></div>
                    <h3>Scalable Foundation</h3>
                    <p>Built to support growing teams and services with maintainable workflows, reusable components, and modern web architecture.</p>
                </div>
            </div>
        </section>

    </div>

</body>
</html>
