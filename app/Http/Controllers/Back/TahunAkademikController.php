<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;

class TahunAkademikController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['name' => 'Tahun Ajaran'],
        ];
        $thnakademik = TahunAkademik::get();
        return view('akademik.index', [
            'thnakademik' => $thnakademik,
            'breadcrumbs' => $breadcrumbs,
            'title' => 'Tabel Tahun Ajaran',
        ]);
    }

    public function create()
    {
        return view('akademik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string|unique:tahun_akademik,year',
        ]);

        $breadcrumbs = [
            ['name' => 'Tahun Ajaran'],
        ];

        TahunAkademik::create([
            'tahun' => $request->tahun,
            'status' => false,
            'semester' => 'Ganjil',
        ]);

        return redirect()->route('akademik.index')->with('success', 'Tahun ajaran berhasil ditambahkan');
    }

    public function edit(TahunAkademik $thnakademik)
    {
        $breadcrumbs = [
            ['name' => 'Tahun Ajaran'],
        ];
        return view('akademik.edit', compact('thnakademik', 'breadcrumbs'), [
            'title' => 'Edit Tahun Ajaran',
        ]);
    }

    public function update(Request $request, TahunAkademik $thnakademik)
    {
        $thnakademik->update([
            'status' => $request->has('status') ? true : false,
            'semester' => $request->semester,
        ]);

        return redirect()->route('akademik.index')->with('success', 'Tahun ajaran berhasil diperbarui');
    }
}