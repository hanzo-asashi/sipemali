@extends('layouts.print')

@section('title', 'Cetak Daftar Rekening Ditagih')

@push('css')
    {{--<style>@page { size: A4 }</style>--}}
@endpush
@section('content')
    <div class="print-body">
        <div>
            <table class="table">
                <thead class="text-center">
                <tr>
                    <th colspan="10" class="bg-white">
                        <div>
                            <h5>PERUSAHAAN DAERAH AIR MINUM <br>KABUPATEN SOPPENG</h5>
                            <h5 class="font-medium-3">LAPORAN REKENING AIR</h5>
                            <p class="mb-0">PERIODE : {{ now()->startOfMonth()->format('d M Y') }} - {{ now()->endOfMonth()->format('d M Y') }}</p>
                        </div>
                    </th>
                </tr>
                <tr class="bg-light-warning">
                    <td colspan="8" class="text-start">Zona : BNA</td>
                </tr>
                <tr>
                    <th rowspan="2" style="width: 2%;" class="bg-white text-center align-middle">No</th>
                    <th rowspan="2" style="width: 6%;" class="bg-white align-middle">No. Sambungan</th>
                    <th rowspan="2" style="width: 25%;" class="bg-white align-middle">Nama</th>
                    <th class="bg-white" colspan="5">Pembebanan</th>
                </tr>
                <tr class="text-center align-middle">
                    <th class="bg-white">Air (m3)</th>
                    <th class="bg-white">Harga Air</th>
                    <th class="bg-white">Dana Meter</th>
                    <th class="bg-white">Biaya Layanan</th>
                    <th class="bg-white">Jumlah Tagihan</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pembayaran as $key => $item)
                    <tr class="bg-light-primary">
                        <td colspan="8">Golongan Tarif : {{ $key }}</td>
                    </tr>
                    @foreach($item as $itemPelanggan)
                        <tr>
                            <td class="text-center">{{ $itemPelanggan->id }}</td>
                            <td class="text-center">{{ $itemPelanggan->customer->no_sambungan }}</td>
                            <td>{{ $itemPelanggan->customer->nama_pelanggan }}</td>
                            <td class="text-center">{{ $item->where('customer_id', $itemPelanggan->customer->id)->sum('pemakaian_air_saat_ini') }}</td>
                            <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($item->where('customer_id',$itemPelanggan->customer->id)->sum('harga_air')) }}</td>
                            <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($item->where('customer_id',$itemPelanggan->customer->id)->sum('dana_meter')) }}</td>
                            <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($item->where('customer_id',$itemPelanggan->customer->id)->sum('biaya_layanan')) }}</td>
                            <td class="text-end">{{ \App\Utilities\Helpers::format_indonesia($item->where('customer_id',$itemPelanggan->customer->id)->sum('total_tagihan')) }}</td>
                        </tr>
                    @endforeach
                @empty
                    <tr><td colspan="8">Data Tidak ditemukan</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('script')
    <script>
        window.print();
    </script>
@endpush
