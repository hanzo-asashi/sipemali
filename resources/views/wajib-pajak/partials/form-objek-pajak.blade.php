{{--<form>--}}
<div id="kolom-op">
    <div class="row">
        <div class="col-lg-3">
            <div class="mb-3">
                <label for="basicpill-firstname-input" class="form-label">Jenis Objek Pajak</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Pilih salah satu</option>
                    <option value="1">Hotel</option>
                    <option value="2">Rumah Makan</option>
                    <option value="3">Reklame</option>
                    <option value="4">Tambang Mineral</option>
                    <option value="5">Penerangan Jalan Umum (PJU)</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="basicpill-phoneno-input" class="form-label">Nama Objek Pajak</label>
                <input type="text" class="form-control" id="basicpill-phoneno-input">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="basicpill-text-input" class="form-label">Nomor Objek Pajak Daerah (NOPD)</label>
                <input type="text" class="form-control" id="basicpill-text-input">
            </div>
        </div>
    </div>
    {{--        <livewire:components.select2-component/>--}}
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-address-input" class="form-label">Alamat Lengkap</label>
                <textarea id="basicpill-address-input" class="form-control"
                          rows="2"></textarea>
            </div>
        </div>
    </div>
    <hr>
    @include('transaksi-pajak.daftar-wajib-pajak.form.op-hotel')
    @include('transaksi-pajak.daftar-wajib-pajak.form.op-rm')
    @include('transaksi-pajak.daftar-wajib-pajak.form.op-reklame')
    @include('transaksi-pajak.daftar-wajib-pajak.form.op-tambang')
    @include('transaksi-pajak.daftar-wajib-pajak.form.op-pju')
</div>
<button type="button" class="btn btn-secondary waves-effect btn-label waves-light"><i class="bx bx-plus label-icon"></i> Tambah
    Objek Pajak
</button>
<hr>
{{--</form>--}}
