# PKMB Hanuba — Sistem Informasi Akademik

Sistem Informasi Akademik berbasis web untuk **Pusat Kegiatan Belajar Masyarakat (PKBM) Hanuba**. Aplikasi ini dirancang untuk mengelola data akademik secara terpadu, mencakup manajemen siswa, guru, kelas, jadwal pelajaran, nilai, dan absensi.

---

## Fitur Utama

### 👤 Manajemen Pengguna
- Multi-role: **Admin** dan **Guru**
- Autentikasi bawaan Laravel

### 🎓 Panel Admin
- **Master Data**: Tingkat kelas, mata pelajaran, tahun akademik
- **Data Siswa**: Tambah, edit, dan hapus data siswa (NIS & NISN hanya angka)
- **Data Guru**: Tambah, edit, dan hapus data guru (NIP hanya angka), termasuk pembuatan akun otomatis
- **Kelas**: Buat dan kelola kelas per tahun akademik
- **Jadwal Pelajaran**: Atur jadwal mengajar per kelas dan guru
- **Registrasi Kelas**: Daftarkan siswa ke kelas tertentu
- **Rekap Nilai**: Pantau kelengkapan nilai per mata pelajaran
- **Absensi**: Validasi absensi yang diinput oleh guru

### 🏫 Panel Guru
- Lihat daftar kelas yang diajar
- Input dan edit nilai siswa (Tugas, UTS, UAS)
- Input dan edit absensi siswa per jadwal
- Rekap nilai mata pelajaran yang diajar

---

## Tech Stack

| Layer | Teknologi |
|---|---|
| **Backend** | PHP 8.2+, Laravel 12 |
| **Frontend** | Blade, Alpine.js |
| **Styling** | Tailwind CSS v4, DaisyUI v5 |
| **Build Tool** | Vite |
| **Database** | MySQL / SQLite |
| **Testing** | Pest PHP |

---

## Prasyarat

Pastikan sistem Anda sudah terpasang:

- PHP **>= 8.2**
- Composer
- Node.js & NPM
- MySQL (atau SQLite untuk pengembangan lokal)

---

## Instalasi & Setup

### 1. Clone Repository

```bash
git clone https://github.com/alfatihritonga/pkmb-hanuba.git
cd pkmb-hanuba
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Install Dependensi Node.js

```bash
npm install
```

### 4. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Kemudian generate application key:

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pkmb_hanuba
DB_USERNAME=root
DB_PASSWORD=
```

> **Catatan:** Untuk pengembangan lokal, Anda juga bisa menggunakan SQLite dengan mengubah `DB_CONNECTION=sqlite`.

### 6. Migrasi & Seeding Database

Jalankan migrasi untuk membuat semua tabel:

```bash
php artisan migrate
```

Isi database dengan data awal (opsional, untuk testing):

```bash
php artisan db:seed
```

Seeder akan membuat data berikut secara otomatis:
- Akun admin & guru default
- Tahun akademik, tingkat kelas, dan mata pelajaran
- Data siswa dan guru contoh
- Kelas, jadwal, dan registrasi siswa contoh

### 7. Build Aset Frontend

Untuk pengembangan (dengan hot-reload):

```bash
npm run dev
```

Untuk produksi:

```bash
npm run build
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`.

---

## Akun Default

Setelah menjalankan seeder, gunakan akun berikut untuk login:

| Role | Email | Password |
|---|---|---|
| Admin | `admin@example.com` | `password` |
| Guru | `guru@example.com` | `password` |

> **Penting:** Segera ganti password default setelah login pertama kali di lingkungan produksi.

---

## Menjalankan Semua Sekaligus (Dev Mode)

Anda bisa menjalankan server PHP, queue worker, dan Vite secara bersamaan dengan satu perintah:

```bash
composer run dev
```

---

## Struktur Direktori Utama

```
app/
├── Http/Controllers/
│   ├── Admin/      # Controller untuk panel admin
│   └── Guru/       # Controller untuk panel guru
├── Models/         # Eloquent models (Student, Teacher, Classroom, dll.)
database/
├── migrations/     # Skema tabel database
├── seeders/        # Data awal untuk testing
resources/
└── views/
    ├── admin/      # Tampilan panel admin
    └── guru/       # Tampilan panel guru
```

