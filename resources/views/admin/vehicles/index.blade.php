@extends('admin.layout')

@section('page-title', 'Manage Vehicles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">All Vehicles</h4>
    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Vehicle
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if($vehicles->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price/km</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $vehicle)
                        <tr>
                            <td>
                                <img src="{{ (str_starts_with($vehicle->image, 'http') || str_starts_with($vehicle->image, '/')) ? $vehicle->image : asset($vehicle->image) }}" 
                                     alt="{{ $vehicle->name }}" 
                                     class="rounded" style="width: 80px; height: 60px; object-fit: cover;">
                            </td>
                            <td class="fw-bold">{{ $vehicle->name }}</td>
                            <td>
                                <div class="small">
                                    <i class="bi bi-person-fill"></i> {{ $vehicle->seating_capacity }} Seats<br>
                                    <i class="bi bi-bag-fill"></i> {{ $vehicle->luggage_capacity ?? 'N/A' }} Bags
                                </div>
                            </td>
                            <td class="fw-bold">₹{{ $vehicle->price_per_km }}/km</td>
                            <td>
                                @if($vehicle->is_available)
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-danger">Not Available</span>
                                @endif
                                @if($vehicle->is_active)
                                    <span class="badge bg-primary">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.vehicles.edit', $vehicle) }}" 
                                       class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this vehicle?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $vehicles->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-car-front fs-1 text-muted d-block mb-3"></i>
                <h5 class="text-muted">No vehicles found</h5>
                <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle me-2"></i>Add Vehicle
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
