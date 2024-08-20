<?php

namespace App\Http\Controllers\Back;

use Exception;
use App\Models\Sejarah;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\SejarahRequest;
use Illuminate\Support\Facades\Storage;

class SejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ['name' => 'Profil Sekolah'],
            ['name' => 'Sejarah'],
        ];

        $sejarah = auth()->user()->sejarah()->with('user')->latest()->get();

        return view('back.sejarah.sejarah', [
            'title' => 'Tabel Sejarah',
            'breadcrumbs' => $breadcrumbs,
            'sejarah' => $sejarah,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SejarahRequest $request)
    {
        try {
            $data = $request->validated();

            // Simpan gambar sementara jika ada
            $tempImagePath = $request->file('image')?->store('images-temp');
            $data['image'] = basename($tempImagePath);

            // Buat excerpt dari deskripsi
            $data['excerpt'] = Str::limit(strip_tags($request->deskripsi), 200);

            // Buat sejarah
            $sejarah = $request->user()->sejarah()->create($data);

            // Jika transaksi berhasil, pindahkan gambar dari temp ke lokasi akhir
            if ($tempImagePath) {
                $finalImagePath = str_replace('images-temp', 'sejarah-images', $tempImagePath);
                Storage::move($tempImagePath, $finalImagePath);
                $sejarah->update(['image' => $finalImagePath]);
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
     * Show the form for editing the specified resource.
     */
    public function show(Sejarah $sejarah)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Profil Sekolah'],
                ['name' => 'Sejarah'],
                ['name' => 'Show'],
            ];
            return view('back.sejarah.sejarah-show', compact('sejarah'), [
                'title' => 'Tabel sejarah',
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
        try {
            $sejarah = Sejarah::where('slug', $slug)->firstOrFail();
            return response()->json(['data' => $sejarah]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SejarahRequest $request, string $slug)
    {
        try {
            $data = $request->validated();

            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $data['image'] = $request->file('image')->store('sejarah-images');
            }

            // Buat excerpt dari deskripsi
            $data['excerpt'] = Str::limit(strip_tags($request->deskripsi), 200);

            // Buat sejarah
            Sejarah::where('slug', $slug)->update($data);

            return response()->json(['message' => 'Data Berhasil Diubah'], 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sejarah $sejarah)
    {
        try {
            // Cek jika ada gambar yang terkait dengan data
            if ($sejarah->image) {
                // Hapus gambar dari penyimpanan
                Storage::delete($sejarah->image);
            }

            // Hapus data dari database
            $sejarah->delete();

            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        } catch (Exception $e) {
            // Tangkap pengecualian dan kirim pesan error
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
