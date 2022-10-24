<div>
    @section('title', $title ?: 'List Golongan Tarif')
    @push('style')
    @endpush
    @isset($breadcrumbs)
        <x-breadcrumb :breadcrumbs="$breadcrumbs" :title="$title"/>
    @endisset
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body bg-soft-light p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-sm-8 col-md-5 col-lg-6 d-flex justify-content-center justify-content-lg-start">
                            @if(!$selectAllRows)
                                <div class="col-md-6">
                                    <input wire:model.debounce.500ms="search" value="{{ $search }}" type="search" class="form-control" placeholder="Cari disini...">
                                </div>
                            @else
                                <div wire:ignore.self>
                                    <x-button wire:click="destroy(0,'bulk')" class="btn-danger" type="button">
                                        <i class="bx bx-trash me-1"></i>
                                        <span>Hapus Terpilih</span>
                                    </x-button>
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                            <div class="d-flex align-items-center justify-content-center justify-content-lg-end">
                                <x-button class="btn-primary" type="button" data-bs-toggle="modal" wire:click.prevent="addGolongan">
                                    <x-loading-button :target="'addGolongan'"/>
                                    <span>Buat Golongan</span>
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-responsive table-hover table-flush-spacing">
            <thead class="align-middle">
            <tr class="text-center">
                <th class="align-middle" style="width: 2%;">
                    <div class="form-check">
                        <input class="form-check-input" id="selectAll" type="checkbox" wire:model="selectAllRows">
                        <label class="form-check-label" for="selectAll"></label>
                    </div>
                </th>
                <th class="text-center" style="width: 3%;">Kode</th>
                <th class="text-center ">Golongan</th>
                <th class="text-center " style="width: 12%;">Tarif Blok A</th>
                <th class="text-center " style="width: 12%;">Tarif Blok B</th>
                <th class="text-center " style="width: 12%;">Tarif Blok C</th>
                <th class="text-center " style="width: 12%;">Tarif Blok D</th>
                <th class="text-center " style="width: 5%;">Biaya Layanan</th>
                <th class="text-center " style="width: 8%;"></th>
            </tr>
            </thead>
            <tbody>
            @if($selectedRows)
                <tr class="mb-2 mt-2 mx-2">
                    <td colspan="13">
                        <span class="text-dark font-medium-1 py-5">Terpilih
                            <span class="badge bg-success font-semibold">{{ count($selectedRows) }}</span>
                            dari
                            <span class="badge bg-info font-semibold">{{ $pageData['totalData'] }}</span>
                            data.
{{--                            @if (!$selectAllRows)--}}
                                <x-button type="button" class="btn-success btn-sm" wire:click.prevent="selectAllData">
                                    Pilih Semua Golongan
                                    <x-loading-button :target="'selectAllData'"/>
                                </x-button>
{{--                            @else--}}
                                <x-button type="button" class="btn-warning btn-sm" href="#" wire:click.prevent="resetCheckbox">
                                    Batalkan terpilih
                                    <x-loading-button :target="'resetCheckbox'"/>
                                </x-button>
{{--                            @endif--}}
                        </span>
                    </td>
                </tr>
            @endif
            @forelse($listGolongan as $gol)
                <tr>
                    <td>
                        <div class="form-check">
                            <input id="list-golongan-{{ $gol->id }}" value="{{ $gol->id }}" class="form-check-input" type="checkbox"
                                   wire:model="selectedRows" wire:key="list-golongan-{{ $gol->id }}">
                        </div>
                    </td>
                    <td class="text-center">{{ $gol->kode_golongan }}</td>
                    <td>
                        {{ $gol->deskripsi }} <span class="badge badge-light-primary">{{ $gol->nama_golongan }}</span>
                    </td>
                    <td class="text-center">{{ number_format($gol->tarif_blok_1,0,',','.') }} ({{ $gol->blok_1 }})</td>
                    <td class="text-center">{{ number_format($gol->tarif_blok_2,0,',','.')}} ({{ $gol->blok_2 }})</td>
                    <td class="text-center">{{ number_format($gol->tarif_blok_3,0,',','.') }} ({{ $gol->blok_3 }})</td>
                    <td class="text-center">{{ number_format($gol->tarif_blok_4,0,',','.') }} ({{ $gol->blok_4 }})</td>
                    <td class="text-center">{{ number_format($gol->biaya_administrasi,0,',','.') }}</td>
                    <td>
                        <div class="d-flex flex-wrap justify-content-center align-items-center gap-1">
                            @can('edit golongan')
                                <x-button wire:click.prevent="editGolongan({{ $gol->id }})" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                          data-bs-original-title="Edit Golongan"
                                          type="button" class="btn-icon btn-sm btn-info">
                                    <i class="mdi mdi-pencil"></i>
                                </x-button>
                            @endcan
                            @can('delete golongan')
                                <x-button wire:click="destroy({{ $gol->id }},'single')" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                          data-bs-original-title="Hapus Golongan"
                                          type="button" class="btn-icon btn-sm btn-danger">
                                    <i class="mdi mdi-trash-can"></i>
                                </x-button>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="text-danger text-center">Maaf, data golongan tarif tidak ditemukan</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination Start -->
    <x-pagination :datalinks="$listGolongan" :page="$pageData['page']" :total-data="$pageData['totalData']" :page-count="$pageData['pageCount']"/>
    <!-- Pagination end -->

    {{-- Modal Tambah List Golongan--}}
    <x-modal :id="$modalId" :maxWidth="'lg'" :title="'Golongan'" :update-mode="$updateMode">
        <form wire:submit.prevent="{{ $updateMode ? 'updateGolongan' : 'storeGolongan' }}" class="needs-validation" novalidate>
            <div class="modal-body">
                <div class="row">
                    <!-- Start Field Kode Golongan  -->
                    <div class="col-md-6">
                        <x-label for="kode" :value="'Kode Golongan'"/>
                        <div class="mb-3">
                            <input class="form-control @error('kode_golongan') is-invalid @enderror"
                                   wire:model.defer="golongan.kode_golongan" type="text" placeholder="contoh : 111,121,211" autofocus
                            />
                            <x-input-error :for="'kode_golongan'"/>
                        </div>
                    </div>
                    <!-- End Field Kode Golongan  -->

                    <!-- Field Nama Golongan  -->
                    <div class="col-md-6">
                        <x-label for="nama_golongan" :value="'Nama Golongan'"/>
                        <div class="mb-3">
                            <input class="form-control @error('nama_golongan') is-invalid @enderror"
                                   wire:model.defer="golongan.nama_golongan" type="text" placeholder="contoh: SU, SK, RT-A"/>
                            <x-input-error :for="'nama_golongan'"/>
                        </div>
                    </div>
                    <!-- End Field Nama Golongan  -->
                </div>

                <!-- Field Deskripsi  -->
                <x-label for="deskripsi" :value="'Deskripsi'"/>
                <div class="mb-3">
                    <input class="form-control @error('deskripsi') is-invalid @enderror"
                           wire:model.defer="golongan.deskripsi" type="text" placeholder="contoh : Sosial Umum, Sosial Khusus"/>
                    <x-input-error :for="'deskripsi'"/>
                </div>
                <!-- End Field Deskripsi  -->

                <div class="row">
                    <!-- Field Blok 1  -->
                    <div class="col-md-3">
                        <x-label for="blok_1" :value="'Blok A (0 - 10 M3)'"/>
                        <div class="mb-3">
                            <input class="form-control @error('blok_1') is-invalid @enderror"
                                   wire:model.defer="golongan.blok_1" type="text" label="0 - 10 m3" placeholder="1, 2, 3,...,10"/>
                            <x-input-error :for="'blok_1'"/>
                        </div>
                    </div>
                    <!-- Field Blok 1  -->

                    <!-- Field Blok 2  -->
                    <div class="col-md-3">
                        <x-label for="blok_2" :value="'Blok B (11 - 20 M3)'"/>
                        <div class="mb-3">
                            <input class="form-control @error('blok_2') is-invalid @enderror"
                                   wire:model.defer="golongan.blok_2" type="text" label="11 - 20 m3" placeholder="11, 12, 13,...,20"/>
                            <x-input-error :for="'blok_2'"/>
                        </div>
                    </div>
                    <!-- End Field Blok 2  -->

                    <!-- Field Blok 3  -->
                    <div class="col-md-3">
                        <x-label for="blok_3" :value="'Blok C (21 - 30 M3)'"/>
                        <div class="mb-3">
                            <input class="form-control @error('blok_3') is-invalid @enderror"
                                   wire:model.defer="golongan.blok_3" type="text" label="21 - 30 m3" placeholder="21, 22, 23,...,30"/>
                            <x-input-error :for="'blok_3'"/>
                        </div>
                    </div>
                    <!-- End Field Blok 3  -->

                    <!-- Field Blok 4  -->
                    <div class="col-md-3">
                        <x-label for="blok_4" :value="'Blok D (> 30 M3)'"/>
                        <div class="mb-3">
                            <input class="form-control @error('blok_4') is-invalid @enderror"
                                   wire:model.defer="golongan.blok_4" type="text" label="> 30 m3" placeholder="31, 32, 33,..."/>
                            <x-input-error :for="'blok_4'"/>
                        </div>
                    </div>
                    <!-- End Field Blok 4  -->
                </div>

                <div class="row">
                    <!-- Field Tarif Blok 1 -->
                    <div class="col-md-3">
                        <x-label for="tarif_blok_1" :value="'Tarif A'"/>
                        <div class="mb-3">
                            <input class="form-control @error('tarif_blok_1') is-invalid @enderror"
                                   wire:model.defer="golongan.tarif_blok_1" type="text" label="Tarif A" placeholder="Rp. 1.750"/>
                            <x-input-error :for="'tarif_blok_1'"/>
                        </div>
                    </div>
                    <!-- End Field Tarif Blok 1 -->

                    <!-- Field Tarif Blok 2 -->
                    <div class="col-md-3">
                        <x-label for="tarif_blok_2" :value="'Tarif B'"/>
                        <div class="mb-3">
                            <input class="form-control @error('tarif_blok_2') is-invalid @enderror"
                                   wire:model.defer="golongan.tarif_blok_2" type="text" label="Tarif B" placeholder="Rp. 2.500"/>
                            <x-input-error :for="'tarif_blok_2'"/>
                        </div>
                    </div>
                    <!-- End Field Tarif Blok 2 -->

                    <!-- Field Tarif Blok 3 -->
                    <div class="col-md-3">
                        <x-label for="tarif_blok_3" :value="'Tarif C'"/>
                        <div class="mb-3">
                            <input class="form-control @error('tarif_blok_3') is-invalid @enderror"
                                   wire:model.defer="golongan.tarif_blok_3" type="text" label="Tarif C" placeholder="Rp. 2.600"/>
                            <x-input-error :for="'tarif_blok_3'"/>
                        </div>
                    </div>
                    <!-- End Field Tarif Blok 3 -->

                    <!-- Field Tarif Blok 4 -->
                    <div class="col-md-3">
                        <x-label for="tarif_blok_4" :value="'Tarif D'"/>
                        <div class="mb-3">
                            <input class="form-control @error('tarif_blok_4') is-invalid @enderror"
                                   wire:model.defer="golongan.tarif_blok_4" type="text" label="Tarif D" placeholder="Rp. 3.500"/>
                            <x-input-error :for="'tarif_blok_4'"/>
                        </div>
                    </div>
                    <!-- End Field Tarif Blok 4 -->
                </div>

                <!-- Field Biaya Administrasi -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <x-label for="biaya_administrasi" :value="'Biaya Layanan'"/>
                        <div class="mb-3">
                            <input class="form-control @error('biaya_administrasi') is-invalid @enderror"
                                   wire:model.defer="golongan.biaya_administrasi" type="text" label="Biaya Layanan" placeholder="Rp. 2.000"/>
                            <x-input-error :for="'biaya_administrasi'"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <x-label for="dana_meter" :value="'Dana Meter'"/>
                        <div class="mb-3">
                            <input class="form-control @error('dana_meter') is-invalid @enderror"
                                   wire:model.defer="golongan.dana_meter" value="2.500" type="text" label="Dana Meter" placeholder="Rp. 2.000"/>
                            <x-input-error :for="'dana_meter'"/>
                        </div>
                    </div>
                </div>
                <!-- End Field Biaya Administrasi -->

                {{--                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">--}}
                {{--                    {{ $updateMode ? 'Ubah' : 'Simpan' }}--}}
                {{--                </button>--}}
                {{--                <button type="button" wire:click.prevent="$emit('resetField')" data-bs-dismiss="modal" class="btn btn-danger">Batal</button>--}}

            </div>
            <div class="modal-footer">
                <x-button type="submit" class="btn-primary" wire:loading.attr="disabled">
                    @if($updateMode)
                        <x-loading-button :target="'updateGolongan'"/>
                        Ubah
                    @else
                        <x-loading-button :target="'storeGolongan'"/>
                        Simpan
                    @endif
                </x-button>
                <x-button type="button" wire:click.prevent="$emit('resetField')" data-bs-dismiss="modal" class="btn btn-danger">Batal</x-button>
            </div>
        </form>
    </x-modal>
    <!-- Hoverable rows end -->
    @push('script')
        {{--        @include('widgets.action-js')--}}
        <script>
            window.addEventListener('openModal', event => {
                $('#{{ $modalId }}').modal('show');
            })
            window.addEventListener('closeModal', event => {
                $('#{{ $modalId }}').modal('hide');
            })
        </script>
    @endpush
</div>
