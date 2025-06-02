<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(){
        return view('login');
    }

    public function login(Request $request) {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
            );
            if(Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }

            return back()->withErrors([
                'email' => 'Email not found'
            ])->onlyInput('email');
    }

    public function logout(Request $request)
        {
            Auth::logout();

            $request->session()->invalidate(); // Menghapus semua data sesi
            $request->session()->regenerateToken(); // Regenerasi token CSRF

            return redirect('/'); // Arahkan kembali ke halaman login
        }

}
