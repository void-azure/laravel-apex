<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * @return \Illuminate\Http\Response Returns the response.
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        // $user->token;
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
