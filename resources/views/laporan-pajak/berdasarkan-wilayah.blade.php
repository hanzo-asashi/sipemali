<x-app-layout>
    @section('title') Laporan @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Laporan Pajak Berdasarkan Wilayah</x-slot>
    </x-breadcrumb>
    <div class="content-header">
        <div class="card bg-soft-light border-secondary">
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('laporan-pajak.wilayah') }}">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                {{--                                <div>--}}
                                {{--                                    <label class="form-label mb-0" for="form-sm-input">Kecamatan</label>--}}
                                {{--                                    {{ Form::select('kecamatan',--}}
                                {{--                                    ['' => 'Pilih Kecamatan'] + $listKecamatan->pluck('nama','kode')->toArray(),--}}
                                {{--                                    $filterKecamatan,--}}
                                {{--                                    ['class' => 'form-select form-select-sm' ]) }}--}}
                                {{--                                </div>--}}
                                <div>
                                    <label class="form-label mb-0" for="periode">Tahun</label>
                                    {!! Form::select('tahun', $listTahun, $periode, ['class' => 'form-select form-select-sm']) !!}
                                </div>
                                <div>
                                    <label class="form-label mb-0" for="form-sm-input">Bulan</label>
                                    {{ Form::select('bulan',['' => 'Pilih Bulan'] + $listBulan, $filterBulan,['class' => 'form-select form-select-sm' ]) }}
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 22px;">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        @include('laporan-pajak.partial.action', ['page' => $page, 'periode' => $periode,'kecamatan' => $filterKecamatan, 'bulan' => $filterBulan])
{{--                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-1">--}}
{{--                            <div>--}}
{{--                                <a href="--}}
{{--                                    {{ route('laporan-pajak.preview', ['page' => $page, 'periode' => $periode,--}}
{{--                                    'kecamatan' => $filterKecamatan, 'bulan' => $filterBulan]) }}--}}
{{--                                    "--}}
{{--                                   target="_blank" class="btn btn-soft-primary btn-lg mt-1">--}}
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
                    <th colspan="15">
                        <div>
                            <h5>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h5>
                            <h5 class="font-size-16">LAPORAN PENDAPATAN ASLI DAERAH</h5>
                            <p class="mb-0">BERDASARKAN WILAYAH KECAMATAN</p>
                            <p class="mb-0">MASA PAJAK : TAHUN {{ $periode }}</p>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2" width="20%">Kecamatan</th>
                    <th colspan="5">Jenis Pajak</th>
                    <th rowspan="2">Capaian</th>
                </tr>
                <tr>
                    <th width="12%">Rumah Makan</th>
                    <th width="12%">Hotel</th>
                    <th width="12%">Reklame</th>
                    <th width="12%">Tambang Mineral</th>
                    <th width="12%">PPJ</th>
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
                @forelse($wilayah as $op)
                    @php
                        $query = \App\Models\Pembayaran::query()->with(['objekpajak'])
                            ->when($periode, function ($q) use ($periode) {
                                $q->where('tahun', (int) $periode);
                            })
                            ->when($filterBulan, function ($q) use ($filterBulan) {
                                $q->where('bulan', $filterBulan);
                            })
                            ->whereHas('objekpajak', function ($q) use ($op) {
                                $q->where('kecamatan', $op->kode);
                            });
                            $capaian = $query->get()->sum('nilai_pajak');
                            $rm = $query->whereHas('objekpajak', function ($q){
                                $q->where('id_jenis_op', 1);
                            })->get()->sum('nilai_pajak');
                            $hotel = $query->whereHas('objekpajak', function ($q){
                                $q->where('id_jenis_op', 2);
                            })->get()->sum('nilai_pajak');
                            $reklame = $query->whereHas('objekpajak', function ($q){
                                $q->where('id_jenis_op', 3);
                            })->get()->sum('nilai_pajak');
                            $tambang = $query->whereHas('objekpajak', function ($q){
                                $q->where('id_jenis_op', 4);
                            })->get()->sum('nilai_pajak');
                            $ppj = $query->whereHas('objekpajak', function ($q){
                                $q->where('id_jenis_op', 5);
                            })->get()->sum('nilai_pajak')

                    @endphp
                    <tr>
                        <td style="text-align: center;">{{ $i++ }}</td>
                        <td>{{ $op->nama }}</td>
                        <td style="text-align: right;">
                            {{ money($rm,'IDR',true) }}
                        </td>
                        <td style="text-align: right;">
                            {{ money($hotel,'IDR',true)}}
                        </td>
                        <td style="text-align: right;">
                            {{ money($reklame,'IDR',true)}}
                        </td>
                        <td style="text-align: right;">
                            {{ money($tambang,'IDR',true)}}
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
</x-app-layout>
