@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Edit Service</h1>
    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.services.form')
        <button type="submit" class="btn btn-primary mt-3">Update Service</button>
    </form>
</div>
@endsection