<form wire:submit.prevent="submitForm" class="form form-horizontal">
    <div class="card-body">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="jenis_wp">Jenis Pajak</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-group input-group-merge">
                            <select wire:model="wajib_pajak.id_jenis_wp" type="number" id="jenis_wp" class="form-control select2-jeniswp" placeholder="Pilih Jenis Wajib Pajak">
                                <option value="">Pilih Jenis Wajib Pajak</option>
                                @foreach($jenisWajibPajak as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endforeach
                            </select>
                            @error('wajib_pajak.id_jenis_wp')
                            <span class="invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="nama_wajib_pajak">Nama Wajib Pajak</label>
                    </div>
                    <div class="col-sm-9">
                        <div wire:ignore class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user" class=""></i></span>
                            <input wire:model="wajib_pajak.nama_wp" type="text" id="nama_wajib_pajak" class="form-control" placeholder="Nama Wajib Pajak">
                            @error('nama_wp')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="nik_nib">NIK / NIB</label>
                    </div>
                    <div class="col-sm-9">
                        <div wire:ignore class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="key" class=""></i></span>
                            <input wire:model="wajib_pajak.nik_nib" type="number" id="nik_nib" class="form-control" placeholder="NIK / NIB">
                            @error('wajib_pajak.nik_nib')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="nwpd">NWPD</label>
                    </div>
                    <div class="col-sm-9">
                        <div wire:ignore class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="divide" class=""></i></span>
                            <input wire:model="wajib_pajak.nwpd" type="number" id="nwpd" class="form-control" placeholder="NWPD">
                            @error('wajib_pajak.nwpd')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <livewire:components.select2-component :selected-kelurahan="'74.08.05'" />
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="nik_nib">Alamat</label>
                    </div>
                    <div class="col-sm-9">
                        <div wire:ignore class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="map-pin" class=""></i></span>
                            <input wire:model="wajib_pajak.alamat" type="text" id="alamat" class="form-control" placeholder="Alamat">
                            @error('wajib_pajak.alamat')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="telepon">Telepon</label>
                    </div>
                    <div class="col-sm-9">
                        <div wire:ignore class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="phone" class=""></i></span>
                            <input wire:model="wajib_pajak.telepon" type="text" id="telepon" class="form-control" placeholder="Telepon">
                            @error('wajib_pajak.telepon')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="email">Email</label>
                    </div>
                    <div class="col-sm-9">
                        <div wire:ignore class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="mail" class=""></i></span>
                            <input wire:model="wajib_pajak.email" type="email" id="email" class="form-control" placeholder="Email">
                            @error('wajib_pajak.email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Card Footer Start  -->
    <div class="card-footer">
        <div class="col-sm-12 offset-sm-4">
            <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Simpan</button>
            <button type="reset" class="btn btn-outline-secondary waves-effect">Batal</button>
        </div>
    </div>
    <!-- Card Footer End  -->
</form>
