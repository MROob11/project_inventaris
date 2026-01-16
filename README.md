# MukhtarInventory - Sistem Manajemen Inventaris

Aplikasi manajemen inventaris barang berbasis PHP & MySQL, dirancang dengan tampilan modern dan responsif untuk mobile & desktop.

## Fitur Utama

- **CRUD Inventaris**: Tambah, Edit, Hapus, dan Lihat daftar barang.
- **Pencarian Real-time**: Cari barang berdasarkan nama atau deskripsi.
- **Dashboard Overview**: Ringkasan total aset, jumlah produk, dan peringatan stok rendah.
- **Atomic Updates**: Mencegah konflik data saat update stok bersamaan.
- **Responsive UI**: Tampilan optimal di HP dan Laptop.

## Tautan File Penting

- `index.php`: Halaman Dashboard.
- `list_barang.php`: Halaman daftar invetaris.
- `db_connect.php`: Konfigurasi Database.

## Cara Instalasi / Hosting

### 1. Persiapan Database

1. Buat database baru di phpMyAdmin atau cPanel dengan nama `db_inventaris` (atau nama lain yang Anda inginkan).
2. Import file `database.sql` (jika ada) atau jalankan query berikut untuk membuat tabel:

```sql
CREATE TABLE IF NOT EXISTS Tb_Barang (
    Id_barang INT AUTO_INCREMENT PRIMARY KEY,
    Nama_barang VARCHAR(100) NOT NULL,
    Deskripsi_barang TEXT,
    Harga_barang DECIMAL(10,2) NOT NULL,
    Stok_barang INT NOT NULL,
    Last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 2. Konfigurasi Koneksi

Buka file `db_connect.php` dan sesuaikan pengaturan database Anda:

```php
$host = 'localhost';      // Biasanya localhost
$dbname = 'db_inventaris'; // Nama database Anda
$username = 'root';        // Username database hosting Anda
$password = '';            // Password database hosting Anda
```

### 3. Upload File

Upload semua file PHP dan CSS ke folder `public_html` atau direktori web server Anda.

---

Dikembangkan oleh **MukhtarAdmin** untuk Tugas UAS Pemrograman Web.
