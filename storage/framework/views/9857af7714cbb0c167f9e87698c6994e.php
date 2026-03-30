<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - PAWSER Pet Care Management</title>
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

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 24px;
        }

        .section-title {
            font-size: 42px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 60px;
            color: #1e293b;
        }

        .section-title span {
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            text-align: center;
            color: #64748b;
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto 60px;
            line-height: 1.8;
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 80px;
        }

        .service-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 40px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #0d9488 0%, #06b6d4 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            border-color: #0d9488;
            box-shadow: 0 20px 40px rgba(13, 148, 136, 0.1);
            transform: translateY(-6px);
        }

        .service-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #f0fdfa 0%, #ecf9f8 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #0d9488;
            margin-bottom: 24px;
        }

        .service-card h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1e293b;
        }

        .service-card p {
            font-size: 14px;
            color: #64748b;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .service-features {
            list-style: none;
            margin-top: 20px;
        }

        .service-features li {
            font-size: 13px;
            color: #64748b;
            padding: 8px 0;
            padding-left: 24px;
            position: relative;
        }

        .service-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #0d9488;
            font-weight: bold;
        }

        /* Feature Comparison */
        .comparison-section {
            margin-top: 100px;
            padding: 60px;
            background: linear-gradient(135deg, #f0fdfa 0%, #ecf9f8 100%);
            border-radius: 12px;
        }

        .comparison-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 40px;
            text-align: center;
            color: #1e293b;
        }

        .comparison-table {
            width: 100%;
            border-collapse: collapse;
        }

        .comparison-table td,
        .comparison-table th {
            padding: 16px;
            border-bottom: 1px solid #cbd5e1;
            text-align: left;
        }

        .comparison-table th {
            background: white;
            font-weight: 700;
            color: #0d9488;
            font-size: 14px;
        }

        .comparison-table tr:last-child td {
            border-bottom: none;
        }

        .comparison-table td:first-child {
            font-weight: 600;
            color: #1e293b;
            width: 40%;
        }

        .comparison-table td:not(:first-child) {
            text-align: center;
            color: #64748b;
            font-size: 13px;
        }

        .check-icon {
            color: #0d9488;
            font-weight: bold;
            font-size: 16px;
        }

        .cross-icon {
            color: #cbd5e1;
            font-weight: bold;
            font-size: 16px;
        }

        /* Pricing Section */
        .pricing-section {
            margin-top: 100px;
            text-align: center;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .pricing-card {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 40px;
            transition: all 0.3s ease;
            position: relative;
        }

        .pricing-card.featured {
            border-color: #0d9488;
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(13, 148, 136, 0.15);
        }

        .pricing-badge {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
            color: white;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .pricing-name {
            font-size: 20px;
            font-weight: 700;
            margin: 16px 0;
            color: #1e293b;
        }

        .pricing-price {
            font-size: 36px;
            font-weight: 800;
            color: #0d9488;
            margin: 16px 0;
        }

        .pricing-price span {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        .pricing-description {
            font-size: 13px;
            color: #64748b;
            margin: 16px 0 24px;
        }

        .pricing-features {
            list-style: none;
            text-align: left;
            margin: 24px 0;
        }

        .pricing-features li {
            padding: 10px 0;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pricing-features li::before {
            content: '✓';
            color: #0d9488;
            font-weight: bold;
            font-size: 16px;
        }

        .pricing-btn {
            display: block;
            width: 100%;
            padding: 12px 24px;
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            margin-top: 24px;
        }

        .pricing-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(13, 148, 136, 0.3);
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
            color: white;
            padding: 60px 24px;
            text-align: center;
            border-radius: 12px;
            margin-top: 100px;
        }

        .cta-section h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 16px;
            opacity: 0.95;
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
            max-width: 1200px;
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

            .section-title {
                font-size: 32px;
            }

            .pricing-card.featured {
                transform: scale(1);
            }

            .nav-menu {
                display: none;
            }

            .comparison-section {
                padding: 24px;
                overflow-x: auto;
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
                <a href="/about">About</a>
                <a href="/services" class="active">Services</a>
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
            <h1>Powerful <span>Features</span> for Modern Pet Care</h1>
            <p>Comprehensive tools designed for veterinary clinics and pet owners to streamline pet health management</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <!-- Services Overview -->
        <h2 class="section-title">Our <span>Services</span></h2>
        <p class="section-subtitle">PAWSER provides a complete suite of integrated services to manage all aspects of pet care and clinic operations</p>

        <div class="services-grid">
            <!-- Service 1 -->
            <div class="service-card">
                <div class="service-icon"><i class="bi bi-calendar-event"></i></div>
                <h3>Appointment Management</h3>
                <p>Intelligent scheduling system that reduces no-shows and optimizes clinic operations.</p>
                <ul class="service-features">
                    <li>Real-time availability</li>
                    <li>Automated reminders</li>
                    <li>Waitlist management</li>
                    <li>Multi-clinic scheduling</li>
                    <li>Calendar integration</li>
                </ul>
            </div>

            <!-- Service 2 -->
            <div class="service-card">
                <div class="service-icon"><i class="bi bi-file-medical"></i></div>
                <h3>Medical Records</h3>
                <p>Secure, comprehensive medical record system with complete history and documentation.</p>
                <ul class="service-features">
                    <li>Complete pet history</li>
                    <li>Treatment notes</li>
                    <li>Lab results tracking</li>
                    <li>Prescription management</li>
                    <li>Document storage</li>
                </ul>
            </div>

            <!-- Service 3 -->
            <div class="service-card">
                <div class="service-icon"><i class="bi bi-shield-plus"></i></div>
                <h3>Immunization Tracking</h3>
                <p>Never miss an immunization with automated tracking and timely reminders.</p>
                <ul class="service-features">
                    <li>Vaccination schedules</li>
                    <li>Reminder alerts</li>
                    <li>Compliance reports</li>
                    <li>Certificate generation</li>
                    <li>Booster notifications</li>
                </ul>
            </div>

            <!-- Service 4 -->
            <div class="service-card">
                <div class="service-icon"><i class="bi bi-graph-up"></i></div>
                <h3>Analytics & Reports</h3>
                <p>Data-driven insights to help clinics make informed decisions and track performance.</p>
                <ul class="service-features">
                    <li>Performance metrics</li>
                    <li>Custom reports</li>
                    <li>Financial tracking</li>
                    <li>Patient analytics</li>
                    <li>Trend analysis</li>
                </ul>
            </div>

            <!-- Service 5 -->
            <div class="service-card">
                <div class="service-icon"><i class="bi bi-people"></i></div>
                <h3>Staff Management</h3>
                <p>Comprehensive tools for managing clinic staff, schedules, and permissions.</p>
                <ul class="service-features">
                    <li>Role management</li>
                    <li>Shift scheduling</li>
                    <li>Access control</li>
                    <li>Activity logs</li>
                    <li>Performance tracking</li>
                </ul>
            </div>

            <!-- Service 6 -->
            <div class="service-card">
                <div class="service-icon"><i class="bi bi-telephone"></i></div>
                <h3>Communication Hub</h3>
                <p>Centralized communication platform for clients, staff, and clinic coordination.</p>
                <ul class="service-features">
                    <li>Client messaging</li>
                    <li>Appointment alerts</li>
                    <li>Notifications</li>
                    <li>SMS support</li>
                    <li>Email templates</li>
                </ul>
            </div>
        </div>

        <!-- Feature Comparison -->
        <section class="comparison-section">
            <h2 class="comparison-title">Feature Comparison</h2>
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Feature</th>
                        <th>Basic</th>
                        <th>Professional</th>
                        <th>Enterprise</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pet & Owner Profiles</td>
                        <td><span class="check-icon">✓</span></td>
                        <td><span class="check-icon">✓</span></td>
                        <td><span class="check-icon">✓</span></td>
                    </tr>
                    <tr>
                        <td>Appointment Scheduling</td>
                        <td><span class="check-icon">✓</span></td>
                        <td><span class="check-icon">✓</span></td>
                        <td><span class="check-icon">✓</span></td>
                    </tr>
                    <tr>
                        <td>Medical Records</td>
                        <td><span class="check-icon">✓</span></td>
                        <td><span class="check-icon">✓</span></td>
                        <td><span class="check-icon">✓</span></td>
                    </tr>
                    <tr>
                        <td>Immunization Tracking</td>
                        <td><span class="cross-icon">✕</span></td>
                        <td><span class="check-icon">✓</span></td>
                        <td><span class="check-icon">✓</span></td>
                    </tr>
                    <tr>
                        <td>Multi-Clinic Support</td>
                        <td><span class="cross-icon">✕</span></td>
                        <td><span class="check-icon">✓</span></td>
                        <td><span class="check-icon">✓</span></td>
                    </tr>
                    <tr>
                        <td>Advanced Analytics</td>
                        <td><span class="cross-icon">✕</span></td>
                        <td><span class="check-icon">✓</span></td>
                        <td><span class="check-icon">✓</span></td>
                    </tr>
                    <tr>
                        <td>API Access</td>
                        <td><span class="cross-icon">✕</span></td>
                        <td><span class="cross-icon">✕</span></td>
                        <td><span class="check-icon">✓</span></td>
                    </tr>
                    <tr>
                        <td>Priority Support</td>
                        <td><span class="cross-icon">✕</span></td>
                        <td><span class="cross-icon">✕</span></td>
                        <td><span class="check-icon">✓</span></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Pricing -->
        <section class="pricing-section">
            <h2 class="section-title">Simple, Transparent <span>Pricing</span></h2>

            <div class="pricing-grid">
                <div class="pricing-card">
                    <div class="pricing-name">Basic</div>
                    <div class="pricing-price">$29<span>/month</span></div>
                    <div class="pricing-description">Perfect for small practices</div>
                    <ul class="pricing-features">
                        <li>Up to 5 pets</li>
                        <li>Basic appointments</li>
                        <li>Medical records</li>
                        <li>Email support</li>
                    </ul>
                    <a href="<?php echo e(route('login')); ?>" class="pricing-btn">Get Started</a>
                </div>

                <div class="pricing-card featured">
                    <div class="pricing-badge">Most Popular</div>
                    <div class="pricing-name">Professional</div>
                    <div class="pricing-price">$79<span>/month</span></div>
                    <div class="pricing-description">For growing practices</div>
                    <ul class="pricing-features">
                        <li>Unlimited pets</li>
                        <li>Smart scheduling</li>
                        <li>Complete records</li>
                        <li>Immunization tracking</li>
                        <li>Analytics & reports</li>
                        <li>Priority support</li>
                    </ul>
                    <a href="<?php echo e(route('login')); ?>" class="pricing-btn">Start Free Trial</a>
                </div>

                <div class="pricing-card">
                    <div class="pricing-name">Enterprise</div>
                    <div class="pricing-price">Custom<span>/month</span></div>
                    <div class="pricing-description">For large organizations</div>
                    <ul class="pricing-features">
                        <li>Unlimited everything</li>
                        <li>Multi-clinic support</li>
                        <li>Advanced analytics</li>
                        <li>API access</li>
                        <li>Dedicated support</li>
                    </ul>
                    <a href="#contact" class="pricing-btn">Contact Sales</a>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="cta-section">
            <h2>Ready to Get Started?</h2>
            <p>Join hundreds of veterinary clinics using PAWSER to enhance their pet care services and streamline operations.</p>
            <a href="<?php echo e(route('login')); ?>" class="cta-btn">Start Your Free Trial</a>
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
<?php /**PATH C:\Users\Lei\Capstone1-web\resources\views/services.blade.php ENDPATH**/ ?>