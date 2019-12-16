<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

/**
 * Verification controller.
 */
class VerificationController extends Controller
{
    use VerifiesEmails;

    /** @var string $redirectTo Where to redirect users after verification. */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void Returns nothing.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
