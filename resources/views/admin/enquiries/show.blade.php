@extends('admin.layout')

@section('page-title', 'Enquiry Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-lg border-0 rounded-4 mt-4">
            <div class="card-header bg-primary text-white border-0 pt-4 pb-3 rounded-top-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold mb-0">Enquiry #{{ $enquiry->id }}</h4>
                    <span class="badge {{ $enquiry->status == 'pending' ? 'bg-warning' : 'bg-success' }} px-3 py-2 fs-6">{{ ucfirst($enquiry->status) }}</span>
                </div>
            </div>
            <div class="card-body rounded-bottom-4 p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="text-muted small">Name</label>
                        <div class="fw-bold fs-5">{{ $enquiry->name }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Passenger</label>
                        <div class="fw-bold fs-5">{{ $enquiry->passenger }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Email</label>
                        <div class="fw-bold fs-5">{{ $enquiry->email }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Phone</label>
                        <div class="fw-bold fs-5">{{ $enquiry->phone }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Pickup Location</label>
                        <div class="fw-bold fs-5">{{ $enquiry->pickup_location }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Drop Location</label>
                        <div class="fw-bold fs-5">{{ $enquiry->drop_location }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Vehicle Type</label>
                        <div class="fw-bold fs-5">{{ $enquiry->vehicle_type }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Pickup Date</label>
                        <div class="fw-bold fs-5">{{ $enquiry->date }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Pickup Time</label>
                        <div class="fw-bold fs-5">{{ $enquiry->pickup_time }}</div>
                    </div>
                    <div class="col-md-12">
                        <label class="text-muted small">Message</label>
                        <div class="fw-bold fs-5">{{ $enquiry->message }}</div>
                    </div>
                </div>
                <hr>
                <form action="{{ route('admin.enquiries.update', $enquiry->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="d-flex align-items-center gap-3">
                        <label class="text-muted small mb-0">Change Status:</label>
                        <select name="status" class="form-select w-auto">
                            <option value="pending" {{ $enquiry->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $enquiry->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $enquiry->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
