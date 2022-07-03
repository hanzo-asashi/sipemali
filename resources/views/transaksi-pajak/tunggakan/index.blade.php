<x-app-layout>
    @section('title') Tunggakan Pajak @endsection

    @push('css')
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Tunggakan</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
        	<livewire:transaksi-pajak.tunggakan.tunggakan-table />
		    <!-- end row -->
        </div>
    </div>

    @push('script')
    	<script src="{{ asset('/assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    	<script type="text/javascript">
	    	// flatpickr
	    	let today = new Date().toLocaleDateString();
			flatpickr('#datepicker-basic', {
				dateFormat: "d/m/Y",
				defaultDate: "today",
			});
		</script>
    @endpush
</x-app-layout>





