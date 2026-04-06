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
<!-- Service Hero -->
<div class="position-relative" style="height: 300px; overflow: hidden;">
	    <img src="{{ asset($service->feature_image) }}" alt="{{ $service->title }}" 
		    class="w-100 h-100" style="object-fit: cover;">
	<div class="position-absolute top-0 start-0 w-100 h-100" 
		 style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.8));">
		<div class="container h-100 d-flex align-items-center pb-5">
			<div class="text-white">
				@if($service->is_popular)
					<span class="badge bg-warning text-dark mb-3">⭐ Popular Service</span>
				@endif
				<h1 class="display-4 fw-bold mb-3">{{ $service->title }}</h1>
				@if($service->duration)
					<div class="fs-5 mb-2">
						<span class="fw-bold text-warning">Duration:</span> {{ $service->duration }}
					</div>
				@endif
				<!-- Removed slug from banner -->
			</div>
		</div>
	</div>
</div>

<div class="container my-5">
	<div class="row g-4">
		<!-- Main Content -->
		<div class="col-lg-8">
			<!-- Amenities Section -->
			@if($service->amenities)
			<div class="card border-0 shadow-sm mb-4">
				<div class="card-body p-4">
					<div class="d-flex justify-content-between flex-wrap">
						@foreach(json_decode($service->amenities, true) as $amenity)
							<div class="text-center mx-3 mb-2">
								@if($amenity == 'Hotels')
									<i class="bi bi-building fs-2 text-primary"></i>
								@elseif($amenity == 'Sightseeing')
									<i class="bi bi-binoculars fs-2 text-success"></i>
								@elseif($amenity == 'Meals')
									<i class="bi bi-egg-fried fs-2 text-warning"></i>
								@elseif($amenity == 'Transfers')
									<i class="bi bi-truck fs-2 text-info"></i>
								@else
									<i class="bi bi-star fs-2 text-secondary"></i>
								@endif
								<div class="small mt-1 fw-bold">{{ $amenity }}</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			@endif

			<!-- Service Points (Highlights, Features, Included, Excluded, Itinerary) -->
			<div class="row mb-4">
				<!-- Highlights -->
                @if($service->highlights)
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-3"><i class="bi bi-star text-warning me-2"></i>Service Highlights</h3>
                            <div class="row g-3">
									@foreach(preg_split('/\r?\n/', $service->highlights) as $highlight)
                                    @if(trim($highlight))
                                        <div class="col-md-12">
                                            <div class="d-flex">
                                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
												<span>{{ strip_tags(trim($highlight)) }}</span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
				@if($service->key_features)
					<div class="col-md-12 mb-4">
						<div class="card border-0 shadow-sm h-100">
							<div class="card-body p-4">
								<h4 class="fw-bold mb-3 text-info"><i class="bi bi-gear-fill me-2"></i>Key Features</h4>
								<ul class="list-unstyled mb-0">
									@foreach(explode("\n", $service->key_features) as $feature)
										@if(trim($feature))
											<li class="mb-2 d-flex align-items-center">
												<i class="bi bi-lightning-charge-fill text-warning me-2"></i>
												<span>{{ strip_tags(trim($feature)) }}</span>
											</li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				@endif
				@if($service->included)
					<div class="col-md-6 mb-4">
						<div class="card border-0 shadow-sm h-100">
							<div class="card-body p-4">
								<h4 class="fw-bold mb-3 text-success"><i class="bi bi-plus-circle-fill me-2"></i>Included</h4>
								<ul class="list-unstyled mb-0">
										@foreach(preg_split('/\r?\n/', $service->included) as $item)
										@if(trim($item))
											<li class="mb-2 d-flex align-items-center">
												<i class="bi bi-check text-success me-2"></i>
												<span>{{ strip_tags(trim($item)) }}</span>
											</li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				@endif
				@if($service->excluded)
					<div class="col-md-6 mb-4">
						<div class="card border-0 shadow-sm h-100">
							<div class="card-body p-4">
								<h4 class="fw-bold mb-3 text-danger"><i class="bi bi-x-circle-fill me-2"></i>Excluded</h4>
								<ul class="list-unstyled mb-0">
										@foreach(preg_split('/\r?\n/', $service->excluded) as $item)
										@if(trim($item))
											<li class="mb-2 d-flex align-items-center">
												<i class="bi bi-x text-danger me-2"></i>
												<span>{{ strip_tags(trim($item)) }}</span>
											</li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				@endif
				@if($service->itinerary)
					<div class="col-12 mb-4">
						<div class="card border-0 shadow-sm">
							<div class="card-body p-4">
								<h4 class="fw-bold mb-3"><i class="bi bi-map-fill text-warning me-2"></i>Itinerary</h4>
								<ul class="timeline list-unstyled">
									@foreach(preg_split('/\r?\n/', $service->itinerary) as $item)
										@if(trim($item))
											<li class="mb-4 d-flex align-items-center timeline-item">
												<div class="timeline-dot"></div>
												<div class="timeline-content ms-3">
													<span class="fw-bold text-warning timeline-day">{{ preg_match('/^Day [0-9]+:/', strip_tags(trim($item))) ? strtok(strip_tags(trim($item)), ':') : '' }}</span>
													<span class="ms-2 text-dark timeline-desc">{{ preg_match('/^Day [0-9]+:/', strip_tags(trim($item))) ? substr(strip_tags(trim($item)), strpos(strip_tags(trim($item)), ':') + 1) : strip_tags(trim($item)) }}</span>
												</div>
											</li>
										@endif
									@endforeach
								</ul>
								<style>
									.timeline-item { position: relative; }
									.timeline-dot {
										width: 14px;
										height: 14px;
										background: #2196f3;
										border-radius: 50%;
										position: relative;
										z-index: 2;
									}
									.timeline-item:not(:last-child)::before {
										content: '';
										position: absolute;
										left: 6px;
										top: 14px;
										width: 2px;
										height: calc(100% - 14px);
										background: #e3e3e3;
										z-index: 1;
									}
									.timeline-day {
										font-size: 1.1rem;
										font-weight: bold;
										color: #ffc107 !important;
									}
									.timeline-desc {
										font-size: 1rem;
										color: #212529;
									}
								</style>
							</div>
						</div>
					</div>
				@endif

			</div>

			<!-- Long Content (Description, More Contents) -->
			<div class="card shadow-sm border-0 mb-4">
				<div class="card-body p-4">
					<h4 class="fw-bold mb-3 text-dark"><i class="bi bi-file-earmark-text text-warning me-2"></i>Service Details</h4>
					<div class="text-muted mb-3">{!! $service->description !!}</div>
					@if($service->more_contents)
						<hr>
						<!-- <h5 class="fw-bold text-secondary"><i class="bi bi-journal-text me-2"></i>More Contents</h5> -->
						<div class="text-muted">{!! $service->more_contents !!}</div>
					@endif
				</div>
			</div>

			

			<!-- Key Features -->
			@if($service->key_features)
				<div class="card shadow-sm border-0 mb-4">
					<div class="card-body p-4">
						<h3 class="fw-bold mb-3"><i class="bi bi-gear me-2"></i>Key Features</h3>
						<div class="list-group list-group-flush">
								@foreach(preg_split('/\r?\n/', $service->key_features) as $index => $feature)
								@if(trim($feature))
									<div class="list-group-item px-0 border-0 border-bottom">
										<div class="d-flex align-items-start">
											<span class="badge bg-primary me-3" style="width: 30px;">{{ $index + 1 }}</span>
											<span>{{ trim($feature) }}</span>
										</div>
									</div>
								@endif
							@endforeach
						</div>
					</div>
				</div>
			@endif

			<!-- Best Time to Avail -->
			@if($service->best_time)
				<div class="card shadow-sm border-0">
					<div class="card-body p-4">
						<h3 class="fw-bold mb-3"><i class="bi bi-calendar3 me-2"></i>Best Time to Avail</h3>
						<div class="alert alert-info d-flex align-items-center">
							<i class="bi bi-sun fs-4 me-3"></i>
							<div>
								<strong>Recommended Time:</strong> {{ $service->best_time }}
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>

		<!-- Sidebar -->
		<div class="col-lg-4">
			<!-- Booking Card -->
			<div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
				<div class="card-body p-4">
					<h5 class="fw-bold mb-4">Book This Service</h5>
					@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
					<div class="service-booking-form-wrapper bg-white">
						<form method="POST" action="{{ route('service-enquiry.store') }}">
							@include('components.enquiry-form')
					</div>
					<div class="mt-4 pt-4 border-top">
						<h6 class="fw-bold mb-3">What's Included</h6>
						<div class="d-flex align-items-start mb-2">
							<i class="bi bi-check text-success me-2"></i>
							<small>Expert Service</small>
						</div>
						<div class="d-flex align-items-start mb-2">
							<i class="bi bi-check text-success me-2"></i>
							<small>Quality Assurance</small>
						</div>
						<div class="d-flex align-items-start mb-2">
							<i class="bi bi-check text-success me-2"></i>
							<small>24/7 Support</small>
						</div>
					</div>
				</div>
			</div>
			<!-- Recommended Packages -->
			@php
				$recommendedServices = \App\Models\Service::where('is_active', true)
					->where('id', '!=', $service->id)
					->inRandomOrder()
					->limit(5)
					->get();
			@endphp
			<div class="card shadow-sm border-0 mt-4">
				<div class="card-body p-4">
					<h5 class="fw-bold mb-3 text-primary">Recommended Packages</h5>
					@foreach($recommendedServices as $recService)
						<div class="mb-3 pb-3 border-bottom">
							<div class="d-flex align-items-center">
								<img src="{{ asset($recService->feature_image) }}" alt="{{ $recService->title }}" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: cover;">
								<div>
									<div class="fw-bold">{{ $recService->title }}</div>
									<div class="text-muted small mb-1">{{ $recService->duration }}</div>
									<a href="{{ route('service.details', $recService->slug) }}" class="text-warning fw-bold">View Details <i class="bi bi-arrow-right"></i></a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		</div>
	</div>

</div>
@endsection
