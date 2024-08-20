<?php

namespace App\Http\Controllers\Guest;

use App\Models\Agenda;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrestasiController extends Controller
{

    public function index(Request $request)
    {
        $prestasi = Prestasi::with('user')
            ->latest()
            ->search($request->search)
            ->paginate(6)
            ->withQueryString();
        return view('guest.prestasi.prestasi', compact('prestasi'));
    }

    public function show($slug)
    {
        // Query untuk agenda, kegiatan dan pengumuman
        $agenda = Agenda::select('id', 'title', 'user_id', 'description', 'location', 'date_time', 'created_at')->with('user')->latest()->take(6)->get();
        $pengumuman = Pengumuman::select('id', 'title', 'user_id', 'body', 'excerpt', 'created_at')->with('user')->latest()->take(6)->get();
        $kegiatan = Kegiatan::select('title', 'user_id', 'excerpt', 'image', 'location', 'created_at', 'slug')
            ->with('user')
            ->latest()
            ->take(6)
            ->get();

        $prestasi = Prestasi::with('user')
            ->where('slug', $slug)
            ->firstOrFail();
        return view('guest.prestasi.prestasi-show', compact('prestasi', 'pengumuman', 'agenda', 'kegiatan'));
    }
}
