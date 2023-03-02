<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

        // //untuk cek signature_key nya hasilnya apa
        // return $signature_key;

        //jika signature_key buatan kita, tidak sesuai dengan signature_key dari json dibody nya, maka tolak
        if ($signature_key != $json->signature_key) {
            return abort(404);
        }

        //status berhasil, cari order_id yang sama di database, lalu update statusnya
        $order = Order::where('order_id', $json->order_id)->first();
        //kembalikan dengan update data order
        return $order->update(['status' => $json->transaction_status]);
    }
}
