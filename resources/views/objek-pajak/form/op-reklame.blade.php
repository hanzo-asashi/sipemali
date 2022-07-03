<div id="op-reklame" class="bg-soft-light border-light p-4 mb-3" style="border-top: 1px solid; border-bottom: 1px solid; margin: 0 -20px 0 ">
    <h5 class="font-size-14 text-secondary mb-3">
        <i class="mdi mdi-form-dropdown me-1"></i> OP Reklame
    </h5>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div>
                <label for="id_kategori" class="form-label">Kategori</label>
                <select wire:dirty.class.remove="is-invalid" id="id_kategori" wire:model.lazy="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror" aria-label="Default select example">
                    <option selected>Pilih salah satu</option>
                    @foreach($listKategori as $key => $kategori)
                    <option value="{{ $key }}">{{ $kategori }}</option>
                    @endforeach
                </select>
                @error('id_kategori')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div>
                <label for="jenis_usaha" class="form-label">Jenis Usaha</label>
                <select wire:dirty.class.remove="is-invalid" id="jenis_usaha" wire:model.lazy="id_jenis_usaha" class="form-select @error('id_jenis_usaha') is-invalid @enderror" aria-label="Default select example">
                    <option selected>Pilih salah satu</option>
                    @foreach($listTipeUsaha as $key => $tipe)
                    <option value="{{ $key }}">{{ $tipe }}</option>
                    @endforeach
                </select>
                @error('id_jenis_usaha')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-6">
            <div>
                <label for="id_jenis_reklame" class="form-label">Jenis Reklame</label>
                <select wire:dirty.class.remove="is-invalid" id="id_jenis_reklame" wire:model.lazy="id_jenis_reklame" class="form-select @error('id_jenis_reklame') is-invalid @enderror" aria-label="Default select
                example">
                    <option selected>Pilih salah satu</option>
                    @foreach($listJenisReklame as $key => $jenis)
                        <option value="{{ $key }}">{{ $jenis }}</option>
                    @endforeach
                </select>
                @error('id_jenis_reklame')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        @if($showSatuan)
            <div class="col-lg-3">
                <div>
                    <label for="panjang" class="form-label">Ukuran Panjang</label>
                    <input wire:dirty.class.remove="is-invalid" wire:model.lazy="panjang" type="text" class="form-control @error('panjang') is-invalid @enderror" id="panjang">
                    @error('panjang')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <label for="lebar" class="form-label">Lebar</label>
                    <input wire:dirty.class.remove="is-invalid" wire:model.lazy="lebar" type="text" class="form-control @error('lebar') is-invalid @enderror" id="lebar">
                    @error('lebar')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @else
            <div class="col-lg-3">
                <div>
                    <label for="kuantiti" class="form-label">Kuantiti</label>
                    <input wire:dirty.class.remove="is-invalid" wire:model.lazy="kuantiti" type="text" class="form-control @error('kuantiti') is-invalid @enderror" id="kuantiti">
                    @error('kuantiti')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endif
    </div>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div>
                <label for="izin" class="form-label">Izin Pajak Reklame</label>
                <select wire:dirty.class.remove="is-invalid" wire:model.lazy="izin"
                        class="form-select @error('izin') is-invalid @enderror" aria-label="Default select example">
                    <option selected>Pilih salah satu</option>
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
