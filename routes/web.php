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
use App\Http\Controllers\KalendarAcaraController;
use App\Http\Controllers\MesyuaratController;
use App\Http\Controllers\MinitMesyuaratController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\QrReaderController;
use App\Http\Controllers\RekodKehadiranController;
use App\Http\Controllers\SumbanganController;
use App\Http\Controllers\UsulMesyuaratController;
use App\Http\Controllers\YuranController;
use App\Models\Minit_mesyuarat;
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

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/pengguna-simpan', [AuthController::class, 'pengguna_simpan'])->name('pengguna-simpan');

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
    Route::get('/pengguna-mail', function () {
        return view('admin.admin-email-pengesahan-pengguna');
    })->name('pengguna-email');


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
    Route::post('/mesyuarat-panggilan', [AdminMesyuaratController::class, 'mesyuarat_panggilan'])->name('admin.mesyuarat-panggilan');
    Route::post('/maklumbalas-kehadiran/{id}', [AdminMesyuaratController::class, 'maklumbalas_kehadiran'])->name('admin.maklumbalas-kehadiran');
    Route::get('/maklumbalas-laporan/{id}', [AdminMesyuaratController::class, 'maklumbalas_laporan'])->name('admin.maklumbalas-laporan');



    // Panggilan Mesyuarat
    Route::get('/panggilan-mesyuarat-butiran/{id}', [AdminMesyuaratController::class, 'panggilan_mesyuarat_butiran'])->name('admin.panggilan-mesyuarat-butiran');
    Route::post('/panggilan-mesyuarat-simpan/{id}', [AdminMesyuaratController::class, 'panggilan_mesyuarat_simpan'])->name('admin.panggilan-mesyuarat-simpan');
    Route::get('/panggilan-mesyuarat-surat/{id}', [AdminMesyuaratController::class, 'panggilan_mesyuarat_surat'])->name('admin.panggilan-mesyuarat-surat');

    //panggilan mesyuarat YDP TYDP
    Route::get('/panggilan-mesyuarat', [MesyuaratController::class, 'index'])->name('admin.mesyuarat');
    Route::get('/minit-mesyuarat', [MinitMesyuaratController::class, 'index'])->name('admin.minit-mesyuarat');


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
    Route::get('/kehadiran-qr-laporan/{id}', [AdminKehadiranController::class, 'kehadiran_qr_laporan'])->name('admin.kehadiran-laporan');


    //qr Reader
    Route::post('/qr-simpan', [AdminQrReaderController::class, 'qr_simpan'])->name('admin.qr-simpan');
    Route::get('/qr-berjaya', [AdminQrReaderController::class, 'qr_berjaya'])->name('admin.qr-berjaya');

    //Yuran
    Route::get('/yuran-tambah', [AdminYuranController::class, 'yuran_tambah'])->name('admin.yuran-tambah');
    Route::post('/yuran-simpan', [AdminYuranController::class, 'yuran_simpan'])->name('admin.yuran-simpan');
    Route::post('/yuran-simpan-tambahan/{id}', [AdminYuranController::class, 'yuran_simpan_tambahan'])->name('admin.yuran-simpan-tambahan');
    Route::get('/yuran-padam/{id}', [AdminYuranController::class, 'yuran_padam'])->name('admin.yuran-padam');
    Route::get('/yuran-laporan/{id}', [AdminYuranController::class, 'yuran_laporan'])->name('admin.yuran-laporan');
    Route::get('/yuran-notis/{id}', [AdminYuranController::class, 'yuran_notis'])->name('admin.yuran-notis');
    Route::post('/yuran-notis-emel/{id}', [AdminYuranController::class, 'yuran_notis_emel'])->name('admin.yuran-notis-emel');

    Route::get('/yuran-edit/{year}', [AdminYuranController::class, 'yuran_edit'])->name('admin.yuran-edit');

    Route::post('/yuran-update/{year}', [AdminYuranController::class, 'yuran_update'])->name('admin.yuran-update');
    Route::get('/yuran-butiran/{year}', [AdminYuranController::class, 'yuran_butiran'])->name('admin.yuran-butiran');
    Route::get('/senarai-bayar/{year}', [AdminYuranController::class, 'senarai_bayar'])->name('admin.senarai-bayar');
    Route::get('/yuran-tambahan-padam', [AdminYuranController::class, 'yuran_tambahan_padam'])->name('admin.yuran-tambahan-padam');
    Route::get('/yuran-resit/{id}', [AdminYuranController::class, 'resit_yuran'])->name('admin.yuran-resit');

    //sumbangan
    Route::get('/sumbangan-arkib', [AdminSumbanganController::class, 'arkib'])->name('admin.sumbangan-arkib');
    Route::get('/sumbangan-padam/{id}', [AdminSumbanganController::class, 'sumbangan_padam'])->name('admin.sumbangan-padam');
    Route::get('/sumbangan-nyahaktif/{id}', [AdminSumbanganController::class, 'sumbangan_nyahaktif'])->name('admin.sumbangan-nyahaktif');
    Route::get('/sumbangan-tambah', [AdminSumbanganController::class, 'sumbangan_tambah'])->name('admin.sumbangan-tambah');
    Route::post('/sumbangan-simpan', [AdminSumbanganController::class, 'sumbangan_simpan'])->name('admin.sumbangan-simpan');
    Route::get('/sumbangan-edit/{id}', [AdminSumbanganController::class, 'sumbangan_edit'])->name('admin.sumbangan-edit');
    Route::post('/sumbangan-update/{id}', [AdminSumbanganController::class, 'sumbangan_update'])->name('admin.sumbangan-update');
    Route::get('/sumbangan-butiran/{id}', [AdminSumbanganController::class, 'sumbangan_butiran'])->name('admin.sumbangan-butiran');
    Route::get('/sumbangan-resit/{id}', [AdminSumbanganController::class, 'sumbangan_resit'])->name('admin.sumbangan-resit');
    Route::get('/sumbangan-laporan/{id}', [AdminSumbanganController::class, 'sumbangan_laporan'])->name('admin.sumbangan-laporan');
});
//qrTest
Route::get('/qr-code', [AdminKehadiranController::class, 'generate'])->name('admin.qr-code');

