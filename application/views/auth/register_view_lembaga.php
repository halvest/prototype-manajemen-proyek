<?php $this->load->view('templates/header'); ?>

<style>
    body { background-color: #f0f8f7; }
    .auth-container { max-width: 450px; margin: 5rem auto; }
    .auth-card { padding: 2.5rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
</style>

<div class="container">
    <div class="auth-container">
        <div class="card auth-card border-0">
            <div class="card-body">
                <h2 class="text-center mb-1">RelfConnect</h2>
                <h4 class="text-center mb-4">Daftar akun lembaga amal</h4>
                
                <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?= form_open('auth/register_view_lembaga'); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lembaga</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama lembaga" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="contoh@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata sandi</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="mb-4">
                        <label for="confirm_password" class="form-label">Ulangi kata sandi</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Masukkan ulang kata sandi" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" style="background-color: #1abc9c; border: none;">Daftar</button>
                    </div>
                <?= form_close(); ?>

                <div class="text-center mt-4">
                    <p class="text-muted">Mempunyai akun? <a href="<?= site_url('auth/login_view_lembaga'); ?>">Masuk</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>