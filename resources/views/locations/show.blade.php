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
@php
    $faqs = $location->faqs()->where('is_active', true)->orderBy('order')->get();
    $otherLocations = \App\Models\Location::where('is_active', true)
        ->where('id', '!=', $location->id)
        ->orderBy('title')
        ->limit(8)
        ->get();

    $rawContent = (string) ($location->content ?? '');
    $rawContent = html_entity_decode($rawContent, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $rawContent = preg_replace('/<p[^>]*>(?:\s|&nbsp;|\x{00A0}|<br\s*\/?>)*<\/p>/iu', '', $rawContent);
    $rawContent = preg_replace('/<h[1-6][^>]*>(?:\s|&nbsp;|\x{00A0}|<br\s*\/?>)*<\/h[1-6]>/iu', '', $rawContent);
    $rawContent = preg_replace('/<div[^>]*>(?:\s|&nbsp;|\x{00A0}|<br\s*\/?>)*<\/div>/iu', '', $rawContent);
    $rawContent = preg_replace('/<span[^>]*>(?:\s|&nbsp;|\x{00A0}|<br\s*\/?>)*<\/span>/iu', '', $rawContent);
    $rawContent = trim((string) $rawContent);

    $parts = preg_split('/(<h[1-6][^>]*>.*?<\/h[1-6]>)/is', $rawContent, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    $contentSections = [];
    $currentSection = null;
    foreach ($parts as $part) {
        if (preg_match('/^<h[1-6][^>]*>.*<\/h[1-6]>$/is', trim($part))) {
            if ($currentSection && trim((string) $currentSection['body']) !== '') {
                $contentSections[] = $currentSection;
            }
            $currentSection = ['heading' => $part, 'body' => ''];
        } else {
            if (!$currentSection) {
                $currentSection = ['heading' => null, 'body' => ''];
            }
            $currentSection['body'] .= $part;
        }
    }
    if ($currentSection && trim((string) $currentSection['body']) !== '') {
        $contentSections[] = $currentSection;
    }

    $topSections = array_slice($contentSections, 0, 2);
    $middleSections = array_slice($contentSections, 2, 2);
    $remainingSections = array_slice($contentSections, 4);
@endphp

<section class="location-page">
    <section class="location-hero position-relative overflow-hidden">
        @if($location->image)
            <img src="{{ asset($location->image) }}" alt="{{ $location->title }}" class="hero-image w-100 h-100">
        @else
            <div class="hero-image w-100 h-100 bg-dark"></div>
        @endif
        <div class="hero-overlay"></div>
        <div class="container position-relative py-5">
            <div class="row">
                <div class="col-lg-9 text-white py-5">
                    <span class="loc-chip mb-3">Location Guide</span>
                    <h1 class="loc-title mb-3">{{ $location->title }} Cab Service</h1>
                    <p class="loc-subtitle mb-4">
                        Local city rides, outstation trips, airport transfers and custom travel routes with fast support.
                    </p>
                    <div class="loc-pills">
                        <span><i class="bi bi-taxi-front me-2"></i>City Rides</span>
                        <span><i class="bi bi-geo-alt me-2"></i>Outstation</span>
                        <span><i class="bi bi-shield-check me-2"></i>Trusted Drivers</span>
                        <span><i class="bi bi-headset me-2"></i>Quick Assistance</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid detail-wide my-5">
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-xxl-11">
                <div class="loc-highlight-grid mb-4">
                    <div class="loc-highlight-card">
                        <i class="bi bi-clock-history"></i>
                        <h6>Fast Pickup</h6>
                        <p>Timely pickup with route-aware drivers.</p>
                    </div>
                    <div class="loc-highlight-card">
                        <i class="bi bi-currency-rupee"></i>
                        <h6>Fair Pricing</h6>
                        <p>Transparent rates with clear billing.</p>
                    </div>
                    <div class="loc-highlight-card">
                        <i class="bi bi-stars"></i>
                        <h6>Clean Vehicles</h6>
                        <p>Regularly sanitized and maintained fleet.</p>
                    </div>
                    <div class="loc-highlight-card">
                        <i class="bi bi-person-check"></i>
                        <h6>Verified Team</h6>
                        <p>Professional and experienced chauffeurs.</p>
                    </div>
                </div>

                @if(!empty($topSections))
                    <div class="content-card mb-4 loc-about">
                        <h3 class="section-title mb-3">About {{ $location->title }}</h3>
                        <div class="prose-content clean-content">
                            @foreach($topSections as $section)
                                @if(!empty($section['heading'])){!! $section['heading'] !!}@endif
                                {!! $section['body'] !!}
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <img src="{{ $location->image ? asset($location->image) : asset('images/why-choose-us.webp') }}" alt="{{ $location->title }}" class="static-showcase-img">
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('images/hero-slider-2.jpg') }}" alt="Cab service support" class="static-showcase-img">
                    </div>
                </div>

                @if(!empty($middleSections))
                    <div class="content-card mb-4">
                        <h3 class="section-title mb-3">Travel Insights</h3>
                        <div class="prose-content clean-content">
                            @foreach($middleSections as $section)
                                @if(!empty($section['heading'])){!! $section['heading'] !!}@endif
                                {!! $section['body'] !!}
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="content-card h-100 loc-faq">
                            <h3 class="section-title mb-3">Frequently Asked Questions</h3>
                            @if($faqs->count())
                                <div class="accordion faq-accordion" id="faqAccordion">
                                    @foreach($faqs as $faq)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                                    {{ $faq->question }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">{{ $faq->answer }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mb-0">No FAQs available for this location.</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="content-card h-100 loc-enquiry">
                            <h4 class="section-title mb-2">Quick Enquiry</h4>
                            <p class="text-muted small mb-3">Trip details share karein, team turant contact karegi.</p>
                            @include('components.enquiry-form')
                        </div>
                    </div>
                </div>

                <div class="content-card mt-4">
                    <h5 class="fw-bold mb-3">Recommended Locations</h5>
                    <div class="row g-2">
                        @forelse($otherLocations as $loc)
                            <div class="col-md-6 col-lg-4">
                                <a href="{{ url('/locations/' . $loc->slug) }}" class="location-link text-decoration-none">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span>{{ $loc->title }}</span>
                                </a>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No other locations found.</p>
                        @endforelse
                    </div>
                </div>

                @if(!empty($remainingSections))
                    <div class="content-card mt-4">
                        <h5 class="fw-bold mb-3">More About {{ $location->title }}</h5>
                        <div class="prose-content clean-content">
                            @foreach($remainingSections as $section)
                                @if(!empty($section['heading'])){!! $section['heading'] !!}@endif
                                {!! $section['body'] !!}
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@include('components.detail-page-styles')
<style>
    a{color:rgb(255 193 7);}
    .location-page { background: linear-gradient(180deg, #f3f7ff 0%, #ffffff 34%); }
    .location-page .location-hero { min-height: 500px; border-bottom-left-radius: 26px; border-bottom-right-radius: 26px; }
    .loc-chip { display: inline-flex; align-items: center; background: #fff; color: #0f2343; border-radius: 999px; padding: .38rem .9rem; font-weight: 600; font-size: .88rem; }
    .loc-title { font-size: clamp(2rem, 4.2vw, 3.35rem); font-weight: 700; line-height: 1.1; }
    .loc-subtitle { max-width: 760px; font-size: 1.1rem; color: rgba(255,255,255,.93); line-height: 1.68; }
    .loc-pills { display: flex; flex-wrap: wrap; gap: .65rem; }
    .loc-pills span { background: rgba(255,255,255,.18); border: 1px solid rgba(255,255,255,.3); border-radius: 10px; padding: .5rem .75rem; font-size: .92rem; }
    .loc-highlight-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
    .loc-highlight-card {
        position: relative;
        background: #fff;
        border: 1px solid #e7edf8;
        border-radius: 16px;
        padding: 18px;
        box-shadow: 0 12px 28px rgba(20,33,61,.06);
        transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
        overflow: hidden;
    }
    .loc-highlight-card::after {
        content: "";
        position: absolute;
        inset: auto 0 0 0;
        height: 3px;
        background: linear-gradient(90deg, #0d6efd, #34b3ff);
        opacity: .75;
    }
    .loc-highlight-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 30px rgba(13, 49, 122, .13);
        border-color: #cfe0ff;
    }
    .loc-highlight-card i {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 1rem;
        margin-bottom: 10px;
    }
    .loc-highlight-card h6 { margin: 0 0 6px; font-weight: 700; color: #0f2343; font-size: 1.02rem; }
    .loc-highlight-card p { margin: 0; color: #5d6b84; font-size: .92rem; line-height: 1.55; }
    .loc-highlight-card:nth-child(1) { background: linear-gradient(135deg, #ffffff, #f4f8ff); }
    .loc-highlight-card:nth-child(1) i { background: #e9f2ff; color: #0d6efd; }
    .loc-highlight-card:nth-child(2) { background: linear-gradient(135deg, #ffffff, #f7f7ff); }
    .loc-highlight-card:nth-child(2) i { background: #ecebff; color: #5b4df3; }
    .loc-highlight-card:nth-child(3) { background: linear-gradient(135deg, #ffffff, #f4fbf8); }
    .loc-highlight-card:nth-child(3) i { background: #e8f8f1; color: #0f9d68; }
    .loc-highlight-card:nth-child(4) { background: linear-gradient(135deg, #ffffff, #fff8f4); }
    .loc-highlight-card:nth-child(4) i { background: #ffefe4; color: #f06d1c; }
    .loc-about { border-left: 4px solid #0d6efd; }
    .loc-enquiry { background: linear-gradient(180deg, #fff 0%, #f8fbff 100%); }
    .loc-faq .accordion-button { font-size: .97rem; }
    .location-link {
        display: flex;
        align-items: center;
        gap: .58rem;
        padding: .78rem .9rem;
        border-radius: 12px;
        border: 1px solid #e7edf8;
        background: linear-gradient(135deg, #ffffff, #f8fbff);
        color: #1d2f4f;
        transition: all .2s ease;
        box-shadow: 0 6px 14px rgba(20,33,61,.04);
    }
    .location-link i {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #e8f1ff;
        color:rgba(37, 34, 0, 0.82);
        font-size: .8rem;
    }
    .location-link span { font-weight: 500; }
    .location-link:hover {
        transform: translateY(-2px);
        border-color: #cfe0ff;
        box-shadow: 0 10px 18px rgba(13, 49, 122, .1);
        background: linear-gradient(135deg, #ffffff, #eef6ff);
    }
    .clean-content p:empty,
    .clean-content h1:empty,
    .clean-content h2:empty,
    .clean-content h3:empty,
    .clean-content h4:empty,
    .clean-content h5:empty,
    .clean-content h6:empty,
    .clean-content div:empty,
    .clean-content span:empty { display: none !important; margin: 0 !important; padding: 0 !important; }
    .clean-content p { margin-bottom: .8rem; }
    .clean-content h2,
    .clean-content h3,
    .clean-content h4 { margin-top: 1.15rem; margin-bottom: .6rem; }
    @media (max-width: 991.98px) {
        .location-page .location-hero { min-height: 430px; border-radius: 0; }
        .loc-highlight-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 575.98px) {
        .loc-highlight-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection
