<div id="op-pju">
    <h4 class="font-size-16 mb-3 text-primary"><i class="bx bx-label"></i> Pajak Penerangan Jalan Umum</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="nama_wilayah" class="form-label">Nama Wilayah</label>
                <select id="nama_wilayah" class="form-select @error('nama_wilayah') is-invalid @enderror" aria-label="Default select example">
                    <option selected>Pilih salah satu</option>
                    <option value="1">Lasusua</option>
                </select>
                @error('nama_wilayah')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
{{--    <hr>--}}
</div>
