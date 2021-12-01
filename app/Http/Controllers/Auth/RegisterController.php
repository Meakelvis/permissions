<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * add user to db and redirect to appropriate page
     */
    public function store(Request $request)
    {
        // check that user is allowed to create other users
        $this->authorize('create-user');

        // validate user input
        $this->validate($request, [
            'name' => 'required|max:255',
            'role' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        // store user
        User::create([
            'name' => $request->name,
            'role_id' => $request->role,
            'email' => $request->email,
            'district' => 'kampala',
            'password' => Hash::make($request->password),
        ]);

        // redirect user back to dashboard
        return back()->with('success', 'New User Created');
    }
}
