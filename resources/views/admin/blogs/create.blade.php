@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Add New Blog</h1>
    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.blogs.form')
        <button type="submit" class="btn btn-success mt-3">Save Blog</button>
    </form>
</div>
@endsection
