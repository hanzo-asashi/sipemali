@extends('layouts.app')
@section('title', 'Laporan Daftar Rekening Ditagih (DRD)')
@push('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endpush
@section('content')
{{--    <livewire:laporan.form-rekening-ditagih />--}}
<div class="row">
    <div class="col-md-6 col-4">
        <div class="card">
            {{--                <div class="card-header">--}}
            {{--                    <h4 class="card-title">Horizontal Form</h4>--}}
            {{--                </div>--}}
            <div class="card-body">
                <form class="form form-horizontal" action="{{ route('laporan.daftar-rekening-ditagih') }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="first-name">Periode</label>
                                </div>
                                <div class="col-sm-9">
                                    <input name="filter[periode_range]" data-input
                                           type="text"
                                           id="fp-range"
                                           value="{{ $filter['periode_range'] ?? '' }}"
                                           class="form-control flatpickr-input flatpickr-range"
                                           placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="email-id">Zona</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" name="filter[zona]">
                                        <option value="">Pilih Zona</option>
                                        @foreach($listZona as $kode => $wilayah)
                                            <option value="{{ $kode }}">{{ $wilayah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="contact-info">Golongan Tarif</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" name="filter[golongan]">
                                        <option value="">Pilih Golongan</option>
                                        @foreach($listGolongan as $kode => $golongan)
                                            <option value="{{ $kode }}">{{ $golongan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary me-1">Cetak</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <div class="card border-secondary">--}}
{{--                <div class="card-body p-1">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-8">--}}
{{--                            <form action="{{ route('laporan.daftar-rekening-ditagih') }}">--}}
{{--                                <div class="d-flex flex-wrap align-items-center gap-1">--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <input name="filter[periode_range]" data-input--}}
{{--                                               type="text"--}}
{{--                                               id="fp-range"--}}
{{--                                               value="{{ $filter['periode_range'] ?? '' }}"--}}
{{--                                               class="form-control flatpickr-input flatpickr-range"--}}
{{--                                               placeholder="YYYY-MM-DD to YYYY-MM-DD"--}}
{{--                                        />--}}
{{--                                        <x-inputs.flatpickr name="periode_range" :value="$filter['periode_range'] ?? ''" />--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-2">--}}
{{--                                        <select class="form-select" name="filter[zona]">--}}
{{--                                            <option value="">Pilih Zona</option>--}}
{{--                                            @foreach($listZona as $kode => $wilayah)--}}
{{--                                                <option value="{{ $kode }}">{{ $wilayah }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-2">--}}
{{--                                        <select class="form-select" name="filter[golongan]">--}}
{{--                                            <option value="">Pilih Golongan</option>--}}
{{--                                           @foreach($listGolongan as $kode => $golongan)--}}
{{--                                                <option value="{{ $kode }}">{{ $golongan }}</option>--}}
{{--                                           @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <button type="submit" class="btn btn-primary">Filter</button>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <button id="btnReset" class="btn btn-info">Reset</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="d-flex flex-wrap align-items-center justify-content-end gap-1">--}}
{{--                                <div>--}}
{{--                                    <a href="{{ route('export.index', ['page' => $page, 'periode' => $periode]) }}" target="_blank" class="btn btn-success">--}}
{{--                                        <i class="far fa-file-excel"></i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <a href="{{ route('cetak.preview', [--}}
{{--                                        'page' => $page, 'periode' => $periode, 'pelanggan' => $pelanggan, 'pembayaran' => $pembayaran,'filterZona' => $filterZona--}}
{{--                                        ]) }}"--}}
{{--                                       target="_blank" class="btn btn-primary">--}}
{{--                                        <i class="far fa-print"></i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="text-center">
                <tr>
                    <th colspan="10" class="bg-white">
                        <div>
                            <h5>PERUSAHAAN DAERAH AIR MINUM <br>KABUPATEN SOPPENG</h5>
                            <h5 class="font-medium-3">LAPORAN REKENING AIR</h5>
                            <p class="mb-0">PERIODE : {{ now()->startOfMonth()->format('d M Y') }} - {{ now()->endOfMonth()->format('d M Y') }}</p>
                        </div>
                    </th>
                </tr>
                <tr class="bg-light-warning">
                    <td colspan="8" class="text-start">Zona : BNA</td>
                </tr>
                <tr>
                    <th rowspan="2" style="width: 2%;" class="bg-white text-center align-middle">No</th>
                    <th rowspan="2" style="width: 6%;" class="bg-white align-middle">No. Sambungan</th>
                    <th rowspan="2" style="width: 25%;" class="bg-white align-middle">Nama</th>
                    <th class="bg-white" colspan="5">Pembebanan</th>
                </tr>
                <tr class="text-center align-middle">
                    <th class="bg-white">Air (m3)</th>
                    <th class="bg-white">Harga Air</th>
                    <th class="bg-white">Dana Meter</th>
                    <th class="bg-white">Biaya Layanan</th>
                    <th class="bg-white">Jumlah Tagihan</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pembayaran as $key => $item)
                <tr class="bg-light-primary">
                    <td colspan="8">Golongan Tarif : {{ $key }}</td>
                </tr>
                @foreach($item as $itemPelanggan)
                    <tr>
                        <td class="text-center">{{ $itemPelanggan->id }}</td>
                        <td class="text-center">{{ $itemPelanggan->customer->no_sambungan }}</td>
                        <td>{{ $itemPelanggan->customer->nama_pelanggan }}</td>
                        <td class="text-center">{{ $item->where('customer_id', $itemPelanggan->customer->id)->sum('pemakaian_air_saat_ini') }}</td>
                        <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($item->where('customer_id',$itemPelanggan->customer->id)->sum('harga_air')) }}</td>
                        <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($item->where('customer_id',$itemPelanggan->customer->id)->sum('dana_meter')) }}</td>
                        <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($item->where('customer_id',$itemPelanggan->customer->id)->sum('biaya_layanan')) }}</td>
                        <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($item->where('customer_id',$itemPelanggan->customer->id)->sum('total_tagihan')) }}</td>
                    </tr>
                @endforeach
                @empty
                    <tr><td colspan="8">Data Tidak ditemukan</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('page-script')
    <script>
        const rangePickr = $('.flatpickr-range');
        if (rangePickr.length) {
            rangePickr.flatpickr({
                mode: 'range',
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "j F Y",
                ariaDateFormat: "j F Y",
                // defaultDate: ['today', new Date().fp_incr(30)],
                onChange: function(dates) {
                    if (dates.length === 2) {
                        let start = dates[0];
                        let end = dates[1];

                        // interact with selected dates here
                    }
                }
            });
        }
    </script>
@endpush
