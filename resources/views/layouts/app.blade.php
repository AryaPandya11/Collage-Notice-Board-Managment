<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Notice Board</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #10b981;
            --bg-color: #f3f4f6;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
            --hover-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        body { 
            background-color: var(--bg-color); 
            font-family: 'Outfit', sans-serif; 
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        h1, h2, h3, h4, h5, h6 { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; }
        
        /* Navbar Styling */
        .glass-navbar {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: 800 !important;
            color: var(--primary) !important;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }
        .nav-link {
            color: var(--text-muted) !important;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.5rem 1rem !important;
            margin: 0 0.2rem;
            border-radius: 8px;
            transition: var(--transition);
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
            background-color: rgba(79, 70, 229, 0.1);
        }
        .nav-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white !important;
            border-radius: 50px;
            padding: 0.5rem 1.5rem !important;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.3);
        }
        .nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.4);
            color: white !important;
        }

        /* Card Styling */
        .premium-card { 
            border: none; 
            border-radius: 16px;
            background: white;
            box-shadow: var(--card-shadow); 
            transition: var(--transition); 
            overflow: hidden;
        }
        .premium-card:hover { 
            transform: translateY(-5px); 
            box-shadow: var(--hover-shadow);
        }
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1.5rem;
        }
        
        /* Dashboard Stats Cards */
        .stat-card {
            border-radius: 20px;
            color: white;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: var(--card-shadow);
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: -1;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card:hover::before {
            transform: scale(1.2);
        }
        .stat-primary { background: linear-gradient(135deg, #6366f1, #4f46e5); }
        .stat-success { background: linear-gradient(135deg, #10b981, #059669); }
        .stat-warning { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .stat-danger  { background: linear-gradient(135deg, #ef4444, #dc2626); }
        .stat-icon {
            position: absolute;
            right: 1.5rem;
            bottom: 1.5rem;
            font-size: 4rem;
            opacity: 0.2;
            z-index: -1;
            transition: transform 0.3s;
        }
        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        /* Buttons */
        .btn-custom {
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: var(--transition);
        }
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        /* Notice Feed */
        .notice-badge {
            font-size: 0.75rem;
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .notice-feed-card {
            border-radius: 16px;
            border: none;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            background: white;
            overflow: hidden;
            position: relative;
        }
        .notice-feed-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }
        .notice-feed-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }
        .notice-feed-card:hover::after {
            transform: scaleX(1);
        }
        
        /* Split Auth Layout */
        .auth-container {
            min-height: calc(100vh - 120px);
            display: flex;
            align-items: center;
        }
        .auth-image-panel {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.9), rgba(16, 185, 129, 0.9)), url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80') center/cover;
            border-radius: 24px;
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 25px 50px -12px rgba(79, 70, 229, 0.25);
        }
        
        /* Forms */
        .form-floating > .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            transition: var(--transition);
            background-color: #f9fafb;
        }
        .form-floating > .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
        
        /* Tables */
        .table-responsive {
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            border: none;
            background: white;
            padding: 1rem;
        }
        .table { margin-bottom: 0; }
        .table th {
            background-color: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            padding: 1.25rem 1rem;
        }
        .table td {
            padding: 1.25rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-weight: 500;
        }
        .table tbody tr {
            transition: var(--transition);
        }
        .table tbody tr:hover {
            background-color: #f8fafc;
            transform: scale(1.002);
        }
        
        main { flex-grow: 1; padding: 2rem 0; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg glass-navbar mb-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <div class="bg-primary text-white rounded p-2 me-2 shadow d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;">
                <i class="fas fa-layer-group fs-5"></i>
            </div>
            CNB Portal
        </a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-toggle="target" aria-controls="navbarNav">
            <div class="bg-light rounded p-2 text-primary shadow-sm"><i class="fas fa-bars"></i></div>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ps-lg-4">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-pie me-1 text-primary"></i> Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fas fa-tags me-1 text-primary"></i> Categories</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.notices.index') }}"><i class="fas fa-file-invoice me-1 text-primary"></i> Notices</a></li>
                    @elseif(auth()->user()->role === 'faculty')
                        <li class="nav-item"><a class="nav-link" href="{{ route('faculty.dashboard') }}"><i class="fas fa-chalkboard-teacher me-1 text-primary"></i> My Notices</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('faculty.notices.create') }}"><i class="fas fa-plus-circle me-1 text-primary"></i> Create Notice</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('student.dashboard') }}"><i class="fas fa-home me-1 text-primary"></i> Notice Board</a></li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav ms-auto align-items-center">
                @guest
                    <li class="nav-item"><a class="nav-link fw-bold text-dark" href="{{ route('login') }}">Sign In</a></li>
                    <li class="nav-item ms-lg-2"><a class="nav-link nav-btn" href="{{ route('register') }}">Create Account <i class="fas fa-arrow-right ms-1 fs-6"></i></a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold text-dark d-flex align-items-center bg-white rounded-pill shadow-sm px-2 py-1 mx-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff&rounded=true&bold=true" class="rounded-circle me-2" width="38" height="38" alt="Avatar">
                            <div class="pe-2">
                                <div style="line-height:1.2; font-size:0.95rem;">{{ auth()->user()->name }}</div>
                                <small class="text-primary" style="font-size:0.70rem; letter-spacing: 0.5px;">{{ strtoupper(auth()->user()->role) }}</small>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2" style="border-radius: 16px; min-width: 220px; animation: slideDown 0.3s ease forwards;">
                            <div class="dropdown-header text-center pb-2 border-bottom mb-2">
                                <h6 class="mb-0 fw-bold">{{ auth()->user()->name }}</h6>
                                <small class="text-muted">{{ auth()->user()->email }}</small>
                            </div>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item rounded text-danger fw-semibold py-2 d-flex align-items-center" type="submit">
                                        <div class="bg-danger bg-opacity-10 rounded p-2 me-3"><i class="fas fa-sign-out-alt"></i></div> Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style>
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<main>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 12px; background: #ecfdf5; border-left: 5px solid #10b981 !important;" role="alert">
                <strong><i class="fas fa-check-circle me-2 fs-5 text-success"></i> Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close mt-1" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 12px; background: #fef2f2; border-left: 5px solid #ef4444 !important;" role="alert">
                <strong><i class="fas fa-exclamation-circle me-2 fs-5 text-danger"></i> Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close mt-1" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
