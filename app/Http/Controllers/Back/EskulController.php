<?php

namespace App\Http\Controllers\Back;

use Exception;
use App\Models\Eskul;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\DataTables\EskulDataTable;
use App\Http\Requests\EskulRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EskulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EskulDataTable $dataTable)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Ekstrakurikuler'],
            ];
            return $dataTable->render('back.eskul.eskul', [
                'title' => 'Tabel Ekstrakurikuler',
                'breadcrumbs' => $breadcrumbs,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(EskulRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            // Simpan gambar sementara jika ada
            $tempImagePath = $request->file('image')?->store('images-temp');
            $data['image'] = basename($tempImagePath);

            // Buat Eskul
            $Eskul = $request->user()->eskul()->create($data);

            // Jika transaksi berhasil, pindahkan gambar dari temp ke lokasi akhir
            if ($tempImagePath) {
                $finalImagePath = str_replace('images-temp', 'eskul-images', $tempImagePath);
                Storage::move($tempImagePath, $finalImagePath);
                $Eskul->update(['image' => $finalImagePath]);
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
    public function show(Eskul $eskul)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Eskul'],
                ['name' => 'Show'],
            ];
            return view('back.eskul.eskul-show', compact('eskul'), [
                'title' => 'Tabel Eskul',
                'breadcrumbs' => $breadcrumbs,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $slug)
    {
        $eskul = Eskul::where('slug', $slug)->firstOrFail();
        return response()->json(['data' => $eskul]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EskulRequest $request, string $slug): JsonResponse
    {
        try {
            $data = $request->validated();

            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $data['image'] = $request->file('image')->store('Eskul-images');
            }

            // Buat Eskul
            Eskul::where('slug', $slug)->update($data);

            return response()->json(['message' => 'Data Berhasil Diubah'], 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eskul $eskul)
    {
        try {
            // Cek jika ada gambar yang terkait dengan data
            if ($eskul->image) {
                // Hapus gambar dari penyimpanan
                Storage::delete($eskul->image);
            }

            // Hapus data dari database
            $eskul->delete();

            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        } catch (Exception $e) {
            // Tangkap pengecualian dan kirim pesan error
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    public function bulkDelete(Request $request): JsonResponse
    {
        try {
            $eskulIds = $request->input('ids');
            $eskuls = Eskul::whereIn('slug', $eskulIds)->get();

            foreach ($eskuls as $eskul) {
                if ($eskul->image) {
                    Storage::delete($eskul->image);
                }
            }

            $deleted = Eskul::whereIn('slug', $eskulIds)->delete();

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
