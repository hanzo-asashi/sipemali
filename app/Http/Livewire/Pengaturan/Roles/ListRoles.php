<?php

namespace App\Http\Livewire\Pengaturan\Roles;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Utilities\Helpers;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ListRoles extends Component
{
    public Role $roles;
    public Permission $permission;

    public int $roleId;
    public int $permissionId;
    public array $perm = [];

    public bool $updateMode = FALSE;
    public $modalId = 'modal-roles';
    public array $state = [];

    public function mount(Role $roles, Permission $permission)
    {
        $this->roles = $roles;
        $this->permission = $permission;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function addRole()
    {
        $this->updateMode = FALSE;
        $this->reset('state');
        $this->openModal();
    }

    public function editRole($id)
    {
        $this->updateMode = TRUE;
        $roles = $this->roles->find($id);
        $this->roleId = $id;
        $this->state['name'] = $roles->name;
        $this->state['guard_name'] = $roles->guard_name;
        $this->state['permission'] = Helpers::recursive_change_key($roles->permissions->pluck('name')->toArray(), $roles->permissions->pluck('name')->toArray());
        $this->perm = $this->state['permission'];
        $this->openModal(['roles' => $this->roles]);
    }

    private function closeModal($options = FALSE): void
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('closeModal', $options);
    }

    private function openModal($options = FALSE): void
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('openModal', $options);
    }

    private function alert($options = FALSE, $event = 'notifikasi'): void
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent($event, $options);
    }

    private function sendNotifikasi($model, $event = 'notifikasi'): void
    {
        if ($model) {
            $this->alert([
                'type' => 'success',
                'title' => 'Berhasil!!',
                'message' => 'Data berhasil disimpan',
            ], $event);
        } else {
            $this->alert([
                'type' => 'error',
                'title' => 'Gagal!!',
                'message' => 'Data gagal dihapus',
            ], $event);
        }
    }

    public function storeRole()
    {
        $validated = Validator::make($this->state, [
            'name' => 'required|unique:roles,name',
            'permission.*' => 'required|unique:permissions,name',
        ])->validated();

        $validated['guard_name'] = 'web';

        $rolePermission = (isset($validated['permission']) && is_array($validated['permission'])) ? $validated['permission'] : [];
        $role = Role::create($validated);
        foreach ($rolePermission as $perm) {
            $permission = Permission::updateOrCreate(['name' => $perm]);
            $role->syncPermissions($permission);
        }
        if ($role) {
            $this->sendNotifikasi($role);
            $this->reset('state');
            $this->closeModal();
        } else {
            $this->sendNotifikasi($role);
        }
    }

    public function updateRole()
    {
        $validated = Validator::make($this->state, [
            'name' => 'required|string',
            'permission' => 'required|string',
        ])->validated();

        $validated['guard_name'] = 'web';

        $role = $this->roles->find($this->roleId);
        $role->updateOrCreate([
            'id' => $this->roleId,
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ], $validated);
        foreach ($validated['permission'] as $item) {
            $exist = Permission::select('name', 'guard_name')->where('name', $item)->where('guard_name', $validated['guard_name'])->first();
            if (!$exist) {
                Permission::create(['name' => $item, 'guard_name' => $validated['guard_name']]);
            }
        }
        $role->syncPermissions($validated['permission']);
//        $check = in_array($allPerm, $validated['permission']);
//        dd($check);
//        $role->syncPermissions($validated['permission']);
        if ($role) {
            $this->sendNotifikasi($role);
            $this->reset('state');
            $this->closeModal();
        } else {
            $this->sendNotifikasi($role);
        }
    }

    public function render()
    {
        $allModels = Helpers::getAppModels('Models');
        $listRoles = $this->roles->with(['user'])->get();
        $listPermission = Permission::defaultCrud();
        $defaultPermission = Permission::defaultPermissions();
        $listUserWithRoles = User::with('roles')->get();
        return view('livewire.pengaturan.roles.list-roles', compact('listRoles', 'listUserWithRoles', 'listPermission', 'allModels'))
            ->extends('layouts.contentLayoutMaster');
    }
}
