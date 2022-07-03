<x-app-layout>
    @section('title') Pendaftaran Objek Pajak @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Pendaftaran Objek Pajak</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
            <livewire:objek-pajak.create-form :update-mode="$updateMode" :edit-objek-pajak="$id"/>
            <!-- end row -->
        </div>
    </div>
    @push('script')
    @endpush
</x-app-layout>



