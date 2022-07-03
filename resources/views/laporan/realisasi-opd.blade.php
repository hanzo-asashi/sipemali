<x-app-layout>
    @section('title') Laporan Realisasi @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Laporan Target Dan Realisasi OPD</x-slot>
    </x-breadcrumb>
    <div class="content-header">
    	<div class="card bg-soft-light border-secondary">
    		<div class="card-body p-2">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('laporan.realisasiopd') }}">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div>
                                    <label class="form-label mb-0" for="filter-tahun">Pilih Periode</label>
                                    {!! Form::select('tahun',['' => 'Semua'] + $listTahun, $periode,['class' => 'form-select form-select-sm']) !!}
                                </div>
                                <div>
                                    <label class="form-label mb-0" for="filter-opd">Pilih OPD</label>
                                    {!! Form::select('opd',['' => 'Semua'] + $opd->toArray(), $filterOpd,['class' => 'form-select form-select-sm']) !!}
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 22px;">Filter</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-4">
                        @include('laporan.partial.action', ['page' => $page, 'periode' => $periode,'opd' => $filterOpd])
{{--                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-1">--}}

{{--                            <div>--}}
{{--                                <a href="{{ route('laporan.preview', ['page' => $page, 'periode' => $periode,'opd' => $filterOpd]) }}" target="_blank" class="btn--}}
{{--                                btn-soft-primary--}}
{{--                                btn-lg--}}
{{--                                mt-1">--}}
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
                    <tr>
                        <th colspan="10">
                            <div>
                                <h5>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h5>
                                <h5 class="font-size-16">LAPORAN REALISASI ORGANISASI PERANGKAT DAERAH</h5>
                                <p class="mb-0">MASA PAJAK : TAHUN {{ setting('tahun_sppt') }}</p>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2" width="2%">No</th>
                        <th rowspan="2" >OPD (Dinas / Badan)</th>
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
                </thead>
                <tbody>
                @php $i = 1 @endphp
{{--                @dd($anggaran)--}}
                @forelse($anggaran as $ang)
                    @php
                        $realisasiRm = $ang->belanja()->where('jenis_belanja',1)->get()->sum('jumlah_transaksi');
                        $realisasiHotel = $ang->belanja()->where('jenis_belanja',2)->get()->sum('jumlah_transaksi')
                    @endphp
                    <tr>
                        <td style="text-align: center;">{{ $i++ }}.</td>
                        <td>{{ $ang->opd->nama_opd }}</td>
                        <td style="text-align: right;">{{ money($ang->nilai_pagu_rm,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($ang->target_pajak_rm,'IDR',true) }}</td>
{{--                        <td style="text-align: right;">{{ money($ang->realisasi_rm,'IDR',true) }}</td>--}}
                        <td style="text-align: right;">{{ money($realisasiRm,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($ang->nilai_pagu_htl,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($ang->target_pajak_htl,'IDR',true) }}</td>
{{--                        <td style="text-align: right;">{{ money($ang->realisasi_htl,'IDR',true) }}</td>--}}
                        <td style="text-align: right;">{{ money($realisasiHotel,'IDR',true) }}</td>
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
    @push('script')
    @endpush
</x-app-layout>





