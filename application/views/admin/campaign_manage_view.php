<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Preview</th>
                    <th>Judul & Deskripsi</th>
                    <th>Lembaga</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($campaigns)): ?>
                    <?php foreach ($campaigns as $c): ?>
                        <tr>
                            <!-- Thumbnail -->
                            <td style="width: 100px;">
                                <?php if (!empty($c->image)): ?>
                                    <img src="<?= base_url('uploads/campaigns/' . $c->image); ?>" alt="Thumbnail" class="img-thumbnail" style="max-width: 80px;">
                                <?php else: ?>
                                    <div class="bg-secondary text-white text-center p-2 rounded" style="width: 80px; font-size: 0.8rem;">Tidak Ada</div>
                                <?php endif; ?>
                            </td>

                            <!-- Judul & Deskripsi -->
                            <td>
                                <strong><?= htmlspecialchars($c->title); ?></strong><br>
                                <span class="text-muted" style="font-size: 0.9rem;">
                                    <?= character_limiter(strip_tags($c->description), 100); ?>
                                </span>
                            </td>

                            <!-- Nama Lembaga -->
                            <td><?= htmlspecialchars($c->lembaga_name); ?></td>

                            <!-- Status -->
                            <td>
                                <?php
                                    switch ($c->status) {
                                        case 'active':   $status_class = 'success'; break;
                                        case 'pending':  $status_class = 'warning'; break;
                                        case 'rejected': $status_class = 'danger';  break;
                                        default:         $status_class = 'secondary';
                                    }
                                ?>
                                <span class="badge text-bg-<?= $status_class; ?>"><?= ucfirst($c->status); ?></span>
                            </td>

                            <!-- Aksi -->
                            <td class="text-end">
                                <?php if ($c->status === 'pending'): ?>
                                    <a href="<?= site_url('admin/dashboard/approve/' . $c->campaign_id); ?>" class="btn btn-sm btn-success">Setujui</a>
                                    <a href="<?= site_url('admin/dashboard/reject/' . $c->campaign_id); ?>" class="btn btn-sm btn-dark">Tolak</a>
                                <?php endif; ?>
                                <a href="<?= site_url('admin/dashboard/edit/' . $c->campaign_id); ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= site_url('admin/dashboard/delete/' . $c->campaign_id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus kampanye ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Belum ada kampanye.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
