<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
     <div class="card-header bg-white">
        <h4 class="mb-0">Pengaturan Akun Lembaga</h4>
    </div>
    <div class="card-body">
        <?= form_open('lembaga/dashboard/pengaturan'); ?>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lembaga</label>
                <input type="text" class="form-control" name="name" value="<?= set_value('name', $user->name ?? ''); ?>">
            </div>
             <div class="mb-3">
                <label for="email" class="form-label">Email Kontak</label>
                <input type="email" class="form-control" name="email" value="<?= set_value('email', $user->email ?? ''); ?>">
            </div>
             <hr>
             <h5 class="mt-4">Ubah Password</h5>
             <div class="mb-3">
                <label for="password" class="form-label">Password Baru</label>
                <input type="password" class="form-control" name="password">
                 <div class="form-text">Biarkan kosong jika tidak ingin mengubah password.</div>
            </div>
             <div class="mb-3">
                <label for="passconf" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" name="passconf">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <?= form_close(); ?>
    </div>
</div>
