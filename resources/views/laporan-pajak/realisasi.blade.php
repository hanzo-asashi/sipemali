<x-app-layout>
    @section('title') Laporan Realisasi @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Laporan Target Dan Realisasi PAD</x-slot>
    </x-breadcrumb>
    <div class="content-header">
        <div class="card bg-soft-light border-secondary">
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('laporan-pajak.realisasi') }}">
                            {{--                            @include('laporan-pajak.partial.filter', ['listTahun' => $listTahun,'periode' => $periode])--}}
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div>
                                    <label class="form-label mb-0" for="periode">Tahun</label>
                                    {!! Form::select('tahun', $listTahun, $periode, ['class' => 'form-select form-select-sm']) !!}
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 22px;">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        @include('laporan-pajak.partial.action', ['page' => $page, 'periode' => $periode])
{{--                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-1">--}}
{{--                            <div>--}}
{{--                                <a href="{{ route('laporan-pajak.export-excel', ['page' => $page, 'periode' => $periode]) }}" target="_blank" class="btn btn-soft-primary btn-lg mt-1">--}}
{{--                                    <i class="mdi mdi-file-excel"></i>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <a href="{{ route('laporan-pajak.preview', ['page' => $page, 'periode' => $periode]) }}" target="_blank" class="btn btn-soft-primary btn-lg mt-1">--}}
{{--                                    <i class="mdi mdi-printer"></i>--}}
{{--                                </a>--}}
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
                <tr class="border-0">
                    <th colspan="6">
                        <div>
                            <h5>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h5>
                            <h5 class="font-size-16">LAPORAN REALISASI PENDAPATAN ASLI DAERAH</h5>
                            <p class="mb-0">MASA PAJAK : TAHUN {{ setting('tahun_sppt', now()->year) }}</p>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th rowspan="2">Kode Rek</th>
                    <th rowspan="2" width="35%">Uraian</th>
                    <th rowspan="2" style="width: 8%;">Capaian (%)</th>
                    <th rowspan="2">Target Pajak</th>
                    <th rowspan="2">Realisasi</th>
                    <th rowspan="2">Sisa / Denda</th>
                </tr>
                <tr>
                    {{--                    <th>{{ $periode - 1 }}</th>--}}
                    {{--                    <th>{{ $periode  }}</th>--}}
                </tr>
                <tr class="font-size-10 bg-soft-dark">
                    <th class="p-0">I</th>
                    <th class="p-0">II</th>
                    <th class="p-0">III</th>
                    <th class="p-0">IV</th>
                    <th class="p-0">V</th>
                    <th class="p-0">VI</th>
                </tr>
                </thead>
                <tbody>
{{--                <tr>--}}
{{--                    <th style="text-align: center;">4.1</th>--}}
{{--                    <th>PENDAPATAN PAJAK DAERAH</th>--}}
{{--                    <th style="text-align: center;"></th>--}}
{{--                    <th style="text-align: right;">{{ money($totalTarget,'IDR', true) }}</th>--}}
{{--                    <th style="text-align: right;">{{ money($totalRealisasi,'IDR',true) }}</th>--}}
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
                        <th colspan="8" class="text-center">Maaf, data tidak ditemukan</th>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">TOTAL PENDAPATAN PAJAK DAERAH : </th>
                        <th class="text-end">{{ money($totalTarget,'IDR', true) }} </th>
                        <th class="text-end">{{ money($totalRealisasi,'IDR', true) }} </th>
                        <th class="text-end">{{ money($totalSisa,'IDR', true) }} </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @push('script')
    @endpush
</x-app-layout>
