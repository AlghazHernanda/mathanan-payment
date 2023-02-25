<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function payment(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 18000,
            ),
            'item_details' => array(
                [
                    'id' => 'a1',
                    'price' => '10000',
                    'quantity' => 1,
                    'name' => 'Apel'
                ], [
                    'id' => 'b1',
                    'price' => '8000',
                    'quantity' => 1,
                    'name' => 'Jeruk'
                ]
            ),
            'customer_details' => array(
                'first_name' => $request->get('uname'),
                'last_name' => '',
                'email' => $request->get('email'),
                'phone' => $request->get('number'),
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        //eturn $snapToken;
        return view('payment', [
            'snap_token' => $snapToken
        ]);
    }

    public function payment_post(Request $request)
    {
        // //untuk test liat hasil data payment yang diambil sebelum dimasukin ke database
        // return $request;

        //jadiin format json lagi
        $json = json_decode($request->get('json'));

        $order = new Order();
        $order->status = $json->transaction_status; //ambil transaction_status yang di dalam JSON
        $order->uname = $request->get('uname');
        $order->email = $request->get('email');
        $order->number = $request->get('number');
        $order->transaction_id = $json->transaction_id; //ambil transaction_id yang di dalam JSON
        $order->order_id = $json->order_id;  //ambil order_id yang di dalam JSON
        $order->gross_amount = $json->gross_amount;  //ambil gross_amount yang di dalam JSON
        $order->payment_type = $json->payment_type;  //ambil payment_type yang di dalam JSON

        $order->payment_code = isset($json->payment_code) ? $json->payment_code : null;
        $order->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;

        return $order->save() ? redirect(url('/'))->with('alert-success', 'Order berhasil dibuat') : redirect(url('/'))->with('alert-failed', 'Terjadi kesalahan');
    }
}
