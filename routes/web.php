<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ===============================================================
    // PRIORITASKAN RUTE ADMIN (resource) DI ATAS RUTE PUBLIK DINAMIS
    // ===============================================================

    // Rute khusus untuk ADMIN (di dalam middleware 'admin')
    // Tempatkan grup ini PERTAMA setelah rute dashboard
    Route::middleware(['admin'])->group(function () {
        // Ini akan mendaftarkan: index, create, store, edit, update, destroy
        // 'show' dikecualikan karena akan didefinisikan terpisah untuk semua user di bawah.
        // Sekarang, /beritas/create akan cocok dengan rute resource ini terlebih dahulu.
        Route::resource('beritas', BeritaController::class)->except(['show']);
    });

    // Rute Berita yang dapat diakses oleh SEMUA USER (termasuk Admin)
    // Tempatkan rute show yang dinamis INI SETELAH rute resource admin.
    // Ini penting agar /beritas/create tidak "tertangkap" oleh /beritas/{berita}
    Route::get('/beritas/{berita}', [BeritaController::class, 'show'])->name('beritas.show'); // Show berita detail

    // ===============================================================
    // Rute untuk Profile (tetap di sini)
    // ===============================================================
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
