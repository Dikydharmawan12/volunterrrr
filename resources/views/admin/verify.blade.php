@extends('layouts.app')

@section('title', 'Verifikasi Admin - Pengajian Akbar Poliwangi 2025')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Header Section -->
            <div class="text-center mb-4">
                <h1 class="display-5 fw-bold text-white mb-3">
                    <i class="fas fa-user-shield me-3"></i>
                    Verifikasi Admin
                </h1>
                <p class="lead text-white-50">
                    Masukkan password untuk mengakses panel admin
                </p>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-lock me-2"></i>
                        Login Admin
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

                    <form action="{{ route('admin.verify.post') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="fas fa-key me-1"></i>Password Admin
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Masukkan password admin" required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Password diperlukan untuk mengakses panel admin
                            </small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i>Verifikasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Info Card -->
            <div class="card mt-4">
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <i class="fas fa-shield-alt me-2"></i>
                        Keamanan
                    </h5>
                    <p class="card-text">
                        Panel admin dilindungi dengan password untuk menjaga keamanan data volunter dan divisi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tambahkan tombol kembali di bawah halaman -->
<div class="text-center mt-4">
    <a href="/" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
    </a>
</div>
@endsection 