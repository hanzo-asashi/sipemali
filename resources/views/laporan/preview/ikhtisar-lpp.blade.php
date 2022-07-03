@extends('layouts.print')

@section('title', 'Cetak Ikhtisar LPP')

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
                            <img style="width: 40px;height: auto;" src="{{ asset("images/logo/logo-soppeng.png") }}" alt=""/>
                        </th>
                        <th colspan="6" class="p-10" style="border-left: 0px;border-right: 0px">
                            <h1 class="mt-0 mb-0">PERUSAHAAN UMUM DAERAH TIRTA OMPO <br> PDAM KABUPATEN SOPPENG</h1>
                            <h1 class="mt-0 mb-0">IKHTISAR LAPORAN PENERIMAAN PENAGIHAN</h1>
                            <h2 class="mt-0 mb-0">PERIODE : {{ now()->startOfMonth()->format('d M Y') }} - {{ now()->endOfMonth()->format('d M Y') }}</h2>
                        </th>
                        <th width="10%" style="border-left: 0px;">
                            <img style="width: 60px;height: auto;" src="{{ asset("images/logo/logo-pdam.png") }}" alt=""/>
                        </th>
                    </tr>
                    <tr class="text-center">
                        <th style="width: 3%;">No.</th>
                        <th width="35%" >Nama Kelompok</th>
                        <th>Air (m3)</th>
                        <th>Harga Air</th>
                        <th>Dana Meter</th>
                        <th>Biaya Layanan</th>
                        <th>Denda</th>
                        <th>Total Penerimaan</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $i = 1
                @endphp
                @forelse($customer as $cust)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td>
                            {{ $cust->golonganTarif->nama_golongan }} ({{ $cust->golonganTarif->kode_golongan }})
                        </td>
                        <td class="text-end">{{ $cust->payment()->get()->sum('pemakaian_air_saat_ini') }}</td>
                        <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($cust->payment()->get()->sum('harga_air')) }}</td>
                        <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($cust->payment()->get()->sum('dana_meter')) }}</td>
                        <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($cust->payment()->get()->sum('biaya_layanan')) }}</td>
                        <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($cust->payment()->get()->sum('denda')) }}</td>
                        <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($cust->payment()->get()->sum('total_tagihan')) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Data tidak ditemukan</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2" class="text-end">
                        <b>JUMLAH</b>
                    </td>
                    <td class="text-center"><strong>{{ $customer->sum('payment_sum_pemakaian_air_saat_ini') }}</strong></td>
                    <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($customer->sum('payment_sum_harga_air')) }}</strong></td>
                    <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($customer->sum('payment_sum_dana_meter')) }}</strong></td>
                    <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($customer->sum('payment_sum_biaya_layanan')) }}</strong></td>
                    <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($customer->sum('payment_sum_denda')) }}</strong></td>
                    <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($customer->sum('payment_sum_total_tagihan')) }}</strong></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-end">
                        <b>TOTAL (Penerimaan - Denda)</b>
                    </td>
                    <td colspan="5" class="text-end"></td>
                    <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($customer->sum('payment_sum_total_tagihan')) }}</strong></td>
                </tr>
                </tfoot>
            </table>
        </section>
    </div>
@endsection
@push('page-script')
    <script>
        window.print();
    </script>
@endpush
