@extends('layouts.blank')

@section('title')
  Confirm Password
@endsection

@push('css')
  <!-- owl.carousel css -->
  <link rel="stylesheet" href="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.css') }}">
@endpush

@section('content')

  <div class="auth-page">
    <div class="container-fluid p-0">
      <div class="row g-0">

        <div class="col-xxl-3 col-lg-4 col-md-5">
          <div class="auth-full-page-content p-md-5 p-4">
            <div class="w-100">

              <div class="d-flex flex-column h-100">
                <div class="mb-4 mb-md-5 text-center">
                  <a href="index" class="d-block auth-logo">
                    <img src="{{ URL::asset('/assets/images/logo-sm.svg') }}" alt="" height="28">
                    <span class="logo-txt">Minia</span>
                  </a>
                </div>
                <div class="my-auto">

                  <div>
                    <h5 class="text-primary"> Confirm Password</h5>
                    <p class="text-muted">Re-Password with Minia.</p>
                  </div>

                  <div class="mt-4">
                    <form class="form-horizontal" method="POST"
                          action="{{ route('password.confirm') }}">
                      @csrf

                      <div class="mb-3">
                        <div class="float-end">
                          @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-muted">Forgot password?</a>
                          @endif
                        </div>
                        <label for="userpassword">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" id="userpassword" placeholder="Enter password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                        @enderror
                      </div>

                      <div class="text-end">
                        <button class="btn btn-primary w-md waves-effect waves-light"
                                type="submit">Confirm Password
                        </button>
                      </div>

                    </form>
                    <div class="mt-5 text-center">
                      <p>Remember It ? <a href="{{ url('login') }}"
                                          class="font-weight-medium text-primary"> Sign In here</a></p>
                    </div>
                  </div>
                </div>
                  @include('layouts.partials.footer-for-blank')
              </div>


            </div>
          </div>
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
  <!-- owl.carousel js -->
  <script src="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.js') }}"></script>
  <!-- auth-2-carousel init -->
  <script src="{{ URL::asset('/assets/js/pages/auth-2-carousel.init.js') }}"></script>
@endpush
