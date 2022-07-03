<div>
    @section('title') Target Pajak @endsection

    @push('css')
    @endpush
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Target Pajak</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
            <div class="row">
                <div class="col-xl-4">
                    <x-card>
                        <x-card-header class="card-header">
                            <h4 class="card-title">
                                @if($showEditModal)
                                    <span>Ubah Target Pajak</span>
                                @else
                                    <span>Tambah Target Pajak</span>
                                @endif
                            </h4>
                        </x-card-header>
                        <x-card-body class="card-body">
                            <form wire:submit.prevent="{{ $showEditModal ? 'updateTargetPajak' : 'createTargetPajak' }}" class="needs-validation" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="id_jenis_objek_pajak" class="visually-hidden">Jenis Objek Pajak</label>
                                    <select wire:model.lazy="id_jenis_objek_pajak" placeholder="Pilih Jenis Objek Pajak"
                                            class="form-select form-control @error('id_jenis_objek_pajak') is-invalid @enderror" id="id_jenis_objek_pajak">
                                        <option value="" selected>Pilih Jenis Objek Pajak</option>
                                        @foreach($listJenisObjekPajak as $key => $jenis)
                                            <option value="{{ $key }}">{{ $jenis }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_jenis_objek_pajak')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="target" class="visually-hidden">Target Pajak</label>
                                    <input wire:model.lazy="target" type="text" id="target"
                                           class="form-control @error('target') is-invalid @enderror"
                                           name="target" placeholder="Target Pajak"
                                           value="{{ old('target') }}" required>
                                    @error('target')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tahun_pajak" class="visually-hidden">Tahun Pajak</label>
                                    <input wire:model.lazy="tahun_pajak" type="text" id="tahun_pajak"
                                           class="form-control @error('tahun_pajak') is-invalid @enderror"
                                           name="tahun_pajak" placeholder="Tahun Pajak"
                                           value="{{ old('tahun_pajak') }}" required>
                                    @error('tahun_pajak')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                <div class="col-xl-8">
                    <x-card>
                        <x-card-header>
                            <h4 class="card-title">List Target Pajak </h4>
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
                                        <th scope="col">Jenis Objek Pajak</th>
                                        <th scope="col">Target Pajak</th>
                                        <th scope="col">Tahun Pajak</th>
                                        <th style="width: 100px; min-width: 80px;">Action</th>
                                    </x-table.table-head>
                                    <x-table.table-body>
                                        @forelse($listTargetPajak as $target)
                                            <tr class="@if($this->isChecked($target->id)) bg-soft-light @endif">
                                                <th scope="row">
                                                    <div class="form-check font-size-16">
                                                        <input id="target-{{ $target->id }}" value="{{ $target->id }}" type="checkbox" class="form-check-input"
                                                               wire:model="checked" wire.key="{{$target->id }}"/>
                                                        <label class="form-check-label" for="target-{{ $target->id }}"></label>
                                                    </div>
                                                </th>
                                                <td>{{ $target->jenisObjekPajak->nama_jenis_op }}</td>
                                                <td>{{ money($target->target,'IDR',true) }}</td>
                                                <td>{{ $target->tahun_pajak }}</td>
                                                <td>
                                                    @can('manage target-pajak')
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @can('edit-jenis-objek-pajak')
                                                                <x-button class="btn-sm btn-soft-success waves-effect waves-light"
                                                                          data-bs-toggle="tooltip" data-bs-placement="top"
                                                                          title="Edit Target Pajak" wire:key="{{ $target->id }}"
                                                                          wire:click.prevent="edit({{ $target}})"
                                                                >
                                                                    <i class="bx bx-edit font-size-14 align-middle"></i>
                                                                </x-button>
                                                            @endcan
                                                            @can('delete-jenis-objek-pajak')
                                                                <x-button wire:click="$emit('triggerDelete',{{ $target->id }},'single')"
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
                                    {{ $listTargetPajak->links() }}
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
