@extends('layouts.app')

@section('title', 'Guard Dashboard')
@section('page-title', "Today's Visit Schedule")

@section('content')

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="card text-center h-100">
            <div class="card-body py-4">
                <div class="fs-2 fw-bold text-primary">{{ $stats['todays_total'] }}</div>
                <div class="text-muted small mt-1">Total Today</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card text-center h-100">
            <div class="card-body py-4">
                <div class="fs-2 fw-bold text-warning">{{ $stats['pending'] }}</div>
                <div class="text-muted small mt-1">Pending Check-in</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card text-center h-100">
            <div class="card-body py-4">
                <div class="fs-2 fw-bold text-success">{{ $stats['checked_in'] }}</div>
                <div class="text-muted small mt-1">Checked In</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card text-center h-100">
            <div class="card-body py-4">
                <div class="fs-2 fw-bold text-info">{{ $stats['checked_out'] }}</div>
                <div class="text-muted small mt-1">Checked Out</div>
            </div>
        </div>
    </div>
</div>

<!-- Today's Visit Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-calendar-day me-2 text-success"></i>Today's Visits — {{ now()->format('l, d F Y') }}</span>
        <a href="{{ route('guard.schedules.index') }}" class="btn btn-sm btn-outline-success">
            Full Schedule
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Time</th>
                        <th>Visitor</th>
                        <th>Inmate</th>
                        <th>Room</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($todaysVisits as $schedule)
                    <tr>
                        <td class="fw-semibold">
                            {{ \Carbon\Carbon::parse($schedule->scheduled_time)->format('H:i') }}
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
                        <td>
                            @if($schedule->check_in_status === 'pending')
                                <form action="{{ route('guard.schedules.check-in', $schedule) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">
                                        <i class="bi bi-box-arrow-in-right"></i> Check In
                                    </button>
                                </form>
                                <form action="{{ route('guard.schedules.no-show', $schedule) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger">No Show</button>
                                </form>

                            @elseif($schedule->check_in_status === 'checked_in')
                                <button class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#checkoutModal{{ $schedule->id }}">
                                    <i class="bi bi-box-arrow-right"></i> Check Out
                                </button>

                                <!-- Checkout Modal -->
                                <div class="modal fade" id="checkoutModal{{ $schedule->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Check Out Visitor</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('guard.schedules.check-out', $schedule) }}"
                                                  method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <label class="form-label">Guard Notes (optional)</label>
                                                    <textarea name="guard_notes" class="form-control" rows="3"
                                                        placeholder="Any observations during the visit..."></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-warning">
                                                        Confirm Check Out
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                            No visits scheduled for today
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection