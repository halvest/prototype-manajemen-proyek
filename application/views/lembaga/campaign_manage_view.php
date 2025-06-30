<style>
    .campaign-manage-card {
        transition: all 0.2s ease-in-out;
        background-color: #fff;
    }
    .campaign-manage-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .campaign-img-container {
        width: 120px;
        height: 120px;
        overflow: hidden;
        border-radius: 0.5rem;
        flex-shrink: 0;
    }
    .campaign-img {
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
    <h3 class="h4">Kelola Kampanye Anda</h3>
    <a href="<?= site_url('lembaga/dashboard/create_campaign'); ?>" class="btn btn-primary" style="background-color: #1abc9c; border:none;">
        <i class="bi bi-plus-lg"></i> Buat Kampanye Baru
    </a>
</div>

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="list-group">
    <?php if (!empty($campaigns)): ?>
        <?php foreach ($campaigns as $item): ?>
            <div class="list-group-item d-flex flex-column flex-md-row align-items-center p-3 mb-3 border rounded campaign-manage-card">
                <div class="campaign-img-container me-md-4 mb-3 mb-md-0">
                    <img src="<?= base_url('uploads/campaigns/' . ($item->image_url ?? 'default.jpg')); ?>" 
                         class="campaign-img" 
                         alt="<?= htmlspecialchars($item->title); ?>"
                         onerror="this.src='https://placehold.co/120x120/e9ecef/6c757d?text=No+Img'">
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1"><?= htmlspecialchars($item->title); ?></h5>
                        <?php
                            $status_class = 'bg-secondary';
                            if ($item->status == 'pending') $status_class = 'bg-warning text-dark';
                            if ($item->status == 'active') $status_class = 'bg-success';
                            if ($item->status == 'rejected') $status_class = 'bg-danger';
                        ?>
                        <span class="badge rounded-pill <?= $status_class ?> status-badge"><?= ucfirst($item->status); ?></span>
                    </div>
                    <p class="mb-2 small text-muted">
                        Kategori: <?= htmlspecialchars($item->category); ?> &bull; Dibuat: <?= date('d M Y', strtotime($item->created_at)); ?>
                    </p>
                    <p class="mb-2">
                        <i class="bi bi-gift-fill text-success"></i> 
                        <strong><?= $item->donation_count ?? 0; ?></strong> donasi diterima.
                    </p>
                </div>
                <div class="mt-3 mt-md-0 ms-md-3 d-flex align-items-center flex-shrink-0">
                    <div class="btn-group">
                        <a href="<?= site_url('lembaga/dashboard/edit_campaign/' . $item->campaign_id); ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil-fill"></i> Edit
                        </a>
                        <a href="<?= site_url('lembaga/dashboard/delete_campaign/' . $item->campaign_id); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kampanye ini?')">
                            <i class="bi bi-trash-fill"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-file-earmark-plus fs-1 text-muted"></i>
            <h5 class="mt-3">Anda Belum Membuat Kampanye</h5>
            <p class="text-muted">Ayo buat kampanye pertama Anda dan mulai gerakan kebaikan.</p>
            <a href="<?= site_url('lembaga/dashboard/create_campaign'); ?>" class="btn btn-primary" style="background-color: #1abc9c; border:none;">
                Buat Kampanye Sekarang
            </a>
        </div>
    <?php endif; ?>
</div>
