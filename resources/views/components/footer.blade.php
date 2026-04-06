
@php
    use App\Models\Setting;
    $settings = Cache::remember('site_settings', 3600, function() {
        return Setting::pluck('value', 'key')->toArray();
    });
@endphp

<!-- Testimonial Section -->
    <section class="testimonial-section py-5 position-relative" style="background: url('{{ asset('images/banners/testimonial-bg.jpg') }}') center/cover no-repeat fixed;">
        <div class="testimonial-checkered-bar w-100 position-absolute bottom-0 start-0" style="height:24px; background: repeating-linear-gradient(90deg, #ffc107 0 24px, #222 24px 48px); z-index:3;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="text-center mb-2">
                <span class="fw-bold text-warning" style="letter-spacing:2px; font-size:1.1rem;">TESTIMONIALS</span>
            </div>
            <h2 class="fw-bold text-center mb-3" style="font-size:2.2rem; color:#fff;">What Our Client <span class="text-warning">Say's</span></h2>
            <div class="text-center mb-4">
                <span style="display:inline-block; border-bottom:4px solid #ffc107; width:60px;"></span>
            </div>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center g-4">
                            <div class="col-md-3 col-sm-6 d-flex">
                                <div class="testimonial-card bg-white rounded-4 shadow-lg p-4 w-100 position-relative">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="testimonial-avatar me-2" style="background:#eaf4ff; border-radius:50%; width:38px; height:38px; display:flex; align-items:center; justify-content:center;">
                                            <img src="{{ asset('images/icons/happy.svg') }}" alt="Customer" style="width:28px; height:28px;">
                                        </div>
                                        <div>
                                            <div class="fw-bold">Suman Rathi</div>
                                            <div class="text-warning small">Customer</div>
                                        </div>
                                    </div>
                                    <div class="testimonial-text text-dark mb-0" style="font-size:1rem;">I've tried many services, but Gurgaon Cab Service gave me the most stress-free Gurgaon to Dehradun trip. Professional and reliable.</div>
                                    <div class="testimonial-highlight position-absolute top-0 end-0" style="height:4px; width:60px; background:#ffc107; border-radius:2px;"></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 d-flex">
                                <div class="testimonial-card bg-white rounded-4 shadow-lg p-4 w-100 position-relative">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="testimonial-avatar me-2" style="background:#eaf4ff; border-radius:50%; width:38px; height:38px; display:flex; align-items:center; justify-content:center;">
                                            <img src="{{ asset('images/icons/happy.svg') }}" alt="Customer" style="width:28px; height:28px;">
                                        </div>
                                        <div>
                                            <div class="fw-bold">Vikram Joshi</div>
                                            <div class="text-warning small">Customer</div>
                                        </div>
                                    </div>
                                    <div class="testimonial-text text-dark mb-0" style="font-size:1rem;">Booked an SUV for Gurgaon to Shimla. Smooth ride, AC worked perfectly, and the driver was very cooperative. Will book again.</div>
                                    <div class="testimonial-highlight position-absolute top-0 end-0" style="height:4px; width:60px; background:#ffc107; border-radius:2px;"></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 d-flex">
                                <div class="testimonial-card bg-white rounded-4 shadow-lg p-4 w-100 position-relative">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="testimonial-avatar me-2" style="background:#eaf4ff; border-radius:50%; width:38px; height:38px; display:flex; align-items:center; justify-content:center;">
                                            <img src="{{ asset('images/icons/happy.svg') }}" alt="Customer" style="width:28px; height:28px;">
                                        </div>
                                        <div>
                                            <div class="fw-bold">Anil Kapoor</div>
                                            <div class="text-warning small">Customer</div>
                                        </div>
                                    </div>
                                    <div class="testimonial-text text-dark mb-0" style="font-size:1rem;">Needed an urgent cab late at night in Sector 29. They arranged one quickly. Felt safe throughout the ride.</div>
                                    <div class="testimonial-highlight position-absolute top-0 end-0" style="height:4px; width:60px; background:#ffc107; border-radius:2px;"></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 d-flex">
                                <div class="testimonial-card bg-white rounded-4 shadow-lg p-4 w-100 position-relative">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="testimonial-avatar me-2" style="background:#eaf4ff; border-radius:50%; width:38px; height:38px; display:flex; align-items:center; justify-content:center;">
                                            <img src="{{ asset('images/icons/happy.svg') }}" alt="Customer" style="width:28px; height:28px;">
                                        </div>
                                        <div>
                                            <div class="fw-bold">Neeraj Bansal</div>
                                            <div class="text-warning small">Customer</div>
                                        </div>
                                    </div>
                                    <div class="testimonial-text text-dark mb-0" style="font-size:1rem;">I use their local cab service daily from Sohna Road to Cyber City. Cars are always on time and well-maintained.</div>
                                    <div class="testimonial-highlight position-absolute top-0 end-0" style="height:4px; width:60px; background:#ffc107; border-radius:2px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <span class="testimonial-dot bg-warning mx-1" style="display:inline-block; width:16px; height:6px; border-radius:3px;"></span>
                    <span class="testimonial-dot bg-warning mx-1" style="display:inline-block; width:16px; height:6px; border-radius:3px; opacity:0.5;"></span>
                    <span class="testimonial-dot bg-warning mx-1" style="display:inline-block; width:16px; height:6px; border-radius:3px; opacity:0.5;"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Prefooter Section -->
    <section class="prefooter-section py-5 position-relative" style="background:#ffc107;">
        <div class="prefooter-checkered-bar w-100 position-absolute top-0 start-0" style="height:24px; background: repeating-linear-gradient(90deg, #222 0 24px, #ffc107 24px 48px); z-index:3;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">
                <div class="col-md-7 mb-4 mb-md-0">
                    <h2 class="fw-bold mb-3" style="font-size:1.5rem;">Book Your Cab It's Simple And Affordable</h2>
                    <p class="mb-0 text-dark" style="max-width:500px;">Book your cab easily and affordably with us. Enjoy quick booking, comfortable rides, professional drivers, and budget-friendly prices for local and outstation travel anytime, anywhere.</p>
                </div>
                <div class="col-md-5 d-flex flex-column align-items-center justify-content-center">
                    <div class="fw-bold text-center mb-3" style="font-size:2rem; color:#fff;">+91 9672965873</div>
                    <a href="#" class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow">BOOK YOUR CAB</a>
                </div>
            </div>
        </div>
        <div class="prefooter-checkered-bar w-100 position-absolute bottom-0 start-0" style="height:24px; background: repeating-linear-gradient(90deg, #222 0 24px, #ffc107 24px 48px); z-index:3;"></div>
    </section>

