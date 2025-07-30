<?php

use App\Http\Controllers\AbsenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PresenceDetailController;
use App\Models\PresenceDetail;

// Route halaman utama
Route::get('/', function () {
    return view('pages.index');
})->name('home');

// Route resource lengkap untuk CRUD Presence (admin)
Route::resource('presence', PresenceController::class);

// Route untuk menghapus detail kehadiran (admin)
Route::delete('presence-detail/{id}', [PresenceDetailController::class, 'destroy'])
    ->name('presence-detail.destroy');
Route::get('presence-detail/export-pdf/{id}', [PresenceDetailController::class, 'exportpdf'])->name('presence-detail.export-pdf');

// Route untuk absen (public)
Route::get('absen/{slug}', [AbsenController::class, 'index'])->name('absen.index');
Route::post('absen/save/{id}', [AbsenController::class, 'save'])->name('absen.save');
