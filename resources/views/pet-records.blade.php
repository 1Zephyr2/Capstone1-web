<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Records - PAWSER</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
            padding: 40px;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 32px 40px;
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .header:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .header h1 {
            font-size: 36px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .back-btn {
            background: white;
            color: #111827;
            border: 1px solid #111827;
            padding: 12px 28px;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(20, 184, 166, 0.3);
        }

        .back-btn:hover {
            background: #f0fdfa;
            border-color: #14b8a6;
            color: #14b8a6;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(20, 184, 166, 0.4);
        }

        .content-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            padding: 60px 48px;
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .content-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .coming-soon {
            text-align: center;
            padding: 80px 20px;
            color: #6B7280;
        }

        .coming-soon h2 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 16px;
            color: #111827;
            letter-spacing: -0.02em;
        }
        
        .coming-soon p {
            font-size: 18px;
            font-weight: 500;
            color: #6b7280;
        }

        .icon {
            font-size: 80px;
            margin-bottom: 28px;
            color: #14b8a6;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="bi bi-clipboard2-check"></i> Pet Records</h1>
            <a href="{{ route('dashboard') }}" class="back-btn">← Back to Dashboard</a>
        </div>

        <div class="content-card">
            <div class="coming-soon">
                <div class="icon"><i class="bi bi-clipboard2-check" style="font-size: 48px;"></i></div>
                <h2>Pet Records Management</h2>
                <p>This feature is under development. View and manage all pet records here.</p>
            </div>
        </div>
    </div>
</body>
</html>

