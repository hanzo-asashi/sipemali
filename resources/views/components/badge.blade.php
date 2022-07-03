@props(['tipe' => 'success'])
<span {{ $attributes->merge(['class' => 'badge bg-'.$tipe]) }}>
    {{ $slot }}
</span>
