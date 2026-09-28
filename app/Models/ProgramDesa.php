<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramDesa extends Model
{
    protected $table = 'program_desa';

    protected $fillable = [
        'name',
        'deskripsi',
        'urutan'
    ];

    protected $casts = [
        'urutan' => 'integer',
    ];

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
