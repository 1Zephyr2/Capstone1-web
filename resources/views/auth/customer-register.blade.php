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

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #969696 0%, #b0b0b0 100%);
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
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 8px;
            color: #f8fafc;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.25);
        }

        .back-link:hover {
            background: #334155;
            border-color: #475569;
            color: #5eead4;
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
            height: 4px;
            background: #374151;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
            box-shadow: inset 0 0 0 1px #4b5563;
        }

        .password-strength-bar {
            height: 100%;
            background: #ef4444;
            width: 0%;
            border-radius: 2px;
            transition: all 0.4s ease;
            box-shadow: 0 0 6px rgba(239, 68, 68, 0.5);
        }

        .password-strength-bar.medium {
            width: 65%;
            background: #f59e0b;
            box-shadow: 0 0 6px rgba(245, 158, 11, 0.5);
        }

        .password-strength-bar.good {
            width: 85%;
            background: #3b82f6;
            box-shadow: 0 0 6px rgba(59, 130, 246, 0.5);
        }

        .password-strength-bar.strong {
            width: 100%;
            background: #10b981;
            box-shadow: 0 0 6px rgba(16, 185, 129, 0.5);
        }

        .password-strength-text {
            font-size: 11px;
            font-weight: 600;
            margin-top: 4px;
            color: #9ca3af;
            transition: color 0.3s ease;
        }

        .password-strength-text.weak {
            color: #ef4444;
        }

        .password-strength-text.fair {
            color: #f59e0b;
        }

        .password-strength-text.good {
            color: #3b82f6;
        }

        .password-strength-text.strong {
            color: #10b981;
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

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .back-link {
            animation: fadeIn 0.4s ease-out;
        }

        .register-card {
            animation: fadeInUp 0.5s ease-out;
        }

        .register-left {
            animation: fadeIn 0.6s ease-out 0.1s both;
        }

        .register-right {
            animation: fadeIn 0.6s ease-out 0.2s both;
        }

        .register-header {
            animation: fadeInUp 0.5s ease-out 0.3s both;
        }

        .form-group {
            animation: fadeInUp 0.5s ease-out;
        }

        .form-section:nth-of-type(1) .form-group { animation-delay: 0.4s; }
        .form-section:nth-of-type(2) .form-group { animation-delay: 0.5s; }
        .form-section:nth-of-type(3) .form-group { animation-delay: 0.6s; }

        .btn-register {
            animation: fadeInUp 0.5s ease-out 0.7s both;
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
                    <a href="{{ route('home') }}" class="back-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Back to Home
                    </a>

                    <div class="register-header">
                        <h1>Create Account</h1>
                        <p>Join our pet care community</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error:</strong> {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('customer.register.store') }}" id="registerForm">
                        @csrf

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
                                            value="{{ old('name') }}" 
                                            placeholder="John Doe"
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
                                    <label for="phone">Phone Number</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-telephone"></i>
                                        <input 
                                            type="tel" 
                                            id="phone" 
                                            name="phone" 
                                            value="{{ old('phone') }}" 
                                            placeholder="09XX-XXX-XXXX"
                                            pattern="(09\d{9}|09\d{2}-\d{3}-\d{4})"
                                            maxlength="13"
                                            inputmode="numeric"
                                            required
                                        >
                                    </div>
                                    <small style="color: #6b7280; margin-top: 4px; display: block;">Format: 09XX-XXX-XXXX (11 digits)</small>
                                    @error('phone')
                                        <div class="error-message">
                                            <i class="bi bi-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
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
                                        value="{{ old('username') }}" 
                                        placeholder="Choose a username"
                                        required
                                    >
                                </div>
                                @error('username')
                                    <div class="error-message">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                <div class="password-strength-text">Weak</div>
                                @error('password')
                                    <div class="error-message">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
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
                        <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add focus animation to form inputs
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"], input[type="tel"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
                this.style.transition = 'transform 0.2s ease';
            });
            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });

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
                
                passwordStrengthBar.style.transition = 'all 0.3s ease';
                const strengthText = document.querySelector('.password-strength-text');
                
                if (password.length === 0) {
                    passwordStrengthBar.className = 'password-strength-bar';
                    passwordStrengthBar.style.width = '0%';
                    if (strengthText) {
                        strengthText.className = 'password-strength-text';
                        strengthText.textContent = '';
                    }
                } else if (strength <= 1) {
                    passwordStrengthBar.className = 'password-strength-bar';
                    passwordStrengthBar.style.width = '30%';
                    if (strengthText) {
                        strengthText.className = 'password-strength-text weak';
                        strengthText.textContent = 'Weak';
                    }
                } else if (strength <= 3) {
                    passwordStrengthBar.className = 'password-strength-bar medium';
                    passwordStrengthBar.style.width = '65%';
                    if (strengthText) {
                        strengthText.className = 'password-strength-text fair';
                        strengthText.textContent = 'Fair';
                    }
                } else if (strength === 4) {
                    passwordStrengthBar.className = 'password-strength-bar good';
                    passwordStrengthBar.style.width = '85%';
                    if (strengthText) {
                        strengthText.className = 'password-strength-text good';
                        strengthText.textContent = 'Good';
                    }
                } else {
                    passwordStrengthBar.className = 'password-strength-bar strong';
                    passwordStrengthBar.style.width = '100%';
                    if (strengthText) {
                        strengthText.className = 'password-strength-text strong';
                        strengthText.textContent = 'Strong';
                    }
                }
            });
        }

        // Button hover effect
        const registerBtn = document.querySelector('.btn-register');
        if (registerBtn) {
            registerBtn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
                this.style.transition = 'transform 0.2s ease';
            });
            registerBtn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        }

        // Philippines phone number formatting
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                // Remove all non-digits
                let digits = this.value.replace(/\D/g, '');
                
                // Limit to 11 digits maximum
                if (digits.length > 11) {
                    digits = digits.slice(0, 11);
                }
                
                // Format as we type: 09XX-XXX-XXXX
                let formatted = '';
                if (digits.length > 0) {
                    if (digits.length <= 2) {
                        formatted = digits; // "09"
                    } else if (digits.length <= 4) {
                        formatted = digits.slice(0, 2) + digits.slice(2); // "09XX"
                    } else if (digits.length <= 7) {
                        formatted = digits.slice(0, 2) + digits.slice(2, 4) + '-' + digits.slice(4); // "09XX-XXX"
                    } else {
                        formatted = digits.slice(0, 2) + digits.slice(2, 4) + '-' + digits.slice(4, 7) + '-' + digits.slice(7, 11); // "09XX-XXX-XXXX"
                    }
                }
                
                this.value = formatted;
                
                // Show/hide error in real-time
                const errorMsg = this.parentElement.nextElementSibling;
                if (digits.length === 11 && digits.startsWith('09')) {
                    this.style.borderColor = '#10b981'; // Green when valid
                    if (errorMsg && errorMsg.classList.contains('error-message')) {
                        errorMsg.style.display = 'none';
                    }
                } else if (digits.length > 0) {
                    this.style.borderColor = '#ef4444'; // Red when invalid
                }
            });
            
            // Validate on blur
            phoneInput.addEventListener('blur', function() {
                const digits = this.value.replace(/\D/g, '');
                if (this.value && (digits.length !== 11 || !digits.startsWith('09'))) {
                    this.style.borderColor = '#ef4444';
                } else if (digits.length === 11) {
                    this.style.borderColor = '#10b981';
                }
            });
        }

        // Simple page fade-in
        window.addEventListener('load', () => {
            document.body.style.opacity = '1';
        });
    </script>
</body>
</html>
