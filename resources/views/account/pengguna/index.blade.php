<x-app-layout>
    @section('title') Pengguna @endsection

    @push('css')
        {{--        <link href="{{ asset('assets/libs/alertifyjs/alertifyjs.min.css') }}" rel="stylesheet" type="text/css"/>--}}
        {{--        <link href="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>--}}
    @endpush
<!-- start page title -->
    @section('breadcrumb')
        @slot('li_1') Dashboard @endslot
        @slot('title') Daftar Pengguna @endslot
    @endsection

    <div class="content-header row">
        <div class="content-body">
            <livewire:pengguna.user-table/>
        </div>
    </div>

    @push('script')
    <!-- Sweet Alerts js -->
        {{--        <script src="{{ asset('assets/libs/alertifyjs/alertifyjs.min.js') }}"></script>--}}
        {{--        <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>--}}
    @endpush
</x-app-layout>
