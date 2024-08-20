<?php

namespace App\Http\Controllers\Back;

use Exception;
use App\Models\GaleryFoto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\DataTables\GaleryFotoDataTable;
use App\Http\Requests\GaleryFotoRequest;
use Illuminate\Support\Facades\Storage;

class GaleryFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GaleryFotoDataTable $dataTable)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Galeri'],
                ['name' => 'Galeri Foto'],
            ];

            return $dataTable->render('back.galery-foto.galery-foto', [
                'title' => 'Tabel Galeri Foto',
                'breadcrumbs' => $breadcrumbs,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GaleryFotoRequest $request)
    {
        try {
            $data = $request->validated();

            // Simpan gambar sementara jika ada
            $tempImagePaths = [];
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $tempImagePaths[] = $image->store('images-temp');
                }
            }

            // Buat galery image
            $galery_foto = $request->user()->galery_foto()->create($data);

            // Jika transaksi berhasil, pindahkan gambar dari temp ke lokasi akhir
            if (!empty($tempImagePaths)) {
                $finalImagePaths = [];
                foreach ($tempImagePaths as $tempImagePath) {
                    $finalImagePath = str_replace('images-temp', 'galery-images', $tempImagePath);
                    Storage::move($tempImagePath, $finalImagePath);
                    $finalImagePaths[] = $finalImagePath;
                }
                $galery_foto->update(['image' => json_encode($finalImagePaths)]);
            }

            return response()->json(['message' => 'Data Berhasil Ditambahkan'], 201);
        } catch (\Throwable $e) {
            if (!empty($tempImagePaths)) {
                foreach ($tempImagePaths as $tempImagePath) {
                    Storage::delete($tempImagePath);
                }
            }
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GaleryFoto $galery_foto)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Informasi'],
                ['name' => 'Galeri Foto'],
                ['name' => 'Show'],
            ];
            return view('back.galery-foto.galery-foto-show', compact('galery_foto'), [
                'title' => 'Tabel Galeri Foto',
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
        $galery_foto = GaleryFoto::where('slug', $slug)->firstOrFail();
        return response()->json(['data' => $galery_foto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GaleryFotoRequest $request, string $slug)
    {
        try {
            $data = $request->validated();

            $galery_foto = GaleryFoto::where('slug', $slug)->firstOrFail();

            if ($request->hasFile('image')) {
                $tempImagePaths = [];
                foreach ($request->file('image') as $image) {
                    $tempImagePaths[] = $image->store('images-temp');
                }

                if ($galery_foto->image) {
                    $oldImages = json_decode($galery_foto->image, true);
                    foreach ($oldImages as $oldImage) {
                        Storage::delete($oldImage);
                    }
                }

                $finalImagePaths = [];
                foreach ($tempImagePaths as $tempImagePath) {
                    $finalImagePath = str_replace('images-temp', 'galery-images', $tempImagePath);
                    Storage::move($tempImagePath, $finalImagePath);
                    $finalImagePaths[] = $finalImagePath;
                }
                $data['image'] = json_encode($finalImagePaths);
            }

            $galery_foto->update($data);

            return response()->json(['message' => 'Data Berhasil Diubah'], 201);
        } catch (\Throwable $e) {
            if (!empty($tempImagePaths)) {
                foreach ($tempImagePaths as $tempImagePath) {
                    Storage::delete($tempImagePath);
                }
            }
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GaleryFoto $galery_foto)
    {
        try {
            // Cek jika ada gambar yang terkait dengan data
            if ($galery_foto->image) {
                $images = json_decode($galery_foto->image, true);
                // Hapus gambar dari penyimpanan
                foreach ($images as $image) {
                    Storage::delete($image);
                }
            }

            // Hapus data dari database
            $galery_foto->delete();

            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        } catch (Exception $e) {
            // Tangkap pengecualian dan kirim pesan error
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function bulkDelete(Request $request): JsonResponse
    {
        try {
            $galery_fotoIds = $request->input('ids');
            $galery_fotos = GaleryFoto::whereIn('slug', $galery_fotoIds)->get();

            foreach ($galery_fotos as $galery_foto) {
                if ($galery_foto->image) {
                    $images = json_decode($galery_foto->image, true);
                    foreach ($images as $image) {
                        Storage::delete($image);
                    }
                }
            }

            $deleted = GaleryFoto::whereIn('slug', $galery_fotoIds)->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.', 'icon' => 'success']);
            } else {
                return response()->json(['error' => 'Gagal menghapus data.']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}