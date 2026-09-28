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
        Schema::create('surat_online', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik', 20);
            $table->string('email')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->text('alamat');
            $table->string('jenis_surat');
            $table->text('keperluan');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->string('file_persyaratan')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_online');
    }
};
