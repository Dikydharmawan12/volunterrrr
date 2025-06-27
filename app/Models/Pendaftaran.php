<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    protected $fillable = ['nama', 'nim', 'prodi', 'no_hp', 'divisi_id'];

    public function divisi(): BelongsTo
    {
        return $this->belongsTo(Divisi::class);
    }
}
