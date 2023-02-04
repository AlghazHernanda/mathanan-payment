<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function get_login()
    {
        return view('login');
    }

    public function get_register()
    {
        return view('register');
    }

    public function post_login(Request $request)
    {
    }

    public function post_register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::create($request->except(['_token']));
    }
}
