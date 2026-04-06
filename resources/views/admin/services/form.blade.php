<div class="row">
    <div class="col-md-6 mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $service->title ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $service->slug ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Feature Image</label>
        <div class="row g-2">
            <div class="col-md-6">
                <input type="file" name="feature_image_upload" class="form-control @error('feature_image_upload') is-invalid @enderror" accept="image/*">
                <small class="text-muted">Upload new image file</small>
                @error('feature_image_upload')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <input type="url" name="feature_image_url" class="form-control @error('feature_image_url') is-invalid @enderror" value="{{ old('feature_image_url') }}" placeholder="Or enter image URL">
                <small class="text-muted">Or paste image URL</small>
                @error('feature_image_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @if(isset($service) && $service->feature_image)
            <div class="mt-2">
                <img src="{{ filter_var($service->feature_image, FILTER_VALIDATE_URL) ? $service->feature_image : asset($service->feature_image) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                <p class="small text-muted mt-1">Current Image</p>
            </div>
        @endif
    </div>
    <div class="col-md-6 mb-3">
        <label>Duration</label>
        <input type="text" name="duration" class="form-control" value="{{ old('duration', $service->duration ?? '') }}" placeholder="e.g. 06 Nights / 07 Days">
    </div>
    <div class="col-md-12 mb-3">
        <label>Amenities (comma separated)</label>
        <input type="text" name="amenities" class="form-control" value="{{ old('amenities', isset($service->amenities) ? implode(',', json_decode($service->amenities, true)) : '') }}" placeholder="Hotels,Sightseeing,Meals,Transfers">
    </div>
    <div class="col-md-6 mb-3">
        <label>Status</label>
        <select name="is_active" class="form-control">
            <option value="1" {{ old('is_active', $service->is_active ?? 1) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('is_active', $service->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Offer (Badge)</label>
        <input type="text" name="offer" class="form-control @error('offer') is-invalid @enderror" value="{{ old('offer', $service->offer ?? '') }}" placeholder="e.g. 30% OFF">
        @error('offer')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Highlights</label>
        <textarea name="highlights" rows="2" class="form-control tinymce @error('highlights') is-invalid @enderror">{{ old('highlights', $service->highlights ?? '') }}</textarea>
        @error('highlights')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
                <!-- Slug auto-generation script -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const titleInput = document.querySelector('input[name="title"]');
                        const slugInput = document.querySelector('input[name="slug"]');
                        if (titleInput && slugInput) {
                            titleInput.addEventListener('input', function() {
                                let slug = titleInput.value.toLowerCase()
                                    .replace(/[^a-z0-9\s-]/g, '')
                                    .replace(/\s+/g, '-')
                                    .replace(/-+/g, '-');
                                slugInput.value = slug;
                            });
                        }
                    });
                </script>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Itinerary</label>
        <textarea name="itinerary" rows="3" class="form-control tinymce @error('itinerary') is-invalid @enderror">{{ old('itinerary', $service->itinerary ?? '') }}</textarea>
        @error('itinerary')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Included</label>
        <textarea name="included" rows="2" class="form-control tinymce @error('included') is-invalid @enderror">{{ old('included', $service->included ?? '') }}</textarea>
        @error('included')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Excluded</label>
        <textarea name="excluded" rows="2" class="form-control tinymce @error('excluded') is-invalid @enderror">{{ old('excluded', $service->excluded ?? '') }}</textarea>
        @error('excluded')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">More Contents</label>
        <textarea name="more_contents" rows="2" class="form-control tinymce @error('more_contents') is-invalid @enderror">{{ old('more_contents', $service->more_contents ?? '') }}</textarea>
        @error('more_contents')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="3" class="form-control tinymce @error('description') is-invalid @enderror">{{ old('description', $service->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Offer (Badge)</label>
        <input type="text" name="offer" class="form-control @error('offer') is-invalid @enderror" value="{{ old('offer', $service->offer ?? '') }}" placeholder="e.g. 30% OFF">
        @error('offer')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
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
    </div>
    <div class="col-md-6 mb-3">
        <label>Meta Title</label>
        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $service->meta_title ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label>Meta Keywords</label>
        <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $service->meta_keywords ?? '') }}">
    </div>
    <div class="col-md-12 mb-3">
        <label>Meta Description</label>
        <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $service->meta_description ?? '') }}</textarea>
    </div>
    <div class="col-md-12 mb-3">
        <label>Meta Canonical</label>
        <input type="text" name="meta_canonical" class="form-control" value="{{ old('meta_canonical', $service->meta_canonical ?? '') }}">
    </div>
</div>