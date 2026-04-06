@extends('layout.app')
@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4 text-center">All Locations</h1>
    <div class="row g-4">
        @forelse($locations as $location)
            <div class="col-md-4 col-12">
                <div class="card h-100 shadow-sm">
                    <a href="{{ url('/locations/'.$location->slug) }}">
                        @if($location->image)
                            <img src="{{ asset('storage/'.$location->image) }}" class="card-img-top" alt="{{ $location->title }}">
                        @endif
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ url('/locations/'.$location->slug) }}" class="text-decoration-none text-dark">{{ $location->title }}</a>
                        </h5>
                        <p class="card-text small text-secondary">{{ Str::limit(strip_tags($location->content), 100) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No locations found.</div>
        @endforelse
    </div>
</div>
@endsection
