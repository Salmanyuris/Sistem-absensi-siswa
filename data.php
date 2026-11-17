<?php
require_once __DIR__ . "/app-helpers.php";
require_once __DIR__ . "/koneksi.php";

if (!$koneksi) {
    include __DIR__ . "/database-error.php";
    return;
}

$sortOptions = array(
    "nama_asc" => array("label" => "Nama A-Z", "sql" => "nama ASC, nis ASC"),
    "nama_desc" => array("label" => "Nama Z-A", "sql" => "nama DESC, nis DESC"),
    "nis_asc" => array("label" => "NIS terkecil", "sql" => "nis ASC"),
    "nis_desc" => array("label" => "NIS terbesar", "sql" => "nis DESC"),
);

$search = request_string($_GET, "q");
$gender = request_string($_GET, "gender");
$sort = request_string($_GET, "sort");
$pageInput = request_string($_GET, "p");
$filterError = "";

if (!in_array($gender, array("", "pria", "wanita"), true)) {
    $filterError = "Filter jenis kelamin tidak valid. Pilih opsi yang tersedia.";
    $gender = "";
}

if ($sort === "") {
    $sort = "nama_asc";
}
if (!isset($sortOptions[$sort])) {
    if ($filterError === "") {
        $filterError = "Urutan data tidak valid. Pilih opsi yang tersedia.";
    }
    $sort = "nama_asc";
}

$currentPage = 1;
if ($pageInput !== "") {
    $validatedPage = filter_var(
        $pageInput,
        FILTER_VALIDATE_INT,
        array("options" => array("min_range" => 1))
    );
    if ($validatedPage === false) {
        if ($filterError === "") {
            $filterError = "Nomor halaman tidak valid. Kembali ke halaman pertama.";
        }
    } else {
        $currentPage = (int) $validatedPage;
    }
}

if ($filterError !== "") {
    http_response_code(400);
}

$pageSize = 10;
$searchPattern = "%" . $search . "%";
$criteriaSql = " WHERE (? = '' OR CAST(nis AS CHAR) LIKE ? OR nama LIKE ?)"
    . " AND (? = '' OR jenis_kelamin = ?)";
$countStatement = mysqli_prepare($koneksi, "SELECT COUNT(*) FROM siswa" . $criteriaSql);
if (!$countStatement) {
    error_log("Gagal menyiapkan jumlah data siswa: " . mysqli_error($koneksi));
    show_page_error(500, "Data siswa gagal dimuat", "Daftar siswa tidak dapat dimuat saat ini.", "index.php?page=data");
}

mysqli_stmt_bind_param(
    $countStatement,
    "sssss",
    $search,
    $searchPattern,
    $searchPattern,
    $gender,
    $gender
);
if (!mysqli_stmt_execute($countStatement)) {
    error_log("Gagal menghitung data siswa: " . mysqli_stmt_error($countStatement));
    mysqli_stmt_close($countStatement);
    show_page_error(500, "Data siswa gagal dimuat", "Daftar siswa tidak dapat dimuat saat ini.", "index.php?page=data");
}

mysqli_stmt_bind_result($countStatement, $totalRows);
if (!mysqli_stmt_fetch($countStatement)) {
    error_log("Gagal membaca jumlah data siswa: " . mysqli_stmt_error($countStatement));
    mysqli_stmt_close($countStatement);
    show_page_error(500, "Data siswa gagal dimuat", "Daftar siswa tidak dapat dimuat saat ini.", "index.php?page=data");
}
mysqli_stmt_close($countStatement);

$totalRows = (int) $totalRows;
$totalPages = max(1, (int) ceil($totalRows / $pageSize));
$currentPage = min($currentPage, $totalPages);
$offset = ($currentPage - 1) * $pageSize;

$studentSql = "SELECT nis, nama, kelas, alamat, jenis_kelamin, agama FROM siswa"
    . $criteriaSql
    . " ORDER BY " . $sortOptions[$sort]["sql"]
    . " LIMIT ? OFFSET ?";
$studentStatement = mysqli_prepare($koneksi, $studentSql);
if (!$studentStatement) {
    error_log("Gagal menyiapkan daftar siswa: " . mysqli_error($koneksi));
    show_page_error(500, "Data siswa gagal dimuat", "Daftar siswa tidak dapat dimuat saat ini.", "index.php?page=data");
}

