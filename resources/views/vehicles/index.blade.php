@extends('layout.app')

@push('meta')
    <title>{{ $meta_title ?? 'Our Vehicles | Gurgaon Cab Service' }}</title>
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
<section class="hero-section position-relative w-100" style="background: linear-gradient(rgba(34,34,34,0.6),rgba(34,34,34,0.6)), url('{{ asset('images/vehicles.jpg') }}') center center / cover no-repeat; min-height: 300px;">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 300px;">
        <div class="text-center text-white">
            <h1 class="display-3 fw-bold mb-3">Choose Your Ride</h1>
            <p class="lead">Comfortable and well-maintained vehicles for your journey</p>
        </div>
    </div>
</section>

<!-- Vehicles Grid -->
<div class="container my-5">
    @if($vehicles->count() > 0)
        <div class="row g-4">
            @foreach($vehicles as $vehicle)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="position-relative">
                            <img src="{{ (str_starts_with($vehicle->image, 'http') || str_starts_with($vehicle->image, '/')) ? $vehicle->image : asset($vehicle->image) }}" 
                                 class="card-img-top" alt="{{ $vehicle->name }}" 
                                 style="height: 220px; object-fit: cover;">
                            @if($vehicle->is_available)
                                <span class="position-absolute top-0 start-0 badge bg-success m-2">Available</span>
                            @else
                                <span class="position-absolute top-0 start-0 badge bg-danger m-2">Not Available</span>
                            @endif
                            @if($vehicle->type == 'luxury')
                                <span class="position-absolute top-0 end-0 badge bg-warning m-2">⭐ Luxury</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">{{ $vehicle->name }}</h5>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="small">
                                        <i class="bi bi-people text-primary me-2"></i>
                                        <span class="fw-bold">{{ $vehicle->seating_capacity }}</span> Seats
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="small">
                                        <i class="bi bi-ui-radios text-primary me-2"></i>
                                        <span class="text-capitalize">{{ $vehicle->type }}</span>
                                    </div>
                                </div>
                                @if($vehicle->has_ac)
                                    <div class="col-6">
                                        <div class="small text-success">
                                            <i class="bi bi-wind me-2"></i>AC Available
                                        </div>
                                    </div>
                                @endif
                                @if($vehicle->luggage_capacity)
                                    <div class="col-6">
                                        <div class="small">
                                            <i class="bi bi-bag text-primary me-2"></i>
                                            {{ $vehicle->luggage_capacity }} Bags
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-bold fs-4 text-primary">₹{{ number_format($vehicle->price_per_km, 0) }}</span>
                                    <small class="text-muted">/km</small>
                                </div>
                                <a href="{{ route('vehicles.show', $vehicle->slug) }}" class="btn btn-primary">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $vehicles->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-car-front fs-1 text-muted d-block mb-3"></i>
            <h5 class="text-muted">No vehicles available</h5>
        </div>
    @endif

    <!-- Why Choose Our Vehicles -->
    <div class="row g-4 mt-5 py-5 bg-light rounded">
        <div class="col-12 text-center mb-4">
            <h3 class="fw-bold">Why Choose Our Vehicles?</h3>
        </div>
        <div class="col-md-3">
            <div class="text-center">
                <i class="bi bi-shield-check fs-1 text-primary mb-3 d-block"></i>
                <h5 class="fw-bold">Well Maintained</h5>
                <p class="text-muted small">Regular servicing and safety checks</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="text-center">
                <i class="bi bi-person-check fs-1 text-primary mb-3 d-block"></i>
                <h5 class="fw-bold">Expert Drivers</h5>
                <p class="text-muted small">Experienced and professional chauffeurs</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="text-center">
                <i class="bi bi-currency-rupee fs-1 text-primary mb-3 d-block"></i>
                <h5 class="fw-bold">Best Rates</h5>
                <p class="text-muted small">Competitive pricing with no hidden costs</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="text-center">
                <i class="bi bi-clock-history fs-1 text-primary mb-3 d-block"></i>
                <h5 class="fw-bold">24/7 Service</h5>
                <p class="text-muted small">Available round the clock for your convenience</p>
            </div>
        </div>
    </div>
</div>
@endsection
