<div>
    @section('title') Anggaran OPD @endsection

    @push('css')
    @endpush
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Anggaran OPD</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
            <div class="row">
                <div class="col-xl-3">
                    <x-card>
                        <x-card-header class="card-header">
                            <h4 class="card-title">
                                @if($showEditModal)
                                    <span>Ubah Anggaran OPD</span>
                                @else
                                    <span>Tambah Anggaran OPD</span>
                                @endif
                            </h4>
                        </x-card-header>
                        <x-card-body class="card-body">
                            <form wire:submit.prevent="{{ $showEditModal ? 'updateAnggaranOpd' : 'createAnggaranOpd' }}" class="needs-validation" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="opd_id" class="visually-hidden">OPD</label>
                                    <select wire:model.lazy="opd_id" placeholder="Pilih OPD"
                                            class="form-select form-control @error('opd_id') is-invalid @enderror" id="opd_id">
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
{{--                                <div class="mb-3">--}}
{{--                                    <label for="jenis_anggaran" class="visually-hidden">Jenis Anggaran</label>--}}
{{--                                    <select wire:model.lazy="jenis_anggaran" placeholder="Pilih Jenis Anggaran"--}}
{{--                                            class="form-select form-control @error('jenis_anggaran') is-invalid @enderror" id="jenis_anggaran">--}}
{{--                                        <option value="" selected>Pilih Jenis Anggaran</option>--}}
{{--                                        @foreach($listJenisAnggaran as $key => $jenis)--}}
{{--                                            <option value="{{ $key }}">{{ $jenis }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @error('jenis_anggaran')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
                                <div class="mb-3">
                                    <label for="nilai_pagu_rm" class="visually-hidden">Nilai Pagu RM</label>
                                    <input wire:model.lazy="nilai_pagu_rm" type="text" id="nilai_pagu_rm"
                                           class="form-control @error('nilai_pagu_rm') is-invalid @enderror"
                                           name="nilai_pagu_rm" placeholder="Nilai Pagu RM"
                                           value="{{ old('nilai_pagu_rm') }}" required>
                                    @error('nilai_pagu_rm')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nilai_pagu_htl" class="visually-hidden">Nilai Pagu Hotel</label>
                                    <input wire:model.lazy="nilai_pagu_htl" type="text" id="nilai_pagu_htl"
                                           class="form-control @error('nilai_pagu_htl') is-invalid @enderror"
                                           name="nilai_pagu_htl" placeholder="Nilai Pagu Hotel"
                                           value="{{ old('nilai_pagu_htl') }}" required>
                                    @error('nilai_pagu_htl')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
{{--                                <div class="mb-3">--}}
{{--                                    <label for="target_pajak_rm" class="visually-hidden">Target Pajak RM</label>--}}
{{--                                    <input wire:model.lazy="target_pajak_rm" type="text" id="target_pajak_rm"--}}
{{--                                           class="form-control @error('target_pajak_rm') is-invalid @enderror"--}}
{{--                                           name="target_pajak_rm" placeholder="Target Pajak RM"--}}
{{--                                           value="{{ old('target_pajak_rm') }}" required>--}}
{{--                                    @error('target_pajak_rm')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="target_pajak_htl" class="visually-hidden">Target Pajak</label>--}}
{{--                                    <input wire:model.lazy="target_pajak_htl" type="text" id="target_pajak_htl"--}}
{{--                                           class="form-control @error('target_pajak_htl') is-invalid @enderror"--}}
{{--                                           name="target_pajak_htl" placeholder="Target Pajak Hotel"--}}
{{--                                           value="{{ old('target_pajak_htl') }}" required>--}}
{{--                                    @error('target_pajak_htl')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
                                <div class="mb-3">
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
                <div class="col-xl-9">
                    <x-card>
                        <x-card-header>
                            <h4 class="card-title">List Anggaran OPD </h4>
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
                                        <div class="col-sm-3">
                                            <select wire:model="selectedOpd" class="form-select form-select-sm form-control form-control-sm">
                                                <option value="" selected>Semua OPD</option>
                                                @foreach($listOpd as $key => $item)
                                                <option wire:key="{{$key}}" value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <select wire:model="selectedTahun" class="form-select form-select-sm form-control form-control-sm">
                                                <option value="" selected>Semua Tahun</option>
                                                @foreach($listTahun as $key => $item)
                                                <option wire:key="{{$key}}" value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                <x-table class="align-middle table-responsive table-hover table-check nowrap">
                                    <x-table.table-head>
                                        <th rowspan="2"></th>
                                        <th rowspan="2"></th>
                                        <th colspan="3" scope="colgroup" class="text-center">Rumah Makan</th>
                                        <th colspan="3" scope="colgroup" class="text-center">Hotel</th>
                                        <th colspan="2" scope="colgroup" class="text-center">Total</th>
                                        <th rowspan="2"></th>
                                        <th rowspan="2"></th>
{{--                                        <th rowspan="2"></th>--}}
                                    </x-table.table-head>
                                    <x-table.table-head>
                                        <th scope="col" rowspan="2" style="width: 30px;">
                                            <div class="form-check ">
                                                <input type="checkbox" class="form-check-input" id="checkAll" wire:model="selectAll"/>
                                                <label class="form-check-label" for="checkAll"></label>
                                            </div>
                                        </th>
                                        <th scope="col" class="text-center">OPD</th>
{{--                                        <th scope="col">Jenis Anggaran</th>--}}
                                        <th scope="col" class="text-center">Pagu</th>
                                        <th scope="col" class="text-center">Target</th>
                                        <th scope="col" class="text-center">Realisasi</th>
                                        <th scope="col" class="text-center">Pagu</th>
                                        <th scope="col" class="text-center">Target</th>
                                        <th scope="col" class="text-center">Realisasi</th>
                                        <th scope="col" class="text-center">Total Target</th>
                                        <th scope="col" class="text-center">Total Realisasi</th>
                                        <th scope="col" class="text-center">Tahun</th>
                                        <th style="width: 100px; min-width: 80px;" class="text-center">Action</th>
                                    </x-table.table-head>
                                    <x-table.table-body>
                                        @forelse($listAnggaranOpd as $anggaran)
                                            <tr class="@if($this->isChecked($anggaran->id)) bg-soft-secondary @endif @if($anggaran->is_admin) table-active @endif">
                                                <th style="width: 30px;" scope="row">
                                                    <div class="form-check">
                                                        <input id="jenis-wp-{{ $anggaran->id }}" value="{{ $anggaran->id }}" type="checkbox" class="form-check-input"
                                                               wire:model="checked" wire.key="{{$anggaran->id }}"/>
                                                        <label class="form-check-label" for="jenis-wp-{{ $anggaran->id }}"></label>
                                                    </div>
                                                </th>
                                                <td>{{ $anggaran->opd()->get()->first()->nama_opd }}</td>
                                                <td>{{ money($anggaran->nilai_pagu_rm,'IDR',true) }}</td>
                                                <td>{{ money($anggaran->target_pajak_rm,'IDR',true) }}</td>
                                                <td>{{ money($anggaran->realisasi_rm,'IDR',true) }}</td>
                                                <td>{{ money($anggaran->nilai_pagu_htl,'IDR',true) }}</td>
                                                <td>{{ money($anggaran->target_pajak_htl,'IDR',true) }}</td>
                                                <td>{{ money($anggaran->realisasi_htl,'IDR',true) }}</td>
                                                <td>{{ money($anggaran->target_pajak_htl + $anggaran->target_pajak_rm,'IDR',true) }}</td>
                                                <td>{{ money($anggaran->realisasi_htl + $anggaran->realisasi_rm,'IDR',true) }}</td>
                                                <td>{{ $anggaran->tahun }}</td>
                                                <td>
                                                    @can('manage-jenis-objek-pajak')
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @can('edit-jenis-objek-pajak')
                                                                <x-button class="btn-sm btn-soft-success waves-effect waves-light"
                                                                          data-bs-toggle="tooltip" data-bs-placement="top"
                                                                          title="Edit Anggaran OPD" wire:key="{{ $anggaran->id }}"
                                                                          wire:click.prevent="edit({{ $anggaran}})"
                                                                >
                                                                    <i class="bx bx-edit font-size-14 align-middle"></i>
                                                                </x-button>
                                                            @endcan
                                                            @can('delete-jenis-objek-pajak')
                                                                <x-button wire:click="$emit('triggerDelete',{{ $anggaran->id }},'single')"
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
                                            <x-no-table-data :colspan="13" />
                                        @endforelse
                                    </x-table.table-body>
                                </x-table>
                                <!-- end table -->
                                <x-pagination>
                                    {{ $listAnggaranOpd->links() }}
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
