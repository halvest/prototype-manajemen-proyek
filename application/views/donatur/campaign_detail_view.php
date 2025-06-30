<style>
    .campaign-detail-header { padding: 4rem 0; background-color: #f8f9fa; }
    .campaign-detail-img { width: 100%; height: 450px; object-fit: cover; border-radius: 12px; }
    .lembaga-info { font-size: 1.1rem; }
    .donation-form-card {
        border: 1px solid #e9ecef;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border-radius: 12px;
    }
</style>
<div class="container my-5">
    <div class="row g-5">
        
        <!-- Kolom Kiri: Detail Kampanye -->
        <div class="col-lg-7">
            <img src="<?= base_url('uploads/campaigns/' . ($campaign->image_url ?? 'default.jpg')); ?>" class="campaign-detail-img mb-4" alt="<?= htmlspecialchars($campaign->title); ?>">
            <h1 class="fw-bold mb-3"><?= htmlspecialchars($campaign->title); ?></h1>
            <p class="text-muted lembaga-info">
                Diselenggarakan oleh: <strong><?= htmlspecialchars($campaign->lembaga_name ?? 'Lembaga Terpercaya'); ?></strong>
            </p>
            <hr>
            <div class="mt-4">
                <h4 class="fw-bold">Deskripsi Kampanye</h4>
                <p><?= nl2br(htmlspecialchars($campaign->description)); ?></p>
            </div>
        </div>

        <!-- Kolom Kanan: Form Donasi -->
        <div class="col-lg-5">
            <div class="card sticky-top donation-form-card" style="top: 20px;">
                 <div class="card-header bg-white border-bottom-0 pt-3">
                    <h4 class="mb-0 text-center">Formulir Donasi</h4>
                </div>
                <div class="card-body">
                    <?php if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'donatur'): ?>
                        <div class="alert alert-warning text-center">
                            <p class="mb-1">Anda harus login sebagai donatur untuk berdonasi.</p>
                            <a href="<?= site_url('auth/login'); ?>" class="btn btn-primary mt-2">Login Sekarang</a>
                        </div>
                    <?php else: ?>
                        
                        <?php // Menampilkan error validasi atau upload ?>
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
                                <div class="form-text">Membantu verifikasi. Maks 2MB.</div>
                            </div>
                            <hr>
                            <p class="text-muted small">Tim kami akan menghubungi Anda untuk mengatur jadwal penjemputan barang donasi.</p>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg mt-2">Kirim Data Donasi</button>
                            </div>
                        <?= form_close(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
