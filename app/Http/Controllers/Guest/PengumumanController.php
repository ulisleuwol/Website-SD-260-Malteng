<?php

namespace App\Http\Controllers\Guest;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $pengumuman = Pengumuman::with('user')
            ->latest()
            ->search($request->search)
            ->paginate(6)
            ->withQueryString();
        return view('guest.pengumuman.pengumuman', compact('pengumuman'));
    }
}
