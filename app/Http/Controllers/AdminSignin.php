<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adminlogin;
use Session;

class AdminSignin extends Controller
{
    // Login Page
    public function index()
    {
        return view('admin.pages.signin');
    }

    // Login Check
    public function login(Request $request)
    {
        $admin = Adminlogin::where('email', $request->email)
                    ->where('password', $request->password)
                    ->first();

        if ($admin) {

            // Store Session
            Session::put('admin_id', $admin->admin_id);

            Session::put('admin_name', $admin->name);

            return response()->json([
                'status' => true,
                'message' => 'Login Successfully',
                'redirect' => route('addcategory')
            ]);

        } else {

            return response()->json([
                'status' => false,
                'message' => 'Invalid Email or Password'
            ]);
        }
    }

    // Logout
    public function logout()
    {
        Session::flush();

        return redirect()->route('login');
    }
}
