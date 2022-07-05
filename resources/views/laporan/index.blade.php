@extends('layouts.app')
@section('title', 'LAPORAN PERUMDA')
@section('content')
    <section id="card-text-alignment">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <div class="card border-primary mb-2">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Rekening Ditagih</h4>
                        <p class="card-text">Daftar Rekening Ditagih atau DRD.</p>
                        <a href="{{ route('laporan.daftar-rekening-ditagih') }}" target="_blank" class="btn btn-outline-primary">Lihat Laporan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="card border-primary mb-2">
                    <div class="card-body">
                        <h4 class="card-title">Penerimaan Tagihan</h4>
                        <p class="card-text">Laporan penerimaan tagihan (LPP).</p>
                        <a href="{{ route('laporan.penerimaan-penagihan',['t' => 'ikh']) }}" target="_blank" class="btn btn-outline-primary">Ikhtisar</a>
                        <a href="{{ route('laporan.penerimaan-penagihan',['t' => 'lpp']) }}" target="_blank" class="btn btn-outline-secondary">Penerimaan Penagihan</a>
                        <a href="{{ route('laporan.penerimaan-penagihan',['t' => 'custom']) }}" target="_blank" class="btn btn-outline-secondary">Custom LPP</a>
{{--                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCustom">--}}
{{--                            Custom--}}
{{--                        </button>--}}
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="card border-success mb-2">
                    <div class="card-body">
                        <h4 class="card-title">Perhitungan</h4>
                        <p class="card-text">Laporan Perhitungan Setoran.</p>
                        <a href="{{ route('laporan.perhitungan') }}" target="_blank" class="btn btn-outline-success">Lihat Laporan</a>
                    </div>
                </div>
            </div>
{{--            <div class="col-md-4 col-lg-4">--}}
{{--                <div class="card border-success mb-2">--}}
{{--                    <div class="card-body">--}}
{{--                        <h4 class="card-title">Daftar Pelanggan</h4>--}}
{{--                        <p class="card-text">Laporan Daftar Pelanggan.</p>--}}
{{--                        <a href="{{ route('laporan.pelanggan') }}" target="_blank" class="btn btn-outline-success">Lihat Laporan</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-md-4 col-lg-4">
                <div class="card border-warning mb-2">
                    <div class="card-body">
                        <h4 class="card-title">Piutang Per Pelanggan</h4>
                        <p class="card-text">Laporan Rincian Piutang Per Pelanggan.</p>
                        <a href="{{ route('laporan.piutang-pelanggan') }}" target="_blank" class="btn btn-outline-warning">Lihat Laporan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="card border-warning mb-2">
                    <div class="card-body">
                        <h4 class="card-title">Piutang Per Kelompok</h4>
                        <p class="card-text">Laporan rincian piutang per kelompok.</p>
                        <a href="{{ route('laporan.piutang-kelompok') }}" target="_blank" class="btn btn-outline-warning">Lihat Laporan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="card border-warning mb-2">
                    <div class="card-body">
                        <h4 class="card-title">Opname Fisik Piutang Per Tahun</h4>
                        <p class="card-text">Laporan opname fisik piutang per tahun.</p>
                        <a href="{{ route('laporan.opname-fisik') }}" target="_blank" class="btn btn-outline-warning">Lihat Laporan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="card border-warning mb-2">
                    <div class="card-body">
                        <h4 class="card-title">Umur Piutang Semua Pelanggan</h4>
                        <p class="card-text">Laporan umur piutang semua pelanggan.</p>
                        <a href="{{ route('laporan.umur-piutang-pelanggan') }}" target="_blank" class="btn btn-outline-warning">Lihat Laporan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="card border-warning mb-2">
                    <div class="card-body">
                        <h4 class="card-title">Umur Piutang Per Kelompok</h4>
                        <p class="card-text">Laporan umur piutang per kelompok.</p>
                        <a href="{{ route('laporan.umur-piutang-kelompok') }}" target="_blank" class="btn btn-outline-warning">Lihat Laporan</a>
                    </div>
                </div>
            </div>
{{--            <div class="col-md-4 col-lg-4">--}}
{{--                <div class="card border-info mb-2">--}}
{{--                    <div class="card-body">--}}
{{--                        <h4 class="card-title">Rekening Air</h4>--}}
{{--                        <p class="card-text">Laporan rekening air.</p>--}}
{{--                        <a href="{{ route('laporan.rekening-air') }}" target="_blank" class="btn btn-outline-info">Lihat Laporan</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>
    <!--/ Text alignment -->
    <div
        class="modal fade text-start"
        id="modalCustom"
        tabindex="-1"
        aria-labelledby="myModalLabel33"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Laporan Penerimaan Penagihan (LPP)</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="card business-card">
                            <div class="card-body">
                                <div class="business-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="business-checkbox-1">
                                            <label class="form-check-label" for="business-checkbox-1">Option #1</label>
                                        </div>
                                        <span class="badge badge-light-success">+$39</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <label>Email: </label>
                            <div class="mb-1">
                                <input type="text" placeholder="Email Address" class="form-control" />
                            </div>

                            <label>Password: </label>
                            <div class="mb-1">
                                <input type="password" placeholder="Password" class="form-control" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
