<?php
require_once __DIR__ . "/app-helpers.php";
require_once __DIR__ . "/koneksi.php";

if (!$koneksi) {
    include __DIR__ . "/database-error.php";
    return;
}

$dateFrom = request_string($_GET, "dari");
$dateTo = request_string($_GET, "sampai");
$class = request_string($_GET, "kelas");
$filterError = "";

if (($dateFrom !== "" && !is_valid_date($dateFrom)) || ($dateTo !== "" && !is_valid_date($dateTo))) {
    $filterError = "Format tanggal tidak valid. Pilih tanggal yang tersedia.";
}
if ($filterError === "" && $dateFrom !== "" && $dateTo !== "" && $dateFrom > $dateTo) {
    $filterError = "Tanggal mulai tidak boleh melewati tanggal akhir.";
}

$classStatement = mysqli_prepare(
    $koneksi,
    "SELECT DISTINCT kelas FROM siswa WHERE kelas <> '' ORDER BY kelas ASC"
);
if (!$classStatement || !mysqli_stmt_execute($classStatement)) {
    error_log("Gagal memuat pilihan kelas: " . ($classStatement ? mysqli_stmt_error($classStatement) : mysqli_error($koneksi)));
    if ($classStatement) {
        mysqli_stmt_close($classStatement);
    }
    show_page_error(500, "Rekap gagal dimuat", "Pilihan kelas tidak dapat dimuat saat ini.", "index.php?page=rekap");
}

$classValue = null;
mysqli_stmt_bind_result($classStatement, $classValue);
$classes = array();
while (mysqli_stmt_fetch($classStatement)) {
    $classes[] = $classValue;
}
$classFetchError = mysqli_stmt_errno($classStatement);
mysqli_stmt_close($classStatement);
if ($classFetchError !== 0) {
    error_log("Gagal membaca pilihan kelas: " . mysqli_error($koneksi));
    show_page_error(500, "Rekap gagal dimuat", "Pilihan kelas tidak dapat dimuat saat ini.", "index.php?page=rekap");
}

if ($filterError === "" && $class !== "" && !in_array($class, $classes, true)) {
    $filterError = "Kelas yang dipilih tidak ditemukan. Pilih kelas yang tersedia.";
}

if ($filterError !== "") {
    http_response_code(400);
}

$totalRecords = 0;
$totalStudents = 0;
$attendanceRows = array();
if ($filterError === "") {
    $summaryStatement = mysqli_prepare(
        $koneksi,
        "SELECT COUNT(*), COUNT(DISTINCT a.nis)
         FROM absen a
         LEFT JOIN siswa s ON s.nis = a.nis
         WHERE (? = '' OR a.tanggal >= ?)
           AND (? = '' OR a.tanggal <= ?)
           AND (? = '' OR s.kelas = ?)"
    );
    if (!$summaryStatement) {
        error_log("Gagal menyiapkan ringkasan rekap absensi: " . mysqli_error($koneksi));
        show_page_error(500, "Rekap gagal dimuat", "Ringkasan absensi tidak dapat dimuat saat ini.", "index.php?page=rekap");
    }

    mysqli_stmt_bind_param($summaryStatement, "ssssss", $dateFrom, $dateFrom, $dateTo, $dateTo, $class, $class);
    if (!mysqli_stmt_execute($summaryStatement)) {
        error_log("Gagal menghitung rekap absensi: " . mysqli_stmt_error($summaryStatement));
        mysqli_stmt_close($summaryStatement);
        show_page_error(500, "Rekap gagal dimuat", "Ringkasan absensi tidak dapat dimuat saat ini.", "index.php?page=rekap");
    }
    mysqli_stmt_bind_result($summaryStatement, $totalRecords, $totalStudents);
    if (!mysqli_stmt_fetch($summaryStatement)) {
        error_log("Gagal membaca ringkasan rekap absensi: " . mysqli_stmt_error($summaryStatement));
        mysqli_stmt_close($summaryStatement);
        show_page_error(500, "Rekap gagal dimuat", "Ringkasan absensi tidak dapat dimuat saat ini.", "index.php?page=rekap");
    }
    mysqli_stmt_close($summaryStatement);

    $attendanceStatement = mysqli_prepare(
        $koneksi,
        "SELECT a.nis, a.nama, a.jam_absen, a.tanggal, s.kelas
         FROM absen a
         LEFT JOIN siswa s ON s.nis = a.nis
         WHERE (? = '' OR a.tanggal >= ?)
           AND (? = '' OR a.tanggal <= ?)
           AND (? = '' OR s.kelas = ?)
         ORDER BY a.tanggal DESC, a.jam_absen DESC, a.nis ASC"
    );
    if (!$attendanceStatement) {
        error_log("Gagal menyiapkan daftar rekap absensi: " . mysqli_error($koneksi));
        show_page_error(500, "Rekap gagal dimuat", "Daftar absensi tidak dapat dimuat saat ini.", "index.php?page=rekap");
    }

    mysqli_stmt_bind_param($attendanceStatement, "ssssss", $dateFrom, $dateFrom, $dateTo, $dateTo, $class, $class);
    if (!mysqli_stmt_execute($attendanceStatement)) {
        error_log("Gagal memuat daftar rekap absensi: " . mysqli_stmt_error($attendanceStatement));
        mysqli_stmt_close($attendanceStatement);
        show_page_error(500, "Rekap gagal dimuat", "Daftar absensi tidak dapat dimuat saat ini.", "index.php?page=rekap");
    }

    $attendanceNis = $attendanceName = $attendanceTime = $attendanceDate = $attendanceClass = null;
    mysqli_stmt_bind_result(
        $attendanceStatement,
        $attendanceNis,
        $attendanceName,
        $attendanceTime,
        $attendanceDate,
        $attendanceClass
    );
    while (mysqli_stmt_fetch($attendanceStatement)) {
        $attendanceRows[] = array(
            "nis" => $attendanceNis,
            "nama" => $attendanceName,
            "jam_absen" => $attendanceTime,
            "tanggal" => $attendanceDate,
            "kelas" => $attendanceClass,
        );
    }
    $attendanceFetchError = mysqli_stmt_errno($attendanceStatement);
    mysqli_stmt_close($attendanceStatement);
    if ($attendanceFetchError !== 0) {
        error_log("Gagal membaca daftar rekap absensi: " . mysqli_error($koneksi));
        show_page_error(500, "Rekap gagal dimuat", "Daftar absensi tidak dapat dimuat saat ini.", "index.php?page=rekap");
    }
}
?>

