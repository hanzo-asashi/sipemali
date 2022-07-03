@extends('layouts.blank')

@section('title')
    @lang('translation.Login')
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
                                        <img src="{{ asset('favicon.png') }}" alt="" height="28"> <span
                                            class="logo-txt">SIPEMALI</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">SELAMAT DATANG !!</h5>
                                        <p class="text-muted mt-2">Masukkan akun anda untuk masuk ke dalam sistem.</p>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}" class="custom-form mt-4 pt-2">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Username/Email/Nik</label>
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                                   placeholder="Enter Username"
                                                   value="{{ old('email') }}" required
                                                   autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label">Kata Sandi</label>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="">
                                                        <a href="@if (Route::has('password.request')) {{ route('password.request') }} @endif" class="text-muted">Lupa kata
                                                            sandi?</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="input-group auth-pass-inputgroup">
                                                <input id="password" type="password" placeholder="Enter Password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" value="{{ old('password') }}"
                                                       required autocomplete="current-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                                @enderror
                                                <button class="btn btn-light ms-0" type="button" id="password-addon"><i
                                                        class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                                    <label class="form-check-label" for="remember-check">
                                                        Ingat saya!
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        <div class="mb-3">--}}
                                        {{--                                            {!! htmlFormSnippet() !!}--}}
                                        {{--                                        </div>--}}
                                        <div class="mb-3">
                                            <button class="btn btn-info w-100 waves-effect waves-light"
                                                    type="submit">Masuk Sistem
                                            </button>
                                        </div>
                                    </form>

                                    {{--                  <div class="mt-5 text-center">--}}
                                    {{--                    <p class="text-muted mb-0">Belum punya akun ? <a--}}
                                    {{--                        href="{{ route('register') }}" class="text-primary fw-semibold">--}}
                                    {{--                        Daftar Sekarang </a></p>--}}
                                    {{--                  </div>--}}
                                </div>
                                @include('layouts.partials.footer-for-blank')
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
            @include('layouts.partials.login-content')
            <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>

@endsection
@push('script')
    <!-- password addon init -->
    <script src="{{ URL::asset('/assets/js/pages/pass-addon.init.js') }}"></script>
@endpush
