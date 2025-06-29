@extends('layouts.app')

@section('title', 'Tambah Divisi - Pengajian Akbar Poliwangi 2025')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-white mb-3">
            <i class="fas fa-plus-circle me-3"></i>
            Tambah Divisi Baru
        </h1>
        <p class="lead text-white-50">
            Buat divisi baru untuk volunter Pengajian Akbar Poliwangi 2025
        </p>
    </div>

    <!-- Navigation and Logout -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.divisi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Divisi
            </a>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin keluar?')">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </button>
        </form>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Formulir Divisi
                    </h4>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.divisi.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama" class="form-label">
                                <i class="fas fa-users me-1"></i>Nama Divisi
                            </label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama') }}" 
                                   placeholder="Contoh: Divisi Acara, Divisi Dokumentasi" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Masukkan nama divisi yang jelas dan mudah dipahami
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="kuota" class="form-label">
                                <i class="fas fa-user-plus me-1"></i>Kuota Volunter
                            </label>
                            <input type="number" class="form-control @error('kuota') is-invalid @enderror" 
                                   id="kuota" name="kuota" value="{{ old('kuota') }}" 
                                   placeholder="Masukkan jumlah kuota" min="1" required>
                            @error('kuota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Jumlah maksimal volunter yang dapat diterima di divisi ini
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="batas_akhir" class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>Batas Akhir Pendaftaran
                            </label>
                            <input type="datetime-local" class="form-control @error('batas_akhir') is-invalid @enderror" 
                                   id="batas_akhir" name="batas_akhir" value="{{ old('batas_akhir') }}" required>
                            @error('batas_akhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Tanggal dan waktu terakhir pendaftaran divisi ini
                            </small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.divisi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Divisi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Info Card -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-lightbulb me-2"></i>
                        Tips Membuat Divisi
                    </h5>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-check-circle text-success me-1"></i>
                            Berikan nama yang jelas dan spesifik
                        </div>
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-check-circle text-success me-1"></i>
                            Sesuaikan kuota dengan kebutuhan acara
                        </div>
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-check-circle text-success me-1"></i>
                            Tetapkan batas waktu yang realistis
                        </div>
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-check-circle text-success me-1"></i>
                            Pertimbangkan kemampuan volunter
                        </div>
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
