<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Register controller.
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /** @var string $redirectTo Where to redirect users after registration. */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void Returns nothing.
     */
    public function __construct()
    {
        $this->middleware('https');
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data The input data to validate.
     *
     * @return \Illuminate\Contracts\Validation\Validator Returns the validator.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:4', 'max:18', 'alpha_dash', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data The user data to insert.
     *
     * @return \App\User Returns the users model.
     */
    protected function create(array $data)
    {
        $user = User::forceCreate([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(80),
        ]);
        $role = Role::where('name', 'user')->first();
        $user->roles()->attach($role);
        return $user;
    }
}
