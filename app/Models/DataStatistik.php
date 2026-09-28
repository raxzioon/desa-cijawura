<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataStatistik extends Model
{
    protected $table = 'data_statistik';
    
    protected $fillable = [
        'nama_statistik',
        'jumlah',
        'satuan',
        'deskripsi',
        'icon',
        'warna',
        'urutan',
        'is_active'
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'urutan' => 'integer',
        'is_active' => 'boolean',
    ];

    // Scope untuk data yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk mengurutkan berdasarkan urutan
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    // Method untuk format jumlah dengan pemisah ribuan
    public function getFormattedJumlahAttribute()
    {
        return number_format($this->jumlah, 0, ',', '.');
    }
}
