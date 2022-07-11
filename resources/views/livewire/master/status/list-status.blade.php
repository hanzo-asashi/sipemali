<div>
    @section('title', $title ?? '')
    @push('style')
    @endpush
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $updateMode ? 'Update Status' : 'Buat Status' }}</h4>
                </div>
                <form wire:submit.prevent="{{ $updateMode ? 'updateStatus' : 'storeStatus' }}" class="needs-validation" novalidate>
                    <div class="card-body">
                        <x-label for="nama_status" :value="'Nama Status'"/>
                        <div class="mb-2">
                            <input class="form-control @error('nama_status') is-invalid @enderror"
                                   wire:model.defer="state.nama_status" type="text" placeholder="Masukkan nama status" autofocus>
                            <x-input-error :for="'nama_status'"/>
                        </div>

                        <x-label for="shortcode" :value="'Kode'"/>
                        <div class="mb-2">
                            <input class="form-control @error('shortcode') is-invalid @enderror"
                                   wire:model.defer="state.shortcode" type="text" placeholder="Masukkan kode pendek atau singkatan">
                            <x-input-error :for="'shortcode'"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        @can('create_status')
                            <x-button type="submit" class="btn-primary" wire:loading.attr="disabled">
                                @if($updateMode)
                                    <x-loading-button :target="'updateStatus'"/>
                                @else
                                    <x-loading-button :target="'storeStatus'"/>
                                @endif
                                {{ $updateMode ? 'Update' : 'Simpan' }}
                            </x-button>
                        @endcan
                        <x-button wire:click.prevent="resetField" wire:loading.attr="disabled" class="btn-danger">
                            <x-loading-button :target="'resetField'"/>
                            Batal
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title ?? 'Daftar Status' }}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive table-hover">
                        <thead>
                        <tr>
                            {{--                            <th style="width: 2%;">--}}
                            {{--                                <div class="form-check">--}}
                            {{--                                    <input class="form-check-input" id="selectAllCheckbox" type="checkbox" value="" wire:model="selectAllCheckbox">--}}
                            {{--                                </div>--}}
                            {{--                            </th>--}}
                            <th class="text-center" style="width: 5%;">Kode</th>
                            <th>Nama Status</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--                        @if($checked)--}}
                        {{--                            <tr class="mb-2 mt-2 mx-2">--}}
                        {{--                                <td colspan="9">--}}
                        {{--                                    <span class="text-dark font-medium-1 py-5">Terpilih--}}
                        {{--                                        <span class="badge badge-light-danger font-semibold">{{ count($checked) }}</span>--}}
                        {{--                                        dari {{ $pageData['totalData'] }} data.--}}
                        {{--                                        @if (!$selectAllStatus)--}}
                        {{--                                            <a href="#" wire:click.prevent="selectAllData">Pilih Semua data. </a>--}}
                        {{--                                        @else--}}
                        {{--                                            <button type="button" class="btn btn-sm btn-danger waves-float waves-effect waves-light"--}}
                        {{--                                                    wire:click.prevent="resetCheckbox">--}}
                        {{--                                                Batalkan Terpilih--}}
                        {{--                                            </button>--}}
                        {{--                                            <button type="button" class="btn btn-sm btn-success waves-float waves-effect waves-light"--}}
                        {{--                                                    wire:click.prevent="deleteAllData">--}}
                        {{--                                                Hapus Terpilih--}}
                        {{--                                            </button>--}}
                        {{--                                        @endif--}}
                        {{--                                    </span>--}}
                        {{--                                </td>--}}
                        {{--                            </tr>--}}
                        {{--                        @endif--}}
                        @forelse($listStatus as $stat)
                            <tr class="@if($this->isChecked($stat->id)) bg-light @endif text-center">
                                {{--                                <td>--}}
                                {{--                                    <div class="form-check">--}}
                                {{--                                        <input id="list-status-{{ $stat->id }}" value="{{ $stat->id }}" class="form-check-input" type="checkbox"--}}
                                {{--                                               wire:model="checked" wire:key="list-status-{{ $stat->id }}">--}}
                                {{--                                    </div>--}}
                                {{--                                </td>--}}
                                <td><span class="badge badge-soft-primary">{{ $stat->shortcode }}</span></td>
                                <td class="text-start">{{ $stat->nama_status }}</td>
                                <td>
                                    @can('update_status')
                                        <button wire:click.prevent="editStatus({{ $stat->id }})" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                                data-bs-original-title="Edit Status"
                                                type="button" class="btn btn-icon btn-sm btn-info waves-effect waves-float waves-light">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    @endcan

                                    @can('delete_status')
                                        <button wire:click.prevent="destroy({{ $stat->id }},'single')" data-bs-toggle="tooltip" data-bs-placement="bottom" title
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
                        <tfoot>
                        <tr>
                            <td colspan="3">
                                <!-- Pagination Start -->
                                <x-pagination :datalinks="$listStatus" :page="$pageData['page']" :total-data="$pageData['totalData']" :page-count="$pageData['pageCount']"/>
                                <!-- Pagination end -->
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Hoverable rows end -->
    @push('script')
        <script></script>
    @endpush
</div>
