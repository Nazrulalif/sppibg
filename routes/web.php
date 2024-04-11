<?php

use App\Http\Controllers\AdminAduanCadanganController;
use App\Http\Controllers\AdminKalendarAcaraController;
use App\Http\Controllers\AdminKehadiranController;
use App\Http\Controllers\AdminLamanUtamaController;
use App\Http\Controllers\AdminMinitMesyuaratController;
use App\Http\Controllers\AdminMesyuaratController;
use App\Http\Controllers\AdminPenggunaController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\AdminSumbanganController;
use App\Http\Controllers\AdminTinjauanAcaraController;
use App\Http\Controllers\AdminUsulMesyuaratController;
use App\Http\Controllers\AdminYuranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('session/login');
})->name('login');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware('auth', 'isadmin')->group(function () {
    Route::get('/laman-utama', [AdminLamanUtamaController::class, 'index'])->name('admin.laman-utama');
    Route::get('/pengguna', [AdminPenggunaController::class, 'index'])->name('admin.pengguna');
    Route::get('/kalendar-acara', [AdminKalendarAcaraController::class, 'index'])->name('admin.kalendar-acara');
    Route::get('/tinjauan-acara', [AdminTinjauanAcaraController::class, 'index'])->name('admin.tinjauan-acara');
    Route::get('/mesyuarat', [AdminMesyuaratController::class, 'index'])->name('admin.panggilan-mesyuarat');
    Route::get('/usul-mesyuarat', [AdminUsulMesyuaratController::class, 'index'])->name('admin.usul-mesyuarat');
    Route::get('/minit-mesyuarat', [AdminMinitMesyuaratController::class, 'index'])->name('admin.minit-mesyuarat');
    Route::get('/kehadiran', [AdminKehadiranController::class, 'index'])->name('admin.kehadiran');
    Route::get('/aduan-cadangan', [AdminAduanCadanganController::class, 'index'])->name('admin.aduan-cadangan');
    Route::get('/yuran', [AdminYuranController::class, 'index'])->name('admin.yuran');
    Route::get('/sumbangan', [AdminSumbanganController::class, 'index'])->name('admin.sumbangan');

    // Halaman Utama
    Route::get('/laman-utama-arkib', [AdminLamanUtamaController::class, 'arkib'])->name('admin.arkib');
    Route::get('/borang-profil/{id}', [AdminLamanUtamaController::class, 'profil_edit'])->name('admin.borang-profil');
    Route::post('/borang-profil-update/{id}', [AdminLamanUtamaController::class, 'profil_update'])->name('admin.profil-update');
    Route::get('/buletin-tambah', [AdminLamanUtamaController::class, 'buletin_tambah'])->name('admin.buletin-tambah');
    Route::post('/buletin-simpan', [AdminLamanUtamaController::class, 'buletin_simpan'])->name('admin.buletin-simpan');
    Route::get('/buletin-padam/{id}', [AdminLamanUtamaController::class, 'buletin_padam'])->name('admin.buletin-padam');
    Route::get('/buletin-edit/{id}', [AdminLamanUtamaController::class, 'buletin_edit'])->name('admin.buletin-edit');
    Route::post('/buletin-update/{id}', [AdminLamanUtamaController::class, 'buletin_update'])->name('admin.buletin-update');

    // Pengguna
    Route::get('/pengguna-belum-sah', [AdminPenggunaController::class, 'belum_sah_pengguna'])->name('admin.pengguna-belum-sah');
    Route::get('/pengguna-tambah', [AdminPenggunaController::class, 'pengguna_tambah'])->name('admin.pengguna-tambah');
    Route::post('/pengguna-simpan', [AdminPenggunaController::class, 'pengguna_simpan'])->name('admin.pengguna-simpan');
    Route::get('/pengguna-padam/{id}', [AdminPenggunaController::class, 'pengguna_padam'])->name('admin.pengguna-padam');
    Route::get('/pengguna-edit/{id}', [AdminPenggunaController::class, 'pengguna_edit'])->name('admin.pengguna-edit');
    Route::post('/pengguna-update/{id}', [AdminPenggunaController::class, 'pengguna_update'])->name('admin.pengguna-update');
    Route::get('/pelajar-delete/{id}', [AdminPenggunaController::class, 'pelajar_delete'])->name('admin.pelajar-delete');
    Route::get('/pengguna-sah/{id}', [AdminPenggunaController::class, 'pengguna_sah'])->name('admin.pengguna-sah');
    Route::get('/pengguna-butiran/{id}', [AdminPenggunaController::class, 'pengguna_butiran'])->name('admin.pengguna-butiran');

    // Kalendar acara
    Route::get('/kalendar-tambah/{date}', [AdminKalendarAcaraController::class, 'kalendar_tambah'])->name('admin.kalendar-tambah');
    Route::get('/kalendar-butiran/{id}', [AdminKalendarAcaraController::class, 'kalendar_butiran'])->name('admin.kalendar-butiran');
    Route::get('/kalendar-delete/{id}', [AdminKalendarAcaraController::class, 'kalendar_delete'])->name('admin.kalendar-delete');
    Route::get('/kalendar-delete-upcomming/{id}', [AdminKalendarAcaraController::class, 'kalendar_delete_upcomming'])->name('admin.kalendar-delete-upcomming');
    Route::post('/kalendar-update/{id}', [AdminKalendarAcaraController::class, 'kalendar_update'])->name('admin.kalendar-update');
    Route::get('/kalendar-edit/{id}', [AdminKalendarAcaraController::class, 'kalendar_edit'])->name('admin.kalendar-edit');
    Route::post('/kalendar-acara-simpan/{date}', [AdminKalendarAcaraController::class, 'acara_simpan'])->name('admin.kalendar-acara-simpan');
    Route::post('/kalendar-mesyuarat-simpan/{date}', [AdminKalendarAcaraController::class, 'mesyuarat_simpan'])->name('admin.kalendar-mesyuarat-simpan');
    Route::get('/kalendar-laporan', [AdminKalendarAcaraController::class, 'kalendar_laporan'])->name('admin.kalendar-laporan');
    Route::post('/kalendar-laporan-tarikh', [AdminKalendarAcaraController::class, 'kalendar_laporan_tarikh'])->name('admin.kalendar-laporan-tarikh');

    // Mesyuarat
    Route::get('/mesyuarat-butiran/{id}', [AdminMesyuaratController::class, 'mesyuarat_butiran'])->name('admin.mesyuarat-butiran');
    Route::get('/mesyuarat-butiran/{id}', [AdminMesyuaratController::class, 'mesyuarat_butiran'])->name('admin.mesyuarat-butiran');
    Route::get('/mesyuarat-arkib', [AdminMesyuaratController::class, 'mesyuarat_arkib'])->name('admin.mesyuarat-arkib');
    Route::get('/mesyuarat-tambah', [AdminMesyuaratController::class, 'mesyuarat_tambah'])->name('admin.mesyuarat-tambah');
    Route::post('/mesyuarat-simpan', [AdminMesyuaratController::class, 'mesyuarat_simpan'])->name('admin.mesyuarat-simpan');
    Route::get('/mesyuarat-padam/{id}', [AdminMesyuaratController::class, 'mesyuarat_padam'])->name('admin.mesyuarat-padam');
    Route::get('/mesyuarat-edit/{id}', [AdminMesyuaratController::class, 'mesyuarat_edit'])->name('admin.mesyuarat-edit');
    Route::post('/mesyuarat-update/{id}', [AdminMesyuaratController::class, 'mesyuarat_update'])->name('admin.mesyuarat-update');

    // Panggilan Mesyuarat
    Route::get('/panggilan-mesyuarat-butiran/{id}', [AdminMesyuaratController::class, 'panggilan_mesyuarat_butiran'])->name('admin.panggilan-mesyuarat-butiran');
    Route::post('/panggilan-mesyuarat-simpan/{id}', [AdminMesyuaratController::class, 'panggilan_mesyuarat_simpan'])->name('admin.panggilan-mesyuarat-simpan');
    Route::get('/panggilan-mesyuarat-surat/{id}', [AdminMesyuaratController::class, 'panggilan_mesyuarat_surat'])->name('admin.panggilan-mesyuarat-surat');

    // Usul Mesyuarat
    Route::get('/usul_mesyuarat/{id}', [AdminUsulMesyuaratController::class, 'index'])->name('admin.usul-mesyuarat');
    Route::get('/usul_mesyuarat-pengesahan/{id}', [AdminUsulMesyuaratController::class, 'usul_mesyuarat_pengesahan'])->name('admin.usul-mesyuarat-pengesahan');
    Route::get('/usul_mesyuarat-terima/{id}', [AdminUsulMesyuaratController::class, 'usul_mesyuarat_terima'])->name('admin.usul-terima');
    Route::get('/usul_mesyuarat-tolak/{id}', [AdminUsulMesyuaratController::class, 'usul_mesyuarat_tolak'])->name('admin.usul-tolak');
    Route::get('/usul_mesyuarat-ulasan/{id}', [AdminUsulMesyuaratController::class, 'ulasan_usul'])->name('admin.ulasan-usul');
    Route::post('/usul_mesyuarat-ulasan-simpan/{id}', [AdminUsulMesyuaratController::class, 'ulasan_simpan'])->name('admin.ulasan-simpan');
    Route::get('/usul_laporan/{id}', [AdminUsulMesyuaratController::class, 'ulasan_laporan'])->name('admin.usul-laporan');

    // Minit Mesyuarat
    Route::post('/minit-simpan/{id}', [AdminMinitMesyuaratController::class, 'minit_simpan'])->name('admin.minit-simpan');
    Route::get('/minit-padam/{id}', [AdminMinitMesyuaratController::class, 'minit_padam'])->name('admin.minit-padam');
});

Route::middleware('auth', 'web', 'isuser')->group(function () {
    Route::get('/laman-utama', [PenggunaController::class, 'index'])->name('laman-utama');
});
