<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
    public function render($request, Throwable $exception)
    {
        // Mengarahkan semua jenis Throwable ke halaman error kustom
        return response()->view('errors.error', ['error' => $exception]);

        // Anda juga bisa menyesuaikan kode di atas sesuai kebutuhan,
        // misalnya menentukan kode status response tertentu seperti 404,
        // atau menambahkan penanganan khusus untuk beberapa jenis Throwable.
    }
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}