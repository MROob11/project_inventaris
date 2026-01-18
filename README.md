# BilliardPro Inventory System (Project UAS)

Aplikasi manajemen inventaris barang berbasis PHP & MySQL, dirancang dengan tampilan modern, responsif, dan mudah digunakan. Project ini dibuat untuk memenuhi tugas UAS Pemrograman Web.

## 📸 Fitur Utama

- **Dashboard Informatif**: Ringkasan total aset, jumlah produk, dan peringatan dini stok menipis (Low Stock Alert).
- **Manajemen Inventaris (CRUD)**:
  - **Create**: Tambah barang baru dengan mudah.
  - **Read**: Lihat daftar barang dengan tabel yang rapi.
  - **Update**: Edit data barang termasuk stok dan harga.
  - **Delete**: Hapus barang yang tidak diperlukan.
- **Pencarian Real-time**: Cari barang berdasarkan nama atau kategori.
- **Atomic Updates**: Mencegah konflik data saat stok diupdate secara bersamaan.
- **Responsive Design**: Tampilan yang menyesuaikan otomatis di HP, Tablet, dan Laptop.

## 🛠️ Teknologi yang Digunakan

- **Backend**: Native PHP (PDO Driver)
- **Database**: MySQL / MariaDB
- **Frontend**: HTML5, Modern CSS Variables (Tanpa Framework CSS berat)
- **Font**: Google Fonts (Inter)

## 📂 Struktur Folder
Pastikan nama folder project Anda adalah `project_UAS_inventaris`.

```
project_UAS_inventaris/
├── db_connect.php     # Konfigurasi koneksi database
├── index.php          # Halaman Dashboard Utama
├── list_barang.php    # Halaman Daftar Barang
├── form_edit.php      # Form Edit Barang
├── form_tambah.php    # Form Tambah Barang
├── proses_tambah.php  # Logic PHP tambah barang
├── proses_delete.php  # Logic PHP hapus barang
├── proses_update.php  # Logic PHP update barang
├── style.css          # Styling utama
├── database.sql       # File export database
└── README.md          # Dokumentasi ini
```

## 🚀 Cara Instalasi

### 1. Persiapan Folder
1. Pastikan folder project ini bernama `project_UAS_inventaris`.
2. Simpan di dalam folder htdocs XAMPP: `C:\xampp\htdocs\project_UAS_inventaris`.

### 2. Persiapan Database
1. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Buat database baru dengan nama `db_inventaris`.
3. Import file `database.sql` yang ada di folder ini ke dalam database tersebut.
4. Atau jalankan query SQL ini di tab SQL:

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

### 3. Konfigurasi Koneksi (Opsional)
Jika Anda menggunakan settingan default XAMPP, tidak perlu mengubah apa-apa.
Cek file `db_connect.php`:

```php
$host = 'localhost';
$dbname = 'db_inventaris';
$username = 'root';
$password = ''; // Kosongkan jika default XAMPP
```

### 4. Jalankan Aplikasi
Buka browser dan akses URL:
[http://localhost/project_UAS_inventaris/](http://localhost/project_UAS_inventaris/)
billiardpro.kesug.com

---
**Dikembangkan oleh Mukhtar**
_Sistem Informasi Inventaris BilliardPro_
