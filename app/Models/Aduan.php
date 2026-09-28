<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Aduan extends Model
{
    protected $table = 'aduan';

    protected $fillable = [
        'nama',
        'nik',
        'no_hp',
        'alamat',
        'jenis_aduan',
        'isi_aduan',
        'lokasi_kejadian',
        'status',
        'catatan_admin',
        'lampiran_pendukung',
        'nomor_aduan',
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
    public static function getJenisAduanOptions()
    {
        // Cache the result for 60 minutes to reduce database queries
        // return Cache::remember('jenis_aduan_options', now()->addHour(), function () {
        return ServiceProcedure::where('category', 'Aduan')
            ->where('is_published', true)
            ->orderBy('title')
            ->pluck('title', 'slug')
            ->toArray();
        //});
    }

    public static function getJenisAduan()
    {
        // Cache the result for 60 minutes to reduce database queries
        //return Cache::remember('jenis_aduan_options_full', now()->addHour(), function () {
        return ServiceProcedure::where('category', 'Aduan')
            ->where('is_published', true)
            ->orderBy('title')
            ->get(['slug', 'title', 'description', 'icon', 'category'])
            ->keyBy('slug')
            ->toArray();
        //});
    }

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
