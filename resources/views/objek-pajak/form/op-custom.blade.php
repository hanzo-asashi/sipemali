<div id="op-custom{{ $selectedOp }}">
    <h4 class="font-size-16 mb-3 text-primary"><i class="bx bx-label"></i> Pajak {{ 'Custom '. $selectedOp }}</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                @foreach($defaultFields as $key => $value)
                    <label for="custom-{{'op'. $selectedOp }}" class="form-label">{{$value['label']}} {{ $selectedOp }}</label>
                    @if($value['fieldTipe'] === 'input')
                        <input wire:dirty.class.remove ="is-invalid" wire:model.lazy="custom-{{ 'op'.$selectedOp }}"
                               class="form-control @error('custom-op'.$selectedOp) is-invalid @enderror"
                               id="custom-{{'op'. $selectedOp }}" aria-label=""
                        />
                    @error('custom-op'.$selectedOp)
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
