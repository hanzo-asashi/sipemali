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
                    <h4 class="card-title">{{ $updateMode ? 'Ubah Loket' : 'Buat Loket' }}</h4>
                </div>
                <form wire:submit.prevent="{{ $updateMode ? 'updateLoket' : 'storeLoket' }}" class="needs-validation" novalidate>
                    <div class="card-body">
                        <x-jet-label for="branch_code" :value="'Kode'"/>
                        <div class="mb-1">
                            <input class="form-control @error('branch_code') is-invalid @enderror"
                                   wire:model.defer="state.branch_code" type="text" placeholder="contoh: ABN, BTU">
                            <x-jet-input-error :for="'branch_code'"></x-jet-input-error>
                        </div>

                        <x-jet-label for="name" :value="'Nama Loket'"/>
                        <div class="mb-1">
                            <input class="form-control @error('name') is-invalid @enderror"
                                   wire:model.defer="state.name" type="text" placeholder="contoh: Abbanuange, Batu2">
                            <x-jet-input-error :for="'name'"></x-jet-input-error>
                        </div>

                        <x-jet-label for="description" :value="'Deskripsi'"/>
                        <div class="mb-1">
                            <input class="form-control @error('description') is-invalid @enderror" wire:model.defer="state.description" type="text" placeholder="Deskripsi">
                            <x-jet-input-error :for="'description'"></x-jet-input-error>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <x-loading-button wire:target="{{ $updateMode ? 'updateLoket' : 'storeLoket' }}" />
                            {{ $updateMode ? 'Update' : 'Simpan' }}
                        </button>
                        <button type="button" wire:click.prevent="resetField" data-bs-dismiss="modal" class="btn btn-danger">
                            <x-loading-button wire:target="resetField" />
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> {{ $title ?? 'List Loket' }}</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-responsive table-hover">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th class="text-center" style="width: 5%;">Kode</th>
                            <th>Nama Loket</th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @forelse($listLoket as $loket)
                            <tr class="@if($this->isChecked($loket->id)) bg-light @endif text-center">
                                <td class="text-start" style="width: 5%;">{{ $i++ }}</td>
                                <td class="text-start">{{ $loket->branch_code }}</td>
                                <td class="text-start">{{ $loket->name }}</td>
                                <td>
                                    {{ $loket->description }}
                                </td>
                                <td>
                                    @can('update_loket')
                                        <button wire:click.prevent="editLoket({{ $loket->id }})" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                                data-bs-original-title="Edit Loket"
                                                type="button" class="btn btn-icon btn-sm btn-info waves-effect waves-float waves-light">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    @endcan
                                    @can('delete_loket')
                                        <button wire:click="destroy({{ $loket->id }},'single')" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                                data-bs-original-title="Hapus Loket"
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
                <x-pagination :datalinks="$listLoket" :page="$pageData['page']" :total-data="$pageData['totalData']" :page-count="$pageData['pageCount']"/>
                <!-- Pagination end -->
            </div>
        </div>
    </div>
    <!-- Hoverable rows end -->
    @push('page-script')
        <script></script>
    @endpush
</div>
