<?php $this->load->view('templates/header'); ?>

<style>
    body {
        background: linear-gradient(120deg, #F0FFFC 0%, #FFFFFF 100%);
        min-height: 100vh;
    }
    .auth-container {
        max-width: 500px;
        margin: 5rem auto;
    }
    .auth-card {
        padding: 2.5rem;
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }
    .auth-card h3 {
        font-weight: 700;
    }
</style>

<div class="container">
    <div class="auth-container">
        <div class="card auth-card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <a class="navbar-brand fs-2" href="<?= site_url('home'); ?>">RelfConnect</a>
                    <h3 class="mt-3">Buat Akun Baru</h3>
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
                        <label for="role" class="form-label">Daftar Sebagai</label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Pilih Peran --</option>
                            <option value="donatur">Donatur</option>
                            <option value="lembaga">Lembaga</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap / Nama Lembaga</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap atau nama lembaga" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="contoh@gmail.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                    </div>

                    <div class="mb-4">
                        <label for="confirm_password" class="form-label">Ulangi Password</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Ketik ulang password" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Daftar</button>
                    </div>
                <?= form_close(); ?>

                <div class="text-center mt-4">
                    <p class="text-muted">Sudah punya akun? <a href="<?= site_url('auth/login'); ?>">Masuk di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
