@extends('admin.layout')

@section('page-title', 'Booking Details')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white pt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Booking #{{ $booking->id }}</h5>
                    <!-- <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-light">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a> -->
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <!-- Customer Details -->
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Customer Details</h6>
                        <div class="mb-2"><strong>Name:</strong> {{ $booking->user->name }}</div>
                        <div class="mb-2"><strong>Email:</strong> {{ $booking->user->email }}</div>
                        <div class="mb-2"><strong>Phone:</strong> {{ $booking->customer_phone }}</div>
                    </div>

                    <!-- Booking Details -->
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Booking Details</h6>
                        <div class="mb-2"><strong>Tour Date:</strong> {{ \Carbon\Carbon::parse($booking->tour_date)->format('M d, Y') }}</div>
                        <div class="mb-2"><strong>Number of People:</strong> {{ $booking->number_of_people }}</div>
                        <div class="mb-2"><strong>Booking Date:</strong> {{ $booking->created_at->format('M d, Y') }}</div>
                    </div>

                    <!-- Package Details -->
                    <div class="col-12">
                        <h6 class="fw-bold mb-3">Package Details</h6>
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="fw-bold">{{ $booking->package->name }}</h5>
                                <p class="text-muted mb-2">{{ $booking->package->destination->name }} - {{ $booking->package->duration }}</p>
                                <span class="badge bg-primary">{{ $booking->package->category->name }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Details -->
                    <div class="col-12">
                        <h6 class="fw-bold mb-3">Payment Details</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td><strong>Base Amount:</strong></td>
                                    <td class="text-end">₹{{ number_format($booking->package->discount_price ?? $booking->package->price, 0) }} x {{ $booking->number_of_people }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Amount:</strong></td>
                                    <td class="text-end fw-bold fs-5">₹{{ number_format($booking->total_amount, 0) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Payment Status:</strong></td>
                                    <td class="text-end">
                                        @if($booking->payment_status == 'paid')
                                            <span class="badge bg-success">Paid</span>
                                        @elseif($booking->payment_status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Failed</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Booking Status:</strong></td>
                                    <td class="text-end">
                                        @if($booking->status == 'confirmed')
                                            <span class="badge bg-success">Confirmed</span>
                                        @elseif($booking->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($booking->status == 'cancelled')
                                            <span class="badge bg-danger">Cancelled</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($booking->special_requests)
                        <div class="col-12">
                            <h6 class="fw-bold mb-3">Special Requests</h6>
                            <div class="p-3 bg-light rounded">{{ $booking->special_requests }}</div>
                        </div>
                    @endif
                </div>

                <div class="border-top pt-4 mt-4">
                    <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-2"></i>Edit Booking
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
