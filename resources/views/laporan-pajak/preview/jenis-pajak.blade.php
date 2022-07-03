@extends('layouts.print')
@section('title') Laporan Jenis Pajak @endsection
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
                    <th colspan="13">
                        <div>
                            <h4>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h4>
                            <h5>LAPORAN PENDAPATAN ASLI DAERAH</h5>
                            <h5>BERDASARKAN JENIS PAJAK</h5>
                            <p>MASA PAJAK : TAHUN {{ $periode }}</p>
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
                    <th rowspan="2">Uraian</th>
                    <th colspan="12">Bulan</th>
                    <th rowspan="2">Capaian</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                    <th>12</th>
                </tr>
                <tr style="font-size: 9px;">
                    <th class="p-0">I</th>
                    <th class="p-0">II</th>
                    <th class="p-0">III</th>
                    <th class="p-0">IV</th>
                    <th class="p-0">V</th>
                    <th class="p-0">VI</th>
                    <th class="p-0">VII</th>
                    <th class="p-0">VIII</th>
                    <th class="p-0">IX</th>
                    <th class="p-0">X</th>
                    <th class="p-0">XI</th>
                    <th class="p-0">XII</th>
                    <th class="p-0">XIII</th>
                    <th class="p-0">XIV</th>
                    <th class="p-0">XV</th>
                </tr>
                @php $i = 1 @endphp
                @forelse($objekPajak as $op)
                    @php
                        $listBulan = \App\Utilities\Helper::list_bulan();
                        $capaian = $op->pembayaran()->where('status_bayar',1)->where('status_transaksi','<>',2)->sum('nilai_pajak')
                    @endphp
                    <tr>
                        <td style="text-align: center;">4.1.{{ $i++ }}</td>
                        <td>Pajak {{ $op->jenisObjekPajak->nama_jenis_op }}</td>
                        @foreach($listBulan as $key => $item)
                            <td style="text-align: right;">
                                {{ money($op->pembayaran()->where('tahun',setting('tahun_sppt'))->where('bulan', $key)->sum('nilai_pajak'),'IDR',true)}}
                            </td>
                        @endforeach
                        <td style="text-align: right;">{{ money($capaian,'IDR',true) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12">Maaf, Data tidak ditemukan</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
