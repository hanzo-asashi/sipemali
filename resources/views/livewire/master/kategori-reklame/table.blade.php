<div>
    <div class="row">
        <div class="col-xl-4">
            <x-card>
                <x-card-header class="card-header">
                    <h4 class="card-title">
                        @if($showEditModal)
                            <span>Ubah Kategori Reklame</span>
                        @else
                            <span>Tambah Kategori Reklame</span>
                        @endif
                    </h4>
                </x-card-header>
                <x-card-body class="card-body">
                    <form wire:submit.prevent="{{ $showEditModal ? 'updateKategoriOpReklame' : 'createKategoriOpReklame' }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="nama_kategori" class="visually-hidden">Nama Kategori Reklame</label>
                            <input wire:model.lazy="nama_kategori" type="text" id="nama_kategori"
                                   class="form-control @error('nama_kategori') is-invalid @enderror"
                                   name="nama_kategori" placeholder="Nama Kategori Reklame"
                                   value="{{ old('nama_kategori') }}" required>
                            @error('nama_kategori')
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
                    <h4 class="card-title">List Kategori Reklame </h4>
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
                                <th scope="col">Nama Kategori Reklame</th>
                                <th style="width: 100px; min-width: 80px;">Action</th>
                            </x-table.table-head>
                            <x-table.table-body>
                                @forelse($listKategoriReklame as $kategori)
                                    <tr class="@if($this->isChecked($kategori->id)) bg-soft-secondary @endif @if($kategori->is_admin) table-active @endif">
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input id="jenis-wp-{{ $kategori->id }}" value="{{ $kategori->id }}" type="checkbox" class="form-check-input" wire:model="checked" wire.key="{{ $kategori->id }}"/>
                                                <label class="form-check-label" for="jenis-wp-{{ $kategori->id }}"></label>
                                            </div>
                                        </th>
                                        <td>{{ $kategori->nama_kategori }}</td>
                                        <td>
                                            @can('manage-kategori-reklame')
                                                <div class="d-flex flex-wrap gap-2">
                                                    @can('edit-kategori-reklame')
                                                        <x-button class="btn-sm btn-soft-success waves-effect waves-light"
                                                                  data-bs-toggle="tooltip" data-bs-placement="top"
                                                                  title="Edit Jenis Wajib Pajak" wire:key="{{ $kategori->id }}" wire:click.prevent="edit({{ $kategori }})"
                                                        >
                                                            <i class="bx bx-edit font-size-14 align-middle"></i>
                                                        </x-button>
                                                    @endcan
                                                    @can('delete-kategori-reklame')
                                                        <x-button wire:click="$emit('triggerDelete',{{ $kategori->id }},'single')"
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
                            {{ $listKategoriReklame->links() }}
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
