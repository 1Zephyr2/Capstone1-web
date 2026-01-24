<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Patient - Health Center</title>
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
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 10px;
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
        h1 {
            color: #047857;
            margin: 0;
            font-size: 24px;
            flex: 1;
        }
        .subtitle {
            color: #6b7280;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .form-section {
            margin-bottom: 24px;
        }
        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }
        .form-row.full {
            grid-template-columns: 1fr;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }
        label .required {
            color: #dc2626;
        }
        input, select, textarea {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.2s;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #047857;
            box-shadow: 0 0 0 3px rgba(4,120,87,0.1);
        }
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        .hint {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }
        .actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        button {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
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
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .optional-section {
            background: #f9fafb;
            padding: 16px;
            border-radius: 6px;
            margin-top: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-top">
            <button onclick="goBack()" class="btn-back">← Back</button>
            <h1>Register New Patient</h1>
        </div>
        <p class="subtitle">Fill in essential patient information. Patient ID will be auto-generated.</p>

        @if($errors->any())
        <div class="alert alert-error">
            <strong>Please fix the following errors:</strong>
            <ul style="margin-top: 8px; margin-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('patients.store') }}" method="POST">
            @csrf

            <!-- Basic Information -->
            <div class="form-section">
                <div class="section-title">Basic Information</div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name <span class="required">*</span></label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name <span class="required">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name') }}">
                        <span class="hint">Optional</span>
                    </div>
                    <div class="form-group">
                        <label>Birthdate <span class="required">*</span></label>
                        <input type="date" name="birthdate" value="{{ old('birthdate') }}" required max="{{ date('Y-m-d') }}">
                        <span class="hint">Age will be auto-calculated</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Sex <span class="required">*</span></label>
                        <select name="sex" required>
                            <option value="">Select</option>
                            <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="tel" name="contact_number" value="{{ old('contact_number') }}" placeholder="09XX-XXX-XXXX">
                    </div>
                </div>

                <div class="form-row full">
                    <div class="form-group">
                        <label>Address <span class="required">*</span></label>
                        <textarea name="address" required>{{ old('address') }}</textarea>
                        <span class="hint">House No., Street, Barangay, City</span>
                    </div>
                </div>
            </div>

            <!-- Optional Information -->
            <div class="form-section">
                <div class="section-title">Additional Information (Optional)</div>
                <div class="optional-section">
                    <div class="form-row">
                        <div class="form-group">
                            <label>PhilHealth Number</label>
                            <input type="text" name="philhealth_number" value="{{ old('philhealth_number') }}">
                        </div>
                        <div class="form-group">
                            <label>Emergency Contact Name</label>
                            <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Emergency Contact Number</label>
                            <input type="tel" name="emergency_contact_number" value="{{ old('emergency_contact_number') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <button type="button" class="btn-secondary" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn-primary">Register Patient</button>
            </div>
        </form>
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
    </script>
</body>
</html>
