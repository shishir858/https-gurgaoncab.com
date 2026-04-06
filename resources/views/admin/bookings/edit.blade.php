@extends('admin.layout')

@section('page-title', 'Edit Booking')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Booking #{{ $booking->id }}</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Package</label>
                            <input type="text" class="form-control" value="{{ $booking->package->name }}" disabled>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Customer</label>
                            <input type="text" class="form-control" value="{{ $booking->user->name }}" disabled>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tour Date</label>
                            <input type="date" name="tour_date" class="form-control @error('tour_date') is-invalid @enderror" 
                                   value="{{ old('tour_date', $booking->tour_date) }}" required>
                            @error('tour_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Number of People</label>
                            <input type="number" name="number_of_people" class="form-control @error('number_of_people') is-invalid @enderror" 
                                   value="{{ old('number_of_people', $booking->number_of_people) }}" min="1" required>
                            @error('number_of_people')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Total Amount (₹)</label>
                            <input type="number" name="total_amount" class="form-control @error('total_amount') is-invalid @enderror" 
                                   value="{{ old('total_amount', $booking->total_amount) }}" required>
                            @error('total_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Payment Status</label>
                            <select name="payment_status" class="form-select @error('payment_status') is-invalid @enderror" required>
                                <option value="pending" {{ old('payment_status', $booking->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ old('payment_status', $booking->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="failed" {{ old('payment_status', $booking->payment_status) == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                            @error('payment_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Booking Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="bi bi-save me-2"></i>Update Booking
                            </button>
                            <!-- <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary px-4 ms-2">Cancel</a> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
