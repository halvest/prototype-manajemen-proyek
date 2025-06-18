<header class="d-flex justify-content-between align-items-center mb-5">
    <h2>Selamat datang, <?= htmlspecialchars($user_name ?? 'Pengguna'); ?>!</h2>
    <div>
        </div>
</header>

<div class="row g-4">
    <div class="col-md-4">
        <div class="stat-card">
            <p class="text-muted">Jangkauan Postingan</p>
            <h1><?= $stats['post_reach'] ?? 'N/A'; ?></h1>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <p class="text-muted">Donasi Diterima</p>
            <h1><?= $stats['donations_received'] ?? 0; ?></h1>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <p class="text-muted">Jumlah Postingan</p>
            <h1><?= $stats['total_posts'] ?? 0; ?></h1>
        </div>
    </div>
</div>

<div class="card mt-5">
    <div class="card-body">
        <h5 class="card-title">Aktivitas Terbaru</h5>
        <p class="card-text">Belum ada aktivitas terbaru untuk ditampilkan.</p>
    </div>
</div>