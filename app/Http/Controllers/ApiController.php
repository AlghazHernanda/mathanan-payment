<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ApiController extends Controller
{
    public function payment_handler(Request $request)
    {
        // //untuk coba-coba ambil data di body postman
        // return $request->getContent();

        //ubah data ke bentuk JSON
        $json = json_decode($request->getContent());

        ////untuk melihat bentuk data json(coba-coba)
        //return $json;
    }
}
