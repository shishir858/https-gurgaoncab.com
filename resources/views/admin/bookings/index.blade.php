@extends('admin.layout')

@section('page-title', 'Manage Bookings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">All Bookings</h4>
    <div>
        <select class="form-select d-inline-block w-auto" onchange="window.location.href=this.value">
            <!-- <option value="{{ route('admin.bookings.index') }}" {{ !request('status') ? 'selected' : '' }}>All Status</option>
            <option value="{{ route('admin.bookings.index', ['status' => 'pending']) }}" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="{{ route('admin.bookings.index', ['status' => 'confirmed']) }}" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="{{ route('admin.bookings.index', ['status' => 'cancelled']) }}" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            <option value="{{ route('admin.bookings.index', ['status' => 'completed']) }}" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option> -->
        </select>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if($bookings->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Package</th>
                            <th>Tour Date</th>
                            <th>People</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>#{{ $booking->id }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ Str::limit($booking->package->name, 25) }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->tour_date)->format('M d, Y') }}</td>
                            <td>{{ $booking->number_of_people }}</td>
                            <td class="fw-bold">₹{{ number_format($booking->total_amount, 0) }}</td>
                            <td>
                                @if($booking->payment_status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @elseif($booking->payment_status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-danger">Failed</span>
                                @endif
                            </td>
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
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" 
                                       class="btn btn-outline-primary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.bookings.edit', $booking) }}" 
                                       class="btn btn-outline-success" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $bookings->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-calendar-check fs-1 text-muted d-block mb-3"></i>
                <h5 class="text-muted">No bookings found</h5>
            </div>
        @endif
    </div>
</div>
@endsection
