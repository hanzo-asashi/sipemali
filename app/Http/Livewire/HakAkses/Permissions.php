<?php

namespace App\Http\Livewire\HakAkses;

use App\Models\Permission;
use App\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Permissions extends Component
{
    use LivewireAlert;
//    use WithPagination;

//    protected string $paginationTheme = 'bootstrap';

    public $role;
    public $permission;
    public string $search = "";
    protected array $updatesQueryString = ['search'];
    public bool $showPermission = false;
    public int $perPage = 8;

    protected $listeners = [
        'showPermissions',
        'confirmedDeletePermission',
        'cancelledDeletePermission',
        'deleteSelectedQuery',
        'updatePermissionList' => 'render'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showPermissions($param)
    {
        $this->showPermission = $param['showPermission'];
        $this->role = Role::with('permissions')->find($param['role']['id']);
        $this->openModal(['role' => $this->role,'permissions' => $this->role->permissions]);
    }

    private function closeModal($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('closePermissionModal', $options);
    }

    private function openModal($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('openPermissionModal', $options);
    }

    public function deletePermission(Permission $permission)
    {
        if(!auth()->user()->can('manage permissions')) {
            return abort(403);
        }

        $this->confirm('Apakah anda yakin ingin menghapus ?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Batal',
            'onConfirmed' => 'confirmedDeletePermission',
            'onCancelled' => 'cancelledDeletePermission'
        ]);

        $this->permission = $permission;
    }

    public function mount(Role $role)
    {
        if(!auth()->user()->can('manage permissions')) {
            return abort(403);
        }

        $this->role = $role;
    }

    public function assign(Permission $permission)
    {
        if(!auth()->user()->can('manage permissions')) {
            return abort(403);
        }

        $this->role->givePermissionTo($permission->name);
        $this->emit('updatePermissionList');
        $this->alert('success','Berhasil menambahkan permission');
        $this->closeModal();
    }

    public function confirmedDeletePermission()
    {
        if(!auth()->user()->can('manage permissions')) {
            return abort(403);
        }

        $this->role->revokePermissionTo($this->permission->name);
        $this->emit('updatePermissionList');
        $this->alert(
            'success',
            __('bap.removed')
        );
        $this->closeModal();
    }

    public function cancelledDeletePermission()
    {
        $this->alert('success','Batal menghapus');
    }

    public function render()
    {
        if (!auth()->user()->can('manage permissions')) {
            return abort(403);
        }

//        $permissions = Permission::when($this->search, function ($q){
//            $q->search($this->search);
//        })->paginate($this->perPage,'*','permissionPage');

        $permissions = Permission::when($this->search, function ($q) {
            $q->search($this->search);
        })->get();

//        if ($this->search != '') {
//            $permissions = Permission::search($this->search)->get();
//        } else {
//            $permissions = Permission::paginate($this->perPage);
//        }

        return view('livewire.hak-akses.permissions', compact('permissions'));
    }
}
