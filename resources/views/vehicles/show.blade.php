@extends('layout.app')

@section('meta')
    <title>{{ $vehicle->meta_title ?? $vehicle->name ?? 'Vehicle Details' }}</title>
    @if(!empty($vehicle->meta_description))
        <meta name="description" content="{{ $vehicle->meta_description }}">
    @endif
    @if(!empty($vehicle->meta_keywords))
        <meta name="keywords" content="{{ $vehicle->meta_keywords }}">
    @endif
    @if(!empty($vehicle->meta_canonical))
        <link rel="canonical" href="{{ $vehicle->meta_canonical }}">
    @endif
@endsection

@section('content')
<!-- Vehicle Hero -->
<div class="position-relative" style="height: 350px; overflow: hidden;">
    <img src="{{ (str_starts_with($vehicle->image, 'http') || str_starts_with($vehicle->image, '/')) ? $vehicle->image : asset($vehicle->image) }}" 
         alt="{{ $vehicle->name }}" 
         class="w-100 h-100" style="object-fit: cover;">
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));">
        <div class="container h-100 d-flex align-items-center pb-5">
            <div class="text-white">
                <div class="mb-3">
                    @if($vehicle->is_available)
                        <span class="badge bg-success">Available</span>
                    @else
                        <span class="badge bg-danger">Not Available</span>
                    @endif
                    @if($vehicle->has_ac)
                        <span class="badge bg-info">AC Available</span>
                    @endif
                </div>
                <h1 class="display-4 fw-bold mb-3">{{ $vehicle->name }}</h1>
                <div class="d-flex align-items-center gap-4">
                    <div><i class="bi bi-people me-2"></i>{{ $vehicle->seating_capacity }} Seats</div>
                    @if($vehicle->luggage_capacity)
                        <div><i class="bi bi-bag me-2"></i>{{ $vehicle->luggage_capacity }} Bags</div>
                    @endif
                    <div class="fs-4"><span class="fw-bold">₹{{ number_format($vehicle->price_per_km, 0) }}</span> /km</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Specifications -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4"><i class="bi bi-gear me-2"></i>Specifications</h3>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <i class="bi bi-people-fill fs-3 text-primary me-3"></i>
                                <div>
                                    <div class="small text-muted">Seating Capacity</div>
                                    <div class="fw-bold">{{ $vehicle->seating_capacity }} Passengers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <i class="bi bi-bag-fill fs-3 text-primary me-3"></i>
                                <div>
                                    <div class="small text-muted">Luggage Capacity</div>
                                    <div class="fw-bold">{{ $vehicle->luggage_capacity ?? 'Standard' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <i class="bi bi-wind fs-3 text-primary me-3"></i>
                                <div>
                                    <div class="small text-muted">Air Conditioning</div>
                                    <div class="fw-bold">{{ $vehicle->has_ac ? 'Yes' : 'No' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features -->
            @if($vehicle->features)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-3"><i class="bi bi-star text-warning me-2"></i>Features & Amenities</h3>
                        <div class="row g-3">
                            @foreach(explode("\n", $vehicle->features) as $feature)
                                @if(trim($feature))
                                    <div class="col-md-6">
                                        <div class="d-flex">
                                            <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                            <span>{{ trim($feature) }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Why Choose This Vehicle -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4">Why Choose This Vehicle?</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="bi bi-shield-check text-success fs-4 me-3"></i>
                                <div>
                                    <h6 class="fw-bold">Safe & Secure</h6>
                                    <p class="text-muted small mb-0">Regular maintenance and safety inspections</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="bi bi-person-badge text-success fs-4 me-3"></i>
                                <div>
                                    <h6 class="fw-bold">Expert Driver</h6>
                                    <p class="text-muted small mb-0">Experienced and courteous chauffeur</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="bi bi-clock-history text-success fs-4 me-3"></i>
                                <div>
                                    <h6 class="fw-bold">On-Time Service</h6>
                                    <p class="text-muted small mb-0">Punctual pickup and drop</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="bi bi-cash-coin text-success fs-4 me-3"></i>
                                <div>
                                    <h6 class="fw-bold">Best Price</h6>
                                    <p class="text-muted small mb-0">Competitive rates with no hidden charges</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Description -->
            <div class="card shadow-sm border-0 my-4">
                <div class="card-body p-4">
                    <!-- <h3 class="fw-bold mb-3">About This Vehicle</h3> -->
                    <div class="text-dark content-html">{!! $vehicle->description !!}</div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Booking Card -->
            <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h2 class="fw-bold text-primary mb-0">₹{{ number_format($vehicle->price_per_km, 0) }}</h2>
                        <small class="text-muted">per kilometer</small>
                    </div>

                    @if($vehicle->is_available)
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle me-2"></i>This vehicle is available
                        </div>

                        <form action="{{ route('cab-enquiry.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                                @include('components.enquiry-form')
                        </form>
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>This vehicle is currently not available
                        </div>
                        <a href="{{ route('vehicles.index') }}" class="btn btn-outline-primary w-100">
                            View Other Vehicles
                        </a>
                    @endif

                    <div class="mt-4 pt-4 border-top">
                        <h6 class="fw-bold mb-3">Included in Price</h6>
                        <div class="d-flex align-items-start mb-2">
                            <i class="bi bi-check text-success me-2"></i>
                            <small>Professional Driver</small>
                        </div>
                        <div class="d-flex align-items-start mb-2">
                            <i class="bi bi-check text-success me-2"></i>
                            <small>Fuel Charges</small>
                        </div>
                        <div class="d-flex align-items-start mb-2">
                            <i class="bi bi-check text-success me-2"></i>
                            <small>Toll Charges</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
