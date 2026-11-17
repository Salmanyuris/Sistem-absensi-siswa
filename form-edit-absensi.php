<?php
require_once "app-helpers.php";
include "koneksi.php";
if (!$koneksi) {
    http_response_code(503);
    $errorTitle = "Database belum siap";
    $errorMessage = "Pastikan MySQL aktif dan database absensi tersedia.";
    $errorDetail = $databaseError;
    include "page-error.php";
    exit;
}

$nis = request_string($_GET, "nis");
$tanggal = request_string($_GET, "tanggal");
if (!is_valid_nis($nis) || !is_valid_date($tanggal)) {
    http_response_code(400);
    $errorTitle = "NIS tidak valid";
    $errorMessage = "Data absensi tidak dapat dimuat karena NIS atau tanggal tidak valid.";
    $errorBackUrl = "index.php?page=home";
    include "page-error.php";
    exit;
}

$statement = mysqli_prepare($koneksi, "SELECT nis, nama, jam_absen, tanggal FROM absen WHERE nis = ? AND tanggal = ?");
if (!$statement) {
    http_response_code(500);
    $errorTitle = "Data absensi gagal dimuat";
    $errorMessage = "Terjadi kesalahan saat menyiapkan permintaan data.";
    $errorDetail = mysqli_error($koneksi);
    $errorBackUrl = "index.php?page=home";
    include "page-error.php";
    exit;
}

mysqli_stmt_bind_param($statement, "is", $nis, $tanggal);
if (!mysqli_stmt_execute($statement)) {
    http_response_code(500);
    $errorTitle = "Data absensi gagal dimuat";
    $errorMessage = "Terjadi kesalahan saat membaca data absensi.";
    $errorDetail = mysqli_stmt_error($statement);
    $errorBackUrl = "index.php?page=home";
    include "page-error.php";
    exit;
}

$attendanceNis = $attendanceName = $attendanceTime = $attendanceDate = null;
mysqli_stmt_bind_result($statement, $attendanceNis, $attendanceName, $attendanceTime, $attendanceDate);
$found = mysqli_stmt_fetch($statement);
mysqli_stmt_close($statement);

if (!$found) {
    http_response_code(404);
    $errorTitle = "Absensi tidak ditemukan";
    $errorMessage = "Data absensi dengan NIS tersebut tidak tersedia.";
    $errorBackUrl = "index.php?page=home";
    include "page-error.php";
    exit;
}

$data = array(
    "nis" => $attendanceNis,
    "nama" => $attendanceName,
    "jam_absen" => $attendanceTime,
    "tanggal" => $attendanceDate,
);
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
                <input type="hidden" name="nis_awal" value="<?= htmlspecialchars($data['nis'], ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="tanggal_awal" value="<?= htmlspecialchars($data['tanggal'], ENT_QUOTES, 'UTF-8') ?>">
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
