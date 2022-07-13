<div>
    @section('title', $title ?? 'Detail Pembayaran')

    <div class="row">
        <div class="col-xl-12 col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm order-2 order-sm-1">
                            <div class="d-flex align-items-start mt-3 mt-sm-0">
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-16 mb-1">{{ $customer->nama_pelanggan }}</h5>
                                        <p class="text-muted font-size-13">No. Sambungan: {{ $customer->no_sambungan }}</p>

                                        <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Zona: {{ $customer->zona?->wilayah }}
                                            </div>
                                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Golongan: {{ $customer->golonganTarif?->nama_golongan }}
                                            </div>
                                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Alamat : {{ $customer->alamat_pelanggan }}</div>
                                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Tahun Langganan : {{ $customer->tahun_langganan }}</div>
                                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Status Aktif : {{ $customer->status_pelanggan === 1 ? 'Aktif' : 'Non Aktif' }}</div>
                                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Status Valid : {{ $customer->is_valid === 1 ? 'Valid' : 'Tidak Valid' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link px-3 active" data-bs-toggle="tab" href="#detail" role="tab">Detail Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" data-bs-toggle="tab" href="#riwayat" role="tab">Riwayat Pembayaran</a>
                        </li>
                    </ul>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="tab-content">
                <div class="tab-pane active" id="detail" role="tabpanel">
                    <div class="card">
                        <!-- Pembayaran Tabel -->
                        <table class="table table-bordered table-responsive">
                            <thead>
                            <tr class="text-center">
                                <th>TRANSAKSI PEMAKAIAN</th>
                                <th>PERIODE</th>
                                <th>TAGIHAN</th>
                                <th>PEMBAYARAN</th>
                                <th>TGL BAYAR</th>
                                <th>AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($listPembayaran as $list)
                                <tr>
                                    <td>
                                        {{ '#' . $list->no_transaksi }} <span class="font-small-3 text-success">({{ $list->pemakaian_air_saat_ini .' m3' }})</span><br>
                                    </td>
                                    <td class="text-center">
                                        {{ \App\Utilities\Helpers::getNamaBulanIndo($list->bulan_berjalan) }} {{ $list->tahun_berjalan }}
                                    </td>
                                    <td class="text-center">{{ 'Rp. ' . number_format($list->total_tagihan,0,',','.') }}</td>
                                    <td class="text-center">{{ 'Rp. ' . number_format($list->total_bayar,0,',','.') }}</td>
                                    <td class="text-center">{{ !is_null($list->tgl_bayar) ? $list->tgl_bayar->format('d/m/Y') : '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('cetak.bukti-pembayaran', ['page' => 'rekening-air', 'pelangganId' => $customer->id,'pembayaranId' => $list->id]) }}"
                                           class="btn btn-icon btn-secondary btn-sm" target="_blank"><i class="bx bx-printer"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted"><span>Belum ada data pembayaran.</span></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="row p-3 g-0 mt-1">
                            <div class="col-sm-6">
                                <div>
                                    <p class="mb-sm-0">Menampilkan {{ $pageData['page'] }} sampai {{ $pageData['pageCount'] }} dari {{ $pageData['totalData'] }} entri</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="float-sm-end">
                                    {{ $listPembayaran->links() }}
                                </div>
                            </div>
                        </div>
                        <!-- /Pembayaran table -->
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end tab pane -->

                <div class="tab-pane" id="riwayat" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-xl-10">
                                    @forelse($listHistory as $hist)
                                        <div>
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="font-size-15 text-truncate"><a href="#" class="text-dark">{{ $hist->event }}</a></h5>
                                                    <p class="font-size-13 text-muted mb-0">{{ $hist->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <div class="pt-3">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item me-3">
                                                        <a href="javascript: void(0);" class="text-muted">
                                                            <i class="bx bx-user align-middle text-muted me-1"></i>
                                                            {{ $customer->nama_pelanggan }}
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item me-3">
                                                        <a href="javascript: void(0);" class="text-muted">
                                                            <i class="bx bx-transfer align-middle text-muted me-1"></i>
                                                            {{ $hist->payment->no_transaksi }}
                                                        </a>
                                                    </li>
                                                </ul>
                                                <p class="text-muted">{{ $hist->description }}</p>
                                            </div>
                                        </div>
                                        <hr class="my-5">
                                    @empty
                                        <div>
                                            <span class="text-muted">Belum ada history pembayaran. Silahkan lakukan pembayaran terlebih dahulu.</span>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="row g-0 mt-4">
                                <div class="col-sm-6">
                                    <div>
                                        <p class="mb-sm-0">Menampilkan {{ $page }} sampai {{ $perPage }} dari {{ $listHistory->count() }} entri</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-sm-end">
                                        {{ $listHistory->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end tab pane -->
            </div>
            <!-- end tab content -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
