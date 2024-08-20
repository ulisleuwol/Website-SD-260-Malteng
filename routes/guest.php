<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\VisiMisiController as GuestVisiMisiController;
use App\Http\Controllers\Guest\GuruController as GuestGuruController;
use App\Http\Controllers\Guest\FasilitasController as GuestFasilitasController;
use App\Http\Controllers\Guest\KegiatanController as GuestKegiatanController;
use App\Http\Controllers\Guest\AgendaController as GuestAgendaController;
use App\Http\Controllers\Guest\PengumumanController as GuestPengumumanController;
use App\Http\Controllers\Guest\GaleryController as GuestGaleryController;
use App\Http\Controllers\Guest\PrestasiController as GuestPrestasiController;
use App\Http\Controllers\Guest\KontakController as GuestKontakController;
use App\Http\Controllers\Guest\EskulController as GuestEskulController;
use App\Http\Controllers\Guest\SejarahController as GuestSejarahController;
use App\Http\Controllers\Guest\PPDBController as GuestPPDBController;

Route::get('/visi-misi-sekolah', [GuestVisiMisiController::class, 'index'])->name('visi-misi-sekolah');
Route::get('/data-guru', [GuestGuruController::class, 'index'])->name('guru');

Route::get('/fasilitas-sekolah', [GuestFasilitasController::class, 'index'])->name('fasilitas-sekolah');
Route::get('/fasilitas-sekolah/{slug}', [GuestFasilitasController::class, 'show'])->name('fasilitas-sekolah-show');

Route::get('/kegiatan-sekolah', [GuestKegiatanController::class, 'index'])->name('kegiatan-sekolah');
Route::get('/kegiatan-sekolah/{slug}', [GuestKegiatanController::class, 'show'])->name('kegiatan-sekolah-show');

Route::get('/agenda-sekolah', [GuestAgendaController::class, 'index'])->name('agenda-sekolah');

Route::get('/pengumuman-sekolah', [GuestPengumumanController::class, 'index'])->name('pengumuman-sekolah');

Route::get('/prestasi-ak', [GuestPrestasiController::class, 'index'])->name('prestasi-ak');
Route::get('/prestasi-ak/{slug}', [GuestPrestasiController::class, 'show'])->name('prestasi-ak-show');

Route::get('/galery-foto-sekolah', [GuestGaleryController::class, 'foto'])->name('galery-foto-sekolah');

Route::get('/galery-video-sekolah', [GuestGaleryController::class, 'video'])->name('galery-video-sekolah');
Route::get('/galery-foto-sekolah/{slug}', [GuestGaleryController::class, 'show'])->name('galery-foto-show');

Route::get('/eskul-sekolah', [GuestEskulController::class, 'index'])->name('eskul-sekolah');
Route::get('/eskul-sekolah/{slug}', [GuestEskulController::class, 'show'])->name('eskul-sekolah-show');

Route::get('/sejarah-sekolah', [GuestSejarahController::class, 'index'])->name('sejarah-sekolah');

Route::get('/kontak-sekolah', [GuestKontakController::class, 'index'])->name('kontak-sekolah');
Route::post('/kontak-sekolah', [GuestKontakController::class, 'sendEmail'])->name('kontak-send');

Route::get('/ppdb-sekolah', [GuestPPDBController::class, 'index'])->name('ppdb-sekolah');

