<?php

namespace App\Http\Livewire\Pengaturan\Users;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;
    use LivewireAlert;

//    use PasswordValidationRules;
    use WithFileUploads;

    public User $users;

    public $roles;

    public string $search = '';

    public int $perPage = 15;

    public string $status = '';

    public string $filterRole = '';

    public string $permission = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'roles' => ['except' => ''],
        'permission' => ['except' => ''],
    ];

    public array $checked = [];

    public array $pengguna = [];

    public bool $isChecked = false;

    public bool $selectAll = false;

    public bool $updateMode = false;

    public bool $selectAllUsers = false;

    public int $userId = 0;

    public string $deleteTipe = 'single';

    public string $title = 'Pengguna';

    public string $modalId = 'modal-users';

    protected $listeners = [
        'delete',
        'updatePengguna' => 'render',
        'pelangganCount',
        'updateValid' => 'updateStatusValid',
        'updateStatusConfirmed',
        'confirmed',
        'cancelled',
        'denied',
    ];

    protected string $paginationTheme = 'bootstrap';

    /**
     * The component's state.
     *
     * @var array
     */
    public array $state = [];

    /**
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

//    /**
//     * Update the user's profile information.
//     *
//     * @param  UpdatesUserProfileInformation  $updater
//     * @return void
//     */
//    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
//    {
//        $this->resetErrorBag();
//
//        $updater->update(
//            Auth::user(),
//            $this->photo
//                ? array_merge($this->state, ['photo' => $this->photo])
//                : $this->state
//        );
//
//        if (isset($this->photo)) {
//            return redirect()->route('profile.show');
//        }
//
//        $this->emit('saved');
//
//        $this->emit('refresh-navigation-menu');
//    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
//    public function deleteProfilePhoto()
//    {
//        Auth::user()->deleteProfilePhoto();
//
//        $this->emit('refresh-navigation-menu');
//    }

    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    public function isChecked($id): bool
    {
        return in_array($id, $this->checked, true);
    }

    public function selectAllData(): void
    {
        $this->selectAllUsers = true;
        $this->checked = $this->users->pluck('id')->toArray();
    }

    public function updatedSelectAll($value): void
    {
        if ($value) {
            $this->checked = $this->users->query()
                ->pluck('id')
                ->forPage($this->page, $this->perPage)
                ->toArray();
        } else {
            $this->checked = [];
            $this->selectAllUsers = false;
        }
    }

    public function resetCheckbox()
    {
        $this->checked = [];
        $this->selectAllUsers = false;
        $this->selectAll = false;
    }

    public function resetForms()
    {
        $this->reset('search', 'status', 'checked', 'pengguna');
    }

    public function confirmed()
    {
        $this->delete($this->userId, $this->deleteTipe);
    }

    public function updateStatusConfirmed()
    {
        $this->updateStatusValid($this->userId);
    }

    public function denied()
    {
    }

    public function cancelled()
    {
        // Do something when cancel button is clicked
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function mount(User $user)
    {
        $this->users = $user;
        $this->state = Auth::user()->withoutRelations()->toArray();
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

    public function destroy($id, $tipe)
    {
        $this->userId = $id;
        $this->deleteTipe = $tipe;

        $this->confirm('Anda yakin ingin menghapus ??', [
            'onConfirmed' => 'confirmed',
            //            'onDismissed' => 'cancelled',
        ]);
    }

    public function delete($id, $tipe)
    {
        if ($tipe === 'bulk') {
            $delete = $this->users->whereKey($this->checked)->delete();
            $this->checked = [];
        } else {
            $delete = $this->users->findOrFail($id)->delete();
        }

        if ($delete) {
            $this->alert('success', 'Pengguna berhasil dihapus');
        } else {
            $this->alert('danger', 'Pengguna gagal dihapus');
        }
    }

    public function updateStatus($id)
    {
        $this->userId = $id;

        $this->confirm('Anda yakin ingin update status menjadi aktif ??', [
            'onConfirmed' => 'updateStatusConfirmed',
            'confirmButtonText' => 'Ya, Update',
        ]);
    }

    public function updateStatusValid($id)
    {
        $user = $this->users->find($id);

        if (! is_null($user)) {
            $status = ! $user->status ? 1 : 0;
            $update = $user->update(['status' => $status]);
            if ($update) {
                $this->alert('success', 'Status pelanggan berhasil diubah');
            } else {
                $this->alert('danger', 'Status pelanggan gagal diubah');
            }
        } else {
            $this->alert('info', 'Pengguna tidak ditemukan');
        }
    }

    private function closeModal($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('closeModal', $options);
    }

    private function openModal($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('openModal', $options);
    }

    public function addUser()
    {
        $this->updateMode = false;
        $this->reset('pengguna');
        $this->openModal();
    }

    public function editUser($userId)
    {
        $this->userId = $userId;
        $this->updateMode = true;
        $user = $this->users->findOrFail($userId);
        $this->pengguna['name'] = $user->name;
        $this->pengguna['email'] = $user->email;
        $this->pengguna['status'] = $user->status;
        $this->pengguna = $user->toArray();
        $this->openModal(['pengguna' => $this->pengguna]);
    }

    public function storePengguna()
    {
        $validated = Validator::make($this->pengguna, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'akses' => 'required',
            //            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $create = $this->users->create($validated);
        if ($create) {
            $this->users->syncRoles($this->pengguna['akses']);
            $this->alert('success', 'Pengguna berhasil ditambahkan');
        } else {
            $this->alert('danger', 'Pengguna gagal ditambahkan');
        }
    }

    public function updatePengguna()
    {
        dd('update pengguna');
    }

    private function renderUsers()
    {
        return $this->users->search($this->search)
            ->with(['roles'])
            ->when($this->filterRole, function ($q) {
                $q->whereHas('roles', function ($q) {
                    return $q->where('name', $this->filterRole);
                });
            })
            ->when($this->status, function ($q) {
                return $q->where('status', $this->status);
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        $listUsers = $this->renderUsers();

        $listRoles = Role::pluck('name', 'id');
        $listStatus = [1 => 'Aktif', 0 => 'Tidak Aktif'];
        $listPermission = Permission::defaultCrud();

        $pageData = [
            'page' => $this->page,
            'pageCount' => $this->perPage,
            'totalData' => $listUsers->total(),
            'listRoles' => $listRoles,
            'listStatus' => $listStatus,
            'listPermission' => $listPermission,
        ];

        return view('livewire.pengaturan.users.list-users', compact('pageData', 'listUsers'))->extends('layouts.contentLayoutMaster');
    }
}
