<?php
require_once 'db_connect.php';

// Prepare Toast
$toastMessage = '';
$toastType = '';
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sukses') {
        $toastMessage = "Data successfully updated!";
        $toastType = 'success';
    } elseif ($_GET['status'] == 'deleted') {
        $toastMessage = "Item deleted!";
        $toastType = 'success';
    } elseif ($_GET['status'] == 'added') {
        $toastMessage = "New item added successfully!";
        $toastType = 'success';
    } elseif ($_GET['status'] == 'error') {
        $toastMessage = $_GET['msg'] ?? "Error";
        $toastType = 'error';
    }
}

// Search Logic
$search = $_GET['q'] ?? '';
$searchParam = "%$search%";

try {
    if ($search) {
        $stmt = $pdo->prepare("SELECT * FROM Tb_Barang WHERE Nama_barang LIKE :search OR Deskripsi_barang LIKE :search ORDER BY Id_barang ASC");
        $stmt->execute(['search' => $searchParam]);
    } else {
        // Default Sort: ID ASC (as requested)
        $stmt = $pdo->query("SELECT * FROM Tb_Barang ORDER BY Id_barang ASC");
    }
    $items = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory List | ArthurAdmin</title>
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
                <li class="nav-item"><a href="list_barang.php" class="active"><span>All Inventory</span></a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div>
                    <h1 class="page-title">Inventory Management</h1>
                    <p style="color: var(--text-secondary); font-size: 0.95rem;">Manage your products and stock levels.
                    </p>
                </div>
            </header>

            <?php if ($toastMessage): ?>
                <div
                    style="background: <?= $toastType == 'success' ? 'var(--success-bg)' : 'var(--danger-bg)' ?>; 
                        color: <?= $toastType == 'success' ? 'var(--success)' : 'var(--danger)' ?>; 
                        padding: 1rem; border-radius: var(--radius); margin-bottom: 1.5rem; border: 1px solid currentColor;">
                    <?= $toastMessage ?>
                </div>
            <?php endif; ?>

            <div class="glass-table-container">
                <div
                    style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; gap:1rem; flex-wrap:wrap;">
                    <!-- Search Form -->
                    <form action="" method="GET" style="flex:1; max-width:400px; display:flex; gap:0.5rem;">
                        <input type="text" name="q" placeholder="Search items..." class="form-input" style="margin:0;"
                            value="<?= htmlspecialchars($search) ?>">
                        <button type="submit" class="btn btn-primary" style="white-space:nowrap;">Search</button>
                    </form>

                    <a href="form_tambah.php" class="btn btn-primary">+ Add New Item</a>
                </div>

                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($items) > 0): ?>
                                <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td style="color:var(--text-secondary);"><?= $item['Id_barang'] ?></td>
                                        <td style="font-weight: 600; color:var(--text-primary);">
                                            <?= htmlspecialchars($item['Nama_barang']) ?></td>
                                        <td
                                            style="color: var(--text-secondary); max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            <?= htmlspecialchars($item['Deskripsi_barang']) ?>
                                        </td>
                                        <td>Rp <?= number_format($item['Harga_barang'], 0, ',', '.') ?></td>
                                        <td>
                                            <span
                                                class="badge <?= $item['Stok_barang'] < 10 ? 'badge-danger' : 'badge-success' ?>">
                                                <?= $item['Stok_barang'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div style="display:flex; gap:0.5rem;">
                                                <a href="form_edit.php?id=<?= $item['Id_barang'] ?>" class="btn btn-edit"
                                                    style="padding:0.4rem 0.8rem; font-size:0.85rem;">Edit</a>
                                                <a href="delete_barang.php?id=<?= $item['Id_barang'] ?>" class="btn btn-delete"
                                                    style="padding:0.4rem 0.8rem; font-size:0.85rem;"
                                                    onclick="return confirm('Delete item?')">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align:center; padding:3rem; color:var(--text-secondary);">
                                        No items found matching "<?= htmlspecialchars($search) ?>". <br>
                                        <a href="list_barang.php" style="color:var(--primary); text-decoration:none;">Reset
                                            Search</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>