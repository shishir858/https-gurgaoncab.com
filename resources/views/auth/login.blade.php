@extends('layout.app')

@section('content')
    <section class="py-5" style="min-height: 100vh; background: linear-gradient(120deg, #232526 0%, #414345 100%); font-family: 'Poppins', sans-serif;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow rounded-4" style="background:rgba(255,255,255,0.97);">
                        <div class="card-body p-4">
                            <div class="text-center mb-2">
                                <i class="bi bi-person-circle" style="font-size: 2rem; color: #232526;"></i>
                                <h2 class="fw-semibold  mb-1" style="font-size:1.5rem; letter-spacing:-1px;">Admin Login</h2>
                                <p class="text-muted mb-0" style="font-size:1.05rem;">Sign in to your admin dashboard</p>
                            </div>

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="mb-2">
                                    <label for="email" class="form-label fw-small" style="font-size:0.8rem;">Email Address</label>
                                    <input type="email"
                                           class="form-control form-control-md @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="Enter your email"
                                           required
                                           style="font-size:0.8rem; padding:0.85rem 1rem; border-radius:0.7rem;">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="password" class="form-label fw-small" style="font-size:0.8rem;">Password</label>
                                    <input type="password"
                                           class="form-control form-control-md @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           placeholder="Enter your password"
                                           required
                                           style="font-size:0.8rem; padding:0.85rem 1rem; border-radius:0.7rem;">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-dark btn-lg w-100 fw-semibold mb-3" style="font-size:1.15rem; border-radius:0.7rem; letter-spacing:0.5px;">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                </button>
                            </form>

                            <hr class="my-2">
                            <div class="text-center">
                                <small class="text-muted" style="font-size:0.8rem;">
                                    <strong>Demo Credentials:</strong><br>
                                    Admin: admin@example.com / admin123
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
