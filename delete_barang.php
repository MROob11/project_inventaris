<?php
require_once 'db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("DELETE FROM Tb_Barang WHERE Id_barang = :id");
        $stmt->execute(['id' => $id]);

        header("Location: list_barang.php?status=deleted");
    } catch (PDOException $e) {
        header("Location: list_barang.php?status=error&msg=" . urlencode($e->getMessage()));
    }
} else {
    header("Location: list_barang.php?status=error&msg=Invalid Request");
}
?>