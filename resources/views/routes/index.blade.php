@extends('layout.app')

@push('meta')
    <title>{{ $meta_title ?? 'Cab Routes | Gurgaon Cab Service' }}</title>
    @if(!empty($meta_description))
        <meta name="description" content="{{ $meta_description }}">
    @endif
    @if(!empty($meta_keywords))
        <meta name="keywords" content="{{ $meta_keywords }}">
    @endif
    @include('components.canonical-link')
@endpush

@section('content')
<style>
    svg {
        height: 20px !important;
        width: 20px !important;
        min-height: 20px !important;
        min-width: 20px !important;
        max-height: 20px !important;
        max-width: 20px !important;
    }
    nav > *:nth-child(2) {
        display: none !important;
    }
</style>
<!-- Hero Section -->
<section class="hero-section position-relative w-100" style="background: linear-gradient(rgba(34,34,34,0.6),rgba(34,34,34,0.6)), url('{{ asset('images/route.jpg') }}') center center / cover no-repeat; min-height: 300px;">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 300px;">
        <div class="text-center text-white">
            <h1 class="display-3 fw-bold mb-3">Explore Popular Routes</h1>
            <p class="lead">Discover the most scenic and popular travel routes</p>
        </div>
    </div>
</section>

<!-- Routes Grid -->
<div class="container my-5">
    @if($routes->count() > 0)
        <div class="row g-4">
            @foreach($routes as $route)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="position-relative">
                            <img src="{{ $route->image }}" class="card-img-top" alt="{{ $route->name }}" 
                                 style="height: 220px; object-fit: cover;">
                            @if($route->is_popular)
                                <span class="position-absolute top-0 start-0 badge bg-warning m-2">⭐ Popular</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">{{ $route->name }}</h5>

                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-geo-alt text-primary me-2"></i>
                                    <small><strong>From:</strong> {{ $route->from_location }}</small>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                                    <small><strong>To:</strong> {{ $route->to_location }}</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-speedometer2 text-primary me-2"></i>
                                    <small>{{ $route->distance }} km</small>
                                    <span class="mx-2">•</span>
                                    <i class="bi bi-clock text-primary me-2"></i>
                                    <small>{{ $route->duration }}</small>
                                </div>
                            </div>

                            <a href="{{ route('routes.show', $route->slug) }}" class="btn btn-primary w-100">
                                <i class="bi bi-eye me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $routes->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-signpost-2 fs-1 text-muted d-block mb-3"></i>
            <h5 class="text-muted">No routes available</h5>
        </div>
    @endif

    <!-- Why Choose Our Routes -->
    <div class="row g-4 mt-5 py-5 bg-light rounded">
        <div class="col-12 text-center mb-4">
            <h3 class="fw-bold">Why Choose Our Routes?</h3>
        </div>
        <div class="col-md-3">
            <div class="text-center">
                <i class="bi bi-map fs-1 text-primary mb-3 d-block"></i>
                <h5 class="fw-bold">Well Planned</h5>
                <p class="text-muted small">Carefully designed itineraries</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="text-center">
                <i class="bi bi-camera fs-1 text-primary mb-3 d-block"></i>
                <h5 class="fw-bold">Scenic Views</h5>
                <p class="text-muted small">Most beautiful landscapes</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="text-center">
                <i class="bi bi-shield-check fs-1 text-primary mb-3 d-block"></i>
                <h5 class="fw-bold">Safe Travel</h5>
                <p class="text-muted small">Well-maintained roads and routes</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="text-center">
                <i class="bi bi-clock-history fs-1 text-primary mb-3 d-block"></i>
                <h5 class="fw-bold">Time Efficient</h5>
                <p class="text-muted small">Optimized travel duration</p>
            </div>
        </div>
    </div>
</div>
@endsection
