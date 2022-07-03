<x-app-layout>
    @section('title') Input Pembayaran Objek Pajak @endsection

    @push('css')
    <!-- choices css -->
        <link href="{{ URL::asset('/assets/libs/choice-js/choice-js.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- datepicker css -->
        <link rel="stylesheet" href="{{ URL::asset('/assets/libs/flatpickr/flatpickr.min.css') }}">
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Input Pembayaran Objek Pajak</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
            <livewire:transaksi-pajak.pembayaran.create-pembayaran />
            <!-- end row -->
        </div>
    </div>
    @push('script')
{{--        <script src="{{ URL::asset('/assets/libs/choice-js/choice-js.min.js') }}"></script>--}}
{{--        <!-- datepicker js -->--}}
{{--        <script src="{{ URL::asset('/assets/libs/flatpickr/flatpickr.min.js') }}"></script>--}}
        <script>

        </script>
    @endpush
</x-app-layout>