Route::middleware('auth', 'web', 'isuser')->group(function () {
    Route::get('/laman-utama', [PenggunaController::class, 'index'])->name('laman-utama');
    Route::get('/kalendar-acara', [KalendarAcaraController::class, 'index'])->name('kalendar-acara');
    Route::get('/mesyuarat', [MesyuaratController::class, 'index'])->name('mesyuarat');
    Route::get('/rekod-kehadiran', [RekodKehadiranController::class, 'index'])->name('rekod-kehadiran');
    Route::get('/qr-reader', [QrReaderController::class, 'index'])->name('qr-reader');
    Route::get('/yuran', [YuranController::class, 'index'])->name('yuran');

    //halaman utama
    Route::get('/borang-profil/{id}', [PenggunaController::class, 'borang_profil'])->name('borang-profil');
    Route::post('/borang-profil-update/{id}', [PenggunaController::class, 'profil_update'])->name('profil-update');

    //kelendar acara
    Route::get('/kalendar-acara-butiran/{id}', [KalendarAcaraController::class, 'kalendar_butiran'])->name('kalendar-butiran');

    //panggilan mesyuarat
    Route::get('/panggilan-mesyuarat-surat/{id}', [AdminMesyuaratController::class, 'panggilan_mesyuarat_surat'])->name('panggilan-mesyuarat-surat');
    Route::post('/maklumbalas-kehadiran/{id}', [AdminMesyuaratController::class, 'maklumbalas_kehadiran'])->name('maklumbalas-kehadiran');

    //usul mesyuarat
    Route::get('/usul-mesyuarat/{id}', [UsulMesyuaratController::class, 'index'])->name('usul-mesyuarat');
    Route::get('/usul-butiran/{id}', [UsulMesyuaratController::class, 'usul_butiran'])->name('usul-butiran');
    Route::get('/usul-mesyuarat-padam/{id}', [UsulMesyuaratController::class, 'usul_padam'])->name('usul-padam');
    Route::get('/usul-tambah/{id}', [UsulMesyuaratController::class, 'usul_tambah'])->name('usul-tambah');
    Route::post('/usul-simpan/{id}', [UsulMesyuaratController::class, 'usul_simpan'])->name('usul-simpan');

    //minit mesyuarat
    Route::get('/minit-mesyuarat', [MinitMesyuaratController::class, 'index'])->name('minit-mesyuarat');


    //QR reader
    Route::post('/qr-simpan', [QrReaderController::class, 'qr_simpan'])->name('qr-simpan');
    Route::get('/qr-berjaya', [QrReaderController::class, 'qr_berjaya'])->name('qr-berjaya');

    //yuran
    Route::post('/pembayaran-yuran', [YuranController::class, 'pembayaran_yuran'])->name('pembayaran-yuran');
    Route::get('/pembayaran-yuran-berjaya', [YuranController::class, 'pembayaran_yuran_berjaya'])->name('pembayaran-yuran-berjaya');
    Route::get('/pembayaran-yuran-gagal', [YuranController::class, 'pembayaran_yuran_gagal'])->name('pembayaran-yuran-gagal');

    //sumbangan
    Route::get('/sumbangan', [SumbanganController::class, 'index'])->name('sumbangan');
    Route::post('/pembayaran-sumbangan', [SumbanganController::class, 'pembayaran_sumbangan'])->name('pembayaran-sumbangan');
    Route::get('/pembayaran-sumbangan-berjaya', [SumbanganController::class, 'pembayaran_sumbangan_berjaya'])->name('pembayaran-sumbangan-berjaya');
    Route::get('/pembayaran-sumbangan-gagal', [SumbanganController::class, 'pembayaran_sumbangan_gagal'])->name('pembayaran-sumbangan-gagal');
});
