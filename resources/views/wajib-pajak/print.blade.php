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
                                    <h5>DAFTAR WAJIB PAJAK</h5>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>No.</th>
                            <th>Wajib Pajak</th>
                            <th>NIK</th>
                            <th>NPWPD</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Alamat</th>
                            <th>Jumlah OP</th>
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
                        @forelse($wajibPajak as $wp)
                        <tr>
                            <td>{{ $wp->id }}</td>
                            <td>{{ $wp->nama_wp }}</td>
                            <td>{{ $wp->nik_nib }}</td>
                            <td>{{ $wp->nwpd }}</td>
                            <td>{{ \App\Utilities\Helper::getNamaWilayah($wp->kecamatan) }}</td>
                            <td>{{ \App\Utilities\Helper::getNamaWilayah($wp->kelurahan) }}</td>
                            <td>{{ $wp->alamat }}</td>
                            <td>{{ $wp->objekpajak()->count() }}</td>
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
