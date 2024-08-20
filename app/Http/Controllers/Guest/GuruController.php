<?php

namespace App\Http\Controllers\Guest;

use App\Models\Guru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $guru = Guru::select('nama', 'image', 'jabatan')->latest()->search($request->search)->paginate(12)->withQueryString();
        return view('guest.guru.data-guru', compact('guru'));
    }
}
