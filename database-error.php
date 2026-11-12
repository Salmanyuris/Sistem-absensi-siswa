<div class="database-notice">
    <span class="database-notice-icon">!</span>
    <div>
        <h2>Database belum siap</h2>
        <p>Data aplikasi belum bisa dimuat. Impor file <strong>absensi.sql</strong> melalui phpMyAdmin, lalu muat ulang halaman ini.</p>
        <?php if (!empty($databaseError)) { ?>
            <small>Koneksi database: <?= htmlspecialchars($databaseError, ENT_QUOTES, 'UTF-8') ?></small>
        <?php } ?>
    </div>
</div>
