<!-- Modal Edit Start -->
<x-modal class="text-start" id="jenis-pajak-modal">
    <x-slot name="modalTitle">
        <h4 class="modal-title" id="modal-title">Edit Metode Pembayaran</h4>
    </x-slot>
    <form wire:submit.prevent="updateJenisPajak" class="form form-vertical">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-1">
                    <label class="visually-hidden" for="jenis_metode">Metode Pembayaran</label>
                    <input wire:model.defer="jenis_metode" id="jenis_metode" type="text"
                           class="form-control @error('jenis_metode') is-invalid @enderror"
                           placeholder="Metode Pembayaran" name="jenis_metode" />
                    @error('jenis_metode')
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
