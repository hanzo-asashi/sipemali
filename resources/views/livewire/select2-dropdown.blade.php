<div>
    <div wire:ignore>
        <select class="form-select" id="select2-pelanggan">
{{--            <option value="">Select a Customer</option>--}}
            @foreach($customers as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
            @endforeach
        </select>
{{--        <x-select2 wire:model="model" :model="'model'">--}}
{{--            @foreach($customers as $key => $item)--}}
{{--                <option value="{{ $key }}">{{ $item }}</option>--}}
{{--            @endforeach--}}
{{--        </x-select2>--}}
    </div>
</div>
@push('page-script')
    <script>
        $(document).ready(function () {
            $('#select2-pelanggan').select2();
            $('#select2-pelanggan').on('change', function (e) {
                var data = $('#select2-pelanggan').select2("val");
                @this.set('ottPlatform', data);
            });
        });
    </script>
@endpush
