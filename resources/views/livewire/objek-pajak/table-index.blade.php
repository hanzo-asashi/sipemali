<div>
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="mb-3">
                <h5 class="card-title">Semua Objek Pajak <span class="text-muted fw-normal ms-2">({{ $checked ? count($checked) : $objekPajak->count() }})</span></h5>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                <div>
                    <a href="{{ route('objek-pajak.create')  }}" class="btn btn-label btn-primary">
                        <i class="bx bx-plus me-1 label-icon"></i>
                        Tambah Objek Pajak
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card bg-soft-light border-secondary">
        <div class="card-body p-2">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <div>
                                <label class="form-label" for="search">Pencarian</label>
                                @include('widget.search-table')
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div>
                                <label class="form-label" for="form-sm-input">Baris</label>
                                @include('widget.page')
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div wire:ignore>
                                <label class="form-label" for="kecamatan">Kecamatan</label>
                                <select wire:model="selectedKecamatan" class="form-select form-select-sm" id="kecamatan">
                                    <option value="">Semua Kecamatan</option>
                                    @foreach($listKecamatan as $kec)
                                        <option value="{{ $kec->kode }}">{{ $kec->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div wire:ignore>
                                <label class="form-label" for="kecamatan">Jenis Objek Pajak</label>
                                <select wire:model="selectedJenisObjekPajak" class="form-select form-select-sm" id="kecamatan">
                                    <option value="">Semua Jenis Objek Pajak</option>
                                    @foreach($listJenisObjekPajak as $key => $jenisop)
                                        <option value="{{ $key }}">{{ $jenisop }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                @can('manage-users')
                                    @include('widget.bulk-action')
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-1">
                        <div>
                            <a href="{{ route('objek-pajak.print') }}" target="_blank" class="btn btn-soft-primary btn-lg mt-1">
                                <i class="mdi mdi-printer"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive mb-4">
        <x-table class="align-middle table-check nowrap">
            <x-table.table-head>
                <th scope="col" style="width: 50px;">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="checkAll" wire:model="selectAll"/>
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </th>
                <th scope="col">Objek Pajak</th>
                <th scope="col">Wajib Pajak</th>
                <th scope="col">Jenis Objek Pajak</th>
                <th scope="col">NOPD</th>
                <th scope="col">Kecamatan</th>
                <th scope="col">Kelurahan</th>
                <th scope="col">Alamat</th>
                <th class="text-center" style="width: 140px; min-width: 80px;">Aksi</th>
            </x-table.table-head>
            <x-table.table-body>
                @forelse($listObjekPajak as $op)
                    <tr wire:loading.class="opacity-50">
                        <th scope="row">
                            <div class="form-check font-size-16">
                                <input value="{{ $op->id }}" type="checkbox" id="objekpajak-{{ $op->id }}" class="form-check-input"
                                       wire:model="checked" wire.key="objekpajak-{{ $op->id }}"/>
                                <label class="form-check-label" for="objekpajak-{{ $op->id }}"></label>
                            </div>
                        </th>
                        <td>{{ $op->nama_objek_pajak }}</td>
                        <td>{{ !is_null($op->wajibpajak) ? $op->wajibpajak->nama_wp : '' }}</td>
                        <td>{{ $op->jenisObjekPajak->nama_jenis_op }}</td>
                        <td>{{ $op->nopd }}</td>
                        <td>{{ $op->kec->nama }}</td>
                        <td>{{ $op->kel->nama }}</td>
                        <td>{{ $op->alamat }}</td>
                        <td>
                            @can('manage objek-pajak')
                                <div wire:ignore.self class="d-flex flex-wrap gap-2">
                                    @can('view objek-pajak')
                                        <a type="button" href="{{ route('objek-pajak.show', $op->id_wp) }}" class="btn btn-sm btn-soft-info waves-effect waves-light"
                                           data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Profil">
                                            <i class="bx bx-detail font-size-14 align-middle"></i>
                                        </a>
                                    @endcan
                                    @can('edit objek-pajak')
                                        <x-nav-link class="btn-sm btn-soft-success waves-effect waves-light"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit Objek Pajak" wire:key="{{ $op->id }}"
                                                    href="{{ route('objek-pajak.edit', ['objek_pajak' => $op->id,'um' => true])}}"
                                        >
                                            <i class="bx bx-edit font-size-14 align-middle"></i>
                                        </x-nav-link>
                                    @endcan
                                    @can('delete objek-pajak')
                                        <x-button wire:click="$emit('triggerDelete',{{ $op->id }},'single')"
                                                  class="btn-sm btn-soft-danger waves-effect waves-light" data-bs-toggle="tooltip"
                                                  data-bs-placement="top" title="Hapus Data">
                                            <i class="bx bx-trash font-size-14 align-middle"></i>
                                        </x-button>
                                    @endcan
                                </div>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <x-no-table-data />
                @endforelse
            </x-table.table-body>
        </x-table>
        <!-- end table -->
        <x-pagination>
            {{  $listObjekPajak->links() }}
        </x-pagination>
    </div>
</div>
@push('script')
    <!--suppress JSJQueryEfficiency -->
    @include('widget.action-js')
@endpush
