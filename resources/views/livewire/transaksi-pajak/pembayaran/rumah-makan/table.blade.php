<div>
    @section('title') Pembayaran Rumah Makan @endsection
    @push('css')
    @endpush

<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Pembayaran Rumah Makan</x-slot>
    </x-breadcrumb>
    <div x-data="{}" class="content-header row">
        <div class="content-body">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <h5 class="card-title">Semua Rumah Makan <span class="text-muted fw-normal ms-2">({{ $listPembayaran->count() }})</span>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card bg-soft-light border-secondary">
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-md-10">
                            <!-- Filter start -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div>
                                        <label class="form-label" for="search">Pencarian {{ $search }}</label>
                                        @include('widget.search-table')
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div>
                                        <label class="form-label" for="form-sm-input">Baris</label>
                                        @include('widget.page')
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div wire:ignore>
                                        <label class="form-label" for="tahun">Filter Tahun</label>
                                        <select id="tahun" wire:model="selectedTahun" class="form-select form-select-sm">
                                            <option value="" selected>Semua Tahun</option>
                                            @foreach($listTahun as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--                        <div class="col-md-2">--}}
                                {{--                            <div>--}}
                                {{--                                <label class="form-label" for="bulan">Filter Berdasarkan Bulan</label>--}}
                                {{--                                <select id="bulan" wire:model="selectedBulan" class="form-select form-select-sm">--}}
                                {{--                                    <option value="" selected>Semua Bulan</option>--}}
                                {{--                                    @foreach($listBulan as $key => $item)--}}
                                {{--                                        <option wire:key="{{ $key }}" value="{{ $key }}">{{ $item }}</option>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </select>--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                {{--                        <div class="col-md-2">--}}
                                {{--                            <div>--}}
                                {{--                                <label class="form-label" for="statusbayar">Filter Berdasarkan Status</label>--}}
                                {{--                                <select id="statusbayar" wire:model="selectedStatus" class="form-select form-select-sm">--}}
                                {{--                                    <option value="" selected>Semua Status Bayar</option>--}}
                                {{--                                    @foreach($listStatus as $key => $item)--}}
                                {{--                                        <option wire:key="{{ $key }}" value="{{ $key }}">{{ $item }}</option>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </select>--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                <div class="col-md-2">
                                    <div>
                                        @can('manage bulk-actions')
                                            @include('widget.bulk-action')
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <!-- Filter end -->
                        </div>
                        @include('widget.global-print')
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <x-table class="table table-responsive table-hover table-nowrap align-middle font-size-13">
                    <x-table.table-head>
                        <tr wire:loading.class="opacity-50" class="bg-transparent">
                            <th scope="col" style="width: 50px;">
                                <div class="form-check font-size-16">
                                    <input type="checkbox" class="form-check-input" id="checkAll" wire:model="selectAll"/>
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th>
                            <th style="width: 13%;">Objek Pajak</th>
                            <th style="width: 13%;">Wajib Pajak</th>
                            <th style="width: 13%;">Pembayaran Terakhir</th>
                            <th class="text-center" style="width: 10%;">Status Bayar</th>
                            <th class="text-center" style="width: 10%;">Status Transaksi</th>
                            <th class="text-center">Realisasi</th>
                            <th class="text-center">Target</th>
                            <th style="width: 6%" class="text-center">Capaian</th>
                            <th style="width: 8%" class="text-center">Aksi</th>
                        </tr>
                    </x-table.table-head>
                    <x-table.table-body>
                        @forelse($listPembayaran as $op)
                            @php
                                $persen = (float) 0;
                                $capaian = 0;
                                $nextBln = 1;
                                $realisasi = 0;
                                $target = 0;
                                $denda = 0;
                                $pembayaran = $op->pembayaran()->orderByDesc('bulan');
                                if($pembayaran->statusTransaksi(1)->get()->count() > 0){
                                    $qryBln = $pembayaran->statusTransaksi(1)->get()->first();
                                }else{
                                    $qryBln = null;
                                }

                                $target = $pembayaran->get()->sum('nilai_pajak');
                                if(!is_null($qryBln)){
                                    $nextBln = $qryBln->bulan + 1;
                                    $blnAgo = $qryBln->bulan - 1;

                                    if($qryBln->bulan === 12){
                                        $nextBln = '1';
                                    }

                                    if($qryBln->bulan === 0){
                                        $blnAgo = '12';
                                    }

                                    //$realisasi =  $pembayaran->where('status_bayar', 1)->sum('nilai_pajak');
                                    $realisasi =  $pembayaran->get()->sum('jumlah_bayar');
                                    $realisasi = (double) $realisasi;

                                    $denda = $pembayaran->get()->sum('denda');
                                    $denda = (double) $denda;

                                    $sisa = $target - $realisasi - $denda;
                                    $sisa = (double) $sisa;

                                    $blnSebelumnya = $pembayaran->where('status_bayar', 1)->where('bulan', $blnAgo)->get()->sum('nilai_pajak');

                                    if($blnSebelumnya > 0 && $realisasi > 0){
                                        $persen = (float) \App\Utilities\Helper::to_persen($blnSebelumnya,$realisasi);
                                    }
                                    if($blnSebelumnya > 0 && $realisasi > 0){
                                        $persen = (float) \App\Utilities\Helper::to_persen($blnSebelumnya,$realisasi);
                                    }

                                    if($realisasi > 0 && $target > 0){
                                        $capaian = (float) \App\Utilities\Helper::to_persen($realisasi,$target);
                                    }
                                }
                            @endphp
                            {{--                        @dd($qryBln)--}}

                            <tr class="@if($this->isChecked($op->id)) bg-soft-light @endif">
                                <th scope="row">
                                    <div class="form-check font-size-16">
                                        <input id="jenis-op-{{$op->id }}" value="{{$op->id }}" type="checkbox" class="form-check-input"
                                               wire:model="checked" wire.key="{{$op->id }}"/>
                                        <label class="form-check-label" for="jenis-op-{{$op->id }}"></label>
                                    </div>
                                </th>
                                <td>
                                    <a href="{{ route('pembayaran.rumahmakan.detail', $op->id) }}"
                                       class="text-dark fw-medium">{{ $op->nama_objek_pajak }}<br>
                                        <span class="text-warning small">{{ $op->nopd }}</span>
                                    </a>
                                </td>
                                <td>
                                    {{ !is_null($op->wajibpajak) ? $op->wajibpajak->nama_wp : '' }}<br>
                                    <span class="small text-info">{{ !is_null($op->wajibpajak) ? $op->wajibpajak->nwpd : '-' }}</span>
                                </td>
                                <td>
                                    <span class="text-success">
                                        {{ \App\Utilities\Helper::getNamaBulanIndo(!is_null($qryBln) ? $qryBln->bulan : setting('masa_pajak_bulan'))}}
                                    </span>&nbsp;{{!is_null($qryBln) ? $qryBln->tahun : setting('tahun_sppt') }}<br>
                                    <span class="small text-muted">Pembayaran Selanjutnya : {{ \App\Utilities\Helper::getNamaBulanIndo((string) $nextBln) ?: '-' }}</span>
                                </td>
                                <td class="text-center">
{{--                                    <span class="badge badge-soft-{{!is_null($qryBln) ? $qryBln->status_bayar === 1 ? 'success' : 'danger' : 'info' }}">--}}
                                    <span class="badge badge-soft-{{ \App\Utilities\Helper::getAlertColor(!is_null($qryBln) ? $qryBln->status_bayar : 3) }}">
                                        {{ \App\Utilities\Helper::getNamaStatusBayar(!is_null($qryBln) ? $qryBln->status_bayar : 2)}}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-soft-{{ \App\Utilities\Helper::getAlertColor(!is_null($qryBln) ? $qryBln->status_bayar : 3) }}">
                                        {{ \App\Utilities\Helper::getNamaStatusTransaksi(!is_null($qryBln) ? $qryBln->status_transaksi : 1)}}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{ money($realisasi,'IDR', true) }}
                                </td>
                                <td class="text-center">
                                    {{ money($target,'IDR', true) }}
                                </td>
                                <td style="width: 6%" class="text-center">
                                    <span class="text-success ">{{ number_format($capaian,0,',','.') }}%</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <div class="btn-group">
                                            @can('create pembayaran')
                                                <a class="btn btn-sm btn-soft-success waves-effect waves-light"
                                                   wire:click.prevent="tambahBayar({{ $op->id }})">
                                                    <i class="bx bx-plus-circle font-size-11 align-middle"
                                                       data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Pembayaran"></i>
                                                </a>
                                            @endcan
                                            @can('detail pembayaran')
                                                <a id="{{ $op->id }}" href="{{ route('pembayaran.rumahmakan.detail', $op->id) }}"
                                                   class="btn btn-sm btn-soft-info waves-effect waves-light">
                                                    <i class="bx bx-detail font-size-11 align-middle" data-bs-toggle="tooltip"
                                                       data-bs-placement="top" title="Detail Pajak"></i>
                                                </a>
                                            @endcan
                                            @can('delete pembayaran')
                                                <x-button wire:click.prevent="$emit('triggerDelete',{{ $op->id }},'single')"
                                                          class="btn-sm btn-soft-danger waves-effect waves-light"
                                                          data-bs-toggle="tooltip"
                                                          data-bs-placement="top" title="Hapus Data">
                                                    <i class="bx bx-trash font-size-11 align-middle"></i>
                                                </x-button>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <x-no-table-data/>
                        @endforelse
                    </x-table.table-body>
                </x-table>
                <x-pagination>
                    {{ $listPembayaran->links() }}
                </x-pagination>
            </div>
        </div>
    </div>
    @include('widget.modal-bayar')
    @push('script')
        @include('widget.alertify')
        @include('widget.action-js')
    @endpush
</div>


