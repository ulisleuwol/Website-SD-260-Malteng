<?php

namespace App\Http\Controllers\Guest;


use App\Models\Agenda;
use App\Models\Kegiatan;
use App\Models\VisiMisi;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisiMisiController extends Controller
{
    public function index()
    {
        // Query untuk agenda, kegiatan dan pengumuman
        $agenda = Agenda::select('id', 'title', 'user_id', 'description', 'location', 'date_time', 'created_at')->with('user')->latest()->take(6)->get();
        $pengumuman = Pengumuman::select('id', 'title', 'user_id', 'body', 'excerpt', 'created_at')->with('user')->latest()->take(6)->get();
        $kegiatan = Kegiatan::select('title', 'user_id', 'excerpt', 'image', 'location', 'created_at', 'slug')
            ->with('user')
            ->latest()
            ->take(6)
            ->get();

        $visi = VisiMisi::where('jenis', 'visi')->latest()->first();
        $misi = VisiMisi::where('jenis', 'misi')->latest()->first();

        return view('guest.visi-misi.visi-misi', compact('visi', 'misi', 'agenda', 'pengumuman', 'kegiatan'));
    }
}
