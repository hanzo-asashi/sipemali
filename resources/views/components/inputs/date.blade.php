@props(['options' => []])

@php
    $options = array_merge([
                    'dateFormat' => 'Y-m-d H:i:s',
                    'enableTime' => false,
                    'altFormat' =>  'd/m/Y',
                    'altInput' => true
                    ], $options)
@endphp

<div wire:ignore>
    <input
        x-data="{value: @entangle($attributes->wire('model')), instance: undefined}"
        x-init="() => {
                $watch('value', value => instance.setDate(value, false));
                instance = flatpickr($refs.input, {{ json_encode((object)$options) }});
            }"
        x-ref="input"
        x-bind:value="value"
        type="text"
        {{ $attributes->merge(['class' => 'form-control flatpickr-input active']) }}
    />
</div>
