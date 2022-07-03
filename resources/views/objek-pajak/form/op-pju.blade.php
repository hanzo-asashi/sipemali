<div id="op-pju" class="bg-soft-light border-light p-4 mb-3" style="border-top: 1px solid; border-bottom: 1px solid; margin: 0 -20px 0 ">
    <h5 class="font-size-14 text-secondary mb-3">
        <i class="mdi mdi-form-dropdown me-1"></i> OP Penerangan Jalan Umum
    </h5>
    <div class="row mb-3">
        <div class="col-lg-5">
            <div>
                <label for="nama_wilayah" class="form-label">Nama Wilayah</label>
                <select wire:model.lazy="nama_wilayah" wire:dirty.class.remove="is-invalid"
                        id="nama_wilayah" class="form-select @error('nama_wilayah') is-invalid @enderror">
                    <option selected>Pilih Wilayah</option>
                    @foreach($listKabupaten as $wilayah)
                        <option wire:key="wilayah-{{ $wilayah->id }}" value="{{ $wilayah->kode }}">{{ $wilayah->nama }}</option>
                    @endforeach
                </select>
                @error('nama_wilayah')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
{{--        <div class="col-lg-3">--}}
{{--            <div>--}}
{{--                <label for="tahun_pajak_ppj" class="form-label">Tahun Pajak</label>--}}
{{--                <input wire:dirty.class.remove="is-invalid" wire:model.lazy="tahun_pajak_ppj"--}}
{{--                       type="text" class="form-control @error('tahun_pajak_ppj') is-invalid @enderror"--}}
{{--                       id="tahun_pajak_ppj"--}}
{{--                >--}}
{{--                @error('tahun_pajak_ppj')--}}
{{--                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4">--}}
{{--            <div>--}}
{{--                <label for="triwulan" class="form-label">Masa Pajak</label>--}}
{{--                <select wire:model.lazy="triwulan" wire:dirty.class.remove="is-invalid"--}}
{{--                        id="triwulan" class="form-select @error('triwulan') is-invalid @enderror">--}}
{{--                    <option selected>Pilih Masa Pajak</option>--}}
{{--                    @foreach(config('custom.triwulan') as $key => $triwulan)--}}
{{--                        <option wire:key="triwulan-{{ $key }}" value="{{ $key }}">{{ $triwulan }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                @error('triwulan')--}}
{{--                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
{{--    <div class="row mb-3">--}}
{{--        <div class="col-lg-4">--}}
{{--            <div>--}}
{{--                <label for="besaran_kwh" class="form-label">Besaran KWH</label>--}}
{{--                <input wire:dirty.class.remove="is-invalid" wire:model.lazy="besaran_kwh"--}}
{{--                       type="text" class="form-control @error('besaran_kwh') is-invalid @enderror"--}}
{{--                       id="besaran_kwh"--}}
{{--                >--}}
{{--                @error('besaran_kwh')--}}
{{--                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4">--}}
{{--            <div>--}}
{{--                <label for="nilai_pajak" class="form-label">Nilai Pajak</label>--}}
{{--                <input wire:dirty.class.remove="is-invalid" wire:model.lazy="nilai_pajak"--}}
{{--                       type="text" class="form-control @error('nilai_pajak') is-invalid @enderror"--}}
{{--                       id="nilai_pajak"--}}
{{--                >--}}
{{--                @error('nilai_pajak')--}}
{{--                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
