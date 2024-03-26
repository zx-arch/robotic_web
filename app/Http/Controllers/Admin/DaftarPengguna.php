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
        $users = User::where('role', '!=', 'admin')
            ->withTrashed() // Ini akan hanya mengambil pengguna yang telah dihapus secara lembut
            ->latest();

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
        //dd($user_id);
        try {
            User::where('id', decrypt($user_id))->update([
                'status' => 'deleted'
            ]);
            User::where('id', decrypt($user_id))->delete();

            return redirect()->route('daftar_pengguna.index')->with('success_deleted', 'Data berhasil dihapus!');

        } catch (\Throwable $e) {
            return redirect()->back()->with('error_deleted', 'Data gagal dihapus. ' . $e->getMessage());
        }

    }
    public function update($user_id)
    {
        try {
            $user = Users::where('id', decrypt($user_id))->first();
            return view('Admin.DaftarPengguna.update', $this->data, compact('user'));

        } catch (\Throwable $e) {
            return redirect()->route('daftar_pengguna.index')->with('error_view', 'Halaman tidak tersedia, pastikan user terdaftar dan belum dihapus!');
        }
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
                'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/'],
            ]);
            //dd($request->all());
            User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'status' => $request->status,
                'role' => $request->role
            ]);

            return redirect()->route('daftar_pengguna.index')->with('success_submit_save', 'User Berhasil Dibuat!');

        } catch (\Throwable $e) {
            return redirect()->back()->with('error_submit_save', $e->getMessage());
        }

    }

    public function view($user_id)
    {
        try {
            $user = Users::where('id', decrypt($user_id))->first();
            return view('Admin.DaftarPengguna.view', $this->data, compact('user'));

        } catch (\Throwable $e) {
            return redirect()->route('daftar_pengguna.index')->with('error_view', 'Halaman tidak tersedia, pastikan user terdaftar dan belum dihapus!');
        }
    }

    public function saveUpdate($user_id, Request $request)
    {
        //dd($request->all(), $user_id);
        try {
            if ($request->isMethod('put')) {

                $user = User::find($user_id);

                if (Hash::needsRehash($request->password)) {
                    $hashedPassword = Hash::make($request->password);
                } else {
                    // Jika password sudah menggunakan algoritma yang sesuai, gunakan yang sudah ada
                    $hashedPassword = $request->password;
                }

                // Lakukan update dengan password yang sudah di-rehash jika perlu
                $user->update([
                    'password' => $hashedPassword,
                ]);

                return redirect()->route('daftar_pengguna.index')->with('success_submit_save', 'Data berhasil diupdate!');

            } else {
                return redirect()->back()->with('error_submit_save', 'Request data tidak valid!');
            }

        } catch (\Throwable $e) {
            return redirect()->back()->with('error_submit_save', 'Data gagal diupdate. ' . $e->getMessage());
        }
    }

    public function updatePassword($user_id)
    {
        $user = Users::where('id', decrypt($user_id))->first();
        return view('Admin.DaftarPengguna.updatePassword', $this->data, compact('user'));
    }

    public function restore($user_id)
    {
        try {
            $data = User::withTrashed()->find(decrypt($user_id));
            $data->restore();
            $data->update(['status' => 'active']);

            return redirect()->route('daftar_pengguna.index')->with('success_restore', 'Data berhasil direstore!');

        } catch (\Throwable $e) {
            return redirect()->route('daftar_pengguna.index')->with('error_restore', 'User id tidak ditemukan, pastikan user sudah di delete!');
        }

    }
}