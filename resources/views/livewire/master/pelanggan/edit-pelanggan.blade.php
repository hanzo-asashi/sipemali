<div>
    @section('title', $title)
    @push('css')
    @endpush
    @isset($breadcrumbs)
        <x-breadcrumb :breadcrumbs="$breadcrumbs" :title="$title"/>
    @endisset

<!-- frequently asked questions tabs pills -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="col-md-6">
                <a href="{{ route('master.pelanggan.list') }}" class=""><i class="fa fa-arrow-alt-circle-left"></i> Kembali ke list pelanggan</a>
            </div>
        </div>
    </div>
    <!-- vertical tab pill -->
    <div class="row">
        <div class="col-12">
            <div class="col-lg-12 col-md-8 col-sm-12">
                <!-- pill tabs tab content -->
                <div class="card">
                    <div class="card-body">
                        <form wire:submit.prevent="submit" class="form form-horizontal">
                            <div class="row mb-3">
                                <div class="col-md-3 text-end">
                                    <label class="col-form-label" for="no_sambungan">No. Samb / No. Pel</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input wire:model.defer="pelanggan.no_sambungan" type="text"
                                               class="form-control @error('no_sambungan') is-invalid @enderror"
                                               id="no_sambungan" readonly aria-readonly="true"
                                        />
                                    </div>
                                    {{--                                            <p><small class="text-muted">Otomatis dari sistem</small></p>--}}
                                    <x-input-error :for="'no_sambungan'"/>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input wire:model.defer="pelanggan.no_pelanggan" type="text"
                                               class="form-control @error('no_pelanggan') is-invalid @enderror"
                                               id="no_pelanggan" placeholder="contoh : 7312111020355354" readonly aria-readonly="true"
                                        />
                                    </div>
                                    {{--                                            <p><small class="text-muted">Otomatis dari sistem</small></p>--}}
                                    <x-input-error :for="'no_pelanggan'"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3 text-end">
                                    <label class="col-form-label" for="nama_pelanggan">Nama Pelanggan</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input wire:dirty.class="is-valid" wire:model.lazy="pelanggan.nama_pelanggan" type="text" id="nama_pelanggan"
                                               class="form-control @error('nama_pelanggan') is-invalid @enderror" placeholder="contoh: Susi Susanti" autofocus
                                        />
                                        <x-input-error :for="'nama_pelanggan'"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3 text-end">
                                    <label class="col-form-label" for="alamat_pelanggan">Alamat Pelanggan</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input wire:dirty.class="is-valid" wire:model.lazy="pelanggan.alamat_pelanggan" type="text" id="alamat_pelanggan"
                                               class="form-control @error('alamat_pelanggan') is-invalid @enderror"
                                               placeholder="contoh : Jl. Raya"
                                        />
                                        <x-input-error :for="'alamat_pelanggan'"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3 text-end">
                                    <label class="col-form-label" for="basic-icon-default-contact">Zona / Golongan Pelanggan</label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group input-group-merge">
                                        <select wire:dirty.class="is-valid" wire:model.lazy="pelanggan.zona_id" id="country" class="select2 form-select @error('zona_id')
                                            is-invalid @enderror">
                                            <option value="">Pilih Zona</option>
                                            @foreach ($pageData['listZona'] as $key => $zona)
                                                <option value="{{ $key }}">{{ $zona}}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :for="'zona_id'"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group input-group-merge">
                                        <select wire:dirty.class="is-valid" wire:model.lazy="pelanggan.golongan_id" id="country"
                                                class="select2 form-select @error('golongan_id') is-invalid @enderror"
                                        >
                                            <option value="">Pilih Golongan</option>
                                            @foreach ($pageData['listGolongan'] as $key => $golongan)
                                                <option value="{{ $key }}">{{ $golongan}}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :for="'golongan_id'"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3 text-end">
                                    <label class="col-form-label" for="bulan_tahun">Bulan / Tahun Langganan</label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group input-group-merge">
                                        <select wire:dirty.class="is-valid" wire:model.lazy="pelanggan.bulan_langganan" id="bulan_tahun"
                                                class="form-select @error('bulan_langganan') is-invalid @enderror"
                                        >
                                            <option value="">Pilih Bulan Berlangganan</option>
                                            @foreach ($pageData['listBulan'] as $key => $bln)
                                                <option value="{{ $key }}">{{ $bln}}</option>
                                            @endforeach
                                        </select>

                                        <x-input-error :for="'bulan_langganan'"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group input-group-merge">
                                        {{--                                                <select wire:dirty.class="is-valid" wire:model.lazy="pelanggan.tahun_langganan" class="form-select @error('tahun_langganan')--}}
                                        {{--                                                    is-invalid @enderror">--}}
                                        {{--                                                    <option value="">Pilih Tahun Berlangganan</option>--}}
                                        {{--                                                    @foreach ($pageData['listTahun'] as $key => $thn)--}}
                                        {{--                                                        <option value="{{ $key }}">{{ $thn}}</option>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                </select>--}}
                                        <input class="form-control @error('tahun_langganan') is-invalid @enderror" wire:model.lazy="pelanggan.tahun_langganan"/>
                                        <x-input-error :for="'tahun_langganan'"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3 text-end">
                                    <label class="col-form-label" for="user-role">Status & Penagihan Pelanggan</label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group input-group-merge">
                                        <select wire:dirty.class="is-valid" wire:model.lazy="pelanggan.status_pelanggan" id="user-role"
                                                class="select2 form-select @error('status_pelanggan') is-invalid @enderror"
                                        >
                                            <option value="">Pilih Status Pelanggan</option>
                                            @foreach ($pageData['listStatus'] as $key => $status)
                                                <option value="{{ $key }}">{{ $status}}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :for="'status_pelanggan'"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group input-group-merge">
                                        <select wire:dirty.class="is-valid" wire:model.lazy="pelanggan.penagihan_pelanggan" id="user-plan"
                                                class="select2 form-select  @error('penagihan_pelanggan') is-invalid @enderror"
                                        >
                                            <option value="1">BIASA</option>
                                            <option value="2">KHUSUS</option>
                                        </select>
                                        <x-input-error :for="'penagihan_pelanggan'"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3 text-end">
                                    <label class="col-form-label" for="keterangan">Keterangan</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-merge">
                                                <textarea wire:dirty.class="is-valid" wire:model.lazy="pelanggan.keterangan"
                                                          class="form-control @error('keterangan') is-invalid @enderror"
                                                          id="keterangan" rows="3" placeholder="contoh: meteran air pelanggan terdaftar lebih dari 1."
                                                >

                                                </textarea>
                                        <x-input-error :for="'keterangan'"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 offset-sm-3">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input wire:dirty.class="is-valid" wire:model.lazy="pelanggan.is_valid" type="checkbox"
                                               class="form-check-input @error('is_valid') is-invalid @enderror" id="customCheck2"
                                        >
                                        <label class="form-check-label" for="customCheck2">Centang bila pelanggan dianggap valid.</label>
                                        <x-input-error :for="'is_valid'"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 offset-sm-3">
                                <x-button type="submit" class="btn-primary me-1">Ubah</x-button>
                                <x-button type="button" wire:click.prevent="buatDanKembali" class="btn-info me-1">
                                    Ubah & Keluar
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('script')
        {{--        @include('widgets.action-js')--}}
        {{--        @include('widgets.notifikasi')--}}
    @endpush
</div>
