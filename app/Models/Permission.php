<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'route_name',
        'module',
    ];

    // Method untuk cek permission berdasarkan route
    public static function getPermissionsByRoutes()
    {
        return [
            // Dashboard
            ['name' => 'view_dashboard', 'display_name' => 'Lihat Dashboard', 'route_name' => 'admin.dashboard', 'module' => 'Dashboard'],
            
            // User Management
            ['name' => 'manage_users', 'display_name' => 'Kelola Pengguna', 'route_name' => 'admin.users.*', 'module' => 'Manajemen Pengguna'],
            
            // Content Management
            ['name' => 'manage_news', 'display_name' => 'Kelola Berita', 'route_name' => 'admin.news.*', 'module' => 'Berita'],
            ['name' => 'manage_galleries', 'display_name' => 'Kelola Galeri', 'route_name' => 'admin.galleries.*', 'module' => 'Galeri'],
            ['name' => 'manage_products', 'display_name' => 'Kelola Produk', 'route_name' => 'admin.products.*', 'module' => 'Produk'],
            ['name' => 'manage_potentials', 'display_name' => 'Kelola Potensi', 'route_name' => 'admin.potentials.*', 'module' => 'Potensi Desa'],
            
            // Service Management
            ['name' => 'manage_service_procedures', 'display_name' => 'Kelola Prosedur Layanan', 'route_name' => 'admin.service-procedures.*', 'module' => 'Prosedur Layanan'],
            ['name' => 'manage_documents', 'display_name' => 'Kelola Dokumen', 'route_name' => 'admin.documents.*', 'module' => 'Dokumen Publik'],
            ['name' => 'manage_institutions', 'display_name' => 'Kelola Lembaga', 'route_name' => 'admin.institutions.*', 'module' => 'Lembaga Desa'],
            
            // Surat Online
            ['name' => 'manage_surat_online', 'display_name' => 'Kelola Surat Online', 'route_name' => 'admin.surat-online.*', 'module' => 'Surat Online'],
            
            // Aduan
            ['name' => 'manage_aduan', 'display_name' => 'Kelola Aduan', 'route_name' => 'admin.aduan.*', 'module' => 'Aduan'],
            
            // Data Management
            ['name' => 'manage_data_statistik', 'display_name' => 'Kelola Data Statistik', 'route_name' => 'admin.data-statistik.*', 'module' => 'Data Statistik'],
            ['name' => 'manage_program_desa', 'display_name' => 'Kelola Program Desa', 'route_name' => 'admin.program-desa.*', 'module' => 'Program Desa'],
            ['name' => 'manage_data_pembangunan', 'display_name' => 'Kelola Data Pembangunan', 'route_name' => 'admin.data-pembangunan.*', 'module' => 'Data Pembangunan'],
            
            // Settings
            ['name' => 'manage_settings', 'display_name' => 'Kelola Pengaturan', 'route_name' => 'admin.settings.*', 'module' => 'Pengaturan'],
            ['name' => 'manage_theme', 'display_name' => 'Kelola Tema', 'route_name' => 'admin.theme.*', 'module' => 'Tema'],
            
            // Comments
            ['name' => 'manage_comments', 'display_name' => 'Moderasi Komentar', 'route_name' => 'admin.comments.*', 'module' => 'Komentar'],
        ];
    }
}
