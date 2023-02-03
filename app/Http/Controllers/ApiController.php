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

        //untuk generate signature_key biar sesuai sama format midtrans
        //https://docs.midtrans.com/docs/https-notification-webhooks    ada disini format signature_key nya
        $signature_key = hash('sha512', $json->order_id . $json->status_code . $json->gross_amount . env('MIDTRANS_SERVER_KEY'));
    }
}
