<x-app-layout>
    @section('title') Profil Wajib Pajak @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Profil Wajib Pajak</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
            <livewire:wajib-pajak.detail :wajib-pajak-id="$id"/>
        </div>
    </div>

    @push('script')

    @endpush
</x-app-layout>





