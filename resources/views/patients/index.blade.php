<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets - Veterinary Clinic</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap');

        :root {
            --bg: #f5f7fb;
            --bg-alt: #eef2ff;
            --card: #ffffff;
            --text: #111827;
            --muted: #6b7280;
            --line: #e5e7eb;
            --primary: #2563eb;
            --primary-strong: #1d4ed8;
            --accent: #16a34a;
            --accent-strong: #15803d;
            --shadow-sm: 0 4px 14px rgba(15, 23, 42, 0.08);
            --shadow-lg: 0 20px 40px rgba(15, 23, 42, 0.12);
            --radius: 14px;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Manrope', sans-serif;
            background: linear-gradient(135deg, var(--bg) 0%, var(--bg-alt) 100%);
            padding: 20px;
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
            filter: blur(0.5px);
        }

        body::before {
            width: 420px;
            height: 420px;
            top: -140px;
            right: -120px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, rgba(37, 99, 235, 0) 70%);
        }

        body::after {
            width: 360px;
            height: 360px;
            bottom: -160px;
            left: -100px;
            background: radial-gradient(circle, rgba(22, 163, 74, 0.16) 0%, rgba(22, 163, 74, 0) 70%);
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
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
            margin-bottom: 20px;
        }
        .header-actions {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }
        .btn-new-patient {
            padding: 12px 22px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-strong) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
        }
        .btn-new-patient:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.32);
        }
        .btn-import {
            padding: 12px 20px;
            background: white;
            color: var(--primary);
            border: 1px solid rgba(37, 99, 235, 0.25);
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        .btn-import:hover {
            background: #eef2ff;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.15);
        }
        .btn-back {
            padding: 10px 16px;
            background: white;
            color: var(--text);
            border: 1px solid var(--line);
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }
        .btn-back:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-1px);
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
            color: #047857;
        }
        h1 {
            color: var(--text);
            margin: 0;
            flex: 1;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .search-bar {
            display: flex;
            gap: 14px;
            margin-bottom: 18px;
            align-items: center;
        }
        .search-wrapper {
            flex: 1;
            position: relative;
        }
        input[type="search"] {
            width: 100%;
            padding: 12px 44px 12px 16px;
            border: 1px solid var(--line);
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.2s ease;
            background: white;
        }
        input[type="search"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .btn-primary {
            background: var(--accent);
            color: white;
        }
        .btn-primary:hover {
            background: var(--accent-strong);
        }
        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }
        .btn-success {
            background: #10b981;
            color: white;
        }
        .btn-info {
            background: #3b82f6;
            color: white;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 16px;
        }
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .patients-table {
            background: var(--card);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--line);
            animation: pageEnter 0.5s ease;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background: #f8fafc;
        }
        th {
            padding: 16px 18px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 1px solid var(--line);
        }
        td {
            padding: 16px 18px;
            border-top: 1px solid var(--line);
            color: #1f2937;
        }
        tr:hover {
            background: #f8fafc;
        }
        .patient-id {
            font-family: monospace;
            color: #6b7280;
            font-size: 13px;
        }
        .patient-name {
            font-weight: 600;
            color: #111827;
        }
        .badge {
            padding: 5px 12px;
            border-radius: 14px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }
        .badge-male {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
        }
        .badge-female {
            background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
            color: #9f1239;
        }
        .actions {
            display: flex;
            gap: 8px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--muted);
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
        .empty-state svg {
            width: 64px;
            height: 64px;
            margin-bottom: 16px;
            opacity: 0.3;
        }
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 8px;
        }
        .autocomplete-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            margin-top: 4px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            max-height: 300px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
        }
        .autocomplete-results.show {
            display: block;
        }
        .autocomplete-item {
            padding: 12px 16px;
            cursor: pointer;
            border-bottom: 1px solid #f3f4f6;
        }
        .autocomplete-item:hover {
            background: #f9fafb;
        }
        .autocomplete-item:last-child {
            border-bottom: none;
        }
        .autocomplete-item .name {
            font-weight: 600;
            color: #111827;
        }
        .autocomplete-item .details {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        /* Patient Quick View Modal */
        .patient-quick-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 2000;
            animation: fadeIn 0.2s ease;
        }
        .patient-quick-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .patient-quick-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideUp 0.3s ease;
        }
        .patient-quick-header {
            background: linear-gradient(135deg, #047857 0%, #059669 100%);
            color: white;
            padding: 16px 20px;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .patient-quick-header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
        }
        .patient-quick-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .patient-quick-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }
        .patient-quick-body {
            padding: 20px;
        }
        .patient-quick-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }
        .patient-quick-field {
            padding: 10px 12px;
            background: #f9fafb;
            border-radius: 6px;
            border-left: 3px solid #047857;
        }
        .patient-quick-field.full {
            grid-column: span 2;
        }
        .patient-quick-field label {
            display: block;
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 4px;
            font-weight: 600;
        }
        .patient-quick-field .value {
            font-size: 15px;
            color: #111827;
            font-weight: 500;
        }
        .patient-quick-actions {
            display: flex;
            gap: 10px;
            padding: 16px 20px;
            border-top: 1px solid #e5e7eb;
            background: #f9fafb;
            border-radius: 0 0 12px 12px;
        }
        .patient-quick-btn {
            flex: 1;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .patient-quick-btn-primary {
            background: #047857;
            color: white;
        }
        .patient-quick-btn-primary:hover {
            background: #059669;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(4, 120, 87, 0.3);
        }
        .patient-quick-btn-secondary {
            background: #3b82f6;
            color: white;
        }
        .patient-quick-btn-secondary:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        /* Visit Modal Styles */
        .visit-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            overflow-y: auto;
        }
        .visit-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .visit-modal-content {
            background: white;
            border-radius: 8px;
            max-width: 800px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .visit-modal-header {
            background: #047857;
            color: white;
            padding: 20px 24px;
            border-radius: 8px 8px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .visit-modal-header h2 {
            margin: 0;
            font-size: 20px;
        }
        .modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
            padding: 0;
            width: 32px;
            height: 32px;
            line-height: 1;
        }
        .visit-modal-body {
            padding: 24px;
        }
        .modal-patient-info {
            background: #f0fdf4;
            padding: 16px;
            border-radius: 6px;
            margin-bottom: 24px;
            border-left: 4px solid #047857;
        }
        .modal-patient-info h3 {
            color: #047857;
            margin: 0 0 8px 0;
            font-size: 16px;
        }
        .modal-patient-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 8px;
            font-size: 13px;
            color: #374151;
        }
        .modal-section-title {
            font-size: 15px;
            font-weight: 600;
            color: #374151;
            margin: 20px 0 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
        }
        .modal-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }
        .modal-form-row.full {
            grid-template-columns: 1fr;
        }
        .modal-form-group {
            display: flex;
            flex-direction: column;
        }
        .modal-form-group label {
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }
        .modal-form-group input,
        .modal-form-group select,
        .modal-form-group textarea {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }
        .modal-form-group textarea {
            min-height: 80px;
            resize: vertical;
        }
        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        .btn-modal-cancel {
            padding: 10px 20px;
            background: #6b7280;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-modal-cancel:hover {
            background: #4b5563;
        }
        .btn-modal-submit {
            padding: 10px 20px;
            background: #047857;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-modal-submit:hover {
            background: #065f46;
        }
        
        /* Registration Modal Styles */
        .registration-modal {
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
            overflow-y: auto;
            padding: 20px;
        }
        .registration-modal.active {
            display: flex;
        }
        .registration-modal-content {
            background: white;
            border-radius: 8px;
            max-width: 800px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            margin: auto;
        }
        .registration-modal-header {
            padding: 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
        }
        .registration-modal-header h2 {
            margin: 0;
            color: #047857;
            font-size: 20px;
        }
        .registration-modal-body {
            padding: 24px;
        }
        .registration-modal-body .modal-section-title {
            font-size: 16px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 16px;
            margin-top: 24px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
        }
        .registration-modal-body .modal-section-title:first-child {
            margin-top: 0;
        }
        .registration-modal-body .modal-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }
        .registration-modal-body .modal-form-row.full {
            grid-template-columns: 1fr;
        }
        .registration-modal-body .modal-form-group {
            display: flex;
            flex-direction: column;
        }
        .registration-modal-body .modal-form-group label {
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }
        .registration-modal-body .modal-form-group .required {
            color: #dc2626;
        }
        .registration-modal-body .modal-form-group input,
        .registration-modal-body .modal-form-group select,
        .registration-modal-body .modal-form-group textarea {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.2s;
        }
        .registration-modal-body .modal-form-group input:focus,
        .registration-modal-body .modal-form-group select:focus,
        .registration-modal-body .modal-form-group textarea:focus {
            outline: none;
            border-color: #047857;
            box-shadow: 0 0 0 3px rgba(4,120,87,0.1);
        }
        .registration-modal-body .modal-form-group textarea {
            resize: vertical;
            min-height: 80px;
        }
        .registration-modal-body .modal-form-group .hint {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }
        .registration-modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        .registration-modal-actions .btn-modal-cancel {
            padding: 10px 20px;
            background: #e5e7eb;
            color: #374151;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }
        .registration-modal-actions .btn-modal-cancel:hover {
            background: #d1d5db;
        }
        .registration-modal-actions .btn-modal-submit {
            padding: 10px 20px;
            background: #047857;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }
        .registration-modal-actions .btn-modal-submit:hover {
            background: #059669;
        }
        .alert-modal {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-modal.success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }
        .alert-modal.error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .modal-optional-section {
            background: #f9fafb;
            padding: 16px;
            border-radius: 6px;
            margin-top: 16px;
        }
        
        /* Import Modal Styles */
        .import-modal {
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
            overflow-y: auto;
            padding: 20px;
        }
        .import-modal.active {
            display: flex;
        }
        .import-modal-content {
            background: white;
            border-radius: 8px;
            max-width: 900px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            margin: auto;
        }
        .import-modal-header {
            padding: 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
        }
        .import-modal-header h2 {
            margin: 0;
            color: #047857;
            font-size: 20px;
        }
        .import-modal-body {
            padding: 24px;
        }
        .import-info-box {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 16px;
            border-radius: 6px;
            margin-bottom: 24px;
        }
        .import-info-box h3 {
            color: #1e40af;
            font-size: 16px;
            margin-bottom: 8px;
        }
        .import-info-box ul {
            margin-left: 20px;
            color: #1e40af;
        }
        .import-info-box li {
            margin: 4px 0;
        }
        .upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            background: #f9fafb;
            margin: 20px 0;
            cursor: pointer;
            transition: all 0.3s;
        }
        .upload-area:hover {
            border-color: #047857;
            background: #f0fdf4;
        }
        .upload-area.dragover {
            border-color: #047857;
            background: #f0fdf4;
        }
        .upload-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }
        .file-info {
            background: #fef3c7;
            padding: 12px;
            border-radius: 6px;
            margin: 16px 0;
            display: none;
        }
        .file-info.show {
            display: block;
        }
        .sample-table {
            margin-top: 16px;
            overflow-x: auto;
        }
        .sample-table table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        .sample-table th {
            background: #f9fafb;
            padding: 8px;
            text-align: left;
            border: 1px solid #e5e7eb;
        }
        .sample-table td {
            padding: 6px 8px;
            border: 1px solid #e5e7eb;
        }
        .template-section {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            margin-top: 24px;
        }
        .btn-download {
            background: #3b82f6;
            color: white;
        }
        .btn-download:hover {
            background: #2563eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn-back" style="margin-bottom: 16px;">← Back to Dashboard</a>
        <div class="header">
            <div class="header-top">
                <a href="{{ route('dashboard') }}" class="header-logo">
                    <img src="/images/systemlogo.png" alt="VetCare" style="height: 35px; object-fit: contain;">
                </a>
                <h1>Pet List</h1>
            </div>
            
            <div class="header-actions">
                <button onclick="openRegistrationModal()" class="btn-new-patient">
                    <i class="bi bi-plus-circle"></i> Register New Pet
                </button>
                <button onclick="openImportModal()" class="btn-import">
                    <i class="bi bi-file-earmark-arrow-up"></i> Import from CSV
                </button>
            </div>
            
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="search-bar">
                <div class="search-wrapper">
                    <input 
                        type="search" 
                        id="patientSearch" 
                        placeholder="Search by pet name, owner, ID, or contact..."
                        autocomplete="off"
                    >
                    <span class="search-icon"><i class="bi bi-search"></i></span>
                    <div id="autocompleteResults" class="autocomplete-results"></div>
                </div>
            </div>
        </div>

        <div class="patients-table">
            @if($patients->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Owner Contact</th>
                        <th>Last Visit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                    <tr>
                        <td class="patient-id">{{ $patient->patient_id }}</td>
                        <td class="patient-name">{{ $patient->full_name }}</td>
                        <td>{{ $patient->age }} yrs</td>
                        <td>
                            <span class="badge badge-{{ strtolower($patient->sex) }}">
                                {{ $patient->sex }}
                            </span>
                        </td>
                        <td>{{ $patient->owner_contact ?: '-' }}</td>
                        <td>
                            @if($patient->visits->first())
                                {{ $patient->visits->first()->visit_date->format('M d, Y') }}
                            @else
                                <span style="color: #9ca3af;">No visits</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('patients.show', $patient) }}" class="btn btn-info btn-sm">View</a>
                                <button onclick="openVisitModal({{ $patient->id }}, '{{ $patient->full_name }}', '{{ $patient->patient_id }}', {{ $patient->age }}, '{{ $patient->sex }}')" class="btn btn-success btn-sm">+ Visit</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="pagination">
                {{ $patients->links() }}
            </div>
            @else
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3>No pets found</h3>
                <p>Start by registering a new pet</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Patient Quick View Modal -->
    <div id="patientQuickModal" class="patient-quick-modal">
        <div class="patient-quick-content">
            <div class="patient-quick-header">
                <h2><i class="bi bi-person-circle"></i> Patient Details</h2>
                <button class="patient-quick-close" onclick="closePatientQuickModal()">&times;</button>
            </div>
            <div class="patient-quick-body">
                <div class="patient-quick-info">
                    <div class="patient-quick-field full">
                        <label>Full Name</label>
                        <div class="value" id="quickPatientName"></div>
                    </div>
                    <div class="patient-quick-field">
                        <label>Patient ID</label>
                        <div class="value" id="quickPatientId"></div>
                    </div>
                    <div class="patient-quick-field">
                        <label>Age</label>
                        <div class="value" id="quickPatientAge"></div>
                    </div>
                    <div class="patient-quick-field">
                        <label>Sex</label>
                        <div class="value" id="quickPatientSex"></div>
                    </div>
                    <div class="patient-quick-field">
                        <label>Contact Number</label>
                        <div class="value" id="quickPatientContact"></div>
                    </div>showPatientQuickModal(${JSON.stringify(patient).replace(/"/g, '&quot;')})">
                                <div class="name">${patient.name} <span style="color: #047857; font-size: 12px; font-weight: 500;">(${patient.patient_id})</span></div>
                                <div class="details">${patient.age} yrs • ${patient.sex} ${patient.contact ? '• ' + patient.contact : ''}</div>
                            </div>
                        `).join('');
                    }
                    autocompleteResults.classList.add('show');
                })
                .catch(error => console.error('Search error:', error));
            }, 300);
        });

        // Patient Quick View Modal Functions
        function showPatientQuickModal(patient) {
            document.getElementById('quickPatientName').textContent = patient.name;
            document.getElementById('quickPatientId').textContent = patient.patient_id;
            document.getElementById('quickPatientAge').textContent = `${patient.age} years old`;
            document.getElementById('quickPatientSex').textContent = patient.sex;
            document.getElementById('quickPatientContact').textContent = patient.contact || 'Not provided';
            document.getElementById('quickPatientAddress').textContent = patient.address || 'Not provided';
            
            document.getElementById('quickViewFullBtn').href = `/patients/${patient.id}`;
            document.getElementById('quickAddVisitBtn').href = `/visits/create?patient_id=${patient.id}`;
            
            document.getElementById('patientQuickModal').classList.add('active');
            autocompleteResults.classList.remove('show');
            document.body.style.overflow = 'hidden';
        }

        function closePatientQuickModal() {
            document.getElementById('patientQuickModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close modal on outside click
        document.getElementById('patientQuickModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePatientQuickModal();
            }
        });

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePatientQuickModal();
            }<i class="bi bi-clipboard2-check"></i> View Full Record
                </a>
                <a id="quickAddVisitBtn" href="#" class="patient-quick-btn patient-quick-btn-secondary">
                    <i class="bi bi-hospital"></i> Add Visit
                </a>
            </div>
        </div>
    </div>

    <script>
        // Type-ahead search functionality
        const searchInput = document.getElementById('patientSearch');
        const autocompleteResults = document.getElementById('autocompleteResults');
        let searchTimeout;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const term = this.value.trim();

            if (term.length < 2) {
                autocompleteResults.classList.remove('show');
                return;
            }

            searchTimeout = setTimeout(() => {
                fetch(`/api/patients/search?term=${encodeURIComponent(term)}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(patients => {
                    if (patients.length === 0) {
                        autocompleteResults.innerHTML = '<div class="autocomplete-item">No patients found</div>';
                    } else {
                        autocompleteResults.innerHTML = patients.map(patient => `
                            <div class="autocomplete-item" onclick="window.location.href='/patients/${patient.id}'">
                                <div class="name">${patient.name}</div>
                                <div class="details">${patient.patient_id} • ${patient.age} yrs • ${patient.sex} ${patient.contact ? '• ' + patient.contact : ''}</div>
                            </div>
                        `).join('');
                    }
                    autocompleteResults.classList.add('show');
                })
                .catch(error => console.error('Search error:', error));
            }, 300);
        });

        // Close autocomplete when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !autocompleteResults.contains(e.target)) {
                autocompleteResults.classList.remove('show');
            }
        });

        function goBack() {
            const referrer = document.referrer;
            const currentDomain = window.location.origin;
            
            // Check if we have a referrer from the same domain and it's not the current page
            if (referrer && referrer.startsWith(currentDomain) && referrer !== window.location.href) {
                window.history.back();
            } else {
                window.location.href = '/dashboard';
            }
        }

        // Visit Modal Functions
        function openVisitModal(patientId, patientName, patientIdCode, age, sex) {
            document.getElementById('visitModal').classList.add('active');
            document.getElementById('modalPatientName').textContent = patientName;
            document.getElementById('modalPatientId').textContent = patientIdCode;
            document.getElementById('modalPatientAge').textContent = age;
            document.getElementById('modalPatientSex').textContent = sex;
            document.getElementById('visitPatientId').value = patientId;
            updateServiceSection(); // Update service section visibility
        }

        function closeVisitModal() {
            document.getElementById('visitModal').classList.remove('active');
            document.getElementById('visitForm').reset();
            updateServiceSection(); // Reset service section visibility
        }

        // Auto-calculate BMI
        function calculateBMI() {
            const weight = parseFloat(document.getElementById('modalWeight').value);
            const height = parseFloat(document.getElementById('modalHeight').value) / 100; // convert cm to m
            
            if (weight > 0 && height > 0) {
                const bmi = (weight / (height * height)).toFixed(1);
                document.getElementById('modalBMI').textContent = bmi;
            } else {
                document.getElementById('modalBMI').textContent = '-';
            }
        }

        // Handle service type changes to show/hide relevant sections
        function updateServiceSection() {
            const serviceTypeSelect = document.getElementById('modalServiceType');
            const vaccinationSection = document.getElementById('modalVaccinationSection');
            const breedingSection = document.getElementById('modalBreedingSection');            
            const referralSection = document.getElementById('modalReferralSection');
            
            // Get all field elements
            const vaccineName = document.getElementById('modalVaccineName');
            const doseNumber = document.getElementById('modalDoseNumber');
            const referredTo = document.getElementById('modalReferredTo');
            const referralReason = document.getElementById('modalReferralReason');
            
            if (!serviceTypeSelect) {
                console.log('Service type select not found');
                return;
            }
            
            const serviceType = serviceTypeSelect.value;
            console.log('Service type changed to:', serviceType);
            
            // Hide all sections and remove required attributes
            [vaccinationSection, breedingSection, referralSection].forEach(function(section) {
                if (section) section.style.display = 'none';
            });
            
            [vaccineName, doseNumber, referredTo, referralReason].forEach(function(field) {
                if (field) field.removeAttribute('required');
            });
            
            // Show relevant section and add required attributes
            if (serviceType === 'Vaccination' && vaccinationSection) {
                console.log('Showing vaccination section');
                vaccinationSection.style.display = 'block';
                if (vaccineName) vaccineName.setAttribute('required', 'required');
                if (doseNumber) doseNumber.setAttribute('required', 'required');
            } else if (serviceType === 'Breeding Consultation' && breedingSection) {
                console.log('Showing breeding section');
                breedingSection.style.display = 'block';
            } else if (serviceType === 'Follow-up' && referralSection) {
                console.log('Showing referral section');
                referralSection.style.display = 'block';
                if (referredTo) referredTo.setAttribute('required', 'required');
                if (referralReason) referralReason.setAttribute('required', 'required');
            }
        }
        
        // No need for DOMContentLoaded since we're using inline onchange

        // Close modal when clicking outside
        document.getElementById('visitModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeVisitModal();
            }
        });
        
        // Registration Modal Functions
        function openRegistrationModal() {
            document.getElementById('registrationModal').classList.add('active');
        }

        function closeRegistrationModal() {
            document.getElementById('registrationModal').classList.remove('active');
            document.getElementById('registrationForm').reset();
            document.getElementById('registrationAlert').style.display = 'none';
        }

        // Handle registration form submission via AJAX
        document.getElementById('registrationForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const alertDiv = document.getElementById('registrationAlert');
            
            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'Registering...';
            
            fetch('{{ route("patients.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    alertDiv.className = 'alert-modal success';
                    alertDiv.textContent = data.message || 'Patient registered successfully!';
                    alertDiv.style.display = 'block';
                    
                    // Reset form
                    this.reset();
                    
                    // Reload page after 1.5 seconds
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    // Show error message
                    alertDiv.className = 'alert-modal error';
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat().map(err => `<li>${err}</li>`).join('');
                        alertDiv.innerHTML = '<strong>Please fix the following errors:</strong><ul style="margin-top: 8px; margin-left: 20px;">' + errorList + '</ul>';
                    } else {
                        alertDiv.textContent = data.message || 'An error occurred. Please try again.';
                    }
                    alertDiv.style.display = 'block';
                    
                    // Re-enable submit button
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Register Patient';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alertDiv.className = 'alert-modal error';
                alertDiv.textContent = 'An error occurred. Please try again.';
                alertDiv.style.display = 'block';
                
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'Register Patient';
            });
        });

        // Close registration modal when clicking outside
        document.getElementById('registrationModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeRegistrationModal();
            }
        });
        
        // Import Modal Functions
        function openImportModal() {
            document.getElementById('importModal').classList.add('active');
        }

        function closeImportModal() {
            document.getElementById('importModal').classList.remove('active');
            document.getElementById('importForm').reset();
            document.getElementById('importFileInfo').classList.remove('show');
            document.getElementById('importBtn').disabled = true;
            document.getElementById('importAlert').style.display = 'none';
        }

        // File upload handling
        const importFileInput = document.getElementById('importFileInput');
        const uploadArea = document.getElementById('uploadArea');
        const fileInfo = document.getElementById('importFileInfo');
        const fileName = document.getElementById('importFileName');
        const importBtn = document.getElementById('importBtn');

        importFileInput?.addEventListener('change', function(e) {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
                fileInfo.classList.add('show');
                importBtn.disabled = false;
            }
        });

        // Drag and drop
        uploadArea?.addEventListener('click', function() {
            importFileInput.click();
        });

        uploadArea?.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        uploadArea?.addEventListener('dragleave', function() {
            this.classList.remove('dragover');
        });

        uploadArea?.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            if (e.dataTransfer.files.length > 0) {
                importFileInput.files = e.dataTransfer.files;
                fileName.textContent = e.dataTransfer.files[0].name;
                fileInfo.classList.add('show');
                importBtn.disabled = false;
            }
        });

        // Handle import form submission
        document.getElementById('importForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = importBtn;
            const alertDiv = document.getElementById('importAlert');
            
            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'Importing...';
            
            fetch('{{ route("patients.import") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    alertDiv.className = 'alert-modal success';
                    let message = data.message;
                    if (data.errors && data.errors.length > 0) {
                        message += '<br><br><strong>Some rows failed:</strong><ul style="margin-top: 8px; margin-left: 20px;">';
                        data.errors.forEach(err => {
                            message += `<li>${err}</li>`;
                        });
                        message += '</ul>';
                    }
                    alertDiv.innerHTML = message;
                    alertDiv.style.display = 'block';
                    
                    // Reset form
                    this.reset();
                    fileInfo.classList.remove('show');
                    
                    // Reload page after 2 seconds
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    // Show error message
                    alertDiv.className = 'alert-modal error';
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat().map(err => `<li>${err}</li>`).join('');
                        alertDiv.innerHTML = '<strong>Please fix the following errors:</strong><ul style="margin-top: 8px; margin-left: 20px;">' + errorList + '</ul>';
                    } else {
                        alertDiv.textContent = data.message || 'Import failed. Please check your file and try again.';
                    }
                    alertDiv.style.display = 'block';
                    
                    // Re-enable submit button
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Import Pets';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alertDiv.className = 'alert-modal error';
                alertDiv.textContent = 'An error occurred during import. Please try again.';
                alertDiv.style.display = 'block';
                
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'Import Pets';
            });
        });

        // Close import modal when clicking outside
        document.getElementById('importModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeImportModal();
            }
        });
    </script>

    <!-- Visit Modal -->
    <div id="visitModal" class="visit-modal">
        <div class="visit-modal-content">
            <div class="visit-modal-header">
                <h2><i class="bi bi-clipboard2-plus"></i> Record Patient Visit</h2>
                <button class="modal-close" onclick="closeVisitModal()">×</button>
            </div>
            <div class="visit-modal-body">
                <div class="modal-patient-info">
                    <h3 id="modalPatientName"></h3>
                    <div class="modal-patient-details">
                        <div><strong>ID:</strong> <span id="modalPatientId"></span></div>
                        <div><strong>Age:</strong> <span id="modalPatientAge"></span> years</div>
                        <div><strong>Sex:</strong> <span id="modalPatientSex"></span></div>
                    </div>
                </div>

                <form id="visitForm" action="{{ route('visits.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="patient_id" id="visitPatientId">

                    <div class="modal-section-title">Visit Information</div>
                    
                    <div class="modal-form-row">
                        <div class="modal-form-group">
                            <label>Service Type <span style="color: #ef4444;">*</span></label>
                            <select name="service_type" id="modalServiceType" required onchange="updateServiceSection()">
                                <option value="">Select service</option>
                                <option value="Wellness Exam">Wellness Exam</option>
                                <option value="Vaccination">Vaccination</option>
                                <option value="Surgery">Surgery</option>
                                <option value="Dental Cleaning">Dental Cleaning</option>
                                <option value="Emergency">Emergency</option>
                                <option value="Grooming">Grooming</option>
                                <option value="Boarding Checkup">Boarding Checkup</option>
                                <option value="Follow-up">Follow-up</option>
                                <option value="Diagnostics">Diagnostics</option>
                                <option value="Spay/Neuter">Spay/Neuter</option>
                                <option value="Breeding Consultation">Breeding Consultation</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="modal-form-group">
                            <label>Veterinarian/Staff</label>
                            <input type="text" name="health_worker" placeholder="Name of health worker">
                        </div>
                    </div>

                    <!-- Vaccination Section -->
                    <div id="modalVaccinationSection" class="modal-service-section" style="display: none;">
                        <div class="modal-section-title" style="background: #dbeafe; color: #1e40af; padding: 12px; border-radius: 6px; margin-bottom: 16px;">
                            <i class="bi bi-shield-fill-check"></i> Vaccination Details
                        </div>
                        <div class="modal-form-row">
                            <div class="modal-form-group">
                                <label>Vaccine Name <span style="color: #ef4444;">*</span></label>
                                <select name="vaccine_name" id="modalVaccineName">
                                    <option value="">Select vaccine</option>
                                    <optgroup label="Core Dog Vaccines">
                                        <option value="Rabies">Rabies</option>
                                        <option value="DHPP">DHPP (Distemper, Hepatitis, Parvovirus, Parainfluenza)</option>
                                        <option value="Distemper">Distemper</option>
                                        <option value="Parvovirus">Parvovirus</option>
                                    </optgroup>
                                    <optgroup label="Non-Core Dog Vaccines">
                                        <option value="Bordetella">Bordetella (Kennel Cough)</option>
                                        <option value="Leptospirosis">Leptospirosis</option>
                                        <option value="Lyme">Lyme Disease</option>
                                        <option value="Canine Influenza">Canine Influenza</option>
                                    </optgroup>
                                    <optgroup label="Core Cat Vaccines">
                                        <option value="FVRCP">FVRCP (Feline Viral Rhinotracheitis, Calicivirus, Panleukopenia)</option>
                                        <option value="Feline Rabies">Feline Rabies</option>
                                    </optgroup>
                                    <optgroup label="Non-Core Cat Vaccines">
                                        <option value="FeLV">FeLV (Feline Leukemia)</option>
                                        <option value="FIV">FIV (Feline Immunodeficiency Virus)</option>
                                        <option value="Chlamydia">Chlamydia</option>
                                    </optgroup>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="modal-form-group">
                                <label>Dose Number <span style="color: #ef4444;">*</span></label>
                                <select name="dose_number" id="modalDoseNumber">
                                    <option value="">Select dose</option>
                                    <option value="1">1st Dose</option>
                                    <option value="2">2nd Dose</option>
                                    <option value="3">3rd Dose</option>
                                    <option value="4">4th Dose</option>
                                    <option value="Booster">Annual Booster</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-form-row">
                            <div class="modal-form-group">
                                <label>Batch/Lot Number</label>
                                <input type="text" name="batch_number" placeholder="e.g., LOT123456">
                            </div>
                            <div class="modal-form-group">
                                <label>Next Dose Due Date</label>
                                <input type="date" name="next_dose_date" min="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Breeding Consultation Section -->
                    <div id="modalBreedingSection" class="modal-service-section" style="display: none;">
                        <div class="modal-section-title" style="background: #fce7f3; color: #9f1239; padding: 12px; border-radius: 6px; margin-bottom: 16px;">
                            <i class="bi bi-heart-pulse-fill"></i> Breeding Consultation Details
                        </div>
                        <div class="modal-form-row">
                            <div class="modal-form-group">
                                <label>Breeding Date</label>
                                <input type="date" name="breeding_date" max="{{ date('Y-m-d') }}">
                            </div>
                            <div class="modal-form-group">
                                <label>Breeding Status</label>
                                <select name="breeding_status">
                                    <option value="Planned">Planned</option>
                                    <option value="Bred">Bred</option>
                                    <option value="Confirmed Pregnant">Confirmed Pregnant</option>
                                    <option value="Not Pregnant">Not Pregnant</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-form-row">
                            <div class="modal-form-group">
                                <label>Sire (Male Parent)</label>
                                <input type="text" name="sire" placeholder="e.g., Max (Golden Retriever)">
                            </div>
                            <div class="modal-form-group">
                                <label>Dam (Female Parent)</label>
                                <input type="text" name="dam" placeholder="Usually the patient">
                            </div>
                        </div>
                        <div class="modal-form-row full">
                            <div class="modal-form-group">
                                <label>Breeding Notes/Concerns</label>
                                <textarea name="breeding_notes" placeholder="Any complications, concerns, or special notes..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Spay/Neuter Section -->
                    <div id="modalFamilyPlanningSection" class="modal-service-section" style="display: none;">
                        <div class="modal-section-title" style="background: #fef3c7; color: #78350f; padding: 12px; border-radius: 6px; margin-bottom: 16px;">
                            Spay/Neuter Details
                        </div>
                        <div class="modal-form-row">
                            <div class="modal-form-group">
                                <label>Procedure Type <span style="color: #ef4444;">*</span></label>
                                <select name="fp_method" id="modalFpMethod">
                                    <option value="">Select procedure</option>
                                    <option value="Spay (Female)">Spay (Female)</option>
                                    <option value="Neuter (Male)">Neuter (Male)</option>
                                    <option value="Not Applicable">Not Applicable</option>
                                </select>
                            </div>
                            <div class="modal-form-group">
                                <label>Procedure Date</label>
                                <input type="date" name="fp_quantity" max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="modal-form-row full">
                            <div class="modal-form-group">
                                <label>Follow-up Date</label>
                                <input type="date" name="fp_followup_date" min="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Referral Section -->
                    <div id="modalReferralSection" class="modal-service-section" style="display: none;">
                        <div class="modal-section-title" style="background: #fecaca; color: #7f1d1d; padding: 12px; border-radius: 6px; margin-bottom: 16px;">
                            <i class="bi bi-hospital"></i> Referral Details
                        </div>
                        <div class="modal-form-row">
                            <div class="modal-form-group">
                                <label>Referred To <span style="color: #ef4444;">*</span></label>
                                <input type="text" name="referred_to" id="modalReferredTo" placeholder="Hospital/Clinic name">
                            </div>
                            <div class="modal-form-group">
                                <label>Reason for Referral <span style="color: #ef4444;">*</span></label>
                                <input type="text" name="referral_reason" id="modalReferralReason" placeholder="e.g., Specialist cardiology consult">
                            </div>
                        </div>
                        <div class="modal-form-row full">
                            <div class="modal-form-group">
                                <label>Urgency Level</label>
                                <select name="referral_urgency">
                                    <option value="Routine">Routine</option>
                                    <option value="Urgent">Urgent</option>
                                    <option value="Emergency">Emergency</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-row full">
                        <div class="modal-form-group">
                            <label>Chief Complaint</label>
                            <textarea name="chief_complaint" placeholder="Patient's main concern or symptoms..."></textarea>
                        </div>
                    </div>

                    <div class="modal-section-title">Vital Signs</div>

                    <div class="modal-form-row">
                        <div class="modal-form-group">
                            <label>Heart Rate (bpm)</label>
                            <input type="number" name="blood_pressure" placeholder="80" min="40" max="200">
                        </div>
                        <div class="modal-form-group">
                            <label>Temperature (°C)</label>
                            <input type="number" name="temperature" step="0.1" min="30" max="45" placeholder="36.5">
                        </div>
                    </div>

                    <div class="modal-form-row">
                        <div class="modal-form-group">
                            <label>Pulse Rate (bpm)</label>
                            <input type="number" name="pulse_rate" step="1" min="30" max="200" placeholder="75">
                        </div>
                        <div class="modal-form-group">
                            <label>Weight (kg)</label>
                            <input type="number" name="weight" id="modalWeight" step="0.1" min="0" max="500" placeholder="65.5" oninput="calculateBMI()">
                        </div>
                    </div>

                    <div class="modal-form-row">
                        <div class="modal-form-group">
                            <label>Height (cm)</label>
                            <input type="number" name="height" id="modalHeight" step="0.1" min="0" max="300" placeholder="165" oninput="calculateBMI()">
                        </div>
                        <div class="modal-form-group">
                            <label>BMI</label>
                            <input type="text" readonly style="background: #f9fafb;" value="-" id="modalBMI">
                        </div>
                    </div>

                    <div class="modal-form-row full">
                        <div class="modal-form-group">
                            <label>Notes / Recommendations</label>
                            <textarea name="notes" placeholder="Additional notes, treatment, or recommendations..."></textarea>
                        </div>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-modal-cancel" onclick="closeVisitModal()">Cancel</button>
                        <button type="submit" class="btn-modal-submit">Save Visit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Import Modal -->
    <div id="importModal" class="import-modal">
        <div class="import-modal-content">
            <div class="import-modal-header">
                <h2>Import Patient Records</h2>
                <button class="modal-close" onclick="closeImportModal()" style="background: none; border: none; font-size: 28px; color: #6b7280; cursor: pointer; padding: 0; line-height: 1;">×</button>
            </div>
            <div class="import-modal-body">
                <div id="importAlert" class="alert-modal" style="display: none;"></div>
                
                <p style="color: #6b7280; margin-bottom: 20px; font-size: 14px;">Bulk upload patient data from CSV file</p>

                <div class="import-info-box">
                    <h3><i class="bi bi-file-earmark-text"></i> CSV File Requirements:</h3>
                    <ul>
                        <li><strong>Format:</strong> CSV (Comma-separated values)</li>
                        <li><strong>Required Columns:</strong> first_name, last_name, birthdate, sex, address</li>
                        <li><strong>Optional Columns:</strong> middle_name, contact_number, microchip_number</li>
                        <li><strong>Date Format:</strong> YYYY-MM-DD (e.g., 1990-05-15)</li>
                        <li><strong>Sex Values:</strong> Male or Female</li>
                    </ul>
                </div>

                <form id="importForm" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="upload-area" id="uploadArea">
                        <div class="upload-icon">File</div>
                        <h3>Drag and drop your file here</h3>
                        <p style="color: #6b7280; margin: 12px 0;">or</p>
                        <label for="importFileInput" class="btn btn-primary" style="cursor: pointer;">Choose File</label>
                        <input type="file" id="importFileInput" name="file" accept=".csv,.xlsx,.xls" style="display: none;" required>
                    </div>

                    <div class="file-info" id="importFileInfo">
                        <strong>Selected file:</strong> <span id="importFileName"></span>
                    </div>

                    <div class="registration-modal-actions">
                        <button type="button" class="btn-modal-cancel" onclick="closeImportModal()">Cancel</button>
                        <button type="submit" class="btn-modal-submit" id="importBtn" disabled>Import Patients</button>
                    </div>
                </form>

                <div class="template-section">
                    <h3 style="margin-bottom: 16px; color: #374151;">Download Sample Template</h3>
                    <p style="color: #6b7280; margin-bottom: 16px;">
                        Download this template, fill in your patient data, and upload it above.
                    </p>
                    <a href="{{ route('patients.download-template') }}" class="btn btn-download" target="_blank">Download CSV Template</a>

                    <div class="sample-table">
                        <p style="font-weight: 600; margin: 20px 0 12px; color: #374151;">Sample Format:</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>first_name</th>
                                    <th>last_name</th>
                                    <th>middle_name</th>
                                    <th>birthdate</th>
                                    <th>sex</th>
                                    <th>contact_number</th>
                                    <th>address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Maria</td>
                                    <td>Santos</td>
                                    <td>Cruz</td>
                                    <td>1990-05-15</td>
                                    <td>Female</td>
                                    <td>09171234567</td>
                                    <td>123 Main St, Brgy San Roque</td>
                                </tr>
                                <tr>
                                    <td>Juan</td>
                                    <td>Dela Cruz</td>
                                    <td></td>
                                    <td>1985-12-01</td>
                                    <td>Male</td>
                                    <td>09181234567</td>
                                    <td>456 Side St, Brgy Poblacion</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Registration Modal -->
    <div id="registrationModal" class="registration-modal">
        <div class="registration-modal-content">
            <div class="registration-modal-header">
                <h2>Register New Pet</h2>
                <button class="modal-close" onclick="closeRegistrationModal()" style="background: none; border: none; font-size: 28px; color: #6b7280; cursor: pointer; padding: 0; line-height: 1;">×</button>
            </div>
            <div class="registration-modal-body">
                <div id="registrationAlert" class="alert-modal" style="display: none;"></div>
                
                <p style="color: #6b7280; margin-bottom: 20px; font-size: 14px;">Fill in essential patient information. Patient ID will be auto-generated.</p>

                <form id="registrationForm">
                    @csrf

                    <!-- Basic Information -->
                    <div class="modal-section-title">Basic Information</div>
                    
                    <div class="modal-form-row">
                        <div class="modal-form-group">
                            <label>First Name <span class="required">*</span></label>
                            <input type="text" name="first_name" required>
                        </div>
                        <div class="modal-form-group">
                            <label>Last Name <span class="required">*</span></label>
                            <input type="text" name="last_name" required>
                        </div>
                    </div>

                    <div class="modal-form-row">
                        <div class="modal-form-group">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name">
                            <span class="hint">Optional</span>
                        </div>
                        <div class="modal-form-group">
                            <label>Birthdate <span class="required">*</span></label>
                            <input type="date" name="birthdate" required max="{{ date('Y-m-d') }}">
                            <span class="hint">Age will be auto-calculated</span>
                        </div>
                    </div>

                    <div class="modal-form-row">
                        <div class="modal-form-group">
                            <label>Sex <span class="required">*</span></label>
                            <select name="sex" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="modal-form-group">
                            <label>Contact Number</label>
                            <input type="tel" name="contact_number" placeholder="09XX-XXX-XXXX">
                        </div>
                    </div>

                    <div class="modal-form-row full">
                        <div class="modal-form-group">
                            <label>Address <span class="required">*</span></label>
                            <textarea name="address" required></textarea>
                            <span class="hint">House No., Street, Barangay, City</span>
                        </div>
                    </div>

                    <!-- Optional Information -->
                    <div class="modal-section-title">Additional Information (Optional)</div>
                    <div class="modal-optional-section">
                        <div class="modal-form-row">
                            <div class="modal-form-group">
                                <label>Microchip Number</label>
                                <input type="text" name="philhealth_number">
                            </div>
                            <div class="modal-form-group">
                                <label>Emergency Contact Name</label>
                                <input type="text" name="emergency_contact_name">
                            </div>
                        </div>
                        <div class="modal-form-row">
                            <div class="modal-form-group">
                                <label>Emergency Contact Number</label>
                                <input type="tel" name="emergency_contact_number">
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="registration-modal-actions">
                        <button type="button" class="btn-modal-cancel" onclick="closeRegistrationModal()">Cancel</button>
                        <button type="submit" class="btn-modal-submit">Register Patient</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
