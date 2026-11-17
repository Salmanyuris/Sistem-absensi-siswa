<?php
require_once __DIR__ . "/app-helpers.php";
require_once __DIR__ . "/koneksi.php";

$renderError = function ($title, $message) {
    ?>
    <section class="panel student-detail-error" role="alert">
        <h2><?= htmlspecialchars($title, ENT_QUOTES, "UTF-8") ?></h2>
        <p><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></p>
        <a href="index.php?page=data" class="btn btn-primary">Kembali ke data siswa</a>
    </section>
    <?php
};

$nis = request_string($_GET, "id");
if (!is_valid_nis($nis)) {
    http_response_code(400);
    $renderError("NIS tidak valid", "Periksa kembali alamat halaman detail siswa.");
    return;
}

if (!$koneksi) {
    include __DIR__ . "/database-error.php";
    return;
}

$studentStatement = mysqli_prepare(
    $koneksi,
    "SELECT nis, nama, kelas, alamat, jenis_kelamin, agama FROM siswa WHERE nis = ?"
);
if (!$studentStatement) {
    error_log("Gagal menyiapkan detail siswa: " . mysqli_error($koneksi));
    http_response_code(500);
    $renderError("Detail siswa gagal dimuat", "Data siswa tidak dapat dimuat saat ini.");
    return;
}

mysqli_stmt_bind_param($studentStatement, "s", $nis);
if (!mysqli_stmt_execute($studentStatement)) {
    error_log("Gagal memuat detail siswa: " . mysqli_stmt_error($studentStatement));
    mysqli_stmt_close($studentStatement);
    http_response_code(500);
    $renderError("Detail siswa gagal dimuat", "Data siswa tidak dapat dimuat saat ini.");
    return;
}

$studentNis = $studentName = $studentClass = $studentAddress = $studentGender = $studentReligion = null;
mysqli_stmt_bind_result(
    $studentStatement,
    $studentNis,
    $studentName,
    $studentClass,
    $studentAddress,
    $studentGender,
    $studentReligion
);
$studentFound = mysqli_stmt_fetch($studentStatement);
$studentFetchError = mysqli_stmt_errno($studentStatement);
mysqli_stmt_close($studentStatement);

if ($studentFetchError !== 0) {
    error_log("Gagal membaca detail siswa: " . mysqli_error($koneksi));
    http_response_code(500);
    $renderError("Detail siswa gagal dimuat", "Data siswa tidak dapat dimuat saat ini.");
    return;
}
if (!$studentFound) {
    http_response_code(404);
    $renderError("Siswa tidak ditemukan", "Data siswa yang diminta tidak tersedia.");
    return;
}

$summaryStatement = mysqli_prepare(
    $koneksi,
    "SELECT COUNT(*), MAX(tanggal) FROM absen WHERE nis = ?"
);
if (!$summaryStatement) {
    error_log("Gagal menyiapkan ringkasan absensi siswa: " . mysqli_error($koneksi));
    http_response_code(500);
    $renderError("Riwayat absensi gagal dimuat", "Ringkasan kehadiran tidak dapat dimuat saat ini.");
    return;
}

mysqli_stmt_bind_param($summaryStatement, "s", $nis);
if (!mysqli_stmt_execute($summaryStatement)) {
    error_log("Gagal menghitung riwayat absensi siswa: " . mysqli_stmt_error($summaryStatement));
    mysqli_stmt_close($summaryStatement);
    http_response_code(500);
    $renderError("Riwayat absensi gagal dimuat", "Ringkasan kehadiran tidak dapat dimuat saat ini.");
    return;
}

$attendanceCount = 0;
$latestAttendance = null;
mysqli_stmt_bind_result($summaryStatement, $attendanceCount, $latestAttendance);
if (!mysqli_stmt_fetch($summaryStatement)) {
    error_log("Gagal membaca ringkasan absensi siswa: " . mysqli_stmt_error($summaryStatement));
    mysqli_stmt_close($summaryStatement);
    http_response_code(500);
    $renderError("Riwayat absensi gagal dimuat", "Ringkasan kehadiran tidak dapat dimuat saat ini.");
    return;
}
mysqli_stmt_close($summaryStatement);

$historyStatement = mysqli_prepare(
    $koneksi,
    "SELECT tanggal, jam_absen FROM absen WHERE nis = ? ORDER BY tanggal DESC, jam_absen DESC LIMIT 10"
);
if (!$historyStatement) {
    error_log("Gagal menyiapkan daftar riwayat absensi: " . mysqli_error($koneksi));
    http_response_code(500);
    $renderError("Riwayat absensi gagal dimuat", "Daftar kehadiran tidak dapat dimuat saat ini.");
    return;
}

