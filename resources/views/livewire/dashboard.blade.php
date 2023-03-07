<div>
    @section('title') Dashboard @endsection
    @push('css')
    @endpush

{{--    @section('breadcrumbs')--}}
{{--        @if(@isset($breadcrumbs))--}}
{{--            <x-breadcrumb :breadcrumbs="$breadcrumbs"/>--}}
{{--        @endisset--}}
{{--    @endsection--}}

        {{--                @if(@isset($breadcrumbs))--}}
        {{--                    <x-breadcrumb :breadcrumbs="$breadcrumbs"/>--}}
        {{--                @endisset--}}
        <div class="row match-height">
            <!-- Statistics Card -->
            <div class="col-xl-12 col-md-6 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">Data Statistik</h4>
                        <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0">Diupdate : {{ $updatedTime }}</p>
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-info me-2">
                                        <div class="avatar-content">
                                            <i class="mdi mdi-account"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{ \App\Utilities\Helpers::number_format_short($statistik['pelanggan']) }}</h4>
                                        <p class="card-text font-small-3 mb-0">Customers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-success me-2">
                                        <div class="avatar-content">
                                            <i class="mdi mdi-transfer"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{ \App\Utilities\Helpers::number_format_short($statistik['pendapatan']) }}</h4>
                                        <p class="card-text font-small-3 mb-0">Pendapatan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            <i class="mdi mdi-account-alert"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{ \App\Utilities\Helpers::number_format_short($statistik['utang'])  }}</h4>
                                        <p class="card-text font-small-3 mb-0">Utang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                            <i class="mdi mdi-account-minus-outline"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{ \App\Utilities\Helpers::number_format_short($statistik['piutang']) }}</h4>
                                        <p class="card-text font-small-3 mb-0">Piutang</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        </div>
        <div class="row match-height">
            <!-- Revenue Report Card -->
            <div class="col-lg-12 col-12">
                <div class="card card-revenue-budget">
                    <div class="row mx-0">
                        <div class="col-md-12 col-12 revenue-report-wrapper">
                            <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-50 mb-sm-0">Total Tagihan Per Bulan</h4>
                                <div class="d-flex align-items-center">
{{--                                    <div class="d-flex align-items-center me-1">--}}
{{--                                        <div class="btn-group">--}}
{{--                                            <button--}}
{{--                                                type="button"--}}
{{--                                                class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown"--}}
{{--                                                data-bs-toggle="dropdown"--}}
{{--                                                aria-haspopup="true"--}}
{{--                                                aria-expanded="false"--}}
{{--                                            >--}}
{{--                                                2022--}}
{{--                                            </button>--}}
{{--                                            <div class="dropdown-menu">--}}
{{--                                                <a class="dropdown-item" href="#">2022</a>--}}
{{--                                                <a class="dropdown-item" href="#">2023</a>--}}
{{--                                                <a class="dropdown-item" href="#">2024</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="d-flex align-items-center ms-75">
                                        <div class="dropdown chart-dropdown">
                                            <i class="fas fa-ellipsis-v cursor-pointer" data-bs-toggle="dropdown"></i>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" wire:click.prevent="setChartFilter(7)" >Last 7 Days</a>
                                                <a class="dropdown-item" wire:click.prevent="setChartFilter(30)" >Last Month</a>
                                                <a class="dropdown-item" wire:click.prevent="setChartFilter(365)" >Last Year</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="column-chart-model" style="height: 32rem;">
                                <livewire:livewire-column-chart
                                    key="{{ $columnChartModel->reactiveKey() }}"
                                    :column-chart-model="$columnChartModel"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Revenue Report Card -->
        </div>
        @push('script')
            @livewireChartsScripts
            {{-- vendor files --}}
            <script src="{{ mix('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        @endpush
</div>
