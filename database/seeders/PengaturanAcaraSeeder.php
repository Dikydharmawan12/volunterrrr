<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PengaturanAcara;

class PengaturanAcaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PengaturanAcara::create([
            'nama_acara' => 'Pengajian Akbar Poliwangi 2025',
            'deskripsi' => 'Bergabunglah sebagai volunter dalam acara pengajian akbar yang akan diselenggarakan di Politeknik Negeri Banyuwangi. Mari kita bersama-sama menyukseskan acara ini!',
            'tanggal_acara' => '2025-01-15',
            'waktu_acara' => '08:00:00',
            'lokasi' => 'Politeknik Negeri Banyuwangi',
            'target_volunter' => 100,
            'status_pendaftaran' => true,
        ]);
    }
} 