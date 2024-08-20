<?php

namespace App\Http\Controllers\Back;

use Exception;
use App\Models\GaleryVideo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\DataTables\GaleryVideoDataTable;
use App\Http\Requests\GaleryVideoRequest;

class GaleryVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GaleryVideoDataTable $dataTable)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Galeri'],
                ['name' => 'Galeri Video'],
            ];

            return $dataTable->render('back.galery-video.galery-video', [
                'title' => 'Tabel Galeri Video',
                'breadcrumbs' => $breadcrumbs,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GaleryVideoRequest $request)
    {
        try {
            $data = $request->validated();

            $request->user()->galery_video()->create($data);

            return response()->json(['message' => 'Data Berhasil Ditambahkan'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GaleryVideo $galery_video)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Informasi'],
                ['name' => 'Galery Video'],
                ['name' => 'Show'],
            ];
            return view('back.galery-video.galery-video-show', compact('galery_video'), [
                'title' => 'Tabel Galery Video',
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
        $galery_video = GaleryVideo::where('slug', $slug)->firstOrFail();
        return response()->json(['data' => $galery_video]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GaleryVideoRequest $request, string $slug)
    {
        try {
            $data = $request->validated();

            GaleryVideo::where('slug', $slug)->update($data);

            return response()->json(['message' => 'Data Berhasil Diubah'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GaleryVideo $galery_video)
    {
        try {
            $galery_video->delete();
            return response()->json(['message' => 'Data Berhasil Di Hapus'], 201);
        } catch (Exception $e) {
            // Tangkap pengecualian dan kirim pesan error
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function bulkDelete(Request $request): JsonResponse
    {
        try {
            $galery_videoIds = $request->input('ids');

            $deleted = GaleryVideo::whereIn('slug', $galery_videoIds)->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.', 'icon' => 'success'], 201);
            } else {
                return response()->json(['error' => 'Gagal menghapus data.']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
