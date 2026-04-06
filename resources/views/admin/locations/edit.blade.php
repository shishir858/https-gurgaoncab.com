@extends('admin.layout.app')
@section('content')
<div class="container py-4">
    <h2>Edit Location</h2>
    <div class="mb-3">
        <a href="{{ route('admin.faqs.index', $location) }}" class="btn btn-info">Manage FAQs for this Location</a>
    </div>
    <form action="{{ route('admin.locations.update', $location) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.locations.partials.form', ['location' => $location])
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
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
