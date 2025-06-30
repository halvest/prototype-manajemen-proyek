<style>
    /* CSS untuk Timeline Pelacakan */
    .timeline { list-style: none; padding: 1rem 0; position: relative; }
    .timeline:before { content: ''; position: absolute; top: 0; bottom: 0; left: 20px; width: 3px; background-color: #e9ecef; }
    .timeline-item { margin-bottom: 2rem; position: relative; padding-left: 45px; }
    .timeline-item:last-child { margin-bottom: 0; }
    .timeline-icon { position: absolute; left: 0; top: 0; width: 40px; height: 40px; border-radius: 50%; background-color: #e9ecef; color: #6c757d; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; z-index: 1; }
    .timeline-item.active .timeline-icon { background-color: #1abc9c; color: #fff; }
    .timeline-content { padding-left: 15px; }
    .timeline-content h6 { font-weight: 600; }
    .timeline-content p { font-size: 0.9rem; color: #6c757d; margin-bottom: 0; }
</style>

<div class="card">
    <div class="card-header bg-white">
        <h4 class="mb-0">Lacak Status Donasi</h4>
    </div>
    <div class="card-body">
        <p class="text-muted">Masukkan ID Donasi Anda untuk melihat status pengiriman terkini.</p>
        <?= form_open('donatur/tracking'); ?>
            <div class="input-group mb-3">
                <input type="text" name="donation_id" class="form-control" placeholder="Contoh: 1, 2, 3..." required>
                <button class="btn btn-success" type="submit">Cari Donasi</button>
            </div>
        <?= form_close(); ?>
    </div>
</div>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger mt-3"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<?php if (isset($donation_result) && $donation_result): ?>
    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Hasil Pelacakan untuk ID Donasi: #<?= htmlspecialchars($donation_result->donation_id); ?></h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Untuk Kampanye:</strong><br>
                    <?= htmlspecialchars($donation_result->campaign_title); ?>
                </div>
                <div class="col-md-6 text-md-end">
                    <strong>Status Terkini:</strong><br>
                    <span class="badge bg-primary"><?= htmlspecialchars($donation_result->current_status); ?></span>
                </div>
            </div>
            <hr>
            
            <ul class="timeline">
                <li class="timeline-item active">
                    <div class="timeline-icon"><i class="bi bi-journal-text"></i></div>
                    <div class="timeline-content">
                        <h6>Data Donasi Dibuat</h6>
                        <p>Anda telah berhasil membuat permintaan donasi.</p>
                        <small class="text-muted"><?= date('d F Y, H:i', strtotime($donation_result->created_at)); ?></small>
                    </div>
                </li>
                
                <?php // --- LOGIKA BARU UNTUK MENAMPILKAN STATUS --- ?>
                <?php if($donation_result->current_status == 'Dalam Proses' || $donation_result->current_status == 'Received'): ?>
                <li class="timeline-item active">
                    <div class="timeline-icon"><i class="bi bi-truck"></i></div>
                    <div class="timeline-content">
                        <h6>Donasi Diproses</h6>
                        <p>Donasi Anda sedang dalam proses penjemputan atau pengiriman.</p>
                    </div>
                </li>
                <?php endif; ?>
                
                <?php if($donation_result->current_status == 'Received'): ?>
                <li class="timeline-item active">
                    <div class="timeline-icon"><i class="bi bi-patch-check-fill"></i></div>
                    <div class="timeline-content">
                        <h6>Donasi Diterima</h6>
                        <p>Donasi telah diterima oleh lembaga tujuan. Terima kasih!</p>
                    </div>
                </li>
                <?php endif; ?>
                 <?php // --- AKHIR LOGIKA BARU --- ?>

            </ul>
        </div>
    </div>
<?php elseif ($this->input->post('donation_id')): ?>
     <div class="card mt-4">
        <div class="card-body text-center p-5">
            <p class="text-muted mb-0">ID Donasi tidak ditemukan atau bukan milik Anda.</p>
        </div>
    </div>
<?php endif; ?>
