@extends('layout.app')

@section('content')
@section('meta')
    <title>{{ $route->meta_title ?? $route->name ?? 'Route Details' }}</title>
    @if(!empty($route->meta_description))
        <meta name="description" content="{{ $route->meta_description }}">
    @endif
    @if(!empty($route->meta_keywords))
        <meta name="keywords" content="{{ $route->meta_keywords }}">
    @endif
    @if(!empty($route->meta_canonical))
        <link rel="canonical" href="{{ $route->meta_canonical }}">
    @endif
@endsection
<!-- Route Hero -->
<div class="position-relative" style="height: 300px; overflow: hidden;">
    <img src="{{ $route->image }}" alt="{{ $route->name }}" 
         class="w-100 h-100" style="object-fit: cover;">
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.8));">
        <div class="container h-100 d-flex align-items-center pb-5">
            <div class="text-white">
                @if($route->is_popular)
                    <span class="badge bg-warning text-dark mb-3">⭐ Popular Route</span>
                @endif
                <h1 class="display-4 fw-bold mb-3">{{ $route->name }}</h1>
                <div class="d-flex align-items-center gap-4 fs-5">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-geo-alt me-2"></i>
                        <span>{{ $route->from_location }}</span>
                    </div>
                    <div>
                        <i class="bi bi-arrow-right-circle me-2"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        <span>{{ $route->to_location }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Quick Info -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <i class="bi bi-speedometer2 fs-3 text-primary me-3"></i>
                                <div>
                                    <div class="small text-muted">Distance</div>
                                    <div class="fw-bold">{{ $route->distance }} km</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <i class="bi bi-clock fs-3 text-primary me-3"></i>
                                <div>
                                    <div class="small text-muted">Duration</div>
                                    <div class="fw-bold">{{ $route->duration }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Highlights -->
            @if($route->highlights)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-3"><i class="bi bi-star text-warning me-2"></i>Route Highlights</h3>
                        <div class="row g-3">
                            @foreach(explode("\n", $route->highlights) as $highlight)
                                @if(trim($highlight))
                                    <div class="col-md-12">
                                        <div class="d-flex">
                                            <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                            <span>{{ trim($highlight) }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Key Stops -->
            @if($route->key_stops)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-3"><i class="bi bi-geo me-2"></i>Key Stops Along The Way</h3>
                        <div class="list-group list-group-flush">
                            @foreach(explode("\n", $route->key_stops) as $index => $stop)
                                @if(trim($stop))
                                    <div class="list-group-item px-0 border-0 border-bottom">
                                        <div class="d-flex align-items-start">
                                            <span class="badge bg-primary me-3" style="width: 30px;">{{ $index + 1 }}</span>
                                            <span>{{ trim($stop) }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Best Time to Visit -->
            @if($route->best_season)
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-3"><i class="bi bi-calendar3 me-2"></i>Best Time to Travel</h3>
                        <div class="alert alert-info d-flex align-items-center">
                            <i class="bi bi-sun fs-4 me-3"></i>
                            <div>
                                <strong>Recommended Season:</strong> {{ $route->best_season }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Description -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <!-- <h3 class="fw-bold mb-3">About This Route</h3> -->
                    <div class="text-muted">{!! $route->description !!}</div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Booking Card -->
            <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Plan Your Journey</h5>

                    <!-- Enquiry form removed: cab-only site -->
                     @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="cab-booking-form-wrapper  bg-white">
                        <form method="POST" action="{{ route('cab-enquiry.store') }}">
                            @include('components.enquiry-form')
                    </div>

                    <div class="mt-4 pt-4 border-top">
                        <h6 class="fw-bold mb-3">What's Included</h6>
                        <div class="d-flex align-items-start mb-2">
                            <i class="bi bi-check text-success me-2"></i>
                            <small>Comfortable Vehicle</small>
                        </div>
                        <div class="d-flex align-items-start mb-2">
                            <i class="bi bi-check text-success me-2"></i>
                            <small>Experienced Driver</small>
                        </div>
                        <div class="d-flex align-items-start mb-2">
                            <i class="bi bi-check text-success me-2"></i>
                            <small>Fuel & Toll Charges</small>
                        </div>
                        <div class="d-flex align-items-start mb-2">
                            <i class="bi bi-check text-success me-2"></i>
                            <small>24/7 Support</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
