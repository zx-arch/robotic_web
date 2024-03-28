<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;
use Illuminate\Validation\ValidationException;

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
    public function search(Request $request)
    {
        // Mendapatkan data pencarian dari request
        $searchData = $request->input('search');
        // Lakukan sesuatu dengan data pencarian, contoh: mencari data di database
        $username = $searchData['username'] ?? null;
        $email = $searchData['email'] ?? null;
        $status = $searchData['status'] ?? null;
        $created_at = $searchData['created_at'] ?? null;
        $last_login = $searchData['last_login'] ?? null;

        // Misalnya, Anda ingin mencari data user berdasarkan username, email, status, created_at, atau last_login
        $users = User::query()->where('role', '!=', 'admin')->withTrashed();

        if ($status !== null || $last_login !== null && ($username !== null || $email !== null || $created_at !== null)) {
            // Menggunakan where untuk menambahkan kondisi pencarian tambahan
            $users->where('status', $status);

            if ($username !== null) {
                $users->where('username', 'like', "$username%");
            }

            if ($email !== null) {
                $users->where('email', 'like', "$email%");
            }

            if ($created_at !== null) {
                $users->where('created_at', 'like', "$created_at%");
            }

            if ($last_login !== null) {
                $users->where('last_login', 'like', "$last_login%");
            }

        } elseif ($username !== null || $status !== null || $email !== null || $created_at !== null || $last_login !== null) {
            $users->where(function ($query) use ($username, $status, $email, $created_at, $last_login) {
                if ($username !== null) {
                    $query->where('username', 'like', "$username%");
                }

                if ($status !== null) {
                    $query->orWhere('status', $status);
                }

                if ($email !== null) {
                    $query->orWhere('email', 'like', "$email%");
                }

                if ($created_at !== null) {
                    $query->orWhere('created_at', 'like', "$created_at%");
                }

                if ($last_login !== null) {
                    $query->orWhere('last_login', 'like', "$last_login%");
                }
            });
        }

        $totalUsers = $users->count();

        // Menentukan jumlah item per halaman
        $itemsPerPage = 15;

        // Menentukan jumlah halaman maksimum untuk semua data
        $totalPagesAll = ceil($totalUsers / $itemsPerPage);
        $users = $users->paginate($itemsPerPage);

        // Mendapatkan URI lengkap dari request
        $fullUri = $request->getRequestUri();

        if ($totalPagesAll >= 15) {
            $totalPages = 15;
        }

        $users->setPath($fullUri);

        if ($users->count() > 15) {
            $users = $users->paginate($itemsPerPage);
            //dd($users);
            if ($users->currentPage() > $users->lastPage()) {
                return redirect($users->url($users->lastPage()));
            }
        }
        return view('Admin.DaftarPengguna.index', $this->data, compact('users', 'searchData', 'itemsPerPage'));

    }

    public function add()
    {
        return view('Admin.DaftarPengguna.add', $this->data);
    }

    public function delete($user_id)
    {
        //dd($user_id);
        try {
            $user = User::find(decrypt($user_id));

            $user->update([
                'status' => 'deleted'
            ]);

            $user->delete();

            Activity::create(array_merge(session('myActivity'), [
                'user_id' => Auth::user()->id,
                'action' => Auth::user()->username . ' Deleted Account User ' . $user->username . ' ID ' . decrypt($user_id),
            ]));

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

            $existingUser = User::where('email', $request->email)->orWhere('username', $request->username)->first();

            if ($existingUser) {
                throw ValidationException::withMessages(['email' => 'User or email already exists.']);
            }
            //dd($request->all());
            $newUser = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'status' => $request->status,
                'role' => $request->role
            ]);

            Activity::create(array_merge(session('myActivity'), [
                'user_id' => Auth::user()->id,
                'action' => Auth::user()->username . ' Add New Account User ' . $newUser->username . ' ID ' . $newUser,
            ]));

            return redirect()->route('daftar_pengguna.index')->with('success_submit_save', 'User Berhasil Dibuat!');

        } catch (ValidationException $e) {
            // Tangkap kesalahan validasi
            return redirect()->back()->withErrors($e->errors())->withInput();

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

                // masukkan tanggal email_verified_at saat posisi user inactive tetapi sudah diaktifkan dari admin
                if ($user->status == 'inactive') {
                    if ($request->status == 'active') {
                        $user->update([
                            'email_verified_at' => now(),
                        ]);
                    }
                }

                // Lakukan update dengan password yang sudah di-rehash jika perlu
                $user->update([
                    'username' => $request->username,
                    'email' => $request->email,
                    'role' => $request->role,
                    'status' => $request->status,
                    'password' => $hashedPassword,
                ]);

                Activity::create(array_merge(session('myActivity'), [
                    'user_id' => Auth::user()->id,
                    'action' => Auth::user()->username . ' Update User Account ' . $user->username . ' ID ' . $user->id,
                ]));

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
            $user = User::withTrashed()->find(decrypt($user_id));
            $user->restore();
            $user->update(['status' => 'active']);

            Activity::create(array_merge(session('myActivity'), [
                'user_id' => Auth::user()->id,
                'action' => Auth::user()->username . ' Restore Data User Account ' . $user->username . ' ID ' . $user->id,
            ]));

            return redirect()->route('daftar_pengguna.index')->with('success_restore', 'Data berhasil direstore!');

        } catch (\Throwable $e) {
            return redirect()->route('daftar_pengguna.index')->with('error_restore', 'User id tidak ditemukan, pastikan user sudah di delete!');
        }

    }
}