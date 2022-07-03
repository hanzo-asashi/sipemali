@extends('layouts.print')

@section('title', 'Cetak Pencatatan Meter')

@push('page-style')
    {{--<style>@page { size: A4 }</style>--}}
@endpush
@section('content')
    <div class="print-body">
        <div>
            <table class="table">
                <thead class="text-center">
                <tr>
                    <th colspan="9" class="bg-white">
                        <div>
                            <h1>PEMERINTAH KABUPATEN SOPPENG <br> PERUSAHAAN UMUM DAERAH (PERUMDA) AIR MINUM TIRTA OMPO</h1>
                            <h5>LAPORAN PENCATATAN METER <br> BULAN : {{ Str::upper(\App\Utilities\Helpers::getNamaBulanIndo(now()->month)) }} {{ now()->year }}</h5>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th style="width: 2%;" class="text-center align-middle">NO</th>
                    <th style="width: 6%;" class="align-middle">NO. SAMB</th>
                    <th style="width: 18%;" class="align-middle">NAMA</th>
                    <th style="width: 18%;" class="bg-white align-middle">ALAMAT</th>
                    <th style="width: 3%;" class="bg-white align-middle">GOL</th>
                    <th style="width: 10%;" class="bg-white align-middle">METER AWAL</th>
                    <th style="width: 10%;" class="bg-white align-middle">METER AKHIR</th>
                    <th style="width: 15%;" class="bg-white align-middle">PETUGAS</th>
                    <th style="width: 10%;" class="bg-white align-middle">KET</th>
                </tr>
                </thead>
                <tbody>
                @forelse($catatMeter as $key => $item)
                    <tr>
                        <td class="text-center">{{ $item->id }}</td>
                        <td class="text-center">{{ $item->customer->no_sambungan }}</td>
                        <td class="text-start">{{ $item->customer->nama_pelanggan }}</td>
                        <td class="text-start">{{ $item->customer->alamat_pelanggan }}</td>
                        <td class="text-center">{{ $item->customer->golonganTarif->kode_golongan }}</td>
                        <td class="text-center">{{ $item->angka_meter_lama }}</td>
                        <td class="text-center">{{ $item->angka_meter_baru }}</td>
                        <td class="text-center">{{ $item->petugas->name }}</td>
                        <td class="text-end">{{ $item->keterangan }}</td>
                    </tr>
                @empty
                    <tr><td colspan="8">Data Tidak ditemukan</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('page-script')
    <script>
        window.print();
    </script>
@endpush
