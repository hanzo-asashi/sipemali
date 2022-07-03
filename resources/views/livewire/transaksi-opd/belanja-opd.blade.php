<div>
    @section('title') Belanja OPD @endsection
    @push('css') @endpush

    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Belanja OPD</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
            <div class="row">
                <div class="col-xl-3">
                    <x-card>
                        <x-card-header class="card-header">
                            <h4 class="card-title">
                                @if($showEditModal)
                                    <span>Ubah Belanja OPD</span>
                                @else
                                    <span>Tambah Belanja OPD</span>
                                @endif
                            </h4>
                        </x-card-header>
                        <x-card-body class="card-body">
                            <form wire:submit.prevent="{{ $showEditModal ? 'updateBelanjaOpd' : 'createBelanjaOpd' }}" class="needs-validation" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="opd_id" class="visually-hidden">OPD</label>
                                    <select wire:model.lazy="opd_id" id="opd_id"
                                            class="form-select form-control @error('opd_id') is-invalid @enderror">
                                        <option value="" selected>Pilih OPD</option>
                                        @foreach($listOpd as $key => $opd)
                                            <option value="{{ $key }}">{{ $opd }}</option>
                                        @endforeach
                                    </select>
                                    @error('opd_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_belanja" class="visually-hidden">Jenis Belanja</label>
                                    <div wire:ignore>
                                        <select wire:model.lazy="jenis_belanja" id="jenis_belanja"
                                                class="form-select form-control @error('jenis_belanja') is-invalid @enderror">
                                            <option value="" selected>Pilih Jenis Belanja</option>
                                            @foreach($listJenisBelanja as $key => $belanja)
                                                <option value="{{ $key }}">{{ $belanja }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_belanja')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @if(!is_null($jenis_belanja))
                                    <div class="mb-3">
                                        <label for="objek_pajak_id" class="visually-hidden">Objek Pajak</label>
                                        <div>
                                            <select wire:model.lazy="objek_pajak_id" id="objek_pajak_id"
                                                    class="form-select form-control @error('objek_pajak_id') is-invalid @enderror">
                                                <option value="" selected>Pilih Objek Pajak</option>
                                                @foreach($listObjekPajak as $op)
                                                    <option value="{{ $op->id }}">{{ $op->nama_objek_pajak }}</option>
                                                @endforeach
                                            </select>
                                            @error('objek_pajak_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <label for="jumlah_transaksi" class="visually-hidden">Jumlah Transaksi</label>
                                    <input wire:model.lazy="jumlah_transaksi" type="text" id="jumlah_transaksi"
                                           class="form-control @error('jumlah_transaksi') is-invalid @enderror"
                                           name="jumlah_transaksi" placeholder="Jumlah Transaksi"
                                           value="{{ old('jumlah_transaksi') }}" required>
                                    @error('jumlah_transaksi')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_pajak" class="visually-hidden">Jumlah Pajak</label>
                                    <input wire:model.lazy="jumlah_pajak" type="text" id="jumlah_pajak"
                                           class="form-control @error('jumlah_pajak') is-invalid @enderror"
                                           name="jumlah_pajak" placeholder="Jumlah Pajak"
                                           value="{{ old('jumlah_pajak') }}" required>
                                    @error('jumlah_pajak')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="bulan" class="visually-hidden">Bulan</label>
                                        <select wire:model.lazy="bulan" id="bulan"
                                                class="form-select form-control @error('bulan') is-invalid @enderror">
                                            <option value="" selected>Pilih Bulan</option>
                                            @foreach($listBulan as $key => $bulan)
                                                <option value="{{ $key }}">{{ $bulan }}</option>
                                            @endforeach
                                        </select>
                                        @error('bulan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tahun" class="visually-hidden">Tahun</label>
                                        <input wire:model.lazy="tahun" type="text" id="tahun"
                                               class="form-control @error('tahun') is-invalid @enderror"
                                               name="tahun" placeholder="Tahun"
                                               value="{{ old('tahun') }}" required>
                                        @error('tahun')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-end">
                                    @if($showEditModal)
                                        <button type="submit" class="btn btn-success btn-label waves-effect waves-light">
                                            <i class="bx bx-edit-alt label-icon"></i>
                                            Update
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-primary btn-label waves-effect waves-light gap-2">
                                            <i class="bx bx-plus label-icon"></i>
                                            Tambah
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </x-card-body>
                    </x-card>
                </div>
                <div class="col-xl-9 col-md-6">
                    <x-card>
                        <x-card-header>
                            <h4 class="card-title">List Belanja OPD </h4>
                        </x-card-header>
                        <x-card-body class="card-body">
                            <div class="row">
                                <div class="col-md-2 gx-3">
                                    <!-- Per Page Start -->
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-text">Show:</div>
                                        @include('widget.page')
                                    </div>
                                    <!-- Per Page End -->
                                </div>
                                <div class="col-md-10">
                                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
                                        <div>
                                            <!-- Bulk Action Start -->
                                            @if($checked)
                                                <x-dropdown>
                                                    <x-button class="btn-sm btn-outline-secondary me-50" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Terpilih <span class="badge rounded-pill bg-danger">{{ count($checked) }}</span>
                                                        <i class="bx bx-chevron-down"></i>
                                                    </x-button>
                                                    <x-dropdown-item>
                                                        <x-nav-link wire:click="$emit('triggerDelete','deleteBulk','bulk')" class="dropdown-item btn-sm">
                                                            <span class="align-middle">Hapus Terpilih</span>
                                                        </x-nav-link>
                                                    </x-dropdown-item>
                                                </x-dropdown>
                                        @endif
                                        <!-- Bulk Action End -->
                                        </div>
                                        <div class="col-sm-3">
                                            <select wire:model="selectedOpd" class="form-select form-select-sm form-control form-control-sm">
                                                <option value="" selected>Semua OPD</option>
                                                @foreach($listOpd as $key => $item)
                                                    <option wire:key="{{$key}}" value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-text">Cari :</div>
                                                <input type="search" wire:model.debounce.500ms="search" class="form-control" id="search" placeholder="Ketik pencarian...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <x-table class="align-middle table-hover table-check nowrap">
                                    <x-table.table-head>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="checkAll" wire:model="selectAll"/>
                                                <label class="form-check-label" for="checkAll"></label>
                                            </div>
                                        </th>
                                        <th scope="col">Objek Pajak</th>
                                        <th scope="col">OPD</th>
                                        <th scope="col">Jenis Belanja</th>
                                        <th scope="col">Jumlah Transaksi</th>
                                        <th scope="col">Jumlah Pajak</th>
                                        <th scope="col">Bulan / Tahun</th>
                                        <th style="width: 100px; min-width: 80px;">Action</th>
                                    </x-table.table-head>
                                    <x-table.table-body>
                                        @forelse($listBelanjaOpd as $belanja)

                                            <tr class="@if($this->isChecked($belanja->id)) bg-soft-secondary @endif">
                                                <th scope="row">
                                                    <div class="form-check font-size-16">
                                                        <input id="jenis-wp-{{ $belanja->id }}" value="{{ $belanja->id }}" type="checkbox" class="form-check-input"
                                                               wire:model="checked" wire.key="{{$belanja->id }}"/>
                                                        <label class="form-check-label" for="jenis-wp-{{ $belanja->id }}"></label>
                                                    </div>
                                                </th>
                                                <td>{{ $belanja->objekpajak()->get()->first()->nama_objek_pajak ?? 'Belum Ada' }}</td>
                                                <td>{{ $belanja->opd()->get()->first()->nama_opd }}</td>
                                                <td>{{ $belanja->jenis_belanja === 1 ? 'Rumah Makan' : 'Hotel' }}</td>
                                                <td>{{ money($belanja->jumlah_transaksi,'IDR',true) }}</td>
                                                <td>{{ money($belanja->jumlah_pajak,'IDR',true) }}</td>
                                                <td>{{ \App\Utilities\Helper::getNamaBulanIndo($belanja->bulan) }} / {{ $belanja->tahun }}</td>
                                                <td>
                                                    @can('manage-jenis-objek-pajak')
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @can('edit-jenis-objek-pajak')
                                                                <x-button class="btn-sm btn-soft-success waves-effect waves-light"
                                                                          data-bs-toggle="tooltip" data-bs-placement="top"
                                                                          title="Edit Belanja OPD" wire:key="{{ $belanja->id }}" wire:click.prevent="edit({{ $belanja
                                                                               }})"
                                                                >
                                                                    <i class="bx bx-edit font-size-14 align-middle"></i>
                                                                </x-button>
                                                            @endcan
                                                            @can('delete-jenis-objek-pajak')
                                                                <x-button wire:click="$emit('triggerDelete',{{ $belanja->id }},'single')"
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
                                            <x-no-table-data :colspan="8" />
                                        @endforelse
                                    </x-table.table-body>
                                </x-table>
                                <!-- end table -->
                                <x-pagination>
                                    {{ $listBelanjaOpd->links() }}
                                </x-pagination>
                            </div>
                        </x-card-body>
                    </x-card>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        @include('widget.alertify')
        @include('widget.action-js')
    @endpush
</div>
