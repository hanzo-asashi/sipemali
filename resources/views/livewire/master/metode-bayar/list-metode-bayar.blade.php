<div>
    @section('title', $title ?? 'List Metode Bayar')
    @push('vendor-style')
    @endpush

    @push('page-style')
    @endpush
    <div class="row">
        <div class="col-md-4">
            <x-card>
                <x-card-header>
                    <h4 class="card-title">{{ $updateMode ? 'Ubah Metode Bayar' : 'Buat Metode Bayar' }}</h4>
                </x-card-header>
                <form wire:submit.prevent="{{ $updateMode ? 'updateMetode' : 'storeMetode' }}" class="needs-validation" novalidate>
                    <x-card-body>
                        <x-label for="kode" :value="'Kode'"/>
                        <div class="mb-1">
                            <input wire:dirty.class.remove="is-invalid" class="form-control @error('kode') is-invalid @enderror"
                                   wire:model.defer="state.kode" type="text" label="Kode" placeholder="PDA, TRF"
                            />
                            <x-input-error :for="'kode'"/>
                        </div>
                        <x-label for="nama" :value="'Nama'"/>
                        <div class="mb-1">
                            <input wire:dirty.class.remove="is-invalid" class="form-control @error('nama') is-invalid @enderror"
                                   wire:model.defer="state.nama" type="text" label="Nama" placeholder="Transfer Bank"
                            />
                            <x-input-error :for="'nama'"/>
                        </div>
                        <x-label for="deskripsi" :value="'Deskripsi'"/>
                        <div class="mb-1">
                            <input wire:dirty.class.remove="is-invalid" class="form-control @error('deskripsi') is-invalid @enderror"
                                   wire:model.defer="state.deskripsi" type="text"
                                   placeholder="Deskripsi"
                            />
                            <x-input-error :for="'deskripsi'"/>
                        </div>
                    </x-card-body>
                    <div class="card-footer">
                        <x-button type="submit" class="btn-primary" wire:loading.attr="disabled">
                            <x-loading-button wire:target="{{ $updateMode ? 'updateMetode' : 'storeMetode' }}"/>
                            {{ $updateMode ? 'Ubah' : 'Simpan' }}
                        </x-button>
                        <x-button wire:click.prevent="resetField" wire:loading.attr="disabled" class="btn-danger">
                            <x-loading-button wire:target="resetField"/>
                            Batal
                        </x-button>
                    </div>
                </form>
            </x-card>
        </div>
        <div class="col-md-8">
            <x-card>
                <x-card-header>
                    <h4 class="card-title">{{ $title ?? 'List Metode Bayar' }}</h4>
                </x-card-header>
                <div class="table-responsive">
                    <x-table class="table-bordered table-responsive table-hover">
                        <x-table.table-head>
                            <tr>
                                <th class="text-center" style="width: 5%;">No</th>
                                <th class="text-center" style="width: 5%;">Kode</th>
                                <th>Metode Bayar</th>
                                <th>Deskripsi</th>
                                <th class="text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </x-table.table-head>
                        <x-table.table-body>
                            @php $i = 1; @endphp
                            @forelse($listMetode as $method)
                                <tr class="@if($this->isChecked($method->id)) bg-soft-light @endif text-center">
                                    <td class="text-start">{{ $i++ }}</td>
                                    <td class="text-start"><span class="badge bg-success">{{ $method->kode }}</span></td>
                                    <td class="text-start">{{ $method->nama }}</td>
                                    <td class="text-start">{{ $method->deskripsi }}</td>
                                    <td>
                                        @can('update_metodebayar')
                                            <button wire:click.prevent="editMetode({{ $method->id }})" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title data-bs-original-title="Edit Metode Bayar"
                                                    type="button" class="btn btn-icon btn-sm btn-info waves-effect waves-float waves-light">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        @endcan
                                        @can('delete_metodebayar')
                                            <button wire:click="destroy({{ $method->id }},'single')" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title
                                                    data-bs-original-title="Hapus Metode Bayar"
                                                    type="button" class="btn btn-icon btn-sm btn-danger waves-effect waves-float waves-light">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        @endcan

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-danger text-center">Maaf, data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </x-table.table-body>
                    </x-table>
                </div>

                <!-- Pagination Start -->
                <x-pagination :datalinks="$listMetode" :page="$pageData['page']" :total-data="$pageData['totalData']" :page-count="$pageData['pageCount']"/>
                <!-- Pagination end -->
            </x-card>
        </div>
    </div>
    <!-- Hoverable rows end -->
    @push('script')
        <script></script>
    @endpush
</div>
