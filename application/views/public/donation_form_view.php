<style>
    body {
        background-color: #f8f9fa;
    }
    .donation-form-container {
        padding: 5rem 0;
    }
    .donation-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .donation-card-header {
        background-color: #1DD2B6;
        color: white;
        text-align: center;
        padding: 2rem;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }
    .donation-card-header h2 {
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    .form-control, .form-select {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
    }
    .btn-submit-donation {
        background-color: #1DD2B6;
        border-color: #1DD2B6;
        padding: 0.75rem;
        font-weight: 600;
        border-radius: 0.5rem;
        transition: background-color .3s;
    }
    .btn-submit-donation:hover {
        background-color: #17a691;
        border-color: #17a691;
    }
    .image-preview-box {
        width: 150px;
        height: 150px;
        border: 2px dashed #ddd;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        overflow: hidden;
    }
    .image-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<main class="donation-form-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card donation-card">
                    <div class="donation-card-header">
                        <h2>Formulir Donasi Anda</h2>
                        <p class="mb-0">Untuk Kampanye: "<?= htmlspecialchars($campaign->title, ENT_QUOTES, 'UTF-8'); ?>"</p>
                    </div>
                    <div class="card-body p-4 p-lg-5">
                        
                        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>

                        <?= form_open_multipart('donatur/submit_donation/' . $campaign->campaign_id); ?>
                            
                            <div class="mb-3">
                                <label for="item_name" class="form-label">Nama Barang</label>
                                <input type="text" name="item_name" class="form-control" placeholder="Contoh: Kemeja Lengan Panjang Bekas" value="<?= set_value('item_name'); ?>" required>
                            </div>
    
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="quantity" class="form-label">Jumlah</label>
                                    <input type="number" name="quantity" class="form-control" value="<?= set_value('quantity', 1); ?>" min="1" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                     <label for="item_condition" class="form-label">Kondisi Barang</label>
                                     <select name="item_condition" id="item_condition" class="form-select" required>
                                        <option value="Baru" <?= set_select('item_condition', 'Baru'); ?>>Baru</option>
                                        <option value="Layak Pakai" <?= set_select('item_condition', 'Layak Pakai', TRUE); ?>>Bekas Layak Pakai</option>
                                     </select>
                                </div>
                            </div>
    
                            <div class="mb-4">
                                <label for="item_image" class="form-label">Foto Barang</label>
                                <div class="image-preview-box mb-2">
                                    <img id="imagePreview" src="" alt="Pratinjau" style="display: none;">
                                </div>
                                <input type="file" name="item_image" class="form-control" id="imageInput" accept="image/png, image/jpeg" required>
                                <div class="form-text">Format yang diizinkan: JPG, PNG. Ukuran maksimal 2MB.</div>
                            </div>
    
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-submit-donation">Ajukan Donasi</button>
                                <a href="<?= site_url('campaign/detail/' . $campaign->campaign_id); ?>" class="btn btn-light text-center mt-2">Batal</a>
                            </div>
    
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    if (imageInput) {
        imageInput.onchange = function(evt) {
            const [file] = evt.target.files;
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
            }
        };
    }
});
</script>
