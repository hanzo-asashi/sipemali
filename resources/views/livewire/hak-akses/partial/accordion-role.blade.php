    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="">
                        <h5>HAK AKSES</h5>
                            <p class="card-title-desc">Formulir Pengisian Informasi Objek Pajak</p>
                    </div>
                </div>
                <div class="card-body">
                    @forelse ($listRoles as $role)
                        <form wire:submit.prevent="updateRole">
                        @if($role->name === 'superadmin')
                            @include('account.roles.partials._permissions', [
                                          'title' => $role->name .' Permissions','permissions' => $listPermissions,
                                          'options' => ['disabled'] ])
                        @else
                            @include('account.roles.partials._permissions', [
                                          'title' => ucfirst($role->name) .' Permissions', 'permissions' => $listPermissions,
                                          'model' => $role ])
                            @can('edit roles')
                                <div class="row m-2">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                </div>
                            @endcan
                        @endif

                        {!! Form::close() !!}

                    @empty
                        <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
