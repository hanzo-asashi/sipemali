@extends('layouts.print')

@section('title', 'Cetak Rekening Air')

@push('css')
{{--    <style type="text/css">--}}
{{--        @media print{--}}
{{--            body{ background-color:#FFFFFF; background-image:none; color:#000000 }--}}
{{--            #ad{ display:none;}--}}
{{--            #leftbar{ display:none;}--}}
{{--            #contentarea{ width:100%;}--}}
{{--        }--}}
{{--    </style>--}}
<style>@page {
        size: A4
    }</style>
@endpush

@section('content')
    <div class="print-body">
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th width="10%" style="border-right: 0px;">
                        <img style="width: 30px;height: auto;" src="{{ asset("assets/images/logo/logo-soppeng.png") }}" alt=""/>
                    </th>
                    <th colspan="5" class="p-10" style="border-left: 0px;border-right: 0px">
                        <h2 class="mt-0 mb-0">REKENING AIR</h2>
                        <h2 class="mt-0 mb-0">{{ strtoupper(setting('nama_kantor')) }}</h2>
                        <h3 class="mt-0 mb-0">{{ strtoupper(setting('alamat_kantor')) . ' TELP. ' . setting('no_telp_kantor') . ' WATANSOPPENG' }}</h3>
                    </th>
                    <th width="10%" style="border-left: 0px;">
                        <img style="width: 40px;height: auto;" src="{{ asset("assets/images/logo/logo-pdam.png") }}" alt=""/>
                    </th>
                </tr>
                </thead>
            </table>
            <table class="table">
                <tbody>
                <tr>
                    <td colspan="5" style="border-top: 0px;border-right:0px;">
                        <div>
                            <ul class="unstyle" style="padding-top: 5px;">
                                <li>
                                    <b style="float: left;width: 50%;">No. Sambungan</b> {{ ': '. $pelanggan->no_sambungan ?: '-' }}
                                </li>
                                <li>
                                    <b style="float: left;width: 50%;">Nama</b> {{ ': '. $pelanggan->nama_pelanggan ?: '-' }}
                                </li>
                                <li>
                                    <b style="float: left;width: 50%;">Alamat</b> {{ ': '. $pelanggan->alamat_pelanggan ?: '-' }}
                                </li>
                                <li>
                                    <b style="float: left;width: 50%;">Zona</b> {{ ': '. $pelanggan->zona->wilayah ?: '-' }}
                                </li>

                                <li>
                                    <b style="float: left;width: 50%;">Gol. Tarif</b> {{ ': '. $pelanggan->golonganTarif->nama_golongan ?: '-' }}
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td colspan="5" style="border-top: 0px;border-left:0px;">
                        <div>
                            <ul class="unstyle" style="padding-top: 5px;">
                                <li>
                                    <b style="float: left;width: 50%;">No. Rek</b> {{ ': '. $pelanggan->no_sambungan ?: '-' }}
                                </li>
                                <li>
                                    <b style="float: left;width: 50%;">Periode</b> {{': '. \App\Utilities\Helpers::getNamaBulanIndo($pembayaran->bulan_berjalan) . ' ' . $pembayaran->tahun_berjalan }}
                                </li>
                                <li>
                                    <b style="float: left;width: 50%;">Tgl. Cetak</b> {{ ': '. now()->format('d/m/Y') }}
                                </li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: center;" width="5%">Meter Awal</th>
                    <th style="text-align: center;" width="5%">Meter Akhir</th>
                    <th style="text-align: center;" width="5%">Pem. Air</th>
                    <th style="text-align: center;">Angsuran</th>
                    <th style="text-align: center;">Harga Air</th>
                    <th style="text-align: center;">D.Meter</th>
                    <th style="text-align: center;">B.Layanan</th>
                    <th style="text-align: center;">Denda</th>
                    <th style="text-align: center;">Total Tagihan</th>
                </tr>
                @php
                    $i = 1;
                    $total = $pembayaran->total_tagihan + $pembayaran->denda;
                @endphp
                <tr style="text-align: center;">
                    <td>{{ $pembayaran->stand_awal }}</td>
                    <td>{{ $pembayaran->stand_akhir }}</td>
                    <td>{{ $pembayaran->pemakaian_air_saat_ini }}</td>
                    <td>{{ $pembayaran->angsuran }}</td>
                    <td>{{ number_format($pembayaran->harga_air,0,',','.') }}</td>
                    <td>{{ number_format($pembayaran->dana_meter,0,',','.') }}</td>
                    <td>{{ number_format($pembayaran->biaya_layanan,0,',','.') }}</td>
                    <td>{{ number_format($pembayaran->denda,0,',','.') }}</td>
                    <td>{{ number_format($pembayaran->total_tagihan,0,',','.') }}</td>
                </tr>
{{--                <tr>--}}
{{--                    <th style="text-align: right;" colspan="6">Denda <i class="text-muted">(Bunga Keterlambatan)</i></th>--}}
{{--                    <td>{{ $pembayaran->denda }}</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th style="text-align: right;" colspan="4">Jumlah Keseluruhan</th>--}}
{{--                    <td><b>{{ $total }}</b></td>--}}
{{--                </tr>--}}
                <tr>
                    <th colspan="9" style="text-align: center;">
                        Terbilang :
                        <i class="font-size-18">
                            {{ \App\Utilities\Helpers::terbilang($total) .' rupiah' }}
                        </i>
                    </th>
                </tr>
                <tr>
                    <th colspan="5" style="border-right: 0px;"></th>
                    <th colspan="5" style="text-align: center;border-left: 0px;">DIREKTUR</th>
                </tr>
{{--                <tr>--}}
{{--                    <td colspan="9" style="text-align: left; font-style: italic;">--}}
{{--                        <b>Catatan :</b><br>--}}
{{--                        <ol>--}}
{{--                            <li>Harap Penyetoran Dilakukan Pada Bank / Bendahara Penerimaan.</li>--}}
{{--                            <li>Apabila SKPD Ini Tidak Atau Kurang Dibayar Lewat Waktu Paling Lama 30 Hari Setelah SKR Diterima Atau (Tanggal Jatuh Tempo) Dikenakan Sanksi--}}
{{--                                Administrasi Berupa Bunga Sebesar 2% Perbulan.--}}
{{--                            </li>--}}
{{--                        </ol>--}}
{{--                    </td>--}}
{{--                </tr>--}}
                </tbody>
            </table>
{{--            <table class="table no-border mt-4">--}}
{{--                <tbody>--}}
{{--                <tr>--}}
{{--                    <td>--}}
{{--                        <div class="qrcode">--}}
{{--                                                        {!! \App\Utilities\Helper::showQrCode(route('objek-pajak.show', $pembayaran->id),70) !!}--}}
{{--                            {!! \App\Utilities\Helpers::showQrCode($pembayaran->id,70) !!}--}}
{{--                                                        <a href="{{ route('qrcode', $pembayaran->wajib_pajak_id) }}"> Show Page</a>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                    <td width="35%">--}}
{{--                        <div class="text-center p-10">--}}
{{--                            <h4>Kab. Kolaka Utara, {{ \App\Utilities\Helpers::tanggal(now()) }}</h4>--}}
{{--                            <h4>{{ setting('jabatan_skpd', 'DIREKTUR') }}</h4>--}}
{{--                            <h5 style="margin-top: 40px; color: #858585;">Dokumen ini ditandatangani secara elektronik oleh</h5>--}}
{{--                            <h4 style="margin-top: 30px; border-bottom: 1px solid #000;">{{ strtoupper(setting('penandatangan_skpd','-')) }}</h4>--}}
{{--                            <p>NIP: {{ setting('nip_skpd','-') }}</p>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
        </div>
    </div>
@endsection

@push('script')
    <script>
        'use strict';
        window.print();
    </script>
@endpush
