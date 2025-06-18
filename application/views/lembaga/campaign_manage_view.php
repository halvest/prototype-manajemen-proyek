<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Kelola Kampanye Anda</h3>
    <a href="<?= site_url('lembaga/campaign/create'); ?>" class="btn btn-primary" style="background-color: #1abc9c; border:none;">
        <i class="bi bi-plus-lg"></i> Buat Kampanye Baru
    </a>
</div>

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<div class="campaign-list">
    <?php if(!empty($campaigns)): ?>
        <?php foreach($campaigns as $item): ?>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-3">
                        <img src="<?= base_url('uploads/campaigns/' . ($item->image_url ?? 'default.jpg')); ?>" 
                             class="img-fluid rounded-start w-100" 
                             alt="<?= htmlspecialchars($item->title); ?>" 
                             style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body d-flex flex-column h-100">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h5 class="card-title mb-1"><?= htmlspecialchars($item->title); ?></h5>
                                    <span class="badge text-bg-success"><?= ucfirst($item->status); ?></span>
                                </div>
                                <div class="btn-group">
                                    <a href="<?= site_url('lembaga/campaign/edit/' . $item->campaign_id); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </a>
                                    <a href="<?= site_url('lembaga/campaign/delete/' . $item->campaign_id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kampanye ini?')">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </a>
                                </div>
                            </div>

                            <p class="card-text text-muted">
                                <?= word_limiter(htmlspecialchars($item->description), 35); ?>
                            </p>

                            <div class="mt-auto">
                                <small class="text-muted">
                                    <strong>Kategori:</strong> <?= htmlspecialchars($item->category); ?> | 
                                    <strong>Dibuat pada:</strong> <?= date('d M Y', strtotime($item->created_at)); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card text-center py-5">
            <div class="card-body">
                <p class="mb-0">Anda belum membuat kampanye apapun.</p>
            </div>
        </div>
    <?php endif; ?>
</div>