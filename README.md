# Sistem Pengurusan PIBG (SPPIBG)

Sistem Pengurusan Persatuan Ibu Bapa dan Guru (PIBG) adalah aplikasi web yang direka untuk memudahkan pengurusan aktiviti, mesyuarat, kewangan, dan pentadbiran PIBG sekolah.

## 📋 Kandungan

-   [Ciri-ciri Utama](#ciri-ciri-utama)
-   [Keperluan Sistem](#keperluan-sistem)
-   [Pemasangan](#pemasangan)
-   [Konfigurasi](#konfigurasi)
-   [Penggunaan](#penggunaan)
-   [Struktur Database](#struktur-database)
-   [Peranan Pengguna](#peranan-pengguna)
-   [Teknologi](#teknologi)
-   [Lesen](#lesen)

## ✨ Ciri-ciri Utama

### 1. **Pengurusan Pengguna**

-   Pendaftaran dan pengesahan pengguna
-   6 Peranan akses: Admin, Setiausaha, Bendahari, Naib Presiden, Ahli Jawatankuasa, Ahli Biasa
-   Profil pengguna dengan maklumat lengkap (nama, IC, alamat, hubungan, telefon)

### 2. **Pengurusan Mesyuarat**

-   Cipta dan urus mesyuarat PIBG
-   Panggilan mesyuarat dengan QR code
-   Sistem kehadiran digital
-   Maklum balas kehadiran (Hadir/Tidak Hadir/Tentative)
-   Minit mesyuarat dengan upload dokumen
-   Agenda dan tempoh mesyuarat

### 3. **Pengurusan Usul**

-   Kemukakan usul untuk mesyuarat
-   Kategorikan usul (Kewangan, Program, Kemudahan, Akademik, Lain-lain)
-   Ulasan dan perbincangan usul
-   Pengesahan dan status usul

### 4. **Pengurusan Acara**

-   Kalendar acara PIBG
-   Penjadwalan acara dengan masa, tempat, dan agenda
-   Tinjauan acara
-   Kod warna untuk kategorikan acara

### 5. **Pengurusan Kewangan**

-   **Yuran Tahunan:**

    -   Yuran mengikut tahun pelajar
    -   Yuran tambahan untuk kelas tertentu
    -   Rekod pembayaran yuran
    -   Status pembayaran (Dibayar/Belum Dibayar)

-   **Sumbangan:**
    -   Kempen sumbangan dengan sasaran jumlah
    -   Rekod sumbangan pengguna
    -   Status transaksi
    -   Penjejakan pembayaran

### 6. **Pengurusan Pelajar**

-   Maklumat pelajar (nama, kelas, tahun)
-   Hubungan pelajar dengan pengguna (ibubapa/penjaga)
-   Rekod akademik mengikut tahun

### 7. **Buletin & Komunikasi**

-   Penerbitan buletin PIBG
-   Upload dokumen buletin (PDF)
-   Sistem draf untuk semakan
-   Notifikasi email untuk:
    -   Pengesahan pengguna
    -   Panggilan mesyuarat
    -   Notis yuran

### 8. **Sistem QR Code**

-   QR code untuk kehadiran mesyuarat
-   QR reader untuk scan kehadiran
-   Kehadiran automatik melalui QR

## 🔧 Keperluan Sistem

-   PHP >= 8.1
-   Composer
-   Node.js & NPM
-   MySQL/MariaDB atau SQLite
-   Apache/Nginx web server

### Package Utama

-   **Laravel 10.x** - PHP Framework
-   **Laravel Sanctum** - API Authentication
-   **Yajra DataTables** - Server-side tables
-   **Simple QR Code** - QR Code generation
-   **PayPal SDK** - Payment integration
-   **Laravel Mail** - Email notifications

## 📥 Pemasangan

### 1. Clone Repository

```bash
git clone https://github.com/Nazrulalif/sppibg.git
cd sppibg
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

Edit `.env` file dengan maklumat database anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sppibg
DB_USERNAME=root
DB_PASSWORD=
```

Atau gunakan SQLite (lalai):

```env
DB_CONNECTION=sqlite
```

### 5. Migrate & Seed Database

```bash
# Run migrations
php artisan migrate

# Seed database dengan data contoh
php artisan db:seed
```

### 6. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Jalankan Aplikasi

```bash
# Development server
php artisan serve
```

Aplikasi boleh diakses di: `http://localhost:8000`

## ⚙️ Konfigurasi

### Mail Configuration

Edit `.env` untuk email notifications:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### PayPal Configuration (Optional)

```env
PAYPAL_MODE=sandbox
PAYPAL_SANDBOX_CLIENT_ID=your-client-id
PAYPAL_SANDBOX_CLIENT_SECRET=your-client-secret
```

## 👥 Peranan Pengguna

Sistem ini mempunyai 6 peranan dengan akses berbeza:

| ID  | Peranan           | Keterangan                         |
| --- | ----------------- | ---------------------------------- |
| 1   | Admin             | Akses penuh ke semua fungsi sistem |
| 2   | Setiausaha        | Urus mesyuarat, minit, panggilan   |
| 3   | Bendahari         | Urus yuran, sumbangan, kewangan    |
| 6   | Naib Presiden     | Akses mesyuarat dan keputusan      |
| 4   | Ahli Jawatankuasa | Ahli eksekutif dengan akses terhad |
| 5   | Ahli Biasa        | Ahli PIBG dengan akses asas        |

### Default Users (After Seeding)

| Email                    | Password | Role              |
| ------------------------ | -------- | ----------------- |
| admin@example.com        | password | Admin             |
| setiausaha@example.com   | password | Setiausaha        |
| bendahari@example.com    | password | Bendahari         |
| naibpresiden@example.com | password | Naib Presiden     |
| jawatankuasa@example.com | password | Ahli Jawatankuasa |
| ahlibiasa@example.com    | password | Ahli Biasa        |

## 🗄️ Struktur Database

### Jadual Utama

-   `users` - Maklumat pengguna
-   `akses_pengguna` - Peranan akses
-   `pelajar` - Data pelajar
-   `tahun_pelajar` - Tahun persekolahan
-   `mesyuarat` - Mesyuarat PIBG
-   `panggilan_mesyuarat` - Panggilan mesyuarat
-   `kehadiran` & `kehadiran_pengguna` - Kehadiran
-   `maklumbalas_kehadiran` - Respon kehadiran
-   `minit_mesyuarat` - Minit mesyuarat
-   `usul_mesyuarat` - Usul/cadangan
-   `usul_kategori` - Kategori usul
-   `ulasan_usul` - Ulasan usul
-   `acara` - Acara PIBG
-   `buletin` - Buletin/newsletter
-   `yuran` - Struktur yuran
-   `yuran_bayar` - Pembayaran yuran
-   `sumbangan` - Kempen sumbangan
-   `sumbangan_pengguna` - Rekod sumbangan

## 💻 Teknologi

### Backend

-   **Laravel 10.x** - PHP Framework
-   **MySQL/SQLite** - Database
-   **Laravel Sanctum** - Authentication

### Frontend

-   **Blade Templates** - Templating engine
-   **Bootstrap/Custom CSS** - Styling
-   **JavaScript** - Client-side interactions
-   **DataTables** - Dynamic tables
-   **QR Code Scanner** - Attendance system

### Tools & Libraries

-   **Composer** - PHP dependency manager
-   **NPM** - JavaScript package manager
-   **Vite** - Asset bundler
-   **Laravel Pint** - Code styling
-   **PHPUnit** - Testing

## 📝 Penggunaan

### Untuk Admin

1. **Login** ke sistem dengan akaun admin
2. **Urus Pengguna** - Tambah, edit, hapus pengguna
3. **Cipta Mesyuarat** - Jadualkan mesyuarat dengan agenda
4. **Keluarkan Panggilan** - Generate QR code untuk kehadiran
5. **Urus Kewangan** - Set yuran, terima pembayaran
6. **Upload Minit** - Muat naik minit mesyuarat

### Untuk Ahli

1. **Login** dengan akaun yang didaftarkan
2. **Lihat Mesyuarat** - Semak jadual mesyuarat
3. **Maklum Balas** - Sahkan kehadiran untuk mesyuarat
4. **Kemukakan Usul** - Submit cadangan untuk mesyuarat
5. **Bayar Yuran** - Bayar yuran tahunan secara online
6. **Beri Sumbangan** - Sumbang untuk projek PIBG

## 🔐 Keselamatan

-   Password hashing menggunakan bcrypt
-   CSRF protection pada semua forms
-   Middleware authentication
-   Role-based access control
-   SQL injection prevention (Eloquent ORM)
-   XSS protection

## 🚀 Development

### Running Tests

```bash
php artisan test
```

### Code Styling

```bash
./vendor/bin/pint
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 📧 Support

Untuk sebarang pertanyaan atau masalah, sila hubungi:

-   Email: support@sppibg.com
-   GitHub Issues: [Create an issue](https://github.com/Nazrulalif/sppibg/issues)

## 📄 Lesen

Projek ini adalah perisian sumber terbuka di bawah [MIT license](LICENSE).

## 👨‍💻 Pembangunan

Dibangunkan untuk memudahkan pengurusan PIBG sekolah di Malaysia.

---

**SPPIBG** - Sistem Pengurusan Persatuan Ibu Bapa dan Guru
© 2025 All Rights Reserved
