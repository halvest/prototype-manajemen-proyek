<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard Lembaga'; ?> - Relf Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { position: fixed; top: 0; left: 0; height: 100vh; width: 250px; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding-top: 20px; z-index: 100; }
        .main-content { margin-left: 250px; padding: 30px; }
        .sidebar .nav-link { color: #555; font-size: 1.1rem; padding: 12px 20px; border-radius: 8px; }
        .sidebar .nav-link.active { background-color: #1abc9c; color: #fff; }
        .sidebar .nav-link:hover { background-color: #f1f1f1; }
        .sidebar .logout-btn { position: absolute; bottom: 20px; left: 20px; right: 20px; }
        .stat-card { background: #fff; padding: 25px; border-radius: 12px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .stat-card h1 { font-size: 2.5rem; font-weight: 700; color: #1abc9c; }
    </style>
</head>
<body>

<div class="sidebar">
    <h3 class="text-center mb-4">RelfConnect</h3>
    <ul class="nav flex-column px-3">
        <li class="nav-item mb-2">
            <a class="nav-link <?= ($active_menu == 'dashboard') ? 'active' : '' ?>" href="<?= site_url('lembaga/dashboard'); ?>">
                <i class="bi bi-grid-fill me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link <?= ($active_menu == 'kelola_posting') ? 'active' : '' ?>" href="<?= site_url('lembaga/campaign'); ?>">
                <i class="bi bi-card-list me-2"></i> Kelola Postingan
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link <?= ($active_menu == 'posting') ? 'active' : '' ?>" href="<?= site_url('lembaga/campaign/create'); ?>">
                <i class="bi bi-plus-square-fill me-2"></i> Buat Postingan
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link <?= ($active_menu == 'lacak') ? 'active' : '' ?>" href="<?= site_url('lembaga/tracking'); ?>">
                <i class="bi bi-box-seam-fill me-2"></i> Lacak Barang
            </a>
        </li>
    </ul>
    <div class="logout-btn">
        <a href="<?= site_url('auth/logout'); ?>" class="btn btn-danger w-100">Logout</a>
    </div>
</div>

<div class="main-content">
    <?php if (isset($view_file)) $this->load->view($view_file, $view_data ?? []); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>