<div class="page-intro">
    <div>
        <h2>Rekap absensi</h2>
        <p>Filter catatan kehadiran berdasarkan rentang tanggal dan kelas.</p>
    </div>
</div>

<section class="panel table-panel">
    <form class="attendance-filter-form" method="get" action="index.php">
        <input type="hidden" name="page" value="rekap">
        <div>
            <label class="form-label" for="attendance-from">Dari tanggal</label>
            <input id="attendance-from" class="form-control" type="date" name="dari" value="<?= htmlspecialchars($dateFrom, ENT_QUOTES, "UTF-8") ?>">
        </div>
        <div>
            <label class="form-label" for="attendance-to">Sampai tanggal</label>
            <input id="attendance-to" class="form-control" type="date" name="sampai" value="<?= htmlspecialchars($dateTo, ENT_QUOTES, "UTF-8") ?>">
        </div>
        <div>
            <label class="form-label" for="attendance-class">Kelas</label>
            <select id="attendance-class" class="form-select" name="kelas">
                <option value="">Semua kelas</option>
                <?php foreach ($classes as $classOption) { ?>
                    <option value="<?= htmlspecialchars($classOption, ENT_QUOTES, "UTF-8") ?>" <?= $class === $classOption ? "selected" : "" ?>>
                        <?= htmlspecialchars($classOption, ENT_QUOTES, "UTF-8") ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="attendance-filter-actions">
            <button type="submit" class="btn btn-primary">Terapkan</button>
            <a href="index.php?page=rekap" class="btn btn-light">Reset</a>
        </div>
    </form>

    <?php if ($filterError !== "") { ?>
        <div class="student-filter-error" role="alert"><?= htmlspecialchars($filterError, ENT_QUOTES, "UTF-8") ?></div>
    <?php } ?>

    <?php if (count($classes) === 0) { ?>
        <p class="attendance-filter-note">Belum ada kelas. Lengkapi data kelas pada menu Data siswa.</p>
    <?php } ?>

    <div class="attendance-summary" aria-live="polite">
        <div>
            <span>Catatan absensi</span>
            <strong><?= (int) $totalRecords ?></strong>
        </div>
        <div>
            <span>Siswa tercatat</span>
            <strong><?= (int) $totalStudents ?></strong>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table modern-table align-middle">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>NIS</th>
                    <th>Nama siswa</th>
                    <th>Kelas</th>
                    <th>Jam masuk</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendanceRows as $index => $attendance) { ?>
                    <tr>
                        <td class="row-number"><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($attendance["tanggal"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= htmlspecialchars($attendance["nis"], ENT_QUOTES, "UTF-8") ?></td>
                        <td class="student-name"><?= htmlspecialchars($attendance["nama"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= $attendance["kelas"] !== null && $attendance["kelas"] !== ""
                            ? htmlspecialchars($attendance["kelas"], ENT_QUOTES, "UTF-8")
                            : "Belum diatur" ?></td>
                        <td><span class="time-badge"><?= htmlspecialchars($attendance["jam_absen"], ENT_QUOTES, "UTF-8") ?></span></td>
                    </tr>
                <?php } ?>
                <?php if ($filterError === "" && count($attendanceRows) === 0) { ?>
                    <tr><td colspan="6" class="empty-state">Tidak ada catatan absensi yang sesuai dengan filter.</td></tr>
                <?php } elseif ($filterError !== "") { ?>
                    <tr><td colspan="6" class="empty-state">Perbaiki filter untuk menampilkan rekap absensi.</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>
