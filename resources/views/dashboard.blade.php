<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - VaxLog</title>
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
            padding: 24px 0;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 0 24px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: #f59e0b;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 600;
        }

        .sidebar-subtitle {
            font-size: 12px;
            opacity: 0.9;
            padding-left: 52px;
        }

        .sidebar-menu {
            margin-top: 24px;
        }

        .menu-section {
            margin-bottom: 24px;
        }

        .menu-label {
            padding: 0 24px;
            font-size: 11px;
            text-transform: uppercase;
            opacity: 0.7;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .menu-item {
            margin: 0 16px 8px 16px;
            padding: 12px 16px;
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

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .action-card {
            background: #FFFFFF;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid #E5E7EB;
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
            height: 3px;
            background: currentColor;
        }

        .action-card:nth-child(1) { color: #3B82F6; }
        .action-card:nth-child(2) { color: #10B981; }
        .action-card:nth-child(3) { color: #8B5CF6; }
        .action-card:nth-child(4) { color: #F59E0B; }

        .action-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .action-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .action-icon.blue {
            background: #EFF6FF;
            color: #3B82F6;
        }

        .action-icon.green {
            background: #ECFDF5;
            color: #10B981;
        }

        .action-icon.purple {
            background: #F5F3FF;
            color: #8B5CF6;
        }

        .action-icon.orange {
            background: #FEF3C7;
            color: #F59E0B;
        }

        .action-details h3 {
            font-size: 15px;
            color: #111827;
            font-weight: 600;
            margin-bottom: 4px;
            letter-spacing: -0.01em;
        }

        .action-details p {
            font-size: 13px;
            color: #6B7280;
            font-weight: 400;
        }

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: #FFFFFF;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            transition: all 0.2s ease;
            border: 1px solid #E5E7EB;
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
            height: 3px;
        }

        .stat-card:nth-child(1)::before,
        .stat-card:nth-child(2)::before {
            background: #10B981;
        }

        .stat-card:nth-child(3)::before,
        .stat-card:nth-child(4)::before {
            background: #F59E0B;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .stat-title {
            font-size: 13px;
            color: #6B7280;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }

        .stat-change {
            font-size: 13px;
            color: #10B981;
            font-weight: 500;
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
            position: fixed;
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

        .ai-modal-content {
            background: white;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp 0.3s ease;
        }

        .ai-modal-header {
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            color: white;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ai-modal-header h2 {
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .ai-modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .ai-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
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
            padding: 15px;
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
            padding: 20px;
            background: #f9fafb;
            border-radius: 12px;
        }

        .appointment-form h4 {
            font-size: 16px;
            color: #111827;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #374151;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-primary {
            background: #10b981;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background: #d1d5db;
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
            .menu-label {
                display: none;
            }

            .menu-item {
                justify-content: center;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <div class="logo-icon">V</div>
                <div class="logo-text">VaxLog</div>
            </div>
            <div class="sidebar-subtitle">Health Center System</div>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-section">
                <div class="menu-label">Main</div>
                <a href="{{ route('dashboard') }}" class="menu-item active">
                    <span class="menu-icon">📊</span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-label">Patient Management</div>
                <div class="menu-item" onclick="openModal('medicalRecords')" style="cursor: pointer;">
                    <span class="menu-icon">📋</span>
                    <span class="menu-text">Medical Records</span>
                </div>
                <div class="menu-item" onclick="openModal('patientList')" style="cursor: pointer;">
                    <span class="menu-icon">👥</span>
                    <span class="menu-text">Patient List</span>
                </div>
                <div class="menu-item" onclick="openModal('newPatient')" style="cursor: pointer;">
                    <span class="menu-icon">➕</span>
                    <span class="menu-text">Add New Patient</span>
                </div>
            </div>

            <div class="menu-section">
                <div class="menu-label">Appointments</div>
                <div class="menu-item" onclick="openModal('schedule')" style="cursor: pointer;">
                    <span class="menu-icon">📅</span>
                    <span class="menu-text">Schedule</span>
                </div>
                <div class="menu-item" onclick="openModal('todayQueue')" style="cursor: pointer;">
                    <span class="menu-icon">🕐</span>
                    <span class="menu-text">Today's Queue</span>
                </div>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navigation -->
        <header class="top-nav">
            <div class="top-nav-left">
                <h1>Good {{ date('A') === 'AM' ? 'Morning' : 'Afternoon' }}, {{ Auth::user()->name }}!</h1>
                <p>{{ date('l, F j, Y') }}</p>
            </div>
            <div class="top-nav-right">
                <div class="user-info">
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-role">Health Center Staff</div>
                    </div>
                    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="dashboard-content">
            <!-- Quick Actions -->
            <div class="quick-actions">
                <div class="action-card" onclick="openModal('newPatient')" style="cursor: pointer;">
                    <div class="action-icon blue">📋</div>
                    <div class="action-details">
                        <h3>New Patient Record</h3>
                        <p>Create medical record</p>
                    </div>
                </div>

                <div class="action-card" onclick="openModal('bookAppointment')" style="cursor: pointer;">
                    <div class="action-icon green">📅</div>
                    <div class="action-details">
                        <h3>Book Appointment</h3>
                        <p>Schedule new visit</p>
                    </div>
                </div>

                <div class="action-card" onclick="openModal('patientSearch')" style="cursor: pointer;">
                    <div class="action-icon purple">👥</div>
                    <div class="action-details">
                        <h3>Patient Search</h3>
                        <p>Find patient records</p>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="stats-grid">
                    <div class="stat-card" onclick="openModal('todayPatients')" style="cursor: pointer;">
                        <div class="stat-header">
                            <span class="stat-title">Today's Patients</span>
                            <div class="stat-icon" style="background: #ECFDF5; color: #10B981;">👥</div>
                        </div>
                        <div class="stat-value">24</div>
                        <div class="stat-change">↑ 12% from yesterday</div>
                    </div>

                    <div class="stat-card" onclick="openModal('appointmentsToday')" style="cursor: pointer;">
                        <div class="stat-header">
                            <span class="stat-title">Appointments Today</span>
                            <div class="stat-icon" style="background: #ECFDF5; color: #10B981;">📅</div>
                        </div>
                        <div class="stat-value">18</div>
                        <div class="stat-change">5 pending</div>
                    </div>

                    <div class="stat-card" onclick="openModal('totalPatients')" style="cursor: pointer;">
                        <div class="stat-header">
                            <span class="stat-title">Total Patients</span>
                            <div class="stat-icon" style="background: #FEF3C7; color: #F59E0B;">📊</div>
                        </div>
                        <div class="stat-value">1,247</div>
                        <div class="stat-change">↑ 8% this month</div>
                    </div>

                    <div class="stat-card" onclick="openModal('immunizations')" style="cursor: pointer;">
                        <div class="stat-header">
                            <span class="stat-title">Immunizations</span>
                            <div class="stat-icon" style="background: #FEF3C7; color: #F59E0B;">💉</div>
                        </div>
                        <div class="stat-value">156</div>
                        <div class="stat-change">This month</div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Floating AI Assistant Button -->
    <button class="floating-ai-button" onclick="openModal('ai')" title="AI Assistant">
        🤖
    </button>

    <!-- New Patient Modal -->
    <div id="newPatientModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'newPatient')">
        <div class="ai-modal-content" style="max-width: 700px;">
            <div class="ai-modal-header">
                <h2><span>📋</span> New Patient Record</h2>
                <button class="ai-modal-close" onclick="closeModal('newPatient')">✕</button>
            </div>
            <div class="ai-modal-body" style="padding: 0;">
                <div class="calendar-container">
                    <div class="appointment-form" style="margin-top: 0;">
                        <h4>Patient Information</h4>
                        
                        <div class="form-group">
                            <label for="patientFullName">Full Name <span style="color: red;">*</span></label>
                            <input type="text" id="patientFullName" placeholder="Enter full name" required>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div class="form-group">
                                <label for="patientDOB">Date of Birth <span style="color: red;">*</span></label>
                                <input type="date" id="patientDOB" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="patientGender">Gender <span style="color: red;">*</span></label>
                                <select id="patientGender" required>
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="patientAddress">Address <span style="color: red;">*</span></label>
                            <textarea id="patientAddress" placeholder="Enter complete address" required style="min-height: 60px;"></textarea>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div class="form-group">
                                <label for="patientPhone">Phone Number <span style="color: red;">*</span></label>
                                <input type="tel" id="patientPhone" placeholder="09XX XXX XXXX" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="11">
                            </div>
                            
                            <div class="form-group">
                                <label for="patientEmail">Email Address</label>
                                <input type="email" id="patientEmail" placeholder="email@example.com">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="patientBloodType">Blood Type</label>
                            <select id="patientBloodType">
                                <option value="">Select blood type</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
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
                            <label for="patientMedicalHistory">Medical History / Allergies</label>
                            <textarea id="patientMedicalHistory" placeholder="Enter any known medical conditions, allergies, or current medications..."></textarea>
                        </div>
                        
                        <div class="form-actions">
                            <button class="btn-primary" onclick="saveNewPatient()">Register Patient</button>
                            <button class="btn-secondary" onclick="closeModal('newPatient')">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Book Appointment Modal -->
    <div id="bookAppointmentModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'bookAppointment')">
        <div class="ai-modal-content">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h2><span>📅</span> Book Appointment</h2>
                <button class="ai-modal-close" onclick="closeModal('bookAppointment')">✕</button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon">📅</div>
                <h3>Schedule New Visit</h3>
                <p>This feature is under development. You will be able to schedule patient appointments and manage visit times here.</p>
            </div>
        </div>
    </div>

    <!-- Patient Search Modal -->
    <div id="patientSearchModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'patientSearch')">
        <div class="ai-modal-content" style="max-width: 800px;">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                <h2><span>👥</span> Patient Search</h2>
                <button class="ai-modal-close" onclick="closeModal('patientSearch')">✕</button>
            </div>
            <div class="ai-modal-body" style="padding: 0;">
                <div class="search-container">
                    <div class="search-header">
                        <div class="search-box">
                            <input type="text" id="quickSearchInput" placeholder="🔍 Search by name, ID, phone, or email..." oninput="performQuickSearch()">
                        </div>
                    </div>
                    
                    <div class="search-filters">
                        <select id="searchGenderFilter" onchange="performQuickSearch()">
                            <option value="">All Genders</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        
                        <select id="searchBloodTypeFilter" onchange="performQuickSearch()">
                            <option value="">All Blood Types</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                        
                        <select id="searchAgeFilter" onchange="performQuickSearch()">
                            <option value="">All Ages</option>
                            <option value="0-17">0-17 years</option>
                            <option value="18-35">18-35 years</option>
                            <option value="36-50">36-50 years</option>
                            <option value="51-65">51-65 years</option>
                            <option value="66+">66+ years</option>
                        </select>
                    </div>
                    
                    <div id="searchResults" style="max-height: 500px; overflow-y: auto;">
                        <!-- Search results will be inserted here -->
                    </div>
                    
                    <div id="noSearchResults" class="no-patients" style="display: none;">
                        <p>No patients found matching your search criteria.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Patients Modal -->
    <div id="todayPatientsModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'todayPatients')">
        <div class="ai-modal-content">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h2><span>👥</span> Today's Patients</h2>
                <button class="ai-modal-close" onclick="closeModal('todayPatients')">✕</button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon">👥</div>
                <h3>24 Patients Today</h3>
                <p>This feature is under development. View the list of all patients scheduled for today, with ↑ 12% from yesterday.</p>
            </div>
        </div>
    </div>

    <!-- Appointments Today Modal -->
    <div id="appointmentsTodayModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'appointmentsToday')">
        <div class="ai-modal-content">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h2><span>📅</span> Appointments Today</h2>
                <button class="ai-modal-close" onclick="closeModal('appointmentsToday')">✕</button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon">📅</div>
                <h3>18 Appointments Today</h3>
                <p>This feature is under development. View and manage today's appointments with 5 pending confirmations.</p>
            </div>
        </div>
    </div>

    <!-- Total Patients Modal -->
    <div id="totalPatientsModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'totalPatients')">
        <div class="ai-modal-content">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                <h2><span>📊</span> Total Patients</h2>
                <button class="ai-modal-close" onclick="closeModal('totalPatients')">✕</button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon">📊</div>
                <h3>1,247 Total Patients</h3>
                <p>This feature is under development. View complete patient database with ↑ 8% growth this month.</p>
            </div>
        </div>
    </div>

    <!-- Immunizations Modal -->
    <div id="immunizationsModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'immunizations')">
        <div class="ai-modal-content">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);">
                <h2><span>💉</span> Immunizations</h2>
                <button class="ai-modal-close" onclick="closeModal('immunizations')">✕</button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon">💉</div>
                <h3>156 Immunizations This Month</h3>
                <p>This feature is under development. Track and manage all immunization records and schedules.</p>
            </div>
        </div>
    </div>

    <!-- Medical Records Modal -->
    <div id="medicalRecordsModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'medicalRecords')">
        <div class="ai-modal-content" style="max-width: 900px;">
            <div class="ai-modal-header">
                <h2><span>📋</span> Medical Records</h2>
                <button class="ai-modal-close" onclick="closeModal('medicalRecords')">✕</button>
            </div>
            <div class="ai-modal-body" style="padding: 0;">
                <div class="medical-records-container">
                    <button class="add-record-btn" onclick="showAddRecordForm()">➕ Add New Record</button>
                    
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
                                        <option value="General Checkup">General Checkup</option>
                                        <option value="Prenatal Care">Prenatal Care</option>
                                        <option value="Immunization">Immunization</option>
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
                                    <label for="recordBP">Blood Pressure</label>
                                    <input type="text" id="recordBP" placeholder="e.g., 120/80">
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
                        <button class="filter-tab" onclick="filterRecordsByType('General Checkup')">General Checkup</button>
                        <button class="filter-tab" onclick="filterRecordsByType('Prenatal Care')">Prenatal Care</button>
                        <button class="filter-tab" onclick="filterRecordsByType('Immunization')">Immunization</button>
                        <button class="filter-tab" onclick="filterRecordsByType('Follow-up')">Follow-up</button>
                    </div>
                    
                    <div class="search-box">
                        <input type="text" id="recordSearchInput" placeholder="🔍 Search by patient name or ID..." oninput="searchMedicalRecords()">
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
                <h2><span>👥</span> Patient List</h2>
                <button class="ai-modal-close" onclick="closeModal('patientList')">✕</button>
            </div>
            <div class="ai-modal-body" style="padding: 0;">
                <div class="patient-list-container">
                    <div class="search-box">
                        <input type="text" id="patientSearchInput" placeholder="🔍 Search by name, ID, or phone..." oninput="filterPatients()">
                    </div>
                    
                    <div style="overflow-x: auto; max-height: 500px;">
                        <table class="patient-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Blood Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="patientTableBody">
                                <!-- Patient rows will be inserted here -->
                            </tbody>
                        </table>
                        <div id="noPatientsMessage" class="no-patients" style="display: none;">
                            <p>No patients found.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Modal -->
    <div id="scheduleModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'schedule')">
        <div class="ai-modal-content" style="max-width: 750px;">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h2><span>📅</span> Schedule</h2>
                <button class="ai-modal-close" onclick="closeModal('schedule')">✕</button>
            </div>
            <div class="ai-modal-body" style="padding: 0;">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <h3 id="currentMonth">January 2026</h3>
                        <div class="calendar-nav">
                            <button onclick="changeMonth(-1)">← Prev</button>
                            <button onclick="goToToday()">Today</button>
                            <button onclick="changeMonth(1)">Next →</button>
                        </div>
                    </div>

                    <div class="calendar-weekdays">
                        <div class="calendar-weekday">Sun</div>
                        <div class="calendar-weekday">Mon</div>
                        <div class="calendar-weekday">Tue</div>
                        <div class="calendar-weekday">Wed</div>
                        <div class="calendar-weekday">Thu</div>
                        <div class="calendar-weekday">Fri</div>
                        <div class="calendar-weekday">Sat</div>
                    </div>

                    <div class="calendar-days" id="calendarDays"></div>

                    <div id="appointmentFormContainer" style="display: none;">
                        <div class="appointment-form">
                            <h4>Schedule Appointment - <span id="selectedDate"></span></h4>
                            <div class="form-group">
                                <label for="patientName">Patient Name</label>
                                <input type="text" id="patientName" placeholder="Enter patient name" required>
                            </div>
                            <div class="form-group">
                                <label for="appointmentTime">Time</label>
                                <input type="time" id="appointmentTime" required>
                            </div>
                            <div class="form-group">
                                <label for="appointmentType">Type</label>
                                <select id="appointmentType">
                                    <option value="general">General Checkup</option>
                                    <option value="prenatal">Prenatal Care</option>
                                    <option value="immunization">Immunization</option>
                                    <option value="followup">Follow-up</option>
                                    <option value="consultation">Consultation</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="appointmentNotes">Notes (Optional)</label>
                                <textarea id="appointmentNotes" placeholder="Additional notes..."></textarea>
                            </div>
                            <div class="form-actions">
                                <button class="btn-primary" onclick="saveAppointment()">Save Appointment</button>
                                <button class="btn-secondary" onclick="cancelAppointmentForm()">Cancel</button>
                            </div>
                        </div>

                        <div class="appointment-list" id="appointmentList"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Queue Modal -->
    <div id="todayQueueModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'todayQueue')">
        <div class="ai-modal-content">
            <div class="ai-modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h2><span>🕐</span> Today's Queue</h2>
                <button class="ai-modal-close" onclick="closeModal('todayQueue')">✕</button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon">🕐</div>
                <h3>Current Patient Queue</h3>
                <p>This feature is under development. Manage today's patient queue and wait times in real-time.</p>
            </div>
        </div>
    </div>

    <!-- AI Modal -->
    <div id="aiModal" class="ai-modal" onclick="closeModalOnBackdrop(event, 'ai')">
        <div class="ai-modal-content">
            <div class="ai-modal-header">
                <h2><span>🤖</span> AI Decision Support</h2>
                <button class="ai-modal-close" onclick="closeModal('ai')">
                    ✕
                </button>
            </div>
            <div class="ai-modal-body">
                <div class="ai-icon">🤖</div>
                <h3>AI-Powered Health Insights</h3>
                <p>This feature is under development. Get AI-driven health recommendations and decision support here.</p>
            </div>
        </div>
    </div>

    <script>
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

        // Calendar functionality
        let currentDate = new Date();
        let selectedDateStr = '';
        let appointments = {};
        let patientRecords = [];
        let patientIdCounter = 1001;
        let medicalRecords = [];
        let recordIdCounter = 1;
        let currentRecordFilter = 'all';

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
                
                if (appointments[dateStr] && appointments[dateStr].length > 0) {
                    classes += ' has-appointment';
                }
                
                const dayDiv = createDayElement(day, classes, dateStr);
                calendarDays.appendChild(dayDiv);
            }
            
            // Next month days
            const totalCells = calendarDays.children.length;
            const remainingCells = 42 - totalCells; // 6 rows * 7 days
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
            
            // Display existing appointments for this date
            displayAppointments(dateStr);
        }

        function displayAppointments(dateStr) {
            const appointmentList = document.getElementById('appointmentList');
            appointmentList.innerHTML = '';
            
            if (appointments[dateStr] && appointments[dateStr].length > 0) {
                appointments[dateStr].forEach((apt, index) => {
                    const aptDiv = document.createElement('div');
                    aptDiv.className = 'appointment-item';
                    aptDiv.innerHTML = `
                        <div class="appointment-info">
                            <div class="appointment-time">${apt.time} - ${apt.type}</div>
                            <div class="appointment-patient">${apt.patient}</div>
                        </div>
                        <button class="btn-delete" onclick="deleteAppointment('${dateStr}', ${index})">Delete</button>
                    `;
                    appointmentList.appendChild(aptDiv);
                });
            }
        }

        function saveAppointment() {
            const patientName = document.getElementById('patientName').value.trim();
            const time = document.getElementById('appointmentTime').value;
            const type = document.getElementById('appointmentType').value;
            const notes = document.getElementById('appointmentNotes').value.trim();
            
            if (!patientName || !time) {
                alert('Please fill in patient name and time');
                return;
            }
            
            if (!appointments[selectedDateStr]) {
                appointments[selectedDateStr] = [];
            }
            
            appointments[selectedDateStr].push({
                patient: patientName,
                time: time,
                type: type.charAt(0).toUpperCase() + type.slice(1),
                notes: notes
            });
            
            // Sort by time
            appointments[selectedDateStr].sort((a, b) => a.time.localeCompare(b.time));
            
            // Refresh calendar and appointment list
            renderCalendar();
            displayAppointments(selectedDateStr);
            
            // Clear form
            document.getElementById('patientName').value = '';
            document.getElementById('appointmentTime').value = '';
            document.getElementById('appointmentNotes').value = '';
            
            alert('Appointment scheduled successfully!');
        }

        function deleteAppointment(dateStr, index) {
            if (confirm('Are you sure you want to delete this appointment?')) {
                appointments[dateStr].splice(index, 1);
                if (appointments[dateStr].length === 0) {
                    delete appointments[dateStr];
                }
                renderCalendar();
                displayAppointments(dateStr);
            }
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
            const fullName = document.getElementById('patientFullName').value.trim();
            const dob = document.getElementById('patientDOB').value;
            const gender = document.getElementById('patientGender').value;
            const address = document.getElementById('patientAddress').value.trim();
            const phone = document.getElementById('patientPhone').value.trim();
            const email = document.getElementById('patientEmail').value.trim();
            const bloodType = document.getElementById('patientBloodType').value;
            const emergencyContact = document.getElementById('patientEmergencyContact').value.trim();
            const emergencyPhone = document.getElementById('patientEmergencyPhone').value.trim();
            const medicalHistory = document.getElementById('patientMedicalHistory').value.trim();
            
            // Validate required fields
            if (!fullName || !dob || !gender || !address || !phone) {
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
            
            // Calculate age from date of birth
            const birthDate = new Date(dob);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            // Create patient object
            const patientId = 'P' + String(patientIdCounter++).padStart(4, '0');
            const patient = {
                id: patientId,
                fullName: fullName,
                dob: dob,
                age: age,
                gender: gender,
                address: address,
                phone: phone,
                email: email,
                bloodType: bloodType || 'N/A',
                emergencyContact: emergencyContact,
                emergencyPhone: emergencyPhone,
                medicalHistory: medicalHistory,
                registeredDate: new Date().toISOString()
            };
            
            // Add to patient records
            patientRecords.push(patient);
            
            // Here you would normally send this to your backend
            console.log('New Patient Registered:', patient);
            
            // Clear form
            document.getElementById('patientFullName').value = '';
            document.getElementById('patientDOB').value = '';
            document.getElementById('patientGender').value = '';
            document.getElementById('patientAddress').value = '';
            document.getElementById('patientPhone').value = '';
            document.getElementById('patientEmail').value = '';
            document.getElementById('patientBloodType').value = '';
            document.getElementById('patientEmergencyContact').value = '';
            document.getElementById('patientEmergencyPhone').value = '';
            document.getElementById('patientMedicalHistory').value = '';
            
            alert(`Patient registered successfully!\n\nPatient ID: ${patientId}\nName: ${fullName}\nAge: ${age} years\nGender: ${gender}\n\nPlease provide this ID to the patient.`);
            closeModal('newPatient');
            
            // Update patient list if open
            if (document.getElementById('patientListModal').classList.contains('active')) {
                renderPatientList();
            }
        }

        // Patient List Functions
        function renderPatientList() {
            const tbody = document.getElementById('patientTableBody');
            const noMessage = document.getElementById('noPatientsMessage');
            
            tbody.innerHTML = '';
            
            if (patientRecords.length === 0) {
                noMessage.style.display = 'block';
                return;
            }
            
            noMessage.style.display = 'none';
            
            patientRecords.forEach((patient, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${patient.id}</td>
                    <td>${patient.fullName}</td>
                    <td>${patient.age}</td>
                    <td>${patient.gender}</td>
                    <td>${patient.phone}</td>
                    <td>${patient.bloodType}</td>
                    <td>
                        <div class="table-actions">
                            <button class="btn-view" onclick="viewPatient(${index})">View</button>
                            <button class="btn-delete" onclick="deletePatient(${index})">Delete</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function filterPatients() {
            const searchTerm = document.getElementById('patientSearchInput').value.toLowerCase();
            const tbody = document.getElementById('patientTableBody');
            const rows = tbody.getElementsByTagName('tr');
            
            let visibleCount = 0;
            
            for (let row of rows) {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }
            
            const noMessage = document.getElementById('noPatientsMessage');
            noMessage.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        function viewPatient(index) {
            const patient = patientRecords[index];
            const details = `
Patient ID: ${patient.id}
Name: ${patient.fullName}
Age: ${patient.age} years
Gender: ${patient.gender}
Date of Birth: ${patient.dob}
Phone: ${patient.phone}
Email: ${patient.email || 'N/A'}
Blood Type: ${patient.bloodType}
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
Gender: ${record.patientGender}

VITAL SIGNS
Height: ${record.vitals.height} cm
Weight: ${record.vitals.weight} kg
BMI: ${record.vitals.bmi}
Blood Pressure: ${record.vitals.bloodPressure}
Temperature: ${record.vitals.temperature}°C
Heart Rate: ${record.vitals.heartRate} bpm

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
            const searchTerm = document.getElementById('quickSearchInput').value.toLowerCase();
            const genderFilter = document.getElementById('searchGenderFilter').value;
            const bloodTypeFilter = document.getElementById('searchBloodTypeFilter').value;
            const ageFilter = document.getElementById('searchAgeFilter').value;
            
            const resultsContainer = document.getElementById('searchResults');
            const noResultsMessage = document.getElementById('noSearchResults');
            
            resultsContainer.innerHTML = '';
            
            let filteredPatients = patientRecords.filter(patient => {
                // Search term filter
                const matchesSearch = !searchTerm || 
                    patient.fullName.toLowerCase().includes(searchTerm) ||
                    patient.id.toLowerCase().includes(searchTerm) ||
                    patient.phone.includes(searchTerm) ||
                    (patient.email && patient.email.toLowerCase().includes(searchTerm));
                
                // Gender filter
                const matchesGender = !genderFilter || patient.gender === genderFilter;
                
                // Blood type filter
                const matchesBloodType = !bloodTypeFilter || patient.bloodType === bloodTypeFilter;
                
                // Age filter
                let matchesAge = true;
                if (ageFilter) {
                    const age = patient.age;
                    if (ageFilter === '0-17') matchesAge = age >= 0 && age <= 17;
                    else if (ageFilter === '18-35') matchesAge = age >= 18 && age <= 35;
                    else if (ageFilter === '36-50') matchesAge = age >= 36 && age <= 50;
                    else if (ageFilter === '51-65') matchesAge = age >= 51 && age <= 65;
                    else if (ageFilter === '66+') matchesAge = age >= 66;
                }
                
                return matchesSearch && matchesGender && matchesBloodType && matchesAge;
            });
            
            if (filteredPatients.length === 0) {
                noResultsMessage.style.display = 'block';
                return;
            }
            
            noResultsMessage.style.display = 'none';
            
            filteredPatients.forEach(patient => {
                const card = document.createElement('div');
                card.className = 'patient-result-card';
                
                // Count medical records for this patient
                const recordCount = medicalRecords.filter(r => r.patientId === patient.id).length;
                
                card.innerHTML = `
                    <div class="patient-result-header">
                        <div>
                            <div class="patient-result-name">${patient.fullName}</div>
                            <div class="patient-result-id">ID: ${patient.id}</div>
                        </div>
                        <div class="patient-badge">${patient.gender}</div>
                    </div>
                    
                    <div class="patient-info-grid">
                        <div class="patient-info-item">
                            <span class="patient-info-label">Age</span>
                            <span class="patient-info-value">${patient.age} years</span>
                        </div>
                        <div class="patient-info-item">
                            <span class="patient-info-label">Blood Type</span>
                            <span class="patient-info-value">${patient.bloodType || 'N/A'}</span>
                        </div>
                        <div class="patient-info-item">
                            <span class="patient-info-label">Phone</span>
                            <span class="patient-info-value">${patient.phone}</span>
                        </div>
                        <div class="patient-info-item">
                            <span class="patient-info-label">Email</span>
                            <span class="patient-info-value">${patient.email || 'N/A'}</span>
                        </div>
                        <div class="patient-info-item">
                            <span class="patient-info-label">Address</span>
                            <span class="patient-info-value">${patient.address}</span>
                        </div>
                        <div class="patient-info-item">
                            <span class="patient-info-label">Medical Records</span>
                            <span class="patient-info-value">${recordCount} record(s)</span>
                        </div>
                    </div>
                    
                    <div class="patient-actions-row">
                        <button class="btn-action btn-view-records" onclick="viewPatientDetails('${patient.id}')">View Full Details</button>
                        <button class="btn-action btn-schedule" onclick="scheduleFromSearch('${patient.id}')">Schedule Appointment</button>
                        <button class="btn-action btn-primary" onclick="addRecordFromSearch('${patient.id}')">Add Medical Record</button>
                    </div>
                `;
                
                resultsContainer.appendChild(card);
            });
        }

        function viewPatientDetails(patientId) {
            const patient = patientRecords.find(p => p.id === patientId);
            if (!patient) return;
            
            const patientMedicalRecords = medicalRecords.filter(r => r.patientId === patientId);
            const recordsList = patientMedicalRecords.length > 0 
                ? patientMedicalRecords.map(r => `  • ${new Date(r.date).toLocaleDateString()} - ${r.type}`).join('\n')
                : '  No medical records found';
            
            const details = `
PATIENT DETAILS
═══════════════════════════════════════
Patient ID: ${patient.id}
Name: ${patient.fullName}
Age: ${patient.age} years
Gender: ${patient.gender}
Date of Birth: ${patient.dob}

CONTACT INFORMATION
Phone: ${patient.phone}
Email: ${patient.email || 'N/A'}
Address: ${patient.address}

MEDICAL INFORMATION
Blood Type: ${patient.bloodType || 'N/A'}

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
    </script>
</body>
</html>
