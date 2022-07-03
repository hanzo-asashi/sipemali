<div>
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="mb-3">
                <h5 class="card-title">Semua Wajib Pajak <span class="text-muted fw-normal ms-2">({{ $checked ? count($checked) : $wajibPajak->count() }})</span></h5>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                <div>
                    <a href="{{ route('wajib-pajak.create')  }}" class="btn btn-label btn-primary">
                        <i class="bx bx-plus me-1 label-icon"></i>
                        Tambah Wajib Pajak
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card bg-soft-light border-secondary">
        <div class="card-body p-2">
            <div class="row">
                <div class="col-md-10">
                    <!-- Filter start -->
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
                                <label class="form-label" for="form-sm-input">Kecamatan</label>
                                <select wire:model="selectedKecamatan" class="form-select form-select-sm">
                                    <option value="">Semua Kecamatan</option>
                                    @foreach($kecamatan as $kec)
                                        <option wire:key="{{ $kec->id }}" value="{{ $kec->kode }}">{{ $kec->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                            @can('manage-users')
                                <!-- Bulk Action Start -->
                                    @if($selectedRows)
                                        <label class="form-label" for="form-sm-input">Aksi</label>
                                        <x-dropdown>
                                            <x-button class="btn-sm btn-outline-secondary me-50" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Terpilih <span class="badge rounded-pill bg-danger">{{ count($selectedRows) }}</span>
                                                <i class="bx bx-chevron-down"></i>
                                            </x-button>
                                            <x-dropdown-item>
                                                <x-nav-link wire:click="deleteAllSelectedRows" class="dropdown-item btn-sm">
                                                    <span class="align-middle">Hapus Terpilih</span>
                                                </x-nav-link>
                                            </x-dropdown-item>
                                        </x-dropdown>
                                    @endif
                                <!-- Bulk Action End -->
                                @endcan
                            </div>
                        </div>
                    </div>
                    <!-- Filter end -->
                </div>
                <div class="col-md-2">
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-1">
                        <div>
                            <a href="{{ route('wajib-pajak.print') }}" target="_blank" class="btn btn-soft-primary btn-lg mt-1">
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
                        <input type="checkbox" class="form-check-input" id="checkAll" wire:model="selectPageRows"/>
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </th>
                <th scope="col">Wajib Pajak</th>
                <th scope="col">NIK</th>
                <th scope="col">NPWPD</th>
                <th scope="col">Kecamatan</th>
                <th scope="col">Kelurahan</th>
                <th scope="col">Alamat</th>
                <th scope="col" class="text-center">Jumlah Objek Pajak</th>
                <th class="text-center" style="width: 150px; min-width: 80px;">Aksi</th>
            </x-table.table-head>
            <x-table.table-body>
                @forelse($listWajibPajak as $wp)
                    <tr wire:loading.class="opacity-50">
                        <th scope="row">
                            <div class="form-check font-size-16">
                                <input value="{{ $wp->id }}" type="checkbox" id="wajibpajak-{{ $wp->id }}" class="form-check-input"
                                       wire:model="selectedRows" wire.key="wajibpajak-{{ $wp->id }}"/>
                                <label class="form-check-label" for="wajibpajak-{{ $wp->id }}"></label>
                            </div>
                        </th>
                        <td>{{ $wp->nama_wp }}</td>
                        <td>{{ $wp->nik_nib }}</td>
                        <td>{{ $wp->nwpd }}</td>
                        <td>{{ $wp->kec->nama }}</td>
                        <td>{{ $wp->kel->nama }}</td>
                        <td>{{ $wp->alamat }}</td>
                        <td class="text-center">{{ $wp->objekpajak_count }}</td>
                        <td>
                            @can('manage wajib-pajak')
                                <div wire:ignore.self class="d-flex flex-wrap gap-2">
                                    @can('view wajib-pajak')
                                        <a href="{{ route('wajib-pajak.show', $wp->id) }}" class="btn btn-sm btn-soft-info waves-effect
                                        waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Profil">
                                            <i class="bx bx-detail font-size-14 align-middle"></i>
                                        </a>
                                    @endcan
                                    @can('edit wajib-pajak')
                                        <x-nav-link class="btn-sm btn-soft-success waves-effect waves-light"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit Wajib Pajak" wire:key="{{ $wp->id }}"
                                                    href="{{ route('wajib-pajak.edit', ['wajib_pajak' => $wp->id, 'um' => true]) }}"
                                        >
                                            <i class="bx bx-edit font-size-14 align-middle"></i>
                                        </x-nav-link>
                                    @endcan
                                    @can('delete wajib-pajak')
                                        <x-button wire:click="$emit('triggerDelete',{{ $wp->id }},'single')"
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
                    <x-no-table-data class="text-primary" />
                @endforelse
            </x-table.table-body>
        </x-table>
        <!-- end table -->
        <x-pagination>
            {{  $listWajibPajak->links() }}
        </x-pagination>
    </div>
    @push('script')
    <!--suppress JSJQueryEfficiency -->
        @include('widget.action-js')
    @endpush
</div>

