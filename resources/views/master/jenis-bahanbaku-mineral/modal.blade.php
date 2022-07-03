<!-- Modal Edit Start -->
<x-modal class="text-start" id="jenis-pajak-modal">
    <x-slot name="modalTitle">
        <h4 class="modal-title" id="modal-title">Edit Jenis Pajak</h4>
    </x-slot>
    <form wire:submit.prevent="updateJenisPajak" class="form form-vertical">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-1">
                    <label class="visually-hidden" for="nama-jenis-pajak">Jenis Bahan Baku Mineral</label>
                    <input wire:model.defer="jenis" id="nama-jenis-pajak" type="text"
                           class="form-control @error('jenis') is-invalid @enderror"
                           placeholder="Jenis Pajak" name="jenis"/>
                    @error('jenis')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <x-slot name="modalFooter">
                <button type="reset" class="btn btn-primary me-1 waves-effect waves-float waves-light">Simpan</button>
            </x-slot>
        </div>
    </form>
</x-modal>
<!-- Modal Edit End -->
