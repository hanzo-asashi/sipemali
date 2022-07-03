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
                        <form action="{{ route('laporan-pajak.belanjaopd') }}">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div>
                                    <label class="form-label mb-0" for="filter-tahun">Pilih Periode</label>
                                    {!! Form::select('tahun',['' => 'Semua'] + $listTahun,$periode,['class' => 'form-select form-select-sm']) !!}
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
                        @include('laporan-pajak.partial.action', ['page' => $page, 'periode' => $periode,'opd' => $filterOpd])
{{--                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-1">--}}
{{--                            <div>--}}
{{--                                <a href="{{ route('laporan-pajak.preview', ['page' => $page, 'periode' => $periode,'opd' => $filterOpd]) }}" target="_blank" class="btn btn-soft-primary btn-lg--}}
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
                    <th colspan="7">
                        <div>
                            <h5>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h5>
                            <h5 class="font-size-16">LAPORAN BELANJA ORGANISASI PERANGKAT DAERAH</h5>
                            <p class="mb-0">MASA PAJAK : TAHUN</p>
                        </div>
                    </th>
                </tr>
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
                </thead>
                <tbody>
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
    @push('script')
    @endpush
</x-app-layout>
