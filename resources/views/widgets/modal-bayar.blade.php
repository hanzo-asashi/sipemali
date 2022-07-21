<x-modal :id="'modal-bayar'" :title="'Pembayaran'" :maxWidth="'lg'">
    <form wire:submit.prevent="prosesPembayaran" class="pembayaran modal-content pt-0">
        <div class="modal-body">
            <div class="row mb-1">
                <div class="col-md-6">
                    <label class="form-label" for="bulan_berjalan">Bulan Berjalan</label>
                    <select wire:model.defer="pembayaran.bulan_berjalan" id="bulan_berjalan" class="form-select">
                        <option value="">Pilih Bulan</option>
                        @foreach($pageData['listBulan'] as $key => $bln)
                            <option value="{{ $key }}">{{ $bln }}</option>
                        @endforeach
                    </select>
                    <x-input-error :for="'bulan_berjalan'"/>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="fp-date">Tahun Berjalan</label>
                    <select wire:model.defer="pembayaran.tahun_berjalan" class="form-select">
                        <option value="">Pilih Tahun</option>
                        @foreach($pageData['listTahun'] as $key => $thn)
                            <option value="{{ $key }}">{{ $thn }}</option>
                        @endforeach
                    </select>

                    <x-input-error :for="'tahun_berjalan'"/>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-6">
                    <label class="form-label" for="stand_awal">Stand Awal (m3)</label>
                    <input
                        wire:model.defer="pembayaran.stand_awal"
                        type="number"
                        id="stand_awal"
                        class="form-control @error('stand_awal') is-invalid @enderror"
                        placeholder="1055"
                    />
                    <x-input-error :for="'stand_awal'"/>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="stand_akhir">Stand Akhir (m3)</label>
                    <span wire:loading.delay.shorter wire:target="pembayaran.stand_akhir" class="spinner-border spinner-border-sm text-end"
                          role="status"
                          aria-hidden="true"></span>
                    <input
                        wire:model.lazy="pembayaran.stand_akhir"
                        type="number"
                        id="stand_akhir"
                        class="form-control @error('stand_akhir') is-invalid @enderror"
                        placeholder="1000"
                    />
                    <x-input-error :for="'stand_akhir'"/>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-6">
                    <label class="form-label" for="stand_awal">Jumlah Pemakaian Air Saat Ini (m3)</label>
                    <input tabindex="-1"
                           wire:model.lazy="pembayaran.pemakaian_air_saat_ini"
                           type="number"
                           id="pemakaian_air_saat_ini"
                           class="form-control @error('pemakaian_air_saat_ini') is-invalid @enderror"
                           placeholder="12"
                    />
                    <x-input-error :for="'pemakaian_air_saat_ini'"/>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="harga_air">Harga Air</label>
                    <input tabindex="-1"
                           wire:model.defer="pembayaran.harga_air"
                           type="text"
                           id="harga_air"
                           class="form-control @error('harga_air') is-invalid @enderror" readonly
                    />
                    <x-input-error :for="'harga_air'"/>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-6">
                    <label class="form-label" for="dana_meter">Dana Meter</label>
                    <input tabindex="-1"
                           wire:model.defer="pembayaran.dana_meter"
                           type="text"
                           id="dana_meter"
                           class="form-control @error('dana_meter') is-invalid @enderror"
                           placeholder="Rp. 5.000" readonly
                    />
                    <x-input-error :for="'dana_meter'"/>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="biaya_layanan">Biaya Layanan</label>
                    <input tabindex="-1"
                           wire:model.defer="pembayaran.biaya_layanan"
                           type="text"
                           id="biaya_layanan"
                           class="form-control @error('biaya_layanan') is-invalid @enderror"
                           placeholder="Rp. 2.000" readonly
                    />
                    <x-input-error :for="'biaya_layanan'"/>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-6">
                    <label class="form-label" for="total_tagihan">Total Tagihan</label>
                    <input tabindex="-1"
                           wire:model.defer="pembayaran.total_tagihan"
                           type="number"
                           id="total_tagihan"
                           class="form-control @error('total_tagihan') is-invalid @enderror"
                           placeholder="Rp. 1.000.000" readonly
                    />
                    <x-input-error :for="'total_tagihan'"/>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="total_bayar">Total Pembayaran</label>
                    <input
                        wire:model.defer="pembayaran.total_bayar"
                        type="text"
                        id="total_bayar"
                        class="form-control @error('total_bayar') is-invalid @enderror"
                        placeholder="Rp. 2.000.000"
                    />
                    <x-input-error :for="'total_bayar'"/>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-6">
                    <label class="form-label" for="status_pembayaran">Status Pembayaran</label>
                    <select wire:model.defer="pembayaran.status_pembayaran" id="status_pembayaran" class="select2 form-select @error('status_pembayaran') is-invalid @enderror ">
                        <option value="">Pilih Status Pembayaran</option>
                        @foreach ($pageData['listStatus'] as $key => $status)
                            <option value="{{ $key }}">{{ $status}}</option>
                        @endforeach
                    </select>
                    <x-input-error :for="'status_pembayaran'"/>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="keterangan">Keterangan</label>
                    <textarea class="form-control @error('total_bayar') is-invalid @enderror" wire:model.defer="pembayaran.keterangan" id="keterangan" rows="2"></textarea>
                    <x-input-error :for="'keterangan'"/>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="d-flex flex-wrap gap-2">
                <x-button type="submit" class="btn-primary" wire:loading.attr="disabled">
                    <x-loading-button :target="'prosesPembayaran'"/>
                    Simpan
                </x-button>
                <button type="button" wire:click.prevent="cetakBukti" class="btn btn-success" wire:loading.attr="disabled">
                    <x-loading-button :target="'cetakBukti'"/>
                    Simpan & Cetak Bukti
                </button>
                <x-button type="reset" class="btn-outline-secondary" data-bs-dismiss="modal">Batal</x-button>
            </div>
        </div>
    </form>
</x-modal>
