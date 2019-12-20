<?php

namespace App\Http\Controllers;

use Thowable;
use Authy\AuthyApi;
use Illuminate\Http\Request;

/**
 * The verify controller.
 */
class VerifyController extends Controller
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
     * Show the application two-factor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable Show the verify page.
     */
    public function index()
    {
        return view('auth.tf');
    }

    /**
     * Verify the 2 factor auth code.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request.
     *
     * @return \Illuminate\Http\Response Returns the response.
     */
    public function verify(Request $request)
    {
        try {
            $user = auth()->user();
            if ($user->two_factor) {
                $data = $request->validate([
                    'verification_code' => ['required', 'numeric'],
                ]);
                $authy_api = new AuthyApi(getenv("AUTHY_SECRET"));
                $res = $authy_api->verifyToken(auth()->user()->authy_id, $data['verification_code']);
                if ($res->bodyvar("success")) {
                    session(['isVerified' => true]);
                    return redirect()->route('home');
                }
                return back()->with(['error' => $res->errors()->message]);
            } else {
                return redirect()->route('home');
            }
        } catch (Throwable $th) {
            return back()->with(['error' => $th->getMessage()]);
        }
    }
}
