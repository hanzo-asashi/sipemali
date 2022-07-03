<x-app-layout>
@section('title') Hak Akses @endsection
  @push('css')
        <link href="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
  @endpush

  <!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">List Hak Akses</x-slot>
    </x-breadcrumb>
  <div class="content-header row">
    <div class="content-body">
      <livewire:hak-akses.role-table/>
    </div>
  </div>
  @push('script')
      <!-- Sweet Alerts js -->
          <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
  @endpush
</x-app-layout>



