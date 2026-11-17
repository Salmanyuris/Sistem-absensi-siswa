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

$nis = request_string($_GET, "id");
if (!is_valid_nis($nis)) {
    http_response_code(400);
    $errorTitle = "NIS tidak valid";
    $errorMessage = "Data siswa tidak dapat dimuat karena NIS tidak valid.";
    $errorBackUrl = "index.php?page=data";
    include "page-error.php";
    exit;
}

$statement = mysqli_prepare($koneksi, "SELECT nis, nama, kelas, alamat, jenis_kelamin, agama FROM siswa WHERE nis = ?");
if (!$statement) {
    http_response_code(500);
    $errorTitle = "Data siswa gagal dimuat";
    $errorMessage = "Terjadi kesalahan saat menyiapkan permintaan data.";
    $errorDetail = mysqli_error($koneksi);
    $errorBackUrl = "index.php?page=data";
    include "page-error.php";
    exit;
}

mysqli_stmt_bind_param($statement, "s", $nis);
if (!mysqli_stmt_execute($statement)) {
    http_response_code(500);
    $errorTitle = "Data siswa gagal dimuat";
    $errorMessage = "Terjadi kesalahan saat membaca data siswa.";
    $errorDetail = mysqli_stmt_error($statement);
    $errorBackUrl = "index.php?page=data";
    include "page-error.php";
    exit;
}

$studentNis = $studentName = $studentClass = $studentAddress = $gender = $religion = null;
mysqli_stmt_bind_result($statement, $studentNis, $studentName, $studentClass, $studentAddress, $gender, $religion);
$found = mysqli_stmt_fetch($statement);
mysqli_stmt_close($statement);

if (!$found) {
    http_response_code(404);
    $errorTitle = "Siswa tidak ditemukan";
    $errorMessage = "Data siswa dengan NIS tersebut tidak tersedia.";
    $errorBackUrl = "index.php?page=data";
    include "page-error.php";
    exit;
}

$data = array(
    "nis" => $studentNis,
    "nama" => $studentName,
    "kelas" => $studentClass,
    "alamat" => $studentAddress,
    "jenis_kelamin" => $gender,
    "agama" => $religion,
);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit siswa | Absensi Sekolah</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="edit-page">
        <section class="edit-card">
            <h1>Edit data siswa</h1>
            <p class="edit-subtitle">Perbarui informasi siswa, lalu simpan perubahan.</p>
            <form action="proses-edit.php" method="post">
                <div class="mb-3">
                    <label class="form-label" for="nis">NIS</label>
                    <input id="nis" type="text" class="form-control" name="nis" value="<?= htmlspecialchars($data['nis'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nama">Nama siswa</label>
                    <input id="nama" type="text" class="form-control" name="nama" value="<?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="kelas">Kelas</label>
                    <input id="kelas" type="text" class="form-control" name="kelas" maxlength="30" value="<?= htmlspecialchars($data['kelas'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Contoh: XI RPL 1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="alamat">Alamat</label>
                    <input id="alamat" type="text" class="form-control" name="alamat" value="<?= htmlspecialchars($data['alamat'], ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="jenis_kelamin">Jenis kelamin</label>
                    <select id="jenis_kelamin" class="form-select" name="jenis_kelamin" required>
                        <option value="">Pilih jenis kelamin</option>
                        <option value="pria" <?= $data['jenis_kelamin'] === 'pria' ? 'selected' : '' ?>>Pria</option>
                        <option value="wanita" <?= $data['jenis_kelamin'] === 'wanita' ? 'selected' : '' ?>>Wanita</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="agama">Agama</label>
                    <select id="agama" class="form-select" name="agama" required>
                        <option value="">Pilih agama</option>
                        <option value="islam" <?= $data['agama'] === 'islam' ? 'selected' : '' ?>>Islam</option>
                        <option value="kristen" <?= $data['agama'] === 'kristen' ? 'selected' : '' ?>>Kristen</option>
                        <option value="budha" <?= $data['agama'] === 'budha' ? 'selected' : '' ?>>Budha</option>
                        <option value="katholik" <?= $data['agama'] === 'katholik' ? 'selected' : '' ?>>Katholik</option>
                    </select>
                </div>
                <div class="edit-actions">
                    <a href="index.php?page=data" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan perubahan</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>
