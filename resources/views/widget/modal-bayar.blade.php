<div class="modal fade" id="modal-detail-bayar" tabindex="-1" aria-labelledby="modalDetailBayar" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailBayar">
                    Transaksi Pembayaran Pajak Daerah
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div>
                                <label for="wajib_pajak_id" class="form-label">Wajib Pajak</label>
                                <select wire:model.lazy="state.wajib_pajak_id" id="wajib_pajak_id"
                                        @if($updateMode) disabled @endif
                                        class="form-control @error('wajib_pajak_id') is-invalid @enderror"
                                        placeholder="Pilih Wajib Pajak">
                                    <option selected>Pilih Wajib Pajak</option>
                                    @foreach($listWajibPajak as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                                @error('wajib_pajak_id')
                                <span class="invalid-feedback"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if(!is_null($wajib_pajak_id))
                            <div class="col-lg-6">
                                <div>
                                    <label for="objek_pajak_id" class="form-label">Objek Pajak</label>
                                    <select wire:model.lazy="state.objek_pajak_id" id="objek_pajak_id"
                                            @if($updateMode) disabled @endif
                                            class="form-control @error('objek_pajak_id') is-invalid @enderror"
                                            placeholder="Pilih Objek Pajak">
                                        <option selected>Pilih Objek Pajak</option>
                                        @foreach($listObjekPajak as $key => $val)
                                            <option value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    @error('objek_pajak_id')
                                    <span class="invalid-feedback"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label for="metode_bayar" class="form-label">Metode Bayar</label>
                            <div wire:ignore>
                                <select wire:model.lazy="state.metode_bayar" class="form-select" id="metode_bayar">
                                    <option>Pilih salah satu</option>
                                    @foreach($listMetodeBayar as $key => $value)
                                        <option wire:key="metode-{{ $key }}" value="{{ $key }}"> {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-2">
                            <label for="" class="form-label">Tahun</label>
                            <div wire:ignore>
                                <select wire:model.lazy="state.tahun" @error('tahun') is-invalid @enderror class="form-select">
                                    <option>Pilih tahun</option>
                                    @foreach(config('custom.tahun_kontrak') as $key => $thn)
                                        <option value="{{ $key }}">{{ $thn }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('tahun')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="bulan" class="form-label">Bulan (Masa Pajak)</label>
                            <select id="bulan" wire:model.lazy="state.bulan" @error('bulan') is-invalid @enderror class="form-select">
                                <option>Pilih Bulan</option>
                                @foreach($listBulan as $key => $bulan)
                                    <option value="{{ $key }}">{{ $bulan }}</option>
                                @endforeach
                            </select>
                            @error('bulan')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="nilai_pajak" class="form-label">Jumlah Yang Harus Dibayar</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input wire:model.lazy="state.nilai_pajak"
                                       type="text" class="form-control @error('nilai_pajak') is-invalid @enderror"
                                       placeholder="" id="nilai_pajak">
                                @error('nilai_pajak')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input wire:model.lazy="state.jumlah_bayar" type="text" id="jumlah_bayar"
                                       class="form-control @error('jumlah_bayar') is-invalid @enderror" placeholder="">
                                @error('jumlah_bayar')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="sisa" class="form-label">Sisa / Lebih</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input wire:model.lazy="state.sisa" type="text" class="form-control" id="sisa" placeholder="" disabled>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-5 col-md-4">
                            <label for="status_bayar" class="form-label">Status</label>
                            <select wire:model.lazy="state.status_bayar" id="status_bayar" class="form-select">
                                <option>Pilih salah satu</option>
                                @foreach(config('custom.status_bayar') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea wire:model.lazy="state.keterangan" id="keterangan" class="form-control"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-1">
                        {{--                        <button type="submit" @if(!$lockButton) disabled @endif class="btn btn-success">Simpan</button>--}}
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--<div class="modal fade" id="modal-detail-bayar" tabindex="-1" aria-labelledby="modalDetailBayar" aria-hidden="true" wire:ignore.self>--}}
{{--    <div class="modal-dialog modal-lg">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="modalDetailBayar">--}}
{{--                    Transaksi Pembayaran Pajak Daerah--}}
{{--                </h5>--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <form wire:submit.prevent="submit">--}}
{{--                    <div class="row mb-3">--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <div>--}}
{{--                                <label for="wajib_pajak_id" class="form-label">Wajib Pajak</label>--}}
{{--                                <select wire:model.lazy="wajib_pajak_id" id="wajib_pajak_id"--}}
{{--                                        @if($updateMode) disabled @endif--}}
{{--                                        class="form-control @error('wajib_pajak_id') is-invalid @enderror"--}}
{{--                                        placeholder="Pilih Wajib Pajak">--}}
{{--                                    <option selected>Pilih Wajib Pajak</option>--}}
{{--                                    @foreach($listWajibPajak as $key => $val)--}}
{{--                                        <option value="{{ $key }}">{{ $val }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('wajib_pajak_id')--}}
{{--                                <span class="invalid-feedback"> {{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @if(!is_null($wajib_pajak_id))--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <div>--}}
{{--                                    <label for="objek_pajak_id" class="form-label">Objek Pajak</label>--}}
{{--                                    <select wire:model.lazy="objek_pajak_id" id="objek_pajak_id"--}}
{{--                                            @if($updateMode) disabled @endif--}}
{{--                                            class="form-control @error('objek_pajak_id') is-invalid @enderror"--}}
{{--                                            placeholder="Pilih Objek Pajak">--}}
{{--                                        <option selected>Pilih Objek Pajak</option>--}}
{{--                                        @foreach($listObjekPajak as $key => $val)--}}
{{--                                            <option value="{{ $key }}">{{ $val }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @error('objek_pajak_id')--}}
{{--                                    <span class="invalid-feedback"> {{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <hr>--}}
{{--                    <div class="row">--}}
{{--                        <div class="mb-3 col-md-3">--}}
{{--                            <label for="metode_bayar" class="form-label">Metode Bayar</label>--}}
{{--                            <div wire:ignore>--}}
{{--                                <select wire:model.lazy="metode_bayar" class="form-select" id="metode_bayar">--}}
{{--                                    <option>Pilih salah satu</option>--}}
{{--                                    @foreach($listMetodeBayar as $key => $value)--}}
{{--                                        <option wire:key="metode-{{ $key }}" value="{{ $key }}"> {{ $value }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3 col-md-2">--}}
{{--                            <label for="" class="form-label">Tahun</label>--}}
{{--                            <div wire:ignore>--}}
{{--                                <select wire:model.lazy="tahun" @error('tahun') is-invalid @enderror class="form-select">--}}
{{--                                    <option>Pilih tahun</option>--}}
{{--                                    @foreach(config('custom.tahun_kontrak') as $key => $thn)--}}
{{--                                        <option value="{{ $key }}">{{ $thn }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            @error('tahun')--}}
{{--                            <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="mb-3 col-md-3">--}}
{{--                            <label for="bulan" class="form-label">Bulan (Masa Pajak)</label>--}}
{{--                            <select id="bulan" wire:model.lazy="bulan" @error('bulan') is-invalid @enderror class="form-select">--}}
{{--                                <option>Pilih Bulan</option>--}}
{{--                                @foreach($listBulan as $key => $bulan)--}}
{{--                                    <option value="{{ $key }}">{{ $bulan }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('bulan')--}}
{{--                            <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <hr>--}}
{{--                    <div class="row">--}}
{{--                        <div class="mb-3 col-md-4">--}}
{{--                            <label for="nilai_pajak" class="form-label">Jumlah Yang Harus Dibayar</label>--}}
{{--                            <div class="input-group">--}}
{{--                                <span class="input-group-text">Rp.</span>--}}
{{--                                <input wire:model.lazy="nilai_pajak"--}}
{{--                                       type="text" class="form-control @error('nilai_pajak') is-invalid @enderror"--}}
{{--                                       placeholder="" id="nilai_pajak">--}}
{{--                                @error('nilai_pajak')--}}
{{--                                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3 col-md-4">--}}
{{--                            <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>--}}
{{--                            <div class="input-group">--}}
{{--                                <span class="input-group-text">Rp.</span>--}}
{{--                                <input wire:model.lazy="jumlah_bayar" type="text" id="jumlah_bayar"--}}
{{--                                       class="form-control @error('jumlah_bayar') is-invalid @enderror" placeholder="">--}}
{{--                                @error('jumlah_bayar')--}}
{{--                                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3 col-md-4">--}}
{{--                            <label for="sisa" class="form-label">Sisa / Lebih</label>--}}
{{--                            <div class="input-group">--}}
{{--                                <span class="input-group-text">Rp.</span>--}}
{{--                                <input wire:model.lazy="sisa" type="text" class="form-control" id="sisa" placeholder="" disabled>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <hr>--}}
{{--                    <div class="row">--}}
{{--                        <div class="mb-5 col-md-4">--}}
{{--                            <label for="status_bayar" class="form-label">Status</label>--}}
{{--                            <select wire:model.lazy="status_bayar" id="status_bayar" class="form-select">--}}
{{--                                <option>Pilih salah satu</option>--}}
{{--                                @foreach(config('custom.status_bayar') as $key => $value)--}}
{{--                                    <option value="{{ $key }}">{{ $value }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3 col-md-8">--}}
{{--                            <label for="keterangan" class="form-label">Keterangan</label>--}}
{{--                            <textarea wire:model.lazy="keterangan" id="keterangan" class="form-control"></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <hr>--}}
{{--                    <div class="mt-1">--}}
{{--                        --}}{{--                        <button type="submit" @if(!$lockButton) disabled @endif class="btn btn-success">Simpan</button>--}}
{{--                        <button type="submit" class="btn btn-success">Simpan</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
