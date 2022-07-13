@props(['p' => '2'])
<div class="grid-container">
    <div {{ $attributes->merge(['class' => 'p-'.$p]) }}>
        {{ $slot }}
    </div>
</div>
