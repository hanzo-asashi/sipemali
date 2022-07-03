<!-- Add Permission Modal -->
<div class="modal fade" id="modal-detail-bayar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Detail Pembayaran #{{!is_null($detail) ? $detail->customer->nama_pelanggan : '' }}</h1>
                    <p>Permissions you may use and assign to your users.</p>
                </div>
                <div class="card">
{{--                    <div class="card-body">--}}
{{--                        <div class="user-avatar-section">--}}
{{--                            <div class="d-flex align-items-center flex-column">--}}
{{--                                <div class="user-info text-center">--}}
{{--                                    <h3>{{ $pembayaran->nama_pelanggan }}</h3>--}}
{{--                                    <span class="badge bg-light-secondary">{{ $pembayaran->statusPelanggan->nama_status }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>--}}
{{--                        <div class="info-container">--}}
{{--                            <ul class="list-unstyled">--}}
{{--                                <li class="mb-75">--}}
{{--                                    <span class="fw-bolder me-25">No Sambungan:</span>--}}
{{--                                    <span>{{ $pembayaran->no_sambungan }}</span>--}}
{{--                                </li>--}}
{{--                                <li class="mb-75">--}}
{{--                                    <span class="fw-bolder me-25">Alamat:</span>--}}
{{--                                    <span>{{ $pembayaran->alamat_pelanggan }}</span>--}}
{{--                                </li>--}}
{{--                                <li class="mb-75">--}}
{{--                                    <span class="fw-bolder me-25">Zona:</span>--}}
{{--                                    <span class="badge bg-light-success">{{ $pembayaran->zona->wilayah }} ({{ $pembayaran->zona->kode }})</span>--}}
{{--                                </li>--}}
{{--                                <li class="mb-75">--}}
{{--                                    <span class="fw-bolder me-25">Golongan:</span>--}}
{{--                                    <span>{{ $pembayaran->golonganTarif->deskripsi }}</span>--}}
{{--                                    <span class="badge badge-light-info font-small-2">{{ $pembayaran->golonganTarif->nama_golongan }}</span>--}}
{{--                                </li>--}}
{{--                                <li class="mb-75">--}}
{{--                                    <span class="fw-bolder me-25">Tahun Langganan:</span>--}}
{{--                                    <span>{{ $pembayaran->tahun_langganan }}</span>--}}
{{--                                </li>--}}
{{--                                <li class="mb-75">--}}
{{--                                    <span class="fw-bolder me-25">Status:</span>--}}
{{--                                    <span class="text-{{ \App\Utilities\Helpers::setBadgeColor($pembayaran->status_pelanggan) }}">{{ $pembayaran->statusPelanggan->nama_status--}}
{{--                                    }}</span>--}}
{{--                                </li>--}}
{{--                                <li class="mb-75">--}}
{{--                                    <span class="fw-bolder me-25">Valid:</span>--}}
{{--                                    <span class="text-{{ $pembayaran->is_valid === 1 ? 'success' : 'danger' }}">--}}
{{--                                        {{ $pembayaran->is_valid === 1 ? 'Valid' : 'Tidak Valid' }}--}}
{{--                                    </span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <div class="d-flex justify-content-center pt-2">--}}
{{--                                <a href="{{ route('master.pelanggan.edit', $pembayaran->id) }}" class="btn btn-primary me-1">--}}
{{--                                    Edit PelangganResource--}}
{{--                                </a>--}}
{{--                                --}}{{--                                <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspended</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->
