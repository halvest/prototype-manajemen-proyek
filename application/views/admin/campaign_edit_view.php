<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label>Judul Kampanye</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($campaign->title); ?>" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($campaign->description); ?></textarea>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="pending" <?= $campaign->status == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="active" <?= $campaign->status == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="rejected" <?= $campaign->status == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?= site_url('admin/campaigns'); ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
