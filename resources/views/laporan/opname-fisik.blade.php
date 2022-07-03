@extends('layouts.contentLayoutMaster')
@push('vendor-style')
    <!-- Vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
@endpush
@push('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endpush
@section('title', $title)
@section('breadcrumbs')
    @if(isset($breadcrumbs))
        <x-breadcrumb :breadcrumbs="[]"/>
    @endif
@endsection
@section('header-right')
    {{--            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">--}}
    {{--                <div class="mb-1 breadcrumb-right">--}}
    {{--                    <div class="dropdown">--}}
    {{--                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
    {{--                            <i data-feather="grid"></i>--}}
    {{--                        </button>--}}
    {{--                        <div class="dropdown-menu dropdown-menu-end">--}}
    {{--                            <a class="dropdown-item" href="#">--}}
    {{--                                <i class="me-1" data-feather="check-square"></i>--}}
    {{--                                <span class="align-middle">Todo</span>--}}
    {{--                            </a>--}}
    {{--                            <a class="dropdown-item" href="#">--}}
    {{--                                <i class="me-1" data-feather="message-square"></i>--}}
    {{--                                <span class="align-middle">Chat</span>--}}
    {{--                            </a>--}}
    {{--                            <a class="dropdown-item" href="#">--}}
    {{--                                <i class="me-1" data-feather="mail"></i>--}}
    {{--                                <span class="align-middle">Email</span>--}}
    {{--                            </a>--}}
    {{--                            <a class="dropdown-item" href="#">--}}
    {{--                                <i class="me-1" data-feather="calendar"></i>--}}
    {{--                                <span class="align-middle">Calendar</span>--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
@endsection
@push('vendor-style')
    {{--    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">--}}
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card bg-light border-secondary">
                <div class="card-body p-1">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('laporan.penerimaan-penagihan') }}">
                                {{--                            @include('laporan.partial.filter', ['listTahun' => $listTahun,'periode' => $periode])--}}
                                <div class="d-flex flex-wrap align-items-center gap-1">
                                    {{--                                    <div>--}}
                                    {{--                                        <label class="form-label mb-0" for="periode">Tahun</label>--}}
                                    {{--                                        <select class="form-select" name="tahun" id="tahun">--}}
                                    {{--                                            <option value="">Pilih Tahun</option>--}}
                                    {{--                                            <option value="">2022</option>--}}
                                    {{--                                            <option value="">2023</option>--}}
                                    {{--                                            --}}{{--                                            @foreach($listTahun as $tahun)--}}
                                    {{--                                            --}}{{--                                                <option value="{{ $tahun }}" {{ $tahun == $periode ? 'selected' : '' }}>{{ $tahun }}</option>--}}
                                    {{--                                            --}}{{--                                            @endforeach--}}
                                    {{--                                        </select>--}}
                                    {{--                                        --}}{{--                                        {!! Form::select('tahun', $listTahun, $periode, ['class' => 'form-select form-select-sm']) !!}--}}
                                    {{--                                    </div>--}}
                                    <div class="col-md-3">
                                        <input name="periode_range"
                                               type="text"
                                               id="fp-range"
                                               value="{{ $filter['periode_range'] ?? '' }}"
                                               class="form-control flatpickr-range"
                                               placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                        />
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                    <div>
                                        <button id="btnReset" class="btn btn-info">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex flex-wrap justify-content-end align-items-end gap-1">
                                <div>
                                    <a href="{{ route('cetak.preview',['page' => $pageName, 'range' => $range, 'start' => $start, 'end' => $end]) }}"
                                       target="_blank" class="btn btn-primary">
                                        <i class="far fa-print"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table id="umurPiutangPelangganTable" class="table table-bordered border-secondary dataTable">
                    <thead class="text-center bg-light">
                    <tr>
                        <th colspan="17">
                            <div>
                                <h5>PERUSAHAAN DAERAH AIR MINUM <br>KABUPATEN SOPPENG</h5>
                                <h5 class="font-medium-3">{{ Str::upper($title) . ' TAHUN ' .now()->format('Y') }}</h5>
                                {{--                                <p class="mb-0">POSISI PER AKHIR BULAN : {{ now()->startOfMonth()->format('d M Y') }} - {{ now()->endOfMonth()->format('d M Y') }}</p>--}}
                            </div>
                        </th>
                    </tr>
                    <tr class="text-center">
                        <th class="text-center" style="width: 3%;">No.</th>
                        <th class="text-center" style="width: 3%;">No.Sambungan</th>
                        <th style="width: 35%;">Nama</th>
                        @foreach(config('custom.list_bulan') as $key => $bulan)
                            <th style="width: 8%;">{{ $bulan }}</th>
                        @endforeach
                        <th>Jumlah</th>
                        <th>Lembar Rek.</th>
                    </tr>
                    </thead>
                    <tbody class="border-secondary">
{{--                    @php $i = 1 @endphp--}}
                    @forelse($customer as $cust)
                        {{--                        <tr class="bg-light-primary">--}}
                        {{--                            <td colspan="10" class="text-uppercase">Golongan Tarif : {{ $cust->nama_golongan }}</td>--}}
                        {{--                        </tr>--}}
                        <tr>
{{--                            <td class="text-center">{{ $i++ }}</td>--}}
                            <td class="text-center">{{ $cust->id }}</td>
                            <td>{{ $cust->no_sambungan }}</td>
                            <td>{{ $cust->nama_pelanggan }}</td>
                            @foreach(config('custom.list_bulan') as $key => $bulan)
                                <td class="text-center">
                                    {{ number_format($cust->payment()->where('bulan_berjalan', $key)->get()->sum('total_tagihan'),0,',','.') }}
                                </td>
                            @endforeach
{{--                            @dd($cust)--}}
                            <td class="text-center"><b>{{ number_format($cust->payment_sum_total_tagihan ?? 0, 0,',','.') }}</b></td>
                            <td class="text-center">{{ $cust->payment()->where('customer_id', $cust->id)->count() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-1">
                {{--                <x-pagination--}}
                {{--                    :datalinks="$customer"--}}
                {{--                    :page="$page"--}}
                {{--                    :total-data="$totalData"--}}
                {{--                    :page-count="$pageCount"--}}
                {{--                />--}}
                {{ $customer->links() }}
            </div>
        </div>
    </div>
@endsection
@push('vendor-script')

@endpush
@push('page-script')
    <script>
        $(document).ready(function () {
            const rangePickr = document.querySelector("#fp-range");
            rangePickr.flatpickr({
                mode: 'range',
                altInput: true,
                altFormat: 'j F Y',
                dateFormat: 'Y-m-d',
                // disable: [
                //     function(date) {
                //         // disable every multiple of 8
                //         return !(date.getDate() % 7);
                //     }
                // ],
                theme: "dark" // or "dark"
            });

            const btnReset = document.querySelector("#btnReset");
            btnReset.addEventListener('click', function () {
                rangePickr.flatpickr().clear();
            });
        });
    </script>
@endpush
