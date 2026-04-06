@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 p-5 text-center">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size:3rem;"></i>
                </div>
                <h2 class="fw-bold mb-3">Thank You!</h2>
                <p class="fs-5">Your cab enquiry has been submitted successfully.<br>We will contact you soon with details.</p>
                <a href="/" class="btn btn-primary mt-3 rounded-pill px-4">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
