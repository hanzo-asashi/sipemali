<div>
    @push('css')
    @endpush
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-12 mb-3">
                <a href="{{ route('objek-pajak.index') }}" class="btn btn-outline-light btn-sm btn-label waves-effect waves-light">
                    <i class="bx label-icon bx-chevron-left"></i>
                    Kembali ke list objek pajak
                </a>
            </div>
            <div class="card">
                <form wire:submit.prevent="{{ !$updateMode ? 'submit' : 'updateObjPajak' }}">
                    <div class="card-header">
                        <div class="">
                            <h5>OBJEK PAJAK</h5>
                            <p class="card-title-desc">Formulir Pengisian Informasi Objek Pajak</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div wire:ignore>
                                    <label for="id_wp" class="form-label">Wajib Pajak</label>
                                    <select id="id_wp" wire:dirty.class.remove="is-invalid" wire:model="id_wp"
                                            class="form-select form-control id_wp @error('id_wp') is-invalid @enderror" data-trigger name="id_wp">
                                        <option placeholder>Pilih Wajib Pajak</option>
                                        @foreach($listWajibPajak as $key => $item)
                                            <option wire:key="{{ $key }}" value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_wp')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <h5 class="font-size-14 text-primary mb-3 mt-3 border-light pt-4" style="border-top: 1px solid;">
                                <i class="mdi mdi-arrow-right me-1"></i> Detail Objek Pajak
                            </h5>
                            <div class="col-lg-4">
                                <div>
                                    <label for="id_jenis_op" class="form-label">Jenis Objek Pajak</label>
                                    <select id="id_jenis_op" wire:dirty.class.remove="is-invalid" wire:model="id_jenis_op"
                                            class="form-select form-control @error('id_jenis_op') is-invalid @enderror"
                                    >
                                        <option value="" selected>Pilih Jenis Objek Pajak</option>
                                        @foreach($listJenisOp as $key => $item)
                                            <option wire:key="{{ $key }}" value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_jenis_op')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @if(!is_null($selectedOp))
                            @if($selectedOp === 1 || $selectedOp === 2)
                                @include('objek-pajak.form.op-izin', ['selectedOp' => $selectedOp])
                            @endif
                            @if($selectedOp === 3)
                                @include('objek-pajak.form.op-reklame',[
                                    'listKategori' => $listKategori,
                                    'listTipeUsaha' => $listTipeUsaha,
                                    'listJenisReklame' => $listJenisReklame,
                                    'id_kategori' => $id_kategori,
                                    'id_jenis_usaha' => $id_jenis_usaha,
                                    'id_jenis_reklame' => $id_jenis_reklame,
                                    'showSatuan' => $showSatuan,
                                ])
                            @endif
                            @if($selectedOp === 4)
                                @include('objek-pajak.form.op-tambang',[
                                    'listOpd' => $listOpd,
                                    'listTahun' => $listTahun,
                                    'listBahanBaku' => $listBahanBaku,
                                    'statusBayar' => $statusBayar,
                                ])
                            @endif
                            @if($selectedOp === 5)
                                @include('objek-pajak.form.op-pju')
                            @endif
                        @endif
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div>
                                    <label for="nama_objek_pajak" class="form-label">Nama Objek Pajak</label>
                                    <input wire:dirty.class.remove="is-invalid" wire:model.lazy="nama_objek_pajak" type="text"
                                           class="form-control @error('nama_objek_pajak') is-invalid @enderror" id="nama_objek_pajak">
                                    @error('nama_objek_pajak')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div>
                                    <label for="nopd" class="form-label">Nomor Objek Pajak Daerah (NOPD)</label>
                                    <input wire:dirty.class.remove="is-invalid" wire:model.lazy="nopd" type="text"
                                           class="form-control @error('nopd') is-invalid @enderror"
                                           id="nopd"
                                    >
                                    @error('nopd')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div>
                                    <label for="alamat_objek_pajak" class="form-label">Alamat Lengkap</label>
                                    <textarea wire:dirty.class.remove="is-invalid" wire:model.lazy="alamat" id="alamat_objek_pajak"
                                              class="form-control @error('alamat') is-invalid @enderror"
                                              rows="2"></textarea>
                                    @error('alamat')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="col-mb-3">
                                    <label class="col-form-label" for="wp_kecamatan">Kecamatan</label>
                                    <select wire:model.lazy="kecamatan" id="wp_kecamatan" class="form-control @error('kecamatan') is-invalid @enderror
                                        select2-kecamatan"
                                            placeholder="Pilih Kecamatan">
                                        <option value="" selected>Pilih Kecamatan</option>
                                        @foreach($listKecamatan as $kec)
                                            <option wire:key="{{ $kec->id }}" value="{{ $kec->kode }}">{{ $kec->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kecamatan')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if(!is_null($kecamatan))
                                <div class="col-lg-3">
                                    <div class="col-mb-3">
                                        <label class="col-form-label" for="wp_kelurahan">Kelurahan</label>
                                        <select wire:model.lazy="kelurahan" id="wp_kelurahan"
                                                class="form-control @error('kelurahan') is-invalid @enderror select2-kelurahan"
                                                placeholder="Pilih Kelurahan"
                                        >
                                            <option value="" selected>Pilih Kelurahan</option>
                                            @foreach($listKelurahan as $kel)
                                                <option wire:key="{{ $kel->id }}" value="{{ $kel->kode }}">{{ $kel->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kelurahan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div>
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea wire:dirty.class.remove="is-invalid" wire:model.lazy="keterangan" id="keterangan"
                                              class="form-control @error('keterangan') is-invalid @enderror"
                                              rows="2">

                                    </textarea>
                                    @error('keterangan')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-3">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary btn-label waves-effect waves-light">
                                <i class="bx label-icon bx-save"></i>
                                {{ $updateMode ? 'Ubah Data' : 'Simpan Data' }}
                            </button>
                            {{--                            <button type="button" wire:click.prevent="submitAndBayar" class="btn btn-success btn-label waves-effect waves-light">--}}
                            {{--                                <i class="bx label-icon bx-transfer"></i>--}}
                            {{--                                Simpan dan Tambah Pembayaran--}}
                            {{--                            </button>--}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
</div>
@push('script')
    @include('widget.alertify')
    @include('widget.action-js')
    <script>
        // Chocies Select plugin
        document.addEventListener('DOMContentLoaded', function () {
            const element = document.getElementById('id_wp');
            const choice = new Choices(element, {
                removeItems: false,
                placeholderValue: 'Pilih Wajib Pajak',
                searchPlaceholderValue: 'Ketikkan pencarian ...',
                noResultsText: 'Data tidak ditemukan',
                noChoicesText: 'Tidak ada terpilih',
                itemSelectText: '',
            });
            window.addEventListener('clearSelect', event => {
                choice.destroy();
                choice.init();
            });
        });

    </script>
@endpush
