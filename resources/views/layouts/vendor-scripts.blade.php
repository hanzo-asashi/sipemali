<!-- JAVASCRIPT -->
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/metismenu/metismenu.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/feather-icons/feather-icons.min.js') }}"></script>
<!-- pace js -->
<script data-pace-options='{ "ajax": false, "elements": false, "restartOnPushState": false, "restartOnRequestAfter": false}'
        src="{{ URL::asset('/assets/libs/pace-js/pace-js.min.js') }}"></script>
{{--<script data-pace-options='{--}}
{{--        "ajax": false,--}}
{{--        "document": false,--}}
{{--        "eventLag": true,--}}
{{--        "elements": false,--}}
{{--        "restartOnPushState": true,--}}
{{--        "restartOnRequestAfter": false--}}
{{--    }'--}}
{{--        src="{{ URL::asset('/assets/libs/pace-js/pace-js.min.js') }}"></script>--}}
<script src="{{ URL::asset('/assets/libs/alertifyjs/alertifyjs.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<!-- Sweet Alerts js -->
<script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
{{--<script src="{{ URL::asset('/assets/libs/choice-js/choice-js.min.js') }}"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
<!-- Scripts -->
{{--<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{--<script src="{{ mix('assets/js/script.min.js') }}"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>--}}

@stack('script')
<script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
{{--<script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>--}}
