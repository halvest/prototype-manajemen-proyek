<style>
    .stat-card-donatur {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        text-align: center;
        border: 1px solid #e9ecef;
    }
    .stat-card-donatur i {
        font-size: 2.5rem;
        color: #1DD2B6;
        margin-bottom: 1rem;
    }
    .stat-card-donatur h3 {
        font-size: 2rem;
        font-weight: 700;
        color: #343a40;
    }
    .stat-card-donatur p {
        color: #6c757d;
        margin-bottom: 0;
    }
    .campaign-card {
        border-radius: 12px;
        border: 1px solid #e9ecef;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        background-color: white;
        transition: all .3s ease;
        overflow: hidden;
    }
    .campaign-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
</style>

<header class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 fw-bold mb-0">Selamat datang, <?= htmlspecialchars($user_name ?? 'Donatur Hebat'); ?>!</h2>
        <p class="text-muted">Terima kasih telah menjadi bagian dari gerakan kebaikan ini.</p>
    </div>
</header>

<div class="row g-4 mb-5">
    <div class="col-md-6">
        <div class="stat-card-donatur">
            <i class="bi bi-box-seam-fill"></i>
            <?php ?>
            <h3><?= $stats['total_donasi'] ?? 0; ?></h3>
            <p>Total Barang Didonasikan</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card-donatur">
            <i class="bi bi-patch-check-fill"></i>
            <?php ?>
            <h3><?= $stats['donasi_terkirim'] ?? 0; ?></h3>
            <p>Donasi Terkonfirmasi</p>
        </div>
    </div>
</div>


<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="h5 fw-bold mb-0">Bantu Kampanye yang Berlangsung</h3>
    <a href="<?= site_url('campaigns'); ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
</div>

<div class="row g-4">
    <?php if (!empty($campaigns)): ?>
        <?php foreach ($campaigns as $campaign): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card campaign-card h-100">
                    <img src="<?= base_url('uploads/campaigns/' . ($campaign->image_url ?? 'default.jpg')); ?>" class="card-img-top" alt="<?= htmlspecialchars($campaign->title); ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($campaign->title); ?></h5>
                        <p class="card-text small text-muted flex-grow-1">
                            <?= character_limiter(strip_tags($campaign->description), 80); ?>
                        </p>
                        <?php ?>
                        <a href="<?= site_url('campaigns/detail/' . $campaign->campaign_id); ?>" class="btn btn-primary mt-3" style="background-color: #1DD2B6; border:none;">Lihat Detail & Donasi</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-info text-center">Saat ini tidak ada kampanye yang aktif.</div>
        </div>
    <?php endif; ?>
</div>
