@php
    use App\Models\Setting;
    $settings = Cache::remember('site_settings', 3600, function() {
        return Setting::pluck('value', 'key')->toArray();
    });
    use App\Models\Location;
    $headerLocations = Cache::remember('header_locations', 600, function() {
        return Location::where('is_active', true)->orderBy('title')->get(['title','slug']);
    });
@endphp
<style>
    .dropdown-menu{
        padding: 0px;
    }
    .dropdown-item{
        border-bottom: 1px solid #80808036;
    }
    .dropdown-item:hover{
        background-color: #ffc107;
        color:#fff;
    }
</style>

<!-- Top Header Bar: Desktop Only -->
<div class="header-top-bar bg-black text-light py-2 px-2 d-none d-md-block" style="border-bottom:5px solid #ffc107; font-size:0.98rem;">
    <div class="container-fluid d-flex flex-row align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-4">
            <span class="d-flex align-items-center gap-1"><i class="bi bi-envelope-fill text-warning"></i> <span class="text-light">gurgaoncab5873@gmail.com</span></span>
            <span class="d-flex align-items-center gap-1"><i class="bi bi-telephone-fill text-warning"></i> <span class="text-light">+91 9672965873</span></span>
            <span class="d-flex align-items-center gap-1"><i class="bi bi-clock-fill text-warning"></i> <span class="text-light">24/7 Availability</span></span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="me-2">Follow Us:</span>
            <a href="#" class="text-warning fs-5"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-warning fs-5"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-warning fs-5"><i class="bi bi-telephone"></i></a>
            <a href="#" class="text-warning fs-5"><i class="bi bi-geo-alt-fill"></i></a>
        </div>
    </div>
</div>

<!-- Mobile Only: Phone Number Bar -->
<div class="d-flex d-md-none bg-black text-warning py-2 px-3 w-100" style="font-size:1.1rem; border-bottom:2px solid #ffc107;">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <span class="d-flex align-items-center gap-2">
            <i class="bi bi-telephone-fill"></i>
            <a href="tel:+919672965873" class="text-warning text-decoration-none fw-bold">+91 9672965873</a>
        </span>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="#" class="text-warning fs-5"><i class="bi bi-facebook"></i></a>
        <a href="#" class="text-warning fs-5"><i class="bi bi-instagram"></i></a>
        <a href="#" class="text-warning fs-5"><i class="bi bi-telephone"></i></a>
        <a href="#" class="text-warning fs-5"><i class="bi bi-geo-alt-fill"></i></a>
    </div>
</div>

<header class="shadow-sm bg-white py-2 position-sticky top-0 z-10" style="z-index:1030;">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid px-3 w-100 d-flex align-items-center justify-content-between">
            <!-- Logo (always left) -->
            <a class="navbar-brand d-flex align-items-center p-0 m-0" href="/" style="min-width:200px;">
                <img src="{{ asset('images/gallery/logo.png') }}" alt="Logo" style="height:54px; width:auto; margin-right:8px;">
                
            </a>
            <!-- Toggler always right on mobile -->
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Desktop Navbar -->
            <div class="collapse navbar-collapse d-none d-lg-flex" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-primary" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/routes">Cabs</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="locationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Locations</a>
                        <ul class="dropdown-menu" aria-labelledby="locationsDropdown">
                            @forelse($headerLocations as $location)
                                <li><a class="dropdown-item" href="{{ url('/locations/'.$location->slug) }}">{{ $location->title }}</a></li>
                            @empty
                                <li><span class="dropdown-item text-secondary">No locations</span></li>
                            @endforelse
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vehicles">Vehicles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.archive') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact Us</a>
                    </li>
                </ul>
                <!-- Right Side: Contact, Search, Login -->
                <div class="d-flex align-items-center gap-3 ms-lg-3 mt-3 mt-lg-0">
                    <a href="/contact" class="btn btn-warning px-4 py-2 fw-bold text-dark book-taxi-btn" style="border-radius:30px; font-size:1rem; box-shadow:0 2px 12px rgba(255,193,7,0.10);">
                        BOOK A TAXI
                    </a>

                    @auth
                        <!-- User dropdown removed for frontend -->
                    @endauth
                </div>
            </div>
            <!-- Offcanvas Mobile Menu -->
            <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title d-flex align-items-center" id="mobileMenuLabel">
                        <img src="{{ asset('images/gallery/logo.png') }}" alt="Logo" style="height:28px; width:auto; margin-right:7px;">
                        
                    </h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-primary" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/routes">Routes</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="locationsDropdownMobile" role="button" data-bs-toggle="dropdown" aria-expanded="false">Locations</a>
                            <ul class="dropdown-menu" aria-labelledby="locationsDropdownMobile">
                                @forelse($headerLocations as $location)
                                    <li><a class="dropdown-item" href="{{ url('/locations/'.$location->slug) }}">{{ $location->title }}</a></li>
                                @empty
                                    <li><span class="dropdown-item text-secondary">No locations</span></li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/vehicles">Vehicles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">Contact Us</a>
                        </li>
                    </ul>
                    <hr>
                    <div class="d-flex flex-column gap-3 mt-3">
                        <div class="d-flex align-items-center">
                            <span class="rounded-circle border d-flex align-items-center justify-content-center" style="width:36px; height:36px;">
                                <i class="bi bi-telephone fs-5"></i>
                            </span>
                            <div class="ms-2">
                                <div class="small text-muted">Need Help?</div>
                                <div class="fw-bold">{{ $settings['contact_whatsapp'] ?? '+91 345 533 865' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
<style>
    /* Global button hover style for all buttons */
    .btn,
    button,
    input[type="submit"],
    input[type="button"],
    .book-taxi-btn {
        transition: background 0.2s, color 0.2s;
    }
    .btn:hover,
    button:hover,
    input[type="submit"]:hover,
    input[type="button"]:hover,
    .book-taxi-btn:hover {
        background: #000 !important;
        color: #fff !important;
        border-color: #000 !important;
    }
</style>
</header>
