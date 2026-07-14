# Setup Aplikasi Bengkel Motor (Laravel)

## 1. Copy semua file
Copy isi folder `app`, `database`, `resources`, `routes` dari paket ini ke folder project Laravel kamu
(`C:\laragon\www\Bengkel-Motor`), timpa/replace kalau ada folder yang sama.

## 2. Daftarkan middleware "admin"
Buka file `bootstrap/app.php` di project Laravel kamu. Cari bagian `->withMiddleware(function (Middleware $middleware) {`
lalu tambahkan baris `$middleware->alias([...])` di dalamnya, jadi seperti ini:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);
})
```

Kalau bagian `->withMiddleware(...)` belum ada di file itu, tambahkan sebelum `->create();` di bagian bawah file.

## 3. Pastikan .env sudah benar
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bengkel-motor
DB_USERNAME=root
DB_PASSWORD=
```

## 4. Jalankan migration + seeder
Buka terminal di folder project, jalankan:
```
php artisan migrate:fresh --seed
```
(pakai `migrate:fresh` biar tabel lama kehapus dulu kalau sempat ada, terus dibuat ulang + diisi data contoh)

## 5. Jalankan aplikasi
Buka `http://bengkel-motor.test` (via Laragon) atau `php artisan serve` lalu buka `http://127.0.0.1:8000`.

## Akun untuk login
- **Admin**: admin@bengkel.test / password
- **Customer**: customer@bengkel.test / password

## Alur testing yang disarankan
1. Login sebagai customer → tambah motor → booking servis
2. Logout, login sebagai admin → buka menu Booking → assign mekanik, tambah sparepart, ubah status jadi "Selesai"
3. Login lagi sebagai customer → cek status booking berubah & detail biaya
