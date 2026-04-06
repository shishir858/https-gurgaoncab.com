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
@php
    $imageUrl = str_starts_with((string) $route->image, 'http') ? $route->image : asset($route->image);
    $highlights = array_values(array_filter(array_map(function ($line) {
        $line = html_entity_decode(strip_tags((string) $line), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $line = preg_replace('/[\x{00A0}\s]+/u', ' ', $line);
        return trim($line);
    }, preg_split('/\r?\n/', (string) $route->highlights))));
    $stops = array_values(array_filter(array_map(function ($line) {
        $line = html_entity_decode(strip_tags((string) $line), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $line = preg_replace('/[\x{00A0}\s]+/u', ' ', $line);
        return trim($line);
    }, preg_split('/\r?\n/', (string) $route->key_stops))));
    $recommendedRoutes = \App\Models\Route::where('is_active', 1)
        ->where('id', '!=', $route->id)
        ->inRandomOrder()
        ->limit(6)
        ->get();

    $rawRouteContent = html_entity_decode((string) ($route->description ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $rawRouteContent = preg_replace('/<p[^>]*>(?:\s|&nbsp;|\x{00A0}|<br\s*\/?>)*<\/p>/iu', '', $rawRouteContent);
    $rawRouteContent = preg_replace('/<h[1-6][^>]*>(?:\s|&nbsp;|\x{00A0}|<br\s*\/?>)*<\/h[1-6]>/iu', '', $rawRouteContent);
    $rawRouteContent = trim((string) $rawRouteContent);
    $routeParts = preg_split('/(<h[1-6][^>]*>.*?<\/h[1-6]>)/is', $rawRouteContent, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    $routeSections = [];
    $currentRouteSection = null;
    foreach ($routeParts as $part) {
        if (preg_match('/^<h[1-6][^>]*>.*<\/h[1-6]>$/is', trim($part))) {
            if ($currentRouteSection && trim((string) $currentRouteSection['body']) !== '') {
                $routeSections[] = $currentRouteSection;
            }
            $currentRouteSection = ['heading' => $part, 'body' => ''];
        } else {
            if (!$currentRouteSection) {
                $currentRouteSection = ['heading' => null, 'body' => ''];
            }
            $currentRouteSection['body'] .= $part;
        }
    }
    if ($currentRouteSection && trim((string) $currentRouteSection['body']) !== '') {
        $routeSections[] = $currentRouteSection;
    }
    $topRouteSections = array_slice($routeSections, 0, 2);
    $midRouteSections = array_slice($routeSections, 2, 2);
    $remainingRouteSections = array_slice($routeSections, 4);
@endphp

<section class="service-page route-page">
    <section class="service-hero position-relative overflow-hidden">
        <img src="{{ $imageUrl }}" alt="{{ $route->name }}" class="hero-image w-100 h-100">
        <div class="hero-overlay"></div>
        <div class="container position-relative py-5">
            <div class="row">
                <div class="col-lg-9 text-white py-5">
                    @if($route->is_popular)
                        <span class="badge rounded-pill bg-warning text-dark px-3 py-2 mb-3">Popular Route</span>
                    @endif
                    <h1 class="hero-title mb-3">{{ $route->name }}</h1>
                    <p class="lead mb-4 route-hero-subtitle">Comfortable one-way and round-trip cab service with verified drivers and responsive support.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="hero-pill"><i class="bi bi-geo-alt me-2"></i>{{ $route->from_location }}</span>
                        <span class="hero-pill"><i class="bi bi-arrow-right me-2"></i>{{ $route->to_location }}</span>
                        @if($route->duration)<span class="hero-pill"><i class="bi bi-clock me-2"></i>{{ $route->duration }}</span>@endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid detail-wide my-5">
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-xxl-11">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="content-card h-100 route-metric">
                            <i class="bi bi-speedometer2"></i>
                            <h6>Distance</h6>
                            <p>{{ $route->distance ?: '-' }} km</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="content-card h-100 route-metric">
                            <i class="bi bi-clock-history"></i>
                            <h6>Travel Duration</h6>
                            <p>{{ $route->duration ?: '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="content-card h-100 route-metric">
                            <i class="bi bi-sun"></i>
                            <h6>Best Season</h6>
                            <p>{{ $route->best_season ?: 'All Seasons' }}</p>
                        </div>
                    </div>
                </div>

                @if(!empty($highlights))
                    <div class="content-card mb-4">
                        <h3 class="section-title mb-3">Route Highlights</h3>
                        <p class="section-subtitle mb-3">Key reasons why this route is preferred by frequent travelers.</p>
                        <div class="row g-3">
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

                @if(!empty($stops))
                    <div class="content-card mb-4">
                        <h3 class="section-title mb-3">Key Stops Along The Way</h3>
                        <p class="section-subtitle mb-3">Important points you can cover during the journey.</p>
                        <ul class="timeline-list timeline-badges mb-0">
                            @foreach($stops as $index => $stop)
                                <li>
                                    <span class="day-pill">Stop {{ $index + 1 }}</span>
                                    <span>{{ $stop }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(!empty($topRouteSections))
                    <div class="content-card mb-4">
                        <h3 class="section-title mb-3">About This Route</h3>
                        <div class="prose-content route-copy clean-content">
                            @foreach($topRouteSections as $section)
                                @if(!empty($section['heading'])){!! $section['heading'] !!}@endif
                                {!! $section['body'] !!}
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <img src="{{ $imageUrl }}" alt="{{ $route->name }}" class="static-showcase-img">
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('images/why-choose-us.webp') }}" alt="Why choose us" class="static-showcase-img">
                    </div>
                </div>

                @if(!empty($midRouteSections))
                    <div class="content-card mb-4">
                        <h3 class="section-title mb-3">Route Insights</h3>
                        <div class="prose-content route-copy clean-content">
                            @foreach($midRouteSections as $section)
                                @if(!empty($section['heading'])){!! $section['heading'] !!}@endif
                                {!! $section['body'] !!}
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="row g-4 mt-1">
                    <div class="col-lg-6">
                        <div class="content-card h-100 plan-trip-card">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h4 class="section-title mb-0">Plan Your Journey</h4>
                                <span class="plan-trip-badge">Quick Booking</span>
                            </div>
                            <p class="text-muted mb-3">Trip details share karein, team route pricing and cab options turant share karegi.</p>
                            <div class="row g-2 mb-3">
                                <div class="col-6"><div class="plan-mini">Driver Support</div></div>
                                <div class="col-6"><div class="plan-mini">On-Time Pickup</div></div>
                                <div class="col-6"><div class="plan-mini">Live Assistance</div></div>
                                <div class="col-6"><div class="plan-mini">Fare Clarity</div></div>
                            </div>
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

                <div class="content-card mt-4">
                    <h5 class="fw-bold mb-3">Recommended Cab Routes</h5>
                    <p class="section-subtitle mb-3">Explore similar nearby routes with the same cab comfort and support.</p>
                    <div class="row g-2">
                        @forelse($recommendedRoutes as $r)
                            <div class="col-md-6 col-lg-4">
                                <a href="{{ route('routes.show', $r->slug) }}" class="location-link text-decoration-none">
                                    <i class="bi bi-sign-turn-right-fill"></i>
                                    <span>{{ $r->name }}</span>
                                </a>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No recommended routes available.</p>
                        @endforelse
                    </div>
                </div>

                @if(!empty($remainingRouteSections))
                    <div class="content-card mt-4">
                        <h5 class="fw-bold mb-3">More Route Information</h5>
                        <div class="prose-content route-copy clean-content">
                            @foreach($remainingRouteSections as $section)
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
    a { color: rgb(255 193 7); }
    .route-page {
        background:
            radial-gradient(900px 450px at 92% 0%, #e2eeff 0%, rgba(226, 238, 255, 0) 55%),
            linear-gradient(180deg, #eff5ff 0%, #ffffff 42%);
    }
    .route-page .service-hero {
        min-height: 560px;
        border-bottom-left-radius: 34px;
        border-bottom-right-radius: 34px;
    }
    .route-page .hero-overlay {
        background: linear-gradient(120deg, rgba(5, 14, 30, .88), rgba(12, 56, 126, .7), rgba(7, 129, 151, .5));
    }
    .route-page .hero-pill {
        border-radius: 14px;
        padding: .58rem .95rem;
        font-weight: 500;
        background: linear-gradient(135deg, rgba(255,255,255,.26), rgba(255,255,255,.1));
        border: 1px solid rgba(255,255,255,.35);
    }
    .route-hero-subtitle {
        max-width: 760px;
        line-height: 1.78;
        font-size: 1.08rem;
        color: rgba(255,255,255,.93) !important;
    }
    .section-subtitle { color: #607089; font-size: .93rem; line-height: 1.6; margin-top: -2px; }

    .route-page .content-card {
        border-radius: 18px;
        border: 1px solid #dce8fa;
        box-shadow: 0 16px 36px rgba(15, 34, 67, .08);
    }

    .route-metric {
        text-align: left;
        background: linear-gradient(150deg, #ffffff 0%, #f4f9ff 100%);
        position: relative;
        overflow: hidden;
    }
    .route-metric::after {
        content: "";
        position: absolute;
        inset: auto 0 0 0;
        height: 3px;
        background: linear-gradient(90deg, #0d6efd, #47b2ff);
        opacity: .8;
    }
    .route-metric i {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e6efff, #f3f8ff);
        color: #0d6efd;
        margin-bottom: 10px;
    }
    .route-metric h6 { margin: 0 0 6px; font-weight: 700; color: #0f2343; font-size: 1.02rem; }
    .route-metric p { margin: 0; color: #3f556f; font-weight: 600; font-size: .98rem; }

    .route-page .highlight-item {
        background: linear-gradient(145deg, #ffffff 0%, #f7fbff 100%);
        border: 1px solid #dee8f9;
        border-radius: 14px;
        padding: 15px;
        height: 100%;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        box-shadow: 0 8px 20px rgba(20,33,61,.06);
        transition: .22s ease;
    }
    .route-page .highlight-item:hover { border-color: #bdd6ff; transform: translateY(-3px); }
    .route-page .highlight-no {
        min-width: 40px;
        height: 40px;
        border-radius: 11px;
        background: linear-gradient(135deg, #dfeaff, #eef5ff);
        color: #0c4eb9;
        font-weight: 700;
        font-size: .88rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #cadeff;
    }
    .route-page .highlight-item p { color: #30455f; line-height: 1.66; font-size: .95rem; }

    .route-page .timeline-list li {
        background: linear-gradient(145deg, #ffffff 0%, #f8fbff 100%);
        border: 1px solid #e0eaf8;
        border-radius: 12px;
        padding: .95rem 1rem .95rem 1.9rem;
        margin-bottom: .8rem;
        box-shadow: 0 7px 18px rgba(20,33,61,.05);
    }
    .route-page .timeline-list li::after { display: none; }
    .route-page .timeline-badges .day-pill {
        background: #edf4ff;
        border-color: #d1e2ff;
        color: #0f4fb6;
        font-weight: 700;
    }

    .route-copy { font-size: 1.03rem; line-height: 1.9; color: #334155; }
    .route-copy h2, .route-copy h3, .route-copy h4 { color: #10284a; margin-top: 1.25rem; margin-bottom: .72rem; font-weight: 700; }
    .route-copy p { margin-bottom: .95rem; }
    .route-copy ul, .route-copy ol { margin: .35rem 0 1rem; padding-left: 0; list-style: none; }
    .route-copy ul li, .route-copy ol li {
        position: relative;
        margin-bottom: .58rem;
        padding: .56rem .74rem .56rem 2rem;
        border: 1px solid #dde7f8;
        border-radius: 10px;
        background: linear-gradient(145deg, #ffffff, #f8fbff);
        line-height: 1.66;
    }
    .route-copy ul li::before, .route-copy ol li::before {
        content: "";
        position: absolute;
        left: .8rem;
        top: 1.06rem;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #0d6efd;
        box-shadow: 0 0 0 3px #e7f0ff;
    }
    .route-copy ul li br, .route-copy ol li br { display: none; }

    .clean-content p:empty,
    .clean-content h1:empty,
    .clean-content h2:empty,
    .clean-content h3:empty,
    .clean-content h4:empty,
    .clean-content h5:empty,
    .clean-content h6:empty,
    .clean-content div:empty,
    .clean-content span:empty { display: none !important; margin: 0 !important; padding: 0 !important; }

    .route-page .plan-trip-card {
        background: linear-gradient(145deg, #ffffff 0%, #eef6ff 100%);
        border-color: #d0e2ff;
    }
    .route-page .plan-trip-badge {
        background: linear-gradient(135deg, #0d6efd, #35a7ff);
        color: #fff;
        font-size: .78rem;
        padding: .26rem .62rem;
        border-radius: 999px;
        font-weight: 600;
        letter-spacing: .2px;
    }
    .route-page .plan-mini {
        background: linear-gradient(135deg, #fff, #f6f9ff);
        border: 1px solid #dce7fb;
        color: #254267;
        border-radius: 10px;
        padding: .52rem .62rem;
        font-size: .84rem;
        font-weight: 500;
        text-align: center;
    }
    .location-link i {
        color: #044729;
    }
    @media (max-width: 991.98px) {
        .route-page .service-hero { min-height: 460px; border-radius: 0; }
    }
</style>
@endsection
