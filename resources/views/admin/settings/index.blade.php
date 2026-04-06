@extends('admin.layout')

@section('page-title', 'Settings')

@section('content')
<div class="mb-3">
    <p class="text-muted">Manage your website contact information, footer links, and social media</p>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')

    @foreach($groups as $groupKey => $groupLabel)
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">
                    <i class="bi 
                        @if($groupKey === 'contact') bi-telephone-fill text-primary
                        @elseif($groupKey === 'social') bi-share-fill text-info
                        @elseif(str_contains($groupKey, 'footer')) bi-layout-text-sidebar text-warning
                        @endif
                    me-2"></i>
                    {{ $groupLabel }}
                </h5>
            </div>
            <div class="card-body">
                    {{-- Regular fields for contact and social --}}
                    <div class="row g-3">
                        @foreach($settingsByGroup[$groupKey] as $setting)
                            <div class="col-md-6">
                                <label for="{{ $setting->key }}" class="form-label fw-semibold">
                                    {{ $setting->label }}
                                    @if($setting->description)
                                        <small class="text-muted d-block" style="font-weight: normal;">{{ $setting->description }}</small>
                                    @endif
                                </label>
                                
                                @if($setting->type === 'textarea')
                                    <textarea 
                                        name="settings[{{ $setting->key }}]" 
                                        id="{{ $setting->key }}"
                                        class="form-control"
                                        rows="3"
                                    >{{ old('settings.'.$setting->key, $setting->value) }}</textarea>
                                @else
                                    <input 
                                        type="{{ $setting->type }}" 
                                        name="settings[{{ $setting->key }}]" 
                                        id="{{ $setting->key }}"
                                        class="form-control"
                                        value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                    >
                                @endif
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-end gap-2 mb-5">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary">
            <i class="bi bi-x-circle me-2"></i>Cancel
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle me-2"></i>Save All Settings
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
    // Auto-save warning
    window.addEventListener('beforeunload', function (e) {
        const form = document.querySelector('form');
        if (form) {
            const formData = new FormData(form);
            let hasChanges = false;
            
            // Check if form has been modified (simple check)
            const inputs = form.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                if (input.defaultValue !== input.value) {
                    hasChanges = true;
                }
            });
            
            if (hasChanges) {
                e.preventDefault();
                e.returnValue = '';
            }
        }
    });
</script>
@endpush
