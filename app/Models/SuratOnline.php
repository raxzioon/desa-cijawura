<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SuratOnline extends Model
{
    protected $table = 'surat_online';

    protected $fillable = [
        'nama',
        'nik',
        'email',
        'no_hp',
        'alamat',
        'jenis_surat',
        'keperluan',
        'status',
        'catatan_admin',
        'file_persyaratan',
        'nomor_surat',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_selesai' => 'datetime',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'diproses';
    const STATUS_COMPLETED = 'selesai';
    const STATUS_REJECTED = 'ditolak';

    // Get status options
    public static function getStatusOptions()
    {
        return [
            self::STATUS_PENDING => 'Menunggu',
            self::STATUS_IN_PROGRESS => 'Sedang Diproses',
            self::STATUS_COMPLETED => 'Selesai',
            self::STATUS_REJECTED => 'Ditolak',
        ];
    }

    // Get jenis surat options
    public static function getJenisSuratOptions()
    {
        // Cache the result for 60 minutes to reduce database queries
        //return Cache::remember('jenis_surat_options', now()->addHour(), function () {
        return ServiceProcedure::where('category', 'Surat')
            ->where('is_published', true)
            ->orderBy('title')
            ->pluck('title', 'slug')
            ->toArray();
        //});
    }

    public static function getJenisSurat()
    {
        // Cache the result for 60 minutes to reduce database queries
        //return Cache::remember('jenis_surat_options_full', now()->addHour(), function () {
        return ServiceProcedure::where('category', 'Surat')
            ->where('is_published', true)
            ->orderBy('title')
            ->get(['slug', 'title', 'description', 'icon', 'category'])
            ->keyBy('slug')
            ->toArray();
        //});
    }

    // // Get icon jenis surat options
    // public static function getIconJenisSuratOptions()
    // {
    //     // This method seems to be a duplicate. For now, it will just call the main method.
    //     // If icons are needed, this should be changed to pluck 'icon' instead of 'title'.
    //     return self::getJenisSuratOptions();
    // }

    // Get status badge class for display
    public function getStatusBadgeClass()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'bg-yellow-100 text-yellow-800';
            case self::STATUS_IN_PROGRESS:
                return 'bg-blue-100 text-blue-800';
            case self::STATUS_COMPLETED:
                return 'bg-green-100 text-green-800';
            case self::STATUS_REJECTED:
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }
}
