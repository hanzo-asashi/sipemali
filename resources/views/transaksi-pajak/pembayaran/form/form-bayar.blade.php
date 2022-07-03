<form>
    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="" class="form-label">Wajib Pajak</label>
            <select class="form-select">
                <option>Pilih wajib pajak</option>
                <option>Wahdan</option>
                <option>Wandi</option>
                <option>HAnsen</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="" class="form-label">Objek Pajak</label>
            <select class="form-select">
                <option>Pilih objek pajak</option>
                <option>Rumah Makan</option>
                <option>Hotel</option>
                <option>Reklame</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label">Nomor STS</label>
            <input type="text" class="form-control">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="" class="form-label">Tahun</label>
            <select class="form-select">
                <option>2020</option>
                <option>2021</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="" class="form-label">Jatuh Tempo</label>
            <input type="text" class="form-control flatpickr-input" id="datepicker-basic" readonly="readonly">
        </div>
        <div class="mb-3 col-md-4">
            <label for="" class="form-label">Jumlah Bayar</label>
            <div class="input-group">
                <span class="input-group-text" id="">Rp.</span>
                <input type="text" class="form-control" placeholder="">
            </div>
        </div>
    </div>
    <hr>
    <div class="mb-5 col-md-4">
        <label for="" class="form-label">Status</label>
        <select class="form-select">
            <option>Pilih salah satu</option>
            <option>Belum Bayar</option>
            <option>Lunas</option>
        </select>
    </div>
    <hr>
    <div class="mt-1">
        <button type="submit" class="btn btn-success">Update Pembayaran</button>
    </div>
</form>
