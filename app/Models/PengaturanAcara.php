<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanAcara extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_acara';
    
    protected $fillable = [
        'nama_acara',
        'deskripsi',
        'tanggal_acara',
        'waktu_acara',
        'lokasi',
        'target_volunter',
        'status_pendaftaran'
    ];

    protected $casts = [
        'tanggal_acara' => 'date',
        'waktu_acara' => 'datetime:H:i',
        'status_pendaftaran' => 'boolean',
    ];

    /**
     * Get formatted date and time
     */
    public function getTanggalWaktuAttribute()
    {
        return $this->tanggal_acara->format('d/m/Y') . ' ' . $this->waktu_acara->format('H:i');
    }

    /**
     * Get full datetime for comparison
     */
    public function getDateTimeAttribute()
    {
        return $this->tanggal_acara->format('Y-m-d') . ' ' . $this->waktu_acara->format('H:i:s');
    }
} 