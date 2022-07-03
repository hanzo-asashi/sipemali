<div id="op-{{ $selectedOp === 1 ? 'rumahmakan' : 'hotel' }}">
    <h4 class="font-size-16 mb-3 text-primary"><i class="bx bx-label"></i> Pajak {{ $selectedOp === 1 ? 'Rumah Makan' : 'Hotel' }}</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="izin-{{ $selectedOp === 1 ? 'rm' : 'hotel' }}" class="form-label">Izin Pajak {{ $selectedOp === 1 ? 'Rumah Makan' : 'Hotel' }}</label>
                <select wire:dirty.class.remove="is-invalid" wire:model.lazy="izin" class="form-select @error('izin') is-invalid @enderror" id="izin-{{ $selectedOp === 1 ? 'rm' : 'hotel' }}" aria-label="">
                    <option selected>Pilih Izin {{ $selectedOp === 1 ? 'Rumah Makan' : 'Hotel' }}</option>
                    <option value="1">Ada</option>
                    <option value="2">Tidak Ada</option>
                </select>
                @error('izin')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
