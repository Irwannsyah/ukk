<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\destination;
use App\Models\Product;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Product';
        $data['get_record'] = destination::with('category')->get();
        return view('admin.destination.list', $data);
    }
}
