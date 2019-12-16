<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Reset password controller.
 */
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /** @var string $redirectTo Where to redirect users after resetting their password. */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void Returns nothing.
     */
    public function __construct()
    {
        $this->middleware('https');
    }
}
