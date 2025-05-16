<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function verifyEmail($id)
{
    $user = User::findOrFail($id);

    if (is_null($user->email_verified_at)) {
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('login')->with('success', 'Xác minh email thành công. Bạn có thể đăng nhập.');
    }

    return redirect()->route('login')->with('info', 'Email đã được xác minh trước đó.');
}
}
