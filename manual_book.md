# 📖 Manual Book Aplikasi AppBencana

**Sistem Manajemen Bencana Terpadu**

---

## Daftar Isi

1. [Pendahuluan](#1-pendahuluan)
2. [Informasi Umum Aplikasi](#2-informasi-umum-aplikasi)
3. [Instalasi & Konfigurasi](#3-instalasi--konfigurasi)
4. [Struktur Aplikasi](#4-struktur-aplikasi)
5. [Modul Autentikasi](#5-modul-autentikasi)
6. [Modul Dashboard](#6-modul-dashboard)
7. [Modul Bencana](#7-modul-bencana)
8. [Modul Korban](#8-modul-korban)
9. [Modul Triase](#9-modul-triase)
10. [Modul Pemeriksaan Medis](#10-modul-pemeriksaan-medis)
11. [Modul Rujukan](#11-modul-rujukan)
12. [Modul Rumah Sakit](#12-modul-rumah-sakit)
13. [Modul User Management](#13-modul-user-management)
14. [Modul Laporan](#14-modul-laporan)
15. [Modul API Documentation](#15-modul-api-documentation)
16. [API Reference](#16-api-reference)
17. [Database Schema](#17-database-schema)
18. [Roles & Permissions](#18-roles--permissions)
19. [Panduan Troubleshooting](#19-panduan-troubleshooting)
20. [FAQ](#20-faq)

---

## 1. Pendahuluan

### 1.1 Tentang Aplikasi

**AppBencana** adalah aplikasi berbasis web yang dikembangkan untuk membantu pencatatan, pengelolaan, dan pelaporan data bencana. Aplikasi ini dibangun menggunakan framework **Laravel 13** dengan dukungan **API RESTful** menggunakan **Laravel Sanctum** untuk autentikasi berbasis token.

### 1.2 Tujuan Aplikasi

- Mendukung pencatatan kejadian bencana secara terstruktur.
- Mengelola data korban, triase, pemeriksaan medis, dan rujukan rumah sakit.
- Menghasilkan laporan dalam format PDF.
- Menyediakan REST API untuk integrasi dengan aplikasi mobile.
- Mendukung autentikasi multi-role (admin, petugas, relawan, medis).

### 1.3 Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 🏠 **Dashboard** | Menampilkan statistik keseluruhan sistem |
| 📋 **Manajemen Bencana** | CRUD data bencana |
| 👥 **Manajemen Korban** | Pencatatan data korban |
| 🏥 **Triase** | Klasifikasi prioritas penanganan korban |
| 💉 **Pemeriksaan Medis** | Pencatatan hasil pemeriksaan medis lengkap |
| 🔄 **Rujukan** | Manajemen rujukan korban ke rumah sakit |
| 🏨 **Manajemen Rumah Sakit** | Data rumah sakit rujukan |
| 👤 **User Management** | Manajemen pengguna sistem |
| � **Laporan PDF** | Cetak laporan per periode |
| 📚 **API Documentation** | Dokumentasi endpoint API |
| 📱 **Mobile API** | REST API untuk aplikasi mobile |

---

## 2. Informasi Umum Aplikasi

### 2.1 Teknologi yang Digunakan

| Komponen | Teknologi |
|----------|-----------|
| **Backend Framework** | Laravel 13.0 |
| **Bahasa Pemrograman** | PHP 8.3+ |
| **Database** | MySQL |
| **Authentication** | Laravel Sanctum 4.3 |
| **PDF Generator** | barryvdh/laravel-dompdf 3.1 |
| **Frontend Build** | Vite 8.0 |
| **CSS Framework** | TailwindCSS 4.0 |
| **JavaScript** | Vanilla JS (ES Module) |
| **Testing** | Pest PHP 4.6 |

### 2.2 Persyaratan Sistem

- PHP >= 8.3
- Composer
- Node.js & NPM
- MySQL Server
- Web Server (Apache/Nginx) atau `php artisan serve` untuk development

### 2.3 Informasi Akses Default

| Role | Keterangan |
|------|------------|
| `admin` | Akses penuh ke seluruh modul |
| `petugas` | Akses terbatas untuk input data |
| `relawan` | Akses terbatas untuk melihat data |
| `medis` | Akses ke modul medis (pemeriksaan) |

> **Catatan:** User default harus dibuat melalui seeder atau database. Belum ada fitur registrasi publik.

---

## 3. Instalasi & Konfigurasi

### 3.1 Langkah Instalasi

#### 1. Clone Repository

```bash
git clone <repository-url> appbencana
cd appbencana
```

#### 2. Install Dependency PHP

```bash
composer install
```

#### 3. Install Dependency JavaScript

```bash
npm install
```

#### 4. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

#### 5. Konfigurasi Database

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appbencana
DB_USERNAME=root
DB_PASSWORD=
```

#### 6. Migrasi Database

```bash
php artisan migrate
```

#### 7. (Opsional) Jalankan Seeder

```bash
php artisan db:seed
```

#### 8. Build Assets

```bash
npm run build
```

#### 9. Jalankan Aplikasi (Development)

```bash
php artisan serve
```

Akses aplikasi di: **http://localhost:8000**

### 3.2 Skrip Pintas

| Perintah | Fungsi |
|----------|--------|
| `composer run setup` | Setup lengkap aplikasi |
| `composer run dev` | Menjalankan server, queue, log, dan vite bersamaan |
| `composer run test` | Menjalankan test suite |
| `npm run build` | Build asset untuk production |
| `npm run dev` | Development mode asset (hot reload) |

---

## 4. Struktur Aplikasi

### 4.1 Struktur Direktori

```
appbencana/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/        # Controller untuk panel admin
│   │       ├── Api/          # Controller untuk REST API
│   │       └── Web/          # Controller untuk web auth
│   └── Models/               # Eloquent Models
├── bootstrap/
├── config/                   # File konfigurasi Laravel
├── database/
│   ├── migrations/           # Skema database
│   ├── factories/            # Model factories
│   └── seeders/              # Data dummy
├── public/                   # Document root & entry point
├── resources/
│   └── views/                # Blade templates
├── routes/
│   ├── web.php               # Routes web (panel admin)
│   └── api.php               # Routes API (mobile)
├── storage/                  # Storage logs, cache, uploads
├── tests/                    # Unit & feature tests
├── .env.example              # Template konfigurasi
├── artisan                   # CLI Laravel
├── composer.json             # Dependency PHP
└── package.json              # Dependency JavaScript
```

### 4.2 Struktur Routing

```
📦 Routes
├── 🌐 Web Routes (web.php)
│   ├── /                       → Login Form
│   ├── /login (POST)           → Proses Login
│   ├── /logout (POST)          → Logout
│   ├── /invoice                → Invoice Demo
│   └── /admin/*                → Grup Admin (auth)
│
└── 🔌 API Routes (api.php)
    ├── /api/login (POST)       → Login (Sanctum)
    └── /api/* (auth:sanctum)   → Grup API terotentikasi
```

---

## 5. Modul Autentikasi

### 5.1 Halaman Login

**URL:** `/`

**Fitur:**
- Login menggunakan **username** dan **password**
- Opsi "Remember Me" untuk session persistent
- Validasi CSRF
- Pesan error kredensial salah

**Field Form:**
| Field | Tipe | Wajib | Keterangan |
|-------|------|-------|------------|
| `username` | text | ✅ | Username pengguna |
| `password` | password | ✅ | Password pengguna |
| `remember` | checkbox | ❌ | Centang untuk remember me |

**Flow Login:**
```
Pengguna → Input Username/Password → Validasi Form →
Cek Kredensial → Jika Valid → Regenerate Session →
Redirect ke /admin/dashboard
```

### 5.2 Logout

**URL:** `POST /logout`

User yang logout akan diarahkan kembali ke halaman login. Session di-invalidate untuk keamanan.

### 5.3 API Login (Mobile)

**URL:** `POST /api/login`

**Request Body:**
```json
{
  "username": "admin",
  "password": "password123"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Login berhasil.",
  "data": {
    "user": {
      "id": 1,
      "username": "admin",
      "name": "Administrator",
      "email": "admin@example.com",
      "role": "admin"
    },
    "token": "1|abcdefghijklmnopqrstuvwxyz",
    "token_type": "Bearer"
  }
}
```

**Response Gagal (401):**
```json
{
  "success": false,
  "message": "Username atau password salah."
}
```

> Token yang dihasilkan harus dikirim di header `Authorization: Bearer <token>` pada request berikutnya.

---

## 6. Modul Dashboard

### 6.1 Deskripsi

Halaman utama setelah login. Menampilkan ringkasan data dan statistik sistem.

**URL:** `/admin/dashboard`

### 6.2 Komponen Dashboard

#### Statistik Utama

| Widget | Menampilkan |
|--------|-------------|
| 🏚️ Total Bencana | Jumlah seluruh data bencana |
| �� Total Korban | Jumlah seluruh data korban |
| 🏥 Total Triase | Jumlah seluruh data triase |
| 🏨 Total Rumah Sakit | Jumlah seluruh data rumah sakit |
| 💉 Total Pemeriksaan | Jumlah seluruh data pemeriksaan |
| 🔄 Total Rujukan | Jumlah seluruh data rujukan |
| 👤 Total Users | Jumlah user terdaftar |

#### Recent Bencana

Menampilkan **5 data bencana terbaru** berdasarkan `tanggal_kejadian` (descending).

#### Quick Actions

Tombol pintas untuk operasi yang sering dilakukan (tergantung implementasi view).

### 6.3 Kontrol Akses

- Hanya user yang sudah login (`auth` middleware) yang dapat mengakses dashboard.
- Redirect otomatis ke halaman login jika belum terautentikasi.

---

## 7. Modul Bencana

### 7.1 Deskripsi

Modul untuk mengelola data kejadian bencana. Setiap bencana menjadi induk dari data korban, triase, dan rujukan.

**URL Prefix:** `/admin/bencana`

### 7.2 Daftar Bencana (Index)

**URL:** `GET /admin/bencana`

**Fitur:**
- **Pencarian** berdasarkan `nama_bencana` atau `lokasi`
- **Filter status:** `aktif` / `selesai`
- **Filter jenis:** `gempa`, `banjir`, `tsunami`, `kebakaran`, `longsor`, `puting_beliung`, `kekeringan`, `lainnya`
- **Pagination:** 10 data per halaman, diurutkan berdasarkan `tanggal_kejadian` (desc)

### 7.3 Tambah Bencana

**URL:** `GET /admin/bencana/create` → Tampilkan form
**URL:** `POST /admin/bencana` → Simpan data

**Field yang harus diisi:**

| Field | Tipe | Wajib | Keterangan |
|-------|------|-------|------------|
| `nama_bencana` | text | ✅ | Nama bencana |
| `jenis_bencana` | select | ✅ | Jenis bencana (dropdown) |
| `lokasi` | text | ✅ | Lokasi bencana |
| `tanggal_kejadian` | date | ✅ | Tanggal kejadian |
| `status` | radio | ✅ | `aktif` atau `selesai` |
| `keterangan` | textarea | ❌ | Deskripsi tambahan |

**Daftar Jenis Bencana:**
- Gempa Bumi
- Banjir
- Tsunami
- Kebakaran
- Longsor
- Puting Beliung
- Kekeringan
- Lainnya

### 7.4 Detail Bencana

**URL:** `GET /admin/bencana/{id}`

Menampilkan detail bencana termasuk data terkait.

### 7.5 Edit Bencana

**URL:** `GET /admin/bencana/{id}/edit`
**URL:** `PUT /admin/bencana/{id}`

Form sama dengan tambah bencana dengan data terisi.

### 7.6 Hapus Bencana

**URL:** `DELETE /admin/bencana/{id}`

> ⚠️ **Penting:** Bencana yang memiliki data korban terkait **tidak dapat dihapus** dan akan menampilkan pesan error.

---

## 8. Modul Korban

### 8.1 Deskripsi

Modul untuk mengelola data korban bencana. Setiap korban terikat pada satu bencana.

**URL Prefix:** `/admin/korban`

### 8.2 Daftar Korban (Index)

**URL:** `GET /admin/korban`

**Fitur:**
- **Pencarian** berdasarkan `nama` atau `lokasi_ditemukan`
- **Filter bencana:** dropdown bencana
- **Filter jenis kelamin:** `L` (Laki-laki) / `P` (Perempuan)
- **Filter status identitas:** `dikenal` / `tidak_dikenal`
- **Pagination:** 10 data per halaman
- **Eager loading:** `bencana`

### 8.3 Tambah Korban

**URL:** `GET /admin/korban/create`
**URL:** `POST /admin/korban`

**Field Form:**

| Field | Tipe | Wajib | Keterangan |
|-------|------|-------|------------|
| `bencana_id` | select | ✅ | Pilih bencana terkait |
| `nama` | text | ❌ | Nama korban (opsional, untuk korban tidak dikenal) |
| `jenis_kelamin` | select | ✅ | `L` atau `P` |
| `umur` | number | ❌ | 0-150 |
| `status_identitas` | select | ✅ | `dikenal` atau `tidak_dikenal` |
| `lokasi_ditemukan` | text | ❌ | Lokasi korban ditemukan |
| `tanggal_ditemukan` | date | ❌ | Tanggal ditemukan |
| `kondisi_awal` | text | ❌ | Kondisi awal korban |
| `foto` | text | ❌ | Path foto (max 255 karakter) |

> `user_id` otomatis terisi dari user yang sedang login (Auth::id()).

### 8.4 Edit & Hapus Korban

Sama dengan CRUD standar. Update melalui `PUT /admin/korban/{id}` dan hapus melalui `DELETE /admin/korban/{id}`.

### 8.5 Relasi

Setiap korban memiliki:
- **Bencana** (`belongsTo`)
- **Lokasi Korban** (`hasOne`) — koordinat GPS
- **Triase** (`hasMany`)
- **Pemeriksaan** (`hasMany`)
- **Rujukan** (`hasMany`)

---

## 9. Modul Triase

### 9.1 Deskripsi

Modul untuk klasifikasi korban berdasarkan tingkat prioritas penanganan medis (sistem START triage).

**URL Prefix:** `GET /admin/triase`

### 9.2 Kategori Triase

| Kategori | Warna | Label | Prioritas |
|----------|-------|-------|-----------|
| `merah` | 🔴 | Immediate | **Tinggi** - Perlu penanganan segera |
| `kuning` | 🟡 | Delayed | **Sedang** - Bisa ditunda |
| `hijau` | 🟢 | Walking Wounded | **Rendah** - Bisa jalan |
| `hitam` | ⚫ | Dead | Meninggal |

### 9.3 Daftar Triase

**URL:** `GET /admin/triase`

**Fitur:**
- **Pencarian** berdasarkan nama korban (relasi)
- **Filter kategori:** merah, kuning, hijau, hitam
- **Filter bencana:** berdasarkan `bencana_id` korban
- **Pagination:** 10 data per halaman
- Menampilkan relasi: `korban`, `user`

### 9.4 Tambah Triase

**URL:** `GET /admin/triase/create`
**URL:** `POST /admin/triase`

**Field Form:**

| Field | Tipe | Wajib | Keterangan |
|-------|------|-------|------------|
| `korban_id` | select | ✅ | Pilih korban (hanya korban yang belum punya triase) |
| `kategori` | select | ✅ | merah / kuning / hijau / hitam |
| `keterangan` | textarea | ❌ | Catatan triase (max 1000 karakter) |

> ⚠️ Hanya korban yang **belum memiliki triase** yang muncul di dropdown saat membuat triase baru.
> `user_id` otomatis terisi dari user yang sedang login.

### 9.5 Edit & Hapus Triase

Update melalui `PUT /admin/triase/{id}` dan hapus melalui `DELETE /admin/triase/{id}`.

---

## 10. Modul Pemeriksaan Medis

### 10.1 Deskripsi

Modul paling lengkap untuk pencatatan pemeriksaan medis korban. Mendukung formulir lengkap IGD.

**URL Prefix:** `/admin/pemeriksaan`

### 10.2 Field Form Pemeriksaan

#### Identitas Pasien

| Field | Tipe | Keterangan |
|-------|------|------------|
| `no_pasien` | string | Nomor rekam medis |
| `nama_pasien` | string | Nama pasien |
| `jenis_kelamin` | string | Jenis kelamin |
| `tanggal_lahir` | date | Tanggal lahir |
| `umur` | integer | Umur (0-150) |
| `alamat` | text | Alamat pasien |

#### Vital Sign

| Field | Tipe | Keterangan |
|-------|------|------------|
| `tekanan_darah` | string | Tekanan darah (mis. 120/80) |
| `nadi` | string | Denyut nadi per menit |
| `respirasi` | string | Pernapasan per menit |
| `suhu` | decimal | Suhu tubuh (°C) |
| `bb` | decimal | Berat badan (kg) |
| `tb` | decimal | Tinggi badan (cm) |

#### Nyeri & Alergi

| Field | Tipe | Keterangan |
|-------|------|------------|
| `nyeri` | string | Ada nyeri? |
| `skala_nyeri` | string | Skala nyeri (0-10) |
| `alergi` | string | Alergi yang dimiliki |

#### Pemeriksaan Psikiatri

| Field | Tipe | Keterangan |
|-------|------|------------|
| `pemeriksaan_psikiatri` | text | Catatan psikiatri |

#### Jenis Kejadian

| Field | Tipe | Keterangan |
|-------|------|------------|
| `jenis_bencana` | array (JSON) | Jenis bencana |
| `jenis_bencana_lainnya` | string | Keterangan jenis bencana lainnya |
| `jenis_cedera` | array (JSON) | Jenis cedera |
| `jenis_cedera_afiksia` | string | Keterangan jenis cedera afiksia |

#### Penemuan & Pelapor

| Field | Tipe | Keterangan |
|-------|------|------------|
| `tanggal_ditemukan` | date | Tanggal ditemukan |
| `jam_ditemukan` | time | Jam ditemukan |
| `lokasi_ditemukan` | string | Lokasi ditemukan |
| `penemu_nama` | string | Nama penemu |
| `penemu_umur` | integer | Umur penemu |
| `penemu_jenis_kelamin` | string | Jenis kelamin penemu |
| `penemu_alamat` | text | Alamat penemu |
| `penemu_telp` | string | Telepon penemu |

#### Primary Survey (ABCDE)

| Field | Tipe | Keterangan |
|-------|------|------------|
| `pupil` | string | Kondisi pupil |
| `reflek_cahaya` | string | Reflek cahaya |
| `airway` | array (JSON) | Airway |
| `breathing` | array (JSON) | Breathing |
| `circulation` | array (JSON) | Circulation |
| `disability` | array (JSON) | Disability |
| `eksposure` | array (JSON) | Exposure |
| `prehospital` | array (JSON) | Tindakan prehospital |

#### Kondisi (Triase)

| Field | Tipe | Keterangan |
|-------|------|------------|
| `kondisi` | string | Kondisi/kategori triase |

#### Anamnesis & Terapi

| Field | Tipe | Keterangan |
|-------|------|------------|
| `keluhan` | text | Keluhan utama |
| `anamnesis` | text | Hasil anamnesis |
| `diagnosa_awal` | text | Diagnosis awal |
| `tindakan` | text | Tindakan yang dilakukan |
| `terapi` | text | Terapi yang diberikan |

#### Tindakan Lanjutan

| Field | Tipe | Keterangan |
|-------|------|------------|
| `tindakan_lanjutan` | string | Tindakan lanjutan |
| `dipulangkan_status` | array (JSON) | Status dipulangkan |
| `tanggal_meninggal` | date | Tanggal meninggal |
| `jam_meninggal` | time | Jam meninggal |
| `dirujuk_ke` | string | Dirujuk ke mana |
| `nama_pengantar` | string | Nama pengantar |
| `transportasi` | string | Jenis transportasi |

#### Petugas

| Field | Tipe | Keterangan |
|-------|------|------------|
| `petugas_nama` | string | Nama petugas medis |

> 📌 **Catatan Penting:** Field dengan tipe **array (JSON)** akan otomatis dikonversi ke format JSON saat disimpan. Contoh field: `airway`, `breathing`, `circulation`, `disability`, `eksposure`, `prehospital`, `dipulangkan_status`, `jenis_bencana`, `jenis_cedera`.

### 10.3 Daftar Pemeriksaan

**URL:** `GET /admin/pemeriksaan`

Menampilkan semua data pemeriksaan dengan relasi `korban` dan `user`.

---

## 11. Modul Rujukan

### 11.1 Deskripsi

Modul untuk mencatat proses rujukan korban dari lokasi bencana ke rumah sakit tujuan.

**URL Prefix:** `/admin/rujukan`

### 11.2 Status Rujukan

| Status | Keterangan |
|--------|------------|
| `dirujuk` | Sedang dalam proses rujukan |
| `diterima` | Sudah diterima rumah sakit |
| `selesai` | Proses rujukan selesai |

### 11.3 Field Form Rujukan

| Field | Tipe | Wajib | Keterangan |
|-------|------|-------|------------|
| `korban_id` | select | ✅ | Pilih korban |
| `rumah_sakit_id` | select | ✅ | Pilih rumah sakit tujuan |
| `status` | select | ✅ | `dirujuk` / `diterima` / `selesai` |
| `waktu_rujuk` | datetime | ❌ | Waktu rujukan |
| `catatan` | textarea | ❌ | Catatan tambahan |

> `user_id` otomatis terisi dari user yang sedang login.

### 11.4 Daftar Rujukan

**URL:** `GET /admin/rujukan`

**Fitur:**
- **Pencarian** berdasarkan nama korban
- **Filter status:** dirujuk, diterima, selesai
- **Pagination:** 10 data per halaman
- Menampilkan relasi: `korban`, `rumahSakit`

---

## 12. Modul Rumah Sakit

### 12.1 Deskripsi

Modul untuk mengelola data rumah sakit yang menjadi tujuan rujukan.

**URL Prefix:** `/admin/rumahsakit`

### 12.2 Field Form Rumah Sakit

| Field | Tipe | Wajib | Keterangan |
|-------|------|-------|------------|
| `nama` | string | ✅ | Nama rumah sakit |
| `alamat` | text | ✅ | Alamat lengkap |
| `no_hp` | string | ❌ | Nomor telepon (max 20) |
| `latitude` | numeric | ❌ | Koordinat latitude (-90 s/d 90) |
| `longitude` | numeric | ❌ | Koordinat longitude (-180 s/d 180) |
| `kapasitas_igd` | integer | ❌ | Kapasitas IGD (>= 0) |

### 12.3 Fitur

- **Pencarian** berdasarkan `nama` atau `alamat`
- **Pagination:** 10 data per halaman
- Mendukung fitur geolokasi (latitude & longitude) untuk cari rumah sakit terdekat via API

### 12.4 Route Key

Model `RumahSakit` menggunakan `id` sebagai route key untuk implicit model binding.

---

## 13. Modul User Management

### 13.1 Deskripsi

Modul untuk mengelola pengguna sistem. Hanya **admin** yang dapat mengakses modul ini.

**URL Prefix:** `/admin/users`

### 13.2 Role yang Tersedia

| Role | Hak Akses |
|------|-----------|
| `admin` | Full akses seluruh modul |
| `petugas` | Akses terbatas input data |
| `relawan` | Akses terbatas untuk melihat data |
| `medis` | Akses ke modul medis |

### 13.3 Field Form User

| Field | Tipe | Wajib | Validasi |
|-------|------|-------|----------|
| `name` | text | ✅ | string, max 255 |
| `username` | text | ✅ | unique, max 255 |
| `email` | email | ✅ | unique, valid email |
| `role` | select | ✅ | `admin`/`petugas`/`relawan`/`medis` |
| `password` | password | ✅* | min 8, konfirmasi |
| `password_confirmation` | password | ✅* | Harus sama dengan password |

> *Pada edit user, password **opsional** (tidak wajib diubah).

### 13.4 Keamanan

- Password di-hash menggunakan **bcrypt** sebelum disimpan.
- Validasi **CSRF** pada semua form.
- User **tidak dapat menghapus akun sendiri** (dengan pesan error).

---

## 14. Modul Laporan

### 14.1 Deskripsi

Modul untuk mencetak laporan dalam format PDF dan melihat laporan dalam bentuk tabel.

**URL Prefix:** `/admin/laporan`

### 14.2 Halaman Index Laporan

**URL:** `GET /admin/laporan`

Berisi menu navigasi ke seluruh sub-laporan.

### 14.3 Jenis Laporan

| Laporan | URL | Filter |
|---------|-----|--------|
| 📋 **Bencana** | `/admin/laporan/bencana` | Tanggal / Bulan-Tahun |
| 👥 **Korban** | `/admin/laporan/korban` | Tanggal / Bulan-Tahun |
| 🏥 **Triase** | `/admin/laporan/triase` | Tanggal / Bulan-Tahun |
| 💉 **Pemeriksaan** | `/admin/laporan/pemeriksaan` | Tanggal / Bulan-Tahun |
| 🔄 **Rujukan** | `/admin/laporan/rujukan` | Tanggal / Bulan-Tahun |
| 🏨 **Rumah Sakit** | `/admin/laporan/rumahsakit` | (Tanpa filter tanggal) |

### 14.4 Filter Laporan

Setiap laporan (kecuali Rumah Sakit) mendukung dua mode filter:

#### Mode Rentang Tanggal
```
?tanggal_mulai=2025-01-01&tanggal_selesai=2025-01-31
```

#### Mode Bulan & Tahun
```
?bulan=1&tahun=2025
```

#### Mode Default
```
(Tanpa parameter) → Menampilkan semua data
```

### 14.5 Export PDF

Untuk mengexport PDF, tambahkan parameter `export=pdf`:

```
/admin/laporan/bencana?export=pdf&bulan=1&tahun=2025
```

**Konfigurasi PDF:**
- **Ukuran kertas:** Legal (8.5" x 14")
- **Orientasi:** Landscape
- **Margin:** Top: 20pt, Left/Right: 20pt
- **Library:** `barryvdh/laravel-dompdf`
- **Header PDF:** Tanggal cetak (`tanggalCetak`) dan rentang tanggal

### 14.6 Implementasi Teknis

```php
// Contoh: Filter tanggal
$query->whereBetween('tanggal_kejadian', [
    Carbon::parse($tanggalMulai)->startOfDay(),
    Carbon::parse($tanggalSelesai)->endOfDay()
]);

// Filter bulan & tahun
$query->whereMonth('tanggal_kejadian', $bulan)
      ->whereYear('tanggal_kejadian', $tahun);
```

---

## 15. Modul API Documentation

### 15.1 Deskripsi

Halaman dokumentasi API yang dapat diakses oleh user dari dalam panel admin. Berguna untuk referensi developer yang ingin mengintegrasikan dengan API.

**URL:** `/admin/api-docs`

### 15.2 Konten

Halaman ini menampilkan:
- Daftar endpoint API
- HTTP Method (GET, POST, PUT, DELETE)
- Deskripsi endpoint
- Parameter yang dibutuhkan beserta tipe datanya

---

## 16. API Reference

### 16.1 Base URL

```
http://localhost:8000/api
```

### 16.2 Autentikasi

API menggunakan **Laravel Sanctum** dengan token Bearer.

**Header Wajib:**
```
Authorization: Bearer <token>
Accept: application/json
Content-Type: application/json
```

### 16.3 Endpoint Autentikasi

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| POST | `/api/login` | Login (public) |
| POST | `/api/logout` | Logout & hapus token |
| GET | `/api/user` | Ambil data user saat ini |

### 16.4 Endpoint Bencana

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/bencana` | List bencana (dengan pagination) |
| POST | `/api/bencana` | Tambah bencana baru |
| GET | `/api/bencana/{id}` | Detail bencana |
| PUT | `/api/bencana/{id}` | Update bencana |
| DELETE | `/api/bencana/{id}` | Hapus bencana |

### 16.5 Endpoint Korban

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/korban` | List korban |
| GET | `/api/korban/by-user` | List korban by user login |
| POST | `/api/korban` | Tambah korban baru |
| GET | `/api/korban/{id}` | Detail korban |
| PUT | `/api/korban/{id}` | Update korban |
| DELETE | `/api/korban/{id}` | Hapus korban |

### 16.6 Endpoint Triase

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/triase` | List triase |
| GET | `/api/triase/by-user` | List triase by user login |
| POST | `/api/triase` | Tambah triase baru |
| GET | `/api/triase/{id}` | Detail triase |
| PUT | `/api/triase/{id}` | Update triase |
| DELETE | `/api/triase/{id}` | Hapus triase |

### 16.7 Endpoint Pemeriksaan

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/pemeriksaan` | List pemeriksaan |
| GET | `/api/pemeriksaan/by-user` | List pemeriksaan by user login |
| POST | `/api/pemeriksaan` | Tambah pemeriksaan baru |
| GET | `/api/pemeriksaan/{id}` | Detail pemeriksaan |
| PUT | `/api/pemeriksaan/{id}` | Update pemeriksaan |
| DELETE | `/api/pemeriksaan/{id}` | Hapus pemeriksaan |

### 16.8 Endpoint Rujukan

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/rujukan` | List rujukan |
| GET | `/api/rujukan/by-user` | List rujukan by user login |
| POST | `/api/rujukan` | Tambah rujukan baru |
| GET | `/api/rujukan/{id}` | Detail rujukan |
| PUT | `/api/rujukan/{id}` | Update rujukan |
| DELETE | `/api/rujukan/{id}` | Hapus rujukan |

### 16.9 Endpoint Rumah Sakit

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/rumah-sakit` | List rumah sakit |
| GET | `/api/rumah-sakit/nearby` | Cari RS terdekat (berdasarkan koordinat) |
| POST | `/api/rumah-sakit` | Tambah rumah sakit |
| GET | `/api/rumah-sakit/{id}` | Detail rumah sakit |
| PUT | `/api/rumah-sakit/{id}` | Update rumah sakit |
| DELETE | `/api/rumah-sakit/{id}` | Hapus rumah sakit |

### 16.10 Contoh Penggunaan API

#### Login (cURL)

```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"username":"admin","password":"password123"}'
```

#### Tambah Korban

```bash
curl -X POST http://localhost:8000/api/korban \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{
    "bencana_id": 1,
    "nama": "John Doe",
    "jenis_kelamin": "L",
    "umur": 30,
    "status_identitas": "dikenal",
    "lokasi_ditemukan": "Kp. Sukamaju"
  }'
```

#### Cari Rumah Sakit Terdekat

```bash
curl -X GET "http://localhost:8000/api/rumah-sakit/nearby?latitude=-6.2&longitude=106.8&radius=20" \
  -H "Authorization: Bearer <token>"
```

> Menggunkan **Haversine Formula** untuk menghitung jarak.

---

## 17. Database Schema

### 17.1 Daftar Tabel

| No | Tabel | Deskripsi |
|----|-------|-----------|
| 1 | `users` | Data pengguna sistem |
| 2 | `bencana` | Data kejadian bencana |
| 3 | `korban` | Data korban bencana |
| 4 | `lokasi_korban` | Koordinat GPS korban |
| 5 | `triase` | Data triase/klasifikasi korban |
| 6 | `pemeriksaan` | Data pemeriksaan medis |
| 7 | `rumah_sakit` | Data rumah sakit |
| 8 | `rujukan` | Data rujukan korban |
| 9 | `log_aktivitas` | Log aktivitas user |
| 10 | `personal_access_tokens` | Token API (Sanctum) |
| 11 | `cache`, `cache_locks` | Cache Laravel |
| 12 | `jobs`, `job_batches`, `failed_jobs` | Queue Laravel |
| 13 | `password_reset_tokens`, `sessions` | Reset password & session |

### 17.2 Skema Tabel Utama

#### `users`

| Field | Tipe | Constraint |
|-------|------|------------|
| id | bigint | PK, auto_increment |
| name | varchar(255) | |
| username | varchar(255) | unique |
| email | varchar(255) | unique |
| role | enum | admin/petugas/relawan/medis, default 'admin' |
| email_verified_at | timestamp | nullable |
| password | varchar(255) | hashed (bcrypt) |
| remember_token | varchar(100) | nullable |
| created_at, updated_at | timestamp | |

#### `bencana`

| Field | Tipe | Constraint |
|-------|------|------------|
| id | bigint | PK |
| nama_bencana | varchar(255) | |
| jenis_bencana | enum | gempa/banjir/tsunami/kebakaran/longsor/puting_beliung/kekeringan/lainnya |
| lokasi | text | |
| tanggal_kejadian | date | |
| status | enum | aktif/selesai, default 'aktif' |
| keterangan | text | nullable |
| created_at, updated_at | timestamp | |

#### `korban`

| Field | Tipe | Constraint |
|-------|------|------------|
| id | bigint | PK |
| bencana_id | bigint | FK → bencana.id |
| nama | varchar(255) | nullable |
| jenis_kelamin | enum | L/P |
| umur | integer | nullable, 0-150 |
| status_identitas | enum | dikenal/tidak_dikenal |
| lokasi_ditemukan | text | nullable |
| tanggal_ditemukan | date | nullable |
| kondisi_awal | text | nullable |
| foto | varchar(255) | nullable |
| user_id | bigint | FK → users.id |
| created_at, updated_at | timestamp | |

#### `triase`

| Field | Tipe | Constraint |
|-------|------|------------|
| id | bigint | PK |
| korban_id | bigint | FK → korban.id |
| kategori | enum | merah/kuning/hijau/hitam |
| keterangan | varchar(1000) | nullable |
| user_id | bigint | FK → users.id |
| created_at, updated_at | timestamp | |

#### `pemeriksaan`

Berisi banyak field medis (lihat bagian **Modul Pemeriksaan Medis** untuk detail lengkap).
Field multi-value disimpan sebagai JSON (`airway`, `breathing`, `circulation`, dll).

#### `rumah_sakit`

| Field | Tipe | Constraint |
|-------|------|------------|
| id | bigint | PK |
| nama | varchar(255) | |
| alamat | text | |
| no_hp | varchar(20) | nullable |
| latitude | double | nullable, -90 s/d 90 |
| longitude | double | nullable, -180 s/d 180 |
| kapasitas_igd | integer | nullable, >= 0 |
| created_at, updated_at | timestamp | |

#### `rujukan`

| Field | Tipe | Constraint |
|-------|------|------------|
| id | bigint | PK |
| korban_id | bigint | FK → korban.id |
| rumah_sakit_id | bigint | FK → rumah_sakit.id |
| status | enum | dirujuk/diterima/selesai |
| waktu_rujuk | datetime | nullable |
| catatan | text | nullable |
| user_id | bigint | FK → users.id |
| created_at, updated_at | timestamp | |

#### `lokasi_korban`

| Field | Tipe | Constraint |
|-------|------|------------|
| id | bigint | PK |
| korban_id | bigint | FK → korban.id (1:1) |
| latitude | double | |
| longitude | double | |
| created_at, updated_at | timestamp | |

#### `log_aktivitas`

| Field | Tipe | Constraint |
|-------|------|------------|
| id | bigint | PK |
| user_id | bigint | FK → users.id |
| aktivitas | text | |
| waktu | datetime | |
| created_at, updated_at | timestamp | |

### 17.3 Diagram Relasi

```
users ─┬──< log_aktivitas
       ├──< korban (user_id) ────< lokasi_korban
       ├──< triase (user_id)
       ├──< pemeriksaan (user_id)
       └──< rujukan (user_id)

bencana ──< korban ──┬──< triase
                    ├──< pemeriksaan
                    └──< rujukan >── rumah_sakit
```

---

## 18. Roles & Permissions

### 18.1 Daftar Role

| Role | Tipe Akun | Hak Akses |
|------|-----------|-----------|
| **admin** | Administrator | Akses penuh ke seluruh modul |
| **medis** | Tenaga medis | Modul pemeriksaan, triase, korban |
| **petugas** | Petugas lapangan | Modul bencana, korban, triase |
| **relawan** | Relawan | View only |

### 18.2 Implementasi

Role disimpan di kolom `role` tabel `users` bertipe ENUM. Saat ini sistem menggunakan **middleware `auth`** untuk seluruh halaman admin (tidak ada role-based middleware khusus). Pengaturan role lebih lanjut dapat ditambahkan dengan:

```php
// Contoh middleware role (custom)
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Rute khusus admin
});
```

---

## 19. Panduan Troubleshooting

### 19.1 Error Umum

#### ❌ `SQLSTATE[HY000] [2002] Connection refused`

**Penyebab:** Database MySQL tidak berjalan atau konfigurasi salah.

**Solusi:**
```bash
# Cek service MySQL
sudo service mysql status

# Perbaiki konfigurasi di .env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appbencana
```

#### ❌ `Class "PDF" not found`

**Penyebab:** Package `barryvdh/laravel-dompdf` belum diinstall atau autoload belum di-refresh.

**Solusi:**
```bash
composer require barryvdh/laravel-dompdf
composer dump-autoload
```

#### ❌ `The token has expired` atau `Unauthenticated`

**Penyebab:** Token Sanctum sudah tidak valid.

**Solusi:**
- Login ulang untuk mendapatkan token baru.
- Pastikan token dikirim di header `Authorization: Bearer <token>`.

#### ❌ `403 Forbidden` saat akses admin

**Penyebab:** Session habis atau tidak login.

**Solusi:** Login ulang melalui `/`.

#### ❌ Halaman blank saat install

**Solusi:**
```bash
php artisan key:generate
php artisan config:clear
php artisan cache:clear
npm run build
```

### 19.2 Cache & Optimization

```bash
# Clear semua cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 19.3 Log Aplikasi

Lokasi log: `storage/logs/laravel.log`

```bash
# Tail log secara real-time
php artisan pail --timeout=0
```

---

## 20. FAQ

### Q1: Bagaimana cara membuat user admin pertama?

**A:** Jalankan query berikut di database setelah migrasi:

```sql
INSERT INTO users (name, username, email, role, password, created_at, updated_at)
VALUES (
  'Administrator',
  'admin',
  'admin@example.com',
  'admin',
  '$2y$12$...', -- hash bcrypt
  NOW(),
  NOW()
);
```

Atau gunakan Tinker:

```bash
php artisan tinker
> User::create([
    'name' => 'Admin',
    'username' => 'admin',
    'email' => 'admin@example.com',
    'role' => 'admin',
    'password' => bcrypt('password')
  ]);
```

### Q2: Mengapa bencana saya tidak bisa dihapus?

**A:** Bencana yang memiliki data korban terkait tidak dapat dihapus. Hapus dulu data korban atau pindahkan ke bencana lain.

### Q3: Apa itu Token Sanctum dan bagaimana cara kerjanya?

**A:** Sanctum adalah package Laravel untuk autentikasi API ringan. Setiap user yang login akan mendapat token yang dikirim di header request.

### Q4: Bagaimana cara mengubah ukuran kertas PDF?

**A:** Edit method export di `LaporanController.php`:

```php
$pdf->setPaper('a4', 'portrait'); // atau 'legal', 'letter'
```

### Q5: Apakah saya bisa menambah field baru di pemeriksaan?

**A:** Ya. Anda perlu:
1. Tambah kolom di migration baru
2. Tambahkan ke `$fillable` di Model `Pemeriksaan`
3. Tambahkan validasi di `PemeriksaanController`
4. Tambahkan input field di view `admin.pemeriksaan.create`

### Q6: Bagaimana cara kerja filter rumah sakit terdekat?

**A:** API menggunakan **Haversine Formula** untuk menghitung jarak antara koordinat user dengan koordinat rumah sakit, kemudian mengurutkan dari yang terdekat.

### Q7: Apakah aplikasi ini mendukung multi-bahasa?

**A:** Bahasa default adalah English (`en`). Untuk multi-bahasa, Laravel sudah mendukung localization melalui file di `lang/`.

---

## Lampiran

### A. Daftar Perintah Artisan Berguna

```bash
# Melihat semua route
php artisan route:list

# Melihat semua migration
php artisan migrate:status

# Rollback migration terakhir
php artisan migrate:rollback

# Membuat user baru via tinker
php artisan tinker

# Melihat konfigurasi saat ini
php artisan config:show
```

### B. Format Response API Standar

#### Success Response

```json
{
  "success": true,
  "message": "Pesan sukses",
  "data": { /* payload */ }
}
```

#### Error Response (umum)

```json
{
  "success": false,
  "message": "Pesan error"
}
```

#### Validation Error (422)

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "field_name": ["Pesan error untuk field ini"]
  }
}
```

### C. HTTP Status Code yang Digunakan

| Code | Keterangan |
|------|------------|
| 200 | OK - Request berhasil |
| 201 | Created - Resource berhasil dibuat |
| 400 | Bad Request - Request tidak valid |
| 401 | Unauthorized - Autentikasi gagal |
| 403 | Forbidden - Tidak diizinkan |
| 404 | Not Found - Resource tidak ditemukan |
| 422 | Unprocessable Entity - Validasi gagal |
| 500 | Internal Server Error |

### D. Kontak & Dukungan

Untuk bantuan teknis, hubungi administrator sistem atau buat issue di repository.

---

**Versi Dokumen:** 1.0  
**Tanggal:** September 2026  
**Framework:** Laravel 13  
**Lisensi:** MIT

---

> **Catatan Akhir:** Manual book ini disusun berdasarkan analisis kode sumber aplikasi AppBencana. Beberapa fitur dapat berubah seiring pengembangan aplikasi. Selalu rujuk ke dokumentasi teknis terbaru dan kode sumber untuk informasi paling mutakhir.
