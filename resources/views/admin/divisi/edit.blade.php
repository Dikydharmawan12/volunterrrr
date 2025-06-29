@extends('layouts.app')

@section('title', 'Edit Divisi - Pengajian Akbar Poliwangi 2025')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-white mb-3">
            <i class="fas fa-edit me-3"></i>
            Edit Divisi
        </h1>
        <p class="lead text-white-50">
            Perbarui informasi divisi volunter
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Edit Divisi: {{ $divisi->nama }}
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

                    <form action="{{ route('admin.divisi.update', $divisi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="nama" class="form-label">
                                <i class="fas fa-users me-1"></i>Nama Divisi
                            </label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama', $divisi->nama) }}" 
                                   placeholder="Masukkan nama divisi" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Nama divisi yang akan ditampilkan kepada volunter
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="kuota" class="form-label">
                                <i class="fas fa-user-plus me-1"></i>Kuota Volunter
                            </label>
                            <input type="number" class="form-control @error('kuota') is-invalid @enderror" 
                                   id="kuota" name="kuota" value="{{ old('kuota', $divisi->kuota) }}" 
                                   placeholder="Masukkan jumlah kuota" min="1" required>
                            @error('kuota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Jumlah maksimal volunter yang dapat diterima
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="batas_akhir" class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>Batas Akhir Pendaftaran
                            </label>
                            <input type="datetime-local" class="form-control @error('batas_akhir') is-invalid @enderror" 
                                   id="batas_akhir" name="batas_akhir" 
                                   value="{{ old('batas_akhir', \Carbon\Carbon::parse($divisi->batas_akhir)->format('Y-m-d\TH:i')) }}" required>
                            @error('batas_akhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Tanggal dan waktu terakhir pendaftaran
                            </small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.divisi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Divisi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Current Info Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Saat Ini
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <i class="fas fa-users text-primary" style="font-size: 2rem;"></i>
                            <h6 class="mt-2">Nama Divisi</h6>
                            <p class="text-primary fw-bold">{{ $divisi->nama }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="fas fa-user-plus text-success" style="font-size: 2rem;"></i>
                            <h6 class="mt-2">Kuota</h6>
                            <p class="text-success fw-bold">{{ $divisi->kuota }} orang</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="fas fa-calendar text-warning" style="font-size: 2rem;"></i>
                            <h6 class="mt-2">Batas Akhir</h6>
                            <p class="text-warning fw-bold">{{ \Carbon\Carbon::parse($divisi->batas_akhir)->format('d/m/Y H:i') }}</p>
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
