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
                    <h4 class="card-title">{{ $updateMode ? 'Ubah Bank' : 'Buat Bank' }}</h4>
                </div>
                <form wire:submit.prevent="{{ $updateMode ? 'updateBank' : 'storeBank' }}" class="needs-validation" novalidate>
                    <div class="card-body">
                        <x-jet-label for="bank_name" :value="'Nama Bank'"/>
                        <div class="mb-1">
                            <input class="form-control @error('bank_name') is-invalid @enderror" wire:model.defer="state.bank_name" type="text" placeholder="Bank Sulselbar">
                            <x-jet-input-error :for="'bank_name'"></x-jet-input-error>
                        </div>

                        <x-jet-label for="name" :value="'Nama Alias'"/>
                        <div class="mb-1">
                            <input class="form-control @error('name') is-invalid @enderror"
                                   wire:model.defer="state.name" type="text" placeholder="contoh: BRI, BCA">
                            <x-jet-input-error :for="'name'"></x-jet-input-error>
                        </div>

                        <x-jet-label for="account_number" :value="'No. Rekening'"/>
                        <div class="mb-1">
                            <input class="form-control @error('account_number') is-invalid @enderror"
                                   wire:model.defer="state.account_number" type="text" placeholder="contoh: 02843-3455-23432">
                            <x-jet-input-error :for="'account_number'"></x-jet-input-error>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <x-loading-button wire:target="{{ $updateMode ? 'updateBank' : 'storeBank' }}" />
                            {{ $updateMode ? 'Update' : 'Simpan' }}
                        </button>
                        <button type="button" wire:loading.attr="disabled" wire:click.prevent="resetField" data-bs-dismiss="modal" class="btn btn-danger">
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
                    <h4 class="card-title">{{ $title ?? 'List Bank' }}</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-responsive table-hover">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th>Nama Bank</th>
                            <th>No Rekening</th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @forelse($listBank as $bank)
                            <tr class="@if($this->isChecked($bank->id)) bg-light @endif text-center">
                                <td>{{ $i++ }}</td>
                                <td class="text-start">{{ $bank->name }}</td>
                                <td class="text-start">{{ $bank->account_number }}</td>
                                <td>
                                    {{ $bank->bank_name }}
                                </td>
                                <td>
                                    @can('update_bank')
                                        <button wire:click.prevent="editBank({{ $bank->id }})" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                                data-bs-original-title="Edit Bank"
                                                type="button" class="btn btn-icon btn-sm btn-info waves-effect waves-float waves-light">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    @endcan
                                    @can('delete_bank')
                                        <button wire:click="destroy({{ $bank->id }},'single')" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                                data-bs-original-title="Hapus Bank"
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
                <x-pagination :datalinks="$listBank" :page="$pageData['page']" :total-data="$pageData['totalData']" :page-count="$pageData['pageCount']"/>
                <!-- Pagination end -->
            </div>
        </div>
    </div>
    <!-- Hoverable rows end -->
    @push('page-script')
    @endpush
</div>
