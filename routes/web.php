<?php

use App\Http\Controllers\AdminAduanCadanganController;
use App\Http\Controllers\AdminKalendarAcaraController;
use App\Http\Controllers\AdminKehadiranController;
use App\Http\Controllers\AdminLamanUtamaController;
use App\Http\Controllers\AdminMinitMesyuaratController;
use App\Http\Controllers\AdminMesyuaratController;
use App\Http\Controllers\AdminPenggunaController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\AdminQrReaderController;
use App\Http\Controllers\AdminRekodKehadiranController;
use App\Http\Controllers\AdminSumbanganController;
use App\Http\Controllers\AdminTinjauanAcaraController;
use App\Http\Controllers\AdminUsulMesyuaratController;
use App\Http\Controllers\AdminYuranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\QrReaderController;
use App\Http\Controllers\YuranController;
use App\Models\Yuran;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
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
    Route::get('/rekod-kehadiran', [AdminRekodKehadiranController::class, 'index'])->name('admin.rekod-kehadiran');
    Route::get('/qr-reader', [AdminQrReaderController::class, 'index'])->name('admin.qr-reader');
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
    Route::get('/pengguna-nyah-aktif/{id}', [AdminPenggunaController::class, 'pengguna_nyah_aktif'])->name('admin.pengguna-nyah-aktif');
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
    // Route::get('/mesyuarat-butiran/{id}', [AdminMesyuaratController::class, 'mesyuarat_butiran'])->name('admin.mesyuarat-butiran');
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

    //kehadiran
    Route::get('/kehadiran-tambah', [AdminKehadiranController::class, 'kehadiran_tambah'])->name('admin.kehadiran-tambah');
    Route::post('/kehadiran-simpan', [AdminKehadiranController::class, 'kehadiran_simpan'])->name('admin.kehadiran-simpan');
    Route::get('/kehadiran-padam/{id}', [AdminKehadiranController::class, 'kehadiran_padam'])->name('admin.kehadiran-padam');
    Route::get('/kehadiran-qr/{id}', [AdminKehadiranController::class, 'kehadiran_qr'])->name('admin.kehadiran-qr');
    Route::get('/kehadiran-pengguna/{id}', [AdminKehadiranController::class, 'kehadiran_pengguna'])->name('admin.kehadiran-pengguna');
    Route::post('/kehadiran-qr-simpan/{id}', [AdminKehadiranController::class, 'kehadiran_qr_simpan'])->name('admin.kehadiran-qr-simpan');
    Route::get('/update-counts/{id}', [AdminKehadiranController::class, 'updateCounts'])->name('admin.update-counts');

    //qr Reader
    Route::post('/qr-simpan', [AdminQrReaderController::class, 'qr_simpan'])->name('admin.qr-simpan');
    Route::get('/qr-berjaya', [AdminQrReaderController::class, 'qr_berjaya'])->name('admin.qr-berjaya');



    //Yuran
    Route::get('/yuran-tambah', [AdminYuranController::class, 'yuran_tambah'])->name('admin.yuran-tambah');
    Route::post('/yuran-simpan', [AdminYuranController::class, 'yuran_simpan'])->name('admin.yuran-simpan');
    Route::post('/yuran-simpan-tambahan/{id}', [AdminYuranController::class, 'yuran_simpan_tambahan'])->name('admin.yuran-simpan-tambahan');
    Route::get('/yuran-padam/{id}', [AdminYuranController::class, 'yuran_padam'])->name('admin.yuran-padam');

    Route::get('/yuran-edit/{year}', [AdminYuranController::class, 'yuran_edit'])->name('admin.yuran-edit');

    Route::post('/yuran-update/{year}', [AdminYuranController::class, 'yuran_update'])->name('admin.yuran-update');
    Route::get('/yuran-butiran/{year}', [AdminYuranController::class, 'yuran_butiran'])->name('admin.yuran-butiran');
    Route::get('/senarai-bayar/{year}', [AdminYuranController::class, 'senarai_bayar'])->name('admin.senarai-bayar');
    Route::get('/yuran-tambahan-padam', [AdminYuranController::class, 'yuran_tambahan_padam'])->name('admin.yuran-tambahan-padam');
});
//qrTest
Route::get('/qr-code', [AdminKehadiranController::class, 'generate'])->name('admin.qr-code');

Route::middleware('auth', 'web', 'isuser')->group(function () {
    Route::get('/laman-utama', [PenggunaController::class, 'index'])->name('laman-utama');
    Route::get('/qr-reader', [QrReaderController::class, 'index'])->name('qr-reader');
    Route::get('/yuran', [YuranController::class, 'index'])->name('yuran');

    //QR reader
    Route::post('/qr-simpan', [QrReaderController::class, 'qr_simpan'])->name('qr-simpan');
    Route::get('/qr-berjaya', [QrReaderController::class, 'qr_berjaya'])->name('qr-berjaya');

    //yuran
    Route::post('/pembayaran-yuran', [YuranController::class, 'pembayaran_yuran'])->name('pembayaran-yuran');
});
