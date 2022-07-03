@extends('layouts.print')
@section('title') Daftar Tunggakan Pajak @endsection
@section('content')
    <div class="print-body">
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th colspan="9">
                        <div>
                            <h4>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h4>
                            <h5>DAFTAR TUNGGAKAN PAJAK</h5>
                            <p>MASA PAJAK : TAHUN</p>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>No.</th>
                    <th>No. Transaksi</th>
                    <th>Tgl Bayar</th>
                    <th>Tgl Jatuh Tempo</th>
                    <th>Lama Tunggakan</th>
                    <th>Jumlah Tagihan</th>
                    <th>Jumlah Bayar</th>
                    <th>Denda / Sisa</th>
                    <th>Total Tagihan</th>
                    <th>Status Tunggakan</th>
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
                    <th class="p-0">X</th>
                </tr>
                @php $i = 1 @endphp
                @forelse($tunggakan as $tunggak)
                    <tr>
                        <td>{{ $i++ }}</td>
                        @foreach($tunggak->pembayaran as $byr)
                            <td>{{ $byr->no_transaksi }}</td>
                        @endforeach
                        <td>{{ !is_null($tunggak->tgl_bayar) ? $tunggak->tgl_bayar->format('d/m/Y') : '-' }}</td>
                        <td>{{ !is_null($tunggak->tgl_jatuh_tempo) ? $tunggak->tgl_jatuh_tempo->format('d/m/Y') : '-' }}</td>
                        <td>{{ $tunggak->lama_tunggakan ?: 0}}</td>
                        <td>{{ money($tunggak->jumlah_tagihan,'IDR',true) }}</td>
                        <td>{{ money($tunggak->jumlah_bayar,'IDR',true) }}</td>
                        <td>{{ money($tunggak->denda,'IDR',true) }} / {{ money($tunggak->sisa_bayar,'IDR',true) }}</td>
                        <td>{{ money($tunggak->total_tagihan ?: 0,'IDR',true) }}</td>
                        <td>{{ $tunggak->status_tunggakan === 0 ? 'Menunggak' : 'Lancar'  }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="9">Maaf, data tidak ditemukan.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
