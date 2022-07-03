<div>
    @section('title', $title ?? '')
    @push('vendor-style')
    @endpush

    @push('page-style')
    @endpush
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $updateMode ? 'Ubah Zona' : 'Buat Zona' }}</h4>
                </div>
                <form wire:submit.prevent="{{ $updateMode ? 'updateZona' : 'storeZona' }}" class="needs-validation" novalidate>
                    <div class="card-body">
                        <x-jet-label for="wilayah" :value="'Wilayah'"/>
                        <div class="mb-1">
                            <input class="form-control @error('wilayah') is-invalid @enderror"
                                   wire:model.defer="state.wilayah" type="text" placeholder="contoh: BNA">
                            <x-jet-input-error :for="'wilayah'" />
                        </div>

                        <x-jet-label for="kode" :value="'Kode'"/>
                        <div class="mb-1">
                            <input class="form-control @error('kode') is-invalid @enderror" wire:model.defer="state.kode" type="text" placeholder="Kode">
                            <x-jet-input-error :for="'kode'" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            {{ $updateMode ? 'Update' : 'Simpan' }}
                        </button>
                        <button type="button" wire:click.prevent="$emit('resetField')" data-bs-dismiss="modal" class="btn btn-danger">Batal</button>
                    </div>
                </form>
            </div>

        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title ?? 'List Zona' }}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive table-hover">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th class="text-center" style="width: 5%;">Kode</th>
                            <th>Wilayah</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @forelse($listZona as $zona)
                            <tr class="@if($this->isChecked($zona->id)) bg-light @endif text-center">
                                <td>{{ $i++ }}</td>
                                <td>
                                    {{ $zona->kode }}
                                </td>
                                <td class="text-start">{{ $zona->wilayah }}</td>
                                <td>
                                    @can('update_zona')
                                        <button wire:click.prevent="editZona({{ $zona->id }})" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                                data-bs-original-title="Edit Zona"
                                                type="button" class="btn btn-icon btn-sm btn-info waves-effect waves-float waves-light">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    @endcan
                                    @can('delete_zona')
                                        <button wire:click="destroy({{ $zona->id }},'single')" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                                data-bs-original-title="Hapus Zona" wire:loading.attr="disabled"
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
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Start -->
                <x-pagination :datalinks="$listZona" :page="$pageData['page']" :total-data="$pageData['totalData']" :page-count="$pageData['pageCount']"/>
                <!-- Pagination end -->
            </div>
        </div>
    </div>

    <!-- Hoverable rows end -->
    @push('page-script')
        <script></script>
    @endpush
</div>
