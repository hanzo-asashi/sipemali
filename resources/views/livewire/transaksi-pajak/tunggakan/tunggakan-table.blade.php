<div>
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="mb-3">
                <h5 class="card-title">Semua Tunggakan <span class="text-muted fw-normal ms-2">({{ !is_null($listTunggakan) ? $listTunggakan->count() : 0  }})</span></h5>
            </div>
        </div>
    </div>
    {{--    <div class="row">--}}
    {{--        <div wire:ignore class="col-12">--}}
    {{--            <x-alert :alertTipe="'info'" :icon="'information-variant'">--}}
    {{--                <x-slot name="alertTitle">Informasi!!!</x-slot>--}}
    {{--                Data Tunggakan terupdate setiap 5 detik--}}
    {{--            </x-alert>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="card bg-soft-light border-secondary">
        <div class="card-body p-2 ">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-1">
                            <div>
                                <label class="form-label" for="form-sm-input">Baris</label>
                                @include('widget.page')
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div>
                                <label class="form-label" for="search">Pencarian</label>
                                @include('widget.search-table')
                            </div>
                        </div>
{{--                        <div class="col-md-2">--}}
{{--                            <div>--}}
{{--                                <label class="form-label" for="jenisObjekPajak">Jenis Objek Pajak</label>--}}
{{--                                <select id="jenisObjekPajak" wire:model="selectedJenisOp" class="form-select form-select-sm">--}}
{{--                                    <option value="">Semua Objek Pajak</option>--}}
{{--                                    @foreach($listJenisOp as $key => $item)--}}
{{--                                        <option wire:key="{{ $key }}" value="{{ $key }}">{{ $item }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-2">--}}
{{--                            <div>--}}
{{--                                @can('manage tunggakan')--}}
{{--                                    @include('widget.bulk-action')--}}
{{--                                @endcan--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-1">
                        <div>
                            <a href="{{ route('transaksi-pajak.tunggakan.print') }}" target="_blank" class="btn btn-soft-primary btn-lg mt-1">
                                <i class="mdi mdi-printer"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:poll.5s="checkJatuhTempo" class="table-responsive table-responsive mb-4">
        <table id="datatable" class="table align-middle datatable dt-responsive table-check nowrap"
               style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
            <thead>
            <tr class="bg-transparent">
                <th style="width: 30px;">
                    <div class="form-check font-size-16">
                        <input type="checkbox" name="check" class="form-check-input" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </th>
                <th style="width: 150px;">No Transaksi</th>
                <th>Bulan / Tahun</th>
                <th>Tgl Jatuh Tempo</th>
                <th>Menunggak (Hari)</th>
                <th>Jumlah Tagihan</th>
                <th>Jumlah Bayar</th>
                <th>Denda</th>
                <th>Total Tagihan</th>
                <th>Status Tunggakan</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($listTunggakan as $op)
                <tr>
                    <td>
                        <div class="form-check font-size-16">
                            <input type="checkbox" class="form-check-input">
                            <label class="form-check-label"></label>
                        </div>
                    </td>

                    <td>
                        <a href="javascript: void(0);" class="text-dark fw-medium">{{ !is_null($op->pembayaran) ? $op->pembayaran()->get()->first()->no_transaksi : '-' }}</a>
                        {{--                        <span class="small text-info">{{ $op->wajibpajak->nwpd }}</span>--}}
                    </td>
                    <td>
                        {{ \App\Utilities\Helper::getNamaBulanIndo(!is_null($op->pembayaran) ? $op->pembayaran()->get()->first()->bulan : 1) }} /
                        {{!is_null($op->pembayaran) ? $op->pembayaran()->get()->first()->tahun : setting('tahun_sppt') }}
                    </td>
{{--                    <td><span class="text-danger">{{ (!is_null($op->tgl_bayar)) ? $op->tgl_bayar->format('d/m/Y') : '-' }}</span></td>--}}
                    <td><span class="text-danger">{{ (!is_null($op->tgl_jatuh_tempo)) ? $op->tgl_jatuh_tempo->format('d/m/Y') : '-' }}</span>
{{--                        <br>--}}
{{--                        <span class="text-danger font-size-10">({{\App\Utilities\Helper::selisihHari2($op->jatuh_tempo) }})</span>--}}
                    </td>
                    <td>{{ $op->lama_tunggakan }}</td>
                    <td>{{ money($op->jumlah_tagihan,'IDR', true) }}</td>
                    <td>{{ money($op->jumlah_bayar, 'IDR', true) }}</td>
                    <td>{{ money($op->denda, 'IDR', true) }}</td>
                    <td>{{ money($op->total_tagihan, 'IDR', true) }}</td>
{{--                    <td>{{ money($op->sisa_bayar, 'IDR', true) }}</td>--}}
                    <td>
                        <span class="badge badge-soft-{{ $op->status_tunggakan === 1 ? 'danger' : 'success' }} font-size-12">
                            {{ $op->status_tunggakan === 1 ? 'Lewat Jatuh Tempo' : 'Lunas' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex flex-wrap gap-2">
                            @can('bayar tunggakan')
                                <a class="btn btn-sm btn-soft-warning waves-effect waves-light" wire:click.prevent="bayarTunggakan({{ $op->id }})">
                                    <i class="bx bx-transfer-alt font-size-11 align-middle"
                                       data-bs-toggle="tooltip" data-bs-placement="top" title="Bayar Tunggakan"></i>
                                </a>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center font-size-14"><strong>Maaf, belum ada data yang menunggak atau jatuh tempo.</strong></td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <x-pagination>
            {{  $listTunggakan->links() }}
        </x-pagination>
    </div>

    @include('widget.modal-tunggakan')
</div>
@push('script')
    <script>
        window.addEventListener('notifikasi', event => {
            alertify.set('notifier', 'position', 'top-right');
            if (event.detail.success) {
                alertify.notify(event.detail.message, 'success', 3);
            } else {
                alertify.notify(event.detail.message, 'error', 3);
            }
        })

        window.addEventListener('alert', event => {
            if (event.detail.success) {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    text: event.detail.message,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar:true
                })
            } else {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'error',
                    text: event.detail.message,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar:true
                })
            }
        });

        window.addEventListener('openModalTunggakan', event => {
            $('#modal-detail-tunggakan').modal('show');
        })
        window.addEventListener('openAddModalTunggakan', event => {
            $('#modal-detail-tunggakan').modal('show');
        })
        window.addEventListener('closeModalTunggakan', event => {
            $('#modal-detail-tunggakan').modal('hide');
        })
    </script>
@endpush
