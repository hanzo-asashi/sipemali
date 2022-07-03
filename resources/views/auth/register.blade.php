@extends('layouts.blank')

@section('title')
    @lang('translation.Register')
@endsection
@section('content')
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="/" class="d-block auth-logo">
                                        <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="28"> <span
                                            class="logo-txt">Pajak Online</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Daftar Akun</h5>
                                        <p class="text-muted mt-2">Dapatkan akun anda sekarang juga.</p>
                                    </div>
                                    <form method="POST" action="{{ route('register') }}" class="needs-validation mt-4 pt-2" novalidate>
                                        @csrf
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline">
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

                                        <div class="mb-3">
                                            <div class="form-group row">
                                                <div class="col-md-6"> {!! htmlFormSnippet() !!} </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <p class="mb-0">Dengan mendaftar berarti anda menyetujui
                                                <a href="#" class="text-primary">Ketentuan Penggunaan Sistem</a>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Daftar</button>
                                        </div>
                                    </form>

                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Sudah mempunyai akun ? <a
                                                href=" @if (Route::has('login')){{ route('login') }} @endif" class="text-primary fw-semibold"> Masuk Sistem
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                @include('layouts.partials.footer-for-blank')
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                @include('layouts.partials.advert')
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>
@endsection

@push('script')
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
    <!-- validation init -->
    <script src="{{ asset('assets/js/pages/validation.init.js') }}"></script>
@endpush
