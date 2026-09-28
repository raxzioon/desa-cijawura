<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DataPembangunan extends Model
{
    use HasFactory;

    protected $table = 'data_pembangunan';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'lokasi',
        'date_at'
    ];

    protected $casts = [
        'date_at' => 'datetime'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug'; // <-- TAMBAHKAN BARIS INI
    }

    // Otomatis buat slug saat menyimpan
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($data_pembangunan) {
            $data_pembangunan->slug = Str::slug($data_pembangunan->title);
        });

        static::updating(function ($data_pembangunan) {
            $data_pembangunan->slug = Str::slug($data_pembangunan->title);
        });

        // Hapus gambar terkait saat berita dihapus (hanya jika itu path lokal)
        static::deleting(function ($data_pembangunan) {
            // Hapus gambar berita
            if ($data_pembangunan->image && (Str::startsWith($data_pembangunan->image, 'http://') || Str::startsWith($data_pembangunan->image, 'https://'))) {
                // Jangan hapus gambar jika itu URL eksternal
            } elseif ($data_pembangunan->image && Storage::disk('public')->exists($data_pembangunan->image)) {
                Storage::disk('public')->delete($data_pembangunan->image);
            }
        });
    }

    // Accessor untuk mendapatkan URL gambar yang benar
    public function getImageUrlAttribute()
    {
        // Jika kolom 'image' dimulai dengan http:// atau https://, berarti itu URL eksternal
        if ($this->image && (Str::startsWith($this->image, 'http://') || Str::startsWith($this->image, 'https://'))) {
            return $this->image;
        }
        // Jika kolom 'image' tidak kosong (berarti path lokal)
        elseif ($this->image) {
            // Gunakan Storage::url() untuk path lokal
            return Storage::url($this->image);
        }
        // Jika tidak ada gambar, kembalikan URL placeholder default
        return asset('images/placeholder-product.png'); // <-- PASTIKAN ANDA MEMILIKI FILE INI
    }
}
