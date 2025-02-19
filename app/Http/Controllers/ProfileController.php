<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $data['user'] = User::where('id', Auth::id())->first();
        $data['payment'] = payment::where('user_id', Auth::id())
            ->where('status', 'settlement')
            ->count();
        $data['header_title'] = 'Profile';
        return view('profile.profile', $data);
    }
    public function riwayat()
    {
        $data['user'] = User::where('id', Auth::id())->first();
        $data['paid'] = payment::where('user_id', Auth::id())->get();
        $data['header_title'] = 'Riwayat';
        return view('profile.riwayat', $data);
    }
    public function ticket()
    {
        $data['header_title'] = 'E-Ticket ';
        return view('profile.ticket');
    }

    public function editForm()
    {
        $user = Auth::user();
        return view('profile.formEdit', compact('user'));
    }

    public function updateForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => now(),
        ];

        // Jika ada gambar baru diupload
        if ($request->hasFile('profile')) {
            // Hapus foto lama jika ada
            if ($user->profile) {
                Storage::delete('public/profile/' . $user->profile);
            }

            // Simpan foto baru
            $file = $request->file('profile');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile', $filename);
            $data['profile'] = $filename;
        }

        DB::table('users')->where('id', Auth::id())->update($data);

        return redirect()->route('user.profileprofile')->with('success', 'Updated Profile successfully');
    }

}
