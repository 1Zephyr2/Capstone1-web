<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Patients - Health Center</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 8px;
        }
        .btn-back {
            padding: 8px 16px;
            background: #6b7280;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-back:hover {
            background: #4b5563;
        }
        .header-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: inherit;
            transition: opacity 0.2s;
            margin-right: auto;
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
            color: #047857;
            margin: 0;
            flex: 1;
        }
        .subtitle {
            color: #6b7280;
            margin-bottom: 24px;
        }
        .info-box {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 16px;
            border-radius: 6px;
            margin-bottom: 24px;
        }
        .info-box h3 {
            color: #1e40af;
            font-size: 16px;
            margin-bottom: 8px;
        }
        .info-box ul {
            margin-left: 20px;
            color: #1e40af;
        }
        .info-box li {
            margin: 4px 0;
        }
        .upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            background: #f9fafb;
            margin: 20px 0;
        }
        .upload-area.dragover {
            border-color: #047857;
            background: #f0fdf4;
        }
        .upload-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }
        input[type="file"] {
            display: none;
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: #047857;
            color: white;
        }
        .btn-primary:hover {
            background: #059669;
        }
        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }
        .btn-secondary:hover {
            background: #d1d5db;
        }
        .btn-download {
            background: #3b82f6;
            color: white;
        }
        .actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 20px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        th {
            background: #f9fafb;
            padding: 8px;
            text-align: left;
            border: 1px solid #e5e7eb;
        }
        td {
            padding: 6px 8px;
            border: 1px solid #e5e7eb;
        }
        .sample-table {
            margin-top: 16px;
            overflow-x: auto;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header-top">
                <a href="{{ route('dashboard') }}" class="header-logo">
                    <img src="/images/systemlogo.png" alt="CareSync" style="height: 35px; object-fit: contain;">
                </a>
                <button onclick="goBack()" class="btn-back">← Back</button>
                <h1>Import Patient Records</h1>
            </div>
            <p class="subtitle">Bulk upload patient data from CSV or Excel file</p>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-error">
                <strong>Errors:</strong>
                <ul style="margin-top: 8px; margin-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="info-box">
                <h3><i class="bi bi-file-earmark-text"></i> CSV File Requirements:</h3>
                <ul>
                    <li><strong>Format:</strong> CSV (Comma-separated values) or Excel (.xlsx, .xls)</li>
                    <li><strong>Required Columns:</strong> first_name, last_name, birthdate, sex, address</li>
                    <li><strong>Optional Columns:</strong> middle_name, contact_number, philhealth_number</li>
                    <li><strong>Date Format:</strong> YYYY-MM-DD (e.g., 1990-05-15)</li>
                    <li><strong>Sex Values:</strong> Male or Female</li>
                </ul>
            </div>

            <form action="{{ route('patients.import') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                
                <div class="upload-area" id="uploadArea">
                    <div class="upload-icon">📁</div>
                    <h3>Drag and drop your file here</h3>
                    <p style="color: #6b7280; margin: 12px 0;">or</p>
                    <label for="fileInput" class="btn btn-primary">Choose File</label>
                    <input type="file" id="fileInput" name="file" accept=".csv,.xlsx,.xls" required>
                </div>

                <div class="file-info" id="fileInfo">
                    <strong>Selected file:</strong> <span id="fileName"></span>
                </div>

                <div class="actions">
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" id="uploadBtn" disabled>Import Patients</button>
                </div>
            </form>
        </div>

        <div class="card">
            <h3 style="margin-bottom: 16px; color: #374151;">📥 Download Sample Template</h3>
            <p style="color: #6b7280; margin-bottom: 16px;">
                Download this template, fill in your patient data, and upload it above.
            </p>
            <a href="{{ route('patients.download-template') }}" class="btn btn-download">Download CSV Template</a>

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
                            <th>philhealth_number</th>
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
                            <td>12-345678901-2</td>
                        </tr>
                        <tr>
                            <td>Juan</td>
                            <td>Dela Cruz</td>
                            <td></td>
                            <td>1985-08-20</td>
                            <td>Male</td>
                            <td>09181234567</td>
                            <td>456 Second Ave, Brgy San Roque</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            const referrer = document.referrer;
            const currentDomain = window.location.origin;
            
            // Check if we have a referrer from the same domain and it's not the current page
            if (referrer && referrer.startsWith(currentDomain) && referrer !== window.location.href) {
                window.history.back();
            } else {
                window.location.href = '/patients';
            }
        }

        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const uploadBtn = document.getElementById('uploadBtn');

        // File input change
        fileInput.addEventListener('change', function(e) {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
                fileInfo.classList.add('show');
                uploadBtn.disabled = false;
            }
        });

        // Drag and drop
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileName.textContent = files[0].name;
                fileInfo.classList.add('show');
                uploadBtn.disabled = false;
            }
        });
    </script>
</body>
</html>
