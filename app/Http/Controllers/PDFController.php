<?php

namespace App\Http\Controllers;

use App\Models\payment;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use TCPDF;

class PDFController extends Controller
{
    public function index($transaction_id)
    {
        $data = payment::where('transaction_id', $transaction_id)->firstOrFail();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('prove.invoice', )->render());
        $mpdf->Output();
    }
}
