<?php

namespace App\Http\Controllers\Back;

use Exception;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\DataTables\PrestasiDataTable;
use App\Http\Requests\PrestasiRequest;
use Illuminate\Support\Facades\Storage;


class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PrestasiDataTable $dataTable)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Informasi'],
                ['name' => 'Prestasi'],
            ];
            return $dataTable->render('back.prestasi.prestasi', [
                'title' => 'Tabel Prestasi',
                'breadcrumbs' => $breadcrumbs,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrestasiRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            // Simpan gambar sementara jika ada
            $tempImagePath = $request->file('image')?->store('images-temp');
            $data['image'] = basename($tempImagePath);


            // Buat prestasi
            $prestasi = $request->user()->prestasi()->create($data);

            // Jika transaksi berhasil, pindahkan gambar dari temp ke lokasi akhir
            if ($tempImagePath) {
                $finalImagePath = str_replace('images-temp', 'prestasi-images', $tempImagePath);
                Storage::move($tempImagePath, $finalImagePath);
                $prestasi->update(['image' => $finalImagePath]);
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
    public function show(Prestasi $prestasi)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Informasi'],
                ['name' => 'Prestasi'],
                ['name' => 'Show'],
            ];
            return view('back.prestasi.prestasi-show', compact('prestasi'), [
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
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();
        return response()->json(['data' => $prestasi]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrestasiRequest $request, string $slug)
    {
        try {
            $data = $request->validated();

            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $data['image'] = $request->file('image')->store('prestasi-images');
            }

            // Buat prestasi
            Prestasi::where('slug', $slug)->update($data);

            return response()->json(['message' => 'Data Berhasil Diubah'], 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        try {
            // Cek jika ada gambar yang terkait dengan data
            if ($prestasi->image) {
                // Hapus gambar dari penyimpanan
                Storage::delete($prestasi->image);
            }

            // Hapus data dari database
            $prestasi->delete();

            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        } catch (Exception $e) {
            // Tangkap pengecualian dan kirim pesan error
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    public function bulkDelete(Request $request): JsonResponse
    {
        try {
            $prestasiIds = $request->input('ids');
            $prestasis = Prestasi::whereIn('slug', $prestasiIds)->get();

            foreach ($prestasis as $prestasi) {
                if ($prestasi->image) {
                    Storage::delete($prestasi->image);
                }
            }

            $deleted = Prestasi::whereIn('slug', $prestasiIds)->delete();

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
