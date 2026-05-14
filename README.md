# Surat Kelurahan (Laravel 13 + Tailwind 4)

Aplikasi mini **buku surat kelurahan** dengan **CRUD** (buat, baca, ubah, hapus) dan antarmuka **Tailwind CSS** (via Vite).

## Prasyarat

- PHP **8.3+**
- [Composer](https://getcomposer.org/)
- Node.js **20+** dan npm

## Setup lokal

```bash
cd surat-kelurahan
composer install
cp .env.example .env          # macOS / Linux / Git Bash
# copy .env.example .env      # Windows CMD
# Copy-Item .env.example .env # Windows PowerShell
php artisan key:generate
```

Buat file database SQLite:

```bash
New-Item -ItemType File database\database.sqlite -Force   # PowerShell
```

Migrasi dan data contoh:

```bash
php artisan migrate
php artisan db:seed
```

Frontend:

```bash
npm install
npm run dev
```

Jalankan server (terminal terpisah):

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000` — akan diarahkan ke daftar surat.

## Ringkas fitur

- **Create / Read / Update / Delete** untuk entri surat (`surats`).
- Pencarian ringan di daftar (nomor / nama / jenis).
- Status surat: diajukan, diproses, selesai, ditolak.
