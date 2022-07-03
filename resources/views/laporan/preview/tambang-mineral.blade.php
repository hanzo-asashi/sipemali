@extends('layouts.print')
@section('title') Laporan Tambang Mineral Wajib @endsection
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
                    <th>
                        <img style="width: 80px;height: 80px;" src="{{ $path."assets/images/Lambang-kolut.png" }}" alt=""/>
                    </th>
                    <th colspan="9">
                        <div>
                            <h4>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h4>
                            <h5>LAPORAN WAJIB TAMBANG MINERAL</h5>
                            <p>MASA PAJAK : TAHUN {{ setting('tahun_sppt', now()->year) }}</p>
                        </div>
                    </th>
                    <th>
                        <img style="width: 100px;height: 100px;" src="{{ $path."assets/images/logo-djp.png" }}" alt=""/>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th rowspan="" width="2%">No</th>
                    <th rowspan="" style="width: 8%;">Tanggal Setoran</th>
                    <th colspan="" style="width: 10%;">Nama WP</th>
                    <th colspan="">Jenis Pekerjaan</th>
                    <th colspan="">SKPD</th>
                    <th colspan="">No Kontrak</th>
                    <th colspan="">Nilai Kontrak</th>
                    <th colspan="" style="width: 10%;">Jumlah Tagihan (SKPD)</th>
                    <th colspan="" style="width: 10%;">Jumlah Penerimaan (Rek. Koran)</th>
                    <th colspan="" style="width: 10%;">Lebih/Kurang Bayar</th>
                    <th rowspan="" width="8%">Keterangan</th>
                </tr>
                <tr class="font-size-10 bg-soft-dark">
                    <th class="p-0">I</th>
                    <th class="p-0">II</th>
                    <th class="p-0" colspan="">III</th>
                    <th class="p-0" colspan="">IV</th>
                    <th class="p-0">V</th>
                    <th class="p-0">VI</th>
                    <th class="p-0">VII</th>
                    <th class="p-0">VIII</th>
                    <th class="p-0">IX</th>
                    <th class="p-0">X</th>
                    <th class="p-0">XI</th>
                </tr>
                @php $i = 1 @endphp
                @forelse($objekPajak as $tb)
                    @foreach($tb->objekPajakTambang as $opt)
                        <tr>
                            <td style="text-align: center;">{{ $i++ }}.</td>
                            <td>{{ $opt->tanggal_setoran->format('d/m/y') }}</td>
                            <td>{{ $tb->wajibpajak->nama_wp }}</td>
                            <td>{{ $opt->jenis_pekerjaan }}</td>
                            <td>{{ $opt->opd_penanggungjawab_anggaran }}</td>
                            <td>{{ $opt->no_kontrak }}</td>
                            <td style="text-align: right;">{{ money($opt->nilai_kontrak,'IDR',true) }}</td>
                            <td style="text-align: right;">{{ money($tb->pembayaran()->where('objek_pajak_id', $tb->id)->get()->first()->nilai_pajak, 'IDR', true) }}</td>
                            <td style="text-align: right;">{{ money($tb->pembayaran()->where('objek_pajak_id', $tb->id)->get()->first()->jumlah_bayar,'IDR',true) }}</td>
                            <td style="text-align: right;">{{ money($tb->pembayaran()->where('objek_pajak_id', $tb->id)->get()->first()->sisa,'IDR',true) }}</td>
                            <td>{{ $opt->keterangan }}</td>
                        </tr>
                    @endforeach
                @empty
                    <tr><td colspan="13" class="text-center">Maaf Data tidak ditemukan</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
