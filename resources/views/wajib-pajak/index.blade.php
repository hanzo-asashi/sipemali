<x-app-layout>
    @section('title') Pendaftaran Wajib Pajak @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Pendaftaran Wajib Pajak</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
            <livewire:wajib-pajak.table-index />
            <!-- end row -->
        </div>
    </div>
    @push('script')

    @endpush
</x-app-layout>



