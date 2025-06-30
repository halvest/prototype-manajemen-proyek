<style>
    .detail-card {
        box-shadow: 0 4px 25px rgba(0,0,0,0.08);
        border: none;
        border-radius: 0.75rem;
    }
    .detail-img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 0.75rem;
    }
    .info-list .info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .info-list .info-item:last-child {
        border-bottom: none;
    }
    .info-list .info-label {
        color: #6c757d;
    }
    .info-list .info-value {
        font-weight: 500;
        color: #343a40;
        text-align: right;
    }
    .status-badge {
        font-size: 0.9rem;
        font-weight: 600;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="h4 mb-0">Detail Donasi <span class="text-primary">#<?= htmlspecialchars($donation->donation_id); ?></span></h3>
    <a href="<?= site_url('lembaga/donations'); ?>" class="btn btn-light">
        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Donasi
    </a>
</div>

<div class="card detail-card">
    <div class="card-body p-4 p-lg-5">
        <div class="row g-5">
            <div class="col-lg-5">
                <h5 class="mb-3">Foto Barang</h5>
                <?php if (!empty($donation->item_image_url)): ?>
                    <img src="<?= base_url('uploads/donations/' . $donation->item_image_url); ?>" class="img-fluid rounded detail-img" alt="Foto Barang" onerror="this.src='https://placehold.co/600x400/e9ecef/6c757d?text=Image+Not+Found'">
                <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center bg-light rounded detail-img">
                        <p class="text-muted mb-0">Tidak ada foto</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-7">
                <h5 class="mb-3">Informasi Donasi</h5>
                <div class="info-list">
                    <div class="info-item">
                        <span class="info-label">Nama Barang</span>
                        <span class="info-value"><?= htmlspecialchars($donation->item_name); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Jumlah</span>
                        <span class="info-value"><?= htmlspecialchars($donation->quantity); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Kondisi</span>
                        <span class="info-value"><?= htmlspecialchars($donation->item_condition); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Untuk Kampanye</span>
                        <span class="info-value"><?= htmlspecialchars($donation->campaign_title); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Donasi</span>
                        <span class="info-value"><?= date('d F Y', strtotime($donation->created_at)); ?></span>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">Informasi Donatur</h5>
                <div class="info-list">
                    <div class="info-item">
                        <span class="info-label">Nama Donatur</span>
                        <span class="info-value"><?= htmlspecialchars($donation->donator_name); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value"><?= htmlspecialchars($donation->donator_email); ?></span>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="info-label d-block">Status Saat Ini</span>
                        <?php
                            $status_class = 'bg-secondary';
                            if ($donation->current_status == 'Pending') $status_class = 'bg-warning text-dark';
                            if ($donation->current_status == 'Received') $status_class = 'bg-success';
                            if ($donation->current_status == 'Dalam Proses') $status_class = 'bg-info text-dark';
                            if ($donation->current_status == 'Dibatalkan') $status_class = 'bg-danger';
                        ?>
                        <span class="badge rounded-pill <?= $status_class ?> status-badge"><?= htmlspecialchars($donation->current_status); ?></span>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-pencil-square me-2"></i>Ubah Status
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><?= form_open('lembaga/donations/update_status/' . $donation->donation_id, ['class' => 'd-inline']); ?>
                                    <input type="hidden" name="status" value="Dalam Proses">
                                    <button type="submit" class="dropdown-item">Dalam Proses</button>
                                <?= form_close(); ?></li>
                            <li><?= form_open('lembaga/donations/update_status/' . $donation->donation_id, ['class' => 'd-inline']); ?>
                                    <input type="hidden" name="status" value="Received">
                                    <button type="submit" class="dropdown-item">Diterima</button>
                                <?= form_close(); ?></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><?= form_open('lembaga/donations/update_status/' . $donation->donation_id, ['class' => 'd-inline']); ?>
                                    <input type="hidden" name="status" value="Dibatalkan">
                                    <button type="submit" class="dropdown-item text-danger">Batalkan</button>
                                <?= form_close(); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
