<style>
    .donation-card {
        transition: all 0.2s ease-in-out;
        background-color: #fff;
    }
    .donation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .donation-img-container {
        width: 80px;
        height: 80px;
        overflow: hidden;
        border-radius: 0.5rem;
        flex-shrink: 0;
    }
    .donation-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .status-badge {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.4em 0.8em;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="h4">Donasi Masuk</h3>
</div>

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="list-group">
    <?php if (!empty($donations)): ?>
        <?php foreach ($donations as $donation): ?>
            <div class="list-group-item d-flex flex-column flex-md-row align-items-center p-3 mb-3 border rounded donation-card">
                <div class="donation-img-container me-md-4 mb-3 mb-md-0">
                    <img src="<?= base_url('uploads/donations/' . ($donation->item_image_url ?? 'default-donation.png')); ?>" 
                         class="donation-img" 
                         alt="<?= htmlspecialchars($donation->item_name); ?>"
                         onerror="this.src='https://placehold.co/80x80/e9ecef/6c757d?text=No+Img'">
                </div>
                <div class="flex-grow-1">
                    <small class="text-muted">ID: #<?= $donation->donation_id; ?> &bull; <?= date('d M Y', strtotime($donation->created_at)); ?></small>
                    <h6 class="mb-1 mt-1">
                        <strong class="text-primary"><?= htmlspecialchars($donation->donator_name ?? 'Donatur'); ?></strong> berdonasi 
                        <strong>"<?= htmlspecialchars($donation->item_name); ?>"</strong>
                    </h6>
                    <p class="mb-1 small text-muted">Untuk kampanye: <?= htmlspecialchars($donation->campaign_title); ?></p>
                </div>
                <div class="mt-3 mt-md-0 ms-md-3 d-flex align-items-center flex-shrink-0">
                    <?php
                        $status_class = 'bg-secondary';
                        if ($donation->current_status == 'Pending') $status_class = 'bg-warning text-dark';
                        if ($donation->current_status == 'Received') $status_class = 'bg-success';
                        if ($donation->current_status == 'Dalam Proses') $status_class = 'bg-info text-dark';
                        if ($donation->current_status == 'Dibatalkan') $status_class = 'bg-danger';
                    ?>
                    <span class="badge rounded-pill me-3 <?= $status_class ?> status-badge"><?= htmlspecialchars($donation->current_status); ?></span>
                    <div class="btn-group">
                        <a href="<?= site_url('lembaga/donations/view/' . $donation->donation_id); ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Status
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
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <h5 class="mt-3">Belum Ada Donasi Masuk</h5>
            <p class="text-muted">Saat ada donasi baru, akan muncul di sini.</p>
        </div>
    <?php endif; ?>
</div>
