<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['currentActive'] = 'login';
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home_dashboard');
        } else {
            return view('login', $this->data);
        }
    }

    public function login(Request $request)
    {
        // Validasi data input
        $credentials = $request->validate([
            'username_or_email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Lakukan proses login
        if (
            Auth::attempt(['email' => $credentials['username_or_email'], 'password' => $credentials['password']]) ||
            Auth::attempt(['username' => $credentials['username_or_email'], 'password' => $credentials['password']])
        ) {
            // Jika autentikasi berhasil, arahkan pengguna sesuai peran
            if (Auth::user()->role == 'admin') {

                User::where('id', Auth::user()->id)->update([
                    'last_login' => now(),
                ]);

                return redirect()->route('admin.dashboard');

            } elseif (Auth::user()->role == 'pengurus') {

                User::where('id', Auth::user()->id)->update([
                    'last_login' => now(),
                ]);

                return redirect()->route('pengurus.dashboard');

            } elseif (Auth::user()->role == 'user') {

                User::where('id', Auth::user()->id)->update([
                    'last_login' => now(),
                ]);

                return redirect()->route('user.dashboard');

            } else {
                return redirect()->route('form.login')->withErrors(['message' => 'Username atau password tidak terdaftar']);
            }
        }

        // Jika autentikasi gagal, kembalikan pengguna ke halaman login dengan pesan error
        return redirect()->route('form.login')->withErrors(['message' => 'Username atau password salah']);
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect('/');
    }
}