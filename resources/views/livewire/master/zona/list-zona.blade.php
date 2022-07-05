<div>
    @section('title', $title ?? '')
    @push('css')
    @endpush
    <div class="row">
        <div class="col-xl-4">
            <x-card>
                <x-card-header>
                    <h4 class="card-title">{{ $updateMode ? 'Ubah Zona' : 'Buat Zona' }}</h4>
                </x-card-header>
                <form wire:submit.prevent="{{ $updateMode ? 'updateZona' : 'storeZona' }}" class="needs-validation" novalidate>
                    <x-card-body>
                        <x-label for="wilayah" :value="'Wilayah'"/>
                        <div class="mb-1">
                            <input class="form-control @error('wilayah') is-invalid @enderror"
                                   wire:model.defer="state.wilayah" type="text" placeholder="contoh: BNA">
                            <x-input-error :for="'wilayah'"/>
                        </div>

                        <x-label for="kode" :value="'Kode'"/>
                        <div class="mb-1">
                            <input class="form-control @error('kode') is-invalid @enderror" wire:model.defer="state.kode" type="text" placeholder="Kode">
                            <x-input-error :for="'kode'"/>
                        </div>
                    </x-card-body>
                    <div class="card-footer">
                        <x-button type="submit" wire:loading.attr="disabled" class="btn-primary"> {{ $updateMode ? 'Update' : 'Simpan' }}</x-button>
                        <x-button wire:click.prevent="resetField" class="btn-danger">Batal</x-button>
                    </div>
                </form>
            </x-card>
        </div>
        <div class="col-xl-8">
            <x-card>
                <x-card-header>
                    <h4 class="card-title">{{ $title ?? 'List Zona' }}</h4>
                </x-card-header>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-content-center align-items-center pt-2 pb-2">
                            <div class="p-2 flex-shrink-0 flex-grow-0">
                                <!-- Per Page Start -->
                                <div class="input-group">
                                    <div class="input-group-text">Hal :</div>
                                    @include('widgets.page')
                                </div>
                                <!-- Per Page End -->
                            </div>
                            @if($checked)
                                <div class="p-2 flex-shrink-0 flex-grow-0">
                                    @include('widgets.bulk-action')
                                </div>
                            @else
                                <div class="p-2 flex-shrink-1 flex-grow-1">
                                    @include('widgets.search-table')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <x-table class="table-bordered table-responsive table-hover table-nowrap align-middle">
                        <x-table.table-head>
                        <tr class="text-center text-uppercase">
                            <th scope="col" style="width: 50px;">
                                <div class="form-check font-size-16">
                                    <input type="checkbox" class="form-check-input" id="checkAllZona" wire:model="selectAllCheckbox"/>
                                    <label class="form-check-label" for="checkAllZona"></label>
                                </div>
                            </th>
                            <th class="text-center" style="width: 5%;">Kode</th>
                            <th>Wilayah</th>
                            <th class="text-center" style="width: 8%;"></th>
                        </tr>
                        </x-table.table-head>
                        <x-table.table-body>
                        @forelse($listZona as $zona)
                            <tr class="@if($this->isChecked($zona->id)) text-primary @endif text-center">
                                <th scope="row">
                                    <div class="form-check font-size-16">
                                        <input id="zona-{{ $zona->id }}" value="{{ $zona->id }}"
                                               type="checkbox" class="form-check-input" wire:model="checked" wire.key="{{$zona->id }}"/>
                                        <label class="form-check-label" for="zona-{{ $zona->id }}"></label>
                                    </div>
                                </th>
                                <td>
                                    {{ $zona->kode }}
                                </td>
                                <td class="text-start">{{ $zona->wilayah }}</td>
                                <td>
                                    @can('update_zona')
                                        <button wire:click.prevent="editZona({{ $zona->id }})" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                                data-bs-original-title="Edit Zona"
                                                type="button" class="btn btn-icon btn-sm btn-info waves-effect waves-float waves-light">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    @endcan
                                    @can('delete_zona')
                                        <button wire:click="destroy({{ $zona->id }},'single')" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                                data-bs-original-title="Hapus Zona" wire:loading.attr="disabled"
                                                type="button" class="btn btn-icon btn-sm btn-danger waves-effect waves-float waves-light">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-danger text-center">Maaf, data tidak ditemukan</td>
                            </tr>
                        @endforelse
                        </x-table.table-body>
                    </x-table>
                </div>
                <!-- Pagination Start -->
                <x-pagination :datalinks="$listZona" :page="$pageData['page']" :total-data="$pageData['totalData']" :page-count="$pageData['pageCount']"/>
                <!-- Pagination end -->
            </x-card>
        </div>
    </div>

    <!-- Hoverable rows end -->
    @push('script')
        <script></script>
    @endpush
</div>
