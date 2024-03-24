<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\Admin\DashboardAdmin;
use App\Http\Controllers\Pengurus\DashboardPengurus;
use App\Http\Controllers\User\DashboardUser;

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
Route::get('/materials', [MaterialsController::class, 'index'])->name('materials');
Route::post('/materials/find', [MaterialsController::class, 'find'])->name('materials.find');
Route::get('/courses/{jenis_materi}', [CoursesController::class, 'index'])->name('courses');
Route::post('/courses/submit', [CoursesController::class, 'submitBook'])->name('courses.submit');
Route::post('/dashboard/chat/submit', [DashboardController::class, 'submitChat'])->name('dashboard.submit_chat');

Route::get('/login', [LoginController::class, 'index'])->name('form.login');
Route::post('/login', [LoginController::class, 'login'])->name('submit_form.login');

Route::middleware(['auth', 'pengurus'])->group(function () {
    Route::get('/dashboard', [DashboardPengurus::class, 'index'])->name('pengurus.dashboard');
    // Tambahkan rute lain untuk pengurus di sini
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardAdmin::class, 'index'])->name('admin.dashboard');
    // Tambahkan rute lain untuk admin di sini
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [DashboardUser::class, 'index'])->name('user.dashboard');
    // Tambahkan rute lain untuk admin di sini
});