<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function showResetForm() {

        return view("auth.reset-password");
    }

    public function reset(Request $request){
        $request->validate([
            'token' => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:7',
        ]);
        $status = Password::reset(
            $request->only('token','email','password', 'password_confirmation'),
            function($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
