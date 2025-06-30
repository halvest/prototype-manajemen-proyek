<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard'; ?> - Relf Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
        .sidebar { position: fixed; top: 0; left: 0; height: 100vh; width: 260px; background-color: #fff; box-shadow: 0 0 15px rgba(0,0,0,0.05); padding-top: 20px; z-index: 100; }
        .main-content { margin-left: 260px; padding: 30px; }
        .sidebar .nav-link { color: #555; font-size: 1rem; padding: 12px 25px; border-radius: 8px; margin-bottom: 5px; font-weight: 500; }
        .sidebar .nav-link.active { background-color: #1abc9c; color: #fff; }
        .sidebar .nav-link:hover { background-color: #e9ecef; }
        .sidebar .nav-link .bi { font-size: 1.2rem; }
        .sidebar .logout-btn { position: absolute; bottom: 20px; left: 20px; right: 20px; }
        .sidebar-brand-link { text-decoration: none; }
        .sidebar-brand { font-weight: 700; color: #1abc9c; }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="<?= site_url('home'); ?>" class="sidebar-brand-link">
        <h3 class="text-center mb-4 sidebar-brand">RelfConnect</h3>
    </a>
    <ul class="nav flex-column px-3">
        <li class="nav-item">
            <a class="nav-link <?= (isset($active_menu) && $active_menu == 'dashboard') ? 'active' : '' ?>" href="<?= site_url('donatur/dashboard'); ?>">
                <i class="bi bi-grid-fill me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($active_menu) && $active_menu == 'riwayat') ? 'active' : '' ?>" href="<?= site_url('donatur/riwayat'); ?>">
                <i class="bi bi-clock-history me-2"></i> Riwayat Donasi
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($active_menu) && $active_menu == 'lacak') ? 'active' : '' ?>" href="<?= site_url('donatur/tracking'); ?>">
                <i class="bi bi-box-seam-fill me-2"></i> Lacak Barang
            </a>
        </li>
         <li class="nav-item">
            <a class="nav-link <?= (isset($active_menu) && $active_menu == 'notifikasi') ? 'active' : '' ?>" href="<?= site_url('donatur/notifikasi'); ?>">
                <i class="bi bi-bell-fill me-2"></i> Notifikasi
            </a>
        </li>
         <li class="nav-item">
            <a class="nav-link <?= (isset($active_menu) && $active_menu == 'pengaturan') ? 'active' : '' ?>" href="<?= site_url('donatur/pengaturan'); ?>">
                <i class="bi bi-gear-fill me-2"></i> Pengaturan
            </a>
        </li>
    </ul>
    <div class="logout-btn">
        <a href="<?= site_url('auth/logout'); ?>" class="btn btn-danger w-100"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
    </div>
</div>

<main class="main-content">
    <?php if (isset($view_file)) $this->load->view($view_file); ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
