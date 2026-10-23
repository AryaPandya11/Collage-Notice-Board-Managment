@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">All Notices</h2>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Posted By</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notices as $notice)
                <tr>
                    <td class="align-middle fw-medium">{{ $notice->title }}</td>
                    <td class="align-middle"><span class="badge bg-secondary">{{ $notice->category->name }}</span></td>
                    <td class="align-middle">{{ $notice->creator->name }}</td>
                    <td class="align-middle">
                        @if($notice->status == 'pending')
                            <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Pending</span>
                        @elseif($notice->status == 'approved')
                            <span class="badge bg-success"><i class="fas fa-check me-1"></i>Approved</span>
                        @else
                            <span class="badge bg-danger"><i class="fas fa-times me-1"></i>Rejected</span>
                        @endif
                    </td>
                    <td class="align-middle">
                        <form action="{{ route('admin.notices.update_status', $notice) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <div class="input-group input-group-sm" style="width: 220px;">
                                <select name="status" class="form-select">
                                    <option value="pending" {{ $notice->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $notice->status == 'approved' ? 'selected' : '' }}>Approve</option>
                                    <option value="rejected" {{ $notice->status == 'rejected' ? 'selected' : '' }}>Reject</option>
                                </select>
                                <button type="submit" class="btn btn-outline-primary">Update</button>
                            </div>
                        </form>
                        <a href="{{ route('student.notices.show', $notice) }}" class="btn btn-sm btn-info text-white ms-2" title="View details"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No notices found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
