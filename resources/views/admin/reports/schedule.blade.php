@extends('layouts.app')

@section('title', 'Schedule Report')
@section('page-title', 'Schedule Report')

@section('content')

<!-- Date Filter -->
<div class="card mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.reports.schedules') }}"
              class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold small">Select Date</label>
                <input type="date" name="date" class="form-control form-control-sm"
                       value="{{ $date }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-warning btn-sm flex-fill">
                    <i class="bi bi-search me-1"></i> View Schedule
                </button>
                <a href="{{ route('admin.reports.schedules') }}"
                   class="btn btn-outline-secondary btn-sm flex-fill">
                    Today
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Summary Pills -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="card text-center">
            <div class="card-body py-3">
                <div class="fs-3 fw-bold">{{ $schedules->count() }}</div>
                <div class="text-muted small">Total Scheduled</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card text-center">
            <div class="card-body py-3">
                <div class="fs-3 fw-bold text-warning">
                    {{ $schedules->where('check_in_status', 'pending')->count() }}
                </div>
                <div class="text-muted small">Pending</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card text-center">
            <div class="card-body py-3">
                <div class="fs-3 fw-bold text-success">
                    {{ $schedules->where('check_in_status', 'checked_in')->count() }}
                </div>
                <div class="text-muted small">Checked In</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card text-center">
            <div class="card-body py-3">
                <div class="fs-3 fw-bold text-info">
                    {{ $schedules->where('check_in_status', 'checked_out')->count() }}
                </div>
                <div class="text-muted small">Checked Out</div>
            </div>
        </div>
    </div>
</div>

<!-- Schedule Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>
            <i class="bi bi-calendar-week me-2 text-warning"></i>
            Schedule for {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}
        </span>
        <span class="badge bg-secondary">{{ $schedules->count() }} visits</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Time</th>
                        <th>End Time</th>
                        <th>Visitor</th>
                        <th>Inmate</th>
                        <th>Room</th>
                        <th>Check-in Status</th>
                        <th>Checked In At</th>
                        <th>Checked Out At</th>
                        <th>Guard Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $schedule)
                    <tr>
                        <td class="fw-semibold">
                            {{ \Carbon\Carbon::parse($schedule->scheduled_time)->format('H:i') }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                        </td>
                        <td>{{ $schedule->visitRequest?->visitor?->full_name ?? 'N/A' }}</td>
                        <td>{{ $schedule->visitRequest?->inmate?->full_name ?? 'N/A' }}</td>
                        <td>{{ $schedule->visit_room ?? '—' }}</td>
                        <td>
                            <span class="status-badge
                                {{ $schedule->check_in_status === 'pending'     ? 'status-pending'   : '' }}
                                {{ $schedule->check_in_status === 'checked_in'  ? 'status-approved'  : '' }}
                                {{ $schedule->check_in_status === 'checked_out' ? 'status-completed' : '' }}
                                {{ $schedule->check_in_status === 'no_show'     ? 'status-rejected'  : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $schedule->check_in_status)) }}
                            </span>
                        </td>
                        <td>{{ $schedule->checked_in_at?->format('H:i') ?? '—' }}</td>
                        <td>{{ $schedule->checked_out_at?->format('H:i') ?? '—' }}</td>
                        <td>{{ $schedule->guard_notes ?? '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                            No visits scheduled for this date
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection