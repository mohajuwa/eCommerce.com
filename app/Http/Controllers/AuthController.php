<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Mail\RegisterMail;
use App\Models\NotificationModel;
use App\Models\User;
use function Laravel\Prompts\password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        return redirect('')->with('info', "You have been logged out successfully");
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
            Mail::to($save->email)->send(new RegisterMail($save));

            $user_id = $save->id;
            $url = url('admin/customer/list/');
            $message = "New Customer Register #" . $request->name;

            NotificationModel::insertRecord($user_id, $url, $message);

            $json['status'] = true;
            $json['message'] = "Your account has been successfully registered , please verify your email address";
        } else {
            $json['status'] = false;
            $json['message'] = "This email address is already registered chose another one.";
        }
        echo json_encode($json);
    }
    public function auth_login(Request $request)
    {
        $remember = !empty($request->is_remember);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $user = Auth::user();

            // Check if the user's account is active and not deleted
            if ($user->status == 0 && $user->is_delete == 0) {
                // Check if the user's email is verified
                if (!empty($user->email_verified_at)) {
                    $json['status'] = true;
                    $json['message'] = "You've logged in successfully";
                } else {
                    // User is not verified, send verification email and logout
                    Auth::logout();
                    $save = User::getSingle($user->id);

                    try {
                        Mail::to($save->email)->send(new RegisterMail($save));
                        $json['status'] = false;
                        $json['message'] = "Your account is not verified, please check your inbox to verify your account.";
                    } catch (\Exception $e) {
                        $json['status'] = false;
                        $json['message'] = "Make sure your email address is correct.";
                    }
                }
            } else {
                // User account is either inactive or deleted, log out the user
                Auth::logout();
                $json['status'] = false;
                $json['message'] = "Your account is either inactive or deleted.";
            }
        } else {
            // Invalid email or password
            $json['status'] = false;
            $json['message'] = "Please enter correct email or password.";
        }

        return response()->json($json);
    }

    public function forgot_password()
    {
        $data['meta_title'] = "Forgot Password";
        return view('auth.forgot', $data);
    }
    public function auth_forgot_password(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();
        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', 'Please check your email and rest your password');
        } else {
            return redirect()->back()->with('error', 'Email not found in the system');
        }
    }
    public function reset($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            $data['user'] = $user;
            $data['meta_title'] = 'Reset Password';
            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }
    public function auth_reset($token, Request $request)
    {
        if ($request->password == $request->cpassword) {
            $user = User::where('remember_token', '=', $token)->first();
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            return redirect('')->with('success', 'Password successfully reseted');
        } else {
            return redirect('')->with('error', 'Password and confirm password does not match');
        }
    }
    public function activate_email($id)
    {
        $id = base64_decode($id);
        $user = User::getSingle($id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect(url(''))->with('success', "Email successfully verified");
    }
}
