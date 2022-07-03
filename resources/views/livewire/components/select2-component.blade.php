<div>
    <div class="mb-3 row">
        <div class="col-lg-4">
            <div class="col-mb-3">
                <label class="col-form-label" for="wp_kabupaten">Kabupaten</label>
                <div wire:ignore>
                    <select wire:model.lazy="selectedKabupaten" id="wp_kabupaten" class="form-control @error('selectedKabupaten') is-invalid @enderror select2-kabupaten"
                            placeholder="Pilih Kabupaten">
                        <option value="" selected>Pilih Kabupaten</option>
                        @foreach($listKabupaten as $kab)
                            <option wire:key="{{ $kab->id }}" value="{{ $kab->kode }}">{{ $kab->nama }}</option>
                        @endforeach
                    </select>
                    @error('selectedKabupaten')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        @if(!is_null($selectedKabupaten))
            <div class="col-lg-4">
                <div class="col-mb-3">
                    <label class="col-form-label" for="wp_kecamatan">Kecamatan</label>
                    <div wire:ignore>
                        <select wire:model.lazy="selectedKecamatan" id="wp_kecamatan" class="form-control @error('selectedKecamatan') is-invalid @enderror select2-kecamatan"
                                placeholder="Pilih Kecamatan">
                            <option value="" selected>Pilih Kecamatan</option>
                            @foreach($kecamatan as $kec)
                                <option wire:key="{{ $kec->id }}" value="{{ $kec->kode }}">{{ $kec->nama }}</option>
                            @endforeach
                        </select>
                        @error('selectedKecamatan')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        @endif
        @if(!is_null($selectedKecamatan))
            <div class="col-lg-4">
                <div class="col-mb-3">
                    <label class="col-form-label" for="wp_kelurahan">Kelurahan</label>
                    <select wire:model.lazy="selectedKelurahan" id="wp_kelurahan" class="form-control @error('selectedKelurahan') is-invalid @enderror select2-kelurahan"
                            placeholder="Pilih Kelurahan">
                        <option value="" selected>Pilih Kelurahan</option>
                        @foreach($kelurahan as $kel)
                            <option wire:key="{{ $kel->id }}" value="{{ $kel->kode }}">{{ $kel->nama }}</option>
                        @endforeach
                    </select>
                    @error('selectedKelurahan')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endif
    </div>
</div>