mysqli_stmt_bind_param($historyStatement, "s", $nis);
if (!mysqli_stmt_execute($historyStatement)) {
    error_log("Gagal memuat riwayat absensi siswa: " . mysqli_stmt_error($historyStatement));
    mysqli_stmt_close($historyStatement);
    http_response_code(500);
    $renderError("Riwayat absensi gagal dimuat", "Daftar kehadiran tidak dapat dimuat saat ini.");
    return;
}

$attendanceDate = $attendanceTime = null;
mysqli_stmt_bind_result($historyStatement, $attendanceDate, $attendanceTime);
$attendanceHistory = array();
while (mysqli_stmt_fetch($historyStatement)) {
    $attendanceHistory[] = array(
        "tanggal" => $attendanceDate,
        "jam_absen" => $attendanceTime,
    );
}
mysqli_stmt_close($historyStatement);

$student = array(
    "nis" => $studentNis,
    "nama" => $studentName,
    "kelas" => $studentClass,
    "alamat" => $studentAddress,
    "jenis_kelamin" => $studentGender,
    "agama" => $studentReligion,
);
?>

<div class="page-intro">
    <div>
        <h2>Detail siswa</h2>
        <p>Identitas dan ringkasan catatan kehadiran siswa.</p>
    </div>
    <div class="page-intro-actions">
        <a href="index.php?page=data" class="btn btn-light">Kembali</a>
        <a href="form-edit.php?id=<?= urlencode($student["nis"]) ?>" class="btn btn-primary">Edit siswa</a>
    </div>
</div>

<div class="student-detail-grid">
    <section class="panel student-detail-panel">
        <div class="panel-heading">
            <div class="section-icon">▦</div>
            <div>
                <h3>Identitas siswa</h3>
                <p>Informasi yang tersimpan pada data siswa</p>
            </div>
        </div>
        <dl class="student-details">
            <div>
                <dt>NIS</dt>
                <dd><?= htmlspecialchars($student["nis"], ENT_QUOTES, "UTF-8") ?></dd>
            </div>
            <div>
                <dt>Nama lengkap</dt>
                <dd><?= htmlspecialchars($student["nama"], ENT_QUOTES, "UTF-8") ?></dd>
            </div>
            <div>
                <dt>Kelas</dt>
                <dd><?= $student["kelas"] !== ""
                    ? htmlspecialchars($student["kelas"], ENT_QUOTES, "UTF-8")
                    : "Belum diatur" ?></dd>
            </div>
            <div>
                <dt>Jenis kelamin</dt>
                <dd><?= htmlspecialchars($student["jenis_kelamin"], ENT_QUOTES, "UTF-8") ?></dd>
            </div>
            <div>
                <dt>Agama</dt>
                <dd><?= htmlspecialchars($student["agama"], ENT_QUOTES, "UTF-8") ?></dd>
            </div>
            <div class="student-detail-address">
                <dt>Alamat</dt>
                <dd><?= htmlspecialchars($student["alamat"], ENT_QUOTES, "UTF-8") ?></dd>
            </div>
        </dl>
    </section>

    <section class="panel student-attendance-summary">
        <span class="student-summary-label">CATATAN KEHADIRAN</span>
        <strong><?= (int) $attendanceCount ?></strong>
        <span>catatan tersimpan</span>
        <div class="student-latest-attendance">
            <span>Terakhir tercatat</span>
            <strong>
                <?= $latestAttendance
                    ? htmlspecialchars($latestAttendance, ENT_QUOTES, "UTF-8")
                    : "Belum ada catatan" ?>
            </strong>
        </div>
    </section>
</div>

<section class="panel table-panel">
    <div class="panel-heading panel-heading-between">
        <div>
            <h3>Riwayat kehadiran</h3>
            <p>Menampilkan hingga 10 catatan terbaru untuk siswa ini.</p>
        </div>
        <span class="table-label">TANGGAL &amp; JAM</span>
    </div>
    <div class="table-responsive">
        <table class="table modern-table align-middle">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Jam masuk</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendanceHistory as $index => $attendance) { ?>
                    <tr>
                        <td class="row-number"><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($attendance["tanggal"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><span class="time-badge"><?= htmlspecialchars($attendance["jam_absen"], ENT_QUOTES, "UTF-8") ?></span></td>
                    </tr>
                <?php } ?>
                <?php if (count($attendanceHistory) === 0) { ?>
                    <tr><td colspan="3" class="empty-state">Belum ada riwayat kehadiran untuk siswa ini.</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <p class="student-history-note">Skema absensi saat ini hanya menyimpan tanggal dan jam; status kehadiran akan tersedia setelah migrasi database.</p>
</section>
