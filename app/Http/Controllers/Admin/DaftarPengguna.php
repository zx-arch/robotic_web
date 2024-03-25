<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;

class DaftarPengguna extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data['currentAdminMenu'] = 'users';
    }
    public function index()
    {
        $users = Users::where('role', '!=', 'admin')->latest();
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
        return view('Admin.DaftarPengguna', $this->data, compact('users', 'itemsPerPage'));
    }
    public function delete($user_id)
    {
        dd($user_id);
    }
}