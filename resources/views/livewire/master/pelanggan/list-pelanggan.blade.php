<div>
    @section('title', $title)
    @isset($breadcrumbs)
        <x-breadcrumb :breadcrumbs="$breadcrumbs" :title="$title"/>
    @endisset
    <div class="row">
        <x-stats class="col-lg-6 col-sm-12" :value="$totalPelangganValid" :color="'bg-success'" :title="'Total Pelanggan Valid'">
            <i class="far fa-user-check font-medium-2"></i>
        </x-stats>
        <x-stats class="col-lg-6 col-sm-12" :value="$totalPelangganTidakValid" :color="'bg-danger'" :title="'Total Pelanggan Tidak Valid'">
            <i class="far fa-user-times font-medium-2"></i>
        </x-stats>
    </div>

    <!-- Hoverable rows start -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="col-sm-8 col-lg-8 d-flex justify-content-center justify-content-lg-start">
                    <div class="me-1">
                        <input wire:model.debounce.300ms="search" value="{{ $search }}" type="search" class="form-control" placeholder="Cari disini...">
                    </div>
                    <div class="me-1">
                        <select wire:model="zona" class="form-select text-capitalize mb-md-0 mb-2">
                            <option value=""> Semua Zona</option>
                            @foreach($pageData['listZona'] as $key => $zona)
                                <option value="{{ $key }}">{{ $zona }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="me-1">
                        <select wire:model="golongan" id="FilterTransaction" class="form-select text-capitalize mb-md-0 mb-2">
                            <option value=""> Semua Golongan</option>
                            @foreach($pageData['listGolongan'] as $key => $gol)
                                <option value="{{ $key }}">{{ $gol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="me-1">
                        <select wire:model="status" id="FilterTransaction" class="form-select text-capitalize mb-md-0 mb-2">
                            <option value=""> Semua Status</option>
                            @foreach($pageData['listStatus'] as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="me-1">
                        <select wire:model="valid" class="form-select text-capitalize mb-md-0 mb-2">
                            <option value=""> Semua Valid</option>
                            <option value="1" class="text-capitalize">Valid</option>
                            <option value="0" class="text-capitalize">Tidak Valid</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-end">
                        @if($selectedRows)
                            <div wire:ignore.self>
                                <x-dropdown>
                                    <x-button class="btn btn-outline-secondary waves-effect waves-float waves-light me-1"
                                              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Pilih Aksi
                                        <i class="far fa-chevron-down font-small-2"></i>
                                    </x-button>
                                    <x-dropdown-item>
                                        <x-nav-link wire:click="$emit('triggerDelete','delete','bulk')" class="dropdown-item">
                                            <span class="align-middle"><i class="far fa-trash-alt"></i> Hapus Terpilih</span>
                                        </x-nav-link>
                                    </x-dropdown-item>
                                </x-dropdown>
                            </div>
                        @else
                            <a href="{{ route('master.pelanggan.create') }}" class="btn btn-primary waves-effect waves-float waves-light" type="button"
                               wire:loading.attr="disabled">
                                <span>Tambah Pelanggan</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hoverable rows end -->
    <div class="justify-content-lg-center align-items-lg-center" wire:loading.flex>
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-responsive table-hover table-bordered">
                    <thead>
                    <tr class="text-center">
                        <th style="width: 5%;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAllPelanggan" wire:model="selectAllRows" @selected($selectAllRows)/>
                                <label class="form-check-label" for="selectAllPelanggan"></label>
                            </div>
                        </th>
                        <th style="width: 11%;">No Sambungan</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th style="width: 12%;">Zona</th>
                        <th style="width: 8%;">Golongan</th>
                        <th style="width: 8%;">Status</th>
                        <th style="width: 3%;">Valid</th>
                        <th style="width: 5%;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                    @php $i = 1 @endphp--}}
                    @if($selectedRows)
                        <tr class="mb-2 mt-2 mx-2">
                            <td colspan="9">
                                    <span class="text-dark font-medium-1">Terpilih
                                        <span class="font-semibold text-danger">{{ count($selectedRows) }}</span>
                                        dari {{ $pageData['totalData'] }} data.
                                        @if (!$selectAllRows)
                                            <a href="#" wire:click.prevent="selectAllData">Pilih Semua data</a>
                                        @else

                                            <button type="button" class="btn btn-sm btn-danger waves-float waves-effect waves-light"
                                                    wire:click.prevent="resetSelectedRows">
                                                Batalkan Terpilih
                                            </button>
                                            @can('delete pelanggan')
                                                <button type="button" class="btn btn-sm btn-success waves-float waves-effect waves-light"
                                                        wire:click.prevent="deleteAllPelanggan">
                                                Hapus Terpilih
                                            </button>
                                            @endcan
                                        @endif
                                    </span>
                            </td>
                        </tr>
                    @endif
                    @forelse($listCustomers as $cust)
                        <tr class="text-center">
                            <td>
                                <div class="form-check">
                                    <input id="list-pelanggan-{{ $cust->id }}" value="{{ $cust->id }}" class="form-check-input" type="checkbox"
                                           wire:model="selectedRows" wire:key="{{ $cust->id }}">
                                    <label class="form-check-label" for="list-pelanggan-{{ $cust->id }}"></label>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('master.pelanggan.show',  ['id' => Hashids::encode($cust->id)]) }}">
                                    <span class="fw-bold">{{ $cust->no_sambungan }}</span>
                                </a>
                            </td>
                            <td>{{ $cust->nama_pelanggan }}</td>
                            <td>
                                {{ $cust->alamat_pelanggan}}
                            </td>
                            <td>
                                {{  isset($cust->zona) ?  $cust->zona->wilayah : '-' }}
                            </td>
                            <td>
                                {{ isset($cust->golonganTarif) ?  $cust->golonganTarif->nama_golongan : '-' }}
                            </td>
                            <td>
                                    <span class="badge rounded-pill bg-{{ \App\Utilities\Helpers::setBadgeColor($cust->status_pelanggan) }} me-1">
                                        {{ isset($cust->statusPelanggan) ? $cust->statusPelanggan->nama_status : '-' }}
                                    </span>
                            </td>
                            <td>
                                     <span class="badge rounded-pill bg-{{ $cust->is_valid ? 'success' : 'danger' }} me-1">
                                        {!! $cust->is_valid ? '<i class="bx bx-user-check font-size-13"></i>' : '<i class="bx bx-x font-size-13"></i>'  !!}
                                    </span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <i class="fas fa-ellipsis-v font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @can('show pelanggan')
                                            <a href="{{ route('master.pelanggan.show', ['id' => $cust->hashId]) }}" class="dropdown-item">Detail Pelanggan</a>
                                        @endcan
                                        @can('update pelanggan')
                                            <a href="{{ route('master.pelanggan.edit', ['id' => $cust->hashId]) }}" class="dropdown-item">Ubah Pelanggan</a>
                                        @endcan
                                        @can('update status')
                                            <a href="#" wire:click.prevent="updateStatus({{ $cust->id }})" class="dropdown-item">
                                                {{ $cust->is_valid ? 'Ubah Status Non Valid' : 'Ubah Status Valid' }}
                                            </a>
                                        @endcan
                                        @can('create pembayaran')
                                            <a href="#" wire:click.prevent="bayarTagihan({{ $cust->id }})" class="dropdown-item bayartagihan">Bayar Tagihan</a>
                                        @endcan
                                        @can('delete pelanggan')
                                            <a href="#" wire:click.prevent="destroy({{ $cust->id }},'single')" class="dropdown-item">Hapus Pelanggan</a>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-danger text-center">Maaf, data tidak ditemukan</td>
                        </tr>
                    @endforelse
                    </tbody>
                    {{--                    <tfoot>--}}
                    {{--                    <tr>--}}
                    {{--                        <td colspan="4" class="text-start border-0">--}}
                    {{--                            <div class="text-muted" role="status" aria-live="polite">--}}
                    {{--                                Menampilkan {{ $pageData['page'] }} sampai {{ $pageData['pageCount'] }} dari {{ $pageData['totalData'] }} entri--}}
                    {{--                            </div>--}}
                    {{--                        </td>--}}
                    {{--                        <td colspan="5" class="text-center border-0">--}}
                    {{--                            {{ $listCustomers->links() }}--}}
                    {{--                        </td>--}}
                    {{--                    </tr>--}}
                    {{--                    </tfoot>--}}
                </table>
            </div>
            <!-- Pagination Start -->
            <x-pagination :datalinks="$listCustomers" :page="$pageData['page']" :total-data="$pageData['totalData']"
                          :page-count="$pageData['pageCount']"/>
            <!-- Pagination end -->
        </div>
    </div>
    @include('widgets.modal-bayar')
    @push('script')
        <script>
            $(".bayartagihan").on('click', function () {
                Pace.start();
            });

            window.addEventListener('loading', event => {
                console.log(event.detail);
                if (event.details.show) {
                    Pace.stop();
                    // Pace.restart();
                }
            });
            window.addEventListener('openModal', event => {
                $('#modal-bayar').modal('show');
            });
            $("#modal-bayar").on('shown.bs.modal', function () {
                $(this).find('#total_bayar').focus();
            });
            window.addEventListener('closeModal', event => {
                $('#modal-bayar').modal('hide');
            });
        </script>
    @endpush
</div>
