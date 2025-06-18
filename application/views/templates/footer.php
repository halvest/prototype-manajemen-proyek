<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5>RelfConnect</h5>
                <p class="footer-text">Menghubungkan kebaikan, mempermudah donasi. Platform terpercaya untuk menyalurkan barang bekas Anda kepada yang membutuhkan.</p>
            </div>
            <div class="col-lg-2 col-md-4 col-6 mb-4 mb-lg-0">
                <h5>Navigasi</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?= site_url('home'); ?>">Home</a></li>
                    <li><a href="<?= site_url('home/about'); ?>">Tentang Kami</a></li>
                    <li><a href="<?= site_url('home/campaign'); ?>">Kampanye</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-6 mb-4 mb-lg-0">
                <h5>Lainnya</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Kontak</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 mb-4 mb-lg-0">
                <h5>Berlangganan Newsletter</h5>
                <p class="footer-text">Dapatkan info kampanye terbaru langsung di email Anda.</p>
                <form action="<?= site_url('newsletter/subscribe'); ?>" method="post">
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" placeholder="Masukkan email Anda" required>
                        <button class="btn btn-primary custom-btn" type="submit" style="padding: 8px 15px;">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-5 footer-bottom">
            <div class="col text-center">
                <p>&copy; <?= date('Y'); ?> RelfConnect. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('assets/js/script.js'); ?>"></script>


