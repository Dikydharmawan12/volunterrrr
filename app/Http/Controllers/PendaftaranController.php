<?php

// app/Http/Controllers/PendaftaranController.php
namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Pendaftaran;
use App\Models\PengaturanAcara;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanAcara::first();
        $divisis = Divisi::all();
        $pendaftarans = Pendaftaran::with('divisi')->latest()->get();
        return view('pendaftaran.index', compact('divisis', 'pengaturan', 'pendaftarans'));
    }

    public function store(Request $request)
    {
        // Cek status pendaftaran
        $pengaturan = PengaturanAcara::first();
        if ($pengaturan && !$pengaturan->status_pendaftaran) {
            return back()->withErrors(['error' => 'Pendaftaran sedang ditutup. Silakan cek kembali nanti.']);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'prodi' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'divisi_id' => 'required|exists:divisis,id',
        ]);

        // Cek apakah divisi masih memiliki kuota
        $divisi = Divisi::findOrFail($request->divisi_id);
        $jumlahPendaftar = Pendaftaran::where('divisi_id', $request->divisi_id)->count();
        
        // Cek batas akhir pendaftaran divisi
        if (now()->gt($divisi->batas_akhir)) {
            return back()->withErrors(['divisi_id' => 'Pendaftaran untuk divisi ini sudah ditutup (batas akhir telah lewat).']);
        }

        if ($jumlahPendaftar >= $divisi->kuota) {
            return back()->withErrors(['divisi_id' => 'Kuota divisi ini sudah penuh.']);
        }

        // Cek apakah NIM sudah terdaftar
        $existingPendaftar = Pendaftaran::where('nim', $request->nim)->first();
        if ($existingPendaftar) {
            return back()->withErrors(['nim' => 'NIM ini sudah terdaftar sebelumnya.']);
        }

        Pendaftaran::create($request->all());

        return redirect()->route('pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil! Terima kasih telah mendaftar.');
    }
}
