<?php

namespace App\Http\Controllers\Back;

use Exception;
use App\Models\Pengumuman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\DataTables\PengumumanDataTable;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PengumumanRequest;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PengumumanDataTable $dataTable)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Informasi'],
                ['name' => 'Pengumuman'],
            ];
            return $dataTable->render('back.pengumuman.pengumuman', [
                'title' => 'Tabel Pengumuman',
                'breadcrumbs' => $breadcrumbs,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PengumumanRequest $request)
    {
        try {
            $data = $request->validated();

            // Simpan file jika ada
            if ($request->hasFile('file')) {
                $data['file'] = $request->file('file')->store('file-pengumuman');
            }

            // Buat excerpt dari body
            $data['excerpt'] = Str::limit(strip_tags($request->body), 150);

            $request->user()->pengumuman()->create($data);

            return response()->json(['message' => 'Data Berhasil Ditambahkan'], 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Informasi'],
                ['name' => 'Pengumuman'],
                ['name' => 'Show'],
            ];
            return view('back.pengumuman.pengumuman-show', compact('pengumuman'), [
                'title' => 'Show Pengumuman',
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
        $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();
        return response()->json(['data' => $pengumuman]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PengumumanRequest $request, string $slug)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('file')) {
                if ($request->oldFile) {
                    Storage::delete($request->oldFile);
                }
                $data['file'] = $request->file('file')->store('file-pengumuman');
            }

            // Buat excerpt dari body
            $data['excerpt'] = Str::limit(strip_tags($request->body), 150);

            Pengumuman::where('slug', $slug)->update($data);

            return response()->json(['message' => 'Data Berhasil Diubah'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        try {
            // Cek jika ada file yang terkait dengan data
            if ($pengumuman->file) {
                // Hapus file dari penyimpanan
                Storage::delete($pengumuman->file);
            }

            $pengumuman->delete();
            return response()->json(['message' => 'Data Berhasil Di Hapus'], 201);
        } catch (Exception $e) {
            // Tangkap pengecualian dan kirim pesan error
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function bulkDelete(Request $request): JsonResponse
    {
        try {
            $pengumumanIds = $request->input('ids');

            // Ambil data pengumuman yang akan dihapus
            $pengumumans = Pengumuman::whereIn('slug', $pengumumanIds)->get();

            // Hapus file terkait terlebih dahulu
            foreach ($pengumumans as $pengumuman) {
                if ($pengumuman->file) {
                    Storage::delete($pengumuman->file);
                }
            }

            // Setelah file dihapus, hapus data pengumuman
            $deleted = Pengumuman::whereIn('slug', $pengumumanIds)->delete();

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
