<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Relf Connect</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
    :root {
        --teal-color: #1abc9c;
        --teal-dark: #0f9885;
        --dark-text: #212529;
        --muted-text: #6c757d;
    }

    body {
        font-family: 'Poppins', sans-serif;
        padding-top: 5px;
        background-color: #fff;
    }

    .navbar {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.04);
        transition: all 0.3s ease-in-out;
    }

    .navbar-brand {
        font-weight: 700;
        font-size: 1.6rem;
        color: var(--teal-color) !important;
        letter-spacing: 0.5px;
    }

    .navbar-nav .nav-link {
        color: var(--muted-text);
        font-weight: 500;
        margin: 0 1rem;
        position: relative;
        padding-bottom: 6px;
        transition: all 0.2s ease-in-out;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: var(--teal-dark) !important;
    }

    .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        background-color: var(--teal-color);
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        transition: width 0.3s ease;
    }

    .navbar-nav .nav-link:hover::after,
    .navbar-nav .nav-link.active::after {
        width: 50%;
    }

    .btn-custom-primary {
        background: var(--teal-color);
        color: #fff;
        border: none;
        padding: 0.5rem 1.3rem;
        font-weight: 500;
        border-radius: 50px;
        transition: 0.3s;
        box-shadow: 0 8px 20px rgba(29, 210, 182, 0.3);
    }

    .btn-custom-primary:hover {
        background: var(--teal-dark);
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }

    .btn-custom-outline {
        color: var(--teal-color);
        border: 1.5px solid var(--teal-color);
        padding: 0.5rem 1.3rem;
        font-weight: 500;
        border-radius: 50px;
        transition: 0.3s;
    }

    .btn-custom-outline:hover {
        background-color: var(--teal-color);
        color: white;
        box-shadow: 0 8px 18px rgba(0,0,0,0.08);
    }

    .dropdown-menu {
        border-radius: 0.75rem;
        border: none;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        padding: 0.5rem 0;
        min-width: 180px;
    }

    .dropdown-item {
        font-weight: 500;
        padding: 0.5rem 1rem;
        color: var(--dark-text);
        transition: background-color 0.2s;
    }

    .dropdown-item:hover {
        background-color: var(--teal-color);
        color: #fff !important;
    }

    .dropdown-item:active {
        background-color: var(--teal-dark) !important;
        color: #fff !important;
    }

    /* Responsive adjustment */
    @media (max-width: 991.98px) {
        .navbar-nav {
            padding-top: 1rem;
        }

        .btn-custom-outline,
        .btn-custom-primary {
            padding: 0.5rem 1.1rem;
            font-size: 0.9rem;
        }
    }
</style>

</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg bg-white py-3 fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('home'); ?>">RelfConnect</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_page) && $active_page == 'home') ? 'active' : '' ?>" href="<?= site_url('home'); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('home#about'); ?>">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('home#campaign'); ?>">Campaign</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('home#testimoni'); ?>">Testimoni</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <?php if(!$this->session->userdata('logged_in')): ?>
                        <a href="<?= site_url('auth/login'); ?>" class="btn btn-custom-outline me-2">Login</a>
                        <a href="<?= site_url('auth/register'); ?>" class="btn btn-custom-primary">Sign Up</a>
                    <?php else: ?>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($this->session->userdata('name')); ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php 
                                    $role = $this->session->userdata('role');
                                    $dashboard_url = ''; 
                                    if ($role == 'donatur') {
                                        $dashboard_url = site_url('donatur/dashboard');
                                    } elseif ($role == 'lembaga') {
                                        $dashboard_url = site_url('lembaga/dashboard');
                                    } elseif ($role == 'admin') {
                                        $dashboard_url = site_url('admin/dashboard');
                                    }
                                ?>
                                <li><a class="dropdown-item" href="<?= $dashboard_url; ?>"><i class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= site_url('auth/logout'); ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
html {
    scroll-behavior: smooth;
}
</style>
