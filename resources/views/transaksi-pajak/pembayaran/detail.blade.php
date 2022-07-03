<x-app-layout>
    @section('title') Profil Wajib Pajak @endsection

    @push('css')
        <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css"/>
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Profil Wajib Pajak</x-slot>
    </x-breadcrumb>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0">
                <div class="col-md-3">
                    <a href="{{ route('pembayaran.index') }}" class="btn btn-sm btn-label btn-link btn-light">
                        <i class="bx bx-chevron-left label-icon"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header row">
        <div class="content-body">
            <livewire:transaksi-pajak.pembayaran.detail-bayar :pembayaran="$pembayaran"/>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('/assets/libs/flatpickr/flatpickr.min.js') }}"></script>

        <script type="text/javascript">
            // flatpickr
            let today = new Date().toLocaleDateString();
            flatpickr('#datepicker-basic', {
                // altFormat: "F j, Y",
                altFormat: "d/m/y",
                dateFormat: "Y-m-d",
                defaultDate: "today",
                altInput: true,
            });

            window.addEventListener('notifikasi', event => {
                $('#modal-detail-bayar').modal('hide');
                alertify.set('notifier','position', 'top-right');
                if(event.detail.success){
                    alertify.notify(event.detail.message, 'success', 3);
                }else{
                    alertify.notify(event.detail.message, 'error', 3);
                }
            })

            window.addEventListener('openModal', event => {
                $('#modal-detail-bayar').modal('show');
            })
        </script>
    @endpush
</x-app-layout>

