<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Access Denied");
}

$nama = trim($_POST['nama'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$harga = $_POST['harga'] ?? '';
$stok = $_POST['stok'] ?? '';

$errors = [];
if (empty($nama))
    $errors[] = "Name is required.";
if (!is_numeric($harga) || $harga < 0)
    $errors[] = "Invalid Price.";
if (!is_numeric($stok) || $stok < 0)
    $errors[] = "Invalid Stock.";

if (!empty($errors)) {
    $msg = implode(" ", $errors);
    header("Location: list_barang.php?status=error&msg=" . urlencode($msg));
    exit;
}

try {
    $sql = "INSERT INTO Tb_Barang (Nama_barang, Deskripsi_barang, Harga_barang, Stok_barang) 
            VALUES (:nama, :deskripsi, :harga, :stok)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nama' => $nama,
        'deskripsi' => $deskripsi,
        'harga' => $harga,
        'stok' => $stok
    ]);

    header("Location: list_barang.php?status=added");
} catch (PDOException $e) {
    header("Location: list_barang.php?status=error&msg=" . urlencode($e->getMessage()));
}
?>