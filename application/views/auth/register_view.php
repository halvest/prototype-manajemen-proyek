<?php $this->load->view('templates/header'); ?>

<style>
    body {
        background: #f9fafb;
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
    }

    .auth-container {
        max-width: 450px;
        margin: 6% auto;
    }

    .auth-card {
        padding: 2rem;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 8px 24px rgba(0,0,0,0.05);
    }

    .auth-card h3 {
        font-weight: 600;
        color: #111827;
        font-size: 20px;
    }

    .navbar-brand {
        font-weight: 700;
        color: #10b981;
        font-size: 1.5rem;
        text-decoration: none;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: .25rem;
        color: #374151;
        font-size: 14px;
    }

    .form-control, .form-select {
        border-radius: 8px;
        font-size: 14px;
        border: 1px solid #d1d5db;
        padding: 10px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 0.15rem rgba(16, 185, 129, 0.25);
    }

    .btn-register {
        background-color: #10b981;
        border: none;
        font-weight: 600;
        border-radius: 8px;
        padding: 10px;
        transition: 0.3s ease;
    }

    .btn-register:hover {
        background-color: #0e9e6e;
    }

    .text-muted a {
        color: #10b981;
        font-weight: 500;
        text-decoration: none;
    }

    .text-muted a:hover {
        text-decoration: underline;
    }

    .alert {
        font-size: 14px;
        padding: 0.75rem 1rem;
        border-radius: 8px;
    }
</style>

<div class="container">
    <div class="auth-container">
        <div class="auth-card">
            <div class="text-center mb-3">
                <a class="navbar-brand" href="<?= site_url('home'); ?>">RelfConnect</a>
                <h3 class="mt-2">Buat Akun Baru</h3>
            </div>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>

            <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            <?= form_open('auth/register'); ?>
                <div class="mb-3">
                    <label class="form-label">Daftar Sebagai</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Pilih Peran --</option>
                        <option value="donatur">Donatur</option>
                        <option value="lembaga">Lembaga</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap / Nama Lembaga</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap atau nama lembaga" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="contoh@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Ulangi Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Ketik ulang password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-register">Daftar</button>
                </div>
            <?= form_close(); ?>

            <div class="text-center mt-4">
                <p class="text-muted">Sudah punya akun? 
                    <a href="<?= site_url('auth/login'); ?>">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
