@extends('layouts.app')

@section('title', 'Daftar Peserta Volunter')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0"><i class="fas fa-users me-2"></i>Daftar Peserta Volunter</h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.divisi.exportPeserta') }}" class="btn btn-success">
                        <i class="fas fa-file-excel me-1"></i> Export Excel
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin keluar?')">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Prodi</th>
                                    <th>No HP</th>
                                    <th>Divisi</th>
                                    <th>Waktu Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendaftarans as $pendaftaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pendaftaran->nama }}</td>
                                        <td>{{ $pendaftaran->nim }}</td>
                                        <td>{{ $pendaftaran->prodi }}</td>
                                        <td>{{ $pendaftaran->no_hp }}</td>
                                        <td>{{ $pendaftaran->divisi->nama ?? '-' }}</td>
                                        <td>{{ $pendaftaran->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada peserta yang mendaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tambahkan tombol kembali di bawah halaman -->
<div class="text-center mt-4">
    <a href="/admin/divisi" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
    </a>
</div>
@endsection 