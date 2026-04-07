@extends('layout.app')

@push('meta')
    <title>{{ $meta_title ?? 'Popular Routes | Gurgaon Cab Service' }}</title>
    @if(!empty($meta_description))
        <meta name="description" content="{{ $meta_description }}">
    @endif
    @if(!empty($meta_keywords))
        <meta name="keywords" content="{{ $meta_keywords }}">
    @endif
    @include('components.canonical-link')
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative w-100" style="background: linear-gradient(rgba(34,34,34,0.6),rgba(34,34,34,0.6)), url('{{ asset('images/popular-routes.jpg') }}') center center / cover no-repeat; min-height: 300px;">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 300px;">
        <div class="text-center text-white">
            <h1 class="display-3 fw-bold mb-3">Most Popular Routes</h1>
            <p class="lead">Traveler favorites and highly recommended routes</p>
        </div>
    </div>
</section>

<!-- Popular Routes Grid -->
<div class="container my-5">
    @if($routes->count() > 0)
        <div class="row g-4">
            @foreach($routes as $route)
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <div class="position-relative h-100 w-100" style="min-height: 100%; height: 100%;">
                                     <img src="{{ $route->image }}" class="img-fluid w-100" alt="{{ $route->name }}" 
                                         style="object-fit: cover; min-height: 220px; height: 100%; max-height: 220px; border-radius: 0.5rem 0 0 0.5rem;">
                                    <span class="position-absolute top-0 start-0 badge bg-warning text-dark m-2" style="z-index:2;">
                                        ⭐ Popular
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body h-100 d-flex flex-column">
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
                                        <div class="row g-2 mt-2">
                                            <div class="col-6">
                                                <div class="small">
                                                    <i class="bi bi-speedometer2 text-primary me-1"></i>
                                                    {{ $route->distance }} km
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="small">
                                                    <i class="bi bi-clock text-primary me-1"></i>
                                                    {{ $route->duration }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-auto">
                                        <a href="{{ route('routes.show', $route->slug) }}" class="btn btn-primary w-100">
                                            <i class="bi bi-eye me-2"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
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
            <h5 class="text-muted">No popular routes available</h5>
            <a href="{{ route('routes.index') }}" class="btn btn-primary mt-3">View All Routes</a>
        </div>
    @endif

    <!-- Popular Routes Benefits -->
    <div class="card shadow-sm border-0 mt-5">
        <div class="card-body p-5">
            <h3 class="fw-bold text-center mb-4">Why These Routes Are Popular</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="d-flex">
                        <i class="bi bi-hand-thumbs-up-fill text-success fs-3 me-3"></i>
                        <div>
                            <h5 class="fw-bold">Highly Rated</h5>
                            <p class="text-muted mb-0">Loved by thousands of travelers</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex">
                        <i class="bi bi-eye-fill text-primary fs-3 me-3"></i>
                        <div>
                            <h5 class="fw-bold">Best Views</h5>
                            <p class="text-muted mb-0">Most scenic and picturesque routes</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex">
                        <i class="bi bi-shield-check-fill text-info fs-3 me-3"></i>
                        <div>
                            <h5 class="fw-bold">Safe Journey</h5>
                            <p class="text-muted mb-0">Well-maintained and secure paths</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
