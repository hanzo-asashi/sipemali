<div>
    @section('title', 'Detail Pelanggan')

    @push('vendor-style')
    @endpush

    @push('page-style')
    @endpush

    <section class="app-user-view-account">
        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <div class="user-info text-center">
                                    <h3>{{ $customer->nama_pelanggan }}</h3>
                                    <span class="badge bg-light-secondary">{{ $customer->statusPelanggan->nama_status }}</span>
                                </div>
                            </div>
                        </div>
                        <h4 class="fw-bolder border-bottom pb-50 mb-1"></h4>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">No Sambungan:</span>
                                    <span>{{ $customer->no_sambungan }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Alamat:</span>
                                    <span>{{ $customer->alamat_pelanggan }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Zona:</span>
                                    <span class="badge bg-light-success">{{ $customer->zona->wilayah }} ({{ $customer->zona->kode }})</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Golongan:</span>
                                    <span>{{ $customer->golonganTarif->deskripsi }}</span>
                                    <span class="badge badge-light-info font-small-2">{{ $customer->golonganTarif->nama_golongan }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Tahun Langganan:</span>
                                    <span>{{ $customer->tahun_langganan }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Status:</span>
                                    <span class="text-{{ \App\Utilities\Helpers::setBadgeColor($customer->status_pelanggan) }}">{{ $customer->statusPelanggan->nama_status }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Valid:</span>
                                    <span class="text-{{ $customer->is_valid === 1 ? 'success' : 'danger' }}">
                                        {{ $customer->is_valid === 1 ? 'Valid' : 'Tidak Valid' }}
                                    </span>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center pt-2">
                                <a href="{{ route('master.pelanggan.edit', ['id' => Hashids::encode($customer->id)]) }}" class="btn btn-primary me-1">
                                    Edit Pelanggan
                                </a>
                                <a href="{{ route('master.pelanggan.list') }}" class="btn btn-outline-secondary suspend-user">Kembali ke List Pelanggan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
            </div>
            <!--/ User Sidebar -->

            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <!-- Pembayaran Tabel -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Pembayaran</h4>
                    </div>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>PELANGGAN</th>
                            <th>PERIODE</th>
                            <th>TAGIHAN</th>
                            <th>PEMBAYARAN</th>
                            <th class="text-truncate">TGL BAYAR</th>
                            <th class="text-truncate">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($listPembayaran as $list)
                            <tr>
                                <td>
                                    {{ $list->customer->nama_pelanggan }} <span class="font-small-3 text-success">({{ $list->pemakaian_air_saat_ini .' m3' }})</span><br>
                                    <span class="font-small-3 text-muted">{{ $list->no_transaksi }}</span>
                                    <span class="badge badge-light-primary font-small-1">{{ $list->customer->zona->wilayah }}</span>
                                    <span class="badge badge-light-dark font-small-1">{{ $list->customer->golonganTarif->nama_golongan }}</span>
                                </td>
                                <td>
                                    {{ \App\Utilities\Helpers::getNamaBulanIndo($list->bulan_berjalan) }} {{ $list->tahun_berjalan }}
                                </td>
                                <td>{{ number_format($list->total_tagihan,0,',','.') }}</td>
                                <td>{{ number_format($list->total_bayar,0,',','.') }}</td>
                                <td>{{ !is_null($list->tgl_bayar) ? $list->tgl_bayar->format('d/m/y') : '-' }}</td>
                                <td>
                                    @can('print tagihan')
                                        <a href="{{ route('cetak.bukti-pembayaran', ['page' => 'rekening-air', 'pelangganId' => $list->customer->id,'pembayaranId' => $list->id]) }}"
                                           class="btn btn-icon btn-sm btn-primary" target="_blank">
                                            <i class="far fa-print"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="8" class="text-center text-muted"><span>Belum ada data pembayaran.</span></td></tr>
                        @endforelse
                        </tbody>
                    </table>
                    <!-- Pagination Start -->
                    @if($pageData['page'] > 1)
                    <x-pagination
                        :datalinks="$listPembayaran"
                        :page="$pageData['page']"
                        :total-data="$pageData['totalData']"
                        :page-count="$pageData['pageCount']"
                    />
                   @endif
                    <!-- Pagination end -->
                </div>
                <!-- /Pembayaran table -->

                <!-- Activity Timeline -->
                <div class="card">
                    <h4 class="card-header">Sejarah Pembayaran</h4>
                    <div class="card-body pt-1">
                        <ul class="timeline ms-50">
                            @forelse($listHistory as $hist)
                                <li class="timeline-item">
                                    <span class="timeline-point timeline-point-success timeline-point-indicator"></span>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6><span
                                                    class="badge badge-glow badge-light-success">{{ $hist->event }}</span>{{ $hist->customer->nama_pelanggan }}
                                            </h6>
                                            <span class="timeline-event-time me-1">{{ $hist->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p>{{ $hist->description }}</p>
                                    </div>
                                </li>
                                @empty
                                <li>
                                    <span class="text-muted">Belum ada history pembayaran. Silahkan lakukan pembayaran terlebih dahulu.</span>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <!-- /Activity Timeline -->

            </div>
            <!--/ User Content -->
        </div>
    </section>
    @push('vendor-script')

    @endpush

    @push('page-script')

    @endpush
</div>
