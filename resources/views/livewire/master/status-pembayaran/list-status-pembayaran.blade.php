<div>
    @section('title', $title ?? '')
    @push('css')
    @endpush
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $updateMode ? 'Ubah Status Pembayaran' : 'Buat Status Pembayaran' }}</h4>
                </div>
                <form wire:submit.prevent="{{ $updateMode ? 'updateStatus' : 'storeStatus' }}" class="needs-validation" novalidate>
                    <div class="card-body">
                        <x-label for="name" :value="'Nama Status'"/>
                        <div class="mb-1">
                            <input class="form-control @error('name') is-invalid @enderror"
                                   wire:model.defer="state.name" type="text" placeholder="contoh: aktif">
                            <x-input-error :for="'name'" />
                        </div>

                        <x-label for="shortcode" :value="'Kode'"/>
                        <div class="mb-1">
                            <input class="form-control @error('shortcode') is-invalid @enderror" wire:model.defer="state.shortcode" type="text" placeholder="Kode">
                            <x-input-error :for="'shortcode'" />
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
                    <h4 class="card-title">{{ $title ?? 'List Status Pembayaran' }}</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-responsive table-hover">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th class="text-center" style="width: 5%;">Kode</th>
                            <th>Nama Status</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @forelse($listStatus as $stat)
                            <tr class="@if($this->isChecked($stat->id)) bg-light @endif text-center">
                                <td>{{ $i++ }}</td>
                                <td><span class="badge badge-soft-primary">{{ $stat->shortcode }}</span></td>
                                <td class="text-start">{{ $stat->name }}</td>
                                <td>
                                    @can('update_paymentstatus')
                                        <button wire:click.prevent="editStatus({{ $stat->id }})" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                                data-bs-original-title="Edit Status"
                                                type="button" class="btn btn-icon btn-sm btn-info waves-effect waves-float waves-light">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    @endcan

                                    @can('delete_paymentstatus')
                                        <button wire:click="destroy({{ $stat->id }},'single')" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                                data-bs-original-title="Hapus Status"
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
                <x-pagination :datalinks="$listStatus" :page="$pageData['page']" :total-data="$pageData['totalData']" :page-count="$pageData['pageCount']"/>
                <!-- Pagination end -->
            </div>
        </div>
    </div>
<!-- Hoverable rows end -->
    @push('script')
        <script></script>
    @endpush
</div>
