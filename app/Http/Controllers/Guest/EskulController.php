<?php

namespace App\Http\Controllers\Guest;

use App\Models\Eskul;
use App\Models\Agenda;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EskulController extends Controller
{
    public function index()
    {
        $eskul = Eskul::latest()->paginate(8);
        return view('guest.eskul.eskul', compact('eskul'));
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

        $eskul = Eskul::where('slug', $slug)->first();
        return view('guest.eskul.eskul-show', compact('eskul', 'pengumuman', 'agenda', 'kegiatan'));
    }
}
