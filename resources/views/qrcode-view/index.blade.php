@extends('layouts.blank')

@section('title', 'QRCode View')

@section('content')
        <div class="bg-light min-vh-100 py-5">
            <div class="py-4">
                <div class="container bg-white">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="content-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="4" class="p-10">
                                                    <div class="row justify-content-between">
                                                        <div class="col-8">
                                                            <img src="{{ asset('assets/images/Lambang-kolut.png') }}" width="80px" height="80px" style="float: left; display: inline-block; margin-right: 10px;">
                                                            <div>
                                                                <h4 class="mt-0 mb-0">{{ strtoupper(setting('footer')) }}</h4>
                                                                <h4 class="mt-0 mb-0">{{ strtoupper(setting('nama_kantor')) }}</h4>
                                                                <p>{{ setting('alamat_kantor') }}</p>
                                                            </div>
                                                        </div>
{{--                                                        <div class="col-2">--}}
{{--                                                            <div class="badge bg-danger mt-3" style="font-size: 24px;">Belum Bayar</div>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <div>
                                                        <ul class="unstyle">
                                                            <li>
                                                                <b>Nama Wajib Pajak</b> {{ $wajibPajak->nama_wp }}
                                                            </li>
                                                            <li>
                                                                <b>NIK</b> {{ $wajibPajak->nik_nib }}
                                                            </li>
                                                            <li>
                                                                <b>Alamat</b> {{ $wajibPajak->alamat }}
                                                            </li>
                                                            <li>
                                                                <b>NPWPD</b> {{ $wajibPajak->nwpd }}
                                                            </li>
{{--                                                            @dd($wajibPajak->pembayaran)--}}
                                                            <li>
                                                                <b>Masa Pajak</b> {{ $wajibPajak->pembayaran->tahun }}
                                                            </li>
                                                            <li>
                                                                <b>Jatuh Tempo</b> {{ (null !== $wajibPajak->pembayaran) ? $wajibPajak->pembayaran->jatuh_tempo->format('d/m/Y'):
                                                                 '-' }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;" width="5%">NO</th>
                                                <th style="text-align: center;">KODE REKENING</th>
                                                <th style="text-align: center;">OBJEK PAJAK DAERAH</th>
                                                <th style="text-align: center;">JUMLAH</th>
                                            </tr>
                                            @php $i = 1 @endphp
                                            @foreach($wajibPajak->objekpajak()->with(['jenisObjekPajak'])->get() as $op)
{{--                                                @dd($op)--}}
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $op->jenisObjekPajak->no_rekening }}</td>
                                                <td>{{ $op->nama_objek_pajak }}</td>
                                                <td>{{ money($wajibPajak->pembayaran()->sum('nilai_pajak'),'IDR',true) }}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th style="text-align: right;" colspan="3">Denda <i class="text-muted">(Bunga Keterlambatan)</i></th>
                                                <td>{{ money($wajibPajak->pembayaran()->sum('denda'),'IDR',true) }}</td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: right;" colspan="3">Jumlah Keseluruhan</th>
                                                <td><b>{{ money($wajibPajak->pembayaran()->sum('nilai_pajak') + $wajibPajak->pembayaran()->sum('denda'),'IDR',true) }}</b></td>
                                            </tr>
                                            <tr>
                                                <th colspan="4" style="text-align: left;">
                                                    Dengan Huruf :
                                                    <i class="font-size-18">
                                                        {{ \App\Utilities\Helper::terbilang($wajibPajak->pembayaran()->sum('nilai_pajak') ) }} rupiah
                                                    </i>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="text-align: left; font-style: italic;">
                                                    <b>Perhatian :</b><br>
                                                    <ol>
                                                        <li>Harap Penyetoran Dilakukan Pada Bank / Bendahara Penerimaan.</li>
                                                        <li>Apabila SKPD Ini Tidak Atau Kurang Dibayar Lewat Waktu Paling Lama 30 Hari Setelah SKR Diterima Atau (Tanggal Jatuh Tempo) Dikenakan Sanksi Administrasi Berupa Bunga Sebesar 2% Perbulan.</li>
                                                    </ol>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="py-4 px-3">
                                    <a href="{{ route('dashboard') }}" class="btn btn-lg btn-info">Menuju Aplikasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
