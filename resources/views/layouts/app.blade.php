<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nyarugenge Prison - E-Visit System')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
        }

        /* ── Sidebar ── */
        .sidebar {
            min-height: 100vh;
            width: 255px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            background: linear-gradient(180deg, #0d1b4b 0%, #1a3a7c 100%);
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.2);
            transition: width 0.3s;
        }

        .sidebar-brand {
            padding: 18px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand .brand-title {
            color: #fff;
            font-weight: 700;
            font-size: 15px;
            line-height: 1.2;
        }

        .sidebar-brand .brand-sub {
            color: rgba(255, 255, 255, 0.55);
            font-size: 11px;
        }

        .sidebar-section-title {
            color: rgba(255, 255, 255, 0.4);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 14px 20px 4px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 9px 16px;
            border-radius: 8px;
            margin: 2px 10px;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }

        .sidebar .nav-link i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
            font-weight: 600;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 14px 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-footer .user-name {
            color: #fff;
            font-size: 13px;
            font-weight: 600;
        }

        .sidebar-footer .user-role {
            color: rgba(255, 255, 255, 0.5);
            font-size: 11px;
            text-transform: capitalize;
        }

        .avatar-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
            flex-shrink: 0;
        }

        /* ── Topbar ── */
        .topbar {
            position: fixed;
            top: 0;
            left: 255px;
            right: 0;
            height: 58px;
            background: #fff;
            border-bottom: 1px solid #e3e6f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 999;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.05);
        }

        .topbar .page-title {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
        }

        /* ── Main Content ── */
        .main-wrapper {
            margin-left: 255px;
            padding-top: 58px;
            min-height: 100vh;
        }

        .main-content {
            padding: 24px;
        }

        /* ── Cards ── */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
            font-weight: 600;
            border-radius: 12px 12px 0 0 !important;
            padding: 14px 20px;
        }

        .stat-card {
            border-radius: 14px;
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        /* ── Status Badges ── */
        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-rejected {
            background: #f8d7da;
            color: #842029;
        }

        .status-completed {
            background: #cff4fc;
            color: #055160;
        }

        .status-cancelled {
            background: #e2e3e5;
            color: #41464b;
        }

        /* ── Role color accents ── */
        .role-admin .sidebar {
            background: linear-gradient(180deg, #0d1b4b 0%, #1a3a7c 100%);
        }

        .role-guard .sidebar {
            background: linear-gradient(180deg, #1b3a1e 0%, #2e7d32 100%);
        }

        .role-visitor .sidebar {
            background: linear-gradient(180deg, #3e1a6b 0%, #6a1b9a 100%);
        }

        /* ── Table ── */
        .table th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #8a94a6;
            border-bottom: 2px solid #f0f0f0;
            font-weight: 600;
        }

        .table td {
            vertical-align: middle;
            font-size: 14px;
        }

        /* ── Alerts ── */
        .alert {
            border: none;
            border-radius: 10px;
            font-size: 14px;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .topbar {
                left: 0;
            }

            .main-wrapper {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>

@php $role = auth()->user()->role ?? 'visitor'; @endphp

<body class="role-{{ $role === 'super_admin' ? 'admin' : $role }}">

    <!-- ══════════════ SIDEBAR ══════════════ -->
    <div class="sidebar">

        <!-- Brand -->
        <div class="sidebar-brand d-flex align-items-center gap-2">
            <i class="bi bi-shield-lock-fill text-white fs-4"></i>
            <div>
                <div class="brand-title">Nyarugenge Prison</div>
                <div class="brand-sub">E-Visit System</div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-2 flex-grow-1">

            {{-- ── ADMIN / SUPER ADMIN ── --}}
            @if(in_array($role, ['admin', 'super_admin']))

            <div class="sidebar-section-title">Main</div>

            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <div class="sidebar-section-title">Management</div>

            <a href="{{ route('admin.users.index') }}"
                class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> User Management
            </a>

            <a href="{{ route('admin.inmates.index') }}"
                class="nav-link {{ request()->routeIs('admin.inmates*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i> Inmates
            </a>

            <a href="{{ route('admin.visitors.index') }}"
                class="nav-link {{ request()->routeIs('admin.visitors*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Visitors
            </a>

            <a href="{{ route('admin.visits.index') }}"
                class="nav-link {{ request()->routeIs('admin.visits*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check"></i> Visit Requests
            </a>

            <div class="sidebar-section-title">Analytics</div>

            <a href="{{ route('admin.reports.index') }}"
                class="nav-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i> Reports
            </a>

            {{-- ── GUARD ── --}}
            @elseif($role === 'guard')

            <div class="sidebar-section-title">Main</div>

            <a href="{{ route('guard.dashboard') }}"
                class="nav-link {{ request()->routeIs('guard.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house"></i> Dashboard
            </a>

            <div class="sidebar-section-title">Operations</div>

            <a href="{{ route('guard.schedules.index') }}"
                class="nav-link {{ request()->routeIs('guard.schedules*') ? 'active' : '' }}">
                <i class="bi bi-calendar-week"></i> Today's Visits
            </a>

            {{-- ── VISITOR ── --}}
            @else

            <div class="sidebar-section-title">Main</div>

            <a href="{{ route('visitor.dashboard') }}"
                class="nav-link {{ request()->routeIs('visitor.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
            <a href="{{ route('visitor.profile.show') }}"
                class="nav-link {{ request()->routeIs('visitor.profile*') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> My Profile
            </a>
            <div class="sidebar-section-title">Visits</div>

            <a href="{{ route('visitor.requests.create') }}"
                class="nav-link {{ request()->routeIs('visitor.requests.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i> New Request
            </a>

            <a href="{{ route('visitor.requests.index') }}"
                class="nav-link {{ request()->routeIs('visitor.requests.index') ? 'active' : '' }}">
                <i class="bi bi-list-ul"></i> My Requests
            </a>

            @endif

            <div class="sidebar-section-title">Account</div>
            <a href="{{ route('password.change') }}"
                class="nav-link {{ request()->routeIs('password.change') ? 'active' : '' }}">
                <i class="bi bi-key"></i> Change Password
            </a>

        </nav>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
            <div class="d-flex align-items-center gap-2">
                <div class="avatar-circle">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="overflow-hidden">
                    <div class="user-name text-truncate">{{ auth()->user()->name }}</div>
                    <div class="user-role">{{ str_replace('_', ' ', auth()->user()->role) }}</div>
                </div>
                <a href="{{ route('logout') }}" class="ms-auto text-white opacity-50"
                    title="Logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right fs-5"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- ══════════════ TOPBAR ══════════════ -->
    <div class="topbar">
        <div class="page-title">@yield('page-title', 'Dashboard')</div>
        <div class="d-flex align-items-center gap-3">
            <small class="text-muted d-none d-md-block">
                <i class="bi bi-calendar3 me-1"></i>{{ now()->format('D, d M Y') }}
            </small>
            <span class="badge rounded-pill px-3 py-2
            @if(in_array($role, ['admin','super_admin'])) bg-primary
            @elseif($role === 'guard') bg-success
            @else bg-purple @endif"
                style="{{ $role === 'visitor' ? 'background:#6a1b9a!important' : '' }}">
                {{ ucfirst(str_replace('_', ' ', $role)) }}
            </span>
        </div>
    </div>

    <!-- ══════════════ MAIN CONTENT ══════════════ -->
    <div class="main-wrapper">
        <div class="main-content">

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>