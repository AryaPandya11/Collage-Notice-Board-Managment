@extends('layouts.app')
@section('content')
<div class="auth-container">
    <div class="row w-100 mx-0 bg-white rounded-4 shadow-lg overflow-hidden position-relative" style="min-height: 600px;">
        <!-- Left Side Image Panel -->
        <div class="col-lg-6 d-none d-lg-flex auth-image-panel rounded-0" style="border-radius: 24px 0 0 24px;">
            <div class="position-relative z-1">
                <div class="mb-4">
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill fs-6 fw-bold shadow-sm">Premium Portal</span>
                </div>
                <h1 class="display-4 fw-bolder mb-4" style="text-shadow: 0 4px 12px rgba(0,0,0,0.1);">Stay Connected with the Campus.</h1>
                <p class="fs-5 text-white-50 ms-1">Access all your official notices, events, and communications in one centralized, modern platform built exclusively for your college.</p>
            </div>
            <!-- Decorative circle -->
            <div class="position-absolute" style="bottom: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%); border-radius: 50%;"></div>
        </div>
        
        <!-- Right Side Form Panel -->
        <div class="col-lg-6 p-5 d-flex align-items-center bg-white">
            <div class="w-100" style="max-width: 420px; margin: 0 auto;">
                <div class="text-center text-lg-start mb-5">
                    <div class="d-inline-flex bg-primary bg-opacity-10 p-3 rounded-circle text-primary mb-3">
                        <i class="fas fa-lock fa-2x"></i>
                    </div>
                    <h2 class="fw-bolder text-dark mb-2">Welcome Back</h2>
                    <p class="text-muted fw-medium">Please enter your credentials to log in.</p>
                </div>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-floating mb-4">
                        <input type="email" class="form-control fw-medium border-2 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
                        <label for="email" class="text-muted"><i class="fas fa-envelope me-2"></i>Email address</label>
                        @error('email') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control fw-medium border-2 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                        <label for="password" class="text-muted"><i class="fas fa-key me-2"></i>Password</label>
                        @error('password') <div class="invalid-feedback fw-semibold">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input border-secondary" id="remember" name="remember" style="width: 1.2rem; height: 1.2rem;">
                            <label class="form-check-label text-muted fw-medium ms-1" style="padding-top:2px;" for="remember">Remember me</label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-custom w-100 py-3 shadow fs-5 rounded-pill">Sign In <i class="fas fa-arrow-right ms-2"></i></button>
                    
                    <div class="text-center mt-5">
                        <p class="text-muted fw-medium">Don't have an account? <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold ms-1" style="border-bottom: 2px solid transparent; transition: all 0.3s; padding-bottom: 2px;">Create an account</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    a:hover { border-bottom-color: var(--primary) !important; }
</style>
@endsection
