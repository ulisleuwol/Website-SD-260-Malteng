<?php

namespace App\Http\Controllers\Guest;

use App\Models\Agenda;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        // Gunakan scope search dan eager loading user
        $kegiatan = Kegiatan::select('title', 'user_id', 'excerpt', 'image', 'location', 'created_at', 'slug')
            ->with('user')
            ->latest()
            ->search($request->search)
            ->paginate(6)
            ->withQueryString();

        // Return view dengan data kegiatan
        return view('guest.kegiatan.kegiatan', compact('kegiatan'));
    }


    public function show($slug)
    {
        // Query kegiatan berdasarkan slug
        $keg = Kegiatan::where('slug', $slug)->firstOrFail();

        // Query untuk agenda dan pengumuman
        $agenda = Agenda::select('id', 'title', 'user_id', 'description', 'location', 'date_time', 'created_at')->with('user')->latest()->take(6)->get();
        $pengumuman = Pengumuman::select('id', 'title', 'user_id', 'body', 'file', 'excerpt', 'created_at')->with('user')->latest()->take(6)->get();

        // Query untuk kegiatan lainnya kecuali yang sesuai dengan slug
        $kegiatan = Kegiatan::select('title', 'user_id', 'excerpt', 'image', 'location', 'created_at', 'slug')
            ->with('user')
            ->where('slug', '!=', $slug) // Tidak termasuk kegiatan yang sesuai dengan slug
            ->latest()
            ->paginate(6);

        // Return view dengan data kegiatan, agenda, pengumuman, dan kegiatan lainnya
        return view('guest.kegiatan.kegiatan-show', compact('kegiatan', 'agenda', 'pengumuman', 'keg'));
    }
}
