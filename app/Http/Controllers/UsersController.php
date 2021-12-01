<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        // check that user is allowed to create other users
        $this->authorize('view-users');
        // get all users from db
        $users = User::orderBy('created_at', 'desc')->get();

        return view('users.index', ['users' => $users]);
    }
}
