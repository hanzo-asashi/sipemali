@props(['placeholder' => 'Pilih Salah Satu', 'options' => [], 'selectedItems' => null])
<select {{ $attributes->merge(['class' => 'form-select']) }}>
    @empty($options)
        {{ $slot }}
    @else
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $key => $value)
            <option value="{{ $key }}" @selected($selectedItems === $key)>{{ $value }}</option>
        @endforeach

    @endempty
</select>
