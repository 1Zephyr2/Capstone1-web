<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAWSER - Customer Login</title>
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

        .login-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            display: flex;
            max-width: 1000px;
            width: 100%;
            height: 500px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            background: white;
        }

        .login-left {
            flex: 0 0 50%;
            background: url('/images/bgreplace.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
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

        .login-left-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
        }

        .login-left-content h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .login-left-content p {
            font-size: 15px;
            opacity: 0.98;
            line-height: 1.6;
            max-width: 300px;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
        }

        .login-right {
            flex: 0 0 50%;
            background: #1f2937;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .login-container {
            width: 100%;
            max-width: 100%;
        }

        .login-header {
            margin-bottom: 28px;
        }

        .login-header h1 {
            color: #f9fafb;
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .login-header p {
            color: #9ca3af;
            font-size: 14px;
        }

        .login-header a {
            color: #14b8a6;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-header a:hover {
            color: #0d9488;
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            color: #d1d5db;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 12px 14px;
            background: #374151;
            border: 1.5px solid #4b5563;
            border-radius: 8px;
            font-size: 14px;
            color: #f9fafb;
            transition: all 0.3s ease;
        }

        input[type="text"]::placeholder,
        input[type="password"]::placeholder,
        input[type="email"]::placeholder {
            color: #9ca3af;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #14b8a6;
            background: #4b5563;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 20px 0 24px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: #14b8a6;
        }

        .checkbox-label {
            color: #d1d5db;
            font-size: 13px;
            cursor: pointer;
            user-select: none;
        }

        .forgot-link {
            color: #14b8a6;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #0d9488;
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            margin-top: 8px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(20, 184, 166, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
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

        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
            font-size: 12px;
        }

        .register-text {
            text-align: center;
            margin-top: 16px;
            color: #9ca3af;
            font-size: 13px;
        }

        .register-text a {
            color: #14b8a6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-text a:hover {
            color: #0d9488;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                height: auto;
                max-width: 100%;
            }

            .login-left {
                flex: 0 0 200px;
                padding: 30px 20px;
            }

            .login-right {
                flex: 1;
                padding: 30px 20px;
            }

            .login-left-content h2 {
                font-size: 26px;
            }

            .login-left-content p {
                font-size: 13px;
            }

            .login-header h1 {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .login-wrapper {
                padding: 10px;
            }

            .login-left {
                padding: 25px 15px;
            }

            .login-right {
                padding: 25px 15px;
            }

            .login-container {
                padding: 0;
            }

            .login-header h1 {
                font-size: 22px;
            }
        }

        .back-button {
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

        .back-button:hover {
            background: #334155;
            border-color: #475569;
            color: #5eead4;
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

        .back-button {
            animation: fadeIn 0.4s ease-out;
        }

        .login-card {
            animation: fadeInUp 0.5s ease-out;
        }

        .login-left {
            animation: fadeIn 0.6s ease-out 0.1s both;
        }

        .login-right {
            animation: fadeIn 0.6s ease-out 0.2s both;
        }

        .login-header {
            animation: fadeInUp 0.5s ease-out 0.3s both;
        }

        .form-group {
            animation: fadeInUp 0.5s ease-out;
        }

        .form-group:nth-of-type(1) { animation-delay: 0.4s; }
        .form-group:nth-of-type(2) { animation-delay: 0.5s; }
        .form-group:nth-of-type(3) { animation-delay: 0.6s; }

        .btn-login {
            animation: fadeInUp 0.5s ease-out 0.7s both;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus {
            transform: scale(1.02);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(20, 184, 166, 0.3);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <a href="<?php echo e(route('home')); ?>" class="back-button">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Back to Home
    </a>

    <div class="login-wrapper">
        <div class="login-card">
            <!-- Left Side - Gradient Background -->
            <div class="login-left">
                <div class="login-left-content">
                    <h2>Pet Owner</h2>
                    <p>Access your grooming appointments and pet care information anytime, anywhere.</p>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="login-right">
                <div class="login-container">
                    <div class="login-header">
                        <h1>Customer Login</h1>
                        <p>Don't have an account? <a href="<?php echo e(route('customer.register.show')); ?>">Create one here</a></p>
                    </div>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <strong>Error:</strong> <?php echo e($errors->first()); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('customer.login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-wrapper">
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="<?php echo e(old('email')); ?>" 
                                    required 
                                    autofocus
                                    placeholder="Enter your email"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-wrapper">
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    required
                                    placeholder="Enter your password"
                                >
                            </div>
                        </div>

                        <div class="checkbox-group">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember" class="checkbox-label">Remember Me</label>
                            </div>
                            <a href="<?php echo e(route('password.request')); ?>" class="forgot-link">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn-login">Login</button>
                    </form>

                    <div class="footer-text">
                        &copy; <?php echo e(date('Y')); ?> PAWSER. Pet Appointment and Workflow Service & Records System.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple page fade-in
        window.addEventListener('load', () => {
            document.body.style.opacity = '1';
        });

        // Add focus effect to inputs
        const inputs = document.querySelectorAll('input[type="text"], input[type="password"], input[type="email"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
                this.style.transition = 'transform 0.2s ease';
            });
            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Button hover effect
        const loginBtn = document.querySelector('.btn-login');
        if (loginBtn) {
            loginBtn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
                this.style.transition = 'transform 0.2s ease';
            });
            loginBtn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        }
    </script>
</body>
</html><?php /**PATH C:\Users\keeia\OneDrive\Documents\Capstone1-web-mayerror\capstone\resources\views/auth/customer-login.blade.php ENDPATH**/ ?>