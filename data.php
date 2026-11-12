<?php
include "koneksi.php";
$sql = "SELECT * FROM siswa";
$result = mysqli_query($koneksi, $sql);
?>

<div class="page-intro">
    <div>
        <h2>Data siswa</h2>
        <p>Kelola informasi siswa yang terdaftar di sekolah.</p>
    </div>
    <a href="index.php?page=tambah" class="btn btn-primary">＋ Tambah siswa</a>
</div>

<section class="panel table-panel">
    <div class="panel-heading panel-heading-between">
        <div>
            <h3>Daftar siswa</h3>
            <p>Informasi dasar seluruh siswa</p>
        </div>
        <span class="table-label">DATA SISWA</span>
    </div>
    <div class="table-responsive">
        <table class="table modern-table align-middle">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIS</th>
                    <th>Nama siswa</th>
                    <th>Alamat</th>
                    <th>Jenis kelamin</th>
                    <th>Agama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; while ($data = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td class="row-number"><?= $i++ ?></td>
                        <td><?= htmlspecialchars($data['nis'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="student-name"><?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($data['alamat'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($data['jenis_kelamin'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($data['agama'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="actions">
                            <a href="form-edit.php?id=<?= urlencode($data['nis']) ?>" class="btn btn-sm btn-soft-primary">Edit</a>
                            <a href="hapus.php?id=<?= urlencode($data['nis']) ?>" class="btn btn-sm btn-soft-danger" onclick="return confirm('Hapus data siswa ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
                <?php if (mysqli_num_rows($result) === 0) { ?>
                    <tr><td colspan="7" class="empty-state">Belum ada data siswa.</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>
