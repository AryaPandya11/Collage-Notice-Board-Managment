@extends('layouts.app')
@section('content')
<div class="auth-container py-4">
    <div class="row w-100 mx-0 bg-white rounded-4 shadow-lg overflow-hidden position-relative">
        
        <!-- Right Side Form Panel -->
        <div class="col-lg-6 p-4 p-md-5 bg-white">
            <div class="w-100" style="max-width: 480px; margin: 0 auto;">
                <div class="mb-4 text-center text-lg-start">
                    <div class="d-inline-flex bg-primary bg-opacity-10 p-3 rounded-circle text-primary mb-3">
                        <i class="fas fa-user-plus fa-2x"></i>
                    </div>
                    <h2 class="fw-bolder text-dark mb-2">Create an Account</h2>
                    <p class="text-muted fw-medium">Join the portal as a Student or Faculty member.</p>
                </div>
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control border-2 fw-medium @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required autofocus>
                        <label for="name" class="text-muted"><i class="fas fa-user me-2 opacity-50"></i>Full Name</label>
                        @error('name') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="form-floating mb-4">
                        <input type="email" class="form-control border-2 fw-medium @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                        <label for="email" class="text-muted"><i class="fas fa-envelope me-2 opacity-50"></i>Email address</label>
                        @error('email') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="form-floating mb-4">
                        <select class="form-select border-2 fw-bold text-primary @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>🎓 Student</option>
                            <option value="faculty" {{ old('role') == 'faculty' ? 'selected' : '' }}>👨‍🏫 Faculty</option>
                        </select>
                        <label for="role" class="text-muted"><i class="fas fa-user-tag me-2 opacity-50"></i>Account Type</label>
                        @error('role') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control border-2 fw-medium @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                                <label for="password" class="text-muted"><i class="fas fa-lock me-2 opacity-50"></i>Password</label>
                                @error('password') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control border-2 fw-medium" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                <label for="password_confirmation" class="text-muted"><i class="fas fa-check-double me-2 opacity-50"></i>Confirm</label>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-custom rounded-pill w-100 py-3 shadow-sm fs-5 mb-4">Create Account <i class="fas fa-arrow-right ms-2"></i></button>
                    
                    <p class="text-center text-muted fw-medium mt-2">Already have an account? <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold ms-1" style="border-bottom: 2px solid transparent; transition: all 0.3s;">Sign in</a></p>
                </form>
            </div>
        </div>

        <!-- Left Side Image Panel -->
        <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-center position-relative pr-0" style="background: linear-gradient(135deg, rgba(79, 70, 229, 0.95), rgba(67, 56, 202, 0.95)); border-radius: 0 24px 24px 0;">
            <div class="p-5 text-white text-center z-1">
                <div class="bg-white bg-opacity-10 rounded-circle p-4 d-inline-block mb-4 shadow-sm">
                    <i class="fas fa-users fa-4x opacity-75"></i>
                </div>
                <h2 class="fw-bolder mb-3 display-5" style="text-shadow: 0 4px 12px rgba(0,0,0,0.1);">Join the Community</h2>
                <p class="fs-5 text-white-75 px-4 mb-5">Register quickly to securely access your designated dashboard and stay up-to-date with essential campus news.</p>
                
                <div class="d-flex justify-content-center gap-3">
                    <div class="bg-white bg-opacity-10 px-4 py-3 rounded-4 shadow-sm backdrop-blur">
                        <h3 class="fw-bold mb-0">100+</h3>
                        <small class="text-white-50">Active Users</small>
                    </div>
                    <div class="bg-white bg-opacity-10 px-4 py-3 rounded-4 shadow-sm backdrop-blur">
                        <h3 class="fw-bold mb-0">24/7</h3>
                        <small class="text-white-50">Availability</small>
                    </div>
                </div>
            </div>
            <div class="position-absolute top-0 end-0 w-100 h-100 opacity-25" style="background: url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80') center/cover; mix-blend-mode: overlay; border-radius: 0 24px 24px 0;"></div>
        </div>
        
    </div>
</div>
<style>
    a:hover { border-bottom-color: var(--primary) !important; }
    .backdrop-blur { backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
</style>
@endsection
