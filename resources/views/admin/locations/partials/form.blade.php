<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $location->title ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Meta Title</label>
    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $location->meta_title ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Meta Keywords</label>
    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $location->meta_keywords ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Meta Description</label>
    <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $location->meta_description ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Meta Canonical</label>
    <input type="text" name="meta_canonical" class="form-control" value="{{ old('meta_canonical', $location->meta_canonical ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Image</label>
    <input type="file" name="image" class="form-control">
    @if(isset($location) && $location->image)
        <img src="{{ asset($location->image) }}" alt="Image" class="img-thumbnail mt-2" style="max-width:120px;">
    @endif
</div>
<div class="mb-3">
    <label class="form-label">Content</label>
    <textarea name="content" class="form-control tinymce" rows="6">{{ old('content', $location->content ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="is_active" class="form-select">
        <option value="1" {{ old('is_active', $location->is_active ?? 1) == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('is_active', $location->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
