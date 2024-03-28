<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;
use App\Models\User;

class RegisterController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['currentActive'] = 'dashboard';
    }
    public function index()
    {
        return view('register', $this->data);
    }
    public function submit(Request $request)
    {
        try {
            $this->validate($request, [
                'username' => 'required|string', // Tambahkan validasi untuk username
                'email' => [
                    'required',
                    'email',
                    function ($attribute, $value, $fail) {
                        // Validasi email menggunakan ekspresi reguler
                        $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
                        if (!preg_match($emailRegex, $value)) {
                            return $fail('Please enter a valid email address.');
                        }
                    }
                ],
                'role' => 'required|string',
                'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/'],
            ]);

            $newUser = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'status' => 'inactive',
                'role' => $request->role
            ]);

            // Periksa apakah pengguna terotentikasi sebelumnya sebelum menggunakan Auth::user()->username
            $username = Auth::check() ? Auth::user()->username : 'Unknown';

            Activity::create(array_merge(session('myActivity'), [
                'user_id' => $newUser->id,
                'action' => $username . ' User Create New Account ID ' . $newUser->id,
            ]));

            return redirect()->back()->with('success_register', 'User Berhasil Dibuat.. Tunggu Konfirmasi Admin');

        } catch (\Throwable $e) {
            return redirect()->back()->with('error_register', 'Gagal Buat User ' . $e->getMessage());
        }
    }

}