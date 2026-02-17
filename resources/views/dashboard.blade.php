<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - VetCare</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #059669 0%, #047857 100%);
            color: white;
            padding: 24px 0 0 0;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 12px 18px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 6px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 0;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            transition: opacity 0.2s;
        }

        .sidebar-logo {
            height: 56px;
            width: 56px;
            object-fit: contain;
            display: block;
        }

        .sidebar-brand {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 700;
            color: white;
            margin: 0;
            line-height: 1.2;
        }
        
        .logo-container:hover {
            opacity: 0.8;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #047857 0%, #059669 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(4, 120, 87, 0.3);
        }

        .logo-text {
            font-size: 22px;
            font-weight: 600;
        }

        .sidebar-subtitle {
            font-size: 12px;
            opacity: 0.9;
            padding-left: 0;
            text-align: left;
            line-height: 1.2;
        }

        .sidebar-menu {
            margin-top: 12px;
        }

        .menu-section {
            margin-bottom: 16px;
        }

        .menu-label {
            padding: 0 24px;
            font-size: 11px;
            text-transform: uppercase;
            opacity: 0.7;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .menu-item {
            margin: 0 16px 6px 16px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .menu-text {
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        /* User Section */
        .user-section {
            padding: 14px 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: auto;
        }

        .user-info-sidebar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .user-avatar-sidebar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            overflow: hidden;
        }

        .user-avatar-sidebar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-details-sidebar {
            flex: 1;
        }

        .user-name-sidebar {
            font-weight: 500;
            font-size: 14px;
        }

        .user-role-sidebar {
            font-size: 12px;
            opacity: 0.8;
        }

        .logout-btn-sidebar {
            width: 100%;
            padding: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logout-btn-sidebar:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Sidebar Activities */
        .sidebar-activities {
            padding: 16px;
            margin-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .activities-header {
            font-size: 13px;
            font-weight: 600;
            color: white;
            margin-bottom: 12px;
            padding: 0 8px;
        }

        .sidebar-activity-item {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 8px;
            display: flex;
            gap: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-activity-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .sidebar-activity-content {
            flex: 1;
            min-width: 0;
        }

        .sidebar-activity-title {
            font-size: 11px;
            color: white;
            font-weight: 500;
            margin-bottom: 2px;
            line-height: 1.3;
        }

        .sidebar-activity-time {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 4px;
        }

        .sidebar-activity-badge {
            display: inline-block;
            font-size: 9px;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 500;
        }

        .sidebar-activity-badge.completed {
            background: rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
        }

        .sidebar-activity-badge.scheduled {
            background: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
        }

        .sidebar-activity-badge.pending {
            background: rgba(251, 191, 36, 0.2);
            color: #fcd34d;
        }

        /* Top Navigation */
        .top-nav {
            background: white;
            padding: 16px 32px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-nav-left h1 {
            font-size: 24px;
            color: #1f2937;
        }

        .top-nav-left p {
            font-size: 14px;
            color: #6b7280;
            margin-top: 4px;
        }

        .top-nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: background 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .user-info:hover {
            background: #f3f4f6;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #059669 0%, #f59e0b 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-details {
            text-align: right;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        .user-role {
            font-size: 12px;
            color: #6b7280;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s ease;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        /* Dashboard Content */
        .dashboard-content {
            padding: 32px;
            flex: 1;
        }

        /* Quick Actions - Modern & Clean */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .action-card {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            gap: 18px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.06);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 0;
            background: currentColor;
            transition: height 0.3s ease;
        }

        .action-card:hover::before {
            height: 4px;
        }

        .action-card:nth-child(1) { color: #3B82F6; }
        .action-card:nth-child(2) { color: #10B981; }
        .action-card:nth-child(3) { color: #8B5CF6; }
        .action-card:nth-child(4) { color: #F59E0B; }

        .action-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08), 0 8px 32px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }

        .action-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }

        .action-card:hover .action-icon {
            transform: scale(1.1);
        }

        .action-icon.blue {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            color: #3B82F6;
        }

        .action-icon.green {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            color: #10B981;
        }

        .action-icon.purple {
            background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%);
            color: #8B5CF6;
        }

        .action-icon.orange {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            color: #F59E0B;
        }

        .action-details h3 {
            font-size: 16px;
            color: #111827;
            font-weight: 600;
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }

        .action-details p {
            font-size: 13px;
            color: #6B7280;
            font-weight: 400;
            line-height: 1.4;
        }

        /* AI Alerts Summary */
        .alerts-summary-section {
            margin-bottom: 32px;
        }

        .alerts-summary-card {
            background: linear-gradient(135deg, #ffffff 0%, #fef3f2 100%);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(249, 115, 22, 0.1);
            border-top: 5px solid #f97316;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .alerts-summary-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .alerts-summary-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .view-all-btn {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(249, 115, 22, 0.2);
        }

        .view-all-btn:hover {
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
        }

        .alerts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .alert-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px;
            border-radius: 14px;
            border: 1px solid;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .alert-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .alert-warning {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-color: #fbbf24;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-color: #ef4444;
        }

        .alert-info {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-color: #3b82f6;
        }

        .alert-icon {
            font-size: 24px;
            flex-shrink: 0;
        }

        .alert-content {
            flex: 1;
        }

        .alert-content h4 {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin: 0 0 4px 0;
        }

        .alert-content p {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
        }

        .alert-badge {
            background: #1f2937;
            color: white;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            flex-shrink: 0;
        }

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: minmax(250px, 1fr) minmax(350px, 1.2fr);
            gap: 20px;
            margin-bottom: 32px;
            align-items: start;
        }
        
        .stats-left-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .calendar-summary {
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
            border-radius: 20px;
            padding: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(16, 185, 129, 0.1);
            display: flex;
            flex-direction: column;
            height: fit-content;
            overflow: visible;
            min-width: 350px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .calendar-summary:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }
        
        .calendar-header {
            border-bottom: 2px solid #d1fae5;
            padding-bottom: 12px;
            margin-bottom: 12px;
            flex-shrink: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .calendar-header-left {
            flex: 1;
        }
        
        .calendar-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
            flex-shrink: 0;
        }
        
        .calendar-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.4);
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }
        
        .calendar-date {
            font-size: 20px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 4px;
            letter-spacing: -0.02em;
        }
        
        .calendar-subtitle {
            font-size: 12px;
            color: #6B7280;
            margin-top: 2px;
            font-weight: 500;
        }
        
        /* Mini Calendar Widget - Modern & Clean */
        .mini-calendar {
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
        }
        
        .mini-calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        
        .mini-calendar-month {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            letter-spacing: -0.01em;
        }
        
        .mini-calendar-nav {
            background: white;
            border: 1px solid #e5e7eb;
            color: #6b7280;
            cursor: pointer;
            padding: 6px 10px;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-size: 12px;
            font-weight: 600;
        }
        
        .mini-calendar-nav:hover {
            background: #f3f4f6;
            color: #111827;
            border-color: #d1d5db;
            transform: scale(1.05);
        }
        
        .mini-calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
        }
        
        .mini-calendar-day-label {
            text-align: center;
            font-size: 10px;
            font-weight: 700;
            color: #9ca3af;
            padding: 6px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .mini-calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            color: #374151;
            padding: 0;
            border: 1px solid transparent;
            background: white;
            font-weight: 500;
        }
        
        .mini-calendar-day:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
            transform: scale(1.1);
        }
        
        .mini-calendar-day.other-month {
            color: #d1d5db;
            pointer-events: none;
            background: transparent;
        }
        
        .mini-calendar-day.today {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }
        
        .mini-calendar-day.today:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: scale(1.1);
        }
        
        .mini-calendar-day.selected {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }
        
        .mini-calendar-day.selected:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }
        
        .mini-calendar-day.has-appointments {
            position: relative;
        }
        
        .mini-calendar-day.has-appointments::after {
            content: '';
            position: absolute;
            bottom: 3px;
            width: 4px;
            height: 4px;
            background: #f59e0b;
            border-radius: 50%;
            box-shadow: 0 0 4px rgba(245, 158, 11, 0.6);
        }
        
        .mini-calendar-day.today.has-appointments::after {
            background: white;
            box-shadow: 0 0 4px rgba(255, 255, 255, 0.8);
        }
        
        /* Calendar Date Pop-out Modal */
        .calendar-date-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            animation: fadeIn 0.2s ease;
        }

        .calendar-date-modal.active {
            display: flex;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .calendar-date-content {
            background: white;
            border-radius: 20px;
            padding: 0;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        .calendar-date-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .calendar-date-header h3 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .calendar-date-header p {
            font-size: 13px;
            opacity: 0.9;
            margin: 4px 0 0 0;
        }

        .calendar-date-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            cursor: pointer;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: all 0.2s;
        }

        .calendar-date-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .calendar-date-body {
            padding: 24px;
            overflow-y: auto;
            flex: 1;
        }

        .calendar-date-appointments {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .calendar-date-appointment-item {
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            transition: all 0.2s;
        }

        .calendar-date-appointment-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateX(4px);
        }

        .calendar-date-empty {
            text-align: center;
            padding: 40px 20px;
            color: #9ca3af;
        }

        .calendar-date-empty i {
            font-size: 48px;
            margin-bottom: 12px;
            display: block;
            opacity: 0.5;
        }
        
        .appointment-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 8px;
            flex: 1;
            min-height: 150px;
            max-height: 400px;
            margin-top: 0;
            width: 100%;
        }
        
        .appointment-list::-webkit-scrollbar {
            width: 8px;
        }
        
        .appointment-list::-webkit-scrollbar-track {
            background: #F3F4F6;
            border-radius: 12px;
        }
        
        .appointment-list::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #D1D5DB 0%, #9CA3AF 100%);
            border-radius: 12px;
        }
        
        .appointment-list::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #9CA3AF 0%, #6B7280 100%);
        }
        
        .appointment-item {
            display: flex;
            align-items: center;
            padding: 14px;
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
            border-radius: 12px;
            border-left: 4px solid #10B981;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            width: 100%;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }
        
        .appointment-item:hover {
            background: linear-gradient(135deg, #f3f4f6 0%, #f9fafb 100%);
            transform: translateX(6px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        
        .appointment-time {
            font-size: 14px;
            font-weight: 700;
            color: #047857;
            min-width: 80px;
            flex-shrink: 0;
        }
        
        .appointment-details {
            flex: 1;
            margin-left: 14px;
            min-width: 0;
            overflow: hidden;
        }
        
        .appointment-patient {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .appointment-status {
            font-size: 12px;
            color: #6B7280;
            font-weight: 500;
        }
        
        .appointment-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 14px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-pending {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            color: #92400E;
        }
        
        .badge-confirmed {
            background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
            color: #065F46;
        }
        
        .badge-completed {
            background: linear-gradient(135deg, #E0E7FF 0%, #C7D2FE 100%);
            color: #3730A3;
        }
        
        .badge-attended {
            background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
            color: #065F46;
        }
        
        .badge-rescheduled {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            color: #92400E;
        }
        
        .attendance-buttons {
            display: flex;
            gap: 6px;
            margin-left: 10px;
            flex-shrink: 0;
        }
        
        .attendance-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        
        .attendance-btn:hover {
            transform: scale(1.1);
        }
        
        .btn-check {
            background: #D1FAE5;
            color: #065F46;
        }
        
        .btn-check:hover {
            background: #A7F3D0;
        }
        
        .btn-cross {
            background: #FEE2E2;
            color: #991B1B;
        }
        
        .btn-cross:hover {
            background: #FECACA;
        }
        
        .no-appointments {
            text-align: center;
            padding: 40px 20px;
            color: #9CA3AF;
        }
        
        .no-appointments-icon {
            font-size: 48px;
            margin-bottom: 12px;
            opacity: 0.5;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.06);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            transition: height 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:nth-child(1)::before,
        .stat-card:nth-child(2)::before {
            background: linear-gradient(90deg, #10B981 0%, #059669 100%);
        }

        .stat-card:nth-child(3)::before,
        .stat-card:nth-child(4)::before {
            background: linear-gradient(90deg, #F59E0B 0%, #D97706 100%);
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
            transform: translateY(-4px);
        }
        
        .stat-card:hover::before {
            height: 6px;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .stat-title {
            font-size: 12px;
            color: #6B7280;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 6px;
            letter-spacing: -0.03em;
        }

        .stat-change {
            font-size: 13px;
            color: #10B981;
            font-weight: 600;
        }

        .stat-change.negative {
            color: #ef4444;
        }

        /* Recent Activity Section */
        .section-header {
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 20px;
            color: #1f2937;
            font-weight: 600;
        }

        .collapsible-content.collapsed {
            max-height: 0;
        }

        .activity-card {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .activity-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            background: #f3f4f6;
        }

        .activity-details {
            flex: 1;
        }

        .activity-title {
            font-size: 14px;
            color: #1f2937;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .activity-time {
            font-size: 12px;
            color: #6b7280;
        }

        .activity-status {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-completed { background: #dcfce7; color: #166534; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-scheduled { background: #dbeafe; color: #1e40af; }

        /* Floating AI Button */
        .floating-ai-button {
            position: fixed !important;
            bottom: 24px;
            right: 24px;
            width: 75px;
            height: 75px;
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            box-shadow: 0 4px 20px rgba(245, 158, 11, 0.4);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            z-index: 1000;
            border: 3px solid white;
        }

        .floating-ai-button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(245, 158, 11, 0.6);
        }

        .floating-ai-button:active {
            transform: scale(0.95);
        }

        .ai-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        /* AI Modal */
        .ai-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .ai-modal.active {
            display: flex;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .ai-modal-content {
            background: white;
            width: 90%;
            max-width: 600px;
            max-height: 85vh;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .ai-modal-header {
            background: linear-gradient(135deg, #fb923c 0%, #f97316 100%);
            color: white;
            padding: 28px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2);
        }

        .ai-modal-header h2 {
            font-size: 26px;
            display: flex;
            align-items: center;
            gap: 14px;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        .ai-modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            font-weight: 600;
        }

        .ai-modal-close:hover {
            background: rgba(255, 255, 255, 0.35);
            border-color: rgba(255, 255, 255, 0.5);
            transform: rotate(90deg) scale(1.1);
        }

        .ai-modal-body {
            padding: 40px;
            text-align: center;
            overflow-y: auto;
            max-height: calc(80vh - 88px);
        }

        .ai-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }

        .ai-modal-body h3 {
            font-size: 22px;
            color: #111827;
            margin-bottom: 12px;
        }

        .ai-modal-body p {
            color: #6B7280;
            font-size: 16px;
            line-height: 1.6;
        }

        /* Calendar Styles */
        .calendar-container {
            padding: 20px;
            max-width: 700px;
            margin: 0 auto;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .calendar-header h3 {
            font-size: 18px;
            color: #111827;
            margin: 0;
        }

        .calendar-nav {
            display: flex;
            gap: 10px;
        }

        .calendar-nav button {
            background: #10b981;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s;
        }

        .calendar-nav button:hover {
            background: #059669;
            transform: scale(1.05);
        }

        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin-bottom: 5px;
        }

        .calendar-weekday {
            text-align: center;
            font-weight: 600;
            color: #6B7280;
            font-size: 12px;
            padding: 6px 0;
        }

        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .calendar-day {
            aspect-ratio: 1;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            background: white;
            position: relative;
            min-height: 45px;
        }

        .calendar-day:hover {
            background: #f0fdf4;
            border-color: #10b981;
            transform: scale(1.05);
        }

        .calendar-day.other-month {
            color: #d1d5db;
            background: #f9fafb;
        }

        .calendar-day.today {
            background: #10b981;
            color: white;
            border-color: #10b981;
            font-weight: bold;
        }

        .calendar-day.today:hover {
            background: #059669;
        }

        .calendar-day.has-appointment {
            background: #dbeafe;
            border-color: #3b82f6;
        }

        .calendar-day.has-appointment::after {
            content: '';
            position: absolute;
            bottom: 4px;
            width: 6px;
            height: 6px;
            background: #3b82f6;
            border-radius: 50%;
        }

        .calendar-day-number {
            font-size: 13px;
        }

        .appointment-form {
            margin-top: 20px;
            padding: 24px;
            background: linear-gradient(135deg, #ffffff 0%, #fef3c7 100%);
            border-radius: 12px;
            border: 1px solid #fbbf24;
        }

        .appointment-form h4 {
            font-size: 16px;
            color: #92400e;
            margin-bottom: 20px;
            font-weight: 700;
            padding-bottom: 12px;
            border-bottom: 2px solid #fbbf24;
            display: flex;
            align-items: center;
            gap: 8px;
        }


        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            color: #1f2937;
            margin-bottom: 6px;
            font-weight: 600;
            letter-spacing: 0.01em;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 11px 14px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background: #ffffff;
            color: #111827;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #f59e0b;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
            background: #fffbeb;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #9ca3af;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 70px;
            line-height: 1.5;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 2px solid #fbbf24;
        }

        .btn-primary {
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
            letter-spacing: 0.02em;
            flex: 1;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(245, 158, 11, 0.4);
        }

        .btn-secondary {
            background: #ffffff;
            color: #374151;
            border: 2px solid #d1d5db;
            padding: 12px 28px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            flex: 1;
        }

        .btn-secondary:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            transform: translateY(-1px);
        }

        .appointment-list {
            margin-top: 20px;
            max-height: 200px;
            overflow-y: auto;
        }

        .appointment-item {
            background: white;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 8px;
            border-left: 4px solid #10b981;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .appointment-info {
            flex: 1;
        }

        .appointment-time {
            font-weight: 600;
            color: #111827;
            font-size: 14px;
        }

        .appointment-patient {
            color: #6B7280;
            font-size: 13px;
            margin-top: 2px;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        /* Patient List Styles */
        .patient-list-container {
            padding: 20px;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
        }

        .search-box input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .patient-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .patient-table thead {
            background: #f3f4f6;
        }

        .patient-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }

        .patient-table td {
            padding: 12px;
            font-size: 14px;
            color: #111827;
            border-bottom: 1px solid #e5e7eb;
        }

        .patient-table tbody tr:hover {
            background: #f9fafb;
        }

        .patient-table tbody tr:last-child td {
            border-bottom: none;
        }

        .btn-view {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s;
        }

        .btn-view:hover {
            background: #2563eb;
        }

        .btn-edit {
            background: #10b981;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s;
            margin-right: 5px;
        }

        .btn-edit:hover {
            background: #059669;
        }

        .table-actions {
            display: flex;
            gap: 5px;
        }

        .no-patients {
            text-align: center;
            padding: 40px;
            color: #6B7280;
        }

        /* Medical Records Styles */
        .medical-records-container {
            padding: 20px;
        }

        .record-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            transition: all 0.2s;
        }

        .record-card:hover {
            border-color: #f59e0b;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.1);
        }

        .record-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 12px;
        }

        .record-patient-info h4 {
            font-size: 16px;
            color: #111827;
            margin-bottom: 4px;
        }

        .record-patient-info p {
            font-size: 13px;
            color: #6B7280;
            margin: 0;
        }

        .record-date {
            font-size: 12px;
            color: #6B7280;
            background: #f3f4f6;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .record-details {
            margin-top: 12px;
        }

        .record-field {
            margin-bottom: 8px;
        }

        .record-field label {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            display: block;
            margin-bottom: 2px;
        }

        .record-field p {
            font-size: 14px;
            color: #111827;
            margin: 0;
        }

        .record-actions {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 8px;
        }

        .add-record-btn {
            background: #f59e0b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 20px;
        }

        .add-record-btn:hover {
            background: #d97706;
        }

        .filter-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .filter-tab {
            background: #f3f4f6;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s;
        }

        .filter-tab:hover {
            background: #e5e7eb;
        }

        .filter-tab.active {
            background: #f59e0b;
            color: white;
        }

        /* Patient Search Styles */
        .search-container {
            padding: 20px;
        }

        .search-header {
            margin-bottom: 20px;
        }

        .search-filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-filters select {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }

        .patient-result-card {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            transition: all 0.2s;
        }

        .patient-result-card:hover {
            border-color: #8b5cf6;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15);
        }

        .patient-result-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f3f4f6;
        }

        .patient-result-name {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }

        .patient-result-id {
            font-size: 14px;
            color: #6B7280;
        }

        .patient-badge {
            background: #8b5cf6;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .patient-info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 16px;
        }

        .patient-info-item {
            display: flex;
            flex-direction: column;
        }

        .patient-info-label {
            font-size: 12px;
            color: #6B7280;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .patient-info-value {
            font-size: 14px;
            color: #111827;
        }

        .patient-actions-row {
            display: flex;
            gap: 8px;
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
        }

        .btn-action {
            flex: 1;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-view-records {
            background: #8b5cf6;
            color: white;
        }

        .btn-view-records:hover {
            background: #7c3aed;
        }

        .btn-schedule {
            background: #10b981;
            color: white;
        }

        .btn-schedule:hover {
            background: #059669;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .sidebar.collapsed {
                width: 70px;
            }

            .main-content {
                margin-left: 70px;
            }

            .sidebar-header .logo-text,
            .sidebar-subtitle,
            .menu-text,
            .menu-label,
            .user-details-sidebar {
                display: none;
            }

            .menu-item {
                justify-content: center;
                padding: 12px;
            }

            .user-section {
                padding: 12px;
            }

            .user-info-sidebar {
                justify-content: center;
            }

            .logout-btn-sidebar i {
                margin: 0;
            }

            .logout-btn-sidebar {
                padding: 8px;
                font-size: 0;
            }

            .logout-btn-sidebar i {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="logo-container">
                <img src="/images/systemlogo.png" alt="VetCare" class="sidebar-logo">
            </a>
            <div class="sidebar-brand">
                <div class="sidebar-title">VetCare</div>
                <div class="sidebar-subtitle">Veterinary Clinic System</div>
            </div>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-section">
                <div class="menu-label">Main</div>
                <a href="{{ route('dashboard') }}" class="menu-item active">
                    <span class="menu-icon"><i class="bi bi-speedometer2"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-label">Pet Management</div>
                <a href="{{ route('patients.index') }}" class="menu-item">
                    <span class="menu-icon"><i class="bi bi-heart-fill"></i></span>
                    <span class="menu-text">Pet List</span>
                </a>
                <a href="{{ route('appointments.index') }}" class="menu-item">
                    <span class="menu-icon"><i class="bi bi-calendar-check"></i></span>
                    <span class="menu-text">Manage Appointments</span>
                </a>
                <a href="{{ route('visits.today') }}" class="menu-item">
                    <span class="menu-icon"><i class="bi bi-clock-history"></i></span>
                    <span class="menu-text">Visit History</span>
                </a>
            </div>

            @if(Auth::user()->hasStaffAccess())
            <div class="menu-section">
                <div class="menu-label">Reports & Tools</div>
                <a href="{{ route('analytics.index') }}" class="menu-item">
                    <span class="menu-icon"><i class="bi bi-graph-up-arrow"></i></span>
                    <span class="menu-text">Data Analytics</span>
                </a>
                <a href="{{ route('automation.support') }}" class="menu-item">
                    <span class="menu-icon"><i class="bi bi-cpu"></i></span>
                    <span class="menu-text">Automation Support</span>
                </a>
            </div>
            @endif
        </nav>

        <div class="user-section">
            <div class="user-info-sidebar">
                @if(Auth::user()->profile_picture)
                    <div class="user-avatar-sidebar">
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}">
                    </div>
                @else
                    <div class="user-avatar-sidebar">
                        <i class="bi bi-person-fill" style="font-size: 24px;"></i>
                    </div>
                @endif
                <div class="user-details-sidebar">
                    <div class="user-name-sidebar">{{ Auth::user()->name }}</div>
                    <div class="user-role-sidebar">{{ Auth::user()->role_name }}</div>
                </div>
            </div>
            <a href="{{ route('profile.show') }}" class="logout-btn-sidebar" style="text-decoration: none; margin-bottom: 8px;">
                <i class="bi bi-person-circle"></i> My Profile
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn-sidebar">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navigation -->
        <header class="top-nav">
            <div class="top-nav-left">
                <h1>Welcome back, {{ Auth::user()->name }}!</h1>
                <p>{{ date('l, F j, Y') }}</p>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="dashboard-content">
            <!-- Quick Actions -->
            <div class="quick-actions">
                <div class="action-card" onclick="openModal('newPatient')" style="cursor: pointer;">
                    <div class="action-icon blue"><i class="bi bi-clipboard2-check"></i></div>
                    <div class="action-details">
                        <h3>New Pet Record</h3>
                        <p>Create veterinary record</p>
                    </div>
                </div>

                <div class="action-card" onclick="openModal('bookAppointment')" style="cursor: pointer;">
                    <div class="action-icon green"><i class="bi bi-calendar-event"></i></div>
                    <div class="action-details">
                        <h3>Book Appointment</h3>
                        <p>Schedule new visit</p>
                    </div>
                </div>

                <div class="action-card" onclick="openModal('patientSearch')" style="cursor: pointer;">
                    <div class="action-icon purple"><i class="bi bi-heart-fill"></i></div>
                    <div class="action-details">
                        <h3>Pet Search</h3>
                        <p>Find pet records</p>
                    </div>
                </div>
            </div>

            <!-- AI Alerts Summary (only show if there are alerts and user is admin) -->
            @if(Auth::user()->hasStaffAccess() && isset($totalAlerts) && $totalAlerts > 0)
            <div class="alerts-summary-section">
                <div class="alerts-summary-card">
                    <div class="alerts-summary-header">
                        <div>
                            <h2 style="margin: 0; font-size: 20px; color: #1f2937;"><i class="bi bi-cpu-fill"></i> Automation Support Alerts</h2>
                            <p style="margin: 4px 0 0 0; font-size: 14px; color: #6b7280;">{{ $totalAlerts }} active alert(s) requiring attention</p>
                        </div>
                        <a href="{{ route('automation.support') }}" class="view-all-btn">View All →</a>
                    </div>
                    <div class="alerts-grid">
                        @foreach($topAlerts as $alert)
                        <div class="alert-item alert-{{ $alert['type'] }}">
                            <div class="alert-icon"><i class="bi {{ $alert['icon'] }}"></i></div>
                            <div class="alert-content">
                                <h4>{{ $alert['title'] }}</h4>
                                <p>{{ $alert['message'] }}</p>
                            </div>
                            <div class="alert-badge">{{ $alert['count'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Statistics -->
            <div class="stats-grid">
                <!-- Left Column: Stat Cards -->
                <div class="stats-left-column">
                    <div class="stat-card" onclick="openModal('todayPatients')" style="cursor: pointer;">
                        <div class="stat-header">
                            <span class="stat-title">Today's Pets</span>
                            <div class="stat-icon" style="background: #ECFDF5; color: #10B981;"><i class="bi bi-heart-fill"></i></div>
                        </div>
                        <div class="stat-value">{{ $todayPatients }}</div>
                        <div class="stat-change">{{ $patientChangePercent > 0 ? '↑' : '↓' }} {{ abs($patientChangePercent) }}% from yesterday</div>
                    </div>

                    <div class="stat-card" onclick="openModal('totalPatients')" style="cursor: pointer;">
                        <div class="stat-header">
                            <span class="stat-title">Total Pets</span>
                            <div class="stat-icon" style="background: #FEF3C7; color: #F59E0B;"><i class="bi bi-bar-chart-fill"></i></div>
                        </div>
                        <div class="stat-value">{{ $totalPatients }}</div>
                        <div class="stat-change">{{ $monthChangePercent > 0 ? '↑' : '↓' }} {{ abs($monthChangePercent) }}% this month</div>
                    </div>

                    <div class="stat-card" onclick="openModal('immunizations')" style="cursor: pointer;">
                        <div class="stat-header">
                            <span class="stat-title">Immunizations</span>
                            <div class="stat-icon" style="background: #FEF3C7; color: #F59E0B;"><i class="bi bi-shield-fill-check"></i></div>
                        </div>
                        <div class="stat-value">{{ $totalImmunizations }}</div>
                        <div class="stat-change">Total records</div>
                    </div>
                </div>

                <!-- Right Column: Calendar Summary -->
                <div class="calendar-summary">
                    <div class="calendar-header">
                        <div class="calendar-header-left">
                            <div class="calendar-date"><i class="bi bi-calendar-event"></i> Appointments</div>
                            <div class="calendar-subtitle" id="selectedDateDisplay">{{ now()->format('l, F j, Y') }}</div>
                        </div>
                    </div>
                    
                    <!-- Mini Calendar Widget -->
                    <div class="mini-calendar">
                        <div class="mini-calendar-header">
                            <button class="mini-calendar-nav" onclick="changeCalendarMonth(-1)"><i class="bi bi-chevron-left"></i></button>
                            <div class="mini-calendar-month" id="calendarMonthDisplay"></div>
                            <button class="mini-calendar-nav" onclick="changeCalendarMonth(1)"><i class="bi bi-chevron-right"></i></button>
                        </div>
                        <div class="mini-calendar-grid" id="miniCalendarGrid"></div>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>

    <!-- Calendar Date Pop-out Modal -->
    <div id="calendarDateModal" class="calendar-date-modal" onclick="closeCalendarModal(event)">
        <div class="calendar-date-content" onclick="event.stopPropagation()">
            <div class="calendar-date-header">
                <div>
                    <h3 id="modalDateTitle">Select a Date</h3>
                    <p id="modalDateSubtitle"></p>
                </div>
                <button class="calendar-date-close" onclick="closeCalendarModal()">&times;</button>
            </div>
            <div class="calendar-date-body">
                <div class="calendar-date-appointments" id="modalAppointmentList">
                    <!-- Appointments will be populated here by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- New Patient Modal -->
    <div id="newPatientModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'newPatient')">
        <div class="ai-modal-content" style="max-width: 700px;">
            <div class="ai-modal-header">
                <h2><i class="bi bi-clipboard2-check"></i> New Pet Record</h2>
                <button class="ai-modal-close" onclick="closeModal('newPatient')">x</button>
            </div>
            <div class="ai-modal-body" style="padding: 0;">
                <div class="calendar-container">
                    <div class="appointment-form" style="margin-top: 0;">
                        <h4>Pet Information</h4>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                            <div class="form-group">
                                <label for="patientLastName">Pet Name <span style="color: #dc2626;">*</span></label>
                                <input type="text" id="patientLastName" placeholder="Enter pet name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="patientFirstName">Species <span style="color: #dc2626;">*</span></label>
                                <select id="patientFirstName" required>
                                    <option value="">Select species</option>
                                    <option value="Dog">Dog</option>
                                    <option value="Cat">Cat</option>
                                    <option value="Bird">Bird</option>
                                    <option value="Rabbit">Rabbit</option>
                                    <option value="Hamster">Hamster</option>
                                    <option value="Guinea Pig">Guinea Pig</option>
                                    <option value="Reptile">Reptile</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                            <div class="form-group">
                                <label for="patientMiddleInitial">Breed</label>
                                <input type="text" id="patientMiddleInitial" placeholder="Enter breed">
                            </div>
                            
                            <div class="form-group">
                                <label for="patientSuffix">Color</label>
                                <input type="text" id="patientSuffix" placeholder="Enter color">
                            </div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                            <div class="form-group">
                                <label for="patientDOB">Date of Birth <span style="color: #dc2626;">*</span></label>
                                <input type="date" id="patientDOB" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="patientGender">Sex <span style="color: #dc2626;">*</span></label>
                                <select id="patientGender" required>
                                    <option value="">Select sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Neutered Male">Neutered Male</option>
                                    <option value="Spayed Female">Spayed Female</option>
                                </select>
                            </div>
                        </div>
                        
                        <h4 style="margin-top: 20px;">Owner Information</h4>
                        
                        <div class="form-group">
                            <label for="ownerName">Owner Name <span style="color: #dc2626;">*</span></label>
                            <input type="text" id="ownerName" placeholder="Enter owner name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="patientAddress">Address <span style="color: #dc2626;">*</span></label>
                            <textarea id="patientAddress" placeholder="Enter complete address" required style="min-height: 60px;"></textarea>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                            <div class="form-group">
                                <label for="patientPhone">Owner Contact <span style="color: #dc2626;">*</span></label>
                                <input type="tel" id="patientPhone" placeholder="09XX XXX XXXX" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="11">
                            </div>
                            
                            <div class="form-group">
                                <label for="patientSecondaryPhone">Microchip Number</label>
                                <input type="text" id="patientSecondaryPhone" placeholder="Enter microchip number">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="patientEmergencyContact">Emergency Contact Name</label>
                            <input type="text" id="patientEmergencyContact" placeholder="Name of emergency contact">
                        </div>
                        
                        <div class="form-group">
                            <label for="patientEmergencyPhone">Emergency Contact Number</label>
                            <input type="tel" id="patientEmergencyPhone" placeholder="09XX XXX XXXX" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="11">
                        </div>
                        
                        <div class="form-group">
                            <label for="patientMedicalHistory">Chief Complaint / Reason for Visit</label>
                            <textarea id="patientMedicalHistory" placeholder="Enter reason for veterinary visit..."></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="patientEmail">Owner Email Address</label>
                            <input type="email" id="patientEmail" placeholder="email@example.com">
                        </div>
                        
                        <!-- Data Privacy Consent -->
                        <div style="display: flex; gap: 12px; padding: 18px; background: linear-gradient(135deg, #fef3c7 0%, #fef3c7 100%); border: 2px solid #fbbf24; border-radius: 10px; margin: 20px 0; box-shadow: 0 2px 8px rgba(251, 191, 36, 0.15);">
                            <input type="checkbox" id="patientDataPrivacyConsent" required style="margin-top: 2px; width: 20px; height: 20px; cursor: pointer; accent-color: #f59e0b; flex-shrink: 0;">
                            <label for="patientDataPrivacyConsent" style="font-size: 13px; color: #92400e; line-height: 1.6; cursor: pointer;">
                                <span style="font-weight: 700; font-size: 14px;">Data Privacy Consent:</span> I consent to the collection, processing, and storage of my pet's and personal information for veterinary care purposes only. I understand that this data will be protected and will not be shared with unauthorized parties. <span style="color: #dc2626; font-weight: 700;">*</span>
                            </label>
                        </div>
                        
                        <div class="form-actions">
                            <button class="btn-primary" onclick="saveNewPatient()">Register Pet</button>
                            <button class="btn-secondary" onclick="closeModal('newPatient')">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Book Appointment Modal -->
    <div id="bookAppointmentModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'bookAppointment')">
        <div class="ai-modal-content" style="max-width: 650px;">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 24px 32px;">
                <h2 style="font-size: 24px;"><i class="bi bi-calendar-event"></i> Book Appointment</h2>
                <button class="ai-modal-close" onclick="closeModal('bookAppointment')">x</button>
            </div>
            <div class="ai-modal-body" style="padding: 28px; max-height: calc(85vh - 80px);">
                <form id="appointmentForm" action="{{ route('appointments.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                    @csrf
                    
                    <!-- Patient Selection -->
                    <div style="display: flex; flex-direction: column; gap: 8px; position: relative;">
                        <label style="font-weight: 600; color: #1f2937; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                            <i class="bi bi-person-fill" style="color: #10b981;"></i>
                            Patient <span style="color: #dc2626;">*</span>
                        </label>
                        <input type="text" id="appointmentPatientSearch" placeholder="Search patient by name or ID..." autocomplete="off" style="padding: 12px 14px 12px 40px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; transition: all 0.2s; background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 fill=%22%236b7280%22 viewBox=%220 0 16 16%22><path d=%22M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z%22/></svg>'); background-repeat: no-repeat; background-position: 14px center; background-size: 16px;">
                        <input type="hidden" name="patient_id" id="appointmentPatientId" required>
                        <div id="appointmentSearchResults" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border: 2px solid #e5e7eb; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.12); max-height: 200px; overflow-y: auto; z-index: 1000; margin-top: 4px;">
                        </div>
                        <div id="selectedPatientDisplay" style="display: none; padding: 12px 14px; background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px solid #10b981; border-radius: 10px; font-size: 13px; position: relative; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.1);">
                            <strong id="selectedPatientName" style="color: #047857; display: flex; align-items: center; gap: 6px;"><i class="bi bi-check-circle-fill"></i> <span></span></strong>
                            <button type="button" onclick="clearAppointmentPatient()" style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); background: #dc2626; color: white; border: none; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; cursor: pointer; transition: all 0.2s;">Change</button>
                        </div>
                    </div>

                    <!-- Date and Time -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-weight: 600; color: #1f2937; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                                <i class="bi bi-calendar3" style="color: #10b981;"></i>
                                Date <span style="color: #dc2626;">*</span>
                            </label>
                            <input type="date" name="appointment_date" required min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" style="padding: 12px 14px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; transition: all 0.2s; cursor: pointer;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-weight: 600; color: #1f2937; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                                <i class="bi bi-clock" style="color: #10b981;"></i>
                                Time <span style="color: #dc2626;">*</span>
                            </label>
                            <input type="time" name="appointment_time" required value="08:00" style="padding: 12px 14px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; transition: all 0.2s; cursor: pointer;">
                        </div>
                    </div>

                    <!-- Service Type -->
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-weight: 600; color: #1f2937; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                            <i class="bi bi-briefcase-fill" style="color: #10b981;"></i>
                            Service Type <span style="color: #dc2626;">*</span>
                        </label>
                        <select name="service_type" id="appointmentServiceType" required style="padding: 12px 14px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; transition: all 0.2s; cursor: pointer; background-color: white;">
                            <option value="">Select service</option>
                            <option value="Wellness Exam">Wellness Exam</option>
                            <option value="Vaccination">Vaccination</option>
                            <option value="Surgery">Surgery</option>
                            <option value="Dental Cleaning">Dental Cleaning</option>
                            <option value="Emergency">Emergency</option>
                            <option value="Grooming">Grooming</option>
                            <option value="Spay/Neuter">Spay/Neuter</option>
                            <option value="Breeding Consultation">Breeding Consultation</option>
                            <option value="Boarding Checkup">Boarding Checkup</option>
                            <option value="Follow-up">Follow-up</option>
                            <option value="Diagnostics">Diagnostics</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <!-- Vaccination Section -->
                    <div id="appointmentVaccination" style="display: none; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); padding: 18px; border-radius: 12px; gap: 12px; flex-direction: column; border: 2px solid #93c5fd; box-shadow: 0 2px 4px rgba(59, 130, 246, 0.1);">
                        <h4 style="margin: 0 0 12px 0; color: #1e40af; font-size: 14px; font-weight: 700; display: flex; align-items: center; gap: 8px;"><i class="bi bi-shield-fill-plus"></i> Vaccination Details</h4>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                <label style="font-weight: 600; color: #374151; font-size: 12px;">Vaccine</label>
                                <select name="vaccine_name" style="padding: 10px 12px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 13px; transition: all 0.2s;">
                                    <option value="">Select vaccine</option>
                                    <option value="Rabies">Rabies</option>
                                    <option value="DHPP">DHPP (Dogs)</option>
                                    <option value="Bordetella">Bordetella</option>
                                    <option value="FVRCP">FVRCP (Cats)</option>
                                    <option value="FeLV">FeLV (Feline Leukemia)</option>
                                    <option value="Leptospirosis">Leptospirosis</option>
                                </select>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                <label style="font-weight: 600; color: #374151; font-size: 12px;">Dose</label>
                                <select name="dose_number" style="padding: 10px 12px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 13px; transition: all 0.2s;">
                                    <option value="">Select dose</option>
                                    <option value="1st Dose">1st Dose</option>
                                    <option value="2nd Dose">2nd Dose</option>
                                    <option value="3rd Dose">3rd Dose</option>
                                    <option value="Booster">Booster</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Breeding Consultation Section -->
                    <div id="appointmentBreeding" style="display: none; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); padding: 18px; border-radius: 12px; gap: 12px; flex-direction: column; border: 2px solid #fbbf24; box-shadow: 0 2px 4px rgba(245, 158, 11, 0.1);">
                        <h4 style="margin: 0 0 12px 0; color: #92400e; font-size: 14px; font-weight: 700; display: flex; align-items: center; gap: 8px;"><i class="bi bi-heart-fill"></i> Breeding Consultation Details</h4>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                <label style="font-weight: 600; color: #374151; font-size: 12px;">Breeding Status</label>
                                <select name="breeding_status" style="padding: 10px 12px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 13px; transition: all 0.2s;">
                                    <option value="">Select status</option>
                                    <option value="Planned">Planned</option>
                                    <option value="Bred">Bred</option>
                                    <option value="Confirmed Pregnant">Confirmed Pregnant</option>
                                    <option value="Not Pregnant">Not Pregnant</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                <label style="font-weight: 600; color: #374151; font-size: 12px;">Expected Delivery Date</label>
                                <input type="date" name="expected_delivery" style="padding: 10px 12px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 13px; transition: all 0.2s;">
                            </div>
                        </div>
                    </div>

                    <!-- Spay/Neuter Section -->
                    <div id="appointmentFP" style="display: none; background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); padding: 18px; border-radius: 12px; gap: 12px; flex-direction: column; border: 2px solid #6ee7b7; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.1);">
                        <h4 style="margin: 0 0 12px 0; color: #166534; font-size: 14px; font-weight: 700; display: flex; align-items: center; gap: 8px;"><i class="bi bi-scissors"></i> Spay/Neuter Details</h4>
                        <div style="display: flex; flex-direction: column; gap: 6px;">
                            <label style="font-weight: 600; color: #374151; font-size: 12px;">Procedure Type</label>
                            <select name="fp_method" style="padding: 10px 12px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 13px; transition: all 0.2s;">
                                <option value="">Select procedure</option>
                                <option value="Spay (Female)">Spay (Female)</option>
                                <option value="Neuter (Male)">Neuter (Male)</option>
                                <option value="Implant">Implant</option>
                            </select>
                        </div>
                    </div>

                    <!-- Referral Section -->
                    <div id="appointmentReferral" style="display: none; background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%); padding: 18px; border-radius: 12px; gap: 12px; flex-direction: column; border: 2px solid #fca5a5; box-shadow: 0 2px 4px rgba(239, 68, 68, 0.1);">
                        <h4 style="margin: 0 0 12px 0; color: #991b1b; font-size: 14px; font-weight: 700; display: flex; align-items: center; gap: 8px;"><i class="bi bi-hospital-fill"></i> Referral Details</h4>
                        <div style="display: flex; flex-direction: column; gap: 6px;">
                            <label style="font-weight: 600; color: #374151; font-size: 12px;">Referred To</label>
                            <input type="text" name="referred_to" placeholder="Hospital/Clinic name" style="padding: 10px 12px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 13px; transition: all 0.2s;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 6px;">
                            <label style="font-weight: 600; color: #374151; font-size: 12px;">Urgency</label>
                            <select name="referral_urgency" style="padding: 10px 12px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 13px; transition: all 0.2s;">
                                <option value="routine">Routine</option>
                                <option value="urgent">Urgent</option>
                                <option value="emergency">Emergency</option>
                            </select>
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-weight: 600; color: #1f2937; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                            <i class="bi bi-chat-left-text-fill" style="color: #10b981;"></i>
                            Remarks
                        </label>
                        <textarea name="chief_complaint" rows="3" placeholder="Enter remarks for this appointment..." style="padding: 12px 14px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; resize: vertical; transition: all 0.2s; font-family: inherit;"></textarea>
                    </div>

                    <!-- Health Worker -->
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-weight: 600; color: #1f2937; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                            <i class="bi bi-person-badge-fill" style="color: #10b981;"></i>
                            Assigned Health Worker
                        </label>
                        <input type="text" name="health_worker" placeholder="Enter health worker name" style="padding: 12px 14px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; transition: all 0.2s;">
                    </div>

                    <!-- Data Privacy Consent -->
                    <div style="display: flex; gap: 12px; padding: 18px; background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px solid #10b981; border-radius: 12px; margin-top: 4px; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.1);">
                        <input type="checkbox" id="appointmentDataPrivacyConsent" name="data_privacy_consent" required style="margin-top: 2px; width: 20px; height: 20px; cursor: pointer; accent-color: #10b981; flex-shrink: 0;">
                        <label for="appointmentDataPrivacyConsent" style="font-size: 13px; color: #047857; line-height: 1.6; cursor: pointer;">
                            <span style="font-weight: 700; display: flex; align-items: center; gap: 6px; margin-bottom: 4px;"><i class="bi bi-shield-filllock"></i> Data Privacy Consent:</span> I consent to the collection, processing, and storage of my personal and medical information for healthcare purposes only. I understand that my data will be protected and will not be shared with unauthorized parties or leaked. <span style="color: #dc2626; font-weight: 700;">*</span>
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 8px; padding-top: 20px; border-top: 2px solid #f3f4f6;">
                        <button type="button" onclick="closeModal('bookAppointment')" style="padding: 12px 24px; border: 2px solid #e5e7eb; background: white; color: #6b7280; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.2s; font-size: 14px;">
                            <i class="bi bi-x-circle"></i> Cancel
                        </button>
                        <button type="submit" style="padding: 12px 28px; border: none; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); font-size: 14px;">
                            <i class="bi bi-check-circle-fill"></i> Book Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Enhanced form field styles */
        #appointmentForm input[type="text"]:focus,
        #appointmentForm input[type="date"]:focus,
        #appointmentForm input[type="time"]:focus,
        #appointmentForm input[type="number"]:focus,
        #appointmentForm select:focus,
        #appointmentForm textarea:focus {
            outline: none;
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
        }

        #appointmentForm input[type="text"]:hover,
        #appointmentForm input[type="date"]:hover,
        #appointmentForm input[type="time"]:hover,
        #appointmentForm input[type="number"]:hover,
        #appointmentForm select:hover,
        #appointmentForm textarea:hover {
            border-color: #10b981 !important;
        }

        #appointmentForm button[type="button"]:hover {
            background: #f9fafb !important;
            border-color: #d1d5db !important;
            color: #374151 !important;
            transform: translateY(-1px);
        }

        #appointmentForm button[type="submit"]:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4) !important;
        }

        #appointmentForm button[type="submit"]:active {
            transform: translateY(0);
        }

        /* Smooth scrollbar for modal */
        .ai-modal-body::-webkit-scrollbar {
            width: 8px;
        }

        .ai-modal-body::-webkit-scrollbar-track {
            background: #f3f4f6;
            border-radius: 10px;
        }

        .ai-modal-body::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        .ai-modal-body::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>

    <!-- Patient Search Modal -->
    <div id="patientSearchModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'patientSearch')">
        <div class="ai-modal-content" style="max-width: 800px;">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                <h2><i class="bi bi-people-fill"></i> Pet Search</h2>
                <button class="ai-modal-close" onclick="closeModal('patientSearch')">x</button>
            </div>
            <div class="ai-modal-body" style="padding: 0;">
                <div class="search-container">
                    <div class="search-header">
                        <div class="search-box">
                        <input type="text" id="quickSearchInput" placeholder="Search by pet name, ID, owner, contact, or microchip..." oninput="performQuickSearch()">
                    </div>
                </div>
                
                <div class="search-filters">
                    <input type="date" id="searchBirthdayFilter" placeholder="Birthday" onchange="performQuickSearch()" style="padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;font-size:14px;color:#374151;">
                    
                        <select id="searchSexFilter" onchange="performQuickSearch()">
                            <option value="">Any Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Neutered Male">Neutered Male</option>
                            <option value="Spayed Female">Spayed Female</option>
                        </select>
                        
                        <select id="searchSpeciesFilter" onchange="performQuickSearch()">
                            <option value="">All Species</option>
                            <option value="Dog">Dog</option>
                            <option value="Cat">Cat</option>
                            <option value="Rabbit">Rabbit</option>
                            <option value="Bird">Bird</option>
                            <option value="Other">Other</option>
                        </select>
                        
                        <select id="searchAgeFilter" onchange="performQuickSearch()">
                            <option value="">All Ages</option>
                            <option value="0-1">0-1 years</option>
                            <option value="1-3">1-3 years</option>
                            <option value="4-7">4-7 years</option>
                            <option value="8-12">8-12 years</option>
                            <option value="13+">13+ years</option>
                        </select>
                    </div>
                    
                    <div id="searchResults" style="max-height: 500px; overflow-y: auto;">
                        <!-- Search results will be inserted here -->
                    </div>
                    
                    <div id="noSearchResults" class="no-patients" style="display: none;">
                        <p>No pets found matching your search criteria.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Patients Modal -->
    <div id="todayPatientsModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'todayPatients')">
        <div class="ai-modal-content">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h2><i class="bi bi-people-fill"></i> Today's Patients</h2>
                <button class="ai-modal-close" onclick="closeModal('todayPatients')">x</button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon"><i class="bi bi-people-fill"></i></div>
                <h3>24 Patients Today</h3>
                <p>This feature is under development. View the list of all patients scheduled for today, with ↑ 12% from yesterday.</p>
            </div>
        </div>
    </div>

    <!-- Appointments Today Modal -->
    <div id="appointmentsTodayModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'appointmentsToday')">
        <div class="ai-modal-content">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h2><i class="bi bi-calendar-event"></i> Appointments Today</h2>
                <button class="ai-modal-close" onclick="closeModal('appointmentsToday')">x</button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon"><i class="bi bi-calendar-event"></i></div>
                <h3>18 Appointments Today</h3>
                <p>This feature is under development. View and manage today's appointments with 5 pending confirmations.</p>
            </div>
        </div>
    </div>

    <!-- Total Patients Modal -->
    <div id="totalPatientsModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'totalPatients')">
        <div class="ai-modal-content">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                <h2><i class="bi bi-bar-chart-fill"></i> Total Patients</h2>
                <button class="ai-modal-close" onclick="closeModal('totalPatients')">x</button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon"><i class="bi bi-bar-chart-fill"></i></div>
                <h3>1,247 Total Patients</h3>
                <p>This feature is under development. View complete patient database with ↑ 8% growth this month.</p>
            </div>
        </div>
    </div>

    <!-- Immunizations Modal -->
    <div id="immunizationsModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'immunizations')">
        <div class="ai-modal-content">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                <h2><i class="bi bi-shield-fill-check"></i> Immunizations</h2>
                <button class="ai-modal-close" onclick="closeModal('immunizations')">x</button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon"><i class="bi bi-shield-fill-check"></i></div>
                @php
                    use App\Models\Immunization;
                    $allImmunizations = Immunization::with('patient')->orderBy('date_given', 'desc')->get();
                    $thisMonthImm = $allImmunizations->filter(function($imm) {
                        return \Carbon\Carbon::parse($imm->date_given)->isCurrentMonth();
                    });
                    $patientGroups = $allImmunizations->groupBy('patient_id');
                @endphp
                <h3>{{ $thisMonthImm->count() }} Immunizations This Month</h3>
                <div style="margin-top: 24px; text-align: left; max-width: 800px; margin-left: auto; margin-right: auto; max-height: 500px; overflow-y: auto;">
                    @foreach($patientGroups as $patientId => $immunizations)
                        @php $patient = $immunizations->first()->patient; @endphp
                        <div style="background: #fff; border-radius: 8px; padding: 16px; margin-bottom: 12px; border-left: 4px solid #f59e0b; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px;">
                                        <i class="bi bi-person-fill" style="font-size: 20px;"></i>
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; font-size: 16px; color: #111827;">{{ $patient->first_name }} {{ $patient->last_name }}</div>
                                        <div style="font-size: 12px; color: #6b7280;">{{ $patient->age }} years old • {{ $patient->bhc_id }}</div>
                                    </div>
                                </div>
                                <div style="background: #e0e7ff; color: #3730a3; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                    {{ $immunizations->count() }} {{ $immunizations->count() === 1 ? 'Vaccine' : 'Vaccines' }}
                                </div>
                            </div>
                            @foreach($immunizations as $imm)
                                <div style="background: #fef3c7; padding: 12px; border-radius: 6px; margin-top: 8px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                        <div style="font-weight: 600; color: #92400e;">{{ $imm->vaccine_name }}</div>
                                        <span style="background: #10b981; color: white; padding: 2px 8px; border-radius: 4px; font-size: 11px;">Dose {{ $imm->dose_number }}</span>
                                    </div>
                                    <div style="font-size: 13px; color: #78716c;">Date: {{ \Carbon\Carbon::parse($imm->date_given)->format('F j, Y') }}</div>
                                    <div style="font-size: 12px; color: #78716c; margin-top: 2px;">Administered by: {{ $imm->administered_by }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div style="margin-top: 20px;">
                    <a href="{{ route('immunizations.index') }}" style="display: inline-block; background: #f59e0b; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500;">View All Records</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Medical Records Modal -->
    <div id="medicalRecordsModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'medicalRecords')">
        <div class="ai-modal-content" style="max-width: 900px;">
            <div class="ai-modal-header">
                <h2><i class="bi bi-clipboard2-check"></i> Medical Records</h2>
                <button class="ai-modal-close" onclick="closeModal('medicalRecords')">x</button>
            </div>
            <div class="ai-modal-body" style="padding: 0;">
                <div class="medical-records-container">
                    <button class="add-record-btn" onclick="showAddRecordForm()">Add New Record</button>
                    
                    <!-- Add Record Form -->
                    <div id="addRecordForm" style="display: none;">
                        <div class="appointment-form" style="margin-top: 0; margin-bottom: 20px;">
                            <h4>New Medical Record</h4>
                            
                            <div class="form-group">
                                <label for="recordPatientId">Patient ID or Name <span style="color: red;">*</span></label>
                                <input type="text" id="recordPatientId" placeholder="Enter patient ID or search name" list="patientSuggestions">
                                <datalist id="patientSuggestions"></datalist>
                            </div>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                <div class="form-group">
                                    <label for="recordDate">Visit Date <span style="color: red;">*</span></label>
                                    <input type="date" id="recordDate" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="recordType">Visit Type <span style="color: red;">*</span></label>
                                    <select id="recordType" required>
                                        <option value="">Select type</option>
                                        <option value="Wellness Exam">Wellness Exam</option>
                                        <option value="Breeding Consultation">Breeding Consultation</option>
                                        <option value="Vaccination">Vaccination</option>
                                        <option value="Follow-up">Follow-up</option>
                                        <option value="Emergency">Emergency</option>
                                        <option value="Consultation">Consultation</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="recordChiefComplaint">Chief Complaint <span style="color: red;">*</span></label>
                                <textarea id="recordChiefComplaint" placeholder="Main reason for visit" required style="min-height: 60px;"></textarea>
                            </div>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                                <div class="form-group">
                                    <label for="recordHeight">Height (cm)</label>
                                    <input type="number" id="recordHeight" placeholder="e.g., 165" step="0.1">
                                </div>
                                
                                <div class="form-group">
                                    <label for="recordWeight">Weight (kg)</label>
                                    <input type="number" id="recordWeight" placeholder="e.g., 65" step="0.1">
                                </div>
                                
                                <div class="form-group">
                                    <label for="recordBP">Heart Rate (bpm)</label>
                                    <input type="number" id="recordBP" placeholder="e.g., 80" min="40" max="200">
                                </div>
                            </div>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                <div class="form-group">
                                    <label for="recordTemp">Temperature (°C)</label>
                                    <input type="number" id="recordTemp" placeholder="e.g., 36.5" step="0.1">
                                </div>
                                
                                <div class="form-group">
                                    <label for="recordHeartRate">Heart Rate (bpm)</label>
                                    <input type="number" id="recordHeartRate" placeholder="e.g., 72">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="recordDiagnosis">Diagnosis <span style="color: red;">*</span></label>
                                <textarea id="recordDiagnosis" placeholder="Medical diagnosis" required></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="recordTreatment">Treatment/Prescription</label>
                                <textarea id="recordTreatment" placeholder="Medications prescribed and treatment plan"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="recordNotes">Additional Notes</label>
                                <textarea id="recordNotes" placeholder="Any other observations or recommendations"></textarea>
                            </div>
                            
                            <div class="form-actions">
                                <button class="btn-primary" onclick="saveMedicalRecord()">Save Record</button>
                                <button class="btn-secondary" onclick="cancelAddRecord()">Cancel</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filter Tabs -->
                    <div class="filter-tabs">
                        <button class="filter-tab active" onclick="filterRecordsByType('all')">All Records</button>
                        <button class="filter-tab" onclick="filterRecordsByType('Wellness Exam')">Wellness Exam</button>
                        <button class="filter-tab" onclick="filterRecordsByType('Breeding Consultation')">Breeding Consultation</button>
                        <button class="filter-tab" onclick="filterRecordsByType('Vaccination')">Vaccination</button>
                        <button class="filter-tab" onclick="filterRecordsByType('Follow-up')">Follow-up</button>
                    </div>
                    
                    <div class="search-box">
                        <input type="text" id="recordSearchInput" placeholder="Search by patient name or ID..." oninput="searchMedicalRecords()">
                    </div>
                    
                    <div id="medicalRecordsList" style="max-height: 500px; overflow-y: auto;">
                        <!-- Records will be inserted here -->
                    </div>
                    
                    <div id="noRecordsMessage" class="no-patients" style="display: none;">
                        <p>No medical records found.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient List Modal -->
    <div id="patientListModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'patientList')">
        <div class="ai-modal-content" style="max-width: 1000px;">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                <h2><i class="bi bi-people-fill"></i> Pet List</h2>
                <button class="ai-modal-close" onclick="closeModal('patientList')">x</button>
            </div>
            <div class="ai-modal-body" style="padding: 0;">
                <div class="patient-list-container">
                    <div class="search-box">
                        <input type="text" id="patientSearchInput" placeholder="Search by pet name, ID, or owner contact..." oninput="filterPatients()">
                    </div>
                    
                    <div style="overflow-x: auto; max-height: 500px;">
                        <table class="patient-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pet</th>
                                    <th>Age</th>
                                    <th>Sex</th>
                                    <th>Owner Contact</th>
                                    <th>Last Visit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="patientTableBody">
                                <!-- Patient rows will be inserted here -->
                            </tbody>
                        </table>
                        <div id="noPatientsMessage" class="no-patients" style="display: none;">
                            <p>No pets found.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Modal - REBUILT VERSION -->
    <div id="scheduleModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'schedule')">
        <div class="ai-modal-content" style="max-width: 750px;">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h2><i class="bi bi-calendar-week"></i> Appointments Calendar</h2>
                <button class="ai-modal-close" onclick="closeModal('schedule')">x</button>
            </div>
            <div class="ai-modal-body" style="padding: 20px;">
                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <button onclick="scheduleChangeMonth(-1)" style="padding: 8px 16px; background: #10b981; color: white; border: none; border-radius: 6px; cursor: pointer;">← Previous</button>
                        <h3 id="scheduleCurrentMonth" style="margin: 0;">February 2026</h3>
                        <button onclick="scheduleChangeMonth(1)" style="padding: 8px 16px; background: #10b981; color: white; border: none; border-radius: 6px; cursor: pointer;">Next →</button>
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
                    
                    <div id="scheduleCalendarDays" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px;"></div>
                </div>
                
                <div id="scheduleSelectedDateInfo" style="display: none; padding: 20px; background: #f9fafb; border-radius: 8px; border: 2px solid #10b981;">
                    <h3 id="scheduleSelectedDateTitle" style="margin: 0 0 16px 0; color: #111827;"></h3>
                    <div id="scheduleAppointmentsList"></div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    // SCHEDULE MODAL - DIRECT IMPLEMENTATION (NO CACHE ISSUES)
    (function() {
        const SCHEDULE_APPOINTMENTS = @json($appointments ?? []);
        let scheduleCurrentDate = new Date();
        
        console.log('SCHEDULE MODAL INITIALIZED WITH DATA:', SCHEDULE_APPOINTMENTS);
        
        window.scheduleChangeMonth = function(delta) {
            scheduleCurrentDate.setMonth(scheduleCurrentDate.getMonth() + delta);
            renderScheduleCalendar();
        };
        
        window.scheduleSelectDate = function(dateStr) {
            const appointments = SCHEDULE_APPOINTMENTS[dateStr] || [];
            const dateObj = new Date(dateStr + 'T00:00:00');
            const formatted = dateObj.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' });
            
            document.getElementById('scheduleSelectedDateInfo').style.display = 'block';
            document.getElementById('scheduleSelectedDateTitle').textContent = formatted;
            
            const list = document.getElementById('scheduleAppointmentsList');
            
            if (appointments.length === 0) {
                list.innerHTML = '<div style="text-align: center; padding: 32px; color: #9ca3af;"><i class="bi bi-calendar-x" style="font-size: 48px; margin-bottom: 12px;"></i><div style="font-size: 16px; font-weight: 600;">No appointments scheduled</div></div>';
            } else {
                list.innerHTML = '<div style="padding: 12px; background: #10b981; color: white; border-radius: 6px; margin-bottom: 16px; font-weight: 600;"><i class="bi bi-check-circle"></i> ' + appointments.length + ' appointment(s) scheduled</div>';
                
                appointments.forEach(function(apt) {
                    const div = document.createElement('div');
                    div.style.cssText = 'padding: 16px; background: white; border-radius: 8px; margin-bottom: 12px; border-left: 4px solid #10b981; box-shadow: 0 1px 3px rgba(0,0,0,0.1);';
                    div.innerHTML = '' +
                        '<div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">' +
                        '<div style="font-size: 16px; font-weight: 700; color: #111827;"><i class="bi bi-person-circle" style="color: #10b981; margin-right: 6px;"></i>' + apt.patient + '</div>' +
                        '<div style="background: #dbeafe; color: #1d4ed8; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase;">' + apt.type + '</div>' +
                        '</div>' +
                        '<div style="font-size: 14px; color: #6b7280; margin-bottom: 4px;"><i class="bi bi-clock" style="margin-right: 6px;"></i><strong>' + apt.time + '</strong></div>' +
                        (apt.status ? '<div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;"><i class="bi bi-info-circle" style="margin-right: 6px;"></i>Status: <span style="text-transform: capitalize; font-weight: 600;">' + apt.status + '</span></div>' : '') +
                        (apt.notes ? '<div style="margin-top: 12px; padding: 12px; background: #fef3c7; border-radius: 6px; font-size: 13px; color: #78350f;"><i class="bi bi-chat-left-text" style="margin-right: 6px;"></i>' + apt.notes + '</div>' : '');
                    list.appendChild(div);
                });
            }
        };
        
        function renderScheduleCalendar() {
            const year = scheduleCurrentDate.getFullYear();
            const month = scheduleCurrentDate.getMonth();
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            document.getElementById('scheduleCurrentMonth').textContent = months[month] + ' ' + year;
            
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const daysInPrevMonth = new Date(year, month, 0).getDate();
            const today = new Date();
            
            const container = document.getElementById('scheduleCalendarDays');
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
                const hasApts = SCHEDULE_APPOINTMENTS[dateStr] && SCHEDULE_APPOINTMENTS[dateStr].length > 0;
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
                        window.scheduleSelectDate(ds);
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
            
            document.getElementById('scheduleSelectedDateInfo').style.display = 'none';
        }
        
        // Initialize when schedule modal opens
        const originalOpenModal = window.openModal;
        window.openModal = function(modalType) {
            originalOpenModal(modalType);
            if (modalType === 'schedule') {
                renderScheduleCalendar();
            }
        };
    })();
    
    // CROSS-PAGE SYNC: Listen for changes from Today's Visits page
    window.addEventListener('storage', function(e) {
        if (e.key === 'visits-page-updated') {
            console.log('DASHBOARD: Detected changes from visits page, reloading...');
            location.reload();
        }
        if (e.key && e.key.startsWith('apt-status-')) {
            console.log('DASHBOARD: Detected attendance status change');
            // Calendars will automatically reflect the updated localStorage values on next render
        }
    });
    
    // Notify visits page of changes when leaving dashboard
    window.addEventListener('beforeunload', function() {
        localStorage.setItem('dashboard-updated', Date.now().toString());
    });
    </script>

    <!-- Today's Queue Modal -->
    <div id="todayQueueModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'todayQueue')">
        <div class="ai-modal-content">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h2><i class="bi bi-clock-history"></i> Today's Queue</h2>
                <button class="ai-modal-close" onclick="closeModal('todayQueue')">x</button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon"><i class="bi bi-clock-history"></i></div>
                <h3>Current Patient Queue</h3>
                <p>This feature is under development. Manage today's patient queue and wait times in real-time.</p>
            </div>
        </div>
    </div>

    <!-- AI Modal -->
    <div id="aiModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'ai')">
        <div class="ai-modal-content">
            <div class="ai-modal-header">
                <h2><i class="bi bi-cpu-fill"></i> AI Decision Support</h2>
                <button class="ai-modal-close" onclick="closeModal('ai')">
                    x
                </button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon"><i class="bi bi-cpu-fill"></i></div>
                <h3>AI-Powered Health Insights</h3>
                <p>This feature is under development. Get AI-driven health recommendations and decision support here.</p>
            </div>
        </div>
    </div>

    <script>
        // VERSION 2.0 - FORCE CACHE BREAK
        console.log('CALENDAR SCRIPT VERSION 2.0 LOADED');
        
        // Mini Calendar State - Use actual current date
        let currentCalendarDate = new Date();
        const todayDate = new Date(); // Store today's date for comparison
        
        // Appointments data from backend
        // ============================================================
        // APPOINTMENTS DATA - Single Source of Truth
        // ============================================================
        // This data comes from the backend and contains all appointments
        // Both the mini calendar and schedule modal read from this
        const appointmentsData = @json($appointments ?? []);
        
        console.log('=== UNIFIED CALENDAR SYSTEM INITIALIZED ===');
        console.log('Total appointment dates:', Object.keys(appointmentsData).length);
        console.log('Appointment dates:', Object.keys(appointmentsData));
        Object.keys(appointmentsData).forEach(dateKey => {
            console.log(`  ${dateKey}: ${appointmentsData[dateKey].length} appointment(s)`);
        });
        console.log('============================================');
        
        // ============================================================
        // MINI CALENDAR WIDGET
        // ============================================================
        // ============================================================
        // MINI CALENDAR WIDGET
        // ============================================================
        function renderMiniCalendar() {
            const y = currentCalendarDate.getFullYear();
            const m = currentCalendarDate.getMonth();
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            // Calculate days
            const lastDayOfMonth = new Date(y, m + 1, 0);
            const totalDays = lastDayOfMonth.getDate();
            const firstDay = new Date(y, m, 1).getDay();
            const prevMonthDays = new Date(y, m, 0).getDate();
            
            // Update header
            document.getElementById('calendarMonthDisplay').textContent = months[m] + ' ' + y;
            
            // Get grid
            const gridElement = document.getElementById('miniCalendarGrid');
            gridElement.innerHTML = '';
            
            // Create day headers
            const headers = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            for (let h = 0; h < headers.length; h++) {
                const hdr = document.createElement('div');
                hdr.className = 'mini-calendar-day-label';
                hdr.textContent = headers[h];
                gridElement.appendChild(hdr);
            }
            
            // Previous month filler
            for (let p = firstDay - 1; p >= 0; p--) {
                const prevCell = document.createElement('div');
                prevCell.className = 'mini-calendar-day other-month';
                prevCell.textContent = prevMonthDays - p;
                gridElement.appendChild(prevCell);
            }
            
            // Current month - ALL DAYS
            for (let d = 1; d <= totalDays; d++) {
                const dayCell = document.createElement('div');
                dayCell.className = 'mini-calendar-day';
                dayCell.textContent = d;
                
                const cellDate = new Date(y, m, d);
                const dateKey = y + '-' + String(m + 1).padStart(2, '0') + '-' + String(d).padStart(2, '0');
                
                // Highlight today
                if (cellDate.toDateString() === todayDate.toDateString()) {
                    dayCell.classList.add('today');
                }
                
                // Mark dates with appointments (using unified data source)
                if (hasAppointments(dateKey)) {
                    dayCell.classList.add('has-appointments');
                }
                
                // Click handler - Show modal with appointments
                dayCell.style.cursor = 'pointer';
                dayCell.onclick = (function(year, month, day, key) {
                    return function() {
                        const clickedDate = new Date(year, month, day);
                        showCalendarDateModal(clickedDate, key);
                    };
                })(y, m, d, dateKey);
                
                gridElement.appendChild(dayCell);
            }
            
            // Next month filler
            const usedCells = firstDay + totalDays;
            const weeksRequired = Math.ceil(usedCells / 7);
            const totalRequired = weeksRequired * 7;
            const nextMonthCells = totalRequired - usedCells;
            
            for (let n = 1; n <= nextMonthCells; n++) {
                const nextCell = document.createElement('div');
                nextCell.className = 'mini-calendar-day other-month';
                nextCell.textContent = n;
                gridElement.appendChild(nextCell);
            }
        }
        
        function changeCalendarMonth(dir) {
            currentCalendarDate.setMonth(currentCalendarDate.getMonth() + dir);
            renderMiniCalendar();
        }
        
        // ============================================================
        // CALENDAR DATE MODAL (Popup from Mini Calendar)
        // ============================================================
        function showCalendarDateModal(date, dateKey) {
            const modal = document.getElementById('calendarDateModal');
            const modalTitle = document.getElementById('modalDateTitle');
            const modalSubtitle = document.getElementById('modalDateSubtitle');
            const modalAppointmentList = document.getElementById('modalAppointmentList');
            
            // Format date for display
            const options = { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' };
            const formattedDate = date.toLocaleDateString('en-US', options);
            const dateObj = new Date(date);
            const isToday = dateObj.toDateString() === new Date().toDateString();
            const isFuture = dateObj > new Date();
            
            modalTitle.textContent = formattedDate;
            
            // Get appointments using unified data source
            const appointments = getAppointmentsForDate(dateKey);
            
            // Set subtitle with count
            const countText = appointments.length === 1 ? '1 appointment' : `${appointments.length} appointments`;
            modalSubtitle.textContent = isToday ? `Today - ${countText}` : (isFuture ? `Upcoming - ${countText}` : `Past - ${countText}`);
            
            if (appointments.length === 0) {
                modalAppointmentList.innerHTML = `
                    <div class="calendar-date-empty">
                        <i class="bi bi-calendar-x"></i>
                        <div style="font-size: 16px; font-weight: 600; color: #6b7280; margin-top: 8px;">No appointments scheduled</div>
                        <div style="font-size: 13px; color: #9ca3af; margin-top: 4px;">This date is currently available</div>
                    </div>
                `;
            } else {
                modalAppointmentList.innerHTML = appointments.map(apt => `
                    <div class="calendar-date-appointment-item">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                            <div>
                                <div style="font-size: 15px; font-weight: 700; color: #111827; margin-bottom: 4px;">
                                    <i class="bi bi-person-circle" style="margin-right: 6px; color: #10b981;"></i>${apt.patient}
                                </div>
                                <div style="font-size: 13px; color: #6b7280;">
                                    <i class="bi bi-clock" style="margin-right: 4px;"></i>${apt.time}
                                </div>
                            </div>
                            <div style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); color: #1d4ed8; padding: 4px 12px; border-radius: 12px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                                ${apt.type}
                            </div>
                        </div>
                        ${apt.notes ? `<div style="font-size: 12px; color: #6b7280; margin-top: 8px; padding: 8px; background: #f9fafb; border-radius: 6px; border-left: 3px solid #10b981;"><i class="bi bi-chat-left-text" style="margin-right: 4px;"></i>${apt.notes}</div>` : ''}
                        <div style="display: flex; gap: 8px; margin-top: 12px;">
                            <button onclick="markAttendance(event, ${apt.id}, 'attended'); closeCalendarModal();" style="flex: 1; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 8px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;" 
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.3)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <i class="bi bi-check-circle"></i> Mark Attended
                            </button>
                            <button onclick="openDashboardReschedule(${apt.id}, '${apt.patient.replace(/'/g, "\\'")}', '${dateKey}', '${apt.time}'); closeCalendarModal();" style="flex: 1; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; padding: 8px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(245, 158, 11, 0.3)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <i class="bi bi-arrow-repeat"></i> Reschedule
                            </button>
                        </div>
                    </div>
                `).join('');
            }
            
            // Show modal
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeCalendarModal(event) {
            // Only close if clicking on backdrop or close button
            if (event && event.target !== event.currentTarget && !event.target.classList.contains('calendar-date-close')) {
                return;
            }
            
            const modal = document.getElementById('calendarDateModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('calendarDateModal');
                if (modal.classList.contains('active')) {
                    closeCalendarModal({ target: modal, currentTarget: modal });
                }
            }
        });
        
        function selectDate(date) {
            // Legacy function - no longer used with modal implementation
            console.log('selectDate called (legacy) - date:', date);
        }
        
        function displayAppointmentsForDate(date) {
            // Legacy function - no longer used with modal implementation
            console.log('displayAppointmentsForDate called (legacy) - date:', date);
        }
        
        // Initialize calendar on page load
        document.addEventListener('DOMContentLoaded', function() {
            renderMiniCalendar();
        });
        
        // Attendance tracking
        function markAttendance(event, appointmentId, status) {
            event.stopPropagation();
            
            // Save to localStorage for sync with Today's Visits page
            const storageKey = 'apt-status-' + appointmentId;
            localStorage.setItem(storageKey, status);
            console.log('Saved to localStorage:', storageKey, '=', status);
            
            const appointmentItem = event.target.closest('.appointment-item');
            if (!appointmentItem) return;
            
            const statusElement = appointmentItem.querySelector('.appointment-status');
            const buttons = appointmentItem.querySelector('.attendance-buttons');
            
            if (status === 'attended') {
                if (statusElement) {
                    statusElement.innerHTML = '<span class="badge-attended" style="display: inline-block; padding: 2px 8px; border-radius: 8px; font-size: 10px; background: #D1FAE5; color: #065F46;">Attended</span>';
                }
                if (buttons) buttons.style.display = 'none';
            } else if (status === 'rescheduled') {
                if (statusElement) {
                    statusElement.innerHTML = '<span class="badge-rescheduled" style="display: inline-block; padding: 2px 8px; border-radius: 8px; font-size: 10px; background: #FEF3C7; color: #92400E;"><i class="bi bi-arrow-clockwise"></i> Rescheduled</span>';
                }
                if (buttons) buttons.style.display = 'none';
            }
        }
        
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 12px 20px;
                background: ${type === 'success' ? '#D1FAE5' : '#FEF3C7'};
                color: ${type === 'success' ? '#065F46' : '#92400E'};
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                z-index: 10000;
                font-weight: 500;
                animation: slideIn 0.3s ease;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 2000);
        }

        function openCalendarView() {
            // Redirect to calendar view page or appointments page
            window.location.href = '{{ route("visits.today") }}';
        }

        function openModal(modalType) {
            const modalMap = {
                'ai': 'aiModal',
                'newPatient': 'newPatientModal',
                'bookAppointment': 'bookAppointmentModal',
                'patientSearch': 'patientSearchModal',
                'todayPatients': 'todayPatientsModal',
                'appointmentsToday': 'appointmentsTodayModal',
                'totalPatients': 'totalPatientsModal',
                'immunizations': 'immunizationsModal',
                'medicalRecords': 'medicalRecordsModal',
                'patientList': 'patientListModal',
                'schedule': 'scheduleModal',
                'todayQueue': 'todayQueueModal'
            };
            const modalId = modalMap[modalType];
            if (modalId) {
                document.getElementById(modalId).classList.add('active');
            }
        }

        function closeModal(modalType) {
            const modalMap = {
                'ai': 'aiModal',
                'newPatient': 'newPatientModal',
                'bookAppointment': 'bookAppointmentModal',
                'patientSearch': 'patientSearchModal',
                'todayPatients': 'todayPatientsModal',
                'appointmentsToday': 'appointmentsTodayModal',
                'totalPatients': 'totalPatientsModal',
                'immunizations': 'immunizationsModal',
                'medicalRecords': 'medicalRecordsModal',
                'patientList': 'patientListModal',
                'schedule': 'scheduleModal',
                'todayQueue': 'todayQueueModal'
            };
            const modalId = modalMap[modalType];
            if (modalId) {
                document.getElementById(modalId).classList.remove('active');
            }
        }

        function closeModalOnBackdrop(event, modalType) {
            const modalMap = {
                'ai': 'aiModal',
                'newPatient': 'newPatientModal',
                'bookAppointment': 'bookAppointmentModal',
                'patientSearch': 'patientSearchModal',
                'todayPatients': 'todayPatientsModal',
                'appointmentsToday': 'appointmentsTodayModal',
                'totalPatients': 'totalPatientsModal',
                'immunizations': 'immunizationsModal',
                'medicalRecords': 'medicalRecordsModal',
                'patientList': 'patientListModal',
                'schedule': 'scheduleModal',
                'todayQueue': 'todayQueueModal'
            };
            const modalId = modalMap[modalType];
            if (event.target.id === modalId) {
                closeModal(modalType);
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                // Close all modals
                document.querySelectorAll('.ai-modal.active').forEach(modal => {
                    modal.classList.remove('active');
                });
            }
        });

        // ============================================================
        // UNIFIED CALENDAR SYSTEM - Single Source of Truth
        // ============================================================
        // Use appointmentsData from backend as the ONLY source
        // Both mini calendar and schedule modal read from this
        let currentDate = new Date();
        let selectedDateStr = '';
        let patientRecords = [];
        let patientIdCounter = 1001;
        let medicalRecords = [];
        let recordIdCounter = 1;
        let currentRecordFilter = 'all';
        
        // Helper function to get appointments for a specific date
        function getAppointmentsForDate(dateStr) {
            return appointmentsData[dateStr] || [];
        }
        
        // Helper function to check if date has appointments
        function hasAppointments(dateStr) {
            return appointmentsData[dateStr] && appointmentsData[dateStr].length > 0;
        }

        // ============================================================
        // SCHEDULE MODAL - Large Calendar
        // ============================================================
        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            
            // Update header
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                              'July', 'August', 'September', 'October', 'November', 'December'];
            document.getElementById('currentMonth').textContent = `${monthNames[month]} ${year}`;
            
            // Get first day of month and number of days
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const daysInPrevMonth = new Date(year, month, 0).getDate();
            
            const calendarDays = document.getElementById('calendarDays');
            calendarDays.innerHTML = '';
            
            const today = new Date();
            const isCurrentMonth = today.getFullYear() === year && today.getMonth() === month;
            
            // Previous month days
            for (let i = firstDay - 1; i >= 0; i--) {
                const day = daysInPrevMonth - i;
                const dayDiv = createDayElement(day, 'other-month');
                calendarDays.appendChild(dayDiv);
            }
            
            // Current month days
            for (let day = 1; day <= daysInMonth; day++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                let classes = '';
                
                if (isCurrentMonth && day === today.getDate()) {
                    classes = 'today';
                }
                
                // Check if this date has appointments using unified data source
                if (hasAppointments(dateStr)) {
                    classes += ' has-appointment';
                }
                
                const dayDiv = createDayElement(day, classes, dateStr);
                calendarDays.appendChild(dayDiv);
            }
            
            // Next month days - only fill to complete current week
            const totalCells = firstDay + daysInMonth;
            const weeksNeeded = Math.ceil(totalCells / 7);
            const totalSlotsNeeded = weeksNeeded * 7;
            const remainingCells = totalSlotsNeeded - totalCells;
            for (let day = 1; day <= remainingCells; day++) {
                const dayDiv = createDayElement(day, 'other-month');
                calendarDays.appendChild(dayDiv);
            }
        }

        function createDayElement(day, classes, dateStr = '') {
            const dayDiv = document.createElement('div');
            dayDiv.className = `calendar-day ${classes}`;
            
            const dayNumber = document.createElement('div');
            dayNumber.className = 'calendar-day-number';
            dayNumber.textContent = day;
            dayDiv.appendChild(dayNumber);
            
            if (dateStr) {
                dayDiv.onclick = () => selectDate(dateStr);
            }
            
            return dayDiv;
        }

        function selectDate(dateStr) {
            selectedDateStr = dateStr;
            const date = new Date(dateStr + 'T00:00:00');
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('selectedDate').textContent = date.toLocaleDateString('en-US', options);
            document.getElementById('appointmentFormContainer').style.display = 'block';
            
            // Clear form
            document.getElementById('patientName').value = '';
            document.getElementById('appointmentTime').value = '';
            document.getElementById('appointmentType').value = 'general';
            document.getElementById('appointmentNotes').value = '';
            
            // Display existing appointments for this date using unified data source
            displayAppointments(dateStr);
        }

        function displayAppointments(dateStr) {
            console.log('\n========== DISPLAY APPOINTMENTS ==========');
            console.log('Date to display:', dateStr);
            
            const appointmentList = document.getElementById('appointmentList');
            const dateAppointments = getAppointmentsForDate(dateStr);
            
            console.log('Retrieved appointments:', dateAppointments);
            console.log('Count:', dateAppointments.length);
            console.log('==========================================\n');
            
            // Create header with count
            const countText = dateAppointments.length === 1 ? '1 appointment' : `${dateAppointments.length} appointments`;
            appointmentList.innerHTML = `
                <div style="padding: 16px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border-radius: 8px; margin-bottom: 16px;">
                    <h4 style="margin: 0; font-size: 16px; font-weight: 600;">${countText} scheduled</h4>
                </div>
            `;
            
            if (dateAppointments.length > 0) {
                dateAppointments.forEach((apt) => {
                    console.log('Displaying appointment:', apt);
                    const aptDiv = document.createElement('div');
                    aptDiv.className = 'appointment-item';
                    aptDiv.style.cssText = 'padding: 16px; background: #f9fafb; border-radius: 8px; margin-bottom: 12px; border-left: 4px solid #10b981;';
                    aptDiv.innerHTML = `
                        <div class="appointment-info">
                            <div style="font-size: 15px; font-weight: 600; color: #111827; margin-bottom: 4px;">
                                <i class="bi bi-person-circle" style="color: #10b981; margin-right: 6px;"></i>${apt.patient}
                            </div>
                            <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">
                                <i class="bi bi-clock" style="margin-right: 4px;"></i>${apt.time}
                            </div>
                            <div style="display: inline-block; background: #dbeafe; color: #1d4ed8; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                ${apt.type}
                            </div>
                            ${apt.notes ? `<div style="margin-top: 8px; padding: 8px; background: white; border-radius: 4px; font-size: 12px; color: #6b7280;"><i class="bi bi-chat-left-text" style="margin-right: 4px;"></i>${apt.notes}</div>` : ''}
                        </div>
                    `;
                    appointmentList.appendChild(aptDiv);
                });
            }
        }

        // Note: To book appointments, use the "Book Appointment" button in sidebar
        // The schedule modal is for VIEWING appointments only
        function saveAppointment() {
            alert('Please use the "Book Appointment" button in the sidebar to schedule appointments. This will save to the database.');
            cancelAppointmentForm();
        }

        function cancelAppointmentForm() {
            document.getElementById('appointmentFormContainer').style.display = 'none';
        }

        function changeMonth(delta) {
            currentDate.setMonth(currentDate.getMonth() + delta);
            renderCalendar();
            document.getElementById('appointmentFormContainer').style.display = 'none';
        }

        function goToToday() {
            currentDate = new Date();
            renderCalendar();
            document.getElementById('appointmentFormContainer').style.display = 'none';
        }

        // Initialize calendar on page load
        document.addEventListener('DOMContentLoaded', function() {
            renderCalendar();
        });

        // New Patient Registration Function
        function saveNewPatient() {
            const lastName = document.getElementById('patientLastName').value.trim();
            const firstName = document.getElementById('patientFirstName').value.trim();
            const middleInitial = document.getElementById('patientMiddleInitial').value.trim();
            const suffix = document.getElementById('patientSuffix').value;
            const dob = document.getElementById('patientDOB').value;
            const gender = document.getElementById('patientGender').value;
            const address = document.getElementById('patientAddress').value.trim();
            const phone = document.getElementById('patientPhone').value.trim();
            const email = document.getElementById('patientEmail').value.trim();
            const emergencyContact = document.getElementById('patientEmergencyContact').value.trim();
            const emergencyPhone = document.getElementById('patientEmergencyPhone').value.trim();
            const secondaryPhone = document.getElementById('patientSecondaryPhone').value.trim();
            const medicalHistory = document.getElementById('patientMedicalHistory').value.trim();
            const dataPrivacyConsent = document.getElementById('patientDataPrivacyConsent').checked;
            
            // Build full name from components
            let fullName = lastName + ', ' + firstName;
            if (middleInitial) {
                fullName += ' ' + middleInitial.toUpperCase() + '.';
            }
            if (suffix) {
                fullName += ' ' + suffix;
            }
            
            // Validate Data Privacy Consent FIRST
            if (!dataPrivacyConsent) {
                alert('You must accept the Data Privacy Consent to register a patient.\n\nPlease check the consent checkbox to proceed.');
                return;
            }
            
            // Validate required fields
            if (!lastName || !firstName || !dob || !gender || !address || !phone) {
                alert('Please fill in all required fields marked with *');
                return;
            }
            
            // Validate phone format (basic validation)
            const phonePattern = /^[0-9]{10,11}$/;
            const cleanPhone = phone.replace(/\s+/g, '');
            if (!phonePattern.test(cleanPhone)) {
                alert('Please enter a valid phone number (10-11 digits)');
                return;
            }
            
            // Prepare data for backend
            const formData = {
                first_name: firstName,
                last_name: lastName,
                middle_name: middleInitial.toUpperCase() || null,
                birthdate: dob,
                sex: gender.charAt(0).toUpperCase() + gender.slice(1), // Capitalize: male -> Male
                address: address,
                contact_number: phone,
                emergency_contact_name: emergencyContact || null,
                emergency_contact_number: emergencyPhone || null,
                _token: '{{ csrf_token() }}'
            };
            
            // Send AJAX request to backend
            fetch('{{ route("patients.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Clear form
                    document.getElementById('patientLastName').value = '';
                    document.getElementById('patientFirstName').value = '';
                    document.getElementById('patientMiddleInitial').value = '';
                    document.getElementById('patientSuffix').value = '';
                    document.getElementById('patientDOB').value = '';
                    document.getElementById('patientGender').value = '';
                    document.getElementById('patientAddress').value = '';
                    document.getElementById('patientPhone').value = '';
                    document.getElementById('patientSecondaryPhone').value = '';
                    document.getElementById('patientEmergencyContact').value = '';
                    document.getElementById('patientEmergencyPhone').value = '';
                    document.getElementById('patientMedicalHistory').value = '';
                    document.getElementById('patientEmail').value = '';
                    document.getElementById('patientDataPrivacyConsent').checked = false;
                    
                    alert(`${data.message}\n\nName: ${fullName}`);
                    closeModal('newPatient');
                    
                    // Refresh the page to show the new patient in lists
                    window.location.reload();
                } else {
                    let errorMsg = 'Failed to register patient.';
                    if (data.errors) {
                        errorMsg += '\n\n';
                        Object.values(data.errors).forEach(errors => {
                            errorMsg += errors.join('\n') + '\n';
                        });
                    }
                    alert(errorMsg);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while registering the patient. Please try again.');
            });
        }

        // Patient List Functions
        function renderPatientList() {
            const tbody = document.getElementById('patientTableBody');
            const noMessage = document.getElementById('noPatientsMessage');
            
            tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 20px;">Loading patients...</td></tr>';
            
            // Fetch real patient data from API
            fetch('/patients')
                .then(response => {
                    if (!response.ok) throw new Error('Failed to fetch patients');
                    return response.text();
                })
                .then(html => {
                    // Parse the HTML to extract patient data
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    // Extract patient data from the page
                    const patientRows = doc.querySelectorAll('tbody tr');
                    
                    tbody.innerHTML = '';
                    
                    if (patientRows.length === 0) {
                        noMessage.style.display = 'block';
                        return;
                    }
                    
                    noMessage.style.display = 'none';
                    
                    patientRows.forEach(row => {
                        const cells = row.querySelectorAll('td');
                        if (cells.length > 0) {
                            const patientId = cells[0].textContent.trim();
                            const name = cells[1].textContent.trim();
                            const age = cells[2].textContent.trim();
                            const sex = cells[3].textContent.trim();
                            const contact = cells[4].textContent.trim();
                            const lastVisit = cells[5] ? cells[5].textContent.trim() : '-';
                            const viewLink = cells[6].querySelector('a[href*="patients/"]');
                            const patientIdNum = viewLink ? viewLink.href.split('/').pop() : '';
                            
                            const newRow = document.createElement('tr');
                            newRow.innerHTML = `
                                <td>${patientId}</td>
                                <td>${name}</td>
                                <td>${age}</td>
                                <td><span class="badge badge-${sex.toLowerCase()}">${sex}</span></td>
                                <td>${contact}</td>
                                <td>${lastVisit}</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="btn-view" onclick="window.location.href='/patients/${patientIdNum}'">View</button>
                                        <button class="btn-view" onclick="window.location.href='/visits/create?patient_id=${patientIdNum}'" style="background: #10b981;">+ Visit</button>
                                    </div>
                                </td>
                            `;
                            tbody.appendChild(newRow);
                        }
                    });
                })
                .catch(error => {
                    console.error('Error loading patients:', error);
                    tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 20px; color: #ef4444;">Error loading patients. Please try again.</td></tr>';
                });
        }

        function filterPatients() {
            const searchTerm = document.getElementById('patientSearchInput').value.toLowerCase();
            
            if (searchTerm.length < 2) {
                renderPatientList();
                return;
            }
            
            const tbody = document.getElementById('patientTableBody');
            tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 20px;">Searching...</td></tr>';
            
            // Use the real search API
            fetch(`/api/patients/search?term=${encodeURIComponent(searchTerm)}`)
                .then(response => response.json())
                .then(patients => {
                    tbody.innerHTML = '';
                    const noMessage = document.getElementById('noPatientsMessage');
                    
                    if (patients.length === 0) {
                        noMessage.style.display = 'block';
                        return;
                    }
                    
                    noMessage.style.display = 'none';
                    
                    patients.forEach(patient => {
                        const petName = patient.pet_name || patient.name || 'Unknown';
                        const sex = patient.sex || 'N/A';
                        const ownerContact = patient.owner_contact || patient.contact || '-';
                        const lastVisit = patient.last_visit || '-';
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${patient.patient_id}</td>
                            <td>${petName}</td>
                            <td>${patient.age} yrs</td>
                            <td><span class="badge badge-${sex.toLowerCase().replace(/\s+/g, '-')}">${sex}</span></td>
                            <td>${ownerContact}</td>
                            <td>${lastVisit}</td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-view" onclick="window.location.href='/patients/${patient.id}'">View</button>
                                    <button class="btn-view" onclick="window.location.href='/visits/create?patient_id=${patient.id}'" style="background: #10b981;">+ Visit</button>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Search error:', error);
                    tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 20px; color: #ef4444;">Search failed. Please try again.</td></tr>';
                });
        }

        function viewPatient(index) {
            const patient = patientRecords[index];
            const details = `
Pet ID: ${patient.id}
Pet Name: ${patient.fullName}
Age: ${patient.age} years
Sex: ${patient.gender}
Date of Birth: ${patient.dob}
Owner Contact: ${patient.phone}
Email: ${patient.email || 'N/A'}
Address: ${patient.address}

Emergency Contact: ${patient.emergencyContact || 'N/A'}
Emergency Phone: ${patient.emergencyPhone || 'N/A'}

Medical History:
${patient.medicalHistory || 'None'}

Registered: ${new Date(patient.registeredDate).toLocaleString()}
            `;
            alert(details);
        }

        function deletePatient(index) {
            const patient = patientRecords[index];
            if (confirm(`Are you sure you want to delete patient ${patient.fullName} (${patient.id})?`)) {
                patientRecords.splice(index, 1);
                renderPatientList();
                alert('Patient record deleted successfully.');
            }
        }

        // Update modal open function to render patient list
        // Update modal open function to render appropriate content
        const originalOpenModalFunc = window.openModal;
        window.openModal = function(modalType) {
            originalOpenModalFunc(modalType);
            if (modalType === 'schedule') {
                renderCalendar();
            } else if (modalType === 'patientList') {
                renderPatientList();
            } else if (modalType === 'medicalRecords') {
                renderMedicalRecords();
                updatePatientSuggestions();
            } else if (modalType === 'patientSearch') {
                performQuickSearch();
            }
        };

        // Medical Records Functions
        function showAddRecordForm() {
            document.getElementById('addRecordForm').style.display = 'block';
            document.getElementById('recordDate').value = new Date().toISOString().split('T')[0];
        }

        function cancelAddRecord() {
            document.getElementById('addRecordForm').style.display = 'none';
            clearRecordForm();
        }

        function clearRecordForm() {
            document.getElementById('recordPatientId').value = '';
            document.getElementById('recordDate').value = '';
            document.getElementById('recordType').value = '';
            document.getElementById('recordChiefComplaint').value = '';
            document.getElementById('recordHeight').value = '';
            document.getElementById('recordWeight').value = '';
            document.getElementById('recordBP').value = '';
            document.getElementById('recordTemp').value = '';
            document.getElementById('recordHeartRate').value = '';
            document.getElementById('recordDiagnosis').value = '';
            document.getElementById('recordTreatment').value = '';
            document.getElementById('recordNotes').value = '';
        }

        function updatePatientSuggestions() {
            const datalist = document.getElementById('patientSuggestions');
            datalist.innerHTML = '';
            patientRecords.forEach(patient => {
                const option = document.createElement('option');
                option.value = `${patient.id} - ${patient.fullName}`;
                datalist.appendChild(option);
            });
        }

        function saveMedicalRecord() {
            const patientInput = document.getElementById('recordPatientId').value.trim();
            const date = document.getElementById('recordDate').value;
            const type = document.getElementById('recordType').value;
            const complaint = document.getElementById('recordChiefComplaint').value.trim();
            const height = document.getElementById('recordHeight').value;
            const weight = document.getElementById('recordWeight').value;
            const bp = document.getElementById('recordBP').value.trim();
            const temp = document.getElementById('recordTemp').value;
            const heartRate = document.getElementById('recordHeartRate').value;
            const diagnosis = document.getElementById('recordDiagnosis').value.trim();
            const treatment = document.getElementById('recordTreatment').value.trim();
            const notes = document.getElementById('recordNotes').value.trim();

            // Validate required fields
            if (!patientInput || !date || !type || !complaint || !diagnosis) {
                alert('Please fill in all required fields marked with *');
                return;
            }

            // Find patient
            const patientId = patientInput.split(' - ')[0];
            const patient = patientRecords.find(p => p.id === patientId || p.fullName.toLowerCase().includes(patientInput.toLowerCase()));
            
            if (!patient) {
                alert('Patient not found. Please select a valid patient from the list.');
                return;
            }

            // Calculate BMI if height and weight provided
            let bmi = null;
            if (height && weight) {
                const heightM = parseFloat(height) / 100;
                bmi = (parseFloat(weight) / (heightM * heightM)).toFixed(1);
            }

            const recordId = 'MR' + String(recordIdCounter++).padStart(5, '0');
            const record = {
                id: recordId,
                patientId: patient.id,
                patientName: patient.fullName,
                patientAge: patient.age,
                patientGender: patient.gender,
                date: date,
                type: type,
                chiefComplaint: complaint,
                vitals: {
                    height: height || 'N/A',
                    weight: weight || 'N/A',
                    bmi: bmi || 'N/A',
                    bloodPressure: bp || 'N/A',
                    temperature: temp || 'N/A',
                    heartRate: heartRate || 'N/A'
                },
                diagnosis: diagnosis,
                treatment: treatment || 'None',
                notes: notes || 'None',
                createdAt: new Date().toISOString()
            };

            medicalRecords.push(record);
            console.log('Medical Record Saved:', record);

            alert(`Medical record saved successfully!\n\nRecord ID: ${recordId}\nPatient: ${patient.fullName}\nDate: ${date}\nType: ${type}`);
            
            cancelAddRecord();
            renderMedicalRecords();
        }

        function renderMedicalRecords() {
            const container = document.getElementById('medicalRecordsList');
            const noMessage = document.getElementById('noRecordsMessage');
            
            container.innerHTML = '';
            
            let filteredRecords = medicalRecords;
            if (currentRecordFilter !== 'all') {
                filteredRecords = medicalRecords.filter(r => r.type === currentRecordFilter);
            }

            if (filteredRecords.length === 0) {
                noMessage.style.display = 'block';
                return;
            }

            noMessage.style.display = 'none';

            // Sort by date, newest first
            filteredRecords.sort((a, b) => new Date(b.date) - new Date(a.date));

            filteredRecords.forEach((record, index) => {
                const card = document.createElement('div');
                card.className = 'record-card';
                card.innerHTML = `
                    <div class="record-header">
                        <div class="record-patient-info">
                            <h4>${record.patientName} (${record.patientId})</h4>
                            <p>${record.patientAge} years, ${record.patientGender} • ${record.type}</p>
                        </div>
                        <div class="record-date">${new Date(record.date).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })}</div>
                    </div>
                    <div class="record-details">
                        <div class="record-field">
                            <label>Chief Complaint:</label>
                            <p>${record.chiefComplaint}</p>
                        </div>
                        <div class="record-field">
                            <label>Vitals:</label>
                            <p>Height: ${record.vitals.height} cm | Weight: ${record.vitals.weight} kg | BMI: ${record.vitals.bmi} | BP: ${record.vitals.bloodPressure} | Temp: ${record.vitals.temperature}°C | HR: ${record.vitals.heartRate} bpm</p>
                        </div>
                        <div class="record-field">
                            <label>Diagnosis:</label>
                            <p>${record.diagnosis}</p>
                        </div>
                        <div class="record-field">
                            <label>Treatment:</label>
                            <p>${record.treatment}</p>
                        </div>
                    </div>
                    <div class="record-actions">
                        <button class="btn-view" onclick="viewFullRecord(${medicalRecords.indexOf(record)})">View Full</button>
                        <button class="btn-delete" onclick="deleteRecord(${medicalRecords.indexOf(record)})">Delete</button>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        function filterRecordsByType(type) {
            currentRecordFilter = type;
            
            // Update active tab
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');
            
            renderMedicalRecords();
        }

        function searchMedicalRecords() {
            const searchTerm = document.getElementById('recordSearchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.record-card');
            
            let visibleCount = 0;
            
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            const noMessage = document.getElementById('noRecordsMessage');
            noMessage.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        function viewFullRecord(index) {
            const record = medicalRecords[index];
            const details = `
MEDICAL RECORD
═══════════════════════════════════════
Record ID: ${record.id}
Date: ${new Date(record.date).toLocaleDateString()}
Type: ${record.type}

PATIENT INFORMATION
Patient ID: ${record.patientId}
Name: ${record.patientName}
Age: ${record.patientAge} years
Sex: ${record.patientGender}

VITAL SIGNS
Height: ${record.vitals.height} cm
Weight: ${record.vitals.weight} kg
BMI: ${record.vitals.bmi}
Heart Rate: ${record.vitals.bloodPressure} bpm
Temperature: ${record.vitals.temperature}°C
Pulse Rate: ${record.vitals.heartRate} bpm

CHIEF COMPLAINT
${record.chiefComplaint}

DIAGNOSIS
${record.diagnosis}

TREATMENT/PRESCRIPTION
${record.treatment}

ADDITIONAL NOTES
${record.notes}

Created: ${new Date(record.createdAt).toLocaleString()}
            `;
            alert(details);
        }

        function deleteRecord(index) {
            const record = medicalRecords[index];
            if (confirm(`Are you sure you want to delete this medical record?\n\nRecord ID: ${record.id}\nPatient: ${record.patientName}\nDate: ${record.date}`)) {
                medicalRecords.splice(index, 1);
                renderMedicalRecords();
                alert('Medical record deleted successfully.');
            }
        }

        // Patient Search Functions
        function performQuickSearch() {
            const searchTerm = document.getElementById('quickSearchInput').value;
            const birthdayFilter = document.getElementById('searchBirthdayFilter').value;
            const sexFilter = document.getElementById('searchSexFilter').value;
            const speciesFilter = document.getElementById('searchSpeciesFilter').value;
            const ageFilter = document.getElementById('searchAgeFilter').value;
            
            const resultsContainer = document.getElementById('searchResults');
            const noResultsMessage = document.getElementById('noSearchResults');
            
            resultsContainer.innerHTML = '<div style="padding: 20px; text-align: center;">Searching...</div>';
            
            // Use the real search API
            const params = new URLSearchParams();
            if (searchTerm) params.append('term', searchTerm);
            if (birthdayFilter) params.append('birthday', birthdayFilter);
            
            fetch(`/api/patients/search?${params.toString()}`)
                .then(response => response.json())
                .then(patients => {
                    resultsContainer.innerHTML = '';
                    
                    // Apply client-side filters
                    let filteredPatients = patients.filter(patient => {
                        // Birthday filter
                        const matchesBirthday = !birthdayFilter || patient.birthdate === birthdayFilter;
                        
                        // Sex filter
                        const matchesSex = !sexFilter || patient.sex === sexFilter;
                        
                        // Species filter
                        const matchesSpecies = !speciesFilter || patient.species === speciesFilter;
                        
                        // Age filter
                        let matchesAge = true;
                        if (ageFilter) {
                            const age = patient.age;
                            if (ageFilter === '0-1') matchesAge = age >= 0 && age <= 1;
                            else if (ageFilter === '1-3') matchesAge = age >= 1 && age <= 3;
                            else if (ageFilter === '4-7') matchesAge = age >= 4 && age <= 7;
                            else if (ageFilter === '8-12') matchesAge = age >= 8 && age <= 12;
                            else if (ageFilter === '13+') matchesAge = age >= 13;
                        }
                        
                        return matchesBirthday && matchesSex && matchesSpecies && matchesAge;
                    });
                    
                    if (filteredPatients.length === 0) {
                        noResultsMessage.style.display = 'block';
                        return;
                    }
                    
                    noResultsMessage.style.display = 'none';
                    
                    filteredPatients.forEach(patient => {
                        const petName = patient.pet_name || patient.name || 'Unknown';
                        const species = patient.species || 'Unknown';
                        const breed = patient.breed || 'Unknown';
                        const owner = patient.owner_name || 'Unknown';
                        const ownerContact = patient.owner_contact || patient.contact || '';
                        const badgeText = patient.sex || species;
                        const card = document.createElement('div');
                        card.className = 'patient-result-card';
                        card.style.cursor = 'pointer';
                        card.onclick = () => showPatientQuickView(patient);
                        
                        // Format birthdate
                        const birthdate = patient.birthdate ? new Date(patient.birthdate).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) : 'N/A';
                        
                        card.innerHTML = `
                            <div class="patient-result-header">
                                <div>
                                    <div class="patient-result-name">${petName}</div>
                                    <div class="patient-result-id">ID: ${patient.patient_id}</div>
                                    <div class="patient-result-id" style="margin-top:2px;">${species} • ${breed}</div>
                                    <div class="patient-result-id" style="color:#10b981;margin-top:2px;">Owner: ${owner}${ownerContact ? ' • ' + ownerContact : ''}</div>
                                </div>
                                <div class="patient-badge">${badgeText}</div>
                            </div>
                        `;
                        
                        resultsContainer.appendChild(card);
                    });
                })
                .catch(error => {
                    console.error('Search error:', error);
                    resultsContainer.innerHTML = '<div style="padding: 20px; text-align: center; color: #ef4444;">Search failed. Please try again.</div>';
                });
        }

        // Show patient quick view modal
        function showPatientQuickView(patient) {
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.6);
                z-index: 10000;
                display: flex;
                align-items: center;
                justify-content: center;
                animation: fadeIn 0.2s ease;
            `;
            
            // Format birthdate
            const birthdate = patient.birthdate ? new Date(patient.birthdate).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) : 'N/A';
            
            modal.innerHTML = `
                <div style="background: white; border-radius: 12px; width: 90%; max-width: 500px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); animation: slideUp 0.3s ease;">
                    <div style="background: linear-gradient(135deg, #047857 0%, #059669 100%); color: white; padding: 16px 20px; border-radius: 12px 12px 0 0; display: flex; justify-content: space-between; align-items: center;">
                        <h2 style="margin: 0; font-size: 18px; font-weight: 700;"><i class="bi bi-person-circle"></i> Patient Details</h2>
                        <button onclick="this.closest('[style*=fixed]').remove(); document.body.style.overflow='auto'" style="background: rgba(255,255,255,0.2); border: none; color: white; font-size: 24px; cursor: pointer; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease;">&times;</button>
                    </div>
                    <div style="padding: 20px;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px;">
                            <div style="grid-column: span 2; padding: 10px 12px; background: #f9fafb; border-radius: 6px; border-left: 3px solid #047857;">
                                <label style="display: block; font-size: 10px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 4px; font-weight: 600;">Full Name</label>
                                <div style="font-size: 15px; color: #111827; font-weight: 500;">${patient.name}</div>
                            </div>
                            <div style="padding: 10px 12px; background: #f9fafb; border-radius: 6px; border-left: 3px solid #047857;">
                                <label style="display: block; font-size: 10px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 4px; font-weight: 600;">Patient ID</label>
                                <div style="font-size: 15px; color: #111827; font-weight: 500;">${patient.patient_id}</div>
                            </div>
                            <div style="padding: 10px 12px; background: #f9fafb; border-radius: 6px; border-left: 3px solid #10b981;">
                                <label style="display: block; font-size: 10px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 4px; font-weight: 600;">Birthday</label>
                                <div style="font-size: 15px; color: #10b981; font-weight: 500;">${birthdate}</div>
                            </div>
                            <div style="padding: 10px 12px; background: #f9fafb; border-radius: 6px; border-left: 3px solid #047857;">
                                <label style="display: block; font-size: 10px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 4px; font-weight: 600;">Age</label>
                                <div style="font-size: 15px; color: #111827; font-weight: 500;">${patient.age} years</div>
                            </div>
                            <div style="padding: 10px 12px; background: #f9fafb; border-radius: 6px; border-left: 3px solid #047857;">
                                <label style="display: block; font-size: 10px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 4px; font-weight: 600;">Sex</label>
                                <div style="font-size: 15px; color: #111827; font-weight: 500;">${patient.sex}</div>
                            </div>
                            <div style="padding: 10px 12px; background: #f9fafb; border-radius: 6px; border-left: 3px solid #047857;">
                                <label style="display: block; font-size: 10px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 4px; font-weight: 600;">Contact</label>
                                <div style="font-size: 15px; color: #111827; font-weight: 500;">${patient.contact || 'N/A'}</div>
                            </div>
                            <div style="grid-column: span 2; padding: 10px 12px; background: #f9fafb; border-radius: 6px; border-left: 3px solid #047857;">
                                <label style="display: block; font-size: 10px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 4px; font-weight: 600;">Address</label>
                                <div style="font-size: 15px; color: #111827; font-weight: 500;">${patient.address || 'N/A'}</div>
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 10px; padding: 16px 20px; border-top: 1px solid #e5e7eb; background: #f9fafb; border-radius: 0 0 12px 12px;">
                        <a href="/patients/${patient.id}" style="flex: 1; padding: 10px 18px; border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; text-align: center; background: #047857; color: white; display: inline-flex; align-items: center; justify-content: center; gap: 6px;"><i class="bi bi-clipboard2-check"></i> View Full Record</a>
                        <a href="/visits/create?patient_id=${patient.id}" style="flex: 1; padding: 10px 18px; border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; text-align: center; background: #3b82f6; color: white; display: inline-flex; align-items: center; justify-content: center; gap: 6px;"><i class="bi bi-hospital"></i> Add Visit</a>
                    </div>
                </div>
            `;
            
            modal.onclick = (e) => {
                if (e.target === modal) {
                    modal.remove();
                    document.body.style.overflow = 'auto';
                }
            };
            
            document.body.appendChild(modal);
            document.body.style.overflow = 'hidden';
        }

        function viewPatientDetails(patientId) {
            const patient = patientRecords.find(p => p.id === patientId);
            if (!patient) return;
            
            const patientMedicalRecords = medicalRecords.filter(r => r.patientId === patientId);
            const recordsList = patientMedicalRecords.length > 0 
                ? patientMedicalRecords.map(r => `  • ${new Date(r.date).toLocaleDateString()} - ${r.type}`).join('\n')
                : '  No medical records found';
            
            const details = `
PET DETAILS
═══════════════════════════════════════
Pet ID: ${patient.id}
Pet Name: ${patient.fullName}
Age: ${patient.age} years
Sex: ${patient.gender}
Date of Birth: ${patient.dob}

OWNER INFORMATION
Owner Contact: ${patient.phone}
Email: ${patient.email || 'N/A'}
Address: ${patient.address}

Emergency Contact: ${patient.emergencyContact || 'N/A'}
Emergency Phone: ${patient.emergencyPhone || 'N/A'}

Medical History/Allergies:
${patient.medicalHistory || 'None'}

MEDICAL RECORDS (${patientMedicalRecords.length})
${recordsList}

Registered: ${new Date(patient.registeredDate).toLocaleString()}
            `;
            alert(details);
        }

        function scheduleFromSearch(patientId) {
            const patient = patientRecords.find(p => p.id === patientId);
            if (!patient) return;
            
            closeModal('patientSearch');
            openModal('schedule');
            
            // Pre-fill patient name in appointment form after a short delay
            setTimeout(() => {
                const patientNameField = document.getElementById('patientName');
                if (patientNameField) {
                    patientNameField.value = patient.fullName;
                }
            }, 300);
        }

        function addRecordFromSearch(patientId) {
            const patient = patientRecords.find(p => p.id === patientId);
            if (!patient) return;
            
            closeModal('patientSearch');
            openModal('medicalRecords');
            
            // Show form and pre-fill patient info
            setTimeout(() => {
                showAddRecordForm();
                const patientIdField = document.getElementById('recordPatientId');
                if (patientIdField) {
                    patientIdField.value = `${patient.id} - ${patient.fullName}`;
                }
            }, 300);
        }

        // Initialize search when modal opens
        
        // Appointment booking - Service type handler
        document.addEventListener('DOMContentLoaded', function() {
            const appointmentServiceType = document.getElementById('appointmentServiceType');
            if (appointmentServiceType) {
                appointmentServiceType.addEventListener('change', function() {
                    const vaccinationSection = document.getElementById('appointmentVaccination');
                    const breedingSection = document.getElementById('appointmentBreeding');
                    const spayNeuterSection = document.getElementById('appointmentFP');
                    const referralSection = document.getElementById('appointmentReferral');
                    
                    // Hide all sections
                    if (vaccinationSection) vaccinationSection.style.display = 'none';
                    if (breedingSection) breedingSection.style.display = 'none';
                    if (spayNeuterSection) spayNeuterSection.style.display = 'none';
                    if (referralSection) referralSection.style.display = 'none';
                    
                    // Remove required attributes
                    document.querySelectorAll('#appointmentVaccination input, #appointmentVaccination select, #appointmentBreeding input, #appointmentBreeding select, #appointmentFP input, #appointmentFP select, #appointmentReferral input, #appointmentReferral select').forEach(field => {
                        field.removeAttribute('required');
                    });
                    
                    // Show relevant section and set required
                    if (this.value === 'Vaccination') {
                        if (vaccinationSection) {
                            vaccinationSection.style.display = 'flex';
                            vaccinationSection.querySelector('[name="vaccine_name"]').setAttribute('required', 'required');
                            vaccinationSection.querySelector('[name="dose_number"]').setAttribute('required', 'required');
                        }
                    } else if (this.value === 'Breeding Consultation') {
                        if (breedingSection) {
                            breedingSection.style.display = 'flex';
                            breedingSection.querySelector('[name="breeding_status"]').setAttribute('required', 'required');
                        }
                    } else if (this.value === 'Spay/Neuter') {
                        if (spayNeuterSection) {
                            spayNeuterSection.style.display = 'flex';
                            spayNeuterSection.querySelector('[name="fp_method"]').setAttribute('required', 'required');
                        }
                    } else if (this.value === 'Referral') {
                        if (referralSection) {
                            referralSection.style.display = 'flex';
                            referralSection.querySelector('[name="referred_to"]').setAttribute('required', 'required');
                        }
                    }
                });
            }
            
            // Appointment patient search
            const appointmentSearchInput = document.getElementById('appointmentPatientSearch');
            const appointmentSearchResults = document.getElementById('appointmentSearchResults');
            const appointmentPatientId = document.getElementById('appointmentPatientId');
            const selectedPatientDisplay = document.getElementById('selectedPatientDisplay');
            const selectedPatientName = document.getElementById('selectedPatientName');
            let searchTimeout;
            
            if (appointmentSearchInput) {
                appointmentSearchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    const query = this.value.trim();
                    
                    if (query.length < 2) {
                        appointmentSearchResults.style.display = 'none';
                        return;
                    }
                    
                    searchTimeout = setTimeout(() => {
                        fetch(`/api/patients/search?q=${encodeURIComponent(query)}`)
                            .then(res => res.json())
                            .then(patients => {
                                if (patients.length > 0) {
                                    displayAppointmentResults(patients);
                                } else {
                                    appointmentSearchResults.innerHTML = '<div style="padding: 12px; color: #6b7280; text-align: center;">No pets found</div>';
                                    appointmentSearchResults.style.display = 'block';
                                }
                            })
                            .catch(err => console.error('Search error:', err));
                    }, 300);
                });
                
                // Hide results when clicking outside
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('#appointmentPatientSearch') && !e.target.closest('#appointmentSearchResults')) {
                        appointmentSearchResults.style.display = 'none';
                    }
                });
            }
            
            function displayAppointmentResults(patients) {
                appointmentSearchResults.innerHTML = patients.map(patient => `
                    <div onclick="selectAppointmentPatient(${patient.id}, '${patient.full_name}', '${patient.patient_id}')" style="padding: 12px; cursor: pointer; border-bottom: 1px solid #f3f4f6; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                        <strong style="color: #047857; display: block;">${patient.full_name}</strong>
                        <small style="color: #6b7280; font-size: 12px;">ID: ${patient.patient_id} | ${patient.sex} | ${patient.age} yrs</small>
                    </div>
                `).join('');
                appointmentSearchResults.style.display = 'block';
            }
            
            window.selectAppointmentPatient = function(id, name, patientId) {
                appointmentPatientId.value = id;
                selectedPatientName.textContent = `${name} (${patientId})`;
                appointmentSearchInput.style.display = 'none';
                selectedPatientDisplay.style.display = 'block';
                appointmentSearchResults.style.display = 'none';
            };
            
            window.clearAppointmentPatient = function() {
                appointmentPatientId.value = '';
                appointmentSearchInput.value = '';
                appointmentSearchInput.style.display = 'block';
                selectedPatientDisplay.style.display = 'none';
            };
        });

        // Dashboard Reschedule Modal Functions
        function openDashboardReschedule(aptId, patientName, currentDate, currentTime) {
            document.getElementById('dashboardRescheduleAppointmentId').value = aptId;
            document.getElementById('dashboardReschedulePatientName').textContent = 'Patient: ' + patientName;
            document.getElementById('dashboardCurrentAppointmentInfo').innerHTML = 
                '<strong>' + currentDate + '</strong><br>' + currentTime;
            
            const modal = document.getElementById('dashboardRescheduleModal');
            modal.style.display = 'flex';
        }

        function closeDashboardRescheduleModal() {
            document.getElementById('dashboardRescheduleModal').style.display = 'none';
            document.getElementById('dashboardRescheduleForm').reset();
        }

        // Handle dashboard reschedule form submission
        document.addEventListener('DOMContentLoaded', function() {
            const rescheduleForm = document.getElementById('dashboardRescheduleForm');
            if (rescheduleForm) {
                rescheduleForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const aptId = document.getElementById('dashboardRescheduleAppointmentId').value;
                    const newDate = document.getElementById('dashboardNewAppointmentDate').value;
                    const newTime = document.getElementById('dashboardNewAppointmentTime').value;
                    
                    // Format the time for display
                    const timeObj = new Date('2000-01-01 ' + newTime);
                    const formattedTime = timeObj.toLocaleTimeString('en-US', { 
                        hour: 'numeric', 
                        minute: '2-digit', 
                        hour12: true 
                    });
                    
                    // Format the date for display
                    const dateObj = new Date(newDate);
                    const formattedDate = dateObj.toLocaleDateString('en-US', { 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    });
                    
                    // Send reschedule request to backend
                    fetch(`/appointments/${aptId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            appointment_date: newDate,
                            appointment_time: newTime,
                            status: 'scheduled'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success || data.message) {
                            // Mark as rescheduled in local storage
                            localStorage.setItem('apt-status-' + aptId, 'rescheduled');
                            
                            alert(`Appointment rescheduled successfully!\n\nNew Date: ${formattedDate}\nNew Time: ${formattedTime}`);
                            closeDashboardRescheduleModal();
                            
                            // Reload the page to show updated calendar
                            window.location.reload();
                        } else {
                            alert('Failed to reschedule appointment. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while rescheduling. Please try again.');
                    });
                });
            }
        });
    </script>

    <!-- Dashboard Reschedule Modal -->
    <div id="dashboardRescheduleModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:3000;align-items:center;justify-content:center;">
        <div style="background:white;border-radius:12px;max-width:500px;width:90%;max-height:90vh;overflow-y:auto;box-shadow:0 20px 25px -5px rgba(0,0,0,0.3);">
            <div style="padding:24px;border-bottom:1px solid #e5e7eb;">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <h2 style="margin:0;color:#047857;font-size:20px;"><i class="bi bi-arrow-clockwise"></i> Reschedule Appointment</h2>
                    <button onclick="closeDashboardRescheduleModal()" style="background:none;border:none;font-size:28px;color:#6b7280;cursor:pointer;padding:0;line-height:1;" onmouseover="this.style.color='#111827'" onmouseout="this.style.color='#6b7280'">&times;</button>
                </div>
                <p id="dashboardReschedulePatientName" style="margin:8px 0 0 0;color:#6b7280;font-size:14px;"></p>
            </div>
            <form id="dashboardRescheduleForm" method="POST" style="padding:24px;">
                @csrf
                @method('PUT')
                <input type="hidden" id="dashboardRescheduleAppointmentId" name="appointment_id">
                
                <div style="margin-bottom:20px;">
                    <label style="display:block;font-weight:500;color:#374151;margin-bottom:8px;font-size:14px;">Current Appointment</label>
                    <div style="padding:12px;background:#f9fafb;border-radius:6px;color:#6b7280;font-size:14px;">
                        <div id="dashboardCurrentAppointmentInfo"></div>
                    </div>
                </div>

                <div style="margin-bottom:20px;">
                    <label for="dashboardNewAppointmentDate" style="display:block;font-weight:500;color:#374151;margin-bottom:8px;font-size:14px;">New Date <span style="color:#ef4444;">*</span></label>
                    <input type="date" id="dashboardNewAppointmentDate" name="appointment_date" required style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:6px;font-size:14px;" min="{{ date('Y-m-d') }}">
                </div>

                <div style="margin-bottom:24px;">
                    <label for="dashboardNewAppointmentTime" style="display:block;font-weight:500;color:#374151;margin-bottom:8px;font-size:14px;">New Time <span style="color:#ef4444;">*</span></label>
                    <input type="time" id="dashboardNewAppointmentTime" name="appointment_time" required style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:6px;font-size:14px;">
                </div>

                <div style="display:flex;gap:12px;justify-content:flex-end;">
                    <button type="button" onclick="closeDashboardRescheduleModal()" style="padding:10px 20px;background:#e5e7eb;color:#374151;border:none;border-radius:6px;cursor:pointer;font-size:14px;font-weight:500;" onmouseover="this.style.background='#d1d5db'" onmouseout="this.style.background='#e5e7eb'">Cancel</button>
                    <button type="submit" style="padding:10px 20px;background:#047857;color:white;border:none;border-radius:6px;cursor:pointer;font-size:14px;font-weight:500;" onmouseover="this.style.background='#065f46'" onmouseout="this.style.background='#047857'">Confirm Reschedule</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