<footer class="footer-main bg-black text-light pt-0 position-relative" style="overflow:hidden;">
    <!-- Checkered Top Bar -->
    <div class="footer-checkered-bar" style="background: repeating-linear-gradient(90deg, #ffc107 0 20px, #000 20px 40px); height:24px;"></div>
    <div class="container py-5">
        <div class="row gy-4">
            <!-- About & Contact -->
            <div class="col-md-4">
                <div class="mb-3">
                    <span class="fw-bold fs-5">Gurgaon Cab Service</span>
                </div>
                <div class="mb-3 small">
                    Gurgaon Cab Service offers reliable taxi services with all vehicle types and customized North India tour packages for a comfortable, safe, and memorable travel experience.
                </div>
                <div class="mb-3 d-flex flex-column gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="footer-icon bg-warning text-black rounded-circle d-flex align-items-center justify-content-center" style="width:32px; height:32px;"><i class="bi bi-telephone-fill"></i></span>
                        <span class="small">+91 9672965873</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="footer-icon bg-warning text-black rounded-circle d-flex align-items-center justify-content-center" style="width:32px; height:32px;"><i class="bi bi-geo-alt-fill"></i></span>
                        <span class="small">Plot No 8, Sector 58, Gurgaon, Haryana 122011</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="footer-icon bg-warning text-black rounded-circle d-flex align-items-center justify-content-center" style="width:32px; height:32px;"><i class="bi bi-envelope-fill"></i></span>
                        <span class="small">gurgaoncab5873@gmail.com</span>
                    </div>
                </div>
            </div>
            <!-- Quick Links -->
            <div class="col-md-2">
                <div class="fw-bold mb-2">Quick Links</div>
                <ul class="list-unstyled small">
                    <li><a href="/" class="text-light text-decoration-none">Home</a></li>
                    <li><a href="/about" class="text-light text-decoration-none">About Us</a></li>
                    <li><a href="/services" class="text-light text-decoration-none">Services</a></li>
                    <li><a href="/vehicles" class="text-light text-decoration-none">Our Vehicle</a></li>
                    <li><a href="/contact" class="text-light text-decoration-none">Contact Us</a></li>
                </ul>
            </div>
            <!-- Services -->
            <div class="col-md-3">
                <div class="fw-bold mb-2">Services</div>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-light text-decoration-none">Taxi Service all types of vehicles</a></li>
                    <li><a href="#" class="text-light text-decoration-none">North India Famous Tour Package</a></li>
                </ul>
            </div>
            <!-- Newsletter -->
            <div class="col-md-3">
                <div class="fw-bold mb-2">Newsletter</div>
                <div class="small mb-2">Subscribe Our Newsletter To Get Latest Update And News</div>
                <form class="footer-newsletter-form" autocomplete="off">
                    <div class="mb-2">
                        <input type="email" class="form-control rounded-3" placeholder="Your Email" style="color:#000; border:none;">
                    </div>
                    <button type="submit" class="btn btn-warning w-100 rounded-3 fw-bold d-flex align-items-center justify-content-center gap-2" style="font-size:1rem;">
                        SUBSCRIBE NOW <i class="bi bi-send"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Bottom Bar -->
    <div class="footer-bottom-bar bg-black py-3 px-2 position-relative" style="border-top: 4px solid #ffc107;">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="small mb-2 mb-md-0 text-light">
                &copy; Copyright 2026 Gurgaon Cab Service All Rights Reserved.
            </div>
            <div class="d-flex gap-3">
                <a href="#" class="footer-social-icon bg-warning text-black rounded-circle d-flex align-items-center justify-content-center" style="width:36px; height:36px;"><i class="bi bi-facebook"></i></a>
                <a href="#" class="footer-social-icon bg-warning text-black rounded-circle d-flex align-items-center justify-content-center" style="width:36px; height:36px;"><i class="bi bi-instagram"></i></a>
                <a href="#" class="footer-social-icon bg-warning text-black rounded-circle d-flex align-items-center justify-content-center" style="width:36px; height:36px;"><i class="bi bi-link-45deg"></i></a>
                <a href="#" class="footer-social-icon bg-warning text-black rounded-circle d-flex align-items-center justify-content-center" style="width:36px; height:36px;"><i class="bi bi-geo-alt-fill"></i></a>
            </div>
        </div>
        <!-- Up Arrow Button -->
        <a href="#" class="position-absolute end-0 bottom-0 mb-3 me-3 bg-warning text-black rounded-circle d-flex align-items-center justify-content-center shadow" style="width:48px; height:48px; z-index:1050;">
            <i class="bi bi-arrow-up fs-3"></i>
        </a>
    </div>
    <!-- Fixed WhatsApp and Call Buttons -->
    <a href="https://wa.me/919672965873" target="_blank" class="position-fixed end-0 bottom-0 mb-4 me-4 bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width:56px; height:56px; z-index:1050; bottom:40px !important;">
        <i class="bi bi-whatsapp fs-2"></i>
    </a>
    <a href="tel:+919672965873" class="position-fixed end-0 bottom-0 mb-20 me-4 text-white rounded-circle d-flex align-items-center justify-content-center shadow call-button-shake" style="background: linear-gradient(135deg, #ffc400 0%, #f7931e 100%); width:60px; height:60px; z-index:1050; bottom:40px !important;left: 32px;">
        <i class="bi bi-telephone-fill fs-2"></i>
        <span class="position-absolute call-ring"></span>
        <span class="position-absolute call-ring" style="animation-delay: 0.5s;"></span>
    </a>
    <style>
        .footer-main { font-family:inherit; }
        .footer-checkered-bar { width:100%; }
        .footer-icon { font-size:1.2rem; }
        .footer-social-icon { font-size:1.3rem; transition:background 0.2s; }
        .footer-social-icon:hover { background:#fff200; color:#000; }
        .footer-newsletter-form input:focus { outline:none; box-shadow:none; border:1px solid #ffc107; }
        @media (max-width: 768px) {
            .footer-bottom-bar .container { flex-direction:column !important; gap:1rem; }
        }
        /* Call Button Animation Styles */
        @keyframes phoneShake {
            0%, 100% { transform: rotate(0deg); }
            10%, 30%, 50%, 70%, 90% { transform: rotate(-8deg); }
            20%, 40%, 60%, 80% { transform: rotate(8deg); }
        }
        @keyframes ringPulse {
            0% { transform: scale(1); opacity: 0.7; }
            50% { transform: scale(1.4); opacity: 0.3; }
            100% { transform: scale(1.8); opacity: 0; }
        }
        .call-button-shake {
            animation: phoneShake 1s ease-in-out infinite;
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.5);
            transition: all 0.3s ease;
        }
        .call-ring {
            content: '';
            width: 100%;
            height: 100%;
            border: 3px solid #ff6b35;
            border-radius: 50%;
            animation: ringPulse 2s infinite;
            top: 0;
            left: 0;
        }
        .call-button-shake:hover {
            animation: none;
            transform: scale(1.15);
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.8);
            background: linear-gradient(135deg, #f7931e 0%, #ff6b35 100%);
        }
        .call-button-shake:hover .call-ring {
            animation: none;
        }
    </style>
</footer>
