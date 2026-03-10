@extends('layouts.app')

@section('title', 'Visitors')
@section('page-title', 'Manage Visitors')

@section('content')

<div class="card">
    <div class="card-header">
        <i class="bi bi-people me-2 text-primary"></i>All Registered Visitors
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>National ID</th>
                        <th>Phone</th>
                        <th>Verified</th>
                        <th>Blacklisted</th>
                        <th>Total Visits</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visitors as $visitor)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $visitor->full_name }}</td>
                        <td>{{ $visitor->national_id }}</td>
                        <td>{{ $visitor->phone }}</td>
                        <td>
                            @if($visitor->is_verified)
                                <span class="status-badge status-approved">Verified</span>
                            @else
                                <span class="status-badge status-pending">Unverified</span>
                            @endif
                        </td>
                        <td>
                            @if($visitor->is_blacklisted)
                                <span class="status-badge status-rejected">Blacklisted</span>
                            @else
                                <span class="status-badge status-completed">Clear</span>
                            @endif
                        </td>
                        <td>{{ $visitor->visitRequests->count() }}</td>
                        <td>
                            <a href="{{ route('admin.visitors.show', $visitor) }}"
                               class="btn btn-sm btn-outline-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            @if(!$visitor->is_verified)
                                <form action="{{ route('admin.visitors.verify', $visitor) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-check-lg"></i> Verify
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>No visitors registered
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $visitors->links() }}</div>
    </div>
</div>

@endsection