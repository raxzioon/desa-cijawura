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
        Schema::create('data_statistik', function (Blueprint $table) {
            $table->id();
            $table->string('nama_statistik'); // Nama jenis statistik (Penduduk, Kebayanan, dll)
            $table->integer('jumlah'); // Nilai/jumlah statistik
            $table->string('satuan'); // Satuan (Jiwa, Dusun, RT, KK)
            $table->string('deskripsi')->nullable(); // Deskripsi tambahan
            $table->string('icon')->nullable(); // Icon untuk tampilan
            $table->string('warna')->default('#3B82F6'); // Warna untuk styling
            $table->integer('urutan')->default(0); // Urutan tampilan
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_statistik');
    }
};
