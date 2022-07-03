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
                                {{--                                <div>--}}
                                {{--                                    <button type="submit" class="btn btn-primary">Filter</button>--}}
                                {{--                                </div>--}}
                                <div>
                                    <button id="btnReset" class="btn btn-icon btn-primary"><i class="far fa-print"></i></button>
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
                        <th colspan="10">
                            <div>
                                <h5>PERUSAHAAN DAERAH AIR MINUM <br>KABUPATEN SOPPENG</h5>
                                <h5 class="font-medium-3">DAFTAR {{ Str::upper($title) }}</h5>
                                <p class="mb-0">POSISI PER AKHIR BULAN : {{ now()->startOfMonth()->format('d M Y') }} - {{ now()->endOfMonth()->format('d M Y') }}</p>
                            </div>
                        </th>
                    </tr>
                    <tr class="text-center">
                        <th class="text-center" style="width: 3%;">No.</th>
                        <th class="text-center" style="width: 3%;">No.Sambungan</th>
                        <th style="width: 35%;">Nama</th>
                        <th  style="width: 5%;">Golongan</th>
                        <th style="width: 8%;">Kuitansi</th>
                        <th>Harga Air</th>
                        <th>Biaya Layanan</th>
                        <th>Dana Meter</th>
                        <th>Jumlah Piutang</th>
                    </tr>
                    </thead>
                    <tbody class="border-secondary">
                    @php $i = 1 @endphp
{{--                        @forelse($customer as $key => $pel)--}}
                    @forelse($customer as $cust)
                        {{--                        <tr class="bg-light-primary">--}}
                        {{--                            <td colspan="10" class="text-uppercase">Golongan Tarif : {{ $cust->nama_golongan }}</td>--}}
                        {{--                        </tr>--}}
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>{{ $cust->no_sambungan }}</td>
                            <td>{{ $cust->nama_pelanggan }}</td>
                            <td>{{ $cust->kode_golongan }}</td>
                            <td class="text-center">{{ $cust->pembayaran_id }}</td>
                            <td class="text-center">{{ $cust->harga_air }}</td>
                            <td class="text-center">{{ $cust->biaya_layanan }}</td>
                            <td class="text-center">{{ $cust->pembayaran_dana_meter }}</td>
                            <td class="text-center">{{ $cust->total_tagihan }}</td>
                        </tr>
                        {{--                        @foreach($pel as $cust)--}}
                        {{--                            --}}
                        {{--                        @endforeach--}}
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div>
                    <nav>
                        {{ $customer->links() }}
                    </nav>
                </div>
            </div>
            {{--            <x-pagination--}}
            {{--                :datalinks="$customer"--}}
            {{--                :page="$page"--}}
            {{--                :total-data="$totalData"--}}
            {{--                :page-count="$pageCount"--}}
            {{--            />--}}
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
