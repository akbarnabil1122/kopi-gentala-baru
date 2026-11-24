# Kopi Gentala

Aplikasi berbasis web untuk mendukung pengelolaan dan penjualan produk Kopi Gentala.

## Teknologi yang Digunakan

- Laravel
- PHP
- MySQL
- HTML, CSS, JavaScript
- Bootstrap

## Persyaratan Sistem

Pastikan perangkat sudah memiliki:
- PHP sesuai versi yang dibutuhkan project
- Composer
- MySQL
- Node.js dan NPM
- Git

## Cara Instalasi

### 1. Clone Repository

```bash
git clone URL_REPOSITORY_GITHUB
```

Masuk ke folder project:

```bash
cd kopi-gentala
```

### 2. Install Dependency

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`.

Windows CMD:

```cmd
copy .env.example .env
```

Kemudian sesuaikan konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kopi_gentala
DB_USERNAME=root
DB_PASSWORD=
```

Buat database dengan nama `kopi_gentala` melalui phpMyAdmin atau MySQL.

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Migrasi Database

```bash
php artisan migrate --seed
```

Perintah ini membuat tabel database dan menjalankan data awal yang telah disediakan oleh Seeder.

### 6. Build Frontend

```bash
npm run build
```

### 7. Jalankan Aplikasi

```bash
php artisan serve
```

Buka browser:

http://127.0.0.1:8000

## Catatan

- Pastikan MySQL sudah aktif sebelum menjalankan aplikasi.
- Jangan mengunggah file `.env` ke repository.
- Pastikan seluruh migration dan seeder tersedia sebelum menjalankan migrasi.
