<style>
    /* CSS Anda sudah bagus, tidak perlu diubah */
    .page-title-bar {
        background-color: #1DD2B6; /* Warna teal */
        padding: 1rem 0;
        text-align: center;
        color: white;
    }
    .page-title-bar h1 {
        font-weight: 700;
    }
    .campaign-section {
        background-color: #f8f9fa;
        padding: 4rem 0;
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
    .campaign-card .card-body {
        padding: 1.5rem;
    }
    .campaign-card .card-title {
        font-weight: 600;
        color: #333;
    }
    .campaign-card .card-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }
    .campaign-card .card-meta .donasi-count {
        color: var(--teal-color, #1DD2B6);
        font-weight: 600;
    }
    .campaign-card .btn-bookmark {
        color: #6c757d;
        border: 1px solid #ced4da;
    }
</style>

<section class="page-title-bar">
    <div class="container">
        <h1>Kampanye Donasi Aktif</h1>
    </div>
</section>

<main class="campaign-section">
    <div class="container">
        <div class="row g-4">
            <?php if (!empty($campaigns)): ?>
                <?php foreach($campaigns as $campaign): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card campaign-card h-100">
                        
                        <img src="<?= htmlspecialchars($campaign->image_url ?? base_url('assets/images/placeholder.jpg')); ?>" class="card-img-top" alt="<?= htmlspecialchars($campaign->title ?? 'Gambar Kampanye'); ?>" style="height: 200px; object-fit: cover;">
                        
                        <div class="card-body d-flex flex-column">
                            <div class="card-meta d-flex justify-content-between mb-2">
                                <span><?= htmlspecialchars($campaign->lembaga_name ?? 'Lembaga Amal'); ?></span>
                                <span class="donasi-count">23 Donasi</span>
                            </div>

                            <h5 class="card-title mb-2">
                                <?= htmlspecialchars($campaign->title ?? 'Judul Kampanye Tidak Tersedia'); ?>
                            </h5>
                            <p class="card-text text-secondary small flex-grow-1">
                                <?= word_limiter(htmlspecialchars($campaign->description ?? 'Deskripsi tidak tersedia.'), 20); ?>
                            </p>
                            
                            <div class="d-flex mt-3">
                                <a href="#" class="btn btn-sm btn-bookmark me-2"><i class="bi bi-bookmark"></i></a>
                                <a href="#" class="btn btn-primary custom-btn w-100" style="padding: 8px 20px !important; font-size: 0.9rem !important;">Donasikan Sekarang!</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col">
                    <p class="text-center">Belum ada kampanye yang bisa ditampilkan.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-5">
            <a href="#" class="btn btn-primary custom-btn">Selengkapnya</a>
        </div>
    </div>
</main>