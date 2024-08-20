<?php

namespace App\Http\Controllers\Back;

use Exception;
use App\Models\Fasilitas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\DataTables\FasilitasDataTable;
use App\Http\Requests\FasilitasRequest;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FasilitasDataTable $dataTable)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Profil Sekolah'],
                ['name' => 'Fasilitas'],
            ];

            return $dataTable->render('back.fasilitas.fasilitas', [
                'title' => 'Tabel Fasilitas',
                'breadcrumbs' => $breadcrumbs,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FasilitasRequest $request)
    {
        try {
            $data = $request->validated();

            // Simpan gambar sementara jika ada
            $tempImagePath = $request->file('image')?->store('images-temp');
            $data['image'] = basename($tempImagePath);


            // Buat fasilitas
            $fasilitas = $request->user()->fasilitas()->create($data);

            // Jika transaksi berhasil, pindahkan gambar dari temp ke lokasi akhir
            if ($tempImagePath) {
                $finalImagePath = str_replace('images-temp', 'fasilitas-images', $tempImagePath);
                Storage::move($tempImagePath, $finalImagePath);
                $fasilitas->update(['image' => $finalImagePath]);
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
    public function show(Fasilitas $fasilitas)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Informasi'],
                ['name' => 'Fasilitas'],
                ['name' => 'Show'],
            ];
            return view('back.fasilitas.fasilitas-show', compact('fasilitas'), [
                'title' => 'Tabel fasilitas',
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
        $fasilitas = Fasilitas::where('slug', $slug)->firstOrFail();
        return response()->json(['data' => $fasilitas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FasilitasRequest $request, string $slug)
    {
        try {
            $data = $request->validated();

            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $data['image'] = $request->file('image')->store('fasilitas-images');
            }

            // Buat fasilitas
            Fasilitas::where('slug', $slug)->update($data);

            return response()->json(['message' => 'Data Berhasil Diubah'], 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fasilitas $fasilitas)
    {
        try {
            // Cek jika ada gambar yang terkait dengan data
            if ($fasilitas->image) {
                // Hapus gambar dari penyimpanan
                Storage::delete($fasilitas->image);
            }

            // Hapus data dari database
            $fasilitas->delete();

            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        } catch (Exception $e) {
            // Tangkap pengecualian dan kirim pesan error
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    public function bulkDelete(Request $request): JsonResponse
    {
        try {
            $fasilitasIds = $request->input('ids');
            $fasilitass = Fasilitas::whereIn('slug', $fasilitasIds)->get();

            foreach ($fasilitass as $fasilitas) {
                if ($fasilitas->image) {
                    Storage::delete($fasilitas->image);
                }
            }

            $deleted = Fasilitas::whereIn('slug', $fasilitasIds)->delete();

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
