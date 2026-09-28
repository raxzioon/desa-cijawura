<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Untuk hash password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat User Admin Utama
        User::firstOrCreate(
            ['email' => 'admin@desa.com'], // Cari berdasarkan email untuk menghindari duplikasi
            [
                'name' => 'Admin', // Nama admin utama
                'password' => Hash::make('password'), // Password: password
                'role' => 'admin', // Atur role sebagai 'admin'
                'email_verified_at' => now(), // Verifikasi email secara otomatis
                // Avatar default dari UI Avatars jika tidak ada image_url di UserFactory
                'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode('Radianus') . '&color=7F9CF5&background=EBF4FF',
            ]
        );
    }
}
