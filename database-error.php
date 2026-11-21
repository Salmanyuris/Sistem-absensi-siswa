<div class="database-notice">
    <span class="database-notice-icon">!</span>
    <div>
        <h2>Database belum siap</h2>
        <p>Data aplikasi belum bisa dimuat. Pastikan MySQL aktif dan database <strong>absensi</strong> beserta tabelnya sudah tersedia.</p>
        <?php if (isset($databaseError) && $databaseError !== '') { ?>
            <small>Koneksi database: <?= htmlspecialchars($databaseError, ENT_QUOTES, 'UTF-8') ?></small>
        <?php } ?>
    </div>
</div>
