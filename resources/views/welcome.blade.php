<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAWSER - Pet Care Management System</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #969696 0%, #b0b0b0 100%);
            color: #1e293b;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navigation */
        nav {
            background: #1e293b;
            border-bottom: 1px solid rgba(20, 184, 166, 0.2);
            padding: 16px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .nav-container {
            max-width: 1400px;
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

        .signup-link {
            text-align: center;
            font-size: 14px;
            color: #cbd5e1;
            margin-top: 12px;
        }

        .signup-link a {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 600;
            transition: opacity 0.3s ease;
        }

        .signup-link a:hover {
            opacity: 0.8;
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

        nav {
            animation: fadeIn 0.5s ease-out;
        }

        .hero-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .feature-item {
            animation: fadeInUp 0.5s ease-out;
        }

        .feature-item:nth-child(1) { animation-delay: 0.1s; }
        .feature-item:nth-child(2) { animation-delay: 0.2s; }
        .feature-item:nth-child(3) { animation-delay: 0.3s; }
        .feature-item:nth-child(4) { animation-delay: 0.4s; }

        .login-options {
            animation: fadeInUp 0.6s ease-out 0.3s both;
        }

        /* Main Content */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }

        /* Hero Card */
        .hero-card {
            background: rgba(31, 41, 55, 0.8);
            border-radius: 24px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            padding: 60px;
            max-width: 1200px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            border: 1px solid rgba(126, 232, 223, 0.2);
            backdrop-filter: blur(10px);
        }

        .hero-left {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .hero-title {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.2;
            color: #e2e8f0;
        }

        .hero-title span {
            background: linear-gradient(135deg, #7ee8df 0%, #22d3ee 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 16px;
            color: #cbd5e1;
            line-height: 1.8;
        }

        .login-options {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-top: 20px;
        }

        .login-btn {
            padding: 16px 32px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .login-btn.pet-owner {
            background: linear-gradient(135deg, #0f766e 0%, #06b6d4 100%);
            color: white;
        }

        .login-btn.pet-owner:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(126, 232, 223, 0.35);
        }

        .login-btn.staff {
            border: 2px solid #7ee8df;
            color: #7ee8df;
            background: transparent;
        }

        .login-btn.staff:hover {
            background: rgba(126, 232, 223, 0.15);
        }

        .learn-more {
            display: inline-block;
            margin-top: 10px;
            color: #7ee8df;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: opacity 0.3s ease;
        }

        .learn-more:hover {
            opacity: 0.8;
        }

        /* Hero Right - Visual */
        .hero-right {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .illustration-box {
            width: 100%;
            height: 380px;
            background: linear-gradient(135deg, rgba(13, 148, 136, 0.15) 0%, rgba(20, 184, 166, 0.1) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(126, 232, 223, 0.2);
        }

        .logo-container {
            width: 380px;
            height: 380px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: drop-shadow(0 4px 12px rgba(13, 148, 136, 0.15));
        }

        .shape-decoration {
            position: absolute;
            border-radius: 50%;
            opacity: 0.15;
        }

        .shape-lg {
            width: 280px;
            height: 280px;
            background: linear-gradient(135deg, #7ee8df 0%, #22d3ee 100%);
            top: -80px;
            right: -80px;
        }

        .shape-sm {
            width: 180px;
            height: 180px;
            background: #7ee8df;
            bottom: -40px;
            left: -40px;
        }

        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            width: 100%;
        }

        .feature-item {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(126, 232, 223, 0.2);
            border-radius: 12px;
            padding: 24px 16px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            backdrop-filter: blur(10px);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .feature-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(126, 232, 223, 0.1) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(126, 232, 223, 0.5);
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.2);
        }

        .feature-item:hover::before {
            opacity: 1;
        }

        .feature-icon {
            font-size: 32px;
            color: #7ee8df;
            margin-bottom: 12px;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: inline-block;
        }

        .feature-item:hover .feature-icon {
            transform: scale(1.25) rotate(8deg);
            color: #22d3ee;
        }

        .feature-item h4 {
            font-size: 15px;
            font-weight: 600;
            color: #e2e8f0;
            margin-bottom: 8px;
            transition: color 0.4s ease;
        }

        .feature-item:hover h4 {
            color: #7ee8df;
        }

        .feature-item p {
            font-size: 13px;
            color: #cbd5e1;
            line-height: 1.5;
            transition: color 0.4s ease;
        }

        .feature-item:hover p {
            color: #e2e8f0;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-card {
                padding: 40px;
                gap: 40px;
            }

            .hero-title {
                font-size: 36px;
            }
        }

        @media (max-width: 768px) {
            .hero-card {
                grid-template-columns: 1fr;
                padding: 30px;
                gap: 30px;
            }

            .hero-title {
                font-size: 28px;
            }

            .nav-menu {
                display: none;
            }

            .features-grid {
                gap: 16px;
            }

            .login-options {
                flex-direction: row;
            }

            .login-btn {
                flex: 1;
            }
        }

        @media (max-width: 640px) {
            main {
                padding: 20px 16px;
            }

            .hero-card {
                padding: 24px;
                border-radius: 16px;
            }

            .hero-left {
                gap: 16px;
            }

            .hero-title {
                font-size: 24px;
            }

            .hero-description {
                font-size: 14px;
            }

            .login-btn {
                padding: 14px 24px;
                font-size: 14px;
            }

            .login-options {
                flex-direction: column;
            }

            .footer-container {
                gap: 24px;
                margin-bottom: 20px;
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
                <a href="{{ route('home') }}" class="active">Home</a>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('features') }}">Features</a>
            </div>
            
            <div class="nav-cta">
                @if (Auth::check())
                    <a href="{{ route('dashboard') }}" class="btn-login">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn-login">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login', ['role' => 'staff']) }}" class="btn-login">Staff</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="hero-card">
            <!-- Left Content -->
            <div class="hero-left">
                <h1 class="hero-title">
                    <span>Complete Pet Care</span><br>
                    Management System
                </h1>

                <p class="hero-description">
                    Manage appointments, client information, pet grooming services, and staff in one secure platform designed for pet clinics.
                </p>

                <div class="login-options">
                    @if (Auth::check())
                        <a href="{{ route('dashboard') }}" class="login-btn pet-owner">
                            <i class="bi bi-speedometer2"></i>
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('customer.login') }}" class="login-btn pet-owner">
                            <i class="bi bi-person"></i>
                            Login as Pet Owner
                        </a>
                        <div class="signup-link">
                            Don't have an account? <a href="{{ route('customer.register.show') }}">Sign up here</a>
                        </div>
                    @endif
                </div>


            </div>

            <!-- Right Visual -->
            <div class="hero-right">
                <div class="features-grid">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <h4>Easy Appointments</h4>
                        <p>Quick booking and instant confirmations</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-scissors"></i>
                        </div>
                        <h4>Service Tracking</h4>
                        <p>Complete grooming service history</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4>Team Management</h4>
                        <p>Organize staff and schedules effortlessly</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <h4>Client Communication</h4>
                        <p>Stay connected with your customers</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Simple page fade-in
        window.addEventListener('load', () => {
            document.body.style.opacity = '1';
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add hover effect to buttons
        document.querySelectorAll('.login-btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
            });
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

    </script>
</body>
</html>
