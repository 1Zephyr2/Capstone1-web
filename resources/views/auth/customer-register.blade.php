<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAWSER - Create Account</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ffffff;
            display: flex;
        }

        .register-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Left Side - Form */
        .register-left {
            flex: 0 0 55%;
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px;
            overflow-y: auto;
            position: relative;
        }

        .register-left::before {
            content: '';
            position: absolute;
            top: 0;
            right: -50%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(20, 184, 166, 0.03) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 1;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #111827;
            border: 1px solid #111827;
            background: white;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 32px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #14b8a6;
            border-color: #14b8a6;
            background: #f0fdfa;
            gap: 10px;
        }

        .register-header {
            margin-bottom: 40px;
        }

        .logo-wrapper {
            width: auto;
            height: 64px;
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }

        .logo-wrapper img {
            height: 100%;
            max-width: 200px;
            object-fit: contain;
        }

        .register-header h1 {
            font-size: 36px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .register-header p {
            font-size: 16px;
            color: #6b7280;
            line-height: 1.5;
        }

        .form-section {
            margin-bottom: 28px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row .form-group {
            margin-bottom: 0;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            color: #d1d5db;
            font-size: 16px;
            pointer-events: none;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            color: #111827;
            transition: all 0.3s ease;
            background: #f9fafb;
            font-weight: 500;
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="password"]::placeholder,
        input[type="tel"]::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="tel"]:focus {
            outline: none;
            border-color: #14b8a6;
            background: white;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.08);
        }

        .input-wrapper i.valid {
            color: #10b981;
        }

        .error-message {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
            font-weight: 500;
        }

        .password-strength {
            height: 3px;
            background: #e5e7eb;
            border-radius: 2px;
            margin-top: 8px;
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
            margin: 32px 0;
            color: #d1d5db;
        }

        .form-divider::before,
        .form-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .form-divider span {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .btn-register {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
            margin-top: 32px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .btn-register:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 184, 166, 0.4);
        }

        .btn-register:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-register:disabled {
            background: linear-gradient(135deg, #d1d5db 0%, #9ca3af 100%);
            cursor: not-allowed;
            box-shadow: 0 2px 8px rgba(107, 114, 128, 0.15);
            opacity: 0.6;
        }

        .btn-register i {
            font-size: 17px;
        }

        .login-section {
            text-align: center;
            margin-top: 28px;
            padding-top: 28px;
            border-top: 1px solid #e5e7eb;
        }

        .login-section p {
            color: #6b7280;
            font-size: 14px;
        }

        .login-section a {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-section a:hover {
            color: #0d9488;
        }

        /* Right Side - Hero */
        .register-right {
            flex: 1;
            background: url('/images/bgreplace.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
            position: relative;
            overflow: hidden;
        }

        .register-right::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(5, 150, 105, 0.75), rgba(6, 182, 212, 0.65));
            z-index: 0;
        }

        .register-right::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(52, 211, 153, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
            display: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
            max-width: 420px;
        }

        .hero-icon {
            font-size: 120px;
            margin-bottom: 32px;
            opacity: 0.9;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .hero-content h2 {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 16px;
            line-height: 1.2;
            letter-spacing: -0.5px;
        }

        .hero-content p {
            font-size: 18px;
            margin-bottom: 40px;
            opacity: 0.95;
            line-height: 1.6;
        }

        .benefits {
            display: flex;
            flex-direction: column;
            gap: 16px;
            text-align: left;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .benefit-item:hover {
            background: rgba(255, 255, 255, 0.12);
            transform: translateX(8px);
        }

        .benefit-icon {
            font-size: 20px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .benefit-text {
            font-size: 14px;
            font-weight: 500;
            line-height: 1.5;
        }

        @media (max-width: 1200px) {
            .register-left {
                flex: 0 0 60%;
            }

            .register-right {
                flex: 0 0 40%;
            }
        }

        @media (max-width: 968px) {
            .register-wrapper {
                flex-direction: column;
            }

            .register-left {
                flex: none;
                padding: 32px 24px;
                min-height: auto;
            }

            .register-right {
                flex: none;
                min-height: 400px;
                padding: 32px 24px;
            }

            .register-container {
                max-width: 100%;
            }

            .hero-content h2 {
                font-size: 32px;
            }

            .hero-icon {
                font-size: 80px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .register-left {
                padding: 24px 16px;
            }

            .register-container {
                max-width: 100%;
            }

            .register-header h1 {
                font-size: 28px;
            }

            .register-header p {
                font-size: 14px;
            }

            .hero-content h2 {
                font-size: 28px;
                margin-bottom: 12px;
            }

            .hero-content p {
                font-size: 16px;
                margin-bottom: 24px;
            }

            .benefits {
                gap: 12px;
            }

            .benefit-item {
                padding: 12px;
            }

            .benefit-text {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="register-wrapper">
        <!-- Left Side - Form -->
        <div class="register-left">
            <div class="register-container">
                <a href="{{ route('login') }}" class="back-link">
                    <i class="bi bi-arrow-left"></i>
                    Back to Login
                </a>

                <div class="register-header">
                    <div class="logo-wrapper">
                        <img src="{{ asset('newlogo.png') }}" alt="PAWSER Logo">
                    </div>
                    <h1>Join PAWSER</h1>
                    <p>Create your account and start managing your pet's health today</p>
                </div>

                <form method="POST" action="{{ route('customer.register.store') }}" id="registerForm">
                    @csrf

                    <div class="form-section">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <div class="input-wrapper">
                                <i class="bi bi-person"></i>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    placeholder="Enter your full name"
                                    required
                                >
                            </div>
                            @error('name')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-wrapper">
                                <i class="bi bi-envelope"></i>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    placeholder="your@email.com"
                                    required
                                >
                            </div>
                            @error('email')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <div class="input-wrapper">
                                    <i class="bi bi-telephone"></i>
                                    <input 
                                        type="tel" 
                                        id="phone" 
                                        name="phone" 
                                        value="{{ old('phone') }}" 
                                        placeholder="(555) 123-4567"
                                        minlength="10"
                                        pattern="[0-9\-\(\)\+\s]+"
                                        required
                                    >
                                </div>
                                @error('phone')
                                    <div class="error-message">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-wrapper">
                                    <i class="bi bi-lock"></i>
                                    <input 
                                        type="password" 
                                        id="password" 
                                        name="password" 
                                        placeholder="••••••••"
                                        minlength="8"
                                        required
                                    >
                                </div>
                                @error('password')
                                    <div class="error-message">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="input-wrapper">
                                <i class="bi bi-shield-check"></i>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    placeholder="••••••••"                                    minlength="8"                                    required
                                >
                            </div>
                            @error('password_confirmation')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn-register">
                        <i class="bi bi-check-lg"></i>
                        Create Account
                    </button>
                </form>

                <div class="login-section">
                    <p>Already have an account? <a href="{{ route('login') }}">Sign in instead</a></p>
                </div>
            </div>
        </div>

        <!-- Right Side - Hero -->
        <div class="register-right">
            <div class="hero-content">
                <div class="hero-icon">
                    <i class="bi bi-paw-fill"></i>
                </div>
                <h2>Your Pet's Health Companion</h2>
                <p>All your pet's medical information in one secure place</p>

                <div class="benefits">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="benefit-text">Manage appointments and reminders</div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="bi bi-file-medical"></i>
                        </div>
                        <div class="benefit-text">View complete medical history</div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                        <div class="benefit-text">Secure and private access</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form validation and real-time feedback
        const form = document.getElementById('registerForm');
        const submitBtn = document.querySelector('.btn-register');
        
        if (form) {
            const inputs = form.querySelectorAll('input[required]');
            
            // Function to validate form
            function validateForm() {
                let isValid = true;
                
                inputs.forEach(input => {
                    // Check HTML5 validity
                    if (!input.checkValidity()) {
                        isValid = false;
                        input.parentElement.style.borderColor = '#ef4444'; // Red border for invalid
                    } else {
                        input.parentElement.style.borderColor = '#14b8a6'; // Teal border for valid
                    }
                    
                    // Check if field is empty
                    if (input.value.trim() === '') {
                        isValid = false;
                        input.parentElement.style.borderColor = '#d1d5db'; // Grey for empty
                    }
                });
                
                // Update button state
                if (submitBtn) {
                    submitBtn.disabled = !isValid;
                }
                
                return isValid;
            }
            
            // Add event listeners for real-time validation
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    validateForm();
                });
                
                input.addEventListener('change', function() {
                    validateForm();
                });
                
                input.addEventListener('focus', function() {
                    if (this.value.trim() !== '') {
                        this.parentElement.style.borderColor = '#14b8a6';
                    }
                });
                
                input.addEventListener('blur', function() {
                    validateForm();
                });
            });
            
            // Prevent form submission if invalid
            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    return false;
                }
            });
            
            // Initial validation check
            validateForm();
        }
    </script>
</body>
</html>
