<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Access Denied");
}

// 1. Get Data
$id = $_POST['id_barang'] ?? null;
$nama = trim($_POST['nama'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$harga = $_POST['harga'] ?? '';
$stok_baru = $_POST['stok'] ?? '';
$stok_lama_form = $_POST['stok_lama'] ?? 0;

// 2. Strict Validation
$errors = [];

if (empty($id) || !is_numeric($id))
    $errors[] = "Invalid ID.";
if (empty($nama))
    $errors[] = "Name is required.";
if (!is_numeric($harga) || $harga < 0)
    $errors[] = "Price must be a valid positive number.";
if (!ctype_digit(strval($stok_baru)) && !is_int($stok_baru + 0))
    $errors[] = "Stock must be a valid integer.";
if ($stok_baru < 0)
    $errors[] = "Stock cannot be negative.";

if (!empty($errors)) {
    $errorMsg = implode(" ", $errors);
    header("Location: list_barang.php?status=error&msg=" . urlencode($errorMsg));
    exit;
}

// 3. ATOMIC UPDATE LOGIC
// Calculate difference: Delta = New Form Value - Original From When Form Loaded
// DB Stock = DB Stock + Delta
$delta_stok = intval($stok_baru) - intval($stok_lama_form);

try {
    // We use a transaction for safety, though single query is atomic enough usually.
    $pdo->beginTransaction();

    $sql = "UPDATE Tb_Barang SET 
            Nama_barang = :nama, 
            Deskripsi_barang = :deskripsi, 
            Harga_barang = :harga, 
            Stok_barang = Stok_barang + :delta 
            WHERE Id_barang = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nama' => $nama,
        'deskripsi' => $deskripsi,
        'harga' => $harga,
        'delta' => $delta_stok,
        'id' => $id
    ]);

    $pdo->commit();
    header("Location: list_barang.php?status=sukses");

} catch (PDOException $e) {
    $pdo->rollBack();
    header("Location: list_barang.php?status=error&msg=" . urlencode("Database Error: " . $e->getMessage()));
}
?>