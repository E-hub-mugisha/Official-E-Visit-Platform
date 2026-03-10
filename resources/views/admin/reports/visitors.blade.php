@extends('layouts.app')

@section('title', 'Visitor Report')
@section('page-title', 'Visitor Report')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-people me-2 text-success"></i>All Visitors</span>
        <span class="badge bg-secondary">{{ $visitors->total() }} records</span>
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
                        <th>Gender</th>
                        <th>Occupation</th>
                        <th>Total Requests</th>
                        <th>Verified</th>
                        <th>Blacklisted</th>
                        <th>Registered</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visitors as $visitor)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">
                            <a href="{{ route('admin.visitors.show', $visitor) }}"
                               class="text-decoration-none">
                                {{ $visitor->full_name }}
                            </a>
                        </td>
                        <td>{{ $visitor->national_id }}</td>
                        <td>{{ $visitor->phone }}</td>
                        <td>{{ ucfirst($visitor->gender) }}</td>
                        <td>{{ $visitor->occupation ?? '—' }}</td>
                        <td>
                            <span class="badge bg-secondary rounded-pill">
                                {{ $visitor->visit_requests_count }}
                            </span>
                        </td>
                        <td>
                            @if($visitor->is_verified)
                                <span class="status-badge status-approved">Yes</span>
                            @else
                                <span class="status-badge status-pending">No</span>
                            @endif
                        </td>
                        <td>
                            @if($visitor->is_blacklisted)
                                <span class="status-badge status-rejected">Yes</span>
                            @else
                                <span class="status-badge status-completed">No</span>
                            @endif
                        </td>
                        <td>{{ $visitor->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>No visitors found
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