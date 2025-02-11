<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $data['user'] = Order::where('user_id', Auth::id())->get();
        $data['header_title'] = 'Profile';
        return view('profile.profile', $data);
    }
    public function riwayat()
    {
        $data['header_title'] = 'Riwayat';
        return view('profile.riwayat');
    }
    public function ticket()
    {
        $data['header_title'] = 'E-Ticket ';
        return view('profile.ticket');
    }
}
