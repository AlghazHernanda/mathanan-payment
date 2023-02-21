<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function notice()
    {
        //ini harusnya bisa dijadikan view biar enak
        return "mohon untuk melakukan verifikasi email";
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return "berhasil diverifikasi, selamat datang di dahsboard";
    }

    //untuk mengirim link verifikasi lagi
    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return "Verififikasi email berhasil dikirim";
    }
}
