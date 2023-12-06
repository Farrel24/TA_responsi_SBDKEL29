<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    $user = DB::table('pengguna')
        ->where('username', $credentials['username'])
        ->first();

    if ($user && $credentials['password'] === $user->password) {
        // Password sesuai, lakukan proses login
        Auth::loginUsingId($user->id_user);
        return redirect()->intended('/');
    }

    // Password tidak sesuai
    return redirect()->route('login')->with('error', 'Login gagal. Periksa kredensial Anda.');
}


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
