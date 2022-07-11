<div wire:ignore.self
     class="modal fade"
     id="roleModal"
     tabindex="-1"
     aria-labelledby="roleModal"
     aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">
                    @if($showEditModal)
                        <span>Ubah Tipe Akses</span>
                    @else
                        <span>Tambah Tipe Akses</span>
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="{{ $showEditModal ? 'updateRole' : 'createRole' }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label" for="hak-akses">Hak Akses</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                <input wire:model.defer="state.name"
                                       type="text"
                                       id="hak-akses"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Hak Akses"
                                />
                                <x-input-error :for="'name'"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <x-button type="submit" class="btn-primary">
                        @if($showEditModal)
                            <x-loading-button :target="'updateRole'"/>
                            <span>Update</span>
                        @else
                            <x-loading-button :target="'createRole'"/>
                            <span>Simpan</span>
                        @endif
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
