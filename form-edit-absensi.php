<?php
include "koneksi.php";
if (!$koneksi) {
    http_response_code(503);
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Database belum siap | Absensi Sekolah</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body><main class="edit-page"><section class="edit-card"><?php include "database-error.php"; ?></section></main></body>
    </html>
    <?php
    exit;
}

$nis = $_GET['id'];
$sql = "SELECT * FROM absen WHERE nis='$nis'";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit absensi | Absensi Sekolah</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="edit-page">
        <section class="edit-card">
            <h1>Edit data absensi</h1>
            <p class="edit-subtitle">Perbarui detail kehadiran siswa, lalu simpan perubahan.</p>
            <form action="proses-edit-absensi.php" method="post">
                <div class="mb-3">
                    <label class="form-label" for="nis">NIS</label>
                    <input id="nis" type="text" class="form-control" name="nis" value="<?= htmlspecialchars($data['nis'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nama">Nama siswa</label>
                    <input id="nama" type="text" class="form-control" name="nama" value="<?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="jam_absen">Jam masuk</label>
                    <input id="jam_absen" type="time" class="form-control" name="jam_absen" value="<?= htmlspecialchars($data['jam_absen'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="tanggal">Tanggal</label>
                    <input id="tanggal" type="date" class="form-control" name="tanggal" value="<?= htmlspecialchars($data['tanggal'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="edit-actions">
                    <a href="index.php?page=home" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan perubahan</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>
