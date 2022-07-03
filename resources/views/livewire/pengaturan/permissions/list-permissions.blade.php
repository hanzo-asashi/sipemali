<div>
    @section('title', 'Hak Akses')

    @push('vendor-style')
    @endpush
    @push('page-style')
    @endpush
    {{--        <h3>Permissions List</h3>--}}
    {{--        <p>Each category (Basic, Professional, and Business) includes the four predefined roles shown below.</p>--}}

    <!-- Permission Table -->
    <div class="card">
        <div class="card-body p-1">
            <div class="d-flex justify-content-between align-items-center">
                <div class="col-sm-8 col-lg-8 d-flex justify-content-center justify-content-lg-start">
                    <div class="me-1">
                        <input wire:model="search" value="{{ $search }}" type="search" class="form-control" placeholder="Cari disini...">
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
                <div class="col-sm-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-end">
                        <button class="btn btn-primary waves-effect waves-float waves-light"
                                type="button" data-bs-toggle="modal" wire:click.prevent="addPermission"
                        >
                            Buat Izin Baru
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                <tr class="text-center">
                    <th style="width: 2%;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="selectAllPermission" wire:model="selectAllPermission">
                            <label class="form-check-label" for="selectAllPermission"></label>
                        </div>
                    </th>
                    {{--                        <th style="width: 3%">ID</th>--}}
                    <th>Nama Izin</th>
                    <th style="width: 10%">Guard</th>
                    <th style="width: 20%">Tanggal Buat</th>
                    <th style="width: 10%">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @if($checked)
                    <tr class="mb-2 mt-2 mx-2">
                        <td colspan="9">
                                <span class="text-dark font-medium-1 py-5">Terpilih
                                    <span class="badge badge-light-danger font-semibold">{{ count($checked) }}</span>
                                    dari {{ $pageData['totalData'] }} data.
                                    @if (!$selectAllPermission)
                                        <a href="#" wire:click.prevent="selectAllData">Pilih Semua data. </a>
                                    @else
                                        <a class="text-danger text-decoration-underline" href="#" wire:click.prevent="resetCheckbox">Batalkan terpilih. </a>
                                        {{--                                            <button type="button" class="btn btn-sm btn-danger waves-float waves-effect waves-light"--}}
                                        {{--                                                    wire:click.prevent="resetCheckbox">--}}
                                        {{--                                                Batalkan Terpilih--}}
                                        {{--                                            </button>--}}
                                        {{--                                            <button type="button" class="btn btn-sm btn-success waves-float waves-effect waves-light"--}}
                                        {{--                                                    wire:click.prevent="deleteAllData">--}}
                                        {{--                                                Hapus Terpilih--}}
                                        {{--                                            </button>--}}
                                    @endif
                                </span>
                        </td>
                    </tr>
                @endif
                @forelse($listPermissions as $perm)
                    <tr class="@if($this->isChecked($perm->id)) bg-light @endif">
                        <td>
                            <div class="form-check">
                                <input wire:model="checked" id="permission-{{ $perm->id }}" value="{{ $perm->id }}" class="form-check-input" type="checkbox">
                                <label class="form-check-label" for="permission-{{ $perm->id }}"></label>
                            </div>
                        </td>
                        <td>{{ $perm->name }}</td>
                        <td class="text-center">{{ $perm->guard_name }}</td>
                        <td class="text-center">{{ $perm->created_at->diffForHumans() }}</td>
                        <td>
                            <button wire:click.prevent="editPermission({{ $perm->id }})" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                    data-bs-original-title="Edit Permission"
                                    type="button" class="btn btn-icon btn-sm btn-info waves-effect waves-float waves-light">
                                <i class="far fa-edit"></i>
                            </button>
                            <button wire:click="$emit('triggerDelete',{{ $perm->id }},'single')" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                    data-bs-original-title="Hapus MetodeBayar"
                                    type="button" class="btn btn-icon btn-sm btn-danger waves-effect waves-float waves-light">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">Data tidak ditemukan</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination Start -->
        <x-pagination :datalinks="$listPermissions" :page="$pageData['page']" :total-data="$pageData['totalData']" :page-count="$pageData['pageCount']"/>
        <!-- Pagination end -->
    </div>
    <!-- Permission Table -->

    <!-- Add Permission Modal -->
    <x-modal :id="$modalId" :title="'Izin'" :update-mode="$updateMode">
        <div class="modal-body">
            <x-jet-validation-errors :errors="$errors"></x-jet-validation-errors>
            <form id="formTambahIzin" wire:submit.prevent="{{ $updateMode ? 'updatePermission' : 'storePermission' }}" class="needs-validation" novalidate>
                <div class="col-12">
                    <label class="form-label" for="permission_name">Nama Izin</label>
                    <input wire:model.defer="state.name" type="text" id="permission_name"
                           class="form-control @error('name') is-invalid @enderror" placeholder="contoh : create_user, update_user, delete_user" autofocus
                    />
                    <x-jet-input-error for="name"/>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary mt-2 me-1" wire:loading.attr="disabled">
                        {{ $updateMode ? 'Update Izin' : 'Buat Izin' }}
                    </button>
                    <button type="button" wire:click.prevent="$emit('resetField')" data-bs-dismiss="modal" class="btn btn-secondary mt-2">Batal</button>
                </div>
            </form>
        </div>
    </x-modal>
    <!-- Add Permission Modal -->

    @push('page-script')
        @include('widgets.action-js')
        @include('widgets.notifikasi')
    @endpush
</div>
