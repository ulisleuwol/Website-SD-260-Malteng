<?php

namespace App\Http\Controllers\Guest;

use App\Models\Agenda;
use App\Models\Kegiatan;
use App\Models\GaleryFoto;
use App\Models\Pengumuman;
use App\Models\GaleryVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GaleryController extends Controller
{
    public function foto(Request $request)
    {
        $foto = GaleryFoto::with('user')->latest()->search($request->search)->paginate(6)->withQueryString();
        return view('guest.galery.galery-foto', compact('foto'));
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
             
        $foto = GaleryFoto::with('user')->where('slug', $slug)->firstOrFail();
        return view('guest.galery.galery-show', compact('foto', 'pengumuman', 'agenda', 'kegiatan'));
    }

    public function video(Request $request)
    {
        $video = GaleryVideo::with('user')->latest()->search($request->search)->paginate(6)->withQueryString();
        return view('guest.galery.galery-video', compact('video'));
    }
}
