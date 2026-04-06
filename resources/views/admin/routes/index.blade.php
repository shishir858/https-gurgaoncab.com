@extends('admin.layout')

@section('page-title', 'Manage Routes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">All Routes</h4>
    <a href="{{ route('admin.routes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Route
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if($routes->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Route</th>
                            <th>Distance</th>
                            <th>Duration</th>
                            <th>Type</th>
                            <th>Price Range</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($routes as $index => $route)
                        <tr>
                            
                            <td>{{ ($routes->currentPage() - 1) * $routes->perPage() + $index + 1 }}</td>
                            <td>
                                <div class="fw-bold">{{ $route->start_location ?? $route->from_location }} <i class="bi bi-arrow-right"></i> {{ $route->end_location ?? $route->to_location }}</div>
                                <small class="text-muted">{{ $route->name }}</small>
                            </td>
                            <td>{{ $route->distance }} km</td>
                            <td>{{ $route->duration }}</td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $route->type)) }}</span>
                            </td>
                            <td>₹{{ number_format($route->min_price) }} - ₹{{ number_format($route->max_price) }}</td>
                            <td>
                                @if($route->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                                @if($route->is_popular)
                                    <span class="badge bg-warning">Popular</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.routes.edit', $route) }}" 
                                       class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.routes.destroy', $route) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this route?')">
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
                {{ $routes->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-signpost-2 fs-1 text-muted d-block mb-3"></i>
                <h5 class="text-muted">No routes found</h5>
                <a href="{{ route('admin.routes.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle me-2"></i>Add Route
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
