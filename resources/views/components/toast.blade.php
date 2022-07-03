<div {{ $attributes->merge(['class' => 'toast fade','role' => 'alert']) }}
     id="toast" aria-live="polite" data-bs-autohide="true" aria-atomic="true"
>
    <div class="toast-header">
        <img src="{{ asset('assets/images/logo-sm.svg') }}" class="me-2" alt="" height="18">
        <strong class="me-auto">{{ $title }}</strong>
        <small class="text-muted"> {{ $titleDescription }}</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {{ $slot }}
    </div>
</div>
