<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Login controller.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers {
        logout as performLogout;
    }

    /** @var string $redirectTo Where to redirect users after login. */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void Returns nothing.
     */
    public function __construct()
    {
        $this->middleware('https');
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect to the login page after logout.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request.
     *
     * @return \Illuminate\Http\Response Returns the response.
     */
    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('login');
    }

    /**
     * Redirect the user to the social authentication page.
     *
     * @param string $provider The social provider.
     *
     * @return \Illuminate\Http\Response Returns the response.
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the social provider.
     *
     * @param string $provider The social provider.
     *
     * @return \Illuminate\Http\Response Returns the response.
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $accountExists = $loginUser = DB::table('users')->where('email', $user->getEmail())->first();
        $socialAccountConnected = DB::table('social_logins')->where('user_email', $user->getEmail())->first();
        if ($accountExists && $socialAccountConnected) {
            Auth::loginUsingId($loginUser->id);
            return redirect()->to($this->redirectTo);
        } elseif ($accountExists) {
            DB::table('users')->where('id', $loginUser->id)->update(['email_verified_at' => now()]);
            DB::table('social_logins')->insert([
                'provider' => $provider, 'provider_id' => $user->getId(), 'user_email' => $loginUser->email,
            ]);
            Auth::loginUsingId($loginUser->id);
            return redirect()->to($this->redirectTo);
        } else {
            $userCreated = User::forceCreate([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'username' => '',
                'password' => Hash::make(Str::random(40)),
                'api_token' => Str::random(80),
            ]);
            $role = Role::where('name', 'user')->first();
            $userCreated->roles()->attach($role);
            DB::table('users')->where('id', $loginUser->id)->update(['email_verified_at' => now()]);
            DB::table('social_logins')->insert([
                'provider' => $provider, 'provider_id' => $user->getId(), 'user_email' => $userCreated->email,
            ]);
            Auth::loginUsingId($loginUser->id);
            return redirect()->to($this->redirectTo);
        }
    }

    /**
     * Reutrn the username field.
     *
     * @return string Returns the name of the username field.
     */
    public function username()
    {
        return 'username';
    }
}
