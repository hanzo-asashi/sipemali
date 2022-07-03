@extends('layouts.print')
@section('title') Cetak Bukti SKPD @endsection

<!-- start page title -->
@section('content')
    <div class="print-body">
        <div>
            <table class="table">
                @php
                    $path = "../public/";
                      if (config('app.env') === 'production'){
                          $path = "../public_html/";
                      }
                @endphp
                <thead>
                <tr>
                    <th width="15%">
                        <img style="width: 60px;height: auto;" src="{{ $path."assets/images/Lambang-kolut.png" }}" alt=""/>
                    </th>
                    <th colspan="3" class="p-10">
                        <h4 class="mt-0 mb-0">{{ strtoupper(setting('footer')) }}</h4>
                        <h4 class="mt-0 mb-0">{{ strtoupper(setting('nama_kantor')) }}</h4>
                        <p>{{ strtoupper(setting('alamat_kantor')) }}</p>
                    </th>
                  	<th width="15%">
                        <img style="width: 120px;height: auto;" src="{{ $path."assets/images/logo-djp.png" }}" alt=""/>
                    </th>
                </tr>
                <tr>
                    <th colspan="5" class="p-10" style="border-bottom: 0;">
                        <div>
                            <h4 class="font-size-16 mt-0 mb-0">SURAT KETETAPAN PAJAK DAERAH</h4>
                            <p class="mb-0">NOMOR SKPD : {{ $pembayaran->nomor_skpd ?: '-' }}</p>
                            <p class="mb-0">MASA PAJAK : TAHUN {{ setting('tahun_sppt') }}</p>
                        </div>
                    </th>
                </tr>
                </thead>
          </table>
          <table class="table">
                <tbody>
                <tr>
                    <td colspan="5">
                        <div>
                            <ul class="unstyle" style="padding-top: 10px;">
                                <li>
                                    <b style="float: left;">Nama Wajib Pajak</b> &nbsp; {{ $pembayaran->wajibpajak->nama_wp ?: '-' }}
                                </li>
                                <li>
                                    <b style="float: left;">NIK</b> &nbsp; {{ $pembayaran->wajibpajak->nik_nib ?: '-' }}
                                </li>
                                <li>
                                    <b style="float: left;">Alamat</b> &nbsp; {{ $pembayaran->wajibpajak->alamat ?: '-' }}
                                </li>
                                <li>
                                    <b style="float: left;">NPWPD</b> &nbsp; {{ $pembayaran->wajibpajak->nwpd ?: '-' }}
                                </li>
{{--                                <li>--}}
{{--                                    <b>Jatuh Tempo</b> {{ $objekPajak->pembayaran->jatuh_tempo?->format('d/m/Y') ?: '-' }}--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: center;" width="5%">NO</th>
                    <th style="text-align: center;">KODE REKENING</th>
                    <th colspan="2" style="text-align: center;">OBJEK PAJAK DAERAH</th>
                    <th style="text-align: center;">JUMLAH</th>
                </tr>
                @php
                    $i = 1;
                    $total = $pembayaran->nilai_pajak + $pembayaran->denda
                @endphp
                <tr>
                    <td style="text-align: center;">{{ $i }}</td>
                    <td>{{ $pembayaran->objekpajak->jenisObjekPajak->no_rekening ?: '-' }}</td>
                    <td colspan="2">
                        {{ $pembayaran->objekpajak->nama_objek_pajak . ' ('. $pembayaran->objekpajak->nopd . ')' }} - Alamat : {{ $pembayaran->objekpajak->alamat }}
                    </td>
                    <td>{{ money($pembayaran->nilai_pajak,'IDR',true) }}</td>
                </tr>
{{--                @foreach($objekPajak->pembayaran()->get() as $bayar)--}}
{{--                <tr>--}}
{{--                    <td>{{ $i++ }}</td>--}}
{{--                    <td>{{ $objekPajak->jenisObjekPajak?->no_rekening ?: '-' }}</td>--}}
{{--                    <td>{{ $objekPajak->nama_objek_pajak . ' ('. $objekPajak->nopd . ')' }} - Alamat : {{ $objekPajak->alamat }}</td>--}}
{{--                    <td>{{ money($bayar->nilai_pajak,'IDR',true) }}</td>--}}
{{--                </tr>--}}
{{--                @endforeach--}}
                <tr>
                    <th style="text-align: right;" colspan="4">Denda <i class="text-muted">(Bunga Keterlambatan)</i></th>
                    <td>{{ money($pembayaran->denda ?: 0,'IDR',true) }}</td>
                </tr>
                <tr>
                    <th style="text-align: right;" colspan="4">Jumlah Keseluruhan</th>
                    <td><b>{{ money($total,'IDR',true) }}</b></td>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: left;">
                        Dengan Huruf :
                        <i class="font-size-18">
                            {{ \App\Utilities\Helper::terbilang($total) .' rupiah' }}
                        </i>
                    </th>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: left; font-style: italic;">
                        <b>Perhatian :</b><br>
                        <ol>
                            <li>Harap Penyetoran Dilakukan Pada Bank / Bendahara Penerimaan.</li>
                            <li>Apabila SKPD Ini Tidak Atau Kurang Dibayar Lewat Waktu Paling Lama 30 Hari Setelah SKR Diterima Atau (Tanggal Jatuh Tempo) Dikenakan Sanksi
                                Administrasi Berupa Bunga Sebesar 2% Perbulan.
                            </li>
                        </ol>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="table no-border mt-30">
                <tbody>
                <tr>
                    <td>
                        <div class="qrcode">
{{--                            {!! \App\Utilities\Helper::showQrCode(route('objek-pajak.show', $pembayaran->id),70) !!}--}}
                            {!! \App\Utilities\Helper::showQrCode(route('qrcode', $pembayaran->wajib_pajak_id),70) !!}
{{--                            <a href="{{ route('qrcode', $pembayaran->wajib_pajak_id) }}"> Show Page</a>--}}
                        </div>
                    </td>
                    <td width="35%">
                        <div class="text-center p-10">
                            <h4>Kab. Kolaka Utara, {{ \App\Utilities\Helper::tanggal(now()) }}</h4>
                            <h4>{{ setting('jabatan_skpd', '-') }}</h4>
                          	<h5 style="margin-top: 40px; color: #858585;">Dokumen ini ditandatangani secara elektronik oleh</h5>
                            <h4 style="margin-top: 30px; border-bottom: 1px solid #000;">{{ strtoupper(setting('penandatangan_skpd','-')) }}</h4>
                            <p>NIP: {{ setting('nip_skpd','-') }}</p>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
