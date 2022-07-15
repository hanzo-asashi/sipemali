@props(['options' => []])

@php
    $options = array_merge([
        'dateFormat' => 'Y-m-d',
        'enableTime' => false,
        'altFormat' =>  'j F Y',
        'ariaDateFormat' => 'j F Y',
        'altInput' => true,
        'defaultDate' => 'today',
    ], $options);
@endphp

{{--<div wire:ignore>--}}
{{--    <input--}}
{{--        x-data="{--}}
{{--           init() {--}}
{{--               flatpickr(this.$refs.input, {{ json_encode((object)$options) }});--}}
{{--           }--}}
{{--        }"--}}
{{--        x-ref="input"--}}
{{--        type="text"--}}
{{--        placeholder="01 Maret 2022"--}}
{{--        {{ $attributes->merge(['class' => 'form-control']) }}--}}
{{--    />--}}
{{--</div>--}}

<div wire:ignore>
    <input
        x-data="{
             value: @entangle($attributes->wire('model')),
             instance: undefined,
             init() {
                 $watch('value', value => this.instance.setDate(value, false));
                 this.instance = flatpickr(this.$refs.input, {{ json_encode((object)$options) }});
             }
        }"
        x-ref="input"
        x-bind:value="value"
        type="text"
        placeholder="12 Maret 2022"
        {{ $attributes->merge(['class' => 'form-control']) }}
    />
</div>
