<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <title> @yield('title') | {{ setting('nama_aplikasi') . ' - ' . setting('footer') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ setting(ucfirst('nama_aplikasi')) }}" name="description"/>
    <meta content="{{ setting('footer') }}" name="{{ setting('nama_kantor') }}"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    @include('layouts.head-css')
    @livewireStyles
    <script type="text/javascript">
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
        let base_url = "{{ route('dashboard') }}";
        let sessionTimeout = "{!! config('session.lifetime') !!}";
        let logoutUrl = "{{ route('logout') }}";
        let redirUrl = "{{ route('login') }}";
    </script>
</head>
<body class="{{ config('custom.page-loader') }}"
      data-sidebar-size="{{ setting('sidebar_size','') }}"
      data-layout-mode="{{ setting('tema_layout','') }}"
      data-topbar="{{ setting('tema_topbar','') }}"
      data-sidebar="{{  setting('tema_sidebar',config('custom.theme')) }}">
<!-- Begin page -->
<div id="layout-wrapper">
@include('layouts.topbar')
@include('layouts.sidebar')
<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                {{ $slot }}
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('layouts.footer')
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
@include('layouts.right-sidebar')
<!-- /Right-bar -->
<!-- JAVASCRIPT -->
@livewireScripts
<script src="https://unpkg.com/alpinejs@2.8.2/dist/alpine.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine-ie11.min.js"></script>--}}
{{--<script defer src="https://unpkg.com/alpinejs@3.4.2/dist/cdn.min.js"></script>--}}
{{--<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.4.2/cdn.min.js"></script>--}}
@include('layouts.vendor-scripts')
@include('layouts.partials.feather-script')
<x-livewire-alert::scripts/>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    });
</script>
</body>
</html>
