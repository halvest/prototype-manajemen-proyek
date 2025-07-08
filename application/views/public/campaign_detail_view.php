<style>
    :root {
        --primary-color: #0056d2; /* Warna biru yang sedikit lebih modern */
        --primary-hover: #0041a0;
        --success-color: #28a745;
        --success-hover-color: #218838;
        --background-light: #f9fafb; /* Latar belakang yang sangat terang */
        --text-dark: #1f2937;
        --text-muted: #6b7280;
        --border-color: #e5e7eb;
        --card-background: #ffffff;
        --shadow-soft: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
        --radius-default: 0.75rem; /* Border-radius yang konsisten */
        --transition-default: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        font-family: 'Inter', 'Poppins', sans-serif; /* Fallback font system */
        background-color: var(--background-light);
        color: var(--text-dark);
    }

    /* --- Typography & Header --- */
    .campaign-header {
        margin-bottom: 2.5rem;
    }

    .campaign-title {
        font-weight: 700;
        font-size: 2.75rem;
        color: var(--text-dark);
    }

    .organizer-info {
        font-size: 1.1rem;
        color: var(--text-muted);
    }

    .organizer-info a {
        color: var(--primary-color);
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition-default);
    }

    .organizer-info a:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    /* --- Main Content --- */
    .campaign-main-image {
        width: 100%;
        border-radius: var(--radius-default);
        box-shadow: var(--shadow-medium);
        object-fit: cover;
    }

    .content-section {
        margin-top: 2.5rem;
    }

    .content-section h4 {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary-color);
        display: inline-block;
    }

    .campaign-description {
        font-size: 1.05rem;
        line-height: 1.7;
        color: #374151;
    }

    /* --- Donation Form Card --- */
    .donation-form-card {
        background-color: var(--card-background);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-default);
        box-shadow: var(--shadow-soft);
        transition: var(--transition-default);
    }
    
    .donation-form-card .card-header {
        background-color: transparent;
        border-bottom: 1px solid var(--border-color);
        padding: 1.5rem;
    }

    .donation-form-card .card-body {
        padding: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--text-dark);
    }

    .form-control,
    .form-select {
        padding: 0.8rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        transition: var(--transition-default);
        background-color: #f9fafb;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 86, 210, 0.15);
        background-color: #fff;
    }

    .btn-submit-donation {
        background-color: var(--success-color);
        border-color: var(--success-color);
        font-weight: 600;
        padding: 0.85rem 1.5rem;
        border-radius: 0.5rem;
        transition: var(--transition-default);
        letter-spacing: 0.5px;
    }

    .btn-submit-donation:hover {
        background-color: var(--success-hover-color);
        border-color: var(--success-hover-color);
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
    }
    
    /* --- Alerts & Notices --- */
    .login-prompt {
        background-color: var(--background-light);
        border: 1px solid var(--border-color);
    }
    
    .pickup-notice {
        background-color: rgba(0, 86, 210, 0.05); /* Light blue background */
        border-left: 4px solid var(--primary-color);
        color: #1c5b9f;
    }

    .form-text {
        font-size: 0.875rem;
    }
</style>

<div class="container my-5 py-4">
    <div class="campaign-header text-center mb-5">
        <h1 class="campaign-title"><?= htmlspecialchars($campaign->title); ?></h1>
        <p class="lead organizer-info mt-3">
            Diselenggarakan oleh <strong><a href="#"><?= htmlspecialchars($campaign->lembaga_name ?? 'Lembaga Terpercaya'); ?></a></strong>
        </p>
    </div>

    <div class="row g-5">
        <div class="col-lg-7">
            <img 
                src="<?= base_url('uploads/campaigns/' . ($campaign->image_url ?? 'default.jpg')); ?>" 
                class="campaign-main-image mb-5" 
                alt="<?= htmlspecialchars($campaign->title); ?>"
            >

            <div class="content-section">
                <h4>Tentang Kampanye Ini</h4>
                <div class="mt-3 campaign-description">
                    <?= nl2br(htmlspecialchars($campaign->description)); ?>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card sticky-top donation-form-card" style="top: 2rem;">
                <div class="card-header text-center">
                    <h4 class="mb-0 fw-bold">Salurkan Bantuan Anda</h4>
                </div>
                <div class="card-body">

                    <?php if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'donatur'): ?>
                        <div class="alert login-prompt text-center rounded-3 p-4">
                            <i class="bi bi-box-arrow-in-right fs-2 text-primary mb-3 d-block"></i>
                            <p class="mb-3">Silakan login sebagai donatur untuk melanjutkan donasi.</p>
                            <a href="<?= site_url('auth/login'); ?>" class="btn btn-primary px-4">Login Sekarang</a>
                        </div>
                    <?php else: ?>
                        
                        <?php 
                            $error_validation = $this->session->flashdata('error_validation');
                            $error_upload = $this->session->flashdata('error_upload');
                        ?>
                        <?php if (!empty($error_validation)): ?>
                            <div class="alert alert-danger d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $error_validation; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($error_upload)): ?>
                            <div class="alert alert-danger d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $error_upload; ?>
                            </div>
                        <?php endif; ?>

                        <?= form_open_multipart('donatur/donasi/submit/' . $campaign->campaign_id, ['class' => 'donation-form']); ?>

                            <div class="mb-3">
                                <label for="item_name" class="form-label">Nama/Deskripsi Barang</label>
                                <input type="text" name="item_name" id="item_name" class="form-control" value="<?= set_value('item_name'); ?>" required placeholder="Contoh: 1 kardus pakaian layak pakai">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-7 mb-3">
                                    <label for="quantity" class="form-label">Jumlah</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" value="<?= set_value('quantity', 1); ?>" min="1">
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="item_condition" class="form-label">Kondisi</label>
                                    <select name="item_condition" id="item_condition" class="form-select" required>
                                        <option value="Layak Pakai" <?= set_select('item_condition', 'Layak Pakai', TRUE); ?>>Layak Pakai</option>
                                        <option value="Baru" <?= set_select('item_condition', 'Baru'); ?>>Baru</option>
                                        <option value="Bekas" <?= set_select('item_condition', 'Bekas'); ?>>Bekas</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="item_image" class="form-label">Foto Barang <span class="text-muted fw-normal">(Opsional)</span></label>
                                <input type="file" name="item_image" id="item_image" class="form-control">
                                <div class="form-text mt-2">Format: JPG, PNG. Ukuran Maks: 2MB.</div>
                            </div>

                            <div class="alert pickup-notice small p-3 text-center mb-4 rounded-3">
                                <i class="bi bi-info-circle-fill me-2"></i> Tim kami akan menghubungi Anda untuk mengatur jadwal penjemputan barang.
                            </div>

                            <div class="d-grid">
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