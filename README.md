# Project Toko

## Deskripsi
Project Toko adalah aplikasi web sederhana untuk manajemen toko online yang mencakup fitur produk, kategori produk, diskon, keranjang belanja, dan transaksi pembelian. Aplikasi ini menggunakan framework CodeIgniter 4 dan menyediakan antarmuka admin untuk mengelola data produk, kategori, diskon, serta memantau dan mengubah status pembelian.

## Fitur
- **Manajemen Produk:** Admin dapat menambah, mengedit, dan menghapus produk serta kategori produk.
- **Manajemen Diskon:** Admin dapat membuat dan mengelola diskon dengan tanggal unik dan nominal tertentu.
- **Keranjang Belanja:** Pengguna dapat menambahkan produk ke keranjang, mengedit jumlah, dan menghapus produk dari keranjang.
- **Transaksi Pembelian:** Pengguna dapat melakukan checkout dan menyelesaikan pembelian dengan perhitungan diskon otomatis.
- **Manajemen Pembelian:** Admin dapat melihat seluruh data pembelian dan mengubah status pesanan (Belum Selesai / Sudah Selesai).
- **Dashboard Sederhana:** Menampilkan data transaksi pembelian dengan jumlah item yang dibeli, menggunakan webservice dari aplikasi Toko.
- **Role-Based Access Control:** Fitur admin hanya dapat diakses oleh pengguna dengan role admin.
- **UI Responsif:** Menggunakan Bootstrap untuk tampilan yang responsif dan user-friendly.

## Instalasi
1. Clone repository ini ke direktori lokal Anda.
2. Pastikan Anda memiliki PHP dan Composer terinstal di sistem Anda.
3. Jalankan perintah berikut untuk menginstal dependensi:
   ```
   composer install
   ```
4. Konfigurasikan database pada file `app/Config/Database.php`.
5. Jalankan migrasi dan seeder untuk membuat tabel dan data awal:
   ```
   php spark migrate
   php spark db:seed DiskonSeeder
   ```
6. Jalankan server development:
   ```
   php spark serve
   ```
7. Akses aplikasi melalui browser di alamat `http://localhost:8080`.

## Struktur Proyek
- `app/Controllers/` : Berisi controller aplikasi seperti `DiskonController`, `PembelianController`, `TransaksiController`, dll.
- `app/Models/` : Berisi model untuk berinteraksi dengan database, seperti `DiskonModel`, `TransactionModel`, dll.
- `app/Database/Migrations/` : Berisi file migrasi untuk membuat dan mengubah struktur tabel database.
- `app/Database/Seeds/` : Berisi file seeder untuk mengisi data awal ke database.
- `app/Views/` : Berisi file view untuk tampilan frontend dan backend.
- `app/Config/Routes.php` : Konfigurasi routing aplikasi.
- `public/` : Folder publik yang berisi file index.php dan aset frontend.
- `public/dashboard-toko/` : Folder aplikasi Dashboard sederhana yang menampilkan data transaksi pembelian menggunakan webservice dari aplikasi Toko.

## Catatan
- Pastikan webservice API pada aplikasi Toko berjalan dengan baik agar Dashboard dapat menampilkan data transaksi dengan benar.
- Role admin diperlukan untuk mengakses fitur manajemen produk, diskon, dan pembelian.
- Fitur diskon otomatis diterapkan pada saat penambahan produk ke keranjang dan saat checkout.
