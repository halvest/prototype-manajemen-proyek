<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel'; ?> - Relf Connect</title>

    <link rel="icon" type="image/png" href="<?= base_url('assets/favicon.png'); ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --teal-color: #1abc9c;
            --dark-text: #343a40;
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            padding-top: 20px;
            z-index: 1020;
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-brand-link { text-decoration: none; }
        .sidebar-brand {
            font-weight: 700;
            color: var(--teal-color);
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar .nav-link {
            color: #555;
            font-size: 1rem;
            padding: 12px 25px;
            border-radius: 8px;
            margin-bottom: 5px;
            font-weight: 500;
            transition: background-color 0.2s, color 0.2s;
        }
        .sidebar .nav-link .bi {
            font-size: 1.2rem;
            vertical-align: middle;
        }
        .sidebar .nav-link.active {
            background-color: var(--teal-color);
            color: #fff;
        }
        .sidebar .nav-link:hover:not(.active) {
            background-color: #e9ecef;
            color: #000;
        }
        .sidebar .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
        }
        .main-content {
            margin-left: 260px;
            padding: 30px;
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1010;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            .sidebar.show + .sidebar-overlay {
                display: block;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar px-3" id="adminSidebar">
        <a href="<?= site_url('home'); ?>" class="sidebar-brand-link">
            <h4 class="sidebar-brand">RelfConnect <span class="badge bg-primary">Admin</span></h4>
        </a>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= (isset($active_menu) && $active_menu === 'dashboard') ? 'active' : '' ?>" href="<?= site_url('admin/dashboard'); ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($active_menu) && $active_menu === 'campaigns') ? 'active' : '' ?>" href="<?= site_url('admin/dashboard/campaigns'); ?>">
                    <i class="bi bi-megaphone-fill me-2"></i> Manajemen Kampanye
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($active_menu) && $active_menu === 'users') ? 'active' : '' ?>" href="<?= site_url('admin/dashboard/users'); ?>">
                    <i class="bi bi-people-fill me-2"></i> Manajemen Pengguna
                </a>
            </li>
        </ul>

        <div class="logout-btn">
            <a href="<?= site_url('auth/logout'); ?>" class="btn btn-danger w-100">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </div>
    </div>
    
    <div class="sidebar-overlay d-md-none" onclick="toggleSidebar()"></div>

    <div class="main-content">
        <button class="btn btn-light d-md-none mb-3" type="button" onclick="toggleSidebar()">
            <i class="bi bi-list"></i> Menu
        </button>

        <div class="container-fluid">
            <h2 class="mb-4 fw-bold"><?= $title ?? 'Admin Panel'; ?></h2>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($view_file)) $this->load->view('admin/' . $view_file, $view_data ?? []); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('d-block');
        }
    </script>

</body>
</html>
