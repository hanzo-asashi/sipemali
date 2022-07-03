<x-app-layout>
    @section('title') Daftar Objek Pajak @endsection

    @push('css')
    @endpush
    <!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Daftar Objek Pajak</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
            <livewire:objek-pajak.table-index/>
            <!-- end row -->
        </div>
    </div>
    @push('script')
    @endpush
</x-app-layout>



