<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --teal-color: #1DD2B6;
        --teal-dark: #0f9885;
        --light-gray: #f1f4f8;
        --dark-text: #212529;
        --muted-text: #6c757d;
        --glass-white: rgba(255, 255, 255, 0.7);
        --shadow-color: rgba(0, 0, 0, 0.1);
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fff;
        color: var(--dark-text);
    }

    /* Global Section Padding */
    section {
        padding: rem 0;
    }

    .section-title-bar {
        background: linear-gradient(90deg, #1DD2B6, #0fb99c);
        padding: 2rem 0;
        text-align: center;
        color: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 3rem;
    }

    .section-title-bar h2 {
        font-weight: 700;
        font-size: 2rem;
        margin: 0;
    }

    .section-heading {
        font-weight: 700;
        font-size: 1.75rem;
        color: var(--dark-text);
    }

    .hero-section {
        background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        padding: 5rem 0;
    }

    .phone-img {
        max-width: 80%;
        animation: float 4s ease-in-out infinite;
        filter: drop-shadow(0 10px 25px rgba(0, 0, 0, 0.1));
    }

    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0); }
    }

    .custom-btn {
        background: linear-gradient(135deg, #1DD2B6, #0fb99c);
        color: white;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        border-radius: 50px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(29, 210, 182, 0.3);
    }

    .custom-btn:hover {
        background: linear-gradient(135deg, #0fb99c, #0f9885);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .about-section,
    .testimonial-section,
    .campaign-section {
        padding: 5rem 0;
    }

    .about-content {
        line-height: 1.8;
        color: var(--muted-text);
    }

    .campaign-section {
        background-color: var(--light-gray);
    }

    .campaign-card {
        border-radius: 1rem;
        overflow: hidden;
        border: none;
        background: white;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease-in-out;
    }

    .campaign-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .campaign-card .card-body {
        padding: 1.5rem;
    }

    .campaign-card .card-title a {
        font-weight: 600;
        color: var(--dark-text);
        text-decoration: none;
        transition: color 0.2s;
    }

    .campaign-card .card-title a:hover {
        color: var(--teal-dark);
    }

    .campaign-card .card-meta {
        font-size: 0.85rem;
        color: var(--muted-text);
    }

    .donasi-count {
        color: var(--teal-color);
        font-weight: 600;
    }

    .testimonial-box {
        max-width: 720px;
        margin: auto;
        padding: 2.5rem;
        background: var(--glass-white);
        backdrop-filter: blur(8px);
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        color: #1c3f3a;
    }

    .quote-icon {
        font-size: 4rem;
        color: rgba(0, 0, 0, 0.15);
    }

    .testimonial-author {
        font-weight: 600;
        color: #444;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: brightness(0) invert(1);
    }

    .btn-outline-success {
        border-radius: 50px;
        padding: 0.6rem 1.5rem;
        font-weight: 500;
        transition: 0.3s ease;
    }

    .btn-outline-success:hover {
        background-color: var(--teal-color);
        color: white;
        border-color: var(--teal-color);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .lead {
        color: var(--muted-text);
        font-size: 1.125rem;
    }

    .text-secondary {
        color: var(--muted-text) !important;
    }
</style>

<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">


<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5 py-5">
            <div class="col-lg-5 text-center d-none d-lg-block">
                <img src="<?= base_url('assets/img/Phone.png'); ?>" alt="Relf Connect App" class="phone-img" onerror="this.style.display='none'">
            </div>
            <div class="col-lg-7">
                <h1 class="display-4 fw-bold">Hubungkan Kebaikan, Melalui Relf Connect</h1>
                <div class="decorative-line my-3">
                    <svg width="150" height="15" viewBox="0 0 150 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 13C27.3077 4.33333 88.5 -5.5 148 13" stroke="#1DD2B6" stroke-width="4" stroke-linecap="round"/>
                    </svg>
                </div>
                <p class="lead my-4 text-secondary">Relf Connect adalah platform donasi barang bekas berbasis web yang menghubungkan donatur dengan lembaga amal.</p>
                <a href="<?= site_url('auth/register'); ?>" class="btn btn-primary custom-btn shadow-sm">Daftar Akun Lembaga Amal?</a>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="section-title-bar">
    <div class="container"><h2>Tentang Kami</h2></div>
</section>
<section class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center about-content">
                <h3 class="section-heading">Apa itu Relf Connect?</h3>
                <p>Relf Connect adalah platform donasi barang bekas berbasis web yang menghubungkan donatur dengan lembaga amal secara mudah, aman, dan transparan.</p>
                <h3 class="section-heading mt-5">Misi Kami</h3>
                <p class="fst-italic">"Mempermudah berbagi kebaikan melalui teknologi yang transparan, aman, dan terpercaya."</p>
            </div>
        </div>
    </div>
</section>

<!-- Campaign Section -->
<section id="campaign" class="section-title-bar">
    <div class="container"><h2>Kampanye Donasi Aktif</h2></div>
</section>
<main class="campaign-section">
    <div class="container">
        <div class="row g-4">
            <?php if (!empty($campaigns)): ?>
                <?php foreach ($campaigns as $campaign): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card campaign-card h-100">
                            <img src="<?= base_url('uploads/campaigns/' . ($campaign->image_url ?? 'default.jpg')); ?>" class="card-img-top" alt="<?= htmlspecialchars($campaign->title); ?>" style="height: 200px; object-fit: cover;" onerror="this.src='https://placehold.co/600x400/e9ecef/6c757d?text=Image+Not+Found'">
                            <div class="card-body d-flex flex-column">
                                <div class="card-meta d-flex justify-content-between mb-2">
                                    <span><?= htmlspecialchars($campaign->lembaga_name ?? 'Lembaga Amal'); ?></span>
                                    <span class="donasi-count"><?= $campaign->donation_count ?? '0'; ?> Donasi</span>
                                </div>
                                <h5 class="card-title">
                                    <a href="<?= site_url('campaigns/detail/' . $campaign->campaign_id); ?>">
                                        <?= htmlspecialchars($campaign->title); ?>
                                    </a>
                                </h5>
                                <p class="card-text small text-muted flex-grow-1"><?= character_limiter(strip_tags($campaign->description), 100); ?></p>
                                <a href="<?= site_url('campaigns/detail/' . $campaign->campaign_id); ?>" class="btn btn-primary custom-btn mt-3">Lihat Detail & Donasi</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col"><p class="text-center">Belum ada kampanye yang bisa ditampilkan.</p></div>
            <?php endif; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?= site_url('campaigns'); ?>" class="btn btn-outline-success">Lihat Semua Kampanye</a>
        </div>
    </div>
</main>

<!-- Testimonial Section -->
<section class="section-title-bar">
    <div class="container"><h2>Testimoni</h2></div>
</section>
<section id="testimoni" class="testimonial-section">
    <div class="container">
        <h3 class="text-center mb-5 section-heading">Apa Kata Mereka?</h3>
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="testimonial-box">
                        <div class="quote-icon">“</div>
                        <p class="testimonial-text">Program ini sangat membantu! Terima kasih telah mendistribusikan bantuan dengan cepat kepada kami.</p>
                        <p class="testimonial-author mt-4">- Anonim</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial-box">
                        <div class="quote-icon">“</div>
                        <p class="testimonial-text">Platform Relf Connect sangat transparan dan mudah digunakan. Kami bisa melihat langsung progres donasi kami.</p>
                        <p class="testimonial-author mt-4">- Budi Donatur</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial-box">
                        <div class="quote-icon">“</div>
                        <p class="testimonial-text">Akhirnya ada cara mudah untuk menyalurkan barang bekas. Sangat bermanfaat bagi panti asuhan kami.</p>
                        <p class="testimonial-author mt-4">- Panti Asuhan Kasih Bunda</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
