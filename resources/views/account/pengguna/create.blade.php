<x-app-layout>
    @section('title') @if($updateMode) Ubah Pengguna @else Tambah Pengguna @endif @endsection

    @push('css')
        <!-- dropzone css -->
        <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- choices css -->
        <link href="{{ URL::asset('/assets/libs/choice-js/choice-js.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ URL::asset('/assets/libs/alertifyjs/alertifyjs.min.css') }}" rel="stylesheet" type="text/css"/>
    @endpush
<!-- start page title -->
    @component('components.breadcrumb')
        @slot('li_1') @if($updateMode) Ubah Pengguna @else Tambah Pengguna @endif @endslot
        @slot('title') Pengguna @endslot
    @endcomponent

<!-- account create page -->
    <livewire:pengguna.create :update-mode="$updateMode" :pengguna="$id" />
    <!-- / account create page -->

    @push('script')
        <!-- choices js -->
        <script src="{{ asset('assets/libs/choice-js/choice-js.min.js') }}"></script>
        <!-- dropzone js -->
        <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/libs/alertifyjs/alertifyjs.min.js') }}"></script>
        <script>
            window.addEventListener('notifikasi', event => {
                alertify.set('notifier','position', 'top-right');
                if(event.detail.success){
                    alertify.notify(event.detail.message, 'success', 3);
                }else{
                    alertify.notify(event.detail.message, 'error', 3);
                }
            })
        </script>
    @endpush

</x-app-layout>



