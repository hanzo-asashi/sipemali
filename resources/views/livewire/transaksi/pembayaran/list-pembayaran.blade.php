<div>
    @section('title', $title)
    @push('vendor-style')@endpush
    @push('page-style')@endpush
    <div class="row">
        <x-stats class="col-lg-3 col-sm-12" :value="$totalTagihan" :color="'bg-primary'" :title="'Total Semua Tagihan'">
            <i class="far fa-file-invoice"></i>
        </x-stats>
        <x-stats class="col-lg-3 col-sm-12" :jumlah="$countPembayaranLunas" :value="$totalPembayaran" :color="'bg-success'" :title="'Total Semua Pembayaran'">
            <i class="far fa-money-check"></i>
        </x-stats>
        <x-stats class="col-lg-3 col-sm-12" :value="$totalTagihanSebagian" :color="'bg-danger'" :title="'Total Piutang'">
            <i class="far fa-money-bill"></i>
        </x-stats>
        <x-stats class="col-lg-3 col-sm-12" :value="$totalTagihanBatal" :color="'bg-warning'" :title="'Total Belum Terbayar'">
            <i class="far fa-file-invoice-dollar"></i>
        </x-stats>
    </div>
    <!-- Hoverable rows start -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-sm-8 col-lg-8 d-flex justify-content-center justify-content-lg-start">
                            <div class="me-1">
                                <select wire:model="perPage" class="form-select">
                                    <option value="15">15</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="me-1">
                                <input wire:model.debounce.300ms="search" value="{{ $search }}" type="search" class="form-control" placeholder="Cari disini...">
                            </div>
                            <div class="me-1">
                                <select wire:model="zona" class="form-select text-capitalize mb-md-0 mb-2">
                                    <option value=""> Semua Zona</option>
                                    @foreach($pageData['listZona'] as $key => $zona)
                                        <option value="{{ $key }}">{{ $zona }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="me-1">
                                <select wire:model="golongan" class="form-select text-capitalize mb-md-0 mb-2">
                                    <option value=""> Semua Golongan</option>
                                    @foreach($pageData['listGolongan'] as $key => $gol)
                                        <option value="{{ $key }}">{{ $gol }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="me-1">
                                <select wire:model="status" class="form-select text-capitalize mb-md-0 mb-2">
                                    <option value=""> Semua Status</option>
                                    @foreach($pageData['listStatus'] as $key => $status)
                                        <option value="{{ $key }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                            <div class="d-flex align-items-center justify-content-center justify-content-lg-end">
                                @if($checked)
                                    <x-nav-link wire:click="$emit('triggerDelete','delete','bulk')" class="btn btn-danger waves-effect waves-float waves-light">
                                        <span class="align-middle">Hapus Terpilih</span>
                                    </x-nav-link>
                                @else
                                    <a href="{{ route('cetak.preview',['page' => 'pembayaran']) }}" target="_blank"
                                       class="btn btn-secondary waves-effect waves-float waves-light me-1"
                                       type="button">
                                        <span>Cetak</span>
                                    </a>
                                    <a href="{{ route('transaksi.pembayaran.create') }}" class="btn btn-primary waves-effect waves-float waves-light" type="button">
                                        <span>Buat Pembayaran</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="text-center">
                            <th style="width: 5%;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="selectAllPembayaran" wire:model="selectAll">
                                    <label class="form-check-label" for="selectAllPembayaran"></label>
                                </div>
                            </th>
                            <th>No. Transaksi</th>
                            <th>Pelanggan</th>
                            <th style="width: 10%;">Pemakaian Air</th>
                            <th>Total Tagihan</th>
                            <th>Total Bayar</th>
                            <th>Denda</th>
                            <th style="width: 8%;">Status</th>
                            <th class="text-center" style="width: 3%;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @if($checked)
                            <tr class="mb-2 mt-2 mx-2">
                                <td colspan="9">
                                    <span class="text-dark font-medium-1">Terpilih
                                        <span class="font-semibold text-danger">{{ count($checked) }}</span>
                                        dari {{ $pageData['totalData'] }} data.
                                        @if (!$selectAllPembayaran)
                                            <a href="#" wire:click.prevent="selectAllData">Pilih Semua data</a>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger waves-float waves-effect waves-light" wire:click
                                                    .prevent="resetCheckbox">Batalkan
                                                Terpilih</button>
                                            <button type="button" class="btn btn-sm btn-primary waves-float waves-effect waves-light" wire:click.prevent="deleteAllData">Hapus
                                                Terpilih</button>
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @endif
                        @forelse($listPembayaran as $bayar)
                            <tr class="@if($this->isChecked($bayar->id)) bg-light @endif">
                                <td class="text-center">
                                    <div class="form-check">
                                        <input id="list-pembayaran-{{ $bayar->id }}" value="{{ $bayar->id }}" class="form-check-input" type="checkbox"
                                               wire:model="checked" wire:key="{{ $bayar->id }}">
                                        <label class="form-check-label" for="list-pembayaran-{{ $bayar->id }}"></label>
                                    </div>
                                </td>
                                <td class="text-center" style="width: 5%;">{{ $bayar->no_transaksi }}</td>
                                <td>
                                    <a href="{{ route('transaksi.pembayaran.detail', ['id' => Hashids::encode($bayar->customer_id)]) }}">
                                        {{ !is_null($bayar->customer) ?  $bayar->customer?->nama_pelanggan : 'N/A'  }}
                                        <span class="badge badge-light-primary font-small-1">
                                            {{  !is_null($bayar->customer->zona) ?  $bayar->customer?->zona?->wilayah : '' }}
                                        </span>
{{--                                        <br>--}}
{{--                                        <span class="badge badge-light-danger font-small-2">{{ '#'. $bayar->no_transaksi }}</span>--}}
                                        <span class="badge badge-light-dark font-small-1">
                                            {{ !is_null($bayar->customer->golonganTarif) ?  $bayar->customer->golonganTarif->nama_golongan : '' }}
                                        </span><br>
                                        <span class="text-muted font-small-3">Periode : {{ \App\Utilities\Helpers::getNamaBulanIndo($bayar->bulan_berjalan) . ' ' .
                                    $bayar->tahun_berjalan }}</span>
                                    </a>

                                </td>
{{--                                <td class="text-center">--}}
{{--                                    <span>{{ \App\Utilities\Helpers::getNamaBulanIndo($bayar->bulan_berjalan) . ' ' . $bayar->tahun_berjalan }}</span>--}}
                                    {{--                                    <br>--}}
                                    {{--                                    <span class="text-muted font-small-3">Berikutnya : {{ \App\Utilities\Helpers::getNamaBulanIndo($bayar->bulan_berjalan + 1) . ' ' .--}}
                                    {{--                                    $bayar->tahun_berjalan }}</span>--}}

{{--                                </td>--}}
                                <td class="text-center">{{ $bayar->pemakaian_air_saat_ini .' m3' }}</td>
                                <td class="text-center">{{ 'Rp. ' . number_format($bayar->total_tagihan,0,',','.') }}</td>
                                <td class="text-center">{{ 'Rp. ' . number_format($bayar->total_bayar,0,',','.') }}</td>
                                <td class="text-center">{{ 'Rp. ' . number_format($bayar->denda,0,',','.') }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-pill badge-light-{{ \App\Utilities\Helpers::setBadgeColor($bayar->status_pembayaran) }} me-1">
                                        {{ isset($bayar->statusPembayaran) ? $bayar->statusPembayaran->name : '-' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <i class="fas fa-ellipsis-v font-medium-1 cursor-pointer dropdown-toggle" data-bs-toggle="dropdown"></i>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @can('show pembayaran')
                                                <a href="{{ route('transaksi.pembayaran.detail', ['id' => Hashids::encode($bayar->customer_id)]) }}"
                                                   class="dropdown-item">Detail Bayar</a>
                                            @endcan
                                            @can('update pembayaran')
                                                <a href="{{ route('transaksi.pembayaran.edit', ['id' => Hashids::encode($bayar->id)]) }}" class="dropdown-item">
                                                    Ubah Pembayaran</a>
                                            @endcan
                                            @can('delete pembayaran')
                                                <a wire:click="destroy({{ $bayar->id }},'single')" class="dropdown-item">Hapus Pembayaran</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="15" class="text-danger text-center">Maaf, data tidak ditemukan</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Start -->
                <x-pagination :datalinks="$listPembayaran" :page="$pageData['page']" :total-data="$pageData['totalData']" :page-count="$pageData['pageCount']"/>
                <!-- Pagination end -->
            </div>

        </div>
    </div>
    <!-- Hoverable rows end -->
    {{--    @include('widgets.modal-bayar')--}}
    @push('page-script')
        <script>
            window.addEventListener('openModal', event => {
                $('#modal-detail-bayar').modal('show');
            })
            window.addEventListener('closeModal', event => {
                $('#modal-detail-bayar').modal('hide');
            })
        </script>
    @endpush
</div>
