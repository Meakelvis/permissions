<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('organisation.login');
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
            return back()->with('error', 'Invalid login details');
        }

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
}
