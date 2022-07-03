<div>
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="mb-3">
                <h5 class="card-title">Semua Pengguna <span class="text-muted fw-normal ms-2">({{ $checked ? count($checked) : $users->count() }})</span></h5>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                <div>
                    <a href="{{ route('pengguna.create')  }}" class="btn btn-label btn-primary">
                        <i class="bx bx-plus me-1 label-icon"></i>
                        Tambah Pengguna
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card bg-soft-light border-secondary">
        <div class="card-body p-2">
            <form>
                <div class="row">
                    <div class="col-md-3">
                        <div>
                            <label class="form-label" for="search">Pencarian</label>
                            @include('widget.search-table')
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div>
                            <label class="form-label" for="form-sm-input">Baris</label>
                            @include('widget.page')
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div wire:ignore>
                            <label class="form-label" for="hak-akses">Hak Akses</label>
                            <select wire:model="selectedRole" class="form-select form-select-sm">
                                <option value="">Semua Hak Akses</option>
                                @foreach($listRoles as $key => $role)
                                    <option wire:key="{{ $key }}" value="{{ $key }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div>
                            <label class="form-label" for="status">Status</label>
                            <select wire:model="selectedStatus" class="form-select form-select-sm">
                                <option value="">Semua Status</option>
                                @foreach($listStatus as $key => $stat)
                                    <option wire:key="{{ $key }}" value="{{ $key }}">{{ $stat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div>
                            @can('manage user')
                                @include('widget.bulk-action')
                            @endcan
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- end row -->

    <div class="table-responsive mb-4">
        <x-table class="align-middle table-check nowrap">
            <x-table.table-head>
                <th scope="col" style="width: 50px;">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="checkAll" wire:model="selectAll"/>
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </th>
{{--                <th scope="col">NIK</th>--}}
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Akses</th>
                <th scope="col">Status</th>
                <th style="width: 100px; min-width: 80px;">Action</th>
            </x-table.table-head>
            <x-table.table-body>
                @forelse($listUsers as $user)
{{--                    @dd($listUsers)--}}
                    <tr wire:loading.class="opacity-50">
                        <th scope="row">
                            <div class="form-check font-size-16">
                                <input value="{{ $user->id }}" type="checkbox" id="user-{{ $user->id }}" class="form-check-input"
                                       wire:model="checked" wire.key="{{ $user->id }}"/>
                                <label class="form-check-label" for="user-{{ $user->id }}"></label>
                            </div>
                        </th>
                        {{--                        <td>{{ $user->nik }}</td>--}}
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge font-size-12 badge-soft-{{ $user->is_admin ? 'warning' : 'success' }}">
                                {{ $user->getRoleNames()[0] }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-soft-{{ $user->status === 1 ? 'success' : 'danger' }} font-size-12">
                                {{ $user->status === 1 ? 'Aktif' : 'Non Aktif' }}
                            </span>
                        </td>
                        <td>
                            @can('manage user')
                                <div class="d-flex flex-wrap gap-2">
                                    @can('update user')
                                        <x-nav-link class="btn-sm btn-soft-info waves-effect waves-light"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit Pengguna" wire:key="{{ $user->id }}" href="{{ route('pengguna.edit', $user->id) }}"
                                        >
                                            <i class="bx bx-edit font-size-14 align-middle"></i>
                                        </x-nav-link>
                                    @endcan
                                    @can('delete user')
                                        <x-button wire:click="$emit('triggerDelete',{{ $user->id }},'single')"
                                                  class="btn-sm btn-soft-danger waves-effect waves-light" data-bs-toggle="tooltip"
                                                  data-bs-placement="top" title="Hapus Data">
                                            <i class="bx bx-trash font-size-14 align-middle"></i>
                                        </x-button>
                                    @endcan
                                </div>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <x-no-table-data :colspan="7" />
                @endforelse
            </x-table.table-body>
        </x-table>
        <!-- end table -->
        <x-pagination>
            {{ $listUsers->links() }}
        </x-pagination>
    </div>
    <!-- users list ends -->
</div>

@push('script')
    <!--suppress JSJQueryEfficiency -->
    @include('widget.action-js')
@endpush
