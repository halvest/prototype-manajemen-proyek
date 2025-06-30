<style>
    .form-card {
        box-shadow: 0 4px 25px rgba(0,0,0,0.08);
        border: none;
        border-radius: 0.75rem;
    }
    .form-control, .form-select {
        padding: 0.75rem 1rem;
    }
    .btn-primary-custom {
        background-color: #1abc9c;
        border-color: #1abc9c;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="h4">Edit Kampanye</h3>
    <a href="<?= site_url('admin/dashboard/campaigns'); ?>" class="btn btn-light">
        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Kampanye
    </a>
</div>

<div class="card form-card">
    <div class="card-body p-4 p-lg-5">
        <?= form_open('admin/dashboard/edit/' . $campaign->campaign_id); ?>
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Judul Kampanye</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($campaign->title); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($campaign->description); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label fw-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="pending" <?= $campaign->status == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="active" <?= $campaign->status == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="rejected" <?= $campaign->status == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                </select>
                <div class="form-text">Mengubah status menjadi 'Active' akan menampilkan kampanye di halaman publik.</div>
            </div>
            <hr class="my-4">
            <div class="d-flex justify-content-end">
                <a href="<?= site_url('admin/dashboard/campaigns'); ?>" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary btn-primary-custom">Simpan Perubahan</button>
            </div>
        <?= form_close(); ?>
    </div>
</div>
