@props(['value' => '', 'for' => ''])
<label {{ $attributes->merge(['class' => 'form-label']) }} for="{{ $for }}">
  {{ $value }}
</label>
