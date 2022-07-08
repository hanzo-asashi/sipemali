@extends('layouts.print')

@section('title', 'Cetak Ikhtisar LPP')

@push('page-style')
<style>@page {
        size: A4
    }</style>
@endpush

@section('content')
    <div class="print-body">
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th width="10%" style="border-right: 0px;">
                        <img style="width: 40px;height: auto;" src="{{ asset("assets/images/logo/logo-soppeng.png") }}" alt=""/>
                    </th>
                    <th colspan="15" class="p-10" style="border-left: 0px;border-right: 0px">
                        <h1 class="mt-0 mb-0">PERUSAHAAN UMUM DAERAH TIRTA OMPO <br> PDAM KABUPATEN SOPPENG</h1>
                        <h1 class="mt-0 mb-0">IKHTISAR LAPORAN PENERIMAAN PENAGIHAN</h1>
                        <h2 class="mt-0 mb-0">PERIODE : {{ now()->startOfMonth()->format('d M Y') }} - {{ now()->endOfMonth()->format('d M Y') }}</h2>
                    </th>
                    <th width="10%" style="border-left: 0px;">
                        <img style="width: 60px;height: auto;" src="{{ asset("assets/images/logo/logo-pdam.png") }}" alt=""/>
                    </th>
                </tr>
                <tr class="text-center">
                    <th class="text-center" style="width: 1%;">No.</th>
                    <th class="text-center" style="width: 3%;">No.Sambungan</th>
                    <th style="width: 10%;">Nama</th>
                    @foreach(config('custom.list_bulan') as $key => $bulan)
                        <th style="width: 4%;">{{ $bulan }}</th>
                    @endforeach
                    <th style="width: 1%;">Lembar Rek.</th>
                        <th style="width: 5%;">Jumlah</th>
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
                        <th class="p-0">IX</th>
                        <th class="p-0">X</th>
                        <th class="p-0">XI</th>
                        <th class="p-0">XII</th>
                        <th class="p-0">XIII</th>
                        <th class="p-0">XIV</th>
                        <th class="p-0">XV</th>
                        <th class="p-0">XVI</th>
                        <th class="p-0">XVII</th>
                    </tr>
                </thead>
                <tbody>
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
                        <td class="text-center">{{ $cust->payment()->where('customer_id', $cust->id)->count() }}</td>
                        <td class="text-center"><b>{{ number_format($cust->payment_sum_total_tagihan ?? 0, 0,',','.') }}</b></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Data tidak ditemukan</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="16" class="text-end">
                        <b>TOTAL :</b>
                    </td>
                    <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($customer->sum('payment_sum_total_tagihan')) }}</strong></td>
{{--                    <td class="text-center"><strong>{{ $customer->sum('payment_sum_pemakaian_air_saat_ini') }}</strong></td>--}}
{{--                    <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($customer->sum('payment_sum_dana_meter')) }}</strong></td>--}}
{{--                    <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($customer->sum('payment_sum_biaya_layanan')) }}</strong></td>--}}
{{--                    <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($customer->sum('payment_sum_denda')) }}</strong></td>--}}
{{--                    <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($customer->sum('payment_sum_total_tagihan')) }}</strong></td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td colspan="2" class="text-end">--}}
{{--                        <b>TOTAL (Penerimaan - Denda)</b>--}}
{{--                    </td>--}}
{{--                    <td colspan="5" class="text-end"></td>--}}
{{--                    <td class="text-end"><strong>{{ \App\Utilities\Helpers::format_indonesia($customer->sum('payment_sum_total_tagihan')) }}</strong></td>--}}
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('page-script')
    <script>
        window.print();
    </script>
@endpush
