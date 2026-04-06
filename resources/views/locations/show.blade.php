@extends('layout.app')

@push('meta')
    <title>{{ $location->meta_title ?? $location->title ?? 'Location Details' }}</title>
    @if(!empty($location->meta_description))
        <meta name="description" content="{{ $location->meta_description }}">
    @endif
    @if(!empty($location->meta_keywords))
        <meta name="keywords" content="{{ $location->meta_keywords }}">
    @endif
    @if(!empty($location->meta_canonical))
        <link rel="canonical" href="{{ $location->meta_canonical }}">
    @endif
@endpush

@section('content')
<!-- Location Hero -->
<div class="position-relative" style="height: 400px; overflow: hidden;">
    @if($location->image)
        <img src="{{ asset($location->image) }}" alt="{{ $location->title }}" class="w-100 h-100" style="object-fit: cover;">
    @else
        <div class="bg-secondary w-100 h-100"></div>
    @endif
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));">
        <div class="container h-100 d-flex align-items-center pb-5">
            <div class="text-white">
                <h1 class="display-4 fw-bold mb-3">{{ $location->title }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="text-dark" style="text-align: justify;">{!! $location->content !!}</div>
                </div>
            </div>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-question-circle text-primary me-2"></i>Frequently Asked Questions</h5>
                    @php $faqs = $location->faqs()->where('is_active', true)->orderBy('order')->get(); @endphp
                    @if($faqs->count())
                        <div class="accordion" id="faqAccordion">
                            @foreach($faqs as $faq)
                                <div class="accordion-item mb-2">
                                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">{!! nl2br(e($faq->answer)) !!}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-muted">No FAQs available for this location.</div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Shared Cab Enquiry Form -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="fw-bold mb-3"><i class="bi bi-chat-dots text-primary me-2"></i>Quick Enquiry</h5>
                    </div>
                    @include('components.enquiry-form')
                 </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt text-primary me-2"></i>Other Locations</h5>
                    <ul class="list-unstyled mb-0">
                        @php
                            $otherLocations = \App\Models\Location::where('is_active', true)->where('id', '!=', $location->id)->orderBy('title')->limit(6)->get();
                        @endphp
                        @forelse($otherLocations as $loc)
                            <li class="mb-2">
                                <a href="{{ url('/locations/'.$loc->slug) }}" class="text-decoration-none text-dark">
                                    <i class="bi bi-chevron-right small text-primary"></i> {{ $loc->title }}
                                </a>
                            </li>
                        @empty
                            <li class="text-muted small">No other locations.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div>
<style>
.card-body img{
    width:100%;
}
</style>
@endsection
