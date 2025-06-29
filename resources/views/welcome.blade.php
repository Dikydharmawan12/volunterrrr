@extends('layouts.app')

@section('title', 'Beranda - Pendaftaran Volunter Pengajian Akbar Poliwangi 2025')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="fas fa-mosque me-3"></i>
                    {{ $pengaturan->nama_acara ?? 'Pengajian Akbar Poliwangi 2025' }}
                </h1>
                <p class="lead mb-4">
                    {{ $pengaturan->deskripsi ?? 'Bergabunglah sebagai volunter dalam acara pengajian akbar yang akan diselenggarakan di Politeknik Negeri Banyuwangi. Mari kita bersama-sama menyukseskan acara ini!' }}
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="/pendaftaran" class="btn btn-light btn-lg px-4">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <h4 class="card-title mb-3">Pendaftaran Volunter</h4>
                            <p class="card-text">
                                Daftar sebagai volunter untuk membantu menyukseskan acara pengajian akbar. 
                                Pilih divisi yang sesuai dengan kemampuan dan minat Anda.
                            </p>
                            <a href="/pendaftaran" class="btn btn-primary">
                                <i class="fas fa-arrow-right me-2"></i>Mulai Daftar
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h4 class="card-title mb-3">Divisi Tersedia</h4>
                            <p class="card-text">
                                Berbagai divisi tersedia untuk volunter seperti acara, dokumentasi, 
                                konsumsi, dan lainnya. Setiap divisi memiliki peran penting.
                            </p>
                            <a href="/pendaftaran" class="btn btn-secondary">
                                <i class="fas fa-eye me-2"></i>Lihat Divisi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Info Section -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Acara
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Tanggal Acara</h6>
                                    <p class="mb-0 text-muted">
                                        {{ $pengaturan ? $pengaturan->tanggal_acara->format('d/m/Y') : 'Akan diumumkan' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Lokasi</h6>
                                    <p class="mb-0 text-muted">
                                        {{ $pengaturan ? $pengaturan->lokasi : 'Politeknik Negeri Banyuwangi' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Waktu</h6>
                                    <p class="mb-0 text-muted">
                                        {{ $pengaturan ? $pengaturan->waktu_acara->format('H:i') : 'Akan diumumkan' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Target Volunter</h6>
                                    <p class="mb-0 text-muted">
                                        {{ $pengaturan ? $pengaturan->target_volunter . '+' : '100+' }} Mahasiswa
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan tombol kembali di bawah info section -->
    <div class="text-center mt-4">
        <a href="/" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
        </a>
    </div>
</div>
@endsection 