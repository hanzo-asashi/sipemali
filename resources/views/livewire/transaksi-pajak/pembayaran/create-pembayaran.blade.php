<div>
    @section('title') Pembayaran Pajak @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Pembayaran Pajak</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
            <div class="row">
{{--                <div class="col-md-12 mb-3">--}}
{{--                    <a href="{{ route('wajib-pajak.index') }}" class="btn btn-outline-light btn-label waves-effect waves-light">--}}
{{--                        <i class="bx label-icon bx-chevron-left"></i>--}}
{{--                        Kembali ke--}}
{{--                    </a>--}}
{{--                </div>--}}
                <form wire:submit.prevent="submit">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <div class="card-title mb-0 flex-grow-1">
                                        <h5>PEMBAYARAN</h5>
                                        <p class="card-title-desc">Formulir Pembayaran Objek Pajak</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="d-flex flex-wrap gap-2 mb-0 my-n1">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-primary btn-label waves-effect waves-light">
                                                    <i class="bx label-icon bx-save"></i>
                                                    Simpan Pembayaran
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="wajib_pajak_id" class="form-label">Wajib Pajak</label>
                                                <select wire:model.lazy="wajib_pajak_id" id="jenis_wp"
                                                        class="form-control @error('wajib_pajak_id') is-invalid @enderror select2-jeniswp"
                                                        placeholder="Pilih Wajib Pajak"
                                                >
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
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="objek_pajak_id" class="form-label">Objek Pajak</label>
                                                    <select wire:model.lazy="objek_pajak_id" id="jenis_wp" class="form-control @error('objek_pajak_id') is-invalid @enderror
                                                        select2-jeniswp"
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

                                    <div class="row mb-3">
                                        <h5 class="font-size-14 text-primary mb-3 mt-3 border-light pt-4" style="border-top: 1px solid;">
                                            <i class="mdi mdi-arrow-right me-1"></i> Detail Pembayaran
                                        </h5>
                                        <div class="col-lg-4">
                                            <label class="form-label">No. Transaksi</label>
                                            <input wire:model.lazy="no_transaksi" type="text"
                                                   class="form-control" readonly="readonly" disabled>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="" class="form-label">Tahun</label>
{{--                                            <div wire:ignore>--}}
                                                <select wire:model.lazy="tahun" @error('tahun') is-invalid @enderror class="form-select">
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                </select>
{{--                                            </div>--}}
                                            @error('tahun')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-lg-3">
                                            <label for="metode_bayar" class="form-label">Metode Bayar</label>
{{--                                            <div wire:ignore>--}}
                                                <select wire:model.lazy="metode_bayar" class="form-select" id="metode_bayar">
                                                    <option>Pilih salah satu</option>
                                                    @foreach($listMetodeBayar as $key => $value)
                                                        <option wire:key="metode-{{ $key }}" value="{{ $key }}"> {{ $value }}</option>
                                                    @endforeach
                                                </select>
{{--                                            </div>--}}
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="bulan" class="form-label">Bulan (Masa Pajak)</label>
                                            <select id="bulan" wire:model.lazy="bulan" @error('bulan') is-invalid @enderror class="form-select">
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

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="nilai_pajak" class="form-label">Nilai Pajak</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input wire:model.lazy="nilai_pajak"
                                                       type="text" class="form-control @error('nilai_pajak') is-invalid @enderror"
                                                       placeholder="" id="nilai_pajak">
                                                @error('nilai_pajak')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="sisa" class="form-label">Sisah / Lebih</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input wire:model.lazy="sisa" type="text" class="form-control" id="sisa" placeholder="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="status_bayar" class="form-label">Status</label>
                                            <select wire:model.lazy="status_bayar" @error('status_bayar') is-invalid @enderror id="status_bayar" class="form-select">
                                                <option>Pilih salah satu</option>
                                                @foreach(config('custom.status_bayar') as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_bayar')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-8">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <textarea wire:model.lazy="keterangan" id="keterangan" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
                                        <div></div>
                                        <button type="submit" class="btn btn-primary btn-label waves-effect waves-light">
                                            <i class="bx label-icon bx-save"></i>
                                            Simpan Pembayaran
                                        </button>
                                    </div>
                                </div>

                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
{{--                        <div class="col-lg-2">--}}
{{--                            <div class="d-grid">--}}
{{--                                <a href="{{ route('wajib-pajak.index') }}" class="btn btn-label btn-primary waves-effect waves-light">--}}
{{--                                    <i class="bx bx-plus label-icon"></i>--}}
{{--                                    Simpan Pembayaran--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('script')
        @include('widget.alertify')
        @include('widget.action-js')
    @endpush
</div>
