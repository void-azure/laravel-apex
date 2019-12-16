<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * Login controller.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /** @var string $redirectTo Where to redirect users after login. */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void Returns nothing.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
