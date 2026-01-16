<?php
require_once 'db_connect.php';

// Calculate Stats
try {
    $stmtVal = $pdo->query("SELECT SUM(Harga_barang * Stok_barang) as total_asset FROM Tb_Barang");
    $totalAsset = $stmtVal->fetch()['total_asset'] ?? 0;

    $stmtCount = $pdo->query("SELECT COUNT(*) as total_items FROM Tb_Barang");
    $totalItems = $stmtCount->fetch()['total_items'];

    // Low Stock Alert (Threshold < 10)
    $stmtLow = $pdo->query("SELECT COUNT(*) as low_stock FROM Tb_Barang WHERE Stok_barang < 10");
    $lowStock = $stmtLow->fetch()['low_stock'];

    $stmtRecent = $pdo->query("SELECT * FROM Tb_Barang ORDER BY Last_update DESC LIMIT 5");
    $recentItems = $stmtRecent->fetchAll();

} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | ArthurAdmin</title>
    <link rel="stylesheet" href="style.css">
    <!-- Inter Font for Clean Look -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand">
                <span style="background:var(--text-primary); color:white; padding:4px 8px; border-radius:6px; font-size: 0.9em;">A</span>
                ArthurInventory
            </div>
            
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="index.php" class="active">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="list_barang.php">
                        <span>All Inventory</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div>
                    <h1 class="page-title">Overview</h1>
                    <p style="color: var(--text-secondary); font-size: 0.95rem;">Here is what's happening with your stock today.</p>
                </div>
                <div class="user-profile">
                    <div style="text-align: right;">
                        <div style="font-weight: 600; font-size: 0.9rem;">Mukhtar</div>
                        <div style="font-size: 0.8rem; color: var(--text-secondary);">Super Admin</div>
                    </div>
                    <div class="avatar">M</div>
                </div>
            </header>

            <!-- Stats Widgets -->
            <div class="stats-grid">
                
                <!-- Asset Value -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">TOTAL ASSET VALUE</span>
                        <div class="stat-icon" style="background: var(--success-bg); color: var(--success);">Rp</div>
                    </div>
                    <div class="stat-value">Rp <?= number_format($totalAsset, 0, ',', '.') ?></div>
                    <div class="stat-trend trend-positive">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                        <span>Verified Valuation</span>
                    </div>
                </div>

                <!-- Product Count -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">TOTAL PRODUCTS</span>
                        <div class="stat-icon" style="background: var(--primary-soft); color: var(--primary);">📦</div>
                    </div>
                    <div class="stat-value"><?= $totalItems ?> Items</div>
                    <div class="stat-trend trend-neutral">
                        <span>Across all categories</span>
                    </div>
                </div>

                <!-- Low Stock Alert -->
                <!-- Dynamic Logic: Green if 0 (Good), Red if > 0 (Action Needed) -->
                <?php
                $isHealthy = ($lowStock == 0);
                $stockColor = $isHealthy ? 'var(--success)' : 'var(--danger)';
                $stockBg = $isHealthy ? 'var(--success-bg)' : 'var(--danger-bg)';
                $stockIcon = $isHealthy ? 'Check' : 'Alert';
                ?>
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">LOW STOCK ALERT</span>
                        <div class="stat-icon" style="background: <?= $stockBg ?>; color: <?= $stockColor ?>;">!</div>
                    </div>
                    <div class="stat-value"><?= $lowStock ?> Items</div>
                    <div class="stat-trend <?= $isHealthy ? 'trend-positive' : 'trend-negative' ?>">
                        <?php if ($isHealthy): ?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Stock levels are healthy</span>
                        <?php else: ?>
                                <span>Restock required immediately</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 1rem;">
                <h3 style="font-size:1.1rem; font-weight:600;">Recent Updates</h3>
                <a href="list_barang.php" style="font-size:0.9rem; text-decoration:none; color:var(--primary);">View All &rarr;</a>
            </div>
            
            <div class="glass-table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Last Activity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentItems as $item): ?>
                            <tr>
                                <td style="font-weight: 500;"><?= htmlspecialchars($item['Nama_barang']) ?></td>
                                <td>Rp <?= number_format($item['Harga_barang'], 0, ',', '.') ?></td>
                                <td><?= $item['Stok_barang'] ?></td>
                                <td style="color: var(--text-secondary); font-size: 0.9rem;">
                                    <?= date('d M Y, H:i', strtotime($item['Last_update'])) ?>
                                </td>
                                <td>
                                    <?php if ($item['Stok_barang'] < 10): ?>
                                            <span class="badge badge-danger">Low Stock</span>
                                    <?php else: ?>
                                            <span class="badge badge-success">On Stock</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</body>
</html>