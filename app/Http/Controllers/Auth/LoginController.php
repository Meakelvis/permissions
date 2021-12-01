<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $userRole = User::where('email', $request->email)->first()->role_id;

        if ($userRole == Role::IS_ORG || $userRole == Role::IS_GENERAL) {
            return back()->with('error', 'Temporarily blocked because the lockdown period has ended');
        }

        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Invalid login details');
        }

        // check user role
        switch (auth()->user()->role_id) {
                // redirect accordingly
            case Role::IS_ORG:
                if (auth()->user()->first_time_login == false) {
                    return redirect()->route('resetPassword');
                }

                return redirect()->route('org.dashboard');
                break;

            case Role::IS_ADMIN:
                if (auth()->user()->first_time_login == false) {
                    return redirect()->route('resetPassword');
                }

                return redirect()->route('dashboard');
                break;

            case Role::IS_GENERAL:
                if (auth()->user()->first_time_login == false) {
                    return redirect()->route('resetPassword');
                }

                return redirect()->route('dashboard');
                break;
            default:
                return redirect()->route('dashboard');
                break;
        }
    }

    /**
     * view to reset password
     */
    public function resetPassword()
    {
        return view('auth.resetpassword');
    }

    /**
     * reset password on first login attempt
     * this applies for general users and admin
     */
    public function updateReset(Request $request)
    {
        // validate user password
        $this->validate($request, [
            'password' => 'required|confirmed',
            // 'password_confirmation' => 'required',
        ]);

        // get current user
        $currentUser = User::where('email', auth()->user()->email);

        if ($currentUser) {
            // reset user password
            auth()->user()->password = Hash::make($request->password);
            auth()->user()->first_time_login = true;
            auth()->user()->save();

            // redirect accordingly
            // switch (auth()->user()->role_id) {
            //     case Role::IS_ADMIN:
            //         return redirect()->route('dashboard');
            //         break;

            //     case Role::IS_GENERAL:
            //         return redirect()->route('dashboard');
            //         break;
            // }
            return redirect()->route('org.dashboard');
        }
    }
}
