<?php

namespace App\Http\Livewire\Pengguna;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'bootstrap';

    public $users;
    public $roles;
    public $userRoles;

    public bool $filter = false;
    public bool $sort = false;
    public string $defaultSort = 'id';
    public int $perPage = 10;
    public bool $filterByStatus = false;
    public string $selectedRole = '';
    public string $search = '';
    public $selectedStatus = '';
    public array $checked = [];
    public bool $isChecked = false;
    public string $cardTitle = 'Data Pengguna';
    public bool $selectAll = false;
    public bool $bulkDisabled = true;

//    public $listeners = [];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(User $users)
    {
        $this->users = $users;
    }

    /**
     * @throws AuthorizationException
     */
    public function delete($id, $tipe): ?bool
    {
        $this->authorize('delete-users', $this->checked);
        if ($tipe === 'bulk') {
            $user = $this->users->whereKey($this->checked)->delete();
            $user->roles()->detach();
            $this->checked = [];

            return $user;
        } else {
//            $user = $this->users->findOrFail($id)->where('id', '!=', 1)->delete();
            $user = $this->users->findOrFail($id);
            if(!$user->hasRole('superadmin') && $user->is_admin === 1){
                $user->delete();
                $user->syncRoles();
            }
//            $user->roles()->detach();
            return $user;
        }
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = $this->users->query()
                ->when($this->selectedRole, function ($q) {
                    $q->role($this->selectedRole);
                })
                ->when($this->selectedStatus, function ($q) {
                    $q->where('status', $this->selectedStatus);
                })
                ->where('id', '!=', 1)
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function isChecked($userid): bool
    {
        return in_array($userid, $this->checked);
    }


    public function render()
    {
        $listUsers = $this->users->with(['roles'])
            ->search(trim($this->search))
            ->when($this->selectedRole, function ($q) {
                $q->role($this->selectedRole);
            })
            ->when($this->selectedStatus, function ($q) {
                $q->where('status', $this->selectedStatus);
            })
            ->orderBy($this->defaultSort)
            ->paginate($this->perPage);

        $roles = Role::pluck('name','id');
        $listStatus = config('custom.status_aktif');

        return view('livewire.pengguna.user-table', [
            'listUsers' => $listUsers,
            'listRoles' => $roles,
            'listStatus' => $listStatus,
        ]);
    }
}
