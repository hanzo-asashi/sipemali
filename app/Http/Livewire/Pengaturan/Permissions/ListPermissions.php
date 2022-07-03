<?php

namespace App\Http\Livewire\Pengaturan\Permissions;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListPermissions extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public Permission $permission;
    public Role $role;

    public User $user;

    public array $state = [];
    public $permissionId;

    public string $search = '';
    public int $perPage = 15;
    public string $orderBy = 'id';
    public string $direction = 'asc';
    public string $defaultSortBy = 'id';

    public array $pageData = [];
    public array $checked = [];
    public bool $isChecked = FALSE;
    public bool $selectAll = FALSE;
    public bool $updateMode = FALSE;
    public bool $selectAllPermission = FALSE;
    public string $title = 'List Permissions';

    public string $modalId = 'modal-permission';
    public bool $show = FALSE;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'delete',
        'resetField' => 'resetField',
    ];

    public function mount(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked);
    }

    public function selectAllData()
    {
        $this->selectAllPermission = TRUE;
        $this->checked = $this->permission->pluck('id')->toArray();
    }

    public function updatedSelectAllPermission($value)
    {
        if ($value) {
            $this->checked = $this->permission->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
            $this->selectAllPermission = FALSE;
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = $this->permission->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
            $this->selectAllPermission = FALSE;
        }
    }

    public function resetCheckbox()
    {
        $this->checked = [];
        $this->selectAllPermission = FALSE;
        $this->selectAll = FALSE;
    }

    public function resetField()
    {
        $this->reset('search', 'state', 'checked');
        $this->resetErrorBag();
//        $this->show = FALSE;
    }

    public function updating()
    {
        $this->resetPage();
    }

    public function updatedPerPage($value)
    {
        $this->setPerPage($value);
    }

    public function setPerPage($value)
    {
        $this->perPage = $value;
    }

    public function editPermission($id)
    {
        $this->updateMode = TRUE;
        $permission = $this->permission->find($id);
        $this->permissionId = $id ?? $permission->id;
//        $this->state['kode'] = $permission->kode;
        $this->state['name'] = $permission->name;
//        $this->state['no_rekening'] = $permission->no_rekening;
//        $this->state['deskripsi'] = $permission->deskripsi;
        $this->openModal(['permission' => $permission]);
    }

    public function addPermission()
    {
        $this->updateMode = FALSE;
//        $this->show = TRUE;
//        $this->state['name'] = '';
        $this->resetField();
        $this->openModal();
    }

    public function storePermission()
    {
        $validated = \Validator::make($this->state, [
            'name' => 'required|string|unique:permissions,name',
        ])->validate();

        $validated['name'] = preg_replace('/\s+/', '_', strtolower(trim($validated['name'])));

        $create = $this->permission->create($validated);
        $this->sendNotifikasi($create);
        $this->resetField();
        $this->closeModal();
//        $this->show = false;
    }

    public function updatePermission()
    {
        $validated = \Validator::make($this->state, [
            'name' => 'required|max:5|unique:permissions,name',
        ])->validate();

        $update = $this->permission->find($this->metodeId);

        $update->update($validated);
        $this->sendNotifikasi($update);
        $this->resetField();
        $this->closeModal();
//        $this->show = false;
    }

    public function delete($id, $tipe)
    {
        if ('bulk' === $tipe) {
            $delete = $this->permission->query()->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->permission->findOrFail($id)->delete();
        }
        $this->sendNotifikasi($delete, 'sendNotif');
    }

    private function alert($options = FALSE, $event = 'notifikasi')
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent($event, $options);
    }

    private function closeModal($options = FALSE)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('closeModal', $options);
    }

    private function openModal($options = FALSE)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('openModal', $options);
    }

    private function sendNotifikasi($model, $event = 'notifikasi')
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

    public function render()
    {
        $listPermissions = $this->permission->paginate($this->perPage);
        $this->pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listPermissions->total(),
        ];
        return view('livewire.pengaturan.permissions.list-permissions', compact('listPermissions'))
            ->extends('layouts.contentLayoutMaster');
    }
}
