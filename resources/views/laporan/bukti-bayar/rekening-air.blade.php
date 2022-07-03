@extends('layouts.print')

@section('title', 'Cetak Rekening Air')

@push('page-style')
{{--<style>@page { size: A4 }</style>--}}
@endpush

@section('content')
    <div class="print-body">
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th width="8%" style="border-right: 0px;">
                            <img style="width: 35px;height: auto;" src="{{ asset("images/logo/logo-soppeng.png") }}" alt="logo-soppeng"/>
                        </th>
                        <th colspan="5" class="p-5" style="border-left: 0px;border-right: 0px">
                            <h1 class="mt-0 mb-0">REKENING AIR</h1>
                            <h1 class="mt-0 mb-0">{{ strtoupper(setting('nama_kantor')) }}</h1>
                            <h2 class="mt-0 mb-0">{{ strtoupper(setting('alamat_kantor')) . ' TELP. ' . setting('no_telp_kantor') . ' WATANSOPPENG' }}</h2>
                        </th>
                        <th width="10%" style="border-left: 0px;">
                            <img style="width: 50px;height: auto;" src="{{ asset("images/logo/logo-pdam.png") }}" alt="logo-pdam"/>
                        </th>
                    </tr>
                </thead>
            </table>
            <table class="table">
                <tbody>
                <tr>
                    <td colspan="5" style="border-top: 0px;border-right:0px;padding-left: 10px;">
                        <div>
                            <ul class="unstyle" style="padding-top: 5px;">
                                <li>
                                    <b style="float: left;width: 60%;">No. Sambungan</b> {{ ': '. $pelanggan->no_sambungan ?: '-' }}
                                </li>
                                <li>
                                    <b style="float: left;width: 60%;">Nama</b> {{ ': '. $pelanggan->nama_pelanggan ?: '-' }}
                                </li>
                                <li>
                                    <b style="float: left;width: 60%;">Alamat</b> {{ ': '. $pelanggan->alamat_pelanggan ?: '-' }}
                                </li>
                                <li>
                                    <b style="float: left;width: 60%;">Zona</b> {{ ': '. $pelanggan->zona->wilayah ?: '-' }}
                                </li>

                                <li>
                                    <b style="float: left;width: 60%;">Gol. Tarif</b> {{ ': '. $pelanggan->golonganTarif->nama_golongan ?: '-' }}
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td colspan="5" style="border-top: 0px;border-left:0px;padding-left: 40px;">
                        <div>
                            <ul class="unstyle" style="padding-top: 5px;">
                                <li>
                                    <b style="float: left;width: 50%;alignment: right;">No. Rek</b> {{ ': '. $pelanggan->no_sambungan ?: '-' }}
                                </li>
                                <li>
                                    <b style="float: left;width: 50%;">Periode</b> {{': '. \App\Utilities\Helpers::getNamaBulanIndo($pembayaran->bulan_berjalan) . ' ' .
                                    $pembayaran->tahun_berjalan }}
                                </li>
                                <li>
                                    <b style="float: left;width: 50%;">Tgl. Cetak</b> {{ ': '. now()->format('d/m/Y') }}
                                </li>
                                <li>
                                    <b style="float: left;width: 50%;">Metode Bayar</b> {{ ': '. \App\Utilities\Helpers::getNamaMetodeBayar($pembayaran->metode_bayar) }}
                                </li>
                                <li>
                                    <b style="float: left;width: 50%;">Status Bayar</b> {{ ': '. \App\Utilities\Helpers::getNamaStatusBayar($pembayaran->status_pembayaran) }}
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: center;" width="5%">Meter Awal</th>
                    <th style="text-align: center;" width="5%">Meter Akhir</th>
                    <th style="text-align: center;" width="5%">Pem. Air</th>
                    <th style="text-align: center;width: 5%;">Angsuran</th>
                    <th style="text-align: center;">Harga Air</th>
                    <th style="text-align: center;">D.Meter</th>
                    <th style="text-align: center;">B.Layanan</th>
                    <th style="text-align: center;">Denda</th>
                    <th colspan="2" style="text-align: center;">Total Tagihan</th>
                </tr>
                @php
                    $i = 1;
                    $total = $pembayaran->total_tagihan + $pembayaran->denda;
                @endphp
                <tr style="text-align: center;">
                    <td>{{ $pembayaran->stand_awal }}</td>
                    <td>{{ $pembayaran->stand_akhir }}</td>
                    <td>{{ $pembayaran->pemakaian_air_saat_ini .'m3' }}</td>
                    <td>{{ $pembayaran->angsuran ?? 0 }}</td>
                    <td>{{ number_format($pembayaran->harga_air,0,',','.') }}</td>
                    <td>{{ number_format($pembayaran->dana_meter,0,',','.') }}</td>
                    <td>{{ number_format($pembayaran->biaya_layanan,0,',','.') }}</td>
                    <td>{{ number_format($pembayaran->denda,0,',','.') }}</td>
                    <td colspan="2">{{ number_format($pembayaran->total_tagihan,0,',','.') }}</td>
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
                    <th colspan="10" style="text-align: center;">
                        Terbilang :
                        <i class="font-size-18">
                            {{ \App\Utilities\Helpers::terbilang($total) .' rupiah' }}
                        </i>
                    </th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: left;border-right: 0px;font-size: 9pt;">Kasir : {{ auth()->user()->name }}</th>
                    <th colspan="5" style="text-align: right;border-left: 0px;">DIREKTUR</th>
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

@push('page-script')
    <script>
        // window.addEventListener('print', event => {
        //     alert(event.detail);
        //     window.open(event.detail.url, '_blank');
        // });
        // $(function () {
        //     'use strict';
        //     window.print();
        // });
    </script>
@endpush
