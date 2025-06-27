@extends('layouts.app')

@section('title', 'Pengaturan Acara - Pengajian Akbar Poliwangi 2025')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-white mb-3">
            <i class="fas fa-cog me-3"></i>
            Pengaturan Acara
        </h1>
        <p class="lead text-white-50">
            Kelola informasi dan pengaturan acara Pengajian Akbar
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Formulir Pengaturan Acara
                    </h4>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

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

                    <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="nama_acara" class="form-label">
                                <i class="fas fa-calendar me-1"></i>Nama Acara
                            </label>
                            <input type="text" class="form-control @error('nama_acara') is-invalid @enderror" 
                                   id="nama_acara" name="nama_acara" 
                                   value="{{ old('nama_acara', $pengaturan->nama_acara ?? 'Pengajian Akbar Poliwangi 2025') }}" 
                                   placeholder="Masukkan nama acara" required>
                            @error('nama_acara')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label">
                                <i class="fas fa-align-left me-1"></i>Deskripsi Acara
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="3" 
                                      placeholder="Deskripsi singkat tentang acara">{{ old('deskripsi', $pengaturan->deskripsi ?? '') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="tanggal_acara" class="form-label">
                                    <i class="fas fa-calendar-day me-1"></i>Tanggal Acara
                                </label>
                                <input type="date" class="form-control @error('tanggal_acara') is-invalid @enderror" 
                                       id="tanggal_acara" name="tanggal_acara" 
                                       value="{{ old('tanggal_acara', $pengaturan->tanggal_acara ?? '') }}" required>
                                @error('tanggal_acara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="waktu_acara" class="form-label">
                                    <i class="fas fa-clock me-1"></i>Waktu Acara
                                </label>
                                <input type="time" class="form-control @error('waktu_acara') is-invalid @enderror" 
                                       id="waktu_acara" name="waktu_acara" 
                                       value="{{ old('waktu_acara', $pengaturan->waktu_acara ?? '') }}" required>
                                @error('waktu_acara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="lokasi" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i>Lokasi Acara
                            </label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                   id="lokasi" name="lokasi" 
                                   value="{{ old('lokasi', $pengaturan->lokasi ?? 'Politeknik Negeri Banyuwangi') }}" 
                                   placeholder="Masukkan lokasi acara" required>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="target_volunter" class="form-label">
                                <i class="fas fa-users me-1"></i>Target Volunter
                            </label>
                            <input type="number" class="form-control @error('target_volunter') is-invalid @enderror" 
                                   id="target_volunter" name="target_volunter" 
                                   value="{{ old('target_volunter', $pengaturan->target_volunter ?? 100) }}" 
                                   placeholder="Masukkan target volunter" min="1" required>
                            @error('target_volunter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Jumlah target volunter yang diharapkan
                            </small>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status_pendaftaran" 
                                       name="status_pendaftaran" value="1" 
                                       {{ old('status_pendaftaran', $pengaturan->status_pendaftaran ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_pendaftaran">
                                    Buka Pendaftaran
                                </label>
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Aktifkan untuk membuka pendaftaran volunter
                            </small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.divisi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Current Info Card -->
            @if($pengaturan)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Acara Saat Ini
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Tanggal & Waktu</h6>
                                    <p class="mb-0 text-primary fw-bold">{{ $pengaturan->tanggal_waktu }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt text-success me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Lokasi</h6>
                                    <p class="mb-0 text-success fw-bold">{{ $pengaturan->lokasi }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users text-warning me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Target Volunter</h6>
                                    <p class="mb-0 text-warning fw-bold">{{ $pengaturan->target_volunter }} orang</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-1">Status Pendaftaran</h6>
                                    <p class="mb-0 text-info fw-bold">
                                        {{ $pengaturan->status_pendaftaran ? 'Terbuka' : 'Tertutup' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 