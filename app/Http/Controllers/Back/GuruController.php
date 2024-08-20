<?php

namespace App\Http\Controllers\Back;

use Exception;
use App\Models\Guru;
use Illuminate\Http\Request;
use App\DataTables\GuruDataTable;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\GuruRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\ImageService;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{

    public function __construct(private ImageService $imageService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(GuruDataTable $dataTable)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Profil Sekolah'],
                ['name' => 'Guru'],
            ];
            return $dataTable->render('back.guru.guru', [
                'title' => 'Tabel Guru',
                'breadcrumbs' => $breadcrumbs,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuruRequest $request)
    {
        try {
            $data = $request->validated();

            $data['image'] = $this->imageService->uploadImage($data, 'guru-images');

            // Buat guru
            $guru = $request->user()->guru()->create($data);

            // Load the 'user' relation
            $guru->load('user');

            return response()->json(['message' => 'Data Berhasil Ditambahkan'], 201);
        } catch (\Throwable $e) {

            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Informasi'],
                ['name' => 'Guru'],
                ['name' => 'Show'],
            ];

            // // Load the 'user' relation
            $guru->load('user');

            return view('back.guru.guru-show', compact('guru'), [
                'title' => 'Tabel Guru',
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
        $guru = Guru::where('slug', $slug)->firstOrFail();
        return response()->json(['data' => $guru]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuruRequest $request, string $slug)
    {
        try {
            $data = $request->validated();
            $guru = Guru::where('slug', $slug)->firstOrFail();

            if ($request->file('image')) {
                $data['image'] = $this->imageService->uploadImage($data, 'guru-images', $guru->image);
            }

            // Update guru
            $guru->update($data);

            return response()->json(['message' => 'Data Berhasil Diubah'], 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        try {
            // Cek jika ada gambar yang terkait dengan data
            if ($guru->image) {
                // Hapus gambar dari penyimpanan
                Storage::delete(['guru-images/' . $guru->image, 'guru-images/thumbnail/' . $guru->image]);
            }

            // Hapus data dari database
            $guru->delete();

            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        } catch (Exception $e) {
            // Tangkap pengecualian dan kirim pesan error
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    public function bulkDelete(Request $request): JsonResponse
    {
        try {
            $guruIds = $request->input('ids');
            $gurus = Guru::whereIn('slug', $guruIds)->get();

            foreach ($gurus as $guru) {
                if ($guru->image) {
                    Storage::delete(['guru-images/' . $guru->image, 'guru-images/thumbnail/' . $guru->image]);
                }
            }

            $deleted = Guru::whereIn('slug', $guruIds)->delete();

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
