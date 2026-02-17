<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breeding Program - Veterinary Clinic</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f5f5 0%, #f0f9ff 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #1f2937;
            font-size: 28px;
            margin-bottom: 8px;
        }
        .breadcrumb {
            color: #6b7280;
            font-size: 14px;
        }
        .breadcrumb a {
            color: #3b82f6;
            text-decoration: none;
        }
        .content {
            background: white;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #1f2937;
            font-size: 24px;
            margin-bottom: 16px;
        }
        p {
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 16px;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #6b7280;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.2s;
        }
        .btn-back:hover {
            background: #4b5563;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 24px;
        }
        .feature-card {
            padding: 20px;
            background: #f9fafb;
            border-radius: 8px;
            border-left: 4px solid #ec4899;
        }
        .feature-card h3 {
            color: #1f2937;
            font-size: 18px;
            margin-bottom: 8px;
        }
        .feature-card p {
            color: #6b7280;
            font-size: 14px;
            margin: 0;
        }
        .icon {
            font-size: 24px;
            color: #ec4899;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="bi bi-heart-pulse-fill"></i> Breeding Program</h1>
            <div class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a> / Breeding Program
            </div>
        </div>

        <div class="content">
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>

            <div style="margin-top: 32px;">
                <h2>Animal Breeding Management</h2>
                <p>Comprehensive breeding program management for your veterinary practice. Track breeding cycles, pregnancy status, expected delivery dates, and litter information.</p>

                <div class="feature-grid">
                    <div class="feature-card">
                        <div class="icon"><i class="bi bi-calendar-heart"></i></div>
                        <h3>Heat Cycle Tracking</h3>
                        <p>Monitor and record heat cycles for breeding candidates with automated reminders.</p>
                    </div>

                    <div class="feature-card">
                        <div class="icon"><i class="bi bi-activity"></i></div>
                        <h3>Pregnancy Monitoring</h3>
                        <p>Track pregnancy confirmation, progress checkups, and expected delivery dates based on species.</p>
                    </div>

                    <div class="feature-card">
                        <div class="icon"><i class="bi bi-file-medical"></i></div>
                        <h3>Breeding Records</h3>
                        <p>Maintain detailed records of sire, dam, breeding dates, and genetic information.</p>
                    </div>

                    <div class="feature-card">
                        <div class="icon"><i class="bi bi-clipboard-data"></i></div>
                        <h3>Litter Management</h3>
                        <p>Track litter size, delivery dates, and individual puppy/kitten health records.</p>
                    </div>

                    <div class="feature-card">
                        <div class="icon"><i class="bi bi-exclamation-triangle"></i></div>
                        <h3>Risk Assessment</h3>
                        <p>Identify and monitor high-risk pregnancies with special care requirements.</p>
                    </div>

                    <div class="feature-card">
                        <div class="icon"><i class="bi bi-graph-up"></i></div>
                        <h3>Analytics & Reports</h3>
                        <p>Generate breeding success rates, statistics, and comprehensive program reports.</p>
                    </div>
                </div>

                <div style="margin-top: 32px; padding: 20px; background: #dbeafe; border-radius: 8px; border-left: 4px solid #3b82f6;">
                    <h3 style="color: #1e40af; margin-bottom: 8px;">Getting Started</h3>
                    <p style="color: #1e40af; margin: 0;">To record a breeding consultation or track pregnancy, create a visit with service type "Breeding Consultation" from the patient's record.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
