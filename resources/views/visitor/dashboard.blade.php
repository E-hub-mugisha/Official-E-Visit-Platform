@extends('layouts.app')

@section('title', 'Visitor Dashboard')
@section('page-title', 'My Dashboard')

@section('content')

<!-- Welcome Banner -->
<div class="card mb-4" style="background:linear-gradient(135deg,#4a148c,#7b1fa2);border:none">
    <div class="card-body p-4 text-white">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-1">Welcome, {{ auth()->user()->name }} 👋</h4>
                <p class="mb-0 opacity-75">Manage your inmate visit requests from your dashboard.</p>
                @if(!$visitor)
                    <a href="{{ route('visitor.requests.create') }}"
                       class="btn btn-light btn-sm mt-3">
                        <i class="bi bi-person-plus me-1"></i> Complete Your Profile
                    </a>
                @endif
            </div>
            <i class="bi bi-person-circle opacity-25" style="font-size:5rem"></i>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="card text-center h-100">
            <div class="card-body py-4">
                <div class="fs-2 fw-bold text-primary">{{ $stats['total_requests'] }}</div>
                <div class="text-muted small mt-1">Total Requests</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card text-center h-100">
            <div class="card-body py-4">
                <div class="fs-2 fw-bold text-warning">{{ $stats['pending_requests'] }}</div>
                <div class="text-muted small mt-1">Pending</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card text-center h-100">
            <div class="card-body py-4">
                <div class="fs-2 fw-bold text-success">{{ $stats['approved_requests'] }}</div>
                <div class="text-muted small mt-1">Approved</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card text-center h-100">
            <div class="card-body py-4">
                <div class="fs-2 fw-bold text-info">{{ $stats['completed_visits'] }}</div>
                <div class="text-muted small mt-1">Completed</div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Requests + Notifications -->
<div class="row g-3">

    <div class="col-xl-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-clock-history me-2 text-primary"></i>Recent Requests</span>
                <a href="{{ route('visitor.requests.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> New Request
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Request #</th>
                                <th>Inmate</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRequests as $req)
                            <tr>
                                <td class="fw-semibold">{{ $req->request_number }}</td>
                                <td>{{ $req->inmate?->full_name }}</td>
                                <td>{{ $req->preferred_date->format('d M Y') }}</td>
                                <td>
                                    <span class="status-badge status-{{ $req->status }}">
                                        {{ ucfirst($req->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('visitor.requests.show', $req) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                    No requests yet.
                                    <a href="{{ route('visitor.requests.create') }}">Submit one now</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-bell me-2 text-warning"></i>Notifications
            </div>
            <div class="card-body p-0">
                @forelse($notifications as $notif)
                <div class="d-flex gap-3 p-3 border-bottom">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                         style="width:38px;height:38px;
                         background:{{ $notif->type === 'approval' ? '#d1e7dd' : '#f8d7da' }}">
                        <i class="bi {{ $notif->type === 'approval' ? 'bi-check text-success' : 'bi-x text-danger' }}"></i>
                    </div>
                    <div>
                        <div class="fw-semibold" style="font-size:13px">{{ $notif->title }}</div>
                        <div class="text-muted" style="font-size:12px">{{ $notif->message }}</div>
                        <div class="text-muted" style="font-size:11px">
                            {{ $notif->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-4">
                    <i class="bi bi-bell-slash fs-4 d-block mb-2"></i>No new notifications
                </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection