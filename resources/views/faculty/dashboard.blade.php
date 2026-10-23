@extends('layouts.app')
@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
    <div>
        <h2 class="fw-bolder mb-1 text-dark display-6">Faculty Hub</h2>
        <p class="text-muted fs-5 mb-0">Manage your published announcements and create new broadcasts.</p>
    </div>
    <a href="{{ route('faculty.notices.create') }}" class="btn btn-primary btn-custom rounded-pill shadow px-4 py-3 fw-bold fs-5">
        <i class="fas fa-plus-circle me-2"></i> Publish Notice
    </a>
</div>

<div class="premium-card p-2 p-md-4">
    <div class="card-body p-0 table-responsive border-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th class="ps-4 rounded-start-3">Notice Detail</th>
                    <th>Category</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th class="text-end pe-4 rounded-end-3">Manage</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notices as $notice)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-dark fs-5 mb-1">{{ $notice->title }}</span>
                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> Created {{ $notice->created_at->format('M d, Y') }}</small>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold border border-primary border-opacity-25">{{ $notice->category->name }}</span>
                    </td>
                    <td>
                        @if($notice->expiry_date)
                            <div class="text-dark fw-semibold"><i class="far fa-clock me-1 text-muted"></i> Until {{ \Carbon\Carbon::parse($notice->expiry_date)->format('M d, Y') }}</div>
                        @else
                            <span class="text-muted fst-italic">Indefinite</span>
                        @endif
                    </td>
                    <td>
                        @if($notice->status == 'pending')
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-bold border border-warning border-opacity-50"><i class="fas fa-circle-notch fa-spin me-1"></i> Awaiting Review</span>
                        @elseif($notice->status == 'approved')
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold border border-success border-opacity-50"><i class="fas fa-check-circle me-1"></i> Published</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold border border-danger border-opacity-50"><i class="fas fa-times-circle me-1"></i> Rejected</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('student.notices.show', $notice) }}" class="btn btn-sm btn-light text-primary shadow-sm rounded-circle d-inline-flex align-items-center justify-content-center" style="width:35px; height:35px;" title="View Render">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('faculty.notices.edit', $notice) }}" class="btn btn-sm btn-light text-warning shadow-sm rounded-circle d-inline-flex align-items-center justify-content-center" style="width:35px; height:35px;" title="Edit Content">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('faculty.notices.destroy', $notice) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to permanently delete this notice?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger shadow-sm rounded-circle d-inline-flex align-items-center justify-content-center" style="width:35px; height:35px;" title="Withdraw Notice">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-5 text-center">
                        <div class="d-inline-flex bg-light rounded-circle p-4 mb-3 text-muted">
                            <i class="fas fa-folder-open fa-3x"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-1">Your Portfolio is Empty</h4>
                        <p class="text-muted">You haven't broadcasted any notices yet. Start by publishing your first announcement.</p>
                        <a href="{{ route('faculty.notices.create') }}" class="btn btn-primary btn-custom rounded-pill mt-2 px-4 shadow-sm">Publish First Notice</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
