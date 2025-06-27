<?php

namespace App\Http\Controllers;

use App\Models\PengaturanAcara;
use Illuminate\Http\Request;

class AdminPengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanAcara::first();
        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_acara' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_acara' => 'required|date|after_or_equal:today',
            'waktu_acara' => 'required',
            'lokasi' => 'required|string|max:255',
            'target_volunter' => 'required|integer|min:1',
            'status_pendaftaran' => 'boolean'
        ]);

        $pengaturan = PengaturanAcara::first();
        
        if (!$pengaturan) {
            $pengaturan = new PengaturanAcara();
        }

        $pengaturan->fill($request->all());
        $pengaturan->save();

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan acara berhasil diperbarui!');
    }
} 