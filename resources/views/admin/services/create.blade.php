@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Add New Service</h1>
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.services.form')
        <button type="submit" class="btn btn-success mt-3">Save Service</button>
    </form>
</div>
@endsection