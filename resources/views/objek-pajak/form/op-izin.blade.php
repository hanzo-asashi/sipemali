<div class="bg-soft-light border-light p-4 mb-3" style="border-top: 1px solid; border-bottom: 1px solid; margin: 0 -20px 0 ">
    <h5 class="font-size-14 text-secondary mb-3">
        <i class="mdi mdi-form-dropdown me-1"></i> {{ $selectedOp === 1 ? 'OP Rumah Makan' : 'OP Hotel' }}
    </h5>
    <div class="row">
        <div class="col-lg-2">
            <div>
                <div id="op-{{ $selectedOp === 1 ? 'rumahmakan' : 'hotel' }}">
                    <!-- <h4 class="font-size-16 mb-3 text-primary"><i class="bx bx-label"></i> Pajak {{ $selectedOp === 1 ? 'Rumah Makan' : 'Hotel' }}</h4> -->
                    <label for="izin-{{ $selectedOp === 1 ? 'rm' : 'hotel' }}" class="form-label">Izin Pajak {{ $selectedOp === 1 ? 'Rumah Makan' : 'Hotel' }}</label>
                    <select wire:dirty.class.remove="is-invalid" wire:model.lazy="izin" class="form-select @error('izin') is-invalid @enderror" id="izin-{{ $selectedOp === 1 ? 'rm' : 'hotel' }}" aria-label="">
                        <option selected>Pilih Izin {{ $selectedOp === 1 ? 'Rumah Makan' : 'Hotel' }}</option>
                        <option value="Ada">Ada</option>
                        <option value="Tidak Ada">Tidak Ada</option>
                    </select>
                    @error('izin')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
