<div {{ $attributes->merge(['class' => 'modal']) }}>
    <div class="modal-dialog">
        {{ $slot }}
    </div>
</div>
