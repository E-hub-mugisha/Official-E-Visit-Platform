<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — Nyarugenge Prison E-Visit System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f0f4f8;
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            width: 45%;
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
            background: radial-gradient(circle, rgba(37,99,235,0.35) 0%, transparent 70%);
            pointer-events: none;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(99,102,241,0.25) 0%, transparent 70%);
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
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
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
            color: rgba(255,255,255,0.5);
            font-size: 11px;
        }

        .left-content {
            position: relative;
            z-index: 1;
        }

        .left-content h2 {
            color: #fff;
            font-size: 2.2rem;
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
            color: rgba(255,255,255,0.65);
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 32px;
        }

        .feature-list {
            list-style: none;
            padding: 0;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.75);
            font-size: 14px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-list li .icon {
            width: 32px;
            height: 32px;
            background: rgba(96,165,250,0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #60a5fa;
            font-size: 14px;
            flex-shrink: 0;
        }

        .left-footer {
            color: rgba(255,255,255,0.35);
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
            padding: 48px 40px;
            background: #fff;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        .login-header {
            margin-bottom: 36px;
        }

        .login-header .welcome {
            font-size: 13px;
            font-weight: 600;
            color: #2563eb;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
        }

        .login-header h1 {
            font-size: 1.9rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .login-header p {
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
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
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
            font-size: 16px;
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
            font-size: 16px;
            border: none;
            background: none;
            padding: 0;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #2563eb;
        }

        .btn-signin {
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
            box-shadow: 0 4px 15px rgba(37,99,235,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-signin:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(37,99,235,0.4);
        }

        .btn-signin:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 24px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            color: #94a3b8;
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
        }

        .register-link {
            text-align: center;
            padding: 14px;
            background: #f8fafc;
            border-radius: 10px;
            font-size: 14px;
            color: #64748b;
        }

        .register-link a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #94a3b8;
            font-size: 13px;
            text-decoration: none;
            margin-bottom: 28px;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #2563eb;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .form-check-label {
            font-size: 13px;
            color: #64748b;
        }

        .forgot-link {
            font-size: 13px;
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .left-panel { display: none; }
            .right-panel { background: #f0f4f8; }
        }

        @media (max-width: 480px) {
            .right-panel { padding: 32px 20px; }
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
            Welcome <span>Back</span><br>to the Portal
        </h2>
        <p>
            Sign in to manage your inmate visiting requests,
            track approvals and view your scheduled visits
            — all in one secure place.
        </p>

        <ul class="feature-list">
            <li>
                <div class="icon"><i class="bi bi-calendar-check"></i></div>
                Submit and track visit requests online
            </li>
            <li>
                <div class="icon"><i class="bi bi-bell"></i></div>
                Get notified on approval or rejection
            </li>
            <li>
                <div class="icon"><i class="bi bi-clock-history"></i></div>
                View your complete visit history
            </li>
            <li>
                <div class="icon"><i class="bi bi-shield-check"></i></div>
                Secure and confidential platform
            </li>
        </ul>
    </div>

    <div class="left-footer">
        &copy; {{ date('Y') }} Nyarugenge Prison. All rights reserved.
    </div>
</div>

<!-- ══════════ RIGHT PANEL ══════════ -->
<div class="right-panel">
    <div class="login-box">

        <a href="{{ route('welcome') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to Home
        </a>

        <div class="login-header">
            <div class="welcome">Welcome Back</div>
            <h1>Sign In</h1>
            <p>Enter your credentials to access your account</p>
        </div>

        @if(session('status'))
            <div class="alert alert-success d-flex gap-2 align-items-center mb-4"
                 style="border-radius:10px;border:none;background:#f0fdf4;color:#166534">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-wrapper">
                    <i class="bi bi-envelope input-icon"></i>
                    <input id="email"
                           type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           placeholder="you@example.com"
                           required
                           autocomplete="email"
                           autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock input-icon"></i>
                    <input id="password"
                           type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Enter your password"
                           required
                           autocomplete="current-password">
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Remember & Forgot -->
            <div class="remember-row">
                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="remember"
                           id="remember"
                           {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-signin">
                <i class="bi bi-box-arrow-in-right"></i>
                Sign In to Your Account
            </button>

        </form>

        <div class="divider">
            <span>Don't have an account?</span>
        </div>

        <div class="register-link">
            New to the system?
            <a href="{{ route('register') }}">Create a free account</a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('toggleIcon');
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