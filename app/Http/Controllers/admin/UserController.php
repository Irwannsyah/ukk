<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $search = $request->input('search');

        // Query dengan filter pencarian
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })->paginate(10); // Tambahkan pagination

        return view('admin.admin.list', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        // Query dengan filter pencarian
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })->get();

        // Kembalikan dalam bentuk JSON untuk AJAX
        return response()->json($users);
    }


    public function delete($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus user
        $user->delete();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'User successfully deleted.');
    }
}
