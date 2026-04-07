@php
    $qs = request()->query();
    if (isset($qs['page']) && (int) $qs['page'] <= 1) {
        unset($qs['page']);
    }
    $canonicalHref = request()->url() . ($qs ? '?' . http_build_query($qs) : '');
@endphp
<link rel="canonical" href="{{ $canonicalHref }}">
