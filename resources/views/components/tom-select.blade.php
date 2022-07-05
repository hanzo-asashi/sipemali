@props([
	'options' => [],
	'selectedItems' => []
])
{{--@if(!blank($selectedItems))--}}
{{--    $selectedItems = @json($selectedItems);--}}
{{--    @dd($selectedItems);--}}
{{--@endif--}}
<div wire:ignore>
    <select x-data="{
		tomSelectInstance: null,
		options: {{ collect($options) }},
	    items: @json($selectedItems),
		renderTemplate(data, escape) {
			return `<div class='flex align-items-center'>
				<div><span class='text-primary'>${escape(data.nama_pelanggan)}</span><br>
				<span class='text-muted font-small-3'>No. Sambungan : ${escape(data.no_sambungan)}</span></div>
			</div>`;
		},
		itemTemplate(data, escape) {
			return `<div>
				<span class='text-primary'>${escape(data.nama_pelanggan)} </span>
			</div>`;
        }
    }" x-init="tomSelectInstance = new TomSelect($refs.customer, {
		valueField: 'id',
		labelField: 'nama_pelanggan',
		searchField: ['nama_pelanggan', 'no_sambungan'],
		closeAfterSelect:true,
		loadThrottle:300,
		maxItems:1,
		options: options,
		items: items,
		@if (! empty($items) && ! $attributes->has('multiple'))
        placeholder: undefined,
        @endif
        render: {
            option: renderTemplate,
            item: itemTemplate,
            loading: function() {
                return `<div class='spinner-border spinner-border-sm'></div>`;
            },
            no_results: function(data, escape) {
                return `<span class='text-muted'>Tidak ditemukan hasil</span>`;
            }
        }
    });" x-ref="customer" x-cloak {{ $attributes }} placeholder="Pilih Pelanggan"></select>
</div>

@once
    @push('css')
        @if(config('app.env') === 'production')
            {{--        <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">--}}
            {{--        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/css/tom-select.css" rel="stylesheet">--}}
{{--            <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">--}}
            <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/css/tom-select.bootstrap5.min.css.map" rel="stylesheet">
            {{--        <link href="https://cdn.jsdelivr.net/npm/tom-select@1.1/dist/css/tom-select.css" rel="stylesheet">--}}
        @else
            <link href="{{ mix('assets/libs/tom-select/tom-select.min.css') }}" rel="stylesheet">
{{--            <link href="{{ mix('assets/libs/tom-select/tom') }}" rel="stylesheet">--}}
        @endif
    @endpush

    @push('script')
        @if(config('app.env') === 'production')
            {{--        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>--}}
{{--            <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.2/dist/js/tom-select.complete.min.js"></script>--}}
            <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/js/tom-select.complete.min.js"></script>
            {{--        <script src="https://cdn.jsdelivr.net/npm/tom-select@1.1/dist/js/tom-select.complete.min.js"></script>--}}
        @else
            <script src="{{ mix('assets/libs/tom-select/tom-select.min.js') }}"></script>
        @endif
    @endpush
@endonce
