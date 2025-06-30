<style>
    .stat-card {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid #e9ecef;
        text-align: center;
    }
    .stat-card i {
        font-size: 2.5rem;
        color: #1DD2B6;
        margin-bottom: 1rem;
    }
    .stat-card h3 {
        font-size: 2rem;
        font-weight: 700;
        color: #343a40;
    }
    .stat-card p {
        color: #6c757d;
        margin-bottom: 0;
    }
</style>

<header class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 fw-bold mb-0">Selamat datang, <?= htmlspecialchars($user_name ?? 'Lembaga'); ?>!</h2>
        <p class="text-muted">Kelola kampanye dan donasi Anda di sini.</p>
    </div>
    <div>
        <a href="<?= site_url('lembaga/campaign/create'); ?>" class="btn btn-primary" style="background-color: #1abc9c; border:none;">
            <i class="bi bi-plus-lg me-2"></i>Buat Kampanye Baru
        </a>
    </div>
</header>

<!-- Statistik Lembaga -->
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="stat-card">
            <i class="bi bi-file-earmark-text-fill"></i>
            <h3><?= $stats['total_posts'] ?? 0; ?></h3>
            <p>Total Postingan</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <i class="bi bi-box2-heart-fill"></i>
            <h3><?= $stats['donations_received'] ?? 0; ?></h3>
            <p>Donasi Diterima</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <i class="bi bi-broadcast"></i>
            <h3><?= $stats['post_reach'] ?? 'N/A'; ?></h3>
            <p>Jangkauan Postingan</p>
        </div>
    </div>
</div>

<!-- Aktivitas Donasi Terbaru -->
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Aktivitas Donasi Terbaru</h5>
    </div>
    <div class="list-group list-group-flush">
        <?php if (!empty($recent_donations)): ?>
            <?php foreach($recent_donations as $donation): ?>
                <a href="<?= site_url('lembaga/donations/view/' . $donation->donation_id); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?= htmlspecialchars($donation->donator_name); ?></strong> berdonasi 
                        "<?= htmlspecialchars($donation->item_name); ?>"
                        <br>
                        <small class="text-muted">untuk kampanye: <?= htmlspecialchars($donation->campaign_title); ?></small>
                    </div>
                    <span class="badge bg-info text-dark"><?= htmlspecialchars($donation->current_status); ?></span>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="list-group-item text-center p-4">
                <p class="text-muted mb-0">Belum ada aktivitas donasi terbaru.</p>
            </div>
        <?php endif; ?>
    </div>
    <div class="card-footer bg-white text-center">
        <a href="<?= site_url('lembaga/donations'); ?>">Lihat Semua Donasi</a>
    </div>
</div>
