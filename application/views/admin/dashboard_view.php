<style>
    .stat-card {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid #e9ecef;
        display: flex;
        align-items: center;
    }
    .stat-card .icon {
        font-size: 2.5rem;
        padding: 1rem;
        border-radius: 50%;
        margin-right: 1.5rem;
    }
    .stat-card .card-text-container h5 { font-weight: 600; font-size: 1rem; color: #6c757d; }
    .stat-card .card-text-container p { font-size: 2rem; font-weight: 700; color: #343a40; margin-bottom: 0; }
    .pending-item { transition: all 0.2s ease-in-out; }
    .pending-item:hover { background-color: #f8f9fa; }
</style>

<div class="row g-4 mb-5">
    <div class="col-lg-4 col-md-6">
        <div class="stat-card">
            <div class="icon text-primary bg-primary-subtle"><i class="bi bi-people-fill"></i></div>
            <div class="card-text-container">
                <h5 class="card-title">Total Pengguna</h5>
                <p class="card-text"><?= $total_users ?? 0; ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="stat-card">
            <div class="icon text-success bg-success-subtle"><i class="bi bi-megaphone-fill"></i></div>
            <div class="card-text-container">
                <h5 class="card-title">Total Kampanye</h5>
                <p class="card-text"><?= $total_campaigns ?? 0; ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="stat-card">
            <div class="icon text-warning bg-warning-subtle"><i class="bi bi-patch-question-fill"></i></div>
            <div class="card-text-container">
                <h5 class="card-title">Perlu Persetujuan</h5>
                <p class="card-text"><?= $pending_campaigns ?? 0; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Kampanye Menunggu Persetujuan</h5>
    </div>
    <div class="list-group list-group-flush">
        <?php if (!empty($pending_campaign_list)): ?>
            <?php foreach ($pending_campaign_list as $campaign): ?>
                <div class="list-group-item d-flex justify-content-between align-items-center pending-item p-3">
                    <div>
                        <h6 class="mb-0"><?= htmlspecialchars($campaign->title); ?></h6>
                        <small class="text-muted">Oleh: <?= htmlspecialchars($campaign->lembaga_name); ?> pada <?= date('d M Y', strtotime($campaign->created_at)); ?></small>
                    </div>
                    <div class="btn-group">
                        <a href="<?= site_url('admin/dashboard/approve/' . $campaign->campaign_id); ?>" class="btn btn-sm btn-outline-success" onclick="return confirm('Setujui kampanye ini?')">
                            <i class="bi bi-check-circle"></i> Setujui
                        </a>
                        <a href="<?= site_url('admin/dashboard/reject/' . $campaign->campaign_id); ?>" class="btn btn-sm btn-outline-warning" onclick="return confirm('Tolak kampanye ini?')">
                            <i class="bi bi-x-circle"></i> Tolak
                        </a>
                        <a href="<?= site_url('admin/dashboard/edit/' . $campaign->campaign_id); ?>" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="list-group-item text-center p-4">
                <p class="text-muted mb-0">Tidak ada kampanye yang menunggu persetujuan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
