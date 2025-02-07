<?php

namespace App\Http\Controllers;

use App\Models\destination;
use App\Models\Order;
use App\Models\orders;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout($id)
    {
        $data['destination'] = destination::with('category')->find($id);
        if (!$data['destination']) {
            return redirect()->back()->with('error', 'Destinasi Tidak ditemukan');
        }

        // Mengambil jumlah tiket yang dibeli dari request
        $ticketQuantity = request('ticket_quantity', 1); // Default 1 jika tidak ada input

        // Hitung total harga
        $totalPrice = $data['destination']->price * $ticketQuantity;

            $data['header_title'] = 'Checkout';
        return view('payment.checkout')->with([
            'data' => $data,
            'totalPrice' => $totalPrice
        ]);

    }

    public function checkoutInsert(Request $request){
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->destination_id = $request->destination_id;
        $order->total_price = $request->total_price;
        $order->ticket_quantity = $request->ticket_quantity;
        $order->status = $request->status;
        $order->save();

        return redirect()->route('user.payment', ['id' => $order->id])->with('success', 'Pesanan berhasil dibuat');
    }


    public function payment($orderId){
        $order = Order::with('payment')->findOrFail($orderId);
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $data['snapToken'] = $snapToken;
        $data['header_title'] = 'Payment';
        return view('payment.payment', $data);
    }
}
