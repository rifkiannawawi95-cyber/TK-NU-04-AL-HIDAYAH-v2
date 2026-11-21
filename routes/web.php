<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\User;

// Public Routes

Route::get('/', [PublicController::class, 'home']);
Route::get('/profil', [PublicController::class, 'profil']);
Route::get('/acara', [PublicController::class, 'acara']);
Route::get('/prestasi', [PublicController::class, 'prestasi']);
Route::get('/galeri', [PublicController::class, 'galeri']);
Route::get('/kalender-akademik', [PublicController::class, 'kalender']);
Route::get('/kontak', [PublicController::class, 'kontak']);
Route::post('/testimoni', [PublicController::class, 'storeTestimoni'])->middleware('throttle:5,1')->name('testimoni.store');

// Route fallback untuk menyajikan file storage publik (solusi symlink Windows/Laragon)
Route::get('/storage/{path}', function ($path) {
    if (str_contains($path, '..')) {
        abort(404);
    }

    $filePath = storage_path('app/public/' . $path);
    if (!file_exists($filePath) || !is_file($filePath)) {
        abort(404);
    }

    return response()->file($filePath);
})->where('path', '.*');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::put('/dashboard/address', [Admin\DashboardController::class, 'updateAddress'])->name('dashboard.address');
    
    Route::resource('guru', Admin\GuruController::class);
    
    Route::get('kehadiran-guru', [Admin\KehadiranGuruController::class, 'index'])->name('kehadiranguru.index');
    Route::post('kehadiran-guru', [Admin\KehadiranGuruController::class, 'store'])->name('kehadiranguru.store');
    Route::get('kehadiran-guru/rekap', [Admin\KehadiranGuruController::class, 'rekap'])->name('kehadiranguru.rekap');
    
    Route::resource('siswa', Admin\SiswaController::class);
    Route::resource('acara', Admin\AcaraController::class);
    Route::resource('prestasi', Admin\PrestasiController::class);
    Route::resource('galeri', Admin\GaleriController::class);
    Route::resource('kalender', Admin\KalenderController::class);

    // Testimoni & Komentar Wali Santri
    Route::get('testimoni', [Admin\TestimoniController::class, 'index'])->name('testimoni.index');
    Route::patch('testimoni/{testimoni}/approve', [Admin\TestimoniController::class, 'approve'])->name('testimoni.approve');
    Route::patch('testimoni/{testimoni}/reject', [Admin\TestimoniController::class, 'reject'])->name('testimoni.reject');
    Route::delete('testimoni/{testimoni}', [Admin\TestimoniController::class, 'destroy'])->name('testimoni.destroy');

    Route::get('laporan', [Admin\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/guru', [Admin\LaporanController::class, 'guru'])->name('laporan.guru');
    Route::get('laporan/siswa', [Admin\LaporanController::class, 'siswa'])->name('laporan.siswa');

    // Pengaturan
    Route::get('setting', [Admin\SettingController::class, 'index'])->name('setting.index');
    Route::put('setting/school', [Admin\SettingController::class, 'updateSchool'])->name('setting.school');
    Route::put('setting/logo', [Admin\SettingController::class, 'updateLogo'])->name('setting.logo');
    Route::put('setting/photo', [Admin\SettingController::class, 'updatePhoto'])->name('setting.photo');
    Route::delete('setting/photo/{key}', [Admin\SettingController::class, 'resetPhoto'])->name('setting.photo.reset');
    Route::put('setting/guru/{guru}', [Admin\SettingController::class, 'updateGuru'])->name('setting.guru');
});

// User (Guru) Routes
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [User\DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('siswa', User\SiswaController::class);
    
    Route::get('kehadiran-siswa', [User\KehadiranSiswaController::class, 'index'])->name('kehadiransiswa.index');
    Route::post('kehadiran-siswa', [User\KehadiranSiswaController::class, 'store'])->name('kehadiransiswa.store');
    Route::get('kehadiran-siswa/rekap', [User\KehadiranSiswaController::class, 'rekap'])->name('kehadiransiswa.rekap');
});
