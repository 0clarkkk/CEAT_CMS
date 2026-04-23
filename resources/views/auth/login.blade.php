<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CEAT - Authentication</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
        }

        body {
            background: #f5f5f5;
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes slideOutLeft {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-100%);
            }
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(100%);
            }
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        body.page-exit {
            animation: fadeOut 0.4s ease-out forwards;
        }

        .auth-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: slideUp 0.6s ease-out;
            min-height: 100vh;
        }

        @keyframes pageIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes pageOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        .auth-box {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            animation: pageIn 0.6s ease-in;
            min-height: 600px;
            height: auto;
        }

        .auth-box.page-exit {
            animation: pageOut 0.4s ease-out forwards;
        }

        .form-column {
            width: 55%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px 50px;
            background: white;
            flex-shrink: 0;
            order: 1;
            transition: opacity 0.6s ease-in-out;
        }

        .form-column.swapping-out-right {
            opacity: 0;
        }

        .form-column.swapping-out-left {
            opacity: 0;
        }

        .form-column.swapping-in-left {
            opacity: 1;
        }

        .form-column.swapping-in-right {
            opacity: 1;
        }

        .form-column.order-left {
            order: -1;
        }

        .form-column.order-right {
            order: 1;
        }

        .form-column.visible-form {
            display: flex;
        }

        .form-column.hidden-form {
            display: none;
        }

        .brand-panel {
            background: linear-gradient(135deg, #a52a2a 0%, #8b0000 100%);
            position: relative;
            overflow: hidden;
            width: 45%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 50px;
            color: white;
            flex-shrink: 0;
            order: 0;
            transition: opacity 0.6s ease-in-out;
        }

        .brand-panel::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(139, 0, 0, 0.3);
            border-radius: 50%;
            top: -50px;
            right: -50px;
        }

        .brand-panel::after {
            content: '';
            position: absolute;
            width: 250px;
            height: 250px;
            background: rgba(165, 42, 42, 0.2);
            border-radius: 50%;
            bottom: -80px;
            left: -50px;
        }

        .brand-panel.swapping-out-right {
            opacity: 0;
        }

        .brand-panel.swapping-out-left {
            opacity: 0;
        }

        .brand-panel.swapping-in-left {
            opacity: 1;
        }

        .brand-panel.swapping-in-right {
            opacity: 1;
        }

        .brand-panel.order-left {
            order: -1;
        }

        .brand-panel.order-right {
            order: 1;
        }

        .brand-panel.visible-form {
            display: flex;
        }

        .brand-panel.hidden-form {
            display: none;
        }

        .brand-content {
            position: relative;
            z-index: 1;
        }

        .checkmark-icon {
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fbbf24;
            border: 2px solid #fbbf24;
            border-radius: 50%;
            color: #8b0000;
            font-size: 14px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .input-field {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .input-field:focus {
            outline: none;
            background: white;
            border-color: #8b0000;
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background: #8b0000;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary:hover:not(:disabled) {
            background: #6b0000;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 0, 0, 0.2);
        }

        .btn-primary:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-secondary {
            width: 100%;
            padding: 12px;
            background: white;
            color: #8b0000;
            border: 2px solid #8b0000;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #f9fafb;
        }

        .logo-badge {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: transparent;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #8b0000;
            font-size: 18px;
            flex-shrink: 0;
        }

        .logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .feature-item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .feature-item p {
            margin: 0;
            line-height: 1.5;
        }

        .feature-title {
            font-weight: 600;
            font-size: 15px;
        }

        .feature-description {
            font-size: 13px;
            opacity: 0.9;
        }

        .spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        .btn-primary.loading .spinner {
            display: block;
        }

        .btn-primary.loading .btn-text {
            opacity: 0.8;
        }

        .password-field-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-field-wrapper input {
            flex: 1;
            padding-right: 40px;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            color: #6b7280;
            transition: color 0.2s ease;
        }

        .password-toggle.visible {
            display: flex;
        }

        .password-toggle:hover {
            color: #8b0000;
        }

        .password-toggle svg {
            width: 20px;
            height: 20px;
        }

        @media (max-width: 768px) {
            .auth-container {
                padding: 15px;
            }
            
            .auth-box {
                flex-direction: column;
                min-height: auto;
            }

            .form-column {
                position: relative;
                width: 100%;
                left: auto;
                padding: 30px 20px;
            }

            .brand-panel {
                width: 100%;
                padding: 30px 20px;
                order: 1;
            }

            .form-column h2 {
                font-size: 24px !important;
            }

            .form-column.register-form {
                left: 0;
            }
        }


    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-box" id="authBox">
            <!-- LOGIN FORM -->
            <div class="form-column login-form visible-form" id="loginForm">
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <div class="mb-8">
                    <h2 style="font-size: 32px; font-weight: 700; color: #1f2937; margin: 0 0 8px 0;">Sign In</h2>
                    <p style="font-size: 14px; color: #6b7280; margin: 0;">Enter your credentials to access your account</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginFormElement">
                    @csrf

                    <div class="form-group">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Email Address</label>
                        <input type="email" name="email" class="input-field" value="{{ old('email') }}" placeholder="student@uphsd.edu.ph" required autofocus autocomplete="username" />
                        @error('email')<p style="color: #dc2626; font-size: 13px; margin-top: 5px;">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Password</label>
                        <div class="password-field-wrapper">
                            <input type="password" name="password" class="input-field" id="loginPassword" placeholder="Enter your password" required autocomplete="current-password" oninput="toggleLoginPasswordIcon()" />
                            <button type="button" class="password-toggle" id="loginToggleBtn" onclick="toggleLoginPassword(event)">
                                <svg id="loginPasswordIcon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7C7.523 19 3.732 16.057 2.458 12z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')<p style="color: #dc2626; font-size: 13px; margin-top: 5px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px; color: #374151;">
                            <input type="checkbox" name="remember" style="width: 18px; height: 18px; cursor: pointer;" />
                            Remember me
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size: 14px; color: #fb923c; text-decoration: none; font-weight: 500;">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-primary" id="loginSubmitBtn">
                        <span class="spinner"></span>
                        <span class="btn-text">Sign In</span>
                    </button>
                </form>

                <p style="text-align: center; font-size: 14px; color: #6b7280; margin-top: 30px;">
                    Don't have an account? 
                    <a href="{{ route('register') }}" style="color: #fb923c; text-decoration: none; font-weight: 600;">Sign up here</a>
                </p>
            </div>

            <!-- REGISTER FORM -->
            <div class="form-column register-form hidden-form" id="registerForm">
                <div class="mb-8">
                    <h2 style="font-size: 32px; font-weight: 700; color: #1f2937; margin: 0 0 8px 0;">Create Account</h2>
                    <p style="font-size: 14px; color: #6b7280; margin: 0;">Join thousands of engineering students shaping the future</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4" id="registerFormElement">
                    @csrf

                    <div class="form-group">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Full Name</label>
                        <input type="text" name="name" class="input-field" value="{{ old('name') }}" placeholder="Enter your full name" required autofocus autocomplete="name" />
                        @error('name')<p style="color: #dc2626; font-size: 13px; margin-top: 5px;">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Email Address</label>
                        <input type="email" name="email" class="input-field" value="{{ old('email') }}" placeholder="student@uphsd.edu.ph" required autocomplete="username" />
                        @error('email')<p style="color: #dc2626; font-size: 13px; margin-top: 5px;">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Password</label>
                        <input type="password" name="password" class="input-field" placeholder="••••••••" required autocomplete="new-password" />
                        @error('password')<p style="color: #dc2626; font-size: 13px; margin-top: 5px;">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="input-field" placeholder="••••••••" required autocomplete="new-password" />
                        @error('password_confirmation')<p style="color: #dc2626; font-size: 13px; margin-top: 5px;">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit" class="btn-primary" id="registerSubmitBtn">
                        <span class="spinner"></span>
                        <span class="btn-text">Create Account</span>
                    </button>
                </form>

                <p style="text-align: center; font-size: 14px; color: #6b7280; margin-top: 30px;">
                    Already have an account?
                    <a href="#" onclick="switchToLogin(event)" style="color: #fb923c; text-decoration: none; font-weight: 600;">Sign in here</a>
                </p>
            </div>

            <!-- LOGIN BRAND PANEL -->
            <div class="brand-panel login-panel" id="loginBrand">
                <div class="brand-content">
                    <div class="logo-badge">
                        <div class="logo-icon">
                            <img src="{{ asset('images/coe-logo.png') }}" alt="UPHSD Logo" />
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">UPHSD</div>
                            <div style="font-size: 12px; opacity: 0.9;">College of Engineering</div>
                        </div>
                    </div>

                    <h1 style="font-size: 42px; font-weight: 700; margin: 0 0 16px 0; line-height: 1.2;">Welcome Back</h1>
                    <p style="font-size: 16px; margin: 0 0 32px 0; opacity: 0.95; line-height: 1.6;">Continue your engineering journey with us</p>

                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div><p class="feature-title">Access your courses and materials</p></div>
                    </div>
                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div><p class="feature-title">Connect with faculty and peers</p></div>
                    </div>
                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div><p class="feature-title">Track your academic progress</p></div>
                    </div>
                </div>
            </div>

            <!-- REGISTER BRAND PANEL -->
            <div class="brand-panel register-panel hidden-form" id="registerBrand">
                <div class="brand-content">
                    <div class="logo-badge">
                        <div class="logo-icon">
                            <img src="{{ asset('images/coe-logo.png') }}" alt="UPHSD Logo" />
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">UPHSD</div>
                            <div style="font-size: 12px; opacity: 0.9;">College of Engineering</div>
                        </div>
                    </div>

                    <h1 style="font-size: 42px; font-weight: 700; margin: 0 0 16px 0; line-height: 1.2;">Start Your Journey</h1>
                    <p style="font-size: 16px; margin: 0 0 32px 0; opacity: 0.95; line-height: 1.6;">Join thousands of engineering students shaping the future</p>

                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div>
                            <p class="feature-title">Quality Education</p>
                            <p class="feature-description">Access world-class engineering curriculum and resources</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div>
                            <p class="feature-title">Expert Faculty</p>
                            <p class="feature-description">Learn from experienced professors and industry professionals</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div>
                            <p class="feature-title">Modern Facilities</p>
                            <p class="feature-description">State-of-the-art laboratories and learning spaces</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div>
                            <p class="feature-title">Career Support</p>
                            <p class="feature-description">Industry partnerships and job placement assistance</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentMode = 'login';

        function switchToRegister(e) {
            e.preventDefault();
            if (currentMode === 'register') return;

            const authBox = document.getElementById('authBox');
            const loginForm = document.getElementById('loginForm');
            const loginBrand = document.getElementById('loginBrand');
            const registerForm = document.getElementById('registerForm');
            const registerBrand = document.getElementById('registerBrand');

            // Fade out the entire auth box
            authBox.classList.add('page-exit');

            setTimeout(() => {
                // Apply order change to swap positions
                loginForm.classList.remove('order-left');
                loginBrand.classList.remove('order-right');
                registerForm.classList.add('order-left');
                registerBrand.classList.add('order-right');

                // Hide login, show register
                loginForm.classList.add('hidden-form');
                loginBrand.classList.add('hidden-form');
                registerForm.classList.remove('hidden-form');
                registerBrand.classList.remove('hidden-form');

                // Remove page-exit animation and trigger page-in
                authBox.classList.remove('page-exit');

                currentMode = 'register';
            }, 400);
        }

        function switchToLogin(e) {
            e.preventDefault();
            if (currentMode === 'login') return;

            const authBox = document.getElementById('authBox');
            const loginForm = document.getElementById('loginForm');
            const loginBrand = document.getElementById('loginBrand');
            const registerForm = document.getElementById('registerForm');
            const registerBrand = document.getElementById('registerBrand');

            // Fade out the entire auth box
            authBox.classList.add('page-exit');

            setTimeout(() => {
                // Remove order change to restore original positions
                loginForm.classList.remove('order-left');
                loginBrand.classList.remove('order-right');
                registerForm.classList.remove('order-left');
                registerBrand.classList.remove('order-right');

                // Show login, hide register
                registerForm.classList.add('hidden-form');
                registerBrand.classList.add('hidden-form');
                loginForm.classList.remove('hidden-form');
                loginBrand.classList.remove('hidden-form');

                // Remove page-exit animation and trigger page-in
                authBox.classList.remove('page-exit');

                currentMode = 'login';
            }, 400);
        }

        function toggleLoginPasswordIcon() {
            const passwordInput = document.getElementById('loginPassword');
            const toggleBtn = document.getElementById('loginToggleBtn');
            
            if (passwordInput.value.length > 0) {
                toggleBtn.classList.add('visible');
            } else {
                toggleBtn.classList.remove('visible');
                passwordInput.type = 'password';
            }
        }

        function toggleLoginPassword(e) {
            e.preventDefault();
            const passwordInput = document.getElementById('loginPassword');
            const icon = document.getElementById('loginPasswordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Change icon to closed eye
                icon.innerHTML = '<path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.12 9.12a3 3 0 015.656 3.656m-9.541-9.541C3.444 3.059 8.014 1 12 1c4.478 0 8.268 2.943 9.543 7a10.079 10.079 0 01-1.563 3.029m0 0a9.9 9.9 0 01-.387.746m0 0l-6.968-6.968"></path>';
            } else {
                passwordInput.type = 'password';
                // Change icon back to open eye
                icon.innerHTML = '<path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7C7.523 19 3.732 16.057 2.458 12z"></path>';
            }
        }

        function toggleRegisterPassword(e, fieldId) {
            e.preventDefault();
            const passwordInput = document.getElementById(fieldId);
            const icon = e.target.closest('.password-toggle').querySelector('svg');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Change icon to closed eye
                icon.innerHTML = '<path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.12 9.12a3 3 0 015.656 3.656m-9.541-9.541C3.444 3.059 8.014 1 12 1c4.478 0 8.268 2.943 9.543 7a10.079 10.079 0 01-1.563 3.029m0 0a9.9 9.9 0 01-.387.746m0 0l-6.968-6.968"></path>';
            } else {
                passwordInput.type = 'password';
                // Change icon back to open eye
                icon.innerHTML = '<path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7C7.523 19 3.732 16.057 2.458 12z"></path>';
            }
        }
            const loginFormElement = document.getElementById('loginFormElement');
            const registerFormElement = document.getElementById('registerFormElement');
            const loginSubmitBtn = document.getElementById('loginSubmitBtn');
            const registerSubmitBtn = document.getElementById('registerSubmitBtn');

            // Handle login form submission
            if (loginFormElement) {
                loginFormElement.addEventListener('submit', function(e) {
                    loginSubmitBtn.disabled = true;
                    loginSubmitBtn.classList.add('loading');
                    
                    setTimeout(() => {
                        document.body.classList.add('page-exit');
                    }, 300);
                });
            }

            // Handle register form submission
            if (registerFormElement) {
                registerFormElement.addEventListener('submit', function(e) {
                    registerSubmitBtn.disabled = true;
                    registerSubmitBtn.classList.add('loading');
                    
                    setTimeout(() => {
                        document.body.classList.add('page-exit');
                    }, 300);
                });
            }
        });
    </script>
</body>
</html>