<div class="modal fade"
     id="showPermission"
     tabindex="-1"
     aria-labelledby="showPermission"
     aria-hidden="true"
>
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Permissions ({{ $permissions->count() }})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        List Akses ({{ $role->permissions->count() }})
                        <ul class="list-group">
                            @foreach($role->permissions->take($perPage) as $permission)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $permission->name }}
                                    <button wire:click="deletePermission({{ $permission->id }})" class="btn btn-danger btn-icon btn-sm">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/trash -->
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="search">Cari Permissions</label>
                            <input type="text" wire:model="search" class="form-control @error('name') is-invalid @enderror" name="search" placeholder="Masukkan nama akses">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <ul class="list-group">
                            @foreach($permissions as $permission)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $permission->name }}
                                    <button wire:click="assign({{ $permission->id }})" class="btn btn-primary btn-icon btn-sm">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                        <i class="bx bx-save"></i>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        {{--                        <x-pagination>--}}
                        {{--                            {{ $permissions->links() }}--}}
                        {{--                        </x-pagination>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
