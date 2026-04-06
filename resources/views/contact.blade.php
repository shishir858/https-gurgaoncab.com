@extends('layout.app')

@section('meta')
    <title>Contact Gurgaon Cab Service - Get in Touch</title>
    <meta name="description" content="Contact Gurgaon Cab Service for cab bookings, tour packages, and travel support. Reach us by phone, email, or visit our office in New Delhi.">
    <meta name="keywords" content="contact Gurgaon Cab Service, cab booking, India tours, phone, email, office">
    <link rel="canonical" href="{{ url()->current() }}">
@endsection
@section('content')
    @php
        use App\Models\Setting;
        $settings = Cache::remember('site_settings', 3600, function() {
            return Setting::pluck('value', 'key')->toArray();
        });
    @endphp

    <!-- Hero Section -->
    <section class="hero-section position-relative w-100" style="background: linear-gradient(rgba(34,34,34,0.6),rgba(34,34,34,0.6)), url('{{ asset('images/contact.webp') }}') center center / cover no-repeat; min-height: 300px;">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 300px;">
            <div class="text-center text-white">
                <h1 class="display-3 fw-bold mb-3">Contact Us</h1>
                <p class="lead">Get in touch with gurgaoncab Tour & Travel</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Contact Information -->
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-4">Get In Touch</h2>
                    <p class="text-secondary mb-4">
                        Have questions about our tours? Need help planning your next adventure? We're here to help! Reach out to us through any of the following channels.
                    </p>

                    <div class="mb-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-geo-alt-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Office Address</h6>
                                <p class="text-secondary mb-0">
                                    {!! nl2br(e($settings['contact_address'] ?? '2nd Floor, MG Road, Near Metro Station, Connaught Place, New Delhi 110001, India')) !!}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-telephone-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Phone</h6>
                                <p class="text-secondary mb-0">
                                    {{ $settings['contact_phone'] ?? '+91 9672965873' }}<br>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-envelope-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Email</h6>
                                <p class="text-secondary mb-0">
                                    {{ $settings['contact_email'] ?? 'info@gurgaoncab.com' }}<br>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-clock-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Working Hours</h6>
                                <p class="text-secondary mb-0">
                                    Monday - Saturday: 9:00 AM - 7:00 PM<br>
                                    Sunday: 10:00 AM - 5:00 PM
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ $settings['social_facebook'] ?? '#' }}" class="btn btn-primary btn-sm rounded-circle" style="width: 40px; height: 40px; line-height: 26px;"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $settings['social_linkedin'] ?? '#' }}" class="btn btn-info btn-sm rounded-circle text-white" style="width: 40px; height: 40px; line-height: 26px;"><i class="bi bi-linkedin"></i></a>
                        <a href="{{ $settings['social_instagram'] ?? '#' }}" class="btn btn-danger btn-sm rounded-circle" style="width: 40px; height: 40px; line-height: 26px;"><i class="bi bi-instagram"></i></a>
                        <a href="{{ $settings['whatsapp_link'] ?? 'https://wa.me/919876543210' }}" class="btn btn-success btn-sm rounded-circle" style="width: 40px; height: 40px; line-height: 26px;"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="bg-light rounded-4 shadow p-4">
                        <h3 class="fw-bold mb-4">Send us a Message</h3>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        @include('components.enquiry-form')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section (Optional) -->
    <section class="py-0">
        <div class="container-fluid px-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d449137.8132799402!2d76.990081!3d28.422601000000004!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d19d582e38859%3A0x2cf5fe8e5c64b1e!2sGurugram%2C%20Haryana!5e0!3m2!1sen!2sin!4v1772787144839!5m2!1sen!2sin" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
@endsection
