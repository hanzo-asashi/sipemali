<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return Application|Factory|View
     */
    public function showRegistrationForm()
    {
        $jenisWp = config('custom.array-data.jenis_wajib_pajak');

        return view('auth.register', compact('jenisWp'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'jenis_wp'           => ['required'],
            'nik'                => ['required', 'max:16', 'unique:users'],
            'npwp'               => ['required', 'max:20', 'unique:users'],
            'name'               => ['required', 'string', 'max:255'],
            'no_telp'            => ['required', 'max:15'],
            'no_hp'              => ['required', 'max:15'],
            'email'              => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'           => ['required', 'string', 'min:8', 'confirmed'],
            recaptchaFieldName() => recaptchaRuleName(),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'jenis_wp'         => (int) $data['jenis_wp'],
            'nik'              => $data['nik'],
            'npwp'             => $data['npwp'],
            'name'             => $data['name'],
            'no_telp'          => $data['no_telp'],
            'no_hp'            => $data['no_hp'],
            'email'            => $data['email'],
            'password'         => Hash::make($data['password']),
            'status'           => 1,
            'is_admin'         => 0,
            'is_perusahaan'    => (int) $data['jenis_wp'] === 2 ? 1 : 0,
        ]);

        $user->assignRole('user');

        return $user;
    }
}
