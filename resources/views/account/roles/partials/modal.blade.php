<div
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
            <form wire:submit.prevent="{{ $showEditModal ? 'updateRole' : 'createRole' }}" class="form form-vertical">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label" for="hak-akses">Hak Akses</label>
                                <div wire:ignore class="input-group input-group-merge">
                                    <span class="input-group-text"><i data-feather="lock"></i></span>
                                    <input wire:model.defer="name"
                                           type="text"
                                           id="hak-akses"
                                           name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Hak Akses"
                                    />
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            @if($showEditModal)
                                <span>Update</span>
                            @else
                                <span>Simpan</span>
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
