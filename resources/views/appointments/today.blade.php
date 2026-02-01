<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Appointments - CareSync</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            padding: 40px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 24px 32px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 28px;
            color: #111827;
        }

        .back-btn {
            background: #10B981;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .back-btn:hover {
            background: #059669;
        }

        .content-card {
            background: white;
            padding: 40px;
            border-radius: 14px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            border: 1px solid #E5E7EB;
        }

        .coming-soon {
            text-align: center;
            padding: 60px 20px;
            color: #6B7280;
        }

        .coming-soon h2 {
            font-size: 24px;
            margin-bottom: 12px;
            color: #111827;
        }

        .icon {
            font-size: 64px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📅 Today's Appointments</h1>
            <a href="{{ route('dashboard') }}" class="back-btn">← Back to Dashboard</a>
        </div>

        <div class="content-card">
            <div class="coming-soon">
                <div class="icon">📅</div>
                <h2>Today's Appointment Schedule</h2>
                <p>This feature is under development. View today's appointments here (18 total, 5 pending).</p>
            </div>
        </div>
    </div>
</body>
</html>
