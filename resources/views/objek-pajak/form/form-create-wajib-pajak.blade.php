<div class="card">
    <form>
        <div class="card-header">
            <h4 class="card-title mb-0">Formulir Pendaftaran</h4>
        </div>
        <div class="card-body">
            <div id="wizard-pendaftaran" class="twitter-bs-wizard">
                <div>
                    <ul class="twitter-bs-wizard-nav">
                        <li class="nav-item">
                            <a href="#daftar-wajib-pajak" class="nav-link" data-toggle="tab">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                     title="Pendaftaran Wajib Pajak">
                                    <i class="bx bxs-user-detail"></i>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#objek-pajak" class="nav-link" data-toggle="tab">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                     title="Pendaftaran Objek Pajak">
                                    <i class="bx bxs-user-account"></i>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#selesai" class="nav-link" data-toggle="tab">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                     title="Tahap Akhir">
                                    <i class="bx bxs-check-circle"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- wizard-nav -->
                <div class="tab-content twitter-bs-wizard-tab-content">
                    <div class="tab-pane" id="daftar-wajib-pajak">
                        <div class="text-center mb-4">
                            <h5>WAJIB PAJAK</h5>
                            <p class="card-title-desc">Formulir pengisian informasi wajib pajak</p>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="jenis_wp" class="form-label">Jenis Wajib Pajak</label>
                                        <select wire:model.lazy.defer="id_jenis_wp" id="jenis_wp" class="form-control select2-jeniswp"
                                                placeholder="Pilih Jenis Wajib Pajak">
                                            <option value="">Pilih Jenis Wajib Pajak</option>
                                            <option value="">Perorangan</option>
                                            <option value="">Perusahaan</option>
                                        </select>
                                        @error('id_jenis_wp')
                                        <span class="invalid-feedback"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="nama_wajib_pajak" class="form-label">Nama Wajib Pajak</label>
                                        <input wire:model.defer="nama_wp" type="text" id="nama_wajib_pajak" class="form-control" placeholder="Nama Wajib Pajak">
                                        @error('nama_wp')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="nik_nib" class="form-label">NIK / NIB</label>
                                        <input wire:model.defer="nik_nib" type="number" id="nik_nib" class="form-control" placeholder="NIK / NIB">
                                        @error('nik_nib')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="nwpd" class="form-label">NWPD</label>
                                        <input wire:model.defer="nwpd" type="text" id="nwpd" class="form-control" placeholder="NWPD">
                                        @error('nwpd')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="telepon" class="form-label">Nomor Telepon</label>
                                        <input wire:model.defer="telepon" type="text" id="telepon" class="form-control" placeholder="Nomor Telepon">
                                        @error('telepon')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Alamat Email</label>
                                        <input wire:model.defer="email" type="text" id="email" class="form-control" placeholder="Alamat Email">
                                        @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <livewire:components.select2-component/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Address</label>
                                        <textarea wire:model.defer="alamat" rows="2" id="alamat" class="form-control" placeholder="Alamat"></textarea>
                                        @error('alamat')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="pager wizard twitter-bs-wizard-pager-link">
                            <li class="next">
                                <a href="javascript: void(0);" class="btn btn-primary">
                                    Selanjutnya
                                    <i class="bx bx-chevron-right ms-1"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- tab pane -->
                    <div class="tab-pane" id="objek-pajak">
                        <div wire:ignore>
                            <div class="text-center mb-4">
                                <h5>OBJEK PAJAK</h5>
                                <p class="card-title-desc">Formulir pengisian data objek pajak</p>
                            </div>
                            <!-- Form Objek Pajak Start -->
                        @include('transaksi-pajak.daftar-wajib-pajak.partials.form-objek-pajak')
                        <!-- Form Objek Pajak end -->
                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                <li class="previous"><a href="javascript: void(0);" class="btn btn-primary"
                                    ><i class="bx bx-chevron-left me-1"></i> Kembali</a>
                                </li>
                                <li class="next">
                                    <button type="button" href="javascript: void(0);" class="btn btn-primary"
                                    >Selanjutnya <i class="bx bx-chevron-right ms-1"></i></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- tab pane -->
                    <div class="tab-pane" id="selesai">
                        <div>
                            <div class="text-center mb-4">
                                <h5>KONFIRMASI PENGISIAN FORMULIR</h5>
                                <p class="font-size-16  card-title-desc">Anda telah mengisi informasi tentang wajib pajak dan objek pajak, jika anda yakin tidak
                                    ada
                                    perubahan lagi, silahkan klik tombol "Simpan Data".</p>
                            </div>
                            <form></form>
                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                <li class="previous"><a href="javascript: void(0);" class="btn btn-primary"
                                    ><i class="bx bx-chevron-left me-1"></i> Kembali</a>
                                </li>
                                <li class="float-end">
                                    <a href="javascript: void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".confirmModal">
                                        Simpan Data
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- tab pane -->
                </div>
                <!-- end tab content -->
            </div>
        </div>
    </form>
    <!-- end card body -->
</div>
