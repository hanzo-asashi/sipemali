<x-app-layout>
    @section('title') Laporan Wajib Tambang Mineral @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Laporan Wajib Tambang Mineral</x-slot>
    </x-breadcrumb>
    <div class="content-header">
    	<div class="card bg-soft-light border-secondary">
    		<div class="card-body p-2">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('laporan.tambangmineral') }}">
                            @include('laporan.partial.filter', ['listTahun' => $listTahun])
                        </form>
                    </div>
                    <div class="col-md-4">
                        @include('laporan.partial.action', ['page' => $page, 'periode' => $periode])
{{--                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-1">--}}
{{--                            <div>--}}
{{--                                <a href="{{ route('laporan.preview', ['page' => $page, 'periode' => $periode]) }}" target="_blank" class="btn btn-soft-primary btn-lg mt-1">--}}
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
                        <th colspan="12">
                            <div>
                                <h5>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h5>
                                <h5 class="font-size-16">LAPORAN WAJIB TAMBANG MINERAL</h5>
{{--                                <h5 class="font-size-16">ORGANISASI PERANGKAT DAERAH</h5>--}}
                                <p class="mb-0">MASA PAJAK : TAHUN {{ $periode ?: setting('tahun_sppt') }}</p>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="" width="2%">No</th>
                        <th rowspan="" style="width: 8%;">Tanggal Setoran</th>
                        <th colspan="" style="width: 10%;">Nama WP</th>
                        <th colspan="">Jenis Pekerjaan</th>
                        <th colspan="">SKPD</th>
                        <th colspan="">No Kontrak</th>
                        <th colspan="">Nilai Kontrak</th>
                        <th colspan="" style="width: 10%;">Jumlah Tagihan (SKPD)</th>
                        <th colspan="" style="width: 10%;">Jumlah Penerimaan (Rek. Koran)</th>
                        <th colspan="" style="width: 10%;">Lebih/Kurang Bayar</th>
                        <th rowspan="" width="8%">Keterangan</th>
                    </tr>
                    <tr class="font-size-10 bg-soft-dark">
                        <th class="p-0">I</th>
                        <th class="p-0">II</th>
                        <th class="p-0" colspan="">III</th>
                        <th class="p-0" colspan="">IV</th>
                        <th class="p-0">V</th>
                        <th class="p-0">VI</th>
                        <th class="p-0">VII</th>
                        <th class="p-0">VIII</th>
                        <th class="p-0">IX</th>
                        <th class="p-0">X</th>
                        <th class="p-0">XI</th>
                    </tr>
                </thead>
                <tbody>
                @php $i = 1 @endphp
                @forelse($objekPajak as $tb)
                    @foreach($tb->objekPajakTambang as $opt)
                    <tr>
                        <td style="text-align: center;">{{ $i++ }}.</td>
                        <td>{{ $opt->tanggal_setoran->format('d/m/y') }}</td>
                        <td>{{ $tb->wajibpajak->nama_wp }}</td>
                        <td>{{ $opt->jenis_pekerjaan }}</td>
                        <td>{{ $opt->opd_penanggungjawab_anggaran }}</td>
                        <td>{{ $opt->no_kontrak }}</td>
                        <td style="text-align: right;">{{ money($opt->nilai_kontrak,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($tb->pembayaran()->where('objek_pajak_id', $tb->id)->get()->first()->nilai_pajak, 'IDR', true) }}</td>
                        <td style="text-align: right;">{{ money($tb->pembayaran()->where('objek_pajak_id', $tb->id)->get()->first()->jumlah_bayar,'IDR',true) }}</td>
                        <td style="text-align: right;">{{ money($tb->pembayaran()->where('objek_pajak_id', $tb->id)->get()->first()->sisa,'IDR',true) }}</td>
                        <td>{{ $opt->keterangan }}</td>
                    </tr>
                    @endforeach
                @empty
                    <tr><td colspan="13" class="text-center">Maaf Data tidak ditemukan</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @push('script')
    @endpush
</x-app-layout>





