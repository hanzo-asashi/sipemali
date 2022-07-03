@extends('layouts.contentLayoutMaster')
@section('title', 'Ikhtisar Laporan Penerimaan Penagihan')
@section('breadcrumbs')
    @if(isset($breadcrumbs))
        <x-breadcrumb :breadcrumbs="[]"/>
    @endif
@endsection
@section('header-right')

@endsection
@push('vendor-style')

@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-secondary">
                <div class="card-body p-1">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('laporan.penerimaan-penagihan') }}">
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <div><input type="hidden" name="t" value="{{ $tipe }}"></div>
                                    <div class="col-md-3">
                                        <input name="filter[periode_range]"
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
                            @include('laporan.partials.action', [
                                    'page' => $page,
                                    'periode' => $periode,
                                    'pelanggan' => $pelanggan,
                                    'pembayaran' => $pembayaran,
                                    'filterZona' => $filterZona,
                                    'range' => $periode,
                                ])
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th colspan="10" class="bg-white">
                                <div>
                                    <h5>PERUSAHAAN DAERAH AIR MINUM <br>KABUPATEN SOPPENG</h5>
                                    <h5 class="font-medium-3">IKHTISAR LAPORAN PENERIMAAN PENAGIHAN</h5>
                                    <p class="mb-0">PERIODE : {{ $start }} - {{ $end }}</p>
                                </div>
                            </th>
                        </tr>
                        <tr class="text-center">
                            <th rowspan="2" class="text-center bg-white" style="width: 3%;">No.</th>
                            <th rowspan="2" width="35%" class="bg-white">Nama Kelompok / Golongan Tarif</th>
                            <th rowspan="2" class="bg-white">Air (m3)</th>
                            <th rowspan="2" class="bg-white">Harga Air</th>
                            <th rowspan="2" class="bg-white">Dana Meter</th>
                            <th rowspan="2" class="bg-white">Biaya Layanan</th>
                            <th rowspan="2" class="bg-white">Denda</th>
                            <th rowspan="2" class="bg-white">Total Penerimaan</th>
                        </tr>
                        <tr>
                            {{--                        <th>dfd</th>--}}
                            {{--                        <th>dfd</th>--}}
                            {{--                    <th>{{ $periode - 1 }}</th>--}}
                            {{--                    <th>{{ $periode  }}</th>--}}
                        </tr>
                        <tr class="font-small-3 bg-light-secondary">
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
                    @php
                        $i = 1
                    @endphp
                    @forelse($customer as $cust)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>
                                {{ $cust->golonganTarif->kode_golongan }} {{ $cust->golonganTarif->nama_golongan }}
                            </td>
                            <td class="text-center">{{ $cust->payment()->get()->sum('pemakaian_air_saat_ini') }}</td>
                            <td class="text-center">{{ $cust->payment()->get()->sum('harga_air') }}</td>
                            <td class="text-center">{{ $cust->payment()->get()->sum('dana_meter') }}</td>
                            <td class="text-center">{{ $cust->payment()->get()->sum('biaya_layanan') }}</td>
                            <td class="text-center">{{ $cust->payment()->get()->sum('denda') }}</td>
                            <td class="text-center">{{ $cust->payment()->get()->sum('total_tagihan') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-end">
                                <b>Jumlah</b>
                            </td>
                            <td class="text-center">{{ $customer->sum('payment_sum_total_tagihan') }}</td>
                            <td class="text-center">{{ $customer->sum('payment_sum_total_tagihan') }}</td>
                            <td class="text-center">{{ $customer->sum('payment_sum_total_tagihan') }}</td>
                            <td class="text-center">{{ $customer->sum('payment_sum_total_tagihan') }}</td>
                            <td class="text-center">{{ $customer->sum('payment_sum_total_tagihan') }}</td>
                            <td class="text-center">{{ $customer->sum('payment_sum_total_tagihan') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">
                                <b>Total (Penerimaan - Denda)</b>
                            </td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center">{{ $customer->sum('payment_sum_total_tagihan') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('page-script')
    <script>
        /**
         * Removes URL parameters
         * @param removeParams - param array
         */
        function removeURLParameters(removeParams) {
            const deleteRegex = new RegExp(removeParams.join('=|') + '=')

            const params = location.search.slice(1).split('&')
            let search = []
            for (let i = 0; i < params.length; i++) if (deleteRegex.test(params[i]) === false) search.push(params[i])

            window.history.replaceState({}, document.title, location.pathname + (search.length ? '?' + search.join('&') : '') + location.hash)
        }

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
