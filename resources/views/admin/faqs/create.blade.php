@extends('admin.layout.app')
@section('content')
<div class="container py-4">
    <h2>Add FAQ for {{ $location->title }}</h2>
    <form action="{{ route('admin.faqs.store', $location) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Question</label>
            <input type="text" name="question" class="form-control" value="{{ old('question') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Answer</label>
            <textarea name="answer" class="form-control" rows="4" required>{{ old('answer') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Order</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="is_active" class="form-select">
                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active', 1) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save FAQ</button>
        <a href="{{ route('admin.faqs.index', $location) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
