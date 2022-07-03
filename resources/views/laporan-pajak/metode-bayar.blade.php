<x-app-layout>
    @section('title') Laporan @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Laporan Berdasarkan Metode Bayar</x-slot>
    </x-breadcrumb>
    <div class="content-header">
        <div class="card bg-soft-light border-secondary">
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-md-8">
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <form action="{{ route('laporan-pajak.metodebayar') }}">
                                @include('laporan-pajak.partial.filter', ['listTahun' => $listTahun,'periode' => $periode])
                            </form>
                        </div>
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
                            <p class="mb-0">BERDASARKAN METODE PEMBAYARAN</p>
                            <p class="mb-0">MASA PAJAK : TAHUN {{ $periode ?: setting('tahun_sppt') }}</p>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2" width="20%">Metode Pembayaran</th>
                    <th colspan="5">Jenis Pajak</th>
                    <th rowspan="2">Total Transaksi</th>
                </tr>
                <tr>
                    <th width="13%">Rumah Makan</th>
                    <th width="13%">Hotel</th>
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
    @push('script')
    @endpush
</x-app-layout>
