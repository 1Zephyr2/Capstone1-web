<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FURCARE — Bark Pack Pet Grooming & Wellness</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --cream:       #FFF8F0;
            --teal:        #0F8A7A;
            --teal-deep:   #0B6B5F;
            --teal-light:  #E6F4F2;
            --amber:       #E8924A;
            --amber-deep:  #C97632;
            --amber-light: #FEF3E8;
            --navy:        #1C2B33;
            --navy-light:  #2E4350;
            --sage:        #7A8B85;
            --warm-line:   #EDE3D6;
            --white:       #FFFFFF;
            --shadow-sm:   0 2px 8px rgba(28,43,51,0.07);
            --shadow-md:   0 8px 28px rgba(28,43,51,0.11);
            --shadow-lg:   0 20px 48px rgba(28,43,51,0.15);
            --radius:      14px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--cream);
            color: var(--navy);
            line-height: 1.6;
        }

        /* ─── NAVBAR ─────────────────────────────────── */
        .site-nav {
            background: var(--navy);
            position: sticky;
            top: 0;
            z-index: 200;
            box-shadow: 0 1px 0 rgba(255,255,255,0.06);
        }

        .nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 28px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .nav-brand img {
            height: 38px;
            width: 38px;
            object-fit: contain;
        }

        .nav-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .nav-brand-name {
            font-size: 17px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.3px;
        }

        .nav-brand-sub {
            font-size: 10px;
            color: rgba(255,255,255,0.55);
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            flex: 1;
            justify-content: center;
        }

        .nav-links a {
            padding: 7px 14px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            border-radius: 7px;
            transition: all 0.2s;
        }

        .nav-links a:hover { background: rgba(255,255,255,0.09); color: #fff; }

        .nav-actions { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }

        .btn-ghost {
            padding: 8px 18px;
            border: 1.5px solid rgba(255,255,255,0.25);
            color: rgba(255,255,255,0.85);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            background: transparent;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-ghost:hover { border-color: rgba(255,255,255,0.5); color: #fff; background: rgba(255,255,255,0.06); }

        .btn-primary {
            padding: 8px 20px;
            background: var(--teal);
            color: #fff;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-primary:hover { background: var(--teal-deep); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(15,138,122,0.3); }

        /* ─── HERO ───────────────────────────────────── */
        .hero {
            background: var(--navy);
            color: #fff;
            overflow: hidden;
            position: relative;
            padding: 80px 28px 100px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -120px; right: -120px;
            width: 480px; height: 480px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(15,138,122,0.22) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -80px;
            width: 360px; height: 360px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(232,146,74,0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(15,138,122,0.18);
            border: 1px solid rgba(15,138,122,0.35);
            color: #5DD8C8;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 6px 12px;
            border-radius: 999px;
            margin-bottom: 20px;
        }

        .hero-title {
            font-size: 52px;
            font-weight: 900;
            line-height: 1.08;
            letter-spacing: -1.5px;
            margin-bottom: 20px;
            color: #fff;
        }

        .hero-title .accent { color: #5DD8C8; }

        .hero-desc {
            font-size: 16px;
            color: rgba(255,255,255,0.65);
            line-height: 1.8;
            margin-bottom: 36px;
            max-width: 460px;
        }

        .hero-cta { display: flex; flex-direction: column; gap: 12px; max-width: 340px; }

        .btn-hero-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 15px 28px;
            background: var(--teal);
            color: #fff;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-hero-primary:hover { background: var(--teal-deep); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(15,138,122,0.4); }

        .btn-hero-secondary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 14px 28px;
            background: transparent;
            color: rgba(255,255,255,0.8);
            border: 1.5px solid rgba(255,255,255,0.2);
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s;
        }

        .btn-hero-secondary:hover { border-color: rgba(255,255,255,0.45); color: #fff; background: rgba(255,255,255,0.06); }

        .hero-register {
            font-size: 13px;
            color: rgba(255,255,255,0.45);
            text-align: center;
        }

        .hero-register a { color: #5DD8C8; text-decoration: none; font-weight: 600; }
        .hero-register a:hover { text-decoration: underline; }

        /* Hero right — feature tiles */
        .hero-tiles {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .hero-tile {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px;
            padding: 24px 20px;
            text-align: center;
            transition: all 0.25s;
        }

        .hero-tile:hover { background: rgba(255,255,255,0.09); border-color: rgba(93,216,200,0.3); transform: translateY(-3px); }

        .hero-tile-icon { font-size: 30px; color: #5DD8C8; margin-bottom: 10px; display: block; }
        .hero-tile h4 { font-size: 14px; font-weight: 700; color: #fff; margin-bottom: 6px; }
        .hero-tile p { font-size: 12px; color: rgba(255,255,255,0.55); line-height: 1.5; }

        /* ─── SECTION SHELL ──────────────────────────── */
        .section { padding: 88px 28px; }
        .section-alt { background: var(--white); }

        .section-inner { max-width: 1280px; margin: 0 auto; }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--teal);
            background: var(--teal-light);
            padding: 5px 11px;
            border-radius: 999px;
            margin-bottom: 14px;
        }

        .section-title {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: -0.8px;
            color: var(--navy);
            margin-bottom: 12px;
            line-height: 1.15;
        }

        .section-sub {
            font-size: 15.5px;
            color: var(--sage);
            max-width: 560px;
            line-height: 1.75;
        }

        .section-head { margin-bottom: 52px; }

        /* ─── PAW DIVIDER (signature element, used once) */
        .paw-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 0 52px;
        }

        .paw-divider::before,
        .paw-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--warm-line);
        }

        .paw-divider i {
            color: var(--amber);
            font-size: 16px;
            opacity: 0.7;
        }

        /* ─── SERVICES / PRICING ─────────────────────── */
        .pricing-note {
            font-size: 13px;
            color: var(--sage);
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pricing-table-wrap { overflow-x: auto; border-radius: var(--radius); border: 1px solid var(--warm-line); box-shadow: var(--shadow-sm); }

        .pricing-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--white);
            font-size: 14px;
        }

        .pricing-table thead tr {
            background: var(--navy);
            color: #fff;
        }

        .pricing-table thead th {
            padding: 14px 18px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            text-align: left;
            white-space: nowrap;
        }

        .pricing-table thead th:not(:first-child) { text-align: center; }

        .pricing-table thead th.size-header {
            background: var(--teal);
            text-align: center;
        }

        .pricing-table tbody tr { border-bottom: 1px solid var(--warm-line); transition: background 0.15s; }
        .pricing-table tbody tr:last-child { border-bottom: none; }
        .pricing-table tbody tr:hover { background: var(--cream); }

        .pricing-table td { padding: 18px 18px; vertical-align: top; }
        .pricing-table td:not(:first-child) { text-align: center; }

        .pkg-name {
            font-weight: 800;
            font-size: 15px;
            color: var(--navy);
            margin-bottom: 3px;
        }

        .pkg-tag {
            display: inline-block;
            font-size: 10.5px;
            font-weight: 600;
            color: var(--amber-deep);
            background: var(--amber-light);
            padding: 2px 7px;
            border-radius: 999px;
            margin-bottom: 7px;
        }

        .pkg-desc { font-size: 12px; color: var(--sage); line-height: 1.55; max-width: 280px; }

        .price {
            font-weight: 800;
            font-size: 15px;
            color: var(--teal-deep);
        }

        .pkg-highlight { background: var(--teal-light) !important; }

        .size-note {
            margin-top: 16px;
            padding: 14px 18px;
            background: var(--amber-light);
            border: 1px solid var(--warm-line);
            border-radius: 10px;
            font-size: 13px;
            color: var(--navy);
            display: flex;
            align-items: flex-start;
            gap: 9px;
        }

        .size-note i { color: var(--amber); font-size: 16px; flex-shrink: 0; margin-top: 1px; }

        /* ─── WHY CHOOSE US ──────────────────────────── */
        .why-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .why-card {
            background: var(--white);
            border: 1px solid var(--warm-line);
            border-radius: var(--radius);
            padding: 32px 28px;
            transition: all 0.25s;
            box-shadow: var(--shadow-sm);
        }

        .why-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: #d4e9e6; }

        .why-icon {
            width: 52px;
            height: 52px;
            background: var(--teal-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: var(--teal);
            margin-bottom: 18px;
        }

        .why-card h3 { font-size: 17px; font-weight: 700; color: var(--navy); margin-bottom: 9px; }
        .why-card p { font-size: 14px; color: var(--sage); line-height: 1.7; }

        /* ─── ABOUT ──────────────────────────────────── */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 56px;
            align-items: center;
        }

        /* TODO: replace with actual clinic photo */
        .about-photo {
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 4/3;
            background: linear-gradient(135deg, var(--teal-light) 0%, #d0ece9 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border: 1px solid var(--warm-line);
            box-shadow: var(--shadow-md);
        }

        .about-photo i { font-size: 56px; color: var(--teal); opacity: 0.4; }
        .about-photo span { font-size: 13px; color: var(--sage); font-style: italic; }

        .about-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 24px; }

        .pill {
            padding: 7px 14px;
            border-radius: 999px;
            background: var(--teal-light);
            color: var(--teal-deep);
            font-size: 12.5px;
            font-weight: 600;
            border: 1px solid #c2deda;
        }

        .pill.amber {
            background: var(--amber-light);
            color: var(--amber-deep);
            border-color: #f0d5b8;
        }

        /* ─── SIZING GUIDE ───────────────────────────── */
        .size-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 16px;
        }

        .size-card {
            background: var(--white);
            border: 1px solid var(--warm-line);
            border-radius: var(--radius);
            padding: 24px 16px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all 0.2s;
        }

        .size-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); border-color: #d4e9e6; }

        .size-badge {
            display: inline-block;
            width: 48px;
            height: 48px;
            line-height: 48px;
            border-radius: 50%;
            background: var(--teal);
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .size-card h4 { font-size: 13px; font-weight: 700; color: var(--navy); margin-bottom: 4px; }
        .size-card p { font-size: 11.5px; color: var(--sage); }

        /* ─── CONTACT / FOOTER ───────────────────────── */
        .contact-section {
            background: var(--navy);
            color: #fff;
            padding: 88px 28px 0;
        }

        .contact-inner {
            max-width: 1280px;
            margin: 0 auto;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr 1fr;
            gap: 56px;
            padding-bottom: 64px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .contact-brand-name { font-size: 22px; font-weight: 800; color: #fff; margin-bottom: 4px; }
        .contact-brand-sub { font-size: 13px; color: rgba(255,255,255,0.45); margin-bottom: 18px; }
        .contact-brand-desc { font-size: 14px; color: rgba(255,255,255,0.55); line-height: 1.75; max-width: 320px; }

        .contact-col h4 { font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 18px; }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 14px;
            font-size: 14px;
            color: rgba(255,255,255,0.65);
        }

        .contact-item i { color: #5DD8C8; font-size: 16px; flex-shrink: 0; margin-top: 1px; }

        .hours-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 13.5px; color: rgba(255,255,255,0.65); }
        .hours-row span:last-child { color: #5DD8C8; font-weight: 600; }

        .cta-box {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 20px;
            margin-top: 4px;
        }

        .cta-box p { font-size: 13.5px; color: rgba(255,255,255,0.6); margin-bottom: 14px; line-height: 1.6; }

        .btn-cta-footer {
            display: block;
            text-align: center;
            padding: 11px 20px;
            background: var(--teal);
            color: #fff;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-cta-footer:hover { background: var(--teal-deep); }

        .footer-bar {
            padding: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12.5px;
            color: rgba(255,255,255,0.3);
        }

        .footer-bar a { color: rgba(255,255,255,0.4); text-decoration: none; }
        .footer-bar a:hover { color: rgba(255,255,255,0.7); }

        /* ─── SCROLL REVEAL ──────────────────────────── */
        .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.65s ease, transform 0.65s ease; }
        .reveal.visible { opacity: 1; transform: none; }

        /* ─── RESPONSIVE ─────────────────────────────── */
        @media (max-width: 1024px) {
            .why-grid { grid-template-columns: 1fr 1fr; }
            .size-grid { grid-template-columns: repeat(3, 1fr); }
            .contact-grid { grid-template-columns: 1fr 1fr; gap: 36px; }
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .hero-inner { grid-template-columns: 1fr; gap: 40px; }
            .hero-title { font-size: 36px; }
            .hero-tiles { grid-template-columns: 1fr 1fr; }
            .about-grid { grid-template-columns: 1fr; }
            .why-grid { grid-template-columns: 1fr; }
            .size-grid { grid-template-columns: repeat(2, 1fr); }
            .contact-grid { grid-template-columns: 1fr; gap: 32px; }
            .section-title { font-size: 28px; }
        }

        @media (max-width: 480px) {
            .hero { padding: 56px 20px 72px; }
            .hero-title { font-size: 30px; }
            .hero-tiles { grid-template-columns: 1fr; }
            .section { padding: 64px 20px; }
        }
    </style>
</head>
<body>

<!-- ═══════════ NAVBAR ═══════════ -->
<nav class="site-nav">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-brand">
            @if(file_exists(public_path('newlogo.png')))
                <img src="{{ asset('newlogo.png') }}" alt="FURCARE">
            @else
                <i class="bi bi-paw-fill" style="font-size:28px;color:#5DD8C8;"></i>
            @endif
            <div class="nav-brand-text">
                <span class="nav-brand-name">FURCARE</span>
                <span class="nav-brand-sub">Bark Pack Pet Grooming</span>
            </div>
        </a>

        <div class="nav-links">
            <a href="#services">Services & Pricing</a>
            <a href="#about">About</a>
            <a href="#sizing">Size Guide</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="nav-actions">
            @if(Auth::check())
                <a href="{{ route('dashboard') }}" class="btn-primary">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn-ghost">Logout</button>
                </form>
            @else
                <a href="{{ route('customer.login') }}" class="btn-primary">Pet Owner Login</a>
            @endif
        </div>
    </div>
</nav>

<!-- ═══════════ HERO ═══════════ -->
<section class="hero">
    <div class="hero-inner">
        <div class="hero-left">
            <div class="hero-eyebrow">
                <i class="bi bi-paw-fill"></i>
                Bark Pack · Baguio City
            </div>

            <h1 class="hero-title">
                Your pet deserves<br>
                <span class="accent">the best care</span>
            </h1>

            <p class="hero-desc">
                Professional grooming, wellness services, and easy online booking — all in one place. Book your pet's next appointment in minutes, anytime.
            </p>

            <div class="hero-cta">
                @if(Auth::check())
                    <a href="{{ route('dashboard') }}" class="btn-hero-primary">
                        <i class="bi bi-speedometer2"></i> Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('customer.login') }}" class="btn-hero-primary">
                        <i class="bi bi-calendar-plus"></i> Book an Appointment
                    </a>
                    
                    <p class="hero-register">
                        New here? <a href="{{ route('customer.register.show') }}">Create a free account</a>
                    </p>
                @endif
            </div>
        </div>

        <div class="hero-tiles">
            <div class="hero-tile">
                <i class="bi bi-calendar-check hero-tile-icon"></i>
                <h4>Easy Booking</h4>
                <p>Request appointments online, anytime — no phone calls needed</p>
            </div>
            <div class="hero-tile">
                <i class="bi bi-scissors hero-tile-icon"></i>
                <h4>Expert Grooming</h4>
                <p>Premium packages tailored to your pet's breed and coat type</p>
            </div>
            <div class="hero-tile">
                <i class="bi bi-heart-pulse hero-tile-icon"></i>
                <h4>Health & Wellness</h4>
                <p>Beyond grooming — health checks, ear cleaning, dental care</p>
            </div>
            <div class="hero-tile">
                <i class="bi bi-bell hero-tile-icon"></i>
                <h4>Stay Updated</h4>
                <p>Get real-time notifications on appointment status & updates</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ SERVICES & PRICING ═══════════ -->
<section class="section section-alt" id="services">
    <div class="section-inner">
        <div class="section-head reveal">
            <div class="section-label"><i class="bi bi-scissors"></i> Grooming Packages</div>
            <h2 class="section-title">Services & Pricing</h2>
            <p class="section-sub">All packages include professional handling by trained groomers. Prices are in Philippine Peso (₱) and may vary depending on coat thickness and condition.</p>
        </div>

        <div class="reveal">
            <div class="pricing-note">
                <i class="bi bi-info-circle" style="color:var(--teal);"></i>
                Prices shown in Philippine Peso (₱). Final price may vary based on coat thickness and pet behavior.
            </div>

            <div class="pricing-table-wrap">
                <table class="pricing-table">
                    <thead>
                        <tr>
                            <th style="width:38%;">Package</th>
                            <th class="size-header">XS</th>
                            <th class="size-header">S</th>
                            <th class="size-header">M</th>
                            <th class="size-header">L</th>
                            <th class="size-header">XL</th>
                            <th class="size-header">Giant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="pkg-name">Premium</div>
                                <div class="pkg-tag">All Stages</div>
                                <div class="pkg-desc">Bath, brush and dry. Recommended for weekly maintenance from the Deluxe, Grande, or Signature package.</div>
                            </td>
                            <td><span class="price">₱400</span></td>
                            <td><span class="price">₱500</span></td>
                            <td><span class="price">₱600</span></td>
                            <td><span class="price">₱1,100</span></td>
                            <td><span class="price">₱1,300</span></td>
                            <td><span class="price">₱1,500</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="pkg-name">Deluxe</div>
                                <div class="pkg-tag">Puppy, Kitten & Adult</div>
                                <div class="pkg-desc">Complete grooming: bath, brush, dry, nail cut/file, toothbrush/gel, anal sac, ear clean and plucking (by request), mild de-matting. Cut: Sanitary (face trim, paw pad, belly, butt).</div>
                            </td>
                            <td><span class="price">₱550</span></td>
                            <td><span class="price">₱650</span></td>
                            <td><span class="price">₱750</span></td>
                            <td><span class="price">₱1,250</span></td>
                            <td><span class="price">₱1,500</span></td>
                            <td><span class="price">₱2,000</span></td>
                        </tr>
                        <tr class="pkg-highlight">
                            <td>
                                <div class="pkg-name">Standard</div>
                                <div class="pkg-tag">Dog</div>
                                <div class="pkg-desc">Complete grooming: bath, brush, dry, nail cut/file, toothbrush/gel, anal sac, ear clean and plucking (by request). Cut: Face & whole body (Summer or Semi).</div>
                            </td>
                            <td><span class="price">₱600</span></td>
                            <td><span class="price">₱700</span></td>
                            <td><span class="price">₱800</span></td>
                            <td><span class="price">₱1,300</span></td>
                            <td><span class="price">₱1,650</span></td>
                            <td><span class="price">₱2,100</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="pkg-name">Grande</div>
                                <div class="pkg-tag">Dog & Cat</div>
                                <div class="pkg-desc">Complete grooming: bath, brush, dry, nail cut/file, toothbrush/gel, anal sac, ear clean and plucking (by request), mild de-matting. Cut: Dog — face trim, body depends on fur condition. Cat — sanitary or full clip cut.</div>
                            </td>
                            <td><span class="price">₱700</span></td>
                            <td><span class="price">₱800</span></td>
                            <td><span class="price">₱900</span></td>
                            <td><span class="price">₱1,500</span></td>
                            <td><span class="price">₱2,000</span></td>
                            <td><span class="price">₱2,500</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="pkg-name">BP Signature</div>
                                <div class="pkg-tag">Dog & Cat</div>
                                <div class="pkg-desc">Bear type cut (more than 1" full body trim). Complete grooming: bath, brush, dry, nail cut/file, toothbrush/gel, anal sac, ear clean and plucking (by request), mild de-matting.</div>
                            </td>
                            <td><span class="price">₱800</span></td>
                            <td><span class="price">₱900</span></td>
                            <td><span class="price">₱1,000</span></td>
                            <td><span class="price">₱1,800</span></td>
                            <td><span class="price">₱2,400</span></td>
                            <td><span class="price">₱2,800</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="size-note">
                <i class="bi bi-rulers"></i>
                <span>Not sure which size your pet is? Scroll down to our <a href="#sizing" style="color:var(--teal);font-weight:600;">Size Guide</a> below — sizes are based on body length and may vary with coat thickness.</span>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ WHY CHOOSE US ═══════════ -->
<section class="section" id="why">
    <div class="section-inner">
        <div class="section-head reveal">
            <div class="section-label"><i class="bi bi-star"></i> Why Bark Pack</div>
            <h2 class="section-title">Care you can count on</h2>
            <p class="section-sub">From the moment you book to the moment you pick up your pet, we make the whole experience smooth and stress-free.</p>
        </div>

        <div class="why-grid">
            <div class="why-card reveal">
                <div class="why-icon"><i class="bi bi-shield-check"></i></div>
                <h3>Trained & Trusted Groomers</h3>
                <p>Our team is experienced in handling pets of all temperaments — gentle, patient, and professional every time.</p>
            </div>
            <div class="why-card reveal">
                <div class="why-icon"><i class="bi bi-phone"></i></div>
                <h3>Online Booking, Anytime</h3>
                <p>Skip the phone call. Request appointments online in minutes and get real-time status updates straight to your dashboard.</p>
            </div>
            <div class="why-card reveal">
                <div class="why-icon"><i class="bi bi-clipboard2-pulse"></i></div>
                <h3>Complete Service Records</h3>
                <p>Every visit, every service, every note — all stored securely in your pet's profile so nothing falls through the cracks.</p>
            </div>
            <div class="why-card reveal">
                <div class="why-icon"><i class="bi bi-scissors"></i></div>
                <h3>Packages for Every Pet</h3>
                <p>From basic bath & brush to full signature cuts — we have grooming packages designed for dogs and cats of every size.</p>
            </div>
            <div class="why-card reveal">
                <div class="why-icon"><i class="bi bi-bell"></i></div>
                <h3>Appointment Reminders</h3>
                <p>Never miss a grooming session. Get notified when your appointment is confirmed, approaching, or updated.</p>
            </div>
            <div class="why-card reveal">
                <div class="why-icon"><i class="bi bi-heart-pulse"></i></div>
                <h3>Health & Wellness Focus</h3>
                <p>Beyond grooming — our services include ear cleaning, nail care, dental hygiene, and wellness checks to keep your pet in top shape.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ ABOUT ═══════════ -->
<section class="section section-alt" id="about">
    <div class="section-inner">
        <div class="paw-divider">
            <i class="bi bi-paw-fill"></i>
        </div>

        <div class="about-grid">
            <!-- TODO: replace with actual clinic photo -->
            <div class="about-photo">
                <i class="bi bi-building"></i>
                <span><!-- TODO: replace with clinic exterior/interior photo --></span>
            </div>

            <div class="reveal">
                <div class="section-label"><i class="bi bi-shop"></i> About Us</div>
                <h2 class="section-title">A modern clinic for your furry family</h2>
                <p style="color:var(--sage);font-size:15px;line-height:1.8;margin-bottom:20px;">
                    Bark Pack is a full-service pet grooming and wellness center in Baguio City. We believe every pet deserves professional, loving care — and every owner deserves a simple, stress-free booking experience.
                </p>
                <p style="color:var(--sage);font-size:15px;line-height:1.8;">
                    FURCARE is our online system that brings your pet's records, appointments, and communications into one place — accessible from any device, any time.
                </p>

                <div class="about-pills">
                    <span class="pill">Grooming</span>
                    <span class="pill">Health & Wellness</span>
                    <span class="pill">Hotel</span>
                    <span class="pill">Supplies</span>
                    <span class="pill amber">Dogs & Cats</span>
                    <span class="pill amber">Baguio City</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ SIZING GUIDE ═══════════ -->
<section class="section" id="sizing">
    <div class="section-inner">
        <div class="section-head reveal">
            <div class="section-label"><i class="bi bi-rulers"></i> Size Guide</div>
            <h2 class="section-title">Which size is your pet?</h2>
            <p class="section-sub">Sizes are measured by body length and may vary depending on coat thickness. When in doubt, our groomers will assess your pet on arrival.</p>
        </div>

        <div class="size-grid reveal">
            <div class="size-card">
                <div class="size-badge">XS</div>
                <h4>Extra Small</h4>
                <p>3 – 5 inches<br>body length</p>
            </div>
            <div class="size-card">
                <div class="size-badge">S</div>
                <h4>Small</h4>
                <p>6 – 10 inches<br>body length</p>
            </div>
            <div class="size-card">
                <div class="size-badge">M</div>
                <h4>Medium</h4>
                <p>10 – 13 inches<br>body length</p>
            </div>
            <div class="size-card">
                <div class="size-badge">L</div>
                <h4>Large</h4>
                <p>13 – 18 inches<br>body length</p>
            </div>
            <div class="size-card">
                <div class="size-badge">XL</div>
                <h4>Extra Large</h4>
                <p>18 – 22 inches<br>body length</p>
            </div>
            <div class="size-card">
                <div class="size-badge" style="background:var(--amber);">G</div>
                <h4>Giant</h4>
                <p>22 – 28 inches<br>body length</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ CONTACT / FOOTER ═══════════ -->
<footer class="contact-section" id="contact">
    <div class="contact-inner">
        <div class="contact-grid">
            <!-- Brand col -->
            <div>
                <div class="contact-brand-name">Bark Pack</div>
                <div class="contact-brand-sub">by FURCARE Pet Management System</div>
                <p class="contact-brand-desc">Professional pet grooming and wellness services in Baguio City. Trusted by pet owners who want the best for their furry family members.</p>
            </div>

            <!-- Hours col -->
            <div>
                <h4>Hours of Operation</h4>
                <!-- TODO: Replace with real operating hours -->
                <div class="hours-row"><span>Monday – Friday</span><span>9:00 AM – 6:00 PM</span></div>
                <div class="hours-row"><span>Saturday</span><span>9:00 AM – 5:00 PM</span></div>
                <div class="hours-row"><span>Sunday</span><span>Closed</span></div>
                <p style="font-size:11.5px;color:rgba(255,255,255,0.3);margin-top:12px;"><!-- TODO: confirm actual hours --></p>

                <div style="margin-top:20px;">
                    <h4>Location</h4>
                    <!-- TODO: Replace with real address -->
                    <div class="contact-item">
                        <i class="bi bi-geo-alt"></i>
                        <span>Baguio City, Philippines<!-- TODO: add full street address --></span>
                    </div>
                    <!-- TODO: Replace with real phone -->
                    <div class="contact-item">
                        <i class="bi bi-telephone"></i>
                        <span><!-- TODO: add phone number --></span>
                    </div>
                </div>
            </div>

            <!-- CTA col -->
            <div>
                <h4>Ready to Book?</h4>
                <div class="cta-box">
                    <p>Create a free pet owner account and request your first grooming appointment online — no phone calls needed.</p>
                    @if(!Auth::check())
                        <a href="{{ route('customer.register.show') }}" class="btn-cta-footer">
                            <i class="bi bi-person-plus"></i> Create Account
                        </a>
                        <a href="{{ route('customer.login') }}" class="btn-cta-footer" style="margin-top:8px;background:transparent;border:1px solid rgba(255,255,255,0.15);">
                            <i class="bi bi-box-arrow-in-right"></i> Sign In
                        </a>
                    @else
                        <a href="{{ route('customer.dashboard') }}" class="btn-cta-footer">
                            <i class="bi bi-speedometer2"></i> Go to Dashboard
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="footer-bar">
            <span>© {{ date('Y') }} Bark Pack · FURCARE System · Baguio City, Philippines</span>
            <span>Built with <i class="bi bi-heart-fill" style="color:var(--amber);font-size:10px;"></i> for pet owners</span>
        </div>
    </div>
</footer>

<script>
    // Scroll reveal
    const revealEls = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });
    revealEls.forEach(el => observer.observe(el));
</script>
</body>
</html>