# Pendaftaran Volunter Pengajian Akbar Poliwangi 2025

Sistem pendaftaran volunter yang modern dan responsif untuk acara Pengajian Akbar yang akan diselenggarakan di Politeknik Negeri Banyuwangi dengan verifikasi admin sederhana.

## ✨ Fitur

- **🎨 Desain Modern**: Interface yang indah dan responsif dengan gradient background
- **📱 Responsif**: Optimal di desktop, tablet, dan mobile
- **🏠 Halaman Utama**: Hero section dengan informasi acara dan navigasi
- **📝 Pendaftaran**: Form pendaftaran yang user-friendly dengan validasi
- **⚙️ Admin Panel**: Kelola divisi (tambah, edit, hapus) dengan verifikasi password
- **🔐 Verifikasi Admin**: Sistem verifikasi sederhana dengan password
- **📊 Dashboard**: Statistik divisi dan volunter
- **📅 Pengaturan Acara**: Admin dapat mengatur tanggal, waktu, lokasi, dan status pendaftaran
- **🚫 Kontrol Pendaftaran**: Admin dapat membuka/menutup pendaftaran

## 🎯 Struktur URL

### Halaman User
- `/` - Beranda dengan hero section
- `/pendaftaran` - Form pendaftaran volunter

### Halaman Admin
- `/admin/verify` - Halaman verifikasi admin
- `/admin/divisi` - Daftar divisi (setelah verifikasi)
- `/admin/divisi/create` - Tambah divisi baru
- `/admin/divisi/{id}/edit` - Edit divisi
- `/admin/pengaturan` - Pengaturan acara (tanggal, waktu, lokasi, dll)

## 🚀 Instalasi

1. Clone repository ini
2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy file `.env.example` ke `.env` dan sesuaikan konfigurasi database

4. Generate app key:
   ```bash
   php artisan key:generate
   ```

5. Jalankan migrasi:
   ```bash
   php artisan migrate
   ```

6. Jalankan seeder untuk data awal:
   ```bash
   php artisan db:seed --class=PengaturanAcaraSeeder
   ```

7. Jalankan server development:
   ```bash
   php artisan serve
   ```

## 📖 Penggunaan

### Untuk Volunter (Mahasiswa)
1. Buka halaman utama `/`
2. Lihat informasi acara yang ditampilkan
3. Klik "Daftar Sekarang" atau akses `/pendaftaran`
4. Isi form pendaftaran dengan data lengkap
5. Pilih divisi yang tersedia
6. Submit pendaftaran

### Untuk Admin
1. Buka halaman utama `/`
2. Klik "Admin Panel" atau akses `/admin/verify`
3. Masukkan password admin: `adminukmimam2025`
4. Setelah verifikasi berhasil, akan diarahkan ke halaman kelola divisi
5. **Kelola Divisi**: Tambah, edit, hapus divisi volunter
6. **Pengaturan Acara**: Atur tanggal, waktu, lokasi, dan status pendaftaran
7. Klik "Logout" di navbar untuk keluar dari mode admin

## 🔒 Keamanan

- **Password Admin**: `adminukmimam2025` (dapat diubah di file `routes/web.php`)
- **Session**: Verifikasi admin menggunakan session Laravel
- **Middleware**: Semua route admin dilindungi dengan middleware `AdminVerified`

## 🎨 Desain & UI/UX

- **Color Scheme**: Gradient biru-ungu yang modern
- **Typography**: Font Segoe UI yang mudah dibaca
- **Icons**: Font Awesome untuk ikon yang konsisten
- **Cards**: Glassmorphism effect dengan backdrop blur
- **Buttons**: Gradient buttons dengan hover effects
- **Responsive**: Mobile-first approach dengan Bootstrap 5

## 📊 Database

### Tabel Divisi
- `id` - Primary key
- `nama` - Nama divisi volunter
- `kuota` - Jumlah kuota maksimal
- `batas_akhir` - Batas waktu pendaftaran
- `created_at`, `updated_at` - Timestamp

### Tabel Pendaftaran
- `id` - Primary key
- `nama` - Nama lengkap volunter
- `nim` - Nomor Induk Mahasiswa
- `prodi` - Program Studi
- `no_hp` - Nomor HP
- `divisi_id` - Foreign key ke tabel divisi
- `created_at`, `updated_at` - Timestamp

### Tabel Pengaturan Acara
- `id` - Primary key
- `nama_acara` - Nama acara
- `deskripsi` - Deskripsi acara
- `tanggal_acara` - Tanggal acara
- `waktu_acara` - Waktu acara
- `lokasi` - Lokasi acara
- `target_volunter` - Target jumlah volunter
- `status_pendaftaran` - Status buka/tutup pendaftaran
- `created_at`, `updated_at` - Timestamp

## 🛠️ Teknologi

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5, Font Awesome
- **Database**: MySQL/SQLite
- **Styling**: Custom CSS dengan CSS Variables
- **Responsive**: Mobile-first design

## 📱 Responsivitas

- **Desktop**: Layout optimal dengan sidebar dan cards
- **Tablet**: Grid layout yang menyesuaikan
- **Mobile**: Single column layout dengan touch-friendly buttons

## 🎯 Fitur Admin

### Pengaturan Acara
- **Nama Acara**: Ubah judul acara
- **Deskripsi**: Edit deskripsi acara
- **Tanggal & Waktu**: Atur tanggal dan waktu acara
- **Lokasi**: Ubah lokasi acara
- **Target Volunter**: Set target jumlah volunter
- **Status Pendaftaran**: Buka/tutup pendaftaran

### Manajemen Divisi
- **Tambah Divisi**: Buat divisi baru
- **Edit Divisi**: Ubah informasi divisi
- **Hapus Divisi**: Hapus divisi yang tidak diperlukan
- **Kuota**: Atur kuota per divisi
- **Batas Waktu**: Set batas pendaftaran per divisi

## 🎯 Catatan

- Sistem menggunakan verifikasi password sederhana
- Admin panel dapat diakses setelah verifikasi berhasil
- Session admin akan bertahan sampai logout atau browser ditutup
- Validasi dilakukan di sisi server untuk mencegah pendaftaran ganda
- Kuota divisi diperiksa secara otomatis
- Desain modern dengan glassmorphism effect
- Fully responsive untuk semua device
- Admin dapat mengontrol status pendaftaran secara real-time
- Informasi acara ditampilkan secara dinamis dari database
