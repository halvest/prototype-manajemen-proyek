<?php
// Test Diagnostik untuk Masalah Autoloading Composer di CodeIgniter

echo "<h1>Hasil Tes Diagnostik</h1>";
echo "<hr>";
echo "Waktu Tes: " . date('Y-m-d H:i:s');
echo "<br><br>";

// === TES 1: Cek Keberadaan File autoload.php ===
$autoload_file = __DIR__ . '/vendor/autoload.php';
echo "<h2>Tes 1: Memeriksa file autoload.php</h2>";
echo "Mencari file di path: <strong>" . htmlspecialchars($autoload_file) . "</strong><br>";

if (!file_exists($autoload_file)) {
    echo "<p style='color:red; font-weight:bold;'>HASIL: GAGAL</p>";
    echo "<p>File <strong>autoload.php</strong> tidak ditemukan. Ini adalah akar masalahnya. Folder 'vendor' Anda mungkin tidak ada atau tidak lengkap.</p>";
    echo "<p><strong>Solusi:</strong> Buka terminal/CMD di folder proyek Anda dan jalankan perintah <code>composer install</code>. Pastikan tidak ada error saat proses instalasi.</p>";
    exit; // Hentikan tes jika file ini tidak ada
}

echo "<p style='color:green; font-weight:bold;'>HASIL: BERHASIL</p>";
echo "<p>File <strong>autoload.php</strong> berhasil ditemukan.</p>";
echo "<hr>";


// === TES 2: Memuat Autoloader dan Memeriksa Class REST_Controller ===
echo "<h2>Tes 2: Memuat Autoloader & Memeriksa Class 'REST_Controller'</h2>";

// Muat autoloader
require_once $autoload_file;
echo "File autoload.php berhasil dimuat (require_once).<br>";

if (class_exists('chriskacerguis\RestServer\RestController')) {
    echo "<p style='color:green; font-weight:bold;'>HASIL: BERHASIL</p>";
    echo "<p>Class <strong>'chriskacerguis\RestServer\RestController'</strong> berhasil ditemukan setelah autoloader dimuat.</p>";
    echo "<p>Ini berarti instalasi Composer Anda sudah benar, dan masalahnya kemungkinan besar ada pada konfigurasi CodeIgniter.</p>";
    echo "<p><strong>Solusi:</strong> Periksa kembali file <code>application/config/config.php</code> dan pastikan baris ini sudah benar: <code>\$config['composer_autoload'] = FCPATH . 'vendor/autoload.php';</code></p>";

} else if (class_exists('REST_Controller')) {
     echo "<p style='color:green; font-weight:bold;'>HASIL: BERHASIL (Versi Lama)</p>";
     echo "<p>Class <strong>'REST_Controller'</strong> (tanpa namespace) berhasil ditemukan setelah autoloader dimuat.</p>";
     echo "<p>Ini berarti instalasi Composer Anda sudah benar, dan masalahnya kemungkinan besar ada pada konfigurasi CodeIgniter.</p>";
     echo "<p><strong>Solusi:</strong> Periksa kembali file <code>application/config/config.php</code> dan pastikan baris ini sudah benar: <code>\$config['composer_autoload'] = FCPATH . 'vendor/autoload.php';</code></p>";
} else {
    echo "<p style='color:red; font-weight:bold;'>HASIL: GAGAL</p>";
    echo "<p>Autoloader berhasil dimuat, tetapi class <strong>'REST_Controller'</strong> tetap tidak ditemukan.</p>";
    echo "<p><strong>Ini menandakan ada masalah serius dengan instalasi library `codeigniter-restserver` Anda.</strong></p>";
    echo "<p><strong>Solusi:</strong></p>";
    echo "<ol>";
    echo "<li>Hapus folder <strong>vendor</strong> dan file <strong>composer.lock</strong>.</li>";
    echo "<li>Pastikan file <strong>composer.json</strong> Anda sudah benar (memiliki `chriskacerguis/codeigniter-restserver`).</li>";
    echo "<li>Jalankan kembali <code>composer install</code> dari terminal.</li>";
    echo "</ol>";
}

?>