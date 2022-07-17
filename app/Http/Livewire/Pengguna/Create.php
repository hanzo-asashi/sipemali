<?php

namespace App\Http\Livewire\Pengguna;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    const STATUS_AKTIF = 1;

    const STATUS_NONAKTIF = 0;

    public $pengguna;

    public $roles;

//    public bool $isChecked = false;

    public $nik;

    public $email;

    public $name;

    public $password;

    public $password_confirmation;

    public $role;

    public $status;

    public $avatar;

    public $avatarTemporaryUrl;

    public array $tempUpdate = [];

    public array $tempValidate = [];

    public bool $updateMode = false;

    public bool $isUploading = false;

    protected $rules
        = [
            //            'nik'                   => 'required|unique:users,nik',
            'name' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            //            'status'                => 'required',
            'avatar' => 'nullable|image|max:1024',
        ];

    public function mount($updateMode)
    {
        $this->updateMode = $updateMode;
        if ($this->updateMode) {
            $this->edit();
        }
//        $this->status = self::STATUS_AKTIF;
    }

    private function resetInput()
    {
        $this->reset(
//            'nik',
            'name',
            'password',
            'password_confirmation',
            'email',
            'role',
//            'status',
            'avatar'
        );
    }

    private function alert($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('notifikasi', $options);
    }

    public function updatedAvatar()
    {
        $this->avatarTemporaryUrl = $this->avatar->temporaryUrl();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit()
    {
        $this->updateMode = true;
        $user = User::find($this->pengguna);
        $this->avatar = asset($user->avatar);
//        $this->nik = $user->nik;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles()->get()->first()->id;
        $this->status = $user->status;
    }

    public function submit()
    {
//        $this->authorize('create', $this->pengguna);
        $data = ['success' => 'false', 'message' => 'Pengguna gagal di tambahkan'];
        $validatedData = $this->validate();
        $user = User::create([
            'avatar' => $this->avatar ? 'storage/pengguna/avatar.png' : 'assets/images/users/default.png',
            //            'nik'      => $validatedData['nik'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'status' => self::STATUS_AKTIF,
            'is_admin' => false,
        ]);

        if ($user) {
            if ($this->avatar) {
                $this->avatar->storeAs('pengguna', 'avatar.png', 'public');
            }
            $user->assignRole($validatedData['role']);
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Pengguna berhasil ditambahkan';
        }

        $this->alert($data);
    }

    public function updatePengguna()
    {
        $data = ['success' => 'false', 'message' => 'Pengguna gagal di tambahkan'];
        if (! is_null($this->password)) {
            $this->tempValidate = [
                'password' => 'required|min:8',
                'password_confirmation' => 'required|min:8|same:password',
            ];
            $this->tempUpdate = ['password' => Hash::make($this->password)];
        }

        if (! is_null($this->avatarTemporaryUrl)) {
            $this->tempValidate = [
                'avatar' => 'image|max:1024',
            ];
            $this->tempUpdate = ['avatar' => 'storage/pengguna/avatar.png'];
        }

        $validatedData = $this->validate([
            //                'nik'   => 'required',
            'name' => 'required',
            'email' => 'email',
            'role' => 'required',
        ] + $this->tempValidate);

        $user = User::find((int) $this->pengguna)->update([
            //                'nik'      => $validatedData['nik'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'status' => self::STATUS_AKTIF,
            'is_admin' => false,
        ] + $this->tempUpdate);

        if ($user) {
            if (! is_null($this->avatarTemporaryUrl)) {
                $this->avatar->storeAs('pengguna', 'avatar.png', 'public');
            }
//            $user->associate($validatedData['role']);
            $this->resetInput();
            $data['success'] = true;
            $data['message'] = 'Pengguna berhasil ditambahkan';
        }

        $this->alert($data);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.pengguna.create', [
            'listRole' => Role::pluck('name', 'id'),
            'listStatus' => [self::STATUS_NONAKTIF => 'Non Aktif', self::STATUS_AKTIF => 'Aktif'],
        ]);
    }
}
