@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Blogs</h1>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-success mb-3">Add New Blog</a>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $index => $blog)
                <tr>
                    <td>{{ ($blogs->currentPage() - 1) * $blogs->perPage() + $index + 1 }}</td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->slug }}</td>
                    <td>{{ $blog->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $blog->published_at ? $blog->published_at->format('d-m-Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this blog?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $blogs->links() }}
</div>
@endsection
