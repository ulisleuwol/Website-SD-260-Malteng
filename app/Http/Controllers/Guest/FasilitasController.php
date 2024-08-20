<?php

namespace App\Http\Controllers\Guest;

use App\Models\Agenda;
use App\Models\Kegiatan;
use App\Models\Fasilitas;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FasilitasController extends Controller
{
    public function index(Request $request)
    {
        $fasilitas = Fasilitas::latest()->search($request->search)->paginate(8)->withQueryString();
        return view('guest.fasilitas.fasilitas', compact('fasilitas'));
    }

    // Method untuk menampilkan detail fasilitas berdasarkan slug
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

        $fasilitas = Fasilitas::where('slug', $slug)->firstOrFail();
        return view('guest.fasilitas.fasilitas-show', compact('fasilitas', 'pengumuman', 'agenda', 'kegiatan'));
    }
}
