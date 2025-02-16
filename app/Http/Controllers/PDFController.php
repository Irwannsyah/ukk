<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use TCPDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDFController extends Controller
{
    public function index($transaction_id)
    {
        $data = payment::where('transaction_id', $transaction_id)->firstOrFail();
        $mpdf = new \Mpdf\Mpdf([
            'format' => [210, 148], // Ukuran kertas custom (A5 landscape)
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
            'margin_right' => 10,
        ]);
        $mpdf->WriteHTML(view('prove.invoice', compact('data') )->render());
        $mpdf->Output($transaction_id .'.pdf', 'D');
    }
}
