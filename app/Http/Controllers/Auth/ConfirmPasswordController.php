<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

/**
 * Comfirm password controller.
 */
class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    /** @var string $redirectTo Where to redirect users when the intended url fails. */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void Returns nothing.
     */
    public function __construct()
    {
        $this->middleware('https');
        $this->middleware('auth');
    }
}