mysqli_stmt_bind_param(
    $studentStatement,
    "sssssii",
    $search,
    $searchPattern,
    $searchPattern,
    $gender,
    $gender,
    $pageSize,
    $offset
);
if (!mysqli_stmt_execute($studentStatement)) {
    error_log("Gagal memuat daftar siswa: " . mysqli_stmt_error($studentStatement));
    mysqli_stmt_close($studentStatement);
    show_page_error(500, "Data siswa gagal dimuat", "Daftar siswa tidak dapat dimuat saat ini.", "index.php?page=data");
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

$students = array();
while (mysqli_stmt_fetch($studentStatement)) {
    $students[] = array(
        "nis" => $studentNis,
        "nama" => $studentName,
        "kelas" => $studentClass,
        "alamat" => $studentAddress,
        "jenis_kelamin" => $studentGender,
        "agama" => $studentReligion,
    );
}
mysqli_stmt_close($studentStatement);

$firstResult = $totalRows === 0 ? 0 : $offset + 1;
$lastResult = min($offset + $pageSize, $totalRows);
$pageUrl = function ($targetPage) use ($search, $gender, $sort) {
    return "index.php?" . http_build_query(array(
        "page" => "data",
        "q" => $search,
        "gender" => $gender,
        "sort" => $sort,
        "p" => $targetPage,
    ));
};
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

    <?php if ($filterError !== "") { ?>
        <div class="student-filter-error" role="alert"><?= htmlspecialchars($filterError, ENT_QUOTES, "UTF-8") ?></div>
    <?php } ?>

    <form class="student-filter-form" method="get" action="index.php">
        <input type="hidden" name="page" value="data">
        <div class="student-search-field">
            <label class="form-label" for="student-search">Cari siswa</label>
            <input
                id="student-search"
                class="form-control"
                type="search"
                name="q"
                value="<?= htmlspecialchars($search, ENT_QUOTES, "UTF-8") ?>"
                placeholder="Cari berdasarkan NIS atau nama"
            >
        </div>
        <div>
            <label class="form-label" for="student-gender">Jenis kelamin</label>
            <select id="student-gender" class="form-select" name="gender">
                <option value="">Semua</option>
                <option value="pria" <?= $gender === "pria" ? "selected" : "" ?>>Pria</option>
                <option value="wanita" <?= $gender === "wanita" ? "selected" : "" ?>>Wanita</option>
            </select>
        </div>
        <div>
            <label class="form-label" for="student-sort">Urutkan</label>
            <select id="student-sort" class="form-select" name="sort">
                <?php foreach ($sortOptions as $sortKey => $sortOption) { ?>
                    <option value="<?= htmlspecialchars($sortKey, ENT_QUOTES, "UTF-8") ?>" <?= $sort === $sortKey ? "selected" : "" ?>>
                        <?= htmlspecialchars($sortOption["label"], ENT_QUOTES, "UTF-8") ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="student-filter-actions">
            <button type="submit" class="btn btn-primary">Terapkan</button>
            <a href="index.php?page=data" class="btn btn-light">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table modern-table align-middle">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIS</th>
                    <th>Nama siswa</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Jenis kelamin</th>
                    <th>Agama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $index => $student) { ?>
                    <tr>
                        <td class="row-number"><?= $firstResult + $index ?></td>
                        <td><?= htmlspecialchars($student["nis"], ENT_QUOTES, "UTF-8") ?></td>
                        <td class="student-name"><?= htmlspecialchars($student["nama"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= $student["kelas"] !== ""
                            ? htmlspecialchars($student["kelas"], ENT_QUOTES, "UTF-8")
                            : "Belum diatur" ?></td>
                        <td><?= htmlspecialchars($student["alamat"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= htmlspecialchars($student["jenis_kelamin"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= htmlspecialchars($student["agama"], ENT_QUOTES, "UTF-8") ?></td>
                        <td class="actions">
                            <a href="index.php?page=detail&amp;id=<?= urlencode($student["nis"]) ?>" class="btn btn-sm btn-light">Detail</a>
                            <a href="form-edit.php?id=<?= urlencode($student["nis"]) ?>" class="btn btn-sm btn-soft-primary">Edit</a>
                            <a href="hapus.php?id=<?= urlencode($student["nis"]) ?>" class="btn btn-sm btn-soft-danger" onclick="return confirm('Hapus data siswa ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
                <?php if ($totalRows === 0) { ?>
                    <tr><td colspan="8" class="empty-state">Tidak ada siswa yang cocok dengan pencarian.</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="student-list-footer">
        <p class="student-results-count">
            Menampilkan <?= $firstResult ?>–<?= $lastResult ?> dari <?= $totalRows ?> siswa
        </p>
        <nav class="student-pagination" aria-label="Halaman daftar siswa">
            <?php if ($currentPage > 1) { ?>
                <a class="btn btn-light" href="<?= htmlspecialchars($pageUrl($currentPage - 1), ENT_QUOTES, "UTF-8") ?>">Sebelumnya</a>
            <?php } else { ?>
                <span class="btn btn-light disabled" aria-disabled="true">Sebelumnya</span>
            <?php } ?>
            <span class="student-page-number">Halaman <?= $currentPage ?> dari <?= $totalPages ?></span>
            <?php if ($currentPage < $totalPages) { ?>
                <a class="btn btn-light" href="<?= htmlspecialchars($pageUrl($currentPage + 1), ENT_QUOTES, "UTF-8") ?>">Selanjutnya</a>
            <?php } else { ?>
                <span class="btn btn-light disabled" aria-disabled="true">Selanjutnya</span>
            <?php } ?>
        </nav>
    </div>
</section>
