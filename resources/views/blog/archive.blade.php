@extends('layout.app')

@push('meta')
    <title>{{ $meta_title ?? 'Blog Archive' }}</title>
    @if(!empty($meta_description))
        <meta name="description" content="{{ $meta_description }}">
    @endif
    @if(!empty($meta_keywords))
        <meta name="keywords" content="{{ $meta_keywords }}">
    @endif
@endpush

@section('content')
<!-- Blog Hero Section -->
<section class="hero-section position-relative w-100" style="background: linear-gradient(rgba(34,34,34,0.6),rgba(34,34,34,0.6)), url('{{ asset('images/banner5.webp') }}') center center / cover no-repeat; min-height: 300px;">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 300px;">
        <div class="text-center text-white">
            <h1 class="display-3 fw-bold mb-3">Our Blog</h1>
            <p class="lead">Read our latest travel tips, stories, and updates</p>
        </div>
    </div>
</section>
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="row g-4">
                @foreach($blogs as $blog)
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            @if($blog->feature_image)
                                <img src="{{ asset($blog->feature_image) }}" alt="{{ $blog->title }}" class="card-img-top" style="height:220px; object-fit:cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="fw-bold mb-2"><a href="{{ route('blog.show', $blog->slug) }}" class="text-dark text-decoration-none">{{ $blog->title }}</a></h5>
                                <div class="text-muted small mb-2">{{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('d M Y') : '' }}</div>
                                <div class="mb-2">{{ Str::limit(strip_tags($blog->content), 120) }}</div>
                                <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-sm btn-warning rounded-pill fw-bold">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">{{ $blogs->links() }}</div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="bi bi-search me-2"></i>Search Blog</h5>
                    <form method="GET" action="{{ route('blog.archive') }}">
                        <input type="text" name="q" class="form-control mb-2" placeholder="Search..." value="{{ request('q') }}">
                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-chat-dots text-primary me-2"></i>Quick Enquiry</h5>
                    @include('components.enquiry-form')
                </div>
            </div>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
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
