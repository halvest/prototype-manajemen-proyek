<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
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
                            <td><?= htmlspecialchars($user->name); ?></td>
                            <td><?= htmlspecialchars($user->email); ?></td>
                            <td><?= ucfirst(htmlspecialchars($user->role)); ?></td>
                            <td>
                                <?php if ($user->role == 'lembaga'): ?>
                                    <?php
                                        $verif = $user->verification_status ?? 'pending';
                                        $badge_class = $verif === 'verified' ? 'success' : 'warning';
                                    ?>
                                    <span class="badge text-bg-<?= $badge_class; ?>">
                                        <?= ucfirst($verif); ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <?php if ($user->role == 'lembaga' && $user->verification_status !== 'verified'): ?>
                                    <a href="<?= site_url('admin/dashboard/verify/' . $user->user_id); ?>" class="btn btn-sm btn-info">
                                        Verifikasi
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada pengguna terdaftar.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
