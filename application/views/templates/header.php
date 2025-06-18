<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relf Connect - Hubungkan Kebaikan</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>"> 
</head>
<body>

<header class="shadow-sm">
    <nav class="navbar navbar-expand-lg bg-white py-3">
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
                        <a class="nav-link <?= (isset($active_page) && $active_page == 'about') ? 'active' : '' ?>" href="<?= site_url('home/about'); ?>">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_page) && $active_page == 'campaign') ? 'active' : '' ?>" href="<?= site_url('home/campaign'); ?>">Campaign</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_page) && $active_page == 'testimoni') ? 'active' : '' ?>" href="#testimoni">Testimoni</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <?php if(!$this->session->userdata('logged_in')): ?>
                        <a href="<?= site_url('auth/login'); ?>" class="btn btn-link text-decoration-none me-2">Login</a>
                        <button type="button" class="btn btn-primary custom-btn-signup" data-bs-toggle="modal" data-bs-target="#roleSelectionModal">
                            Sign Up
                        </button>
                    <?php else: ?>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i> <?= $this->session->userdata('name'); ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php if($this->session->userdata('role') != 'donatur'): ?>
                                    <li><a class="dropdown-item" href="<?= site_url($this->session->userdata('role') . '/dashboard'); ?>">Dashboard</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?= site_url('auth/logout'); ?>">Logout</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="modal fade" id="roleSelectionModal" tabindex="-1" aria-labelledby="roleSelectionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="roleSelectionModalLabel">Daftar Sebagai...</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 mb-3 mb-md-0">
            <div class="card h-100 text-center">
              <div class="card-body p-4">
                <i class="bi bi-heart-fill fs-1 text-danger"></i>
                <h4 class="card-title mt-3">Donatur</h4>
                <p class="card-text">Saya ingin berdonasi barang bekas untuk membantu sesama.</p>
                <a href="<?= site_url('auth/register_view_donatur'); ?>" class="btn btn-outline-primary mt-3">Daftar sebagai Donatur</a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card h-100 text-center">
              <div class="card-body p-4">
                <i class="bi bi-building fs-1 text-primary"></i>
                <h4 class="card-title mt-3">Lembaga Amal</h4>
                <p class="card-text">Lembaga kami membutuhkan donasi dan ingin membuat kampanye.</p>
                <a href="<?= site_url('auth/register_view_lembaga'); ?>" class="btn btn-outline-primary mt-3">Daftar sebagai Lembaga</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>