<div>
    @section('title') {{ $title }} @endsection
    @push('css')
    @endpush
    @isset($breadcrumb)
        <x-breadcrumb :title="$title" :breadcrumbs="$breadcrumb"/>
    @endisset
    <div class="row">
        <div class="col-12">
            <div class="card border-secondary p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="col-sm-8 col-lg-8 d-flex justify-content-center justify-content-lg-start">
                        <div class="me-1">
                            <select wire:model="perPage" class="form-select">
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="me-1">
                            <input wire:model.debounce.300ms="search" value="{{ $search }}" type="search" class="form-control" placeholder="Cari disini...">
                        </div>
                        <div class="me-1">
                            <select wire:model="bulan" class="form-select text-capitalize mb-md-0 mb-2"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Filter Golongan">
                                <option value=""> Semua Bulan</option>
                                @foreach($pageData['listBulan'] as $key => $bulan)
                                    <option value="{{ $key }}">{{ $bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-1">
                            <select wire:model="golongan" class="form-select text-capitalize mb-md-0 mb-2"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Filter Golongan">
                                <option value=""> Semua Golongan</option>
                                @foreach($pageData['listGolongan'] as $key => $gol)
                                    <option value="{{ $key }}">{{ $gol }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-1">
                            <x-button wire:click.prevent="resetFilter" class="btn btn-icon btn-dark waves-effect waves-float waves-light"
                                      data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Reset Filter">
                                <i class="bx bx-reset align-middle font-size-18"></i>
                            </x-button>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                        <div class="d-flex align-items-center justify-content-center justify-content-lg-end">
                            @if($checked)
                                <x-nav-link wire:click="$emit('triggerDelete','delete','bulk')" class="btn btn-danger waves-effect waves-float waves-light">
                                    <span class="align-middle">Hapus Terpilih</span>
                                </x-nav-link>
                            @else
                                <a href="{{ route('cetak.preview',['page' => 'catat-meter']) }}" target="_blank"
                                   class="btn btn-secondary waves-effect waves-float waves-light me-1"
                                   type="button">
                                    <span><i class="bx bx-printer mt-1"></i> Cetak</span>
                                </a>
                                <x-button class="btn-primary"
                                          type="button" wire:click.prevent="addCatatMeter" wire:loading.attr="disabled">
                                    <x-loading-button wire:target="addCatatMeter"/>
                                    <i class="bx bx-plus mt-1"></i>
                                    Buat Catatan Meter
                                </x-button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive table-hover">
                        <thead class="text-uppercase align-middle">
                        <tr class="text-center">
                            <th style="width: 2%;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAllCatatMeter" wire:model="selectAllCatatMeter" @selected($selectAllCatatMeter)>
                                    <label class="form-check-label" for="selectAllCatatMeter"></label>
                                </div>
                            </th>
                            <th style="width: 8%;">No Sambungan</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th style="width: 3%;">Gol</th>
                            <th style="width: 5%;">Angka Meteran</th>
                            <th style="width: 5%;">Periode</th>
                            <th>Petugas</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($checked)
                        <tr>
                            <td colspan="8">
                                    <span class="text-dark font-medium-1 py-5">Terpilih
                                        <span class="badge badge-light-danger font-semibold">{{ count($checked) }}</span>
                                        dari {{ $pageData['totalData'] }} data.
                                        @if (!$selectAllMeter)
                                            <a href="#" wire:click.prevent="selectAllData">Pilih Semua data. </a>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger waves-float waves-effect waves-light"
                                                    wire:click.prevent="resetCheckbox">
                                                Batalkan Terpilih
                                            </button>
                                            <button type="button" class="btn btn-sm btn-success waves-float waves-effect waves-light"
                                                    wire:click.prevent="deleteAllData">
                                                Hapus Terpilih
                                            </button>
                                        @endif
                                    </span>
                            </td>
                        </tr>
                    @endif
                    @forelse($listCatatMeter as $meter)
                        <tr class="text-center {{ $this->isChecked($meter->id) ? 'bg-light' : '' }}">
                            <td>
                                <div class="form-check">
                                    <input id="list-meter-{{ $meter->id }}" value="{{ $meter->id }}" class="form-check-input" type="checkbox"
                                           wire:model="checked" wire:key="meter{{ $meter->id }}"/>
                                    <label class="form-check-label" for="list-meter-{{ $meter->id }}"></label>
                                </div>
                            </td>
                            <td>{{ !is_null($meter->customer) ? $meter->customer?->no_sambungan : '' }}</td>
                            <td>{{ !is_null($meter->customer) ? $meter->customer?->nama_pelanggan : '' }}</td>
                            <td>{{ !is_null($meter->customer) ? $meter->customer?->alamat_pelanggan : '' }}</td>
                            <td>{{ !is_null($meter->customer) ? $meter->customer?->golonganTarif?->kode_golongan : '' }}</td>
                            <td>{{ $meter->angka_meter_baru }}</td>
                            <td>{{ \App\Utilities\Helpers::getNamaBulanIndo(5) }}</td>
                            <td>{{ !is_null($meter->petugas) ? $meter->petugas->name : 'N/A' }}</td>
                            <td class="text-end">
                                @can('update_catatmeter')
                                    <button wire:loading.attr="disabled"
                                            wire:click.prevent="editCatatMeter({{ $meter->id }})"
                                            wire:target="editCatatMeter({{ $meter->id }})"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                            data-bs-original-title="Ubah Catatan Meter"
                                            type="button" class="btn btn-icon btn-sm btn-info waves-effect waves-float waves-light">
                                        <i class="far fa-edit"></i>
                                    </button>
                                @endcan

                                @can('delete_catatmeter')
                                    <button wire:loading.attr="disabled"
                                            wire:click.prevent="destroy({{$meter->id}},'single')"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title
                                            data-bs-original-title="Hapus Catatan Meter"
                                            type="button" class="btn btn-icon btn-sm btn-danger waves-effect waves-float waves-light">
                                        <i class="far fa-trash"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <x-no-table-data :use-image="true" :colspan="9"/>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination Start -->
            <x-pagination :datalinks="$listCatatMeter" :page="$pageData['page']" :total-data="$pageData['totalData']" :page-count="$pageData['pageCount']"/>
            <!-- Pagination end -->
        </div>
    </div>

    {{-- Modal Tambah Status --}}
    <x-modal :id="$modalId" :title="'Catat Meter'" :maxWidth="''" :update-mode="$updateMode">
        <form wire:submit.prevent="{{ $updateMode ? 'updateCatatMeter' : 'storeCatatMeter' }}" class="needs-validation" novalidate>
            <div class="modal-body">
                <x-label for="name" :value="'Pelanggan'"/>
                <div class="mb-1">
                    <x-tom-select
                        id="selectPelanggan"
                        name="state.customer_id"
                        wire:model="state.customer_id"
                        :selected-items="$selectedItems"
                        :selected-items="[$selectedItem]"
                        :options="$listPelanggan"
                        placeholder="Pilih Pelanggan"
                        class="form-select"
                        autocomplete="off"
                    />
                    <x-input-error :for="'customer_id'"/>
                </div>

                <input class="form-control" wire:model.defer="state.angka_meter_lama" type="hidden">

                <x-label for="angka_meter_baru" :value="'Angka Meteran'"/>
                <div class="mb-1">
                    <input class="form-control @error('angka_meter_baru') is-invalid @enderror"
                           wire:model.defer="state.angka_meter_baru" type="text" placeholder="contoh: 1986">
                    <x-input-error :for="'angka_meter_baru'"/>
                </div>

                <x-label for="bulan" :value="'Bulan'"/>
                <div class="mb-1">
                    <select class="form-control @error('bulan') is-invalid @enderror"
                           wire:model.defer="state.bulan">
                        <option value="">Semua Bulan</option>
                        @foreach($pageData['listBulan'] as $key => $bulan)
                            <option value="{{ $key }}">{{ $bulan }}</option>
                        @endforeach
                    </select>
                    <x-input-error :for="'bulan'"/>
                </div>
                <x-label for="keterangan" :value="'Keterangan'"/>
                <div class="mb-1">
                    <input class="form-control @error('keterangan') is-invalid @enderror" wire:model.defer="state.keterangan" type="text">
                    <x-input-error :for="'keterangan'"/>
                </div>
            </div>
            <div class="modal-footer">
                <x-button type="submit" class="btn-primary" wire:loading.attr="disabled">
                    <i class="bx bx-save mt-1"></i>
                    {{ $updateMode ? 'Update' : 'Simpan' }}
                </x-button>
                <x-button type="button" wire:click.prevent="$emit('resetField')" data-bs-dismiss="modal" class="btn btn-danger">
                    <i class="bx bx-x mt-1"></i>
                    Batal
                </x-button>
            </div>
        </form>
    </x-modal>

    <!-- Hoverable rows end -->
    @push('script')
        <script>
            window.addEventListener('openModal', event => {
                {{--$('#{{ $modalId }}').modal('show');--}}
                $('#modal-catatmeter').modal('show');
            })
            window.addEventListener('closeModal', event => {
{{--                $('#{{ $modalId }}').modal('hide');--}}
                $('#modal-catatmeter').modal('hide');
            })

            /* Clear selection pelanggan */
            // window.addEventListener('clearPelanggan', event => {
            //     TomSelect('#selectPelanggan').clear();
            //     $('#selectPelanggan').clear();
            // });
            // window.addEventListener('customerId', event => {
            //     TomSelect('#selectPelanggan').clear();
            // });
        </script>
    @endpush
</div>
