<div>

    <!-- roles list start -->
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="mb-3">
                <h5 class="card-title">Semua Hak Akses <span class="text-muted fw-normal ms-2">({{ $checked ? count($checked) : $roles->count() }})</span></h5>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                <div>
                    <x-button wire:click.prevent="addNew" class="btn btn-label btn-success">
                        <i class="bx bx-plus me-1 label-icon"></i>
                        Tambah Hak Akses
                    </x-button>
                </div>
            </div>
        </div>
    </div>
    <div class="card bg-soft-light border-secondary">
        <div class="card-body p-2">
            <form>
                <div class="row">
                    <div class="col-md-3">
                        <div>
                            <label class="form-label" for="search">Pencarian</label>
                            @include('widget.search-table')
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div>
                            <label class="form-label" for="form-sm-input">Baris</label>
                            @include('widget.page')
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div>
                            @can('manage-users')
                                @include('widget.bulk-action')
                            @endcan
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive mb-4">
        <x-table class="align-middle table-check nowrap">
            <x-table.table-head>
                <th scope="col" style="width: 50px;">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="checkAll" wire:model="selectAll"/>
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </th>
                <th scope="col">Hak Akses</th>
                {{--                <th scope="col">Tipe Akses</th>--}}
                <th style="width: 150px; min-width: 80px;">Action</th>
            </x-table.table-head>
            <x-table.table-body>
                @forelse($listRoles as $role)
                    <tr wire:loading.class="opacity-50">
                        <th scope="row">
                            <div class="form-check font-size-16">
                                <input value="{{ $role->id }}" type="checkbox" id="user-{{ $role->id }}" class="form-check-input"
                                       wire:model="checked" wire.key="{{ $role->id }}"/>
                                <label class="form-check-label" for="user-{{ $role->id }}"></label>
                            </div>
                        </th>
                        <td>{{ \Illuminate\Support\Str::ucfirst($role->name) }}</td>
                        <td>
                            @can('manage role')
                                <div class="d-flex flex-wrap gap-2">
                                    @can('manage permissions')
                                        <x-button wire:click.prevent="showPermissions({{ $role->id }})"
                                                  class="btn-sm btn-soft-success waves-effect waves-light"
                                                  data-bs-toggle="tooltip" data-bs-placement="top"
                                                  title="Update Tipe Akses (Permission)" wire:key="{{ $role->id }}"
                                        >
                                            <i class="bx bx-lock font-size-14 align-middle"></i>
                                        </x-button>
                                        {{--                                        <x-button--}}
                                        {{--                                                  onclick="Livewire.emit('showModal','hak-akses.permissions','{{ json_encode($role->id) }}')"--}}
                                        {{--                                                  class="btn-sm btn-soft-success waves-effect waves-light"--}}
                                        {{--                                                  data-bs-toggle="tooltip" data-bs-placement="top"--}}
                                        {{--                                                  title="Update Tipe Akses (Permission)" wire:key="{{ $role->id }}"--}}
                                        {{--                                        >--}}
                                        {{--                                            <i class="bx bx-lock font-size-14 align-middle"></i>--}}
                                        {{--                                        </x-button>--}}
                                    @endcan
                                    @can('update role')
                                        <x-button wire:click.prevent="edit({{ $role->id }})" class="btn-sm btn-soft-info waves-effect waves-light"
                                                  data-bs-toggle="tooltip" data-bs-placement="top"
                                                  title="Edit Hak Akses" wire:key="{{ $role->id }}"
                                        >
                                            <i class="bx bx-edit font-size-14 align-middle"></i>
                                        </x-button>
                                    @endcan
                                    @can('delete role')
                                        <x-button wire:click="$emit('triggerDelete',{{ $role->id }},'single')"
                                                  class="btn-sm btn-soft-danger waves-effect waves-light" data-bs-toggle="tooltip"
                                                  data-bs-placement="top" title="Hapus Hak Akses">
                                            <i class="bx bx-trash font-size-14 align-middle"></i>
                                        </x-button>
                                    @endcan
                                </div>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-primary">Maaf, data tidak ditemukan. Silahkan input data terlebih dahulu.</td>
                    </tr>
                @endforelse
            </x-table.table-body>
        </x-table>
        <!-- end table -->
        <x-pagination>
            {{ $listRoles->links() }}
        </x-pagination>
    </div>

    <!-- Add Role Modal start -->
    @include('account.roles.partials.modal')
    @if($showPermission)
        <livewire:hak-akses.permissions/>
    @endif
<!-- Add Role Modal end -->
</div>
@push('script')
    <!--suppress JSJQueryEfficiency -->
    <script>
        window.addEventListener('closePermissionModal', event => {
            $('#showPermission').modal('hide');
            if (event.detail.success) {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    text: event.detail.message,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                })
            } else {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'error',
                    text: event.detail.message,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                })
            }
        })

        window.addEventListener('openPermissionModal', event => {
            $('#showPermission').modal('show');
        })

        window.addEventListener('closeModal', event => {
            $('#roleModal').modal('hide');
            if (event.detail.success) {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    text: event.detail.message,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                })
            } else {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'error',
                    text: event.detail.message,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                })
            }
        })

        window.addEventListener('openModal', event => {
            $('#roleModal').modal('show');
        })
    </script>
    {{--    @include('widget.alertify')--}}
    <!--suppress JSJQueryEfficiency -->
    @include('widget.action-js')
@endpush
