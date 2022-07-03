<x-app-layout>
    @section('title') Laporan @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Laporan Jenis Pajak</x-slot>
    </x-breadcrumb>
    <div class="content-header">
        <div class="card bg-soft-light border-secondary">
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('laporan-pajak.jenispajak') }}">
                            @include('laporan-pajak.partial.filter', ['listTahun' => $listTahun,'periode' => $periode])
                        </form>
                    </div>
                    <div class="col-md-4">
                            @include('laporan-pajak.partial.action', ['page' => $page, 'periode' => $periode])
{{--                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-1">--}}
{{--                            <div>--}}
{{--                                <a href="{{ route('laporan-pajak.preview', ['page' => $page, 'periode' => $periode]) }}" target="_blank" class="btn btn-soft-primary btn-lg mt-1"><i--}}
{{--                                        class="mdi mdi-printer"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="table-responsive">
            <table class="table table-bordered border-primary font-size-12 mb-0">
                <thead class="text-center bg-gradient">
                <tr>
                    <th colspan="15">
                        <div>
                            <h5>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h5>
                            <h5 class="font-size-16">LAPORAN PENDAPATAN ASLI DAERAH</h5>
                            <p class="mb-0">BERDASARKAN JENIS PAJAK</p>
                            <p class="mb-0">MASA PAJAK : TAHUN {{ $periode }}</p>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th rowspan="2">Kode Rek</th>
                    <th rowspan="2" width="20%">Uraian</th>
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
                <tr class="font-size-10 bg-soft-dark">
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
                </thead>
                <tbody>
                @php $i = 1 @endphp
                @forelse($objekPajak as $op)
                    @php
                        $listBulan = \App\Utilities\Helper::list_bulan();
                        $capaian = $op->pembayaran()->where('status_bayar',1)->where('status_transaksi','<>',2)->sum('nilai_pajak')
                    @endphp
                    <tr>
                        <td style="text-align: center;">4.1.{{ $i++ }}</td>
                        <td>{{ $op->jenisObjekPajak->nama_jenis_op }}</td>
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
    @push('script')
    @endpush
</x-app-layout>
