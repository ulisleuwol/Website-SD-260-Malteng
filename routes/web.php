<?php

use App\Http\Controllers;
// use App\Http\Controllers\Controller;
// use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controllers\Guest\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Controllers\Back\DashboardController::class)->middleware('verified')->name('dashboard');

    Route::get('/profile', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/kegiatan', Controllers\Back\KegiatanController::class)->except(['show', 'edit', 'destroy', 'create']);
    Route::delete('/kegiatan/{kegiatan:slug}', [Controllers\Back\KegiatanController::class, 'destroy'])->name('kegiatan.destroy');
    Route::get('/kegiatan/{kegiatan:slug}', [Controllers\Back\KegiatanController::class, 'show'])->name('kegiatan.show');
    Route::get('/kegiatan/{kegiatan:slug}/edit', [Controllers\Back\KegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::post('/kegiatan/bulk-delete',  [Controllers\Back\KegiatanController::class, 'bulkDelete'])->name('kegiatan.bulk_delete');

    Route::resource('/agenda', Controllers\Back\AgendaController::class)->except(['show', 'edit', 'destroy', 'create']);
    Route::delete('/agenda/{agenda:slug}', [Controllers\Back\AgendaController::class, 'destroy'])->name('agenda.destroy');
    Route::get('/agenda/{agenda:slug}', [Controllers\Back\AgendaController::class, 'show'])->name('agenda.show');
    Route::get('/agenda/{agenda:slug}/edit', [Controllers\Back\AgendaController::class, 'edit'])->name('agenda.edit');
    Route::post('/agenda/bulk-delete',  [Controllers\Back\AgendaController::class, 'bulkDelete'])->name('agenda.bulk_delete');

    Route::resource('/pengumuman', Controllers\Back\PengumumanController::class)->except(['show', 'edit', 'destroy', 'create']);
    Route::delete('/pengumuman/{pengumuman:slug}', [Controllers\Back\PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
    Route::get('/pengumuman/{pengumuman:slug}', [Controllers\Back\PengumumanController::class, 'show'])->name('pengumuman.show');
    Route::get('/pengumuman/{pengumuman:slug}/edit', [Controllers\Back\PengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::post('/pengumuman/bulk-delete',  [Controllers\Back\PengumumanController::class, 'bulkDelete'])->name('pengumuman.bulk_delete');

    Route::resource('/guru', Controllers\Back\GuruController::class)->except(['show', 'edit', 'destroy', 'create']);
    Route::delete('/guru/{guru:slug}', [Controllers\Back\GuruController::class, 'destroy'])->name('guru.destroy');
    Route::get('/guru/{guru:slug}', [Controllers\Back\GuruController::class, 'show'])->name('guru.show');
    Route::get('/guru/{guru:slug}/edit', [Controllers\Back\GuruController::class, 'edit'])->name('guru.edit');
    Route::post('/guru/bulk-delete',  [Controllers\Back\GuruController::class, 'bulkDelete'])->name('guru.bulk_delete');

    Route::resource('/visi-misi', Controllers\Back\VisiMisiController::class)->except(['show', 'edit', 'destroy', 'create']);
    Route::delete('/visi-misi/{visi_misi:slug}', [Controllers\Back\VisiMisiController::class, 'destroy'])->name('visi-misi.destroy');
    Route::get('/visi-misi/{visi_misi:slug}/edit', [Controllers\Back\VisiMisiController::class, 'edit'])->name('visi-misi.edit');

    Route::resource('/sejarah', Controllers\Back\SejarahController::class)->except(['show', 'edit', 'destroy', 'create']);
    Route::delete('/sejarah/{sejarah:slug}', [Controllers\Back\SejarahController::class, 'destroy'])->name('sejarah.destroy');
    Route::get('/sejarah/{sejarah:slug}', [Controllers\Back\SejarahController::class, 'show'])->name('sejarah.show');
    Route::get('/sejarah/{sejarah:slug}/edit', [Controllers\Back\SejarahController::class, 'edit'])->name('sejarah.edit');

    Route::resource('/fasilitas', Controllers\Back\FasilitasController::class)->except(['show', 'edit', 'destroy', 'create']);
    Route::delete('/fasilitas/{fasilitas:slug}', [Controllers\Back\FasilitasController::class, 'destroy'])->name('fasilitas.destroy');
    Route::get('/fasilitas/{fasilitas:slug}', [Controllers\Back\FasilitasController::class, 'show'])->name('fasilitas.show');
    Route::get('/fasilitas/{fasilitas:slug}/edit', [Controllers\Back\FasilitasController::class, 'edit'])->name('fasilitas.edit');
    Route::post('/fasilitas/bulk-delete',  [Controllers\Back\FasilitasController::class, 'bulkDelete'])->name('fasilitas.bulk_delete');

    Route::resource('/prestasi', Controllers\Back\PrestasiController::class)->except(['show', 'edit', 'destroy', 'create']);
    Route::delete('/prestasi/{prestasi:slug}', [Controllers\Back\PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    Route::get('/prestasi/{prestasi:slug}', [Controllers\Back\PrestasiController::class, 'show'])->name('prestasi.show');
    Route::get('/prestasi/{prestasi:slug}/edit', [Controllers\Back\PrestasiController::class, 'edit'])->name('prestasi.edit');
    Route::post('/prestasi/bulk-delete',  [Controllers\Back\PrestasiController::class, 'bulkDelete'])->name('prestasi.bulk_delete');

    Route::resource('/eskul', Controllers\Back\EskulController::class)->except(['show', 'edit', 'destroy', 'create']);
    Route::delete('/eskul/{eskul:slug}', [Controllers\Back\EskulController::class, 'destroy'])->name('eskul.destroy');
    Route::get('/eskul/{eskul:slug}', [Controllers\Back\EskulController::class, 'show'])->name('eskul.show');
    Route::get('/eskul/{eskul:slug}/edit', [Controllers\Back\EskulController::class, 'edit'])->name('eskul.edit');
    Route::post('/eskul/bulk-delete',  [Controllers\Back\EskulController::class, 'bulkDelete'])->name('eskul.bulk_delete');

    Route::resource('/galery-foto', Controllers\Back\GaleryFotoController::class)->except(['show', 'edit', 'destroy', 'create']);
    Route::delete('/galery-foto/{galery_foto:slug}', [Controllers\Back\GaleryFotoController::class, 'destroy'])->name('galery-foto.destroy');
    Route::get('/galery-foto/{galery_foto:slug}', [Controllers\Back\GaleryFotoController::class, 'show'])->name('galery-foto.show');
    Route::get('/galery-foto/{galery_foto:slug}/edit', [Controllers\Back\GaleryFotoController::class, 'edit'])->name('galery-foto.edit');
    Route::post('/galery-foto/bulk-delete',  [Controllers\Back\GaleryFotoController::class, 'bulkDelete'])->name('galery-foto.bulk_delete');

    Route::resource('/galery-video', Controllers\Back\GaleryVideoController::class)->except(['show', 'edit', 'destroy', 'create']);
    Route::delete('/galery-video/{galery_video:slug}', [Controllers\Back\GaleryVideoController::class, 'destroy'])->name('galery-video.destroy');
    Route::get('/galery-video/{galery_video:slug}', [Controllers\Back\GaleryVideoController::class, 'show'])->name('galery-video.show');
    Route::get('/galery-video/{galery_video:slug}/edit', [Controllers\Back\GaleryVideoController::class, 'edit'])->name('galery-video.edit');
    Route::post('/galery-video/bulk-delete',  [Controllers\Back\GaleryVideoController::class, 'bulkDelete'])->name('galery-video.bulk_delete');

    Route::get('/pengaturan', [Controllers\Back\PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan/{pengaturan}', [Controllers\Back\PengaturanController::class, 'update'])->name('pengaturan.update');

    Route::resource('/ppdb', Controllers\Back\PPDBController::class)->except(['show', 'edit', 'destroy', 'create']);
    Route::delete('/ppdb/{ppdb:slug}', [Controllers\Back\PPDBController::class, 'destroy'])->name('ppdb.destroy');
    Route::get('/ppdb/{ppdb:slug}', [Controllers\Back\PPDBController::class, 'show'])->name('ppdb.show');
    Route::get('/ppdb/{ppdb:slug}/edit', [Controllers\Back\PPDBController::class, 'edit'])->name('ppdb.edit');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/guest.php';
