<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('auth/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [App\Http\Controllers\GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

//User Routes
Route::get('/kreator', [App\Http\Controllers\KreatorController::class, 'index'])->name('kreator')->middleware('user_level');
Route::get('/kreator/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('kreator.berita')->middleware('user_level');
Route::get('/kreator/berita/tambah', [App\Http\Controllers\BeritaController::class, 'create'])->name('kreator.berita.tambah')->middleware('user_level');
Route::post('/kreator/berita/store', [App\Http\Controllers\BeritaController::class, 'store'])->name('kreator.berita.store')->middleware('user_level');
Route::get('/kreator/berita/edit/{id}', [App\Http\Controllers\BeritaController::class, 'edit'])->name('kreator.berita.edit')->middleware('user_level');
Route::post('/kreator/berita/update/{id}', [App\Http\Controllers\BeritaController::class, 'update'])->middleware('user_level');
Route::get('/kreator/berita/delete/{id}', [App\Http\Controllers\BeritaController::class, 'destroy'])->middleware('user_level');
Route::get('/kreator/berita/search', [App\Http\Controllers\BeritaController::class, 'searchBerita'])->name('kreator.berita.search')->middleware('user_level');
Route::get('/kreator/profile', [App\Http\Controllers\KreatorController::class, 'showProfile'])->name('kreator.profile.show')->middleware('user_level');
Route::post('/kreator/profile/update/{id}', [App\Http\Controllers\KreatorController::class, 'updateProfile'])->middleware('user_level');
Route::get('/kreator/profile/edit-password/{id}', [App\Http\Controllers\KreatorController::class, 'editPasswordProfile'])->name('edit.password.profile')->middleware('user_level');
Route::post('/kreator/profile/update-password/{id}', [App\Http\Controllers\KreatorController::class, 'updatePasswordProfile'])->middleware('user_level');
Route::post('/berita/like', [App\Http\Controllers\KreatorController::class, 'likeBerita'])->middleware('user_level');
Route::post('/berita/dislike/{slug}', [App\Http\Controllers\KreatorController::class, 'dislikeBerita'])->middleware('user_level');
Route::get('/kreator/berita-premium', [App\Http\Controllers\KreatorController::class, 'showBeritaPremium'])->name('kreator.berita.premium')->middleware('user_level');
Route::get('/kreator/berita-premium/search', [App\Http\Controllers\KreatorController::class, 'searchBeritaPremium'])->name('kreator.berita.premium.search')->middleware('user_level');
Route::get('/kreator/berita-premium-list', [App\Http\Controllers\KreatorController::class, 'showBeritaPremiumList'])->name('kreator.berita.premium.list')->middleware('user_level');
Route::get('/kreator/berita-premium/beli', [App\Http\Controllers\KreatorController::class, 'beliBeritaPremium'])->name('kreator.berita.premium.beli')->middleware('user_level');
Route::post('/kreator/berita-premium/beli', [App\Http\Controllers\KreatorController::class, 'storeBeliBeritaPremium'])->name('kreator.berita.premium.beli.store')->middleware('user_level');
Route::get('/kreator/berita-premium/riwayat', [App\Http\Controllers\KreatorController::class, 'showRiwayatBeritaPremium'])->name('kreator.berita.premium.riwayat')->middleware('user_level');
Route::get('/kreator/berita-premium/riwayat/search', [App\Http\Controllers\KreatorController::class, 'searchRiwayatBeritaPremium'])->name('kreator.berita.premium.riwayat.search')->middleware('user_level');
Route::get('/berita-premium/{slug}/{id_users}/{id_berita}', [App\Http\Controllers\KreatorController::class, 'commonShowPremiumBerita'])->middleware('user_level');
Route::get('/kreator/wartapay', [App\Http\Controllers\KreatorController::class, 'showWartaPay'])->name('kreator.wartapay')->middleware('user_level');
Route::get('/kreator/wartapay/search', [App\Http\Controllers\KreatorController::class, 'searchWartaPay'])->name('kreator.wartapay.search')->middleware('user_level');
Route::post('/kreator/wartapay/isi', [App\Http\Controllers\KreatorController::class, 'isiWartaPay'])->middleware('user_level');


//Admin Routes
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('admin_level');
Route::get('/admin/kategori', [App\Http\Controllers\AdminController::class, 'showKategori'])->name('admin.kategori')->middleware('admin_level');
Route::get('/admin/kategori/search', [App\Http\Controllers\AdminController::class, 'searchKategori'])->name('admin.kategori.search')->middleware('admin_level');
Route::get('/admin/kategori/tambah', [App\Http\Controllers\AdminController::class, 'tambahKategori'])->name('admin.kategori.tambah')->middleware('admin_level');
Route::post('/admin/kategori/tambah', [App\Http\Controllers\AdminController::class, 'storeKategori'])->name('admin.kategori.store')->middleware('admin_level');
Route::get('/admin/kategori/edit/{id}', [App\Http\Controllers\AdminController::class, 'editKategori'])->name('admin.kategori.edit')->middleware('admin_level');
Route::post('/admin/kategori/update/{id}', [App\Http\Controllers\AdminController::class, 'updateKategori'])->middleware('admin_level');
Route::get('/admin/kategori/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteKategori'])->middleware('admin_level');
Route::get('/admin/datakreator', [App\Http\Controllers\AdminController::class, 'showDataKreator'])->name('admin.datakreator')->middleware('admin_level');
Route::get('/admin/datakreator/search', [App\Http\Controllers\AdminController::class, 'searchDataKreator'])->name('admin.datakreator.search')->middleware('admin_level');
Route::get('/admin/datakreator/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteDataKreator'])->middleware('admin_level');
Route::get('/admin/databerita', [App\Http\Controllers\AdminController::class, 'showDataBerita'])->name('admin.databerita')->middleware('admin_level');
Route::get('/admin/databerita/search', [App\Http\Controllers\AdminController::class, 'searchDataBerita'])->name('admin.databerita.search')->middleware('admin_level');
Route::get('/admin/databerita/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteDataBerita'])->name('admin.databerita.delete')->middleware('admin_level');
Route::post('/admin/databerita/successstatus/{id}', [App\Http\Controllers\AdminController::class, 'statusSuccessDataBerita'])->middleware('admin_level');
Route::post('/admin/databerita/gagalstatus/{id}', [App\Http\Controllers\AdminController::class, 'statusGagalDataBerita'])->middleware('admin_level');
Route::post('/admin/databerita/{id}', [App\Http\Controllers\AdminController::class, 'sethargaBerita'])->middleware('admin_level');
Route::get('/admin/transaksi/berita-premium', [App\Http\Controllers\AdminController::class, 'showTransaksiBeritaPremium'])->name('admin.transaksi.beritapremium')->middleware('admin_level');
Route::get('/admin/transaksi/berita-premium/search', [App\Http\Controllers\AdminController::class, 'searchTransaksiBeritaPremium'])->name('admin.transaksi.beritapremium.search')->middleware('admin_level');
Route::post('/admin/transaksi/berita-premium/konfirmasi-pembayaran/{id}', [App\Http\Controllers\AdminController::class, 'confirmTransaksiBeritaPremium'])->middleware('admin_level');
Route::get('/admin/transaksi/berita-premium/hapus-transaksi/{id}', [App\Http\Controllers\AdminController::class, 'hapusTransaksiBeritaPremium'])->middleware('admin_level');
Route::get('/admin/transaksi/riwayat/top-up', [App\Http\Controllers\AdminController::class, 'showRiwayatTransaksiTopUp'])->name('admin.riwayat.transaksi.topup')->middleware('admin_level');
Route::get('/admin/transaksi/riwayat/top-up/search', [App\Http\Controllers\AdminController::class, 'searchRiwayatTransaksiTopUp'])->name('admin.riwayat.transaksi.topup.search')->middleware('admin_level');
Route::post('/admin/transaksi/riwayat/top-up/{id}', [App\Http\Controllers\AdminController::class, 'confirmRiwayatTransaksiTopUp'])->middleware('admin_level');


//Common Route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
Route::get('/berita/{slug}/{token}', [App\Http\Controllers\HomeController::class, 'commonShowBerita']);
Route::post('/berita/komentar', [App\Http\Controllers\HomeController::class, 'komentarBerita'])->name('berita.komentar');
Route::get('/news', [App\Http\Controllers\HomeController::class, 'showNews'])->name('news.show');
Route::get('/news/search', [App\Http\Controllers\HomeController::class, 'searchNews'])->name('news.search');
Route::get('/tips&trick', [App\Http\Controllers\HomeController::class, 'showTipsNTrick'])->name('tipsNtrick.show');
Route::get('/tips&trick/search', [App\Http\Controllers\HomeController::class, 'searchTipsNTrick'])->name('tipsNtrick.search');
Route::get('/tech&life', [App\Http\Controllers\HomeController::class, 'showTechNLife'])->name('techNlife.show');
Route::get('/tech&life/search', [App\Http\Controllers\HomeController::class, 'searchTechNLife'])->name('techNlife.search');
Route::get('/games', [App\Http\Controllers\HomeController::class, 'showGames'])->name('games.show');
Route::get('/games/search', [App\Http\Controllers\HomeController::class, 'searchGames'])->name('games.search');