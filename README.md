# Pawon3D - Sistem Manajemen Toko Kue

Aplikasi manajemen toko kue berbasis web menggunakan Laravel 12 + Livewire 3.

## Requirements

-   PHP >= 8.2
-   MySQL >= 5.7 atau MariaDB >= 10.3
-   Composer
-   Node.js >= 18
-   NPM atau Yarn

## Tech Stack

-   **Backend:** Laravel 12
-   **Frontend:** Livewire 3 + Volt, Tailwind CSS 4, Alpine.js
-   **Database:** MySQL (default)
-   **PDF:** DomPDF
-   **Excel:** Maatwebsite Excel
-   **Testing:** Pest
-   **Queue:** Database (dapat diubah ke Redis/SQS)

## Installation

### 1. Clone Repository

```bash
git clone https://github.com/kyudyoz/pawon3d.git
cd pawon3d
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` sesuaikan database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pawon3d
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Database

```bash
php artisan migrate --seed
```

### 5. Link Storage

```bash
php artisan storage:link
```

### 6. Run Development Server

```bash
composer run dev
```

Atau manual (3 terminal terpisah):

```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Queue worker
php artisan queue:listen

# Terminal 3: Vite
npm run dev
```

Aplikasi dapat diakses di: `http://localhost:8000`

## Production Deployment

Lihat panduan lengkap di **[DEPLOYMENT.md](DEPLOYMENT.md)**

**Quick Setup:**

```bash
composer install --optimize-autoloader --no-dev
npm install && npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Features

-   ✅ Manajemen Produk & Kategori
-   ✅ Manajemen Bahan Baku (dengan sistem konversi satuan otomatis)
-   ✅ Manajemen Supplier
-   ✅ Transaksi Penjualan (POS)
-   ✅ Manajemen Produksi
-   ✅ Inventori & Stok
-   ✅ Perhitungan Harga Modal
-   ✅ Laporan Kasir, Produksi, Inventori (PDF & Excel)
-   ✅ Multi-user dengan Role & Permission
-   ✅ Notifikasi Real-time
-   ✅ Activity Logs

## Database

Project ini menggunakan **MySQL** sebagai database default (bukan SQLite).

Pastikan:

-   MySQL server sudah running
-   Database sudah dibuat
-   Kredensial di `.env` sudah benar

## Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=MaterialTest

# Run with coverage
php artisan test --coverage
```

## Queue Management

### Development

```bash
php artisan queue:work
```

### Production (Shared Hosting)

Gunakan `QUEUE_CONNECTION=sync` di `.env` atau setup cron job:

```bash
* * * * * cd /path/to/project && php artisan queue:work --stop-when-empty --max-time=50
```

## Troubleshooting

### Error: SQLite file not found

**Solusi:** Pastikan `.env` sudah ada dan `DB_CONNECTION=mysql` diset dengan benar. Jalankan:

```bash
php artisan config:clear
```

### Error: Max execution time exceeded

**Solusi:** Sudah dihandle di `.htaccess`. Jika masih error, hubungi provider hosting untuk naikkan `max_execution_time`.

### Error: Permission denied

**Solusi:**

```bash
chmod -R 775 storage bootstrap/cache
```

## License

Proprietary - Skripsi Project

## Support

Untuk bantuan deployment atau konfigurasi, baca dokumentasi lengkap di [DEPLOYMENT.md](DEPLOYMENT.md).
