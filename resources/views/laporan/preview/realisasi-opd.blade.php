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
                    <th colspan="8">
                        <div>
                            <h4>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h4>
                            <h5>LAPORAN REALISASI ORGANISASI PERANGKAT DAERAH</h5>
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
                    <th rowspan="2" width="2%">No</th>
                    <th rowspan="2">OPD (Dinas / Badan)</th>
                    <th colspan="3">Makan Dan Minum</th>
                    <th colspan="3">Hotel</th>
                    <th rowspan="2" width="10%">Total Target</th>
                    <th rowspan="2" width="10%">Total Realisasi</th>
                </tr>
                <tr>
                    <th width="10%">Perkiraan</th>
                    <th width="10%">Target</th>
                    <th width="10%">Realisasi</th>
                    <th width="10%">Perkiraan</th>
                    <th width="10%">Target</th>
                    <th width="10%">Realisasi</th>
                </tr>
                <tr class="font-size-10 bg-soft-dark">
                    <th class="p-0">I</th>
                    <th class="p-0">II</th>
                    <th class="p-0" colspan="3">III</th>
                    <th class="p-0" colspan="3">IV</th>
                    <th class="p-0">V</th>
                    <th class="p-0">VI</th>
                </tr>
                @php $i = 1 @endphp
                @forelse($anggaran as $ang)
                    <tr>
                        <td style="text-align: center;">{{ $i++ }}.</td>
                        <td>{{ $ang->opd->nama_opd }}</td>
                        <td style="text-align: right;">{{ money($ang->nilai_pagu_rm,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($ang->target_pajak_rm,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($ang->realisasi_rm,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($ang->nilai_pagu_htl,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($ang->target_pajak_htl,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($ang->realisasi_htl,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($ang->target_pajak_htl + $ang->target_pajak_rm ,'IDR',true)}}</td>
                        <td style="text-align: right;">{{ money($ang->realisasi_rm + $ang->realisasi_htl ,'IDR',true)}}</td>
                    </tr>
                @empty
                    <tr><td colspan="10" class="text-center">Maaf Data tidak ditemukan</td></tr>
                @endforelse
                <tr class="font-size-12 bg-soft-light">
                    <th class="text-end p-0" colspan="8">Total : </th>
                    <th class="p-0 text-end">{{ money($anggaran->sum('target_pajak_htl') + $anggaran->sum('target_pajak_rm'),'IDR', true) }}</th>
                    <th class="p-0 text-end">{{ money($anggaran->sum('realisasi_rm') + $anggaran->sum('realisasi_htl'),'IDR', true) }}</th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
