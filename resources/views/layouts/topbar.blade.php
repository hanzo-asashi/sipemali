<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('home') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('storage/uploads/'.setting('logo_aplikasi')) ?: asset('assets/images/logo-sm.svg') }}" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('storage/uploads/'.setting('logo_aplikasi')) ?: asset('assets/images/logo-sm.svg') }}" alt="" height="24">
                        <span class="logo-txt">Pajak Online</span>
                    </span>
                </a>

                <a href="{{ route('home') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('storage/uploads/'.setting('logo_aplikasi')) ?? asset('assets/images/logo-sm.svg') }}" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('storage/uploads/'.setting('logo_aplikasi')) ?? asset('assets/images/logo-sm.svg') }}" alt="" height="24"> <span class="logo-txt">
                            {{ strtoupper(setting('nama_aplikasi', config('app.name'))) }}</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            {{--            <form class="app-search d-none d-lg-block">--}}
            <div class="position-relative mt-4 align-items-center">
                <span class="text-muted font-size-16">{{ \App\Utilities\Helper::hari_tanggal() }}</span>
                {{--                    <input type="text" class="form-control" placeholder="Search...">--}}
                {{--                    <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>--}}
            </div>
            {{--            </form>--}}
        </div>

        <div class="d-flex">
            {{--            <div class="dropdown d-inline-block d-lg-none ms-2">--}}
            {{--                <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown"--}}
            {{--                        aria-haspopup="true" aria-expanded="false">--}}
            {{--                    <i data-feather="search" class="icon-lg"></i>--}}
            {{--                </button>--}}
            {{--                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"--}}
            {{--                     aria-labelledby="page-header-search-dropdown">--}}

            {{--                    <form class="p-3">--}}
            {{--                        <div class="form-group m-0">--}}
            {{--                            <div class="input-group">--}}
            {{--                                <input type="text" class="form-control" placeholder="Search ..."--}}
            {{--                                       aria-label="Search Result">--}}

            {{--                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </form>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            {{--            @include('layouts.partials.languange')--}}

            {{--            <livewire:components.dark-mode-switch/>--}}

            {{--            @include('layouts.partials.notifications')--}}

            {{--      <div class="dropdown d-inline-block">--}}
            {{--        <button type="button" class="btn header-item right-bar-toggle me-2">--}}
            {{--          <i data-feather="settings" class="icon-lg"></i>--}}
            {{--        </button>--}}
            {{--      </div>--}}
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end"
                        id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ \App\Utilities\Helper::getAvatar() }}" alt="Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    {{--                    <a class="dropdown-item" href="{{ route('pengguna.profile') }}">--}}
                    {{--                        <i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i>--}}
                    {{--                        Profil--}}
                    {{--                    </a>--}}
                    {{--                    <a class="dropdown-item" href="{{ url('/lock-screen') }}">--}}
                    {{--                        <i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock screen--}}
                    {{--                    </a>--}}
                    {{--                    <div class="dropdown-divider"></div>--}}
                    <a class="dropdown-item text-danger" href="javascript:void();"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="mdi mdi-logout font-size-16 align-middle me-1"></i> <span key="t-logout">Log Out</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>
