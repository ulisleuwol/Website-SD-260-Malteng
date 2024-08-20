<?php

namespace App\Http\Controllers\Back;

use Exception;
use App\Models\PPDB;
use Illuminate\Http\Request;
use App\Http\Requests\PPDBRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PPDBController extends Controller
{

    public function index()
    {
        $breadcrumbs = [
            ['name' => 'PPDB'],
        ];

        try {
            // Eager load relasi user
            $ppdb = PPDB::with('user')->latest()->get();

            return view('back.ppdb.ppdb', [
                'title' => 'Tabel PPDB',
                'breadcrumbs' => $breadcrumbs,
                'ppdb' => $ppdb,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data PPDB.');
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PPDBRequest $request)
    {
        try {
            $data = $request->validated();

            // Simpan gambar sementara jika ada
            $tempImagePath = $request->file('image')?->store('images-temp');
            $data['image'] = basename($tempImagePath);


            // Buat ppdb
            $ppdb = $request->user()->ppdb()->create($data);

            // Jika transaksi berhasil, pindahkan gambar dari temp ke lokasi akhir
            if ($tempImagePath) {
                $finalImagePath = str_replace('images-temp', 'ppdb-images', $tempImagePath);
                Storage::move($tempImagePath, $finalImagePath);
                $ppdb->update(['image' => $finalImagePath]);
            }

            return response()->json(['message' => 'Data Berhasil Ditambahkan'], 201);
        } catch (\Throwable $e) {
            if ($tempImagePath) {
                Storage::delete($tempImagePath);
            }
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

     /**
     * Display the specified resource.
     */
    public function show(PPDB $ppdb)
    {
        try {
            $breadcrumbs = [
                ['name' => 'PPDB'],
                ['name' => 'Show'],
            ];
            return view('back.ppdb.ppdb-show', compact('ppdb'), [
                'title' => 'Tabel Prestasi',
                'breadcrumbs' => $breadcrumbs,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $ppdb = PPDB::where('slug', $slug)->firstOrFail();
        return response()->json(['data' => $ppdb]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PPDBRequest $request, string $slug)
    {
        try {
            $data = $request->validated();

            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $data['image'] = $request->file('image')->store('ppdb-images');
            }

            // Buat ppdb
            PPDB::where('slug', $slug)->update($data);

            return response()->json(['message' => 'Data Berhasil Diubah'], 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PPDB $ppdb)
    {
        try {
            // Cek jika ada gambar yang terkait dengan data
            if ($ppdb->image) {
                // Hapus gambar dari penyimpanan
                Storage::delete($ppdb->image);
            }

            // Hapus data dari database
            $ppdb->delete();

            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        } catch (Exception $e) {
            // Tangkap pengecualian dan kirim pesan error
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
