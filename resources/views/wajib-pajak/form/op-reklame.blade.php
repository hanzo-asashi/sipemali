<div id="op-reklame">
    <h4 class="font-size-16 mb-3 text-primary"><i class="bx bx-label"></i> Pajak Reklame</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
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
            <div class="mb-3">
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
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
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
                <div class="mb-3">
                    <label for="panjang" class="form-label">Ukuran Panjang</label>
                    <input wire:dirty.class.remove="is-invalid" wire:model.lazy="panjang" type="text" class="form-control @error('panjang') is-invalid @enderror" id="panjang">
                    @error('panjang')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mb-3">
                    <label for="lebar" class="form-label">Lebar</label>
                    <input wire:dirty.class.remove="is-invalid" wire:model.lazy="lebar" type="text" class="form-control @error('lebar') is-invalid @enderror" id="lebar">
                    @error('lebar')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @else
            <div class="col-lg-3">
                <div class="mb-3">
                    <label for="kuantiti" class="form-label">Kuantiti</label>
                    <input wire:dirty.class.remove="is-invalid" wire:model.lazy="kuantiti" type="text" class="form-control @error('kuantiti') is-invalid @enderror" id="kuantiti">
                    @error('kuantiti')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="izin" class="form-label">Izin Pajak Reklame</label>
                <select wire:dirty.class.remove="is-invalid" wire:model.lazy="izin"
                        class="form-select @error('izin') is-invalid @enderror" aria-label="Default select example">
                    <option selected>Pilih salah satu</option>
                    <option value="1">Ada</option>
                    <option value="2">Tidak Ada</option>
                </select>
                @error('izin')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">

    </div>
{{--    <hr>--}}
</div>
