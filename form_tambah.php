<?php
require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item | MukhtarAdmin</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="app-container">
        <!-- Sidebar / Navigasi -->
        <aside class="sidebar">
            <div class="mobile-header">
                <div class="brand">
                    <span
                        style="background:var(--text-primary); color:white; padding:4px 8px; border-radius:6px; font-size: 0.9em;">M</span>
                    MukhtarInventory
                </div>
                <button class="menu-toggle"
                    onclick="document.querySelector('.nav-menu').classList.toggle('active')">☰</button>
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="index.php"><span>Dashboard</span></a></li>
                <li class="nav-item"><a href="list_barang.php"><span>All Inventory</span></a></li>
            </ul>
        </aside>

        <!-- Konten Utama -->
        <main class="main-content">
            <header class="header">
                <div>
                    <h1 class="page-title">Add New Product</h1>
                    <p style="color: var(--text-secondary); font-size: 0.95rem;">Create a new item in your inventory.
                    </p>
                </div>
            </header>

            <div style="max-width: 800px; margin: 0 auto;">
                <form action="proses_tambah.php" method="POST" class="stat-card">

                    <div class="form-grid-layout">
                        <div>
                            <div style="margin-bottom: 1.5rem;">
                                <label
                                    style="display:block; margin-bottom:0.5rem; font-weight:500; color:var(--text-primary);">Product
                                    Name</label>
                                <input type="text" name="nama" class="form-input" placeholder="e.g. Mechanical Keyboard"
                                    required>
                            </div>

                            <div style="margin-bottom: 1.5rem;">
                                <label
                                    style="display:block; margin-bottom:0.5rem; font-weight:500; color:var(--text-primary);">Description</label>
                                <textarea name="deskripsi" class="form-input" rows="5"
                                    placeholder="Enter product details..."></textarea>
                            </div>
                        </div>

                        <div class="form-column-right">
                            <div style="margin-bottom: 1.5rem;">
                                <label
                                    style="display:block; margin-bottom:0.5rem; font-weight:500; color:var(--text-primary);">Price
                                    (IDR)</label>
                                <input type="number" name="harga" class="form-input" placeholder="0" required>
                            </div>

                            <div style="margin-bottom: 1.5rem;">
                                <label
                                    style="display:block; margin-bottom:0.5rem; font-weight:500; color:var(--text-primary);">Initial
                                    Stock</label>
                                <input type="number" name="stok" class="form-input" placeholder="0" required>
                            </div>
                        </div>
                    </div>

                    <div
                        style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem; padding-top:1.5rem; border-top:1px solid var(--border-color);">
                        <a href="list_barang.php" class="btn btn-edit">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>