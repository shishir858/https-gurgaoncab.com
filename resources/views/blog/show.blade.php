@extends('layout.app')

@push('meta')
    <title>{{ $meta_title ?? $blog->title ?? 'Blog Details' }}</title>
    @if(!empty($meta_description))
        <meta name="description" content="{{ $meta_description }}">
    @endif
    @if(!empty($meta_keywords))
        <meta name="keywords" content="{{ $meta_keywords }}">
    @endif
    @if(!empty($canonical))
        <link rel="canonical" href="{{ $canonical }}">
    @endif
@endpush

@section('content')
<!-- Blog Hero Section -->
<div class="position-relative" style="height: 350px; overflow: hidden;">
    <img src="{{ $blog->feature_image ? asset($blog->feature_image) : asset('images/banner5.webp') }}" alt="{{ $blog->title }}" class="w-100 h-100" style="object-fit: cover;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.85));">
        <div class="container h-100 d-flex align-items-center pb-5">
            <div class="text-white">
                <h1 class="display-4 fw-bold mb-3">{{ $blog->title }}</h1>
                <div class="text-light mb-2">{{ $blog->published_at ? $blog->published_at->format('d M Y') : '' }}</div>
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
                    <div class="text-dark" style="text-align: justify;">
                        <style>
                            .blog-content img {
                                width: 100%;
                                max-height: 400px;
                                height: auto;
                                object-fit: contain;
                                display: block;
                                margin: 0 auto 1rem auto;
                            }
                        </style>
                        <div class="blog-content">
                            {!! $blog->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Enquiry Form (same as vehicle) -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-chat-dots text-primary me-2"></i>Quick Enquiry</h5>
                    @include('components.enquiry-form')
                </div>
            </div>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-journal-text me-2"></i>Recent Blogs</h5>
                    <ul class="list-unstyled mb-0">
                        @foreach($recentBlogs as $recent)
                            <li class="mb-2">
                                <a href="{{ route('blog.show', $recent->slug) }}" class="text-decoration-none text-dark">
                                    <i class="bi bi-chevron-right small text-primary"></i> {{ $recent->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
