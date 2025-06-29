@extends('layouts.app')

@section('title', 'Pendaftaran Volunter - Pengajian Akbar Poliwangi 2025')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header Section -->
            <div class="text-center mb-4">
                <h1 class="display-5 fw-bold text-white mb-3">
                    <i class="fas fa-user-plus me-3"></i>
                    Pendaftaran Volunter
                </h1>
                <p class="lead text-white-50">
                    Bergabunglah sebagai volunter dalam acara {{ $pengaturan->nama_acara ?? 'Pengajian Akbar Poliwangi 2025' }}
                </p>
            </div>

            <!-- Event Info Card -->
            @if($pengaturan)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Acara
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-calendar-alt text-primary me-2"></i>
                            <strong>Tanggal:</strong> {{ $pengaturan->tanggal_acara->format('d/m/Y') }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-clock text-primary me-2"></i>
                            <strong>Waktu:</strong> {{ $pengaturan->waktu_acara->format('H:i') }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <strong>Lokasi:</strong> {{ $pengaturan->lokasi }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-users text-primary me-2"></i>
                            <strong>Target:</strong> {{ $pengaturan->target_volunter }} volunter
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Registration Status Alert -->
            @php
                use Illuminate\Support\Carbon;
                $pendaftaranTutupSemua = $divisis->count() > 0 && $divisis->every(function($divisi) { return now()->gt($divisi->batas_akhir); });
            @endphp
            @if($pengaturan && !$pengaturan->status_pendaftaran)
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-triangle me-2" style="font-size: 2rem;"></i>
                    <h5 class="mt-2">Pendaftaran Sedang Ditutup</h5>
                    <p class="mb-0">Pendaftaran volunter sedang ditutup sementara. Silakan cek kembali nanti.</p>
                </div>
            @elseif($pendaftaranTutupSemua)
                <div class="alert alert-danger text-center">
                    <i class="fas fa-lock me-2" style="font-size: 2rem;"></i>
                    <h5 class="mt-2">Pendaftaran Sudah Ditutup</h5>
                    <p class="mb-0">Semua divisi telah melewati batas akhir pendaftaran.</p>
                </div>
            @else
                <!-- Button Lihat Divisi -->
                <div class="mb-3 text-end">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDivisi">
                        <i class="fas fa-eye me-1"></i> Lihat Divisi Tersedia
                    </button>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Formulir Pendaftaran
                        </h4>
                    </div>
                    <div class="card-body p-4">
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

                        @if($divisis->count() == 0)
                            <div class="alert alert-info text-center">
                                <i class="fas fa-info-circle me-2" style="font-size: 2rem;"></i>
                                <h5 class="mt-2">Belum ada divisi yang tersedia</h5>
                                <p class="mb-0">Silakan hubungi admin untuk menambahkan divisi volunter.</p>
                            </div>
                        @else
                            <form action="{{ route('pendaftaran.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama" class="form-label">
                                            <i class="fas fa-user me-1"></i>Nama Lengkap
                                        </label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                               id="nama" name="nama" value="{{ old('nama') }}" 
                                               placeholder="Masukkan nama lengkap" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="nim" class="form-label">
                                            <i class="fas fa-id-card me-1"></i>NIM
                                        </label>
                                        <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                                               id="nim" name="nim" value="{{ old('nim') }}" 
                                               placeholder="Masukkan NIM" required>
                                        @error('nim')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="prodi" class="form-label">
                                            <i class="fas fa-graduation-cap me-1"></i>Program Studi
                                        </label>
                                        <input type="text" class="form-control @error('prodi') is-invalid @enderror" 
                                               id="prodi" name="prodi" value="{{ old('prodi') }}" 
                                               placeholder="Masukkan program studi" required>
                                        @error('prodi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="no_hp" class="form-label">
                                            <i class="fas fa-phone me-1"></i>Nomor HP
                                        </label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                               id="no_hp" name="no_hp" value="{{ old('no_hp') }}" 
                                               placeholder="Masukkan nomor HP" required>
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="divisi_id" class="form-label">
                                        <i class="fas fa-users me-1"></i>Pilih Divisi
                                    </label>
                                    <select class="form-select @error('divisi_id') is-invalid @enderror" 
                                            id="divisi_id" name="divisi_id" required>
                                        <option value="">-- Pilih Divisi Volunter --</option>
                                        @foreach($divisis as $divisi)
                                            @php
                                                $sisa_kuota = $divisi->kuota - $divisi->pendaftarans()->count();
                                            @endphp
                                            <option value="{{ $divisi->id }}" {{ old('divisi_id') == $divisi->id ? 'selected' : '' }}>
                                                {{ $divisi->nama }} (Sisa Kuota: {{ $sisa_kuota }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('divisi_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Pilih divisi yang sesuai dengan kemampuan dan minat Anda
                                    </small>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Daftar Sebagai Volunter
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
            
            <!-- Info Card -->
            <div class="card mt-4">
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <i class="fas fa-lightbulb me-2"></i>
                        Tips Pendaftaran
                    </h5>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <i class="fas fa-check-circle text-success me-1"></i>
                            Pastikan data yang diisi benar
                        </div>
                        <div class="col-md-4 mb-2">
                            <i class="fas fa-check-circle text-success me-1"></i>
                            Pilih divisi sesuai kemampuan
                        </div>
                        <div class="col-md-4 mb-2">
                            <i class="fas fa-check-circle text-success me-1"></i>
                            Siap berkomitmen untuk acara
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Volunter yang Sudah Mendaftar -->
            <div class="card mt-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Daftar Volunter yang Sudah Mendaftar</h5>
                </div>
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
                                        <td colspan="7" class="text-center">Belum ada volunter yang mendaftar.</td>
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

<!-- Modal Daftar Divisi -->
<div class="modal fade" id="modalDivisi" tabindex="-1" aria-labelledby="modalDivisiLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="modalDivisiLabel"><i class="fas fa-users me-2"></i>Daftar Divisi Tersedia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Divisi</th>
                <th>Kuota</th>
                <th>Deskripsi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($divisis as $divisi)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $divisi->nama }}</td>
                  <td>{{ $divisi->kuota }}</td>
                  <td>{{ $divisi->deskripsi ?? '-' }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center">Belum ada divisi tersedia.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection
