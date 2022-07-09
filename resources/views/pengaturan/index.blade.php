<x-app-layout>
    @section('title') Pengaturan @endsection

    @push('css')
    <!-- dropzone css -->
        <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css"/>
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Pengaturan</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
            @include('widgets.alert')
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Nav Start -->
                                <div class="col-md-2">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                         aria-orientation="vertical">
                                        <a class="nav-link mb-2 active" id="v-pills-informasi-tab" data-bs-toggle="pill"
                                           href="#v-pills-informasi" role="tab" aria-controls="v-pills-informasi"
                                           aria-selected="true"><i class="bx bx-laptop"></i>&nbsp;&nbsp;Infomasi</a>
                                        <a class="nav-link mb-2" id="v-pills-persuratan-tab" data-bs-toggle="pill"
                                           href="#v-pills-persuratan" role="tab" aria-controls="v-pills-persuratan"
                                           aria-selected="true"><i class="bx bx-envelope"></i>&nbsp;&nbsp;Persuratan</a>
                                        <a class="nav-link mb-2" id="v-pills-aplikasi-tab" data-bs-toggle="pill"
                                           href="#v-pills-aplikasi" role="tab" aria-controls="v-pills-persuratan"
                                           aria-selected="true"><i class="bx bx-desktop"></i> Aplikasi</a>
                                    </div>
                                </div>
                                <!-- Nav end -->

                                <div class="col-md-10">
                                    <form method="POST" action="{{ route('pengaturan.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">

                                            <!-- Tab Informasi start -->
                                            <div class="tab-pane fade show active" id="v-pills-informasi" role="tabpanel"
                                                 aria-labelledby="v-pills-informasi-tab">
                                                <div class="py-1 px-4">
                                                    <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Pengaturan Infomasi</h5>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="">Nama Aplikasi</label>
                                                            <div class="col-md-12">
                                                                <input type="text" name="nama_aplikasi" value="{{ setting('nama_aplikasi',config('app.name')) }}"
                                                                       class="form-control" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="">Nama Kantor</label>
                                                            <div class="col-md-12">
                                                                <input type="text" name="nama_kantor" value="{{ setting('nama_kantor', 'BAPENDA') }}" class="form-control"
                                                                       id="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-8">
                                                            <label class="form-label" for="">Alamat Kantor</label>
                                                            <div class="col-md-12">
                                                                <input name="alamat_kantor" value="{{ setting('alamat_kantor', '') }}" type="text" class="form-control" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Telepon Kantor</label>
                                                            <div class="col-md-12">
                                                                <input name="telp_kantor" value="{{ setting('telp_kantor', '') }}" type="text" class="form-control" id="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Kode Provinsi Sulawesi Selatan</label>
                                                            <div class="col-md-12">
                                                                <input type="text" name="kode_provinsi" value="{{ setting('kode_provinsi','74') }}"
                                                                       class="form-control" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Kode Kabupaten Soppeng</label>
                                                            <div class="col-md-12">
                                                                <input type="text" name="kode_kabupaten" value="{{ setting('kode_kabupaten', '74.08') }}" class="form-control"
                                                                       id="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="">Logo Aplikasi</label>
                                                        <div class="dropzone col-md-4">
                                                            <div class="fallback">
                                                                <input value="{{ setting('logo_aplikasi', 'logo_sm.svg') }}" name="logo_aplikasi" type="file">
                                                            </div>
                                                            <div class="dz-message needsclick">
                                                                <div class="mb-3">
                                                                    <i class="display-4 text-muted bx bx-cloud-upload"></i>
                                                                </div>
                                                                <img class="rounded-circle avatar-xl"
                                                                     src="{{ asset('storage/uploads/'. setting('logo_aplikasi','logo_sm.svg')) }}"
                                                                     alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Copyright</label>
                                                            <div class="col-md-12">
                                                                <input name="copyright" value="{{ setting('copyright', now()->year) }}" type="text" class="form-control" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Tulisan Kaki</label>
                                                            <div class="col-md-12">
                                                                <input name="footer" value="{{ setting('footer', 'Pemerintah Kabupaten Kolaka Utara') }}" type="text"
                                                                       class="form-control" id="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Tab Informasi end -->

                                            <!-- Tab Persuratan start -->
                                            <div class="tab-pane fade show" id="v-pills-persuratan" role="tabpanel"
                                                 aria-labelledby="v-pills-persuratan-tab">
                                                <div class="py-1 px-4">
                                                    <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Pengaturan Persuratan</h5>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Nama Penandatangan 1</label>
                                                            <div class="col-md-12">
                                                                <input name="penandatangan" value="{{ setting('penandatangan', '') }}" type="text" class="form-control" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">NIP 1</label>
                                                            <div class="col-md-12">
                                                                <input name="nip" value="{{ setting('nip', '') }}" type="text" class="form-control" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Jabatan 1</label>
                                                            <div class="col-md-12">
                                                                <input name="jabatan" value="{{ setting('jabatan', '') }}" type="text" class="form-control" id="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Nama Penandatangan 2</label>
                                                            <div class="col-md-12">
                                                                <input name="penandatangan2" value="{{ setting('penandatangan2', '') }}" type="text" class="form-control" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">NIP 2</label>
                                                            <div class="col-md-12">
                                                                <input name="nip2" value="{{ setting('nip2', '') }}" type="text" class="form-control" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Jabatan 2</label>
                                                            <div class="col-md-12">
                                                                <input name="jabatan2" value="{{ setting('jabatan2', '') }}" type="text" class="form-control" id="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Nama Penandatangan SKPD</label>
                                                            <div class="col-md-12">
                                                                <input name="penandatangan_skpd" value="{{ setting('penandatangan_skpd', '') }}" type="text" class="form-control"
                                                                       id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">NIP SKPD</label>
                                                            <div class="col-md-12">
                                                                <input name="nip_skpd" value="{{ setting('nip_skpd', '') }}" type="text" class="form-control" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Jabatan SKPD</label>
                                                            <div class="col-md-12">
                                                                <input name="jabatan_skpd" value="{{ setting('jabatan_skpd', '') }}" type="text" class="form-control" id="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <hr>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Tahun SPPT</label>
                                                            <div class="col-md-12">
                                                                <input name="tahun_sppt" value="{{ setting('tahun_sppt', date(now()->year)) }}" type="text" class="form-control"
                                                                       id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="masa_pajak_bulan">Masa Pajak (Bulan)</label>
                                                            <div class="col-md-12">
                                                                <select name="masa_pajak_bulan" class="form-select form-control" id="masa_pajak_bulan">
                                                                    @foreach(\App\Utilities\Helpers::list_bulan() as $key => $item)
                                                                        <option value="{{ $key }}" @if(setting('masa_pajak_bulan') ===(string) $key ) selected @endif>{{ $item
                                                                        }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Periode Penarikan Pajak</label>
                                                            <div class="col-md-12">
                                                                <select name="periode_penarikan_pajak" class="form-select form-control">
                                                                    @foreach($periode as $key => $item)
                                                                        <option value="{{ $key }}"
                                                                                @if(setting('periode_penarikan_pajak') === $key) selected @endif>{{ $item }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="tgl-periode-pajak">Tanggal Periode Pajak</label>
                                                            <div class="col-md-12">
                                                                <input name="tgl_periode_pajak" type="date"
                                                                       value="{{ now()->startOfMonth()->format('Y-m-d') ?: setting('tgl_periode_pajak', now()->startOfMonth()->format('Y-m-d')) }}"
                                                                       class="form-control flatpickr-input active" id="tgl_periode_pajak">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Tab Persuratan end -->

                                            <!-- Tab Aplikasi start -->
                                            <div class="tab-pane fade show" id="v-pills-aplikasi" role="tabpanel"
                                                 aria-labelledby="v-pills-aplikasi-tab">
                                                <div class="py-1 px-4">
                                                    <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Pengaturan Aplikasi</h5>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="">Ukuran Menu</label>
                                                            <div class="col-md-12">
                                                                <input name="sidebar_size" value="{{ setting('sidebar_size', '') }}" type="text"
                                                                       class="form-control">
                                                                <small class="help-block text-muted">pilihan ukuran : kosong (default), md, sm</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="">Tema Menu Samping (Sidebar)</label>
                                                            <div class="col-md-12">
                                                                <input name="tema_sidebar" value="{{ setting('tema_sidebar', config('custom.theme')) }}" type="text"
                                                                       class="form-control">
                                                                <small class="help-block text-muted">pilihan tema : light (default), dark, brand</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="">Tema Menu Atas (Topbar)</label>
                                                            <div class="col-md-12">
                                                                <input name="tema_topbar" value="{{ setting('tema_topbar', '') }}" type="text"
                                                                       class="form-control">
                                                                <small class="help-block text-muted">pilihan : kosong, dark (untuk dark mode)</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="">Tema Layout</label>
                                                            <div class="col-md-12">
                                                                <input name="tema_layout" value="{{ setting('tema_layout', '') }}" type="text"
                                                                       class="form-control">
                                                                <small class="help-block text-muted">pilihan : kosong, dark (Untuk dark mode)</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-2">
                                                            <label class="form-label" for="format_no_transaksi">Format No. Transaksi</label>
                                                            <div class="col-md-12">
                                                                <input name="format_no_transaksi" value="{{ setting('format_no_transaksi', 'PJO') }}" type="text"
                                                                       class="form-control" id="format_no_transaksi">
                                                                <small class="help-block text-muted">Untuk membuat no transaksi otomatis.</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label class="form-label" for="pemisah">Pemisah</label>
                                                            <div class="col-md-12">
                                                                <input name="pemisah" value="{{ setting('pemisah', '-') }}" type="text"
                                                                       class="form-control" id="pemisah">
                                                                <small class="help-block text-muted">Pemisah nomor transaksi.</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label" for="pemisah">Pajak Mineral (%)</label>
                                                            <div class="col-md-12">
                                                                <input name="persen_pajak_mineral" value="{{ setting('persen_pajak_mineral', 20) }}" type="text"
                                                                       class="form-control" id="persen_pajak_mineral">
                                                                <small class="help-block text-muted">Variabel perhitungan pajak tambang mineral.</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label" for="pemisah">Pajak Anggaran OPD (%)</label>
                                                            <div class="col-md-12">
                                                                <input name="persen_target_anggaran" value="{{ setting('persen_target_anggaran', 10) }}" type="text"
                                                                       class="form-control" id="persen_target_anggaran">
                                                                <small class="help-block text-muted">Persen Target Pajak Anggaran OPD.</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label" for="pemisah">Persen Denda(%)</label>
                                                            <div class="col-md-12">
                                                                <input name="persen_denda_default" value="{{ setting('persen_denda_default', 2) }}" type="text"
                                                                       class="form-control" id="persen_denda_default">
                                                                <small class="help-block text-muted">Persen Denda.</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Tab Aplikasi end -->
                                        </div>
                                        <div class="col-md-6 py-1 px-4 gap-2 d-inline-flex">
                                            <button type="submit" class="btn btn-success w-md btn-label"><i class="bx bx-cog label-icon"></i> Simpan Pengaturan</button>
                                        </div>
                                    </form>
                                </div><!--  end col -->
                            </div><!-- end row -->
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
        </div>
    </div>

    @section('script')
    <!-- dropzone js -->
        <script src="{{ asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
    @endsection
</x-app-layout>
