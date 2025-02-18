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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class PaymentController extends Controller
{
    // public function checkout($id)
    // {
    //     $data['destination'] = destination::with('category')->find($id);
    //     if (!$data['destination']) {
    //         return redirect()->back()->with('error', 'Destinasi Tidak ditemukan');
    //     }
    //         $data['header_title'] = 'Checkout';
    //     return view('payment.checkout', $data);

    // }

    // public function checkoutInsert(Request $request){
    //     $order = new Order();
    //     $order->order_id = 'ORD-' . strtoupper(Str::random(10));
    //     $order->user_id = auth()->user()->id;
    //     $order->destination_id = $request->destination_id;
    //     $order->total_price = $request->total_price;
    //     $order->ticket_quantity = $request->ticket_quantity;
    //     $order->visit_date = $request->visit_date;
    //     $order->save();

    //     return redirect()->route('user.payment', ['id' => $order->id])->with('success', 'Pesanan berhasil dibuat');
    // }

    public function showPayment()
    {
        $snapToken = session('snapToken');
        $header_title = session('header_title');
        $destination = session('destination');
        $visit_date = session('visit_date');
        $ticket = session('ticket_quantity');

        if(!$snapToken || !$destination) {
            return redirect()->route('user.dashbaord')->with('error', 'Session expired. Please try again.');
        }
        return view('payment.payment', compact('snapToken', 'header_title', 'destination', 'visit_date', 'ticket'));

    }
    public function payment(Request $request)
    {

        $request->validate([
            'destination_id' => 'required|exists:destination,id',
            'visit_date' => 'required|date',
            'ticket_quantity' => 'required|integer|min:1',
        ]);
        $visit_date = $request->input('visit_date');
        $ticket_quantity = $request->input('ticket_quantity');
        $total_price = $request->input('total_price');
        $price = $request->input('price');

        $destination = destination::findOrFail($request->destination_id);

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => "ORD-" . str::random(10),
                'gross_amount' => $total_price,
            ),
            'item_details' => array(
                [
                    'id' => 'a1',
                    'price' => $price,
                    'quantity' => $ticket_quantity,
                    'name' => $destination->title,
                ]
            ),
            'customer_details' => array(
                'first_name' => "Irwansyah",
                'email' => "irwansyah9060@gmail.com",
                'phone' => "085723762",
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // $data = [
        //     'snapToken' => $snapToken,
        //     'header_title' => 'Payment',
        //     'destination' => $destination,
        // ];

        session()->put('snapToken', $snapToken);
        session()->put('header_title', 'payment');
        session()->put('destination', $destination);
        session()->put('ticket_quantity', $ticket_quantity);
        session()->put('visit_date', $visit_date);

        return redirect()->route('user.showPayment');
    }

    public function payment_post(Request $request)
    {
        $json = json_decode($request->get('json'));

        // Periksa apakah data JSON valid
            $payment = new Payment();
            $payment->status = $json->transaction_status;
            $payment->user_id = $request->user_id;
            $payment->destination_id = $request->destination_id;
            $payment->email = $request->email;
            $payment->ticket = $request->ticket;
            $payment->visit_date = $request->visit_date;
            $payment->transaction_id = $json->transaction_id;
            $payment->order_id = $json->order_id;
            $payment->gross_amount = $json->gross_amount;
            $payment->paymen_type = $json->payment_type;
            $payment->save();

        return redirect()->route('user.dashbaord');
    }




    public function callback(Request $request)
    {   
        $json = json_decode($request->getContent());
        $serverKey = config('midtrans.serverKey');
        $signature_key = hash('sha512', $json->order_id . $json->status_code . $json->gross_amount . $serverKey);
        if($signature_key != $json->signature_key){
            return abort(404);
        }

        // status confirm

        $payment = payment::where('order_id', $json->order_id)->first();
        return $payment->update(['status'=> $json->transaction_status]);
    }

}
