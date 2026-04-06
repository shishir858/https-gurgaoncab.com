@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Edit Blog</h1>
    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.blogs.form')
        <button type="submit" class="btn btn-primary mt-3">Update Blog</button>
    </form>
</div>
@endsection
