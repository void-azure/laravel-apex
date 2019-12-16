<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/**
 * Forgot password controller.
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
}
