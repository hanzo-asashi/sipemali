@extends('layouts.blank')

@section('title')
   Verify Email
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
                                    <a href="/" class="d-block auth-logo">
                                        <img src="{{ URL::asset('/assets/images/logo-sm.svg') }}" alt="" height="28">
                                        <span class="logo-txt">Pajak Online</span>
                                    </a>
                                </div>
                                <div class="my-auto">
                                    <div>
                                        <h5 class="text-primary"> Verify Your Email Address</h5>
                                    </div>

                                    <div class="mt-4">
                                        @if (session('resent'))
                                            <div class="alert alert-success" role="alert">
                                                {{ __('A fresh verification link has been sent to your email address.') }}
                                            </div>
                                        @endif
                                       <div>
                                           {{ __('Before proceeding, please check your email for a verification link.') }}
                                           {{ __('If you did not receive the email') }},
                                       </div>
                                        <form class="form-horizontal" method="POST" action="{{ route('verification.send') }}">
                                            @csrf
                                            <div class="mt-3 text-center">
                                                <button class="btn btn-primary w-md waves-effect waves-light"
                                                        type="submit">{{ __('Kirim Ulang Email Verifikasi') }}
                                                </button>
                                            </div>
                                        </form>
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

