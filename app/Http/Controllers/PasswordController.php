<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\support\Str;
use Illuminate\support\Facades\DB;
use Illuminate\support\Facades\Mail;
use Hash;

class PasswordController extends Controller
{
    public function getForgotPassword()
    {
        return view("auth.forgot-password");
    }
    public function postForgotPassword(Request $request)
    {
        $request->validate([
            'email' => "required|email",
        ]);

        $token = Str::random(64);

        DB::table("password_reset_tokens")->insert([
            "email" => $request->email,
            "token" => $token,
            'created_at' => Carbon::now(),
        ]);


        Mail::send('emails.forgot-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email)->subject('Reset Password');
        });

        return redirect()->route('get.forgot.password')->with('success', 'We have send an email to reset password.');
    }

    public function getResetPassword(Request $request)
    {
        return view('auth.reset-password', ["token" => $request->token]);
    }
    public function postResetPassword(Request $request)
    {
        $request->validate([
            // 'email' => 'required|email|exists:users',
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')->where(['token' => $request->token])->first();
        if (!$updatePassword) {
            return redirect()->route('get.reset.password')->with('error', 'Sorry, invalid token');
        }

        // update password in users table
        DB::table('users')->where(['email' => $updatePassword->email])->update(['password' => Hash::make($request->password)]);

        // delete token of password_reset_tokens table
        DB::table('password_reset_tokens')->where(['email' => $updatePassword->email])->delete();

        return redirect()->route('get.login')->with('success', 'Password reset completed successfully.');
    }
}
