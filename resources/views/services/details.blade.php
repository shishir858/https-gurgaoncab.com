@extends('layout.app')

@section('content')
@section('meta')
	<title>{{ $service->meta_title ?? $service->name ?? 'Service Details' }}</title>
	@if(!empty($service->meta_description))
		<meta name="description" content="{{ $service->meta_description }}">
	@endif
	@if(!empty($service->meta_keywords))
		<meta name="keywords" content="{{ $service->meta_keywords }}">
	@endif
	@if(!empty($service->meta_canonical))
		<link rel="canonical" href="{{ $service->meta_canonical }}">
	@endif
@endsection
@php
    $amenities = json_decode($service->amenities ?? '[]', true) ?: [];
    $highlights = array_values(array_filter(array_map(function ($line) {
        $line = html_entity_decode(strip_tags((string) $line), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $line = preg_replace('/[\x{00A0}\s]+/u', ' ', $line);
        return trim($line);
    }, preg_split('/\r?\n/', (string) $service->highlights))));
    $keyFeatures = array_values(array_filter(array_map(function ($line) {
        $line = html_entity_decode(strip_tags((string) $line), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $line = preg_replace('/[\x{00A0}\s]+/u', ' ', $line);
        return trim($line);
    }, preg_split('/\r?\n/', (string) $service->key_features))));
    $includedItems = array_values(array_filter(array_map(function ($line) {
        $line = html_entity_decode(strip_tags((string) $line), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $line = preg_replace('/[\x{00A0}\s]+/u', ' ', $line);
        return trim($line);
    }, preg_split('/\r?\n/', (string) $service->included))));
    $excludedItems = array_values(array_filter(array_map(function ($line) {
        $line = html_entity_decode(strip_tags((string) $line), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $line = preg_replace('/[\x{00A0}\s]+/u', ' ', $line);
        return trim($line);
    }, preg_split('/\r?\n/', (string) $service->excluded))));
    $itineraryPlain = html_entity_decode(strip_tags((string) $service->itinerary), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $itineraryPlain = preg_replace('/[\x{00A0}\s]+/u', ' ', $itineraryPlain);
    preg_match_all('/(Day\s*\d+\s*:\s*.*?)(?=Day\s*\d+\s*:|$)/i', $itineraryPlain, $itineraryMatches);
    $itineraryItems = !empty($itineraryMatches[1])
        ? array_values(array_filter(array_map(function ($line) {
            return trim($line, " \t\n\r\0\x0B-:");
        }, $itineraryMatches[1])))
        : array_values(array_filter(array_map(function ($line) {
            $line = html_entity_decode(strip_tags((string) $line), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $line = preg_replace('/[\x{00A0}\s]+/u', ' ', $line);
            return trim($line, " \t\n\r\0\x0B-:");
        }, preg_split('/\r?\n/', (string) $service->itinerary))));
    $recommendedServices = \App\Models\Service::where('is_active', true)
        ->where('id', '!=', $service->id)
        ->inRandomOrder()
        ->limit(8)
        ->get();

    $rawServiceContent = html_entity_decode((string) ($service->description ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8')
        . ($service->more_contents ? ('<h3>More Information</h3>' . html_entity_decode((string) $service->more_contents, ENT_QUOTES | ENT_HTML5, 'UTF-8')) : '');
    $rawServiceContent = preg_replace('/<p[^>]*>(?:\s|&nbsp;|\x{00A0}|<br\s*\/?>)*<\/p>/iu', '', $rawServiceContent);
    $rawServiceContent = preg_replace('/<h[1-6][^>]*>(?:\s|&nbsp;|\x{00A0}|<br\s*\/?>)*<\/h[1-6]>/iu', '', $rawServiceContent);
    $rawServiceContent = trim((string) $rawServiceContent);

    $serviceParts = preg_split('/(<h[1-6][^>]*>.*?<\/h[1-6]>)/is', $rawServiceContent, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    $serviceSections = [];
    $currentServiceSection = null;
    foreach ($serviceParts as $part) {
        if (preg_match('/^<h[1-6][^>]*>.*<\/h[1-6]>$/is', trim($part))) {
            if ($currentServiceSection && trim((string) $currentServiceSection['body']) !== '') {
                $serviceSections[] = $currentServiceSection;
            }
            $currentServiceSection = ['heading' => $part, 'body' => ''];
        } else {
            if (!$currentServiceSection) {
                $currentServiceSection = ['heading' => null, 'body' => ''];
            }
            $currentServiceSection['body'] .= $part;
        }
    }
    if ($currentServiceSection && trim((string) $currentServiceSection['body']) !== '') {
        $serviceSections[] = $currentServiceSection;
    }
    $topServiceSections = array_slice($serviceSections, 0, 2);
    $midServiceSections = array_slice($serviceSections, 2, 2);
    $remainingServiceSections = array_slice($serviceSections, 4);
@endphp

<section class="service-page">
<section class="service-hero position-relative overflow-hidden">
    <img src="{{ asset($service->feature_image) }}" alt="{{ $service->title }}" class="hero-image w-100 h-100">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="row">
            <div class="col-lg-9 text-white py-5">
                @if($service->is_popular)
                    <span class="badge rounded-pill bg-warning text-dark px-3 py-2 mb-3">Popular Service</span>
                @endif
                <h1 class="hero-title mb-3">{{ $service->title }}</h1>
                <p class="lead mb-4 text-light-emphasis">
                    Premium cab service experience with trusted drivers, cleaner vehicles, and real support.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    @if($service->duration)
                        <span class="hero-pill"><i class="bi bi-clock me-2"></i>{{ $service->duration }}</span>
                    @endif
                    <span class="hero-pill"><i class="bi bi-shield-check me-2"></i>Verified Service</span>
                    <span class="hero-pill"><i class="bi bi-headset me-2"></i>24/7 Assistance</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid detail-wide my-5">
    <div class="row g-4 justify-content-center">
        <div class="col-12 col-xxl-11">
            <div class="service-highlight-grid mb-4">
                <div class="service-highlight-card">
                    <i class="bi bi-patch-check"></i>
                    <h6>Trusted Operators</h6>
                    <p>Verified team and quality-checked service process.</p>
                </div>
                <div class="service-highlight-card">
                    <i class="bi bi-currency-rupee"></i>
                    <h6>Transparent Pricing</h6>
                    <p>Clear fare communication with no hidden surprises.</p>
                </div>
                <div class="service-highlight-card">
                    <i class="bi bi-geo-alt"></i>
                    <h6>Flexible Routes</h6>
                    <p>Custom pickup/drop plans based on your schedule.</p>
                </div>
                <div class="service-highlight-card">
                    <i class="bi bi-headset"></i>
                    <h6>Always Support</h6>
                    <p>Quick response team for plan changes and updates.</p>
                </div>
            </div>

            @if(!empty($amenities))
                <div class="content-card mb-4">
                    <h3 class="section-title mb-3">Service Amenities</h3>
                    <div class="row g-3">
                        @php
                            $amenityIcons = ['bi-stars', 'bi-shield-check', 'bi-car-front', 'bi-cup-hot', 'bi-geo-alt', 'bi-emoji-smile', 'bi-camera', 'bi-suitcase-lg'];
                            $amenityThemes = ['theme-blue', 'theme-indigo', 'theme-green', 'theme-orange', 'theme-cyan', 'theme-pink', 'theme-purple', 'theme-dark'];
                        @endphp
                        @foreach($amenities as $index => $amenity)
                            <div class="col-sm-6 col-md-2">
                                <div class="amenity-box amenity-card {{ $amenityThemes[$index % count($amenityThemes)] }}">
                                    <i class="bi {{ $amenityIcons[$index % count($amenityIcons)] }}"></i>
                                    <span>{{ $amenity }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(!empty($highlights))
                <div class="content-card mb-4">
                    <h3 class="section-title mb-3">Highlights</h3>
                    <div class="row g-3 highlight-grid">
                        @foreach($highlights as $index => $highlight)
                            <div class="col-md-6">
                                <div class="highlight-item">
                                    <span class="highlight-no">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                    <p class="mb-0">{{ $highlight }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(!empty($topServiceSections))
                <div class="content-card mb-4">
                    <h3 class="section-title mb-3">Service Details</h3>
                    <div class="prose-content clean-content">
                        @foreach($topServiceSections as $section)
                            @if(!empty($section['heading'])){!! $section['heading'] !!}@endif
                            {!! $section['body'] !!}
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <img src="{{ asset($service->feature_image) }}" alt="{{ $service->title }}" class="static-showcase-img">
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/why-choose-us.webp') }}" alt="Why choose us" class="static-showcase-img">
                </div>
            </div>

            @if(!empty($midServiceSections))
                <div class="content-card mb-4">
                    <h3 class="section-title mb-3">Trip Information</h3>
                    <div class="prose-content clean-content">
                        @foreach($midServiceSections as $section)
                            @if(!empty($section['heading'])){!! $section['heading'] !!}@endif
                            {!! $section['body'] !!}
                        @endforeach
                    </div>
                </div>
            @endif

            @if(!empty($keyFeatures))
                <div class="content-card mb-4">
                    <h3 class="section-title mb-3">Key Features</h3>
                    <ul class="styled-list mb-0">
                        @foreach($keyFeatures as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4">
                @if(!empty($includedItems))
                    <div class="col-md-6">
                        <div class="content-card h-100">
                            <h3 class="section-title text-success mb-3">Included</h3>
                            <ul class="styled-list styled-list-success mb-0">
                                @foreach($includedItems as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                @if(!empty($excludedItems))
                    <div class="col-md-6">
                        <div class="content-card h-100">
                            <h3 class="section-title text-danger mb-3">Excluded</h3>
                            <ul class="styled-list styled-list-danger mb-0">
                                @foreach($excludedItems as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

            @if(!empty($itineraryItems))
                <div class="content-card mt-4">
                    <h3 class="section-title mb-3">Travel Plan / Itinerary</h3>
                    <ul class="timeline-list timeline-badges mb-0">
                        @foreach($itineraryItems as $item)
                            <li>
                                @php
                                    preg_match('/^Day\s*(\d+)\s*:\s*(.*)$/i', $item, $dayParts);
                                    $dayLabel = $dayParts[1] ?? null;
                                    $dayText = $dayParts[2] ?? $item;
                                @endphp
                                <span class="day-pill">{{ $dayLabel ? 'Day ' . $dayLabel : 'Day' }}</span>
                                <span>{{ $dayText }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4 mt-1">
                <div class="col-lg-6">
                    <div class="content-card h-100 plan-trip-card">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4 class="section-title mb-0">Plan Your Trip</h4>
                            <span class="plan-trip-badge">Instant Help</span>
                        </div>
                        <p class="text-muted mb-3">Quick enquiry bhejiye, team aapko cab options, pricing aur confirmation details share karegi.</p>
                        <div class="row g-2 mb-3">
                            <div class="col-6"><div class="plan-mini">Quick Callback</div></div>
                            <div class="col-6"><div class="plan-mini">Custom Route</div></div>
                            <div class="col-6"><div class="plan-mini">Driver Support</div></div>
                            <div class="col-6"><div class="plan-mini">Fare Clarity</div></div>
                        </div>
                        <a href="#recommendedServicesCarousel" class="plan-btn text-decoration-none">Explore Packages</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="content-card h-100">
                        <h4 class="section-title mb-3">Quick Enquiry</h4>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @include('components.enquiry-form')
                    </div>
                </div>
            </div>

            @if($service->best_time)
                <div class="content-card mt-4">
                    <h5 class="fw-bold mb-2">Best Time To Avail</h5>
                    <p class="mb-0 text-muted">{{ $service->best_time }}</p>
                </div>
            @endif

            <div class="content-card mt-4">
                <h5 class="fw-bold mb-3">Recommended Services</h5>
                @if($recommendedServices->count())
                    <div id="recommendedServicesCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
                        <div class="carousel-inner">
                            @foreach($recommendedServices as $index => $recService)
                                @php
                                    $a = $recommendedServices[$index];
                                    $b = $recommendedServices[($index + 1) % $recommendedServices->count()];
                                    $c = $recommendedServices[($index + 2) % $recommendedServices->count()];
                                @endphp
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="row g-3">
                                        @foreach([$a, $b, $c] as $cardIndex => $cardService)
                                            <div class="col-12 col-md-4 {{ $cardIndex > 0 ? 'd-none d-md-block' : '' }}">
                                                <div class="service-card-slide h-100">
                                                    <img src="{{ asset($cardService->feature_image) }}" alt="{{ $cardService->title }}">
                                                    <div class="p-3">
                                                        <h6>{{ $cardService->title }}</h6>
                                                        <small>{{ $cardService->duration ?: 'Custom duration available' }}</small><br>
                                                        <a href="{{ route('service.details', $cardService->slug) }}" class="small fw-semibold text-decoration-none">View details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#recommendedServicesCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#recommendedServicesCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                @else
                    <p class="text-muted mb-0">No recommended services found.</p>
                @endif
            </div>

            @if(!empty($remainingServiceSections))
                <div class="content-card mt-4">
                    <h5 class="fw-bold mb-3">More Service Information</h5>
                    <div class="prose-content clean-content">
                        @foreach($remainingServiceSections as $section)
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
    .service-page { background: linear-gradient(180deg, #f3f7ff 0%, #ffffff 34%); }
    .service-page .service-hero { min-height: 500px; border-bottom-left-radius: 26px; border-bottom-right-radius: 26px; }
    .service-highlight-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
    .service-highlight-card { background: #fff; border: 1px solid #e7edf8; border-radius: 16px; padding: 18px; box-shadow: 0 12px 28px rgba(20,33,61,.06); transition: .22s ease; }
    .service-highlight-card:hover { transform: translateY(-4px); box-shadow: 0 16px 30px rgba(13, 49, 122, .13); border-color: #cfe0ff; }
    .service-highlight-card i { width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 1rem; margin-bottom: 10px; }
    .service-highlight-card h6 { margin: 0 0 6px; font-weight: 700; color: #0f2343; font-size: 1.02rem; }
    .service-highlight-card p { margin: 0; color: #5d6b84; font-size: .92rem; line-height: 1.55; }
    .service-highlight-card:nth-child(1) { background: linear-gradient(135deg, #ffffff, #f4f8ff); }
    .service-highlight-card:nth-child(1) i { background: #e9f2ff; color: #0d6efd; }
    .service-highlight-card:nth-child(2) { background: linear-gradient(135deg, #ffffff, #f7f7ff); }
    .service-highlight-card:nth-child(2) i { background: #ecebff; color: #5b4df3; }
    .service-highlight-card:nth-child(3) { background: linear-gradient(135deg, #ffffff, #f4fbf8); }
    .service-highlight-card:nth-child(3) i { background: #e8f8f1; color: #0f9d68; }
    .service-highlight-card:nth-child(4) { background: linear-gradient(135deg, #ffffff, #fff8f4); }
    .service-highlight-card:nth-child(4) i { background: #ffefe4; color: #f06d1c; }
    .amenity-card { min-height: 92px; border-radius: 14px; border-width: 1px; }
    .amenity-card i { width: 34px; height: 34px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 1rem; }
    .amenity-card span { font-size: .9rem; line-height: 1.35; }
    .amenity-card.theme-blue { background: linear-gradient(135deg, #eef6ff, #f8fbff); border-color: #d5e6ff; }
    .amenity-card.theme-blue i { background: #dfeeff; color: #0d6efd; }
    .amenity-card.theme-indigo { background: linear-gradient(135deg, #f2f1ff, #fbfaff); border-color: #dfdcff; }
    .amenity-card.theme-indigo i { background: #e4e1ff; color: #5748ee; }
    .amenity-card.theme-green { background: linear-gradient(135deg, #eefaf5, #f9fdfb); border-color: #d8f2e6; }
    .amenity-card.theme-green i { background: #ddf5ea; color: #0f9d68; }
    .amenity-card.theme-orange { background: linear-gradient(135deg, #fff6ee, #fffdfa); border-color: #ffe4ce; }
    .amenity-card.theme-orange i { background: #ffe8d5; color: #ec6b17; }
    .amenity-card.theme-cyan { background: linear-gradient(135deg, #eefcff, #f9feff); border-color: #d5f1f8; }
    .amenity-card.theme-cyan i { background: #ddf4fb; color: #0a8db3; }
    .amenity-card.theme-pink { background: linear-gradient(135deg, #fff1f7, #fffafb); border-color: #ffddea; }
    .amenity-card.theme-pink i { background: #ffe3ef; color: #d9448f; }
    .amenity-card.theme-purple { background: linear-gradient(135deg, #f5f1ff, #fcfbff); border-color: #e6dcff; }
    .amenity-card.theme-purple i { background: #ece4ff; color: #7d47e6; }
    .amenity-card.theme-dark { background: linear-gradient(135deg, #f3f5f8, #fbfcfd); border-color: #dce2ea; }
    .amenity-card.theme-dark i { background: #e5eaf1; color: #425466; }
    .highlight-grid .highlight-item { background: linear-gradient(135deg, #fff, #f8fbff); border: 1px solid #e5edf9; border-radius: 14px; padding: 14px; height: 100%; display: flex; align-items: flex-start; gap: 12px; box-shadow: 0 8px 20px rgba(20,33,61,.05); }
    .highlight-no { min-width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #e8f0ff, #f0f6ff); color: #0d4fc2; font-weight: 700; font-size: .88rem; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #d8e4fb; }
    .highlight-item p { color: #344054; line-height: 1.6; font-size: .95rem; }
    .plan-trip-card { background: linear-gradient(135deg, #ffffff, #f5f9ff); border-color: #dce8fb; }
    .plan-trip-badge { background: linear-gradient(135deg, #0d6efd, #35a1ff); color: #fff; font-size: .78rem; padding: .26rem .62rem; border-radius: 999px; font-weight: 600; letter-spacing: .2px; }
    .plan-mini { background: #fff; border: 1px solid #e4ecfb; color: #254267; border-radius: 10px; padding: .48rem .6rem; font-size: .84rem; font-weight: 500; text-align: center; }
    .plan-btn { display: inline-flex; align-items: center; justify-content: center; width: 100%; border-radius: 10px; padding: .62rem .8rem; background: linear-gradient(135deg, #0d6efd, #289bff); color: #fff; font-weight: 600; border: 1px solid rgba(13,110,253,.3); }
    .plan-btn:hover { color: #fff; filter: brightness(.96); }
    .clean-content p:empty,
    .clean-content h1:empty,
    .clean-content h2:empty,
    .clean-content h3:empty,
    .clean-content h4:empty,
    .clean-content h5:empty,
    .clean-content h6:empty,
    .clean-content div:empty,
    .clean-content span:empty { display: none !important; margin: 0 !important; padding: 0 !important; }
    .clean-content p { margin-bottom: .85rem; }
    .clean-content h2,
    .clean-content h3,
    .clean-content h4 { margin-top: 1.15rem; margin-bottom: .6rem; }
    @media (max-width: 991.98px) {
        .service-page .service-hero { min-height: 430px; border-radius: 0; }
        .service-highlight-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 575.98px) {
        .service-highlight-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection
