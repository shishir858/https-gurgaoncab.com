<div class="row">
    <div class="col-md-8 mb-3">
        <label class="form-label fw-bold">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title ?? '') }}" required>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label fw-bold">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $blog->slug ?? '') }}">
    </div>
    @push('scripts')
    <script>
    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^a-z0-9\-]/g, '')    // Remove all non-alphanumeric except -
            .replace(/-+/g, '-')             // Replace multiple - with single -
            .replace(/^-+|-+$/g, '');        // Trim - from start/end
    }
    document.addEventListener('DOMContentLoaded', function() {
        var titleInput = document.querySelector('input[name="title"]');
        var slugInput = document.getElementById('slug');
        if(titleInput && slugInput) {
            titleInput.addEventListener('input', function() {
                if(!slugInput.value || slugInput.value === '' || slugInput.value === slugify(slugInput.value)) {
                    slugInput.value = slugify(titleInput.value);
                }
            });
        }
    });
    </script>
    @endpush
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Meta Title</label>
        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $blog->meta_title ?? '') }}">
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Meta Description</label>
        <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Meta Keywords</label>
        <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $blog->meta_keywords ?? '') }}">
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Meta Canonical</label>
        <input type="text" name="meta_canonical" class="form-control" value="{{ old('meta_canonical', $blog->meta_canonical ?? '') }}">
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label fw-bold">Feature Image</label>
            <input type="file" name="feature_image_upload" class="form-control" accept="image/*">
            @if(isset($blog) && $blog->feature_image)
                <img src="{{ asset($blog->feature_image) }}" alt="Current Image" class="img-thumbnail mt-2" style="max-width:200px;">
            @endif
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Status</label>
            <select name="is_active" class="form-control">
                <option value="1" {{ old('is_active', $blog->is_active ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active', $blog->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Publish Date</label>
            <input type="date" name="published_at" class="form-control" value="{{ old('published_at', isset($blog->published_at) ? $blog->published_at->format('Y-m-d') : '') }}">
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Content</label>
        <textarea name="content" rows="8" class="form-control tinymce">{{ old('content', $blog->content ?? '') }}</textarea>
    </div>
</div>
@push('scripts')
<script src="https://cdn.tiny.cloud/1/negmyd1ubj2sws8aken91d35q7i3uzln8nt0u4jyei0tat88/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce',
        height: 350,
        plugins: 'link image lists code table fullscreen',
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | code fullscreen',
        menubar: false,
        branding: false,
        images_upload_url: '{{ route('admin.tinymce.upload') }}',
        images_upload_credentials: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        images_reuse_filename: false,
        image_uploadtab: false,
        convert_urls: false,
        relative_urls: false,
        remove_script_host: false,
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function () {
                var file = this.files[0];
                var formData = new FormData();
                formData.append('file', file);
                fetch('{{ route('admin.tinymce.upload') }}', {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    cb(data.location, { title: file.name });
                });
            };
            input.click();
        }
    });
</script>
@endpush
