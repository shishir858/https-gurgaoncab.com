@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('content')
<!-- Statistics Cards -->
<div class="row g-4 mb-4 ">
    <div class="col-md-4 col-sm-6">
        <div class="card stat-card shadow-sm border-0 rounded-4 h-100 d-flex flex-column align-items-center justify-content-center p-4 bg-success text-white">
            <div class="d-flex flex-column align-items-center">
                <i class="bi bi-calendar-check mb-2" style="font-size: 2.5rem;"></i>
                <h3 class="fw-bold mb-1">{{ $stats['total_bookings'] ?? 0 }}</h3>
                <p class="mb-0 opacity-75">Total Enquiries</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card stat-card shadow-sm border-0 rounded-4 h-100 d-flex flex-column align-items-center justify-content-center p-4 bg-warning text-dark">
            <div class="d-flex flex-column align-items-center">
                <i class="bi bi-envelope mb-2" style="font-size: 2.5rem;"></i>
                <h3 class="fw-bold mb-1">{{ $stats['pending_enquiries'] ?? 0 }}</h3>
                <p class="mb-0 opacity-75">Pending Enquiries</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <!-- Recent Bookings -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4 h-100">
            <div class="card-header bg-white border-0 pt-4 pb-3 rounded-top-4">
                <h5 class="fw-bold mb-0"><i class="bi bi-calendar-check me-2"></i>Recent Bookings</h5>
            </div>
            <div class="card-body rounded-bottom-4">
                @if($recentBookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Vehicle</th>
                                    <th>Booking Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings as $booking)
                                <tr>
                                    <td>#{{ $booking->id }}</td>
                                    <td>{{ $booking->user ? $booking->user->name : 'N/A' }}</td>
                                    <td>{{ $booking->vehicle->name ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y') }}</td>
                                    <td class="fw-bold">₹{{ number_format($booking->total_amount, 0) }}</td>
                                    <td>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        <p>No bookings yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Enquiries -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4 h-100">
            <div class="card-header bg-white border-0 pt-4 pb-3 rounded-top-4">
                <h5 class="fw-bold mb-0"><i class="bi bi-envelope me-2"></i>Recent Enquiries</h5>
            </div>
            <div class="card-body rounded-bottom-4">
                @if($recentEnquiries->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentEnquiries as $enquiry)
                        <div class="list-group-item px-0 border-0 border-bottom">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="mb-1 fw-bold">{{ $enquiry->name }}</h6>
                                <span class="badge {{ $enquiry->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                                    {{ ucfirst($enquiry->status) }}
                                </span>
                            </div>
                            <p class="mb-1 small text-muted">{{ Str::limit($enquiry->message, 60) }}</p>
                            <small class="text-muted">
                                <i class="bi bi-clock me-1"></i>{{ $enquiry->created_at->diffForHumans() }}
                            </small>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        <p>No enquiries yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4 mt-2">
    {{-- Removed: Quick Actions for non-cab services --}}
</div>
@endsection
