<?php

use App\Http\Controllers\Admin\AduanController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DataStatistikController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\InstitutionController;
use App\Http\Controllers\Admin\LetterGeneratorController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PotentialController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileContentController;
use App\Http\Controllers\Admin\ProgramDesaController;
use App\Http\Controllers\Admin\ServiceProcedureController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SuratOnlineController;
use App\Http\Controllers\Admin\ThemeSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisionMissionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DataPembangunanController;
use App\Http\Controllers\Admin\RoleController;

// route login with rate limiting
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('throttle:6,1');

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/theme', [ThemeSettingController::class, 'edit'])->name('admin.theme.edit');
    Route::post('/theme', [ThemeSettingController::class, 'update'])->name('admin.theme.update');

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Rute untuk Manajemen Pengguna
    Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->names('admin.users');
    // Rute untuk pengelolaan Hero Slider (CRUD)
    Route::resource('hero-sliders', HeroSliderController::class)->names('admin.hero-sliders');
    Route::get('/vision-mission', [VisionMissionController::class, 'index'])->name('admin.vision-mission.index');
    Route::get('/vision-mission/edit', [VisionMissionController::class, 'edit'])->name('admin.vision-mission.edit');
    Route::put('/vision-mission', [VisionMissionController::class, 'update'])->name('admin.vision-mission.update');
    // --- Rute Potensi Desa ---
    Route::resource('potentials', PotentialController::class)->names('admin.potentials');
    // Rute khusus untuk menghapus gambar individu dari galeri
    Route::delete('gallery-images/{image}', [GalleryController::class, 'deleteImage'])->name('admin.galleries.delete-image');
    // --- Rute Prosedur Layanan ---
    Route::resource('service-procedures', ServiceProcedureController::class)->names('admin.service-procedures');
    // --- Rute Dokumen Publik ---
    Route::resource('documents', DocumentController::class)->names('admin.documents');
    // --- Rute Produk Desa ---
    Route::resource('products', ProductController::class)->names('admin.products');
    // --- Rute Komentar (Moderasi) ---
    // Tidak menggunakan Route::resource karena hanya perlu index, update, destroy
    Route::get('/comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('admin.comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
    // --- Rute Lembaga Desa ---
    Route::resource('institutions', InstitutionController::class)->names('admin.institutions');
    // --- Rute Data Statistik ---
    Route::resource('data-statistik', DataStatistikController::class)->names('admin.data-statistik');
    // --- Rute Program Desa ---
    Route::resource('program-desa', ProgramDesaController::class)->names('admin.program-desa');
    // --- Rute Konten Profil (Visi, Misi, Sejarah, Struktur) ---
    // Gunakan rute kustom karena bukan CRUD Resource standar
    Route::get('/profile-contents/{key}/edit', [ProfileContentController::class, 'edit'])->name('admin.profile-contents.edit');
    Route::put('/profile-contents/{key}', [ProfileContentController::class, 'update'])->name('admin.profile-contents.update');
    // --- Rute Pengaturan Umum & Info Desa (Terkonsolidasi) ---
    Route::get('/settings/general-info', [SettingController::class, 'editGeneralInfo'])->name('admin.settings.edit-general-info');
    Route::put('/settings/general-info', [SettingController::class, 'updateGeneralInfo'])->name('admin.settings.update-general-info');

    // --- Rute Generator Surat ---
    Route::get('/letter-generator/create', [LetterGeneratorController::class, 'create'])->name('admin.letter-generator.create');
    Route::post('/letter-generator/generate', [LetterGeneratorController::class, 'generate'])->name('admin.letter-generator.generate');

    // --- Rute Surat Online ---
    Route::resource('surat-online', SuratOnlineController::class)->names('admin.surat-online');
    Route::put('/surat-online/{suratOnline}/update-status', [SuratOnlineController::class, 'updateStatus'])->name('admin.surat-online.update-status');

    // --- Rute Aduan ---
    Route::resource('aduan', AduanController::class)->names('admin.aduan');
    Route::put('/aduan/{aduan}/update-status', [AduanController::class, 'updateStatus'])->name('admin.aduan.update-status');

    // --- Rute Data Pembangunan ---
    Route::resource('data-pembangunan', DataPembangunanController::class)->names('admin.data-pembangunan');

    // Role Management - Only for Admin
    Route::middleware('role:manage_users')->group(function () {
        Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->names('admin.users');
        Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
        Route::post('/roles/update', [RoleController::class, 'update'])->name('admin.roles.update');
    });

    Route::middleware('role:manage_news')->resource('news', NewsController::class)->names('admin.news');

    Route::middleware('role:manage_galleries')->resource('galleries', GalleryController::class)->names('admin.galleries');
});
