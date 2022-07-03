<div>
    <div class="row">
        <div class="col-xl-4">
            <x-card>
                <x-card-header class="card-header">
                    <h4 class="card-title">
                        @if($showEditModal)
                            <span>Ubah Tipe Usaha Reklame</span>
                        @else
                            <span>Tambah Tipe Usaha Reklame</span>
                        @endif
                    </h4>
                </x-card-header>
                <x-card-body class="card-body">
                    <form wire:submit.prevent="{{ $showEditModal ? 'updateTipeUsahaReklame' : 'createTipeUsahaReklame' }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="nama_tipe_usaha" class="visually-hidden">Nama Tipe Usaha Reklame</label>
                            <input wire:model.lazy="nama_tipe_usaha" type="text" id="nama_tipe_usaha"
                                   class="form-control @error('nama_tipe_usaha') is-invalid @enderror"
                                   name="nama_tipe_usaha" placeholder="Nama Tipe Usaha Reklame"
                                   value="{{ old('nama_tipe_usaha') }}" required>
                            @error('nama_tipe_usaha')
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
                    <h4 class="card-title">List Tipe Usaha Reklame </h4>
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
                                <th scope="col">Nama Tipe Usaha Reklame</th>
                                <th style="width: 100px; min-width: 80px;">Action</th>
                            </x-table.table-head>
                            <x-table.table-body>
                                @forelse($listTipeUsaha as $tipe)
                                    <tr class="@if($this->isChecked($tipe->id)) bg-soft-secondary @endif @if($tipe->is_admin) table-active @endif">
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input id="jenis-wp-{{ $tipe->id }}" value="{{ $tipe->id }}" type="checkbox" class="form-check-input" wire:model="checked" wire
                                                       .key="{{ $tipe->id }}"/>
                                                <label class="form-check-label" for="jenis-wp-{{ $tipe->id }}"></label>
                                            </div>
                                        </th>
                                        <td>{{ $tipe->nama_tipe_usaha }}</td>
                                        <td>
                                            @can('manage-jenis-objek-pajak')
                                                <div class="d-flex flex-wrap gap-2">
                                                    @can('edit-jenis-objek-pajak')
                                                        <x-button class="btn-sm btn-soft-success waves-effect waves-light"
                                                                  data-bs-toggle="tooltip" data-bs-placement="top"
                                                                  title="Edit Jenis Wajib Pajak" wire:key="{{ $tipe->id }}" wire:click.prevent="edit({{ $tipe }})"
                                                        >
                                                            <i class="bx bx-edit font-size-14 align-middle"></i>
                                                        </x-button>
                                                    @endcan
                                                    @can('delete-jenis-objek-pajak')
                                                        <x-button wire:click="$emit('triggerDelete',{{ $tipe->id }},'single')"
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
                                    <x-no-table-data :colspan="3" />
                                @endforelse
                            </x-table.table-body>
                        </x-table>
                        <!-- end table -->
                        <x-pagination>
                            {{ $listTipeUsaha->links() }}
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
