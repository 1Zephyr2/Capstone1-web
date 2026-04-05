<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Appointment - PAWser</title>
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap-icons/bootstrap-icons.min.css')); ?>">
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
            min-height: 100vh;
            padding: 20px;
            color: #0f172a;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            text-decoration: none;
            color: #111827;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .back-button:hover {
            background: #f0fdfa;
            border-color: #14b8a6;
            color: #14b8a6;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            padding: 24px;
            color: white;
        }

        .card-header h1 {
            font-size: 24px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-body {
            padding: 28px;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-weight: 600;
            color: #1f2937;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        label .icon {
            color: #14b8a6;
            font-size: 16px;
        }

        .required {
            color: #dc2626;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        select,
        textarea {
            padding: 12px 14px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s;
            background-color: white;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #93c5fd;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .error-list {
            list-style: none;
            padding: 0;
        }

        .error-list li {
            padding: 4px 0;
        }

        .button-group {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        button,
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-cancel {
            background: #e5e7eb;
            color: #6b7280;
            border: 1px solid #d1d5db;
        }

        .btn-cancel:hover {
            background: #d1d5db;
            color: #4b5563;
        }

        .btn-primary {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(20, 184, 166, 0.4);
        }

        .info-box {
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
            color: #166534;
        }

        .info-box i {
            color: #16a34a;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?php echo e(route('customer.dashboard')); ?>" class="back-button">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>

        <div class="card">
            <div class="card-header">
                <h1>Request Appointment</h1>
            </div>

            <div class="card-body">
                <div class="info-box">
                    <i class="bi bi-info-circle"></i>
                    <strong>How it works:</strong> Submit your appointment request below and our staff will review and confirm your appointment within 24 hours.
                </div>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle"></i>
                        <div>
                            <strong>Please fix the following errors:</strong>
                            <ul class="error-list">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('appointment-requests.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <!-- Pet Selection -->
                    <div class="form-group">
                        <label>
                            <span class="icon"><i class="bi bi-paw-fill"></i></span>
                            Pet <span class="required">*</span>
                        </label>
                        <select name="patient_id" required>
                            <option value="">-- Select a pet --</option>
                            <?php $__currentLoopData = $pets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pet->id); ?>" <?php echo e(old('patient_id') == $pet->id ? 'selected' : ''); ?>>
                                    <?php echo e($pet->pet_name); ?> (<?php echo e($pet->species); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Date and Time -->
                    <div class="form-row">
                        <div class="form-group">
                            <label>
                                <span class="icon"><i class="bi bi-calendar3"></i></span>
                                Preferred Date <span class="required">*</span>
                            </label>
                            <input type="date" name="requested_date" required min="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e(old('requested_date', date('Y-m-d'))); ?>">
                        </div>

                        <div class="form-group">
                            <label>
                                <span class="icon"><i class="bi bi-clock"></i></span>
                                Preferred Time <span class="required">*</span>
                            </label>
                            <input type="time" name="requested_time" required value="<?php echo e(old('requested_time', '09:00')); ?>">
                        </div>
                    </div>

                    <!-- Service Type -->
                    <div class="form-group">
                        <label>
                            <span class="icon"><i class="bi bi-briefcase-fill"></i></span>
                            Service Type
                        </label>
                        <select name="service_type">
                            <option value="">-- Select service type (optional) --</option>
                            <optgroup label="Grooming Services">
                                <option value="Bath & Dry" <?php echo e(old('service_type') == 'Bath & Dry' ? 'selected' : ''); ?>>Bath & Dry</option>
                                <option value="Full Grooming" <?php echo e(old('service_type') == 'Full Grooming' ? 'selected' : ''); ?>>Full Grooming</option>
                                <option value="Haircut & Styling" <?php echo e(old('service_type') == 'Haircut & Styling' ? 'selected' : ''); ?>>Haircut & Styling</option>
                                <option value="Nail Trimming" <?php echo e(old('service_type') == 'Nail Trimming' ? 'selected' : ''); ?>>Nail Trimming</option>
                                <option value="Ear Cleaning" <?php echo e(old('service_type') == 'Ear Cleaning' ? 'selected' : ''); ?>>Ear Cleaning</option>
                                <option value="Teeth Brushing" <?php echo e(old('service_type') == 'Teeth Brushing' ? 'selected' : ''); ?>>Teeth Brushing</option>
                                <option value="De-shedding Treatment" <?php echo e(old('service_type') == 'De-shedding Treatment' ? 'selected' : ''); ?>>De-shedding Treatment</option>
                                <option value="Flea & Tick Treatment" <?php echo e(old('service_type') == 'Flea & Tick Treatment' ? 'selected' : ''); ?>>Flea & Tick Treatment</option>
                                <option value="Paw Treatment" <?php echo e(old('service_type') == 'Paw Treatment' ? 'selected' : ''); ?>>Paw Treatment</option>
                            </optgroup>
                            <optgroup label="Other Services">
                                <option value="Boarding Checkup" <?php echo e(old('service_type') == 'Boarding Checkup' ? 'selected' : ''); ?>>Boarding Checkup</option>
                                <option value="Follow-up" <?php echo e(old('service_type') == 'Follow-up' ? 'selected' : ''); ?>>Follow-up</option>
                                <option value="Other" <?php echo e(old('service_type') == 'Other' ? 'selected' : ''); ?>>Other</option>
                            </optgroup>
                        </select>
                    </div>

                    <!-- Notes -->
                    <div class="form-group">
                        <label>
                            <span class="icon"><i class="bi bi-chat-left-text-fill"></i></span>
                            Notes/Preferred Details
                        </label>
                        <textarea name="preferred_notes" placeholder="Please tell us any additional details about your appointment request..."><?php echo e(old('preferred_notes')); ?></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="button-group">
                        <a href="<?php echo e(route('customer.dashboard')); ?>" class="btn btn-cancel">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\keeia\OneDrive\Documents\Capstone1-web-mayerror\capstone\resources\views/appointment-requests/create.blade.php ENDPATH**/ ?>