<div>
    @section('title') Detail Pembayaran Objek Pajak @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Detail Pembayaran Objek Pajak</x-slot>
    </x-breadcrumb>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0">
                <div class="col-md-3">
                    <a href="{{ route('pembayaran.tambangmineral', $objekpajak->id_jenis_op) }}" class="btn btn-sm btn-label btn-link btn-light">
                        <i class="bx bx-chevron-left label-icon"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header row">
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm order-2 order-sm-1">
                            <div class="d-flex align-items-start mt-3 mt-sm-0">
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-24 mb-1">{{ $objekpajak->nama_objek_pajak }}</h5>
                                        <p class="text-muted font-size-13"><b>NOPD :</b> {{ $objekpajak->nopd }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                        <div class="col-sm-auto order-1 order-sm-2">--}}
                        {{--                            <x-button class="btn btn-success">--}}
                        {{--                                <i class="bx bx-plus"></i>--}}
                        {{--                                Tambah Pembayaran--}}
                        {{--                            </x-button>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered">
                            <tr>
                                <th width="10%">Kabupaten</th>
                                <td width="17%">{{ \App\Utilities\Helper::getNamaWilayah($objekpajak->kabupaten) }}</td>
                                <th width="10%">Kecamatan</th>
                                <td width="17%">{{ \App\Utilities\Helper::getNamaWilayah($objekpajak->kecamatan) }}</td>
                                <th width="10%">Kelurahan</th>
                                <td width="17%">{{ \App\Utilities\Helper::getNamaWilayah($objekpajak->kelurahan) }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td colspan="5">{{ $objekpajak->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td colspan="5">{{ $objekpajak->keterangan }}</td>
                            </tr>
                        </table>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="row align-content-between align-items-center">
                        <div class="col-sm order-2 order-sm-1">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-2 mb-2">
                                    <div>
                                        <h5 class="text-start">Rincian Pembayaran</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                        <div class="col-sm-auto mb-2 order-1 order-sm-2">--}}
                        {{--                            @include('widget.button-print-bukti-cetak', ['objekpajak' => $objekpajak])--}}
                        {{--                        </div>--}}
                    </div>
                   <div class="table-responsive">
                       <table id="datatable" class="table table-responsive table-bordered table-check nowrap font-size-14" style="width: 100%;">
                           <thead class="bg-soft-light">
                           <tr class="bg-transparent text-center">
                               <th style="width: 11%;">No. Transaksi</th>
                               <th style="width: 10%;">Nomor SKPD / STS</th>
                               <th style="width: 12%;">Periode Pajak</th>
                               <th style="width: 8%;">Tgl. Bayar</th>
                               <th style="width: 8%;">Jatuh Tempo</th>
                               {{--                            <th width="8%">Denda</th>--}}
                               <th width="8%">Status Bayar</th>
                               <th width="15%">Jumlah Bayar</th>
                               <th width="15%">Nilai Pajak</th>
                               <th width="2%"></th>
                           </tr>
                           </thead>
                           <tbody>
                           @forelse($objekpajak->pembayaran()->get() as $bayar)
                               <tr wire:key="{{ $bayar->id }}">
                                   <td class="text-center">{{ $bayar->no_transaksi }}</td>
                                   <td>
                                       {{ $bayar->nomor_sts }}<br>
                                       <span class="text-warning font-size-13">{{ $bayar->nomor_skpd }}</span>
                                   </td>
                                   <td class="text-center">{{ \App\Utilities\Helper::getNamaBulanIndo($bayar->bulan) . ' - ' . $bayar->tahun }}</td>
                                   <td>{{ !is_null($bayar->created_at) ? $bayar->created_at->format('d/m/Y') : '-' }}</td>
                                   <td>{{ !is_null($bayar->jatuh_tempo) ? $bayar->jatuh_tempo->format('d/m/Y') : '-' }}</td>
                                   {{--                                <td> {{ $bayar->denda }} </td>--}}
                                   <td class="text-center">
                                    <span class="badge badge-soft-{{ $bayar->status_bayar ? 'success' : 'danger' }}">
                                    {{ \App\Utilities\Helper::getNamaStatusBayar($bayar->status_bayar) }}
                                    </span>
                                   </td>
                                   <td>{{ money($bayar->jumlah_bayar,'IDR', true) }} </td>
                                   <td>{{ money($bayar->nilai_pajak ?: 0,'IDR', true) }}</td>
                                   <td style="width: 2%;">
                                       <div wire:ignore class="dropdown">
                                           <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                                   aria-expanded="false">
                                               <i class="bx bx-dots-vertical-rounded"></i>
                                           </button>
                                           <ul class="dropdown-menu dropdown-menu-end" style="">
                                               <li>
                                                   <a class="dropdown-item" href="#" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" title="Tambah Pembayaran"
                                                      wire:click.prevent="bayar({{ $bayar->id }})">
                                                       <i class="bx bx-detail font-size-16 align-middle me-2"></i>
                                                       Ubah Pembayaran
                                                   </a>
                                               </li>
                                               <li>
                                                   <a href="{{ route('laporan-pajak.bukticetak',['page' => 'skpd', 'bayarid' => $bayar->id]) }}" target="_blank" class="dropdown-item">
                                                       <i class="bx bx-printer font-size-16 align-middle me-2"></i> Cetak SKPD
                                                   </a>
                                               </li>
                                               <li>
                                                   <a href="{{ route('laporan-pajak.bukticetak',['page' => 'sts', 'bayarid' => $bayar->id]) }}" target="_blank" type="button" class="dropdown-item">
                                                       <i class="bx bx-printer font-size-16 align-middle me-2"></i> Cetak STS
                                                   </a>
                                               </li>
                                           </ul>
                                       </div>
                                   </td>
                               </tr>
                           @empty
                           @endforelse
                           </tbody>
                           <tfoot>
                           @php
                               $nilaiPjk = $objekpajak->pembayaran()->sum('nilai_pajak') ?: 0;
                               $denda = $objekpajak->pembayaran()->sum('denda') ?: 0;
                               $sisaDana = (double) $objekpajak->pembayaran()->sum('sisa') ?: 0;

                               $totalNilaiPajak = $nilaiPjk - $denda
                           @endphp
                           <tr>
                               <td colspan="7" style="text-align: right;"><b>Total Pajak Keseluruhan</b></td>
                               <td>
                                <span class="text-primary font-size-14">
                                        {{ money($totalNilaiPajak,'IDR',true) }}
                                </span>
                               </td>
                           </tr>
                           {{--                        <tr>--}}
                           {{--                            <td colspan="7" style="text-align: right;"><b>Bayar</b></td>--}}
                           {{--                            <td>--}}
                           {{--                                <div class="d-grid">--}}
                           {{--                                    <a class="btn btn-sm btn-warning btn-block waves-effect waves-light" wire:click.prevent="bayar({{ $pembayaran }})">--}}
                           {{--                                        <i class="bx bx-transfer-alt font-size-14" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Status"></i> Pembayaran--}}
                           {{--                                    </a>--}}
                           {{--                                </div>--}}
                           {{--                            </td>--}}
                           {{--                        </tr>--}}
                           </tfoot>
                       </table>
                   </div>
                </div><!-- end card-body -->
            </div>
        </div>
    </div>

    <!-- Modal Perubahan Status -->
    @include('widget.modal-bayar')
    @push('script')
        @include('widget.alertify')
    @endpush
</div>
