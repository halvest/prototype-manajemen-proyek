<div class="card">
    <div class="card-body p-4">
        <h3 class="mb-4"><?= isset($campaign) ? 'Edit' : 'Buat'; ?> Postingan Kampanye Donasi</h3>
        
        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <?php if(isset($error)) { echo '<div class="alert alert-danger">' . $error . '</div>'; } ?>

        <?= form_open_multipart(isset($campaign) ? 'lembaga/campaign/edit/' . $campaign->campaign_id : 'lembaga/campaign/create'); ?>
            
            <div class="mb-4">
                <label class="form-label">Upload Foto Kampanye</label>
                <img id="imagePreview" src="<?= isset($campaign->image_url) ? base_url('uploads/campaigns/' . $campaign->image_url) : ''; ?>" alt="Image Preview" class="img-fluid rounded mb-2" style="width: 200px; display: <?= isset($campaign->image_url) ? 'block' : 'none'; ?>;">
                <input type="file" name="campaign_image" class="form-control" id="imageInput">
                <div class="form-text">Format yang diizinkan: jpg, png, gif. Maksimal 2MB.</div>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" placeholder="Judul" value="<?= set_value('title', $campaign->title ?? ''); ?>">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Isi deskripsi"><?= set_value('description', $campaign->description ?? ''); ?></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Kategori barang</label>
                <div>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="category" id="pakaian" value="Pakaian" <?= set_radio('category', 'Pakaian', (isset($campaign) && $campaign->category == 'Pakaian')); ?>>
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

            <div class="d-flex justify-content-end mt-4">
                <a href="<?= site_url('lembaga/campaign'); ?>" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-primary" style="background-color: #1abc9c; border:none;">
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
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
}
</script>