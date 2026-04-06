@extends('layout.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section position-relative w-100" style="background: linear-gradient(rgba(34,34,34,0.6),rgba(34,34,34,0.6)), url('{{ asset('images/enquiry.webp')}}') center center / cover no-repeat; min-height: 300px;">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 300px;">
            <div class="text-center text-white">
                <h1 class="display-3 fw-bold mb-3">About gurgaoncab Tour & Travel</h1>
                <p class="lead">Your trusted partner for unforgettable travel experiences across India</p>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-5">
    @section('meta')
        <title>About Gurgaon Cab Service - Trusted India Travel Agency</title>
        <meta name="description" content="Learn about Gurgaon Cab Service, your trusted partner for unforgettable travel experiences across India. 5+ years of expertise, personalized service, and 24/7 support.">
        <meta name="keywords" content="about Gurgaon Cab Service, India travel agency, trusted partner, experience, support">
        <link rel="canonical" href="{{ url()->current() }}">
    @endsection
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('images/about-director.webp')}}" alt="Director" class="w-100 rounded-3 shadow" style="height:400px; object-fit:cover;">
                </div>
                <div class="col-lg-6">
                    <div class="mb-2 text-uppercase fw-bold text-warning" style="letter-spacing:2px;">Director, Gurgaon Cab Services</div>
                    <h2 class="fw-bold mb-3">About Vikram Singh Yadav</h2>
                    <p class="text-secondary mb-3">
                        Mr. Vikram Singh Yadav is the founder and driving force behind Gurgaon Cab Services, a trusted cab and travel service provider catering to thousands of satisfied customers across Gurgaon and Delhi NCR. With a strong background in transport management and customer service, he has built a company that stands for reliability, safety, and convenience.
                    </p>
                    <p class="text-secondary mb-3">
                        Starting with a simple idea to make daily travel hassle-free and affordable Mr. Yadav has transformed Gurgaon Cab into a well-recognized brand for local city rides, airport transfers, corporate travel, and outstation trips. His leadership is rooted in hands-on experience, deep understanding of customer needs, and a constant focus on quality.
                    </p>
                    <p class="text-secondary mb-3">
                        To learn more about his professional journey and connect directly, visit his LinkedIn profile.
                    </p>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="fw-bold mb-4">Experience And Expertise</h2>
                    <p class="text-secondary mb-3">
                        Over the years, Mr. Yadav has gained extensive experience in managing transportation services with efficiency and trust. His expertise includes:
                    </p>
                    <ul class="list-unstyled fs-5">
                        <li class="mb-2 d-flex align-items-center"><i class="bi bi-truck me-2 text-success fs-3"></i> Fleet management and operations</li>
                        <li class="mb-2 d-flex align-items-center"><i class="bi bi-person-check me-2 text-primary fs-3"></i> Training and development of drivers</li>
                        <li class="mb-2 d-flex align-items-center"><i class="bi bi-star me-2 text-warning fs-3"></i> Customer service excellence</li>
                        <li class="mb-2 d-flex align-items-center"><i class="bi bi-map me-2 text-danger fs-3"></i> Route planning and safety management</li>
                        <li class="mb-2 d-flex align-items-center"><i class="bi bi-laptop me-2 text-info fs-3"></i> Digital transformation in transport services</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
