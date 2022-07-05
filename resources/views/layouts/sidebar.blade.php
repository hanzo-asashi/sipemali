<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-utama">Utama</li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('transaksi.pembayaran.list') }}">
                        <i data-feather="credit-card"></i>
                        <span data-key="t-laporan">Pembayaran</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('catat-meter') }}">
                        <i data-feather="credit-card"></i>
                        <span data-key="t-laporan">Catat Meter Mandiri</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('laporan.list') }}">
                        <i data-feather="pie-chart"></i>
                        <span data-key="t-laporan">Laporan</span>
                    </a>
                </li>

{{--                @hasanyrole('superadmin|admin|operator')--}}
{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow" data-key="t-daftar-wp">--}}
{{--                        <i data-feather="user-check"></i>--}}
{{--                        <span data-key="t-apps">Pendaftaran</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('wajib-pajak.index') }}">--}}
{{--                                <span data-key="t-list-wp">Wajib Pajak</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('objek-pajak.index') }}">--}}
{{--                                <span data-key="t-list-wp">Objek Pajak</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('pembayaran.tambah') }}">--}}
{{--                                <span data-key="t-list-wp">PembayaranPajak</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                @endhasanyrole--}}

{{--                @can('manage transaksi-pembayaran')--}}
{{--                    <li>--}}
{{--                        <a href="javascript: void(0);" class="has-arrow">--}}
{{--                            <i data-feather="credit-card"></i>--}}
{{--                            <span data-key="t-apps">PembayaranPajak</span>--}}
{{--                        </a>--}}
{{--                        <ul class="sub-menu" aria-expanded="true">--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('pembayaran.rumahmakan',1) }}">--}}
{{--                                    <span data-key="t-pembayaran-rm">Rumah Makan</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('pembayaran.hotel',2) }}">--}}
{{--                                    <span data-key="t-pembayaran-htl">Hotel</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('pembayaran.reklame', 3) }}">--}}
{{--                                    <span data-key="t-pembayaran-rkl">Reklame</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('pembayaran.tambangmineral',4) }}">--}}
{{--                                    <span data-key="t-pembayaran-tbm">Tambang Mineral</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('pembayaran.peneranganjalanumum',5) }}">--}}
{{--                                    <span data-key="t-pembayaran-ppj">Penerangan Jalan (PPJ)</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endcan--}}
{{--                <li>--}}
{{--                    <a href="{{ route('tunggakan.index') }}">--}}
{{--                        <i data-feather="book-open"></i>--}}
{{--                        <span data-key="t-tunggakan">Tunggakan</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @can('manage transaksi-opd')--}}
{{--                    <li>--}}
{{--                        <a href="javascript: void(0);" class="has-arrow">--}}
{{--                            <i data-feather="folder-plus"></i>--}}
{{--                            <span data-key="t-apps">Transaksi OPD</span>--}}
{{--                        </a>--}}
{{--                        <ul class="sub-menu" aria-expanded="false">--}}
{{--                            <li>--}}
{{--                                <a href="{{ url('anggaran-opd') }}">--}}
{{--                                    <span data-key="t-daftar-wp">Anggaran OPD</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{ url('belanja-opd') }}">--}}
{{--                                    <span data-key="t-pembayaran">Belanja OPD</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endcan--}}

                <li class="menu-title" data-key="t-pengaturan">Pengaturan</li>
                @hasanyrole('superadmin|admin|operator')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="database"></i>
                        <span data-key="t-apps">Data Pokok</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('master.pelanggan.list') }}">
                                <span data-key="t-pelanggan">Pelanggan</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('master.alamat.list') }}">
                                <span data-key="t-alamat">Alamat</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('master.golongan.list') }}">
                                <span data-key="t-golongan-tarif">Golongan Tarif</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('master.status.list') }}">
                                <span data-key="t-status">Status</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('master.status-pembayaran.list') }}">
                                <span data-key="t-status-pembayaran">Status Pembayaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('master.metode-bayar.list') }}">
                                <span data-key="t-metode-bayar">Metode Bayar</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('master.zona.list') }}">
                                <span data-key="t-metode-bayar">Zona Wilayah</span>
                            </a>
                        </li>

{{--                        <li>--}}
{{--                            <a href="{{ route('master.loket.list') }}">--}}
{{--                                <span data-key="t-loket">Loket Pembayaran</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <a href="{{ route('master.bank.list') }}">--}}
{{--                                <span data-key="t-bank">Akun Bank</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </li>
                @endhasanyrole
                @hasanyrole('superadmin|admin')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-apps">Managemen Pengguna</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('pengguna') }}">
                                <span data-key="t-pengguna">Pengguna</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('hak-akses.index') }}">
                                <span data-key="t-pembayaran">Hak Akses</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endhasanyrole

                <li>
                    <a href="{{ route('pengaturan.index') }}">
                        <i data-feather="settings"></i>
                        <span data-key="t-pengaturan">Pengaturan</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
