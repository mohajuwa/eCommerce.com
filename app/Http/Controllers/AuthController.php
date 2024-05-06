<?php

namespace App\Http\Controllers;

use App\Models\User;
use function Laravel\Prompts\password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_admin()
    {
        if (!empty(Auth::check()) && Auth::user()->is_admin == 1) {
            return redirect('admin/dashboard');
        }
        return view('admin.auth.login');
    }
    public function auth_login_admin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 0, 'is_delete' => 0], $remember)) {
            return redirect('admin/dashboard')->with('success', 'Login Successfully');
        } else {
            return redirect()->back()->with('error', "Please enter currect email and password");
        }
    }
    public function logout_admin()
    {
        Auth::logout();
        return redirect('admin')->with('info', "You have been logged out successfully");
    }

    public function auth_register(Request $request)
    {
        $checkEmail = User::checkEmail($request->email);
        if (empty($checkEmail)) {
            $save = new User;
            $save->name = trim($request->name);
            $save->email = trim($request->email);
            $save->password = Hash::make($request->password);
            $save->save();
            $json['status'] = true;
            $json['message'] = "Your account has been successfully registered";

        } else {
            $json['status'] = false;
            $json['message'] = "This email address is already registered chose another one.";
        }
        echo json_encode($json);

    }
}
