<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}"
                    aria-expanded="{{ $closed ?? 'true' }}" aria-controls="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
                {{ $title ?? 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </button>
{{--            <a role="button" data-bs-toggle="collapse"--}}
{{--               data-parent="#dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}" href="#dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}"--}}
{{--               aria-expanded="{{ $closed ?? 'true' }}" aria-controls="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">--}}
{{--                {{ $title or 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}--}}
{{--            </a>--}}
        </h2>
        <div id="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}" class="accordion-collapse collapse {{ $closed ?? 'in' }}"
             aria-labelledby="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}"
             data-bs-parent="#dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}" style="">
            <div class="accordion-body">
                @foreach($listPermissions as $perm)
                    @php
                    $per_found = null;

                    if( isset($role) ) {
                        $per_found = $role->hasPermissionTo($perm->name);
                    }

                    if( isset($user)) {
                        $per_found = $user->hasDirectPermission($perm->name);
                    }
                    @endphp
                <div class="row d-flex d-inline-flex gx-3 gy-2 align-items-center align-content-between">
                    <div class="col-auto">
                        <div class="form-check mb-3">
{{--                            <input class="form-check-input" type="checkbox" id="formCheck1">--}}
                            {!! Form::checkbox("permissions[]", $perm->name, $per_found, $options ?? ['class' => 'form-check-input','wire:model' => 'permissions']) !!}
                            <label class="form-check-label {{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}" for="formCheck1">
                                {{ $perm->name }}
                            </label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-3">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div><!-- end accordion -->
