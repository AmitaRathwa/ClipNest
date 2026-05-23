<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;


class UserRegister extends Controller
{
    public function index(){
         return view('users.pages.user_register');
    }

public function store(Request $request)
{

    $request->validate([

        'name' => 'required|max:255',

        'email' => 'required|email|unique:tbl_user,email',

        'password' => 'required|min:6',

        'password_confirmation' => 'required|same:password',

    ]);

    $user = UserModel::create([

        'name' => $request->name,

        'email' => $request->email,

        // Password Hash
        'password' => Hash::make($request->password),

        'status' => 1,

        'created_at' => now(),

    ]);

    return response()->json([

        'status' => true,

        'message' => 'Registration Successfully',

        'data' => $user

    ]);

}


}
