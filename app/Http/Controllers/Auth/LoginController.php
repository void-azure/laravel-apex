<?php

namespace App\Http\Controllers\Auth;

use Authy\AuthyApi;
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
     * The user has been authenticated now check for 2 factor auth.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request.
     * @param mixed                    $user    The authenticated user.
     *
     * @return \Illuminate\Http\Response Returns the response.
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->two_factor) {
            $authy_api = new AuthyApi(getenv("AUTHY_SECRET"));
            $authy_api->requestSms($user->authy_id);
            session(['isVerified' => false]);
            return redirect('/two-factor/verify');
        }
        session(['isVerified' => true]);
        return redirect()->to($this->redirectTo);
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
     * Reutrn the username field.
     *
     * @return string Returns the name of the username field.
     */
    public function username()
    {
        return 'username';
    }
}
