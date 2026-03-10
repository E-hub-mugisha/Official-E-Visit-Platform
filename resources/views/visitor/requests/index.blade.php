@extends('layouts.app')

@section('title', 'My Requests')
@section('page-title', 'My Visit Requests')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2 text-primary"></i>My Visit Requests</span>
        <a href="{{ route('visitor.requests.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> New Request
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Request #</th>
                        <th>Inmate</th>
                        <th>Preferred Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Scheduled</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $req)
                    <tr>
                        <td class="fw-semibold text-primary">{{ $req->request_number }}</td>
                        <td>{{ $req->inmate?->full_name }}</td>
                        <td>{{ $req->preferred_date->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($req->preferred_time)->format('H:i') }}</td>
                        <td>
                            <span class="status-badge status-{{ $req->status }}">
                                {{ ucfirst($req->status) }}
                            </span>
                        </td>
                        <td>
                            @if($req->schedule)
                                {{ $req->schedule->scheduled_date->format('d M Y') }}
                                {{ \Carbon\Carbon::parse($req->schedule->scheduled_time)->format('H:i') }}
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('visitor.requests.show', $req) }}"
                               class="btn btn-sm btn-outline-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            @if($req->isPending())
                                <form action="{{ route('visitor.requests.cancel', $req) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Cancel this request?')">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-x"></i> Cancel
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            No requests yet.
                            <a href="{{ route('visitor.requests.create') }}">Submit your first request</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $requests->links() }}</div>
    </div>
</div>

@endsection