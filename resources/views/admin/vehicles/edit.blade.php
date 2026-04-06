@extends('admin.layout')

@section('page-title', 'Edit Vehicle')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Vehicle</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Vehicle Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $vehicle->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Model</label>
                            <input type="text" name="model" class="form-control @error('model') is-invalid @enderror" 
                                value="{{ old('model', $vehicle->model) }}">
                            @error('model')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Year</label>
                            <input type="number" name="year" class="form-control @error('year') is-invalid @enderror" 
                                   value="{{ old('year', $vehicle->year) }}" min="2000" max="2030">
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Capacity <span class="text-danger">*</span></label>
                            <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror" 
                                   value="{{ old('capacity', $vehicle->capacity) }}" min="1" required>
                            @error('capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Seating Capacity <span class="text-danger">*</span></label>
                            <input type="number" name="seating_capacity" class="form-control @error('seating_capacity') is-invalid @enderror" 
                                   value="{{ old('seating_capacity', $vehicle->seating_capacity) }}" min="1" required>
                            @error('seating_capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Luggage Capacity</label>
                            <input type="number" name="luggage_capacity" class="form-control @error('luggage_capacity') is-invalid @enderror" 
                                   value="{{ old('luggage_capacity', $vehicle->luggage_capacity) }}" min="0">
                            @error('luggage_capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Price/km <span class="text-danger">*</span></label>
                            <input type="number" name="price_per_km" step="0.01" class="form-control @error('price_per_km') is-invalid @enderror" 
                                   value="{{ old('price_per_km', $vehicle->price_per_km) }}" required>
                            @error('price_per_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Features</label>
                            <textarea name="features" rows="4" class="form-control @error('features') is-invalid @enderror" 
                                      placeholder="Enter each feature on a new line">{{ old('features', $vehicle->features) }}</textarea>
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Description</label>
                                                        <textarea name="description" rows="5" class="form-control tinymce @error('description') is-invalid @enderror">{{ old('description', $vehicle->description) }}</textarea>
                                                        @error('description')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                            @error('features')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Enter each feature on a new line</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Image</label>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="file" name="image_file" class="form-control @error('image_file') is-invalid @enderror" 
                                           accept="image/*">
                                    <small class="text-muted">Upload new image file</small>
                                    @error('image_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                     <input type="url" name="image_url" class="form-control @error('image_url') is-invalid @enderror" 
                                         value="{{ old('image_url', $vehicle->image ? (filter_var($vehicle->image, FILTER_VALIDATE_URL) ? $vehicle->image : asset($vehicle->image)) : '') }}" placeholder="Or enter image URL">
                                     <small class="text-muted">Or paste image URL</small>
                                    @error('image_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @if($vehicle->image)
                                <div class="mt-2">
                                    <img src="{{ filter_var($vehicle->image, FILTER_VALIDATE_URL) ? $vehicle->image : asset($vehicle->image) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                                    <p class="small text-muted mt-1">Current Image</p>
                                </div>
                            @endif
                        </div>

                            <div class="col-12">
                                <hr>
                                <h6 class="fw-bold mt-3 mb-2">SEO Meta Information</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $vehicle->meta_title) }}">
                                @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Meta Description</label>
                                <textarea name="meta_description" rows="2" class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $vehicle->meta_description) }}</textarea>
                                @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" value="{{ old('meta_keywords', $vehicle->meta_keywords) }}">
                                @error('meta_keywords')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Meta Canonical URL</label>
                                <input type="url" name="meta_canonical" class="form-control @error('meta_canonical') is-invalid @enderror" value="{{ old('meta_canonical', $vehicle->meta_canonical) }}">
                                @error('meta_canonical')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold d-block">Air Conditioning</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="has_ac" id="has_ac" value="1"
                                       {{ old('has_ac', $vehicle->has_ac) ? 'checked' : '' }}>
                                <label class="form-check-label" for="has_ac">Has AC</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold d-block">Availability</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1"
                                       {{ old('is_available', $vehicle->is_available) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_available">Available</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold d-block">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                                       {{ old('is_active', $vehicle->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="bi bi-save me-2"></i>Update Vehicle
                            </button>
                            <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary px-4 ms-2">Cancel</a>
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
