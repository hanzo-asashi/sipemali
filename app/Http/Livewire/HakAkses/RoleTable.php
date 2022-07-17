<?php

namespace App\Http\Livewire\HakAkses;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;
use Validator;

class RoleTable extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public string $defaultSort = 'id';

    public int $perPage = 10;

    public string $selectedRole = '';

    public string $search = '';

    public string $sortColumn = 'created_at';

    public string $sortDirection = 'asc';

    public array $selectedPermission = [];

    public array $checked = [];

    public array $state = [];

    public bool $isChecked = false;

    public string $cardTitle = 'Data Hak Akses';

    public bool $selectAll = false;

    public bool $bulkDisabled = true;

    public array $listPermission = ['create', 'read', 'update', 'delete'];

    public bool $showEditModal = false;

    public bool $disableButton = false;

    public bool $showPermission = false;

    public $roles;

    public $permissions;

    public $name;

    public $role;

    protected $listeners = [
        'confirmedDelete',
    ];

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function setPerPage($perPage): void
    {
        $this->perPage = $perPage;
    }

    public function mount(Role $roles, Permission $permission): void
    {
        $this->roles = $roles;
        $this->permissions = $permission;
    }

    public function showPermissions(Role $role): void
    {
        $this->showPermission = true;
        $this->emitTo('hak-akses.permissions', 'showPermissions', ['showPermission' => $this->showPermission, 'role' => $role]);
    }

    public function addNew(): void
    {
        $this->showEditModal = false;
        $this->openModal();
        $this->resetInput();
    }

    public function edit(Role $role): void
    {
        $this->showEditModal = true;
        $this->state['name'] = $role->name;
        $this->name = $role->name;
        $this->role = $role;
        $this->openModal(['role' => $this->name]);
    }

    private function resetInput(): void
    {
        $this->reset('name', 'state');
    }

    public function createRole(): void
    {
        $data = ['success' => 'false', 'message' => 'Tipe akses gagal di tambahkan'];
        $validated = Validator::make($this->state, [
            'name' => 'required',
        ])->validate();

        $create = Role::create($validated);
        if ($create) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Tipe akses berhasil ditambahkan';
        }

        $this->closeModal($data);
    }

    public function updateRole(): void
    {
        $data = ['success' => false, 'message' => 'Hak akses gagal di perbaharui'];
        $validated = Validator::make($this->state, [
            'name' => 'required',
        ])->validate();

        $update = $this->role->update($validated);

        if ($update) {
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Hak akses berhasil diperbaharui';
        }

        $this->alert($data);
        $this->closeModal($data);
    }

    private function closeModal($options = false): void
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('closeModal', $options);
    }

    private function openModal($options = false): void
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('openModal', $options);
    }

    public function sortByColumn($column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->reset('sortDirection');
            $this->sortColumn = $column;
        }
    }

    private function alert($options = false): void
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('alert', $options);
    }

    public function isChecked($userid): bool
    {
        return in_array($userid, $this->checked, true);
    }
//
//    public function updated($propertyName): void
//    {
//        $this->validateOnly($propertyName);
//    }

    /**
     * @throws Throwable
     */
    public function delete($id): ?bool
    {
        return Role::findOrFail($id)->deleteOrFail();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): Factory|View|Application
    {
        $listRoles = $this->roles->with(['permissions'])
            ->search(trim($this->search))
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        $listPermissions = $this->permissions->all();

        return view('livewire.hak-akses.role-table')->with([
            'listRoles' => $listRoles,
            'listPermissions' => $listPermissions,
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totaldata' => $listPermissions->count(),
        ]);
    }
}
