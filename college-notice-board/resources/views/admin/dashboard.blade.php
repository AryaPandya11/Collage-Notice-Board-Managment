@extends('layouts.app')
@section('content')
<div class="row mb-5 align-items-center">
    <div class="col-md-8">
        <h2 class="fw-bolder mb-2 text-dark" style="font-size: 2.2rem;">Admin Hub</h2>
        <p class="text-muted fs-5">Overview of system categories and notice moderation.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <div class="d-inline-flex bg-white rounded-pill shadow-sm px-4 py-2 align-items-center">
            <i class="far fa-calendar-alt text-primary me-2"></i>
            <span class="fw-semibold text-dark">{{ now()->format('l, F j, Y') }}</span>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="stat-card stat-warning shadow-lg">
            <i class="fas fa-clock stat-icon"></i>
            <div class="position-relative z-1">
                <h6 class="text-white-50 text-uppercase fw-bold mb-2 tracking-wide">Pending Review</h6>
                <div class="d-flex align-items-center">
                    <h2 class="display-3 fw-bolder mb-0 me-3">{{ $pendingCount }}</h2>
                    @if($pendingCount > 0)
                        <span class="badge bg-white text-warning rounded-pill py-2 px-3 fw-bold shadow-sm">Needs Action</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-success shadow-lg">
            <i class="fas fa-check-circle stat-icon"></i>
            <div class="position-relative z-1">
                <h6 class="text-white-50 text-uppercase fw-bold mb-2 tracking-wide">Approved Notices</h6>
                <h2 class="display-3 fw-bolder mb-0">{{ $approvedCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-danger shadow-lg">
            <i class="fas fa-times-circle stat-icon"></i>
            <div class="position-relative z-1">
                <h6 class="text-white-50 text-uppercase fw-bold mb-2 tracking-wide">Rejected Notices</h6>
                <h2 class="display-3 fw-bolder mb-0">{{ $rejectedCount }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="premium-card h-100 p-1">
            <div class="card-body text-center p-5 d-flex flex-column justify-content-center h-100">
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-4 mx-auto mb-4" style="width: 100px; height: 100px;">
                    <i class="fas fa-layer-group fa-3x text-primary m-auto"></i>
                </div>
                <h3 class="fw-bold mb-3">Category Management</h3>
                <p class="text-muted fs-5 mb-4 px-lg-4">Organize and structure your institution's notices by creating logical categories.</p>
                <div class="mt-auto">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-custom rounded-pill shadow px-5 py-3 fs-5">Manage Categories <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="premium-card h-100 p-1">
            <div class="card-body text-center p-5 d-flex flex-column justify-content-center h-100">
                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-4 mx-auto mb-4" style="width: 100px; height: 100px;">
                    <i class="fas fa-tasks fa-3x text-success m-auto"></i>
                </div>
                <h3 class="fw-bold mb-3">Notice Moderation</h3>
                <p class="text-muted fs-5 mb-4 px-lg-4">Review submissions from faculty. Approve essential broadcasts or reject incomplete ones.</p>
                <div class="mt-auto">
                    <a href="{{ route('admin.notices.index') }}" class="btn btn-success btn-custom rounded-pill shadow px-5 py-3 fs-5 text-white" style="background: linear-gradient(135deg, #10b981, #059669); border-color: transparent;">Review Submissions <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
