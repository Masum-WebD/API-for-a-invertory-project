<?php

namespace App\Http\Controllers;

use App\Mail\MyDemoMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    function UserRegistration(Request $request)
    {
        try {
            $request->validate([
                'firstName' => 'required|string|max:50',
                'lastName' => 'required|string|max:50',
                'email' => 'required|string|email|max:50|unique:users,email',
                'number' => 'required|string|max:50',
                'password' => 'required|string|min:3'
            ]);
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'number' => $request->input('number'),
                'password' => Hash::make($request->input('password'))
            ]);
            return response()->json(['status' => 'success', 'message' => 'User created successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function login(Request $request)
    {
        return view('pages.auth.login');
    }
    function UserLogin(Request $request)
    {
        // dd($request);
        try {
            $request->validate([
                'email' => 'required|string|email|max:50',
                "password" => "required|string|min:3"
            ]);

            $user = User::where('email', $request->input('email'))->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid user']);
            };

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['status' => 'success', 'message' => 'Login successfully', 'token' => $token]);
        } catch (Exception $e) {
            return response()->json(['status' => 'failed', 'message' => 'Login failed', 'error' => $e->getMessage()]);
        }
    }

    function UserProfile(Request $request)
    {
        // $users= User::all();
        // return $users;
        return Auth::user();
    }

    function UserLogout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['status' => 'success', 'message' => 'Logout successfully']);
        // return redirect('login');
    }

    function UserUpdate(Request $request)
    {
        try {
            $request->validate([
                'firstName' => 'required|string|max:50',
                'lastName' => 'required|string|max:50',
                'email' => 'required|string|email|max:50|unique:users,email',
                'number' => 'required|string|max:50',
                'password' => 'required|string|min:3'
            ]);
            User::where('id', '=', Auth::id())->update([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'number' => $request->input('number'),
                'password' => Hash::make($request->input('password'))
            ]);
            return response()->json(['status' => 'success', 'message' => 'User updated successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function SendOTP(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email|max:50'
            ]);
            $email = $request->input('email');
            $count = User::where('email', '=', $email)->count();
            $otp = rand(1000, 9999);
            if ($count == 1) {
                Mail::to($email)->send(new MyDemoMail($otp));
                User::where('email', '=', $email)->update(['otp' => $otp]);
                return response()->json(['success' => 'success', 'otp' => '4 Digit OTP send your email address']);
            } else {
                return response()->json(['status' => 'Fail', 'Message' => 'Invalid email']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


    function VerifyOTP(Request $request)
    {
        try {
            $request->validate([
                "email" => "required|string|email|max:50",
                "otp" => "required|string|min:4"
            ]);
            $email = $request->input('email');
            $otp = $request->input('otp');

            $user = User::where('email', '=', $email)->where('otp', '=', $otp)->first();
            if (!$user) {
                return response()->json(['status' => 'Fail', 'Message' => 'Invalid OTP']);
            }
            User::where('email', '=', $email)->update(['otp' => '0']);
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['status' => 'success', 'Message' => "OTP verification successful", 'Token' => $token]);
        } catch (Exception $e) {
            return response()->json(['status' => 'Error', 'Message' => $e->getMessage()]);
        }
    }

    function ResetPassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|string|min:3',
            ]);

            $id = Auth::id();
            $password = $request->input('password');

            User::where('id', $id)->update(['password' => Hash::make($password)]);
            return response()->json(['status' => 'success', 'Message' => "Reset password successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'Error', 'Message' => $e->getMessage()]);
        }
    }
}
