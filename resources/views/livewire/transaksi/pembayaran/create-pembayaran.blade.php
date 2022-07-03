<div>
    @section('title', $title)
    @push('vendor-style')
    @endpush

    @push('page-style')
    @endpush

    <div class="row mb-1">
        <div class="col-md-6">
            <a href="{{ route('transaksi.pembayaran.list') }}" class=""><i class="fa fa-arrow-alt-circle-left"></i> Kembali ke list pembayaran</a>
        </div>
    </div>

    {{--    <div class="row">--}}
    {{--        <div class="col-md-8">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-body">--}}
    {{--                    --}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="col-md-4">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-body">--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form wire:submit.prevent="storePembayaran">
                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <div class="clearfix">
                                    <label class="form-label" for="select2-dropdown">
                                        Pelanggan
                                    </label>
                                    <div wire:loading.delay.shorter wire:target="pembayaran.customer_id" class="spinner-border spinner-border-sm float-end" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <x-tom-select
                                              id="customer_id"
                                              name="customer_id"
                                              wire:model="pembayaran.customer_id"
                                              :selected-items="$selectedItems"
                                              :options="$pageData['listPelanggan']"
                                              placeholder="Pilih Pelanggan"
                                              class="form-select"
                                              autocomplete="off"
                                />
                                <x-jet-input-error :for="'customer_id'"/>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="fp-date">Bulan Berjalan</label>
                                <select wire:model.defer="pembayaran.bulan_berjalan" class="form-select">
                                    <option value="">Pilih Bulan</option>
                                    @foreach($pageData['listBulan'] as $key => $bln)
                                        <option value="{{ $key }}">{{ $bln }}</option>
                                    @endforeach
                                </select>

                                @error('periode')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="fp-date">Tahun Berjalan</label>
                                <select wire:model.defer="pembayaran.tahun_berjalan" class="form-select">
                                    <option value="">Pilih Tahun</option>
                                    @foreach($pageData['listTahun'] as $key => $thn)
                                        <option value="{{ $key }}">{{ $thn }}</option>
                                    @endforeach
                                </select>

                                @error('periode')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label class="form-label" for="stand_awal">Meter Awal (m3)</label>
                                <span wire:loading.delay wire:target="pembayaran.stand_awal" class="spinner-border spinner-border-sm text-end"
                                      role="status"
                                      aria-hidden="true"></span>
                                <input wire:loading.attr="disabled"
                                       wire:model.defer="pembayaran.stand_awal"
                                       type="number"
                                       id="stand_awal"
                                       class="form-control @error('stand_awal') is-invalid @enderror"
                                       placeholder="1988"
                                />
                                @error('stand_awal')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="stand_akhir">Meter Akhir (m3)</label>
                                <input
                                    wire:model.lazy="pembayaran.stand_akhir"
                                    type="number"
                                    id="stand_akhir"
                                    class="form-control @error('stand_akhir') is-invalid @enderror"
                                    placeholder="1978"
                                />
                                @error('stand_akhir')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label class="form-label" for="pemakaian_air_saat_ini">Jumlah Pemakaian Air Saat Ini (m3)</label>
                                <span wire:loading.delay wire:target="pembayaran.pemakaian_air_saat_ini" class="spinner-border spinner-border-sm text-end"
                                      role="status"
                                      aria-hidden="true"></span>
                                <input wire:loading.attr="disabled" tabindex="-1"
                                       wire:model.lazy="pembayaran.pemakaian_air_saat_ini"
                                       type="number"
                                       id="pemakaian_air_saat_ini"
                                       class="form-control @error('pemakaian_air_saat_ini') is-invalid @enderror"
                                       placeholder="10"
                                />
                                @error('pemakaian_air_saat_ini')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="harga_air">Harga Air</label>
                                <input tabindex="-1"
                                       wire:model.defer="pembayaran.harga_air"
                                       type="text"
                                       id="harga_air"
                                       class="form-control @error('harga_air') is-invalid @enderror" readonly
                                />
                                @error('harga_air')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
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
                                @error('dana_meter')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
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
                                @error('biaya_layanan')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
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
                                <x-jet-input-error :for="'total_tagihan'"/>
                                {{--                                        @error('total_tagihan')--}}
                                {{--                                        <span class="invalid-feedback" role="alert">--}}
                                {{--                                            <strong>{{ $message }}</strong>--}}
                                {{--                                        </span>--}}
                                {{--                                        @enderror--}}
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
                                <x-jet-input-error :for="'total_bayar'"/>
                                {{--                                        @error('total_bayar')--}}
                                {{--                                        <span class="invalid-feedback" role="alert">--}}
                                {{--                                            <strong>{{ $message }}</strong>--}}
                                {{--                                        </span>--}}
                                {{--                                        @enderror--}}
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label class="form-label" for="status_pembayaran">Status Pembayaran</label>
                                <select wire:model.defer="pembayaran.status_pembayaran" id="status_pembayaran"
                                        class="select2 form-select @error('status_pembayaran') is-invalid @enderror ">
                                    <option value="">Pilih Status Pembayaran</option>
                                    @foreach ($pageData['listStatus'] as $key => $status)
                                        <option value="{{ $key }}">{{ $status}}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error :for="'status_pembayaran'"/>
                                {{--                                        @error('status_pembayaran')--}}
                                {{--                                        <span class="invalid-feedback" role="alert">--}}
                                {{--                                                <strong>{{ $message }}</strong>--}}
                                {{--                                            </span>--}}
                                {{--                                        @enderror--}}
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="status_pembayaran">Metode Pembayaran</label>
                                <select wire:model.defer="pembayaran.metode_bayar" id="metode_bayar"
                                        class="select2 form-select @error('metode_bayar') is-invalid @enderror ">
                                    <option value="">Pilih Metode Bayar</option>
                                    @foreach ($pageData['listMetode'] as $key => $metode)
                                        <option value="{{ $key }}">{{ $metode}}</option>
                                    @endforeach
                                </select>
                                @error('metode_bayar')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" wire:model.defer="pembayaran.keterangan" id="keterangan"
                                          rows="2"></textarea>
                                @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                        </div>
{{--                        <hr>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="d-inline-flex gap-1">--}}
{{--                                    <button wire:loading.attr="disabled" type="submit" class="btn btn-primary waves-effect waves-float waves-light">--}}
{{--                                                        <span wire:loading.delay.shorter wire:target="storePembayaran" class="spinner-border spinner-border-sm" role="status"--}}
{{--                                                              aria-hidden="true"></span>--}}
{{--                                        <i class="far fa-save me-1"></i>Simpan--}}
{{--                                    </button>--}}
{{--                                    <button wire:loading.attr="disabled" type="button" wire:click.prevent="buatDanKembali"--}}
{{--                                            class="btn btn-info waves-effect waves-float waves-light">--}}
{{--                                                        <span wire:loading.delay.shorter wire:target="buatDanKembali" class="spinner-border spinner-border-sm" role="status"--}}
{{--                                                              aria-hidden="true"></span>--}}
{{--                                        <i class="far fa-backspace me-1"></i> Simpan & Kembali--}}
{{--                                    </button>--}}
{{--                                    <button wire:loading.attr="disabled" type="button" wire:click.prevent="simpanDanCetak"--}}
{{--                                            class="btn btn-outline-secondary waves-effect waves-float waves-light">--}}
{{--                                                        <span wire:loading.delay.shorter wire:target="simpanDanCetak" class="spinner-border spinner-border-sm" role="status"--}}
{{--                                                              aria-hidden="true"></span>--}}
{{--                                        <i class="far fa-print me-1"></i>Simpan & Cetak Nota--}}
{{--                                    </button>--}}
{{--                                    <button wire:loading.attr="disabled" type="reset" wire:click.prevent="resetForms"--}}
{{--                                            class="btn btn-outline-danger waves-effect">--}}
{{--                                                            <span wire:loading.delay.shorter wire:target="resetForms" class="spinner-border spinner-border-sm" role="status"--}}
{{--                                                                  aria-hidden="true"></span>--}}
{{--                                        <i class="far fa-ban me-1"></i>Batal--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="card-footer py-1 px-1">
                        <div class="d-flex gap-1 justify-content-end align-items-center">
                            <button wire:loading.attr="disabled" type="submit" class="btn btn-primary waves-effect waves-float waves-light">
                                                        <span wire:loading.delay.shorter wire:target="storePembayaran" class="spinner-border spinner-border-sm" role="status"
                                                              aria-hidden="true"></span>
                                <i class="far fa-save me-1"></i>Simpan
                            </button>
                            <button wire:loading.attr="disabled" type="button" wire:click.prevent="buatDanKembali"
                                    class="btn btn-info waves-effect waves-float waves-light">
                                                        <span wire:loading.delay.shorter wire:target="buatDanKembali" class="spinner-border spinner-border-sm" role="status"
                                                              aria-hidden="true"></span>
                                <i class="far fa-backspace me-1"></i> Simpan & Kembali
                            </button>
                            <a href="" wire:loading.attr="disabled" wire:click.prevent="simpanDanCetak" target="_blank"
                                    class="btn btn-outline-secondary waves-effect waves-float waves-light">
                                                        <span wire:loading.delay.shorter wire:target="simpanDanCetak" class="spinner-border spinner-border-sm" role="status"
                                                              aria-hidden="true"></span>
                                <i class="far fa-print me-1"></i>Simpan & Cetak Nota
                            </a>
                            <button wire:loading.attr="disabled" type="reset" wire:click.prevent="resetForms"
                                    class="btn btn-outline-danger waves-effect">
                                                            <span wire:loading.delay.shorter wire:target="resetForms" class="spinner-border spinner-border-sm" role="status"
                                                                  aria-hidden="true"></span>
                                <i class="far fa-ban me-1"></i>Batal
                            </button>
                        </div>
                    </div>
                    <x-honeypot livewire-model="extraFields" />
                </form>
            </div>
        </div>
    </div>
    @push('page-script')
        <script>
            /* Clear selection pelanggan */
            window.addEventListener('clearPelanggan', event => {
                TomSelect('#customer_id').clear();
            });
        </script>
    @endpush
</div>
