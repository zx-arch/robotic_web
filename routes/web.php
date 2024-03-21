<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\CoursesController;

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