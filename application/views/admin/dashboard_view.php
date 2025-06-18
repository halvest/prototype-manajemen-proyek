<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Pengguna</h5>
                <p class="card-text fs-2 fw-bold"><?= $total_users ?? 0; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Kampanye</h5>
                <p class="card-text fs-2 fw-bold"><?= $total_campaigns ?? 0; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Kampanye Perlu Persetujuan</h5>
                <p class="card-text fs-2 fw-bold"><?= $pending_campaigns ?? 0; ?></p>
            </div>
        </div>
    </div>
</div>

<h4 class="mb-3">Kampanye Belum Disetujui</h4>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Judul Kampanye</th>
                <th>Lembaga</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($campaign_list)): ?>
                <?php $no = 1; foreach ($campaign_list as $c): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $c['judul']; ?></td>
                    <td><?= $c['nama_lembaga']; ?></td>
                    <td><?= date('d M Y', strtotime($c['tanggal_dibuat'])); ?></td>
                    <td><span class="badge bg-warning text-dark">Menunggu</span></td>
                    <td>
                        <a href="<?= site_url('admin/campaign/detail/' . $c['id']); ?>" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="<?= site_url('admin/campaign/edit/' . $c['id']); ?>" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="<?= site_url('admin/campaign/approve/' . $c['id']); ?>" class="btn btn-sm btn-success" onclick="return confirm('Setujui kampanye ini?')">
                            <i class="bi bi-check2-circle"></i>
                        </a>
                        <a href="<?= site_url('admin/campaign/delete/' . $c['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kampanye ini?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">Tidak ada kampanye yang menunggu persetujuan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
