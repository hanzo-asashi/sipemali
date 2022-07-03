<div>
@section('title', $title)
@push('vendor-style')
@endpush

@push('page-style')
@endpush
<!-- Hoverable rows start -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-sm-8 col-lg-8 d-flex justify-content-center justify-content-lg-start">
                            <div class="me-1">
                                <input wire:model="search" value="{{ $search }}" type="search" class="form-control" placeholder="Cari disini...">
                            </div>
                            <div class="me-1">
                                <select wire:model="filterRole" class="form-select text-capitalize mb-md-0 mb-2">
                                    <option value=""> Semua Hak Akses</option>
                                    @foreach($pageData['listRoles'] as $key => $role)
                                        <option value="{{ $key }}">{{ $role }}</option>
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
                        </div>
                        <div class="col-sm-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                            <div class="d-flex align-items-center justify-content-center justify-content-lg-end">
                                <div wire:ignore.self>
                                    @include('widgets.bulk-action')
                                </div>
                                <button type="button" wire:click.prevent="addUser" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal">
                                    <span>Tambah Pengguna</span>
                                </button>
                                {{--                                <a href="{{ route('master.pelanggan.create') }}" class="btn btn-primary waves-effect waves-float waves-light" type="button">--}}
                                {{--                                    <span>Tambah Pengguna</span>--}}
                                {{--                                </a>--}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-responsive table-bordered table-hover">
                        <thead>
                        <tr class="text-center">
                            <th style="width: 5%;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="selectAll" wire:model="selectAll">
                                    <label class="form-check-label" for="selectAll"></label>
                                </div>
                            </th>
                            <th style="width: 25%;">Nama</th>
                            <th>Email</th>
                            <th style="width: 8%;">Roles</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 11%;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @if($checked)
                            <tr class="mb-2 mt-2 mx-2">
                                <td colspan="9">
                                    <span class="text-dark font-medium-1">Terpilih
                                        <span class="font-semibold text-danger">{{ count($checked) }}</span>
                                        dari {{ $pageData['totalData'] }} data.
                                        @if (!$selectAllUsers)
                                            <a href="#" wire:click.prevent="selectAllData">Pilih Semua data</a>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger waves-float waves-effect waves-light" wire:click.prevent="resetCheckbox">Batalkan
                                                Terpilih</button>
                                            <button type="button" class="btn btn-sm btn-success waves-float waves-effect waves-light" wire:click.prevent="deleteAllData">Hapus Terpilih</button>
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @endif
                        @forelse($listUsers as $user)
                            <tr class="@if($this->isChecked($user->id)) bg-soft-light @endif">
                                <td>
                                    <div class="form-check">
                                        <input id="list-users-{{ $user->id }}" value="{{ $user->id }}" class="form-check-input" type="checkbox"
                                               wire:model="checked" wire:key="{{ $user->id }}">
                                        <label class="form-check-label" for="list-users-{{ $user->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $user->name }}</span>
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td class="text-center">
                                     <span class="badge rounded-pill badge-light-{{ $user->getRoleNames()[0] === 'superadmin' ? 'primary' : 'secondary' }}">
                                        {{ $user->getRoleNames()[0] }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge rounded-pill badge-light-{{ \App\Utilities\Helpers::setBadgeColor($user->status) }}">
                                        {{ $user->status === 1 ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center justify-content-lg-end" role="group" aria-label="Basic example">
                                        <div class="me-1">
                                            {{--                                            <a href="{{ route('master.pelanggan.edit', $user->id) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title--}}
                                            {{--                                               data-bs-original-title="Edit Pengguna"--}}
                                            {{--                                               type="button" class="btn btn-icon btn-sm btn-outline-success waves-effect waves-float waves-light">--}}
                                            {{--                                                <i class="fal fa-edit"></i>--}}
                                            {{--                                            </a>--}}
                                            <button wire:click.prevent="editUser({{ $user->id }})"
                                                    class="btn btn-icon btn-sm btn-outline-success waves-effect waves-float waves-light"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title data-bs-original-title="Edit Pengguna"
                                                    type="button"
                                            >
                                                <i class="fal fa-edit"></i>
                                            </button>
                                            <button wire:click="destroy({{ $user->id }},'single')" data-bs-toggle="tooltip" data-bs-placement="bottom" title
                                                    data-bs-original-title="Hapus Pengguna"
                                                    type="button" class="btn btn-icon btn-sm btn-outline-danger waves-effect waves-float waves-light">
                                                <i class="fal fa-trash-alt"></i>
                                            </button>
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
                    </table>
                </div>
                <!-- Pagination Start -->
                <x-pagination :datalinks="$listUsers" :page="$pageData['page']" :total-data="$pageData['totalData']"
                              :page-count="$pageData['pageCount']"/>
                <!-- Pagination end -->
            </div>
        </div>
    </div>
    <!-- Hoverable rows end -->
    <x-modal :id="$modalId" :title="$title" :maxWidth="''" :update-mode="$updateMode">
        <form wire:submit.prevent="{{ $updateMode ? 'updatePengguna' : 'storePengguna' }}" class="needs-validation" novalidate>
            <div class="modal-body">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="mb-1" x-data="{photoName: null, photoPreview: null}">
                        <!-- Profile Photo File Input -->
                        <input type="file" hidden wire:model="photo" x-ref="photo"
                               x-on:change=" photoName = $refs.photo.files[0].name; const reader = new FileReader();
                               reader.onload = (e) => { photoPreview = e.target.result;}; reader.readAsDataURL($refs.photo.files[0]);"/>

                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ $updateMode ? $this->user->profile_photo_url : $this->users->profile_photo_url }}" class="rounded-circle" height="80px" width="80px"
                                 alt="">
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview">
                            <img x-bind:src="photoPreview" class="rounded-circle" width="80px" height="80px" alt="">
                        </div>

                        <x-jet-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Pilih Foto Profil') }}
                        </x-jet-secondary-button>

                        @if ($updateMode ? $this->user->profile_photo_path : $this->users->profile_photo_path)
                            <button type="button" class="btn btn-danger text-uppercase mt-2" wire:click="deleteProfilePhoto">
                                {{ __('Hapus Foto Profil') }}
                            </button>
                        @endif

                        <x-jet-input-error for="photo" class="mt-2"/>
                    </div>
            @endif
            <!-- Input Nama -->
                <x-jet-label for="name" :value="'Nama'"/>
                <div class="mb-1">
                    <x-jet-input class="@error('name') 'is-invalid' @enderror" wire:model.lazy="pengguna.name" type="text" label="Nama" placeholder="John Doe"/>
                </div>
                <x-jet-input-error :for="'name'" />

                <!-- Input Email -->
                <x-jet-label for="email" :value="'Email'"/>
                <div class="mb-1">
                    <x-jet-input class="@error('email') 'is-invalid' @enderror" wire:model.lazy="pengguna.email" type="text" label="Email"
                                 placeholder="johndoe@gmail.com"/>
                </div>
                <x-jet-input-error :for="'email'" />

                <!-- Input Password -->
                <x-jet-label for="password" :value="'Kata Sandi'"/>
                <div class="mb-1">
                    <x-jet-input class="@error('password') 'is-invalid' @enderror" wire:model.lazy="pengguna.password" type="password" label="Kata Sandi"
                                 placeholder="*******"/>
                </div>
                <x-jet-input-error :for="'password'" />

                <x-jet-label for="akses" :value="'Hak Akses'"/>
                <div class="mb-1">
                    <select class="form-select" wire:model.defer="akses">
                        <option value="">Pilih Hak Akses</option>
                        @foreach($pageData['listRoles'] as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <x-jet-input-error :for="'akses'" />

                <!-- Input Status -->
                <div class="mb-1">
                    <div class="form-check">
                        <x-jet-checkbox class="@error('status') 'is-invalid' @enderror" wire:model.lazy="pengguna.status" label="Status" placeholder=""/>
                        <x-jet-label for="status" :value="'Status Aktif'"/>
                    </div>
                </div>
                <x-jet-input-error :for="'status'" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ $updateMode ? 'Update' : 'Simpan' }}</button>
            </div>
        </form>
    </x-modal>

    @push('page-script')
        <script>
            window.addEventListener('openModal', event => {
                $('#{{ $modalId }}').modal('show');
            });
            window.addEventListener('closeModal', event => {
                $('#{{ $modalId }}').modal('hide');
            });
        </script>
    @endpush
</div>
