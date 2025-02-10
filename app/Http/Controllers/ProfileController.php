<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $data['user'] = auth()->user()->load('order');
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
