@extends('layouts.blank')

@section('title', 'Landing Page')

@section('content')

    <div class="bg-soft-light min-vh-100 pt-3">
        <div class="pt-3">
            <div class="container d-none d-lg-block">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <img style="width: 80px;height: 100px;" src="{{ asset('assets/images/logo/logo-soppeng.png') }}" alt=""/>
                            <img style="width: 80px;height: 80px;" src="{{ asset('assets/images/logo/logo-cutout.png') }}" alt=""/>
                            <h3 class="mt-4">PEMERINTAH KABUPATEN SOPPENG</h3>
                            <p>PERUSAHAAN UMUM DAERAH (PERUMDA) AIR MINUM TIRTA OMPO </p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->


            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col-xl-8 bg-gradient bg-soft-light bg-card-img">
                        <div class="text-center text-white p-4 pt-5">
                            <img style="width: 300px;height: 100%;" src="{{ asset('assets/images/app-name.png') }}" alt=""/>
                            <p class="mt-3 mb-1">SISTEM ELEKTRONIK</p>
                            <h5 class="text-white">PEMBAYARAN AIR ONLINE DAERAH SOPPENG</h5>
                            <div>
                                @auth()
                                    <a href="{{ route('dashboard') }}" class="btn btn-success mt-2 me-2 waves-effect waves-light">Dashboard</a>
                                @endauth
                                @guest()
                                    <a href="{{ route('login') }}" class="btn btn-success mt-2 me-2 waves-effect waves-light">Login Sistem</a>
                                @endguest

                                <a href="https://sipemali.com" target="_blank" class="btn btn-light mt-2 waves-effect waves-light">Website</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 bg-gradient bg-success">
                        <div class="text-center p-5">
                            <h5>TRACKING PEMBAYARAN</h5>
                            <p class="text-white">Masukkan No Sambungan atau No Pelanggan untuk mengetahui status pembayaran air anda</p>
                            <form action="{{ route('search') }}" class="app-search d-lg-block mt-4">
                                @csrf
                                <div class="position-relative">
                                    <input name="search" type="text" class="form-control" placeholder="Search...">
                                    <button class="btn btn-primary" type="submit"><i class="bx bx-search-alt align-middle"></i></button>
                                </div>
                            </form>
                        </div>
{{--                        <livewire:tracking-pembayaran />--}}
                    </div>
                </div>
            </div>

            <div class="bg-primary pt-5 pb-4 px-5">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body overflow-hidden position-relative">
                                <div>
                                    <i class="bx bx-smile widget-box-1-icon text-primary"></i>
                                </div>
                                <h5 class="mt-3">PELANGGAN AKTIF</h5>
                                <h3 class="mt-3 mb-0">{{ $data['totalWajibPajak'] }} <span style="font-size: 13px; font-style: italic;">Orang</span></h3>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body overflow-hidden position-relative">
                                <div>
                                    <i class="bx bx-map-pin widget-box-1-icon text-primary"></i>
                                </div>
                                <h5 class="mt-3">PELANGGAN VALID</h5>
                                <h3 class="mt-3 mb-0">{{ $data['totalObjekPajak'] }} <span style="font-size: 13px; font-style: italic;">Orang</span></h3>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body overflow-hidden position-relative">
                                <div>
                                    <i class="bx bx-pie-chart-alt widget-box-1-icon text-primary"></i>
                                </div>
                                <h5 class="mt-3">PENDAPATAN</h5>
                                <h3 class="mt-3 mb-0"><span style="font-size: 13px; font-style: italic;">Rp.</span> {{ number_format($data['totalTargetPajak'],0,',','.') }}</h3>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body overflow-hidden position-relative">
                                <div>
                                    <i class="bx bx-pie-chart widget-box-1-icon text-primary"></i>
                                </div>
                                <h5 class="mt-3">TERTUNGGAK</h5>
                                <h3 class="mt-3 mb-0"><span style="font-size: 13px; font-style: italic;">Rp.</span> {{ number_format($data['totalRealisasiPajak'],0,',','.') }}</h3>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
            <div class="bg-light py-2">
                <div class="text-center">
                    {{ now()->year }} <i class="bx bx-copyright"></i> PERUMDA AIR MINUM TIRTA OMPO - Pemerintah Kabupaten Soppeng.
                </div>
            </div>
        </div>
    </div>
    <!-- end  -->

@endsection
