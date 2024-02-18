<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookTranslation;

class DashboardController extends Controller
{
    public function index()
    {
        // $bookTranslation = BookTranslation::create([
        //     'language_name' => 'English',
        //     'status_id' => 1,
        // ]);

        // // Periksa hasil insert
        // if ($bookTranslation) {
        //     echo "Data berhasil dimasukkan ke dalam tabel BookTranslation.";
        // } else {
        //     echo "Gagal memasukkan data ke dalam tabel BookTranslation.";
        // }

        return view('partial.dashboard');
    }
}