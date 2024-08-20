<?php

namespace App\Http\Controllers\Guest;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class KontakController extends Controller
{
    public function index()
    {
        // Mengambil data kontak dari Pengaturan
        $pengaturan = Pengaturan::first();

        // Menyiapkan data kontak dengan nilai default jika tidak ada
        $kontak = [
            'alamat' => $pengaturan->alamat ?? '',
            'telp' => $pengaturan->telp ?? '',
            'email' => $pengaturan->email ?? '',
            'map' => $pengaturan->map ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.959284247299!2d128.62965910000003!3d-3.5968061!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d6c9dd5f0989afb%3A0x9f4e0fa31a4da576!2sSD%20NEGERI%20260%20MALUKU%20TENGAH%20%2F%20SD%20NEGERI%203%20HARIA!5e0!3m2!1sid!2sid!4v1721565315565!5m2!1sid!2sid',
            'jam_kerja' => $pengaturan->jam_kerja ?? '',
        ];

        return view('guest.kontak', compact('kontak'));
    }

    public function sendEmail(Request $request)
    {
        // Validasi form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $toEmail = 'ulissleksmart@gmail.com'; // Email tujuan
        $fromEmail = config('mail.from.address'); // Email pengirim yang terverifikasi
        $fromName = $validatedData['name']; // Nama pengirim dari input pengguna

        Mail::send([], [], function ($message) use ($validatedData, $toEmail, $fromEmail, $fromName) {
            $message->to($toEmail)
                ->subject($validatedData['subject'])
                ->from($fromEmail, config('app.name')) // Email default terverifikasi
                ->replyTo($validatedData['email'], $fromName) // Reply-to menggunakan email pengguna
                ->html($validatedData['message']);
        });

        return back()->with('success', 'Pesan Telah Terkirim!');
    }
}
