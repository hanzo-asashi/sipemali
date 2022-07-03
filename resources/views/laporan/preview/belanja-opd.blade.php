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
                    <th width="2%">No</th>
                    <th width="30%">Objek Pajak</th>
                    <th>Jenis</th>
                    <th>Bulan</th>
                    <th width="15%">Transaksi</th>
                    <th width="15%">Pajak</th>
                </tr>
                <tr class="font-size-10 bg-soft-dark">
                    <th class="p-0">I</th>
                    <th class="p-0">II</th>
                    <th class="p-0">III</th>
                    <th class="p-0">IV</th>
                    <th class="p-0">V</th>
                    <th class="p-0">VI</th>
                </tr>
                @php $i = 1 @endphp
                @forelse($daftarOpd as $blj)
                    <tr>
                        <td colspan="6">
                            <b class="font-size-14">{{ $blj->nama_opd }}</b>
                        </td>
                    </tr>
                    @if($blj->belanjaopd()->count() > 0)
                        @foreach($blj->belanjaopd()->get() as $op)
                            {{--                            @dd($op->objekPajak->first())--}}
                            <tr>
                                <td style="text-align: center;">{{ $i++ }}.</td>
                                <td>{{ $op->objekPajak->first()->nama_objek_pajak }} - <i>nopd : {{ $op->objekPajak->first()->nopd }}</i></td>
                                <td>{{ $op->jenis_belanja === 1 ? 'Rumah Makan' : 'Hotel' }}</td>
                                <td>{{ \App\Utilities\Helper::getNamaBulanIndo($op->bulan) }}</td>
                                <td class="text-end">{{ money($op->jumlah_transaksi,'IDR',true) }}</td>
                                <td class="text-end">{{ money($op->jumlah_pajak,'IDR',true) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <td class="text-center bg-soft-light"  colspan="6">Maaf, Data objek pajak tidak ditemukan</td>
                    @endif
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total : </strong></td>
                        <td class="text-end text-black-50 font-size-13 bg-soft-light">
                            <strong>{{ money($blj->belanjaopd()->get()->sum('jumlah_transaksi'),'IDR',true) }}</strong>

                        </td>
                        <td class="text-end text-black-50 font-size-13 bg-soft-light">
                            <strong>{{ money($blj->belanjaopd()->get()->sum('jumlah_pajak'),'IDR',true) }}</strong>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Maaf, data tidak ditemukan</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
