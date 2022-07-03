<div class="modal fade" id="pembayaranModal" tabindex="-1" aria-labelledby="pembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pembayaranModalLabel">Transaksi Pembayaran Pajak Daerah #120394</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label for="" class="form-label">Metode Bayar</label>
                            <select class="form-select">
                                <option>Pilih salah satu</option>
                                <option>Bank</option>
                                <option>Kantor Bapenda</option>
                                <option>Transfer</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label">Tanggal</label>
                            <input type="text" class="form-control flatpickr-input" id="datepicker-basic" readonly="readonly">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <strong class="mb-3"><i class="bx bxs-news"></i> Penginputan Pembayaran</strong>
                        <div class="mb-3 col-md-2">
                            <label for="" class="form-label">Tahun</label>
                            <select class="form-select">
                                <option>2020</option>
                                <option>2021</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="" class="form-label">Bulan (Masa Pajak)</label>
                            <select class="form-select">
                                <option>Januari</option>
                                <option>Februari</option>
                                <option>Maret</option>
                                <option>April</option>
                                <option>Mei</option>
                                <option>Juni</option>
                                <option>Juli</option>
                                <option>Agustus</option>
                                <option>September</option>
                                <option>Oktober</option>
                                <option>November</option>
                                <option>Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="" class="form-label">Jumlah Yang Harus Dibayar</label>
                            <div class="input-group">
                                <span class="input-group-text" id="">Rp.</span>
                                <input type="text" class="form-control" placeholder="" disabled>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="" class="form-label">Jumlah Bayar</label>
                            <div class="input-group">
                                <span class="input-group-text" id="">Rp.</span>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="" class="form-label">Sisah / Lebih</label>
                            <div class="input-group">
                                <span class="input-group-text" id="">Rp.</span>
                                <input type="text" class="form-control" placeholder="" disabled>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3 col-md-8">
                        <label for="" class="form-label">Keterangan</label>
                        <textarea class="form-control"></textarea>
                    </div>
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
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalInputPembayaran" tabindex="-1" aria-labelledby="modalInputPembayaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInputPembayaranLabel">Input Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('transaksi-pajak.pembayaran.form.form-bayar')
            </div>
        </div>
    </div>
</div>
