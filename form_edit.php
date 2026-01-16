<?php
require_once 'db_connect.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: list_barang.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM Tb_Barang WHERE Id_barang = :id");
$stmt->execute(['id' => $id]);
$item = $stmt->fetch();

if (!$item)
    die("Item not found");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item | ArthurAdmin</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand">
                <span
                    style="background:var(--text-primary); color:white; padding:4px 8px; border-radius:6px; font-size: 0.9em;">A</span>
                ArthurInventory
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="index.php"><span>Dashboard</span></a></li>
                <li class="nav-item"><a href="list_barang.php"><span>All Inventory</span></a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div>
                    <h1 class="page-title">Edit Product</h1>
                    <p style="color: var(--text-secondary); font-size: 0.95rem;">
                        Updating ID #<?= $item['Id_barang'] ?>:
                        <strong><?= htmlspecialchars($item['Nama_barang']) ?></strong>
                    </p>
                </div>
            </header>

            <div style="max-width: 900px; margin: 0 auto;">
                <form action="proses_update.php" method="POST" class="stat-card">
                    <input type="hidden" name="id_barang" value="<?= $item['Id_barang'] ?>">
                    <input type="hidden" name="stok_lama" value="<?= $item['Stok_barang'] ?>">

                    <div style="display:grid; grid-template-columns: 2fr 1fr; gap:2.5rem;">

                        <!-- Left: Main Info -->
                        <div>
                            <h3 style="font-size:1.1rem; font-weight:600; margin-bottom:1.5rem;">Product Details</h3>

                            <div style="margin-bottom: 1.5rem;">
                                <label
                                    style="display:block; margin-bottom:0.5rem; font-weight:500; color:var(--text-primary);">Product
                                    Name</label>
                                <input type="text" name="nama" class="form-input"
                                    value="<?= htmlspecialchars($item['Nama_barang']) ?>" required>
                            </div>

                            <div style="margin-bottom: 1.5rem;">
                                <label
                                    style="display:block; margin-bottom:0.5rem; font-weight:500; color:var(--text-primary);">Description</label>
                                <textarea name="deskripsi" class="form-input"
                                    rows="6"><?= htmlspecialchars($item['Deskripsi_barang']) ?></textarea>
                            </div>
                        </div>

                        <!-- Right: Status & Pricing -->
                        <div style="border-left:1px solid var(--border-color); padding-left:2rem;">
                            <h3 style="font-size:1.1rem; font-weight:600; margin-bottom:1.5rem;">Inventory Status</h3>

                            <div style="margin-bottom: 1.5rem;">
                                <label
                                    style="display:block; margin-bottom:0.5rem; font-weight:500; color:var(--text-primary);">Price
                                    (IDR)</label>
                                <div style="position:relative;">
                                    <span
                                        style="position:absolute; left:12px; top:11px; color:var(--text-secondary);">Rp</span>
                                    <input type="number" name="harga" class="form-input" style="padding-left:2.5rem;"
                                        value="<?= $item['Harga_barang'] ?>" required>
                                </div>
                            </div>

                            <div style="margin-bottom: 1.5rem;">
                                <label
                                    style="display:block; margin-bottom:0.5rem; font-weight:500; color:var(--text-primary);">Current
                                    Stock</label>
                                <input type="number" name="stok" class="form-input" value="<?= $item['Stok_barang'] ?>"
                                    required>
                                <div
                                    style="display:flex; align-items:center; gap:0.5rem; margin-top:0.75rem; font-size:0.85rem; color: #d97706; background:#fffbeb; padding:0.5rem; border-radius:6px;">
                                    <span>⚠️</span>
                                    <span>Atomic Update Active (Safe for multi-user)</span>
                                </div>
                            </div>

                            <div style="margin-top:2rem;">
                                <label
                                    style="display:block; margin-bottom:0.5rem; font-weight:500; color:var(--text-secondary);">Last
                                    Updated</label>
                                <div style="font-size:0.9rem; font-weight:600;">
                                    <?= date('d M Y, H:i', strtotime($item['Last_update'])) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        style="display: flex; justify-content: space-between; align-items:center; margin-top: 3rem; padding-top:1.5rem; border-top:1px solid var(--border-color);">
                        <a href="delete_barang.php?id=<?= $item['Id_barang'] ?>" class="btn btn-delete"
                            onclick="return confirm('Truly delete this item?')">Delete Item</a>

                        <div style="display:flex; gap:1rem;">
                            <a href="list_barang.php" class="btn btn-edit">Cancel</a>
                            <button type="submit" class="btn btn-primary"
                                style="min-width:120px; justify-content:center;">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>