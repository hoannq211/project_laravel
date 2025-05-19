<?php

namespace App\Http\Controllers;

use App\Events\LoginEvent;
use App\Http\Requests\AuthRegisterRequest;
use App\Jobs\SendEmailVerification;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function fromLogin()
    {
        if (auth()->check()) {
            $user = User::find(auth()->id());

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('info', 'Bạn đã đăng nhập');
            }

            if ($user->isStaff()) {
                return redirect()->route('staff.homeStaff')->with('info', 'Bạn đã đăng nhập');
            }

            return redirect()->route('home')->with('info', 'Bạn đã đăng nhập');
        }

        return view("auth.login");
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $data = $validated;

        $remember = $request->has('remember');


        if (Auth::attempt($data, $remember)) {
            $request->session()->regenerate();

            $user = User::find(Auth::id());
            event(new LoginEvent($user));
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
            }
            if ($user->isStaff()) {
                return redirect()->route('staff.homeStaff')->with('success', 'Đăng nhập thành công');
            }

            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        } else {
            return redirect()->back()->withInput()->with([
                'error' => 'email hoặc password không đúng'
            ]);
        }
    }
    public function fromRegister()
    {

        return view("auth.register");
    }

    public function register(AuthRegisterRequest  $request)
    {

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user = User::create($data);
        $user->roles()->attach(2);

        SendEmailVerification::dispatch($user);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with([
            'success' => 'đăng xuất thành công'
        ]);
    }
}
