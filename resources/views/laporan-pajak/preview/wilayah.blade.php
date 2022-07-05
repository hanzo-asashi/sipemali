@extends('layouts.print')
@section('title') Laporan Pajak Berdasarkan Wilayah @endsection
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
                            <th colspan="6">
                                <div>
                                    <h4>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h4>
                                    <h5>LAPORAN REALISASI PENDAPATAN ASLI DAERAH</h5>
                                    <h5>BERDASARKAN WILAYAH KECAMATAN</h5>
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
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Kecamatan</th>
                            <th colspan="5">Jenis Pajak</th>
                            <th rowspan="2">Capaian</th>
                        </tr>
                        <tr>
                            <th>Hotel</th>
                            <th>Rumah Makan</th>
                            <th>Reklame</th>
                            <th>Tambang Mineral</th>
                            <th>PPJ</th>
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
                        </tr>
                        @php $i = 1 @endphp
                        @forelse($wilayah as $op)
                            @php
                                $query = \App\Models\PembayaranPajak::with(['objekpajak'])
                                    ->when($periode, function ($q) use ($periode) {
                                        $q->where('tahun', (int) $periode);
                                    })
                                    ->when($filterBulan, function ($q) use ($filterBulan) {
                                        $q->where('bulan', $filterBulan);
                                    })
                                    ->when($filterKecamatan, function ($q) use ($filterKecamatan) {
                                        $q->whereHas('objekpajak', function ($q) use ($filterBulan) {
                                             $q->where('kecamatan', $filterKecamatan);
                                        });
                                    })
                                    ->whereHas('objekpajak', function ($q) use ($op) {
                                             $q->where('kecamatan', $op->kode);
                                        });
                                    $capaian = $query->whereIn('objek_pajak_id',[1,2,3,4,5])->sum('nilai_pajak')
                            @endphp
                            <tr>
                                <td style="text-align: center;">{{ $i++ }}</td>
                                <td>{{ $op->nama }}</td>
                                <td style="text-align: right;">
                                    {{ money($query->where('objek_pajak_id', 1)->sum('nilai_pajak'),'IDR',true) }}
                                </td>
                                <td style="text-align: right;">
                                    {{ money($query->where('objek_pajak_id', 2)->sum('nilai_pajak'),'IDR',true)}}
                                </td>
                                <td style="text-align: right;">
                                    {{ money($query->where('objek_pajak_id', 3)->sum('nilai_pajak'),'IDR',true)}}
                                </td>
                                <td style="text-align: right;">
                                    {{ money($query->where('objek_pajak_id', 4)->sum('nilai_pajak'),'IDR',true)}}
                                </td>
                                <td style="text-align: right;">
                                    {{ money($query->where('objek_pajak_id', 5)->sum('nilai_pajak'),'IDR',true)}}
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
@endsection
