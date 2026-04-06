<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - gurgaoncab Tour & Travel</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/gallery/logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/gallery/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/gallery/logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .sidebar .nav-link i {
            width: 20px;
        }
        .btn:hover{
            background-color:transparent;
            color:#000;
        }
        .btn-outline-secondary:hover {
            background-color: transparent;
            color:#000;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid px-0">
        <!-- Header (full width, above row) -->
        <div class="d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1rem 2rem; border-radius: 0;">
            <div class="text-white">
                <h4 class="fw-bold mb-0">Admin Panel</h4>
                <small class="opacity-75">Tour & Travel</small>
            </div> 
            <div class="d-flex">
                <a href="/" class="btn btn-outline-light d-flex align-items-center me-4" style="font-weight:500; color:#fff; border-color:#fff;" target="_blank" rel="noopener">
                    <i class="bi bi-globe2 me-2"></i>Visit Website
                </a>
                <div class="d-flex align-items-center gap-2">
                    <span class="rounded-circle d-flex align-items-center justify-content-center" style="background:#ff784e; color:#fff; width:38px; height:38px; font-weight:700; font-size:1.2rem;">A</span>
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle p-0 ms-1" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color:#fff; font-weight:500; font-size:1.08rem; text-decoration:none;">
                            Admin User
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
                
        </div>
        <div class="row gx-0">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <nav class="nav flex-column px-3">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-house-door me-2"></i>Dashboard</a>
                    <a href="{{ route('admin.vehicles.index') }}" class="nav-link {{ request()->routeIs('admin.vehicles.*') ? 'active' : '' }}"><i class="bi bi-car-front me-2"></i>Vehicles</a>
                    <a href="{{ route('admin.routes.index') }}" class="nav-link {{ request()->routeIs('admin.routes.*') ? 'active' : '' }}"><i class="bi bi-signpost-2 me-2"></i>Routes</a>
                    <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"><i class="bi bi-briefcase me-2"></i>Services</a>
                    <a href="{{ route('admin.locations.index') }}" class="nav-link {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}"><i class="bi bi-geo-alt me-2"></i>Locations</a>
                    <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}"><i class="bi bi-journal-text me-2"></i>Blogs</a>
                    <a href="{{ route('admin.enquiries.index') }}" class="nav-link {{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}"><i class="bi bi-envelope me-2"></i>Enquiries</a>
                    <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><i class="bi bi-gear-fill me-2"></i>Settings</a>
                </nav>
            </div>
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="p-4">
                    <!-- Alerts -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <!-- Content -->
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
