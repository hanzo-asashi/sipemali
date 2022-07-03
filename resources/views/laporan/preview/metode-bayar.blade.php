@extends('layouts.print')
@section('title') Laporan Berdasarkan Metode Bayar @endsection
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
                            <th colspan="6">
                                <div>
                                    <h4>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h4>
                                    <h5>LAPORAN REALISASI PENDAPATAN ASLI DAERAH</h5>
                                    <h5>BERDASARKAN METODE PEMBAYARAN</h5>
                                    <p>MASA PAJAK : TAHUN {{ $periode ?: setting('tahun_sppt') }}</p>
                                </div>
                            </th>
                            <th>
                                <img style="width: 100px;height: 100px;" src="{{ $path."assets/images/logo-djp.png" }}" alt=""/>
                            </th>
                        </tr>
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2" width="20%">Metode Pembayaran</th>
                            <th colspan="5">Jenis Pajak</th>
                            <th rowspan="2">Total Transaksi</th>
                        </tr>
                        <tr>
                            <th width="13%">Hotel</th>
                            <th width="13%">Rumah Makan</th>
                            <th width="13%">Reklame</th>
                            <th width="13%">Tambang Mineral</th>
                            <th width="13%">PPJ</th>
                        </tr>
                        <tr class="font-size-10 bg-soft-dark">
                            <th class="p-0">I</th>
                            <th class="p-0">II</th>
                            <th class="p-0">III</th>
                            <th class="p-0">IV</th>
                            <th class="p-0">V</th>
                            <th class="p-0">VI</th>
                            <th class="p-0">VII</th>
                            <th class="p-0">VIII</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $i = 1 @endphp
                    @forelse($metodeBayar as $op)
                        @php
                            $capaian = $op->pembayaran()->where('metode_bayar',$op->id)->sum('nilai_pajak') + $op->pembayaran()->where('metode_bayar',$op->id)->sum('denda');
                        $rm = $op->pembayaran()->whereHas('objekpajak', function ($q){
                            $q->where('id_jenis_op',1);
                        })->where('metode_bayar',$op->id)->sum('nilai_pajak') + $op->pembayaran()->whereHas('objekpajak', function ($q){
                            $q->where('id_jenis_op',1);
                        })
                        ->where('metode_bayar',$op->id)->sum('denda');
                        $htl = $op->pembayaran()->whereHas('objekpajak', function ($q){
                            $q->where('id_jenis_op',2);
                        })->where('metode_bayar',$op->id)->sum('nilai_pajak') + $op->pembayaran()->where('metode_bayar',$op->id)->whereHas('objekpajak', function ($q){
                            $q->where('id_jenis_op',2);
                        })->sum('denda');
                        $rkl = $op->pembayaran()->where('metode_bayar',$op->id)->whereHas('objekpajak', function ($q){
                            $q->where('id_jenis_op',3);
                        })->sum('nilai_pajak') + $op->pembayaran()->where('metode_bayar',$op->id)->whereHas('objekpajak', function ($q){
                            $q->where('id_jenis_op',3);
                        })->sum('denda');
                        $tbm = $op->pembayaran()->where('metode_bayar',$op->id)->whereHas('objekpajak', function ($q){
                            $q->where('id_jenis_op',4);
                        })->sum('nilai_pajak') + $op->pembayaran()->where('metode_bayar',$op->id)->whereHas('objekpajak', function ($q){
                            $q->where('id_jenis_op',4);
                        })->sum('denda');
                        $ppj = $op->pembayaran()->where('metode_bayar',$op->id)->whereHas('objekpajak', function ($q){
                            $q->where('id_jenis_op',5);
                        })->sum('nilai_pajak') + $op->pembayaran()->where('metode_bayar',$op->id)->whereHas('objekpajak', function ($q){
                            $q->where('id_jenis_op',5);
                        })->sum('denda')
                        @endphp
                        <tr>
                            <td style="text-align: center;">{{ $i++ }}</td>
                            <td>{{ $op->jenis_metode }}</td>
                            <td style="text-align: right;">
                                {{ money($rm,'IDR',true)}}
                            </td>
                            <td style="text-align: right;">
                                {{ money($htl,'IDR',true)}}
                            </td>
                            <td style="text-align: right;">
                                {{ money($rkl,'IDR',true)}}
                            </td>
                            <td style="text-align: right;">
                                {{ money($tbm,'IDR',true)}}
                            </td>
                            <td style="text-align: right;">
                                {{ money($ppj,'IDR',true)}}
                            </td>
                            <td style="text-align: right;">{{ money($capaian,'IDR',true) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-muted" colspan="12">Maaf, Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
