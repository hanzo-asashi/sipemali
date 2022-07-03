@extends('layouts.print')
@section('title')
    Cetak Pembayaran
@endsection
@section('content')
        <div class="print-body">
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="9">
                                <div>
                                    <h4>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h4>
                                    <h5>DAFTAR PEMBAYARAN {{ strtoupper($title) }}</h5>
                                    <p>MASA PAJAK : TAHUN</p>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>No.</th>
                            <th>Wajib Pajak</th>
                            <th>Tahun</th>
                            <th>Nomor STS</th>
                            <th>Jatuh Tempo</th>
                            <th>Objek Pajak</th>
                            <th>Nilai Pajak</th>
                            <th>Denda</th>
                            <th>Status Transaksi</th>
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
                            <th class="p-0">IX</th>
                        </tr>
                        @forelse($pembayaran as $rm)
                            <tr class="text-center align-middle">
                                <td>{{ $rm->id }}</td>
                                <td>{{ $rm->wajibpajak->nama_wp }}</td>
                                <td>{{ $rm->tahun }}</td>
                                <td>{{ $rm->nomor_sts ?: '-'}}</td>
                                <td>{{ (!is_null($rm->jatuh_tempo)) ? $rm->jatuh_tempo->format('d/m/Y') : '-' }}</td>
                                <td>{{ $rm->objekpajak->nama_objek_pajak }}</td>
                                <td>{{ money($rm->nilai_pajak,'IDR',true) }}</td>
                                <td>{{ money($rm->denda ?: 0,'IDR',true) }}</td>
                                <td>{{ \App\Utilities\Helper::getNamaStatusTransaksi($rm->status_transaksi)  }}</td>
                            </tr>
                        @empty
                            <tr><td class="text-center" colspan="9">Maaf, data tidak ditemukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
