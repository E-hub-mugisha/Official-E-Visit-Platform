@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<!-- Stats Row -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card h-100" style="background:linear-gradient(135deg,#1a237e,#3949ab)">
            <div class="card-body text-white p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['total_inmates'] }}</div>
                        <div class="opacity-75 mt-1">Total Inmates</div>
                    </div>
                    <div class="opacity-50">
                        <i class="bi bi-person-badge" style="font-size:2.5rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card stat-card h-100" style="background:linear-gradient(135deg,#1b5e20,#388e3c)">
            <div class="card-body text-white p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['total_visitors'] }}</div>
                        <div class="opacity-75 mt-1">Total Visitors</div>
                    </div>
                    <div class="opacity-50">
                        <i class="bi bi-people" style="font-size:2.5rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card stat-card h-100" style="background:linear-gradient(135deg,#e65100,#f57c00)">
            <div class="card-body text-white p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['pending_requests'] }}</div>
                        <div class="opacity-75 mt-1">Pending Requests</div>
                    </div>
                    <div class="opacity-50">
                        <i class="bi bi-hourglass-split" style="font-size:2.5rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card stat-card h-100" style="background:linear-gradient(135deg,#006064,#00838f)">
            <div class="card-body text-white p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['todays_visits'] }}</div>
                        <div class="opacity-75 mt-1">Today's Visits</div>
                    </div>
                    <div class="opacity-50">
                        <i class="bi bi-calendar-check" style="font-size:2.5rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Second Stats Row -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:50px;height:50px;background:#d1e7dd">
                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-success">{{ $stats['approved_requests'] }}</div>
                    <div class="text-muted small">Approved Requests</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:50px;height:50px;background:#f8d7da">
                    <i class="bi bi-x-circle-fill text-danger fs-4"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-danger">{{ $stats['rejected_requests'] }}</div>
                    <div class="text-muted small">Rejected Requests</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:50px;height:50px;background:#cff4fc">
                    <i class="bi bi-flag-fill text-info fs-4"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-info">{{ $stats['completed_visits'] }}</div>
                    <div class="text-muted small">Completed Visits</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tables Row -->
<div class="row g-3">

    <!-- Recent Requests -->
    <div class="col-xl-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-clock-history me-2 text-primary"></i>Recent Visit Requests</span>
                <a href="{{ route('admin.visits.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Request #</th>
                                <th>Visitor</th>
                                <th>Inmate</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRequests as $req)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.visits.show', $req) }}"
                                       class="text-decoration-none fw-semibold text-primary">
                                        {{ $req->request_number }}
                                    </a>
                                </td>
                                <td>{{ $req->visitor?->full_name ?? 'N/A' }}</td>
                                <td>{{ $req->inmate?->full_name ?? 'N/A' }}</td>
                                <td>{{ $req->preferred_date->format('d M Y') }}</td>
                                <td>
                                    <span class="status-badge status-{{ $req->status }}">
                                        {{ ucfirst($req->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>No requests yet
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Schedule -->
    <div class="col-xl-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-calendar-day me-2 text-success"></i>Today's Schedule</span>
                <span class="badge bg-success">{{ now()->format('d M Y') }}</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Time</th>
                                <th>Visitor</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($todaysSchedules as $schedule)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($schedule->scheduled_time)->format('H:i') }}</td>
                                <td>{{ $schedule->visitRequest?->visitor?->full_name ?? 'N/A' }}</td>
                                <td>
                                    <span class="status-badge status-{{ $schedule->check_in_status === 'checked_in' ? 'approved' : ($schedule->check_in_status === 'checked_out' ? 'completed' : 'pending') }}">
                                        {{ ucfirst(str_replace('_', ' ', $schedule->check_in_status)) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    <i class="bi bi-calendar-x fs-4 d-block mb-2"></i>No visits today
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection