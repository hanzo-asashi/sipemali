@extends('layouts.print')

@section('title', 'Cetak Penerimaan Penagihan')

@push('page-style')
    {{--<style>@page { size: A4 }</style>--}}
@endpush

@section('content')
    <div class="print-body">
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th width="10%" style="border-right: 0px;">
                        <img style="width: 40px;height: auto;" src="{{ asset("assets/images/logo/logo-soppeng.png") }}" alt=""/>
                    </th>
                    <th colspan="10" class="p-10" style="border-left: 0px;border-right: 0px">
                        <h1 class="mt-0 mb-0">PERUSAHAAN UMUM DAERAH TIRTA OMPO <br> PDAM KABUPATEN SOPPENG</h1>
                        <h1 class="mt-0 mb-0">LAPORAN PENERIMAAN PENAGIHAN</h1>
                        <h2 class="mt-0 mb-0">PERIODE : {{ now()->startOfMonth()->format('d M Y') }} - {{ now()->endOfMonth()->format('d M Y') }}</h2>
                    </th>
                    <th width="10%" style="border-left: 0px;">
                        <img style="width: 60px;height: auto;" src="{{ asset("assets/images/logo/logo-pdam.png") }}" alt=""/>
                    </th>
                </tr>
                <tr class="text-center">
                    <th style="width: 1%;">No.</th>
                    <th style="width: 3%;">Tanggal</th>
                    <th style="width: 3%;">No. Kuit.</th>
                    <th style="width: 3%;">Periode</th>
                    <th style="width: 3%;">No. Samb</th>
                    <th>Nama</th>
                    <th style="width: 3%;">Air (m3)</th>
                    <th style="width: 7%;">Harga Air</th>
                    <th style="width: 7%;">Dana Meter</th>
                    <th style="width: 7%;">Biaya Layanan</th>
                    <th style="width: 7%;">Denda</th>
                    <th style="width: 10%;">Total Penerimaan</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 1
                @endphp
                @forelse($pembayaran as $key => $bayar)
                    <tr>
                        <td colspan="12"><strong>{{ "ZONA : " . $key }}</strong></td>
                    </tr>
                    @foreach($bayar as $byr)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $byr->tgl_bayar->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $byr->no_transaksi }}</td>
                            <td  class="text-center">{{ \App\Utilities\Helpers::getNamaBulanIndo($byr->bulan_berjalan) }}</td>
                            <td>{{ $byr->customer->no_sambungan }}</td>
                            <td>{{ $byr->customer->nama_pelanggan }}</td>
                            <td class="text-end">{{ $byr->pemakaian_air_saat_ini }}</td>
                            <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($byr->harga_air) }}</td>
                            <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($byr->dana_meter) }}</td>
                            <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($byr->biaya_layanan) }}</td>
                            <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($byr->denda) }}</td>
                            <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($byr->total_tagihan) }}</td>
                        </tr>
                    @endforeach
                    <tr class="bg-light">
                        <td colspan="11" class="text-end"><strong>TOTAL {{ $key }}</strong></td>
                        <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($bayar->sum('total_tagihan')) }}</strong></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">Data tidak ditemukan</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('page-script')
    <script>
        'use strict';
        window.print();
    </script>
@endpush
