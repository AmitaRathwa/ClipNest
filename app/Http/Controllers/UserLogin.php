<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class UserLogin extends Controller
{
    public function index(){
        return view('users.pages.user_login');

    }


    public function loginCheck(Request $request)
{

    $request->validate([

        'email' => 'required|email',

        'password' => 'required',

    ]);

    $user = UserModel::where('email',$request->email)->first();

    if($user){

        if(Hash::check($request->password, $user->password)){

            Session::put('user_id', $user->user_id);

            Session::put('user_name', $user->name);

            return response()->json([

                'status' => true,

                'message' => 'Login Successfully'

            ]);

        }else{

            return response()->json([

                'status' => false,

                'message' => 'Password Incorrect'

            ]);

        }

    }else{

        return response()->json([

            'status' => false,

            'message' => 'Email Not Found'

        ]);

    }

}
public function logout()
{

    Session::forget('user_id');

    Session::forget('user_name');

    Session::flush();

    return redirect()
            ->route('userlogin')
            ->with('success','Logout Successfully');

}

}
