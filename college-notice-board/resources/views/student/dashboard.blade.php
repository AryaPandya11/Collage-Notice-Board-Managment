@extends('layouts.app')
@section('content')
<div class="row mb-5 align-items-end">
    <div class="col-lg-6">
        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-3 border border-primary border-opacity-25"><i class="fas fa-broadcast-tower me-2"></i> Live Broadcasts</span>
        <h1 class="fw-bolder display-5 text-dark mb-2" style="letter-spacing: -1px;">Campus Notice Board</h1>
        <p class="text-muted fs-5 mb-0">Stay informed with the latest official announcements from your faculty members.</p>
    </div>
    <div class="col-lg-6 mt-4 mt-lg-0">
        <form action="{{ route('student.dashboard') }}" method="GET" class="d-flex justify-content-lg-end bg-white p-2 rounded-pill shadow-sm">
            <div class="input-group" style="max-width: 400px;">
                <span class="input-group-text bg-transparent border-0 text-primary ps-4"><i class="fas fa-filter"></i></span>
                <select name="category" class="form-select border-0 shadow-none fw-semibold text-dark bg-transparent" onchange="this.form.submit()">
                    <option value="">All Topics</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @if(request('category'))
                    <a href="{{ route('student.dashboard') }}" class="btn btn-light rounded-pill px-4 text-muted fw-bold">Reset</a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="row g-4">
    @forelse($notices as $notice)
    <div class="col-md-6 col-xl-4 d-flex align-items-stretch">
        <div class="notice-feed-card w-100 d-flex flex-column position-relative">
            <div class="card-body p-4 d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="badge bg-light text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill fw-bold">{{ $notice->category->name }}</span>
                    @if($notice->created_at->isToday())
                        <span class="badge bg-danger px-2 py-1 rounded-pill animate-pulse"><i class="fas fa-fire-alt me-1"></i> New</span>
                    @else
                        <small class="text-muted fw-medium"><i class="far fa-calendar me-1"></i>{{ $notice->created_at->format('M d') }}</small>
                    @endif
                </div>
                
                <h4 class="card-title fw-bold text-dark mb-3" style="line-height: 1.4;">{{ $notice->title }}</h4>
                <p class="card-text text-muted mb-4 flex-grow-1" style="line-height: 1.6;">{{ Str::limit($notice->description, 120) }}</p>
                
                <div class="d-flex align-items-center mt-auto pt-3 border-top border-light">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($notice->creator->name) }}&background=f3f4f6&color=4f46e5&bold=true" class="rounded-circle me-3 border border-2 border-white shadow-sm" width="40" height="40" alt="Avatar">
                    <div class="me-auto">
                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $notice->creator->name }}</div>
                        <div class="text-primary fw-semibold" style="font-size: 0.75rem;">Faculty Member</div>
                    </div>
                    <a href="{{ route('student.notices.show', $notice) }}" class="btn btn-primary rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center" style="width:40px; height:40px;"><i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 py-5 text-center mt-5">
        <img src="https://cdni.iconscout.com/illustration/premium/thumb/folder-is-empty-illustration-download-in-svg-png-gif-file-formats--no-data-record-blank-document-pack-design-development-illustrations-6453664.png?f=webp" alt="Empty" style="width: 250px; opacity: 0.7;" class="mb-4">
        <h3 class="fw-bolder text-dark mb-2">You're all caught up!</h3>
        <p class="text-muted fs-5 mx-auto" style="max-width: 500px;">There are no active notices at the moment. Keep an eye out, announcements will appear here when they are broadcasted.</p>
    </div>
    @endforelse
</div>

<style>
@keyframes pulse {
    0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
    70% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
    100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
}
.animate-pulse { animation: pulse 2s infinite; }
</style>
@endsection
