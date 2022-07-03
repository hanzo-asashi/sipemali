<div>
    @section('title', $title ?? 'Pengaturan')
    <div class="row">
        <div class="col-12">
            <x-jet-action-message on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>
        </div>
        <div class="col-12">
            <div class="card">
                <form wire:submit.prevent="submit">
                    <!-- card-body start -->
                    <div class="card-body">
                        <!-- Row Start -->
                        <div class="row">
                            <div class="col-md-4">
                                <x-section-title>
                                    <x-slot name="title">
                                        {{ __('Aplikasi') }}
                                    </x-slot>

                                    <x-slot name="description">
                                        {{ __('Update nama aplikasi serta format no transaksi untuk generate otomatis') }}
                                    </x-slot>
                                </x-section-title>
                            </div>
                            <div class="col-md-8">
                                <div class="px-2">
                                    <!-- Nama Aplikasi -->
                                    <div class="row mb-1">
                                        <div class="col-md-6">
                                            <x-jet-label class="form-label" for="nama_aplikasi" value="{{ __('Nama Aplikasi') }}"/>
                                            <x-jet-input id="nama_aplikasi" type="text" class="{{ $errors->has('nama_aplikasi') ? 'is-invalid' : '' }}"
                                                         wire:model.defer="state.nama_aplikasi" autofocus/>
                                            <x-jet-input-error for="nama_aplikasi"/>
                                        </div>
                                        <div class="col-md-6">
                                            <x-jet-label class="form-label" for="nama_kantor" value="{{ __('Nama Kantor') }}"/>
                                            <x-jet-input id="nama_kantor" type="text" class="{{ $errors->has('nama_kantor') ? 'is-invalid' : '' }}"
                                                         wire:model.defer="state.nama_kantor" autofocus/>
                                            <x-jet-input-error for="nama_kantor"/>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-9">
                                            <x-jet-label class="form-label" for="alamat_kantor" value="{{ __('Alamat Kantor') }}"/>
                                            <x-jet-input id="alamat_kantor" type="text" class="{{ $errors->has('alamat_kantor') ? 'is-invalid' : '' }}"
                                                         wire:model.defer="state.alamat_kantor" autofocus/>
                                            <x-jet-input-error for="alamat_kantor"/>
                                        </div>
                                        <div class="col-md-3">
                                            <x-jet-label class="form-label" for="no_telp_kantor" value="{{ __('No Telp Kantor') }}"/>
                                            <x-jet-input id="no_telp_kantor" type="text" class="{{ $errors->has('no_telp_kantor') ? 'is-invalid' : '' }}"
                                                         wire:model.defer="state.no_telp_kantor" autofocus/>
                                            <x-jet-input-error for="no_telp_kantor"/>
                                        </div>
                                    </div>

                                    <!-- Format -->
                                    <div class="row mb-1">
                                        <div class="col-md-3">
                                            <x-jet-label class="form-label" for="email" value="{{ __('Format No Transaksi') }}"/>
                                            <x-jet-input id="format_no_transaksi" type="format_no_transaksi" class="{{ $errors->has('format_no_transaksi') ? 'is-invalid' : '' }}"
                                                         wire:model.defer="state.format_no_transaksi"/>
                                            <x-jet-input-error for="format_no_transaksi"/>
                                        </div>
                                        <div class="col-md-3">
                                            <x-jet-label class="form-label" for="pemisah" value="{{ __('Pemisah') }}"/>
                                            <x-jet-input id="pemisah" type="pemisah" class="{{ $errors->has('pemisah') ? 'is-invalid' : '' }}"
                                                         wire:model.defer="state.pemisah"/>
                                            <x-jet-input-error for="pemisah"/>
                                        </div>
                                        <div class="col-md-2">
                                            <x-jet-label class="form-label" for="tgl_pembayaran" value="{{ __('Tanggal Periode') }}"/>
                                            <x-jet-input id="tgl_pembayaran" type="tgl_pembayaran" class="{{ $errors->has('tgl_pembayaran') ? 'is-invalid' : '' }}"
                                                         wire:model.defer="state.tgl_pembayaran"/>
                                            <x-jet-input-error for="tgl_pembayaran"/>
                                        </div>
                                        <div class="col-md-2">
                                            <x-jet-label class="form-label" for="bulan_periode" value="{{ __('Bulan Periode') }}"/>
                                            <select id="bulan_periode" wire:model.defer="state.bulan" class="form-select {{ $errors->has('bulan') ? 'is-invalid' : '' }}">
                                                <option value="">Pilih Bulan</option>
                                                @foreach($listBulan as $key => $bln)
                                                    <option value="{{ $key }}">{{ $bln }}</option>
                                                @endforeach
                                            </select>
                                            <x-jet-input-error for="bulan"/>
                                        </div>
                                        <div class="col-md-2">
                                            <x-jet-label class="form-label" for="tahun_periode" value="{{ __('Tahun Periode') }}"/>
                                            <x-jet-input id="tahun_periode" type="text" class="{{ $errors->has('tahun_periode') ? 'is-invalid' : '' }}"
                                                         wire:model.defer="state.tahun_periode"/>
                                            <x-jet-input-error for="tahun_periode"/>
                                        </div>
                                    </div>
                                    <!-- Denda -->
                                    <div class="row mb-1">
                                        <div class="col-md-2">
                                            <x-jet-label class="form-label" for="tarif_denda" value="{{ __('Tarif Denda (Rp)') }}"/>
                                            <x-jet-input id="tarif_denda" type="text" class="{{ $errors->has('tarif_denda') ? 'is-invalid' : '' }}"
                                                         wire:model.defer="state.tarif_denda"/>
                                            <x-jet-input-error for="tarif_denda"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                        <x-section-border/>--}}
                        </div>
                        <!-- Row end -->
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <x-section-title>
                                    <x-slot name="title">
                                        {{ __('Persuratan') }}
                                    </x-slot>

                                    <x-slot name="description">
                                        {{ __('Isi nama pejabat penandatangan beserta jabatan untuk di tambahkan ke laporan-pajak.') }}
                                    </x-slot>
                                </x-section-title>
                            </div>
                            <div class="col-md-8">
                                <div class="px-2">
                                    <div class="row mb-1">
                                        <div class="col-md-6">
                                            <x-jet-label class="form-label" for="penandatangan" value="{{ __('Pejabat Penandatangan') }}"/>
                                            <x-jet-input id="penandatangan" type="text" class="{{ $errors->has('penandatangan') ? 'is-invalid' : '' }}"
                                                         wire:model.defer="state.penandatangan" autofocus/>
                                            <x-jet-input-error for="penandatangan"/>
                                        </div>
                                        <div class="col-md-6">
                                            <x-jet-label class="form-label" for="jabatan" value="{{ __('Jabatan') }}"/>
                                            <x-jet-input id="jabatan" type="text" class="{{ $errors->has('jabatan') ? 'is-invalid' : '' }}"
                                                         wire:model.defer="state.jabatan" autofocus/>
                                            <x-jet-input-error for="jabatan"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <x-section-title>
                                    <x-slot name="title">
                                        {{ __('Layout dan Tema Aplikasi') }}
                                    </x-slot>

                                    <x-slot name="description">
                                        {{ __('Pilihan untuk mengganti tema aplikasi, serta tersedia fitur dark mode.') }}
                                    </x-slot>
                                </x-section-title>
                            </div>
                            <div class="col-md-8">
                                <div class="px-2">
                                    <!-- Dark Mode -->
                                    <div class="mb-1">
                                        <div class="form-check form-switch form-check-success">
                                            <input wire:model="state.darkmode" type="checkbox" class="form-check-input" id="darkMode" />
                                            <label class="form-check-label" for="darkMode">Aktifkan Mode Gelap</label>
                                        </div>
                                    </div>

                                    <div class="mb-1">
                                        <div class="form-check form-switch form-check-success">
                                            <input wire:model="state.sidebarcollapsed" type="checkbox" class="form-check-input" id="sidebar_collapsed" />
                                            <label class="form-check-label" for="sidebar_collapsed">Perkecil Menu Samping</label>
                                        </div>
                                    </div>
                                    <!-- Format -->
                                    <div class="row mb-1">
                                        <div class="col-md-3">
                                            <x-jet-label class="form-label" for="theme" value="{{ __('Tema') }}"/>
                                            <select id="theme" wire:model.defer="state.theme" class="form-select">
                                                <option value="">Pilih Tema</option>
                                                @foreach($listTheme as $key => $tema)
                                                    <option value="{{ $key }}">{{ $tema }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <x-jet-label class="form-label" for="verticalMenuNavbarType" value="{{ __('Tipe Menu Samping') }}"/>
                                            <select id="verticalMenuNavbarType" wire:model.defer="state.verticalMenuNavbarType" class="form-select">
                                                <option value="">Pilih Tipe</option>
                                                @foreach($listMenuNavbarType as $key => $tipe)
                                                    <option value="{{ $key }}">{{ $tipe }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <x-jet-label class="form-label" for="navbarColor" value="{{ __('Warna Navbar Atas') }}"/>
                                            <select id="navbarColor" wire:model.defer="state.navbarColor" class="form-select">
                                                <option value="">Pilih Warna</option>
                                                @foreach($listNavbarColor as $key => $warna)
                                                    <option value="{{ $key }}">{{ $warna }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <x-jet-label class="form-label" for="footerType" value="{{ __('Tipe Footer / Kaki') }}"/>
                                            <select id="footerType" wire:model.defer="state.footerType" class="form-select">
                                                <option value="">Pilih Tipe</option>
                                                @foreach($listFooterType as $key => $tipe)
                                                    <option value="{{ $key }}">{{ $tipe }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                        <x-section-border/>--}}
                        </div>
                    </div>
                    <!-- card-body end -->
                    <div class="card-footer">
                        <div class="text-start">
                            <x-jet-button>
                                {{ __('Simpan Pengaturan') }}
                            </x-jet-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
