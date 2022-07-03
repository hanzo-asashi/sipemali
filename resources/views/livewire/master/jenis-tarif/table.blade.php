<div>
    <div class="row">
        <div class="col-xl-4">
            <x-card>
                <x-card-header class="card-header">
                    <h4 class="card-title">
                        @if($showEditModal)
                            <span>Ubah Jenis Tarif</span>
                        @else
                            <span>Tambah Jenis Tarif</span>
                        @endif
                    </h4>
                </x-card-header>
                <x-card-body class="card-body">
                    <form wire:submit.prevent="{{ $showEditModal ? 'updateJenisTarif' : 'createJenisTarif' }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="jenis" class="visually-hidden">Nama Jenis Tarif</label>
                            <input wire:model.lazy="jenis" type="text" id="jenis"
                                   class="form-control @error('jenis') is-invalid @enderror"
                                   name="jenis" placeholder="Nama Jenis Tarif"
                                   value="{{ old('jenis') }}" required>
                            @error('jenis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nilai" class="visually-hidden">Nilai Tarif</label>
                            <input wire:model.lazy="nilai" type="text" id="nilai"
                                   class="form-control @error('nilai') is-invalid @enderror"
                                   name="nilai" placeholder="Nilai Tarif"
                                   value="{{ old('nilai') }}" required>
                            @error('nilai')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="visually-hidden">Keterangan</label>
                            <input wire:model.lazy="keterangan" type="text" id="keterangan"
                                   class="form-control @error('keterangan') is-invalid @enderror"
                                   name="keterangan" placeholder="Keterangan"
                                   value="{{ old('keterangan') }}">
                            @error('keterangan')
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
                    <h4 class="card-title">List Jenis Usaha Reklame </h4>
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
                                <th scope="col">Nilai</th>
                                <th scope="col">Keterangan</th>
                                <th style="width: 100px; min-width: 80px;">Action</th>
                            </x-table.table-head>
                            <x-table.table-body>
                                @forelse( $jenisTrf as $jt)
                                    <tr class="@if($this->isChecked($jt->id)) bg-soft-secondary @endif @if($jt->is_admin) table-active @endif">
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input id="jenis-wp-{{ $jt->id }}" value="{{ $jt->id }}" type="checkbox" class="form-check-input" wire:model="checked"
                                                       wire.key="{{ $jt->id }}"/>
                                                <label class="form-check-label" for="jenis-wp-{{ $jt->id }}"></label>
                                            </div>
                                        </th>
                                        <td>{{ $jt->jenis }}</td>
                                        <td>{{ $jt->nilai }}</td>
                                        <td>{{ $jt->keterangan }}</td>
                                        <td>
                                            @can('manage-jenis-tarif')
                                                <div class="d-flex flex-wrap gap-2">
                                                    @can('edit-jenis-tarif')
                                                        <x-button class="btn-sm btn-soft-success waves-effect waves-light"
                                                                  data-bs-toggle="tooltip" data-bs-placement="top"
                                                                  title="Edit Jenis Wajib Pajak" wire:key="{{ $jt->id }}" wire:click.prevent="edit({{ $jt }})"
                                                        >
                                                            <i class="bx bx-edit font-size-14 align-middle"></i>
                                                        </x-button>
                                                    @endcan
                                                    @can('delete-jenis-tarif')
                                                        <x-button wire:click="$emit('triggerDelete',{{ $jt->id }},'single')"
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
                            {{ $jenisTrf->links() }}
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
