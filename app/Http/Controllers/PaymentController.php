<?php

namespace App\Http\Controllers;

use App\Models\destination;
use App\Models\Order;
use App\Models\orders;
use Illuminate\Support\Str;
use App\Models\payment;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class PaymentController extends Controller
{
    public function checkout($id)
    {
        $data['destination'] = destination::with('category')->find($id);
        if (!$data['destination']) {
            return redirect()->back()->with('error', 'Destinasi Tidak ditemukan');
        }
            $data['header_title'] = 'Checkout';
        return view('payment.checkout', $data);

    }

    public function checkoutInsert(Request $request){
        $order = new Order();
        $order->order_id = 'ORD-' . strtoupper(Str::random(10));
        $order->user_id = auth()->user()->id;
        $order->destination_id = $request->destination_id;
        $order->total_price = $request->total_price;
        $order->ticket_quantity = $request->ticket_quantity;
        $order->visit_date = $request->visit_date;
        $order->save();

        return redirect()->route('user.payment', ['id' => $order->id])->with('success', 'Pesanan berhasil dibuat');
    }


    public function payment($orderId){

        $order = Order::getSingle($orderId);
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->order_id,
                'gross_amount' => $order->total_price,
            ),
            'item_details' => array(
                [
                    'id' => 'a1',
                    'price' => $order->destination->price,
                    'quantity' => $order->ticket_quantity,
                    'name' => $order->destination->title,
                ]
            ),
            'customer_details' => array(
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $data = [
            'snapToken' => $snapToken,
            'header_title' => 'Payment',
            'order' => $order,
        ];
        return view('payment.payment', $data);
    }

    public function payment_post(Request $request){
        $json= json_decode($request->get('json'));
        $payment = new payment();
        $payment->status = $json->transaction_status;
        $payment->name = $request->name;
        $payment->email = $request->email;
        $payment->transaction_id = $json->transaction_id;
        $payment->order_id = $json->order_id;
        $payment->gross_amount = $json->gross_amount;
        $payment->paymen_type = $json->payment_type;
        return $payment->save() ? redirect()->route('user.dashbaord')->with('success', 'Pembayaran telah berhasil dilakukan') : redirect()->route('user.dashbaord')->with('failed', 'Pembayaran Gagal');
    }
}
