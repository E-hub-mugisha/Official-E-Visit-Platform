@extends('layouts.app')

@section('title', "Today's Visits")
@section('page-title', "Today's Visit Schedule")

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>
            <i class="bi bi-calendar-check me-2 text-success"></i>
            Visits — {{ now()->format('l, d F Y') }}
        </span>
        <span class="badge bg-success">{{ $schedules->count() }} visits</span>
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
                        <th>No. of Visitors</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $schedule)
                    <tr>
                        <td class="fw-bold">
                            {{ \Carbon\Carbon::parse($schedule->scheduled_time)->format('H:i') }}
                            <small class="text-muted d-block">
                                ends {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                            </small>
                        </td>
                        <td>
                            <div class="fw-semibold">
                                {{ $schedule->visitRequest?->visitor?->full_name ?? 'N/A' }}
                            </div>
                            <small class="text-muted">
                                {{ $schedule->visitRequest?->visitor?->phone ?? '' }}
                            </small>
                        </td>
                        <td>
                            <div class="fw-semibold">
                                {{ $schedule->visitRequest?->inmate?->full_name ?? 'N/A' }}
                            </div>
                            <small class="text-muted">
                                {{ $schedule->visitRequest?->inmate?->inmate_number ?? '' }}
                            </small>
                        </td>
                        <td>{{ $schedule->visit_room ?? '—' }}</td>
                        <td class="text-center">
                            <span class="badge bg-secondary rounded-pill">
                                {{ $schedule->visitRequest?->number_of_visitors }}
                            </span>
                        </td>
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
                                    <button class="btn btn-sm btn-outline-danger">
                                        No Show
                                    </button>
                                </form>

                            @elseif($schedule->check_in_status === 'checked_in')
                                <button class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#checkoutModal{{ $schedule->id }}">
                                    <i class="bi bi-box-arrow-right"></i> Check Out
                                </button>

                                <div class="modal fade" id="checkoutModal{{ $schedule->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Check Out — {{ $schedule->visitRequest?->visitor?->full_name }}
                                                </h5>
                                                <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('guard.schedules.check-out', $schedule) }}"
                                                  method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <label class="form-label fw-semibold">
                                                        Guard Notes (optional)
                                                    </label>
                                                    <textarea name="guard_notes" class="form-control"
                                                              rows="3"
                                                              placeholder="Any observations..."></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="bi bi-check-lg me-1"></i>
                                                        Confirm Check Out
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @else
                                <span class="text-muted small">No actions</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
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