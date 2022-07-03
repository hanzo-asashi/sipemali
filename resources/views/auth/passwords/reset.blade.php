@extends('layouts.blank')

@section('title')
  @lang('translation.Recover_Password')
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
                    <img src="{{ URL::asset('/assets/images/logo-sm.svg') }}" alt="" height="28">
                    <span class="logo-txt">Pajak Online</span>
                  </a>
                </div>
                <div class="auth-content my-auto">
                  <div class="text-center">
                    <h5 class="mb-0">Reset Kata Sandi</h5>
                    <p class="text-muted mt-2">Reset Kata Sandi Pada Pajak Online</p>
                  </div>
                  <form class="custom-form mt-4" method="POST"
                        action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                      <label class="form-label">Alamat Email</label>
                      <input type="email"
                             class="form-control @error('email') is-invalid @enderror" id="useremail"
                             name="email" placeholder="Enter email"
                             value="{{ $email ?? old('email') }}" id="email" readonly>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="userpassword">Kata Sandi</label>
                      <input type="password"
                             class="form-control @error('password') is-invalid @enderror"
                             name="password" id="userpassword" placeholder="Enter password">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                      @enderror
                    </div>

                    <div class="mb-3">
                      <label for="userpassword">Konfirmasi Kata Sandi</label>
                      <input id="password-confirm" type="password" name="password_confirmation"
                             class="form-control" placeholder="Enter confirm password">
                    </div>

                    <div class="mb-3 mt-4">
                      <button class="btn btn-primary w-100 waves-effect waves-light"
                              type="submit">Reset
                      </button>
                    </div>
                  </form>

                  <div class="mt-5 text-center">
                    <p class="text-muted mb-0">Remember It ? <a href="{{ route('login') }}"
                                                                class="text-primary fw-semibold"> Masuk Sistem </a></p>
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
