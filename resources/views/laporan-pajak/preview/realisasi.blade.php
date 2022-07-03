@extends('layouts.print')
@section('title') Laporan Target Dan Realisasi @endsection
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
                    <th colspan="4">
                        <div>
                            <h4>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h4>
                            <h5>LAPORAN REALISASI PENDAPATAN ASLI DAERAH</h5>
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
                    <th rowspan="2">Kode Rek</th>
                    <th rowspan="2" width="35%">Uraian</th>
                    <th rowspan="2" style="width: 8%;">Capaian (%)</th>
                    <th rowspan="2">Target Pajak</th>
                    <th rowspan="2">Realisasi</th>
                    <th rowspan="2">Sisa / Denda</th>
                </tr>
                <tr>
{{--                                        <th>{{ $periode - 1 }}</th>--}}
                    {{--                    <th>{{ $periode  }}</th>--}}
                </tr>
                <tr style="font-size: 9px;">
                    <th class="p-0">I</th>
                    <th class="p-0">II</th>
                    <th class="p-0">III</th>
                    <th class="p-0">IV</th>
                    <th class="p-0">V</th>
                    <th class="p-0">VI</th>
                </tr>
                {{--                <tr>--}}
                {{--                    <th style="text-align: center;">4.1</th>--}}
                {{--                    <th>PENDAPATAN PAJAK DAERAH</th>--}}
                {{--                    <th style="text-align: right;">{{ money($totalTarget,'IDR', true) }}</th>--}}
                {{--                    <th style="text-align: right;">{{ money($totalTarget2020,'IDR',true) }}</th>--}}
                {{--                    <th style="text-align: right;">{{ money($totalRealisasi,'IDR',true) }}</th>--}}
                {{--                    <th style="text-align: center;">{{ number_format($totalPersen,0,',','.') }}%</th>--}}
                {{--                    <th style="text-align: right;">{{ money($totalSisa,'IDR',true) }}</th>--}}
                {{--                </tr>--}}
                @php $i = 1 @endphp
                @forelse($objekPajak as $op)
                    @php
                        $targetPajak = $op->pembayaran()->sum('nilai_pajak');
                        $realisasi = $op->pembayaran()->where('status_bayar',1)->sum('jumlah_bayar') + $op->pembayaran()->where('status_bayar',1)->sum('sisa');
                        $nilaiPajak = $op->pembayaran()->where('status_bayar',1)->sum('nilai_pajak') + $op->pembayaran()->where('status_bayar',1)->sum('denda');
                        $denda = $op->pembayaran()->where('status_bayar',1)->sum('denda');
                        $sisa = $op->pembayaran()->where('status_bayar',1)->sum('sisa')
                    @endphp
                    <tr>
                        <td style="text-align: center;">4.1.{{ $i++ }}</td>
                        <td>{{ $op->jenisObjekPajak->nama_jenis_op }}</td>
                        <td style="text-align: center;">
                            {{$nilaiPajak > 0 && $realisasi > 0 ? App\Utilities\Helper::to_persen($nilaiPajak,$realisasi) : 0 }}
                        </td>
                        <td style="text-align: right;">{{ money($targetPajak,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($realisasi,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($sisa,'IDR', true) }} / {{ money($denda,'IDR', true) }}</td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="8">Maaf, data tidak ditemukan</th>
                    </tr>
                @endforelse
                <tr>
                    <th colspan="3" class="text-end">TOTAL PENDAPATAN PAJAK DAERAH :</th>
                    <th class="text-end">{{ money($totalTarget,'IDR', true) }} </th>
                    <th class="text-end">{{ money($totalRealisasi,'IDR', true) }} </th>
                    <th class="text-end">{{ money($totalSisa,'IDR', true) }} </th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
