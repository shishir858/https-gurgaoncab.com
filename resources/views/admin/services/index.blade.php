@extends('admin.layout')
@section('content')
<style>
    svg {
        height: 20px !important;
        width: 20px !important;
        min-height: 20px !important;
        min-width: 20px !important;
        max-height: 20px !important;
        max-width: 20px !important;
    }
    nav > *:nth-child(2) {
        display: none !important;
    }
</style>
<!-- Removed all custom pagination styling -->
<div class="container-fluid">
    <h1 class="mb-4">Services List</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-success mb-3">Add New Service</a>
  
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $index => $service)
            <tr>
                <td>{{ ($services->currentPage() - 1) * $services->perPage() + $index + 1 }}</td>
                <td>{{ $service->title }}</td>
                <td>{{ $service->slug }}</td>
                <td>{{ $service->is_active ? 'Active' : 'Inactive' }}</td>
                <td>{{ $service->created_at->format('Y-m-d') }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this service?')"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $services->links() }}
</div>
@endsection