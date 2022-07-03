<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-12 mb-3">
                <a href="{{ route('wajib-pajak.index') }}" class="btn btn-outline-light btn-label waves-effect waves-light">
                    <i class="bx label-icon bx-chevron-left"></i>
                    Kembali ke list wajib pajak
                </a>
            </div>
            <div class="card">
                <form wire:submit.prevent="{{ !$updateMode ? 'submit' : 'updateWajibPajak' }}">
                    <div class="card-header">
                        <div class="">
                            <h5>WAJIB PAJAK</h5>
                            <p class="card-title-desc">Formulir Pengisian Informasi Wajib Pajak</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <div>
                                    <label for="jenis_wp" class="form-label">Jenis Wajib Pajak</label>
                                    <select wire:model.lazy="id_jenis_wp" id="jenis_wp" class="form-control @error('id_jenis_wp') is-invalid @enderror
                                        select2-jeniswp"
                                            placeholder="Pilih Jenis Wajib Pajak">
                                        <option value="">Pilih Jenis Wajib Pajak</option>
                                        @foreach($jenisWajibPajak as $key => $val)
                                            <option value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_jenis_wp')
                                    <span class="invalid-feedback"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <h5 class="font-size-14 text-primary mb-3 mt-3 border-light pt-4" style="border-top: 1px solid;">
                                <i class="mdi mdi-arrow-right me-1"></i> Detail Wajib Pajak
                            </h5>
                            <div class="col-lg-4">
                                <div>
                                    <label for="nama_wajib_pajak" class="form-label">Nama Wajib Pajak</label>
                                    <input wire:model.lazy="nama_wp"
                                           type="text" id="nama_wajib_pajak"
                                           class="form-control @error('nama_wp') is-invalid @enderror"
                                           placeholder="Nama Wajib Pajak">
                                    @error('nama_wp')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div>
                                    <label for="nik_nib" class="form-label">NIK / NIB</label>
                                    <input wire:model.lazy="nik_nib" type="text" id="nik_nib"
                                           class="form-control @error('nik_nib') is-invalid @enderror"
                                           placeholder="NIK / NIB">
                                    @error('nik_nib')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div>
                                    <label for="nwpd" class="form-label">NWPD</label>
                                    <input wire:model.lazy="nwpd" type="text" id="nwpd" class="form-control @error('nwpd') is-invalid @enderror" placeholder="NWPD">
                                    @error('nwpd')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <div>
                                    <label for="telepon" class="form-label">Nomor Telepon</label>
                                    <input wire:model.lazy="telepon" type="text" id="telepon" class="form-control @error('telepon') is-invalid @enderror"
                                           placeholder="Nomor Telepon">
                                    @error('telepon')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <input wire:model.lazy="email" type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Alamat Email">
                                    @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <h5 class="font-size-14 text-primary mb-3 mt-3 border-light pt-4" style="border-top: 1px solid;">
                                <i class="mdi mdi-arrow-right me-1"></i> Detail Wilayah
                            </h5>
                            <div class="col-lg-3">
                                <div>
                                    <label class="col-form-label" for="wp_kabupaten">Kabupaten</label>
                                    <div wire:ignore>
                                        <select wire:model.lazy="kabupaten" id="wp_kabupaten" class="form-control @error('kabupaten') is-invalid @enderror
                                            select2-kabupaten" placeholder="Pilih Kabupaten">
                                            <option value="" selected>Pilih Kabupaten</option>
                                            @foreach($listKabupaten as $kab)
                                                <option wire:key="{{ $kab->id }}" value="{{ $kab->kode }}">{{ $kab->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kabupaten')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            @if(!is_null($kabupaten))
                                <div class="col-lg-3">
                                    <div>
                                        <label class="col-form-label" for="wp_kecamatan">Kecamatan</label>
                                        <select wire:model.lazy="kecamatan" id="wp_kecamatan" class="form-control @error('kecamatan') is-invalid @enderror
                                            select2-kecamatan" placeholder="Pilih Kecamatan">
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
                            @endif
                            @if(!is_null($kecamatan))
                                <div class="col-lg-4">
                                    <div>
                                        <label class="col-form-label" for="wp_kelurahan">Kelurahan</label>
                                        <select wire:model.lazy="kelurahan" id="wp_kelurahan" class="form-control @error('kelurahan') is-invalid @enderror
                                            select2-kelurahan"
                                                placeholder="Pilih Kelurahan">
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
                            <div class="col-lg-6">
                                <div>
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea wire:model.lazy="alamat" rows="2" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                              placeholder="Alamat"></textarea>
                                    @error('alamat')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
                            <div></div>
                            @if($updateMode)
                                <button type="submit" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="bx label-icon bx-save"></i>
                                    Ubah Wajib Pajak
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary btn-label waves-effect waves-light">
                                    <i class="bx label-icon bx-save"></i>
                                    Simpan Wajib Pajak
                                </button>
                                <button type="button" wire:click.prevent="simpanTambahObjekPajak" class="btn btn-success btn-label waves-effect waves-light">
                                    <i class="bx label-icon bx-add-to-queue"></i>
                                    Simpan dan Tambah Objek Pajak
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
</div>
