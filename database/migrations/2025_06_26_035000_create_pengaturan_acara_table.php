<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaturan_acara', function (Blueprint $table) {
            $table->id();
            $table->string('nama_acara');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_acara');
            $table->time('waktu_acara');
            $table->string('lokasi');
            $table->integer('target_volunter')->default(100);
            $table->boolean('status_pendaftaran')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_acara');
    }
}; 