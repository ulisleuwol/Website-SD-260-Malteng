<?php

namespace App\Http\Controllers\Back;

use Exception;
use App\Models\Kegiatan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\DataTables\KegiatanDataTable;
use App\Http\Requests\KegiatanRequest;
use Illuminate\Support\Facades\Storage;

// class KegiatanController extends Controller
// {
//     public function index()
//     {
//         return view('back.kegiatan.kegiatan', [
//             'kegiatan' => Kegiatan::select('id', 'user_id', 'title', 'description', 'excerpt', 'date_time', 'location', 'image', 'slug')->where('user_id', auth()->user()->id)->latest()->get()
//         ]);
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create(Kegiatan $kegiatan)
//     {
//         return view('back.kegiatan.kegiatan-form', [
//             'kegiatan' => $kegiatan,
//             'name' => 'Tambah Kegiatan',
//             'title' => 'Tambah Kegiatan',
//             'method' => 'post',
//             'route' => route('kegiatan.store')
//         ]);
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(KegiatanRequest $request)
//     {
//         $data = $request->validated();

//         if ($request->file('image')) {
//             $data['image'] = $request->file('image')->store('kegiatan-images');
//         }

//         $data['user_id'] = auth()->user()->id;
//         $data['excerpt'] = Str::limit(strip_tags($request->description), 150);

//         Kegiatan::create($data);

//         return to_route('kegiatan.index')->with('success', 'Kegiatan Berhasil Di Tambahkan!');
//     }

//     public function edit(Kegiatan $kegiatan)
//     {
//         return view('back.kegiatan.kegiatan-form', [
//             'kegiatan' => $kegiatan,
//             'name' => 'Edit Kegiatan',
//             'title' => 'Edit Kegiatan : ' . $kegiatan->title,
//             'method' => 'put',
//             'route' => route('kegiatan.update', $kegiatan->slug)
//         ]);
//     }

//     public function show(Kegiatan $kegiatan)
//     {
//         return view('back.kegiatan.kegiatan-show', [
//             'kegiatan' => $kegiatan
//         ]);
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(KegiatanRequest $request, string $slug)
//     {
//         $data = $request->validated();

//         if ($request->file('image')) {
//             if ($request->oldImage) {
//                 Storage::delete($request->oldImage);
//             }
//             $data['image'] = $request->file('image')->store('kegiatan-images');
//         }

//         $data['user_id'] = auth()->user()->id;
//         $data['excerpt'] = Str::limit($request->description, 150);

//         Kegiatan::where('slug', $slug)->update($data);

//         return to_route('kegiatan.index')->with('success', 'Kegiatan Berhasil Di Update!');
//     }


//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         $kegiatan = Kegiatan::find($id);

//         if ($kegiatan->image) {
//             Storage::delete($kegiatan->image);
//         }

//         Kegiatan::destroy($kegiatan->id);
//         return to_route('kegiatan.index')->with('success', 'Kegiatan Berhasil Di Hapus!');
//     }
// }

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(KegiatanDataTable $dataTable)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Informasi'],
                ['name' => 'Kegiatan'],
            ];
            return $dataTable->render('back.kegiatan.index', [
                'title' => 'Tabel Kegiatan',
                'breadcrumbs' => $breadcrumbs,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(KegiatanRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            // Simpan gambar sementara jika ada
            $tempImagePath = $request->file('image')?->store('images-temp');
            $data['image'] = basename($tempImagePath);

            // Buat excerpt dari deskripsi
            $data['excerpt'] = Str::limit(strip_tags($request->description), 150);

            // Buat kegiatan
            $kegiatan = $request->user()->kegiatan()->create($data);

            // Jika transaksi berhasil, pindahkan gambar dari temp ke lokasi akhir
            if ($tempImagePath) {
                $finalImagePath = str_replace('images-temp', 'kegiatan-images', $tempImagePath);
                Storage::move($tempImagePath, $finalImagePath);
                $kegiatan->update(['image' => $finalImagePath]);
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
    public function show(Kegiatan $kegiatan)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Informasi'],
                ['name' => 'Kegiatan'],
                ['name' => 'Show'],
            ];
            return view('back.kegiatan.kegiatan-show', compact('kegiatan'), [
                'title' => 'Tabel Kegiatan',
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
        $kegiatan = Kegiatan::where('slug', $slug)->firstOrFail();
        return response()->json(['data' => $kegiatan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KegiatanRequest $request, string $slug): JsonResponse
    {
        try {
            $data = $request->validated();

            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $data['image'] = $request->file('image')->store('kegiatan-images');
            }

            // Buat excerpt dari deskripsi
            $data['excerpt'] = Str::limit(strip_tags($request->description), 150);

            // Buat kegiatan
            Kegiatan::where('slug', $slug)->update($data);

            return response()->json(['message' => 'Data Berhasil Diubah'], 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        try {
            // Cek jika ada gambar yang terkait dengan data
            if ($kegiatan->image) {
                // Hapus gambar dari penyimpanan
                Storage::delete($kegiatan->image);
            }

            // Hapus data dari database
            $kegiatan->delete();

            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        } catch (Exception $e) {
            // Tangkap pengecualian dan kirim pesan error
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    public function bulkDelete(Request $request): JsonResponse
    {
        try {
            $kegiatanIds = $request->input('ids');
            $kegiatans = Kegiatan::whereIn('slug', $kegiatanIds)->get();

            foreach ($kegiatans as $kegiatan) {
                if ($kegiatan->image) {
                    Storage::delete($kegiatan->image);
                }
            }

            $deleted = Kegiatan::whereIn('slug', $kegiatanIds)->delete();

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
