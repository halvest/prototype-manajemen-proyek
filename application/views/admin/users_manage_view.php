<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Manajemen Pengguna</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Peran</th>
                        <th>Status Verifikasi</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user->user_id; ?></td>
                                <td><?= htmlspecialchars($user->name); ?></td>
                                <td><?= htmlspecialchars($user->email); ?></td>
                                <td><?= ucfirst(htmlspecialchars($user->role)); ?></td>
                                <td>
                                    <?php if ($user->role == 'lembaga'): ?>
                                        <?php
                                            $verif = $user->verification_status ?? 'pending';
                                            $badge_class = 'bg-warning text-dark';
                                            if ($verif === 'verified') $badge_class = 'bg-success';
                                        ?>
                                        <span class="badge <?= $badge_class; ?>">
                                            <?= ucfirst($verif); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <?php if ($user->role == 'lembaga' && ($user->verification_status ?? 'pending') !== 'verified'): ?>
                                        <a href="<?= site_url('admin/dashboard/verify_user/' . $user->user_id); ?>" class="btn btn-sm btn-info" onclick="return confirm('Verifikasi lembaga ini?')">
                                            <i class="bi bi-check-circle-fill me-1"></i> Verifikasi
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Tidak ada pengguna terdaftar.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
