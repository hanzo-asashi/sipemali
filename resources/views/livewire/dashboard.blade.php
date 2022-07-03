<div>
    @section('title') Dashboard @endsection

    @push('css')
    @endpush

    <section id="content">
        <x-breadcrumb>
            <x-slot name="li_1"> Home</x-slot>
            <x-slot name="title"> Dashboard</x-slot>
        </x-breadcrumb>

        <div class="col-filter-ds mb-2 col-md-2">
{{--            <x-inputs.select2 wire:model="tahun" id="tahun" class="form-select form-select-sm" data-placeholder="Pilih Tahun">--}}
{{--                @foreach($listTahun as $key => $tahun)--}}
{{--                    <option value="{{ $key }}">{{ $tahun }}</option>--}}
{{--                @endforeach--}}
{{--            </x-inputs.select2>--}}
            <select wire:model="tahun" class="form-select form-select-sm">
                <option value="">Pilih Tahun</option>
                @foreach($listTahun as $key => $tahun)
                <option value="{{ $key }}">{{ $tahun }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="text-success mb-4 lh-1 d-block">Wajib Pajak</span>
                                <h4 class="mb-1">
                                    <i class="bx bx-user text-success"></i>&nbsp;&nbsp;<span>{{ $totalWajibPajak }}</span> <span class="lead">Orang</span>
                                </h4>
                                {{--                                <div class="text-nowrap mt-2">--}}
                                {{--                                    <span class="badge bg-soft-danger text-danger">-29 Trades</span>--}}
                                {{--                                    <span class="ms-1 text-muted font-size-13">Since last week</span>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="text-info mb-4 lh-1 d-block">Objek Pajak</span>
                                <h4 class="mb-1">
                                    <i class="bx bx-buildings text-info"></i>&nbsp;&nbsp;<span>{{ $totalObjekPajak }}</span> <span class="lead">Objek</span>
                                </h4>
                                {{--                                <div class="text-nowrap mt-2">--}}
                                {{--                                    <span class="badge bg-soft-danger text-danger">-29 Trades</span>--}}
                                {{--                                    <span class="ms-1 text-muted font-size-13">Since last week</span>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="text-warning mb-4 lh-1 d-block">Target Pajak</span>
                                <h4 class="mb-1">
                                    <i class="bx bx-target-lock text-warning"></i>&nbsp;&nbsp;<span class="lead">Rp. </span>
                                    <span>{{ \App\Utilities\Helper::format_angka($totalTargetPajak) }}</span>
                                </h4>
                                {{--                                <div class="text-nowrap mt-2">--}}
                                {{--                                    <span class="badge bg-soft-danger text-danger">-29 Trades</span>--}}
                                {{--                                    <span class="ms-1 text-muted font-size-13">Since last week</span>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="text-danger mb-4 lh-1 d-block">Realisasi Pajak</span>
                                <h4 class="mb-1">
                                    <i class="bx bx-pie-chart text-danger"></i>&nbsp;&nbsp;<span class="lead">Rp. </span>
                                    <span>{{ \App\Utilities\Helper::format_angka($totalRealisasiPajak) }}</span>
                                </h4>
                                {{--                                <div class="text-nowrap mt-2">--}}
                                {{--                                    <span class="badge bg-soft-success text-success">+$29 Trades</span>--}}
                                {{--                                    <span class="ms-1 text-muted font-size-13">Since last week</span>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

        </div><!-- end row-->

        <div class="row">
            <!--Grafik Target dan realisasi-->
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Grafik Target Dan Realisasi Pendapatan</h4>
                    </div>
                    <div class="card-body">
                        <div style="height: 25rem;" class="apex-charts" dir="ltr">
                            <livewire:livewire-column-chart
                                key="{{ $columnChartModel->reactiveKey() }}"
                                :column-chart-model="$columnChartModel"
                            />
                        </div>
                    </div>
                </div>
                <!--end Grafik Target dan realisasi-->
            </div>

            <!--Laporan 10-->
            <div class="col-xl-5">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Laporan 10</h4>
                        <div class="flex-shrink-0">
                            <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#sepuluh-terbesar" role="tab">
                                        Terbesar
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#sepuluh-tercepat" role="tab">
                                        Tercepat
                                    </a>
                                </li>
                            </ul>
                            <!-- end nav tabs -->
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body px-0">
                        <div class="tab-content">
                            <!-- start tab 10 terbesar -->
                            <div class="tab-pane active" id="sepuluh-terbesar" role="tabpanel">
                                <div class="table-responsive px-3" data-simplebar style="max-height: 347px;">
                                    <table class="table align-middle table-nowrap table-borderless">
                                        <tbody>
                                        @forelse($terbesar as $besar)
                                            <tr>
                                                <td style="width: 30px;">
                                                    <div class="font-size-22 text-{{ \App\Utilities\Helper::switchBadge($besar->objekpajak->id_jenis_op) }}">
                                                        {!! \App\Utilities\Helper::switchIcon($besar->objekpajak->id_jenis_op) !!}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h5 class="font-size-14 mb-1">{{ $besar->objekpajak->nama_objek_pajak ?? '-' }}</h5>
                                                        <p class="text-muted mb-0 font-size-12">{{ $besar->objekpajak->jenisObjekPajak->nama_jenis_op ?? '-' }}</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-end">
                                                        <h5 class="font-size-14 mb-0">{{ money($besar->nilai_pajak ?: 0,'IDR',true) }}</h5>
                                                        <p class="text-muted mb-0 font-size-12">Nilai Pajak</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center text-muted font-size-14" colspan="4">Maaf, Belum ada data.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end tab 10 terbesar -->

                            <!-- start tab 10 tercepat -->
                            <div class="tab-pane" id="sepuluh-tercepat" role="tabpanel">
                                <div class="table-responsive px-3" data-simplebar style="max-height: 347px;">
                                    <table class="table align-middle table-nowrap table-borderless">
                                        <tbody>
                                        @forelse($tercepat as $cepat)
                                            <tr>
                                                <td style="width: 30px;">
                                                    <div class="font-size-22 text-{{ \App\Utilities\Helper::switchBadge($cepat->objekpajak->id_jenis_op) }}">
                                                        {!! \App\Utilities\Helper::switchIcon($cepat->objekpajak->id_jenis_op) !!}
                                                    </div>
                                                </td>

                                                <td>
                                                    <div>
                                                        <h5 class="font-size-14 mb-1">{{ $cepat->objekpajak->nama_objek_pajak ?? '-' }}</h5>
                                                        <p class="text-muted mb-0 font-size-12">{{ $cepat->objekpajak->jenisObjekPajak->nama_jenis_op ?? '-' }}</p>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="text-end">
                                                        <h5 class="font-size-14 mb-0"><i class="bx bx-calendar-event"></i>
                                                            {{ \App\Utilities\Helper::convertTglFromString($cepat->created_at) }}
                                                        </h5>
                                                        <p class="text-muted mb-0 font-size-12">Tanggal Bayar</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center text-muted font-size-14" colspan="4">Maaf, Belum ada data.</td>
                                            </tr>
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end tab 10 tercepat -->
                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!--end laporan-pajak 10-->
        </div>

        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Tabel Realisasi Pajak</h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <table class="table align-middle table-check nowrap"
                                   style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                <thead>
                                <tr class="bg-transparent">
                                    <th>Jenis Pajak</th>
                                    <th>Target</th>
                                    <th>Realisasi</th>
                                    <th>Sisa</th>
                                    {{--                                    <th width="100px"></th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($objekPajak as $op)
                                    @php
                                        $nilaiPajak = $op->pembayaran()->where('status_bayar', 1)->sum('nilai_pajak') ?: 0;
                                        $totalTarget = $op->pembayaran()->sum('nilai_pajak') ?: 0;
                                        $denda = $op->pembayaran()->sum('denda') ?: 0;
                                        $sisa = $totalTarget - $nilaiPajak;

                                        if($nilaiPajak > 0 && $totalTarget > 0){
                                            $valNow = \App\Utilities\Helper::to_persen(($nilaiPajak - $denda) ?: 0, $totalTarget);
                                            $valMax = \App\Utilities\Helper::to_persen(($nilaiPajak - $denda) ?: 0, $totalTarget);
                                        }else{
                                            $valNow = 0;
                                            $valMax = 0;
                                        }
                                    @endphp
                                    <tr>
                                        <td>Pajak {{ $op->jenisObjekPajak->nama_jenis_op }} <br>
                                            <span class="badge bg-primary">Total : {{ $op->pembayaran()->count() }}</span></td>
                                        <td>{{ money($totalTarget,'IDR',true) }}</td>
                                        <td>{{ money($nilaiPajak,'IDR',true) }}</td>
                                        <td>{{ money($op->pembayaran()->sum('nilai_pajak') - $op->pembayaran()->where('status_bayar', 1)->sum('nilai_pajak'),'IDR',true) }}</td>
                                        <td>
                                            <div class="progress mt-2" style="height: 6px;">
                                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                                     style="width: {{ $valNow }};"
                                                     aria-valuenow="{{ $valNow }}" aria-valuemin="0"
                                                     aria-valuemax="{{ $valMax }}"
                                                >
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-muted font-size-14" colspan="5">Maaf, Belum ada data objek pajak.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Grafik Realisasi Berdasarkan Jenis Pajak</h4>
                    </div>
                    <div class="card-body">
                        <div style="height: 25rem;" class="apex-charts" dir="ltr">
                            <livewire:livewire-pie-chart
                                key="{{ $pieChartModel->reactiveKey() }}"
                                :pie-chart-model="$pieChartModel"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </section>

    @push('script')
        <script src="{{ URL::asset('/assets/libs/imask/imask.min.js') }}"></script>
        <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    @endpush
    @livewireChartsScripts
</div>
