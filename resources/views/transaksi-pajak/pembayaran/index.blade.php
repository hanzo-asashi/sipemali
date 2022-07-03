<x-app-layout>
    @section('title') Pembayaran Pajak @endsection

    @push('css')
        <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css"/>
        <style>
            .table-editable input {
                width: 125px;
            }
        </style>
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Pembayaran</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
            <livewire:transaksi-pajak.pembayaran.pembayaran-table/>
        </div>
    </div>

    @push('script')
        <!-- Table Editable plugin -->
        <script src="{{ asset('/assets/libs/table-edits/table-edits.min.js') }}"></script>
        <!-- flatpickr js -->
        <script src="{{ asset('/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    @endpush
</x-app-layout>





