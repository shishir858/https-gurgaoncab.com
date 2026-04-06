</section>
{{-- Hero Banner Component --}}
<style>
    a{
        text-decoration: none;
    }
@media (max-width: 767.98px) {
    #heroSliderBg {
        background-image: linear-gradient(rgba(34,34,34,0.7),rgba(34,34,34,0.7)), url('{{ asset('images/banners/mob-banner2.png') }}') !important;
        background-size: cover !important;
        background-position: center center !important;
    }
    #heroSliderBg .row.g-0 {
        min-height: 345px !important;
    }
}
</style>
<section id="heroSliderBg" class="hero-slider-clean position-relative w-100 py-5 py-md-6" style="background: linear-gradient(rgba(34,34,34,0.7),rgba(34,34,34,0.7)), url('{{ asset('images/banners/banner1.jpg') }}') center center / cover no-repeat; transition: background-image 0.7s;">
    <div class="container-fluid px-0">
        <div class="row g-0 align-items-center flex-column flex-lg-row" style="min-height:320px; min-height:480px;@media (min-width: 768px){min-height:480px;}">
            <!-- Unified Slider Content for All Devices -->
            <div class="col-12 d-flex flex-column justify-content-center align-items-center px-3 px-md-5 py-4 py-lg-0 text-center position-relative" id="heroBannerContent">
                <!-- Content will be injected by JS -->
            </div>
            <!-- Banner Controller (Visible only on desktop) -->
            <div class="position-absolute w-100 justify-content-between align-items-center d-none d-md-flex" style="top:50%; left:0; z-index:2; pointer-events:none;">
                <button id="heroPrevBtn" class="btn btn-dark btn-lg rounded-circle ms-3" style="box-shadow:0 2px 12px rgba(0,0,0,0.10); pointer-events:auto;"><i class="bi bi-chevron-left"></i></button>
                <button id="heroNextBtn" class="btn btn-dark btn-lg rounded-circle me-3" style="box-shadow:0 2px 12px rgba(0,0,0,0.10); pointer-events:auto;"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>
        <!-- Booking Form: Only visible on desktop -->
        <div class="d-none d-md-block position-relative" style="z-index:10;">
            <div class="book-ride-form-wrapper position-absolute start-50 translate-middle-x" style="top:-60px; width:80%; max-width:1100px;">
                <form action="{{ route('cab-enquiry.store') }}" method="POST" class="bg-white rounded-4 shadow-lg px-4 py-4" style="box-shadow:0 8px 32px rgba(0,0,0,0.10);">
                    @csrf
                    <div class="fw-bold fs-4 mb-3">Book Your Ride</div>
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control form-control-sm rounded-3" name="name" placeholder="Enter Name" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control form-control-sm rounded-3" name="phone" placeholder="Phone" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Pick Up Location</label>
                            <input type="text" class="form-control form-control-sm rounded-3" name="pickup_location" placeholder="Pick Up Location" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Drop Off Location</label>
                            <input type="text" class="form-control form-control-sm rounded-3" name="drop_location" placeholder="Drop Off Location" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Cab Type</label>
                            <select class="form-select form-select-sm rounded-3" name="vehicle_type" required>
                                <option value="">Choose Cab</option>
                                <option value="5 Seater">5 Seater</option>
                                <option value="Sedan">Sedan</option>
                                <option value="SUV">SUV</option>
                                <option value="Tempo Traveler">Tempo Traveler</option>
                                <option value="Luxury">Luxury</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Pick Up Date</label>
                            <input type="date" class="form-control form-control-sm rounded-3" name="date" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control form-control-sm rounded-3" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-3 d-flex align-items-end justify-content-end">
                            <button type="submit" class="btn btn-warning px-4 py-2 fw-bold text-dark w-100" style="border-radius:30px; font-size:1rem; box-shadow:0 2px 12px rgba(255,193,7,0.10);">BOOK TAXI</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <style>
        .hero-title-yellow { color: #ffc107; }
        .hero-title-white { color: #fff; }
        .hero-title-main {
            font-size: 2.8rem;
            font-weight: 900;
            line-height: 1.22;
            letter-spacing: 2.5px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.25);
            max-width: 850px;
            margin-left: auto;
            margin-right: auto;
            word-break: break-word;
        }
        @media (max-width: 767.98px) {
            .hero-title-main {
                font-size: 1.5rem;
            }
            .hero-title-sub {
                font-size: 0.9rem;
            }
            .hero-desc {
                font-size: 0.95rem;
            }
            .hero-btn-yellow, .hero-btn-white {
                padding-left: 1rem;
                padding-right: 1rem;
                min-width: 120px;
                font-size: 1rem;
                margin-right: 0.7rem;
            }
        }
        .hero-title-sub {
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            color: #ffc107;
            margin-bottom: 1.2rem;
            text-transform: uppercase;
            max-width: 850px;
            margin-left: auto;
            margin-right: auto;
        }
        .hero-desc {
            color: #fff;
            font-size: 1.08rem;
            margin-bottom: 2rem;
            text-shadow: 0 1px 6px rgba(0,0,0,0.18);
            max-width: 850px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
            letter-spacing: 0.5px;
        }
        .hero-btn-yellow {
            background: #ffc107;
            color: #111;
            border-radius: 30px;
            font-weight: 700;
            padding: 0.7rem 2.2rem;
            margin-right: 1rem;
            border: none;
            transition: background 0.2s, color 0.2s;
        }
        .hero-btn-yellow:hover { background: #000; color: #fff; }
        .hero-btn-white {
            background: #fff;
            color: #111;
            border-radius: 30px;
            font-weight: 700;
            padding: 0.7rem 2.2rem;
            border: none;
            transition: background 0.2s, color 0.2s;
        }
        .hero-btn-white:hover { background: #000; color: #fff; }
    </style>
</section>
<script>
// Hero background slider images and content (match screenshots)
const heroSliderImages = [
    '{{ asset('images/banners/1.webp') }}',
    '{{ asset('images/banners/2.webp') }}'
];
const heroSliderContents = [
    {
        sub: "WELCOME TO GURGAON CAB SERVICE",
        main: `<span class='hero-title-white'>TRUSTED GURGAON CAB<br><span class='hero-title-yellow'>JUST ₹13/KM</span></span>`,
        desc: "Book Gurugram’s most trusted cab for local, airport, or outstation trips. Safe rides, transparent pricing, and special offers for new users.",
        btn1: { text: "ABOUT MORE", link: "/about", yellow: true },
        btn2: { text: "CONTACT US", link: "/contact", yellow: false }
    },
    {
        sub: "WELCOME TO GURGAON CAB SERVICE",
        main: `<span class='hero-title-white'>DISCOVER <span class='hero-title-yellow'>NORTH INDIA</span><br>WITH EXPERT CABS</span>`,
        desc: "Explore famous North India trips with our expert cab service. Discover temples, hills, and heritage with comfort and ease.",
        btn1: { text: "ABOUT MORE", link: "/about", yellow: true },
        btn2: { text: "CONTACT US", link: "/contact", yellow: false }
    },
];
let heroSliderIndex = 0;
function updateHeroContent(idx) {
    const content = heroSliderContents[idx];
    const el = document.getElementById('heroBannerContent');
    if(el && content) {
        el.innerHTML = `
            <div class='hero-title-sub mb-2'>${content.sub}</div>
            <div class='hero-title-main mb-3'>${content.main}</div>
            <div class='hero-desc mb-4'>${content.desc}</div>
            <div class='d-flex justify-content-center gap-2'>
                <a href='${content.btn1.link}' class='hero-btn-yellow'>${content.btn1.text}</a>
                <a href='${content.btn2.link}' class='hero-btn-white'>${content.btn2.text}</a>
            </div>
        `;
    }
}
function updateHeroBg(idx) {
    const section = document.getElementById('heroSliderBg');
    if(section) {
        section.style.background = `linear-gradient(rgba(34,34,34,0.7),rgba(34,34,34,0.7)), url('${heroSliderImages[idx]}') center center / cover no-repeat`;
    }
}
updateHeroContent(heroSliderIndex);
updateHeroBg(heroSliderIndex);
// Auto slide
let heroSliderTimer = setInterval(() => {
    heroSliderIndex = (heroSliderIndex + 1) % heroSliderImages.length;
    updateHeroBg(heroSliderIndex);
    updateHeroContent(heroSliderIndex);
}, 4000);
// Manual controls
// Wait for DOMContentLoaded to ensure buttons exist
setTimeout(function() {
    const prevBtn = document.getElementById('heroPrevBtn');
    const nextBtn = document.getElementById('heroNextBtn');
    if(prevBtn && nextBtn) {
        prevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            clearInterval(heroSliderTimer);
            heroSliderIndex = (heroSliderIndex - 1 + heroSliderImages.length) % heroSliderImages.length;
            updateHeroBg(heroSliderIndex);
            updateHeroContent(heroSliderIndex);
            heroSliderTimer = setInterval(() => {
                heroSliderIndex = (heroSliderIndex + 1) % heroSliderImages.length;
                updateHeroBg(heroSliderIndex);
                updateHeroContent(heroSliderIndex);
            }, 4000);
        });
        nextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            clearInterval(heroSliderTimer);
            heroSliderIndex = (heroSliderIndex + 1) % heroSliderImages.length;
            updateHeroBg(heroSliderIndex);
            updateHeroContent(heroSliderIndex);
            heroSliderTimer = setInterval(() => {
                heroSliderIndex = (heroSliderIndex + 1) % heroSliderImages.length;
                updateHeroBg(heroSliderIndex);
                updateHeroContent(heroSliderIndex);
            }, 4000);
        });
    }
}, 300);
</script>

<!-- Mobile Booking Form: Separate section below banner -->
<div class="d-block d-md-none px-2 mb-4 p-2">
    <div class="bg-white bg-opacity-95 rounded-4 shadow-lg p-4 w-100" style="max-width: 500px; margin:auto;">
        <form action="{{ route('cab-enquiry.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-semibold">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Your Name" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Phone number" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Pick Up Location</label>
                    <input type="text" class="form-control" name="pickup_location" placeholder="Pick Up Location" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Drop Off Location</label>
                    <input type="text" class="form-control" name="drop_location" placeholder="Drop Off Location" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Cab Type</label>
                    <select class="form-select" name="vehicle_type" required>
                        <option value="">Select Cab Type</option>
                        <option value="5 Seater">5 Seater</option>
                        <option value="Sedan">Sedan</option>
                        <option value="SUV">SUV</option>
                        <option value="Tempo Traveler">Tempo Traveler</option>
                        <option value="Luxury">Luxury</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Pick Up Date</label>
                    <input type="date" class="form-control" name="date" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
            </div>
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-warning btn-lg rounded-pill fw-bold shadow">BOOK NOW</button>
            </div>
        </form>
    </div>
</div>
