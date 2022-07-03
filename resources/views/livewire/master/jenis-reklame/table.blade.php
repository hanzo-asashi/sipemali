<div>
    <div class="row">
        <div class="col-xl-3">
            <x-card>
                <x-card-header class="card-header">
                    <h4 class="card-title">
                        @if($showEditModal)
                            <span>Ubah Jenis Reklame</span>
                        @else
                            <span>Tambah Jenis Reklame</span>
                        @endif
                    </h4>
                </x-card-header>
                <x-card-body class="card-body">
                    <form wire:submit.prevent="{{ $showEditModal ? 'updateJenisReklame' : 'createJenisReklame' }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="nama_jenis_op" class="visually-hidden">Nama Jenis Reklame</label>
                            <input wire:model.lazy="nama_jenis_op" type="text" id="nama_jenis_op"
                                   class="form-control @error('nama_jenis_op') is-invalid @enderror"
                                   name="nama_jenis_op" placeholder="Nama Jenis Reklame"
                                   value="{{ old('nama_jenis_op') }}" required>
                            @error('nama_jenis_op')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="periode_pembayaran" class="visually-hidden">Periode Pembayaran</label>
                            <select id="periode_pembayaran" wire:model.lazy="periode_pembayaran" class="form-select @error('periode_pembayaran') is-invalid @enderror" placeholder="Tipe Satuan">
                                <option value="">Pilih Periode Pembayaran</option>
                                @foreach($periodePembayaran as $key => $periode)
                                    <option wire:key="{{ $key }}" value="{{ $key }}">{{ $periode }}</option>
                                @endforeach
                            </select>
                            @error('periode_pembayaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nilai_strategis" class="visually-hidden">Nilai Strategis</label>
                            <input wire:model.lazy="nilai_strategis" type="text" id="nilai_strategis"
                                   class="form-control @error('nilai_strategis') is-invalid @enderror"
                                   placeholder="Nilai Strategis"
                            >
                            @error('nilai_strategis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nilai_jual_objek_pajak" class="visually-hidden">Nilai Jual Objek Pajak (NJOPR)</label>
                            <input wire:model.lazy="nilai_jual_objek_pajak" type="text" id="nilai_jual_objek_pajak"
                                   class="form-control @error('nilai_jual_objek_pajak') is-invalid @enderror"
                                   placeholder="Nilai Jual Objek Pajak (NJOPR)"
                            >
                            @error('nilai_jual_objek_pajak')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tipe_satuan" class="visually-hidden">Tipe Satuan</label>
                            <select wire:model.lazy="tipe_satuan" class="form-select @error('tipe_satuan') is-invalid @enderror" placeholder="Tipe Satuan">
                                <option value="">Pilih Tipe Satuan</option>
                                @foreach($listSatuan as $key => $satuan)
                                <option wire:key="{{ $key }}" value="{{ $key }}">{{ $satuan }}</option>
                                @endforeach
                            </select>
                            @error('tipe_satuan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jenis_tarif" class="visually-hidden">Jenis Tarif</label>
                            <select wire:model.lazy="jenis_tarif" class="form-select @error('jenis_tarif') is-invalid @enderror" placeholder="Tipe Satuan">
                                <option value="">Pilih Jenis Tarif</option>
                                @foreach($listTarif as $key => $tarif)
                                    <option wire:key="{{ $key }}" value="{{ $key }}">{{ $tarif }}</option>
                                @endforeach
                            </select>
                            @error('jenis_tarif')
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
        <div class="col-xl-9">
            <x-card>
                <x-card-header>
                    <h4 class="card-title">List Jenis Reklame </h4>
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
                                <th scope="col">Nama Jenis Reklame</th>
                                <th scope="col">Periode Pembayaran</th>
                                <th scope="col">Nilai Strategis</th>
                                <th scope="col">Nilai Jual Objek Pajak</th>
                                <th scope="col">Tipe Satuan</th>
                                <th scope="col">Jenis Tarif</th>
                                <th style="width: 100px; min-width: 80px;">Action</th>
                            </x-table.table-head>
                            <x-table.table-body>
                                @forelse( $listJenisReklame as $jenis)
                                    <tr class="@if($this->isChecked($jenis->id)) bg-soft-secondary @endif @if($jenis->is_admin) table-active @endif">
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input id="jenis-wp-{{ $jenis->id }}" value="{{ $jenis->id }}" type="checkbox" class="form-check-input" wire:model="checked"
                                                       wire.key="{{ $jenis->id }}"/>
                                                <label class="form-check-label" for="jenis-wp-{{ $jenis->id }}"></label>
                                            </div>
                                        </th>
                                        <td>{{ $jenis->nama_jenis_op }}</td>
                                        <td>{{ \App\Utilities\Helper::periodePembayaran($jenis->periode_pembayaran) }}</td>
                                        <td>{{ $jenis->nilai_strategis }}</td>
                                        <td>{{ $jenis->nilai_jual_objek_pajak }}</td>
                                        <td>{{ $jenis->satuan()->get()->first()->satuan }}</td>
                                        <td>{{ $jenis->tarif()->get()->first()->jenis }}</td>
                                        <td>
                                            @can('manage jenis-reklame')
                                                <div class="d-flex flex-wrap gap-2">
                                                    @can('edit jenis-reklame')
                                                        <x-button class="btn-sm btn-soft-success waves-effect waves-light"
                                                                  data-bs-toggle="tooltip" data-bs-placement="top"
                                                                  title="Edit Jenis Wajib Pajak" wire:key="{{ $jenis->id }}" wire:click.prevent="edit({{ $jenis }})"
                                                        >
                                                            <i class="bx bx-edit font-size-14 align-middle"></i>
                                                        </x-button>
                                                    @endcan
                                                    @can('delete jenis-reklame')
                                                        <x-button wire:click="$emit('triggerDelete',{{ $jenis->id }},'single')"
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
                            {{ $listJenisReklame->links() }}
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
