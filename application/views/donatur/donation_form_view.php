<div class="card">
    <div class="card-header bg-white border-bottom-0">
        <h4 class="mb-0">Formulir Donasi untuk Kampanye:</h4>
        <h5 class="mb-0 text-success fw-bold"><?= htmlspecialchars($campaign->title); ?></h5>
    </div>
    <div class="card-body">
        <?php if(!empty($upload_error)): ?>
            <div class="alert alert-danger"><?= $upload_error; ?></div>
        <?php endif; ?>
        
        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <?= form_open_multipart('donatur/donasi/submit/' . $campaign->campaign_id); ?>
            <div class="mb-3">
                <label for="item_name" class="form-label">Nama/Deskripsi Barang</label>
                <input type="text" name="item_name" class="form-control" value="<?= set_value('item_name'); ?>" required placeholder="Contoh: 1 kardus pakaian layak pakai">
            </div>
             <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="quantity" class="form-label">Jumlah</label>
                    <input type="number" name="quantity" class="form-control" value="<?= set_value('quantity', 1); ?>" min="1">
                </div>
                 <div class="col-md-6 mb-3">
                    <label for="item_condition" class="form-label">Kondisi Barang</label>
                    <select name="item_condition" class="form-select" required>
                        <option value="Baru" <?= set_select('item_condition', 'Baru'); ?>>Baru</option>
                        <option value="Layak Pakai" <?= set_select('item_condition', 'Layak Pakai', TRUE); ?>>Layak Pakai</option>
                        <option value="Bekas" <?= set_select('item_condition', 'Bekas'); ?>>Bekas</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="item_image" class="form-label">Foto Barang (Opsional)</label>
                <input type="file" name="item_image" class="form-control">
                <div class="form-text">Upload gambar untuk membantu verifikasi. Maksimal 2MB.</div>
            </div>
            <hr>
            <p><strong>Informasi Pengambilan:</strong></p>
            <p class="text-muted">Tim kami akan menghubungi Anda untuk mengatur jadwal penjemputan barang donasi.</p>
            
            <button type="submit" class="btn btn-primary w-100 mt-3">Kirim Data Donasi</button>
        <?= form_close(); ?>
    </div>
</div>
