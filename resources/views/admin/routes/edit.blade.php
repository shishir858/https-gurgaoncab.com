@extends('admin.layout')

@section('page-title', 'Edit Route')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Route</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.routes.update', $route) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Route Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $route->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">From Location <span class="text-danger">*</span></label>
                            <input type="text" name="from_location" class="form-control @error('from_location') is-invalid @enderror" 
                                   value="{{ old('from_location', $route->from_location) }}" required>
                            @error('from_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">To Location <span class="text-danger">*</span></label>
                            <input type="text" name="to_location" class="form-control @error('to_location') is-invalid @enderror" 
                                   value="{{ old('to_location', $route->to_location) }}" required>
                            @error('to_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Distance (km) <span class="text-danger">*</span></label>
                            <input type="number" name="distance" step="0.1" class="form-control @error('distance') is-invalid @enderror" 
                                   value="{{ old('distance', $route->distance) }}" required>
                            @error('distance')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Base Price</label>
                            <input type="number" name="base_price" step="0.01" class="form-control @error('base_price') is-invalid @enderror" value="{{ old('base_price', $route->base_price) }}">
                            @error('base_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Duration <span class="text-danger">*</span></label>
                            <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" 
                                   value="{{ old('duration', $route->duration) }}" placeholder="e.g., 5 hours" required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" rows="3" class="form-control tinymce @error('description') is-invalid @enderror">{{ old('description', $route->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Highlights</label>
                            <textarea name="highlights" rows="3" class="form-control @error('highlights') is-invalid @enderror" 
                                      placeholder="Enter each highlight on a new line">{{ old('highlights', $route->highlights) }}</textarea>
                            @error('highlights')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Enter each highlight on a new line</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Key Stops</label>
                            <textarea name="key_stops" rows="3" class="form-control @error('key_stops') is-invalid @enderror" 
                                      placeholder="Enter each stop on a new line">{{ old('key_stops', $route->key_stops) }}</textarea>
                            @error('key_stops')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Enter each key stop on a new line</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Image</label>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="file" name="image_file" class="form-control @error('image_file') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted">Upload image file</small>
                                    @error('image_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="url" name="image_url" class="form-control @error('image_url') is-invalid @enderror" value="{{ old('image_url', $route->image ? (filter_var($route->image, FILTER_VALIDATE_URL) ? $route->image : asset($route->image)) : '') }}" placeholder="Or enter image URL">
                                    <small class="text-muted">Or paste image URL</small>
                                    @error('image_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @if($route->image)
                                <div class="mt-2">
                                    <img src="{{ filter_var($route->image, FILTER_VALIDATE_URL) ? $route->image : asset($route->image) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                                    <p class="small text-muted mt-1">Current Image</p>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Best Season</label>
                            <input type="text" name="best_season" class="form-control @error('best_season') is-invalid @enderror" 
                                   value="{{ old('best_season', $route->best_season) }}" placeholder="e.g., October to March">
                            @error('best_season')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold d-block">Popular Route</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_popular" id="is_popular" value="1"
                                       {{ old('is_popular', $route->is_popular) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_popular">Mark as Popular</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold d-block">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                                       {{ old('is_active', $route->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>

                            <div class="col-12">
                                <hr>
                                <h6 class="fw-bold mt-3 mb-2">SEO Meta Information</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $route->meta_title) }}">
                                @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Meta Description</label>
                                <textarea name="meta_description" rows="2" class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $route->meta_description) }}</textarea>
                                @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" value="{{ old('meta_keywords', $route->meta_keywords) }}">
                                @error('meta_keywords')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Meta Canonical URL</label>
                                <input type="url" name="meta_canonical" class="form-control @error('meta_canonical') is-invalid @enderror" value="{{ old('meta_canonical', $route->meta_canonical) }}">
                                @error('meta_canonical')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="bi bi-save me-2"></i>Update Route
                            </button>
                            <a href="{{ route('admin.routes.index') }}" class="btn btn-secondary px-4 ms-2">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

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
