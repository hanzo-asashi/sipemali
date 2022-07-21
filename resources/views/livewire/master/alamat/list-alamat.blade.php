<div>
    @section('title', $title ?? '')
    @push('css')
    @endpush
    <div class="row">
        {{--        <div class="col-md-12">--}}
        {{--            <x-alert/>--}}
        {{--        </div>--}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $updateMode ? 'Update' : 'Tambah' }} Alamat</h4>
                </div>
                <form wire:submit.prevent="{{ $updateMode ? 'updateAlamat' : 'storeAlamat' }}" class="needs-validation" novalidate>
                    <div class="card-body p-3">
                        <x-label for="alamat" :value="'Alamat'"/>
                        <div class="mb-1">
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" wire:model.defer="alamat" id="alamat" placeholder="Alamat">
                            {{--                    <x-jet-input class="@error('alamat') is-invalid @enderror" wire:model.defer="alamat" type="text" label="Alamat" placeholder="Alamat" />--}}
                            <x-input-error :for="'alamat'"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <x-button type="submit" class="btn-primary" wire:loading.attr="disabled" wire:target="{{ $updateMode ? 'updateAlamat' : 'storeAlamat' }}">
                            <x-loading-button wire:target="{{ $updateMode ? 'updateAlamat' : 'storeAlamat' }}"/>
                            <i class="bx bx-save me-1 mt-1"></i>
                            {{ $updateMode ? 'Ubah' : 'Simpan' }}
                        </x-button>
                        <button type="button" wire:loading.attr="disabled" wire:click.prevent="resetField" wire:target="resetField" data-bs-dismiss="modal" class="btn btn-danger">
                            <x-loading-button wire:target="resetField"/>
                            <i class="bx bx-x me-1 mt-1"></i>
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body bg-soft-light p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-sm-8 col-lg-8 d-flex align-items-center justify-content-center justify-content-lg-start">
                            <div class="me-1">
                                <select wire:model="perPage" class="form-select">
                                    <option value="15">15</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="me-1">
                                <input wire:model.debounce="search" value="{{ $search }}" type="search" class="form-control" placeholder="Cari disini...">
                            </div>
                            <div wire:ignore.self>
                                @if($checked)
                                    <button wire:click="$emit('triggerDelete','delete','bulk')" class="btn btn-danger waves-effect waves-float waves-light" type="button">
                                        <span>Hapus Terpilih</span>
                                    </button>
                                    {{--                                    @include('widgets.bulk-action')--}}
                                @endif
                            </div>
                        </div>
                        {{--                        <div class="col-sm-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">--}}
                        {{--                            <div class="d-flex align-items-center justify-content-center justify-content-lg-end">--}}
                        {{--                                <button class="btn btn-primary waves-effect waves-float waves-light"--}}
                        {{--                                        type="button" data-bs-toggle="modal" wire:click.prevent="addAlamat"--}}
                        {{--                                >--}}
                        {{--                                    Buat Alamat--}}
                        {{--                                </button>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-responsive table-hover align-middle">
                    <thead class="text-center">
                    <tr>
                        {{--                            <th style="width: 5%;">--}}
                        {{--                                <div class="form-check">--}}
                        {{--                                    <input class="form-check-input" type="checkbox" value="" id="selectAllAlamat" wire:model="selectAll" />--}}
                        {{--                                    <label class="form-check-label" for="selectAllAlamat"></label>--}}
                        {{--                                </div>--}}
                        {{--                            </th>--}}
                        {{--                        <th style="width: 2%">No.</th>--}}
                        <th>Alamat</th>
                        <th class="text-center" style="width: 10%;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                        @if($checked)--}}
                    {{--                            <tr class="mb-2 mt-2 mx-2">--}}
                    {{--                                <td colspan="9">--}}
                    {{--                                    <span class="text-dark font-medium-1 py-5">Terpilih--}}
                    {{--                                        <span class="badge badge-light-danger font-semibold">{{ count($checked) }}</span>--}}
                    {{--                                        dari {{ $pageData['totalData'] }} data.--}}
                    {{--                                        @if (!$selectAllAlamat)--}}
                    {{--                                            <a href="#" wire:click.prevent="selectAllData">Pilih Semua data. </a>--}}
                    {{--                                        @else--}}
                    {{--                                            <a class="text-danger text-decoration-underline" href="#" wire:click.prevent="resetCheckbox">Batalkan terpilih. </a>--}}
                    {{--                                        @endif--}}
                    {{--                                    </span>--}}
                    {{--                                </td>--}}
                    {{--                            </tr>--}}
                    {{--                        @endif--}}
                    {{--                    @php $i = 1; @endphp--}}
                    @forelse($listAlamat as $almt)
                        <tr class="">
                            {{--                                <td>--}}
                            {{--                                    <div class="form-check">--}}
                            {{--                                        <input id="alamat-{{ $almt->id }}" value="{{ $almt->id }}" class="form-check-input" type="checkbox"--}}
                            {{--                                               wire:model="checked" wire:key="{{ $almt->id }}" />--}}
                            {{--                                        <label class="form-check-label" for="alamat-{{ $almt->id }}"></label>--}}
                            {{--                                    </div>--}}
                            {{--                                </td>--}}
                            {{--                            <td>{{ $i++ }}</td>--}}
                            <td>{{ $almt->alamat }}</td>
                            <td class="text-center">
                                @can('update_alamat')
                                    <button wire:click.prevent="editAlamat({{ $almt->id }})" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                            data-bs-original-title="Edit Alamat" wire:loading.attr="disabled" wire:target="editAlamat({{ $almt->id }})"
                                            type="button" class="btn btn-icon btn-sm btn-info waves-effect waves-float waves-light">
                                        <i class="far fa-edit"></i>
                                    </button>
                                @endcan

                                @can('delete_alamat')
                                    <button wire:click.prevent="destroy({{ $almt->id }}, 'single')" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                            data-bs-original-title="Hapus Alamat" wire:loading.attr="disabled"
                                            type="button" class="btn btn-icon btn-sm btn-danger waves-effect waves-float waves-light">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-muted text-center">Maaf, data tidak ditemukan</td>
                        </tr>
                    @endforelse
                    </tbody>
                    {{--                    <tfoot>--}}
                    {{--                    <tr>--}}
                    {{--                        <td colspan="4" class="text-start border-0">--}}
                    {{--                            <div class="text-muted" role="status" aria-live="polite">--}}
                    {{--                                Menampilkan {{ $pageData['page'] }} sampai {{ $pageData['pageCount'] }} dari {{ $pageData['totalData'] }} entri--}}
                    {{--                            </div>--}}
                    {{--                        </td>--}}
                    {{--                        <td colspan="5" class="text-center border-0">--}}
                    {{--                            {{ $listAlamat->links() }}--}}
                    {{--                        </td>--}}
                    {{--                    </tr>--}}
                    {{--                    </tfoot>--}}
                </table>
            {{--            @dd($pageData, $listAlamat)--}}
            <!-- Pagination Start -->
                <x-pagination :datalinks="$listAlamat" :page="$pageData['page']" :total-data="$pageData['totalData']" :page-count="$pageData['pageCount']"/>
                <!-- Pagination end -->
            </div>
        </div>
    </div>
    {{-- Modal Tambah List ALamat--}}
    {{--    <x-modal :id="$modalId" :title="'Alamat'" :maxWidth="''" :update-mode="$updateMode">--}}
    {{--        --}}{{--        <x-jet-validation-errors :errors="$errors"></x-jet-validation-errors>--}}
    {{--        <form wire:submit.prevent="{{ $updateMode ? 'updateAlamat' : 'storeAlamat' }}" class="needs-validation" novalidate>--}}
    {{--            <div class="modal-body">--}}
    {{--                <x-jet-label for="alamat" :value="'Alamat'"/>--}}
    {{--                <div class="mb-1">--}}
    {{--                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" wire:model.defer="alamat" id="alamat" placeholder="Alamat">--}}
    {{--                    --}}{{--                    <x-jet-input class="@error('alamat') is-invalid @enderror" wire:model.defer="alamat" type="text" label="Alamat" placeholder="Alamat" />--}}
    {{--                    <x-input-error :for="'alamat'"/>--}}
    {{--                </div>--}}
    {{--                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">--}}
    {{--                    {{ $updateMode ? 'Ubah' : 'Simpan' }}--}}
    {{--                </button>--}}
    {{--                <button type="button" wire:click.prevent="$emit('resetField')" data-bs-dismiss="modal" class="btn btn-danger">Batal</button>--}}
    {{--            </div>--}}
    {{--        </form>--}}
    {{--    </x-modal>--}}
<!-- Hoverable rows end -->
    @push('script')
        <script></script>
    @endpush
</div>
