<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect(route('admin.laman-utama'));
        }
        return view('session/login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->verified == 1) {
                if ($user->access_code == 1 || $user->access_code == 2 || $user->access_code == 3) {
                    return redirect()->intended(route('admin.laman-utama'))->with("success", "Log masuk berjaya");
                } else {
                    return redirect()->intended(route('laman-utama'))->with("success", "Log Masuk Berjaya");
                }
            } else {
                Auth::logout();
                return redirect(route('login'))->with("error", "Butiran anda belum disahkan");
            }
        }

        return redirect(route('login'))->with("error", "Butiran log masuk salah");
    }

    public function logout()
    {
        // Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
