<?php

namespace App\Http\Controllers;

use App\Rules\TwoFactorRule;
use App\Notifications\TwoFactorCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * The 2 factor controller.
 */
class TwoFactorController extends Controller
{
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

    /**
     * Show the 2 factor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable Show the verify page.
     */
    public function index()
    {
        return view('auth.tf');
    }

    /**
     * Verify the 2 factor code.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request.
     *
     * @return \Illuminate\Http\Response Returns the response.
     */
    public function verify(Request $request)
    {
        $validatedData = $request->validate([
            'two_factor_code' => ['required', 'string', new TwoFactorRule],
        ]);
        session()->put('tf.session', true);
        return redirect()->route('home');
    }

    /**
     * Resend the 2 factor code.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request.
     *
     * @return \Illuminate\Http\Response Returns the response.
     */
    public function resend()
    {
        $user = auth()->user();
        $user->two_factor_code = $two_factor_code = Str::random(9);
        $user->two_factor_expiry = now()->addMinutes(10);
        $user->save();
        $user->notify(new TwoFactorCodeNotification($two_factor_code));
        return redirect('/two-factor/verify');
    }
}
