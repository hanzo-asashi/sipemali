@extends('layouts.blank')

@section('title')
  Keluar Sistem
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
                        <div class="avatar-xl mx-auto">
                            <div class="avatar-title bg-soft-light text-primary h1 rounded-circle">
                                <i class="bx bxs-user"></i>
                            </div>
                        </div>

                        <div class="mt-4 pt-2">
                            <h5>Anda sudah keluar sistem.</h5>
                            <p class="text-muted font-size-15">Terima kasih sudah menggunakan <span
                                    class="fw-semibold text-dark">Pajak Online</span></p>
                            <div class="mt-4">
                                <a href="{{ route('login') }}"
                                   class="btn btn-primary w-100 waves-effect waves-light">
                                    Masuk Kembali
                                </a>
                            </div>
                        </div>
                    </div>

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
        @include('layouts.partials.advert')
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
