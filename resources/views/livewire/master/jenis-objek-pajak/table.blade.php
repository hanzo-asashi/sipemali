<div>
    <div class="row">
        <div class="col-xl-4">
            <x-card>
                <x-card-header class="card-header">
                    <h4 class="card-title">
                        @if($showEditModal)
                            <span>Ubah Jenis Objek Pajak</span>
                        @else
                            <span>Tambah Jenis Objek Pajak</span>
                        @endif
                    </h4>
                </x-card-header>
                <x-card-body class="card-body">
                    <form wire:submit.prevent="{{ $showEditModal ? 'updateJenisObjekPajak' : 'createJenisObjekPajak' }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="nama_jenis_op" class="visually-hidden">Nama Jenis Objek Pajak</label>
                            <input wire:model.lazy="nama_jenis_op" type="text" id="nama_jenis_op"
                                   class="form-control @error('nama_jenis_op') is-invalid @enderror"
                                   name="nama_jenis_op" placeholder="Nama Jenis Objek Pajak"
                                   value="{{ old('nama_jenis_op') }}"
                                   @if($jenisOp->count() === $maxObjekPajak && !$showEditModal) disabled @endif
                                   required>
                            @error('nama_jenis_op')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_rekening" class="visually-hidden">No Rekening</label>
                            <input wire:model.lazy="no_rekening" type="text" id="no_rekening"
                                   class="form-control @error('no_rekening') is-invalid @enderror"
                                   name="no_rekening" placeholder="No Rekening"
                                   value="{{ old('no_rekening') }}"
                                   @if($jenisOp->count() === $maxObjekPajak && !$showEditModal) disabled @endif required>
                            @error('no_rekening')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="shortcode" class="visually-hidden">Kode Objek Pajak</label>
                            <input wire:model.lazy="shortcode" type="text" id="shortcode"
                                   class="form-control @error('shortcode') is-invalid @enderror"
                                   name="shortcode" placeholder="Kode Objek Pajak"
                                   value="{{ old('shortcode') }}" @if($jenisOp->count() === $maxObjekPajak && !$showEditModal) disabled @endif required>
                            @error('shortcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="text-end">
                            @if($showEditModal)
{{--                                <a @if($jenisOp->count() === $maxObjekPajak) disabled @endif wire:click.prevent="add" class="btn btn-primary btn-label waves-effect--}}
{{--                                 waves-light">--}}
{{--                                    <i class="bx bx-x label-icon"></i>--}}
{{--                                    Batal--}}
{{--                                </a>--}}
                                <button type="submit" class="btn btn-success btn-label waves-effect waves-light">
                                    <i class="bx bx-edit-alt label-icon"></i>
                                    Update
                                </button>
                            @else
                                @if($jenisOp->count() < $maxObjekPajak)
                                    <button type="submit" class="btn btn-primary btn-label waves-effect waves-light gap-2">
                                        <i class="bx bx-plus label-icon"></i>
                                        Tambah
                                    </button>
                                @endif
                            @endif
                        </div>
                    </form>
                </x-card-body>
            </x-card>
            <div class="row">
                <div wire:ignore class="col-md-12">
                    <div class="alert alert-important alert-info alert-dismissible alert-label-icon label-arrow fade show mb-0" role="alert">
                        <i class="mdi mdi-alert-circle-outline label-icon"></i>
                        <strong>Informasi</strong> - Untuk saat ini Jenis Objek Pajak dibatasi <strong>HANYA 5</strong> Jenis saja.
{{--                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <x-card>
                <x-card-header>
                    <h4 class="card-title">List Jenis Objek Pajak </h4>
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
                                @include('widget.bulk-action')
                                @include('widget.search-table')
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <x-table class="align-middle table-hover table-check nowrap">
                            <x-table.table-head>
                                <th scope="col" style="width: 50px;">
                                    <div class="form-check font-size-16">
                                        <input type="checkbox" class="form-check-input" id="checkAll" wire:model="selectAll"/>
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th scope="col">Nama Jenis Objek Pajak</th>
                                <th scope="col">Kode Objek Pajak</th>
                                <th scope="col">No Rekening</th>
                                <th style="width: 100px; min-width: 80px;">Action</th>
                            </x-table.table-head>
                            <x-table.table-body>
                                @forelse( $jenisOp as $jwp)
                                    <tr class="@if($this->isChecked($jwp->id)) bg-soft-secondary @endif @if($jwp->is_admin) table-active @endif">
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input id="jenis-wp-{{ $jwp->id }}" value="{{ $jwp->id }}" type="checkbox" class="form-check-input" wire:model="checked"
                                                       wire.key="{{ $jwp->id }}"/>
                                                <label class="form-check-label" for="jenis-wp-{{ $jwp->id }}"></label>
                                            </div>
                                        </th>
                                        <td>{{ $jwp->nama_jenis_op }}</td>
                                        <td>{{ $jwp->shortcode }}</td>
                                        <td>{{ $jwp->no_rekening }}</td>
                                        <td>
                                            @can('manage-jenis-objek-pajak')
                                                <div class="d-flex flex-wrap gap-2">
                                                    @can('edit-jenis-objek-pajak')
                                                    <x-button class="btn-sm btn-soft-success waves-effect waves-light"
                                                              data-bs-toggle="tooltip" data-bs-placement="top"
                                                              title="Edit Jenis Wajib Pajak" wire:key="{{ $jwp->id }}" wire:click.prevent="edit({{ $jwp }})"
                                                    >
                                                        <i class="bx bx-edit font-size-14 align-middle"></i>
                                                    </x-button>
                                                    @endcan
                                                    @can('delete-jenis-objek-pajak')
                                                    <x-button wire:click="$emit('triggerDelete',{{ $jwp->id }},'single')"
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
                                    <x-no-table-data :colspan="4" />
                                @endforelse
                            </x-table.table-body>
                        </x-table>
                        <!-- end table -->
                        <x-pagination>
                            {{ $jenisOp->links() }}
                        </x-pagination>
                    </div>
                </x-card-body>
            </x-card>
        </div>
    </div>
</div>

@push('script')
    @include('widget.alertify')
    @include('widget.action-js')
@endpush
