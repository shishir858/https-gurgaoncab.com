@extends('admin.layout')

@section('page-title', 'Manage Enquiries')

@section('content')
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-header bg-white border-0 pt-4 pb-3 rounded-top-4">
        <h5 class="fw-bold mb-0"><i class="bi bi-envelope me-2"></i>All Enquiries</h5>
    </div>
    <div class="card-body rounded-bottom-4">
        @if($enquiries->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Pickup</th>
                            <th>Drop</th>
                            <th>Vehicle</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enquiries as $enquiry)
                        <tr>
                            <td>#{{ $enquiry->id }}</td>
                            <td>{{ $enquiry->name }}</td>
                            <td>{{ $enquiry->pickup_location }}</td>
                            <td>{{ $enquiry->drop_location }}</td>
                            <td>{{ $enquiry->vehicle_type }}</td>
                            <td>{{ $enquiry->date }}</td>
                            <td>
                                <span class="badge {{ $enquiry->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                                    {{ ucfirst($enquiry->status ?? 'pending') }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.enquiries.show', $enquiry->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $enquiries->links() }}
            </div>
        @else
            <div class="text-center text-muted py-5">
                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                <p>No enquiries yet</p>
            </div>
        @endif
    </div>
</div>
@endsection
