<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

/**
 * The impersonate controller.
 */
class ImpersonateController extends Controller
{
    /** @var string $redirectTo Where to redirect users after impersonation. */
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
        $this->middleware('admin');
    }

    /**
     * Impersonate a user.
     *
     * @param int The id of the user to impersonate.
     *
     * @return \Illuminate\Http\Response Returns the response.
     */
    public function take($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->route('admin.users.index');
        } elseif ($user->hasRole('admin')) {
            return redirect()->route('admin.users.index');
        } else {
            session()->put('impersonate', $user->id);
        }
        return redirect()->to($this->redirectTo)->with('status', trans('flash.impersonate_take'));
    }

    /**
     * Leave user impersonation.
     *
     * @return \Illuminate\Http\Response Returns the response.
     */
    public function leave()
    {
        session()->forget('impersonate');
        return redirect()->route('admin.users.index')->with('status', trans('flash.impersonate_left'));
    }
}
