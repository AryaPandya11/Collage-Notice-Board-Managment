@extends('layouts.app')
@section('content')
<div class="row justify-content-center py-4">
    <div class="col-lg-10">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <a href="{{ url()->previous() == url()->current() ? route('student.dashboard') : url()->previous() }}" class="btn btn-light text-dark fw-bold rounded-pill px-4 shadow-sm border border-light d-inline-flex align-items-center custom-back-btn">
                <i class="fas fa-arrow-left me-2 text-primary"></i> Back to Dashboard
            </a>
            
            <div class="d-flex align-items-center text-muted fw-medium bg-white px-4 py-2 rounded-pill shadow-sm">
                <i class="far fa-calendar-alt text-primary me-2"></i> Published: <span class="text-dark ms-1">{{ $notice->created_at->format('l, F j, Y') }}</span>
            </div>
        </div>
        
        <div class="premium-card position-relative overflow-visible mt-5">
            <!-- Decorative ribbon -->
            <div class="position-absolute bg-primary shadow-sm" style="top: 0; left: 0; right: 0; height: 6px; border-radius: 16px 16px 0 0;"></div>
            
            <div class="card-body p-0">
                <div class="p-4 p-md-5 bg-white position-relative border-bottom border-light">
                    <div class="position-absolute d-none d-md-block text-primary opacity-10" style="top: 30px; right: 40px;">
                        <i class="fas fa-quote-right fa-5x"></i>
                    </div>
                    
                    <div class="mb-4">
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-4 py-2 rounded-pill fs-6 fw-bold shadow-sm mb-3 d-inline-flex align-items-center"><i class="fas fa-tag me-2"></i>{{ $notice->category->name }}</span>
                    </div>
                    
                    <h1 class="display-5 fw-bolder text-dark mb-4" style="line-height: 1.2; letter-spacing: -0.5px;">{{ $notice->title }}</h1>
                    
                    <div class="d-flex align-items-center mb-5 bg-light p-3 rounded-4 d-inline-block">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($notice->creator->name) }}&background=4338ca&color=fff&bold=true" class="rounded-circle me-3 shadow-sm border border-2 border-white" width="55" height="55" alt="Avatar">
                        <div>
                            <div class="fw-bold text-dark fs-5">{{ $notice->creator->name }}</div>
                            <div class="text-primary fw-semibold" style="letter-spacing: 0.5px;">Authorized Communicator - Faculty</div>
                        </div>
                    </div>
                    
                    <div class="content-body text-dark">
                        <div class="fs-5" style="white-space: pre-wrap; line-height: 1.8; color: #374151;">{{ $notice->description }}</div>
                    </div>
                </div>
                
                @if($notice->attachments->count() > 0)
                <div class="bg-light p-4 p-md-5" style="border-radius: 0 0 16px 16px;">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                            <i class="fas fa-paperclip fa-lg"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-0">Attached Resources ({{ $notice->attachments->count() }})</h4>
                    </div>
                    
                    <div class="row g-3">
                        @foreach($notice->attachments as $attachment)
                            @php
                                $ext = strtolower(pathinfo($attachment->file_path, PATHINFO_EXTENSION));
                                $icon = 'fa-file-alt text-primary';
                                $bg = 'bg-primary';
                                if(in_array($ext, ['jpg','jpeg','png'])) { $icon = 'fa-image text-success'; $bg = 'bg-success'; }
                                if($ext == 'pdf') { $icon = 'fa-file-pdf text-danger'; $bg = 'bg-danger'; }
                            @endphp
                            <div class="col-md-6 col-xl-4">
                                <a href="{{ route('student.notices.download', $attachment) }}" class="card text-decoration-none h-100 hover-lift attachment-card border-0 shadow-sm" style="border-radius: 12px; transition: all 0.3s ease;">
                                    <div class="card-body p-3 d-flex align-items-center">
                                        <div class="{{ $bg }} bg-opacity-10 rounded p-3 me-3 text-center" style="width: 50px; height: 50px; display:flex; align-items:center; justify-content:center;">
                                            <i class="fas {{ $icon }} fa-lg"></i>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <div class="fw-bold text-dark text-truncate" title="Document {{ $loop->iteration }}.{{ $ext }}">Document_ID_{{ $loop->iteration }}</div>
                                            <div class="text-muted fw-semibold" style="font-size: 0.75rem; text-transform: uppercase;">{{ $ext }} format</div>
                                        </div>
                                        <div class="ms-2">
                                            <i class="fas fa-download text-muted download-icon" style="transition: color 0.3s ease;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px -5px rgba(0,0,0,0.1) !important; }
.attachment-card:hover .download-icon { color: var(--primary) !important; transform: scale(1.2); }
.custom-back-btn { transition: all 0.3s ease; }
.custom-back-btn:hover { background-color: var(--primary); color: white !important; border-color: var(--primary) !important; }
.custom-back-btn:hover i { color: white !important; }
.content-body p { margin-bottom: 1.5rem; }
</style>
@endsection
