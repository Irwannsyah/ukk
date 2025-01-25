<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function list(){
        $data['header_title'] = 'List User';
        $data['getRecord'] = User::GetUser();
        return view('admin.admin.list', $data);
    }

    public function delete($id){
        $user = User::getSingle($id);
        $user->delete();

        return redirect()->back()->with('success', 'User Successfully Delete');
    }
}
