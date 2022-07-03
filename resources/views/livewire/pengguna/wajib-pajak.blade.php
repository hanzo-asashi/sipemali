<form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
    @csrf
    <div class="mb-3">
        <div class="form-check form-check-inline mt-2">
            <input id="jenis_wp_perorangan" class="form-check-input @error('jenis_wp') is-invalid @enderror"
                   type="radio" name="jenis_wp" value="1" checked>
            <label class="form-check-label" for="jenis_wp_perorangan">
                Perorangan
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input id="jenis_wp_perusahaan" class="form-check-input @error('jenis_wp') is-invalid @enderror"
                   type="radio" name="jenis_wp" value="2">
            <label class="form-check-label" for="jenis_wp_perusahaan">
                Perusahaan
            </label>
        </div>

        @error( "jenis_wp" )
        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
        @enderror
        <div class="invalid-feedback">
            Silahkan Pilih Jenis Wajib Pajak
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
                <input id="nik" type="text" placeholder="Masukkan NIK"
                       class="form-control @error('nik') is-invalid @enderror" name="nik"
                       value="{{ old('nik') }}" required>
                @error('nik')
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                @enderror
                <div class="invalid-feedback">
                    Silahkan masukkan NIK
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="npwp" class="form-label">Nomor Pokok Wajib Pajak (NPWP)</label>
                <input id="npwp" type="text" placeholder="Masukkan NPWP"
                       class="form-control @error('npwp') is-invalid @enderror" name="npwp"
                       value="{{ old('npwp') }}" required>
                @error('nik')
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                @enderror
                <div class="invalid-feedback">
                    Silahkan masukkan NPWP
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input id="name" type="text" placeholder="Masukkan nama lengkap"
               class="form-control @error('name') is-invalid @enderror" name="name"
               value="{{ old('name') }}" required>

        @error('name')
        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
        @enderror
        <div class="invalid-feedback">
            Silahkan masukkan nama lengkap
        </div>
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" placeholder="Alamat Email"
               class="form-control @error('email') is-invalid @enderror" name="email"
               value="{{ old('email') }}" required>

        @error('email')
        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
        @enderror
        <div class="invalid-feedback">
            Silahkan masukkan email
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            {{-- No Telepon --}}
            <div class="mb-3">
                <label for="no_telp" class="form-label">No Telepon</label>
                <input id="no_telp" type="number" placeholder="Nomor Telepon"
                       class="form-control @error('no_telp') is-invalid @enderror" name="no_telp"
                       value="{{ old('no_telp') }}" required>

                @error('no_telp')
                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                @enderror
                <div class="invalid-feedback">
                    Silahkan masukkan nomor telepon
                </div>
            </div>
        </div>
        <div class="col-md-6">
            {{-- No Handphone / HP --}}
            <div class="mb-3">
                <label for="no_hp" class="form-label">No Handphone</label>
                <input id="no_hp" type="number" placeholder="Nomor Handphone"
                       class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                       value="{{ old('no_hp') }}" required>

                @error('no_hp')
                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                @enderror
                <div class="invalid-feedback">
                    Silahkan masukkan nomor handphone
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            {{-- Kata sandi --}}
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input id="password" type="password" placeholder="Masukkan kata sandi"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                @enderror
                <div class="invalid-feedback">
                    Silahkan masukkan kata sandi
                </div>
            </div>
        </div>
        <div class="col-md-6">
            {{-- Konfirmasi Kata sandi --}}
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Konfirmasi Kata Sandi</label>
                <input id="confirm_password" type="password" placeholder="Masukkan konfirmasi kata sandi"
                       class="form-control @error('password_confirmation') is-invalid @enderror"
                       name="password_confirmation" required autocomplete="new-password">

                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                @enderror
                <div class="invalid-feedback">
                    Silahkan masukkan konfirmasi kata sandi
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">Agree to terms and
                        conditions</label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Submit form</button>
</form>
