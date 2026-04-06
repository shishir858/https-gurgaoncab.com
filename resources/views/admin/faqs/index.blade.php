@extends('admin.layout.app')
@section('content')
<div class="container py-4">
    <h2>FAQs for {{ $location->title }}</h2>
    <a href="{{ route('admin.faqs.create', $location) }}" class="btn btn-success mb-3">Add FAQ</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card mb-3">
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Question</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($faqs as $faq)
                    <tr>
                        <td>{{ $faq->order }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->is_active ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('admin.faqs.edit', [$location, $faq]) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.faqs.destroy', [$location, $faq]) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this FAQ?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">No FAQs found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <a href="{{ route('admin.locations.edit', $location) }}" class="btn btn-secondary">Back to Location Edit</a>
</div>
@endsection
