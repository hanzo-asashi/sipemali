@props(['placeholder' => 'Pilih Tahun', 'id'])

<div wire:ignore>
    <select id="{{ $id }}" data-placeholder="{{ $placeholder }}" style="width: 100%;">
        <option value="">Pilih Tahun</option>
        {{ $slot }}
    </select>
</div>

@once
    @push('script')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush
@endonce

@push('script')
    <script>
        $(function () {
            $('#{{ $id }}').select2({
                //minimumInputLength : 2,
                placeholder: '{{ $placeholder }}'
            }).on('change', function () {
                @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', $(this).val());
            })
        });
    </script>
@endpush

