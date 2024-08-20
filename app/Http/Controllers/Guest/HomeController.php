<?php

namespace App\Http\Controllers\Guest;

use App\Models\Guru;
use App\Models\Eskul;
use App\Models\Agenda;
use App\Models\Sejarah;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\Fasilitas;
use App\Models\Pengaturan;
use App\Models\Pengumuman;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        $pengaturan = Pengaturan::first();

        $kegiatan = Kegiatan::select('title', 'user_id', 'slug', 'excerpt', 'image', 'created_at', 'location')
            ->with('user')
            ->latest()
            ->take(6)
            ->get();

        $pengumuman = Pengumuman::with('user')
            ->latest()
            ->take(4)
            ->get();

        $guru = Guru::select('nama', 'image', 'jabatan')
            ->take(6)
            ->get();

        $agenda = Agenda::with('user')
            ->latest()
            ->take(4)
            ->get();

        $eskul = Eskul::select('eskul', 'slug', 'image')
            ->latest()
            ->take(4)
            ->get();

        $sejarah = Sejarah::first();
        $fasilitas = Fasilitas::all();
        $prestasi = Prestasi::all();

        $total = count($guru);

        return view('guest.home', [
            'nama_web' => $pengaturan->nama_web ?? 'Sekolah Dasar Negeri 260 Maluku Tengah',
            'banner' => $pengaturan->banner ?? asset('guest/assets/img/sdn.png'),
            'home' => $pengaturan->deskripsi ?? '',
            'akreditas' => $pengaturan->akreditas ?? '',
            'total' => $total,
            'kegiatan' => $kegiatan,
            'pengumuman' => $pengumuman,
            'guru' => $guru,
            'agenda' => $agenda,
            'eskul' => $eskul,
            'deskripsi' => $sejarah->excerpt ?? 'Sekolah Dasar Negeri 260 Maluku Tengah',
            'title' => $sejarah->title ?? 'Sejarah Sekolah Dasar Negeri 260 Maluku Tengah',
            'fasilitas' => $total = count($fasilitas),
            'prestasi' => $total = count($prestasi),
        ]);
    }
}
