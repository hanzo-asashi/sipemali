<x-app-layout>
    @section('title') Jenis Pajak @endsection

    @push('css')
        <link href="{{ URL::asset('/assets/libs/alertifyjs/alertifyjs.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- Sweet Alert-->
        <link href="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Jenis Objek Pajak</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
            <livewire:master.jenis-objek-pajak.table/>
        </div>
    </div>

    @push('script')
        <script src="{{ URL::asset('/assets/libs/alertifyjs/alertifyjs.min.js') }}"></script>
        <!-- Sweet Alerts js -->
        <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- validation init -->
        <script src="{{ asset('assets/js/pages/validation.init.js') }}"></script>
    @endpush
</x-app-layout>





