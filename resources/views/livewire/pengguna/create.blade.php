<div>
    <div class="row">
        <form wire:submit.prevent="@if(!$updateMode) submit @else updatePengguna @endif" class="needs-validation" novalidate>
            @csrf
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1 mb-3">
                                <div wire:ignore.self class="text-start mt-2">
                                    @if(!$updateMode)
                                        <img class="rounded-circle avatar-lg" src="{{ $avatar ? $avatar->temporaryUrl() : asset('assets/images/users/default.png') }}" alt="">
                                    @else
                                        <img class="rounded-circle avatar-lg" src="{{ $avatar }}" alt="">
                                    @endif
                                </div>
                                <div class="text-danger" role="alert" id="avatarError" data-ajax-feedback="avatar"></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="avatar">Foto Profil</label>
                                <div class="input-group">
                                    <input type="file" wire:model="avatar" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" autofocus>
                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            {{--                            <div class="col-md-6">--}}
                            {{--                                <div class="mb-3">--}}
                            {{--                                    <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>--}}
                            {{--                                    <input wire:model="nik" id="nik" type="text" placeholder="Masukkan NIK"--}}
                            {{--                                           class="form-control @error('nik') is-invalid @enderror" name="nik"--}}
                            {{--                                           value="{{ old('nik') }}" required>--}}
                            {{--                                    @error('nik')--}}
                            {{--                                    <span class="invalid-feedback" role="alert">--}}
                            {{--                                        <strong>{{ $message }}</strong>--}}
                            {{--                                    </span>--}}
                            {{--                                    @enderror--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input wire:model="name" id="name" type="text" placeholder="Masukkan nama lengkap"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {{-- Email --}}
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input wire:model="email" id="email" type="email" placeholder="Alamat Email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="select-role" class="form-label">Hak Akses</label>
                                    <select wire:model.lazy="role" required id="select-role" class="form-select form-control @error('role') is-invalid @enderror"
                                            name="role">
                                        <option value="">Pilih hak akses</option>
                                        @foreach($listRole as $key => $role)
                                            <option wire:key="{{ $key }}" value="{{ $key }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Kata sandi --}}
                                <div class="mb-3">
                                    <label for="password" class="form-label">Kata Sandi</label>
                                    <input wire:model="password" id="password" type="password" placeholder="Masukkan kata sandi"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- Konfirmasi Kata sandi --}}
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Konfirmasi Kata Sandi</label>
                                    <input wire:model="password_confirmation" id="confirm_password" type="password" placeholder="Masukkan konfirmasi kata sandi"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation" required>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="mb-0">--}}
{{--                                    <label for="select-status" class="form-label">Status</label>--}}
{{--                                    <select wire:model.lazy="status" id="select-status" class="form-select @error('status') is-invalid @enderror" name="status">--}}
{{--                                        @foreach($listStatus as $key => $stat)--}}
{{--                                            <option wire:key="{{ $key }}" value="{{ $key }}">{{ $stat}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @error('role')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-md-6 d-inline-flex gap-2 text-start">
                                @if($updateMode)
                                    <button class="btn btn-primary btn-label waves-effect waves-light" type="submit">
                                        <i class="label-icon bx bx-edit-alt"></i>
                                        Update Pengguna
                                    </button>
                                @else
                                    <button class="btn btn-primary btn-label waves-effect waves-light" type="submit">
                                        <i class="label-icon bx bx-save"></i>
                                        Simpan Pengguna
                                    </button>
                                @endif
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('pengguna') }}" class="btn btn-label btn-secondary waves-effect waves-light">
                                    <i class="label-icon bx bx-left-arrow-alt"></i>
                                    Kembali Ke Pengguna
                                </a>
                            </div>
                        </div>
                    </div>
                    {{--                </form>--}}
                </div>
                <!-- end card -->
            </div>
{{--            <div class="col-md-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="col-md-3 mb-2">--}}
{{--                            <div class="text-start mt-2">--}}
{{--                                <img class="rounded-circle avatar-lg" src="{{ $avatar ? $avatar->temporaryUrl() : asset(Auth::user()->avatar) }}" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="text-danger" role="alert" id="avatarError" data-ajax-feedback="avatar"></div>--}}
{{--                        </div>--}}
{{--                        --}}{{--                        <form wire:submit.prevent="saveAvatar">--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="avatar">Foto Profil</label>--}}
{{--                            <div class="input-group">--}}
{{--                                <input type="file" wire:model="avatar" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" autofocus>--}}
{{--                                @error('avatar')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                                <button class="btn btn-primary" type="submit">--}}
{{--                                    Save Photo--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- end col -->
        </form>
    </div>

    <!-- end row -->
</div>
@push('script')

@endpush
