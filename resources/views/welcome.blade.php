<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nyarugenge Prison — E-Visit System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f4f8;
            color: #1a202c;
        }

        /* ── NAVBAR ── */
        .navbar {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            padding: 14px 0;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0,0,0,0.06);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #1a3a7c, #2563eb);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            flex-shrink: 0;
        }

        .brand-text .title {
            font-weight: 700;
            font-size: 15px;
            color: #1a202c;
            line-height: 1.2;
        }

        .brand-text .subtitle {
            font-size: 11px;
            color: #718096;
        }

        .nav-links a {
            color: #4a5568;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .nav-links a:hover {
            color: #2563eb;
            background: #eff6ff;
        }

        .btn-login {
            background: #f1f5f9;
            color: #1a202c;
            border: none;
            padding: 9px 20px;
            border-radius: 9px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: #e2e8f0;
            color: #1a202c;
        }

        .btn-register {
            background: linear-gradient(135deg, #1a3a7c, #2563eb);
            color: white;
            border: none;
            padding: 9px 20px;
            border-radius: 9px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(37,99,235,0.3);
        }

        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37,99,235,0.4);
            color: white;
        }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d1b4b 0%, #1a3a7c 50%, #1e4d9b 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 70px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(37,99,235,0.3) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.9);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 24px;
            backdrop-filter: blur(10px);
        }

        .hero-badge i {
            color: #60a5fa;
        }

        .hero h1 {
            font-size: clamp(2.2rem, 4vw, 3.5rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 20px;
        }

        .hero h1 span {
            background: linear-gradient(135deg, #60a5fa, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 17px;
            color: rgba(255,255,255,0.7);
            line-height: 1.7;
            margin-bottom: 36px;
            max-width: 520px;
        }

        .hero-actions {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            background: #fff;
            color: #1a3a7c;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.3);
            color: #1a3a7c;
        }

        .btn-hero-secondary {
            background: rgba(255,255,255,0.1);
            color: #fff;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            border: 1px solid rgba(255,255,255,0.25);
            transition: all 0.3s;
            backdrop-filter: blur(10px);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-hero-secondary:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
            transform: translateY(-2px);
        }

        /* Hero Card */
        .hero-card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 32px;
            position: relative;
            z-index: 1;
        }

        .hero-card-title {
            color: rgba(255,255,255,0.9);
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .process-step {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 10px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            transition: all 0.2s;
        }

        .process-step:hover {
            background: rgba(255,255,255,0.1);
        }

        .step-number {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            flex-shrink: 0;
        }

        .step-content .step-title {
            color: rgba(255,255,255,0.9);
            font-weight: 600;
            font-size: 13px;
        }

        .step-content .step-desc {
            color: rgba(255,255,255,0.5);
            font-size: 12px;
            margin-top: 2px;
        }

        /* ── STATS ── */
        .stats-section {
            background: #fff;
            padding: 60px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .stat-item {
            text-align: center;
            padding: 24px;
        }

        .stat-item .number {
            font-size: 2.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1a3a7c, #2563eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-item .label {
            color: #718096;
            font-size: 14px;
            font-weight: 500;
        }

        .stat-divider {
            width: 1px;
            background: #e2e8f0;
            margin: auto;
        }

        /* ── FEATURES ── */
        .features-section {
            padding: 90px 0;
            background: #f8fafc;
        }

        .section-badge {
            display: inline-block;
            background: #eff6ff;
            color: #2563eb;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 14px;
        }

        .section-title {
            font-size: clamp(1.8rem, 3vw, 2.4rem);
            font-weight: 800;
            color: #1a202c;
            margin-bottom: 14px;
        }

        .section-subtitle {
            color: #718096;
            font-size: 16px;
            max-width: 550px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .feature-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            height: 100%;
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #1a3a7c, #2563eb);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border-color: #bfdbfe;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 18px;
        }

        .feature-card h5 {
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 10px;
            color: #1a202c;
        }

        .feature-card p {
            color: #718096;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        /* ── HOW IT WORKS ── */
        .how-section {
            padding: 90px 0;
            background: #fff;
        }

        .how-step {
            text-align: center;
            padding: 20px;
            position: relative;
        }

        .how-step-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1a3a7c, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            margin: 0 auto 20px;
            box-shadow: 0 8px 25px rgba(37,99,235,0.3);
            position: relative;
            z-index: 1;
        }

        .how-step-number {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 22px;
            height: 22px;
            background: #f59e0b;
            border-radius: 50%;
            font-size: 11px;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .how-step h5 {
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .how-step p {
            color: #718096;
            font-size: 14px;
            line-height: 1.6;
        }

        .how-connector {
            position: absolute;
            top: 55px;
            right: -50%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #bfdbfe, transparent);
        }

        /* ── ROLES ── */
        .roles-section {
            padding: 90px 0;
            background: linear-gradient(135deg, #0d1b4b 0%, #1a3a7c 100%);
        }

        .role-card {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 16px;
            padding: 28px;
            text-align: center;
            transition: all 0.3s;
            height: 100%;
        }

        .role-card:hover {
            background: rgba(255,255,255,0.12);
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .role-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin: 0 auto 18px;
        }

        .role-card h5 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .role-card p {
            color: rgba(255,255,255,0.6);
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 18px;
        }

        .role-features {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }

        .role-features li {
            color: rgba(255,255,255,0.7);
            font-size: 13px;
            padding: 5px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .role-features li i {
            color: #60a5fa;
            font-size: 12px;
        }

        /* ── CTA ── */
        .cta-section {
            padding: 90px 0;
            background: #f8fafc;
        }

        .cta-card {
            background: linear-gradient(135deg, #1a3a7c, #2563eb);
            border-radius: 24px;
            padding: 60px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-card::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.08), transparent 70%);
        }

        .cta-card h2 {
            color: #fff;
            font-weight: 800;
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            margin-bottom: 16px;
        }

        .cta-card p {
            color: rgba(255,255,255,0.75);
            font-size: 16px;
            margin-bottom: 32px;
        }

        /* ── FOOTER ── */
        footer {
            background: #0d1b4b;
            color: rgba(255,255,255,0.6);
            padding: 50px 0 30px;
        }

        .footer-brand .title {
            color: #fff;
            font-weight: 700;
            font-size: 16px;
        }

        .footer-brand p {
            font-size: 13px;
            margin-top: 8px;
            line-height: 1.6;
        }

        footer h6 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 16px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 13px;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: #60a5fa;
        }

        .footer-contact li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .footer-contact li i {
            color: #60a5fa;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08);
            margin-top: 40px;
            padding-top: 20px;
            font-size: 13px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .how-connector { display: none; }
            .hero { padding-top: 80px; }
            .hero-card { margin-top: 40px; }
        }
    </style>
</head>
<body>

<!-- ══════════════ NAVBAR ══════════════ -->
<nav class="navbar">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between w-100">

            <a href="{{ route('welcome') }}" class="navbar-brand">
                <div class="brand-icon">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <div class="brand-text">
                    <div class="title">Nyarugenge Prison</div>
                    <div class="subtitle">E-Visit Management System</div>
                </div>
            </a>

            <div class="d-flex align-items-center gap-2">
                <div class="nav-links d-none d-md-flex align-items-center gap-1">
                    <a href="#features">Features</a>
                    <a href="#how-it-works">How It Works</a>
                    <a href="#roles">Access</a>
                </div>
                <div class="d-flex align-items-center gap-2 ms-2">
                    <a href="{{ route('login') }}" class="btn-login">Sign In</a>
                    <a href="{{ route('register') }}" class="btn-register">
                        <i class="bi bi-person-plus me-1"></i> Register
                    </a>
                </div>
            </div>

        </div>
    </div>
</nav>

<!-- ══════════════ HERO ══════════════ -->
<section class="hero">
    <div class="container py-5">
        <div class="row align-items-center g-5">

            <div class="col-lg-6" style="position:relative;z-index:1">
                <div class="hero-badge">
                    <i class="bi bi-shield-check-fill"></i>
                    Official E-Visit Platform — Nyarugenge Prison
                </div>

                <h1>
                    Manage Prison Visits
                    <span>Digitally & Securely</span>
                </h1>

                <p>
                    Submit, track and manage inmate visiting requests online.
                    No more long queues, paperwork or unnecessary delays.
                    A safer, faster and more transparent process for everyone.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn-hero-primary">
                        <i class="bi bi-person-plus-fill"></i>
                        Register as Visitor
                    </a>
                    <a href="{{ route('login') }}" class="btn-hero-secondary">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Sign In
                    </a>
                </div>
            </div>

            <div class="col-lg-6" style="position:relative;z-index:1">
                <div class="hero-card">
                    <div class="hero-card-title">
                        <i class="bi bi-list-check text-info"></i>
                        How the Process Works
                    </div>

                    <div class="process-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <div class="step-title">Register & Complete Profile</div>
                            <div class="step-desc">Create your account and fill in your visitor profile</div>
                        </div>
                    </div>

                    <div class="process-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <div class="step-title">Submit Visit Request</div>
                            <div class="step-desc">Select the inmate, preferred date and time</div>
                        </div>
                    </div>

                    <div class="process-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <div class="step-title">Admin Reviews & Approves</div>
                            <div class="step-desc">Prison administration processes your request</div>
                        </div>
                    </div>

                    <div class="process-step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <div class="step-title">Attend Your Scheduled Visit</div>
                            <div class="step-desc">Check in with the guard on your scheduled date</div>
                        </div>
                    </div>

                    <div class="mt-4 p-3 rounded-3 d-flex align-items-center gap-3"
                         style="background:rgba(96,165,250,0.1);border:1px solid rgba(96,165,250,0.2)">
                        <i class="bi bi-info-circle text-info fs-5"></i>
                        <p class="mb-0" style="color:rgba(255,255,255,0.7);font-size:13px">
                            All visits are subject to approval by prison administration.
                            Visitors must be registered and verified.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ══════════════ STATS ══════════════ -->
<section class="stats-section">
    <div class="container">
        <div class="row g-0">
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="number">{{ number_format($stats['total_inmates']) }}+</div>
                    <div class="label"><i class="bi bi-person-badge me-1"></i>Active Inmates</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="number">{{ number_format($stats['total_visitors']) }}+</div>
                    <div class="label"><i class="bi bi-people me-1"></i>Verified Visitors</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="number">{{ number_format($stats['total_requests']) }}+</div>
                    <div class="label"><i class="bi bi-calendar-check me-1"></i>Visit Requests</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="number">{{ number_format($stats['completed_visits']) }}+</div>
                    <div class="label"><i class="bi bi-flag-fill me-1"></i>Completed Visits</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════ FEATURES ══════════════ -->
<section class="features-section" id="features">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-badge">System Features</div>
            <h2 class="section-title">Everything You Need in One Place</h2>
            <p class="section-subtitle">
                A comprehensive digital platform designed to modernize and
                secure the inmate visitation process at Nyarugenge Prison.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#eff6ff">
                        <i class="bi bi-laptop" style="color:#2563eb"></i>
                    </div>
                    <h5>Online Request Submission</h5>
                    <p>Submit and track visit requests from anywhere, anytime. No need to physically visit the prison to apply.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#f0fdf4">
                        <i class="bi bi-check2-circle" style="color:#16a34a"></i>
                    </div>
                    <h5>Instant Approval Workflow</h5>
                    <p>Administrators can review, approve or reject visit requests with scheduling in one streamlined interface.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#faf5ff">
                        <i class="bi bi-database-lock" style="color:#7c3aed"></i>
                    </div>
                    <h5>Centralized & Secure Database</h5>
                    <p>All visitor, inmate and visit records stored securely with role-based access control and audit trails.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fff7ed">
                        <i class="bi bi-bell" style="color:#ea580c"></i>
                    </div>
                    <h5>Real-Time Notifications</h5>
                    <p>Visitors receive instant notifications when their request is approved, rejected or scheduled.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#f0fdfa">
                        <i class="bi bi-qr-code-scan" style="color:#0d9488"></i>
                    </div>
                    <h5>Guard Check-in System</h5>
                    <p>Prison guards can check visitors in and out digitally, maintaining accurate visit logs and notes.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fff1f2">
                        <i class="bi bi-bar-chart-line" style="color:#e11d48"></i>
                    </div>
                    <h5>Reports & Analytics</h5>
                    <p>Generate comprehensive reports on visiting schedules, visitor history, approval rates and more.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ══════════════ HOW IT WORKS ══════════════ -->
<section class="how-section" id="how-it-works">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-badge">Simple Process</div>
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">
                Four simple steps to schedule your inmate visit online.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">
                <div class="how-step">
                    <div class="how-step-icon">
                        <i class="bi bi-person-plus"></i>
                        <div class="how-step-number">1</div>
                    </div>
                    <h5>Create Account</h5>
                    <p>Register online with your name, email, national ID and phone number.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="how-step">
                    <div class="how-step-icon">
                        <i class="bi bi-person-vcard"></i>
                        <div class="how-step-number">2</div>
                    </div>
                    <h5>Complete Profile</h5>
                    <p>Fill in your visitor profile with personal details for verification by administration.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="how-step">
                    <div class="how-step-icon">
                        <i class="bi bi-calendar-plus"></i>
                        <div class="how-step-number">3</div>
                    </div>
                    <h5>Submit Request</h5>
                    <p>Choose the inmate you wish to visit, select your preferred date and time.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="how-step">
                    <div class="how-step-icon">
                        <i class="bi bi-door-open"></i>
                        <div class="how-step-number">4</div>
                    </div>
                    <h5>Visit the Inmate</h5>
                    <p>Arrive on your scheduled date, check in with the guard and proceed to your visit.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ══════════════ ROLES ══════════════ -->
<section class="roles-section" id="roles">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge" style="background:rgba(255,255,255,0.1);color:rgba(255,255,255,0.9)">
                System Access
            </span>
            <h2 class="section-title" style="color:#fff">Who Uses This System?</h2>
            <p class="section-subtitle" style="color:rgba(255,255,255,0.6)">
                The platform serves four distinct user roles, each with tailored access.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">
                <div class="role-card">
                    <div class="role-icon" style="background:rgba(96,165,250,0.15)">
                        <i class="bi bi-person-circle" style="color:#60a5fa;font-size:28px"></i>
                    </div>
                    <h5>Visitor</h5>
                    <p>Family members and friends of inmates who wish to schedule visits.</p>
                    <ul class="role-features">
                        <li><i class="bi bi-check-circle-fill"></i> Register & manage profile</li>
                        <li><i class="bi bi-check-circle-fill"></i> Submit visit requests</li>
                        <li><i class="bi bi-check-circle-fill"></i> Track request status</li>
                        <li><i class="bi bi-check-circle-fill"></i> Receive notifications</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="role-card">
                    <div class="role-icon" style="background:rgba(52,211,153,0.15)">
                        <i class="bi bi-shield-check" style="color:#34d399;font-size:28px"></i>
                    </div>
                    <h5>Guard</h5>
                    <p>Prison staff responsible for managing physical check-ins and check-outs.</p>
                    <ul class="role-features">
                        <li><i class="bi bi-check-circle-fill"></i> View daily schedule</li>
                        <li><i class="bi bi-check-circle-fill"></i> Check-in visitors</li>
                        <li><i class="bi bi-check-circle-fill"></i> Check-out visitors</li>
                        <li><i class="bi bi-check-circle-fill"></i> Mark no-shows</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="role-card">
                    <div class="role-icon" style="background:rgba(251,191,36,0.15)">
                        <i class="bi bi-person-gear" style="color:#fbbf24;font-size:28px"></i>
                    </div>
                    <h5>Admin</h5>
                    <p>Prison administrators who review and process all visit requests.</p>
                    <ul class="role-features">
                        <li><i class="bi bi-check-circle-fill"></i> Manage inmates</li>
                        <li><i class="bi bi-check-circle-fill"></i> Approve / reject requests</li>
                        <li><i class="bi bi-check-circle-fill"></i> Verify visitors</li>
                        <li><i class="bi bi-check-circle-fill"></i> Generate reports</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="role-card">
                    <div class="role-icon" style="background:rgba(248,113,113,0.15)">
                        <i class="bi bi-person-fill-gear" style="color:#f87171;font-size:28px"></i>
                    </div>
                    <h5>Super Admin</h5>
                    <p>System administrators with full control over users and system settings.</p>
                    <ul class="role-features">
                        <li><i class="bi bi-check-circle-fill"></i> Full system access</li>
                        <li><i class="bi bi-check-circle-fill"></i> Manage all users</li>
                        <li><i class="bi bi-check-circle-fill"></i> Reset passwords</li>
                        <li><i class="bi bi-check-circle-fill"></i> System oversight</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ══════════════ CTA ══════════════ -->
<section class="cta-section">
    <div class="container">
        <div class="cta-card">
            <h2>Ready to Schedule a Visit?</h2>
            <p>
                Create your free account today and submit your visit request
                in just a few minutes. No paperwork, no queues.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('register') }}" class="btn-hero-primary">
                    <i class="bi bi-person-plus-fill"></i> Create Free Account
                </a>
                <a href="{{ route('login') }}" class="btn-hero-secondary">
                    <i class="bi bi-box-arrow-in-right"></i> Already have an account?
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════ FOOTER ══════════════ -->
<footer>
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-4">
                <div class="footer-brand">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="brand-icon">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <div class="title">Nyarugenge Prison</div>
                    </div>
                    <p>
                        The official E-Visit Request Processing System for
                        Nyarugenge Prison, Kigali, Rwanda. Designed to improve
                        efficiency, security and transparency in inmate visitation.
                    </p>
                </div>
            </div>

            <div class="col-lg-2 col-md-4">
                <h6>Quick Links</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('welcome') }}">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#how-it-works">How It Works</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="{{ route('login') }}">Sign In</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4">
                <h6>For Visitors</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('register') }}">Create Account</a></li>
                    <li><a href="{{ route('login') }}">Submit Visit Request</a></li>
                    <li><a href="{{ route('login') }}">Track Your Request</a></li>
                    <li><a href="{{ route('login') }}">View Schedule</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4">
                <h6>Contact Information</h6>
                <ul class="footer-links footer-contact">
                    <li>
                        <i class="bi bi-geo-alt-fill"></i>
                        Nyarugenge District, Kigali, Rwanda
                    </li>
                    <li>
                        <i class="bi bi-telephone-fill"></i>
                        +250 788 000 000
                    </li>
                    <li>
                        <i class="bi bi-envelope-fill"></i>
                        info@nyarugengeprison.rw
                    </li>
                    <li>
                        <i class="bi bi-clock-fill"></i>
                        Mon–Fri: 8:00 AM – 5:00 PM
                    </li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                &copy; {{ date('Y') }} Nyarugenge Prison — E-Visit System. All rights reserved.
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge" style="background:rgba(255,255,255,0.1);font-size:12px">
                    <i class="bi bi-shield-check me-1"></i> Secure Platform
                </span>
                <span class="badge" style="background:rgba(255,255,255,0.1);font-size:12px">
                    <i class="bi bi-lock me-1"></i> Data Protected
                </span>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Navbar shadow on scroll
    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 20) {
            navbar.style.boxShadow = '0 4px 30px rgba(0,0,0,0.1)';
        } else {
            navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.06)';
        }
    });

    // Animate stats on scroll
    const animateNumber = (el, target) => {
        let current = 0;
        const step = Math.ceil(target / 60);
        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            el.textContent = current.toLocaleString() + '+';
        }, 25);
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const numbers = entry.target.querySelectorAll('.number');
                numbers.forEach(num => {
                    const value = parseInt(num.textContent.replace(/[^0-9]/g, ''));
                    animateNumber(num, value);
                });
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    const statsSection = document.querySelector('.stats-section');
    if (statsSection) observer.observe(statsSection);
</script>

</body>
</html>