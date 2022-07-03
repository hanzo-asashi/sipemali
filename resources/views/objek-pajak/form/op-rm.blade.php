<div id="op-{{ $selectedOp === 1 ? 'rumahmakan' : 'hotel' }}">
    <h4 class="font-size-16 mb-3 text-primary"><i class="bx bx-label"></i> Pajak {{ $selectedOp === 1 ? 'Rumah Makan' : 'Hotel' }}</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="izin-{{ $selectedOp === 1 ? 'rm' : 'hotel' }}" class="form-label">Izin Pajak {{ $selectedOp === 1 ? 'Rumah Makan' : 'Hotel' }}</label>
                <select wire:model="izin" class="form-select" id="izin-{{ $selectedOp === 1 ? 'rm' : 'hotel' }}" aria-label="">
                    <option selected>Pilih Izin {{ $selectedOp === 1 ? 'Rumah Makan' : 'Hotel' }}</option>
                    <option value="1">Ada</option>
                    <option value="2">Tidak Ada</option>
                </select>
            </div>
        </div>
    </div>
    {{--    <hr>--}}
</div>

{{--<div id="op-rumahmakan">--}}
{{--    <h4 class="font-size-16 mb-3 text-primary"><i class="bx bx-label"></i> Pajak Rumah Makan</h4>--}}
{{--    <div class="row">--}}
{{--        <div class="col-lg-4">--}}
{{--            <div class="mb-3">--}}
{{--                <label for="basicpill-phoneno-input" class="form-label">Izin Pajak Rumah Makan</label>--}}
{{--                <select wire:model="izin" class="form-select" aria-label="Default select example">--}}
{{--                    <option selected>Pilih salah satu</option>--}}
{{--                    <option value="1">Ada</option>--}}
{{--                    <option value="2">Tidak Ada</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <hr>--}}
{{--</div>--}}
