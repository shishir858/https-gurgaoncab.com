@extends('layout.app')

@section('meta')
    <title>Gurgaon Cab Service - Cab Booking & India Tours</title>
    <meta name="description" content="Book cabs and discover incredible India with Gurgaon Cab Service. Trusted partner for memorable journeys, luxury travel, and adventure tours.">
    <meta name="keywords" content="cab booking, India tours, Gurgaon Cab Service, luxury travel, adventure, sightseeing, holiday packages">
    <link rel="canonical" href="{{ url()->current() }}">
@endsection
@section('content')
    <!-- Hero Slider Section -->
    @include('components.hero-banner')

    <!-- Spacer for About Section -->
    <div class="d-none d-md-block" style="height: 170px;"></div>

    <!-- About Section: Home Page -->
    <section class="about-section py-5 bg-white">
        <div class="container">
            <div class="row align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 col-12 mt-4 mt-md-0">
                    <h2 class="fw-bold mb-3" style="font-size:1.2rem;">The Best Cab Services in Gurgaon for Safe, Comfortable, and Reliable Travel</h2>
                    <p class="mb-3 text-secondary" style="max-width: 600px;">
                        Now, commuting in a fast-moving city like Gurgaon requires more than just a ride; it needs reliability and comfort, not to say safety, with affordability on each journey. That's the exact point at which Gurgaon Cab Service differs as a reliable cab service company that is dedicated to making day-to-day travel smooth, hassle-free, and dependable.<br>
                        From short city rides to <a href="#" class="fw-bold text-primary">long outstation journeys</a>, from early morning airport drops to late night pickups, our goal is simple: to provide the best taxi service experience that feels personal, professional, and reliable every single time with our Gurugram cab service.<br>
                        As a customer-centric taxi service company, we believe at Cabilly that every ride counts-be it going to the office, catching flights, sending kids to school, or planning a family trip. Comfort and peace of mind are not to be compromised.<br>
                        This is why our services have been designed in keeping with real travel needs-no complications, no surprises, just smooth journeys.
                    </p>
                    
                </div>
                <div class="col-md-6 col-12 d-flex justify-content-center mb-4 mb-md-0">
                    <!-- Collage for large screens -->
                    <div class="d-none d-md-block position-relative">
                        <img src="{{ asset('images/cab.jpg') }}" alt="Cab" class="w-100 h-100">
                    </div>
                    <!-- Only one image for mobile -->
                    <div class="d-md-none w-100 d-flex flex-column align-items-center">
                        <img src="{{ asset('images/cab.jpg') }}" alt="Travel" style="width: 100%; max-width: 98vw; height: 210px; object-fit: cover;" class="rounded-4 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Section: Popular Packages from Gurgaon -->
    <section class="packages-section py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold text-center mb-3" style="font-size:1.7rem;">Popular Packages from Gurgaon to other Locations</h2>
            <p class="text-center text-secondary mb-4" style="max-width:1000px;margin:0 auto;">Explore our most popular travel packages from Gurgaon to top destinations across North India. Each package is designed for comfort, convenience, and memorable experiences—perfect for family holidays, adventure trips, and relaxing getaways. Book your next journey with us and enjoy exclusive deals!</p>
            <div class="row g-4 justify-content-center" style="display: flex; flex-wrap: wrap;">
                <!-- Card 1 -->
                @foreach($featuredServices as $service)
                <div class="col-md-4 col-sm-6 d-flex">
                    <div class="package-card-new rounded-4 shadow-lg overflow-hidden bg-white border position-relative w-100" style="min-height: 420px; display: flex; flex-direction: column;">
                        <div class="position-relative">
                            <img src="{{ asset($service->feature_image ?? 'images/gallery/default.jpg') }}" alt="{{ $service->title }}" class="w-100" style="height:180px; object-fit:cover;">
                            @if(isset($service->offer) && $service->offer)
                                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 px-3 py-2 rounded-pill fw-bold" style="font-size:0.95rem;">{{ Str::limit(strip_tags($service->offer), 40) }}</span>
                            @else
                                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 px-3 py-2 rounded-pill fw-bold" style="font-size:0.95rem;">Special Offer</span>
                            @endif
                        </div>
                        <div class="p-3">
                            <h4 class="fw-bold text-dark mb-1" style="font-size:1.15rem;">{{ $service->title }}</h4>
                            <div class="mb-2"><span class="fw-bold text-secondary">Duration:</span> <span class="text-warning">{{ $service->duration ?? 'N/A' }}</span></div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between text-center mb-2">
                                <div>
                                    <img src="{{ asset('images/icons/hotel-icon.webp') }}" alt="Hotels" style="height:24px;">
                                    <div class="small text-secondary">Hotels</div>
                                </div>
                                <div>
                                    <img src="{{ asset('images/icons/Sightseeing-icon.webp') }}" alt="Sightseeing" style="height:24px;">
                                    <div class="small text-secondary">Sightseeing</div>
                                </div>
                                <div>
                                    <img src="{{ asset('images/icons/meals-icon.webp') }}" alt="Meals" style="height:24px;">
                                    <div class="small text-secondary">Meals</div>
                                </div>
                                <div>
                                    <img src="{{ asset('images/icons/transfer-icon.webp') }}" alt="Transfers" style="height:24px;">
                                    <div class="small text-secondary">Transfers</div>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="mb-2">
                                <div class="fw-bold text-primary mb-1" style="font-size:1rem;">Service Inclusions:</div>
                                <ul class="ps-3 mb-1" style="font-size:0.97rem;">
                                    <li>{{ Str::limit(strip_tags($service->description), 120) ?? 'See details' }}</li>
                                </ul>
                                <a href="{{ route('service.details', $service->slug) }}" class="text-warning small fw-bold">Read More</a>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark" style="font-size:1.1rem;">₹ On Request</span>
                                <a href="{{ route('service.details', $service->slug) }}#enquiry" class="btn btn-warning rounded-pill px-4 fw-bold shadow">SEND ENQUIRY</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('services.archive') }}" class="btn btn-warning btn-lg rounded-pill px-4 fw-bold shadow">Explore all tour packages</a>
            </div>
        </div>
    </section>
    
    <!-- Services Slider Section -->
    <section class="services-slider-section py-5 bg-white">
        <div class="container">
            <h2 class="fw-bold text-center mb-4" style="font-size:2rem;">Our Cab Services</h2>
            <p class="text-center text-secondary mb-4" style="max-width:1000px;margin:0 auto;">Discover our range of cab services designed for every travel need in Gurgaon and beyond. From local rides to airport transfers and outstation trips, we ensure comfort, safety, and reliability for every journey. Choose the service that fits your plan and book instantly!</p>
            <div id="servicesSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
                <div class="carousel-inner">
                    <!-- Slide -->
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-md-4 mb-4">
                                <div class="service-card shadow rounded-4 overflow-hidden h-100">
                                    <img src="{{ asset('images/gallery/gallery1.jpg') }}" alt="Customized North India Tours" class="w-100" style="height:170px; object-fit:cover;">
                                    <div class="p-4 text-center">
                                        <h4 class="fw-bold mb-2">Customized North India Tours</h4>
                                        <p class="text-secondary mb-3">Explore North India with tailor-made tour packages. Travel comfortably in our cabs while our drivers help you enjoy a stress-free and memorable trip. Plan your customized tour package from Gurgaon today!</p>
                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings['contact_whatsapp'] ?? '919999999999') }}" target="_blank" class="btn btn-primary rounded-pill px-4">Book Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="service-card shadow rounded-4 overflow-hidden h-100">
                                    <img src="{{ asset('images/car-rental-india.jpg') }}" alt="Local Cab Service" class="w-100" style="height:170px; object-fit:cover;">
                                    <div class="p-4 text-center">
                                        <h4 class="fw-bold mb-2">Local Cab Service</h4>
                                        <p class="text-secondary mb-3">Looking for a Local Cab in Gurgaon? Enjoy a convenient and reliable ride across Cyber City, MG Road, and Sohna Road with clean cars and professional drivers. Book your local cab service now!</p>
                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings['contact_whatsapp'] ?? '919999999999') }}" target="_blank" class="btn btn-primary rounded-pill px-4">Book Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="service-card shadow rounded-4 overflow-hidden h-100">
                                    <img src="{{ asset('images/airport-transfers.jpg') }}" alt="Airport Transfers" class="w-100" style="height:170px; object-fit:cover;">
                                    <div class="p-4 text-center">
                                        <h4 class="fw-bold mb-2">Airport Transfers</h4>
                                        <p class="text-secondary mb-3">Need a reliable cab for Delhi airport? Enjoy safe and timely rides with a trusted airport cab in Gurgaon, offering smooth travel to and from Gurgaon. Our professional drivers ensure a comfortable journey for business or leisure. Reserve your cab today!</p>
                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings['contact_whatsapp'] ?? '919999999999') }}" target="_blank" class="btn btn-primary rounded-pill px-4">Book Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="service-card shadow rounded-4 overflow-hidden h-100">
                                    <img src="{{ asset('images/corporate-cab-service.jpg') }}" alt="Corporate Cab Service" class="w-100" style="height:170px; object-fit:cover;">
                                    <div class="p-4 text-center">
                                        <h4 class="fw-bold mb-2">Corporate Cab Service</h4>
                                        <p class="text-secondary mb-3">Need reliable office commute solutions in Gurgaon? Our corporate cab service is ideal for employees, meetings, and daily pickups with professional drivers, clean cars, and on-time arrivals. Book a corporate cab now!</p>
                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings['contact_whatsapp'] ?? '919999999999') }}" target="_blank" class="btn btn-primary rounded-pill px-4">Book Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="service-card shadow rounded-4 overflow-hidden h-100">
                                    <img src="{{ asset('images/taxi-service-railway-station.png') }}" alt="Railway Station Transfers" class="w-100" style="height:170px; object-fit:cover;">
                                    <div class="p-4 text-center">
                                        <h4 class="fw-bold mb-2">Railway Station Transfers</h4>
                                        <p class="text-secondary mb-3">Catch your train on time with our reliable railway station pickup & drop service from Gurgaon. We cover New Delhi Railway Station, Old Delhi, Anand Vihar, Gurugram stations, and more with safe, punctual rides. Book now for a stress-free transfer!</p>
                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings['contact_whatsapp'] ?? '919999999999') }}" target="_blank" class="btn btn-primary rounded-pill px-4">Book Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="service-card shadow rounded-4 overflow-hidden h-100">
                                    <img src="{{ asset('images/outstation-trips.jpg') }}" alt="Outstation Trips" class="w-100" style="height:170px; object-fit:cover;">
                                    <div class="p-4 text-center">
                                        <h4 class="fw-bold mb-2">Outstation Trips</h4>
                                        <p class="text-secondary mb-3">Explore nearby cities with our outstation cab from Gurgaon. Experienced drivers, well-maintained vehicles, & transparent pricing guarantee a smooth, safe journey.</p>
                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings['contact_whatsapp'] ?? '919999999999') }}" target="_blank" class="btn btn-primary rounded-pill px-4">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#servicesSlider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#servicesSlider" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Cab Fare Table Section -->
    <section class="cab-fare-section py-5 bg-white">
        <div class="container">
            <h2 class="fw-bold text-center mb-3" style="font-size:2rem;">Cab Fare in Gurgaon – SUV / MUV / Sedan & Tempo Traveller</h2>
            <p class="text-center text-secondary mb-4" style="max-width:1000px;margin:0 auto;">Check our transparent cab fare chart for Gurgaon. Find the best rates for local rides, outstation trips, and airport transfers. Enjoy special discounts for new and existing customers. No hidden charges—just clear pricing and great service!</p>
            <div class="table-responsive">
                <table class="table cab-fare-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Service Type</th>
                            <th>Vehicle Type</th>
                            <th>Per Km Fare</th>
                            <th>Notes / Offers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">Within City / Local</td>
                            <td>Sedan / MUV / SUV</td>
                            <td>₹13–17/km</td>
                            <td>Driver charge: ₹300/day, Night charge extra</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempo Traveller</td>
                            <td>₹18–25/km</td>
                            <td>Driver charge: ₹500/day, Night charge extra</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Outstation Trips</td>
                            <td>Sedan / MUV / SUV</td>
                            <td>₹13–17/km</td>
                            <td>Driver charge: ₹300/day, Night charge extra</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempo Traveller</td>
                            <td>₹18–25/km</td>
                            <td>Driver charge: ₹500/day, Night charge extra</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Airport Transfers</td>
                            <td>Sedan / MUV / SUV</td>
                            <td>₹13–17/km</td>
                            <td>Driver charge: ₹300 (if waiting), Night charge extra</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tempo Traveller</td>
                            <td>₹18–25/km</td>
                            <td>Driver charge: ₹500 (if waiting), Night charge extra</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="fw-bold">Discounts</td>
                            <td>All Vehicles</td>
                            <td>—</td>
                            <td class="fw-bold text-dark">New Customers: <span class="text-warning">20% OFF</span>, Existing Customers: <span class="text-warning">15% OFF</span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
    
    <!-- About Gurgaon City & Cab Service Section -->
    <section class="about-gurgaon-section py-5 position-relative" style="background:#f7f8fa;">
        <div class="about-bg-overlay position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(120deg,rgba(0, 0, 0, 0.55) 0%,rgba(0, 0, 0, 0.35) 100%), url('{{ asset('images/banner6.jpg') }}') center/cover no-repeat; z-index:0; opacity:0.7;"></div>
        <div class="container position-relative" style="z-index:2;">
            <h2 class="fw-bold text-light text-center mb-2" style="font-size:2.2rem;">About Gurgaon city and Gurgaon Cab Service</h2>
            <div class="text-center text-light mb-5" style="font-size:1.15rem;">Trusted travel partner with comfort, safety & reliability for every ride.</div>
            <div class="row justify-content-center g-4">
                <div class="col-md-6">
                    <div class="about-card shadow-sm rounded-4 bg-white p-4 h-100">
                        <h4 class="fw-bold mb-3">About Gurgaon Cab Service</h4>
                        <p class="mb-0 text-secondary text-justify" style="font-size:1.08rem;">
                            Gurgaon Cab Service is your trusted travel partner with over <b class="text-highlight">20 years of experience</b> in the travel industry. Known for reliability, professionalism, and a customer-first approach, we specialize in safe, affordable, and comfortable rides across Gurgaon and North India. We follow strict hygiene protocols, prioritize personal safety, and deliver hassle-free trips. With transparent pricing, <b class="text-highlight">24/7 availability</b>, and thousands of positive reviews on Trustpilot and Google Business Profile, we continue to set the benchmark for quality <b class="text-highlight">cab services in Gurgaon</b>.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-card shadow-sm rounded-4 bg-white p-4 h-100">
                        <h4 class="fw-bold mb-3">About Gurgaon City</h4>
                        <p class="mb-0 text-secondary text-justify" style="font-size:1.08rem;">
                            Gurgaon, now known as <b class="text-highlight">Gurugram</b>, is one of India’s fastest-growing cities and a major financial and technology hub in the Delhi NCR region. Known for its modern skyline, corporate offices, shopping malls, and vibrant nightlife, Gurgaon also offers rich cultural and historical attractions nearby. With excellent connectivity to Delhi and North India, the city is ideal for both business and leisure travelers. From <b class="text-highlight">Cyber Hub</b> and <b class="text-highlight">Kingdom of Dreams</b> to its proximity to heritage sites and weekend getaways, Gurgaon blends tradition with modern living beautifully.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Counter Section: Key Stats -->
    <section class="counter-section py-5 bg-light">
        <div class="container position-relative" style="z-index:2;">
            <div class="row justify-content-center text-center g-4">
                <div class="col-md-3 col-6">
                    <div class="counter-card bg-white rounded-4 shadow-lg py-4 px-2 d-flex flex-column align-items-center">
                        <div class="counter-icon mb-2" style="background:#ffc107; border-radius:50%; width:64px; height:64px; display:flex; align-items:center; justify-content:center;">
                            <img src="{{ asset('images/icons/taxi-safety.svg') }}" alt="Years Experience" style="width:32px; height:32px;">
                        </div>
                        <div class="counter-value fw-bold text-dark mb-2" style="font-size:1.3rem;" data-count="20">0+</div>
                        <div class="counter-label text-secondary" style="font-size:.9rem;">Years Experience</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="counter-card bg-white rounded-4 shadow-lg py-4 px-2 d-flex flex-column align-items-center">
                        <div class="counter-icon mb-2" style="background:#ffc107; border-radius:50%; width:64px; height:64px; display:flex; align-items:center; justify-content:center;">
                            <img src="{{ asset('images/icons/happy.svg') }}" alt="Happy Customers" style="width:32px; height:32px;">
                        </div>
                        <div class="counter-value fw-bold text-dark mb-2" style="font-size:1.3rem;" data-count="50000">0+</div>
                        <div class="counter-label text-secondary" style="font-size:.9rem;">Happy Customers</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="counter-card bg-white rounded-4 shadow-lg py-4 px-2 d-flex flex-column align-items-center">
                        <div class="counter-icon mb-2" style="background:#ffc107; border-radius:50%; width:64px; height:64px; display:flex; align-items:center; justify-content:center;">
                            <img src="{{ asset('images/icons/taxi-1.svg') }}" alt="Completed Rides" style="width:32px; height:32px;">
                        </div>
                        <div class="counter-value fw-bold text-dark mb-2" style="font-size:1.3rem;" data-count="100000">0+</div>
                        <div class="counter-label text-secondary" style="font-size:.9rem;">Completed Rides</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="counter-card bg-white rounded-4 shadow-lg py-4 px-2 d-flex flex-column align-items-center">
                        <div class="counter-icon mb-2" style="background:#ffc107; border-radius:50%; width:64px; height:64px; display:flex; align-items:center; justify-content:center;">
                            <img src="{{ asset('images/icons/trip.svg') }}" alt="Cities Covered" style="width:32px; height:32px;">
                        </div>
                        <div class="counter-value fw-bold text-dark mb-2" style="font-size:1.3rem;" data-count="50">0+</div>
                        <div class="counter-label text-secondary" style="font-size:.9rem;">Cities Covered</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.counter-value').forEach(function(el) {
                var end = parseInt(el.getAttribute('data-count'));
                var duration = 1200;
                var start = 0;
                var step = Math.ceil(end / (duration / 20));
                var interval = setInterval(function() {
                    start += step;
                    if (start >= end) {
                        el.textContent = end.toLocaleString() + '+';
                        clearInterval(interval);
                    } else {
                        el.textContent = start.toLocaleString() + '+';
                    }
                }, 20);
            });
        });
    </script>

     <!-- Popular Taxi Routes Section -->
    <section class="popular-routes-section py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold text-center mb-2" style="font-size:2rem;">Popular Taxi Routes from Gurgaon</h2>
            <p class="text-center text-secondary mb-4" style="max-width:1000px;margin:0 auto;">Book reliable and affordable one-way & round-trip cabs from Gurgaon to top destinations.</p>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        @foreach($routes as $route)
                            <a href="{{ url('cab/' . $route->slug) }}" class="route-card bg-white rounded-3 shadow-sm px-4 py-3 mb-2 text-decoration-none text-dark">
                                {{ $route->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Section: Our Awesome Feature -->
    <section class="feature-section py-5 position-relative" style="background: url('{{ asset('images/banners/feature-banner.jpg') }}') center/cover no-repeat;">
        <div class="feature-overlay position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(120deg,rgba(25, 135, 84, 0) 0%,rgba(25, 135, 84, 0.06) 100%); z-index:0; opacity:0.7;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="text-center mb-2">
                <span class="fw-bold text-warning" style="letter-spacing:2px; font-size:1.1rem;">FEATURE</span>
            </div>
            <h2 class="fw-bold text-light text-center mb-3" style="font-size:2.2rem;">Our Awesome Feature</h2>
            <div class="text-center mb-4">
                <span style="display:inline-block; border-bottom:4px solid #ffc107; width:60px;"></span>
            </div>
            <div class="row justify-content-center g-4">
                <div class="col-md-3 col-sm-6 d-flex">
                    <div class="feature-card bg-white rounded-4 shadow-lg p-4 w-100 d-flex flex-column align-items-center">
                        <div class="feature-icon mb-3" style="background:#ffc107; border-radius:50%; width:80px; height:80px; display:flex; align-items:center; justify-content:center;">
                            <img src="{{ asset('images/icons/taxi-safety.svg') }}" alt="Safety Guarantee" style="width:48px; height:48px;">
                        </div>
                        <h5 class="fw-bold mb-2">Safety Guarantee</h5>
                        <p class="text-secondary text-center mb-0" style="font-size:1rem;">Your safety is our priority. All our vehicles are regularly sanitized and driven by professional, background-verified drivers.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 d-flex">
                    <div class="feature-card bg-white rounded-4 shadow-lg p-4 w-100 d-flex flex-column align-items-center">
                        <div class="feature-icon mb-3" style="background:#ffc107; border-radius:50%; width:80px; height:80px; display:flex; align-items:center; justify-content:center;">
                            <img src="{{ asset('images/icons/pickup.svg') }}" alt="Fast Pickup" style="width:48px; height:48px;">
                        </div>
                        <h5 class="fw-bold mb-2">Fast Pickup</h5>
                        <p class="text-secondary text-center mb-0" style="font-size:1rem;">We ensure quick response times and prompt pickups so you're never left waiting. Book and ride instantly with ease.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 d-flex">
                    <div class="feature-card bg-white rounded-4 shadow-lg p-4 w-100 d-flex flex-column align-items-center">
                        <div class="feature-icon mb-3" style="background:#ffc107; border-radius:50%; width:80px; height:80px; display:flex; align-items:center; justify-content:center;">
                            <img src="{{ asset('images/icons/money.svg') }}" alt="Affordable Rate" style="width:48px; height:48px;">
                        </div>
                        <h5 class="fw-bold mb-2">Affordable Rate</h5>
                        <p class="text-secondary text-center mb-0" style="font-size:1rem;">Enjoy budget-friendly travel with our competitive pricing. No hidden charges, just transparent and affordable fares.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 d-flex">
                    <div class="feature-card bg-white rounded-4 shadow-lg p-4 w-100 d-flex flex-column align-items-center">
                        <div class="feature-icon mb-3" style="background:#ffc107; border-radius:50%; width:80px; height:80px; display:flex; align-items:center; justify-content:center;">
                            <img src="{{ asset('images/icons/support.svg') }}" alt="24/7 Support" style="width:48px; height:48px;">
                        </div>
                        <h5 class="fw-bold mb-2">24/7 Support</h5>
                        <p class="text-secondary text-center mb-0" style="font-size:1rem;">Need help anytime? Our dedicated support team is available around the clock to assist you with bookings and queries.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="feature-checkered-bar w-100 position-absolute bottom-0 start-0" style="height:24px; background: repeating-linear-gradient(90deg, #ffc107 0 24px, #222 24px 48px); z-index:3;"></div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-section py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <span class="fw-bold text-warning mb-2 d-block" style="letter-spacing:2px; font-size:1.1rem;">WHY CHOOSE US</span>
                    <h2 class="fw-bold mb-3" style="font-size:2.2rem;">We Are Dedicated To Provide Quality Service</h2>
                    <p class="mb-4 text-secondary" style="max-width:500px;">We focus on delivering a smooth, safe, and reliable cab service with professional drivers, clean vehicles, and competitive pricing across all travel needs.</p>
                    <img src="{{ asset('images/why-choose-us.webp') }}" alt="Why Choose Us" class="w-100" style="max-width:350px;">
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column gap-4">
                        <!-- Card 1 -->
                        <div class="why-card bg-white rounded-4 shadow-sm px-4 py-3 d-flex align-items-center justify-content-between" style="min-height:110px;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="why-icon d-flex align-items-center justify-content-center" style="background:#ffc107; border-radius:50%; width:48px; height:48px; min-width:48px; min-height:48px; box-shadow:0 2px 8px rgba(25,135,84,0.08);">
                                    <img src="{{ asset('images/icons/taxi-1.svg') }}" alt="Best Quality Taxi" style="width:28px; height:28px;">
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">Best Quality Taxi</h5>
                                    <p class="text-secondary mb-0" style="font-size:1rem;">Our fleet is regularly maintained and fully air-conditioned to ensure comfort and safety for every ride—whether it's short or long-distance.</p>
                                </div>
                            </div>
                            <div class="why-number fw-bold text-warning" style="font-size:2.2rem; opacity:0.15;">01</div>
                        </div>
                        <!-- Card 2 -->
                        <div class="why-card bg-white rounded-4 shadow-sm px-4 py-3 d-flex align-items-center justify-content-between" style="min-height:110px;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="why-icon d-flex align-items-center justify-content-center" style="background:#ffc107; border-radius:50%; width:48px; height:48px; min-width:48px; min-height:48px; box-shadow:0 2px 8px rgba(25,135,84,0.08);">
                                    <img src="{{ asset('images/icons/driver.svg') }}" alt="Expert Drivers" style="width:28px; height:28px;">
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">Expert Drivers</h5>
                                    <p class="text-secondary mb-0" style="font-size:1rem;">Our drivers are highly experienced, professionally trained, and well-versed with local routes to offer you a smooth and secure journey every time.</p>
                                </div>
                            </div>
                            <div class="why-number fw-bold text-warning" style="font-size:2.2rem; opacity:0.15;">02</div>
                        </div>
                        <!-- Card 3 -->
                        <div class="why-card bg-white rounded-4 shadow-sm px-4 py-3 d-flex align-items-center justify-content-between" style="min-height:110px;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="why-icon d-flex align-items-center justify-content-center" style="background:#ffc107; border-radius:50%; width:48px; height:48px; min-width:48px; min-height:48px; box-shadow:0 2px 8px rgba(25,135,84,0.08);">
                                    <img src="{{ asset('images/icons/support.svg') }}" alt="Many Locations" style="width:28px; height:28px;">
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">Many Locations</h5>
                                    <p class="text-secondary mb-0" style="font-size:1rem;">We provide cab services across multiple cities and towns, ensuring you always have a reliable travel option wherever you go.</p>
                                </div>
                            </div>
                            <div class="why-number fw-bold text-warning" style="font-size:2.2rem; opacity:0.15;">03</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7 mb-4 mb-md-0">
                    <h2 class="fw-bold mb-4 text-center text-md-start" style="font-size:2rem;">Frequently Asked Questions</h2>
                    <div class="accordion faq-accordion" id="faqAccordion">
                        <!-- FAQ 1 -->
                        <div class="accordion-item mb-3 rounded-4 shadow-sm border border-0">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button fw-bold text-primary rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1" style="background:#eaf4ff;">
                                    <span class="me-2"><img src="{{ asset('images/icons/taxi-1.svg') }}" alt="Cab Icon" style="width:22px; height:22px;"></span>
                                    What types of cabs are available in Gurgaon?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary pt-3 pb-2 ps-4" style="border-left:3px solid #ffc107; background:#f9fafb;">
                                    At Gurgaon Cab Service, we provide a wide range of vehicles to suit every travel need. Our fleet includes sedans, SUVs, MUVs, and tempo travellers, ideal for local rides, airport transfers, outstation trips, and group travel. All vehicles are well-maintained, sanitized, and equipped for comfort and safety.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ 2 -->
                        <div class="accordion-item mb-3 rounded-4 shadow-sm border border-0">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed fw-bold rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    <span class="me-2"><img src="{{ asset('images/icons/pickup.svg') }}" alt="Pickup Icon" style="width:22px; height:22px;"></span>
                                    How can I book a cab in Gurgaon?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary pt-3 pb-2 ps-4" style="border-left:3px solid #ffc107; background:#f9fafb;">
                                    You can book a cab easily through our website, mobile app, or by calling our customer support. Choose your preferred vehicle, enter your travel details, and confirm your booking instantly.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ 3 -->
                        <div class="accordion-item mb-3 rounded-4 shadow-sm border border-0">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed fw-bold rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    <span class="me-2"><img src="{{ asset('images/icons/support.svg') }}" alt="Support Icon" style="width:22px; height:22px;"></span>
                                    Are your cabs available 24/7?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary pt-3 pb-2 ps-4" style="border-left:3px solid #ffc107; background:#f9fafb;">
                                    Yes, our cabs are available round the clock. Whether you need an early morning airport transfer or a late-night pickup, we are always ready to serve you.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ 4 -->
                        <div class="accordion-item mb-3 rounded-4 shadow-sm border border-0">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button collapsed fw-bold rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    <span class="me-2"><img src="{{ asset('images/icons/money.svg') }}" alt="Money Icon" style="width:22px; height:22px;"></span>
                                    What payment methods are accepted?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary pt-3 pb-2 ps-4" style="border-left:3px solid #ffc107; background:#f9fafb;">
                                    We accept cash, credit/debit cards, UPI, and other popular digital payment methods for your convenience.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ 5 -->
                        <div class="accordion-item mb-3 rounded-4 shadow-sm border border-0">
                            <h2 class="accordion-header" id="faq5">
                                <button class="accordion-button collapsed fw-bold rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    <span class="me-2"><img src="{{ asset('images/icons/happy.svg') }}" alt="Discount Icon" style="width:22px; height:22px;"></span>
                                    Are there any discounts available?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary pt-3 pb-2 ps-4" style="border-left:3px solid #ffc107; background:#f9fafb;">
                                    Yes, we offer special discounts for new and existing customers. Check our website or contact support for current offers.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ 6 -->
                        <div class="accordion-item mb-3 rounded-4 shadow-sm border border-0">
                            <h2 class="accordion-header" id="faq6">
                                <button class="accordion-button collapsed fw-bold rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    <span class="me-2"><img src="{{ asset('images/icons/trip.svg') }}" alt="Trip Icon" style="width:22px; height:22px;"></span>
                                    Can I make multiple stops during my journey?
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="faq6" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary pt-3 pb-2 ps-4" style="border-left:3px solid #ffc107; background:#f9fafb;">
                                    Yes, you can request multiple stops when booking your cab. Our drivers will accommodate your travel plans as needed.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 d-flex justify-content-center align-items-stretch">
                    <img src="{{ asset('images/banners/mob-banner2.png') }}" alt="FAQ" class="w-100 h-100" style="max-width:340px; border-radius:24px; object-fit:cover; min-height:100%;">
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section: Best Tour and Travel Agency in Delhi -->
    <section class="content-section py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h2 class="fw-bold mb-3" style="font-size:2rem;">
                        <span class="text-highlight">A Gurgaon Cab Service</span> <span class="text-dark">Built for Everyday Gurgaon Life</span>
                    </h2>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        Gurgaon is a city of professionals, families, students, and travellers. Daily schedules are tight, and safety is always our top priority. Gurgaon Cab Service in Gurgaon was created for precisely these realities.
                    </p>
                    <div class="mb-3">
                        <span class="fw-bold text-highlight" style="font-size:1.1rem;">We offer:</span>
                        <ul class="ps-3 mb-1" style="font-size:1.08rem;">
                            <li><span class="fw-bold text-highlight">Quick local rides</span></li>
                            <li><span class="fw-bold text-highlight">Reliable daily taxi service</span></li>
                            <li><span class="fw-bold text-highlight">Comfortable airport transfers</span></li>
                            <li><span class="fw-bold text-highlight">Long-distance outstation trips</span></li>
                            <li><span class="fw-bold text-highlight">Custom Tour Packages for North India</span></li>
                        </ul>
                    </div>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        Whether it’s a short visit to a mall or a full-day booking, our service aligns with your plans, not the other way around. Convenience merged with excellence is the reason people choose us when searching for the nearest taxi service, the best taxi service near me, or a <span class="fw-bold text-highlight">reliable airport cab in Gurgaon</span>. We assure faster availability, shorter wait times, and seamless bookings, with our trusted Gurugram taxi service available across Gurgaon.
                    </p>
                    <hr class="my-4">
                    <h3 class="fw-bold mb-3" style="font-size:1.7rem;">
                        <span class="text-dark">Affordable Yet Premium:</span> <span class="text-highlight">Gurgaon Cab Service You Can Trust</span>
                    </h3>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        Quality travel need not be expensive. We charge reasonably and transparently for the premium experience we intend to provide as a customer-centric cab service company.
                    </p>
                    <div class="mb-3">
                        <span class="fw-bold text-highlight" style="font-size:1.1rem;">Our economical budget taxi services are ideal for:</span>
                        <ul class="ps-3 mb-1" style="font-size:1.08rem;">
                            <li><span class="fw-bold text-highlight">Daily office commutes</span></li>
                            <li><span class="fw-bold text-highlight">Regular school drops</span></li>
                            <li><span class="fw-bold text-highlight">Shopping and Personal Errands</span></li>
                            <li><span class="fw-bold text-highlight">Long-term local travel needs</span></li>
                        </ul>
                    </div>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        No hidden charges, no last-minute surprises—just fair pricing that respects your budget while maintaining comfort and safety.
                    </p>
                    <hr class="my-4">
                    <h3 class="fw-bold mb-3" style="font-size:1.7rem;">
                        <span class="text-highlight">Gurgaon Taxi Service</span> <span class="text-dark">You Can Rely On Daily</span>
                    </h3>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        Consistency is everything when it comes to daily travel. Our daily taxi services are built for people who need dependable transportation without hassles with our reliable Gurugram cab service. From fixed-route office travel to flexible day bookings, our drivers arrive on time, the vehicles stay clean, and service quality remains consistent. This is why most clients, when coming to Gurgaon, rely on Gurgaon Cab Service instead of choosing any random app-based vehicle.
                    </p>
                    <h4 class="fw-bold mb-2" style="font-size:1.2rem; color:#222;">Outstation & North India Tour Services</h4>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        We offer safe and comfortable outstation travel across North India, beyond city limits. Whether it is a weekend getaway, family function, or spiritual journey, our experienced drivers will make long-distance rides smooth with our reliable Gurgaon taxi service.
                    </p>
                    <hr class="my-4">
                    <h3 class="fw-bold mb-3" style="font-size:1.7rem;">
                        <span class="text-dark">Special Offers</span> <span class="text-highlight">that add real value</span>
                    </h3>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        To welcome new customers and reward loyalty, Gurgaon Cab Service has the following:
                    </p>
                    <ul class="ps-3 mb-1" style="font-size:1.08rem;">
                        <li><span class="fw-bold text-highlight">20% OFF</span> for first-time riders.</li>
                        <li><span class="fw-bold text-highlight">Repeat customers get 15% off.</span></li>
                    </ul>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        These offers help make quality travel more accessible, thereby building long-term trust with our customers.
                    </p>
                    <hr class="my-4">
                    <h3 class="fw-bold mb-3" style="font-size:1.7rem;">
                        <span class="text-dark">Why opt for</span> <span class="text-highlight">Gurgaon Cab Service?</span>
                    </h3>
                    <ul class="ps-3 mb-1" style="font-size:1.08rem;">
                        <li><span class="fw-bold text-dark">A reliable company providing cab services.</span> We are not just another taxi service company but a local service provider cognizant of the pace of Gurgaon, its people, and their travel patterns.</li>
                        <li><span class="fw-bold text-dark">Best Taxi Service with Local Expertise</span> Right from the busy corporate hubs to residential sectors, we know Gurgaon inside out. That makes us one of the most reliable answers to searches like the best taxi service near me.</li>
                        <li><span class="fw-bold text-dark">Reliable Airport Cab Service</span> Timely, stress-free, and comfortable airport transfers are still one of our strong areas of service.</li>
                        <li><span class="fw-bold text-dark">Affordable and Transparent Pricing.</span> Our budget taxi service assures affordability, sans compromising on quality.</li>
                        <li><span class="fw-bold text-dark">Daily Taxi Service that Works</span> Our day-to-day taxi service provides continuity and reliability to regular commuters.</li>
                        <li><span class="fw-bold text-dark">Safety above everything</span> From routine vehicle maintenance to driver verification, safety is never optional-it is standard.</li>
                    </ul>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        Our outstation services are relied on by corporate travellers and families alike for comfort and safety, complemented by professional service from a reliable taxi service company.
                    </p>
                    <hr class="my-4">
                    <h3 class="fw-bold mb-3" style="font-size:1.7rem;">
                        <span class="text-highlight">Clean and Well-Maintained Fleet</span> <span class="text-dark">to Suit Every Need</span>
                    </h3>
                    <ul class="ps-3 mb-1" style="font-size:1.08rem;">
                        <li>Regular servicing.</li>
                        <li>Professionally cleaned and sanitised.</li>
                        <li>Equipped for Comfort and Safety.</li>
                    </ul>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        At Gurgaon Taxi Service, we believe that, be it a compact car, a spacious sedan, or an SUV, every ride should boast a high level of quality. For us, clean interiors, smooth driving, and comfortable seating are not extras; they are basic.
                    </p>
                    <hr class="my-4">
                    <h3 class="fw-bold mb-3" style="font-size:1.7rem;">
                        <span class="text-dark">Professional and Courteous Drivers</span>
                    </h3>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        Everything starts with the driver when it comes to a great cab experience. That is why we work only with trained, background-verified chauffeurs who understand the importance of professionalism as part of our reliable Gurgaon taxi service.
                    </p>
                    <ul class="ps-3 mb-1" style="font-size:1.08rem;">
                        <li>Polite and well-trained.</li>
                        <li>Familiar with Gurgaon routes.</li>
                        <li>Punctual and responsible.</li>
                        <li>Focused on passenger comfort.</li>
                    </ul>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        Whether it is a short city ride or a long outstation journey, the top priorities are always safety and courtesy.
                    </p>
                    <hr class="my-4">
                    <h3 class="fw-bold mb-3" style="font-size:1.7rem;">
                        <span class="text-highlight">Our Commitment</span> <span class="text-dark">to Quality Service</span>
                    </h3>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        Quality at Gurgaon Cab Service is not a promise but a practice. Every ride depicts our dedication to the satisfaction, comfort, and reliability of our customers.
                    </p>
                    <ul class="ps-3 mb-1" style="font-size:1.08rem;">
                        <li>Improve service response time.</li>
                        <li>Hygiene in vehicles.</li>
                        <li>Training of drivers.</li>
                        <li>Enhancing the experience of customers.</li>
                    </ul>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        This commitment is what makes us one of the most dependable names in Gurgaon’s transportation space as a trusted Gurugram taxi service.
                    </p>
                    <hr class="my-4">
                    <h3 class="fw-bold mb-3" style="font-size:1.7rem;">
                        <span class="text-dark">Your Go-To Choice for</span> <span class="text-highlight">Comfortable & Reliable Cab Travel in Gurgaon</span>
                    </h3>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        You would want a taxi service you can rely on. The goal remains pretty simple-to travel around the city easily and in comfort. With neat, well-kept cars, skilled drivers, and timely pickups, commutes within Gurgaon end up becoming hassle-free. Whether it is your daily ride, airport transfer, or going out of town, dependable taxi services will guarantee a smooth experience. Easy booking, transparent pricing, availability 24*7- these are what differentiate the best taxi services in Gurgaon, best taxi service in Gurgaon, best cab service in Gurgaon.
                    </p>
                    <hr class="my-4">
                    <h3 class="fw-bold mb-3" style="font-size:1.7rem;">
                        <span class="text-highlight">More Than Just a Ride</span> <span class="text-dark">- A Travel Experience</span>
                    </h3>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        Choosing a cab should feel simple and stress-free. This is the experience that we try to deliver every time there is a booking. Whether someone needs the nearest taxi service or a reliable airport taxi service, or if one needs a comfortable outstation ride, our focus remains on smooth journeys and happy customers with our trusted Gurugram cab service.
                    </p>
                    <hr class="my-4">
                    <h3 class="fw-bold mb-3" style="font-size:1.7rem;">
                        <span class="text-dark">Book with Confidence</span>
                    </h3>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        Choosing a cab should feel simple and stress-free. This is the experience that we try to deliver every time there is a booking. When you need a cab service company that will provide a blend of affordability, professionalism, and comfort, Gurgaon Cab Service is ready for your service.
                    </p>
                    <div class="mb-3">
                        <span class="fw-bold text-highlight" style="font-size:1.1rem;">Book today and Experience:</span>
                        <ul class="ps-3 mb-1" style="font-size:1.08rem;">
                            <li>Safe travels</li>
                            <li>Comfortable rides</li>
                            <li>Professional service</li>
                            <li>Affordable pricing</li>
                        </ul>
                    </div>
                    <p class="mb-3 text-secondary" style="font-size:1.08rem; text-align:justify;">
                        From daily commuting to travel for special occasions, rely on Gurgaon Cab Service, where each journey is steered by care, comfort, and commitment.
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
