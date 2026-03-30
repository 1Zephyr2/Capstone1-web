<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Today's Visits - PAWser</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
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
            --radius: 12px;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--bg) 0%, var(--bg-alt) 100%);
            padding: 0;
            padding-top: 72px;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            color: var(--text);
            display: flex;
            flex-direction: column;
        }

        body::before,
        body::after {
            content: '';
            position: fixed;
            z-index: -1;
            border-radius: 50%;
        }

        body::before {
            width: 420px;
            height: 420px;
            top: -140px;
            right: -120px;
            background: radial-gradient(circle, rgba(20, 184, 166, 0.18) 0%, rgba(20, 184, 166, 0) 70%);
        }

        body::after {
            width: 360px;
            height: 360px;
            bottom: -160px;
            left: -100px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.16) 0%, rgba(6, 182, 212, 0) 70%);
        }
        /* Top Navigation Bar */
        .navbar {
            background: #1e293b;
            color: white;
            padding: 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            height: 72px;
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

        .navbar-profile-btn {
            padding: 6px 12px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .navbar-profile-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        .navbar-logout-btn {
            padding: 6px 12px;
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .navbar-logout-btn:hover {
            background: rgba(239, 68, 68, 0.25);
            border-color: rgba(239, 68, 68, 0.5);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .navbar-menu {
                gap: 4px;
            }

            .navbar-item {
                padding: 6px 10px;
                font-size: 12px;
                gap: 4px;
            }

            .navbar-item span {
                display: none;
            }

            .navbar-user-text {
                display: none;
            }

            .navbar-container {
                padding: 0 12px;
                gap: 12px;
            }

            .navbar-item i {
                font-size: 18px;
            }
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
            flex: 1;
            width: 100%;
        }
        .header {
            background: var(--card);
            padding: 24px;
            border-radius: var(--radius);
            margin-bottom: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
            transition: all 0.3s ease;
            animation: pageEnter 0.5s ease;
        }
        
        .header:hover {
            box-shadow: var(--shadow-lg);
        }
        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 12px;
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-actions {
            margin-left: auto;
            display: flex;
            gap: 10px;
        }
        .header-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: inherit;
            transition: opacity 0.2s;
        }
        .header-logo:hover {
            opacity: 0.8;
        }
        .header-logo-text {
            font-size: 18px;
            font-weight: 600;
            color: #14b8a6;
        }
        h1 {
            color: var(--text);
            margin: 0;
            flex: 1;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        .stat-card,
        .stat-item {
            background: var(--card);
            padding: 22px;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover,
        .stat-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        .stat-value {
            font-size: 30px;
            font-weight: 800;
            color: var(--primary);
        }
        .stat-label {
            color: var(--muted);
            font-size: 13px;
            margin-top: 6px;
        }
        .visits-container {
            display: grid;
            gap: 16px;
        }
        /* Owner group accordion */
        .owner-group-card {
            background: var(--card);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
            overflow: hidden;
            transition: box-shadow 0.2s;
        }
        .owner-group-card:hover {
            box-shadow: var(--shadow-lg);
        }
        .owner-group-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            cursor: pointer;
            background: #f8fafc;
            border-bottom: 1px solid transparent;
            transition: background 0.2s, border-color 0.2s;
            user-select: none;
        }
        .owner-group-header:hover { background: #eff6ff; }
        .owner-group-header.open {
            background: #eff6ff;
            border-bottom-color: var(--line);
        }
        .owner-group-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .owner-icon {
            width: 40px;
            height: 40px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }
        .owner-group-name {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
        }
        .owner-group-meta {
            font-size: 13px;
            color: #6b7280;
            margin-top: 2px;
        }
        .owner-chevron {
            font-size: 16px;
            color: #6b7280;
            transition: transform 0.25s ease;
        }
        .owner-group-header.open .owner-chevron { transform: rotate(180deg); }
        /* Pet rows inside owner group */
        .owner-pets-list { display: none; }
        .owner-pets-list.open { display: block; }
        .pet-visit-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            border-bottom: 1px solid #f3f4f6;
            border-left: 4px solid var(--primary);
            cursor: pointer;
            transition: background 0.15s, border-left-color 0.15s;
        }
        .pet-visit-row:last-child { border-bottom: none; }
        .pet-visit-row:hover {
            background: #f0fdf4;
            border-left-color: var(--accent);
        }
        .pet-visit-left { flex: 1; }
        .pet-visit-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .click-hint {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 4px;
        }
        
        /* Modal Styles */
        .visit-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .visit-modal.active {
            display: flex;
        }
        .visit-modal-content {
            background: white;
            border-radius: 12px;
            max-width: 800px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        .visit-modal-header {
            padding: 24px;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
            border-radius: 12px 12px 0 0;
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 28px;
            color: #6b7280;
            cursor: pointer;
            padding: 0;
            line-height: 1;
            transition: color 0.2s;
        }
        .modal-close:hover {
            color: #111827;
        }
        .visit-modal-body {
            padding: 24px;
        }
        .modal-patient-header {
            margin-bottom: 20px;
        }
        .visit-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }
        .visit-patient {
            flex: 1;
        }
        .patient-name {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }
        .patient-info {
            display: flex;
            gap: 16px;
            color: #6b7280;
            font-size: 14px;
        }
        .visit-time {
            color: #6b7280;
            font-size: 14px;
        }
        .service-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            margin-top: 8px;
        }
        .service-general { background: #dbeafe; color: #1e40af; }
        .service-vaccination { background: #fef3c7; color: #92400e; }
        .service-breeding { background: #fce7f3; color: #9f1239; }
        .service-surgery { background: #fee2e2; color: #991b1b; }
        .service-wellness { background: #d1fae5; color: #065f46; }
        .service-dental { background: #e0e7ff; color: #3730a3; }
        .service-emergency { background: #fee2e2; color: #991b1b; }
        .service-other { background: #f3f4f6; color: #374151; }
        .service-other { background: #e5e7eb; color: #374151; }
        .vital-signs {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
        }
        .vital-item {
            display: flex;
            flex-direction: column;
        }
        .vital-label {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 2px;
        }
        .vital-value {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
        }
        .complaint {
            margin-top: 12px;
            padding: 12px;
            background: #f9fafb;
            border-radius: 6px;
        }
        .complaint-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
            margin-bottom: 4px;
        }
        .complaint-text {
            color: #374151;
            font-size: 14px;
        }
        .health-worker {
            margin-top: 12px;
            padding: 10px 12px;
            background: #ecfdf5;
            border-radius: 6px;
            border-left: 3px solid #10b981;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .health-worker-label {
            font-size: 13px;
            color: #047857;
            font-weight: 600;
        }
        .health-worker-name {
            font-size: 13px;
            color: #065f46;
        }
        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: var(--muted);
            background: var(--card);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
        }
        .empty-state svg {
            width: 64px;
            height: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #1f2937;
        }
        
        /* Photo Gallery Styles */
        .modal-photo-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            background: #f3f4f6;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .modal-photo-item:hover {
            transform: scale(1.05);
        }
        .modal-photo-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
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
    </style>
</head>
<body>
    <x-staff-navbar />
    <!-- CALENDAR MODAL - SYNCHRONIZED WITH DASHBOARD -->
    <div id="visitsCalendarModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 10000; align-items: center; justify-content: center;" onclick="closeCalendarModal(event)">
        <div style="background: white; border-radius: 12px; max-width: 750px; width: 90%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);" onclick="event.stopPropagation()">
            <div style="background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); padding: 20px; border-radius: 12px 12px 0 0; display: flex; justify-content: space-between; align-items: center;">
                <h2 style="margin: 0; color: white; font-size: 20px;"><i class="bi bi-calendar-week"></i> Appointments Calendar</h2>
                <button onclick="closeCalendarModal()" style="background: rgba(255,255,255,0.2); border: none; color: white; font-size: 24px; cursor: pointer; width: 36px; height: 36px; border-radius: 50%; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">×</button>
            </div>
            <div style="padding: 20px;">
                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <button onclick="visitsChangeMonth(-1)" style="padding: 8px 16px; background: #10b981; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">← Previous</button>
                        <h3 id="visitsCurrentMonth" style="margin: 0;">February 2026</h3>
                        <button onclick="visitsChangeMonth(1)" style="padding: 8px 16px; background: #10b981; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">Next →</button>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; margin-bottom: 8px;">
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Sun</div>
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Mon</div>
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Tue</div>
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Wed</div>
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Thu</div>
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Fri</div>
                        <div style="font-weight: 600; color: #6b7280; padding: 8px; font-size: 13px;">Sat</div>
                    </div>
                    <div id="visitsCalendarDays" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px;"></div>
                </div>
                <div id="visitsSelectedDateInfo" style="display: none; padding: 20px; background: #f9fafb; border-radius: 8px; border: 2px solid #10b981;">
                    <h3 id="visitsSelectedDateTitle" style="margin: 0 0 16px 0; color: #111827;"></h3>
                    <div id="visitsAppointmentsList"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="header">
            <div class="header-top">
                <div class="header-left">
                    <h1>Today's Visits</h1>
                </div>
                <div class="header-actions">
                    <button onclick="openAppointmentsCalendar()" class="btn-calendar" style="padding: 8px 16px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.3); transition: all 0.2s; display: flex; align-items: center; gap: 6px;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 6px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(16, 185, 129, 0.3)'">
                        <i class="bi bi-calendar3"></i> View Calendar
                    </button>
                </div>
            </div>
            <p style="color: #6b7280; font-size: 14px;">{{ now()->format('l, F j, Y') }}</p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-value" id="totalVisitsToday">0</div>
                <div class="stat-label">Total Completed Today</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="groomingServicesToday">0</div>
                <div class="stat-label">Grooming</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="medicalServicesToday">0</div>
                <div class="stat-label">Medical</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-color: #fcd34d;">
                <div class="stat-value" id="otherServicesToday" style="color: #d97706;">0</div>
                <div class="stat-label" style="color: #92400e;">Other</div>
            </div>
        </div>

        <div style="margin-bottom: 20px; display: flex; gap: 12px; align-items: center;">
            <input type="date" id="filterDate" style="padding: 8px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;" />
            <input type="text" id="searchVisits" placeholder="Search by owner name..." style="padding: 8px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px; flex: 1;" />
            <button onclick="resetFilters()" style="padding: 8px 16px; background: #f3f4f6; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">Reset</button>
        </div>

        <div id="visitsListContainer" style="margin-top: 20px;"></div>

    <!-- Visit Details Modal -->
    <div id="visitModal" class="visit-modal">
        <div class="visit-modal-content">
            <div class="visit-modal-header">
                <div>
                    <h2 id="modalPatientName" style="margin: 0; color: #047857; font-size: 24px;"></h2>
                    <p id="modalPatientInfo" style="color: #6b7280; margin-top: 4px; font-size: 14px;"></p>
                </div>
                <button class="modal-close" onclick="closeVisitModal()">×</button>
            </div>
            <div class="visit-modal-body">
                <div class="modal-patient-header">
                    <div style="display: flex; gap: 12px; margin-bottom: 12px;">
                        <span id="modalServiceBadge" class="service-badge"></span>
                        <span id="modalVisitTime" style="color: #6b7280; font-size: 14px;"></span>
                    </div>
                </div>

                <div id="modalChiefComplaint" class="complaint" style="display: none;">
                    <div class="complaint-label">Chief Complaint:</div>
                    <div class="complaint-text" id="modalChiefComplaintText"></div>
                </div>

                <div id="modalNotes" class="complaint" style="display: none; margin-top: 16px;">
                    <div class="complaint-label">Notes/Recommendations:</div>
                    <div class="complaint-text" id="modalNotesText"></div>
                </div>

                <div id="modalHealthWorker" class="health-worker" style="display: none; margin-top: 16px;">
                    <span class="health-worker-label"><i class="bi bi-person-badge"></i> Veterinarian:</span>
                    <span class="health-worker-name" id="modalHealthWorkerName"></span>
                </div>

                <div id="modalWalkInStatus" style="display: none; margin-top: 16px; padding: 12px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 6px; border-left: 3px solid #d97706; display: flex; align-items: center; gap: 8px;">
                    <i class="bi bi-exclamation-circle-fill" style="color: #d97706; font-size: 18px;"></i>
                    <div>
                        <div style="font-size: 13px; color: #92400e; font-weight: 600;">Walk-in Appointment</div>
                        <div style="font-size: 12px; color: #b45309;">This is an unscheduled walk-in customer</div>
                    </div>
                </div>

                <!-- Service-Specific Details -->
                <div id="modalGroomingDetails" style="display: none; margin-top: 16px;"></div>

                <!-- Photos Gallery -->
                <div id="modalPhotosSection" style="display: none; margin-top: 20px;">
                    <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 12px;"><i class="bi bi-images" style="color: #14b8a6; margin-right: 6px;"></i>Visit Photos</h3>
                    <div id="modalPhotosGallery" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 12px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const visitsData = @json($visits);
        const visits = visitsData.data || visitsData;

        // Calculate and display statistics
        function calculateStats() {
            if (!visits || visits.length === 0) {
                document.getElementById('totalVisitsToday').textContent = '0';
                document.getElementById('groomingServicesToday').textContent = '0';
                document.getElementById('medicalServicesToday').textContent = '0';
                document.getElementById('otherServicesToday').textContent = '0';
                return;
            }

            const totalVisits = visits.length;
            
            // Grooming services
            const groomingServices = ['Bath & Dry', 'Full Grooming', 'Haircut & Styling', 'Nail Trimming', 'Ear Cleaning', 'Teeth Brushing', 'De-shedding Treatment', 'Flea & Tick Treatment', 'Paw Treatment'];
            const groomingCount = visits.filter(v => groomingServices.includes(v.service_type)).length;
            
            // Medical services
            const medicalServices = ['Vaccination', 'Spay/Neuter', 'Dental Cleaning', 'Deworming', 'General Checkup', 'Wound Treatment'];
            const medicalCount = visits.filter(v => medicalServices.includes(v.service_type)).length;
            
            // Other services (everything else: Boarding Checkup, Follow-up, Referral, Other)
            const otherCount = totalVisits - groomingCount - medicalCount;

            document.getElementById('totalVisitsToday').textContent = totalVisits;
            document.getElementById('groomingServicesToday').textContent = groomingCount;
            document.getElementById('medicalServicesToday').textContent = medicalCount;
            document.getElementById('otherServicesToday').textContent = otherCount;
        }

        // Calculate stats when page loads
        calculateStats();

        function toggleOwnerGroup(header) {
            header.classList.toggle('open');
            header.nextElementSibling.classList.toggle('open');
        }

        function openVisitModal(visitId) {
            // Fetch visit details via AJAX
            fetch(`/api/visits/${visitId}/details`)
                .then(response => response.json())
                .then(result => {
                    if (!result.success) {
                        console.error('Failed to fetch visit details');
                        return;
                    }

                    const visit = result.data;

                    // Set patient name and info
                    document.getElementById('modalPatientName').textContent = visit.pet_name;
                    document.getElementById('modalPatientInfo').textContent = 
                        `Owner: ${visit.owner_name} • Date: ${visit.visit_date} • Time: ${visit.visit_time}`;

                    // Set service badge
                    const serviceBadge = document.getElementById('modalServiceBadge');
                    serviceBadge.textContent = visit.service_type;
                    serviceBadge.className = `service-badge service-${visit.service_type.toLowerCase().replace(/ /g, '-')}`;
                    
                    document.getElementById('modalVisitTime').textContent = 
                        `<i class="bi bi-clock"></i> ${visit.visit_time}`;

                    // Set health worker
                    if (visit.health_worker) {
                        document.getElementById('modalHealthWorkerName').textContent = visit.health_worker;
                        document.getElementById('modalHealthWorker').style.display = 'flex';
                    } else {
                        document.getElementById('modalHealthWorker').style.display = 'none';
                    }

                    // Display grooming details
                    let groomingDetailsHTML = '';
                    if (visit.coat_condition || visit.behavior || visit.grooming_notes) {
                        groomingDetailsHTML += '<div style="padding: 12px; background: #f9fafb; border-radius: 8px; border: 1px solid #e5e7eb;">';
                        if (visit.coat_condition) {
                            groomingDetailsHTML += `<p style="margin: 0 0 8px 0;"><strong style="color: #6b7280;">Coat Condition:</strong> ${visit.coat_condition}</p>`;
                        }
                        if (visit.behavior) {
                            groomingDetailsHTML += `<p style="margin: 0 0 8px 0;"><strong style="color: #6b7280;">Pet Behavior:</strong> ${visit.behavior}</p>`;
                        }
                        if (visit.grooming_notes) {
                            groomingDetailsHTML += `<p style="margin: 0;"><strong style="color: #6b7280;">Grooming Notes:</strong><br>${visit.grooming_notes}</p>`;
                        }
                        groomingDetailsHTML += '</div>';
                    }

                    // Add service-specific fields
                    if (visit.flea_tick_product || visit.flea_tick_area) {
                        groomingDetailsHTML += '<div style="padding: 12px; background: #fef3c7; border-radius: 8px; margin-top: 12px; border: 1px solid #fcd34d;">';
                        if (visit.flea_tick_product) {
                            groomingDetailsHTML += `<p style="margin: 0 0 6px 0;"><strong>Product Used:</strong> ${visit.flea_tick_product}</p>`;
                        }
                        if (visit.flea_tick_area) {
                            groomingDetailsHTML += `<p style="margin: 0;"><strong>Area Treated:</strong> ${visit.flea_tick_area}</p>`;
                        }
                        groomingDetailsHTML += '</div>';
                    }

                    if (visit.nail_condition_before || visit.nail_condition_after) {
                        groomingDetailsHTML += '<div style="padding: 12px; background: #e0e7ff; border-radius: 8px; margin-top: 12px; border: 1px solid #c7d2fe;">';
                        if (visit.nail_condition_before) {
                            groomingDetailsHTML += `<p style="margin: 0 0 6px 0;"><strong>Before:</strong> ${visit.nail_condition_before}</p>`;
                        }
                        if (visit.nail_condition_after) {
                            groomingDetailsHTML += `<p style="margin: 0;"><strong>After:</strong> ${visit.nail_condition_after}</p>`;
                        }
                        groomingDetailsHTML += '</div>';
                    }

                    if (visit.dental_notes) {
                        groomingDetailsHTML += `<div style="padding: 12px; background: #f0fdf4; border-radius: 8px; margin-top: 12px; border: 1px solid #bbf7d0;"><p style="margin: 0;"><strong>Dental Notes:</strong> ${visit.dental_notes}</p></div>`;
                    }

                    if (visit.shedding_amount || visit.hair_removed) {
                        groomingDetailsHTML += '<div style="padding: 12px; background: #fce7f3; border-radius: 8px; margin-top: 12px; border: 1px solid #fbcfe8;">';
                        if (visit.shedding_amount) {
                            groomingDetailsHTML += `<p style="margin: 0 0 6px 0;"><strong>Shedding:</strong> ${visit.shedding_amount}</p>`;
                        }
                        if (visit.hair_removed) {
                            groomingDetailsHTML += `<p style="margin: 0;"><strong>Hair Removed:</strong> ${visit.hair_removed}</p>`;
                        }
                        groomingDetailsHTML += '</div>';
                    }

                    if (visit.boarding_observations) {
                        groomingDetailsHTML += `<div style="padding: 12px; background: #dbeafe; border-radius: 8px; margin-top: 12px; border: 1px solid #a5d8ff;"><p style="margin: 0;"><strong>Observations:</strong> ${visit.boarding_observations}</p></div>`;
                    }

                    if (groomingDetailsHTML) {
                        document.getElementById('modalGroomingDetails').innerHTML = groomingDetailsHTML;
                        document.getElementById('modalGroomingDetails').style.display = 'block';
                    } else {
                        document.getElementById('modalGroomingDetails').style.display = 'none';
                    }

                    // Display photos
                    if (visit.photos && visit.photos.length > 0) {
                        let photosHTML = '';
                        visit.photos.forEach((photo, index) => {
                            photosHTML += `
                                <div style="position: relative; border-radius: 8px; overflow: hidden; background: #f3f4f6; cursor: pointer;" onclick="openPhotoLightbox('${photo.url}')">
                                    <img src="${photo.url}" alt="Visit photo ${index + 1}" style="width: 100%; height: 150px; object-fit: cover; transition: transform 0.3s;">
                                </div>
                            `;
                        });
                        document.getElementById('modalPhotosGallery').innerHTML = photosHTML;
                        document.getElementById('modalPhotosSection').style.display = 'block';
                    } else {
                        document.getElementById('modalPhotosSection').style.display = 'none';
                    }

                    // Show modal
                    document.getElementById('visitModal').classList.add('active');
                })
                .catch(error => {
                    console.error('Error fetching visit details:', error);
                    alert('Failed to load visit details');
                });
        }

        function openPhotoLightbox(photoUrl) {
            // You can expand this to show a larger image in a lightbox
            window.open(photoUrl, '_blank');
        }

        function closeVisitModal() {
            document.getElementById('visitModal').classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('visitModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVisitModal();
            }
        });

        // Appointments Calendar Modal Functions
        let appointmentsCalendarData = {};
        let currentCalendarMonth = new Date();

        function openAppointmentsCalendar() {
            document.getElementById('appointmentsCalendarModal').style.display = 'flex';
            document.getElementById('selectedDateAppointments').style.display = 'none';
            loadAppointmentsCalendar();
        }

        function closeAppointmentsCalendar() {
            document.getElementById('appointmentsCalendarModal').style.display = 'none';
        }

        function loadAppointmentsCalendar() {
            fetch('{{ route("appointments.calendar.data") }}')
                .then(response => response.json())
                .then(data => {
                    appointmentsCalendarData = data;
                    renderAppointmentsCalendar();
                })
                .catch(error => {
                    console.error('Error loading appointments:', error);
                });
        }

        function renderAppointmentsCalendar() {
            const year = currentCalendarMonth.getFullYear();
            const month = currentCalendarMonth.getMonth();
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const startingDayOfWeek = firstDay.getDay();
            const monthDays = lastDay.getDate();

            // Update header
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'];
            document.getElementById('calendarMonthYear').textContent = `${monthNames[month]} ${year}`;

            // Generate calendar grid
            let html = '<div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 8px; margin-top: 20px;">';
            
            // Day headers
            const dayHeaders = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            dayHeaders.forEach(day => {
                html += `<div style="text-align: center; font-weight: 600; color: #6b7280; padding: 8px; font-size: 12px;">${day}</div>`;
            });

            // Empty cells before first day
            for (let i = 0; i < startingDayOfWeek; i++) {
                html += '<div style="padding: 12px;"></div>';
            }

            // Days of month
            for (let day = 1; day <= monthDays; day++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const hasAppointments = appointmentsCalendarData[dateStr] && appointmentsCalendarData[dateStr].length > 0;
                const appointmentCount = hasAppointments ? appointmentsCalendarData[dateStr].length : 0;
                const isToday = dateStr === new Date().toISOString().split('T')[0];
                
                const style = `
                    padding: 12px;
                    text-align: center;
                    border-radius: 8px;
                    cursor: pointer;
                    background: ${hasAppointments ? 'linear-gradient(135deg, #14b8a6 0%, #0d9488 100%)' : (isToday ? '#f3f4f6' : 'white')};
                    color: ${hasAppointments ? 'white' : '#374151'};
                    font-weight: ${hasAppointments ? '700' : (isToday ? '600' : '400')};
                    border: ${isToday && !hasAppointments ? '2px solid #10b981' : 'none'};
                    transition: all 0.2s;
                    position: relative;
                `;
                
                html += `<div style="${style}" onclick="showDateAppointments('${dateStr}')" 
                    onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <div>${day}</div>
                    ${hasAppointments ? `<div style="font-size: 10px; margin-top: 2px;">${appointmentCount} apt${appointmentCount > 1 ? 's' : ''}</div>` : ''}
                </div>`;
            }

            html += '</div>';
            document.getElementById('calendarGrid').innerHTML = html;
        }

        function showDateAppointments(dateStr) {
            const appointments = appointmentsCalendarData[dateStr] || [];
            const displaySection = document.getElementById('selectedDateAppointments');
            const contentDiv = document.getElementById('selectedDateAppointmentsContent');

            const date = new Date(dateStr + 'T00:00:00');
            const formattedDate = date.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            
            let html = `
                <div style="background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); color: white; padding: 16px; border-radius: 8px; margin-bottom: 16px;">
                    <h3 style="margin: 0; font-size: 18px;">${formattedDate}</h3>
                    <p style="margin: 4px 0 0 0; font-size: 14px; opacity: 0.9;">${appointments.length} appointment${appointments.length > 1 ? 's' : ''}</p>
                </div>
            `;
            
            if (appointments.length === 0) {
                html += `
                    <div style="text-align: center; padding: 40px 20px; color: #6b7280; background: #f9fafb; border-radius: 8px;">
                        <i class="bi bi-calendar-x" style="font-size: 48px; color: #d1d5db; margin-bottom: 16px;"></i>
                        <p style="font-size: 16px; margin: 0;">No appointments scheduled for this date</p>
                    </div>
                `;
            } else {
                html += '<div style="max-height: 400px; overflow-y: auto;">';
            
            appointments.forEach(apt => {
                const statusColors = {
                    'scheduled': '#10b981',
                    'completed': '#14b8a6',
                    'cancelled': '#ef4444',
                    'no-show': '#f59e0b'
                };
                const statusColor = statusColors[apt.status] || '#6b7280';
                
                html += `
                    <div style="background: #f9fafb; padding: 16px; border-radius: 8px; margin-bottom: 12px; border-left: 4px solid ${statusColor};">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                            <div style="font-weight: 600; font-size: 16px; color: #111827;">${apt.patient}</div>
                            <div style="background: ${statusColor}; color: white; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; text-transform: uppercase;">
                                ${apt.status}
                            </div>
                        </div>
                        <div style="display: flex; gap: 16px; font-size: 14px; color: #6b7280;">
                            <div><i class="bi bi-clock"></i> ${apt.time}</div>
                            <div><i class="bi bi-heart-pulse"></i> ${apt.type}</div>
                        </div>
                    </div>
                `;
            });
            
                html += '</div>';
            }
            
            contentDiv.innerHTML = html;
            displaySection.style.display = 'block';
            
            // Scroll to appointments section smoothly
            setTimeout(() => {
                displaySection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
        }

        function changeCalendarMonth(direction) {
            currentCalendarMonth.setMonth(currentCalendarMonth.getMonth() + direction);
            renderAppointmentsCalendar();
            // Hide appointments section when changing months
            document.getElementById('selectedDateAppointments').style.display = 'none';
        }

        function closeDateAppointments() {
            document.getElementById('dateAppointmentsModal').style.display = 'none';
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const calModal = document.getElementById('appointmentsCalendarModal');
            const dateModal = document.getElementById('dateAppointmentsModal');
            if (event.target === calModal) {
                closeAppointmentsCalendar();
            }
            if (event.target === dateModal) {
                closeDateAppointments();
            }
        }

        // Auto-refresh today's visits stats every 15 seconds
        let allVisits = [];
        
        function refreshTodaysVisits() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            console.log('📡 Fetching /api/visits/today...');
            fetch('/api/visits/today', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || '',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                console.log('📨 Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('✅ Visits data received:', data);
                if (data && data.visits && Array.isArray(data.visits)) {
                    allVisits = data.visits;
                    console.log('📊 Loaded', allVisits.length, 'visits');
                    
                    // Recalculate stats based on service type
                    const totalVisits = allVisits.length;
                    
                    // Grooming services
                    const groomingServices = ['Bath & Dry', 'Full Grooming', 'Haircut & Styling', 'Nail Trimming', 'Ear Cleaning', 'Teeth Brushing', 'De-shedding Treatment', 'Flea & Tick Treatment', 'Paw Treatment'];
                    const groomingCount = allVisits.filter(v => groomingServices.includes(v.service_type)).length;
                    
                    // Medical services
                    const medicalServices = ['Vaccination', 'Spay/Neuter', 'Dental Cleaning', 'Deworming', 'General Checkup', 'Wound Treatment'];
                    const medicalCount = allVisits.filter(v => medicalServices.includes(v.service_type)).length;
                    
                    // Other services
                    const otherCount = totalVisits - groomingCount - medicalCount;

                    // Update displayed stats
                    document.getElementById('totalVisitsToday').textContent = totalVisits;
                    document.getElementById('groomingServicesToday').textContent = groomingCount;
                    document.getElementById('medicalServicesToday').textContent = medicalCount;
                    document.getElementById('otherServicesToday').textContent = otherCount;
                    
                    // Render visits list
                    console.log('🎨 Rendering visits list...');
                    renderVisitsList(allVisits);
                    
                    console.log('✅ Stats updated - Total:', totalVisits, 'Grooming:', groomingCount, 'Medical:', medicalCount, 'Other:', otherCount);
                }
            })
            .catch(error => {
                console.error('❌ Error refreshing visits:', error);
            });
        }

        function renderVisitsList(visits) {
            const container = document.getElementById('visitsListContainer');
            
            if (visits.length === 0) {
                container.innerHTML = '<div style="text-align: center; padding: 40px; color: #9ca3af;"><i class="bi bi-inbox" style="font-size: 48px; margin-bottom: 12px; display: block;"></i>No visits recorded yet</div>';
                return;
            }
            
            // Group visits by owner
            const visitsByOwner = {};
            visits.forEach(visit => {
                if (!visitsByOwner[visit.owner_name]) {
                    visitsByOwner[visit.owner_name] = [];
                }
                visitsByOwner[visit.owner_name].push(visit);
            });
            
            let html = '<div style="display: grid; gap: 16px;">';
            
            Object.keys(visitsByOwner).forEach(ownerName => {
                const ownerVisits = visitsByOwner[ownerName];
                const ownerInitials = ownerName.split(' ').map(n => n[0]).join('').toUpperCase();
                
                html += `
                    <div style="background: white; padding: 16px; border-radius: 12px; border: 1px solid #e5e7eb;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: #14b8a6; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 16px;">
                                ${ownerInitials}
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #1f2937; font-size: 15px;">${ownerName}</div>
                                <div style="font-size: 13px; color: #9ca3af;">${ownerVisits.length} pet${ownerVisits.length !== 1 ? 's' : ''}</div>
                            </div>
                        </div>
                        
                        <div style="margin-left: 28px; padding-left: 12px; border-left: 2px solid #e5e7eb; display: grid; gap: 12px;">
                `;
                
                ownerVisits.forEach(visit => {
                    const petInitials = (visit.pet_name || 'P').substring(0, 1).toUpperCase();
                    html += `
                        <div style="display: flex; align-items: flex-start; gap: 12px;">
                            <div style="width: 36px; height: 36px; border-radius: 50%; background: #14b8a6; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px; flex-shrink: 0;">
                                ${petInitials}
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 500; color: #1f2937; font-size: 14px; margin-bottom: 4px;">${visit.pet_name}</div>
                                <div style="font-size: 12px; color: #9ca3af; margin-bottom: 3px;"><i class="bi bi-clock"></i> ${visit.visit_time || 'TBD'}</div>
                                <div style="font-size: 12px; color: #9ca3af;"><i class="bi bi-briefcase"></i> ${visit.service_type}</div>
                            </div>
                            <div style="background: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; flex-shrink: 0;">
                                Completed
                            </div>
                        </div>
                    `;
                });
                
                html += `
                        </div>
                    </div>
                `;
            });
            
            html += '</div>';
            container.innerHTML = html;
        }

        function resetFilters() {
            document.getElementById('filterDate').value = '';
            document.getElementById('searchVisits').value = '';
            renderVisitsList(allVisits);
        }

        // Setup filter listeners
        document.getElementById('filterDate').addEventListener('change', function() {
            filterAndRenderVisits();
        });
        
        document.getElementById('searchVisits').addEventListener('input', function() {
            filterAndRenderVisits();
        });

        function filterAndRenderVisits() {
            const dateFilter = document.getElementById('filterDate').value;
            const searchFilter = document.getElementById('searchVisits').value.toLowerCase();
            
            let filtered = allVisits;
            
            if (dateFilter) {
                filtered = filtered.filter(v => v.visit_date === dateFilter);
            }
            
            if (searchFilter) {
                filtered = filtered.filter(v => {
                    const ownerName = (v.owner_name || '').toLowerCase();
                    const petName = (v.pet_name || '').toLowerCase();
                    return ownerName.includes(searchFilter) || petName.includes(searchFilter);
                });
            }
            
            renderVisitsList(filtered);
        }

        // Start refresh interval
        setInterval(refreshTodaysVisits, 15000);
        
        // Initial test - call it once on page load to verify it works
        console.log('✅ Visits page loaded - refresh function ready');
        refreshTodaysVisits();
    </script>

    <!-- Appointments Calendar Modal -->
    <div id="appointmentsCalendarModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 10000; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: white; border-radius: 16px; max-width: 800px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
            <div style="background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); color: white; padding: 24px; border-radius: 16px 16px 0 0; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h2 style="margin: 0; font-size: 24px; font-weight: 700;">Appointments Calendar</h2>
                    <p style="margin: 4px 0 0 0; font-size: 14px; opacity: 0.9;">View appointments by date</p>
                </div>
                <button onclick="closeAppointmentsCalendar()" style="background: rgba(255,255,255,0.2); border: none; color: white; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; font-size: 20px; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">×</button>
            </div>
            <div style="padding: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <button onclick="changeCalendarMonth(-1)" style="background: #f3f4f6; border: none; color: #374151; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">
                        ← Previous
                    </button>
                    <h3 id="calendarMonthYear" style="margin: 0; font-size: 18px; font-weight: 700; color: #111827;"></h3>
                    <button onclick="changeCalendarMonth(1)" style="background: #f3f4f6; border: none; color: #374151; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">
                        Next →
                    </button>
                </div>
                <div id="calendarGrid"></div>
                <div style="margin-top: 20px; padding: 16px; background: #f9fafb; border-radius: 8px; display: flex; gap: 16px; align-items: center; font-size: 13px; color: #6b7280;">
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <div style="width: 16px; height: 16px; background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); border-radius: 4px;"></div>
                        <span>Has Appointments</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <div style="width: 16px; height: 16px; background: white; border: 2px solid #10b981; border-radius: 4px;"></div>
                        <span>Today</span>
                    </div>
                </div>
                
                <!-- Appointments Display Section -->
                <div id="selectedDateAppointments" style="margin-top: 24px; display: none;">
                    <div style="border-top: 2px solid #e5e7eb; padding-top: 20px;">
                        <div id="selectedDateAppointmentsContent"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Appointments Details Modal -->
    <div id="dateAppointmentsModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 10001; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: white; border-radius: 16px; max-width: 600px; width: 100%; max-height: 90vh; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
            <div style="padding: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <button onclick="closeDateAppointments(); openAppointmentsCalendar();" style="background: #f3f4f6; border: none; color: #374151; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px; transition: all 0.2s;" onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">
                        ← Back to Calendar
                    </button>
                    <button onclick="closeDateAppointments()" style="background: transparent; border: none; color: #6b7280; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; font-size: 24px; transition: all 0.2s;" onmouseover="this.style.background='#f3f4f6'; this.style.color='#111827'" onmouseout="this.style.background='transparent'; this.style.color='#6b7280'">×</button>
                </div>
                <div id="dateAppointmentsContent"></div>
            </div>
        </div>
    </div>
    
    <!-- CALENDAR SYNCHRONIZATION SCRIPT - UNIFIED WITH DASHBOARD -->
    <script>
    (function() {
        // Get appointments from backend (same structure as dashboard)
        const VISITS_APPOINTMENTS = @json($appointments ?? []);
        let visitsCurrentDate = new Date();
        
        console.log('VISITS PAGE: Appointments loaded:', VISITS_APPOINTMENTS);
        
        // Open calendar modal
        window.openAppointmentsCalendar = function() {
            document.getElementById('visitsCalendarModal').style.display = 'flex';
            renderVisitsCalendar();
        };
        
        // Close calendar modal
        window.closeCalendarModal = function(event) {
            if (!event || event.target.id === 'visitsCalendarModal') {
                document.getElementById('visitsCalendarModal').style.display = 'none';
                document.getElementById('visitsSelectedDateInfo').style.display = 'none';
            }
        };
        
        // Change month
        window.visitsChangeMonth = function(delta) {
            visitsCurrentDate.setMonth(visitsCurrentDate.getMonth() + delta);
            renderVisitsCalendar();
        };
        
        // Select a date
        window.visitsSelectDate = function(dateStr) {
            const appointments = VISITS_APPOINTMENTS[dateStr] || [];
            const dateObj = new Date(dateStr + 'T00:00:00');
            const formatted = dateObj.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' });
            
            document.getElementById('visitsSelectedDateInfo').style.display = 'block';
            document.getElementById('visitsSelectedDateTitle').textContent = formatted;
            
            const list = document.getElementById('visitsAppointmentsList');
            
            if (appointments.length === 0) {
                list.innerHTML = '<div style="text-align: center; padding: 32px; color: #9ca3af;"><i class="bi bi-calendar-x" style="font-size: 48px; margin-bottom: 12px;"></i><div style="font-size: 16px; font-weight: 600;">No appointments scheduled</div></div>';
            } else {
                list.innerHTML = '<div style="padding: 12px; background: #10b981; color: white; border-radius: 6px; margin-bottom: 16px; font-weight: 600;"><i class="bi bi-check-circle"></i> ' + appointments.length + ' appointment(s) scheduled</div>';
                
                appointments.forEach(function(apt) {
                    // Check localStorage for attendance status
                    const statusKey = 'apt-status-' + apt.id;
                    const status = localStorage.getItem(statusKey);
                    
                    const div = document.createElement('div');
                    div.style.cssText = 'padding: 16px; background: white; border-radius: 8px; margin-bottom: 12px; border-left: 4px solid ' + (status === 'attended' ? '#10b981' : status === 'rescheduled' ? '#f59e0b' : '#3b82f6') + '; box-shadow: 0 1px 3px rgba(0,0,0,0.1);';
                    
                    let statusBadge = '';
                    if (status === 'attended') {
                        statusBadge = '<div style="background: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Attended</div>';
                    } else if (status === 'rescheduled') {
                        statusBadge = '<div style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Rescheduled</div>';
                    }
                    
                    div.innerHTML = '' +
                        '<div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">' +
                        '<div style="font-size: 16px; font-weight: 700; color: #111827;"><i class="bi bi-person-circle" style="color: #10b981; margin-right: 6px;"></i>' + apt.patient + '</div>' +
                        '<div style="display: flex; gap: 8px;">' +
                        statusBadge +
                        '<div style="background: #dbeafe; color: #1d4ed8; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase;">' + apt.type + '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div style="font-size: 14px; color: #6b7280; margin-bottom: 4px;"><i class="bi bi-clock" style="margin-right: 6px;"></i><strong>' + apt.time + '</strong></div>' +
                        (apt.status ? '<div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;"><i class="bi bi-info-circle" style="margin-right: 6px;"></i>Status: <span style="text-transform: capitalize; font-weight: 600;">' + apt.status + '</span></div>' : '') +
                        (apt.notes ? '<div style="margin-top: 12px; padding: 12px; background: #fef3c7; border-radius: 6px; font-size: 13px; color: #78350f;"><i class="bi bi-chat-left-text" style="margin-right: 6px;"></i>' + apt.notes + '</div>' : '');
                    list.appendChild(div);
                });
            }
        };
        
        // Render calendar
        function renderVisitsCalendar() {
            const year = visitsCurrentDate.getFullYear();
            const month = visitsCurrentDate.getMonth();
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            document.getElementById('visitsCurrentMonth').textContent = months[month] + ' ' + year;
            
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const daysInPrevMonth = new Date(year, month, 0).getDate();
            const today = new Date();
            
            const container = document.getElementById('visitsCalendarDays');
            container.innerHTML = '';
            
            // Previous month days
            for (let i = firstDay - 1; i >= 0; i--) {
                const day = daysInPrevMonth - i;
                const div = document.createElement('div');
                div.style.cssText = 'padding: 12px 8px; text-align: center; border-radius: 6px; color: #d1d5db; cursor: default;';
                div.textContent = day;
                container.appendChild(div);
            }
            
            // Current month days
            for (let day = 1; day <= daysInMonth; day++) {
                const dateStr = year + '-' + String(month + 1).padStart(2, '0') + '-' + String(day).padStart(2, '0');
                const hasApts = VISITS_APPOINTMENTS[dateStr] && VISITS_APPOINTMENTS[dateStr].length > 0;
                const isToday = today.getFullYear() === year && today.getMonth() === month && today.getDate() === day;
                
                const div = document.createElement('div');
                div.style.cssText = 'padding: 12px 8px; text-align: center; border-radius: 6px; cursor: pointer; transition: all 0.2s; position: relative;' +
                    (isToday ? 'background: #10b981; color: white; font-weight: 700;' : 'background: #f3f4f6; color: #111827;') +
                    (hasApts && !isToday ? 'border: 2px solid #10b981; font-weight: 600;' : '');
                
                div.textContent = day;
                
                if (hasApts) {
                    const dot = document.createElement('div');
                    dot.style.cssText = 'position: absolute; bottom: 4px; left: 50%; transform: translateX(-50%); width: 6px; height: 6px; background: ' + (isToday ? 'white' : '#10b981') + '; border-radius: 50%;';
                    div.appendChild(dot);
                }
                
                div.onclick = (function(ds) {
                    return function() {
                        window.visitsSelectDate(ds);
                    };
                })(dateStr);
                
                div.onmouseover = function() {
                    if (!isToday) this.style.background = '#e5e7eb';
                };
                div.onmouseout = function() {
                    if (!isToday) this.style.background = hasApts ? '#f3f4f6' : '#f3f4f6';
                };
                
                container.appendChild(div);
            }
            
            // Next month days
            const totalCells = firstDay + daysInMonth;
            const remainingCells = Math.ceil(totalCells / 7) * 7 - totalCells;
            for (let day = 1; day <= remainingCells; day++) {
                const div = document.createElement('div');
                div.style.cssText = 'padding: 12px 8px; text-align: center; border-radius: 6px; color: #d1d5db; cursor: default;';
                div.textContent = day;
                container.appendChild(div);
            }
            
            document.getElementById('visitsSelectedDateInfo').style.display = 'none';
        }
        
        // Listen for localStorage changes (sync with dashboard)
        window.addEventListener('storage', function(e) {
            if (e.key && e.key.startsWith('apt-status-')) {
                console.log('VISITS PAGE: Detected attendance change from dashboard, refreshing...');
                // Re-render if calendar is open
                if (document.getElementById('visitsCalendarModal').style.display === 'flex') {
                    const selectedDate = document.getElementById('visitsSelectedDateTitle').textContent;
                    if (selectedDate) {
                        renderVisitsCalendar();
                    }
                }
            }
        });
        
    })();
    </script>
</body>
</html>
