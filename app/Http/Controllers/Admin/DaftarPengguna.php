<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DaftarPengguna extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['currentAdminMenu'] = 'daftar_pengguna';
        $this->data['currentTitle'] = 'Daftar Pengguna';
    }

    public function index()
    {
        $users = Users
            ::where('role', '!=', 'admin')->latest();
        $totalUsers = $users->count();

        // Menentukan jumlah item per halaman
        $itemsPerPage = 15;
        //print_r();
        // Menentukan jumlah halaman maksimum untuk semua data
        $totalPagesAll = ceil($totalUsers / $itemsPerPage);
        $users = $users->paginate($itemsPerPage);

        if ($totalPagesAll >= 15) {
            $totalPages = 15;
        }

        if ($users->count() > 15) {
            $users = $users->paginate($itemsPerPage);
            //dd($users);
            if ($users->currentPage() > $users->lastPage()) {
                return redirect($users->url($users->lastPage()));
            }
        }
        return view('Admin.DaftarPengguna.index', $this->data, compact('users', 'itemsPerPage'));
    }

    public function add()
    {
        return view('Admin.DaftarPengguna.add', $this->data);
    }

    public function delete($user_id)
    {
        dd($user_id);
    }

    public function save(Request $request)
    {
        // dd($request->all());
        try {
            $this->validate($request, [
                'username' => 'required|string|min:3',
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
                'status' => 'required|string',
                'role' => 'required|string',
                'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            ]);
            //dd($request->all());
            User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'status' => $request->status,
                'role' => $request->role
            ]);

            return redirect()->back()->with('success_submit_save', 'User Berhasil Dibuat!');

        } catch (\Throwable $e) {
            return redirect()->back()->with('error_submit_save', $e->getMessage());
        }

    }
}