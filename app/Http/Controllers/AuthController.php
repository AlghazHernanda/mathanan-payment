<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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

        //return $request;

        $user = User::create($request->except(['_token']));

        //untuk memberitahu ada user baru dan mengirimkan ke email
        event(new Registered($user));

        auth()->login($user);

        //ketika ingin membuat verifikasi, kita harus membuat route('verification.notice')
        return redirect()->route('verification.notice')->with('success', 'akun berhasil dibuat, silahkan verifikasi email anda');
    }
}
