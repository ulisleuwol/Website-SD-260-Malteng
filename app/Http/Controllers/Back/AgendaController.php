<?php

namespace App\Http\Controllers\Back;

use Exception;
use App\Models\Agenda;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\DataTables\AgendaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgendaRequest;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(AgendaDataTable $dataTable)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Informasi'],
                ['name' => 'Agenda'],
            ];
            return $dataTable->render('back.agenda.agenda', [
                'title' => 'Tabel Agenda',
                'breadcrumbs' => $breadcrumbs,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgendaRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            if ($request->file('image')) {
                $data['image'] = $request->file('image')->store('agenda-images');
            }

            $data['excerpt'] = Str::limit(strip_tags($request->description), 150);

            $request->user()->agenda()->create($data);

            return response()->json(['message' => 'Data Berhasil Ditambahkan'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Agenda $agenda)
    {
        try {
            $breadcrumbs = [
                ['name' => 'Informasi'],
                ['name' => 'Agenda'],
                ['name' => 'Show'],
            ];
            return view('back.agenda.agenda-show', compact('agenda'), [
                'title' => 'Show Agenda',
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
        $agenda = Agenda::where('slug', $slug)->firstOrFail();
        return response()->json(['data' => $agenda]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgendaRequest $request, string $slug): JsonResponse
    {
        try {
            $data = $request->validated();

            $data['excerpt'] = Str::limit($request->description, 150);

            Agenda::where('slug', $slug)->update($data);;

            return response()->json(['message' => 'Data Berhasil Diubah'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        try {
            $agenda->delete();
            return response()->json(['message' => 'Data Berhasil Di Hapus'], 201);
        } catch (Exception $e) {
            // Tangkap pengecualian dan kirim pesan error
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }


    public function bulkDelete(Request $request): JsonResponse
    {
        try {
            $agendaIds = $request->input('ids');

            $deleted = Agenda::whereIn('slug', $agendaIds)->delete();

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
