<div>
    @extends('layouts.blank')

    @section('title', 'Landing Page')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm order-2 order-sm-1">
                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                        <div class="flex-grow-1">
                            <div>
                                <h5 class="font-size-24 mb-1">{{ strtoupper($detailWajibPajak->nama_wp) }}</h5>
                                <p class="text-muted font-size-13">
                                    <span class="badge rounded-pill bg-success font-size-13">
                                        {{ $detailWajibPajak->jenisWajibPajak()->get()->first()->nama_jenis_wp }}
                                    </span> - <b>KTP :</b> {{ $detailWajibPajak->nik_nib }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-auto order-1 order-sm-2">
                    <div class="d-flex align-items-start justify-content-end gap-2">
                        <div>
                            <a class="btn btn-soft-secondary" href="{{ route('wajib-pajak.edit', ['wajib_pajak' => $detailWajibPajak->id, 'um' => true]) }}">
                                Edit profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>NPWPD</th>
                    <td colspan="5">: {{ $detailWajibPajak->nwpd }}</td>
                </tr>
                <tr>
                    <th width="10%">Kabupaten</th>
                    <td width="17%">{{ $detailWajibPajak->kab->nama }}</td>
                    <th width="10%">Kecamatan</th>
                    <td width="17%">{{ $detailWajibPajak->kec->nama }}</td>
                    <th width="10%">Kelurahan</th>
                    <td width="17%">{{ $detailWajibPajak->kel->nama }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td colspan="5">{{ $detailWajibPajak->alamat }}</td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td>{{ $detailWajibPajak->telepon }}</td>
                    <th>Email</th>
                    <td colspan="4">{{ $detailWajibPajak->email }}</td>
                </tr>
            </table>
        </div><!-- end card header -->

        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-justified" role="tablist" wire:ignore>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-bs-toggle="tab" href="#objek-pajak" role="tab" aria-selected="false">
                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-block">Objek Pajak</span>
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" data-bs-toggle="tab" href="#pembayaran" role="tab" aria-selected="true">
                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-block">Pembayaran</span>
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" data-bs-toggle="tab" href="#tunggakan" role="tab" aria-selected="false">
                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                        <span class="d-none d-sm-block">Tunggakan</span>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content pt-5 text-muted">
                <div class="tab-pane active" id="objek-pajak" role="tabpanel">
                    <di class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="col-md-3">
                                <a href="{{ route('objek-pajak.create',['wajib_pajak_id'=> $detailWajibPajak->id]) }}" class="btn btn-soft-primary">
                                    <i class="bx bx-plus align-middle"></i>
                                    Tambah Objek Pajak
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            @foreach($detailWajibPajak->objekpajak()->get() as $op)
                                <table class="table table-bordered mb-3">
                                    <tr class="bg-light">
                                        <td colspan="6">
                                            <div>
                                                <h5 class="font-size-18 mb-1">{{ $op->nama_objek_pajak }}</h5>
                                                <p class="text-muted font-size-13 mb-0"><b>NOPD :</b> {{ $op->nopd }}</p>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <x-nav-link href="{{ route('objek-pajak.edit',['objek_pajak' => $op->id, 'um' => 1]) }}"
                                                        class="btn btn-success waves-light waves-effect"
                                            >
                                                <i class="bx bx-edit align-middle font-size-14" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Objek Pajak"></i>
                                                Ubah Objek Pajak
                                            </x-nav-link>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Objek Pajak</th>
                                        <td colspan="5">{{ strtoupper(\App\Utilities\Helper::getNamaJenisObjekPajak($op->id_jenis_op,true)) }}</td>
                                    </tr>
                                    <tr>
                                        <th width="10%">Kabupaten</th>
                                        <td width="17%">{{ $op->kab->nama }}</td>
                                        <th width="10%">Kecamatan</th>
                                        <td width="17%">{{ $op->kec->nama }}</td>
                                        <th width="10%">Kelurahan</th>
                                        <td width="17%">{{ $op->kel->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat OP</th>
                                        <td colspan="5">{{ $op->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td colspan="5">{{ $op->keterangan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Izin</th>
                                        <td colspan="5">{{ $op->objekPajakRumahMakan->first()->izin ?? 'Tidak Ada' }}</td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    </di>
                </div>
                <div class="tab-pane" id="pembayaran" role="tabpanel">
                    <table id="datatable" class="table table-bordered table-check nowrap" style="width: 100%;">
                        <thead>
                        <tr class="bg-transparent">
                            <th>Tahun</th>
                            <th>Nomor STS</th>
                            <th>Jatuh Tempo</th>
                            <th>Objek Pajak</th>
                            <th>Nilai Pajak</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($pembayaran as $bayar)
                            <tr>
                                <td>{{ $bayar->tahun }}</td>
                                <td>{{ $bayar->nomor_sts }}</td>
                                <td>{{ !is_null($bayar->jatuh_tempo) ? $bayar->jatuh_tempo->format('d/m/Y') : '-' }}</td>
                                <td>{{ $bayar->objekpajak->first()->nama_objek_pajak }}</td>
                                <td>{{ money($bayar->nilai_pajak,'IDR',true) }}</td>
                                <td>
                                    <div class="badge badge-soft-{{ $bayar->status_bayar ? 'success' : 'danger'  }}  font-size-12">
                                        {{ \App\Utilities\Helper::getNamaStatusBayar($bayar->status_bayar) }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-primary font-size-14 text-center">Maaf, Belum ada data pembayaran</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="tunggakan" role="tabpanel">
                    <table id="datatable" class="table table-bordered table-check nowrap" style="width: 100%;">
                        <thead>
                        <tr class="bg-transparent">
                            <th>Tahun</th>
                            <th>Nomor STS</th>
                            <th>Jatuh Tempo</th>
                            <th>Objek Pajak</th>
                            <th>Nilai Pajak</th>
                            <th>Denda</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tunggakan as $tunggak)
                            <tr>
                                <td>2021</td>
                                <td>#120394</td>
                                <td>31/11/2021</td>
                                <td>Hotel Trimulti</td>
                                <td>Rp. 2.700.000</td>
                                <td>Rp. 700.000</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-primary font-size-14 text-center">Maaf, Belum ada data tunggakan</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- end card-body -->
    </div>
</div>
