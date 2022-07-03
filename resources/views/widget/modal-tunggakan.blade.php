<div wire:ignore.self class="modal fade" id="modal-detail-tunggakan" tabindex="-1" aria-labelledby="modalDetailTunggakan" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailTunggakan">
                    Transaksi Tunggakan Pajak Daerah
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="prosesTunggakan">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div>
                                    <label for="no_transaksi" class="form-label">No Transaksi</label>
                                    <input wire:model.lazy="no_transaksi"
                                           type="text" class="form-control @error('no_transaksi') is-invalid @enderror"
                                           placeholder="" id="no_transaksi">
                                    @error('no_transaksi')
                                    <span class="invalid-feedback"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div>
                                    <label for="tgl_bayar" class="form-label">Tgl Bayar</label>
                                    <x-inputs.date wire:model="tgl_bayar"></x-inputs.date>
                                    @error('tgl_bayar')
                                    <span class="invalid-feedback"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div>
                                    <label for="tgl_jatuh_tempo" class="form-label">Tgl Jatuh Tempo</label>
                                    <x-inputs.date wire:model="tgl_jatuh_tempo"></x-inputs.date>
                                    @error('tgl_jatuh_tempo')
                                    <span class="invalid-feedback"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div>
                                    <label for="pembayaran_id" class="form-label">Lama Tunggakan</label>
                                    <input wire:model.lazy="lama_tunggakan"
                                           type="number" class="form-control @error('lama_tunggakan') is-invalid @enderror"
                                           placeholder="" id="lama_tunggakan" disabled>
                                    @error('lama_tunggakan')
                                    <span class="invalid-feedback"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div><hr>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="jumlah_tagihan" class="form-label">Jumlah Tagihan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input wire:model.lazy="jumlah_tagihan"
                                       type="text" class="form-control @error('jumlah_tagihan') is-invalid @enderror"
                                       placeholder="" id="jumlah_tagihan" disabled>
                                @error('jumlah_tagihan')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input wire:model.lazy="jumlah_bayar" type="text" id="jumlah_bayar"
                                       class="form-control @error('jumlah_bayar') is-invalid @enderror" placeholder="">
                                @error('jumlah_bayar')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="sisa_bayar" class="form-label">Sisah / Lebih</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input wire:model.lazy="sisa_bayar" type="text" class="form-control" id="sisa_bayar" placeholder="" disabled>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="denda" class="form-label">Denda Tunggakan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input wire:model.lazy="denda" type="text" class="form-control" id="denda" placeholder="" disabled>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="total_tagihan" class="form-label">Total Tagihan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input wire:model.lazy="total_tagihan" type="text" class="form-control" id="total_tagihan" placeholder="" disabled>
                            </div>
                        </div>
{{--                        <div class="mb-5 col-md-4">--}}
{{--                            <label for="status_tunggakan" class="form-label">Status</label>--}}
{{--                            <select wire:model.lazy="status_tunggakan" id="status_tunggakan" class="form-select">--}}
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
                    </div>
                    <hr>
                    <div class="mt-1 text-end">
{{--                        <button type="submit" @if(!$lockButton) disabled @endif class="btn btn-success">Simpan</button>--}}
                        <button type="submit" class="btn btn-success">Bayar Tunggakan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
