<?php $this->load->view('templates/header'); ?>

<style>
    body { 
        background: linear-gradient(120deg, #F0FFFC 0%, #FFFFFF 100%);
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
    }

    .auth-container { 
        max-width: 450px; 
        margin: 5rem auto; 
    }

    .auth-card { 
        padding: 2.5rem; 
        border-radius: 16px; 
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,0.06); 
    }

    .auth-card h3 {
        font-weight: 600;
        color: #1f2937;
        font-size: 22px;
    }

    .navbar-brand {
        font-weight: 700;
        color: #10b981;
        text-decoration: none;
    }

    .navbar-brand:hover {
        color: #0ea97a;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 6px;
        color: #374151;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 15px;
        border: 1px solid #d1d5db;
    }

    .form-control:focus, .form-select:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 0.15rem rgba(16, 185, 129, 0.25);
    }

    .custom-btn-signup {
        background-color: #10b981;
        border-color: #10b981;
        font-weight: 600;
        border-radius: 10px;
    }

    .custom-btn-signup:hover {
        background-color: #0ea97a;
        border-color: #0ea97a;
    }

    .text-muted a {
        color: #10b981;
        font-weight: 500;
        text-decoration: none;
    }

    .text-muted a:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <div class="auth-container">
        <div class="card auth-card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <a class="navbar-brand fs-2" href="<?= site_url('home'); ?>">RelfConnect</a>
                    <h3 class="mt-3">Login Admin</h3>
                </div>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                <?php endif; ?>

                <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?= form_open('auth/admin_login'); ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="admin@relfconnect.com" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn custom-btn-signup">Masuk</button>
                    </div>
                <?= form_close(); ?>

                <div class="text-center mt-4">
                    <p class="text-muted">Kembali ke 
                        <a href="<?= site_url('auth/login'); ?>">halaman login umum</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
