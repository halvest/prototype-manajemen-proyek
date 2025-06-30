<style>
    .history-card {
        transition: all 0.2s ease-in-out;
        background-color: #fff;
        border: 1px solid #e9ecef;
    }
    .history-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }
    .history-img-container {
        width: 100px;
        height: 100px;
        overflow: hidden;
        border-radius: 0.5rem;
        flex-shrink: 0;
    }
    .history-img {
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
    <h3 class="h4">Riwayat Donasi Anda</h3>
</div>

<div class="list-group">
    <?php if (!empty($donations)): ?>
        <?php foreach ($donations as $donation): ?>
            <div class="list-group-item d-flex flex-column flex-md-row align-items-center p-3 mb-3 rounded history-card">
                <div class="history-img-container me-md-4 mb-3 mb-md-0">
                    <img src="<?= base_url('uploads/donations/' . ($donation->item_image_url ?? 'default-donation.png')); ?>" 
                         class="history-img" 
                         alt="<?= htmlspecialchars($donation->item_name); ?>"
                         onerror="this.src='https://placehold.co/100x100/e9ecef/6c757d?text=No+Img'">
                </div>
                <div class="flex-grow-1">
                    <small class="text-muted">ID: #<?= $donation->donation_id; ?> &bull; <?= date('d F Y', strtotime($donation->created_at)); ?></small>
                    <h6 class="mb-1 mt-1">
                        <strong><?= htmlspecialchars($donation->item_name); ?></strong>
                    </h6>
                    <p class="mb-1 small text-muted">Untuk kampanye: <?= htmlspecialchars($donation->campaign_title ?? 'N/A'); ?></p>
                </div>
                <div class="mt-3 mt-md-0 ms-md-3 text-center">
                    <?php
                        $status_class = 'bg-secondary';
                        $status_icon = 'bi-hourglass-split';
                        if ($donation->current_status == 'Pending') {
                            $status_class = 'bg-warning text-dark';
                            $status_icon = 'bi-clock-history';
                        }
                        if ($donation->current_status == 'Received' || $donation->current_status == 'Terkirim') {
                            $status_class = 'bg-success';
                            $status_icon = 'bi-check-circle-fill';
                        }
                        if ($donation->current_status == 'Dalam Proses') {
                             $status_class = 'bg-info text-dark';
                             $status_icon = 'bi-truck';
                        }
                    ?>
                    <span class="badge rounded-pill <?= $status_class ?> status-badge">
                        <i class="bi <?= $status_icon ?> me-1"></i>
                        <?= htmlspecialchars($donation->current_status); ?>
                    </span>
                    <a href="<?= site_url('donatur/tracking?id=' . $donation->donation_id); ?>" class="btn btn-sm btn-outline-primary mt-2">Lacak Pengiriman</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <h5 class="mt-3">Anda Belum Pernah Berdonasi</h5>
            <p class="text-muted">Ayo mulai berdonasi dan bantu sesama!</p>
            <a href="<?= site_url('home'); ?>" class="btn btn-primary mt-2">Cari Kampanye</a>
        </div>
    <?php endif; ?>
</div>
