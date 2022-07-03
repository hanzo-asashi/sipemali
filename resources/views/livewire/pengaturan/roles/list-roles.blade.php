<div>
    @section('title', 'Roles')

    @push('vendor-style')

    @endpush
    @push('page-style')

    @endpush
    <!-- Role cards -->
    <div class="row">
        @foreach($listRoles as $roleuser)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Total {{ $roleuser->user->count() }} users</span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                @foreach($roleuser->user as $usr)
                                    <li
                                        data-bs-toggle="tooltip"
                                        data-popup="tooltip-custom"
                                        data-bs-placement="top"
                                        title="{{ $usr->name }}"
                                        class="avatar avatar-sm pull-up"
                                    >
                                        <img class="rounded-circle" src="{{ $usr->profile_photo_path ?? asset('images/avatars/2.png')}}" alt="Avatar"/>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder">{{ Str::ucfirst($roleuser->name) }}</h4>
                                <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal" wire:click.prevent="editRole({{ $roleuser->id }})">
                                    <small class="fw-bolder">Edit Akses</small>
                                </a>
                            </div>
                            {{--                            <a href="javascript:void(0);" class="text-body"><i data-feather="copy" class="font-medium-5"></i></a>--}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end justify-content-center h-100">
                            <img
                                src="{{asset('images/illustration/faq-illustrations.svg')}}"
                                class="img-fluid mt-2"
                                alt="Image"
                                width="85"
                            />
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <a wire:click.prevent="addRole"
                               href="javascript:void(0)"
                               data-bs-toggle="modal"
                               class="stretched-link text-nowrap add-new-role"
                            >
                                <span class="btn btn-primary mb-1">Buat Hak Akses</span>
                            </a>
                            <p class="mb-0">Tambah hak akses, jika tidak tersedia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Role cards -->

    <!-- Add Role Modal -->
    <x-modal :id="$modalId" :title="'Hak Akses'" :maxWidth="'xl'" :update-mode="$updateMode">
        <div class="modal-body">
            <!-- Add role form -->
            <form wire:submit.prevent="{{ $updateMode ? 'updateRole' : 'storeRole' }}" class="needs-validation" novalidate>
                <div class="col-12 mb-1">
                    <label class="form-label" for="roleName">Nama Akses</label>
                    <input
                        wire:model.defer="state.name"
                        type="text"
                        id="roleName"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="contoh: superadmin, admin, operator"
                    />
                    <x-jet-input-error :for="'name'"/>
                </div>
                <div class="col-12">
                    <h4 class="mt-2 pt-50">Ijin Hak Akses</h4>
                    <div class="table-responsive">
                        <table class="table table-flush-spacing">
                            <tbody>
                            @foreach($allModels as $model)
                                <tr>
                                    <td>{{ $model }}</td>
                                    @foreach($listPermission as $key => $perm)
                                        <td>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-check">
                                                    <input value="{{ $perm.'_'.strtolower($model) }}"
                                                           class="form-check-input @error('permission') is-invalid @enderror"
                                                           wire:model.defer="state.permission.{{ $perm.'_'.strtolower($model)}}"
                                                           type="checkbox"
                                                           id="{{ strtolower($model).'_'.$perm }}"/>
                                                    <x-jet-input-error :for="'permission'"/>
                                                    <label class="form-check-label" for="{{ strtolower($model).'_'.$perm }}"> {{ $perm }} </label>
                                                </div>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 text-center mt-2">
                    <button type="submit" class="btn btn-primary me-1" wire:loading.attr="disabled">
                        {{ $updateMode ? 'Update' : 'Simpan' }}
                    </button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                        Batal
                    </button>
                </div>
            </form>
            <!--/ Add role form -->
        </div>
    </x-modal>

    @push('vendor-script')

    @endpush
    @push('page-script')
        @include('widgets.action-js')
        @include('widgets.notifikasi')
        {{--        <script src="{{ asset(mix('js/scripts/pages/modal-add-role.js')) }}"></script>--}}
        {{--        <script src="{{ asset(mix('js/scripts/pages/app-access-roles.js')) }}"></script>--}}
    @endpush

</div>
