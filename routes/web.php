<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController; // Import HomeController
use App\Http\Controllers\Frontend\ProfileController as FrontendProfileController; // Import ProfileController frontend dengan alias
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\DocumentController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\InstitutionController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\PotentialController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ServiceProcedureController;
use App\Http\Controllers\Frontend\SuratOnlineController;
use App\Http\Controllers\Frontend\AduanController;
use App\Http\Controllers\Frontend\DataPembangunanController;
use Illuminate\Support\Facades\Artisan;
// --- RUTE FRONTEND PUBLIK DESA ---

// Rute Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/layanan-online', function () {
    return view('frontend.online_services');
})->name('online-services');
Route::get('/kontak', function () {
    return view('frontend.contact');
})->name('contact');


// --- RUTE BAWAAN LARAVEL BREEZE (UNTUK PENGGUNA TERAUTENTIKASI) ---

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Rute Profil Pengguna bawaan Breeze
// Ini untuk mengelola profil pengguna yang login (bukan admin)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Rute Berita ---
Route::get('/berita', [NewsController::class, 'index'])->name('news');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');


// --- Rute Galeri ---
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');
Route::get('/galeri/{slug}', [GalleryController::class, 'show'])->name('gallery.show');

// --- Rute Prosedur Layanan Warga ---
Route::get('/prosedur-layanan', [ServiceProcedureController::class, 'index'])->name('service-procedures');
Route::get('/prosedur-layanan/{slug}', [ServiceProcedureController::class, 'show'])->name('service-procedures.show');


// --- Rute Dokumen Publik ---
Route::get('/dokumen-publik', [DocumentController::class, 'index'])->name('documents');
Route::get('/dokumen-publik/{slug}/unduh', [DocumentController::class, 'download'])->name('documents.download');

// --- Rute Potensi Desa ---
Route::get('/potensi-desa', [PotentialController::class, 'index'])->name('potentials');


// --- Rute Produk Desa ---
Route::get('/produk-desa', [ProductController::class, 'index'])->name('products');
Route::get('/produk-desa/{slug}', [ProductController::class, 'show'])->name('products.show');

// --- Rute Profil Desa ---
Route::get('/profil/visi', [FrontendProfileController::class, 'visionMission'])->name('profil.visi');
Route::get('/profil/sejarah', [FrontendProfileController::class, 'history'])->name('profil.sejarah');
Route::get('/profil/struktur-pemerintahan', [FrontendProfileController::class, 'structure'])->name('profil.struktur');
Route::get('/profil/geografis', [FrontendProfileController::class, 'geografis'])->name('profil.geografis');

// --- Rute Komentar (Pengiriman) ---
Route::post('/news/{news}/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('throttle:10,1'); // 10 comments per minute

// --- Rute Lembaga Desa ---
Route::get('/lembaga-desa', [InstitutionController::class, 'index'])->name('institutions.index');
Route::get('/lembaga-desa/{slug}', [InstitutionController::class, 'show'])->name('institutions.show');

Route::middleware(['auth', 'verified'])->group(function () {
    // --- Rute Surat Online ---
    Route::get('/surat-online', [SuratOnlineController::class, 'index'])->name('surat-online.index');
    Route::post('/surat-online', [SuratOnlineController::class, 'store'])
        ->name('surat-online.store')
        ->middleware('throttle:5,1'); // 5 submissions per minute
    Route::post('/surat-online/search-status', [SuratOnlineController::class, 'searchStatus'])
        ->name('surat-online.search-status')
        ->middleware('throttle:20,1'); // 20 searches per minute
    Route::get('/surat-online/status/{id}', [SuratOnlineController::class, 'showStatus'])->name('surat-online.status');
});
// --- Rute Aduan ---
Route::get('/aduan', [AduanController::class, 'index'])->name('aduan.index');
Route::post('/aduan', [AduanController::class, 'store'])
    ->name('aduan.store')
    ->middleware('throttle:3,1'); // 3 submissions per minute
Route::post('/aduan/search-status', [AduanController::class, 'searchStatus'])
    ->name('aduan.search-status')
    ->middleware('throttle:20,1'); // 20 searches per minute
Route::get('/aduan/status/{id}', [AduanController::class, 'showStatus'])->name('aduan.status');

// --- Rute Data Pembangunan ---
Route::get('/data-pembangunan', [DataPembangunanController::class, 'index'])->name('data-pembangunan.index');
Route::get('/data-pembangunan/{slug}', [DataPembangunanController::class, 'show'])->name('data-pembangunan.show');

// Tambahkan ini sementara di routes/web.php
Route::get('/clear-config-desa', function () {
    // Menjalankan php artisan config:clear
    Artisan::call('config:clear');

    // Opsional: jalankan cache sekalian agar performa stabil di hosting
    Artisan::call('config:cache');

    Artisan::call('cache:clear');

    Artisan::call('optimize:clear');

    return "Konfigurasi Website Desa berhasil dibersihkan dan diperbarui!";
});

Route::get('/symlink', function () {
    // Karena kita tidak memisahkan folder, jalurnya lebih sederhana:
    $targetFolder = __DIR__ . '/../storage/app/public';
    $linkFolder = __DIR__ . '/../public/storage';

    symlink($targetFolder, $linkFolder);
    return 'Symlink berhasil dibuat!';
});

// Route::get('/profil/visi-misi', [ProfileController::class, 'visiMisi'])->name('profil.visi');
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
