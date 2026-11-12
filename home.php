<?php
include "koneksi.php";
if (!$koneksi) {
    include "database-error.php";
    return;
}

$sql = "SELECT * FROM absen";
$result = mysqli_query($koneksi, $sql);
?>

<div class="page-intro">
    <div>
        <h2>Ringkasan kehadiran</h2>
        <p>Catat kehadiran dan pantau data absensi siswa.</p>
    </div>
    <span class="date-pill"><?= date('d M Y') ?></span>
</div>

<div class="workspace-grid">
    <section class="panel form-panel">
        <div class="panel-heading">
            <div class="section-icon">＋</div>
            <div>
                <h3>Tambah absensi</h3>
                <p>Lengkapi detail kehadiran siswa</p>
            </div>
        </div>
        <form action="proses-tambah-absensi.php" method="post">
            <div class="mb-3">
                <label class="form-label" for="nis">NIS</label>
                <input id="nis" type="text" class="form-control" name="nis" placeholder="Contoh: 10234" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="nama">Nama siswa</label>
                <input id="nama" type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="form-row">
                <div class="mb-3">
                    <label class="form-label" for="jam_absen">Jam masuk</label>
                    <input id="jam_absen" type="time" class="form-control" name="jam_absen" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="tanggal">Tanggal</label>
                    <input id="tanggal" type="date" class="form-control" name="tanggal" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="simpan" value="simpan">Simpan absensi</button>
        </form>
    </section>

    <section class="panel table-panel">
        <div class="panel-heading panel-heading-between">
            <div>
                <h3>Riwayat absensi</h3>
                <p>Data kehadiran siswa terbaru</p>
            </div>
            <span class="table-label">TERCATAT</span>
        </div>
        <div class="table-responsive">
            <table class="table modern-table align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIS</th>
                        <th>Nama siswa</th>
                        <th>Jam masuk</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while ($data = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td class="row-number"><?= $i++ ?></td>
                            <td><?= htmlspecialchars($data['nis'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="student-name"><?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><span class="time-badge"><?= htmlspecialchars($data['jam_absen'], ENT_QUOTES, 'UTF-8') ?></span></td>
                            <td><?= htmlspecialchars($data['tanggal'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="actions">
                                <a href="form-edit-absensi.php?id=<?= urlencode($data['nis']) ?>" class="btn btn-sm btn-soft-primary">Edit</a>
                                <a href="hapus-absensi.php?id=<?= urlencode($data['nis']) ?>" class="btn btn-sm btn-soft-danger" onclick="return confirm('Hapus data absensi ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if (mysqli_num_rows($result) === 0) { ?>
                        <tr><td colspan="6" class="empty-state">Belum ada data absensi.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
