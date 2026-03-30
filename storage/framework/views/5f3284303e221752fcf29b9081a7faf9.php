<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About PAWSER - Pet Care Management System</title>
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap-icons/bootstrap-icons.min.css')); ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ffffff;
            color: #1e293b;
            line-height: 1.6;
        }

        /* Navigation */
        nav {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
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
            color: #0d9488;
            transition: opacity 0.3s ease;
        }

        .nav-brand:hover {
            opacity: 0.8;
        }

        .nav-logo {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: 700;
        }

        .nav-menu {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: #0d9488;
        }

        .nav-menu a.active {
            border-bottom: 2px solid #0d9488;
            padding-bottom: 2px;
        }

        .nav-cta {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-login {
            padding: 8px 20px;
            border: 1px solid #0d9488;
            color: #0d9488;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #f0fdfa;
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
            box-shadow: 0 8px 16px rgba(13, 148, 136, 0.2);
        }

        /* Hero */
        .hero-section {
            background: linear-gradient(135deg, #f0fdfa 0%, #ecf9f8 100%);
            padding: 80px 24px;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-content h1 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            color: #1e293b;
        }

        .hero-content h1 span {
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-content p {
            font-size: 18px;
            color: #64748b;
            line-height: 1.8;
        }

        /* Main Content */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 80px 24px;
        }

        .section {
            margin-bottom: 80px;
        }

        .section h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 30px;
            color: #1e293b;
        }

        .section h2 span {
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section p {
            font-size: 16px;
            color: #64748b;
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
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 32px;
            transition: all 0.3s ease;
        }

        .value-card:hover {
            border-color: #0d9488;
            box-shadow: 0 12px 24px rgba(13, 148, 136, 0.12);
            transform: translateY(-4px);
        }

        .value-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #f0fdfa 0%, #ecf9f8 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #0d9488;
            margin-bottom: 20px;
        }

        .value-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1e293b;
        }

        .value-card p {
            font-size: 14px;
            color: #64748b;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .team-member {
            text-align: center;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .team-member:hover {
            border-color: #0d9488;
            box-shadow: 0 8px 16px rgba(13, 148, 136, 0.1);
        }

        .team-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 32px;
            color: white;
        }

        .team-member h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 4px;
            color: #1e293b;
        }

        .team-member p {
            font-size: 13px;
            color: #0d9488;
            margin-bottom: 12px;
        }

        .team-member .description {
            font-size: 12px;
            color: #64748b;
        }

        .timeline {
            position: relative;
            padding: 40px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 100%;
            background: #e2e8f0;
        }

        .timeline-item {
            margin-bottom: 50px;
            position: relative;
        }

        .timeline-item:nth-child(odd) .timeline-content {
            margin-left: 0;
            margin-right: 51%;
            text-align: right;
        }

        .timeline-item:nth-child(even) .timeline-content {
            margin-left: 51%;
            margin-right: 0;
        }

        .timeline-marker {
            position: absolute;
            left: 50%;
            top: 0;
            width: 16px;
            height: 16px;
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
            border: 3px solid white;
            border-radius: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }

        .timeline-content {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .timeline-content:hover {
            border-color: #0d9488;
            box-shadow: 0 8px 16px rgba(13, 148, 136, 0.1);
        }

        .timeline-content h3 {
            font-size: 16px;
            font-weight: 700;
            color: #0d9488;
            margin-bottom: 8px;
        }

        .timeline-content p {
            font-size: 14px;
            color: #64748b;
            margin: 0;
        }

        /* CTA */
        .cta-section {
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
            color: white;
            padding: 60px 24px;
            text-align: center;
            border-radius: 12px;
            margin-top: 80px;
        }

        .cta-section h2 {
            color: white;
            font-size: 36px;
            margin-bottom: 20px;
        }

        .cta-section p {
            color: rgba(255, 255, 255, 0.95);
            font-size: 16px;
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-btn {
            padding: 12px 32px;
            background: white;
            color: #0d9488;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
        }

        .cta-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background: #1e293b;
            color: #cbd5e1;
            padding: 60px 24px 20px;
            margin-top: 80px;
        }

        .footer-container {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h4 {
            color: white;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 12px;
        }

        .footer-section a {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #0d9488;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #334155;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 32px;
            }

            .section h2 {
                font-size: 28px;
            }

            .timeline::before {
                left: 10px;
            }

            .timeline-item:nth-child(odd) .timeline-content,
            .timeline-item:nth-child(even) .timeline-content {
                margin-left: 50px;
                margin-right: 0;
            }

            .timeline-marker {
                left: 10px;
            }

            .nav-menu {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="/" class="nav-brand">
                <div class="nav-logo">🐾</div>
                <span>PAWSER</span>
            </a>
            <div class="nav-menu">
                <a href="/">Home</a>
                <a href="/about" class="active">About</a>
                <a href="/services">Services</a>
                <a href="#contact">Contact</a>
            </div>
            <div class="nav-cta">
                <?php if(auth()->guard()->check()): ?>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin: 0;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-primary" style="border: none; cursor: pointer;">
                            Logout
                        </button>
                    </form>
                    <a href="/dashboard" class="btn-login">Dashboard</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn-login">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                    <a href="<?php echo e(route('login')); ?>" class="btn-primary">Get Started</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero-section">
        <div class="hero-content">
            <h1>About <span>PAWSER</span></h1>
            <p>Revolutionizing pet care management through innovative technology and compassionate service</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <!-- Our Story -->
        <section class="section">
            <h2>About <span>PAWSER</span></h2>
            <p>PAWSER is a comprehensive pet care management system designed to streamline operations for veterinary clinics and improve pet health outcomes. Our platform integrates appointment scheduling, medical records, immunization tracking, and staff management into one unified system.</p>
            <p>Built with modern technology and pet care best practices, PAWSER helps clinics and pet owners keep detailed, accessible records of pet health information while improving clinic efficiency and reducing administrative burden.</p>
        </section>

        <!-- Our Values -->
        <section class="section">
            <h2>Our <span>Values</span></h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-heart-fill"></i></div>
                    <h3>Pet First</h3>
                    <p>Every decision we make is guided by what's best for pets and their owners. Their health and happiness are our priority.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-shield-check"></i></div>
                    <h3>Trust & Security</h3>
                    <p>We maintain the highest standards of data security and privacy. Your information is sacred to us.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-lightbulb"></i></div>
                    <h3>Innovation</h3>
                    <p>We continuously improve and innovate to provide the best possible experience for our users.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-people-fill"></i></div>
                    <h3>Community</h3>
                    <p>We believe in the power of community and work closely with our users to shape the future of PAWSER.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-rocket-fill"></i></div>
                    <h3>Excellence</h3>
                    <p>We strive for excellence in everything we do, from product design to customer support.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-globe"></i></div>
                    <h3>Accessibility</h3>
                    <p>We make pet care management accessible to clinics of all sizes and pet owners everywhere.</p>
                </div>
            </div>
        </section>

        <!-- Our Team -->
        <section class="section">
            <h2>Our <span>Team</span></h2>
            <p>PAWSER is powered by a passionate team of dedicated professionals committed to transforming pet care management.</p>
            <div class="team-grid">
                <div class="team-member">
                    <div class="team-avatar"><i class="bi bi-person-fill"></i></div>
                    <h3>Dr. Sarah Wilson</h3>
                    <p>Founder & CEO</p>
                    <p class="description">Veterinarian with 15+ years of clinical experience</p>
                </div>
                <div class="team-member">
                    <div class="team-avatar"><i class="bi bi-person-fill"></i></div>
                    <h3>Mark Chen</h3>
                    <p>CTO</p>
                    <p class="description">Full-stack developer with expertise in healthcare systems</p>
                </div>
                <div class="team-member">
                    <div class="team-avatar"><i class="bi bi-person-fill"></i></div>
                    <h3>Emma Rodriguez</h3>
                    <p>Head of Product</p>
                    <p class="description">Product strategist focused on user experience</p>
                </div>
                <div class="team-member">
                    <div class="team-avatar"><i class="bi bi-person-fill"></i></div>
                    <h3>James Miller</h3>
                    <p>Lead Support</p>
                    <p class="description">Customer success specialist with 10+ years in SaaS</p>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="cta-section">
            <h2>Get Started with PAWSER</h2>
            <p>Log in to access your pet care management system and start managing your clinic or pets efficiently.</p>
            <a href="<?php echo e(route('login')); ?>" class="cta-btn">Login to Portal</a>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h4>About PAWSER</h4>
                <ul>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/services">Our Services</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Careers</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Product</h4>
                <ul>
                    <li><a href="/services">Features</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Security</a></li>
                    <li><a href="#">API Docs</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Community</a></li>
                    <li><a href="#">Status Page</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Legal</h4>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">Compliance</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo e(date('Y')); ?> PAWSER Pet Care Management System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\Users\Lei\Capstone1-web\resources\views/about.blade.php ENDPATH**/ ?>