<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insight Center - PAWser</title>
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap-icons/bootstrap-icons.min.css')); ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --bg: #f8fafc;
            --bg-alt: #f0f9ff;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #6b7280;
            --line: #e5e7eb;
            --primary: #14b8a6;
            --primary-strong: #0d9488;
            --accent: #06b6d4;
            --accent-strong: #0891b2;
            --shadow-sm: 0 4px 14px rgba(15, 23, 42, 0.08);
            --shadow-lg: 0 20px 40px rgba(15, 23, 42, 0.12);
            --radius: 14px;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Top Navigation Bar */
        .navbar {
            background: #1e293b;
            color: white;
            padding: 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            height: 72px;
            animation: staffFadeIn 0.5s ease-out;
        }

        @keyframes staffFadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes staffFadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar i.bi {
            font-family: bootstrap-icons;
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
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }

        .navbar-subtitle {
            font-size: 11px;
            opacity: 0.8;
            margin: 0;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 6px;
            flex: 1;
            justify-content: center;
        }

        .navbar-item {
            padding: 8px 14px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .navbar-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateY(-2px);
        }

        .navbar-item.active {
            background: rgba(20, 184, 166, 0.15);
            color: #14b8a6;
            border-bottom: 2px solid #14b8a6;
        }

        .navbar-end {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .navbar-avatar:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.08);
        }

        .navbar-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .navbar-user-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .navbar-user-name {
            font-size: 13px;
            font-weight: 600;
            color: white;
        }

        .navbar-user-role {
            font-size: 11px;
            opacity: 0.7;
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

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--bg) 0%, var(--bg-alt) 100%);
            padding: 0;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            color: var(--text);
        }

        body::before,
        body::after {
            content: '';
            position: fixed;
            z-index: -1;
            border-radius: 50%;
        }

        body::before {
            width: 460px;
            height: 460px;
            top: -160px;
            right: -140px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, rgba(37, 99, 235, 0) 70%);
        }

        body::after {
            width: 380px;
            height: 380px;
            bottom: -160px;
            left: -120px;
            background: radial-gradient(circle, rgba(22, 163, 74, 0.16) 0%, rgba(22, 163, 74, 0) 70%);
        }

        .container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 40px;
            animation: staffFadeInUp 0.6s ease-out;
        }

        .header {
            background: var(--card);
            padding: 28px 32px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid var(--line);
            transition: all 0.3s ease;
            animation: pageEnter 0.5s ease;
        }
        
        .header:hover {
            box-shadow: var(--shadow-lg);
        }

        .header-left h1 {
            font-size: 32px;
            font-weight: 800;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .header-left p {
            font-size: 14px;
            color: var(--muted);
            font-weight: 500;
        }

        .tech-badge {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
            padding: 8px 18px;
            border-radius: 24px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 2px 8px rgba(5, 150, 105, 0.3);
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
            margin-bottom: 40px;
            animation: staffFadeInUp 0.6s ease-out 0.1s both;
        }

        .metric-card {
            background: var(--card);
            padding: 24px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
            position: relative;
            overflow: hidden;
        }
        
        .metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 90px;
            height: 90px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .metric-label {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .metric-value {
            font-size: 38px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 10px;
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .metric-trend {
            font-size: 13px;
            padding: 6px 14px;
            border-radius: 10px;
            display: inline-block;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .trend-up {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }

        .trend-down {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }

        .trend-neutral {
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
            color: #3730a3;
        }

        .insights-section {
            background: var(--card);
            padding: 28px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 32px;
            border: 1px solid var(--line);
            transition: all 0.3s ease;
        }
        
        .insights-section:hover {
            box-shadow: var(--shadow-lg);
        }

        .insights-section h3 {
            color: #111827;
            margin-bottom: 28px;
            font-size: 22px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.02em;
        }

        .insight-item {
            padding: 20px;
            margin-bottom: 16px;
            border-left: 4px solid var(--accent);
            background: #f8fafc;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .insight-item:hover {
            background: #f1f5f9;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.12);
            transform: translateX(4px);
        }

        .insight-item h4 {
            color: #059669;
            margin-bottom: 10px;
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.01em;
        }

        .insight-item p {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.7;
            font-weight: 500;
        }

        .charts-section {
            margin-bottom: 40px;
            animation: staffFadeInUp 0.6s ease-out 0.2s both;
        }

        .section-title {
            font-size: 24px;
            color: #111827;
            font-weight: 800;
            margin-bottom: 28px;
            padding-left: 6px;
            letter-spacing: -0.02em;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 28px;
        }

        .chart-card {
            background: var(--card);
            padding: 28px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            border: 1px solid var(--line);
        }

        .chart-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        @keyframes pageEnter {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chart-card h3 {
            color: #111827;
            margin-bottom: 28px;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -0.01em;
        }

        .chart-container {
            position: relative;
            height: 320px;
        }

        @media (max-width: 1200px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="<?php echo e(route('dashboard')); ?>" class="navbar-brand">
                <img src="<?php echo e(asset('newlogo.png')); ?>" alt="PAWSER" class="navbar-logo">
                <div class="navbar-brand-text">
                    <div class="navbar-title">PAWSER</div>
                    <div class="navbar-subtitle">Staff Dashboard</div>
                </div>
            </a>

            <div class="navbar-menu">
                <a href="<?php echo e(route('dashboard')); ?>" class="navbar-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
                <a href="<?php echo e(route('pets.index')); ?>" class="navbar-item <?php echo e(request()->routeIs('pets.*') ? 'active' : ''); ?>">
                    <i class="bi bi-heart-fill"></i>
                    Pets
                </a>
                <a href="<?php echo e(route('appointments.index')); ?>" class="navbar-item <?php echo e(request()->routeIs('appointments.*') ? 'active' : ''); ?>">
                    <i class="bi bi-calendar-check"></i>
                    Appointments
                </a>
                <?php if(Auth::user()->hasStaffAccess()): ?>
                <a href="<?php echo e(route('appointment-requests.index')); ?>" class="navbar-item <?php echo e(request()->routeIs('appointment-requests.*') ? 'active' : ''); ?>">
                    <i class="bi bi-inbox-fill"></i>
                    Requests
                </a>
                <?php endif; ?>
                <a href="<?php echo e(route('visits.today')); ?>" class="navbar-item <?php echo e(request()->routeIs('visits.*') ? 'active' : ''); ?>">
                    <i class="bi bi-clock-history"></i>
                    Visits
                </a>
                <?php if(Auth::user()->hasStaffAccess()): ?>
                <a href="<?php echo e(route('analytics.index')); ?>" class="navbar-item <?php echo e(request()->routeIs('analytics.*') ? 'active' : ''); ?>">
                    <i class="bi bi-graph-up-arrow"></i>
                    Insights
                </a>
                <a href="<?php echo e(route('automation.support')); ?>" class="navbar-item <?php echo e(request()->routeIs('automation.*') ? 'active' : ''); ?>">
                    <i class="bi bi-cpu"></i>
                    Actions
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
                    <button type="submit" class="navbar-logout-btn" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h1>
                    <span>Insight Center</span>
                </h1>
                <p>Advanced insights and predictive analytics for data-driven veterinary care decisions</p>
            </div>
        </div>

        <!-- Key Metrics -->
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-label">Total Pets Registered</div>
                <div class="metric-value"><?php echo e(number_format($metrics['total_patients'])); ?></div>
                <span class="metric-trend trend-neutral">All time</span>
            </div>

            <div class="metric-card" style="border-left-color: #f59e0b;">
                <div class="metric-label">Appointments This Month</div>
                <div class="metric-value" style="color: #d97706;"><?php echo e(number_format($metrics['appointments_this_month'])); ?></div>
                <span class="metric-trend <?php echo e($metrics['appointment_growth_rate'] > 0 ? 'trend-up' : ($metrics['appointment_growth_rate'] < 0 ? 'trend-down' : 'trend-neutral')); ?>">
                    <?php echo e($metrics['appointment_growth_rate'] > 0 ? '+' : ''); ?><?php echo e($metrics['appointment_growth_rate']); ?>% vs last month
                </span>
            </div>

            <div class="metric-card" style="border-left-color: #8b5cf6;">
                <div class="metric-label">Appointment Completion Rate</div>
                <div class="metric-value" style="color: #7c3aed;"><?php echo e($metrics['appointment_completion']); ?>%</div>
                <span class="metric-trend trend-neutral"><?php echo e(number_format($metrics['completed_appointments'])); ?> of <?php echo e(number_format($metrics['total_appointments'])); ?> total</span>
            </div>

            <div class="metric-card" style="border-left-color: #10b981;">
                <div class="metric-label">Upcoming (Next 7 Days)</div>
                <div class="metric-value" style="color: #059669;"><?php echo e(number_format($metrics['upcoming_appointments'])); ?></div>
                <span class="metric-trend trend-up">Scheduled appointments</span>
            </div>

            <div class="metric-card">
                <div class="metric-label">Visits This Month</div>
                <div class="metric-value"><?php echo e(number_format($metrics['current_month_visits'])); ?></div>
                <span class="metric-trend <?php echo e($metrics['visit_growth_rate'] > 0 ? 'trend-up' : ($metrics['visit_growth_rate'] < 0 ? 'trend-down' : 'trend-neutral')); ?>">
                    <?php echo e($metrics['visit_growth_rate'] > 0 ? '+' : ''); ?><?php echo e($metrics['visit_growth_rate']); ?>% vs last month
                </span>
            </div>

        </div>

        <!-- Predictive Insights -->
        <div class="insights-section">
            <h3><i class="bi bi-lightbulb-fill"></i> Predictive Insights &amp; Recommendations</h3>

            <div class="insight-item">
                <h4>Appointment Forecast</h4>
                <p>This month has <strong><?php echo e($metrics['appointments_this_month']); ?> appointments</strong> booked
                    (<?php echo e($metrics['appointment_growth_rate'] > 0 ? '+' : ''); ?><?php echo e($metrics['appointment_growth_rate']); ?>% vs last month).
                    <strong><?php echo e($metrics['upcoming_appointments']); ?> more</strong> are scheduled for the next 7 days.
                    Appointment completion rate is <strong><?php echo e($metrics['appointment_completion']); ?>%</strong>
                    G�� <?php echo e($metrics['no_show_appointments']); ?> no-show<?php echo e($metrics['no_show_appointments'] == 1 ? '' : 's'); ?> and
                    <?php echo e($metrics['cancelled_appointments']); ?> cancellation<?php echo e($metrics['cancelled_appointments'] == 1 ? '' : 's'); ?> recorded.</p>
            </div>

            <div class="insight-item">
                <h4>Visit Forecast</h4>
                <p>Based on the last 3 months average (<?php echo e($metrics['avg_monthly_visits']); ?> visits/month) and current growth rate (<?php echo e($metrics['visit_growth_rate']); ?>%), we predict approximately <strong><?php echo e($metrics['predicted_next_month']); ?> clinic visits next month</strong>. Adjust staffing accordingly.</p>
            </div>

            <?php if($metrics['appointment_growth_rate'] > 20): ?>
            <div class="insight-item">
                <h4>High Appointment Demand</h4>
                <p>Appointments have surged by <strong>+<?php echo e($metrics['appointment_growth_rate']); ?>%</strong> this month. Consider extending available time slots or adding a second grooming/consultation session to handle demand.</p>
            </div>
            <?php elseif($metrics['appointment_growth_rate'] < -20): ?>
            <div class="insight-item">
                <h4>Declining Appointment Trend</h4>
                <p>Appointments dropped by <strong><?php echo e(abs($metrics['appointment_growth_rate'])); ?>%</strong> this month. Consider promotional outreach (e.g. grooming discounts, vaccination reminders) to re-engage owners.</p>
            </div>
            <?php endif; ?>

            <?php if($metrics['visit_growth_rate'] > 15): ?>
            <div class="insight-item">
                <h4>High Visit Growth Alert</h4>
                <p>Pet visits are increasing significantly (+<?php echo e($metrics['visit_growth_rate']); ?>%). This indicates growing demand. Recommend expanding clinic hours or adding staff to maintain service quality.</p>
            </div>
            <?php elseif($metrics['visit_growth_rate'] < -15): ?>
            <div class="insight-item">
                <h4>Declining Visit Trend Alert</h4>
                <p>Pet visits have decreased by <?php echo e(abs($metrics['visit_growth_rate'])); ?>%. Consider community outreach programs or reviewing service accessibility to re-engage pet owners.</p>
            </div>
            <?php endif; ?>

        </div>

        <!-- Pet Activity & Retention Analytics -->
        <div class="insights-section" style="margin-top: 32px;">
            <h3><i class="bi bi-graph-up-arrow"></i> Pet Activity & Retention Predictive Analytics</h3>
            
            <div class="metrics-grid" style="margin-bottom: 24px;">
                <div class="metric-card">
                    <div class="metric-label">Active Pets (30 days)</div>
                    <div class="metric-value"><?php echo e(number_format($patientActivityMetrics['patients_with_recent_visits'])); ?></div>
                    <span class="metric-trend trend-up"><?php echo e($metrics['total_patients'] > 0 ? round(($patientActivityMetrics['patients_with_recent_visits'] / $metrics['total_patients']) * 100, 1) : 0); ?>% of total</span>
                </div>

                <div class="metric-card">
                    <div class="metric-label">Inactive Pets (90+ days)</div>
                    <div class="metric-value"><?php echo e(number_format($patientActivityMetrics['inactive_patients'])); ?></div>
                    <span class="metric-trend trend-down">Need re-engagement</span>
                </div>

                <div class="metric-card">
                    <div class="metric-label">Never Visited</div>
                    <div class="metric-value"><?php echo e(number_format($patientActivityMetrics['never_visited'])); ?></div>
                    <span class="metric-trend trend-neutral">Registered only</span>
                </div>

                <div class="metric-card">
                    <div class="metric-label">Pet Retention Rate</div>
                    <div class="metric-value"><?php echo e($patientActivityMetrics['retention_rate']); ?>%</div>
                    <span class="metric-trend <?php echo e($patientActivityMetrics['retention_rate'] >= 70 ? 'trend-up' : 'trend-down'); ?>">
                        <?php echo e($patientActivityMetrics['retention_rate'] >= 70 ? 'Good retention' : 'Needs improvement'); ?>

                    </span>
                </div>
            </div>

            <div class="insight-item">
                <h4><i class="bi bi-people-fill"></i> Pet Visit Patterns</h4>
                <p>Out of <strong><?php echo e(number_format($metrics['total_patients'])); ?> total pets</strong>, <strong><?php echo e(number_format($patientActivityMetrics['patients_with_recent_visits'])); ?> pets (<?php echo e($metrics['total_patients'] > 0 ? round(($patientActivityMetrics['patients_with_recent_visits'] / $metrics['total_patients']) * 100, 1) : 0); ?>%) have visited in the last 30 days</strong>. Meanwhile, <strong><?php echo e(number_format($patientActivityMetrics['inactive_patients'])); ?> pets</strong> haven't visited in over 90 days and may need follow-up contact.</p>
            </div>

            <?php if($patientActivityMetrics['at_risk_patients'] > 0): ?>
            <div class="insight-item">
                <h4><i class="bi bi-exclamation-circle-fill"></i> At-Risk Pet Alert</h4>
                <p><strong><?php echo e(number_format($patientActivityMetrics['at_risk_patients'])); ?> pets</strong> are at risk of becoming inactive. They last visited 60-90 days ago. Consider proactive outreach through SMS reminders or calls to re-engage pet owners before they become fully inactive.</p>
            </div>
            <?php endif; ?>

            <?php if($patientActivityMetrics['never_visited'] > 0): ?>
            <div class="insight-item">
                <h4><i class="bi bi-clipboard-data"></i> Never Visited Pets</h4>
                <p><strong><?php echo e(number_format($patientActivityMetrics['never_visited'])); ?> pets (<?php echo e($metrics['total_patients'] > 0 ? round(($patientActivityMetrics['never_visited'] / $metrics['total_patients']) * 100, 1) : 0); ?>%)</strong> are registered but have never visited the clinic. These may be pre-registered pets or those who registered but didn't complete their first visit. Follow up to confirm their records and encourage a first visit.</p>
            </div>
            <?php endif; ?>

            <?php if($patientActivityMetrics['retention_rate'] < 70): ?>
            <div class="insight-item">
                <h4><i class="bi bi-arrow-down-circle-fill"></i> Low Retention Warning</h4>
                <p>Current pet retention rate is <strong><?php echo e($patientActivityMetrics['retention_rate']); ?>%</strong>, which is below the recommended 70% threshold. This indicates that many pets are not returning for follow-up care. Recommended actions: implement automated appointment reminders, conduct client satisfaction surveys, and improve follow-up protocols.</p>
            </div>
            <?php elseif($patientActivityMetrics['retention_rate'] >= 80): ?>
            <div class="insight-item">
                <h4><i class="bi bi-check-circle-fill"></i> Excellent Retention</h4>
                <p>Pet retention rate of <strong><?php echo e($patientActivityMetrics['retention_rate']); ?>%</strong> is excellent! Pets are regularly returning for care, indicating good service quality and effective follow-up systems. Continue current practices and consider documenting successful strategies.</p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Charts Section -->
        <div class="charts-section">
            <h2 class="section-title"><i class="bi bi-bar-chart-fill"></i> Visual Analytics</h2>

            <div class="charts-grid">
                <!-- Pet Registration Trend -->
                <div class="chart-card">
                    <h3><i class="bi bi-graph-up"></i> Pet Registration Trend (6 Months)</h3>
                    <div class="chart-container">
                        <canvas id="patientGrowthChart"></canvas>
                    </div>
                </div>

                <!-- Appointment Trend -->
                <div class="chart-card">
                    <h3><i class="bi bi-calendar-check"></i> Appointment Trend (6 Months)</h3>
                    <div class="chart-container">
                        <canvas id="appointmentTrendChart"></canvas>
                    </div>
                </div>

                <!-- Daily Visit Patterns -->
                <div class="chart-card">
                    <h3><i class="bi bi-hospital"></i> Daily Visit Patterns (30 Days)</h3>
                    <div class="chart-container">
                        <canvas id="visitTrendsChart"></canvas>
                    </div>
                </div>

                <!-- Appointment Service Distribution -->
                <div class="chart-card">
                    <h3><i class="bi bi-bullseye"></i> Appointment Service Breakdown</h3>
                    <div class="chart-container">
                        <canvas id="serviceDistributionChart"></canvas>
                    </div>
                </div>

                <!-- Appointment Status -->
                <div class="chart-card">
                    <h3><i class="bi bi-pie-chart-fill"></i> Appointment Status Breakdown</h3>
                    <div class="chart-container">
                        <canvas id="appointmentStatusChart"></canvas>
                    </div>
                </div>

                <!-- Species Distribution -->
                <div class="chart-card">
                    <h3><i class="bi bi-heart-fill"></i> Species Distribution</h3>
                    <div class="chart-container">
                        <canvas id="speciesDistributionChart"></canvas>
                    </div>
                </div>

                <!-- Age Demographics -->
                <div class="chart-card">
                    <h3><i class="bi bi-people-fill"></i> Pet Age Distribution</h3>
                    <div class="chart-container">
                        <canvas id="ageDemographicsChart"></canvas>
                    </div>
                </div>

                <!-- Sex Distribution -->
                <div class="chart-card">
                    <h3><i class="bi bi-person-badge"></i> Sex Distribution</h3>
                    <div class="chart-container">
                        <canvas id="genderDistributionChart"></canvas>
                    </div>
                </div>

                <!-- Top Complaints -->
                <div class="chart-card">
                    <h3><i class="bi bi-chat-text"></i> Top Chief Complaints</h3>
                    <div class="chart-container">
                        <canvas id="topComplaintsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
        Chart.defaults.color = '#6b7280';

        const PALETTE = ['#059669','#f59e0b','#3b82f6','#8b5cf6','#ec4899','#14b8a6','#ef4444','#f97316','#6366f1','#84cc16'];

        // G��G�� Pet Registration Trend G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��
        new Chart(document.getElementById('patientGrowthChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($patientGrowth->pluck('month')); ?>,
                datasets: [{
                    label: 'New Pets',
                    data: <?php echo json_encode($patientGrowth->pluck('count')); ?>,
                    borderColor: '#059669',
                    backgroundColor: 'rgba(5,150,105,0.1)',
                    fill: true, tension: 0.4, pointRadius: 4
                }]
            },
            options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}},
                scales:{y:{beginAtZero:true,ticks:{precision:0}}} }
        });

        // G��G�� Appointment Trend G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��
        new Chart(document.getElementById('appointmentTrendChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($appointmentTrend->pluck('month')); ?>,
                datasets: [{
                    label: 'Appointments',
                    data: <?php echo json_encode($appointmentTrend->pluck('count')); ?>,
                    backgroundColor: 'rgba(245,158,11,0.8)',
                    borderColor: '#d97706', borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}},
                scales:{y:{beginAtZero:true,ticks:{precision:0}}} }
        });

        // G��G�� Daily Visit Patterns G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��
        new Chart(document.getElementById('visitTrendsChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($visitTrends->pluck('date')); ?>,
                datasets: [{
                    label: 'Daily Visits',
                    data: <?php echo json_encode($visitTrends->pluck('count')); ?>,
                    borderColor: '#047857',
                    backgroundColor: 'rgba(4,120,87,0.1)',
                    fill: true, tension: 0.4, pointRadius: 3
                }]
            },
            options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}},
                scales:{y:{beginAtZero:true,ticks:{precision:0}}} }
        });

        // G��G�� Appointment Service Breakdown G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��
        new Chart(document.getElementById('serviceDistributionChart'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($appointmentServiceDistribution->pluck('service_type')); ?>,
                datasets: [{ data: <?php echo json_encode($appointmentServiceDistribution->pluck('count')); ?>,
                    backgroundColor: PALETTE }]
            },
            options: { responsive:true, maintainAspectRatio:false,
                plugins:{ legend:{ position:'bottom', labels:{boxWidth:12,padding:10,font:{size:11}} } } }
        });

        // G��G�� Appointment Status G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��
        new Chart(document.getElementById('appointmentStatusChart'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($appointmentStatusBreakdown->pluck('status')->map(fn($s) => ucfirst($s))); ?>,
                datasets: [{ data: <?php echo json_encode($appointmentStatusBreakdown->pluck('count')); ?>,
                    backgroundColor: ['#059669','#f59e0b','#ef4444','#6b7280','#3b82f6'] }]
            },
            options: { responsive:true, maintainAspectRatio:false,
                plugins:{ legend:{ position:'bottom', labels:{boxWidth:12,padding:10,font:{size:11}} } } }
        });

        // G��G�� Species Distribution G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��
        new Chart(document.getElementById('speciesDistributionChart'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($speciesDistribution->pluck('species')); ?>,
                datasets: [{ data: <?php echo json_encode($speciesDistribution->pluck('count')); ?>,
                    backgroundColor: PALETTE }]
            },
            options: { responsive:true, maintainAspectRatio:false,
                plugins:{ legend:{ position:'bottom', labels:{boxWidth:12,padding:10,font:{size:11}} } } }
        });

        // G��G�� Pet Age Distribution G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��
        new Chart(document.getElementById('ageDemographicsChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($ageDemographics->pluck('age_group')); ?>,
                datasets: [{
                    label: 'Pets',
                    data: <?php echo json_encode($ageDemographics->pluck('count')); ?>,
                    backgroundColor: 'rgba(5,150,105,0.8)',
                    borderColor: '#059669', borderWidth: 1, borderRadius: 5
                }]
            },
            options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}},
                scales:{y:{beginAtZero:true,ticks:{precision:0}}} }
        });

        // G��G�� Sex Distribution G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��
        new Chart(document.getElementById('genderDistributionChart'), {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($genderDistribution->pluck('sex')); ?>,
                datasets: [{ data: <?php echo json_encode($genderDistribution->pluck('count')); ?>,
                    backgroundColor: ['#059669','#f59e0b','#3b82f6'] }]
            },
            options: { responsive:true, maintainAspectRatio:false,
                plugins:{ legend:{ position:'bottom', labels:{boxWidth:12,padding:10} } } }
        });

        // G��G�� Top Chief Complaints G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��G��
        new Chart(document.getElementById('topComplaintsChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($topComplaints->pluck('chief_complaint')); ?>,
                datasets: [{
                    label: 'Occurrences',
                    data: <?php echo json_encode($topComplaints->pluck('count')); ?>,
                    backgroundColor: PALETTE
                }]
            },
            options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}},
                scales:{y:{beginAtZero:true,ticks:{precision:0}}} }
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\keeia\OneDrive\Documents\Capstone1-web-mayerror\capstone\resources\views/insight-center.blade.php ENDPATH**/ ?>