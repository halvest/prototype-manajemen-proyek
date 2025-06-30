<style>
    /* ----- Variabel Warna untuk Konsistensi & Kemudahan Modifikasi ----- */
    :root {
        --primary-color: #007BFF; /* Biru yang lebih vibrant */
        --secondary-color: #6c757d;
        --success-color: #28a745; /* Hijau yang umum digunakan */
        --success-hover-color: #218838;
        --light-bg-color: #f8f9fa;
        --text-dark-color: #212529;
        --text-muted-color: #6c757d;
        --border-color: #dee2e6;
        --box-shadow-soft: 0 4px 15px rgba(0, 0, 0, 0.07);
        --box-shadow-lift: 0 8px 25px rgba(0, 0, 0, 0.1);
        --border-radius-md: 0.5rem;
        --border-radius-lg: 1rem;
    }

    /* ----- Hero Section ----- */
    .campaign-hero {
        padding: 4rem 0;
        background-color: var(--light-bg-color);
        border-bottom: 1px solid var(--border-color);
    }
    .campaign-title {
        font-weight: 700;
        color: var(--text-dark-color);
    }
    .lembaga-info {
        font-size: 1.1rem;
        font-weight: 400; /* Dibuat lebih tipis agar fokus ke judul */
        color: var(--text-muted-color);
    }
    .lembaga-info a {
        font-weight: 600;
        text-decoration: none;
        color: var(--primary-color);
        transition: color 0.3s ease;
    }
    .lembaga-info a:hover {
        color: #0056b3;
    }

    /* ----- Konten Utama ----- */
    .campaign-detail-img {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: cover;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--box-shadow-lift);
    }

    .content-section h4 {
        font-weight: 600;
        color: var(--text-dark-color);
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary-color);
        display: inline-block;
    }

    .campaign-description {
        font-size: 1.1rem; /* Sedikit lebih besar untuk kenyamanan membaca */
        line-height: 1.8; /* Jarak antar baris yang lebih lega */
        color: #343a40;
    }

    /* ----- Form Donasi Card ----- */
    .donation-form-card {
        border: 1px solid var(--border-color);
        box-shadow: var(--box-shadow-soft);
        border-radius: var(--border-radius-lg);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .donation-form-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--box-shadow-lift);
    }

    .donation-form-card .card-header {
        background-color: transparent;
        border-bottom: 1px solid var(--border-color);
        padding: 1.5rem;
    }

    .donation-form-card .card-body {
        padding: 1.5rem;
    }

    /* ----- Form Elements ----- */
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select {
        padding: 0.8rem 1rem;
        border: 1px solid #ced4da;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }

    /* ----- Tombol Aksi ----- */
    .btn-submit-donation {
        background-color: var(--success-color);
        border-color: var(--success-color);
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.9rem;
        border-radius: var(--border-radius-md);
        transition: background-color 0.3s ease, border-color 0.3s ease, transform 0.2s ease;
    }
    .btn-submit-donation:hover {
        background-color: var(--success-hover-color);
        border-color: var(--success-hover-color);
        transform: translateY(-2px);
    }
    .btn-submit-donation .bi {
        font-size: 1.1rem;
    }
</style>

<section class="campaign-hero">
    <div class="container">
        <h1 class="campaign-title display-5 mb-3"><?= htmlspecialchars($campaign->title); ?></h1>
        <p class="lead lembaga-info">
            Diselenggarakan oleh: <strong><a href="#"><?= htmlspecialchars($campaign->lembaga_name ?? 'Lembaga Terpercaya'); ?></a></strong>
        </p>
    </div>
</section>

<div class="container my-5 py-4">
    <div class="row g-5">
        
        <div class="col-lg-7">
            <img src="<?= base_url('uploads/campaigns/' . ($campaign->image_url ?? 'default.jpg')); ?>" class="campaign-detail-img mb-5" alt="<?= htmlspecialchars($campaign->title); ?>">
            
            <div class="content-section">
                <h4>Tentang Kampanye Ini</h4>
                <div class="mt-4 campaign-description text-justify">
                    <?= nl2br(htmlspecialchars($campaign->description)); ?>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card sticky-top donation-form-card" style="top: 2rem;">
                <div class="card-header">
                    <h4 class="mb-0 text-center fw-bold">Salurkan Bantuan Anda</h4>
                </div>
                <div class="card-body">
                    <?php if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'donatur'): ?>
                        <div class="alert alert-light text-center border rounded-3 p-4">
                            <i class="bi bi-box-arrow-in-right fs-2 text-primary mb-3 d-block"></i>
                            <p class="mb-3">Silakan login sebagai donatur untuk melanjutkan donasi.</p>
                            <a href="<?= site_url('auth/login'); ?>" class="btn btn-primary px-4">Login Sekarang</a>
                        </div>
                    <?php else: ?>
                        
                        <?php 
                            $error_validation = $this->session->flashdata('error_validation');
                            $error_upload = $this->session->flashdata('error_upload');
                        ?>
                        <?php if(!empty($error_validation)): ?>
                            <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $error_validation; ?></div>
                        <?php endif; ?>
                        <?php if(!empty($error_upload)): ?>
                            <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $error_upload; ?></div>
                        <?php endif; ?>

                        <?= form_open_multipart('donatur/donasi/submit/' . $campaign->campaign_id, ['class' => 'donation-form']); ?>
                            <div class="mb-3">
                                <label for="item_name" class="form-label">Nama/Deskripsi Barang</label>
                                <input type="text" name="item_name" id="item_name" class="form-control" value="<?= set_value('item_name'); ?>" required placeholder="Contoh: 1 kardus pakaian layak pakai">
                            </div>
                             <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="quantity" class="form-label">Jumlah</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" value="<?= set_value('quantity', 1); ?>" min="1">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="item_condition" class="form-label">Kondisi Barang</label>
                                    <select name="item_condition" id="item_condition" class="form-select" required>
                                        <option value="Layak Pakai" <?= set_select('item_condition', 'Layak Pakai', TRUE); ?>>Layak Pakai</option>
                                        <option value="Baru" <?= set_select('item_condition', 'Baru'); ?>>Baru</option>
                                        <option value="Bekas" <?= set_select('item_condition', 'Bekas'); ?>>Bekas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="item_image" class="form-label">Foto Barang <span class="text-muted">(Opsional)</span></label>
                                <input type="file" name="item_image" id="item_image" class="form-control">
                                <div class="form-text mt-2">Format: JPG, PNG. Ukuran Maks: 2MB.</div>
                            </div>
                            
                            <p class="text-muted small text-center bg-light p-3 rounded-3">
                               <i class="bi bi-info-circle me-1"></i> Tim kami akan menghubungi Anda untuk mengatur jadwal penjemputan barang.
                            </p>
                            
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-submit-donation btn-lg">
                                    <i class="bi bi-send-fill me-2"></i> Kirim Data Donasi
                                </button>
                            </div>
                        <?= form_close(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>