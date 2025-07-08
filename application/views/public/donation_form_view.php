<style>
    :root {
        --primary-color: #007BFF;
        --primary-hover: #0056b3;
        --background-light: #f8f9fa;
        --text-dark: #212529;
        --text-muted: #6c757d;
        --border-color: #dee2e6;
        --card-background: #ffffff;
        --shadow-medium: 0 8px 24px rgba(0, 0, 0, 0.08);
        --radius-default: 0.75rem;
        --transition-default: all 0.3s ease;
    }

    body {
        background-color: var(--background-light);
        font-family: 'Inter', 'Poppins', sans-serif;
    }

    .donation-form-container {
        padding: 4rem 0;
    }

    .donation-card {
        background-color: var(--card-background);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-default);
        box-shadow: var(--shadow-medium);
        overflow: hidden; /* Penting untuk border-radius di header */
    }

    .donation-card-header {
        text-align: left;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border-color);
    }
    
    .donation-card-header h2 {
        font-weight: 700;
        margin: 0;
        color: var(--text-dark);
    }

    .donation-card-header p {
        margin: 0.25rem 0 0;
        color: var(--text-muted);
        font-size: 0.95rem;
    }
    
    .donation-card .card-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #343a40;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border-radius: 0.5rem;
        padding: 0.8rem 1rem;
        border: 1px solid var(--border-color);
        transition: var(--transition-default);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
    }

    /* Interactive Image Upload Zone */
    .image-upload-zone {
        width: 100%;
        min-height: 180px;
        border: 2px dashed var(--border-color);
        border-radius: var(--radius-default);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #fcfdff;
        cursor: pointer;
        transition: var(--transition-default);
        position: relative;
        overflow: hidden;
    }
    
    .image-upload-zone:hover {
        border-color: var(--primary-color);
        background-color: #f7faff;
    }
    
    .image-upload-zone .upload-instructions {
        color: var(--text-muted);
        text-align: center;
    }

    .image-upload-zone .upload-instructions i {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .image-upload-zone #imagePreview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        display: none; /* Sembunyikan by default */
    }

    /* State ketika gambar sudah di-upload */
    .image-upload-zone.has-image .upload-instructions {
        display: none; /* Sembunyikan instruksi */
    }

    .image-upload-zone.has-image #imagePreview {
        display: block; /* Tampilkan gambar */
    }

    /* Buttons */
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        border-radius: 0.5rem;
        transition: var(--transition-default);
    }

    .btn-primary:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
        transform: translateY(-2px);
    }
    
    .btn-light {
        border: 1px solid var(--border-color);
    }

</style>

<main class="donation-form-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card donation-card">
                    <div class="donation-card-header">
                        <h2>Formulir Donasi Barang</h2>
                        <p>Untuk Kampanye: "<?= htmlspecialchars($campaign->title, ENT_QUOTES, 'UTF-8'); ?>"</p>
                    </div>
                    <div class="card-body">
                        
                        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>

                        <?= form_open_multipart('donatur/submit_donation/' . $campaign->campaign_id); ?>
                            
                            <div class="mb-4">
                                <label for="item_name" class="form-label">Nama Barang</label>
                                <input type="text" name="item_name" class="form-control" placeholder="Contoh: 1 dus pakaian anak layak pakai" value="<?= set_value('item_name'); ?>" required>
                            </div>
    
                            <div class="row g-3">
                                <div class="col-md-6 mb-4">
                                    <label for="quantity" class="form-label">Jumlah</label>
                                    <input type="number" name="quantity" class="form-control" value="<?= set_value('quantity', 1); ?>" min="1" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                     <label for="item_condition" class="form-label">Kondisi Barang</label>
                                     <select name="item_condition" id="item_condition" class="form-select" required>
                                         <option value="Layak Pakai" <?= set_select('item_condition', 'Layak Pakai', TRUE); ?>>Bekas Layak Pakai</option>
                                         <option value="Baru" <?= set_select('item_condition', 'Baru'); ?>>Baru</option>
                                     </select>
                                </div>
                            </div>
    
                            <div class="mb-4">
                                <label class="form-label">Foto Barang</label>
                                <label for="item_image_input" class="image-upload-zone" id="uploadZone">
                                    <div class="upload-instructions">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                        <div>Klik untuk mengunggah gambar</div>
                                    </div>
                                    <img id="imagePreview" src="#" alt="Pratinjau Gambar">
                                </label>
                                <input type="file" name="item_image" class="form-control" id="item_image_input" accept="image/png, image/jpeg" required hidden>
                                <div class="form-text mt-2">Format: JPG, PNG. Ukuran maksimal 2MB.</div>
                            </div>
    
                            <div class="d-grid gap-2 mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg">Ajukan Donasi</button>
                                <a href="<?= site_url('campaign/detail/' . $campaign->campaign_id); ?>" class="btn btn-light text-center">Batal</a>
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
    const imageInput = document.getElementById('item_image_input');
    const imagePreview = document.getElementById('imagePreview');
    const uploadZone = document.getElementById('uploadZone');

    if (imageInput && imagePreview && uploadZone) {
        // Ketika file dipilih
        imageInput.addEventListener('change', function(evt) {
            const file = evt.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    uploadZone.classList.add('has-image');
                }
                reader.readAsDataURL(file);
            }
        });
        
        // Memungkinkan user mengklik zona untuk memicu input file
        uploadZone.addEventListener('click', () => imageInput.click());
    }
});
</script>