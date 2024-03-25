<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\Admin\DashboardAdmin;
use App\Http\Controllers\Admin\DaftarPengguna;
use App\Http\Controllers\Pengurus\DashboardPengurus;
use App\Http\Controllers\user\Dashboarduser;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('home_dashboard');
Route::get('/login', [LoginController::class, 'index'])->name('form.login');
Route::get('/materials', [MaterialsController::class, 'index'])->name('materials');
Route::post('/materials/find', [MaterialsController::class, 'find'])->name('materials.find');
Route::get('/courses/{jenis_materi}', [CoursesController::class, 'index'])->name('courses');
Route::post('/courses/submit', [CoursesController::class, 'submitBook'])->name('courses.submit');
Route::post('/dashboard/chat/submit', [DashboardController::class, 'submitChat'])->name('dashboard.submit_chat');

Route::post('/login', [LoginController::class, 'login'])->name('submit_form.login');

// Tambahkan rute lain untuk admin di sini
Route::middleware(['auth.login', 'admin.auth'])->group(function () {
    Route::get('/admin', [DashboardAdmin::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/daftar_pengguna', [DaftarPengguna::class, 'index'])->name('daftar_pengguna.index');
    Route::get('/admin/daftar_pengguna/delete/{user_id}', [DaftarPengguna::class, 'delete'])->name('daftar_pengguna.delete');
});


// Tambahkan rute lain untuk admin di sini
Route::middleware(['auth.login', 'pengurus.auth'])->group(function () {
    Route::get('/pengurus', [DashboardPengurus::class, 'index'])->name('pengurus.dashboard');
});


// Tambahkan rute lain untuk admin di sini
Route::middleware(['auth.login', 'user.auth'])->group(function () {
    Route::get('/user', [DashboardUser::class, 'index'])->name('user.dashboard');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');