@props(['alertTipe' => '','icon' => 'check-all'])
<div {{ $attributes->merge(['class' => 'alert alert-border-left alert-dismissible alert-'.$alertTipe.' fade show' ,'role' => 'alert']) }}>
    <i class="mdi me-3 align-middle mdi-{{ $icon }}"></i><strong>{{ $alertTitle }}</strong>
    {{ $slot }}
    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
</div>

