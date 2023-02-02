<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function payment_handler(Request $request)
    {
        // //untuk coba-coba ambil data di body postman
        // return $request->getContent();

        //ubah data ke bentuk JSON
        $json = json_decode($request->getContent());
    }
}
