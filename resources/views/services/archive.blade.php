@extends('layout.app')
@section('meta')
    <title>Tour Packages - Gurgaon Cab</title>
    <meta name="description" content="Explore our curated tour packages and services.">
    <link rel="canonical" href="{{ url()->current() }}">
@endsection
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
<section class="hero-section position-relative w-100" style="background: linear-gradient(rgba(34,34,34,0.6),rgba(34,34,34,0.6)), url('{{ asset('images/banner5.webp') }}') center center / cover no-repeat; min-height: 300px;">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 300px;">
        <div class="text-center text-white">
            <h1 class="display-3 fw-bold mb-3">Tour Packages & Services</h1>
            <p class="lead">Explore our curated tour packages and services for your next journey</p>
        </div>
    </div>
</section>
<div class="container py-5">
    <h1 class="fw-bold mb-4 d-none">Tour Packages & Services</h1>
    <div class="row">
        @foreach($services as $service)
        <div class="col-md-4 mb-4">
            <div class="package-card card h-100 border-0 shadow-sm position-relative overflow-hidden" style="transition: box-shadow .3s;">
                <div class="position-relative">
                    <img src="{{ $service->feature_image }}" class="card-img-top" alt="{{ $service->title }}" style="height:220px; object-fit:cover;">
                    @if($service->is_popular)
                        <span class="position-absolute top-0 start-0 badge bg-warning text-dark m-2">⭐ Popular</span>
                    @endif
                </div>
                <div class="card-body d-flex flex-column">
                    <a href="{{ route('service.details', $service->slug) }}" class="stretched-link text-decoration-none">
                        <h5 class="card-title fw-bold text-primary mb-2" style="transition: color .2s;">{{ $service->title }}</h5>
                    </a>
                    <div class="mb-3 text-muted small" style="min-height:48px;">
                        {{ Str::limit(strip_tags($service->description), 120) }}
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('service.details', $service->slug) }}" class="btn btn-outline-primary w-100 fw-bold" style="border-radius:30px;">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $services->links() }}
</div>
<style>
.package-card:hover {
    box-shadow: 0 6px 24px rgba(34,34,34,0.18);
}
.package-card .card-title:hover {
    color: #ffc107;
}
</style>
@endsection
