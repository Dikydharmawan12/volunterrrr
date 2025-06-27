<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminDivisiController extends Controller
{
    public function index()
    {
        $divisis = Divisi::all();
        return view('admin.divisi.index', compact('divisis'));
    }

    public function create()
    {
        return view('admin.divisi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
            'batas_akhir' => 'required|date',
        ]);

        Divisi::create($request->all());

        return redirect()->route('admin.divisi.index')
            ->with('success', 'Divisi berhasil ditambahkan!');
    }

    public function edit(Divisi $divisi)
    {
        return view('admin.divisi.edit', compact('divisi'));
    }

    public function update(Request $request, Divisi $divisi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
            'batas_akhir' => 'required|date',
        ]);

        $divisi->update($request->all());

        return redirect()->route('admin.divisi.index')
            ->with('success', 'Divisi berhasil diperbarui!');
    }

    public function destroy(Divisi $divisi)
    {
        $divisi->delete();

        return redirect()->route('admin.divisi.index')
            ->with('success', 'Divisi berhasil dihapus!');
    }

    public function peserta()
    {
        $pendaftarans = Pendaftaran::with('divisi')->latest()->get();
        return view('admin.divisi.peserta', compact('pendaftarans'));
    }

    public function exportPeserta()
    {
        // Implementasi ekspor excel akan dibuat setelah view dan route siap
    }
}

