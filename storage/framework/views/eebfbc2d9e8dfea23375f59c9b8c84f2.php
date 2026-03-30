<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAWSER - Create Account</title>
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap-icons/bootstrap-icons.min.css')); ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #4ca699 0%, #556375 100%);
        }

        .register-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card {
            display: flex;
            max-width: 1000px;
            width: 100%;
            min-height: 550px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            background: white;
        }

        /* Left Side - Gradient Background */
        .register-left {
            flex: 0 0 50%;
            background: url('/images/bgreplace.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 36px;
            position: relative;
            overflow: hidden;
        }

        .register-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(13, 148, 136, 0.65), rgba(20, 184, 166, 0.55));
            backdrop-filter: blur(4px);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
        }

        .hero-content h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .hero-content p {
            font-size: 15px;
            opacity: 0.98;
            line-height: 1.6;
            max-width: 300px;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
        }

        /* Right Side - Form */
        .register-right {
            flex: 0 0 50%;
            background: #1f2937;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            padding: 32px 36px;
            overflow-y: auto;
            max-height: 100vh;
        }

        .register-container {
            width: 100%;
            max-width: 100%;
            padding-top: 12px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #14b8a6;
            border: 1px solid #14b8a6;
            background: transparent;
            padding: 7px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            margin-bottom: 14px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #0d9488;
            border-color: #0d9488;
            background: rgba(20, 184, 166, 0.1);
            gap: 10px;
        }

        .register-header {
            margin-bottom: 18px;
        }

        .register-header h1 {
            color: #f9fafb;
            font-size: 26px;
            margin-bottom: 0;
            font-weight: 700;
        }

        .register-header p {
            color: #9ca3af;
            font-size: 13px;
            margin-top: 4px;
        }

        .form-section {
            margin-bottom: 18px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-row .form-group {
            margin-bottom: 0;
        }

        label {
            display: block;
            color: #d1d5db;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 12px;
            color: #9ca3af;
            font-size: 14px;
            pointer-events: none;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            padding: 9px 12px 9px 38px;
            background: #374151;
            border: 1.5px solid #4b5563;
            border-radius: 8px;
            font-size: 13px;
            color: #f9fafb;
            transition: all 0.3s ease;
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="password"]::placeholder,
        input[type="tel"]::placeholder {
            color: #9ca3af;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="tel"]:focus {
            outline: none;
            border-color: #14b8a6;
            background: #4b5563;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        .input-wrapper i.valid {
            color: #10b981;
        }

        .error-message {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #fca5a5;
            font-size: 12px;
            margin-top: 3px;
            font-weight: 500;
        }

        .password-strength {
            height: 3px;
            background: #4b5563;
            border-radius: 2px;
            margin-top: 5px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            background: #ef4444;
            width: 30%;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .password-strength-bar.medium {
            width: 65%;
            background: #f59e0b;
        }

        .password-strength-bar.strong {
            width: 100%;
            background: #10b981;
        }

        .form-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 14px 0;
            color: #4b5563;
        }

        .form-divider::before,
        .form-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #4b5563;
        }

        .form-divider span {
            font-size: 12px;
            font-weight: 600;
            color: #9ca3af;
        }

        .btn-register {
            width: 100%;
            padding: 11px;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
            margin-top: 12px;
        }

        .btn-register:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 184, 166, 0.4);
        }

        .btn-register:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-register:disabled {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
            cursor: not-allowed;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            opacity: 0.6;
        }

        .btn-register i {
            font-size: 16px;
        }

        .login-section {
            text-align: center;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #4b5563;
        }

        .login-section p {
            color: #9ca3af;
            font-size: 12px;
        }

        .login-section a {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-section a:hover {
            color: #0d9488;
            text-decoration: underline;
        }

        .alert {
            padding: 9px 11px;
            border-radius: 8px;
            margin-bottom: 14px;
            font-size: 12px;
        }

        .alert-danger {
            background-color: #7f1d1d;
            color: #fecaca;
            border: 1px solid #991b1b;
        }

        .alert-success {
            background-color: #064e3b;
            color: #a7f3d0;
            border: 1px solid #047857;
        }

        @media (max-width: 768px) {
            .register-card {
                flex-direction: column;
                height: auto;
                max-width: 100%;
            }

            .register-left {
                flex: 0 0 200px;
                padding: 30px 20px;
            }

            .register-right {
                flex: 1;
                padding: 30px 20px;
                overflow-y: auto;
            }

            .hero-content h2 {
                font-size: 26px;
            }

            .hero-content p {
                font-size: 13px;
            }

            .register-header h1 {
                font-size: 22px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .register-wrapper {
                padding: 10px;
            }

            .register-left {
                padding: 25px 15px;
            }

            .register-right {
                padding: 25px 15px;
            }

            .register-container {
                padding: 0;
            }

            .register-header h1 {
                font-size: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="register-wrapper">
        <div class="register-card">
            <!-- Left Side - Gradient Background -->
            <div class="register-left">
                <div class="hero-content">
                    <h2>Welcome</h2>
                    <p>Create your account and start managing your pet's appointments and health records today.</p>
                </div>
            </div>

            <!-- Right Side - Registration Form -->
            <div class="register-right">
                <div class="register-container">
                    <a href="<?php echo e(route('login')); ?>" class="back-link">
                        <i class="bi bi-arrow-left"></i>
                        Back to Login
                    </a>

                    <div class="register-header">
                        <h1>Create Account</h1>
                        <p>Join our pet care community</p>
                    </div>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <strong>Error:</strong> <?php echo e($errors->first()); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('customer.register.store')); ?>" id="registerForm">
                        <?php echo csrf_field(); ?>

                        <div class="form-section">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-person"></i>
                                        <input 
                                            type="text" 
                                            id="name" 
                                            name="name" 
                                            value="<?php echo e(old('name')); ?>" 
                                            placeholder="John Doe"
                                            required
                                        >
                                    </div>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="error-message">
                                            <i class="bi bi-exclamation-circle"></i>
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-telephone"></i>
                                        <input 
                                            type="tel" 
                                            id="phone" 
                                            name="phone" 
                                            value="<?php echo e(old('phone')); ?>" 
                                            placeholder="(555) 123-4567"
                                            required
                                        >
                                    </div>
                                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="error-message">
                                            <i class="bi bi-exclamation-circle"></i>
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <div class="input-wrapper">
                                    <i class="bi bi-envelope"></i>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        value="<?php echo e(old('email')); ?>" 
                                        placeholder="your@email.com"
                                        required
                                    >
                                </div>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="error-message">
                                        <i class="bi bi-exclamation-circle"></i>
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <div class="input-wrapper">
                                    <i class="bi bi-person-check"></i>
                                    <input 
                                        type="text" 
                                        id="username" 
                                        name="username" 
                                        value="<?php echo e(old('username')); ?>" 
                                        placeholder="Choose a username"
                                        required
                                    >
                                </div>
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="error-message">
                                        <i class="bi bi-exclamation-circle"></i>
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-wrapper">
                                    <i class="bi bi-lock"></i>
                                    <input 
                                        type="password" 
                                        id="password" 
                                        name="password" 
                                        placeholder="Minimum 8 characters"
                                        required
                                    >
                                </div>
                                <div class="password-strength">
                                    <div class="password-strength-bar"></div>
                                </div>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="error-message">
                                        <i class="bi bi-exclamation-circle"></i>
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="input-wrapper">
                                    <i class="bi bi-lock-check"></i>
                                    <input 
                                        type="password" 
                                        id="password_confirmation" 
                                        name="password_confirmation" 
                                        placeholder="Re-enter password"
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-register">
                            <i class="bi bi-check-circle"></i>
                            Create Account
                        </button>
                    </form>

                    <div class="login-section">
                        <p>Already have an account? <a href="<?php echo e(route('login')); ?>">Sign in here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form validation and password strength indicator
        const form = document.getElementById('registerForm');
        const passwordInput = document.getElementById('password');
        const passwordStrengthBar = document.querySelector('.password-strength-bar');
        
        if (passwordInput && passwordStrengthBar) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                
                if (password.length >= 8) strength++;
                if (password.length >= 12) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[a-z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[!@#$%^&*]/.test(password)) strength++;
                
                switch(strength) {
                    case 0:
                    case 1:
                        passwordStrengthBar.className = 'password-strength-bar';
                        passwordStrengthBar.style.width = '30%';
                        break;
                    case 2:
                    case 3:
                        passwordStrengthBar.className = 'password-strength-bar medium';
                        passwordStrengthBar.style.width = '65%';
                        break;
                    default:
                        passwordStrengthBar.className = 'password-strength-bar strong';
                        passwordStrengthBar.style.width = '100%';
                }
            });
        }
    </script>
</body>
</html>
<?php /**PATH C:\Users\Lei\Capstone1-web\resources\views/auth/customer-register.blade.php ENDPATH**/ ?>