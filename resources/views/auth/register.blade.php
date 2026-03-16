<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Nyarugenge Prison E-Visit System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f0f4f8;
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            width: 40%;
            background: linear-gradient(160deg, #0d1b4b 0%, #1a3a7c 60%, #1e4d9b 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.35) 0%, transparent 70%);
            pointer-events: none;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, transparent 70%);
            pointer-events: none;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 1;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
            backdrop-filter: blur(10px);
        }

        .brand-text .name {
            color: #fff;
            font-weight: 700;
            font-size: 15px;
            line-height: 1.2;
        }

        .brand-text .tagline {
            color: rgba(255, 255, 255, 0.5);
            font-size: 11px;
        }

        .left-content {
            position: relative;
            z-index: 1;
        }

        .left-content h2 {
            color: #fff;
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .left-content h2 span {
            background: linear-gradient(135deg, #60a5fa, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .left-content p {
            color: rgba(255, 255, 255, 0.65);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .step-list {
            list-style: none;
            padding: 0;
        }

        .step-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        .step-list li:last-child {
            border-bottom: none;
        }

        .step-num {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .step-info .step-title {
            color: rgba(255, 255, 255, 0.9);
            font-size: 13px;
            font-weight: 600;
        }

        .step-info .step-desc {
            color: rgba(255, 255, 255, 0.45);
            font-size: 12px;
            margin-top: 2px;
        }

        .left-footer {
            color: rgba(255, 255, 255, 0.3);
            font-size: 12px;
            position: relative;
            z-index: 1;
        }

        /* ── RIGHT PANEL ── */
        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 40px;
            background: #fff;
            overflow-y: auto;
        }

        .register-box {
            width: 100%;
            max-width: 480px;
        }

        .register-header {
            margin-bottom: 28px;
        }

        .register-header .welcome {
            font-size: 13px;
            font-weight: 600;
            color: #2563eb;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
        }

        .register-header h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .register-header p {
            color: #94a3b8;
            font-size: 14px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 14px;
            color: #1a202c;
            background: #f8fafc;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #2563eb;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
            background: #fff5f5;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 15px;
            pointer-events: none;
        }

        .input-wrapper .form-control {
            padding-left: 38px;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            cursor: pointer;
            font-size: 15px;
            border: none;
            background: none;
            padding: 0;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #2563eb;
        }

        .section-divider {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin: 20px 0 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .btn-register {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #1a3a7c, #2563eb);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 8px;
        }

        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            padding: 14px;
            background: #f8fafc;
            border-radius: 10px;
            font-size: 14px;
            color: #64748b;
            margin-top: 16px;
        }

        .login-link a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #94a3b8;
            font-size: 13px;
            text-decoration: none;
            margin-bottom: 24px;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #2563eb;
        }

        .terms-note {
            font-size: 12px;
            color: #94a3b8;
            text-align: center;
            margin-top: 14px;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .left-panel {
                display: none;
            }

            .right-panel {
                background: #f0f4f8;
            }
        }

        @media (max-width: 480px) {
            .right-panel {
                padding: 32px 20px;
            }
        }
    </style>
</head>

<body>

    <!-- ══════════ LEFT PANEL ══════════ -->
    <div class="left-panel d-none d-lg-flex flex-column">

        <div class="brand">
            <div class="brand-icon">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <div class="brand-text">
                <div class="name">Nyarugenge Prison</div>
                <div class="tagline">E-Visit Management System</div>
            </div>
        </div>

        <div class="left-content">
            <h2>
                Start Your <span>Visit</span><br>Journey Today
            </h2>
            <p>
                Create your free visitor account to submit and manage
                inmate visiting requests online — no paperwork, no queues.
            </p>

            <ul class="step-list">
                <li>
                    <div class="step-num">1</div>
                    <div class="step-info">
                        <div class="step-title">Create Your Account</div>
                        <div class="step-desc">Fill in your name, email and credentials</div>
                    </div>
                </li>
                <li>
                    <div class="step-num">2</div>
                    <div class="step-info">
                        <div class="step-title">Complete Visitor Profile</div>
                        <div class="step-desc">Add your personal details for verification</div>
                    </div>
                </li>
                <li>
                    <div class="step-num">3</div>
                    <div class="step-info">
                        <div class="step-title">Submit Visit Request</div>
                        <div class="step-desc">Choose inmate, date and time for your visit</div>
                    </div>
                </li>
                <li>
                    <div class="step-num">4</div>
                    <div class="step-info">
                        <div class="step-title">Get Approved & Visit</div>
                        <div class="step-desc">Receive notification and attend your visit</div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="left-footer">
            &copy; {{ date('Y') }} Nyarugenge Prison. All rights reserved.
        </div>

    </div>

    <!-- ══════════ RIGHT PANEL ══════════ -->
    <div class="right-panel">
        <div class="register-box">

            <a href="{{ route('welcome') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Back to Home
            </a>

            <div class="register-header">
                <div class="welcome">Get Started</div>
                <h1>Create Account</h1>
                <p>Register as a visitor to submit inmate visit requests</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Personal Info Section -->
                <div class="section-divider">Personal Information</div>

                <div class="row g-3 mb-3">

                    <!-- Name -->
                    <div class="col-12">
                        <label for="name" class="form-label">
                            Full Name <span class="text-danger">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-person input-icon"></i>
                            <input id="name"
                                type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="Enter your full name"
                                required
                                autocomplete="name"
                                autofocus>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- National ID -->
                    <div class="col-md-6">
                        <label for="national_id" class="form-label">
                            National ID <span class="text-danger">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-credit-card input-icon"></i>
                            <input id="national_id"
                                type="text"
                                name="national_id"
                                class="form-control @error('national_id') is-invalid @enderror"
                                value="{{ old('national_id') }}"
                                placeholder="16-digit ID number"
                                required>
                            @error('national_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label for="phone" class="form-label">
                            Phone Number <span class="text-danger">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-telephone input-icon"></i>
                            <input id="phone"
                                type="text"
                                name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}"
                                placeholder="+250 7XX XXX XXX"
                                required>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Account Info Section -->
                <div class="section-divider">Account Credentials</div>

                <div class="row g-3">

                    <!-- Email -->
                    <div class="col-12">
                        <label for="email" class="form-label">
                            Email Address <span class="text-danger">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope input-icon"></i>
                            <input id="email"
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                required
                                autocomplete="email">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="role" class="form-label">
                            Your Role <span class="text-danger">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope input-icon"></i>
                            <select name="role" class="form-control" id="role"required>
                                <option value="admin">Admin</option>
                                <option value="guard">Guard</option>
                                <option value="visitor">Visitor</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="col-md-6">
                        <label for="password" class="form-label">
                            Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock input-icon"></i>
                            <input id="password"
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Min 8 characters"
                                required
                                autocomplete="new-password">
                            <button type="button" class="toggle-password"
                                onclick="togglePass('password','icon1')">
                                <i class="bi bi-eye" id="icon1"></i>
                            </button>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-md-6">
                        <label for="password-confirm" class="form-label">
                            Confirm Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input id="password-confirm"
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Repeat password"
                                required
                                autocomplete="new-password">
                            <button type="button" class="toggle-password"
                                onclick="togglePass('password-confirm','icon2')">
                                <i class="bi bi-eye" id="icon2"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Submit -->
                <button type="submit" class="btn-register mt-3">
                    <i class="bi bi-person-plus-fill"></i>
                    Create My Account
                </button>

            </form>

            <div class="login-link">
                Already have an account?
                <a href="{{ route('login') }}">Sign in here</a>
            </div>

            <p class="terms-note">
                By registering, you agree that all information provided is accurate
                and truthful. False information may result in account suspension.
            </p>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePass(fieldId, iconId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
</body>

</html>