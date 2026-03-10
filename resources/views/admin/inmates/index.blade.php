@extends('layouts.app')

@section('title', 'Inmates')
@section('page-title', 'Manage Inmates')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-person-badge me-2 text-primary"></i>All Inmates</span>
        <a href="{{ route('admin.inmates.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Add Inmate
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Inmate No.</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Crime Category</th>
                        <th>Cell Block</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inmates as $inmate)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold text-primary">{{ $inmate->inmate_number }}</td>
                        <td>{{ $inmate->full_name }}</td>
                        <td>{{ ucfirst($inmate->gender) }}</td>
                        <td>{{ $inmate->crime_category }}</td>
                        <td>{{ $inmate->cell_block ?? '—' }}</td>
                        <td>
                            <span class="status-badge
                                {{ $inmate->status === 'active'      ? 'status-approved'  : '' }}
                                {{ $inmate->status === 'released'    ? 'status-completed' : '' }}
                                {{ $inmate->status === 'transferred' ? 'status-pending'   : '' }}">
                                {{ ucfirst($inmate->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.inmates.show', $inmate) }}"
                               class="btn btn-sm btn-outline-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.inmates.edit', $inmate) }}"
                               class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.inmates.destroy', $inmate) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this inmate?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>No inmates found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $inmates->links() }}</div>
    </div>
</div>

@endsection