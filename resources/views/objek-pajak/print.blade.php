@extends('layouts.print')
@section('content')
        <div class="print-body">
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="8">
                                <div>
                                    <h4>PEMERINTAH KABUPATEN KOLAKA UTARA<br>BADAN PENDAPATAN DAERAH</h4>
                                    <h5>DAFTAR OBJEK PAJAK</h5>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>No.</th>
                            <th>Objek Pajak</th>
                            <th>Wajib Pajak</th>
                            <th>Jenis Objek Pajak</th>
                            <th>NOPD</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Alamat</th>
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
                        @forelse($objekPajak as $op)
                            <tr>
                                <td>{{ $op->id }}</td>
                                <td>{{ $op->nama_objek_pajak }}</td>
                                <td>{{ $op->wajibpajak->nama_wp }}</td>
                                <td>{{ $op->jenisObjekPajak->nama_jenis_op }}</td>
                                <td>{{ $op->nopd }}</td>
                                <td>{{ \App\Utilities\Helper::getNamaWilayah($op->kecamatan) }}</td>
                                <td>{{ \App\Utilities\Helper::getNamaWilayah($op->kelurahan) }}</td>
                                <td>{{ $op->alamat }}</td>
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
