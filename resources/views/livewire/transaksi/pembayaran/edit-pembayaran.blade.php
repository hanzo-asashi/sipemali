<div>
    @section('title', $title)
    @push('vendor-style')
    @endpush

    @push('page-style')
        {{-- Page Css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-faq.css')) }}">
    @endpush

    <div class="row mb-1">
        <div class="col-md-6">
            <a href="{{ route('transaksi.pembayaran.list') }}" class=""><i class="fa fa-arrow-alt-circle-left"></i> Kembali ke list pembayaran</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form wire:submit.prevent="updatePembayaran">
                   <div class="card-body">
                       <div class="row">
                           <div class="row mb-1">
                               <div class="col-md-7">
                                   <label class="form-label" for="select2-dropdown">Pelanggan</label>
                                   {{--                                        <input readonly name="pembayaran.customer_id" value="{{ $this->customers->nama_pelanggan }}" class="form-control">--}}
                                   <x-tom-select x-cloak
                                                 id="customer_id"
                                                 name="customer_id"
                                                 wire:model="pembayaran.customer_id"
                                                 :options="$pageData['listPelanggan']"
                                                 :selected-items="$this->customers->id"
                                                 placeholder="Pilih Pelanggan"
                                                 class="form-select"
                                                 autocomplete="off" disabled=""
                                   />
                                   {{--                                        <div wire:ignore class="input-group">--}}
                                   {{--                                            <x-select2 wire:model="pembayaran.customer_id" class="@error('periode') is-invalid @enderror" readonly>--}}
                                   {{--                                                @foreach($pageData['listPelanggan'] as $key => $item)--}}
                                   {{--                                                    <option value="{{ $key }}">{{ $item }}</option>--}}
                                   {{--                                                @endforeach--}}
                                   {{--                                            </x-select2>--}}
                                   {{--                                        </div>--}}
                                   {{--                                        <x-jet-input-error :for="'customer_id'">--}}
                                   {{--                                            <x-slot name="message">--}}
                                   {{--                                                {{ $message ?? '' }}--}}
                                   {{--                                            </x-slot>--}}
                                   {{--                                        </x-jet-input-error>--}}
                               </div>
                               <div class="col-md-2">
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
                                   <input tabindex="-1"
                                          wire:model.defer="pembayaran.pemakaian_air_saat_ini"
                                          type="number"
                                          id="pemakaian_air_saat_ini"
                                          class="form-control @error('pemakaian_air_saat_ini') is-invalid @enderror"
                                          readonly
                                   />
                                   @error('pemakaian_saat_ini')
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
                                   @error('total_tagihan')
                                   <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                   @enderror
                               </div>
                               <div class="col-md-6">
                                   <label class="form-label" for="total_bayar">Total Pembayaran</label>
                                   <input
                                       wire:model.lazy="pembayaran.total_bayar"
                                       type="text"
                                       id="total_bayar"
                                       class="form-control @error('total_bayar') is-invalid @enderror"
                                       placeholder="Rp. 2.000.000"
                                   />
                                   @error('total_bayar')
                                   <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                   @enderror
                               </div>
                           </div>
                           <div class="row mb-1">
                               <div class="col-md-3">
                                   <label class="form-label" for="status_pembayaran">Status Pembayaran</label>
                                   <select wire:model.defer="pembayaran.status_pembayaran" id="status_pembayaran"
                                           class="select2 form-select @error('status_pembayaran') is-invalid @enderror ">
                                       <option value="">Pilih Status Pembayaran</option>
                                       @foreach ($pageData['listStatus'] as $key => $status)
                                           <option value="{{ $key }}">{{ $status}}</option>
                                       @endforeach
                                   </select>
                                   @error('status_pembayaran')
                                   <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                   @enderror
                               </div>
                               <div class="col-md-9">
                                   <div class="mb-1">
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
                           </div>
                       </div>
                   </div>
                    <div class="card-footer py-1 px-1">
                        <div class="d-flex gap-1 justify-content-end align-items-center">
                            <button wire:loading.attr="disabled" type="submit" class="btn btn-primary waves-effect waves-float waves-light">
                                                        <span wire:loading.delay.shorter wire:target="updatePembayaran" class="spinner-border spinner-border-sm" role="status"
                                                              aria-hidden="true"></span>
                                <i class="far fa-save me-1"></i>Ubah
                            </button>
                            <button wire:loading.attr="disabled" type="button" wire:click.prevent="simpanDanKembali"
                                    class="btn btn-info waves-effect waves-float waves-light">
                                                        <span wire:loading.delay.shorter wire:target="simpanDanKembali" class="spinner-border spinner-border-sm" role="status"
                                                              aria-hidden="true"></span>
                                <i class="far fa-backspace me-1"></i> Simpan & Kembali
                            </button>
{{--                            <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Update</button>--}}
{{--                            <button type="button" wire:click.prevent="simpanDanKembali" class="btn btn-info me-1 waves-effect waves-float waves-light">Simpan &--}}
{{--                                Kembali--}}
{{--                            </button>--}}
                        </div>

                    </div>
                    <x-honeypot livewire-model="extraFields" />
                </form>
            </div>
        </div>
    </div>
{{--    <section id="faq-tabs">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-6">--}}
{{--                <a href="{{ route('transaksi.pembayaran.list') }}" class=""><i class="fa fa-arrow-alt-circle-left"></i> Kembali ke list pembayaran</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- vertical tab pill -->--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                <div class="faq-navigation d-flex justify-content-between flex-column mb-2 mb-md-0">--}}
{{--                    <img style="width: 700px; height: 700px;"--}}
{{--                         src="{{asset('images/illustration/create-account.svg')}}"--}}
{{--                         class="img-fluid d-none d-md-block"--}}
{{--                         alt="demand img"--}}
{{--                    />--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 col-md-8 col-sm-12">--}}
{{--                <!-- pill tabs tab content -->--}}
{{--                <div class="card">--}}
{{--                    --}}{{--                    <div class="card-header">--}}
{{--                    --}}{{--                        <h4>Test</h4>--}}
{{--                    --}}{{--                        <p class="text-sm text-muted">sfsdf</p>--}}
{{--                    --}}{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <form wire:submit.prevent="updatePembayaran">--}}
{{--                            <div class="row">--}}
{{--                                <div class="row mb-1">--}}
{{--                                    <div class="col-md-7">--}}
{{--                                        <label class="form-label" for="select2-dropdown">Pelanggan</label>--}}
{{--                                        <input readonly name="pembayaran.customer_id" value="{{ $this->customers->nama_pelanggan }}" class="form-control">--}}
{{--                                        <x-tom-select x-cloak--}}
{{--                                                      id="customer_id"--}}
{{--                                                      name="customer_id"--}}
{{--                                                      wire:model="pembayaran.customer_id"--}}
{{--                                                      :options="$pageData['listPelanggan']"--}}
{{--                                                      :selected-items="$this->customers->id"--}}
{{--                                                      placeholder="Pilih Pelanggan"--}}
{{--                                                      class="form-select"--}}
{{--                                                      autocomplete="off" disabled=""--}}
{{--                                        />--}}
{{--                                        <div wire:ignore class="input-group">--}}
{{--                                            <x-select2 wire:model="pembayaran.customer_id" class="@error('periode') is-invalid @enderror" readonly>--}}
{{--                                                @foreach($pageData['listPelanggan'] as $key => $item)--}}
{{--                                                    <option value="{{ $key }}">{{ $item }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </x-select2>--}}
{{--                                        </div>--}}
{{--                                        <x-jet-input-error :for="'customer_id'">--}}
{{--                                            <x-slot name="message">--}}
{{--                                                {{ $message ?? '' }}--}}
{{--                                            </x-slot>--}}
{{--                                        </x-jet-input-error>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-2">--}}
{{--                                        <label class="form-label" for="fp-date">Bulan Berjalan</label>--}}
{{--                                        <select wire:model.defer="pembayaran.bulan_berjalan" class="form-select">--}}
{{--                                            <option value="">Pilih Bulan</option>--}}
{{--                                            @foreach($pageData['listBulan'] as $key => $bln)--}}
{{--                                                <option value="{{ $key }}">{{ $bln }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}

{{--                                        @error('periode')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <label class="form-label" for="fp-date">Tahun Berjalan</label>--}}
{{--                                        <select wire:model.defer="pembayaran.tahun_berjalan" class="form-select">--}}
{{--                                            <option value="">Pilih Tahun</option>--}}
{{--                                            @foreach($pageData['listTahun'] as $key => $thn)--}}
{{--                                                <option value="{{ $key }}">{{ $thn }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}

{{--                                        @error('periode')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row mb-1">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label class="form-label" for="stand_awal">Meter Awal (m3)</label>--}}
{{--                                        <span wire:loading.delay wire:target="pembayaran.stand_awal" class="spinner-border spinner-border-sm text-end"--}}
{{--                                              role="status"--}}
{{--                                              aria-hidden="true"></span>--}}
{{--                                        <input wire:loading.attr="disabled"--}}
{{--                                               wire:model.defer="pembayaran.stand_awal"--}}
{{--                                               type="number"--}}
{{--                                               id="stand_awal"--}}
{{--                                               class="form-control @error('stand_awal') is-invalid @enderror"--}}
{{--                                        />--}}
{{--                                        @error('stand_awal')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label class="form-label" for="stand_akhir">Meter Akhir (m3)</label>--}}
{{--                                        <input--}}
{{--                                            wire:model.lazy="pembayaran.stand_akhir"--}}
{{--                                            type="number"--}}
{{--                                            id="stand_akhir"--}}
{{--                                            class="form-control @error('stand_akhir') is-invalid @enderror"--}}
{{--                                        />--}}
{{--                                        @error('stand_akhir')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row mb-1">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label class="form-label" for="pemakaian_air_saat_ini">Jumlah Pemakaian Air Saat Ini (m3)</label>--}}
{{--                                        <input tabindex="-1"--}}
{{--                                            wire:model.defer="pembayaran.pemakaian_air_saat_ini"--}}
{{--                                            type="number"--}}
{{--                                            id="pemakaian_air_saat_ini"--}}
{{--                                            class="form-control @error('pemakaian_air_saat_ini') is-invalid @enderror"--}}
{{--                                            readonly--}}
{{--                                        />--}}
{{--                                        @error('pemakaian_saat_ini')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label class="form-label" for="harga_air">Harga Air</label>--}}
{{--                                        <input tabindex="-1"--}}
{{--                                            wire:model.defer="pembayaran.harga_air"--}}
{{--                                            type="text"--}}
{{--                                            id="harga_air"--}}
{{--                                            class="form-control @error('harga_air') is-invalid @enderror" readonly--}}
{{--                                        />--}}
{{--                                        @error('harga_air')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row mb-1">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label class="form-label" for="dana_meter">Dana Meter</label>--}}
{{--                                        <input tabindex="-1"--}}
{{--                                            wire:model.defer="pembayaran.dana_meter"--}}
{{--                                            type="text"--}}
{{--                                            id="dana_meter"--}}
{{--                                            class="form-control @error('dana_meter') is-invalid @enderror"--}}
{{--                                            placeholder="Rp. 5.000" readonly--}}
{{--                                        />--}}
{{--                                        @error('dana_meter')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label class="form-label" for="biaya_layanan">Biaya Layanan</label>--}}
{{--                                        <input tabindex="-1"--}}
{{--                                            wire:model.defer="pembayaran.biaya_layanan"--}}
{{--                                            type="text"--}}
{{--                                            id="biaya_layanan"--}}
{{--                                            class="form-control @error('biaya_layanan') is-invalid @enderror"--}}
{{--                                            placeholder="Rp. 2.000" readonly--}}
{{--                                        />--}}
{{--                                        @error('biaya_layanan')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row mb-1">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label class="form-label" for="total_tagihan">Total Tagihan</label>--}}
{{--                                        <input tabindex="-1"--}}
{{--                                            wire:model.defer="pembayaran.total_tagihan"--}}
{{--                                            type="number"--}}
{{--                                            id="total_tagihan"--}}
{{--                                            class="form-control @error('total_tagihan') is-invalid @enderror"--}}
{{--                                            placeholder="Rp. 1.000.000" readonly--}}
{{--                                        />--}}
{{--                                        @error('total_tagihan')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label class="form-label" for="total_bayar">Total Pembayaran</label>--}}
{{--                                        <input--}}
{{--                                            wire:model.lazy="pembayaran.total_bayar"--}}
{{--                                            type="text"--}}
{{--                                            id="total_bayar"--}}
{{--                                            class="form-control @error('total_bayar') is-invalid @enderror"--}}
{{--                                            placeholder="Rp. 2.000.000"--}}
{{--                                        />--}}
{{--                                        @error('total_bayar')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row mb-1">--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <label class="form-label" for="status_pembayaran">Status Pembayaran</label>--}}
{{--                                        <select wire:model.defer="pembayaran.status_pembayaran" id="status_pembayaran"--}}
{{--                                                class="select2 form-select @error('status_pembayaran') is-invalid @enderror ">--}}
{{--                                            <option value="">Pilih Status Pembayaran</option>--}}
{{--                                            @foreach ($pageData['listStatus'] as $key => $status)--}}
{{--                                                <option value="{{ $key }}">{{ $status}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        @error('status_pembayaran')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-9">--}}
{{--                                        <div class="mb-1">--}}
{{--                                            <label class="form-label" for="keterangan">Keterangan</label>--}}
{{--                                            <textarea class="form-control @error('keterangan') is-invalid @enderror" wire:model.defer="pembayaran.keterangan" id="keterangan"--}}
{{--                                                      rows="2"></textarea>--}}
{{--                                            @error('keterangan')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-sm-9 offset-sm-3">--}}
{{--                                    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Update</button>--}}
{{--                                    <button type="button" wire:click.prevent="simpanDanKembali" class="btn btn-info me-1 waves-effect waves-float waves-light">Simpan &--}}
{{--                                        Kembali--}}
{{--                                    </button>--}}
{{--                                    <button type="reset" wire:click.prevent="resetForms" class="btn btn-outline-secondary waves-effect">Batal</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <x-honeypot livewire-model="extraFields" />--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    @push('page-script')
        <script>
            /* Clear selection pelanggan */
            window.addEventListener('clearPelanggan', event => {
                $('#{{ $select2DropdownId }}').empty();
            });
            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                return $(
                    '<span>' + state.text + '</span>'
                );
            }

            $(document).ready(function () {
                let options = {
                    // formatResult: formatState,
                    // formatSelection: formatState,
                    // templateResult: formatState,
                    placeholder: "Pilih PelangganResource",
                    selectOnClose: true,
                };
                $('#{{ $select2DropdownId }}').select2(options);
                $('#{{ $select2DropdownId }}').on('change', function (e) {
                    let selected = $('#{{ $select2DropdownId }}').val();
                    @this.set('selectedPelanggan', selected);
                });
            });
        </script>
    @endpush
</div>
