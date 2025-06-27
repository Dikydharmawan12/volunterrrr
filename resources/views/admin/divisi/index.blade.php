@extends('layouts.app')

@section('title', 'Kelola Divisi - Pengajian Akbar Poliwangi 2025')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-white mb-3">
            <i class="fas fa-cogs me-3"></i>
            Kelola Divisi Volunter
        </h1>
        <p class="lead text-white-50">
            Manajemen divisi untuk acara Pengajian Akbar Poliwangi 2025
        </p>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white">
            <i class="fas fa-list me-2"></i>
            Daftar Divisi
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.pengaturan.index') }}" class="btn btn-info">
                <i class="fas fa-cog me-2"></i>Pengaturan Acara
            </a>
            <a href="{{ route('admin.divisi.peserta') }}" class="btn btn-success">
                <i class="fas fa-users me-2"></i>Daftar Peserta
            </a>
            <a href="{{ route('admin.divisi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Divisi
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($divisis->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="30%">Nama Divisi</th>
                                <th width="15%">Kuota</th>
                                <th width="25%">Batas Akhir</th>
                                <th width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($divisis as $index => $divisi)
                                <tr>
                                    <td class="text-center">
                                        <span class="badge bg-primary">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <strong style="color:#111 !important; opacity:1 !important; font-weight:700;">{{ $divisi->nama }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $divisi->kuota }} orang</span>
                                    </td>
                                    <td>
                                        <span style="color:#111 !important; opacity:1 !important; font-weight:600;">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ \Carbon\Carbon::parse($divisi->batas_akhir)->format('d/m/Y H:i') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.divisi.edit', $divisi->id) }}" 
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <form action="{{ route('admin.divisi.destroy', $divisi->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Yakin ingin menghapus divisi ini?')">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-folder-open text-muted" style="font-size: 4rem;"></i>
                    <h4 class="mt-3 text-muted">Belum ada divisi yang ditambahkan</h4>
                    <p class="text-muted">Mulai dengan menambahkan divisi pertama untuk volunter</p>
                    <a href="{{ route('admin.divisi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Divisi Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Stats Card -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-users text-primary" style="font-size: 2rem;"></i>
                    <h5 class="mt-2">Total Divisi</h5>
                    <h3 class="text-primary">{{ $divisis->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-user-plus text-success" style="font-size: 2rem;"></i>
                    <h5 class="mt-2">Total Kuota</h5>
                    <h3 class="text-success">{{ $divisis->sum('kuota') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-clock text-warning" style="font-size: 2rem;"></i>
                    <h5 class="mt-2">Status</h5>
                    <h3 class="text-warning">Aktif</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

