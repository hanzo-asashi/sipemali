<div>
    <div class="row">
        <div class="col-xl-4">
            <x-card>
                <x-card-header class="card-header">
                    <h4 class="card-title">
                        @if($showEditModal)
                            <span>Ubah Jenis Bahan Baku Mineral</span>
                        @else
                            <span>Tambah Jenis Bahan Baku Mineral</span>
                        @endif
                    </h4>
                </x-card-header>
                <x-card-body class="card-body">
                    <form wire:submit.prevent="{{ $showEditModal ? 'updateJenisBahanBakuMineral' : 'createJenisBahanBakuMineral' }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="visually-hidden">Nama Jenis Bahan Baku Mineral</label>
                            <input wire:model.lazy="nama" type="text" id="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   name="nama" placeholder="Nama Jenis Bahan Baku Mineral"
                                   value="{{ old('nama') }}" required>
                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="satuan" class="visually-hidden">Satuan</label>
                            <input wire:model.lazy="satuan" type="text" id="satuan"
                                   class="form-control @error('satuan') is-invalid @enderror"
                                   name="satuan" placeholder="Satuan"
                                   value="{{ old('satuan') }}">
                            @error('satuan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nilai" class="visually-hidden">Nilai Bahan Baku</label>
                            <input wire:model.lazy="nilai" type="text" id="nilai"
                                   class="form-control @error('nilai') is-invalid @enderror"
                                   name="nilai" placeholder="Nilai Bahan Baku"
                                   value="{{ old('nilai') }}" required>
                            @error('nilai')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="text-end">
                            @if($showEditModal)
{{--                                <a href="#" wire:click.prevent="add" class="btn btn-primary btn-label waves-effect waves-light">--}}
{{--                                    <i class="bx bx-plus label-icon"></i>--}}
{{--                                    Tambah</a>--}}
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
        <div class="col-xl-8">
            <x-card>
                <x-card-header>
                    <h4 class="card-title">List Jenis Bahan Baku Mineral</h4>
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
                                <th scope="col">Jenis</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Nilai</th>
                                <th style="width: 100px; min-width: 80px;">Action</th>
                            </x-table.table-head>
                            <x-table.table-body>
                                @forelse( $listBahanBaku as $bahan)
                                    <tr class="@if($this->isChecked($bahan->id)) bg-soft-secondary @endif @if($bahan->is_admin) table-active @endif">
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input id="jenis-wp-{{ $bahan->id }}" value="{{ $bahan->id }}" type="checkbox" class="form-check-input" wire:model="checked"
                                                       wire.key="{{ $bahan->id }}"/>
                                                <label class="form-check-label" for="jenis-wp-{{ $bahan->id }}"></label>
                                            </div>
                                        </th>
                                        <td>{{ $bahan->nama }}</td>
                                        <td>{{ $bahan->satuan }}</td>
                                        <td>{{ money( $bahan->nilai, 'IDR',false)  }}</td>
                                        <td>
                                            @can('manage-jenis-bahanbaku-mineral')
                                                <div class="d-flex flex-wrap gap-2">
                                                    @can('edit-jenis-bahanbaku-mineral')
                                                        <x-button class="btn-sm btn-soft-success waves-effect waves-light"
                                                                  data-bs-toggle="tooltip" data-bs-placement="top"
                                                                  title="Edit Jenis Wajib Pajak" wire:key="{{ $bahan->id }}" wire:click.prevent="edit({{ $bahan }})"
                                                        >
                                                            <i class="bx bx-edit font-size-14 align-middle"></i>
                                                        </x-button>
                                                    @endcan
                                                    @can('delete-jenis-bahanbaku-mineral')
                                                        <x-button wire:click="$emit('triggerDelete',{{ $bahan->id }},'single')"
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
                                    <x-no-table-data :colspan="5" />
                                @endforelse
                            </x-table.table-body>
                        </x-table>
                        <!-- end table -->
                        <x-pagination>
                            {{ $listBahanBaku->links() }}
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
