<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\PengaturanRequest;
use App\Models\Pengaturan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PengaturanController extends Controller
{
    public function index()
    {
        try {
            $breadcrumbs = [
                ['name' => 'Pengaturan'],
            ];

            return view('back.settings.index', [
                'title' => 'Pengaturan',
                'breadcrumbs' => $breadcrumbs,
                'pengaturan' => Pengaturan::firstOrFail()
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data pengaturan.');
        }
    }

    public function update(PengaturanRequest $request, Pengaturan $pengaturan)
    {
        try {
            $validated = $request->validated();

            $pengaturan->nama_web = $validated['nama_web'];
            $pengaturan->email = $validated['email'];
            $pengaturan->telp = $validated['telp'];
            $pengaturan->alamat = $validated['alamat'];
            $pengaturan->deskripsi = $validated['deskripsi'];
            $pengaturan->jam_kerja = $validated['jam_kerja'];
            $pengaturan->ig = $validated['ig'];
            $pengaturan->youtube = $validated['youtube'];
            $pengaturan->facebook = $validated['facebook'];
            $pengaturan->twitter = $validated['twitter'];
            $pengaturan->map = $validated['map'];
            $pengaturan->akreditas = $validated['akreditas'];

            // Store images and delete old ones if necessary
            $this->storeImage($request, $pengaturan, 'logo', 'logo-images');
            $this->storeImage($request, $pengaturan, 'banner', 'banner-images');
            $this->storeImage($request, $pengaturan, 'background', 'background-images');
            $this->storeImage($request, $pengaturan, 'favicon', 'favicon-images');

            $pengaturan->save();

            return redirect()->route('pengaturan.index')->with('success', 'Pengaturan berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui pengaturan.');
        }
    }

    private function storeImage(Request $request, Pengaturan $pengaturan, string $field, string $path)
    {
        if ($request->hasFile($field)) {
            // Delete the old image if it exists
            if ($pengaturan->$field) {
                Storage::disk('public')->delete($pengaturan->$field);
            }

            // Store the new image and save the path
            $imagePath = $request->file($field)->store($path, 'public');
            $pengaturan->$field = $imagePath;
        }
    }
}