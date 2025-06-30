<style>
    .form-card {
        box-shadow: 0 4px 25px rgba(0,0,0,0.08);
        border: none;
        border-radius: 0.75rem;
    }
    .image-upload-card {
        border: 2px dashed #e9ecef;
        text-align: center;
        padding: 2rem;
        background-color: #f8f9fa;
        transition: all 0.2s ease-in-out;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .image-upload-card:hover {
        border-color: #1abc9c;
        background-color: #f1f1f1;
    }
    #imagePreview {
        max-height: 250px;
        width: 100%;
        object-fit: cover;
        border-radius: 0.5rem;
    }
    .btn-check:checked+.btn-outline-secondary {
        background-color: #1abc9c;
        border-color: #1abc9c;
        color: #fff;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="h4"><?= isset($campaign) ? 'Edit' : 'Buat'; ?> Kampanye Baru</h3>
    <a href="<?= site_url('lembaga/dashboard/campaigns'); ?>" class="btn btn-light">
        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Kampanye
    </a>
</div>

<div class="card form-card">
    <div class="card-body p-4 p-lg-5">
        
        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <?php if(isset($error)) { echo '<div class="alert alert-danger">' . $error . '</div>'; } ?>

        <?= form_open_multipart(isset($campaign) ? 'lembaga/dashboard/edit_campaign/' . $campaign->campaign_id : 'lembaga/dashboard/create_campaign'); ?>
            <div class="row g-4">
                <!-- Kolom Kiri: Detail Teks -->
                <div class="col-lg-7">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Kampanye</label>
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Contoh: Bantuan Pakaian untuk Musim Dingin" value="<?= set_value('title', $campaign->title ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Lengkap</label>
                        <textarea name="description" class="form-control" rows="8" placeholder="Jelaskan tujuan dan detail kampanye Anda di sini..."><?= set_value('description', $campaign->description ?? ''); ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Kategori Barang Donasi</label>
                        <div>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="category" id="pakaian" value="Pakaian" <?= set_radio('category', 'Pakaian', (isset($campaign) ? $campaign->category == 'Pakaian' : TRUE)); ?>>
                                <label class="btn btn-outline-secondary" for="pakaian">Pakaian</label>

                                <input type="radio" class="btn-check" name="category" id="elektronik" value="Elektronik" <?= set_radio('category', 'Elektronik', (isset($campaign) && $campaign->category == 'Elektronik')); ?>>
                                <label class="btn btn-outline-secondary" for="elektronik">Elektronik</label>

                                <input type="radio" class="btn-check" name="category" id="buku" value="Buku" <?= set_radio('category', 'Buku', (isset($campaign) && $campaign->category == 'Buku')); ?>>
                                <label class="btn btn-outline-secondary" for="buku">Buku</label>
                                
                                <input type="radio" class="btn-check" name="category" id="lainnya" value="Lainnya" <?= set_radio('category', 'Lainnya', (isset($campaign) && $campaign->category == 'Lainnya')); ?>>
                                <label class="btn btn-outline-secondary" for="lainnya">Lainnya</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Upload Gambar -->
                <div class="col-lg-5">
                     <label class="form-label">Foto Utama Kampanye</label>
                    <div class="image-upload-card">
                        <img id="imagePreview" src="<?= isset($campaign->image_url) && !empty($campaign->image_url) ? base_url('uploads/campaigns/' . $campaign->image_url) : ''; ?>" alt="Image Preview" class="mb-3" style="display: <?= isset($campaign->image_url) && !empty($campaign->image_url) ? 'block' : 'none'; ?>;">
                        <i class="bi bi-cloud-arrow-up-fill fs-1 text-muted" id="uploadIcon" style="display: <?= isset($campaign->image_url) && !empty($campaign->image_url) ? 'none' : 'block'; ?>;"></i>
                        <label for="imageInput" class="btn btn-light">Pilih Gambar</label>
                        <input type="file" name="campaign_image" class="d-none" id="imageInput">
                        <div class="form-text mt-2">Format: JPG, PNG, GIF. Maks 2MB.</div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end">
                <a href="<?= site_url('lembaga/dashboard/campaigns'); ?>" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-primary" style="background-color: #1abc9c; border:none;">
                    <i class="bi bi-send-fill me-2"></i>
                    <?= isset($campaign) ? 'Simpan Perubahan' : 'Posting Kampanye'; ?>
                </button>
            </div>
        <?= form_close(); ?>
    </div>
</div>

<script>
document.getElementById('imageInput').onchange = evt => {
    const [file] = evt.target.files;
    if (file) {
        const preview = document.getElementById('imagePreview');
        const icon = document.getElementById('uploadIcon');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
        icon.style.display = 'none';
    }
}
</script>
